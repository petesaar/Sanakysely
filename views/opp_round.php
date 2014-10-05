<body>
        <table width="90%" align="center" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="40" colspan="3" scope="col"></td>
            </tr>
            <tr>
                <td colspan="2"><h1>Sanakysely</h1></td>
                <td width="118" align="center">

                </td>
            </tr>
            <tr>
                <td width="277">                    
                </td>
            </tr>
            <tr>
                <td  height="40" colspan="3"></td>
            </tr>
            <tr>
                <td rowspan="2"><h1>TENTTI</h1><br>
                    Sanasto: <?php echo $data->valittu_sanasto->getNimi(); ?>, <?php echo $data->valittu_sanasto->getKieli(); ?><br>
                    Sanoja yhteensä: <?php echo $data->valittu_sanasto->getMaara(); ?><br>
                    Oikein vastatut: x<br>
                    Sanoja jäljellä: x<br>
                </td>
                <td width="661"><h2>SANA: <b><?php echo $data->kysyttava; ?></b></h2></td>
                <td rowspan="2">&nbsp;</td>               
            </tr>
            <tr>
              <td>TUOMIO: <?php echo $data->tuomio; ?><br>
                <br>
              <div class="col-xs-3">
                  <form role="form" method="GET">
                                    <span class="input-group-addon">Vastauksesi:</span>
                                    <input type="text" class="form-control" name="vastausKentta" placeholder="">
                                    
              </div></td>
            </tr>
            <tr>
                <td height="40" colspan="3"></td>
            </tr>
            <tr>
                <td colspan="4"><table width="90%" border="0" align="center" cellpadding="1" cellspacing="1">
                        <td colspan="4">                        
                        
                        <tr>
                            <td width="219"></td>
                            <td width="85"></b></td>
                            <td width="454"><div class="form-group">
                                    

                                    <button type="submit" name="vastausNappi" value="submit" class="btn btn-default" formaction="kysely_2.php">Vastaa</button>
                                    <button type="submit" name="huijausNappi" value="submit" class="btn btn-default" formaction="kysely_2.php">Näytä vastaus</button>
                                    <button type="submit" name="lopetusNappi" value="submit" class="btn btn-default" formaction="kysely_2.php">Lopeta</button>
                                    <button type="submit" name="seuraavaNappi" value="submit" class="btn btn-default" formaction="kysely_2.php">Seuraava</button>
                                    </form>
                                </div></td>
                            <td width="179"></td>
                        </tr>
                        <tr>
                            <td width="219"></td>
                            <td colspan="2">
                              Lisätietoja: (sanaluokka, taivutus...)</td>
                            <td width="179"></td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>

    </body>