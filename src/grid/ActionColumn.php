<?php
namespace ant\grid;

use Yii;
use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn {
    const MESSAGE_DELETE_CONFIRM = 'Are you sure you want to delete this item?';

    public $iconMap = [
        'pencil' => 'edit',
        'eye-open' => 'eye',
    ];

    public static function dropdown($options) {
        $items = isset($options['items']) ? $options['items'] : [];
        $color = isset($options['color']) ? $options['color'] : 'secondary';

        foreach ($items as &$item) {
            if (isset($item['confirm'])) $item['linkOptions']['data']['confirm'] = $item['confirm'];
            if (isset($item['method'])) $item['linkOptions']['data']['method'] = $item['method']; 
        }

        return \yii\bootstrap4\ButtonDropdown::widget([
            'label' => isset($options['label']) ? $options['label'] : '',
            'split' => true,
            'tagName' => 'a',
            'buttonOptions' => [
                //'onclick' => 'showBookingDetail("'.$model->encodedId.'")',
                //'data-toggle' => 'modal',
                //'data-target' => '#'.$modal2->id,
                //'href' => '#'.$modal2->id,
                'href' => isset($options['url']) ? $options['url'] : '',
                'class' => 'btn-sm btn btn-'.$color,
            ],
            'dropdown' => [
                'items' => $items,
            ],
        ]);
    }

    public static function button($options) {
        $color = isset($options['color']) ? $options['color'] : 'default';
        $defaultButtonCssClass = 'btn btn-'.$color.' btn-sm btn-labeled text-left';

        $label = isset($options['label']) ? $options['label'] : null;
        $icon = isset($options['icon']) ? $options['icon'] : null;
        $url = isset($options['url']) ? $options['url'] : null;
        $buttonOptions = isset($options['options']) ? $options['options'] : null;
        $buttonOptions['class'] = isset($buttonOptions['class']) ? $buttonOptions['class'] : $defaultButtonCssClass;

        if (isset($options['confirm'])) $buttonOptions['data']['confirm'] = $options['confirm'];
        if (isset($options['method'])) $buttonOptions['data']['method'] = $options['method'];

        $icon = strtr('<i class="fa fa-{icon} fa-fw"></i>', ['{icon}' => $icon]);
        $label = strtr('<span class="btn-label">{icon}</span> {label}', ['{label}' => $label, '{icon}' => $icon]);

        return Html::a($label, $url, $buttonOptions);
    }

    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-$iconName fas fa-".$this->mapIcon($iconName).""]);
                return Html::a($icon, $url, $options);
            };
        }
    }

    protected function mapIcon($iconName) {
        return isset($this->iconMap[$iconName]) ? $this->iconMap[$iconName] : $iconName;
    }
}