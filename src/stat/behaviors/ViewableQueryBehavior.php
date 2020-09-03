<?php
namespace ant\stat\behaviors;

use Yii;

class ViewableQueryBehavior extends \yii\base\Behavior {
	public function orderByViews($direction = 'desc', $key = null, $startsAt = null, $endsAt = null) {
		return $this->owner->joinWith(['viewRecords viewRecords' => function($q) use ($key, $startsAt, $endsAt) {
			if (isset($key)) $q->haveKey($key);
			$q->createdAtBetween($startsAt, $endsAt);
		}])
			->orderBy('viewRecords.unique_visit '.$direction);
	}
}