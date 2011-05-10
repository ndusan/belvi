<div id="login">

    <!-- Messages -->
    <div class="warning"  style="display: none;" >El.adresa i lozinka nisu ispravni</div>


    <form name="form" action="<?php echo BASE_PATH.'login'.DS.'submit'.DS; ?>" method="post">
        <table cellpadding="0" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><h2>Unesite el.adresu i lozinku zbog verifikacije</h2></th>
                </tr>
            </thead>
            <tbody>
                <tr>

                    <td><label>El.adresa</label>
                        <input type="text" name="email" class="inputSmall r lite" value="test" /></td>
                </tr>
                <tr>
                    <td><label>Lozinka</label>
                        <input type="password" name="password" class="inputSmall r lite" value="test" /></td>
                </tr>
                <tr>

                    <td><input class="radio" type="checkbox" value="1" name="remember" />Zapamti me</td>
                </tr>
            </tbody>
			<tfoot>
                <tr>

                    <td align="center">
                        <button type="submit" name="button">Prijavi</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>

</div>