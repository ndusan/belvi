<div class="entry">
    <?php if(isset($users) && !empty($users)):?>
    <h2>Pregeld postojećih korisnika</h2>
    <table cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Elektronska adresa</th>
                <th>Datum kreiranja</th>
                <th style="width: 50px;">Akcija</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach($users as $u):?>
            <tr>
                <td><?php echo $u['firstname']; ?></td>
                <td><?php echo $u['lastname']; ?></td>
                <td><?php echo $u['email']; ?></td>
                <td><?php echo $u['modif']; ?></td>
                <td>
                    <a class="j_icon j_edit" title="Izmena detalja" href="<?php echo BASE_PATH.'cms'.DS.'users'.DS.$u['id'].DS.'edit'.DS;?>"><!-- edit --></a>
                            <?php if($u['id'] != $_SESSION['belvi']['id']):?>
                    <a class="j_icon j_del" rel="<?php echo $u['firstname']." ".$u['lastname']; ?>" title="Brisanje korisnika" href="<?php echo BASE_PATH.'cms'.DS.'users'.DS.$u['id'].DS.'delete'.DS;?>"><!-- delete --></a>
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
    <div class="noContent info">Nema unetih korisnika. Klikni <a href="<?php echo BASE_PATH.'cms'.DS.'users'.DS.'add'.DS; ?>">ovde</a> da dodaš prvog korisnika.</div>
    <?php endif; ?>
</div>