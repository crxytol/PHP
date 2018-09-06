<?php
// require HttpClientHelper file
require_once("./DonneesFacture.php");
require_once("./../HttpClientHelper.php");

function callSaopClient()
{
 try
 {
    // init HttpClientHelper
    $httpClientHelper = new HttpClientHelper;
    // init Soap client helper 
    // @var string full service endpoint
    $httpClientHelper->initSoapClient("http://localhost:60720/Service1.svc?wsdl");

    /**
     * Instance new DonneesFacture
     */
    $donneesFacture = new DonneesFacture;

    /**
     * DonneesFacture Model usage
     * sample model obejct with data from view
     */
    $donneesFacture->referenceclient ="01245";
    $donneesFacture->adresseemail ="mydevcount@gmail.com";
    $donneesFacture->numerotelephone="07385635";
    $donneesFacture->numerocompteclient="0000000023" ;
    $donneesFacture->reglageclient="NaN" ;
    $donneesFacture->puissanceclien = "NaN" ;
    $donneesFacture->usageclient = "NaN" ;
    $donneesFacture->numerofacture = "000005202" ;
    $donneesFacture->regroupementclient = "NaN";
    $donneesFacture->datelimite = "NaN";
    $donneesFacture->datenouvelindex = "NaN";
    $donneesFacture->dateancienindex = "NaN";
    $donneesFacture->consommation = "2500" ;
    $donneesFacture->nouvelindex = "1500" ;
    $donneesFacture->ancienindex = "100" ;
    $donneesFacture->numerocompteur = "000000N01";
    $donneesFacture->nomclient = "Ange Michael" ;
    $donneesFacture->montantfacture = "20036" ;

    $donneesFacture2 = new DonneesFacture;

    $donneesFacture2->referenceclient ="501245";
    $donneesFacture2->adresseemail ="adoalfred07@yahoo.fr";
    $donneesFacture2->numerotelephone="07385635";
    $donneesFacture2->numerocompteclient="0000000" ;
    $donneesFacture2->reglageclient="NaN" ;
    $donneesFacture2->puissanceclien = "15" ;
    $donneesFacture2->usageclient = "20" ;
    $donneesFacture2->numerofacture = "00000015702" ;
    $donneesFacture2->regroupementclient = "NaN";
    $donneesFacture2->datelimite = "12/05/2018";
    $donneesFacture2->datenouvelindex = "12/01/2018";
    $donneesFacture2->dateancienindex = "12/09/2017";
    $donneesFacture2->consommation = "2500" ;
    $donneesFacture2->nouvelindex = "1500" ;
    $donneesFacture2->ancienindex = "900" ;
    $donneesFacture2->numerocompteur = "000000052";
    $donneesFacture2->nomclient = "Ado Alfred" ;
    $donneesFacture2->montantfacture = "10500" ;

    /*
    * Convert object to array
    */
    $donneesFactureArray = (array) $donneesFacture;
    $donneesFacture2Array = (array) $donneesFacture2;

    /*
    * add new array of object donneesFacture to array
    */
    $params = array($donneesFactureArray,$donneesFacture2Array);

    /*
     * Soap client usage
     * @var string Service web method
     * @var array Service web parameters
    */
    $wsResult = $httpClientHelper->Get("EnvoyerFacturesGroupees",$params);
    // result from web service
    return $wsResult;
} 
catch (Exception $e)
{
    return "Caught exception: ".$e->getMessage(). "\n";
}
}



?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Demo , Php Soap CLient!</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1 class="display-4">Php Soap CLient helper, Sample </h1>
                    <p class="lead">Click on Run button to call Soap client</p>

                    <form method="post">
                        <button class="btn btn-primary btn-lg" type="submit" name="test" id="test" value="RUN" >Run</button>
                    </form>
                    <h2>Send : <?php
                    if (array_key_exists('test',$_POST))
                    {
                        print_r(callSaopClient());
                    } ?>
                </h2>

            </div>
        </div>
    </div>
</div>
    

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
