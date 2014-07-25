<h2><b><?= Auth::user()->firstname ?> <?= Auth::user()->middlename?> <?= Auth::user()->lastname ?> <small>ID: <?= Config::get("mlm_config.id_prefix")?><?= Auth::user()->id ?></small></b></h2>

<section id="activation-codes" class="col-md-6 col-sm-6">
<?php	
	echo View::make('modules.codesgenerator')->render();
?>
</section>

<section class="col-md-6 col-sm-6">
<?php	
	echo View::make('modules.navigation')->render();
?>
</section>

<section class="col-md-6 col-sm-6">
<?php	
	echo View::make('modules.membertree')->render();
?>
</section>