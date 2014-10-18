<tr>
    <td width="50%">
        <form role="form" method="POST">
            <div class="btn-group">
                <button type="submit" class="btn btn-default" formaction='etusivu.php'>Sanastot</button>
                <button type="button" class="btn btn-default" disabled="disabled">Katso tulokset</button>
            </div>
        </form>
    </td>
</tr>
<tr>
    <td  height="40" colspan="3"></td>
</tr>
<tr>
    <td colspan="3">Oppilas <?php echo $kirjautunut->getNimi(); ?>, tässä ovat aikaisempien tenttiesi tulokset:</td>               
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
                            <th>#</th>
                            <th>Sanasto:</th>
                            <th>Kielet:</th>
                            <th>Yrityksiä:</th>
                            <th>Sanoja:</th>                            
                            <th>Paras tulos:</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach ($data->sanastot as $voc): ?>
                                <td><?php echo $voc->getSanastotunnus(); ?></td>
                                <td><?php echo $voc->getNimi(); ?></td>
                                <td><?php echo $voc->getKieli(); ?></td>
                                <td><?php echo $data->monestiko[$voc->getSanastotunnus()]; ?></td>
                                <td><?php echo $voc->getMaara(); ?></td>                                
                                <td><?php echo $data->parasTulos[$voc->getSanastotunnus()]; ?></td>                        
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