<?php
require_once 'libs/models/oppilas.php';
require_once 'libs/common.php';
$h = $_SESSION['kirjautunut'];
$kirjautunut = unserialize($h);
?>
<?php
if (onkoKirjautunut() == null){
    header('Location: login.php');
}
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Oppilaan etusivu</title>
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
                <td width="150" align="center"><button type="submit" class="btn btn-info" onclick="location.href = 'logout.php'">Kirjaudu ulos</button>

                </td>
            </tr>
            <tr>
                <td height="40" colspan="3" scope="col"></td>
            </tr>
  <?php 
    /* HTML-rungon keskellä on sivun sisältö, 
     * joka haetaan sopivasta näkymätiedostosta.
     * Oikean näkymän tiedostonimi on tallennettu muuttujaan $sivu.
     */
    require 'views/'.$sivu; 
  ?>
</table>


</body>
</html>