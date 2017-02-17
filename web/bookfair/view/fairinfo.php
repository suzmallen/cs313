<?php

$id=$_SESSION['bookfairid'];
$userid = $_SESSION['userid'];
//echo $id;
//Get the book fair data
$bookfair = getbookfair($id, $db);
$schools = getschools($userid,$db);
$bookfairdays = getbookfairdays($id, $db);

//get the dates for the bookfair associated with the book fair

?>



<script>
       
    
$(document).ready(function(){
    $('#remove').click(function(){
        var currentID = 0;
        var values = $('#dates').val();
         for( var i=0; i < values.length ; i++){
             //alert(values[i]);
             currentID = values[i]
             $.post("deleteDay.php",
        {
          id: currentID
             },
        function(data,status){
            if ($data == "success"){
                
            }else{
                alert(data);
            }
            
        });
             $("#dates option[value='" + currentID + "']").remove();
         }
              
    });
});
    
    
</script>      
<script>
$(document).ready(function(){
    $('#add').click(function(){
        var intSequence = $('#dates option').length + 1;
        var bookfairid = $('#bookfair_id').val();
        var bookfairdate = $('#bookfair_date').val();
        if (bookfairdate==""){
            alert("Please enter a date");
        }else{
        $('#dates').append('<option value="' + bookfairid+ '">' + bookfairdate + '</option>');
        $('#bookfair_date').val("");
        $.post("addDay.php",
        {
          id: bookfairid,
          date: bookfairdate ,
          sequence: intSequence    
        },
        function(data,status){
            if ($data == "success"){
                
            }else{
                alert(data);
            }
            
        });}
    });
});
  $( function() {
    $( "#bookfair_date" ).datepicker();
  } );   
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
                                    <form role="form" action="savebfchanges.php" method="post" class="form-inline">
                                        <div class="form-group">
                                            <label>Book Fair Name</label><br>
                                            <input class="form-control" size="50" name="bookfair_name" id="bookfair_name" value="<?php echo $bookfair['description'];?>">
                                            
                                        </div><br><br>
                                        <div class="form-group">
                                            <label>School</label>
                                            <select class="form-control" id="school" name="school">
                                                <?php foreach ($schools as $school){
                                                      $schoolid = $school['school_id'];
                                                      $schoolname= $school['school_name'];
                                                    if ($bookfair['school_id'] == $schoolid) {
                                                        $selected = "selected";
                                                    }
                                                    else{
                                                        $selected = "";
                                                    }
                                                    
                                                    echo "<option  value='$schoolid' $selected>$schoolname</option>";
                                                    }?>
                                               
                                            </select>
                                        </div><br><br>
                                        <div class="form-group">
                                            <label>Primary Contact:</label>
                                            <p class="form-control-static"><?php echo $bookfair['primary_user'];?></p>
                                        </div><br><br>
                                       <div class="form-group">
                                            <label>Start Date:</label>
                                            <input type="text" class="form-control" id="startdate" name="startdate" value="<?php echo date('m/d/Y',strtotime($bookfair['start_date']));?>">
                                        </div><br><br>
                                        <div class="form-group">
                                            <label>End Date:</label>
                                            <input type="text" class="form-control" id="enddate" name="enddate" value="<?php echo date('m/d/Y',strtotime($bookfair['end_date']));?>">
                                        </div><br><br>
                                        <div class="form-group">
                                            <label>Set Up Date:</label>
                                            <input type="text" class="form-control" id="setupdate" name="setupdate" value="<?php echo date('m/d/Y',strtotime($bookfair['set_up_date']));?>">
                                        </div><br><br>
                                        <input type="hidden" name="id" value="<?php echo $id;?>">
                                        <input type="submit" value="Save Changes">
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
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Book Fair Dates
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                    <p>Please Input all Dates that the Book Fair will be open for business:</p>
                                        <div >
                                            <label>Open Dates:</label>
                                            <select multiple size="4" name="dates[]" id="dates" class="form-control">
                                           <?php foreach ($bookfairdays as $bookfairday){
                                            $bookfairdate = date('m/d/Y',strtotime($bookfairday['bookfair_date']));
                                            $bookfairdayid = $bookfairday['bookfair_day_id'];
                                            echo "<option value='$bookfairdayid'>$bookfairdate</option>";
                                            } ?>
                                                
                                               
                                            </select>
                                        </div>
                                        <button id="remove" >Remove Date(s)</button><br>
                                    <br>
                                    
                                           
                                    
                                            <label>Fair Date:</label>
                                        <div class="input-group">
                                            <input type="text" name="bookfair_date" id="bookfair_date" class="form-control" placeholder="MM/DD/YYYY"><br>
                                        
                                        <input type="hidden" id="bookfair_id" name="bookfair_id" value="<?php echo $bookfairid;?>"/>
                                        
                                        <button id="add">Add Date</button>
                                        </div>
                                      
                                   
                            
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