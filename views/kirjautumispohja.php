<!DOCTYPE html>

<html>
    <head>
        <title>Sanakysely-ohjelman kirjautumissivu</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
    </head>
    <body>
        <table width="90%" align="center" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="40" colspan="3" scope="col"></td>
            </tr>
            <tr>
                <td colspan="2"><h1>Sanakysely</h1></td>
            </tr>
            <tr>
                <td height="40" colspan="3" scope="col"></td>
            </tr>
            <tr>
                <td  height="40" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="3">Tervetuloa käyttämään Sanakysely-ohjelmaa! Ole hyvä ja kirjaudu sisään. Jos sinulla ei vielä ole käyttäjätunnusta, rekisteröidy palveluun.</td>
                <tr>
                    <td align="center"><br>
                    <form class="form-horizontal" role="form" action="doLogin.php" method="POST">
                        <button type="submit" name="rekisterointiNappi" value="rekisterointi" class="btn btn-default">Rekisteröidy</button>
                    </form>
                </td>
                </tr>
            </tr>
            <tr>
                <td  height="40" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <table width="30%" border="0" cellspacing="0" cellpadding="0">
                        <td style="width:20%">                       

                            <div class="container">
                                <?php if (!empty($data->virhe)): ?>
                                    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
                                <?php endif; ?>
                                <?php
                                /* Tähän kohtaan sisältöä joka haetaan sopivasta näkymätiedostosta. Tiedostonimi muuttujassa $sivu.
                                 */
                                require 'views/' . $sivu;
                                ?>
                            </div>
                        </td>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>


