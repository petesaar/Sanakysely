<?php

/* Kontrolleri opettajan sanastonmuokkaussivun näyttämiseen ja muihin toimiin */

  require_once 'libs/common.php';
  require 'libs/models/sanasto.php';
  require 'libs/models/sana.php';
  require 'libs/models/opettaja.php';
  
  $pohja = 'ope_pohja.php';
  $sivu = 'ope_sanat.php';
  $sanastoLista = Sanasto::getKaikkiSanastot();
  $opet = Opettaja::getKaikkiOpettajat();
  $valittu_sanasto = Sanasto::etsiSanasto($_SESSION['muokattava_sanasto']) ;
  $sanalista = Sana::getSanastonSanat($valittu_sanasto->getSanastotunnus());  
    
  if (isset($_GET['sananPoistoNappi'])) {
    $valittu = Sana::etsiSana($_GET['sananPoistoNappi']);
    $teksti = $valittu->getKohde();
    $valittu->poistaKannasta();
    $valittu_sanasto->paivitaKantaanLkm('-1');
    $_SESSION['ilmoitus'] = "Sana poistettu onnistuneesti.";
    header('Location: sisallon_muokkaus.php');
    exit(); //jostain syystä vaatii tämän, tai 'ilmoitus'-muuttuja ei toimi kun kontrolleri lataa itsensä uudelleen
  }
  
  if (isset($_GET['sananMuokkausNappi'])) {
    $valittu = Sana::etsiSana($_GET['sananMuokkausNappi']);
    $teksti = $valittu->getKohde();
    $_SESSION['muokattava_sana'] = $valittu->getSanatunnus();
    header('Location: sanan_muutos.php');
  }
  
  if (isset($_GET['sanastonPaivitysNappi'])) {
    $valittu = Sanasto::etsiSanasto($_GET['sanastonPaivitysNappi']);    
    $_SESSION['muutettava'] = $_GET['sanastonPaivitysNappi'];
    header('Location: sanaston_muutos.php');
      
  }  
  
  naytaNakyma($pohja, $sivu, array(      
      'sanastot' => $sanastoLista,
      'opet' => $opet,
      'valittu_sanasto' => $valittu_sanasto,
      'sanat' => $sanalista,
  ));

