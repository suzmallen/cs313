          
<?php

$id = 3;

$stmt = $db->prepare('SELECT bookfair_id, bookfair_date , report_cash_amount::numeric::float8 AS report_cash_amount, 
    report_credit_amount::numeric::float8 AS report_credit_amount,
    report_num_receipts, report_total_sales::numeric::float8 AS report_total_sales, 
    actual_cash::numeric::float8 AS actual_cash, actual_checks::numeric::float8 AS actual_checks, 
    actual_other::numeric::float8 AS actual_other,
    (actual_cash+actual_checks+actual_other)::numeric::float8 AS total_cash, 
    actual_num_receipts, sequence_no::numeric AS sequence_no FROM bookfairday WHERE bookfair_id=:id and sequence_no=:daynum');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':daynum', $daynum, PDO::PARAM_INT);
$stmt->execute();
$dayrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$myDay= $dayrows[0];
$daynum = $myDay['sequence_no'];

$stmt2 = $db->prepare('SELECT Count(*) as num_days FROM bookfairday WHERE bookfair_id=:id');
$stmt2->bindValue(':id', $id, PDO::PARAM_INT);
$stmt2->execute();
$row = $stmt2->fetchAll(PDO::FETCH_ASSOC);
$daycount= $row[0]['num_days'];

        ?>
             
             <!--TASK Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               
            </div>
            <!-- /.navbar-header -->
                
            <div class="vcenter"><table><tr >
                <td class="fawidth"><?php 
                    if ($daynum > 1) { ?>
                        <a class="navbar-brand" 
                           href="index.php?action=data&id=<?php echo $myDay['bookfair_id'];?>&day=<?php echo ($myDay['sequence_no']-1);?>&task=1" ><i class="fa fa-chevron-circle-left fa-fw vcenter"></i></a>
                    <?php 
                                     }else{
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;                
                    } ?></td><td class="lead"><span class="vcenter"><?php echo date('m/d/y',strtotime($myDay['bookfair_date']));?></span></td>
                <td class="fawidth"><?php 
                                      
                    if ($daynum < $daycount) { ?>
                    <a class="navbar-brand" 
                                           href="index.php?action=data&id=<?php echo $myDay['bookfair_id'];?>&day=<?php echo ($myDay['sequence_no']+1);?>" >
                    <i class="fa fa-chevron-circle-right fa-fw"></i></a>
                    
                    <?php }else{
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" ;                
                    }  ?> </td></tr></table></div>
               
                    <div class="vcenter"><ul class="nav navbar-top-links ">
                <li><a class="panel panel-green" href="index.php?action=data&id=<?php echo $myDay['bookfair_id'];?>&day=<?php echo $myDay['sequence_no'];?>&task=1" >
                        Step 1: Cash
                    </a>
                </li>
                <li><a class="panel panel-primary" href="index.php?action=data&id=<?php echo $myDay['bookfair_id'];?>&day=<?php echo $myDay['sequence_no'];?>&task=2">
                        Step 2: Checks
                    </a>
                        
                </li>
                <li><a class="panel panel-yellow" href="index.php?action=data&id=<?php echo $myDay['bookfair_id'];?>&day=<?php echo $myDay['sequence_no'];?>&task=3">
                        Step 3: Register
                    </a>
                </li>
                <li><a class="panel panel-red" href="index.php?action=data&id=<?php echo $myDay['bookfair_id'];?>&day=<?php echo $myDay['sequence_no'];?>&task=4">
                        Step 4: Verify
                    </a>
                </li>
                
                
                <!-- /.dropdown -->
            </ul></div>
            <!-- /.navbar-top-links -->
        </nav>
            