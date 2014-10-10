<?php
  require_once 'libs/common.php';
  require 'libs/models/sanasto.php';
  require 'libs/models/opettaja.php';
  require 'libs/models/oppilas.php';
  require 'libs/models/tentti.php';
  
  $pohja = 'ope_pohja.php';
  $sivu = 'ope_tuloksia.php';
  $sanastoLista = Sanasto::getKaikkiSanastot();
  $opet = Opettaja::getKaikkiOpettajat();
  $oppilaat = Oppilas::getKaikkiOppilaat();  
  $teksti = "kokeilu";
  $oppilastunnus = $_SESSION['valittu_oppilas'];
  $oppilas = Oppilas::etsiOppilas($oppilastunnus);

  //Haetaan tiedot kustakin oppilaan tenttimästä sanastosta:
  foreach ($sanastoLista as $voc) {
    $parasTulos[$voc->getSanastotunnus()] = Tentti::getParasTulos($voc->getSanastotunnus(), $oppilastunnus);
    $monestiko[$voc->getSanastotunnus()] = Tentti::getTentitPerSanasto($voc->getSanastotunnus(), $oppilastunnus);
}
  
  naytaNakyma($pohja, $sivu, array(
      'testikentta' => $teksti,
      'sanastot' => $sanastoLista,
      'opet' => $opet,
      'oppilas' => $oppilas,
      'parasTulos' => $parasTulos,
      'monestiko' => $monestiko,
  ));

