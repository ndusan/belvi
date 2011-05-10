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
            <td>
            	<input class="inputSmall r" type="text" name="name" value="<?php echo $acc['name']; ?>" /> 
            	<span class="j_icon j_note_right" title="Unesi tačan naziv hotela ili apartmana "></span>
            </td>
        </tr>
        <tr>
            <td>Dodatno o aranžmanu: </td>
            <td>
            	<input class="inputSmall" type="text" name="add" value="<?php echo $acc['add']; ?>" /> 
            	<span class="j_icon j_note_right" title="O smeštaju"></span>
            </td>
        </tr>
        <tr>
            <td>Kategorija aranžmana: </td>
            <td>
            	<input class="inputSmall" type="text" name="cat" value="<?php echo $acc['cat']; ?>" /> 
            	<span class="j_icon j_note_right" title="Kategorija smeštaja (na primer 5*)"></span>
            </td>
        </tr>
        <tr>
            <td>Tip aranžmana: (*)</td>
            <td>
            	<select name="accomodation_type" class="bigInput" >
					<?php if(isset($accomodation_types) && !empty($accomodation_types)):?>
					<?php foreach($accomodation_types as $at):?>
					<?php 
							if($at['id'] == $acc['accomodation_type_id']) $sel ="selected='selected'"; 
							else $sel = "";
					?>
            		<option <?php echo $sel;?> value="<?php echo $at['id']; ?>"><?php echo $at['name']; ?></option>
            		<?php endforeach; ?>
            		<?php endif;?>
            	</select> 
            	<span class="j_icon j_note_right" title="Povežite aranžman sa tipom aranžmana kome pripada"></span>
            </td>
        </tr>
        <tr>
            <td>Tip smeštaja: (*)</td>
            <td>
            	<select name="type" class="bigInput" >
	            	<?php if(isset($types) && !empty($types)):?>
					<?php foreach($types as $t):?>
					<?php if($t['id'] == $acc['type_id']) $sel = "selected='selected'";
						  else $sel = "";
					?>
	            	<option <?php echo $sel; ?> value="<?php echo $t['id']; ?>"><?php echo $t['name']; ?></option>
	            	<?php endforeach; ?>
	            	<?php endif;?>
            	</select> 
            	<span class="j_icon j_note_right" title="Odaberite tip smeštaja"></span>
            </td>
        </tr>
        <tr>
            <td>Tooltip:</td>
            <td>
            	<input class="inputSmall" type="text" name="type_desc" value="<?php echo $acc['type_desc']; ?>" /> 
            	<span class="j_icon j_note_right" title="Tekst koji se pojavljuje u tooltip-u"></span>
            </td>
        </tr>
        <tr>
            <td>Program putovanja i uslovi:</td>
            <td>
				<textarea rows="" cols="" class="mceAdvanced" name="desc"><?php echo $acc['desc']; ?></textarea> 
				<span class="j_icon j_note_right" title="Upisati program putovanja i uslove"></span>
			</td>
        </tr>
        <tr>
            <td>Opis:</td>
            <td>
				<textarea rows="" cols="" class="mceAdvanced" name="conditions"><?php echo $acc['conditions']; ?></textarea> 
				<span class="j_icon j_note_right" title="Opis tipa aranzmana"></span>
			</td>
        </tr>
        <tr>
            <td>Mapa:</td>
            <td>
				<textarea rows="" cols="" class="bigInput" name="map"><?php echo $acc['map']; ?></textarea> 
				<span class="j_icon j_note_right" title="Potrebno je uneti link sa mapom za odabrani smeštaj. Veličina mape mora biti V: Š:"></span>
			</td>
        </tr>
        <tr>
            <td>Vremenska prognoza(kod za mesto):</td>
            <td>
            <input class="inputSmall" type="text" name="code" value="<?php echo $acc['code']; ?>" />
            <span class="j_icon j_note_right" title="Uneti KOD za mesto"></span>
            </td>
        </tr>
	<tr>
            <td>Description:</td>
            <td>
				<textarea rows="" cols="" name="web_desc"><?php echo $acc['web_desc']; ?></textarea> 
				<span class="j_icon j_note_right" title="Opis stranice (ovo je bitno zbog pretrage). Ukoliko prazno, podrazumevani opis će biti unet."></span>
			</td>
        </tr>
        <tr>
            <td>Keywords:</td>
            <td>
				<textarea rows="" cols="" name="web_keywords"><?php echo $acc['web_keywords']; ?></textarea> 
				<span class="j_icon j_note_right" title="Kljucne reči (ovo je bitno zbog pretrage). Ukoliko prazno, podrazumevane reči će biti unete."></span>
			</td>
        </tr>
    </tbody>
</table>
<br/>
<div style="clear: both; "></div>
<br/>
<table cellpadding="0" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th colspan="5">
				Slike za izabrani aranžman 
				<span class="j_icon j_note_right" title="Dimenzije V:150px Š:205px"></span>
			</th>
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
	    		<a href="<?php echo BASE_PATH.'cms'.DS.'accomodation'.DS.$params['id'].DS.'delete-image'.DS.'?img_id='.$a['id'].'&step=first'; ?>" class="j_icon j_del" rel="<?php echo $a['image']; ?>" title="Brisanje slike"><!-- delete --></a>
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
			$.post('<?php echo BASE_PATH.'cms'.DS.'accomodation'.DS.'delete-image'.DS; ?>',
					{id: realId},
					function(data){
						if(data) $("#type-" + id).remove();
					}			
			);
		}else $("#type-" + id).remove();
	}
</script>
