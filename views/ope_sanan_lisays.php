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

                    <input type="text" class="form-control" name = "sananNimi" placeholder="Sana" value="Sana">

                    <input type="text" class="form-control" name = "sananKielet" placeholder="Kielet" value="Kieli">

                    <input type="text" class="form-control" name = "sananKaannos" placeholder="Käännös" value="Kaannos">
<input type="text" class="form-control" name = "sananTaivutus" placeholder="Taivutus" value="Taivutus">
<input type="text" class="form-control" name = "sananSanaluokka" placeholder="Sanaluokka" value="Sluokka">
<input type="text" class="form-control" name = "sananArtikkeli" placeholder="Artikkeli" value="Artikkeli">
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






