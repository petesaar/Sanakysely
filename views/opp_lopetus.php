<tr>
    <td width="50%">
        <form role="form" method="POST">
            <div class="btn-group">
                <button type="submit" class="btn btn-default" formaction='etusivu.php'">Sanastot</button>
                <button type="submit" class="btn btn-default" formaction='omat_tulokset.php'>Katso tulokset</button>
            </div>
        </form>
    </td>
</tr>
<tr>
    <td  height="40" colspan="3"></td>
</tr>
<tr>
    <td colspan="3">Oppilas <?php echo $kirjautunut->getNimi(); ?>, tentit juuri sanaston nimeltä '<b><?php echo $data->valittu_sanasto->getNimi(); ?>'.</b></td>               
</tr><br>
<tr>
    <td>
        <ul>
            <li>Sanoja yhteensä: <?php echo $data->valittu_sanasto->getMaara(); ?></li>
            <li>Oikein vastatut: <?php echo $data->tiedetyt; ?></li>
            <li>Vääriä vastauksia: <?php echo $data->vaarinVastatut; ?></li>
            <li>Ohitetut: <?php echo $data->ohitetut; ?></li>
        </ul>
    </td>
<br>
<tr>
    <td>Uusin tuloksesi on nyt tallennettu tietokantaan.<br></td>
</tr> 
<br>
<tr>
    <td>Olet kokeillut tätä sanastoa <?php echo $data->monestiko; ?> kertaa ja paras tuloksesi on <?php echo $data->paras; ?> / <?php echo $data->valittu_sanasto->getMaara(); ?>.<br></td>
</tr>  
<tr>
<tr>
    <td width="50%">  
    </td>
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
    <td colspan="3"></td>
</tr>
</table>


