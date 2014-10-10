<?php

require_once 'libs/common.php';
require 'libs/models/oppilas.php';
require 'libs/models/opettaja.php';
$pohja = 'kirjautumispohja.php';
$sivu = 'kirjautumislomake.php';

/* Jos kyseessä on uuden käyttäjän rekisteröityminen: */
if (isset($_POST["rekisterointiNappi"])) {
    header('Location: signUp.php');
}


if (empty($_POST["tunnari"])) {
    naytaNakyma($pohja, $sivu, array(
        'virhe' => "Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta.",
    ));
}
$kayttaja = putsaaString($_POST["tunnari"]);

if (empty($_POST["ssana"])) {
    naytaNakyma($pohja, $sivu, array(
        'kayttaja' => $kayttaja,
        'virhe' => "Kirjautuminen epäonnistui! Et antanut salasanaa.",
    ));
}
$salasana = putsaaString($_POST["ssana"]);

$pupil = Oppilas::etsiOppilasTunnuksilla($kayttaja, $salasana);
$teacher = Opettaja::etsiOpettajaTunnuksilla($kayttaja, $salasana);

  if ($teacher != null) {
  //Tallennetaan istuntoon käyttäjäolio
  $_SESSION['kirjautunut'] = serialize($teacher);    
  header('Location: muokkaus.php');
  
  } elseif ($pupil != null) {      
  //Tallennetaan istuntoon käyttäjäolio
  $_SESSION['kirjautunut'] = serialize($pupil);  
  header('Location: etusivu.php');  
  
} else {
    /* Väärän tunnuksen syöttänyt saa eteensä kirjautumislomakkeen ja virheen. */
    naytaNakyma($pohja, $sivu, array(
        /* Välitetään näkymälle tieto siitä, kuka yritti kirjautumista */
        'kayttaja' => $kayttaja,
        'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.", request
    ));
}

