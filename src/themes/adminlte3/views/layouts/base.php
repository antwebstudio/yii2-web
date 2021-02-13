<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use ant\language\widgets\LanguageDetector;

//$appBundle = \backend\assets\AppAsset::register($this);
//$adminLtePluginBundle = \backend\themes\adminlte\assets\AdminLtePluginAsset::register($this);
//$themeBundle = \backend\themes\adminlte\assets\ThemeAsset::register($this);

//$this->theme->setBaseUrl($themeBundle->baseUrl);
//$this->theme->setBasePath($themeBundle->basePath);

$this->theme->registerAsset($this);

$renderParams =
[
    'themeBaseURL' => $this->theme->baseUrl,
    'adminlteBaseUrl' => Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist'),
	'new' => true,
];
?>
<?php $this->beginContent('@app/views/layouts/_clear.php', ['body' => ['class' => 'hold-transition skin-black sidebar-mini layout-fixed']]) ?>
	
	<?= LanguageDetector::widget() ?>
	
	<div class="wrapper">

		<?= $this->render('parts/_nav-bar.php', $renderParams); ?>

		<?= $this->render('parts/_main-sidebar.php', $renderParams); ?>

		<?= $this->render('parts/_content.php', ArrayHelper::merge(['content' => $content], $renderParams)); ?>

		<footer class="main-footer">
			<strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
			All rights reserved.
			<div class="float-right d-none d-sm-inline-block">
				<b>Version</b> 3.0.1
			</div>
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>

<?php $this->endContent() ?>
