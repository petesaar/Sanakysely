<?php

/* Common tarjoaa yleiskäyttöisiä metodeja kaikille Sanakysely-sovelluksen luokille ja kontrollereille */
session_start();
require_once 'libs/tietokantayhteys.php';

function naytaNakyma($pohja, $sivu, $data = array()) {
    $data = (object) $data;
    require 'views/'.$pohja;    
    exit();
}

/* Tarkistetaan onko oikeuksia sivulle */
function onkoKirjautunut() {
    session_start();

    if (isset($_SESSION['kirjautunut'])) {
        return true;
    } else {
        header('Location: login.php');
        return false;
    }
}

/* Puhdistetaan syötteitä injektion varalta */
function putsaaString($s) { 
     return htmlspecialchars(trim($s)); 
 } 

