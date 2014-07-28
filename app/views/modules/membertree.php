<?php for ($i=1; $i < 16; $i++) { 
	echo '<span id="modal-lvl' . $i . '"></span>';
}
?>
<table class="unilevel table table-bordered">
	<thead>
		<tr>
			<td>Level</td>
			<td>Member Count</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="level">1</td>
			<td class="count"> <button class="btn btn-sm btn-danger show-member lvl1">0</td>
		</tr>
	</tbody>
</table>

<script>
	$(document).ready(function () {
		function makeLevel(level, count, data){
			$('#modal-lvl' + level).html(makeModal(level,data));
			return '<tr><td>' + level + '</td><td><button class="btn btn-sm btn-danger show-member lvl1" data-toggle="modal" data-target="#memberlist' + level + '">' + count + '</button></td></tr>';
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
				var htmldata = '', 
					memberlistdata = '', 
					memberlistdata2 ='',
					memberlistdata3 ='',
					memberlistdata4 ='',
					memberlistdata5 ='';
				var itemcount = 0,
					itemcount2 = 0,
					itemcount3 = 0,
					itemcount4 = 0,
					itemcount5 = 0;

				if(data.hasOwnProperty('lvl1')){
					$.each(data.lvl1, function(i, item) {
						itemcount = itemcount + 1;
						memberlistdata += '<tr><td>' + item.id + '</td><td>' + item.name + '</td></tr>';
						
					});
				}
				if(data.hasOwnProperty('lvl2')){
					$.each(data.lvl2, function(i, item) {
						itemcount2 = itemcount2 + 1;
						memberlistdata2 += '<tr><td>' + item.id + '</td><td>' + item.name + '</td></tr>';
						
					});
				}
				if(data.hasOwnProperty('lvl3')){
					$.each(data.lvl3, function(i, item) {
						itemcount3 = itemcount3 + 1;
						memberlistdata3 += '<tr><td>' + item.id + '</td><td>' + item.name + '</td></tr>';
						
					});
				}
				if(data.hasOwnProperty('lvl4')){
					$.each(data.lvl4, function(i, item) {
						itemcount4 = itemcount4 + 1;
						memberlistdata4 += '<tr><td>' + item.id + '</td><td>' + item.name + '</td></tr>';
						
					});
				}
				if(data.hasOwnProperty('lvl5')){
					$.each(data.lvl5, function(i, item) {
						itemcount5 = itemcount5 + 1;
						memberlistdata5 += '<tr><td>' + item.id + '</td><td>' + item.name + '</td></tr>';
						
					});
				}

				// The unilevel table is stacked here
				htmldata = makeLevel(1,itemcount,memberlistdata) + makeLevel(2,itemcount2,memberlistdata2) + makeLevel(3,itemcount3,memberlistdata3) + makeLevel(4,itemcount4,memberlistdata4) + makeLevel(5,itemcount5,memberlistdata5);
				$('.unilevel tbody').html(htmldata);
			}
		});
	});
</script>