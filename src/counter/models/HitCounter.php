<?php

namespace ant\counter\models;

use Yii;

/**
 * This is the model class for table "hit_counter".
 *
 * @property integer $id
 * @property string $key
 * @property integer $unique_visit
 * @property string $created_date
 * @property string $last_updated
 */
 
 //ALTER TABLE `hit_counter` CHANGE `created_date` `created_at` TIMESTAMP NULL, CHANGE `last_updated` `updated_at` TIMESTAMP NULL;

 
class HitCounter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%hit_counter}}';
    }
	
	public function behaviors() {
		return [
			['class' => \ant\behaviors\TimestampBehavior::className()],
		];
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['unique_visit'], 'integer'],
            [['created_date', 'last_updated'], 'safe'],
            [['key'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'unique_visit' => 'Unique Visit',
            'created_date' => 'Created Date',
            'last_updated' => 'Last Updated',
        ];
    }
	
	public static function isNewVisit($key) {
		//$serialize_key = serialize($key);
		//if (isset($_SESSION['hitCounter']['visit'][$serialize_key]) && $_SESSION['hitCounter']['visit'][$serialize_key] === true) return false;
		//$_SESSION['hitCounter']['visit'][$serialize_key] = true;
		return true;
	}
	
	public static function getCounter($key) {
		$serialize_key = serialize($key);
		
		return self::findOne([
			'key' => $serialize_key,
		]);
	}
	
	public static function addCounter($key) {
		if (!self::isNewVisit($key)) return false;
		
		$serialize_key = serialize($key);
		$model = self::findOne([
			'key' => $serialize_key,
		]);
		
		if (isset($model)) {
			$model->updateCounters(['unique_visit' => 1]);
		} else {
			$model = new HitCounter;
			$model->key = $serialize_key;
			$model->unique_visit = 1;
			$model->save();
		}
		return $model;
	}
}
