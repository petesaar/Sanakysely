<?php

/* Kontrolleri opettajan sananmuutossivun näyttämiseen ja muihin toimiin */

require_once 'libs/common.php';
require 'libs/models/sanasto.php';
require 'libs/models/opettaja.php';
require 'libs/models/sana.php';

$pohja = 'ope_pohja.php';
$sivu = 'ope_sanan_muutos.php';
$sanastoLista = Sanasto::getKaikkiSanastot();
$sanaLista = Sana::getKaikkiSanat();
$opet = Opettaja::getKaikkiOpettajat();
$valittu_sanasto = Sanasto::etsiSanasto($_SESSION['muokattava_sanasto']) ;
$sanalista = Sana::getSanastonSanat($valittu_sanasto->getSanastotunnus());
$tunnus = $_SESSION['muokattava_sana'];
$muutettavaSana = Sana::etsiSana($tunnus);

if (isset($_POST["tallennaSananMuutoksetNappi"])) {
    $muutettavaSana->setKohde(putsaaString($_POST['sananNimi']));
    $muutettavaSana->setKieli(putsaaString($_POST['sananKielet']));
    $muutettavaSana->setKaannos(putsaaString($_POST['sananKaannos']));
    $muutettavaSana->setTaivutus(putsaaString($_POST['sananTaivutus']));
    $muutettavaSana->setSluokka(putsaaString($_POST['sananSanaluokka']));
    $muutettavaSana->setArtikkeli(putsaaString($_POST['sananArtikkeli']));
    
    if ($muutettavaSana->onkoKelvollinen()) {        
        $muutettavaSana->paivitaKantaan();
        $_SESSION['ilmoitus'] = "Sana päivitetty onnistuneesti.";
        header('Location: sisallon_muokkaus.php');
    } else {
        $virheet = $muutettavaSana->getVirheet();
        naytaNakyma($pohja, $sivu, array(
            'sana' => $muutettavaSana,
            'virheet' => $virheet,
        ));
    }
}
    naytaNakyma($pohja, $sivu, array(        
        'sana' => $muutettavaSana,
        'sanastot' => $sanastoLista,
        'opet' => $opet,
        'sanat' => $sanalista,
    ));


    
