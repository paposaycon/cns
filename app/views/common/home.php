<?php require_once Config::get('mlm_config.get_header'); ?>

<!-- DATABASE INITIAL SETUP -->
<?php if (isset($db_result)): ?>
<h1><?= $db_result ?></h1>
<?php endif ?>
<!-- DATABASE INITIAL SETUP END -->

<?php 
if (Auth::check()) 
{ 
	if ($membertype == 'admin' || $membertype == 'superuser') 
	{
		echo View::make('account.admin')->render();
	}
	else
	{
		echo View::make('account.member')->render();
	}
}
else 
{
	echo View::make('account.guest')->render();
} 
?>



<?php require_once Config::get('mlm_config.get_footer'); ?>