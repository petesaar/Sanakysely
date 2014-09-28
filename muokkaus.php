<?php
  require_once 'libs/common.php';
  require 'libs/models/sanasto.php';
  require 'libs/models/opettaja.php';
  
  $pohja = 'ope_pohja.php';
  $sivu = 'ope_sanastot.php';
  $sanastoLista = Sanasto::getKaikkiSanastot();
  $opet = Opettaja::getKaikkiOpettajat();
  //$valittu = Sanasto::etsiSanasto(0);
  $teksti = "kokeilu";
    
  if (isset($_GET['poistoNappi'])) {
    $valittu = Sanasto::etsiSanasto($_GET['poistoNappi']);
    $teksti = $valittu->getKuvaus();
    $valittu->poistaKannasta();
    $_SESSION['ilmoitus'] = "Sanasto poistettu onnistuneesti.";
    header('Location: muokkaus.php');
  }
  
  if (isset($_GET['muokkausNappi'])) {
    $valittu = Sanasto::etsiSanasto($_GET['muokkausNappi']);
    $teksti = $valittu->getKuvaus();
    $_SESSION['muokattava_sanasto'] = $valittu->getSanastotunnus();
    //$muokattava_sanasto = $valittu->getSanastotunnus();
    header('Location: sisallon_muokkaus.php');
      //naytaNakyma($pohja, $sivu, array(
      //'testikentta' => $teksti,
      //'sanastot' => $sanastoLista,
      //'opet' => $opet,
  //));
  }
  
  naytaNakyma($pohja, $sivu, array(
      'testikentta' => $teksti,
      'sanastot' => $sanastoLista,
      'opet' => $opet,
  ));

