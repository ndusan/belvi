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
            <th colspan="2"><?php echo (isset($params['id']) && !empty($params['id']) ? "Izmenite podatke i kliknite na dugme 'Sačuvaj izmene'" : "Unesite podatke za novi automobil i kliknite na dugme 'Dodaj automobil'"); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Marka automobila: (*)</td>
            <td><input class="inputSmall r" type="text" name="type" value="<?php echo @$car[0]['type']; ?>" /> <span class="j_icon j_note_right" title="Unesi marku automobila"></span></td>
        </tr>
        <tr>
        	<td>Slika automobila:<br />
        	</td>
			<td>
				<input type="file" name="file" class="inputSmall" value=""/>
				<?php if(isset($car[0]['image']) && !empty($car[0]['image'])):?>
				[ <a target="_blank" href="<?php echo FILE_PATH.'rent_a_car'.DS.'resized'.DS.$car[0]['id'].'-'.$car[0]['image']; ?>" ><?php echo $car[0]['image']; ?></a>]
				<a href="<?php echo BASE_PATH.'cms'.DS.'rent_a_car'.DS.$car[0]['id'].DS.'delete-image'.DS; ?>" class="j_icon j_del" rel="<?php echo $car[0]['image']; ?>" title="Brisanje slike"><!-- delete --></a>
				<?php endif; ?> <span class="j_icon j_note_right" title="Dimenzije slike moraju biti Š:300px V:219px"></span>
			</td>        	
        </tr>
        <tr>
            <td>Generalne karakteristike:</td>
            <td>
            	<textarea class="r mceAdvanced" rows="" cols="" name="desc"><?php echo @$car[0]['desc']; ?></textarea> <span class="j_icon j_note_right" title="Osnovne karakteristike vozila"></span>
        </tr>
    </tbody>
</table>
<br/>
<div style="clear:both;"></div>
<br/>
<table>
	<thead>
		<tr>
			<th colspan="5">Dodavanje cena za izabrani automobil </th>
		</tr>
	</thead>
	<tbody>
		<?php $count = 0; ?>
		<?php if(isset($car[0]['additional']) && !empty($car[0]['additional'])): ?>
		<?php foreach($car[0]['additional'] as $a):?>
		<?php $count++; ?>
	    <tr id="car-<?php echo $count;?>">
	    	<td>Cena: (*)</td>
	    	<td><input type='text' name='price[]' value='<?php echo $a['price']; ?>' class='r' /></td>
	        <td>Period: (*)</td>
	        <td><input type='text' name='period[]' value='<?php echo $a['period']; ?>' class='r' /></td> 			
	    	<td><a href='javascript:;' onClick='javascript:deleteRow("<?php echo $count; ?>");'>obriši</a></td>
		<?php endforeach; ?>
		</tr>
		<?php endif;?>
		<tr>
			<td colspan="5">
				<a href="javascript:;" id="add">dodaj cenu</a> <span class="j_icon j_note_right" title="Od najviše ka najnižoj"></span>
			</td>
		</tr>
	</tbody>
	<tfoot>
        <tr>
        	<td colspan="5">
				<input type="hidden" id="count" value="<?php echo $count;?>" />
				<button type="submit" name="button"><?php echo (isset($params['id']) && !empty($params['id']) ? "Sačuvaj izmene" : "Dodaj automobil"); ?></button>
			</td>
        </tr>
    </tfoot>
</table>
<script type="text/javascript" >
	$(document).ready(function(){

		$("#add").click(function(){
			var id = $("#count").val();
			id = parseInt(id) + 1;
			var html = "<tr id='car-" + id + "'>" +
							"<td>Cena: (*)</td>" + 
							"<td><input type='text' name='price[]' value='' class='r' /></td>" +
							"<td>Period: (*)</td>" + 
							"<td><input type='text' name='period[]' value='' class='r' /></td>" +
							"<td><a href='javascript:;' onClick='javascript:deleteRow(\"" + id + "\");'>obriši</a></td>" + 
					   "</tr>";
			$(this).parent().parent().before(html);
			$("#count").val(id);
		});

		$('.j_icon').each(function(){
	        $(this).colorTip({color:'red'});
        });
	});

	function deleteRow(id){

		$("#car-" + id).remove();
	}
</script>