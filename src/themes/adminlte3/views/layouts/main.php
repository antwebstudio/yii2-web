<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use ant\widgets\Tabs;
?>
<?php $this->beginContent('@app/views/layouts/base.php') ?>
	<?php if (isset($this->blocks['content-header-buttons'])): ?>
		<?= $this->blocks['content-header-buttons'] ?>
	<?php else: ?>
		<div class="content-header-buttons mb-4">
			<?php if (isset($this->params['content-header-buttons'])): ?>
				<?php foreach ($this->params['content-header-buttons'] as $element): ?>
					<?= $element ?>
				<?php endforeach ?>
			<?php endif ?>
		</div>
	<?php endif ?>
	
	<?= \ant\themes\adminlte3\widgets\Alert::widget() ?>

	<?= Tabs::widget([
		'items' => Yii::$app->menu->getMenu(Yii::$app->request->get('tab')),
	]) ?>
	
	<?= $content ?>
<?php $this->endContent() ?>
