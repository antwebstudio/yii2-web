<?php
namespace ant\widgets;

use yii\helpers\Html;
use ant\helpers\ArrayHelper;
use ant\helpers\TemplateHelper;

class ShareWidget extends \yii\base\Widget {
	public $url;
	public $template = '{facebook} {link}';
	public $buttonTemplate = '<i class="{icon}"></i>';
	public $button = [];
	
	protected $defaultButton = [
		'facebook' => [
			'icon' => 'fab fa-facebook-f',
			'url' => 'https://www.facebook.com/sharer/sharer.php?u={url}&amp;src=sdkpreparse',
			'options' => ['target' => '_blank'],
		],
		'link' => [
			'icon' => 'fas fa-link',
			'options' => ['data-toggle' => 'copy-link', 'data-copied' => '<span style="position: relative; "><i class="fas fa-link"></i> <span class="tooltiptext">Link Copied</span></span>'],
			'url' => '{url}',
		],
	];
	
	public function run() {
		$this->view->registerCss('
		');
		$this->view->registerJs('
			var copyLink = function (link){
				var currentLink = document.createElement("input");
				currentLink.class = "copytext";
				document.body.appendChild(currentLink);
				currentLink.value = link;
				currentLink.select();
				document.execCommand("copy");
				document.body.removeChild(currentLink);
			}
			
			var buttons = document.querySelectorAll("[data-toggle=copy-link]");
			
			for (var i = 0; i < buttons.length; i++) {
				var button = buttons[i];
				var orig = button.innerHTML;
				var copied = button.getAttribute("data-copied");
				button.addEventListener("click", function(event) {
					event.preventDefault();
					copyLink(button.getAttribute("href"));
					button.innerHTML = copied;
				});
				
				button.addEventListener("mouseout", function(event) {
					button.innerHTML = orig;
				});
			}
		');
		
		$buttons = ArrayHelper::merge($this->defaultButton, $this->button);
		
		foreach ($buttons as $name => $options) {
			$url = isset($options['url']) ? $options['url'] : null;
			$renderer[$name] = function () use ($url, $name) {
				$url = strtr($url, ['{url}' => $this->url]);
				return $this->renderButton($url, $name);
			};
		}
		
		return TemplateHelper::render($this->template, $renderer);
	}
	
	public function renderButton($url, $name) {
		$buttons = ArrayHelper::merge($this->defaultButton, $this->button);
		$label = TemplateHelper::render($this->buttonTemplate, ['icon' => isset($buttons[$name]['icon']) ? $buttons[$name]['icon'] : '']);
		$options = isset($buttons[$name]['options']) ? $buttons[$name]['options'] : [];
		
		return Html::a($label, $url, $options);
	}
}