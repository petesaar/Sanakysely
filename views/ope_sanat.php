<tr>
    <td width="50%">
        <form role="form" method="POST">
        <div class="btn-group">

            <button type="submit" class="btn btn-default" formaction='muokkaus.php'>Sanastojen hallinta</button>
            <button type="submit" class="btn btn-default" formaction='oppilaat.php'>Oppilaiden tulokset</button>
        </div>
        </form>
    </td>
</tr> 
<tr>
    <td  height="40" colspan="3"></td>
</tr>
<tr>
    <td>Opettaja <?php echo $kirjautunut->getNimi(); ?>, olet valinnut muokattavaksi sanaston <b>nro <?php echo $data->valittu_sanasto->getSanastotunnus(); ?></b>, nimeltään <b><?php echo $data->valittu_sanasto->getNimi(); ?></b>.Voit muuttaa sen tietoja painamalla oheista nappia.  
    <td align="left""><form method="GET"><button type="submit" name="sanastonPaivitysNappi" value="<?php echo $data->valittu_sanasto->getSanastotunnus(); ?>" class="btn btn-xs btn-info" formaction="sisallon_muokkaus.php" >Päivitä tiedot</button></form>
    </td></td> 
<tr><br>
    <td>Tällä hetkellä sanastoon kuuluvat alla listatut sanat. Voit poistaa tai muokata niitä ja lisätä uusia sanoja:</td>    
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
        // Samalla kun viesti näytetään, se poistetaan istunnosta,
        // ettei se näkyisi myöhemmin jollain toisella sivulla uudestaan.
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
                            <th>Sana:</th>
                            <th>Kielet:</th>
                            <th>Käännös:</th>
                            <th>Taivutus:</th>
                            <th>Sanaluokka:</th>        
                            <th>Artikkeli:</th>                                                                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach ($data->sanat as $word): ?>
                                <td><?php echo $word->getSanatunnus(); ?></td>
                                <td><?php echo $word->getKohde(); ?></td>
                                <td><?php echo $word->getKieli(); ?></td>
                                <td><?php echo $word->getKaannos(); ?></td>
                                <td><?php echo $word->getTaivutus(); ?></td>
                                <td><?php echo $word->getSluokka(); ?></td>
                                <td><?php echo $word->getArtikkeli(); ?></td>
                        <form method="GET"> 
                            <td><button type="submit" name="sananMuokkausNappi" value="<?php echo $word->getSanatunnus(); ?>" class="btn btn-xs btn-info" formaction="sisallon_muokkaus.php" >Muokkaa</button></td> 
                        </form> 
                        <form method="GET" onsubmit="return confirm('Haluatko varmasti poistaa sanan?')"> 
                            <td><button type="submit" name="sananPoistoNappi" value="<?php echo $word->getSanatunnus(); ?>" class="btn btn-xs btn-danger" formaction="sisallon_muokkaus.php" >Poista</button></td> 
                        </form> 
                        </tr>
                    <?php endforeach; ?>                                    
                    </tbody>
                </table>

            </div>

        </th>
        <th scope="col"><td align="center">
            <button type="submit" class="btn btn-default" onclick="location.href = 'sanan_lisays.php'">Lisää sana</button>
        </td>
        </th>
</tr>
</table></td>
</tr>
</table>

