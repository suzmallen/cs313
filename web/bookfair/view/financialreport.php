<?php 
require "model/financialdb.php";
$id=$_SESSION['bookfairid'];

$rows = getdailyfinancialinfo($id, $db);

?>
<h1>Final Financial Report</h1>

           <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <b>Register Reported Totals</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Cash/Checks</th>
                                            
                                            <th>Credit</th>
                                            <th># Receipts</th>
                                            <th>Total Sales</th>
                                            
                                            <th></th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        
                                            $subTotalCash = 0.00;
                                            $subTotalCredit = 0.00;
                                            $subTotalReceipts = 0.00;
                                            $subTotalTotal = 0.00;    
                                        
                                        foreach ($rows as $row)
                                            { 
                                        ?>
                                        
                                        
                                        <tr>
                                           <td><?php echo $row['bookfair_date'];?></td>
                                            <td><?php echo '$'.number_format($row['report_cash_amount'], 2, ".", "," );?></td>
                                            <td><?php echo '$'.number_format($row['report_credit_amount'], 2, ".", "," );?></td>
                                            <td><?php echo $row['report_num_receipts'];?></td>
                                            <td><?php echo '$'.number_format($row['report_total_sales'], 2, ".", "," );?></td>
                                            
                                        </tr>
                                   <?php
                                            $subTotalCash += $row['report_cash_amount'];
                                            $subTotalCredit += $row['report_credit_amount'];
                                            $subTotalReceipts += $row['report_num_receipts'];
                                            $subTotalTotal += $row['report_total_sales'];
                                            } ?>
                                        </tbody><tfoot>
                                            <tr><th>Totals:</th>
                                                <th><?php echo '$'.number_format($subTotalCash, 2, ".", "," );?></th>
                                                <th><?php echo '$'.number_format($subTotalCredit, 2, ".", "," );?></th>
                                                <th><?php echo $subTotalReceipts;?></th>
                                                <th><?php echo '$'.number_format($subTotalTotal, 2, ".", ",");?></th>
                                            </tr></tfoot>
                                
                                    
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>


<!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <b>Book Fair Cash/Check Summary</b> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Reported</th>
                                            <th colspan="3">Actual</th>
                                           </tr>
                                        <tr>
                                            <th>Date</th>
                                            <th>Cash/Checks</th>
                                            
                                            <th>Cash</th>
                                            <th>Checks</th>
                                            <th>Other</th>
                                            <th>Total</th>
                                            <th></th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $subTotalReportCash = 0.00;
                                        $subTotalCash = 0.00;
                                        $subTotalChecks = 0.00;
                                        $subTotalOther = 0.00;
                                        $subTotalAll = 0.00;   
                                        foreach ($rows as $row)
                                            { 
                                                $reportCash = $row['report_cash_amount'];
                                                $actualCash = $row['actual_cash'];
                                                $actualChecks = $row['actual_checks'];
                                                $actualOther =  $row['actual_other'];   
                                                $total = $row['total_cash'];?>
                                        
                                        
                                        <tr>
                                            <td><?php echo $row['bookfair_date'];?></td>
                                            <td><?php echo '$'.number_format($reportCash, 2, ".", "," );?></td>
                                            <td><?php echo '$'.number_format($actualCash, 2, ".", ",");?></td>
                                            <td><?php echo '$'.number_format($actualChecks, 2, ".", "," );?></td>
                                            <td><?php echo '$'.number_format($actualOther, 2, ".", "," );?></td>
                                            <td><?php echo '$'.number_format($total, 2, ".", ","); ?></td>                            
                                        </tr>
                                        
                                        <?php 
                                            $subTotalReportCash += $reportCash; 
                                            $subTotalCash += $actualCash;
                                            $subTotalChecks += $actualChecks;
                                            $subTotalOther += $actualOther;
                                            $subTotalAll +=$total;    
                                            
                                            } ?>
                                    </tbody>
                                    <tfoot><tr>
                                        <th>Totals:</th>
                                        <th><?php echo '$'.number_format($subTotalReportCash, 2, ".", ",");?></th>
                                        <th><?php echo '$'.number_format($subTotalCash, 2, ".", ",");?></th>
                                        <th><?php echo '$'.number_format($subTotalChecks, 2, ".", ",");?></th>
                                        <th><?php echo '$'.number_format($subTotalOther, 2, ".", ",");?></th>
                                        <th><?php echo '$'.number_format($subTotalAll, 2, ".", ",");?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                </div>
                
                

                
                
                
                <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <b>Instructions:</b> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                   
                                    <tbody>
                                        
                                        <tr></tr><th>Amount to deposit in Bank:</th>
                                        <td><?php echo '$'.number_format($subTotalCash+$subTotalChecks, 2, ".", ",");?></td></tr>
                                        <tr><th>Amount to remit to Scholastic:</th>
                                            <td><?php echo '$'.number_format($subTotalReportCash, 2, ".", ",");?></td></tr>
                                        <tr><th>Amount to retain for PTO:</th>
                                            <td><?php echo '$'.number_format(($subTotalCash+$subTotalChecks)-$subTotalReportCash, 2, ".", ",");?></td></tr>
                                        
                                        <?php  ?>
                               
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
               </div>