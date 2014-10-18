<?php
require_once 'libs/models/oppilas.php';
require_once 'libs/common.php';
$h = $_SESSION['kirjautunut'];
$kirjautunut = unserialize($h);
?>
<?php
if (!is_a($kirjautunut, 'Oppilas')) {
    naytaNakyma('kirjautumispohja.php', 'kirjautumislomake.php', array(
        'virhe' => "Sinulla ei ole käyttöoikeutta tuolle sivulle! Kirjaudu sisään ja yritä uudelleen!",
    ));
}
if (onkoKirjautunut() == null) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Sanakysely</title>
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
                <td width="150" align="center">

                    <form method="GET" onsubmit="return confirm('Haluatko varmasti kirjautua ulos?')"> 
                        <button type="submit" name="ulos" class="btn btn-lg btn-info" formaction="logout.php" >Kirjaudu ulos</button> 
                    </form> 
                </td>
            </tr>
            <tr>
                <td height="40" colspan="3" scope="col"></td>
            </tr>
            <?php if (!empty($data->virheet)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($data->virheet as $fiba): ?>
                        <?php echo $fiba . "<br>"; ?>
                    <?php endforeach; ?>
                </div></td>
        <?php endif; ?>
        <?php
        /* Tähän kohtaan sisältöä joka haetaan sopivasta näkymätiedostosta. Tiedostonimi muuttujassa $sivu.
         */
        require 'views/' . $sivu;
        ?>
    </table>
</body>
</html>