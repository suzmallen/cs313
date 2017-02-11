<?php 
require "model/db.php";
require "model/financialdb.php";


$sequence= filter_input(INPUT_GET, 'day',FILTER_VALIDATE_INT);
$id= filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT);
$bookfair_day_id = filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
$quarters = filter_input(INPUT_POST, 'quarters',FILTER_VALIDATE_INT);
$dimes = filter_input(INPUT_POST, 'dimes',FILTER_VALIDATE_INT);
$nickels = filter_input(INPUT_POST, 'nickels',FILTER_VALIDATE_INT);
$pennies  = filter_input(INPUT_POST, 'pennies',FILTER_VALIDATE_INT);

updatecoins($bookfair_day_id, $quarters, $dimes, $nickels, $pennies,  $db);

//echo "success";
header('location: index.php?action=data&id='.$id.'&day='.$sequence); 
die();

?>