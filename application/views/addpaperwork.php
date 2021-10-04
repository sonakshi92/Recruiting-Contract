<title>Add Documentation | Project</title>

<div class="col-md-5">

  <?php if(isset($_SESSION['success'])) { ?>
    <h3> <div class="alert alert-success"> <?php echo $_SESSION['success']; ?></h3>
     <?php }  ?>
</div>

     <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title"> DOCUMENTATION FORM</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <form method="post" enctype="multipart/form-data" action="<?php echo base_url().'user/addpaperwork';?>">  
                  <label>Name Of Candidate :</label>
                  <input type="text" class="form-control" name="name_of_candidate" size="50" value="<?php echo set_value('name_of_candidate');?>">
                  <span style="color:red" class="danger" ><?php echo form_error('name_of_candidate'); ?> </span>
                </div>
                <div class="form-group">
                  <label>Contact Number :</label>
                  <input type="tel" class="form-control" name="phone"  size="50" value="<?php echo set_value('phone');?>">
                  <span style="color:red" class="danger" ><?php echo form_error('phone'); ?> </span>
                </div>
                <div class="form-group">
                  <label>Employee Website :</label>
                  <input type="url" class="form-control" name="employer_website"  size="50" value="<?php echo set_value('employer_website');?>">
                  <span style="color:red" class="danger" ><?php echo form_error('employer_website'); ?> </span>
                </div>
                
                <div class="form-group">
                  <label>Manager Name :</label>
                  <input type="text" class="form-control" name="manager_name" size="50" value="<?php echo set_value('manager_name');?>">
                  <span style="color:red" class="danger" ><?php echo form_error('manager_name'); ?> </span>
                </div>
                 <input type="submit"  style="font-size:15px;" class="btn btn-primary btn-lg"  name="create" value="Submit">
                  <a style="font-size:15px;" href="<?php echo base_url().'user/dashboard';?>" class="btn btn-secondary btn-lg">Cancel</a>
              </div>
              <!-- /.col -->


              <div class="col-md-6">
                <div class="form-group">
                  <label>E-mail Address :</label>
                  <input type="email" class="form-control"  name="email"  size="50" value="<?php echo set_value('email');?>">
                  <span style="color:red;" class="danger" ><?php echo form_error('email'); ?> </span>
                </div>
                <div class="form-group">
                  <label>Employer Company Name:</label>
                  <input type="text" class="form-control" name="employer_company_name" size="50" value="<?php echo set_value('employer_company_name');?>">
                  <span style="color:red" class="danger" ><?php echo form_error('employer_company_name'); ?> </span>
                </div> 
                <div class="form-group">
                  <label>Submitted By (Recruiter's Name) :</label>
                  <input type="text" class="form-control" name="sub_by_rec_name" size="50" value="<?php echo set_value('sub_by_rec_name');?>">
                  <span style="color:red" class="danger" ><?php echo form_error('sub_by_rec_name'); ?> </span>
                </div>
                <div class="form-group">
                  <label> Upload Multi Files :</label>
                    <input type="file" class="form-control" name="upload_files[]" multiple="multiple">
                    <small> <?php if(isset($errorfile)) { echo $errorfile; } ?></small>
                  <span style="color:red" class="danger" ><?php echo form_error('upload_files[]'); ?> </span>

                </div> 
              </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
            <!-- /.card -->

