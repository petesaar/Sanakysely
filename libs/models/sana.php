<?php

require_once 'libs/tietokantayhteys.php';

class Sana {

    private $sanatunnus;
    private $kohde;
    private $kieli;
    private $kaannos;
    private $taivutus;
    private $sluokka;
    private $artikkeli;
    private $virheet = array();

    public function getSanatunnus() {
        return $this->sanatunnus;
    }

    public function getKohde() {
        return $this->kohde;
    }

    public function getKieli() {
        return $this->kieli;
    }

    public function getKaannos() {
        return $this->kaannos;
    }

    public function getTaivutus() {
        return $this->taivutus;
    }

    public function getSluokka() {
        return $this->sluokka;
    }

    public function getArtikkeli() {
        return $this->artikkeli;
    }

    public function setSanatunnus($sanatunnus) {
        $this->sanatunnus = $sanatunnus;
    }

    public function setKohde($kohde) {
        $this->kohde = $kohde;

        if (trim($this->kohde) == '' || strlen($this->kohde) > 30) {
            $this->virheet['kohde'] = "Kohde ei saa olla tyhjä eikä siinä saa olla enempää kuin 30 merkkiä.";
        } else {
            unset($this->virheet['kohde']);
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

    public function setKaannos($kaannos) {
        $this->kaannos = $kaannos;

        if (trim($this->kaannos) == '' || strlen($this->kaannos) > 30) {
            $this->virheet['kaannos'] = "Kaannosvalinta ei saa olla tyhjä eikä siinä saa olla enempää kuin 30 merkkiä.";
        } else {
            unset($this->virheet['kaannos']);
        }
    }

    public function setTaivutus($taivutus) {
        $this->taivutus = $taivutus;

        if (strlen($this->taivutus) > 50) {
            $this->virheet['taivutus'] = "Taivutusvalinnassa ei saa olla enempää kuin 50 merkkiä.";
        } else {
            unset($this->virheet['taivutus']);
        }
    }

    public function setSluokka($sluokka) {
        $this->sluokka = $sluokka;

        if (trim($this->sluokka) == '' || strlen($this->sluokka) > 15) {
            $this->virheet['sluokka'] = "Sanaluokkavalinta ei saa olla tyhjä eikä siinä saa olla enempää kuin 15 merkkiä.";
        } else {
            unset($this->virheet['sluokka']);
        }
    }

    public function setArtikkeli($artikkeli) {
        $this->artikkeli = $artikkeli;

        if (strlen($this->artikkeli) > 5) {
            $this->virheet['artikkeli'] = "Artikkelivalinnassa ei saa olla enempää kuin 5 merkkiä.";
        } else {
            unset($this->virheet['artikkeli']);
        }
    }

    /* Haetaan kannasta kaikki sana-rivit */

    public static function getKaikkiSanat() {
        $sql = "SELECT sanatunnus, kohde, kieli, kaannos, taivutus, sluokka, artikkeli FROM sana ORDER BY kohde";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {

            $sana = new Sana();

            $sana->setSanatunnus($tulos->sanatunnus);
            $sana->setKohde($tulos->kohde);
            $sana->setKieli($tulos->kieli);
            $sana->setKaannos($tulos->kaannos);
            $sana->setTaivutus($tulos->taivutus);
            $sana->setSluokka($tulos->sluokka);
            $sana->setArtikkeli($tulos->artikkeli);
            $tulokset[] = $sana;
        }
        return $tulokset;
    }

    /* Haetaan kannasta kaikki sana-rivit */

    public static function getSanastonSanat($sanastotunnus) {
        $sql = "SELECT sana.sanatunnus, kohde, sana.kieli, kaannos, taivutus, sluokka, artikkeli FROM kuuluu JOIN sana ON sana.sanatunnus = kuuluu.sanatunnus JOIN sanasto ON sanasto.sanastotunnus = kuuluu.sanastotunnus WHERE kuuluu.sanastotunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($sanastotunnus));        

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {

            $sana = new Sana();
            $sana->setSanatunnus($tulos->sanatunnus);
            $sana->setKohde($tulos->kohde);
            $sana->setKieli($tulos->kieli);
            $sana->setKaannos($tulos->kaannos);
            $sana->setTaivutus($tulos->taivutus);
            $sana->setSluokka($tulos->sluokka);
            $sana->setArtikkeli($tulos->artikkeli);
            $tulokset[] = $sana;
        }
        return $tulokset;
    }
    /* Etsitään suurin sanatunnus */

    public static function etsiSuurin() {
        $sanaLista = Sana::getKaikkiSanat();
        $suurin = 0;
        foreach ($sanaLista as $snsto) {
            if ($snsto->sanatunnus > $suurin) {
                $suurin = $snsto->sanatunnus;
            }
        }
        return $suurin;
    }
 
        /* Tallennetaan uusi sanasto tietokantaan */

    public function lisaaKantaan($sanastoId) {
        
        $sql = "INSERT INTO sana(sanatunnus, kohde, kieli, kaannos, taivutus, sluokka, artikkeli) VALUES(?,?,?,?,?,?,?)";
        $kysely = getTietokantayhteys()->prepare($sql);        
        $ok = $kysely->execute(array($this->getSanatunnus(), $this->getKohde(), $this->getKieli(), $this->getKaannos(), $this->getTaivutus(), $this->getSluokka(), $this->getArtikkeli()));
        
        $sql = "INSERT INTO kuuluu (sanatunnus, sanastotunnus) VALUES(?,?)";
        $kysely = getTietokantayhteys()->prepare($sql);        
        $ok = $kysely->execute(array($this->getSanatunnus(), $sanastoId));
        return $ok;
    }
        /* Palauttaa true, jos Sanaan syötetyt arvot ovat järkeviä. */

    public function onkoKelvollinen() {
        return empty($this->virheet);
    }

    /* Palauttaa mahdolliset virheet arrayna */

    public function getVirheet() {
        return $this->virheet;
    }
}
