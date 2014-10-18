<?php
  
/* Kontrolleri oppilaan tenttisivun näyttämiseen ja muihin toimiin */

  require 'libs/models/sanasto.php';
  require 'libs/models/sana.php';
  require 'libs/models/oppilas.php';
  require 'libs/models/tentti.php';
  require 'kierros.php';  
  require_once 'libs/common.php';
  
  $pohja = 'opp_pohja.php';
  $sivu = 'opp_harjoittelu.php';
  $valittu_sanasto = Sanasto::etsiSanasto($_SESSION['muokattava_sanasto']) ;
  $h = $_SESSION['kirjautunut'];
  $kirjautunut = unserialize($h);
  $oppTunnus = $kirjautunut->getOppilastunnus();
  $monestiko = 0; //kuinka monta kertaa oppilas on tenttinyt kyseistä sanastoa
  $monestiko = Tentti::getTentitPerSanasto($valittu_sanasto->getSanastotunnus(), $oppTunnus);
  $parasTulos = 0; //mikä on toistaiseksi parast tulos valitusta sanastosta
  $parasTulos = Tentti::getParasTulos($valittu_sanasto->getSanastotunnus(), $oppTunnus);
  
  /* Tehdään tarvittavia toimia, kun käyttäjä on valinnut kyselyn suunnan */
  if (isset($_GET['suuntaNappi'])) {
    $valittuSuunta = $_GET['suuntaNappi'];
    $_SESSION['suunta'] = $valittuSuunta;    
    $rundi = new Kierros($valittu_sanasto, $valittuSuunta);
    $rundi->setKierrostunnus(1);
    $rundi->teeListat();
    $_SESSION['kyselyOlio'] = ($rundi);

    header('Location: kysely_2.php');
  }

  naytaNakyma($pohja, $sivu, array(
      'testikentta' => "(Muut painikkeet kuin 'Kirjaudu ulos' eivät toimi vielä!)",
      'valittu_sanasto' => $valittu_sanasto,
      'monestiko' => $monestiko,
      'paras' => $parasTulos,
  ));