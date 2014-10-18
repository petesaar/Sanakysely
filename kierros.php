<?php

require_once 'libs/tietokantayhteys.php';

/* Kierros on apuluokka, jota käytetään oppilaan tentin yhteydessä. Kontrollerissa Kysely luodaan
 * $rundi-niminen olio parametrinä annettujen $sanaston ja $suunnan mukaisesti. $rundi välitetään
 * Kysely-2 -kontrollerille, joka käyttää Kierroksen metodeja kyselyn toteuttamiseen.
 */

class Kierros {

    private $kierrostunnus;
    private $sanasto;
    private $oppilas;
    private $tulos = 0;
    private $suunta;
    private $laskuri = 0;
    private $oikeinVastatut = 0;
    private $vaarinVastatut = 0;
    private $kysyttavat = array();
    private $vastaukset = array();
    private $sanaluokka = array();
    private $tiedetyt = 0;
    private $ohitetut = 0;
    private $nro;
    private $kysyttavienMaara = 0;
    public static $lisatieto;

    public function __construct($sanasto, $suunta) {
        $this->sanasto = $sanasto;
        $this->suunta = $suunta;
    }

    public function getKierrostunnus() {
        return $this->kierrostunnus;
    }

    public function getSuunta() {
        return $this->suunta;
    }

    public function getOikeinVastatut() {
        return $this->oikeinVastatut;
    }

    public function getVaarinVastatut() {
        return $this->vaarinVastatut;
    }

    public function getTulos() {
        return $this->tulos;
    }

    public function getLaskuri() {
        return $this->laskuri;
    }

    public function getNro() {
        return $this->nro;
    }

    public function getTiedetyt() {
        return $this->tiedetyt;
    }

    public function getOhitetut() {
        return $this->ohitetut;
    }

    public function getSanaluokka($nro) {
        return $this->sanaluokka[$nro];
    }

    public function getKysyttavienMaara() {
        $m = count($this->kysyttavat);
        return $m;
    }

    public function setKierrostunnus($kierrostunnus) {
        $this->kierrostunnus = $kierrostunnus;
    }

    public function setSuunta($suunta) {
        $this->suunta = $suunta;
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

    public function setNro($nro) {
        $this->nro = $nro;
    }

    public function setTiedetyt($tiedetyt) {
        $this->tiedetyt = $tiedetyt;
    }

    public function setOhitetut($ohitetut) {
        $this->ohitetut = $ohitetut;
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
            $this->sanaluokka[] = $sana->getSluokka();
        }
    }

    public function lisaaLaskuria() {
        $this->laskuri++;
    }

    /* Arvotaan seuraava sana jäljellä olevien listasta */
    public function annaSana() {        
        $k = array_rand($this->kysyttavat);
        $this->setNro($k);
        $v = $this->kysyttavat[$k];
        Kierros::$lisatieto = $this->getSanaluokka($k);        
        return $v;
    }
    
    /* sanaan liittyviä lisätietoja, tässä versiossa sanaluokka */
    public function annaLisatieto() {
        return Kierros::$lisatieto;
    }

    /* Tutkitaan onko käyttäjän antama vastaus kelvollinen. Jos on, poistetaan sana kysyttävien listalta.
     * (Huom. Tiedän, että kontrollereissa *ei pitäisi* käsitellä HTML:ää! Tein nyt niin tässä metodissa vain kokeilun vuoksi...)
     */
    public function tuomitse($vastaus) {
        $q = 'Onko sanan "' . $this->kysyttavat[$this->nro] . '"' . ' käännös ' . '"' . $vastaus . '"' . '?  ';
        if ($vastaus == $this->vastaukset[$this->nro]) {
            array_splice($this->kysyttavat, $this->nro, 1);
            array_splice($this->vastaukset, $this->nro, 1);
            $this->tiedetyt++;
            $this->setOikeinVastatut($this->tiedetyt);
            return $q . "<br><font color='green' size='6'>   Oikein :-)</font>";
        } else {
            $this->vaarinVastatut++;
            return $q . "<br><font color='red' size='6'>   Väärin :-(</font>";
        }
    }

    /* Kun oppilas painaa ohita-painiketta, eli ei halua ruveta arvailemaan sanaa jota ei tiedä */
    public function ohitaSana() {
        $this->ohitetut++;
        $kyssari = $this->kysyttavat[$this->nro];
        $spoileri = $this->vastaukset[$this->nro];
        array_splice($this->kysyttavat, $this->nro, 1);
        array_splice($this->vastaukset, $this->nro, 1);

        return array($kyssari, $spoileri);
    }

    /* Kyselyn päätyttyä tallennetaan tulos Tentti-malliluokan avulla */
    public function tallennaTentti() {
        Tentti::tallennaTentti();
    }

    /*
    public static function etsiSuurin() {
        $kierrosLista = Sana::getKaikkiSanat();
        $suurin = 0;
        foreach ($sanaLista as $snsto) {
            if ($snsto->sanatunnus > $suurin) {
                $suurin = $snsto->sanatunnus;
            }
        }
        return $suurin;
    }
*/
}
