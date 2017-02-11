

<?php

require "model/db.php";

$stmt = $db->prepare('SELECT bookfair.description, bookfairday.bookfair_date, bookfairday.sequence_no, 
                    bookfairday.bookfair_day_id, bookfair.bookfair_id FROM bookfairday INNER JOIN bookfair 
                    oN bookfairday.bookfair_id = bookfair.bookfair_id 
                    INNer JOIN type on TYPE.type_id = bookfair.fair_type WHERE bookfairday.bookfair_id=3 ORDER BY sequence_no');
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
   
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Book Fair Admin - <?php    
                                  echo $rows[0]['description']; ?>
            </a></div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a href="index.php?action=changeid">
                    <i class="fa fa-exchange"> Other Fairs </i>
                    </a></li>
                <li> <a href="index.php?action=logout">
                    <span class="glyphicon glyphicon-log-out"> Logout </span>
                    </a></li>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href="index.php?action=info"><i class="fa fa-file-text"></i> Fair Info</a>
                        </li>
                        <li>
                            <a href="index.php?action=data&day=1"><i class="fa fa-dollar fa-fw"></i> Daily Financials</a>

                            <ul class="nav nav-second-level">
                                <?php    
                                    foreach ($rows as $row) {
                                        ?>
                                <li>
                                    <a href="index.php?action=data&id=<?php echo $row['bookfair_id']; ?>&day=<?php echo $row['sequence_no']; ?>">
                                        <?php echo date('m/d/y',strtotime($row['bookfair_date'])); ?></a>
                                </li>
                                <?php } ?>
                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="index.php?action=report"><i class="fa fa-list-alt fa-fw"></i> Reports</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">