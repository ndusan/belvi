<?php if(isset($transport) && !empty($transport)):?>
<?php foreach($transport as $t): ?>
<table cellpadding="0" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th colspan="3"><?php echo $t['name']; ?></th>
		</tr>
	</thead>
	<tbody>
	    <tr>
	    	<td>
				<input class="fl bigInput" type="text" name="price[<?php echo $t['id']; ?>]" value="<?php echo (isset($price[$t['id']]) ? $price[$t['id']]['price'] : "");?>"/>
				<span class="j_icon j_note_right" title="Upisati cenu za odabrani tip prevoza (na primer: 85 EUR   dete 0-2g besplatno)"></span>  	
	    	</td>
		</tr>
	</tbody>
</table>
<br/>
	<div style="both:clear; "></div>
<br/>
<?php endforeach; ?>
<?php else:?>
<div class="noResults">
	Nije izabran nijedan oblik prevoza!	
</div>
<?php endif; ?>
<table cellpadding="0" cellspacing="0" width="100%"> 
	<tfoot>
		<tr>
			<td> 
				<button type="submit" name="button">Kreiraj</button>
				<input type="hidden" name="step" value="third" />
			</td>
		</tr>
	</tfoot>
</table>