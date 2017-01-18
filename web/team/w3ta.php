<?php
$majors = array(
  array("CS","Computer Science"),
  array("WDD","Web Design and Development"),
  array("CIT","Computer Information Technology"),
  array("SE","Software Engineering"),
  array("CE","Computer Engineering")
  );
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Week 3 Team Activity</title>
    </head>
    <body>
    <form method="post" action="results.php">
        <br/>
        <label>Name:</label>
        <input id="txtName" name="txtName" type="text"><br/><br/>
        <label>Email:</label>
        <input id="txtEmail" name="txtEmail" type="text"><br/><br/>
        <label>What is your Major?<br/></label>
        <?php
        foreach ($majors as $major) { 
        ?>
        <input type="radio" name="major" id="major" value="<?php echo $major[0];?>"><?php echo $major[1];?><br/>
      
<?php } ?>
        
        <br/>
        <label>Which Continents have you visited?<br></label>
        <input type="checkbox" name="continents[]" value="North America" checked>North America<br>
        <input type="checkbox" name="continents[]" value="South America">South America<br>
        <input type="checkbox" name="continents[]" value="Europe">Europe<br>
        <input type="checkbox" name="continents[]" value="Asia">Asia<br>
        <input type="checkbox" name="continents[]" value="Australia">Australia<br>
        <input type="checkbox" name="continents[]" value="Africa">Africa<br>
        <input type="checkbox" name="continents[]" value="Antarctica">Antarctica<br>
        <label>Comments:</label><br/>
        <textarea id="txtComments" name="txtComments" rows="5" cols="50"  ></textarea><br/>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset Form">
        
        </form>
    <br/>
        
    </body>
    
</html>