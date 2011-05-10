<table cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th colspan="2"><?php echo (isset($params['id']) && !empty($params['id']) ? "Izmenite podatke i kliknite na dugme 'Sačuvaj izmene'" : "Unesite podatke i klikni na dugme 'Dodaj poziciju'"); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Naziv poziciju: (*) </td>
            <td><input class="inputSmall r" type="text" name="name" value="<?php echo $p['name']; ?>" /><span class="j_icon j_note_right" title="Unesi naziv pozicije"></span></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>&nbsp;</td>
            <td><button type="submit" name="button"><?php echo (isset($params['id']) && !empty($params['id']) ? "Sačuvaj izmene" : "Dodaj poziciju"); ?></button>
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