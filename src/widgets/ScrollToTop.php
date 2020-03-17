<?php
namespace ant\widgets;

use ant\widgets\assets\ScrollToTop as Asset;

class ScrollToTop extends \yii\base\Widget {
	public function run() {
		Asset::register($this->view);
		return $this->render('scroll-to-top', []);
	}
}