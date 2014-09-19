<?php
require 'libs/tietokantayhteys.php';
require_once 'libs/models/oppilas.php';
$sql = "SELECT oppilastunnus, nimi, salasana from oppilas";
$kysely = getTietokantayhteys()->prepare($sql);
$kysely->execute();

$opptaulu = $kysely->fetchAll(PDO::FETCH_OBJ);
echo $opptaulu[0]->oppilastunnus . "<br>";
echo $opptaulu[0]->salasana . "<br>";
echo $opptaulu[1]->nimi . "<br>";
echo $opptaulu[1]->salasana . "<br>";
echo $opptaulu[2]->nimi . "<br>";
echo $opptaulu[2]->salasana . "<br>";
print_r($opptaulu);
echo "<br>";
$määrä = count($opptaulu);
echo $määrä;

$tulokset = array();
echo "taalla";
$kysely->execute();
foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
    $oppilas = new Oppilas();
    $oppilas->setOppilastunnus($tulos->oppilastunnus);
    $oppilas->setNimi($tulos->nimi);
    $oppilas->setSalasana($tulos->salasana);

    //$array[] = $muuttuja; lisää muuttujan arrayn perään. 
    //Se vastaa melko suoraan ArrayList:in add-metodia.
    $tulokset[] = $oppilas;
    echo "valmis";
}
?><!DOCTYPE HTML>
<html>
    <head><title>Otsikko</title></head>
    <body>
        <h1>Oppilasluettelo</h1>
        <ul>
            <?php foreach ($tulokset as $asia) { ?>
                <li><?php echo $asia->getNimi() . "  Salasana: " . $asia->getSalasana(); ?></li>
            <?php } ?>
        </ul>
    </body>
</html>