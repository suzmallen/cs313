<?php 

try
{ 
  $dbUrl = getenv('DATABASE_URL');

$dbopts = parse_url($dbUrl);

$dbHost = $dbopts["host"];
$dbPort = $dbopts["port"];
$dbUser = $dbopts["user"];
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
} 


$book = $_GET['book'];
echo $book;

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
    
    <?php 
        foreach ($rows as $row)
{ echo '<p><b>'.$row['book'].' ';
  echo $row['chapter'].':';
  echo $row['verse'].'</b> - "';
    echo $row['content'].'"</p>';

}
?>
