<div class="entry">
    <?php if(isset($cars) && !empty($cars)):?>
    <h2>Pregeld postojećih automobila</h2>
    <table cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Marka automobila</th>
                <th>Datum kreiranja</th>
                <th>Detaljnije</th>
                <th>Pozicija</th>
                <th style="width: 50px;">Akcija</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cars as $c):?>
            <tr>
                <td><?php echo $c['type']; ?></td>
                <td><?php echo $c['modif']; ?></td>
                <td>
                	<a href="javascript:;" class="details" id="details-<?php echo $c['id']; ?>" >klikni ovde</a>
                </td>
                <td>
                    <a class="j_icon j_up" href="<?php echo BASE_PATH.'cms'.DS.'rent_a_car'.DS.$c['id'].DS.'position'.DS.'?dir=up'?>" title="Pomeri gore" ><!-- up --></a>
                    <a class="j_icon j_down" href="<?php echo BASE_PATH.'cms'.DS.'rent_a_car'.DS.$c['id'].DS.'position'.DS.'?dir=down'?>" title="Pomeri dole" ><!-- down --></a>
                </td>
                <td>
                    <a class="j_icon j_edit" title="Izmena detalja" href="<?php echo BASE_PATH.'cms'.DS.'rent_a_car'.DS.$c['id'].DS.'edit'.DS;?>"><!-- edit --></a>
                    <a class="j_icon j_del" rel="<?php echo $c['type']; ?>" title="Brisanje automobila" href="<?php echo BASE_PATH.'cms'.DS.'rent_a_car'.DS.$c['id'].DS.'delete'.DS;?>"><!-- delete --></a>
                </td>
            </tr>
            <tr class="popUp" id="popUp-<?php echo $c['id']; ?>">
            	<td colspan="6">
            		<ul>
            			<li>
	            			<strong><u>Podaci o automobilu:</u></strong>
	                		<?php echo $c['desc']; ?>
                		</li>
                		<li>
	            			<strong><u>Cenovnik:</u></strong>
	                		<?php if(isset($c['additional']) && !empty($c['additional'])): ?>
	                			<ul>
	                			<?php foreach($c['additional'] as $a):?>
	                				<li>Price: <?php echo $a['price']; ?> | Period: <?php echo $a['period']; ?></li>
	                			<?php endforeach; ?>
	                			</ul>
	                		<?php endif;?>
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
    <?php else:?>
    <div class="noContent info">Nema unetih automobila. Klikni <a href="<?php echo BASE_PATH.'cms'.DS.'rent_a_car'.DS.'add'.DS; ?>">ovde</a> da dodaš prvi automobil.</div>
    <?php endif; ?>
</div>