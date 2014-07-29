<ul class="nav nav-pills nav-stacked">
	<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="btn btn-sm btn-danger btn-codes-allocation" data-toggle="collapse" data-parent="#accordion" href="#codes-allocation" style="color: #fff !important;">
          <span class="glyphicon glyphicon-pencil"></span> Codes Allocation
        </a> 
        <a data-toggle="collapse" data-parent="#accordion" href="#codes-allocation" class="pull-right btn-codes-allocation"><span class="glyphicon glyphicon-chevron-down" style="padding-top: 10px;"></span></a>
      </h4>
    </div>
    <div id="codes-allocation" class="panel-collapse collapse">
      <div class="panel-body">
      	<div class="form-group">
      		<label for="code-reciever-id">User ID</label>
		    <select class="form-control" name="code-reciever-id" id="code-reciever-id">
		    	<option value=":)">:)</option>
		    </select>
      	</div>
        <div class="form-group">
        	<label for="code-allocation-count">Number of Codes</label>
	        <input class="form-control" type="number" id="code-allocation-count" placeholder="Input numbers only">
        </div>
		<div id="code-allocation-alert" class="alert alert-success" role="alert" style="display:none;"></div>
        <button class="btn btn-primary btn-sm pull-right" id="submit-code-allocation">Submit</button>
		
		<br>
        <hr style="clear:both;">

        <h4><b>Recent Allocations</b></h4>
		<table id="recent-allocations" class="table .table-hover">
			<thead>
				<tr>
					<td>To</td>
					<td>Count</td>
					<td>From</td>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="btn btn-sm btn-danger" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="color: #fff !important;">
          <span class="glyphicon glyphicon-sort-by-attributes"></span> Sales Entry
        </a>
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="pull-right"><span class="glyphicon glyphicon-chevron-down" style="padding-top: 10px;"></span></a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        <?php	
			
		?>
      </div>
    </div>
  </div>
</div>
</ul>

<!-- FETCH IDs for code allocation -->
<script>
	$(document).ready(function () {

		$('.btn-codes-allocation').click(function () {
			getUsers('#code-reciever-id');
			getRecentAllocations();
		});

		function getUsers(insert) {
			$.ajax({
				url:"<?= action('AccountController@getUsers') ?>",
				type: 'POST',
				data: {

				},
				success:function(result){
					var data = JSON.parse(result);
					var htmldata;
					$.each(data, function(i, item) {
						htmldata += '<option value="' + item.id + '">' + item.name + ' - ID: <?= Config::get("mlm_config.id_prefix"); ?>' + item.id + '</option>';
					});
					$(insert).html(htmldata);
					$(insert).slideDown('fast');
				}

			});
		}

		// Submit code allocation 
		$('#submit-code-allocation').click(function () {
			submitCodes();
		});

		function submitCodes() {
			var id = $('#code-reciever-id').val();
			var count = $('#code-allocation-count').val();

			$.ajax({
				url:"<?= action('CodesController@allocateCodes') ?>",
				type: 'POST',
				data: {
					id: id,
					count: count,
				},
				before:function(){

				},
				success:function(result){
					$('#code-allocation-alert').html(result).fadeIn('fast').delay('5000').slideUp('slow');
					getRecentAllocations();
				}

			});
		}

		function getRecentAllocations() {
			$.ajax({
				url:"<?= action('CodesController@getAllocations') ?>",
				type: 'POST',
				data: {
				},
				before:function(){

				},
				success:function(result){
					var htmldata = '';
					var data = JSON.parse(result);
					$.each(data, function(i, item) {
						htmldata += '<tr><td><?= Config::get("mlm_config.id_prefix")?>' + item.id + '</td><td>' + item.count + '</td><td><?= Config::get("mlm_config.id_prefix")?>' + item.allocated_by + '</td></tr>';
					});

					$('#recent-allocations tbody').html(htmldata);
				}

			});
		}

	});
</script>