<tr>
    <td width="50%">
        <div class="text-info">
            <h2>Sanan lisäys</h2>
        </div>
    </td>
</tr> 
<tr>
    <td  height="40" colspan="3"></td>
</tr>
<tr>
    <td colspan="3">Täytä seuraavat kentät uudelle sanalle:</td>               
</tr>

<tr>
    <td height="40" colspan="3"></td>
</tr>
<tr>
    <td colspan="3"><table width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th scope="col">
            <form class="form-horizontal" role="form" action="sanan_lisays.php" method="POST">                   
                <div class="input-group">
<div class="input-group">
                        <span class="input-group-addon">Sana:</span>
                        <input type="text" class="form-control" name = "sananNimi" placeholder="Pakollinen" value="<?php echo $data->sana->getKohde(); ?>">
                    </div>
<div class="input-group">
                        <span class="input-group-addon">Kielet:</span>
                        <input type="text" class="form-control" name = "sananKielet" placeholder="Pakollinen" value="<?php echo $data->sana->getKieli(); ?>">
                    </div>
<div class="input-group">
                        <span class="input-group-addon">Käännös:</span>
                        <input type="text" class="form-control" name = "sananKaannos" placeholder="Pakollinen" value="<?php echo $data->sana->getKaannos(); ?>">
                    </div>
<div class="input-group">
                        <span class="input-group-addon">Taivutus:</span>
                        <input type="text" class="form-control" name = "sananTaivutus" placeholder="" value="<?php echo $data->sana->getTaivutus(); ?>">
                    </div>
<div class="input-group">
                        <span class="input-group-addon">Sanaluokka:</span>
                        <input type="text" class="form-control" name = "sananSanaluokka" placeholder="Pakollinen" value="<?php echo $data->sana->getSluokka(); ?>">
                    </div>
<div class="input-group">
                        <span class="input-group-addon">Artikkeli:</span>
                        <input type="text" class="form-control" name = "sananArtikkeli" placeholder="" value="<?php echo $data->sana->getArtikkeli(); ?>">
                    </div>
 <br>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-default" name = "tallennaSanaNappi" >Tallenna sana</button>                             
                        </div>
                    </div>

            </form>


        </div>
        <div class="col-md-offset-2 col-md-10">
            <button type="submit" class="btn btn-default" onclick="location.href = 'sisallon_muokkaus.php'">Peruuta</button>
        </div>
    </th>

</tr>
</table></td>
</tr>
</table>






