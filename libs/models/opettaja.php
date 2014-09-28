<?php
require_once 'libs/tietokantayhteys.php';
class Opettaja {
  
  private $opettajatunnus;
  private $nimi;
  private $salasana;
  private $tehdyt;  

  public function __construct($opettajatunnus, $nimi, $salasana, $tehdyt) {
    $this->opettajatunnus = $opettajatunnus;
    $this->nimi = $nimi;
    $this->salasana = $salasana;
    $this->tehdyt = $tehdyt;
  }

  public function getOpettajatunnus() {
    return $this->opettajatunnus;
  }

  public function getNimi() {
    return $this->nimi;
  }

  public function getSalasana() {
    return $this->salasana;
  }

  public function getTehdyt() {
    return $this->tehdyt;
  }
  
  public function setOpettajatunnus($opettajatunnus) {
    $this->opettajatunnus = $opettajatunnus;
  }

  public function setNimi($nimi) {
    $this->nimi = $nimi;
  }

  public function setSalasana($salasana) {
    $this->salasana = $salasana;
  }
  
  public function setTehdyt($tehdyt) {
    $this->tehdyt = $tehdyt;
  }

  /* Etsitään kannasta opettaja-riviä id:llä*/
     public static function etsiOpe($opettajatunnus) { 
     $sql = "SELECT opettajatunnus, nimi, salasana, tehdyt from opettaja where opettajatunnus = ? LIMIT 1"; 
    $kysely = getTietokantayhteys()->prepare($sql); 
     $kysely->execute(array($opettajatunnus)); 
      
     $tulos = $kysely->fetchObject(); 
     if ($tulos->opettajatunnus == null) { 
      return null; 
     } else { 
         $henkilo = new Opettaja($tulos->opettajatunnus,$tulos->nimi,$tulos->salasana, 
          $tulos->tehdyt); 
      $henkilo->setOpettajatunnus($tulos->opettajatunnus);
      $henkilo->setNimi($tulos->nimi);
      $henkilo->setSalasana($tulos->salasana);
      return $henkilo;
     }     
   } 

   /* Etsitään kannasta käyttäjätunnuksella ja salasanalla käyttäjäriviä */
  public static function etsiOpettajaTunnuksilla($kayttaja, $salasana) {
    $sql = "SELECT opettajatunnus, nimi, salasana, tehdyt from opettaja where nimi = ? AND salasana = ? LIMIT 1";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($kayttaja, $salasana));    
    
    $tulos = $kysely->fetchObject();
    if ($tulos == null) {
        
      return null;
    } else {
         $henkilo = new Opettaja($tulos->opettajatunnus,$tulos->nimi,$tulos->salasana, 
          $tulos->tehdyt); 
      $henkilo->setOpettajatunnus($tulos->opettajatunnus);
      $henkilo->setNimi($tulos->nimi);
      $henkilo->setSalasana($tulos->salasana);
      return $henkilo;
    }
  }  
   
/* Haetaan kannasta kaikki opettaja-rivit */
  public static function getKaikkiOpettajat() {
      $sql = "SELECT opettajatunnus, nimi, salasana, tehdyt from opettaja";
      $kysely = getTietokantayhteys()->prepare($sql); 
      $kysely->execute(); 
      
      $tulokset = array();
      foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) { 
       $opettaja = new Opettaja($tulos->opettajatunnus,$tulos->nimi,$tulos->salasana, 
          $tulos->tehdyt); 
 
       $tulokset[] = $opettaja; 
     } 
     return $tulokset; 
   }
}