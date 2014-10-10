<?php

if (isset($_GET['vastausNappi'])) {
    $vastaus = $_GET['vastausKentta'];
    $tuomio = $rundi->tuomitse($vastaus);
    $seuraavaSana = $rundi->annaSana();
    $tiedetyt = $rundi->getTiedetyt();
    //$rundi->lisaaLaskuria();
    //unset($_POST['vastausNappi']);
    naytaNakyma($pohja, $sivu, array(
        'kysyttava' => $seuraavaSana,
        'valittu_sanasto' => $valittu_sanasto,
        'tuomio' => $tuomio,
        'tiedetyt' => $tiedetyt,
    ));
}