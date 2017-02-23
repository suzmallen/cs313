<?php 
require "dbconnect.php";
$db= getdb();

 if(!isset($_SESSION)){session_start();}

if(!isset( $_SESSION['username'])) {
    header('Location:login.php');
}else{
    $username= $_SESSION['username']; 
}
        
     
?>

<!DOCTYPE html>
<html lang="en">

    <head></head>
    
    <body>
       <h1>Welcome <?php echo $username;?>!</h1>
        <a href="logout.php">Logout</a>
    
    </body>
    
</html>