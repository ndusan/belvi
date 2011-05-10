<div class="entry">
    <?php if(isset($destinations) && !empty($destinations)):?>
    <h2>Pregeld postojećih destinacija</h2>
    <table cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Naziv destinacije</th>
                <th>Zastava</th>
                <th>Datum kreiranja</th>
                <th style="width: 50px;">Vidljiva</th>
                <th style="width: 50px;">Pozicija</th>
                <th style="width: 50px;">Akcija</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach($destinations as $d):?>
            <tr>
                <td><?php echo $d['name']; ?></td>
                <td>
                	<?php if(isset($d['image']) && !empty($d['image'])):?>
                	<img src="<?php echo FILE_PATH.'destinations'.DS.'resized'.DS.$d['id'].'-'.$d['image']; ?>" alt="" />
                	<?php endif; ?>
                </td>
				<td><?php echo $d['modif']; ?></td>
				<td style="text-align: center; ">
					<input type="checkbox" class="visible" value="" onClick="javascript: location.href='<?php echo BASE_PATH.'cms'.DS.'destinations'.DS.'set-visible'.DS.'?id='.$d['id']; ?>';" <?php echo ($d['visible']>0 ? "checked='checked'" : ""); ?> />
				</td>
				<td>
					<?php if(isset($d['visible']) && $d['visible'] == 1):?>
                    <a class="j_icon j_up" href="<?php echo BASE_PATH.'cms'.DS.'destinations'.DS.$d['id'].DS.'position'.DS.'?dir=up'?>" title="Pomeri gore" ><!-- up --></a>
                    <a class="j_icon j_down" href="<?php echo BASE_PATH.'cms'.DS.'destinations'.DS.$d['id'].DS.'position'.DS.'?dir=down'?>" title="Pomeri dole" ><!-- down --></a>
                	<?php endif; ?>
                </td>
                <td>
                    <a class="j_icon j_edit" title="Izmena detalja" href="<?php echo BASE_PATH.'cms'.DS.'destinations'.DS.$d['id'].DS.'edit'.DS;?>"><!-- edit --></a>
                    <a class="j_icon j_del" rel="<?php echo $d['name']; ?>" title="Brisanje destinacije" href="<?php echo BASE_PATH.'cms'.DS.'destinations'.DS.$d['id'].DS.'delete'.DS;?>"><!-- delete --></a>
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
    <div class="noContent info">Nema unetih destinacija. Klikni <a href="<?php echo BASE_PATH.'cms'.DS.'destinations'.DS.'add'.DS; ?>">ovde</a> da dodaš prvu destinaciju.</div>
    <?php endif; ?>
</div>