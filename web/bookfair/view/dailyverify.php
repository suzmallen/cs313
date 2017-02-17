<?php
require "model/financialdb.php";
$rows =  getdailyfinancialinfo($bookfairdayid, $db);
$row = $rows[0];

?>
<script>   
$(document).ready(function(){
    $('#complete').click(function(){
        var dayid = $('#dayid').val();;
        $.post("updatecomplete.php",
        { dayid: dayid     
             },
        function(data,status){
            if (data == "success"){
                $('#completediv').html( "<span class='glyphicon glyphicon-ok text-danger'> Completed</span>");
            }else{
                alert(data);
            }
            
        });
          
              
    });
    
    
    
    $('#saveinitbalance').click(function(){
        var dayid = $('#dayid').val();;
        var initialbalance = $('#initialbalance').val();
        var bookfairid = $('#bookfairid').val();
        $.post("updateinitbalance.php",
        { id: bookfairid,
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
});</script>
<div class="row">
                <div class="col-lg-8">
                    <h3 class="page-header">Step 4: Verify Numbers</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default panel-red">
                        <div class="panel-heading">
                            Do the expected Cash/Checks and reported cash/checks amounts
                            match up?  If so, mark as complete.
                        </div>
                        <div class="panel-body">
                            <div>
                            <table>
                                <tr>
                                    <td>Cash in Register:</td>
                                    <td><?php echo '$'.number_format($row['actual_cash'], 2, ".", "," );?></td>
                                </tr>
                                <tr>
                                    <td>Checks in Register:</td>
                                    <td><?php echo '$'.number_format($row['actual_checks'], 2, ".", "," );?></td>
                                </tr>
                                <tr>
                                    <td>Other forms Payment<br>
                                        (i.e. certificates):</td>
                                    <td><?php echo '$'.number_format($row['actual_other'], 2, ".", "," );?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Less Initial Balance:</td>
                                    <td>-(<?php echo '$'.number_format($row['initial_balance'], 2, ".", "," );?>)</td>
                                </tr>
                                <tr>
                                    <td>Total Cash/Checks:</td>
                                    <td> <?php echo '$'.number_format($row['total_cash'], 2, ".", "," );?></td>
                                </tr>
                                <tr>
                                    <td>Reported Cash/Checks: </td>
                                    <td><?php echo '$'.number_format($row['report_cash_amount'], 2, ".", "," );?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input type="button" id="complete" value="Complete">
                                        <div id="completediv"><?php if ($row['complete'] == true){
                                        echo "<span class='glyphicon glyphicon-ok text-danger'> Completed</span>";
                                        }
                                        ?></div>
                                    
                                    
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Enter the amount of cash to be left in the register for following day:</td>
                                    <tr>
                                <td>$<input type="text" id="initialbalance" name="initialbalance" value="">
                                        </td>
                                        <td>
                                        <input type="button" id="saveinitbalance" name="saveinitbalance" value="Save Balance">
                            <input type="hidden" id="bookfairid" value="<?php echo $id;?>">
                                <input type="hidden" id="dayid" value="<?php echo $bookfairdayid;?>">
                                        </td>
                                </tr>
                            
                                
                                </table>    
                                                        
                           
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                </div>       
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