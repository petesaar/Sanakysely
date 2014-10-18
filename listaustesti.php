<?php
require 'libs/tietokantayhteys.php';
require_once 'libs/models/oppilas.php';
$sql = "SELECT oppilastunnus, nimi, salasana, tehdyt, viimeksi from oppilas";
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
    $oppilas = new Oppilas($tulos->oppilastunnus, $tulos->nimi, $tulos->salasana, $tulos->tehdyt, $tulos->viimeksi);
    $oppilas->setOppilastunnus($tulos->oppilastunnus);
    $oppilas->setNimi($tulos->nimi);
    $oppilas->setSalasana($tulos->salasana);

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
                <li><?php echo $asia->getOppilastunnus() . ",  nimi: " . $asia->getNimi() . ",  salasana: " . $asia->getSalasana(); ?></li>
            <?php } ?>
        </ul>
    </body>
</html>