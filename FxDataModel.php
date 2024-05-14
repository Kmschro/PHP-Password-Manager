<?php

define( 'FX_RATES_INI_FILE', 'fxRates.ini' );

class FxDataModel
{
  const FX_DATA_MODEL_KEY = 'fx.data.model';
  const FX_RATE_FILE_KEY = 'fx.rate.file';
  const RESULT_KEY   = 'result'  ;
  const AMOUNT_KEY        = 'amount'        ;
  const FX_CURRENCY_KEY          = 'currency'         ;
  const FX_CURRENCY_KEY_TWO          = 'currency.Two'         ;
  const FX_RATES_KEY          = 'rates'  ;
  
  private $iniArray;

  private $fxRates   ;
  private $fxCurrencies   ;

  
  public function __construct() 
  {
    $this->iniArray = parse_ini_file( FX_RATES_INI_FILE );
    
    if( ( $handle = fopen( $this->iniArray[ self::FX_RATE_FILE_KEY ], "r" ) ) !== FALSE ) 
    {
      if( ( $this->fxCurrencies = fgetcsv( $handle ) ) !== FALSE )
      {
        while( ( $this->fxRates[] = fgetcsv($handle) ) !== FALSE ){
        continue;
      }
      }
      fclose( $handle );
    }
  }
  
  
 
    
  
  public function getIniArray()
  {
    return $this->iniArray;
  }
 
  
  public function getFxRates( $currency, $currency2  )
  {
    $in  = 0                      ;
    $len = count($this->fxCurrencies );
    $out = 0                      ;
    
    for( ; $in < $len ; $in++ )
    {
      if($this->fxCurrencies[ $in ] == $currency )
      {
        break;
      }
    }

    for( ; $out < $len ; $out++ )
    {
      if($this->fxCurrencies[ $out ] == $currency2 )
      {
        break;
      }
    }
    
    return $this->fxRates[ $in ][ $out ];
  }
  
  public function getFxCurrencies()
  {
    return $this->fxCurrencies;
  }
}   
?>

