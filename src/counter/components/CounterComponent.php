<?php
namespace ant\counter\components;

use Yii;
use ant\counter\models\HitCounter;

class CounterComponent extends \yii\base\Component {
	public function addBulk(array $keys = null, $type = 'default') {
		if (!isset($keys) || $keys == '') return;
		
		$encodedKeys = [];
		foreach ($keys as $key) {
			$encodedKeys[] = $this->processKey($key);
		}
		
		$counters = HitCounter::find()->indexBy('key')->andWhere(['type' => $type, 'key' => $encodedKeys])->all();
		
		// Add new non-existed counter
		foreach ($encodedKeys as $encodedKey) {
			if (!isset($counters[$encodedKey]) && $this->shouldUpdate($encodedKey, $type)) {
				$this->addProcessedKey($encodedKey, $type);
			}
		}
		
		// Update existed counters
		$updateKeys = [];
		foreach ($counters as $encodedKey => $counter) {
			if ($this->shouldUpdate($encodedKey, $type)) {
				$updateKeys[] = $encodedKey;
			}
		}
		HitCounter::updateAllCounters(['unique_visit' => 1], ['type' => $type, 'key' => $updateKeys]);
		
		$this->markBulkAsVisited($encodedKeys, $type);
	}
	
	public function add($key, $type = 'default') {
		$encodedKey = $this->processKey($key);
		$counter = HitCounter::find()->andWhere(['type' => $type, 'key' => $encodedKey])->one();
		
		if (isset($counter)) {
			if ($this->shouldUpdate($encodedKey, $type)) {
				$counter->updateCounters(['unique_visit' => 1]);
			}
		} else {
			$this->addProcessedKey($this->processKey($key), $type);
		}
		$this->markAsVisited($encodedKey, $type);
	}
	
	public function getTopKeys($limit = 5, $type = null) {
		$query = HitCounter::find()->orderBy('unique_visit DESC')->limit($limit);
		if (isset($type)) {
			$query->andWhere(['LIKE', 'type', $type.'%', false]);
		}
		return $query->all();
	}
	
	protected function addProcessedKey($processedKey, $type = 'default') {
		if (!isset($processedKey) || $processedKey == '') return;
		
		$counter = new HitCounter;
		$counter->key = $processedKey;
		$counter->type = $type;
		$counter->unique_visit = 1;
		
		if (!$counter->save()) throw new \Exception('Failed to save counter. '.print_r($counter->errors, 1));
	}
	
	protected function markAsVisited($processedKey, $type) {
		return $this->markBulkAsVisited([$processedKey], $type);
	}
	
	protected function markBulkAsVisited(array $processedKeys, $type) {
		$sessionName = 'visited_'.$type;
		
		$visited = Yii::$app->session->get($sessionName, $processedKeys);
		$visited = array_unique(\yii\helpers\ArrayHelper::merge($visited, $processedKeys));
		
		Yii::$app->session->set($sessionName, $visited);
	}
	
	protected function isUniqueVisit($processedKey, $type) {
		$sessionName = 'visited_'.$type;
		$visited = Yii::$app->session->get($sessionName, []);
		
		return !in_array($processedKey, $visited);
		//throw new \Exception(print_r($visited,1));
	}
	
	protected function shouldUpdate($processedKey, $type) {
		return $this->isUniqueVisit($processedKey, $type);
	}
	
	protected function deprocessKey($encodedKey) {
		return $key;
	}
	
	protected function processKey($key) {
		return $key;
	}
}