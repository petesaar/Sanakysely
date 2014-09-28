<?php
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
    
      naytaNakyma($pohja, $sivu, array(
      'testikentta' => $teksti,
      'sanastot' => $sanastoLista,
      'opet' => $opet,
  ));
  }
  
  if (isset($_GET['sanastonPaivitysNappi'])) {
    $valittu = Sanasto::etsiSanasto($_GET['sanastonPaivitysNappi']);    
    $_SESSION['muutettava'] = $_GET['sanastonPaivitysNappi'];
    header('Location: sanaston_muutos.php');
      
  }  
  
  naytaNakyma($pohja, $sivu, array(
      'testikentta' => $teksti,
      'sanastot' => $sanastoLista,
      'opet' => $opet,
      'valittu_sanasto' => $valittu_sanasto,
      'sanat' => $sanalista,
  ));

