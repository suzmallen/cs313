<?php
//require "model/db.php";

require "model/financialdb.php";

$userid = $_SESSION['userid'];


$id = $_SESSION['bookfairid'];
$sequence= filter_input(INPUT_GET, 'day',FILTER_VALIDATE_INT);


//Get the book fair data
$bookfair = getbookfair($id, $db);

$bookfairday = getbookfairday($id, $sequence, $db);
$bookfairdayid = $bookfairday['bookfair_day_id'];


?>
<script>
    
    
$(document).ready(function(){
    $('#calc').click(function(){
        var reg1cash = parseFloat($('#reg1cash').val());
        var reg2cash = parseFloat($('#reg2cash').val());
        var reg1credit = parseFloat($('#reg1credit').val());
        var reg2credit = parseFloat($('#reg2credit').val());
        var reg1receipts = parseInt($('#reg1receipts').val());
        var reg2receipts = parseInt($('#reg2receipts').val());
        var reg1total = parseFloat($('#reg1total').val());
        var reg2total = parseFloat($('#reg2total').val());
        var totcash = reg1cash + reg2cash;
        var totcredit = reg1credit + reg2credit;
        var totreceipts = reg1receipts + reg2receipts;
        var tottotal = reg1total + reg2total;
        var currentID = ($('#dayid').val());
        alert(currentID);
        $.post("saveregreports.php",
        {
          id: currentID,
          totcash: totcash,
          totcredit: totcredit,
          totreceipts: totreceipts,
          tottotal: tottotal
             },
        function(data,status){
            if (data == "success"){
                alert("update was successful")
                 $('#totcash').text(totcash.toFixed(2));
                 $('#totcredit').text(totcredit.toFixed(2));
                 $('#totreceipts').text(totreceipts);
                 $('#tottotal').text(tottotal.toFixed(2));
            }else{
                alert(data);
            }
            
        });
       
    });  
});    
    
</script>

<div class="row">
                <div class="col-lg-8">
                    <h3 class="page-header">Step 3: Enter Register Reports</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                                            <div class="col-lg-3">
                    <div class="panel panel-default panel-yellow">
                        <div class="panel-heading">
                           Totals:
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form class="form-inline">
                                     <div class="form-group">
                                    <label>Total Cash/Checks:</label>
                                         $<span name="totcash" id="totcash"><?php echo number_format($bookfairday['frcash'], 2, ".", "," );?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Total Credit:</label>
                                            $<span name="totcredit" id="totcredit"><?php echo number_format($bookfairday['frcredit'], 2, ".", "," );?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Total # Receipts:</label>
                                            <span name="totreceipts" id="totreceipts"><?php echo $bookfairday['report_num_receipts'];?></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Total Sales:</label>
                                            $<span name="tottotal" id="tottotal"><?php echo number_format($bookfairday['frtotal'], 2, ".", "," );?></span>
                                        </div>
                                                                        
                                        </form>
                                       
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        
                        </div>
            </div>
            <!-- /.row -->
                </div>
                
                <div class="col-lg-4">
                    <div class="panel panel-default panel-yellow">
                        <div class="panel-heading">
                            Register #1
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <label>Total Cash/Checks:</label>
                                            $<input type="text" size="8" class="form-control" name="reg1cash" id="reg1cash" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Total Credit:</label>
                                            $<input type="text" size="8" class="form-control" name="reg1credit" id="reg1credit" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Total # Receipts:</label>
                                            <input type="text" size="4" class="form-control" name="reg1receipts" id="reg1receipts" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Total Sales:</label>
                                            $<input type="text" size="8" class="form-control" name="reg1total" id="reg1total" value="">
                                        </div>
                                        <input type="hidden" name="dayid" id="dayid" value="<?php echo $bookfairdayid;?>">
                                              
                                    </form>                                                                            
                                       
                                </div>
                               
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                </div>
                <!-- /.col-lg-6 --> <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-4">
                    <div class="panel panel-default panel-yellow">
                        <div class="panel-heading">
                           Register #2
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form class="form-inline">
                                     <div class="form-group">
                                    <label>Total Cash/Checks:</label>
                                    $<input type="text" size="8" class="form-control" name="reg2cash" id="reg2cash" value="">
                                    </div>
                                
                                        <div class="form-group">
                                            <label>Total Credit:</label>
                                            $<input type="text" size="8" class="form-control" name="reg2credit" id="reg2credit" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Total # Receipts:</label>
                                            <input type="text" size="4" class="form-control" name="reg2receipts" id="reg2receipts" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Total Sales:</label>
                                            $<input type="text" size="8" class="form-control" name="reg2total" id="reg2total" value="">
                                        </div>
                                        
                                    </form>   
                                       
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        <label>Calculate and Save</label><button type="button" id="calc">GO</button>
                        </div>
                                    </div>
            </div>
            <!-- /.row -->
           <!-- /.col-lg-6 (nested) -->

                
</div>
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