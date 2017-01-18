<?php  
include("view/header.php");?>
<h1>Your Order is Complete</h1>
<div class="panel-group col-sm-10">
    <div class="panel panel-default">
        <div class="panel-heading">Items Purchased</div>
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
        <div class="panel-heading">Items will be sent to:</div>
        <div class="panel-Body">

    <label class="equalwidth" ><?php echo $_POST['txtFName'].' '.$_POST['txtLName'];?></label><br>
    <label class="equalwidth"><?php echo $_POST['txtAddress1'].'<br>'.$_POST['txtAddress2'];?></label><br>
    <label class="equalwidth"><?php echo $_POST['txtCity'].','.$_POST['txtState'].'  '.$_POST['txtZip'];?></label><br>
  

</div>
        </div>
        </div>
<?php
    $cart = $_SESSION['cart'];
    //var_dump($cart);
    
    foreach ($cart as $productinfo) { 
         unset($_SESSION['cart'][$productinfo['id']]); //remove the item from the cart                   
    
        }
    ?>
<?php
include('view/footer.php');
  
?>