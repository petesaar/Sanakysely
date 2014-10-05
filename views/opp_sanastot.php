<tr>
    <td width="50%">
        <div class="btn-group">
            <button type="button" class="btn btn-default">Sanastot</button>
            <button type="button" class="btn btn-default">Katso tulokset</button>
        </div>
    </td>
</tr>
<tr>
    <td  height="40" colspan="3"></td>
</tr>
<tr>
    <td colspan="3">Oppilas <?php echo $kirjautunut->getNimi(); ?>, valitse listalta sanasto, jota haluaisit harjoitella:</td>               
</tr>
<tr>
    <tr>
    <td><font color="blue">Huom. arvioija! Nyt, viikon 5 palautuksen aikaan, tämän (oppilaan) puolen toiminnot ovat vielä vähän vaiheessa... Kokeilla toki voi.</font> </td>    
</tr>
</tr>
<tr>
    <td height="40" colspan="3">
    
        <?php if (!empty($_SESSION['ilmoitus'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['ilmoitus']; ?>
            </div>
        </td>
        <?php        
        unset($_SESSION['ilmoitus']);
    endif;
    ?>        
 
</tr>
<tr>
    <td colspan="3"><table width="80%" border="1" cellspacing="0" cellpadding="0">
            <tr>
                <th scope="col">
            <div class="pre-scrollable">

                <table class="table table-striped">                                
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sanasto:</th>
                            <th>Kielet:</th>
                            <th>Sanoja:</th>
                            <th>Kuvaus:</th>
                            <th>Tehty:</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach ($data->sanastot as $voc): ?>
                                <td><?php echo $voc->getSanastotunnus(); ?></td>
                                <td><?php echo $voc->getNimi(); ?></td>
                                <td><?php echo $voc->getKieli(); ?></td>
                                <td><?php echo $voc->getMaara(); ?></td>
                                <td><?php echo $voc->getKuvaus(); ?></td>
                                <td><?php echo $voc->getTehty(); ?></td>
                               
                        <form method="GET"> 
                            <td><button type="submit" name="sanastonValintaNappi" value="<?php echo $voc->getSanastotunnus(); ?>" class="btn btn-xs btn-info" formaction="etusivu.php" >Tenttimään</button></td> 
                        </form>                         
                        </tr>
                    <?php endforeach; ?>                                    
                    </tbody>
                </table>

            </div>

        </th>

</tr>
</table></td>
</tr>
</table>