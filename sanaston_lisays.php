<?php

/* Kontrolleri opettajan sanastonlisäyssivun näyttämiseen ja muihin toimiin */

require_once 'libs/common.php';
require 'libs/models/sanasto.php';
require 'libs/models/opettaja.php';

$pohja = 'ope_pohja.php';
$sivu = 'ope_sanaston_lisays.php';
$h = $_SESSION['kirjautunut'];
$kirjautunut = unserialize($h);
$sanastoLista = Sanasto::getKaikkiSanastot();
$opet = Opettaja::getKaikkiOpettajat();
$opettaja = $kirjautunut->getOpettajatunnus();

if (isset($_POST["tallennaNappi"])) {
    $lkm = Sanasto::etsiSuurin();

    $sanasto = new Sanasto();
    $sanasto->setSanastotunnus($lkm + 1);
    $sanasto->setNimi(putsaaString($_POST['sanastonNimi']));
    $sanasto->setKieli(putsaaString($_POST['sanastonKielet']));
    $sanasto->setKuvaus(putsaaString($_POST['sanastonKuvaus']));
    $sanasto->setMaara(0);
    $sanasto->setOpetunnus($opettaja);

    if ($sanasto->onkoKelvollinen()) {
        $sanasto->lisaaKantaan();
        $_SESSION['ilmoitus'] = "Sanasto lisätty onnistuneesti. Huomaathan, että sanasto ei näy oppilaalle tentittävänä, ennen kuin siihen on lisätty ainakin yksi sana!";
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
        'sanasto' => new Sanasto(),
        'sanastot' => $sanastoLista,
        'opet' => $opet,
    ));


    