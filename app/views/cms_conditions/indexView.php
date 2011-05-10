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
<form name="form" enctype="multipart/form-data" action="<?php echo BASE_PATH.'cms'.DS.'conditions'.DS.'submit'.DS; ?>" method="post">
	<input type="hidden" name="id" value="<?php echo @$cond['id']; ?>" />
	<div class="entry">
		<h2>Unesi generalne uslove putovanja</h2>	
		<table cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th colspan="2">Unesite uslove putovanja i klikni na dugme 'Dodaj uslove'</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Naziv poziciju: (*)</td>
            <td>
            	<textarea rows="" cols="" name="name" class="r inputSmall mceAdvanced"><?php echo $cond['name'];?></textarea><span class="j_icon j_note_right" title="Uneti uslov"></span>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>&nbsp;</td>
            <td><button type="submit" name="button">Dodaj uslove</button>
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
	</div>
</form>