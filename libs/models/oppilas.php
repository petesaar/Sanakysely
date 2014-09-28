<?php
require_once 'libs/tietokantayhteys.php';
class Oppilas {
  
  private $oppilastunnus;
  private $nimi;
  private $salasana;
  private $tehdyt;
  private $viimeksi;

  public function __construct($oppilastunnus, $nimi, $salasana, $tehdyt, $viimeksi) {
    $this->oppilastunnus = $oppilastunnus;
    $this->nimi = $nimi;
    $this->salasana = $salasana;
    $this->tehdyt = $tehdyt;
    $this->viimeksi = $viimeksi;
  }

  public function getOppilastunnus() {
    return $this->oppilastunnus;
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
  
  public function getViimeksi() {
    return $this->viimeksi;
  }

  public function setOppilastunnus($oppilastunnus) {
    $this->oppilastunnus = $oppilastunnus;
  }

  public function setNimi($nimi) {
    $this->nimi = $nimi;
  }

  public function setSalasana($salasana) {
    $this->salasana = $salasana;
  }
  
    public function setViimeksi($viimeksi) {
    $this->viimeksi = $viimeksi;
  }
  
    public function setTehdyt($tehdyt) {
    $this->tehdyt = $tehdyt;
  }
 
/* Haetaan kannasta kaikki oppilas-rivit */
  public function getKaikkiOppilaat() {
      $sql = "SELECT oppilastunnus, nimi, salasana, tehdyt, viimeksi from oppilas ORDER BY oppilastunnus";
      $kysely = getTietokantayhteys()->prepare($sql); 
      $kysely->execute(); 
      
      $tulokset = array();
      foreach($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) { 
       $oppilas = new Oppilas($tulos->oppilastunnus,$tulos->nimi,$tulos->salasana, 
          $tulos->tehdyt, $tulos->viimeksi); 
 
       $tulokset[] = $oppilas; 
     } 
     return $tulokset; 
   }

/* Etsitään kannasta käyttäjäriviä nimellä ja salasanalla */
  public static function etsiOppilasTunnuksilla($kayttaja, $salasana) {
    $sql = "SELECT oppilastunnus, nimi, salasana, tehdyt, viimeksi from oppilas where nimi = ? AND salasana = ? LIMIT 1";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($kayttaja, $salasana));    
    
    $tulos = $kysely->fetchObject();
    if ($tulos == null) {
        
      return null;
    } else {
      $henkilo = new Oppilas($tulos->oppilastunnus,$tulos->nimi,$tulos->salasana, 
          $tulos->tehdyt, $tulos->viimeksi); 
      $henkilo->setOppilastunnus($tulos->oppilastunnus);
      $henkilo->setNimi($tulos->nimi);
      $henkilo->setSalasana($tulos->salasana);
      return $henkilo;
    }
  }
  
  /* Etsitään kannasta oppilas-riviä id:llä*/
   public static function etsiOppilas($oppilastunnus) { 
     $sql = "SELECT oppilastunnus, nimi, salasana, tehdyt, viimeksi from oppilas where oppilastunnus = ? LIMIT 1"; 
    $kysely = getTietokantayhteys()->prepare($sql); 
     $kysely->execute(array($oppilastunnus)); 
      
     $tulos = $kysely->fetchObject(); 
     if ($tulos->oppilastunnus == null) { 
      return null; 
     } else { 
         $henkilo = new Oppilas($tulos->oppilastunnus,$tulos->nimi,$tulos->salasana, 
          $tulos->tehdyt, $tulos->viimeksi); 
      $henkilo->setOppilastunnus($tulos->oppilastunnus);
      $henkilo->setNimi($tulos->nimi);
      $henkilo->setSalasana($tulos->salasana);
      return $henkilo;
     }     
   } 

}