<?php

require 'libs/models/sanasto.php';
require 'libs/models/sana.php';
require 'libs/models/oppilas.php';
require 'libs/models/tentti.php';
require 'kierros.php';
require_once 'libs/common.php';

$pohja = 'opp_pohja_2.php';
$sivu = 'opp_round.php';
$vastaus = 'joku';
$tuomio = 'ei mitään';
$valittu_sanasto = Sanasto::etsiSanasto($_SESSION['muokattava_sanasto']);
$valittuSuunta = $_SESSION['suunta'];

//$rundi = unserialize($_SESSION['kyselyOlio']);

$rundi = $_SESSION['kyselyOlio'];
$rundi->teeListat();

$seuraavaSana = $rundi->annaSana();  
//$rundi->lisaaLaskuria();

if (isset($_GET['vastausNappi'])) {
    $vastaus = $_GET['vastausKentta'];
    $tuomio = $rundi->tuomitse($vastaus, $rundi->getLaskuri());
    $seuraavaSana = $rundi->annaSana();
    //$rundi->lisaaLaskuria();
    //unset($_POST['vastausNappi']);
    naytaNakyma($pohja, $sivu, array(
        'kysyttava' => $seuraavaSana,
        'valittu_sanasto' => $valittu_sanasto,
        'tuomio' => $tuomio,
    ));
}

naytaNakyma($pohja, $sivu, array(
    'kysyttava' => $seuraavaSana,
    'valittu_sanasto' => $valittu_sanasto,
    'tuomio' => $tuomio,
));
