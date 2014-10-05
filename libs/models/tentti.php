<?php

require_once 'libs/tietokantayhteys.php';

class Tentti {

    private $tenttitunnus;
    private $suunta;
    private $tulos;
    private $aika;

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
    
}
