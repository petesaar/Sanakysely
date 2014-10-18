<?php
  
/* Kontrolleri oppilaan juuri suoritetun tentin tulosten näyttämiseen ja muihin toimiin */

  require 'libs/models/sanasto.php';
  require 'libs/models/sana.php';
  require 'libs/models/oppilas.php';
  require 'libs/models/tentti.php';
  require 'kierros.php';    
  require_once 'libs/common.php';
  
  $rundi = $_SESSION['kyselyOlio']; //tämä Kierros-luokan olio napataan kiinni Kysely_2-sivulta
  $pohja = 'opp_pohja.php';
  $sivu = 'opp_lopetus.php';
  $valittu_sanasto = Sanasto::etsiSanasto($_SESSION['muokattava_sanasto']);
  $h = $_SESSION['kirjautunut'];
  $kirjautunut = unserialize($h);
  $oppTunnus = $kirjautunut->getOppilastunnus();
  $valittu_oppilas = Oppilas::etsiOppilas($oppTunnus);
  $aika = date('Y-m-d H:i:s');  
  
  $tiedetyt = $rundi->getTiedetyt();
  $ohitetut = $rundi->getOhitetut();
  $vaarinVastatut = $rundi->getVaarinVastatut();
  $lkm = Tentti::etsiSuurin();
  $tallennus = Tentti::tallennaTentti($lkm+1, $rundi->getSuunta(), $rundi->getTulos(), $aika, $rundi->getOikeinVastatut(), $rundi->getVaarinVastatut(), $oppTunnus, $valittu_sanasto->getSanastotunnus());
  $monestiko = Tentti::getTentitPerSanasto($valittu_sanasto->getSanastotunnus(), $oppTunnus);
  $parasTulos = Tentti::getParasTulos($valittu_sanasto->getSanastotunnus(), $oppTunnus);
  
  naytaNakyma($pohja, $sivu, array(
      'testikentta' => "(Muut painikkeet kuin 'Kirjaudu ulos' eivät toimi vielä!)",
      'valittu_sanasto' => $valittu_sanasto,
      'tiedetyt' => $tiedetyt,
      'ohitetut' => $ohitetut,
      'vaarinVastatut' => $vaarinVastatut,
      'monestiko' => $monestiko,
      'paras' => $parasTulos,
  ));
