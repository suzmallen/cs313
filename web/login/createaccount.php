<?php

require "dbconnect.php";

$username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password',FILTER_SANITIZE_STRING);
$confirm = filter_input(INPUT_POST, 'confirm',FILTER_SANITIZE_STRING);

if ($confirm == $password){


$hashedpw = password_hash($password, PASSWORD_DEFAULT);

$db=getdb();

    $query = 'INSERT INTO users(username, password)
            VALUES (:username, :password)' ;

    $statement=$db->prepare($query);
    $statement->bindValue(':username',$username);
    $statement->bindValue(':password',$hashedpw);
    $statement->execute();
   

if(!isset($_SESSION)){session_start();}

/**
 * Finally, update LAST_ACTIVITY so that our timeout
 * is based on it and not the user’s login time.
 */
$_SESSION['username'] = $username;



header('Location: home.php');
        
}
else{
    header('Location: signup.php?msg=pwfail');
}

?> 
