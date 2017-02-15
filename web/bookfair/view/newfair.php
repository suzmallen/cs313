<?php 

session_set_cookie_params(0, '/');
if(!isset($_SESSION)){session_start();}

require "model/db.php";
require "model/bookfairdb.php";

$userid = $_SESSION['userid'];
$schools = getschools($userid,$db);

//Get the book fair data
$schools = getschools($userid,$db);


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
  
<script>
   
     $( function() {
    $( "#startdate" ).datepicker();
  } );   
     $( function() {
    $( "#enddate" ).datepicker();
  } );   
     $( function() {
    $( "#setupdate" ).datepicker();
  } );   
</script>

<div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Book Fair Information</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            General Information
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" action="addfair.php" method="post" class="form-inline">
                                        <div class="form-group">
                                            <label>Book Fair Name</label><br>
                                            <input class="form-control" size="50" name="bookfair_name" id="bookfair_name" >
                                            
                                        </div><br><br>
                                        <div class="form-group">
                                            <label>School</label>
                                            <select class="form-control" id="school" name="school">
                                                <?php foreach ($schools as $school){
                                                      $schoolid = $school['school_id'];
                                                      $schoolname= $school['school_name'];
                                                                                                    
                                                    echo "<option  value='$schoolid'>$schoolname</option>";
                                                    }?>
                                               
                                            </select>
                                        </div><br><br>
                                        <input type="hidden" class="form-control" id="primuserid" name="primuserid"
                                                   value="<?php echo $userid;?>">
                                        <div class="form-group">
                                            <label>Start Date:</label>
                                            <input type="text" class="form-control" id="startdate" name="startdate" >
                                        </div><br><br>
                                        <div class="form-group">
                                            <label>End Date:</label>
                                            <input type="text" class="form-control" id="enddate" name="enddate">
                                        </div><br><br>
                                        <div class="form-group">
                                            <label>Set Up Date:</label>
                                            <input type="text" class="form-control" id="setupdate" name="setupdate" >
                                        </div><br><br>
                                        
                                        <input type="submit" value="Add Fair">
                                    </form>
                                    
                                        
                                       
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->

                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
    

</div>
</div>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>