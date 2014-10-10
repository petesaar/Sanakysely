<form class="form-horizontal" role="form" action="doSignUp.php" method="POST">
    <div class="form-group form-group-lg">
        <div class="row">

            <label for="inputTunnus" class="col-xs-2 control-label">Käyttäjätunnus</label>

            <div class="col-xs-2">
                <input type="text" class="form-control" id="inputTunnus" name="tunnari" value="<?php echo $data->kayttaja; ?>">
            </div>

        </div>
        <br>
        <div class="form-group">
            <label for="inputSalasana" class="col-xs-2 control-label">Salasana</label>

            <div class="col-xs-2">
                <input type="password" class="form-control" id="inputSsana" name="ssana" placeholder="Salasana">
            </div>

        </div>        
        <div class="form-group">
            <label for="inputSalasana" class="col-xs-2 control-label">Salasana uudelleen</label>

            <div class="col-xs-2">
                <input type="password" class="form-control" id="inputSsana_2" name="ssana_2" placeholder="Varmistus">
            </div>

        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">                
                <button type="submit" name="rekisterointiNappi" value="rekisterointi" class="btn btn-default">Rekisteröidy</button>
            </div>
        </div>
    </div>  
</form>


