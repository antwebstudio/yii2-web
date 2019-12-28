<?php
namespace ant\widgets;

class Youtube extends \yii\base\Widget {
    public $url;
    public $autoplay = false;

    public function run() {
        return $this->convertYoutube($this->url);
    }

    protected function convertYoutube($url) {
        $autoplay = $this->autoplay ? 1 : 0;
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        
        return '<div class="video-wrap embed-responsive embed-responsive-16by9"><iframe class="video-iframe embed-responsive-item" src="//www.youtube.com/embed/'.$match[1].'?autoplay='.$autoplay.'" allowfullscreen></iframe></div>';
        // width="100%" height="500px" 
        /*return preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "<div class=\"video-wrap\"><iframe width=\"100%\" height=\"500px\" src=\"//www.youtube.com/embed/$2?autoplay=1\" allowfullscreen></iframe></div>",$string
        );*/
    }
}