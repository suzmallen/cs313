<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!empty($message)) {echo $message;}
?>
<br/>
<h3 class="moremargin">Log in</h3>
<div >
<form id="login_form" action="." method="post" >
    <fieldset class="spaces">
        <label class="equalwidth" for="login">Login Name:</label>
            <input type="text" id="login" name="login" required><br>
            
            <label class="equalwidth" >&nbsp;</label>
            <input type="submit" name="action" value="Login">  
        
    </fieldset>
    
</form></div>