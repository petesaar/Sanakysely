<?php

session_start();
require_once 'libs/tietokantayhteys.php';

function naytaNakyma($pohja, $sivu, $data = array()) {
    $data = (object) $data;
    require 'views/'.$pohja;    
    exit();
}

function onkoKirjautunut() {
    session_start();

    if (isset($_SESSION['kirjautunut'])) {
        return true;
    } else {
        header('Location: login.php');
        return false;
    }
}
