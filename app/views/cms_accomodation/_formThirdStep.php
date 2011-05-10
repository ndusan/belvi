<?php if(isset($services) && !empty($services)):?>
<?php foreach($services as $s): ?>
<table cellpadding="0" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th colspan="3"><?php echo $s['service']; ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="width:20%;">Datum polaska</td>
			<td style="width:20%;">Broj noćenja</td>
			<td style="width:60%;">Cena</td>
		</tr>
		<?php if(isset($dates) && !empty($dates)):?>
		<?php foreach($dates as $d):?>
	    <tr>
	    	<td>
	    		<?php echo $d['date']; ?>
	    	</td>
	    	<td><?php echo $d['nights']; ?></td>
	    	<td>
				<input class="fl smallInput" type="text" name="price[<?php echo $s['id']; ?>][<?php echo $d['id']; ?>]" value="<?php echo (isset($price[$s['id']][$d['id']]) ? $price[$s['id']][$d['id']]['price'] : "");?>"/>
	    	</td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>
<br/>
	<div style="both:clear; "></div>
<br/>
<?php endforeach; ?>
<?php else:?>
<div class="noResults">
	Nije izabran tip!	
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