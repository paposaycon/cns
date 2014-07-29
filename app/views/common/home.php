<?= View::make('common.header', array('page_title' => $page_title))->render(); ?>

<!-- DATABASE INITIAL SETUP -->
<?php if (isset($db_result)): ?>
<h1><?= $db_result ?></h1>
<?php endif ?>
<!-- DATABASE INITIAL SETUP END -->

<?php 
if (Auth::check()) 
{ 
	if($membertype == 'superuser')
	{
		echo View::make('account.superuser')->render();
	}
	elseif ($membertype == 'admin') 
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

<?= View::make('common.footer')->render(); ?>