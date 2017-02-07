<?php
require "connect.php";


$book = $_POST['book'];
$chapter = $_POST['chapter'];
$verse = $_POST['verse'];
$content = $_POST['content'];
$topics = $_POST['topic'];

var_dump($topics);

    try
    {
	 $stmt = $db->prepare("INSERT INTO scriptures(book, chapter, verse, content) 
        VALUES (:book, :chapter, :verse, :content)");
        
        // pass values to the statement
        $stmt->bindValue(':book', $book);
        $stmt->bindValue(':chapter', $chapter);
        $stmt->bindValue(':verse', $verse);
        $stmt->bindValue(':content', $content);
      
        
        // execute the insert statement
        $stmt->execute();
        
        // return generated id
        $id = $db->lastInsertId('scriptures_id_seq');
  }
  catch(PDOException $ex)
  {
    echo "Error connecting to DB. Details: $ex";
  }


foreach ($topics as $value) {

			try
		    	{
			 	$stmt = $db->prepare("INSERT INTO scripturetopics(scr_id,top_id ) 
		        VALUES (:scr_id, :top_id)");
		        
		        // pass values to the statement
		        $stmt->bindValue(':scr_id', $id);
		        $stmt->bindValue(':top_id', $value);
		
		        
		        // execute the insert statement
		        $stmt->execute();
                    echo "record added<br>";
		      
		  }
		  catch(PDOException $ex)
		  {
		    echo "Error connecting to DB. Details: $ex";
		  }

	
}


header('location: scr_content.php'); 
die();
?>