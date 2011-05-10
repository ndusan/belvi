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
            <th colspan="2"><?php echo (isset($params['id']) && !empty($params['id']) ? "Izmenite podatke i kliknite na dugme 'Sačuvaj izmene'" : "Unesite podatke za novi događaj i kliknite na dugme 'Dodaj događaj'"); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Naziv događaja: (*)</td>
            <td><input class="inputSmall r" type="text" name="name" value="<?php echo $event['name']; ?>" /> <span class="j_icon j_note_right" title="Unesi tačan naziv koncerta"></span></td>
        </tr>
        <tr>
            <td>Mesto održavanja događaja: (*)</td>
            <td><input class="inputSmall r" type="text" name="place" value="<?php echo $event['place']; ?>" /> <span class="j_icon j_note_right" title="Unesi lokaciju na kojoj se održava koncert"></span></td>
        </tr>
        <tr>
            <td>Cena: (*)</td>
            <td><input class="inputSmall r" type="text" name="price" value="<?php echo $event['price']; ?>" /> <span class="j_icon j_note_right" title="Unesi cenu odlaska na koncert"></span></td>
        </tr>
        <tr>
            <td>Datum: (*)</td>
            <td><input class="inputSmall r datepicker" style="width: 100px;" type="text" name="date" value="<?php echo $event['date']; ?>" /> <span class="j_icon j_note_right" title="Unesi datum koncerta"></span></td>
        </tr>
        <tr>
            <td>Link ka fajlu: (*)</td>
            <td>
            	<?php if(isset($event['pdf']) && !empty($event['pdf'])):?>
            	<input class="inputSmall" type="file" name="pdf" value="" />
				[ <a target="_blank" href="<?php echo FILE_PATH.'events'.DS.'original'.DS.$event['id'].'-pdf-'.$event['pdf']; ?>" ><?php echo $event['pdf']; ?></a>]
				<a href="<?php echo BASE_PATH.'cms'.DS.'events'.DS.$event['id'].DS.'delete-file'.DS; ?>" class="j_icon j_del" rel="<?php echo $event['pdf']; ?>" title="Brisanje fajla"><!-- delete --></a>
				<?php else:?>
				<input class="inputSmall r" type="file" name="pdf" value="" />
				<?php endif;?>
				<span class="j_icon j_note_right" title="Unesite PDF dokument sa detaljima koncerta"></span>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top;">Generalan opis:</td>
            <td>
            	<textarea class="r mceAdvanced" rows="" cols="" name="desc"><?php echo $event['desc']; ?></textarea><span class="j_icon j_note_right" title="Opis putovanja"></span>
        </tr>
        <tr>
        	<td>Slika događaja:<br />
        	  	</td>
			<td>
				<input type="file" name="file" class="inputSmall" value=""/>
				<?php if(isset($event['image']) && !empty($event['image'])):?>
				[ <a target="_blank" href="<?php echo FILE_PATH.'events'.DS.'resized'.DS.$event['id'].'-'.$event['image']; ?>" ><?php echo $event['image']; ?></a>]
				<a href="<?php echo BASE_PATH.'cms'.DS.'events'.DS.$event['id'].DS.'delete-image'.DS; ?>" class="j_icon j_del" rel="<?php echo $event['image']; ?>" title="Brisanje slike"><!-- delete --></a>
				<?php endif; ?> <span class="j_icon j_note_right" title="Dimenzije slike moraju biti Š:486px V:240px"></span>
			</td>        	
        </tr>
    </tbody>
    <tfoot>
        <tr>
        	<td colspan="5">
				<input type="hidden" id="count" value="<?php echo $count;?>" />
				<button type="submit" name="button"><?php echo (isset($params['id']) && !empty($params['id']) ? "Sačuvaj izmene" : "Dodaj događaj"); ?></button>
			</td>
        </tr>
    </tfoot>
</table>
<script type="text/javascript" src="<?php echo JS_PATH.'ui.datepicker.js'?>"></script>
<link href='<?php echo CSS_PATH.'datepicker.css'?>' rel='stylesheet' type='text/css'/>

<script type="text/javascript" >
	$(document).ready(function(){
		$(".datepicker").datepicker();
		$('.j_icon').each(function(){
	        $(this).colorTip({color:'red'});
        });
	});
</script>