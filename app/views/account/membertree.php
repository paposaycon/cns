<?= View::make('common.header', array('page_title' => $page_title))->render(); ?>
<?php //var_dump($lvl[6]); ?>
<div class="row">
<section class="col-sm-12 membertree-table">
	<div class="row">
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 wide"><?= $lvl['0']['0']['0']['username'] ?></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
	</div>
	<div class="row">
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 wide"><?= $lvl['1']['0']['0']['username'] ?> | <?= $lvl['1']['0']['0']['position'] ?></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 wide"><?= $lvl['3']['0']['0']['username'] ?> | <?= $lvl['1']['0']['1']['position'] ?></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
		<div class="col-sm-1 slim"></div>
	</div>
</section>


</div>

<?= View::make('common.footer')->render(); ?>