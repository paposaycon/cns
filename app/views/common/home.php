<?php echo View::make('common.header')->render(); ?>

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



<?php echo View::make('common.footer')->render(); ?>