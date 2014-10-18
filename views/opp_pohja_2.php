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
        <title>Tentti</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
    </head>
    <?php
    /* Tähän kohtaan sisältöä joka haetaan sopivasta näkymätiedostosta. Tiedostonimi muuttujassa $sivu.
     */
    require 'views/' . $sivu;
    ?>
</html>
