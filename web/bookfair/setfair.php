<?php
session_set_cookie_params(0, '/');
if(!isset($_SESSION)){session_start();}

$bookfairid = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);

$_SESSION['bookfairid']= $bookfairid;

//echo $bookfairid;
//echo $_SESSION['bookfairid'];

header('Location:index.php');

?>