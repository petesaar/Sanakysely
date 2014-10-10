<tr>
    <td width="50%">
        <form role="form" method="POST">
        <div class="btn-group">

            <button type="submit" class="btn btn-default" formaction='muokkaus.php'>Sanastojen hallinta</button>
            <button type="button" class="btn btn-default" disabled="disabled">Oppilaiden tulokset</button>
        </div>
        </form>
    </td>
</tr> 
<tr>
    <td  height="40" colspan="3"></td>
</tr>
<tr>
    <td colspan="3">Opettaja <?php echo $kirjautunut->getNimi(); ?>, valitse listalta oppilas nähdäksesi suoritukset:</td>
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
                            <th>Oppilastunnus:</th>
                            <th>Oppilaan nimi:</th>
                            <th>Tentittyjä sanastoja:</th>                                                                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach ($data->oppilaat as $pup): ?>
                                <td><?php echo $pup->getOppilastunnus(); ?></td>
                                <td><?php echo $pup->getNimi(); ?></td>
                                <td><?php echo $data->tehdyt[$pup->getOppilastunnus()]; ?> kpl</td>                                
                        <form method="GET"> 
                            <td><button type="submit" name="tiedotNappi" value="<?php echo $pup->getOppilastunnus(); ?>" class="btn btn-xs btn-info" formaction="oppilaat.php" >Tarkemmat tiedot</button></td> 
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
