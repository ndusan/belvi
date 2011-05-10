        <table cellpadding="0" cellspacing="0" width="100%" >
            <thead>
                <tr>
                    <th colspan="2"><?php echo (isset($params['id']) && !empty($params['id']) ? "Izmenite podatke i kliknite na dugme 'Sačuvaj'" : "Unesite podatke za reklamu i kliknite na dugme 'Sačuvaj'"); ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td><!-- empty --></td>
                    <td><button type="submit" name="button" >Sačuvaj</button></td>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td style="width: 200px; ">Naziv reklame (*):</td>
                    <td><input type="text" class="r bigInput" name="name" value="<?php echo $carousel['name'];?>" /> <span class="j_icon j_note_right" title="Tekst na header-u koji opisuje sliku"></span></td>
                </tr>
                <tr>
                    <td>Link (*):</td>
                    <td>
                    	<?php if(isset($links) && !empty($links)):?>
                        <select name="link" class="r bigInput">
                        	<?php foreach($links as $l):
                        			if($l['id'] == $carousel['accomodation_type_id']) $sel = "selected='selected'";
                        			else $sel = "";
                        	?>
                        	<option <?php echo $sel; ?> value="<?php echo $l['id']; ?>"><?php echo $l['name']; ?></option>
							<?php endforeach; ?>
                        </select><span class="j_icon j_note_right" title="Veza sa stranicom koju opisuje slika"></span>
                        <?php else:?>
                        <b>Kreirajte prvo konkretan aranžman!!!</b>
                        <?php endif;?>
                    </td>
                </tr>
                <tr>
                    <td>Slika reklame (*):</td>
                    <td>
                    	<?php if(isset($carousel['image']) && !empty($carousel['image'])):?>
                    	<input type="file" class="bigInput" name="file" value="" />
						[ <a target="_blank" href="<?php echo FILE_PATH.'carousel'.DS.'resized'.DS.$carousel['id'].'-'.$carousel['image']; ?>" ><?php echo $carousel['image']; ?></a>]
						<a href="<?php echo BASE_PATH.'cms'.DS.'carousel'.DS.$carousel['id'].DS.'delete-image'.DS; ?>" class="j_icon j_del" rel="<?php echo $carousel['image']; ?>" title="Brisanje slike"><!-- delete --></a>
						<?php else: ?>
						<input class="bigInput r" type="file" name="file" value="" /><span class="j_icon j_note_right" title="Slika u header-u. Dimenzije slike moraju biti V:207px, Š:744px"></span>
						<?php endif; ?>
                    </td>
                </tr>
            </tbody>

        </table>
<script type="text/javascript" >
	$(document).ready(function(){

		$('.j_icon').each(function(){
	        $(this).colorTip({color:'red'});
        });
	});
</script>