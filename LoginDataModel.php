<?php

define( 'FX_USERS_INI_FILE', 'fxUsers.ini' );
define( 'LOGIN_INI_FILE'     , 'login.ini'   );

class LoginDataModel 
{
  const PASSWORD_KEY = 'password';
  const USERNAME_KEY = 'username';
  
  private $iniArray;  
  private $loginArray;  
    
  public function __construct() 
  {
    $this->iniArray   = parse_ini_file( LOGIN_INI_FILE )   ;
    $this->loginArray = parse_ini_file( FX_USERS_INI_FILE );
  }

  public function getIniArray()
  {
    return $this->iniArray;
  }
  
  public function validateUser( $username, $password ) 
  {
   	return array_key_exists( $username, $this->loginArray ) && ( $this->loginArray[ $username ] == $password );
  }
}

?>
