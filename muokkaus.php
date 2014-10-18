<?php

/* Kontrolleri opettajan etusivun näyttämiseen ja muihin toimiin */

  require_once 'libs/common.php';
  require 'libs/models/sanasto.php';
  require 'libs/models/opettaja.php';
  
  $pohja = 'ope_pohja.php';
  $sivu = 'ope_sanastot.php';
  $sanastoLista = Sanasto::getKaikkiSanastot();
  $opet = Opettaja::getKaikkiOpettajat();  
  $teksti = "kokeilu";
    
  /* Jos opettaja haluaa poistaa sanaston, eli painaa 'Poista'-nappia */ 
  if (isset($_GET['poistoNappi'])) {
    $valittu = Sanasto::etsiSanasto($_GET['poistoNappi']);
    $teksti = $valittu->getKuvaus();
    $valittu->poistaKannasta();
    $_SESSION['ilmoitus'] = "Sanasto poistettu onnistuneesti.";
    header('Location: muokkaus.php');
    exit(); //jostain syystä vaatii tämän, tai 'ilmoitus'-muuttuja ei toimi kun kontrolleri lataa itsensä uudelleen
  }
  
  /* Jos opettaja haluaa muokata sanastoa, eli painaa 'Muokkaa'-nappia */ 
  if (isset($_GET['muokkausNappi'])) {
    $valittu = Sanasto::etsiSanasto($_GET['muokkausNappi']);
    $teksti = $valittu->getKuvaus();
    $_SESSION['muokattava_sanasto'] = $valittu->getSanastotunnus();    
    header('Location: sisallon_muokkaus.php');
  }
  
  naytaNakyma($pohja, $sivu, array(
      'testikentta' => $teksti,
      'sanastot' => $sanastoLista,
      'opet' => $opet,
  ));

