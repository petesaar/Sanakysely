<?php

/* Kontrolleri oppilaan etusivun näyttämiseen ja muihin toimiin */

require_once 'libs/common.php';
require 'libs/models/sanasto.php';
require 'libs/models/oppilas.php';

$pohja = 'opp_pohja.php';
$sivu = 'opp_sanastot.php';
$sanastoLista = array();
$sanastoLista_1 = Sanasto::getKaikkiSanastot();

/* Tarkistetaan ettei listaan päädy sanastoja, joissa ei ole yhtään sanaa
 * Sellaista ei voi antaa oppilaan tentittäviksi! */
foreach ($sanastoLista_1 as $sanasto) {
    if ($sanasto->getMaara() != 0) {
        $sanastoLista[] = $sanasto;
    }
}

/* Jos oppilas valitsee listalta sanaston, siirrytään tenttimään */
if (isset($_GET['sanastonValintaNappi'])) {
    $valittu = Sanasto::etsiSanasto($_GET['sanastonValintaNappi']);
    $teksti = $valittu->getKuvaus();
    $_SESSION['muokattava_sanasto'] = $valittu->getSanastotunnus();

    header('Location: kysely.php');
}

naytaNakyma($pohja, $sivu, array(
    'testikentta' => "",
    'sanastot' => $sanastoLista,
));
