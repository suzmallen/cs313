<?php  
include("view/header.php");?>

<div class="panel-group col-sm-10">
    <div class="panel panel-default">
        <div class="panel-heading">Your Shopping Cart</div>
        <div class="panel-Body">
<table class="table-bordered table-striped table-responsive">
    <tr>
    <th>
    Product
    </th><th>Price</th></tr>
<?php
    $cart = $_SESSION['cart'];
    //var_dump($cart);
    $totalprice = 0.00;
    foreach ($cart as $productinfo) { ?>
        <tr><td><?php echo $productinfo['product']; ?></td><td><?php 
                                     $curprice = floatval($productinfo['price']);
                                     $totalprice = $totalprice + $curprice;
                                     setlocale(LC_MONETARY, 'en_US');
                                     printf("$%01.2f", $curprice); ?></td>
     </tr>
         <?php   
        }
    ?>
    <tr><th>Total</th><th><?php printf("$%01.2f", $totalprice); ?></th></tr>
</table>
</div>
        </div>
        </div>

<div class="panel-group col-sm-10">
    <div class="panel panel-default">
        <div class="panel-heading">Please Enter Your Shipping Information</div>
        <div class="panel-Body">
<form id="personalInfo" method="post" action="confirmation.php">
<label>First Name:</label><input type="text" id="txtFName" name="txtFName" size="25"> &nbsp; &nbsp;
    <label class="equalwidth" >Last Name:</label><input type="text" id="txtLName" name="txtLName" size="25"><br>
    <label class="equalwidth">Address1:</label><input type="text" id="txtAddress1" name="txtAddress1" size="50"><br>
    <label class="equalwidth">Address2:</label><input type="text" id="txtAddress2" name="txtAddress2" size="50"><br>
    <label class="equalwidth">City:&nbsp; &nbsp; &nbsp;</label><input type="text" id="txtCity" name="txtCity" size="25"> &nbsp; &nbsp;
    <label class="equalwidth">State:&nbsp; &nbsp;</label><input type="text" id="txtState" name="txtState" size="2"><br>
    <label class="equalwidth">Zip:&nbsp; &nbsp;&nbsp; &nbsp;</label><input type="text" id="txtZip" name="txtZip" size="10"><br>
    <input type="submit" value="Place Order"><br>
    
</form> 
</div>
        </div>
        </div>

