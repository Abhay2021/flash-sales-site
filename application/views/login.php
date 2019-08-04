<div class="row mt-5">
<?php
if($this->session->flashdata('error')){
  echo '<div class="alert alert-danger">'.$this->session->flashdata('error').'</div>';
  }
if($message){
  echo '<div class="alert alert-success">'.$message.'</div>';
  }
?>
</div>
<form action="<?php echo base_url(); ?>admin/login" method="post" id="loginForm">
  <div class="form-group">
    <label >Email address</label>
    <input type="email" class="form-control req" id="" name="email"  placeholder="Enter email">
    <span class="error"></span>
  </div>
  <div class="form-group">
    <label >Password</label>
    <input type="password" class="form-control req" id="" name="password" placeholder="Password">
    <span class="error"></span>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  
</form>
<script>
  $(document).ready(function () {	
	 $("#loginForm").on("submit", function(e) {
			
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