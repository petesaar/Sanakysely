<?php
  require_once 'libs/common.php';
  require 'libs/models/sanasto.php';
  
  $pohja = 'opp_pohja.php';
  $sivu = 'opp_sanastot.php';
  $sanastoLista = Sanasto::getKaikkiSanastot();
  //$valittu_sanasto = Sanasto::etsiSanasto($_SESSION['muokattava_sanasto']) ;
  //$sanalista = Sanasto::getSanastonSanat($valittu_sanasto->getSanastotunnus());
  
if (isset($_GET['sanastonValintaNappi'])) {
    $valittu = Sanasto::etsiSanasto($_GET['sanastonValintaNappi']);
    $teksti = $valittu->getKuvaus();
    $_SESSION['muokattava_sanasto'] = $valittu->getSanastotunnus();

    header('Location: kysely.php');
}
  
  naytaNakyma($pohja, $sivu, array(
      'testikentta' => "(Muut painikkeet kuin 'Kirjaudu ulos' eivät toimi vielä!)",
      'sanastot' => $sanastoLista,
  ));
