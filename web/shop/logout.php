<?php
// Start session management
session_start();

if (isset($_SESSION['loginName'])){
    unset($_SESSION['loginName']);
}
if(!isset($_SESSION)){
    session_destroy();}
 header("Location:index.php");
exit();
?>
