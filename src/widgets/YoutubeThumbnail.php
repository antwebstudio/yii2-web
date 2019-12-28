<?php
namespace ant\widgets;

use yii\helpers\Html;

class YoutubeThumbnail extends \yii\base\Widget {
    public $url;
    public $options = [];
    
    public function run() {
        $url = self::getUrl($this->url);
        return Html::img($url, $this->options);
    }

    public static function getUrl($url){
        $filename = 'sddefault';
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        return isset($match[1]) ? 'https://img.youtube.com/vi/'.$match[1].'/'.$filename.'.jpg' : null;
    }
}