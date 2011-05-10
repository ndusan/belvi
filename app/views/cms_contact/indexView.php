<div class="entry">
    <?php if(isset($locations) && !empty($locations)):?>
    <h2>Pregeld postojećih lokacija</h2>
    <table cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Ime lokacije</th>
                <th>Datum kreiranja</th>
                <th style="width: 50px;">Pozicija</th>
                <th style="width: 50px;">Akcija</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach($locations as $l):?>
            <tr>
                <td class="parent"><?php echo $l['location']; ?></td>
                <td><?php echo $l['modif']; ?></td>
                <td>
                    <a class="j_icon j_up" href="<?php echo BASE_PATH.'cms'.DS.'contact'.DS.$l['id'].DS.'position'.DS.'?dir=up'?>" title="Pomeri gore" ><!-- up --></a>
                    <a class="j_icon j_down" href="<?php echo BASE_PATH.'cms'.DS.'contact'.DS.$l['id'].DS.'position'.DS.'?dir=down'?>" title="Pomeri dole" ><!-- down --></a>
                </td>
                <td>
                    <a class="j_icon j_edit" title="Izmena detalja" href="<?php echo BASE_PATH.'cms'.DS.'contact'.DS.$l['id'].DS.'edit'.DS;?>"><!-- edit --></a>
                    <a class="j_icon j_del" rel="<?php echo $l['location']; ?>" title="Brisanje lokacije" href="<?php echo BASE_PATH.'cms'.DS.'contact'.DS.$l['id'].DS.'delete'.DS;?>"><!-- delete --></a>
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
    <div class="noContent info">Nema unetih lokacija. Klikni <a href="<?php echo BASE_PATH.'cms'.DS.'contact'.DS.'add'.DS; ?>">ovde</a> da dodaš prvu lokaciju.</div>
    <?php endif; ?>
</div>