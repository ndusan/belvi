<table cellpadding="0" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th colspan="3">Datumi polazaka i broj noćenja</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="width: 40%;">Datum polaska</td>
			<td style="width: 30%;">Broj noćenja</td>
			<td style="width: 30%;">Akcija</td>
		</tr>
		<?php if(isset($output) && !empty($output)): ?>
		<?php foreach($output as $o):?>
	    <tr>
	    	<td>
	    		<?php echo $o['date']; ?> 
	    	</td>
	    	<td>
	    		<?php echo $o['nights']; ?>
	    	</td>
	    	<td>
	    		<a href="<?php echo BASE_PATH.'cms'.DS.'accomodation_type'.DS.$o['id'].DS.'delete-date'.DS.'?id='.$params['id'].'&step=second'; ?>" class="j_icon j_del" rel="<?php echo $o['date']; ?>" title="Brisanje datuma"><!-- delete --></a>
	    	</td>
		</tr>
		<?php endforeach; ?>
		<?php endif;?>
		<tr>
			<td colspan="5">
				<a href="javascript:;" id="add">dodaj datum</a>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3"> 
				<button type="submit" name="button">Sačuvaj i idi dalje</button>
				<input type="hidden" name="action" value="<?php echo $params['action']; ?>" />
				<input type="hidden" name="count" id="count" value="0" />
				<input type="hidden" name="step" value="second" />
			</td>
		</tr>
	</tfoot>
</table>
<script type="text/javascript" >
	$(document).ready(function(){

		$("#add").click(function(){
			var id = $("#count").val();
			id = parseInt(id) + 1;
			var html = "<tr id='type-" + id + "'>" +
							"<td>" + 
								"<input type='text' name='date[]' value='' class='datepicker r mediumInput'/>" +
							"</td>" +
							"<td>" +
								"<input type='text' name='nights[]' value='' class='r smallInput' />" +
							"</td>" +
							"<td><a href='javascript:;' onClick='javascript:deleteRow(\"" + id + "\", 0);'>obriši</a></td>" + 
					   "</tr>";
			$(this).parent().parent().before(html);
			$('.datepicker').datepicker();
			$("#count").val(id);
		});

		$('.j_icon').each(function(){
	        $(this).colorTip({color:'red'});
        });
	});

	function deleteRow(id, realId){
		if(realId > 0){
			$.post('<?php echo BASE_PATH.'cms'.DS.'accomodation_type'.DS.$params['action'].DS.'delete-date'.DS; ?>',
					{id: realId},
					function(data){
						if(data) $("#type-" + id).remove();
					}			
			);
		}else $("#type-" + id).remove();
	}
</script>