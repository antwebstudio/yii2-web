<?php
namespace ant\widgets;

use yii\helpers\Html;

class Pjax extends \yii\widgets\Pjax {
	public $showLoader = true;
	public $loaderOptions = ['class' => 'loading'];
	
	public function init() {
		parent::init();
		$this->registerLoaderScript();
	}
	
	public function run() {
		$content = $this->showLoader ? $this->renderLoader() : '';
		return $content.parent::run();
	}
	
	protected function renderLoader() {
		if (!isset($this->loaderOptions['style'])) {
			$this->loaderOptions['style'] = '';
		}
		$this->loaderOptions['style'] .= ' display:none; ';
		return Html::tag('div', '', $this->loaderOptions);
	}
	
	protected function registerLoaderScript() {
		$this->view->registerJs('
			(function($) {
				$(document).on("pjax:send", function() {
				  $(".loading").show()
				})
				$(document).on("pjax:complete", function() {
				  $(".loading").hide()
				})
			})(jQuery);
		');
	}
}