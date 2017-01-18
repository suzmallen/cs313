<?php
include("view/header.php");



if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'remove') {
        $id = $_GET['id'];
        unset($_SESSION['cart'][$id]); //remove the item from the cart
    }
    if ($action == 'add') {
        $id = $_GET['id'];
        $product = $_GET['product'];
        $price = $_GET['price'];
    
        $_SESSION['cart'][$id]['product'] = $product;
        $_SESSION['cart'][$id]['price'] = $price;
        $_SESSION['cart'][$id]['id'] = $id;
    
    }
    
    
    
//below code might be useful
//$_SESSION['cart'][$id]['quantity']++; // another of this item to the cart

  
}

?>
<h1>Your Shopping Cart</h1>
<div class="col-sm-12">
<table class="table-bordered table-striped table-responsive">
    <tr>
    <th>
    Product
    </th><th>Price</th><th></th></tr>
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
     <td><button onClick="window.location='cart.php?action=remove&id=<?php echo $productinfo['id']; ?>'">Remove</button></td></tr>
         <?php   
        }
         
    

    ?>
    <tr><th>Total</th><th><?php printf("$%01.2f", $totalprice); ?></th><th></th></tr>
</table>
    
    <br><br><button onClick="window.location='checkout.php'">Check Out</button><div><br><br><a href="index.php">Return to Store</a></div>
    </div>

<?php
include('view/footer.php');
  
?>
