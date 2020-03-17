<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>
<a href="<?= Url::to($item['url']) ?>" class="list-group-item <?= \Yii::$app->menu->isItemActive($item, $this->context->route) ? 'active' : '' ?>">
	<span><i class="icon-home"></i> <?= $item['label'] ?></span>
</a>