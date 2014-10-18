<?php

/* Kontrolleri opettajan tulossivun näyttämiseen ja muihin toimiin */

  require_once 'libs/common.php';
  require 'libs/models/sanasto.php';
  require 'libs/models/opettaja.php';
  require 'libs/models/oppilas.php';
  require 'libs/models/tentti.php';
  
  $pohja = 'ope_pohja.php';
  $sivu = 'ope_oppilaat.php';
  $sanastoLista = Sanasto::getKaikkiSanastot();
  $opet = Opettaja::getKaikkiOpettajat();
  $oppilaat = Oppilas::getKaikkiOppilaat();  
  $teksti = "kokeilu";
  //Haetaan tieto, montako eri sanastoa kukin oppilas on tenttinyt:
  foreach ($oppilaat as $o){
      $tehdyt[$o->getOppilastunnus()] = Tentti::montakoSanastoaTenttinyt($o->getOppilastunnus());
  }
  
  if (isset($_GET['tiedotNappi'])) {
    $valittu = Oppilas::etsiOppilas($_GET['tiedotNappi']);    
    $_SESSION['valittu_oppilas'] = $_GET['tiedotNappi'];
    header('Location: tulostiedot.php');
  }
  
  naytaNakyma($pohja, $sivu, array(
      'testikentta' => $teksti,
      'sanastot' => $sanastoLista,
      'opet' => $opet,
      'oppilaat' => $oppilaat,
      'tehdyt' => $tehdyt,
  ));


