<?php
namespace ant\widgets;

use yii\helpers\Html;

class SideNav extends \yii\base\Widget {
    public $heading = '';

    public $items = [];

    public $options = [];

    public function run() {
        if (!isset($this->options['class'])) $this->options['class'] = 'nav-pills nav flex-column nav-tabs-nostyle';
        
        $html = Html::beginTag('div', ['class' => 'card']);
        $html .= Html::tag('div', $this->heading, ['class' => 'card-header list-heading']);
        $html .= \ant\widgets\Nav::widget([
            'items' => $this->items,
            'options' => $this->options,
        ]);
        $html .= Html::endTag('div');
        
        return $html;
    }
}