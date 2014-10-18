<?php

/* Kontrolleri oppilaan tenttisivun näyttämiseen ja muihin toimiin */

require 'libs/models/sanasto.php';
require 'libs/models/sana.php';
require 'libs/models/oppilas.php';
require 'libs/models/tentti.php';
require 'kierros.php';
require_once 'libs/common.php';

$rundi = $_SESSION['kyselyOlio']; //tämä Kierros-luokan olio napataan kiinni Kysely-sivulta
$pohja = 'opp_pohja_2.php';
$sivu = 'opp_round.php';
$vastaus = 'joku';
$tiedetyt = $rundi->getTiedetyt(); //oikeiden vastausten määrä
$ohitetut = $rundi->getOhitetut(); //ohitettujen sanojen määrä

$valittu_sanasto = Sanasto::etsiSanasto($_SESSION['muokattava_sanasto']);
$valittuSuunta = $_SESSION['suunta']; //mihin suuntaan sanoja kysellään, esim. eng-suo vai suo-eng
$jaljella = $rundi->getKysyttavienMaara();

/* Kun käyttäjä vastaa (tai ohittaa) viimeisen sanan, hän saa eteensä poisNapin */
if (isset($_POST['poisNappi'])) {
    header('Location: kyselyn_tulos.php');
}

/* Jos sanoja ei enää ole kysyttävien listalla, näkymässä herää erillinen skripti */
if ($jaljella == '0') {
    $_SESSION['viimeinen'] = "Kysyttävät sanat ovat loppuneet! ";    
}

/* Kun käyttäjä haluaa keskeyttää koko tentin, eli painaa Lopeta-nappia */
if (isset($_POST['lopetusNappi'])) {
    $_SESSION['keskeytys'] = "Lopetit tentin kesken! Tulosta ei tallennettu tietokantaan!";
    header('Location: etusivu.php');
}

/* Jos käyttäjä on juuri aloittanut tentin, saadaan ensimmäinen sana */
if (!isset($_POST['vastausNappi']) && !isset($_POST['ohitusNappi'])) {
    $seuraavaSana = $rundi->annaSana();
    $lisuke = $rundi->annaLisatieto(); //esim. sanaluokka}
    $tuomio = ''; //tuomio saadaan sitten Kierros-luokalta; väärin vai oikein
    naytaNakyma($pohja, $sivu, array(
        'kysyttava' => $seuraavaSana,
        'valittu_sanasto' => $valittu_sanasto,
        'tuomio' => $tuomio,
        'tiedetyt' => $tiedetyt,
        'jaljella' => $jaljella,
        'lisuke' => $lisuke,
        'ohitetut' => $ohitetut,
        'spoileri' => $spoileri,
    ));
}

/* Kun käyttäjä haluaa ohittaa esitetyn sanan, eli painaa Ohita-nappia */
if (isset($_POST['ohitusNappi'])) {
    $tuomio = '';
    $tiedetyt = $rundi->getTiedetyt();
    list($kyssari, $spoileri) = $rundi->ohitaSana();
    $ohitetut = $rundi->getOhitetut();
    $jaljella = $rundi->getKysyttavienMaara();

    if ($jaljella == '0') {
        $_SESSION['viimeinen'] = "Kysyttävät sanat ovat loppuneet! ";
    }

    unset($_POST['vastausNappi']);

    $_SESSION['ilmoitus'] = "Ohitit sanan ";
    naytaNakyma($pohja, $sivu, array(
        'kysyttava' => $seuraavaSana,
        'valittu_sanasto' => $valittu_sanasto,
        'tuomio' => $tuomio,
        'tiedetyt' => $tiedetyt,
        'jaljella' => $jaljella,
        'lisuke' => $lisuke,
        'ohitetut' => $ohitetut,
        'spoileri' => $spoileri,
        'kyssari' => $kyssari,
    ));
}

/* Kun käyttäjä haluaa vastata esitettyyn sanaan, eli painaa Vastaa-nappia */
if (isset($_POST['vastausNappi'])) {
    $vastaus = $_POST['vastausKentta'];
    $tuomio = $rundi->tuomitse(putsaaString($vastaus));
    $tiedetyt = $rundi->getTiedetyt();
    $ohitetut = $rundi->getOhitetut();
    $jaljella = $rundi->getKysyttavienMaara();
    if ($jaljella == '0') {
        $_SESSION['viimeinen'] = "Kysyttävät sanat ovat loppuneet! ";
    }

    $seuraavaSana = $rundi->annaSana();
    $lisuke = $rundi->annaLisatieto();

    naytaNakyma($pohja, $sivu, array(
        'kysyttava' => $seuraavaSana,
        'valittu_sanasto' => $valittu_sanasto,
        'tuomio' => $tuomio,
        'tiedetyt' => $tiedetyt,
        'jaljella' => $jaljella,
        'lisuke' => $lisuke,
        'ohitetut' => $ohitetut,
        'spoileri' => $spoileri,
    ));
}

