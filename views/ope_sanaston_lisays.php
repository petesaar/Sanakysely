<tr>
    <td width="50%">
        <div class="text-info">
            <h2>Sanaston lisäys</h2>
        </div>
    </td>
</tr> 
<tr>
    <td  height="40" colspan="3"></td>
</tr>
<tr>
    <td colspan="3">Täytä seuraavat kentät uudelle sanastolle:</td>               
</tr>  
<tr>
    <td height="40" colspan="3"></td>
</tr>
<tr>
    <td colspan="3"><table width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th scope="col">
            <form class="form-horizontal" role="form" action="sanaston_lisays.php" method="POST">                   
                <div class="input-group">
                    <div class="input-group">
                        <span class="input-group-addon">Sanaston nimi</span>
                        <input type="text" class="form-control" name = "sanastonNimi" placeholder="Sanaston nimi" value="<?php echo $data->sanasto->getNimi(); ?>">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Sanaston kuvaus</span>
                        <input type="text" class="form-control" name = "sanastonKuvaus" placeholder="Sanaston kuvaus" value="<?php echo $data->sanasto->getKuvaus(); ?>">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Sanaston kielet</span>
                        <input type="text" class="form-control" name = "sanastonKielet" placeholder="Kielet" value="<?php echo $data->sanasto->getKieli(); ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-default" name = "tallennaNappi" >Tallenna sanasto</button>                             
                        </div>
                    </div>
            </form>
        </div>
        <div class="col-md-offset-2 col-md-10">
            <form method="GET"> 
                <button type="submit" name="peruutus" class="btn btn-default" formaction="muokkaus.php" >Peruuta</button> 
            </form>            
        </div>
    </th>
</tr>
</table></td>
</tr>
</table>





