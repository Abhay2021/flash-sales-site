<div class="row"><h2>Users</h2></div>
<div class="row">
<a href="<?php echo base_url(); ?>admin/dashboard" class="btn btn-primary" >Dashboard</a>
<a href="<?php echo base_url(); ?>admin/register_user" class="btn btn-dark" >Add User</a>
<a href="<?php echo base_url("user/logout"); ?>" class="btn btn-danger" >Log out</a>
</div>
<div class="row mb-2">
<div class="col-md-2">Image</div>
<div class="col-md-2">Username</div>
<div class="col-md-2">Email</div>
</div>
<?php 
if($user){ 
foreach($user as $key =>$d){ //print_r($d);
?>
<div class="row mb-5">
<div class="col-md-2"><?php $img = base_url()."uploads/user/".$d->image; ?>
<img src="<?php echo $img; ?>" alt="image" class="img-fluid" width="50px" height="50px" >
</div> 
<div class="col-md-2"><?php echo $d->username; ?></div>
<div class="col-md-2"><?php echo $d->email; ?></div> 
</div>
<?php   }} ?>