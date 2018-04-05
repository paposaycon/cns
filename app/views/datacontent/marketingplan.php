<?= View::make('common.header', array('page_title' => $page_title))->render(); ?>





<section class="bg3">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-example-generic" data-slide-to="1"></li>
		<li data-target="#carousel-example-generic" data-slide-to="2"></li>
		<li data-target="#carousel-example-generic" data-slide-to="3"></li>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<div class="item active">
			<div class="container" style="text-align: center;">
				<img src="<?= asset('assets/imgs/marketing_plan/pp1.png') ?>" alt="...">
			</div>
		</div>
		<div class="item">
			<div class="container" style="text-align: center;">
				<img src="<?= asset('assets/imgs/marketing_plan/pp2.png') ?>" alt="...">
			</div>
		</div>
		<div class="item">
			<div class="container" style="text-align: center;">
				<img src="<?= asset('assets/imgs/marketing_plan/pp3.png') ?>" alt="...">
			</div>
		</div>
		<div class="item">
			<div class="container" style="text-align: center;">
				<img src="<?= asset('assets/imgs/marketing_plan/pp4.png') ?>" alt="...">
			</div>
		</div>
		<div class="item">
			<div class="container" style="text-align: center;">
				<img src="<?= asset('assets/imgs/marketing_plan/pp5.png') ?>" alt="...">
			</div>
		</div>
		<div class="item">
			<div class="container" style="text-align: center;">
				<img src="<?= asset('assets/imgs/marketing_plan/pp6.png') ?>" alt="...">
			</div>
		</div>
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
	</a>
</div>
</section>


<script>
	$(document).ready(function () {
		$('#carousel-example-generic').carousel({
		  interval: 120000
		})
	});
</script>


<?= View::make('common.footer')->render(); ?>