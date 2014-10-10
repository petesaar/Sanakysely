<?php

require_once 'libs/common.php';
require 'libs/models/oppilas.php';
require 'libs/models/opettaja.php';
$pohja = 'rekPohja.php';
$sivu = 'register.php';

if (empty($_POST["tunnari"])) {
    naytaNakyma($pohja, $sivu, array(
        'virhe' => "Rekisteröityminen epäonnistui! Et antanut käyttäjätunnusta.",
    ));
}
$kayttaja = putsaaString($_POST["tunnari"]);

if (empty($_POST["ssana"])) {
    naytaNakyma($pohja, $sivu, array(
        'kayttaja' => $kayttaja,
        'virhe' => "Rekisteröityminen epäonnistui! Et antanut salasanaa.",
    ));
}
$salasana = putsaaString($_POST["ssana"]);

if (empty($_POST["ssana_2"])) {
    naytaNakyma($pohja, $sivu, array(
        'kayttaja' => $kayttaja,
        'virhe' => "Rekisteröityminen epäonnistui! Laita salasana molempiin kenttiin.",
    ));
}
$salasana_2 = putsaaString($_POST["ssana_2"]);

/* Tarkistetaan ovatko salasanakentät samoja */
if ($salasana != $salasana_2) {
    naytaNakyma($pohja, $sivu, array(
        'kayttaja' => $kayttaja,
        'virhe' => "Rekisteröityminen epäonnistui! Laita sama salasana kumpaankin niille varattuun kenttään.",
    ));
}

$pupil = Oppilas::etsiOppilasTunnuksilla($kayttaja, $salasana);
$teacher = Opettaja::etsiOpettajaTunnuksilla($kayttaja, $salasana);

if ($pupil || $teacher){
    naytaNakyma($pohja, $sivu, array(
        'kayttaja' => $kayttaja,
        'virhe' => "Rekisteröityminen epäonnistui! Nimi on varattu. Valitse toinen käyttäjätunnus.",
    ));
}

/* Haetaan suurin oppilastunnus */
$lkm = Oppilas::etsiSuurin();

$aika = date('Y-m-d H:i:s');
$oppilas = new Oppilas($lkm + 1, $kayttaja, $salasana, '0', $aika);
    
    if ($oppilas->onkoKelvollinen()) {
        $oppilas->lisaaKantaan($kayttaja, $salasana);
        $_SESSION['kirjautunut'] = serialize($oppilas);  
        $_SESSION['ilmoitus'] = "Tervetuloa, uusi käyttäjä!";
        header('Location: etusivu.php');
    } else {
        $virheet = $sana->getVirheet();
        naytaNakyma($pohja, $sivu, array(
            'oppilas' => $oppilas,
            'virheet' => $virheet,
        ));
    }





