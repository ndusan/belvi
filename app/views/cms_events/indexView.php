<div class="entry">
    <?php if(isset($events) && !empty($events)):?>
    <h2>Pregled postojećih događaja</h2>
    <table cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Naziv događaja</th>
                <th>Mesto događaja</th>
                <th>Cena</th>
                <th>Datum</th>
                <th>Glavni</th>
                <th>Detaljnije</th>
                <th style="width: 50px;">Akcija</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($events as $e):?>
            <tr>
                <td><?php echo $e['name']; ?></td>
                <td><?php echo $e['place']; ?></td>
                <td><?php echo $e['price']; ?></td>
                <td><?php echo $e['date']; ?></td>
                <td>
                	<input type="radio" name="main" value="<?php echo $e['id']; ?>" <?php echo (isset($e['main']) && $e['main'] == 1 ? "checked='checked'" : ""); ?> />
                </td>
                <td>
                	<a href="javascript:;" class="details" id="details-<?php echo $e['id']; ?>" >klikni ovde</a>
                </td>
                <td>
                    <a class="j_icon j_edit" title="Izmena detalja" href="<?php echo BASE_PATH.'cms'.DS.'events'.DS.$e['id'].DS.'edit'.DS;?>"><!-- edit --></a>
                    <a class="j_icon j_del" rel="<?php echo $e['name']; ?>" title="Brisanje dogaÄ‘aja" href="<?php echo BASE_PATH.'cms'.DS.'events'.DS.$e['id'].DS.'delete'.DS;?>"><!-- delete --></a>
                </td>
            </tr>
            <tr class="popUp" id="popUp-<?php echo $e['id']; ?>">
            	<td colspan="6">
            		<ul>
            			<li>
	            			<strong><u>Detaljnije:</u></strong>
	                		<?php echo $e['desc']; ?>
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

			$("input[type='radio']").each(function(){
				$(this).click(function(){
					var value = $(this).val();
					$.post(	'<?php echo BASE_PATH.'cms'.DS.'events'.DS.'ajax-set-main'.DS; ?>',
							{'id' : value}
					);
				});
			});	        
        });
    </script>
    <?php else:?>
    <div class="noContent info">Nema unetih događaja. Klikni <a href="<?php echo BASE_PATH.'cms'.DS.'events'.DS.'add'.DS; ?>">ovde</a> da dodaš prvi događaj.</div>
    <?php endif; ?>
</div>