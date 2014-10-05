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
    <td colspan="3">Oppilas <?php echo $kirjautunut->getNimi(); ?>, olet valinnut harjoiteltavaksi sanaston nimeltä '<b><?php echo $data->valittu_sanasto->getNimi(); ?>'.</b></td>               
</tr>
<tr>
    <td>Olet kokeillut sitä n kertaa ja paras tuloksesi on x / <?php echo $data->valittu_sanasto->getMaara(); ?><br></td>
</tr>  
<tr>

<tr>

    <td><br>Sanaston kielet ovat <?php echo $data->valittu_sanasto->getKieli(); ?>. Aloita tentti valitsemalla kyselyn suunta:</td>

</tr>

<tr>

    <td width="50%">  
        <div class="btn-group">
            <br>

            <form method="GET" action="kysely.php"> 
                <button type="submit" name="suuntaNappi" value="0" class="btn btn-default" formaction="kysely.php">Oletussuunta</button>
                <button type="submit" name="suuntaNappi" value="1" class="btn btn-default" formaction="kysely.php">Käänteinen</button>
            </form>  
        </div>
    </td>
</tr>

<td height="40" colspan="3">Huom! <?php echo $data->testikentta; ?></td>
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

