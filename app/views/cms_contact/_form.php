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
        <table cellpadding="0" cellspacing="0" width="100%" >
            <thead>
                <tr>
                    <th colspan="2"><?php echo (isset($params['id']) && !empty($params['id']) ? "Izmenite podatke i kliknite na dugme 'Sačuvaj'" : "Unesite podatke za novi kontakt i kliknite na dugme 'Sačuvaj'"); ?></th>
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
                    <td>Ime lokacije:</td>
                    <td><input type="text" class="r inputSmall" name="location" value="<?php echo @$contact['location'];?>" /> <span class="j_icon j_note_right" title="Naziv lokacije na primer: BELVI TRAVEL"></span></td>
                </tr>
                <tr>
                    <td>Adresa:</td>
                    <td>
                        <textarea rows="" cols="" name="address" class="r inputSmall mceAdvanced"><?php echo @$contact['address'];?></textarea><span class="j_icon j_note_right" title="Uneti adresu"></span>
                    </td>
                </tr>
                <tr>
                    <td>Google mapa:<br />
                    
                    </td>
                    <td>
                        <textarea style="width:500px;" rows="" cols="" name="map" class="r inputSmall"><?php echo @$contact['map'];?></textarea> <span class="j_icon j_note_right" title="Veličinu mape podesiti na: širina 250px, visina 200px"></span>
                    </td>
                </tr>
            </tbody>

        </table>
