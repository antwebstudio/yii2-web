<?php
namespace ant\widgets;

use yii\helpers\Url;

class ModalBootstrap4 extends \yii\bootstrap4\Modal {
    public $url;

    public function init() {
        if (isset($this->url)) {
            $this->clientEvents['show.bs.modal'] = new \yii\web\JsExpression('function() {
                var url = "'.Url::to($this->url).'";
                $modalBody = $("#' . $this->id . '").find(".modal-body");
                $modalBody.html("<div class=\"modal-loader\"></div>");
                $modalBody.load(url, function() { 
                
                });
            }');
        }
        parent::init();
        
    }
}