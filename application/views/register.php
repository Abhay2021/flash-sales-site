<?php 
/**
 * this page is use for register user by admin
 */
?>
<div class="row mt-5">
<?php 
//echo validation_errors('<div class="alert alert-danger">', '</div>'); 
if($this->session->flashdata('error')){
echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>';
}
//print_r($user->id);exit;
if(isset($user)){ $id= $user->id;
 $image = isset($user->image)?$user->image:'' ;
 $image = base_url("uploads/user/$image");
}else{$id=$image='';}
?>
</div>
<div class="row"><a href="<?php echo base_url(); ?>admin/dashboard" class="btn btn-primary" >Dashboard</a></div>
<form id="user_add" action="<?php echo base_url("admin/save_user/$id"); ?>" method="post" enctype="multipart/form-data">
<?php 
  //CSRF Security
  $hash_name = $this->security->get_csrf_token_name();
  $hash_val = $this->security->get_csrf_hash();
  ?>
    <input type="hidden" name="<?php echo $hash_name; ?>" value="<?php echo $hash_val; ?>">
<div class="form-group row">
    <label  class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input value="<?php echo isset($user->username)?$user->username:'' ; ?>" type="text" class="req form-control" name="username" placeholder="">
      <span class="error"></span>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input value="<?php echo isset($user->email)?$user->email:''; ?>" type="email" class="req form-control" name="email" placeholder="">
      <span class="error"></span>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="<?php if(!isset($user)){echo 'req';} ?> form-control" name="password" placeholder="">
      <span class="error"><?php if(isset($user)){echo 'Leave Password blank if you don\'t want to change' ;} ?></span>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Image</label>
    <div class="col-sm-4">
      <input  type="file" class="<?php if(!isset($user)){echo 'req';} ?>" name="image" id="image" placeholder="">
      <span class="error"></span>
    </div>
    <div class="col-md-3">
    <img src="<?php echo $image; ?>" alt="image" id="previewImage" width="80px" height="80px" <?php if(!isset($user->image)){echo 'style="display:none;"';} ?> >
    </div>
  </div>
  <div class="row">
  <input value="submit" type="submit" class=" btn btn-primary" name="submit">
  </div>
  </form>
<script>
//-------------Image validation---------------
$("#image").change(function () {
        var fileExtension = ['jpg','jpeg','png','gif'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : "+fileExtension.join(', '));
            $(this).val('');
        }
        var file_size = this.files[0].size;
        var max_size = 2097152;
        if(file_size>max_size)
        { var max_size_mb = Math.round(max_size/1000000);
          alert('Oops! Sorry!','file size should not exceed '+max_size_mb+'MB limit');
          $(this).val('');
        }

        if (this.files && this.files[0]) 
        {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('#previewImage').show();
            $('#previewImage').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(this.files[0]);
        }
        
});
  $(document).ready(function () {	
	 $("#user_add").on("submit", function(e) {
			
		var status=true;		
		
		$('.req').each(function(){
		
				if($(this).val().trim()=='')
				{
					$(this).addClass('fieldisrequired');
					$(this).siblings('.error').html('This field is required').show().fadeOut(9500).css("color", "red");
					$('html,body').animate({scrollTop: $(this).offset().top}, 0);
					
					status=false;
					return false;
				}
				else
				{
					$(this).removeClass('fieldisrequired');
					$(this).siblings('.error').html('');	
			    }
			
		});

		$('.req').on("blur", function(){
			$(this).removeClass('fieldisrequired');
			$(this).siblings('.help').html('');
		});


            if(!status)
            {
                return status;
            }
            else
            {  	
            return true;
            }
		});
  });
</script>