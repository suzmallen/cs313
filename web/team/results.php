

<!DOCTYPE html>
<html>
    <head>
        <title>Form Results</title>
    </head>
    <body>
        <div>
        <label>Your Name: <?php echo $_POST["txtName"]; ?></label><br>
        <label>Your Email: <a href="mailto:'<?php echo $_POST['txtEmail']; ?>'"><?php echo $_POST['txtEmail']; ?></a>'</label><br>
            <label>Your Major: <?php echo $_POST["major"]; ?></label><br>
            <label>You have been to the following continents:<?php
                    $continents = $_POST["continents"];
                    var_dump($continents);
                    foreach ($continents as $continent)
                    {
                        echo $continent . '<br>'; }

                    ?></label>
            <label>Comments: <?php echo $_POST["txtComments"]; ?></label><br>
        </div>
    </body>
</html>
        