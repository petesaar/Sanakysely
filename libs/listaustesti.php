
<?php
  require 'libs/tietokantayhteys.php'; 
  require 'libs/kayttaja.php';  
  $sql = "SELECT nimi, salasana from oppilas";
  $kysely = getTietokantayhteys()->prepare($sql); 
  $kysely->execute();

  $haku_olio = $kysely->fetchAll();
  echo $haku_olio[0]['nimi'];
  echo "<br>"; 
  echo $haku_olio[0]['salasana'];
  echo "<br>";
  echo $haku_olio[1]['nimi'];
  echo "<br>";
  echo $haku_olio[1]['salasana'];
  echo "<br>";
  echo $haku_olio[2]['nimi'];
  echo "<br>";
  echo $haku_olio[2]['salasana'];
?>
