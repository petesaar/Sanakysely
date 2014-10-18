<?php

/* Kontrolleri oppilaan tulossivun näyttämiseen ja muihin toimiin */

require_once 'libs/common.php';
require 'libs/models/sanasto.php';
require 'libs/models/oppilas.php';
require 'libs/models/tentti.php';

$pohja = 'opp_pohja.php';
$sivu = 'opp_tulokset.php';
$sanastoLista = array();
$sanastoLista_1 = Sanasto::getKaikkiSanastot();

/* Tarkistetaan ettei listaan päädy sanastoja, joissa ei ole yhtään sanaa
 * Sellaista ei voi antaa oppilaan tentittäviksi! */
foreach ($sanastoLista_1 as $sanasto) {
    if ($sanasto->getMaara() != 0) {
        $sanastoLista[] = $sanasto;
    }
}

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
    'sanastot' => $sanastoLista,
    'parasTulos' => $parasTulos,
    'monestiko' => $monestiko,
));
