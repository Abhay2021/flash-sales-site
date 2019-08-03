<form action="<?php echo base_url(); ?>admin/login" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label >Email address</label>
    <input type="email" class="form-control" id="" name="email"  placeholder="Enter email">
    
  </div>
  <div class="form-group">
    <label >Password</label>
    <input type="password" class="form-control" id="" name="password" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  
</form>