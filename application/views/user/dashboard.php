<div class="row"><h2>User Dashboard</h2></div>
<div class="row">
<a href="<?php echo base_url("user/index/$uid"); ?>" class="btn btn-primary" >Shop More</a>
<a href="<?php echo base_url("user/logout"); ?>" class="btn btn-danger" >Log out</a>
</div>
<h2>Your Orders</h2>
<div class="row">
<div class="col-md-2">Title</div>
<div class="col-md-2">Description</div>
<div class="col-md-1">Price (Rs)</div>
<div class="col-md-1">Discounted price (Rs)</div>
<div class="col-md-1">Extra Shopping discount (%)</div>
<div class="col-md-1">Final discounted price (Rs)</div>
<div class="col-md-2">image</div>
</div>
<?php 
if($deals){
foreach($deals as $key =>$d){
?>
<div class="row">
<div class="col-md-2"><?php echo $d->title; ?></div>
<div class="col-md-2"><?php echo $d->description; ?></div>
<div class="col-md-1"><?php echo $d->price; ?></div>
<div class="col-md-1"><?php echo $d->discounted_price; ?></div>
<div class="col-md-1"><?php echo $user_discount?$user_discount:'0'; ?></div>
<div class="col-md-1"><?php $user_discount = $user_discount/100;
$discount_price= $user_discount*$d->discounted_price;
$user_discounted_price = $d->discounted_price - $discount_price;
echo $discount_price?$discount_price:$d->discounted_price;
?></div> 
<div class="col-md-2"><?php $img = base_url()."/uploads/".$d->image; ?>
<img src="<?php echo $img; ?>" alt="image" class="img-fluid" width="100px" height="100px" >
</div> 

</div>
<?php }} ?>