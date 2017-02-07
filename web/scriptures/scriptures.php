<?php
require "connect.php";
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Week 5 Team Activity</title>
    </head>
    <body><a href="addscr.php">Add Scripture</a>
        <h1>Scripture Resources</h1>
        
    <?php foreach ($db->query('SELECT * FROM scriptures') as $row) 
    
    
{ echo '<p><a href="scr_content.php?id='.$row['id'].'"><b>'.$row['book'].' ';
  echo $row['chapter'].':';
  echo $row['verse'].'</b></a>';
    

}
        
        ?>
        <form action='scr_results.php' method="get">
        <label for='book'>Enter book name:</label><input id='book' name='book' type='text'/>   
        <input type= 'submit'  value='Search' />
                           </form>
        
        
    </body>
</html>