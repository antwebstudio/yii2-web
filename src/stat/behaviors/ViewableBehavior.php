<?php
namespace ant\stat\behaviors;

use Yii;
use ant\models\ModelClass;
use ant\stat\models\Visit;

class ViewableBehavior extends \yii\base\Behavior {
    const COOKIES_NAME = 'viewable';
	
	protected $cookiesExpire = 24 * 3600; // seconds
    protected $cookies;
    protected $requestCookies;
	
	public function init() {
		$this->cookies = Yii::$app->response->cookies;
        $this->requestCookies = Yii::$app->request->cookies;
	}
	
	public function hit($key = null) {
		if ($this->shouldCount($this->owner)) {
			$visit = $this->getVisitRecord($this->owner, $key);
			$visit->updateCounters(['unique_visit' => 1]);
		}
	}
	
	public function getViewRecords() {
		return $this->owner->hasMany(Visit::class, ['model_id' => 'id'])
			->onCondition(['model_class_id' => ModelClass::getClassId($this->owner)]);
	}
	
	protected function shouldCount($model) {
		if ($cookie = $this->requestCookies->get($this->getCookieKey($model)) === null) {
			$this->cookies->add(new \yii\web\Cookie([
				'name' => $this->getCookieKey($model),
				'value' => 1,
				'expire' => $this->cookiesExpire == 0 ? $this->cookiesExpire : time() + $this->cookiesExpire,
			]));
			return true;
		}
		return false;
	}
	
	protected function getCookieKey($model) {
		return self::COOKIES_NAME.'_'.ModelClass::getClassId($model).'_'.$model->id;
	}

	protected function normalizeKey($key) {
		return Visit::normalizeKey($key);
	}
	
	protected function getVisitRecord($model, $key = null) {
		$visit = Visit::find()->andWhere([
			'model_id' => $model->id,
			'model_class_id' => ModelClass::getClassId($model),
			'key' => $this->normalizeKey($key),
		])->one();
		
		if (!isset($visit)) {
			$visit = new Visit;
			$visit->attributes = [
				'model_id' => $model->id,
				'model_class_id' => ModelClass::getClassId($model),
				'key' => $this->normalizeKey($key),
			];
			if (!$visit->save()) throw new \Exception(print_r($visit->errors, 1));
		}
		return $visit;	
	}
}