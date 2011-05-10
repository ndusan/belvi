<script type="text/javascript" src="<?php echo JS_PATH.'tiny_mce'.DS.'tiny_mce.js'?>"></script>
<script type="text/javascript">
   	tinyMCE.init({
    	mode : "textareas",
    	theme : "advanced",
    	editor_selector : "mceAdvanced",
    	plugins : "fullscreen",
    	// Theme options
    	theme_advanced_buttons3 : "fullscreen"
    });
</script>
<table cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th colspan="2">Unesite osnovne podatke o aranžmanu</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Naziv aranžmana: (*)</td>
            <td><input class="inputSmall r" type="text" name="name" value="<?php echo $acc['name']; ?>" /></td>
        </tr>
        <tr>
            <td>Dodatno o aranžmanu: </td>
            <td><input class="inputSmall" type="text" name="add" value="<?php echo $acc['add']; ?>" /></td>
        </tr>
        <tr>
            <td>Tip aranžmana: (*)</td>
            <td>
            	<select name="accomodation_type" class="bigInput" >
					<?php if(isset($accomodation_types) && !empty($accomodation_types)):?>
					<?php foreach($accomodation_types as $at):?>
            		<option value="<?php echo $at['id']; ?>"><?php echo $at['name']; ?></option>
            		<?php endforeach; ?>
            		<?php endif;?>
            	</select>
            </td>
        </tr>
        <tr>
            <td>Tip smeštaja: (*)</td>
            <td>
            	<select name="type" class="bigInput" >
	            	<?php if(isset($types) && !empty($types)):?>
					<?php foreach($types as $t):?>
	            	<option value="<?php echo $t['id']; ?>"><?php echo $t['name']; ?></option>
	            	<?php endforeach; ?>
	            	<?php endif;?>
            	</select>
            </td>
        </tr>
        <tr>
            <td>Opis tipa smeštaja:</td>
            <td><input class="inputSmall" type="text" name="type_desc" value="<?php echo $acc['type_desc']; ?>" /></td>
        </tr>
        <tr>
            <td>Opis:</td>
            <td>
				<textarea rows="" cols="" class="mceAdvanced" name="desc"><?php echo $acc['desc']; ?></textarea>
			</td>
        </tr>
        <tr>
            <td>Uslovi:</td>
            <td>
				<textarea rows="" cols="" class="mceAdvanced" name="conditions"><?php echo $acc['conditions']; ?></textarea>
			</td>
        </tr>
        <tr>
            <td>Mapa:</td>
            <td>
				<textarea rows="" cols="" class="bigInput" name="map"><?php echo $acc['map']; ?></textarea>
			</td>
        </tr>
        <tr>
            <td>Vremenska prognoza(kod za mesto):</td>
            <td><input class="inputSmall" type="text" name="code" value="<?php echo $acc['code']; ?>" /></td>
        </tr>
    </tbody>
</table>
<br/>
<div style="clear: both; "></div>
<br/>
<table cellpadding="0" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th colspan="5">Slike za izabrani aranžman</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($acc['additional']) && !empty($acc['additional'])): ?>
		<?php foreach($acc['additional'] as $a):?>
	    <tr>
	    	<td>
	    		<?php echo $a['name']; ?> 
	    		[<a target="_blank" href="<?php echo FILE_PATH.'accomodation'.DS.'resized'.DS.$acc['id'].'-'.$a['id'].'-'.$a['image']; ?>" ><?php echo $a['image']; ?></a>]
	    	</td>
	    	<td>
	    		<a href="<?php echo BASE_PATH.'cms'.DS.'winter'.DS.$params['id'].DS.'delete-image'.DS.'?img_id='.$a['id'].'&step=first'; ?>" class="j_icon j_del" rel="<?php echo $a['image']; ?>" title="Brisanje slike"><!-- delete --></a>
	    	</td>
		</tr>
		<?php endforeach; ?>
		<?php endif;?>
		<tr>
			<td colspan="5">
				<a href="javascript:;" id="add">dodaj sliku</a>
			</td>
		</tr>
	</tbody>
	<tfoot>
        <tr>
        	<td colspan="5">
				<input type="hidden" name="count" id="count" value="0" />
				<input type="hidden" name="action" value="<?php echo $params['action']; ?>" />
				<button type="submit" name="button">Sačuvaj i idi dalje</button>
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
								"<input type='file' name='file-" + id + "' value='' />" +
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
			$.post('<?php echo BASE_PATH.'cms'.DS.'winter'.DS.'delete-image'.DS; ?>',
					{id: realId},
					function(data){
						if(data) $("#type-" + id).remove();
					}			
			);
		}else $("#type-" + id).remove();
	}
</script>