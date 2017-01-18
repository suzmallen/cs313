<?php 
//  the header.php file handles all login functions
     include('view/header.php');
 
?>

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Cool Emoji</div>
        <div class="panel-body"><img src="images/emoji_cool.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">$3.00<button onClick="window.location='cart.php?action=add&product=Cool%20Emoji&price=3&id=1'"class="pull-right" type="button">Add to cart</button></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Nerd Emoji</div>
        <div class="panel-body"><img src="images/emoji_glasses.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">$4.00<button onClick="window.location='cart.php?action=add&product=Nerd%20Emoji&price=4&id=2'"class="pull-right" type="button">Add to cart</button></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger">
        <div class="panel-heading">SALE! Loving Emoji</div>
        <div class="panel-body"><img src="images/emoji_love.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">$2.00<button onClick="window.location='cart.php?action=add&product=Loving%20Emoji&price=2&id=3'"class="pull-right" type="button">Add to cart</button></div>
      </div>
    </div>
  </div>
</div><br>

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Scared Emoji</div>
        <div class="panel-body"><img src="images/emoji_scared.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">$3.00<button onClick="window.location='cart.php?action=add&product=Scared%20Emoji&price=3&id=4'"class="pull-right" type="button">Add to cart</button></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Silly Emoji</div>
        <div class="panel-body"><img src="images/emoji_silly.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">$4.00<button onClick="window.location='cart.php?action=add&product=Silly%20Emoji&price=4&id=5'"class="pull-right" type="button">Add to cart</button></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Whining Emoji</div>
        <div class="panel-body"><img src="images/emoji_whiner.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer">$5.00<button onClick="window.location='cart.php?action=add&product=Whining%20Emoji&price=5&id=6'" class="pull-right" type="button">Add to cart</button></div>
      </div>
    </div>
  </div>
</div><br><br>

<?php
include('view/footer.php');
  
?>