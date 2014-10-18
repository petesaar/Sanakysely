<tr>
    <td width="50%">
        <form role="form" method="POST">
            <div class="btn-group">
                <button type="submit" class="btn btn-default" formaction='etusivu.php'>Sanastot</button>
                <button type="submit" class="btn btn-default" formaction='omat_tulokset.php'>Katso tulokset</button>
            </div>
        </form>
    </td>
</tr>
<tr>
    <td  height="40" colspan="3"></td>
</tr>
<tr>
    <td colspan="3">Oppilas <?php echo $kirjautunut->getNimi(); ?>, olet valinnut harjoiteltavaksi sanaston nimeltä '<b><?php echo $data->valittu_sanasto->getNimi(); ?>'.</b></td>               
</tr>
<tr>
    <td>Olet kokeillut sitä <?php echo $data->monestiko; ?> kertaa ja paras tuloksesi on <?php echo $data->paras; ?> / <?php echo $data->valittu_sanasto->getMaara(); ?>.<br></td>
</tr>  
<tr>
<tr>
    <td><br>Sanaston kielet ovat <b><?php echo $data->valittu_sanasto->getKieli(); ?></b>. Aloita tentti valitsemalla kyselyn suunta:</td>
</tr>
<tr>
    <td width="50%">  
        <div class="btn-group">
            <br>
            <form method="GET" action="kysely.php"> 
                <div class="btn-group btn-group-lg">
                    <button type="submit" name="suuntaNappi" value="0" class="btn btn-xs btn-info" formaction="kysely.php">Oletussuunta</button>
                    <button type="submit" name="suuntaNappi" value="1" class="btn btn-xs btn-info" formaction="kysely.php">Käänteinen</button>
                </div>
            </form>  
        </div>
    </td>
</tr>
<tr>
    <td height="40" colspan="3"> <br>
        <b>Ohjeita tenttiin:</b><br><br>
        Voit keskeyttää tentin milloin tahansa painamalla <font color='red'>'Lopeta tentti'</font>-painiketta. Tällöin tuloksesi ei tallennu tietokantaan ja palaudut etusivulle.<br>
        Anna vastaus kirjoittamalla se tekstikenttään ja painamalla <font color='blue'>'Vastaa'</font>-painiketta. Jos käännös kelpaa, ohjelma kertoo siitä ja saat pisteen.<br>
        Jos vastaat väärin, ohjelma kertoo myös siitä. Väärin vastaaminen useitakaan kertoja ei vie sinulta pisteitä.<br>
        Jos haluat ohittaa sanan kokonaan, paina <font color='orange'>'Ohita ja näytä vastaus'</font>-painiketta. Tällöin menetät pisteen, mutta ohjelma ei kysy sanaa enää uudelleen.<br>
        Ohjelma arpoo seuraavan kysyttävän sanan jäljellä olevien joukosta. Sana voi olla myös sama kuin se, johon olet juuri vastannut väärin.
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

