<div class="entry">
    <?php if(isset($carrieres) && !empty($carrieres)):?>
    <h2>Pregeld postojećih prijava za posao</h2>
    <table cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Ime i prezime</th>
                <th>Konkurs za mesto</th>
                <th>Stručna sprema</th>
                <th>Datum prijave</th>
                <th>Detaljnije</th>
                <th style="width: 50px;">Akcija</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach($carrieres as $c):?>
            <tr>
                <td><?php echo $c['candidat']; ?></td>
                <td><?php echo $c['position']; ?></td>
                <td><?php echo $c['level']; ?></td>
                <td><?php echo $c['modif']; ?></td>
                <td>
                	<a href="javascript:;" class="details" id="details-<?php echo $c['id']; ?>" >klikni ovde</a>
                </td>
                <td>
                    <a class="j_icon j_del" rel="<?php echo $c['candidat']; ?>" title="Brisanje prijave" href="<?php echo BASE_PATH.'cms'.DS.'carriere'.DS.$c['id'].DS.'delete'.DS;?>"><!-- delete --></a>
                </td>
            </tr>
            <tr class="popUp" id="popUp-<?php echo $c['id']; ?>">
            	<td colspan="6">
            		<ul>
            			<li>
	            			<strong>Godište:</strong>
	                		<?php echo $c['born']; ?>
                		</li>
                		<li>
	            			<strong>Profesija:</strong>
	                		<?php echo $c['profession']; ?>
                		</li>
                		<li>
	            			<strong>Godina sticanja ss-a:</strong>
	                		<?php echo $c['year']; ?>
                		</li>
                		<li>
	            			<strong>Iskustvo:</strong>
	                		<?php echo $c['expirience']; ?>
                		</li>
                		<li>
	            			<strong>Razlog:</strong>
	                		<?php echo $c['reason']; ?>
                		</li>
                		<li>
	            			<strong>Lični kvaliteti:</strong>
	                		<?php echo $c['features']; ?>
                		</li>
                		<li>
	            			<strong>El.adresa:</strong>
	                		<?php echo $c['email']; ?>
                		</li>
                		<li>
	            			<strong>Kontakt telefon:</strong>
	                		<?php echo $c['telephone']; ?>
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
    <div class="noContent info">Nema unetih prijava za zaposlenje. </div>
    <?php endif; ?>
</div>