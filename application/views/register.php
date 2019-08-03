<?php 
echo validation_errors('<div class="alert alert-danger">', '</div>'); 
echo $this->session->flashdata('error');
?>
<div class="row"><a href="<?php echo base_url(); ?>admin/dashboard" class="btn btn-primary" >Dashboard</a></div>
<form id="user_add" action="<?php echo base_url(); ?>admin/save_user" method="post" enctype="multipart/form-data">
<div class="form-group row">
    <label  class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="req form-control" name="username" placeholder="">
      <span class="error"></span>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="req form-control" name="email" placeholder="">
      <span class="error"></span>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="req form-control" name="password" placeholder="">
      <span class="error"></span>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Image</label>
    <div class="col-sm-10">
      <input type="file" class="req" name="image" placeholder="">
      <span class="error"></span>
    </div>
  </div>
  <div class="row">
  <input type="submit" class=" btn btn-primary" name="submit">
  </div>
  </form>
  
  <script>
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