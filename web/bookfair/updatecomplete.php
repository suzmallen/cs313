<?php 

require "model/db.php";
require "model/financialdb.php";

$dayid = filter_input(INPUT_POST, 'dayid',FILTER_VALIDATE_INT);

if (($dayid>0))
{
    $result = updatecomplete($dayid, $db);

    echo "success";
}
else
{
   echo "Day ID is invalid: ".$dayid;
}

?>