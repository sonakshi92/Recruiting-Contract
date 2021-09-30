
<div class="navbar navbar-dark bg-dark"><h2 style="color:white"><b>Documentation  Form</h2></b>
</div>

<div class="col-md-5">

<?php if(isset($_SESSION['success'])) { ?>
    
    <h3> <div class="alert alert-success"> <?php echo $_SESSION['success']; ?></h3>
     <?php }  ?></div>
<div class="container" style="font-size:13px;">
                   
         <form method="post" enctype="multipart/form-data" action="<?php echo base_url().'user/addpaperwork';?>">  
        <div class="col-md-5">
          <div class="form-group">
            <label style="text-decoration: underline;">Name Of Candidate :</label>
            <input type="text" name="name_of_candidate" size="50" value="<?php echo set_value('name_of_candidate');?>">
            <span style="color:red" class="danger" ><?php echo form_error('name_of_candidate'); ?> </span>
    </div>
    <div class="form-group">
      <label style="text-decoration: underline;">E-mail Address :</label>
      <input type="email"  name="email"  size="50" value="<?php echo set_value('email');?>">
      <span style="color:red;" class="danger" ><?php echo form_error('email'); ?> </span>
        </div>
        <div class="form-group">
          <label style="text-decoration: underline;">Contact Number :</label>
          <input type="tel" name="phone"  size="50" value="<?php echo set_value('phone');?>">
          <span style="color:red" class="danger" ><?php echo form_error('phone'); ?> </span>
        </div>
        <div class="form-group">
          <label style="text-decoration: underline;">Employer Company Name:</label>
          <input type="text" name="employer_company_name" size="50" value="<?php echo set_value('employer_company_name');?>">
          <span style="color:red" class="danger" ><?php echo form_error('employer_company_name'); ?> </span>
        </div>
        <div class="form-group">
          <label style="text-decoration: underline;">Employee Website :</label>
          <input type="url" name="employer_website"  size="50" value="<?php echo set_value('employer_website');?>">
          <span style="color:red" class="danger" ><?php echo form_error('employer_website'); ?> </span>
        </div>
          <div class="form-group">
          <label style="text-decoration: underline;">Submitted By (Recruiter's Name) :</label>
          <input type="text" name="sub_by_rec_name" size="50" value="<?php echo set_value('sub_by_rec_name');?>">
          <span style="color:red" class="danger" ><?php echo form_error('sub_by_rec_name'); ?> </span>
        </div>
        <div class="form-group">
          <label style="text-decoration: underline;">Manager Name :</label>
          <input type="text" name="manager_name" size="50" value="<?php echo set_value('manager_name');?>">
          <span style="color:red" class="danger" ><?php echo form_error('manager_name'); ?> </span>
        </div>

        <div class="form-group">
<label style="text-decoration: underline;"> Upload Multi Files :</label>
<br>
<input type="file" name="upload_files[]" multiple="multiple">
    <small> <?php if(isset($errorfile)) { echo $errorfile; } ?></small>
        </div> 
<br>
  <input type="submit"  style="font-size:15px;" class="btn btn-primary btn-lg"  name="create" value="Submit">
  <a style="font-size:15px;" href="<?php echo base_url().'user/dashboard';?>" class="btn btn-secondary btn-lg">Cancel</a>
</div>

</div>
</div>
</div>
<br>
</div>

