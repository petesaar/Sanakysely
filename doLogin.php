<?php

require_once 'libs/common.php';
require 'libs/models/oppilas.php';
$pohja = 'kirjautumispohja.php';
$sivu = 'kirjautumislomake.php';

if (empty($_POST["tunnari"])) {
    naytaNakyma($pohja, $sivu, array(
        'virhe' => "Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta.",
    ));
}
$kayttaja = $_POST["tunnari"];

if (empty($_POST["ssana"])) {
    naytaNakyma($pohja, $sivu, array(
        'kayttaja' => $kayttaja,
        'virhe' => "Kirjautuminen epäonnistui! Et antanut salasanaa.",
    ));
}
$salasana = $_POST["ssana"];

$henkilo = Oppilas::etsiOppilasTunnuksilla($kayttaja, $salasana);

  if ($henkilo != null) {
  //Tallennetaan istuntoon käyttäjäolio
  $_SESSION['kirjautunut'] = serialize($henkilo);  
  $pohja = 'opp_pohja.php';
  $sivu = 'opp_sanastot.php';
  naytaNakyma($pohja, $sivu, array(
      'testikentta' => "(Muut painikkeet kuin 'Kirjaudu ulos' eivät toimi vielä!)",
  ));
    
} else {
    /* Väärän tunnuksen syöttänyt saa eteensä kirjautumislomakkeen ja virheen. */
    naytaNakyma($pohja, $sivu, array(
        /* Välitetään näkymälle tieto siitä, kuka yritti kirjautumista */
        'kayttaja' => $kayttaja,
        'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä.", request
    ));
}
