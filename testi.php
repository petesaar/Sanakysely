<?php
require_once 'libs/models/oppilas.php';

  $tervehdys = "tässolis ny php-sivu";
  $ja = "1234567!"#¤%"; 
          
?><!DOCTYPE HTML>
<html>
<head><title><?php echo $tervehdys; ?></title></head>
<body>
  <h1><?php echo $tervehdys; ?></h1>
  <?php echo $ja; ?>
  <?php
  //$kayttaja = new Oppilas('0', 'joku', 'passu');
  echo 'Käyttäjä: ';
  echo $kayttaja;
  ?>
</body>
</html>