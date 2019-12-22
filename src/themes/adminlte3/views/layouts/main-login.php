<?php
use yii\helpers\Html;

//$appBundle = \backend\assets\AppAsset::register($this);
//$adminLteBundle = \backend\themes\adminlte\assets\AdminLtePluginAsset::register($this);
$themeBundle = \ant\themes\adminlte3\assets\ThemeAsset::register($this);

?>
<?php $this->beginContent('@app/views/layouts/_clear.php', ['body' => ['class' => ['login-page']]]);?>
	<?= $content ?>
<?php $this->endContent(); ?>
