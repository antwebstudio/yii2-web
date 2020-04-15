<?php
namespace ant\widgets;

use yii\helpers\Html;

class NumberSpinner extends \yii\widgets\InputWidget {
	public function run() {
		$this->registerScript();
		$this->view->registerCss('.quantity-selector input[type=number] { text-align: center; width: 50px; vertical-align: bottom; }');
		
		$this->options['data-input'] = 'number-spinner';
		Html::addCssClass($this->options, 'quantity-selector');
		
		$html = Html::beginTag('div', $this->options);
		$html .= '<a data-action="minus" class="btn btn-sm btn-dark" href="javascript:;"><i class="fa fa-minus"></i></a>';
		if ($this->hasModel()) {
			$html .= Html::activeTextInput($this->model, $this->attribute, ['type' => 'number']);
		} else {
			$html .= Html::textInput($this->name, 0, ['type' => 'number']);
		}
		$html .= '<a data-action="plus" class="btn btn-sm btn-dark" href="javascript:;"><i class="fa fa-plus"></i></a>';
		$html .= Html::endTag('div');
		
		return $html;
	}
	
	protected function registerScript() {
		$this->view->registerJs('
			(function($) {
				$("[data-input=number-spinner]").each(function() {
					var $input = $(this).find("input[type=number]");
					console.log($input);
					$(this).find("[data-action=minus]").click(function() {
						var qty = parseInt($input.val());
						if (qty > 0) {
							$input.val(--qty).trigger("change");
						}
					});
					$(this).find("[data-action=plus]").click(function() {
						var qty = parseInt($input.val());
						$input.val(++qty).trigger("change");
					});
				});
			})(jQuery);
		');
	}
}