<?php 

require "connect.php";

$book = $_GET['book'];
//echo $book;

$stmt = $db->prepare('SELECT * FROM scriptures WHERE book=:book');
$stmt->bindValue(':book', $book, PDO::PARAM_STR);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Week 5 Team Activity</title>
    </head>
    <body>
        <h1>Scripture Resources</h1>
        <a href="scriptures.php">Return to Search</a>
    
    <?php 
        foreach ($rows as $row)
{ echo '<p><b>'.$row['book'].' ';
  echo $row['chapter'].':';
  echo $row['verse'].'</b> - "';
    echo $row['content'].'"</p>';

}
?>
