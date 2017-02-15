<?php
//require "model/db.php";
require "model/bookfairdb.php";
require "model/financialdb.php";



$id = filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT);
$sequence= filter_input(INPUT_GET, 'day',FILTER_VALIDATE_INT);


//Get the book fair data
$bookfair = getbookfair($id, $db);

$bookfairday = getbookfairday($id, $sequence, $db);
$bookfairdayid = $bookfairday['bookfair_day_id'];

$checks = getdaychecks($bookfairdayid,$db);


?>



<script>
    
$(document).ready(function(){
    $('#add').click(function(){
        var bookfairdayid = $('#bookfairdayid').val();
        var checkno = $('#checkno').val();
        var amount = $('#amount').val();
        
        $('#checkno').val("");
        $('#amount').val("");
        
        $.post("addcheck.php",
        {
          id: bookfairdayid,
          checkno: checkno ,
          amount: amount    
        },
        function(data,status){
            if (data == "success"){
                $('#checks').append('<tr><td>' + checkno + '</td><td>' + amount + '</td></tr>');
            }else{
                alert(data);
            }
            
        });
    });
});
</script>            

<div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Step 2: Enter Checks</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                 <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Checks
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table id="checks" class="table">
                                    <thead>
                                        <tr>
                                            <th>Check #</th>
                                            <th>Amount</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            <?php 
                                            $totalchecks = 0.00;
                                            if (!empty($checks) and (count($checks)>0)) {
                                                foreach($checks as $row){
                                                    $checkno = $row['checkno'];
                                                    $amount = $row['amount'];
                                                    $totalchecks += $amount;             
                                                    echo "<tr><td>$checkno</td><td>".'$'.number_format($amount, 2, ".", ",")."</td> </tr>";
                                                }
                                                
                                            }
                                           
                                            ?>
                                       
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total</th>
                                            <th><?php echo '$'.number_format($totalchecks, 2, ".", ",");?></th>
                                            
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
            
                 <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Checks
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row" >
                                <div class="col-lg-6">
                                
                                Check Number:<br><input type="text" id="checkno" name="checkno" size="10"/>
                                </div>
                                <div class="col-lg-6">
                                <input type="hidden" id="bookfairdayid" value="<?php echo $bookfairdayid;?>"/>
                                Amount:<br>$<input type="text" id="amount" name="amount" size="10"/>
                                </div>
                            </div>
                             <div class="row" >
                                <div class="col-lg-12">
                                
                                                            
                                    <input type="button" id="add" value="Add Check"/>
                                </div>
                                
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
    

</div>
</div>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>