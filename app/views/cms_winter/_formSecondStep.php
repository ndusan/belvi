<table cellpadding="0" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th colspan="4">Vrste usluga i ostale informacije</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="width: 30%;">Vrsta usluge</td>
			<td style="width: 30%;">Maks.broj osoba</td>
			<td style="width: 30%;">Broj osoba koje plaćaju deo</td>
			<td style="width: 10%;">Akcija</td>
		</tr>
		<?php if(isset($output) && !empty($output)): ?>
		<?php foreach($output as $o):?>
	    <tr>
	    	<td>
	    		<?php echo $o['service']; ?> 
	    	</td>
	    	<td>
	    		<?php echo $o['max_num']; ?>
	    	</td>
	    	<td>
	    		<?php echo $o['num']; ?>
	    	</td>
	    	<td>
	    		<a href="<?php echo BASE_PATH.'cms'.DS.'winter'.DS.$o['id'].DS.'delete-service'.DS.'?id='.$params['id'].'&step=second'; ?>" class="j_icon j_del" rel="<?php echo $o['service']; ?>" title="Brisanje vrste usluge"><!-- delete --></a>
	    	</td>
		</tr>
		<?php endforeach; ?>
		<?php endif;?>
		<tr>
			<td colspan="4">
				<a href="javascript:;" id="add">dodaj vrstu usluge</a>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4"> 
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
								"<input type='text' name='acc[]' value='' class='r bigInput'/>" +
							"</td>" +
							"<td>" +
								"<input type='text' name='max_num[]' value='1' class='r smallInput' />" +
							"</td>" +
							"<td>" +
								"<input type='text' name='num[]' value='0' class='r smallInput' />" +
							"</td>" +
							"<td><a href='javascript:;' onClick='javascript:deleteRow(\"" + id + "\", 0);'>obriši</a></td>" + 
					   "</tr>";
			$(this).parent().parent().before(html);
			$("#count").val(id);
		});

		$('.j_icon').each(function(){
	        $(this).colorTip({color:'red'});
        });
	});

	function deleteRow(id, realId){
		if(realId > 0){
			$.post('<?php echo BASE_PATH.'cms'.DS.'accomodation'.DS.$params['action'].DS.'delete-acc'.DS; ?>',
					{id: realId},
					function(data){
						if(data) $("#type-" + id).remove();
					}			
			);
		}else $("#type-" + id).remove();
	}
</script>