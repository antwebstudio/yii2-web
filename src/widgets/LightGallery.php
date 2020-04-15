<?php

namespace ant\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use ant\widgets\assets\LightGalleryAsset;

class LightGallery extends \yii\base\Widget
{
    public $containerOptions = ['class' => 'light-gallery'];
	
	// more options http://sachinchoolur.github.io/lightGallery/docs/api.html
    public $options = [];
	public $clientOptions;
    public $items = [];
	public $thumbOptions = ['class' => 'img-fluid'];


    public function init()
    {
		if (!isset($this->clientOptions)) $this->clientOptions = $this->options;
        $this->registerClientScript();
    }

    public function run()
    {
        return $this->renderItems();
    }

    public function renderItems()
    {
        $items = [];
        if (count($this->items) > 0) {
            foreach ($this->items as $item) {
                $items[] = $this->renderItem($item);
            }
        }
		$options = $this->containerOptions;
		$options['id'] = $this->id;
        return Html::tag('div', implode("\n", array_filter($items)), $options);
    }

    public function renderItem($item)
    {
        $src = ArrayHelper::getValue($item, 'src');
        $thumb = ArrayHelper::getValue($item, 'thumb');
        return Html::a(Html::img($thumb, $this->thumbOptions), $src);
    }

    public function registerClientScript()
    {
        $view = $this->getView();
        LightGalleryAsset::register($view);
        $options = Json::encode($this->options);
        $js = '$("#' . $this->id . '").lightGallery(' . $options . ');';
        $view->registerJs($js);
        $this->addCss();
    }

    public function addCss()
    {
        $css = "
            .light-gallery a img {
                position: relative;
                cursor: pointer;
                overflow: hidden;
            }
            .light-gallery a{
                border-bottom: none;
                margin: 0 1px 1px 0;
                transition: all 0.4s ease 0.1s;
            }
        ";
        $this->getView()->registerCss($css);

    }
}