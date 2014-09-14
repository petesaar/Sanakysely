<?php
$yhteys = new PDO("pgsql:");
$yhteys->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//Alustetaan muuttuja jossa on Select-kysely, joka palauttaa lukuarvon:
$sqlkysely = "SELECT 1+1 as two";

//Pyydet��n PDO-yhteysoliota k�sittelem��n SQL-muotoinen kysely.
//Huom! PHP:ss� k�ytet��n syntaksia $olio->metodi(); metodien kutsumiseen.
$kysely = $yhteys->prepare($sqlkysely);


if ($kysely->execute()) {
  //Tulos-muuttujan arvoksi pit�isi tulla numero kaksi.
  $tulos = $kysely->fetchColumn();

  //var_dump tulostaa muuttujan tyypin ja arvon k�ytt�j�lle:
  var_dump($tulos);
}


