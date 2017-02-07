<?php 
try
{
 $dbUrl = getenv('DATABASE_URL');

    if (empty($dbUrl)) {
 // example localhost configuration URL with postgres username and a database called cs313db
 $dbUrl = "postgres://ta_user:pa55word@localhost:5432/scripture";
}

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


$stmt = $db->prepare('SELECT * FROM topics');
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
<head>
    </head>
    <body>
    
    <input type="text"
    
    <?php foreach ($rows as $row) {
    $topic = $row['name'];
    $id= 
    
    echo "<input type='checkbox' id=topic[] value='$id'>$topic<br>";
}

   
}
    </body>



</html>
