<?php
namespace ant\widgets;

use yii\helpers\Html;

class SideNav extends \yii\base\Widget {
    public $heading = false;

    public $items = [];

    public $options = [];

    public function run() {
        if (!isset($this->options['class'])) $this->options['class'] = 'nav-pills nav flex-column nav-tabs-nostyle';
        
        $html = Html::beginTag('div', ['class' => 'card']);
		
		if ($this->heading) {
			$html .= Html::tag('div', $this->heading, ['class' => 'card-header list-heading']);
		}
		
        $html .= \ant\widgets\Nav::widget([
            'items' => $this->items,
            'options' => $this->options,
			'encodeLabels' => false,
        ]);
        $html .= Html::endTag('div');
        
        return $html;
    }
}