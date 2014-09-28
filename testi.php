<?php
session_start();
require_once 'libs/models/oppilas.php';
require 'libs/models/sanasto.php';
?>
<!DOCTYPE HTML>
<html>
    <head><title>main</title></head>
    <body>
        <h1>main</h1>

        <?php
        $hemmo = $_SESSION['kirjautunut'];
        $kirjoilla = unserialize($hemmo);
        $id = (int)$_GET['muokkausNappi'];
        $valittu = Sanasto::etsiSanasto($id);
        //$id = (int)$_GET['oppilastunnus'];            
        //echo $id;
        
        //$n = opp::getNimi();
        $opp = Oppilas::getKaikkiOppilaat();
        ?>
        <?php foreach ($opp as $oppilas):
            ?>
            <div>
                Kaikki oppilaat ovat
                <?php echo $oppilas->getNimi(); ?>                
            </div>
        <?php endforeach; ?>
            <div>
                Ja sinä olet 
                <?php foreach ($_GET as $param_name => $param_val) {
    echo "Param: $param_name; Value: $param_val<br />\n";
} ?>
            </div>
            <div>
                Ja valittu sanasto on nro  
                <?php echo $valittu->getNimi(); ?>
            </div>      


    </body>
</html>