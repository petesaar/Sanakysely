<?php
  require_once 'libs/common.php';
  
  $pohja = 'opp_pohja.php';
  $sivu = 'opp_sanastot.php';

  naytaNakyma($pohja, $sivu, array(
      'testikentta' => "(Muut painikkeet kuin 'Kirjaudu ulos' eivät toimi vielä!)",
  ));