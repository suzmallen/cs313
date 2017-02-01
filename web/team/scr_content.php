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


$id = $_GET['id'];

$stmt = $db->prepare('SELECT * FROM scriptures WHERE id=:id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Week 5 Team Activity</title>
    </head>
    <body>
         <?php 
        foreach ($rows as $row)
{ ?>
        
        <h1><?php echo $row['book'].' '.$row['chapter'].':'.$row['verse']; ?></h1>
    
   
  
 <?php   echo '<p>"'.$row['content'].'"</p>';

}
?>
    </body>
</html>