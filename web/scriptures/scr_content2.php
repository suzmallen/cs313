<?php 

require "connect.php";
$db = get_db();

$stmt = $db->prepare('SELECT * FROM scripture');
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Week 6 Team Activity</title>
    </head>
    <body>
         <?php 
        foreach ($rows as $row)
{ ?>
        
        <h1><?php echo $row['book'].' '.$row['chapter'].':'.$row['verse']; ?></h1>
    
   
  
 <?php   echo '<p>"'.$row['content'].'"</p>';


}

 
 foreach ($db->query
            (' 
              SELECT * FROM scripture_topic st 
              INNER JOIN topic t ON t.id = st.top_id 
              INNER JOIN scripture s ON s.id = st.scr_id;
           ') as $row)

     echo $row['book']." : ".$row['name']."<br>";

?>

    </body>
</html>