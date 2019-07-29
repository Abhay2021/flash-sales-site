<?php 
echo validation_errors('<div class="alert alert-danger">', '</div>'); 
echo $this->session->flashdata('error');
?>
<div class="card m-5">
<div class="row"><h2>Add Deals</h2></div>
<form id="deals_add" method="post"  action="<?php echo base_url(); ?>/admin/save_deals" enctype="multipart/form-data" >
<div class="row mt-5">
    <div class="form-group col-md-6">
        <label for="title" class="col-sm-2 col-form-label">Title</label>
        <div class="col-sm-10">
        <input name="title" type="text" class="form-control req" id="title" placeholder="title">
        <span class="error"></span>
        </div>
    </div>
    <div class="col-md-6">
        <label for="description" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
        <textarea name="description" type="text" class="form-control req" id="description" ></textarea>
        <span class="error"></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6">
        <label for="price" class="col-sm-2 col-form-label">Price</label>
        <div class="col-sm-10">
        <input name="price" type="text" class="form-control req" id="price" placeholder="price">
        <span class="error"></span>
        </div>
    </div>
    <div class="col-md-6">
        <label for="discount" class="col-sm-2 col-form-label">Discounted Price</label>
        <div class="col-sm-10">
        <input name="discount" type="text" class="form-control req" id="discount" placeholder="discounted price">        
        <span class="error"></span>
        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6">
        <label for="quantity" class="col-sm-2 col-form-label">quantity</label>
        <div class="col-sm-10">
        <input name="quantity" type="text" class="form-control req" id="quantity" placeholder="quantity">
        <span class="error"></span>
        </div>
    </div>
    <div class="col-md-6">
        <label for="date" class="col-sm-2 col-form-label">Publish date</label>
        <div class="col-sm-10">
        <input name="date" type="date" class="form-control req" id="date" placeholder="dd/mm/yy"> 
        <span class="error"></span>       
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <label for="image" class="col-sm-2 col-form-label">Image</label>
        <div class="col-sm-10">
        <input  name="image" type="file" class=" req" id="image">
        <span class="error"></span>
        </div>
    </div>
</div>
<div class="row">
<input  type="submit" class="btn btn-primary" name="submit">
</div>
</form>
</div>            
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
//-----------checking date for dublication------------
var date = <?php echo json_encode($date); ?>;
$('#date').on('change',function(){
var publish_date = $(this).val();
if(jQuery.inArray(publish_date, date) !== -1){
    $(this).val('');
    alert('this date is already reserved for other deals. Please select other date');
}
});

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
        
});

$(document).ready(function () {	
	$("#deals_add").on("submit", function(e) {
			
		var status=true;		
		
		$('.req').each(function(){
		
				if($(this).val().trim()=='')
				{
					$(this).addClass('fieldisrequired');
					$(this).siblings('.error').html('This field is required').show().fadeOut(9500).css("color", "red");
					$('html,body').animate({scrollTop: $(this).offset().top}, 0);
					$('#Error_msg').empty();
					$('#Error_msg').html('Please fill the required fields shown in red box');
					$('#Error_msg').css("color", "red");
					status=false;
					return false;
				}
				else
				{
					$(this).removeClass('fieldisrequired');
					$(this).siblings('.error').html('');	
			}
			
		});

		$('.important').on("blur", function(){
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