<?php 
session_set_cookie_params(0, '/');
if(!isset($_SESSION)){session_start();}

require "model/db.php";
require "model/financialdb.php";

$id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
$dayid = filter_input(INPUT_POST, 'dayid',FILTER_VALIDATE_INT);
$initbalance = filter_input(INPUT_POST, 'initialbalance', FILTER_VALIDATE_FLOAT);
if (($initbalance>0.00) && ($dayid>0))
{
    $result = updateinitbalance($id, $dayid, $initbalance, $db);

    echo "success";
}
else
{
   echo "Date is invalid.  Dayid:".$dayid." initbalance:".$initbalance;
}

?>