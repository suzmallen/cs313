<?php 
require "model/db.php";
require "model/bookfairdb.php";

$id =  filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
$date = filter_input(INPUT_POST, 'date');
$sequence = filter_input(INPUT_POST, 'sequence',FILTER_VALIDATE_INT);

$datevalid = is_date($date);

if ($datevalid && ($date!=="") && ($id>0) && ($sequence>0))
{
    addbookfairday($id, $date, $sequence, $db);

    echo "success";
}
else
{
   echo "Date is invalid";
}

?>