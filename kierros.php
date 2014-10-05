<?php

require_once 'libs/tietokantayhteys.php';

class Kierros {

    private $kierrostunnus;
    private $sanasto;
    private $oppilas;
    private $tulos = 0;
    private $suunta;
    private $laskuri = 0;
    private $oikeinVastatut = 0;
    private $kysyttavat = array();
    private $vastaukset = array();

    public function getKierrostunnus() {
        return $this->kierrostunnus;
    }

    public function getOikeinVastatut() {
        return $this->oikeinVastatut;
    }

    public function getTulos() {
        return $this->tulos;
    }

    public function getLaskuri() {
        return $this->laskuri;
    }

    public function setKierrostunnus($kierrostunnus) {
        $this->kierrostunnus = $kierrostunnus;
    }

    public function setOikeinVastatut($oikeinVastatut) {
        $this->oikeinVastatut = $oikeinVastatut;
    }

    public function setTulos($tulos) {
        $this->tulos = $tulos;
    }

    public function setLaskuri($laskuri) {
        $this->laskuri = $laskuri;
    }

    public function __construct($sanasto, $suunta) {
        $this->sanasto = $sanasto;
        $this->suunta = $suunta;
    }

    /* Metodi muodostaa kysyttävien sanojen ja vastausten luettelot valitusta sanastosta */

    public function teeListat() {
        $sanalista = Sana::getSanastonSanat($this->sanasto->getSanastotunnus());
        foreach ($sanalista as $sana) {
            if ($this->suunta == '0') {
                $this->kysyttavat[] = $sana->getKohde();
                $this->vastaukset[] = $sana->getKaannos();
            }
            if ($this->suunta == '1') {
                $this->vastaukset[] = $sana->getKohde();
                $this->kysyttavat[] = $sana->getKaannos();
            }
        }
    }

    public function lisaaLaskuria() {
        $this->laskuri++;
    }

    public function annaSana() {
        $moneskoSana = $this->getLaskuri();
        $this->lisaaLaskuria();
        return $this->kysyttavat[$moneskoSana];
    }

    public function tuomitse($vastaus, $nro) {
        if ($vastaus == $this->vastaukset[$nro-2]) {
            return "oikea vastaus";
        } else {
            return "väärä vastaus";
        }
    }



}
