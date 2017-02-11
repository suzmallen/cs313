<?php 
require "model/db.php";
require "model/financialdb.php";


$sequence= filter_input(INPUT_GET, 'day',FILTER_VALIDATE_INT);
$id= filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT);
$bookfair_day_id = filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
$ones = filter_input(INPUT_POST, 'ones',FILTER_VALIDATE_INT);
$fives = filter_input(INPUT_POST, 'fives',FILTER_VALIDATE_INT);
$tens = filter_input(INPUT_POST, 'tens',FILTER_VALIDATE_INT);
$twenties  = filter_input(INPUT_POST, 'twenties',FILTER_VALIDATE_INT);
$fifties = filter_input(INPUT_POST, 'fifties',FILTER_VALIDATE_INT);
$nstotal = filter_input(INPUT_POST, 'nstotal');
    

updatebills($bookfair_day_id, $ones, $fives, $tens, $twenties, $fifties, $nstotal, $db);

//echo "success";
header('location: index.php?action=data&id='.$id.'&day='.$sequence); 
die();

?>