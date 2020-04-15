<?php
namespace ant\widgets;

use yii\helpers\Url;

class FilterTag extends \yii\base\Widget {
	public $model;
	public $attribute;
	
	public function run() {
		if (isset($this->model->{$this->attribute}) && $this->model->{$this->attribute}) {
			return '<a href="' . Url::current([$this->model->formName() => [$this->attribute => null]]) . '">
				<span class="badge badge-sm badge-dark p-2">
					' . $this->model->getAttributeLabel($this->attribute) . ': ' . $this->model->{$this->attribute} . '
					<span class=""><i class="fa fa-times-circle"></i></span>
				</span>
			</a>';
		}
	}
}