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
<div class="col-md-2">Action</div>
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
<div class="col-md-2">
<a href="<?php echo base_url("admin/register_user/$d->id"); ?>" class="badge badge-primary mr-2" >Edit</a>
<?php if($d->active=='1'){ ?>

<button class="badge badge-danger user_active"  uid="<?php echo $d->id; ?>" status="0" >Deactivate</button>
<?php }else{?>
<button class="badge badge-success user_active" uid="<?php echo $d->id; ?>" status="1" >Activate</button>
<?php } ?>
</div>
</div>
<?php   }} ?>
<script>
$(".user_active").on("click",function(){
var uid = $(this).attr('uid').trim();
var status = $(this).attr('status').trim();
var button_obj = $(this);
console.log("uid = "+uid);
$.ajax({
    type:'post',
    url :'<?php echo base_url("admin/user_status") ?>',
    data:{id:uid,status:status},
    dataType:'json',
    success:function(data){ console.log(data);
        if(data.msg=='Activate'){console.log("msg = "+data.msg);
            button_obj.attr({ 
                "class" : "badge badge-success user_active",
                "status" : "1"
            });
            button_obj.text('Activate');            
        }else{ console.log("msg 0 = "+data.msg);

            button_obj.attr({
                "class" : "badge badge-danger user_active",
                "status" : "0"
            });
            button_obj.text('Deactivate');
        }
    }
});

});
</script>