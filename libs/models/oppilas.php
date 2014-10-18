<?php

/* Oppilas on malliluokka, joka huolehtii tietokantayhteyksistä oppilas-tauluun
 * ja tarjoaa metodeja Sanakysely-sovelluksen kontrollereille.
 */
require_once 'libs/tietokantayhteys.php';

class Oppilas {

    private $oppilastunnus;
    private $nimi;
    private $salasana;
    private $tehdyt;
    private $viimeksi;
    private $virheet = array();

    /* kuormitettu konstruktori */
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
        
        if (strlen($this->nimi) > 15) {
            $this->virheet['nimi'] = "Nimessä ei saa olla enempää kuin 15 merkkiä.";
        } else {
            unset($this->virheet['nimi']);
        }
    }

    public function setSalasana($salasana) {
        $this->salasana = $salasana;
                
        if (strlen($this->salasana) > 30) {
            $this->virheet['salasana'] = "Salasanassa ei saa olla enempää kuin 30 merkkiä.";
        } else {
            unset($this->virheet['salasana']);
        }
    }

    public function setViimeksi($viimeksi) {
        $this->viimeksi = $viimeksi;
    }

    public function setTehdyt($tehdyt) {
        $this->tehdyt = $tehdyt;
    }

    /* Haetaan kannasta kaikki oppilas-rivit */
    public static function getKaikkiOppilaat() {
        $sql = "SELECT oppilastunnus, nimi, salasana, tehdyt, viimeksi from oppilas ORDER BY oppilastunnus";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $oppilas = new Oppilas($tulos->oppilastunnus, $tulos->nimi, $tulos->salasana, $tulos->tehdyt, $tulos->viimeksi);

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
            $henkilo = new Oppilas($tulos->oppilastunnus, $tulos->nimi, $tulos->salasana, $tulos->tehdyt, $tulos->viimeksi);
            $henkilo->setOppilastunnus($tulos->oppilastunnus);
            $henkilo->setNimi($tulos->nimi);
            $henkilo->setSalasana($tulos->salasana);
            return $henkilo;
        }
    }

    /* Etsitään kannasta oppilas-riviä id:llä */
    public static function etsiOppilas($oppilastunnus) {
        $sql = "SELECT oppilastunnus, nimi, salasana, tehdyt, viimeksi from oppilas where oppilastunnus = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($oppilastunnus));

        $tulos = $kysely->fetchObject();
        if ($tulos->oppilastunnus == null) {
            return null;
        } else {
            $henkilo = new Oppilas($tulos->oppilastunnus, $tulos->nimi, $tulos->salasana, $tulos->tehdyt, $tulos->viimeksi);
            $henkilo->setOppilastunnus($tulos->oppilastunnus);
            $henkilo->setNimi($tulos->nimi);
            $henkilo->setSalasana($tulos->salasana);
            return $henkilo;
        }
    }
    
    /* Etsitään suurin oppilastunnus */
    public static function etsiSuurin() {
        $oppilasLista = Oppilas::getKaikkiOppilaat();
        $suurin = 0;
        foreach ($oppilasLista as $o) {
            if ($o->oppilastunnus > $suurin) {
                $suurin = $o->oppilastunnus;
            }
        }
        return $suurin;
    }

    /* Tallennetaan uusi oppilas tietokantaan */
    public function lisaaKantaan($nimi, $salasana) {

        $sql = "INSERT INTO oppilas(oppilastunnus, nimi, salasana, tehdyt, viimeksi) VALUES(?,?,?,?,?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getOppilastunnus(), $this->getNimi(), $this->getSalasana(), $this->getTehdyt(), $this->getViimeksi()));

        return $ok;
    }
    
    /* Palauttaa true, jos Oppilaaseen syötetyt arvot ovat järkeviä. */
    public function onkoKelvollinen() {
        return empty($this->virheet);
    }

    /* Palauttaa mahdolliset virheet arrayna */
    public function getVirheet() {
        return $this->virheet;
    }
}
