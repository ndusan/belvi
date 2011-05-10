<div class="entry">
    <?php if(isset($bookings) && !empty($bookings)):?>
    <h2>Pregeld postojećih rezervacija</h2>
    <table cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Datum prijave</th>
                <th>Period putovanja od</th>
                <th>Period putovanja do</th>
                <th>Destinacija</th>
                <th>Hotel/apartman</th>
                <th>Detaljnije</th>
                <th style="width: 50px;">Akcija</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach($bookings as $b):?>
            <tr>
                <td><?php echo $b['modif']; ?></td>
                <td><?php echo $b['date_from']; ?></td>
                <td><?php echo $b['date_to']; ?></td>
                <td><?php echo $b['destination']; ?></td>
                <td><?php echo $b['accomodation']; ?></td>
                <td>
                	<a href="javascript:;" class="details" id="details-<?php echo $b['id']; ?>" >klikni ovde</a>
                </td>
                <td>
                    <a class="j_icon j_del" rel="<?php echo $b['destination']; ?>" title="Brisanje rezervacije" href="<?php echo BASE_PATH.'cms'.DS.'online_booking'.DS.$b['id'].DS.'delete'.DS;?>"><!-- delete --></a>
                </td>
            </tr>
            <tr class="popUp" id="popUp-<?php echo $b['id']; ?>">
            	<td colspan="6">
            		<?php if($b['additional']):?>
            		<strong><u>Podaci o putnicima:</u></strong>
            		<ul>
						<?php foreach($b['additional'] as $a):?>
						<?php if($a['type'] == 'Putnik'):?>
            			<li>
	            			<strong>Ime putnika:</strong>
	                		<?php echo $a['passanger']; ?>
                		</li>
                		<li>
	            			<strong>Datum rođenja putnika:</strong>
	                		<?php echo $a['birth_date']; ?>
                		</li>
                		<?php endif; ?>
                		<?php endforeach; ?>
                	</ul>
                	
                	<strong><u>Podaci o deci:</u></strong>
                	<ul>
                		<?php foreach($b['additional'] as $a):?>
						<?php if($a['type'] == 'Dete'):?>
            			<li>
	            			<strong>Ime deteta:</strong>
	                		<?php echo $a['passanger']; ?>
                		</li>
                		<li>
	            			<strong>Datum rođenja deteta:</strong>
	                		<?php echo $a['birth_date']; ?>
                		</li>
                		<?php endif; ?>
                		<?php endforeach; ?>
                	</ul>
                	<?php endif;?>
                	<strong><u>Ostali podaci:</u></strong>
                	<ul>
            			<li>
	            			<strong>Prevozno sredstvo:</strong>
	                		<?php echo $b['transport']; ?>
                		</li>
                		<li>
	            			<strong>Način plaćanja:</strong>
	                		<?php echo $b['payment_method']; ?>
                		</li>
                	</ul>
                	<strong>Lični podaci:</strong>
                	<ul>
            			<li>
	            			<strong>Adresa:</strong>
	                		<?php echo $b['address']; ?>
                		</li>
                		<li>
	            			<strong>Mesto:</strong>
	                		<?php echo $b['city']; ?>
                		</li>
                		<li>
	            			<strong>Kontakt telefon:</strong>
	                		<?php echo $b['telephone']; ?>
                		</li>
                		<li>
	            			<strong>El.adresa:</strong>
	                		<?php echo $b['email']; ?>
                		</li>
                		<li>
	            			<strong>Napomena:</strong>
	                		<?php echo $b['reason']; ?>
                		</li>
                	</ul>
            	</td>
            </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.j_icon').each(function(){
                $(this).colorTip({color:'red'});
            });
        });
    </script>
    <?php else: ?>
    <div class="noContent info">Nema unetih rezervacija. </div>
    <?php endif; ?>
</div>