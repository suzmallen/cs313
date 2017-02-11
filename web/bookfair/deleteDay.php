<?php 
require "model/db.php";
require "model/bookfairdb.php";

$id =  filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);

if ($id>0)
{
    deletebookfairday($id, $db);

echo "success";
}
else
{
    echo "Date is invalid";
}


//echo "success";
?>