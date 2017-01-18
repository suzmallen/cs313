<?php 

// Start session management
session_set_cookie_params(0, '/');

if(!isset($_SESSION)){session_start();}

$time = $_SERVER['REQUEST_TIME'];
/**
 * for a 30 minute timeout, specified in seconds
 */
$timeout_duration = 1800;
/**
 * Here we look for the user’s LAST_ACTIVITY timestamp. If
 * it’s set and indicates our $timeout_duration has passed,
 * blow away any previous $_SESSION data and start a new one.
 */
if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
  session_unset();    
  session_destroy();
  session_start();    
}
/**
 * Finally, update LAST_ACTIVITY so that our timeout
 * is based on it and not the user’s login time.
 */
$_SESSION['LAST_ACTIVITY'] = $time;

if (empty($_SESSION['loginName'])) {
    $login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_STRING);
    //if this is not a login attempt- go to login page    
    if (empty($login)) {
         include('view/login.php');
          exit;
         
            
         } 
    else{
        
                 $_SESSION['loggedid']=TRUE;
                $_SESSION['loginName']=$login;
            //create the shopping cart
            $_SESSION['cart'] = array();
    }

}?>
    
<!DOCTYPE html>
<html>
    <head>
        <title>Emoji Shop!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
          table {
    table-layout: fixed;
              width:70%;
              margin:auto;
}

          td:first {
    width: 50%;
}
td:second {
    width: 50%;
}
      
  </style>     
    </head>
<body>

<div >
    
  <div class="container text-center">
    <h1>Welcome to the Emoji Shop!</h1>      
    <p>Feelings, Faces, and Fun</p>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
     <a class="navbar-brand" href="."></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        
        <li><a href="index.php">Products</a></li>
        <li><a href=".">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        
        <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
      </ul>
    </div>
  </div>
</nav>
