<?php 
//  the header.php file handles all login functions
     include('view/header.php');
 
?>

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary"><form method="post" action="cart.php?action=add">
        <div class="panel-heading">Cool Emoji</div>
        <div class="panel-body"><img src="images/emoji_cool.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">$3.00<input class="pull-right" type="submit" value="Add to cart">
          <input type="text" hidden="hidden" value="Cool Emoji" name="product">
            <input type="text" hidden="hidden" value="3" name="price">       
            <input type="text" hidden="hidden" value="1" name="id">
            </div></form>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary"><form method="post" action="cart.php?action=add">
        <div class="panel-heading">Nerd Emoji</div>
        <div class="panel-body"><img src="images/emoji_glasses.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">$4.00<input class="pull-right" type="submit" value="Add to cart">
          <input type="text" hidden="hidden" value="Nerd Emoji" name="product">
            <input type="text" hidden="hidden" value="4" name="price">       
            <input type="text" hidden="hidden" value="2" name="id">
            </div></form>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger"><form method="post" action="cart.php?action=add">
        <div class="panel-heading">SALE! Loving Emoji</div>
        <div class="panel-body"><img src="images/emoji_love.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">$2.00<input class="pull-right" type="submit" value="Add to cart">
          <input type="text" hidden="hidden" value="Loving Emoji" name="product">
            <input type="text" hidden="hidden" value="2" name="price">       
            <input type="text" hidden="hidden" value="3" name="id">
            </div></form>
      </div>
    </div>
  </div>
</div><br>

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary"><form method="post" action="cart.php?action=add">
        <div class="panel-heading">Scared Emoji</div>
        <div class="panel-body"><img src="images/emoji_scared.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">$3.00<input class="pull-right" type="submit" value="Add to cart">
          <input type="text" hidden="hidden" value="Scared Emoji" name="product">
            <input type="text" hidden="hidden" value="3" name="price">       
            <input type="text" hidden="hidden" value="4" name="id">
            </div></form>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary"><form method="post" action="cart.php?action=add">
        <div class="panel-heading">Silly Emoji</div>
        <div class="panel-body"><img src="images/emoji_silly.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">$4.00<input class="pull-right" type="submit" value="Add to cart">
          <input type="text" hidden="hidden" value="Silly Emoji" name="product">
            <input type="text" hidden="hidden" value="4" name="price">       
            <input type="text" hidden="hidden" value="5" name="id">
            </div></form>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary"><form method="post" action="cart.php?action=add">
        <div class="panel-heading">Whining Emoji</div>
        <div class="panel-body"><img src="images/emoji_whiner.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">$5.00<input class="pull-right" type="submit" value="Add to cart">
            <input type="text" hidden="hidden" value="Whining Emoji" name="product">
            <input type="text" hidden="hidden" value="5" name="price">       
            <input type="text" hidden="hidden" value="6" name="id">
            </div></form>
      </div>
    </div>
  </div>
</div><br><br>

<?php
include('view/footer.php');
  
?>