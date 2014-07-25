<div class="row">
	<div class="activation-codes col-md-12 col-sm-12">
		<div class="jumbotron">
			<div class="form">
				<div class="title">
					<h3><strong>Codes Generation Area</strong></h3>
				</div>
				<div class="form-group">
					<label for="formemebertype">Member Type</label>
					<select name="membertype" id="formembertype" class="form-control">
						<option value="admin">Admin</option>
						<option value="center">Center</option>
						<option value="member">Member</option>
					</select>
				</div>
				<div class="form-group">
					<label for="count">How many codes do you need?</label>
					<select class="form-control" id="count" name="count">
						<?php for ($i=1; $i < 11; $i++) { ?>
							<option value="<?= $i ?>"><?= $i ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class='generate-form-btn' style="text-align: center;">
				<button class="btn btn-lg btn-primary" id="generate-codes">Hit me!</button>
				<span class="info"></span>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="activation-codes col-md-12 col-sm-12">
		<div class="jumbotron">
			<div class="title">
				<h3><strong>Available Codes</strong></h3>
			</div>
			<table class="activation-codes table table-hover">
				<thead>
					<tr>
						<td>Member Type</td>
						<td>Code</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>


<script>

	$(document).ready(function () {
		refreshCodes();
		function refreshCodes() {
			$.ajax({
				url:"<?= action('CodesController@showCodes') ?>",
				type: 'POST',
				success:function(result){
					var htmldata;
					var data = JSON.parse(result);
					$.each(data, function(i, item) {
						htmldata += '<tr><td>' + item.membertype + '</td><td>' + item.activationcode + '</td></tr>';
					});
					$('.activation-codes tbody').html(htmldata);
				}
			});
		}

		$('#generate-codes').click(function () {

			var $membertype = $('#formembertype').val(),
				$count = $('#count').val();

			$.ajax({
				url:"<?= action('CodesController@generateCode') ?>",
				type: 'POST',
				data: {
					membertype : $membertype,
					count : $count,
				},
				beforeSend:function(){
					$('.generate-form-btn').html('<button class="btn btn-lg btn-primary"> Generating codes</button>');

				},
				success:function(result){
				    $('.form').slideUp('fast');
				    $('.generate-form-btn').html('<button class="btn btn-lg btn-primary">' + result + '</button>');
				    location.reload(true); 
				}
			});

		});
		
	});
	
</script>