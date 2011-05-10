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
            <th colspan="2">Unesite osnovne podatke o tipu aranžmana</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Naziv tipa aranžmana: (*) </td>
            <td>
            	<input class="inputSmall r" type="text" name="name" value="<?php echo $type['name']; ?>" /> 
            	<span class="j_icon j_note_right" title="Naziv turističke ture koju organizijete (na primer PRAG AUTOBUSOM)"></span>
            </td>
        </tr>
        <tr>
            <td>Aranžman: (*) </td>
            <td>
            	<select name="accomodation" class="bigInput" > 
            		<option value="summer" <?php echo ($type['accomodation']=='summer'?"selected='selected'":"");?>>Letovanja</option>
            		<option value="winter" <?php echo ($type['accomodation']=='winter'?"selected='selected'":"");?>>Zimovanja</option>
            		<option value="city_break" <?php echo ($type['accomodation']=='city_break'?"selected='selected'":"");?>>Evropski gradovi</option>
            		<option value="other" <?php echo ($type['accomodation']=='other'?"selected='selected'":"");?>>Ostalo</option>
            		<option value="destination" <?php echo ($type['accomodation']=='destination'?"selected='selected'":"");?>>Daleke destinacije</option>
            		<option value="wellness_and_spa" <?php echo ($type['accomodation']=='wellness_and_spa'?"selected='selected'":"");?>>Wellness and Spa</option>
            	</select> 
            	<span class="j_icon j_note_right" title="Odaberite pod kojom kategorijom je aranžman"></span>
            </td>
        </tr>
        <tr>
            <td>Opis aranžmana: (*) </td>
            <td>
            	<textarea rows="" cols="" name="desc" class="mceAdvanced r"><?php echo $type['desc']; ?></textarea>
            	<span class="j_icon j_note_right" title="Dinarski deo aranžmana, koji je vidljiv u tabeli sa cenama"></span>
            </td>
        </tr>
        <tr>
            <td>Dodatni tekst za upis uslova putovanja: </td>
            <td>
            	<textarea rows="" cols="" name="desc_bottom" class="mceAdvanced"><?php echo $type['desc_bottom']; ?></textarea>
            	<span class="j_icon j_note_right" title="Tekst na dnu tabele"></span>
            </td>
        </tr>
        <tr>
            <td>Vrsta prevoza: (*) </td>
            <td><?php ?>
            	<?php if(isset($transport) && !empty($transport)):?>
            	<?php foreach($transport as $t):?>
            	<input class="inputSmall r fl" id="transport-<?php echo $t['id']; ?>" type="checkbox" name="transport[]" value="<?php echo $t['id']; ?>" 
            	<?php echo (array_key_exists($t['id'], $type['transport']) ? "checked='checked'" : "");?> 
            	/>
				<label for="transport-<?php echo $t['id']; ?>"><?php echo $t['name']; ?></label>
            	<?php endforeach; ?>
            	<?php else:?>
            	Nije uneto u bazu
            	<?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>Destinacija: (*) </td>
            <td>
            	<select name="destination" class="inputSmall r">
            		<?php foreach($destination as $d):?>
            		<?php if($d['id'] == $type['destination_id']) $sel = "selected='selected'"; 
            			  else $sel = "";
            		?>
            		<option <?php echo $sel; ?> value="<?php echo $d['id']; ?>"><?php echo $d['name']; ?></option>
            		<?php endforeach; ?>
            	</select> 
            	<span class="j_icon j_note_right" title="Odaberite pod kojom destinacijom (zemljom ili događajem) je tip aranžmana"></span>
            </td>
        </tr>
        <tr>
            <td>Polasci: (*) </td>
            <td>
            	<input class="inputSmall r" type="text" name="start" value="<?php echo $type['start']; ?>" /> 
            	<span class="j_icon j_note_right" title="Kratak opis polazaka"></span>
            </td>
        </tr>
        <tr>
            <td>Cena od: (*) </td>
            <td>
            	<input class="inputSmall r" type="text" name="from" value="<?php echo $type['from']; ?>" /> 
            	<span class="j_icon j_note_right" title="Cene od"></span>
            </td>
        </tr>
        <tr>
            <td>Glavna slika: (*) </td>
            <td>
            	<?php if(isset($type['image']) && !empty($type['image'])):?>
            	<input class="inputSmall" type="file" name="image" value="" />
            	[ <a target="_blank" href="<?php echo FILE_PATH.'accomodation_type'.DS.'resized'.DS.$type['id'].'-'.$type['image']; ?>" ><?php echo $type['image']; ?></a>]
				<a href="<?php echo BASE_PATH.'cms'.DS.'accomodation_type'.DS.$type['id'].DS.'delete-image'.DS; ?>" class="j_icon j_del" rel="<?php echo $type['image']; ?>" title="Brisanje slike"><!-- delete --></a>
            	<?php else: ?>
				<input class="inputSmall r" type="file" name="image" value="" />
				<?php endif; ?>
				<span class="j_icon j_note_right" title="Slika mora biti dimenzija V:100px Š:227px"></span>
            </td>
        </tr>
        <tr>
            <td>Cenovnik (PDF): </td>
            <td>
            	<?php if(isset($type['pdf']) && !empty($type['pdf'])):?>
            	<input class="inputSmall" type="file" name="pdf" value="" />
            	[ <a target="_blank" href="<?php echo FILE_PATH.'accomodation_type'.DS.'original'.DS.$type['id'].'-'.$type['pdf']; ?>" ><?php echo $type['pdf']; ?></a>]
				<a href="<?php echo BASE_PATH.'cms'.DS.'accomodation_type'.DS.$type['id'].DS.'delete-file'.DS; ?>" class="j_icon j_del" rel="<?php echo $type['pdf']; ?>" title="Brisanje cenovnika"><!-- delete --></a>
            	<?php else: ?>
				<input class="inputSmall" type="file" name="pdf" value="" />
				<?php endif; ?>
				<span class="j_icon j_note_right" title="Dokument može da bude u .pdf, .doc, .xdoc formatu"></span>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; ">Program putovanja i uslovi:</td>
            <td style="vertical-align: top; ">
				<textarea rows="" cols="" name="gen_desc" class="mceAdvanced"><?php echo $type['gen_desc']; ?></textarea> <span class="j_icon j_note_right" title="Upisati program putovanja i uslove"></span>
			</td>
        </tr>
        <tr>
            <td style="vertical-align: top; ">Opis:</td>
            <td style="vertical-align: top; ">
				<textarea rows="" cols="" name="conditions" class="mceAdvanced"><?php echo $type['conditions']; ?></textarea>
				<span class="j_icon j_note_right" title="Opis tipa aranzmana"></span>
			</td>
        </tr>
	<tr>
            <td>Description:</td>
            <td>
				<textarea rows="" cols="" name="web_desc"><?php echo $type['web_desc']; ?></textarea> 
				<span class="j_icon j_note_right" title="Opis stranice (ovo je bitno zbog pretrage). Ukoliko prazno, podrazumevani opis će biti unet."></span>
			</td>
        </tr>
        <tr>
            <td>Keywords:</td>
            <td>
				<textarea rows="" cols="" name="web_keywords"><?php echo $type['web_keywords']; ?></textarea> 
				<span class="j_icon j_note_right" title="Kljucne reči (ovo je bitno zbog pretrage). Ukoliko prazno, podrazumevane reči će biti unete."></span>
			</td>
        </tr>
    </tbody>
