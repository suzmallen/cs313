<?php 
require "model/db.php";
require "model/bookfairdb.php";

$userid =  filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
$schoolid = filter_input(INPUT_POST, 'schoolid', FILTER_VALIDATE_INT);

echo $userid;
echo $schoolid;

if (($userid>0) && ($schoolid>0))
{
    removeuserschool($userid, $schoolid, $db);

   header('Location:index.php?action=changeid');
}
else
{
   echo "problem with userid and schoolid";
}

?>