<?php

require "dbconnect.php";

$username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password',FILTER_SANITIZE_STRING);

$db=getdb();

    $query = 'SELECT * FROM users WHERE 
    username =:username' ;

    $statement=$db->prepare($query);
    $statement->bindValue(':username',$username);
    $statement->execute();
    $user = $statement->fetchAll(PDO::FETCH_ASSOC);
var_dump($user);
$dbpassword = $user[0]['password'];
   
$verified = password_verify($password,$dbpassword);

if ($verified) {
    if(!isset($_SESSION)){session_start();}

/**
 * Finally, update LAST_ACTIVITY so that our timeout
 * is based on it and not the user’s login time.
 */
$_SESSION['username'] = $username;
    header('Location: home.php');
    
}else{
    echo "Invalid Username and password.";
}






?> 