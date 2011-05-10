<div class="entry">
    <?php if(isset($pos) && !empty($pos)):?>
    <h2>Pregeld postojećih pozicija</h2>
    <table cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Naziv</th>
                <th>Datum kreiranja</th>
                <th style="width: 50px;">Akcija</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pos as $c):?>
            <tr>
                <td><?php echo $c['name']; ?></td>
                <td><?php echo $c['modif']; ?></td>
                <td>
                    <a class="j_icon j_del" rel="<?php echo $c['name']; ?>" title="Brisanje prijave" href="<?php echo BASE_PATH.'cms'.DS.'carriere'.DS.$c['id'].DS.'del-pos'.DS;?>"><!-- delete --></a>
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
    <div class="noContent info">Nema unetih pozicija. Klikni <a href="<?php echo BASE_PATH.'cms'.DS.'carriere'.DS.'add'.DS; ?>">ovde</a> da dodaš prvu poziciju.</div>
    <?php endif; ?>
</div>