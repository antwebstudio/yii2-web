<?php

namespace ant\stat\models\query;

use ant\helpers\DateTime;
use ant\stat\models\Visit;

class VisitQuery extends \yii\db\ActiveQuery {
    public function behaviors() {
        return [
            \ant\behaviors\DateTimeAttributeQueryBehavior::class,
        ];
    }

    public function haveKey($key) {
        $key = Visit::normalizeKey($key);
        return $this->andWhere(['key' => $key]);
    }

    public function createdAtBetween($startsAt, $endsAt) {
        if (isset($startsAt)) {
            $this->andWhereAttributeOlderThan('created_at', $startsAt);
        }
        if (isset($endsAt)) {
            $this->andWhereAttributeNewerThan('created_at', $endsAt);
        }
    }
	
	public function andWhereAttributeOlderThan($attribute, $dateTime = null) {
		if (isset($dateTime)) {
			return $this->owner->andWhere(['>', $attribute , (new DateTime($dateTime))->format(DateTime::FORMAT_MYSQL) ]);
		} else {
			return $this->owner;
		}
	}
	
	public function andWhereAttributeNewerThan($attribute, $dateTime = null) {
		if (isset($dateTime)) {
			return $this->owner->andWhere(['<', $attribute , (new DateTime($dateTime))->format(DateTime::FORMAT_MYSQL) ]);
		} else {
			return $this->owner;
		}
	}
}