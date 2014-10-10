<?php

require_once 'libs/common.php';
require 'libs/models/sanasto.php';
require 'libs/models/oppilas.php';
require 'libs/models/tentti.php';

$pohja = 'opp_pohja.php';
$sivu = 'opp_tulokset.php';
$sanastoLista = Sanasto::getKaikkiSanastot();
//$valittu_sanasto = Sanasto::etsiSanasto($_SESSION['muokattava_sanasto']);
$h = $_SESSION['kirjautunut'];
$kirjautunut = unserialize($h);
$oppTunnus = $kirjautunut->getOppilastunnus();
$valittu_oppilas = Oppilas::etsiOppilas($oppTunnus);
//$monestiko = Tentti::getTentitPerSanasto($valittu_sanasto->getSanastotunnus(), $oppTunnus);

//Haetaan tiedot kustakin oppilaan tenttimästä sanastosta:
foreach ($sanastoLista as $voc) {
    $parasTulos[$voc->getSanastotunnus()] = Tentti::getParasTulos($voc->getSanastotunnus(), $oppTunnus);
    $monestiko[$voc->getSanastotunnus()] = Tentti::getTentitPerSanasto($voc->getSanastotunnus(), $oppTunnus);
}

naytaNakyma($pohja, $sivu, array( 
    'testikentta' => "(Muut painikkeet kuin 'Kirjaudu ulos' eivät toimi vielä!)",
    'sanastot' => $sanastoLista,
    'parasTulos' => $parasTulos,
    'monestiko' => $monestiko,
));
