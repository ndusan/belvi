<div class="entry">
    <?php if(isset($types) && !empty($types)):?>
    <h2>Pregled postojećih tipova aranžmana</h2>
    <table cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Tip aranžmana</th>
                <th>Aranžman</th>
                <th>Destinacija</th>
                <th>Datum kreiranja</th>
                <th>Pozicija</th>
                <th style="width: 50px;">Akcija</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach($types as $key => $val):?>
                <?php $first = true;?>
                <?php foreach($val as $t):?>
                <?php if($first):?>
            <tr>
            	<td colspan="6"></td>
            </tr>
            	<?php $first = false;?>
                <?php endif;?>
            <tr>
                <td><?php echo $t['name']; ?></td>
                 <td>
                <?php 
                if(isset($t['accomodation'])){
                	switch($t['accomodation']){
                		case 'summer': echo 'Letovanja'; break;
                		case 'winter': echo 'Zimovanja'; break;
                		case 'city_break': echo 'City break'; break;
                		case 'other': echo 'Ostalo'; break;
                		case 'destination': echo 'Daleke destinacije'; break;
                		case 'wellness_and_spa': echo 'Welness and spa'; break;
                		default: //error
                	} 
                }
                ?>
                </td>
                <td><?php echo $t['destination']; ?></td>
				<td><?php echo $t['modif']; ?></td>
				<td>
					<a class="j_icon j_up" href="<?php echo BASE_PATH.'cms'.DS.'accomodation_type'.DS.$t['id'].DS.'position'.DS.'?dir=up&destination_id='.$t['destination_id']; ?>" title="Pomeri gore" ><!-- up --></a>
                    <a class="j_icon j_down" href="<?php echo BASE_PATH.'cms'.DS.'accomodation_type'.DS.$t['id'].DS.'position'.DS.'?dir=down&destination_id='.$t['destination_id']; ?>" title="Pomeri dole" ><!-- down --></a>
				</td>
                <td>
                    <a class="j_icon j_edit" title="Izmena detalja" href="<?php echo BASE_PATH.'cms'.DS.'accomodation_type'.DS.$t['id'].DS.'edit'.DS;?>"><!-- edit --></a>
                    <a class="j_icon j_del" rel="<?php echo $t['name']; ?>" title="Brisanje tip aranžmana" href="<?php echo BASE_PATH.'cms'.DS.'accomodation_type'.DS.$t['id'].DS.'delete'.DS;?>"><!-- delete --></a>
                </td>
            </tr>
                <?php endforeach; ?>
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
    <?php else:?>
    <div class="noContent info">Nema unetih tipova aranžmana. Klikni <a href="<?php echo BASE_PATH.'cms'.DS.'accomodation_type'.DS.'add'.DS; ?>">ovde</a> da dodaš prvi tip aranžmana.</div>
    <?php endif; ?>
</div>