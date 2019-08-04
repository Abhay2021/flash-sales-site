<div class="row mt-5">
<?php 
//echo validation_errors('<div class="alert alert-danger">', '</div>'); 
if($this->session->flashdata('error')){
echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>';
}
?>
</div>
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
    <div class="col-sm-4">
      <input type="file" class="req" name="image" id="image" placeholder="">
      <span class="error"></span>
    </div>
    <div class="col-md-3">
    <img src="#" alt="image" id="previewImage" width="80px" height="80px" style="display:none;">
    </div>
  </div>
  <div class="row">
  <input type="submit" class=" btn btn-primary" name="submit">
  </div>
  </form>
<script>
//-------------Image validation---------------
$("#image").change(function () {
        var fileExtension = ['jpg','png','gif'];
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