<?php
use yii\helpers\Url;

$autohide = true;
?>
<style>
.fixed-bottom, .fixed-bottom a.link { height: 40px;  }
.fixed-bottom.hide { bottom: -40px; }

<?php if (!$autohide): ?>
	body { margin-bottom: 40px; }
<?php endif ?>

.fixed-bottom { border-top: 1px #eeeeee solid; }
.fixed-bottom { transition: bottom 0.2s ease-in-out; position: fixed; bottom: 0; width: 100%; background-color: #cccccc; }
.fixed-bottom a.link { width: 100%; text-align: center; display: inline-block; align-items: center; display: flex; justify-content: center;  }
.bg-facebook { background-color: #3b5998; color: white; }
.bg-instagram { background-color: #E1306C; color: white; }
.bg-share { background-color: #343434; color: white; }
</style>

<?php if ($autohide): ?>
	<?php \ant\widgets\JsBlock::begin() ?>
	<script>
	var lastScrollTop = 0;
	$(window).scroll(function(event){
	   var st = $(this).scrollTop();
	   if (st > lastScrollTop){
		   // downscroll code
		   console.log('down'); $('.fixed-bottom').addClass('hide')
	   } else {
		  // upscroll code
		  console.log('up'); $('.fixed-bottom').removeClass('hide')
	   }
	   lastScrollTop = st;
	});
	</script>
	<?php \ant\widgets\JsBlock::end() ?>
<?php endif ?>

<div class="fixed-bottom d-md-none">
	<div class="row no-gutters">
		<?= $this->context->renderButtons() ?>	
		<a class="class3 link col-9 bg-share" href="<?= 'https://www.facebook.com/sharer/sharer.php?u='.Url::current([], true) ?>">分享</a>	
	</div>	
</div>