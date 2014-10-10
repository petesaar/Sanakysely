<?php

require_once 'libs/tietokantayhteys.php';

class Tentti {

    private $tenttitunnus;
    private $suunta;
    private $tulos;
    private $aika;
    private $oikeinVastatut;
    private $vaarinVastatut;
    private $oppilasTunnus;
    private $sanastoTunnus;

    public function getTenttitunnus() {
        return $this->tenttitunnus;
    }

    public function getSuunta() {
        return $this->suunta;
    }

    public function getTulos() {
        return $this->tulos;
    }

    public function getAika() {
        return $this->aika;
    }

    public function getOikeinVastatut() {
        return $this->oikeinVastatut;
    }

    public function getVaarinVastatut() {
        return $this->vaarinVastatut;
    }
    
    public function getOppilasTunnus() {
        return $this->oppilasTunnus;
    }
     
    public function getSanastoTunnus() {
        return $this->sanastoTunnus;
    }   
    
    public function setTenttitunnus($tenttitunnus) {
        $this->tenttitunnus = $tenttitunnus;
    }

    public function setSuunta($suunta) {
        $this->suunta = $suunta;
    }

    public function setTulos($tulos) {
        $this->tulos = $tulos;
    }

    public function setAika($aika) {
        $this->aika = $aika;
    }

    public function setOikeinVastatut($oikeinVastatut) {
        $this->oikeinVastatut = $oikeinVastatut;
    }

    public function setVaarinVastatut($vaarinVastatut) {
        $this->vaarinVastatut = $vaarinVastatut;
    }
    
    public function setOppilasTunnus($oppilasTunnus) {
        $this->oppilasTunnus = $oppilasTunnus;
    }
     
    public function setSanastoTunnus($sanastoTunnus) {
        $this->sanastoTunnus = $sanastoTunnus;
    } 
    public static function tallennaTentti($tenttitunnus, $suunta, $tulos, $aika, $oikeinVastatut, $vaarinVastatut, $oppilas, $sanasto){
        
        $sql = "INSERT INTO tentti(tenttitunnus, suunta, tulos, aika, oikeinVastatut, vaarinVastatut, oppilastunnus, sanastotunnus) VALUES(?,?,?,?,?,?,?,?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($tenttitunnus, $suunta, $tulos, $aika, $oikeinVastatut, $vaarinVastatut, $oppilas, $sanasto));
 
        return $ok;
    }
    
        /* Haetaan kannasta kaikki tentti-rivit */

    public static function getKaikkiTentit() {
        $sql = "SELECT tenttitunnus, suunta, tulos, aika, oikeinVastatut, vaarinVastatut, oppilastunnus, sanastotunnus FROM tentti ORDER BY tenttitunnus";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {

            $tentti = new Tentti();

            $tentti->setTenttitunnus($tulos->tenttitunnus);
            $tentti->setSuunta($tulos->suunta);
            $tentti->setTulos($tulos->tulos);
            $tentti->setAika($tulos->aika);
            $tentti->setOikeinVastatut($tulos->oikeinVastatut);
            $tentti->setVaarinVastatut($tulos->vaarinVastatut);
            $tentti->setOppilastunnus($tulos->oppilastunnus);
            $tentti->setSanastotunnus($tulos->sanastotunnus);
            $tulokset[] = $tentti;
        }
        return $tulokset;
    }
     
    public static function getOppilaanTentit($oppTunnus) {
        $sql = "SELECT tenttitunnus, suunta, tulos, aika, oikeinVastatut, vaarinVastatut, oppilastunnus, sanastotunnus FROM tentti WHERE oppilastunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($oppTunnus));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {

            $tentti = new Tentti();

            $tentti->setTenttitunnus($tulos->tenttitunnus);
            $tentti->setSuunta($tulos->suunta);
            $tentti->setTulos($tulos->tulos);
            $tentti->setAika($tulos->aika);
            $tentti->setOikeinVastatut($tulos->oikeinVastatut);
            $tentti->setVaarinVastatut($tulos->vaarinVastatut);
            $tentti->setOppilastunnus($tulos->oppilastunnus);
            $tentti->setSanastotunnus($tulos->sanastotunnus);
            $tulokset[] = $tentti;
        }
        return $tulokset;
    }
    
    public static function montakoSanastoaTenttinyt($oppTunnus) {
        $sql = "SELECT count(distinct sanastotunnus) as kpl FROM tentti WHERE oppilastunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($oppTunnus));

        $tulos = $kysely->fetchObject();
        $maara = $tulos->kpl;
        return $maara;
    }
    
    /* Etsitään suurin tenttitunnus */

    public static function etsiSuurin() {
        $tenttiLista = Tentti::getKaikkiTentit();
        $suurin = 0;
        foreach ($tenttiLista as $tnt) {
            if ($tnt->tenttitunnus > $suurin) {
                $suurin = $tnt->tenttitunnus;
            }
        }
        return $suurin;
    }
    
    public static function getTentitPerSanasto($sanastotunnus, $oppTunnus) {
        $sql = "SELECT count(*) as maara FROM tentti WHERE sanastotunnus = ? AND oppilastunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);        
        $kysely->execute(array($sanastotunnus, $oppTunnus));
        $tulos = $kysely->fetchObject();
        $maara = $tulos->maara;
        return $maara;
    }
    
    public static function getParasTulos($sanastotunnus, $oppTunnus) {
        $sql = "SELECT MAX (oikeinVastatut) as paras FROM tentti WHERE sanastotunnus = ? AND oppilastunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);        
        $kysely->execute(array($sanastotunnus, $oppTunnus));
        $tulos = $kysely->fetchObject();
        $paras = $tulos->paras;
        return $paras;
    }
}
