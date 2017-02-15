<?php 

session_set_cookie_params(0, '/');
if(!isset($_SESSION)){session_start();}

require "model/db.php";
require "model/bookfairdb.php";

$userid = $_SESSION['userid'];
$schools = getschools($userid,$db);
$allschools = getallschools($db);
//var_dump($schools);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Book Fair Admin</title>
     <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <!-- for the datepicker -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
     .vcenter {
    
    vertical-align: middle;
    float: left;
         display:inline-block;
         margin:0px;
}
        .fawidth {
    width:10px;
    height:10px;
}
       
    </style>
   
    </head><body>
 <div id="wrapper">
          
 <!-- Page Content -->
        <div id="page-wrapper">

<?php

//Show the list of schools associated with the person
if (!empty($schools)){
    $bookfairs = getuserbookfairs($userid, $db);
    //var_dump($bookfairs);
    ?>
    
<div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header">My Book Fairs</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Select Fair
                        </div>
                        <div class="panel-body">
                            <ul>
                                <?php
                                $prevrecord="";
                                foreach ($bookfairs as $bookfair){ 
                                    if ($prevrecord == $bookfair['school_name']){
                                    //write a normal list item                    
                                    ?>
                                        <li><a href="setfair.php?id=<?php echo $bookfair['bookfair_id'];?>">
                                        <?php echo $bookfair['description'];?></a></li>

                                    <?php }                                                                      
                                    else {//otherwise, create a new section ?>
                                        </ul></li><li><?php echo $bookfair['school_name'];?><ul>
                                        <li><a href="setfair.php?id=<?php echo $bookfair['bookfair_id'];?>">
                                    <?php echo $bookfair['description'];?></a></li>
                                    <?php } 
                                $prevrecord = $bookfair['school_name'];
                                }?>                                                        
                            </ul>
                    <br><a href="index.php?action=addfair">Add New Bookfair</a>    
                    </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 --> 
              <div class="row">
                                <div class="col-lg-4">
                                    <form role="form" action="adduserschool.php" method="post" class="form-inline">
                                        
                                        <div class="form-group">
                                            <label>School</label>
                                            <select class="form-control" id="schoolid" name="schoolid">
                                                <?php foreach ($allschools as $school){
                                                      $schoolid = $school['school_id'];
                                                      $schoolname= $school['school_name'];
                                                    if ($bookfair['school_id'] == $schoolid) {
                                                        $selected = "selected";
                                                    }
                                                    else{
                                                        $selected = "";
                                                    }
                                                    
                                                    echo "<option  value='$schoolid' $selected>$schoolname</option>";
                                                    }?>
                                               
                                            </select>
                                        </div><br>
                                       
                                        <input type="hidden" name="id" value="<?php echo $userid;?>">
                                        <input type="submit" value="Add Selected School">
                                    </form><br>
                                    
                                        
                                       
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-4">
                                    <form role="form"  action="removeuserschool.php" method="post" class="form-inline">
                                        
                                        <div class="form-group">
                                            <label>My Schools:</label>
                                            <select size="3" class="form-control" id="schoolid" name="schoolid">
                                                <?php foreach ($schools as $school){
                                                      $schoolid = $school['school_id'];
                                                      $schoolname= $school['school_name'];
                                                                                                    
                                                    echo "<option  value='$schoolid'>$schoolname</option>";
                                                    }?>
                                               
                                            </select>
                                        </div><br>
                                        <input type="hidden" name="id" value="<?php echo $userid;?>">
                                        <input type="submit" value="Remove Selected School"><br>
        
                                    </form>
                                    
                                        
                                       
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
     </div>
      
                
    
  <?php  
    
}else{
//Notify User that they are not associated with any schools.  Please add one.
    
?>
<h4>You are not associated with any schools.  Please select a school.</h4>
<div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="adduserschool.php" method="post" class="form-inline">
                                        
                                        <div class="form-group">
                                            <label>School</label>
                                            <select class="form-control" id="schoolid" name="schoolid">
                                                <?php foreach ($allschools as $school){
                                                      $schoolid = $school['school_id'];
                                                      $schoolname= $school['school_name'];
                                                    if ($bookfair['school_id'] == $schoolid) {
                                                        $selected = "selected";
                                                    }
                                                    else{
                                                        $selected = "";
                                                    }
                                                    
                                                    echo "<option  value='$schoolid' $selected>$schoolname</option>";
                                                    }?>
                                               
                                            </select>
                                        </div><br><br>
                                       
                                        <input type="hidden" name="id" value="<?php echo $userid;?>">
                                        <input type="submit" value="Add School">
                                    </form>
                                    
                                        
                                       
                                </div>
                                <!-- /.col-lg-6 (nested) -->
    <div class="col-lg-6">
                                    <form role="form" class="form-inline">
                                        
                                        <div class="form-group">
                                            <label>My Schools:</label>
                                            <select multiple size="3" class="form-control" id="myschools" name="myschool">
                                                <?php foreach ($schools as $school){
                                                      $schoolid = $school['school_id'];
                                                      $schoolname= $school['school_name'];
                                                    if ($bookfair['school_id'] == $schoolid) {
                                                        $selected = "selected";
                                                    }
                                                    else{
                                                        $selected = "";
                                                    }
                                                    
                                                    echo "<option  value='$schoolid' $selected>$schoolname</option>";
                                                    }?>
                                               
                                            </select>
                                        </div><br><br>
        
                                    </form>
                                    
                                        
                                       
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
     </div>
    
 <?php   
}
?>
    </div>
    </div>
    </body>
</html>