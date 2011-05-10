<div class="entry">
    <?php if(isset($carousel) && !empty($carousel)):?>
    <h2>Pregled postojećih reklama</h2>
    <table cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Tip aranžmana</th>
                <th>Link</th>
                <th>Datum kreiranja</th>
                <th style="width: 50px;">Pozicija</th>
                <th style="width: 50px;">Akcija</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach($carousel as $d):?>
            <tr>
                <td><?php echo $d['name']; ?></td>
                <td><?php echo $d['accomodation_type']; ?></td>
				<td><?php echo $d['modif']; ?></td>
				<td>
                    <a class="j_icon j_up" href="<?php echo BASE_PATH.'cms'.DS.'carousel'.DS.$d['id'].DS.'position'.DS.'?dir=up'?>" title="Pomeri gore" ><!-- up --></a>
                    <a class="j_icon j_down" href="<?php echo BASE_PATH.'cms'.DS.'carousel'.DS.$d['id'].DS.'position'.DS.'?dir=down'?>" title="Pomeri dole" ><!-- down --></a>
                </td>
                <td>
                	<a class="j_icon j_edit" href="<?php echo BASE_PATH.'cms'.DS.'carousel'.DS.$d['id'].DS.'edit'.DS?>" title="Izmeni" ><!-- down --></a>
                	<a class="j_icon j_del" href="<?php echo BASE_PATH.'cms'.DS.'carousel'.DS.$d['id'].DS.'delete'.DS?>" rel="<?php echo $d['name']; ?>" title="Obriši" ><!-- down --></a>
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
    <div class="noContent info">Nema unetih reklama. Klikni <a href="<?php echo BASE_PATH.'cms'.DS.'carousel'.DS.'add'.DS; ?>">ovde</a> da dodaš prvu reklamu.</div>
    <?php endif; ?>
</div>