<table cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th colspan="2"><?php echo (isset($params['id']) && !empty($params['id']) ? "Izmenite podatke i kliknite na dugme 'Sačuvaj izmene'" : "Unesite podatke za novu destinaciju i kliknite na dugme 'Dodaj destinaciju'"); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Naziv destinacije: (*) </td>
            <td><input class="inputSmall r" type="text" name="name" value="<?php echo $dest['name']; ?>" /><span class="j_icon j_note_right" title="Unesi naziv destinacije (zemlju ili događaj)"></span></td>
        </tr>
        <tr>
            <td>Zastava: </td>
            <td>
            	<input class="inputSmall" type="file" name="file" /> <span class="j_icon j_note_right" title="Dodaj sliku zastave za zemlju. Ako je Destinacija događaj, polje ostaviti prazno."></span>
            	<?php if(isset($dest['image']) && !empty($dest['image'])):?>
				[ <a target="_blank" href="<?php echo FILE_PATH.'destinations'.DS.'resized'.DS.$dest['id'].'-'.$dest['image']; ?>" ><?php echo $dest['image']; ?></a>]
				<?php endif; ?>	 
            </td>
        </tr>
        <tr>
            <td>Opis: </td>
            <td>
				<textarea rows="10" cols="50" name="desc"><?php echo $dest['desc']; ?></textarea> <span class="j_icon j_note_right" title="Upiši kratak opsi destinacije"></span>
			</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>&nbsp;</td>
            <td><button type="submit" name="button"><?php echo (isset($params['id']) && !empty($params['id']) ? "Sačuvaj izmene" : "Dodaj destinaciju"); ?></button>
        </tr>
    </tfoot>
</table>
<script type="text/javascript" >
	$(document).ready(function(){

		$('.j_icon').each(function(){
	        $(this).colorTip({color:'red'});
        });
	});
</script>