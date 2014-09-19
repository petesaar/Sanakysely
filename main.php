<?php
session_start();
require_once 'libs/models/oppilas.php';
?>
<!DOCTYPE HTML>
<html>
    <head><title>main</title></head>
    <body>
        <h1>main</h1>

        <?php
        $hemmo = $_SESSION['kirjautunut'];
        $kirjoilla = unserialize($hemmo);
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
                <?php echo $kirjoilla->getNimi(); ?>
            </div>
        


    </body>
</html>