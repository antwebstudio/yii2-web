<?php
use yii\helpers\Url;
use yii\helpers\Html;

$sideNavItems = isset($this->params['sideNav']['items']) ? $this->params['sideNav']['items'] : null;
$sideNavItems = isset($this->params['sidenav']) ? $this->params['sidenav'] : $sideNavItems;

?>
<?php $this->beginContent('@app/views/layouts/base.php') ?>
<div class="layout-left-sidenav container">
	<?= $this->blocks['sidebar-top'] ?? '' ?>
	
	<div class="row">
		<?php if (isset($this->blocks['sidebar'])): ?>
			<div class="col-lg-3">
				<?= $this->blocks['sidebar'] ?>
			</div>
		<?php elseif (isset($sideNavItems)): ?>
			<div class="col-lg-3">
				<div class="list-group list-group-border-0 mb-5">
					<?php foreach ($sideNavItems as $item): ?>
						<?php if (!isset($item['visible']) || $item['visible']): ?>
							<a href="<?= Url::to($item['url']) ?>" class="list-group-item <?= \Yii::$app->menu->isItemActive($item, $this->context->route) ? 'active' : '' ?>">
								<span><i class="icon-home"></i> <?= $item['label'] ?></span>
							</a>
						<?php endif ?>
					<?php endforeach ?>
				</div>
			</div>
		<?php endif ?>
		<div class="<?= isset($sideNavItems) ? 'col-lg-9' : 'col-lg-12' ?>">
			<?php if (isset($this->blocks['content-header'])): ?>
				<?= $this->blocks['content-header'] ?>
			<?php elseif (isset($this->params['title'])): ?>
				<h1 class="page-heading"><?= \yii\helpers\Html::encode($this->params['title']) ?></h1>
			<?php endif ?>
			
			<?= \ant\widgets\Alert::widget() ?>
			
			<?= $content ?>
		</div>
	</div>
</div>
<?php $this->endContent() ?>