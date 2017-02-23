<?php
$error = filter_input(INPUT_GET,'msg',FILTER_SANITIZE_STRING);

echo $error;
?>
<!DOCTYPE html>
<html lang="en">

    <head></head>
    
    <body>
        <form action="createaccount.php" method="post">
            <h2>Create a User Name and Password</h2>
        User Name:<input type="text" name="username" id="username" required/><br>
        Password:<input type="password" name="password" id="password" required/> <br>
        Confirm Password:<input type="password" name="confirm" id="confirm" required/> <br>
        <input type="submit" value="Create Password"/>
        </form>
    
    
    </body>
    
</html>