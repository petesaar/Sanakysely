<?php
  
  require 'libs/models/sanasto.php';
  require 'libs/models/sana.php';
  require 'libs/models/oppilas.php';
  require 'libs/models/tentti.php';
  require 'kierros.php';  
  require_once 'libs/common.php';
  
  $pohja = 'opp_pohja.php';
  $sivu = 'opp_harjoittelu.php';
  $valittu_sanasto = Sanasto::etsiSanasto($_SESSION['muokattava_sanasto']) ;
  
  if (isset($_GET['suuntaNappi'])) {
    $valittuSuunta = $_GET['suuntaNappi'];
    $_SESSION['suunta'] = $valittuSuunta;    
    $rundi = new Kierros($valittu_sanasto, $valittuSuunta);
    $_SESSION['kyselyOlio'] = ($rundi);
    //$rundi ->teeListat();
    //$rundi ->teeTesti();
    header('Location: kysely_2.php');
    //$teksti = $valittu->getKohde();
    //$_SESSION['muokattava_sana'] = $valittu->getSanatunnus();
    //header('Location: sanan_muutos.php');
    //$pohja = 'opp_pohja_2.php';
    //$sivu = 'opp_round.php';
      //naytaNakyma($pohja, $sivu, array(
      //'testikentta' => $valittuSuunta,
      //'valittu_sanasto' => $valittu_sanasto,
      //'sanastot' => $sanastoLista,
      //'opet' => $opet,
  //));
  }

  naytaNakyma($pohja, $sivu, array(
      'testikentta' => "(Muut painikkeet kuin 'Kirjaudu ulos' eivät toimi vielä!)",
      'valittu_sanasto' => $valittu_sanasto,
  ));