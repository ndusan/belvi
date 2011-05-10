<table cellpadding="0" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th colspan="2"><?php echo (isset($params['id']) && !empty($params['id']) ? "Izmenite podatke i kliknite na dugme 'Sačuvaj izmene'" : "Unesite podatke za novog korisnika i kliknite na dugme 'Dodaj korisnika'"); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Ime: (*)</td>
            <td><input class="inputSmall r" type="text" name="firstname" value="<?php echo @$usr['firstname']; ?>" /></td>
        </tr>
        <tr>
            <td>Prezime: (*)</td>
            <td><input class="inputSmall r" type="text" name="lastname" value="<?php echo @$usr['lastname']; ?>" /></td>
        </tr>
        <tr>
            <td>El.adresa: (*)</td>
            <td><input class="inputSmall r" type="text" name="email" <?php echo (isset($params['id']) && !empty($params['id']) ? "disabled='disabled'" : ""); ?> value="<?php echo @$usr['email']; ?>" /></td>
        </tr>
        <tr>
            <td>Lozinka: (*)</td>
            <td>
                <?php if(isset($params['id']) && !empty($params['id'])):?>
                <a href="javascript:;" onclick="javascript:add();" id="psw-change">Izmeni lozinku</a>
                <script type="text/javascript">
                    function add(){
                        var html = "<input class='inputSmall r psw-cancel' type='text' name='password' value='' />" +
                            " <a href='javascript:;' onclick='javascript:cancel();' class='psw-cancel' id='psw-cancel'>otkaži</a>";
                        //Add
                        $("#psw-change").parent().append(html);
                        //Remove
                        $("#psw-change").remove();
                    }

                    function cancel(){
                        var html = "<a href='javascript:;' id='psw-change' onclick='javascript:add();'>Izmeni lozinku</a>";
                        //Add
                        $("#psw-cancel").parent().append(html);
                        //Remove
                        $(".psw-cancel").each(function(){
                            $(this).remove();
                        });
                    }
                </script>
                <?php else:?>
                <input class="inputSmall r" type="text" name="password" value="" />
                <?php endif; ?>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>&nbsp;</td>
            <td><button type="submit" name="button"><?php echo (isset($params['id']) && !empty($params['id']) ? "Sačuvaj izmene" : "Dodaj korisnika"); ?></button>
        </tr>
    </tfoot>
</table>