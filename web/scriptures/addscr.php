<?php
require "connect.php";
?>

<html>
<head>
</head>
<body>
<form action="process.php" method="post">
    <h1>Enter scriptures:</h1><br> 
    <label><b>Book</b></label>
    <input type="text" placeholder="Enter book" name="book" required><br>

    <label><b>Chapter</b></label>
    <input type="text" placeholder="Enter chapter" name="chapter" required><br>

    <label><b>Verse</b></label>
    <input type="text" placeholder="Enter Name" name="verse" required><br>
    
    Content:<br>
    <textarea type="text" placeholder="Enter text" name="content" rows="10" cols="50" required>
    	
    </textarea><br>
       
     <?php   
$stmt = $db->prepare('SELECT * FROM topics');
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
 foreach ($rows as $row) {
    $topic = $row['name'];
    $id= $row['id'];
    
    echo "<input type='checkbox' name=topic[] value='$id'>$topic<br>";
}?>
  
    <button class="button1" type="submit">Add to database</button>
  
</form>

</body>
</html>