<?php

require_once 'libs/common.php';
require 'libs/models/sanasto.php';
require 'libs/models/opettaja.php';

$pohja = 'ope_pohja.php';
$sivu = 'ope_sanaston_muutos.php';
$sanastoLista = Sanasto::getKaikkiSanastot();
$opet = Opettaja::getKaikkiOpettajat();
$tunnus = $_SESSION['muutettava'];
$muutettavaSanasto = Sanasto::etsiSanasto($tunnus);

if (isset($_POST["tallennaSanastonMuutoksetNappi"])) {

    $muutettavaSanasto->setNimi(putsaaString($_POST['sanastonNimi']));
    $muutettavaSanasto->setKieli(putsaaString($_POST['sanastonKielet']));
    $muutettavaSanasto->setKuvaus(putsaaString($_POST['sanastonKuvaus']));

    if ($muutettavaSanasto->onkoKelvollinen()) {
        $muutettavaSanasto->paivitaKantaan();
        $_SESSION['ilmoitus'] = "Sanasto päivitetty onnistuneesti.";
        header('Location: muokkaus.php');
    } else {
        $virheet = $muutettavaSanasto->getVirheet();
        naytaNakyma($pohja, $sivu, array(
            'sanasto' => $muutettavaSanasto,
            'virheet' => $virheet,
        ));
    }
}
    naytaNakyma($pohja, $sivu, array(
        'testikentta' => "(Muut painikkeet kuin 'Kirjaudu ulos' eivät toimi vielä!)",
        'sanasto' => $muutettavaSanasto,
        'sanastot' => $sanastoLista,
        'opet' => $opet,
    ));


    
