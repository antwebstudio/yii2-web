<?php

namespace ant\stat\models;

use Yii;
use ant\stat\models\query\VisitQuery;

/**
 * This is the model class for table "tw_stat_model_visit".
 *
 * @property int $id
 * @property int|null $model_id
 * @property int|null $model_class_id
 * @property string|null $type
 * @property string|null $key
 * @property int $unique_visit
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Visit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%stat_model_visit}}';
    }

    public static function normalizeKey($key) {
		if (isset($key)) {
			asort($key);
			return json_encode($key);
		}
    }
    
    public static function find() {
        return new VisitQuery(get_called_class());
    }
	
	public function behaviors() {
		return [
			['class' => \ant\behaviors\TimestampBehavior::class],
		];
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model_id', 'model_class_id', 'unique_visit'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['type'], 'string', 'max' => 50],
            [['key'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model_id' => 'Model ID',
            'model_class_id' => 'Model Class ID',
            'type' => 'Type',
            'key' => 'Key',
            'unique_visit' => 'Unique Visit',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
