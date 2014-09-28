<?php

require_once 'libs/common.php';
require 'libs/models/sanasto.php';
require 'libs/models/opettaja.php';

$pohja = 'ope_pohja.php';
$sivu = 'ope_sanaston_lisays.php';
$sanastoLista = Sanasto::getKaikkiSanastot();
$opet = Opettaja::getKaikkiOpettajat();

if (isset($_POST["tallennaNappi"])) {
    $lkm = Sanasto::etsiSuurin();

    $sanasto = new Sanasto();
    $sanasto->setSanastotunnus($lkm + 1);
    $sanasto->setNimi(putsaaString($_POST['sanastonNimi']));
    $sanasto->setKieli(putsaaString($_POST['sanastonKielet']));
    $sanasto->setKuvaus(putsaaString($_POST['sanastonKuvaus']));
    $sanasto->setMaara(0);
    $sanasto->setOpetunnus(0);

    if ($sanasto->onkoKelvollinen()) {
        $sanasto->lisaaKantaan();
        $_SESSION['ilmoitus'] = "Sanasto lisätty onnistuneesti.";
        header('Location: muokkaus.php');
    } else {
        $virheet = $sanasto->getVirheet();
        naytaNakyma($pohja, $sivu, array(
            'sanasto' => $sanasto,
            'virheet' => $virheet,
        ));
    }
}
    naytaNakyma($pohja, $sivu, array(
        'testikentta' => "(Muut painikkeet kuin 'Kirjaudu ulos' eivät toimi vielä!)",
        'sanasto' => new Sanasto(),
        'sanastot' => $sanastoLista,
        'opet' => $opet,
    ));


    