<?php

session_set_cookie_params(0, '/');
if(!isset($_SESSION)){session_start();}


$id=$_SESSION['bookfairid'];
$userid = $_SESSION['userid'];

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
    $result= addnewbookfair($description, $school_id, $userid, $start_date, $end_date, $set_up_date, $db);
    if ($result){
        //echo "success";
 header('Location:index.php?action=changeid');
 die();
    }

}
else
{
    echo "Entered data is invalid";
}




?>