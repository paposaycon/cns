<?php require_once Config::get('mlm_config.get_header'); ?>

<!-- DATABASE INITIAL SETUP -->
<?php if (isset($db_result)): ?>
<h1><?= $db_result ?></h1>
<?php endif ?>
<!-- DATABASE INITIAL SETUP END -->

<?php if (Auth::check()) { 
	echo View::make('modules.codesgenerator')->render();
}
else { ?>

	<h3>Welcome! <small>Hit "Login" to start.</small></h3>

<?php } ?>



<?php require_once Config::get('mlm_config.get_footer'); ?>