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
        $task = filter_input(INPUT_GET, 'task');
        if ($task == NULL) {
            $task=1;
        }
        switch ($task) {
            case 1:
                include('view/financesubhead.php');
                include ('view/enterdaily.php');
                break;
            case 2:
                include('view/financesubhead.php');
                include ('view/checks.php');
                break;
            case 3:
                include('view/financesubhead.php');
                include ('view/dailyregreport.php');
                break;
            case 4:
                include('view/financesubhead.php');
                include ('view/dailyverify.php');
                break;
            default:
                include('view/financesubhead.php');
                include ('view/enterdaily.php');
        }
        
        
    break;
    case 'info':
        include("bookfairdb.php");
        include ('view/fairinfo.php');
    break; 
    default:
       // include('home-page.php');
}

?>


 
 