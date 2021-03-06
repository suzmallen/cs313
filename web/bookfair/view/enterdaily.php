<?php
//require "model/db.php";

require "model/financialdb.php";

$userid = $_SESSION['userid'];

$id =$_SESSION['bookfairid'];
$sequence= filter_input(INPUT_GET, 'day',FILTER_VALIDATE_INT);

//Get the book fair data
$bookfair = getbookfair($id, $db);

$daycount = countbookfairdays($id, $db);
if ( $daycount == '0') {
    echo "";
}else{

$bookfairday = getbookfairday($id, $sequence, $db);
$bookfairdayid = $bookfairday['bookfair_day_id'];

//get the dates for the bookfair associated with the book fair
$quarters = $bookfairday['quarter_count'];
$dimes = $bookfairday['dime_count'];
$nickels = $bookfairday['nickel_count'];
$pennies = $bookfairday['penny_count'];
$totalcoins = (.25 * $quarters) + (.10 * $dimes) + (.05 * $nickels) + (.01 * $pennies);

$other = $bookfairday['ns_total'];
$ones = $bookfairday['one_count'];
$fives = $bookfairday['five_count'];    
$tens = $bookfairday['ten_count'];
$twenties = $bookfairday['twenty_count'];
$fifties = $bookfairday['fifty_count'];
$totalbills = $other + (1.00 * $ones) + (5.00 * $fives) + (10.00 * $tens) + (20.00 * $twenties) + (50.00 * $fifties);
    
$total = $totalbills + $totalcoins;    
$initialbalance = $bookfairday['initial_balance'];    

updateactualcash($bookfairdayid,$total,$db);

?>



<script>$(document).ready(function(){

    $('#saveinitbalance').click(function(){
        var dayid = $('#dayid').val();
        //alert(dayid);
        var initialbalance = $('#initialbalance').val();
        $.post("updateinitbalance.php",
        {   id:0,
            dayid: dayid,
          initialbalance: initialbalance     
             },
        function(data,status){
            if (data == "success"){
                
            }else{
                alert(data);
            }
            
        });
          
              
    });
});
</script>            

<div class="row">
                <div class="col-lg-8">
                    <h3 class="page-header">Step 1: Enter Cash</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default panel-green">
                        <div class="panel-heading">
                            Coins
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" action="savecash.php?id=<?php echo $id;?>&day=<?php echo $sequence;?>" method="post" class="form-inline">
                                        <div class="form-group">
                                            <label>Quarters:</label>
                                            <input type="text" size="4" class="form-control" name="quarters" id="quarters" value="<?php echo $bookfairday['quarter_count'];?>">
                                        </div><br>
                                        <div class="form-group">
                                            <label>Dimes:</label>
                                            <input type="text" size="4" class="form-control" name="dimes" id="dimes" value="<?php echo $bookfairday['dime_count'];?>">
                                        </div><br>
                                        <div class="form-group">
                                            <label>Nickels:</label>
                                            <input type="text" size="4" class="form-control" name="nickels" id="nickels" value="<?php echo $bookfairday['nickel_count'];?>">
                                        </div><br>
                                        <div class="form-group">
                                            <label>Pennies:</label>
                                            <input type="text" size="4" class="form-control" name="pennies" id="pennies" value="<?php echo $bookfairday['penny_count'];?>">
                                        </div><br>
                                        <input type="hidden" name="id" value="<?php echo $bookfairdayid;?>">
                                              
                                        <label>Save and Calculate</label><input type="submit" id="coin" value="GO">
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
                    <div class="panel panel-default panel-green">
                        <div class="panel-heading">
                           Bills
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" action="savebills.php?id=<?php echo $id;?>&day=<?php echo $sequence;?>" method="post" class="form-inline">
                                       <div class="form-group">
                                            <label>$1 Bills:</label>
                                            <input type="text" size="4" class="form-control" name="ones" id="ones" value="<?php echo $bookfairday['one_count'];?>">
                                        </div><br>
                                        <div class="form-group">
                                            <label>$5 Bills:</label>
                                            <input type="text" size="4" class="form-control" name="fives" id="fives" value="<?php echo $bookfairday['five_count'];?>">
                                        </div><br>
                                        <div class="form-group">
                                            <label>$10 Bills:</label>
                                            <input type="text" size="4" class="form-control" name="tens" id="tens" value="<?php echo $bookfairday['ten_count'];?>">
                                        </div><br>
                                        <div class="form-group">
                                            <label>$20 Bills:</label>
                                            <input type="text" size="4" class="form-control" name="twenties" id="twenties" value="<?php echo $bookfairday['twenty_count'];?>">
                                        </div><br>
                                        <div class="form-group">
                                            <label>$50 Bills:</label>
                                            <input type="text" size="4" class="form-control" name="fifties" id="fifties" value="<?php echo $bookfairday['fifty_count'];?>">
                                        </div><br>
                                        <div class="form-group">
                                            <label>Total amount other Bills/Change:</label><br>
                                            $<input type="text" size="10" class="form-control" name="nstotal" id="nstotal" placeholder="#.##" value="<?php echo number_format($bookfairday['ns_total'], 2, ".", "," );?>">
                                        </div><br>
                                        <input type="hidden" name="id" value="<?php echo $bookfairdayid;?>">
                                          
                                        <label>Save and Calculate</label><input type="submit" id="bills" value="GO">
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
                     <div class="panel panel-default panel-green">
                        <div class="panel-heading">
                           Summary
                        </div>
                         
                        <div class="panel-body">
                 <label>Total Coins: <?php echo '$'.number_format($totalcoins, 2, ".", "," );?></label><br>
                <label>Total Bills/other: <?php echo '$'.number_format($totalbills, 2, ".", "," );?></label><br>
            <label>Total Cash: <?php echo '$'.number_format($total, 2, ".", "," );?></label>
                </div>
                         <div class="panel-body">
                         <label>Initial Balance:</label>
                             $<input id="initialbalance" name="initialbalance" value="<?php echo number_format($initialbalance, 2, ".", "," );?>"><input type="button" id="saveinitbalance" value="Update">
                              <input type="hidden" id="dayid" name="dayid" value="<?php echo $bookfairdayid;?>">
                         </div>
                     </div></div></div>
<?php } ?>
      

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>