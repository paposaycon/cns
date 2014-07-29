
<div class="superuser-nav">

</div>

<div class="row">
	<?= View::make('account.dashboard')->render();?>

	<aside class="col-sm-4 col-md-4">
		<?= View::make('account.superuser.navigation')->render(); ?>
	</aside>
</div>

