<tr>
    <td width="50%">
        <form role="form" method="POST">
        <div class="btn-group">

            <button type="button" class="btn btn-default" disabled="disabled">Sanastojen hallinta</button>
            <button type="submit" class="btn btn-default" formaction='oppilaat.php'>Oppilaiden tulokset</button>
        </div>
        </form>
    </td>
</tr> 
<tr>
    <td  height="40" colspan="3"></td>
</tr>
<tr>
    <td colspan="3">Opettaja <?php echo $kirjautunut->getNimi(); ?>, valitse listalta sanasto muokkaamista varten tai luo uusi sanasto:</td>
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
                            <th>Laatija:</th>                                                                        
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
                                <td><?php echo $data->opet[$voc->getOpetunnus()]->getNimi(); ?></td>
                        <form method="GET"> 
                            <td><button type="submit" name="muokkausNappi" value="<?php echo $voc->getSanastotunnus(); ?>" class="btn btn-xs btn-info" formaction="muokkaus.php" >Muokkaa</button></td> 
                        </form> 
                        <form method="GET" onsubmit="return confirm('Haluatko varmasti poistaa sanaston? Operaatiota ei voida enää perua!')"> 
                            <td><button type="submit" name="poistoNappi" value="<?php echo $voc->getSanastotunnus(); ?>" class="btn btn-xs btn-danger" formaction="muokkaus.php" >Poista</button></td> 
                        </form> 
                        </tr>
                    <?php endforeach; ?>                                    
                    </tbody>
                </table>

            </div>

        </th>
        <th scope="col"><td align="center">
            <button type="submit" class="btn btn-default" onclick="location.href = 'sanaston_lisays.php'">Lisää sanasto</button>
        </td>
        </th>
</tr>
</table></td>
</tr>
</table>
