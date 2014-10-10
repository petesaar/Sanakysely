<body>
    <table width="90%" align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td height="40" colspan="3" scope="col"></td>
        </tr>
        <tr>
            <td colspan="2"><h1>Sanakysely</h1></td>
            <td width="118" align="center">

            </td>
        </tr>
        <tr>
            <td width="277">                    
            </td>
        </tr>
        <tr>
            <td  height="40" colspan="3"></td>
        </tr>
        <tr>
            <td rowspan="2"><h1>TENTTI</h1><br>
                <b>Sanasto: <?php echo $data->valittu_sanasto->getNimi(); ?>, <?php echo $data->valittu_sanasto->getKieli(); ?></b><br>
                Sanoja yhteensä: <?php echo $data->valittu_sanasto->getMaara(); ?><br>
                Oikein vastatut: <?php echo $data->tiedetyt; ?><br>
                Ohitetut sanat: <?php echo $data->ohitetut; ?><br>
                Sanoja jäljellä: <?php echo $data->jaljella; ?><br>
            </td>
            
            <td width="661"><h2>SANA: <b><?php echo $data->kysyttava; ?></b></h2>          <?php echo $data->lisuke; ?></td>
            <td rowspan="2"></td>               
        </tr>
        <tr>
            <td>
                <br>

                <div class="col-xs-3">
                    <form role="form" method="POST" action="kysely_2.php">
                        <span class="input-group-addon">Vastauksesi:</span>
                        <input type="text" class="form-control" name="vastausKentta" placeholder="">

                        </div><div><?php echo $data->tuomio; ?></div><br></td>
                        </tr>
                        <tr>
                            <td height="40" colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="4"><table width="90%" border="0" align="center" cellpadding="1" cellspacing="1">
                                    <td colspan="4">                        

                                    <tr>
                                        <td width="219"></td>
                                        <td width="5"></b></td>
                                        <td width="454"><div class="form-group">  
                                                <?php if (empty($_SESSION['ilmoitus'])): ?>
                                                <div class="btn-group btn-group-lg">

                                                    <button type="submit" name="vastausNappi" class="btn btn-xs btn-info">Vastaa</button> 
                                                    <button type="submit" name="ohitusNappi" class="btn btn-xs btn-warning">Ohita ja näytä vastaus</button>
                                                    
                                                    <button type="submit" name="lopetusNappi" class="btn btn-xs btn-danger" formaction='etusivu.php'>Lopeta tentti</button>
                                                    
                                                </div>     
                                                <?php    endif;    ?>        
                                                </form>
                                            </div></td>
                                        <td width="179"></td>
                                    </tr>
                                    <tr>
                                        <td width="219"></td>
                                        <td colspan="2">                                            
                                        <td width="179"></td>
                                    </tr>
<tr>
    <?php if (!empty($_SESSION['ilmoitus'])): ?>
        
    <td width="377" height="40" colspan="3">

        
            <div class="alert alert-danger">
                <?php echo $_SESSION['ilmoitus']; ?><b>'<?php echo $data->kyssari; ?></b>'. Sitä ei enää kysytä tässä tentissä! Huomaa, että jokainen lunttaus vähentää pisteitäsi!<br>
                Oikea vastaus on <b>'<?php echo $data->spoileri; ?>'</b>.
                <div align="left" class="btn-group btn-group-lg">
        <form role="form" method="POST" action="kysely_2.php">
                <button type="submit" name="jatkaNappi" class="btn btn-default">Jatka tenttiä</button> 
                </form></div>
            </div>

    </td>
        <?php
        unset($_SESSION['ilmoitus']);
    endif;
    ?>        

</tr>
                                </table>

                            </td>
                        </tr>
                        </table>

                        </body>