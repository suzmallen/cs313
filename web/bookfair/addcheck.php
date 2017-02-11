<?php 
require "model/db.php";
require "model/financialdb.php";

$id =  filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
$checkno = filter_input(INPUT_POST, 'checkno',FILTER_VALIDATE_INT);
$amount = filter_input(INPUT_POST, 'amount',FILTER_VALIDATE_FLOAT);

if ((strlen($checkno) == 0) || (strlen($amount) ==0))
{
    echo "Check Data is invalid";
    echo $checkno.' '.$amount;
}
else
{
  
     adddaychecks($id, $checkno, $amount, $db);
     updateactualchecks($id,$db);

    echo "success";
}

?>