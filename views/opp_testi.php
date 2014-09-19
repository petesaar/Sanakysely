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
    <td colspan="3">Oppilas <?php echo $kirjautunut->getNimi(); ?>, valitse listalta sanasto, jota haluaisit harjoitella:</td>               
</tr>
<tr>
    <td height="40" colspan="3">Huom! <?php echo $data->testikentta; ?></td>
</tr>
<tr>
    <td colspan="3">
        <table width="80%" border="1" cellspacing="0" cellpadding="0">
            <tr>
                <th scope="col">
            <div class="container">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sanasto:</th>
                            <th>Kielet:</th>
                            <th>Sanojen määrä:</th>
                            <th>Luotu:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Tietotekniikka 2</td>
                            <td>eng - suo</td>
                            <td>62</td>
                            <td>6.2.2014</td>
                            <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-hand-up"></span> Tenttaa</button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Matkailu 1</td>
                            <td>ruo - suo</td>
                            <td>34</td>
                            <td>6.2.2014</td>
                            <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-hand-up"></span> Tenttaa</button></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Adjektiivit 1</td>
                            <td>eng - suo</td>
                            <td>100</td>
                            <td>6.2.2014</td>
                            <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-hand-up"></span> Tenttaa</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </th>
        <th scope="col">
        </th>
</tr>
</table></td>
</tr>

