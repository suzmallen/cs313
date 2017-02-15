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


//GET the action for controller processing
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    
    if ($action == NULL) {
        $action = 'home_page';
    }
}


switch ($action) {
        
    case 'home_page':
        //echo $_SESSION['bookfairid'];
        if (!isset($_SESSION['userid'])){
            include('view/header.php'); 
        }else if (!isset($_SESSION['bookfairid'])){
            include('view/manageschools.php');
        }else{
            include('view/header.php'); 
        }
        
        //include('home-page.php');
    break;
    case 'report':
        include('view/header.php'); 
        include ("view/financialreport.php");
    break;
    case 'addfair':
        include('view/newfair.php'); 
       
    break;
    case 'changeid':
        include ("view/manageschools.php");
    break;
    case 'data':
        include('view/header.php'); 
        //Get the bookfairid from the request
        $daynum = filter_input(INPUT_GET, 'day');
        if ($daynum == NULL) {
            $daynum=1;
        }
        $task = filter_input(INPUT_GET, 'task');
        if ($task == NULL) {
            $task=1;
        }
        switch ($task) {
            case 1:
                include('view/financesubhead.php');
                include ('view/enterdaily.php');
                break;
            case 2:
                include('view/financesubhead.php');
                include ('view/checks.php');
                break;
            case 3:
                include('view/financesubhead.php');
                include ('view/dailyregreport.php');
                break;
            case 4:
                include('view/financesubhead.php');
                include ('view/dailyverify.php');
                break;
            default:
                include('view/financesubhead.php');
                include ('view/enterdaily.php');
        }
        
        
    break;
    case 'info':
        include('view/header.php'); 
        include("bookfairdb.php");
        include ('view/fairinfo.php');
    break; 
    case 'signin':
        require('view/login.php');
    break;
    case 'newaccount':
        require('view/signup.php');
    break;
    case 'login':
        require('model/db.php');
        require('model/bookfairdb.php');
            $message = "";
            //Gather the post data
            $login = filter_input(INPUT_POST,'login',FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password',FILTER_SANITIZE_STRING);
            //Verify the password for the login name
            $data = login_user($login,$db);
            $pw_match = password_verify($password,$data['password']);
            //if the password was correct,
            if ($pw_match) {
                //set the session logged in variable to true
                $_SESSION['loggedin']=TRUE;
                $_SESSION['firstname']=$data['first_name'];
                $_SESSION['lastname']=$data['last_name'];
                $_SESSION['userid'] = $data['user_id'];
                //go to the default admin page
                header("Location: .");
               exit;
            }else{
                //if the password doesn't match the database, tell the user and have them try again
                $message = '<p class="redBold">Password and login incorrect.</p>';
                 include('view/login.php');
            }
    break;
        case 'logout':
            session_unset();
            session_destroy();
              
            header("Location:index.php");

    break;
    case 'addaccount':
            require('model/db.php');
            require('model/bookfairdb.php');
        
             //capture and filter inputs from the signup form
            $first_name = filter_input(INPUT_POST,'fname',FILTER_SANITIZE_STRING);
            $last_name = filter_input(INPUT_POST, 'lname',FILTER_SANITIZE_STRING);
            $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password',FILTER_SANITIZE_STRING);
            $verify = filter_input(INPUT_POST, 'vpassword',FILTER_SANITIZE_STRING);
           //initialize the error message for validating fields
            $errormessage='';
            //validate the inputs to make sure everything is present
            if (empty($first_name)) {
                $errormessage.='<p class="redBold">First Name is Missing.  Please fill in all fields.</p>';
            }
            if (empty($last_name) ){
                $errormessage.='<p class="redBold">Last Name is Missing.  Please fill in all fields.</p>';
            }
            if(empty($username)){
                $errormessage.='<p class="redBold">Login Name is Missing.  Please fill in all fields.</p>'; 
                }   
            if (empty($password)|| (strlen($password)<8)){
                $errormessage.='<p class="redBold">Password is Missing or not long enough.  Please fill in all fields.</p>';  
                }   
            if (empty($verify) ){
                $errormessage.='<p class="redBold">Password Verification is Missing.  Please fill in all fields.</p>'; 
            } else {
                if (!($verify==$password)){
                     $errormessage.='<p class="redBold">Passwords do not match.</p>'; 
                }
            }
        
            //if there are error messages, send the user back to registration
             if (!($errormessage=='')) { 
                  include('view/signup.php');
                exit;}
            //verify that the $password is the same as $verify and check the admin_code    
             if ($password === $verify) {
                //hash the password
                $password = password_hash($password,PASSWORD_DEFAULT);
                //insert user into the database    
                 $errormessage.= "inserting user";
                $reg_result= insert_user($first_name,$last_name,$username,$password,$db);
             } else {
                 //if passwords do not match or the admin code is wrong, make them try again
                $errormessage = '<p class="redBold">Passwords do not match, or Admin Code is incorrect.</p>';
                include('view/signup.php');
                exit;
            }
            //check $reg_result which tells us if the user was added into the database. 
            if (!$reg_result){
                $error = "The user was not added";
                echo $error;
                //include('../errors/error.php');
            } else {
                //let the user know that the account was successfully added. Next, make them login.
               $message = '<p class="redBold">Your Account has been added.  Please Log in.</p>';
               include('view/login.php');
            }
    break;      
    default:
       // include('home-page.php');
        include('view/header.php'); 
}

?>


 
 