<?php 
require "model/db.php";
require "model/bookfairdb.php";


$id = filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
$description = filter_input(INPUT_POST, 'bookfair_name');
$school_id = filter_input(INPUT_POST, 'school',FILTER_VALIDATE_INT);
$start_date = filter_input(INPUT_POST, 'startdate');
$end_date  = filter_input(INPUT_POST, 'enddate');
$set_up_date = filter_input(INPUT_POST, 'setupdate');

$sdatevalid = is_date($start_date);
$edatevalid = is_date($end_date);
$sudatevalid = is_date($set_up_date);                            

if ($sdatevalid && $edatevalid && $sudatevalid && ($school_id > 0) && ($description <> "")   )
{
    updatebookfairinfo($id, $description, $school_id, $start_date, $end_date, $set_up_date, $db);

//echo "success";
 header('location: index.php?action=info'); 
 die();
}
else
{
    echo "Entered data is invalid";
}


?>