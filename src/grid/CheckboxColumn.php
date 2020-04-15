<?php
namespace ant\grid;

use Closure;
use yii\helpers\Html;

class CheckboxColumn extends \yii\grid\CheckboxColumn {
	public $useAwesomeCheckbox = false;
	public $highlightRowOnChecked = true;
	public $highlightRowCssClass = 'highlight';
	public $freeze = false;
	
	public function init() {
		if ($this->highlightRowOnChecked) {
			$this->registerHighlightRowScript();
		}
		if ($this->freeze) {
			$this->registerFreezeColumnScript();
		}
		parent::init();
	}
	
	protected function registerFreezeColumnScript() {
		Html::addCssClass($this->contentOptions, 'freeze-col');
		Html::addCssClass($this->headerOptions, 'freeze-col');
		$this->grid->view->registerCss('.table-responsive .freeze-col { background-color: #999999; z-index: 1; position: sticky; position: -webkit-sticky; left: 0px; } ');
	}
	
	protected function registerHighlightRowScript() {
		$this->grid->view->registerCss('tr.highlighted { background-color: #cccccc!important; }');
		$this->grid->view->registerJs('
			(function($) {
				$("#'.$this->grid->id.' tbody tr").each(function() {
					var $tr = $(this);
					$tr.find("[type=checkbox]").change(function() {
						console.log("change");
						if ($(this).is(":checked")) {
							$tr.addClass("highlighted");
							//$tr.classList.add("highlighted");
						} else {
							$tr.removeClass("highlighted");
							//$tr.classList.remove("highlighted");
						}
					});
				});
			})(jQuery);
		');
	}
	
    protected function renderHeaderCellContent()
    {
        if ($this->header !== null || !$this->multiple) {
            return parent::renderHeaderCellContent();
        }

		if ($this->useAwesomeCheckbox) {
			$id = uniqid();
			return Html::tag('div', Html::checkbox($this->getHeaderCheckBoxName(), false, ['id' => $id, 'class' => 'select-on-check-all']).'<label for="'.$id.'"></label>', ['class' => 'checkbox checkbox-primary']);
		}
		
        return parent::renderHeaderCellContent();
    }

    /**
     * {@inheritdoc}
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        if ($this->content !== null) {
            return parent::renderDataCellContent($model, $key, $index);
        }
		
		if ($this->useAwesomeCheckbox) {
			$id = uniqid();
			
			if ($this->checkboxOptions instanceof Closure) {
				$options = call_user_func($this->checkboxOptions, $model, $key, $index, $this);
			} else {
				$options = $this->checkboxOptions;
			}

			if (!isset($options['value'])) {
				$options['value'] = is_array($key) ? Json::encode($key) : $key;
			}

			if ($this->cssClass !== null) {
				Html::addCssClass($options, $this->cssClass);
			}
			$options['id'] = $id;
			return Html::tag('div', Html::checkbox($this->name, !empty($options['checked']), $options).'<label for="'.$id.'"></label>', ['class' => 'checkbox checkbox-primary']);
        }
		
        return parent::renderDataCellContent($model, $key, $index);
    }
}