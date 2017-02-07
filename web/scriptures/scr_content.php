<?php 
require "connect.php";


$id = filter_input(INPUT_GET, 'id');
// echo 'the id: '.$id;
if (empty($id)) {
    //echo "id is empty";
    try
		  {
            $stmt = $db->prepare('SELECT s.id AS scr_id, s.book, s.chapter,
            s.verse, s.content, t.name as topic
            FROM scriptures s LEFT OUTER JOIN 
            scripturetopics st ON s.id = st.scr_id LEFT OUTER JOIN topics t
            ON t.id = st.top_id ORDER BY s.id');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
              }
		  catch(PDOException $ex)
		  {
		    echo "Error connecting to DB. Details: $ex";
		  }

}
else
{  //echo "id is not empty";
    try
		  {
            $stmt = $db->prepare('SELECT s.id AS scr_id, s.book, s.chapter,
            s.verse, s.content, t.name as topic
            FROM scriptures s LEFT OUTER JOIN 
            scripturetopics st ON s.id = st.scr_id LEFT OUTER JOIN topics t
            ON t.id = st.top_id WHERE s.id=:id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
               }
    catch(PDOException $ex)
		  {
		    echo "Error connecting to DB. Details: $ex";
		  }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Scriptures</title>
    </head>
    <body><a href="addscr.php">Add Scripture</a>&nbsp;&nbsp;&nbsp;<a href="scriptures.php">Search for Scriptures</a>
         <?php 
        
        $prevrow = 0;
        foreach ($rows as $row) {
            { if ($prevrow < $row['scr_id']) {?>

                    <h2><?php echo $row['book'].' '.$row['chapter'].':'.$row['verse']; ?></h1>



             <?php   echo '<p>"'.$row['content'].'"</p><p>'.$row['topic'];
                                       }
            else{ 
                echo ', '.$row['topic'].' ';
                } 
            }
                $prevrow = $row['scr_id'];   
        }
?>
    </body>
</html>