<div class="entry">
    <?php if(isset($entry) && !empty($entry)):?>
    <h2>Pregled postojećih aranžmana</h2>
    <table cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Naziv aranžmana</th>
                <th>Tip aranžmana</th>
                <th>Datum kreiranja</th>
                <th style="width: 50px;">Akcija</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach($entry as $e):?>
            <tr>
                <td><?php echo $e['name']; ?></td>
                <td><?php echo $e['accomodation_type']; ?></td>
				<td><?php echo $e['modif']; ?></td>
                <td>
                    <a class="j_icon j_edit" title="Izmena detalja" href="<?php echo BASE_PATH.'cms'.DS.'accomodation'.DS.$e['id'].DS.'edit'.DS;?>"><!-- edit --></a>
                    <a class="j_icon j_del" rel="<?php echo $e['name']; ?>" title="Brisanje aranžmana" href="<?php echo BASE_PATH.'cms'.DS.'accomodation'.DS.$e['id'].DS.'delete'.DS;?>"><!-- delete --></a>
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
    <div class="noContent info">Nema unetih aranžana. Klikni <a href="<?php echo BASE_PATH.'cms'.DS.'accomodation'.DS.'add'.DS; ?>">ovde</a> da dodaš prvi aranžman.</div>
    <?php endif; ?>
</div>