<?php

/* Sanasto on malliluokka, joka huolehtii tietokantayhteyksistä sanasto-tauluun
 * ja tarjoaa metodeja Sanakysely-sovelluksen kontrollereille.
 */
require_once 'libs/tietokantayhteys.php';

class Sanasto {

    private $sanastotunnus;
    private $nimi;
    private $kieli;
    private $kuvaus;
    private $maara;
    private $tehty;
    private $opetunnus;
    private $virheet = array();

    public function getSanastotunnus() {
        return $this->sanastotunnus;
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function getKieli() {
        return $this->kieli;
    }

    public function getMaara() {
        return $this->maara;
    }

    public function getKuvaus() {
        return $this->kuvaus;
    }

    public function getTehty() {
        return $this->tehty;
    }

    public function getOpetunnus() {
        return $this->opetunnus;
    }

    public function setSanastotunnus($sanastotunnus) {
        $this->sanastotunnus = $sanastotunnus;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;

        if (trim($this->nimi) == '' || strlen($this->nimi) > 80) {
            $this->virheet['nimi'] = "Nimi ei saa olla tyhjä eikä siinä saa olla enempää kuin 80 merkkiä.";
        } else {
            unset($this->virheet['nimi']);
        }
    }

    public function setKieli($kieli) {
        $this->kieli = $kieli;

        if (trim($this->kieli) == '' || strlen($this->kieli) > 12) {
            $this->virheet['kieli'] = "Kielivalinta ei saa olla tyhjä eikä siinä saa olla enempää kuin 12 merkkiä.";
        } else {
            unset($this->virheet['kieli']);
        }
    }

    public function setMaara($maara) {
        $this->maara = $maara;
    }

    public function setKuvaus($kuvaus) {
        $this->kuvaus = $kuvaus;

        if (trim($this->kuvaus) == '' || strlen($this->kieli) > 200) {
            $this->virheet['kuvaus'] = "Sanastoon tulee liittyä lyhyt kuvaus eikä siinä saa olla enempää kuin 200 merkkiä.";
        } else {
            unset($this->virheet['kuvaus']);
        }
    }

    public function setTehty($tehty) {
        $this->tehty = $tehty;
    }

    public function setOpetunnus($opetunnus) {
        $this->opetunnus = $opetunnus;
    }

    /* Haetaan kannasta kaikki sanastorivit */
    public static function getKaikkiSanastot() {
        $sql = "SELECT sanastotunnus, nimi, kieli, kuvaus, maara, tehty, opetunnus FROM sanasto ORDER BY nimi";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $sanasto = new Sanasto();

            $sanasto->setSanastotunnus($tulos->sanastotunnus);
            $sanasto->setNimi($tulos->nimi);
            $sanasto->setKieli($tulos->kieli);
            $sanasto->setKuvaus($tulos->kuvaus);
            $sanasto->setMaara($tulos->maara);
            $sanasto->setTehty($tulos->tehty);
            $sanasto->setOpetunnus($tulos->opetunnus);

            $tulokset[] = $sanasto;
        }
        return $tulokset;
    }

    /* Etsitään kannasta sanasto-riviä id:llä */
    public static function etsiSanasto($sanastotunnus) {
        $sql = "SELECT sanastotunnus, nimi, kieli, kuvaus, maara, tehty, opetunnus FROM sanasto WHERE sanastotunnus = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($sanastotunnus));

        $tulos = $kysely->fetchObject();
        if ($tulos->sanastotunnus == null) {
            return null;
        } else {
            $sanasto = new Sanasto();

            $sanasto->setSanastotunnus($tulos->sanastotunnus);
            $sanasto->setNimi($tulos->nimi);
            $sanasto->setKieli($tulos->kieli);
            $sanasto->setKuvaus($tulos->kuvaus);
            $sanasto->setMaara($tulos->maara);
            $sanasto->setTehty($tulos->tehty);
            $sanasto->setOpetunnus($tulos->opetunnus);

            return $sanasto;
        }
    }

    /* Tallennetaan uusi sanasto tietokantaan */
    public function lisaaKantaan() {
        $sql = "INSERT INTO sanasto(sanastotunnus, nimi, kieli, kuvaus, maara, tehty, opetunnus) VALUES(?,?,?,?,?,?,?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getSanastotunnus(), $this->getNimi(), $this->getKieli(), $this->getKuvaus(), $this->getMaara(), date('d/m/Y'), $this->getOpetunnus()));
 
        return $ok;
    }
    
    /* Tallennetaan sanaston muuttuneet tiedot */    
    public function paivitaKantaan() {
        $sql = "UPDATE sanasto SET nimi = ?, kieli = ?, kuvaus= ? WHERE sanastotunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getNimi(), $this->getKieli(), $this->getKuvaus(), $this->getSanastotunnus()));
        
        return $ok;   
    }
    
    /* Tallennetaan sanaston sanojen muuttunut lukumäärä */    
     public function paivitaKantaanLkm($muutos) {
        $sql = "UPDATE sanasto SET maara = ? WHERE sanastotunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getMaara()+$muutos, $this->getSanastotunnus()));
        
        return $ok;   
    } 
    
    /* Poistetaan sanasto */    
    public function poistaKannasta() {
        $sql = "DELETE FROM sanasto WHERE sanastotunnus=?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getSanastotunnus()));
    }

    /* Etsitään suurin sanastotunnus */
    public static function etsiSuurin() {
        $sanastoLista = Sanasto::getKaikkiSanastot();
        $suurin = 0;
        foreach ($sanastoLista as $snsto) {
            if ($snsto->sanastotunnus > $suurin) {
                $suurin = $snsto->sanastotunnus;
            }
        }
        return $suurin;
    }

    /* Palauttaa true, jos Sanastoon syötetyt arvot ovat järkeviä. */
    public function onkoKelvollinen() {
        return empty($this->virheet);
    }

    /* Palauttaa mahdolliset virheet arrayna */
    public function getVirheet() {
        return $this->virheet;
    }

}
