<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

//$appBundle = \backend\assets\AppAsset::register($this);
//$adminLtePluginBundle = \backend\themes\adminlte\assets\AdminLtePluginAsset::register($this);
//$themeBundle = \backend\themes\adminlte\assets\ThemeAsset::register($this);

//$this->theme->setBaseUrl($themeBundle->baseUrl);
//$this->theme->setBasePath($themeBundle->basePath);

$this->theme->registerAsset($this);

/*$renderParams =
[
    'themeBaseURL' => $this->theme->baseUrl,
    'adminlteBaseUrl' => Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist'),
];*/
?>

<?php $this->beginContent('@app/views/layouts/_clear.php', ['body' => ['class' => ['hold-transition',  'skin-black', 'sidebar-mini']]]) ?>

	<?= $content ?>

<?php $this->endContent(); ?>
