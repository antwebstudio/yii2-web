<?php
namespace ant\widgets;

use ant\helpers\ArrayHelper as Arr;
use ant\helpers\Html;

class StickyBar extends \yii\base\Widget {
	public $template = '{facebook} {share}';
	public $buttonUrls;
	public $buttons = [];
	
	public $defaultButtons = [
		'facebook' => [
			'class' => 'class3 link col-3 bg-facebook',
			'icon' => 'fab fa-facebook-f',
			'label' => '{icon}',
		],
	];
	
	public function init() {
		echo $this->renderBegin();
		ob_start();
	}
	
	public function run() {
		$content = ob_get_clean();
		
		if (isset($content)) {
			echo $content; // Mobile version
		} else {
			$this->buttons = Arr::merge($this->defaultButtons, $this->buttons);
			
			foreach ($this->buttonUrls as $name => $url) {
				if (!isset($this->buttons[$name]['url'])) {
					$this->buttons[$name]['url'] = $url;
				}
			}
			
			echo $this->render('sticky-bar', [
				'urls' => $this->buttonUrls,
			]);
		}
		
		echo $this->renderEnd();
		
		if (isset($content)) {
			echo $this->renderDesktopVersionBegin();
			echo $content; // Desktop version
			echo $this->renderDesktopVersionEnd();
		}
	}
	
	public function renderBegin() {
		return '<div class="fixed-bottom d-md-none">';
	}
	
	public function renderEnd() {
		return '</div>';
	}
	
	public function renderDesktopVersionBegin() {
		return '<div class="d-md-block d-none">';
	}
	
	public function renderDesktopVersionEnd() {
		return '</div>';
	}
	
	public function renderButtons() {
		$html = '';
		foreach ($this->buttons as $name => $button) {
			$label = Arr::remove($button, 'label');
			if (isset($button['icon'])) $label = strtr($label, ['{icon}' => '<i class="'. Arr::remove($button, 'icon') .'"></i>']);
			$html .= Html::a($label, Arr::remove($button, 'url'), $button);
		}
		return $html;
	}
}
