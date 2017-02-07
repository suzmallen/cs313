<?php 

//GET the action for controller processing
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    
    if ($action == NULL) {
        $action = 'home_page';
    }
}

include('view/header.php'); 


switch ($action) {
    case 'home_page':
        //include('home-page.php');
    break;
    case 'report':
        include ("view/financialreport.php");
    break;
    case 'data':
        
        //Get the bookfairid from the request
        $daynum = filter_input(INPUT_GET, 'day');
        if ($daynum == NULL) {
            $daynum=1;
        }

        include('view/financesubhead.php');
        include ('view/enterdaily.php');
    break;
    case 'info':
        include ('view/fairinfo.php');
    break;    
    default:
       // include('home-page.php');
}

?>


 
           
            

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

   
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
