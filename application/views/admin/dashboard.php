<div class="row"><h2>Admin Dashboard</h2></div>
<div class="row m-2">
<a href="<?php echo base_url(); ?>/admin/add_deals" class="btn btn-primary" >Add Deals</a>
<a href="<?php echo base_url("admin/logout"); ?>" class="btn btn-danger" >Log out</a>
</div>
<div class="row">
<div class="col-md-2">Title</div>
<div class="col-md-2">Description</div>
<div class="col-md-1">Total Quantity</div>
<div class="col-md-1">Remaining Quantity</div>
<div class="col-md-1">Price</div>
<div class="col-md-1">Discounted price</div>
<div class="col-md-2">publish date</div>
<div class="col-md-2">image</div>
</div>
<?php 
if($deals){
foreach($deals as $key =>$d){
?>
<div class="row">
<div class="col-md-2"><?php echo $d->title; ?></div>
<div class="col-md-2"><?php echo $d->description; ?></div>
<div class="col-md-1"><?php echo $d->quantity; ?></div>
<div class="col-md-1"><?php echo $d->remaining_quantity; ?></div>
<div class="col-md-1"><?php echo $d->price; ?></div>
<div class="col-md-1"><?php echo $d->discounted_price; ?></div> 
<div class="col-md-2"><?php echo $d->publish_date; ?></div> 
<div class="col-md-2"><?php $img = base_url()."/uploads/".$d->image; ?>
<img src="<?php echo $img; ?>" alt="image" class="img-fluid" width="100px" height="100px" >
</div> 

</div>
<?php }} ?>