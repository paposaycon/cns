<?php for ($i=1; $i < 16; $i++) { 
	echo '<span id="modal-lvl' . $i . '"></span>';
}
?>
<table class="unilevel table table-bordered">
	<thead>
		<tr>
			<td><b>Level</b></td>
			<td><b>Member Count</b></td>
			<td><b>PV</b></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="level">1</td>
			<td class="count"> <button class="btn btn-sm btn-danger show-member lvl1">0</td>
			<td class="pv">0</td>
		</tr>
	</tbody>
</table>

<script>
	$(document).ready(function () {

		function makeLevel(level, count, data, pv){
			$('#modal-lvl' + level).html(makeModal(level,data));
			return '<tr><td>' + level + '</td><td><button class="btn btn-sm btn-danger show-member lvl1" data-toggle="modal" data-target="#memberlist' + level + '">' + count + '</button></td><td class="pv">' + pv + '</td></tr>';
		}

		function makeModal(level, data){
			var $output = '';
			$output += '<div class="modal fade" id="memberlist' + level + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
			$output += '<div class="modal-dialog">';
			$output += '<div class="modal-content">';
			$output += '<div class="modal-header">';
			$output += '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
			$output += '<h4 class="modal-title" id="myModalLabel">Members for this level</h4>';
			$output += '</div>';
			$output += '<div class="modal-body">';
			$output += '<table class="table table-hover" id="memberlist-table">';
			$output += '<thead>';
			$output += '<tr>';
			$output += '<td><b>ID</b></td>';
			$output += '<td><b>Name</b></td>';
			$output += '</tr>';
			$output += '</thead>';
			$output += '<tbody>' + data;
			$output += '</tbody>';
			$output += '</table>';
			$output += '</div>';
			$output += '<div class="modal-footer">';
			$output += '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
			$output += '</div>';
			$output += '</div>';
			$output += '</div>';
			$output += '</div>';

			return $output;
		}

		$.ajax({
			url:"<?= route('getdownline') ?>",
			type: 'POST',
			success:function(result){
				
				var data = JSON.parse(result);
				var htmldata = '';

				<?php for ($i=1; $i < 16; $i++) { ?>
				var itemcount<?= $i ?> = 0;
				var memberlistdata<?= $i ?> = '';
				var pv<?= $i ?> = 0;

				if(data.hasOwnProperty('lvl<?= $i ?>')){
					$.each(data.lvl<?= $i ?>, function(i, item) {
						itemcount<?= $i ?> = itemcount<?= $i ?> + 1;
						memberlistdata<?= $i ?> += '<tr><td><?= Config::get("mlm_config.id_prefix") ?>' + item.id + '</td><td>' + item.name + '</td></tr>';
						pv<?= $i ?> = item.pointvalue;
					});
				}

				// The unilevel table is stacked and is rendered here using the makeLevel() function
				htmldata += makeLevel(<?= $i ?>,itemcount<?= $i ?>,memberlistdata<?= $i ?>,pv<?= $i ?>);
				<?php } ?>

				
				$('.unilevel tbody').html(htmldata);
			}
		});

	});
</script>