<!DOCTYPE html>

<?php

  require_once( 'LoginDataModel.php' );
  
  $loginDataModel = new LoginDataModel()          ;
  $iniArray       = $loginDataModel->getIniArray();
  
  $usernameVal = $iniArray[ LoginDataModel::USERNAME_KEY ] ; 
  $passwordVal = $iniArray[ LoginDataModel::PASSWORD_KEY ]; 
       
  if( array_key_exists( $usernameVal, $_POST ) )
  {
     $password = $_POST[ $passwordVal ];
     $username = $_POST[ $usernameVal ];
        
     if( isset( $username ) && $loginDataModel->validateUser($username, $password ) )
     {
       session_start();
      
       $_SESSION[ LoginDataModel::USERNAME_KEY ] = $username;
  
        include( 'fxCalc.php' );
        exit();
     }
   }
   
?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>F/X Calculator Login Page</title>
  </head>

  <body>
    <h1 align="center">F/X Calculator Login Page</h1>
    <hr/><br/>
    <form name="login" action="login.php" method="post">

      <center>
        
        <table>
          <tr>
            <td>Username:</td>
            <td>
              <input type="text" id="<?php echo $usernameVal ?>" name="<?php echo $usernameVal ?>" value="" />
            </td>
          </tr>
          <tr>
            <td>Password:</td>
            <td><input type="password" name="<?php echo $passwordVal ?>" value="" /></td>
          </tr>
        </table>

        <br/>

        <button type="submit" value="Submit" name="Submit">Login</button>
        <button type="reset"  value="Reset"  name="Reset"
                onclick= this.form.<?php echo $usernameVal ?>.focus() />
          Reset
        </button>
        <p> </p>
            <li>Username: <u>jim</u> ,   Password: <u>jimsPassword</u></li>
            <li>Username: <u>phil</u> ,   Password: <u>philsPassword</u></li>
            <li>Username: <u>max</u> ,   Password: <u>maxsPassword</u></li>
            <li>Username: <u>johnny</u> ,   Password: <u>johnnysPassword</u></li>
      </center>


    </form>
  </body>
</html>
       
        