</table>
<br/>
<div style="clear:both;"></div>
<br/>
<table cellpadding="0" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th colspan="5">Slike za izabrani tip aranžmana </th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($type['additional']) && !empty($type['additional'])): ?>
		<?php foreach($type['additional'] as $t):?>
	    <tr>
	    	<td>
	    		<?php echo $t['name']; ?> 
	    		[<a target="_blank" href="<?php echo FILE_PATH.'accomodation_type'.DS.'resized'.DS.$type['id'].'-'.$t['id'].'-'.$t['image']; ?>" ><?php echo $t['image']; ?></a>]
	    	</td>
	    	<td>
	    		<a href="<?php echo BASE_PATH.'cms'.DS.'accomodation_type'.DS.$t['id'].DS.'delete-image-second'.DS; ?>" class="j_icon j_del" rel="<?php echo $t['image']; ?>" title="Brisanje slike"><!-- delete --></a>
	    	</td>
		</tr>
		<?php endforeach; ?>
		<?php endif;?>
		<tr>
			<td colspan="5">
				<a href="javascript:;" id="add">dodaj sliku</a><span class="j_icon j_note_right" title="Dimenzije V:150px Š:205px"></span>
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
			$.post('<?php echo BASE_PATH.'cms'.DS.'accomodation_type'.DS.'delete-image'.DS; ?>',
					{id: realId},
					function(data){
						if(data) $("#type-" + id).remove();
					}			
			);
		}else $("#type-" + id).remove();
	}
</script>
