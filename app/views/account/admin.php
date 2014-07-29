<h2><b><?= Auth::user()->firstname ?> <?= Auth::user()->middlename?> <?= Auth::user()->lastname ?> <small>ID: <?= Config::get("mlm_config.id_prefix")?><?= Auth::user()->id ?></small></b></h2>

<hr>

<div class="row">
<?= View::make('account.dashboard')->render(); ?>
<?= View::make('common.sidebar-right')->render(); ?>
</div>



