<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\base\UnknownPropertyException;

/**
 *
 *  $settingForm = new SettingForm($configModels);
 *  $settingForm->{model} = 'value';
 *  $settingForm->save();
 *  
 *  $settingForm->ConfigureAdmin1 = true;
 *
 *  Product
 *  [
 *      name =>
 *  ]
 * 
 */

class SettingForm extends Model
{
    protected $_attributeModels = [];

    protected $_attribtues = null;

    protected $_labels = null;

    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        
        if (method_exists($this, $setter)) {

            $this->$setter($value);

        } else if (isset($this->{$name})) {

            $this->{$name} = $value;

        } else if (isset($this->attributeModels[$name])) {

            $this->setAttributeModelValue($name, $value);

        } else {
            
            throw new UnknownPropertyException('Setting unknown property: ' . get_class($this) . '::' . $name);
        }
    }

    public function __get($name)
    {
        $getter = 'get' . $name;

        if (method_exists($this, $getter)) {

            return $this->$getter();

        } else if (isset($this->{$name})) {

            return $this->{$name};

        } else {

            if (isset($this->attributeModels[$name])) {

                return $this->getAttributeModelValue($name);

            } else {

                throw new UnknownPropertyException('Setting unknown property: ' . get_class($this) . '::' . $name);

            }
        }
    }

    public function rules()
    {
        return [
            [$this->attributes(), 'safe'],
        ];
    }

    // public function afterValidate()
    // {
    //     if (!Model::validateMultiple($this->attributeModels))
    //     {
    //         $this->addError(null);
    //     }
    // 
    //     parent::afterValidate();
    // }

    public function attributes()
    {
        if ($this->_attribtues === null)
        {
            $this->_attribtues = array_keys($this->attributeModels);
        }

        return $this->_attribtues;
    }

    public function attributeLabels()
    {
        if ($this->_labels === null)
        {
            foreach ($this->attributeModels as $key => $model) 
            {
                $this->_labels[$key] = $model->key;
            }
        }

        return $this->_labels;
    }

    public function save()
    {
        if (!$this->validate()) return false;

        $transaction = Yii::$app->db->beginTransaction();

        foreach ($this->attributeModels as $model) 
        {
            if (!$model->save(false)) 
            {   
                $transaction->rollBack();
                return false;
            }
        }
        
        $transaction->commit();
        return true;
    }

    public function setAttributeModels($attributeModels)
    {
        $models = [];

        foreach ($attributeModels as $model)
        {   
            $models[lcfirst((new \ReflectionClass($model))->getShortName()) . $model->id] = $model;
        }

        $this->_attributeModels = $models;
    }

    public function getAttributeModels()
    {
        return $this->_attributeModels;
    }

    protected function setAttributeModelValue($name, $value)
    {
        $this->getAttributeModel($name)->value = $value;
    }

    protected function getAttributeModelValue($name)
    {
        return $this->getAttributeModel($name)->value;
    }

    public function getAttributeModel($name)
    {
        return $this->attributeModels[$name];
    }
}
?>