<div class="entry">
    <?php if(isset($types) && !empty($types)):?>
    <h2>Pregled postojećih tipova aranžnama na naslovnoj stranici</h2>
    <table cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Tip aranžmana</th>
                <th>Destinacija</th>
                <th>Datum kreiranja</th>
                <th style="width: 120px;">Vidljiv  na naslovnoj </th>
                <th style="width: 50px;">Pozicija</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach($types as $d):?>
            <tr>
                <td><?php echo $d['name']; ?></td>
                <td><?php echo $d['destination']; ?></td>
				<td><?php echo $d['modif']; ?></td>
				<td style="text-align: center; ">
					<input type="checkbox" class="visible" value="" onClick="javascript: location.href='<?php echo BASE_PATH.'cms'.DS.'set-visible'.DS.'?id='.$d['id']; ?>';" <?php echo ($d['visible']>0 ? "checked='checked'" : ""); ?> />
				</td>
				<td>
					<?php if(isset($d['visible']) && $d['visible'] == 1):?>
                    <a class="j_icon j_up" href="<?php echo BASE_PATH.'cms'.DS.$d['id'].DS.'position'.DS.'?dir=up'?>" title="Pomeri gore" ><!-- up --></a>
                    <a class="j_icon j_down" href="<?php echo BASE_PATH.'cms'.DS.$d['id'].DS.'position'.DS.'?dir=down'?>" title="Pomeri dole" ><!-- down --></a>
                	<?php endif; ?>
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
    <div class="noContent info">Nema unetih tipova aranžmana.</div>
    <?php endif; ?>
</div>