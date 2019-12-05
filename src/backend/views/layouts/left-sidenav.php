<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;
use kartik\sidenav\SideNav;

$theme = $this->theme;
$this->params['sideNav'] = isset($this->params['sidenav']) ? $this->params['sidenav'] : $this->params['sideNav'];
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="layout-left-sidenav">
	<div class="row">
		<div class="col-lg-2">
        <?php  
        echo SideNav::widget([
            'type' => SideNav::TYPE_DEFAULT,
            'heading' => isset($this->params['sideNav']['heading']) ? $this->params['sideNav']['heading'] : null,
            'items' => isset($this->params['sideNav']['items']) ? $this->params['sideNav']['items'] : [],
            'containerOptions' => ['class' => 'side-nav']
        ]);
        ?>
        </div>

		<div class="col-lg-10">
			
			<?= $content ?>
		</div>
	</div>
</div>
<?php $this->endContent(); ?>