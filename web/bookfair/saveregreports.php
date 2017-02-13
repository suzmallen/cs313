<?php 
require "model/db.php";
require "model/financialdb.php";

$id =  filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
$totcash = filter_input(INPUT_POST, 'totcash',FILTER_VALIDATE_FLOAT);
$totcredit = filter_input(INPUT_POST, 'totcredit',FILTER_VALIDATE_FLOAT);
$tottotal = filter_input(INPUT_POST, 'tottotal',FILTER_VALIDATE_FLOAT);
$totreceipts = filter_input(INPUT_POST, 'totreceipts',FILTER_VALIDATE_INT);


//if the numbers were not valid, let the user know
if($totcash===FALSE || $totcash==NULL || $totcredit===FALSE || $totcredit==NULL
  ||$tottotal===FALSE || $tottotal==NULL || $totreceipts===FALSE || $totreceipts==NULL){
    echo "Please verify that numbers are entered correctly.";
}else{ //otherwise, update the database
    updateregnumbers($id,$totcash,$totcredit,$totreceipts,$tottotal, $db);

    echo "success";
    
}

?>