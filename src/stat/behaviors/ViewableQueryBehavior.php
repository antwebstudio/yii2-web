<?php
namespace ant\stat\behaviors;

use Yii;

class ViewableQueryBehavior extends \yii\base\Behavior {
	public function orderByViews($direction = 'desc') {
		return $this->owner->joinWith('viewRecords viewRecords')
			->orderBy('viewRecords.unique_visit '.$direction);
	}
}