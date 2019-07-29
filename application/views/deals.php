<div class="card">
<div class="row">
<h2>Today Flash Deals</h2>
</div>
<?php 
if($deals){ 
foreach($deals as $key =>$d){
    if(!$deals_ids){ $deals_ids =[];}
        if (in_array($d->id, $deals_ids))
        {
        
        }
        else
        {?>
        <div class="row">
        <a href="<?php echo base_url("/user/buy/$uid/$d->id"); ?>" onclick="return confirm('Do you confirm the order?')" class="btn btn-primary">Buy Now</a>
        </div>
    <?php    }  
?>

<div class="row">
    <div class="col-md-8">
        <div class="row"><h5>Title : <?php echo $d->title; ?></h5> </div>
        <div class="row"><h5>Description : <?php echo $d->description; ?></h5></div>
        <!-- <div class="row"><h5>Tota : </h5><?php // echo $d->quantity; ?></div> -->
        <div class="row"><h5>Price (Rs) : <?php echo $d->price; ?></h5></div>
        <div class="row"><h5>Discounted price (Rs) : <?php echo $d->discounted_price; ?></h5></div> 
        <!-- <div class="row"><h5> : </h5><?php //echo $d->publish_date; ?></div>  -->
       
         
    </div>
    <div class="col-md-4">
    <?php $img = base_url()."/uploads/".$d->image; ?>
    <img src="<?php echo $img; ?>" alt="image" class="img-fluid" width="300px" height="300px" >
        </div>
    </div>
</div>
<?php }} ?>
</div>