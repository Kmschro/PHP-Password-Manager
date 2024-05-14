      <!DOCTYPE html>

<?php
require_once( 'LoginDataModel.php' );

if( !isset( $_SESSION ) )
  {
    session_start();
  }

  if( !isset( $_SESSION[LoginDataModel::USERNAME_KEY ] ) ) 
  {
     include( 'login.php' );
     
     exit();
  }
  
  require_once( 'FxDataModel.php' );
  
  if( isset( $_SESSION[ FxDataModel::FX_DATA_MODEL_KEY ] ) )
  {
    $fxDataModel = unserialize( $_SESSION[ FxDataModel::FX_DATA_MODEL_KEY ] );
  }
  else
  {
    $fxDataModel = new FxDataModel();
  
    $_SESSION[ FxDataModel::FX_DATA_MODEL_KEY ] = serialize( $fxDataModel );
  }
  

$iniArray = $fxDataModel->getIniArray();
$currencies = $fxDataModel->getFxCurrencies();


$resultVal = $iniArray[FxDataModel::RESULT_KEY];
$amountVal = $iniArray[FxDataModel::AMOUNT_KEY];
$currencyVal = $iniArray[FxDataModel::FX_CURRENCY_KEY];
$currencyVal2 = $iniArray[FxDataModel::FX_CURRENCY_KEY_TWO];

$ratesVal = $iniArray[FxDataModel::FX_RATES_KEY];

if (array_key_exists($amountVal, $_POST)) {
    $amount = $_POST[$amountVal];
    $currency = $_POST[$currencyVal];
    $currency2 = $_POST[$currencyVal2];
}

if (isset($amount) && is_numeric($amount)) {
    $rate = $fxDataModel->getFxRates($currency, $currency2);
    $result = $amount * $rate;
} else {
    $result = '';
    $amount = '';
    $currency = $currencies[0];
    $currency2 = $currencies[0];
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>F/X Calculator</title>
    </head>

    <body>
        <h1 align="center">F/X Calculator</h1>
        <hr/><br/>
        <form name="fxCalc" action="fxCalc.php" method="post">
            <center>
            <h2>Welcome <?php echo $_SESSION[ LoginDataModel::USERNAME_KEY ] ?></h2>  
                
                <select name="<?php echo $currencyVal ?>">
<?php
foreach ($currencies as $c1) {
    ?>
                        <option value="<?php echo $c1 ?>"

    <?php
    if ($c1 == $currency) {
        ?>   
                                    selected
                            <?php
                        }
                        ?>

                                ><?php echo "$c1" ?></option>
                                <?php
                            }
                            ?>
                </select>

                <input type="text" name="<?php echo $amountVal ?>" value="<?php echo $amount ?>" />



                <select name="<?php echo $currencyVal2 ?>">
                            <?php
                            foreach ($currencies as $c2) {
                                ?>
                        <option value="<?php echo $c2 ?>"

    <?php
    if ($c2 == $currency2) {
        ?>
                                    selected
                            <?php
                        }
                        ?>

                                ><?php echo "$c2" ?></option>

                                <?php
                            }
                            ?>
                </select>

                <input type="text" name="<?php echo $resultVal ?>" disabled="disabled" value="<?php echo $result ?>"/>

                <br/><br/>

                <input type="submit" value="Calculate"/>
                <input type="reset"/>

            </center>
        </form>

    </body>
</html>
