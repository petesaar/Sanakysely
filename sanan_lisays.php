<?php

/* Kontrolleri opettajan sananlisäyssivun näyttämiseen ja muihin toimiin */

require_once 'libs/common.php';
require 'libs/models/sanasto.php';
require 'libs/models/opettaja.php';
require 'libs/models/sana.php';

$pohja = 'ope_pohja.php';
$sivu = 'ope_sanan_lisays.php';
$sanastoLista = Sanasto::getKaikkiSanastot();
$opet = Opettaja::getKaikkiOpettajat();
$valittu_sanasto = Sanasto::etsiSanasto($_SESSION['muokattava_sanasto']) ;
$sanalista = Sana::getSanastonSanat($valittu_sanasto->getSanastotunnus());

if (isset($_POST["tallennaSanaNappi"])) {
    $lkm = Sana::etsiSuurin();

    $sana = new Sana();
    $sana->setSanatunnus($lkm + 1);
    $sana->setKohde(putsaaString($_POST['sananNimi']));
    $sana->setKieli(putsaaString($_POST['sananKielet']));
    $sana->setKaannos(putsaaString($_POST['sananKaannos']));
    $sana->setTaivutus(putsaaString($_POST['sananTaivutus']));
    $sana->setSluokka(putsaaString($_POST['sananSanaluokka']));
    $sana->setArtikkeli(putsaaString($_POST['sananArtikkeli']));
    
    if ($sana->onkoKelvollinen()) {
        $sana->lisaaKantaan($valittu_sanasto->getSanastotunnus());
        $valittu_sanasto->paivitaKantaanLkm('1');
        $_SESSION['ilmoitus'] = "Sana lisätty onnistuneesti.";
        header('Location: sisallon_muokkaus.php');
    } else {
        $virheet = $sana->getVirheet();
        naytaNakyma($pohja, $sivu, array(
            'sana' => $sana,
            'virheet' => $virheet,
        ));
    }
}
    naytaNakyma($pohja, $sivu, array(        
        'sana' => new Sana(),
        'sanastot' => $sanastoLista,
        'opet' => $opet,
        'sanat' => $sanalista,
    ));


    
