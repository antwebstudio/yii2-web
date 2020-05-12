<?php
namespace ant\widgets;

use yii\helpers\Url;
use yii\helpers\Html;

class FilterTag extends \yii\base\Widget {
	public $model;
	public $attribute;
	public $options = ['class' => 'badge badge-sm badge-dark p-2'];
	public $linkOptions = [];
	
	public function run() {
		if (isset($this->model->{$this->attribute}) && $this->model->{$this->attribute}) {
			return Html::a(
				Html::tag('span', 
					$this->model->getAttributeLabel($this->attribute) . ': ' . $this->model->{$this->attribute} . '
					<i class="fa fa-times-circle"></i>',
				$this->options)
			, Url::current([$this->model->formName() => [$this->attribute => null]]), $this->linkOptions);
		}
	}
}