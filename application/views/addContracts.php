<title>Add Contract | Project </title>


     <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title"> CONTRACT FORM</h3>
            <?php if(isset($_SESSION['success'])) { ?>
    <h3> <div class="alert alert-danger"> <?php echo $_SESSION['success']; ?></h3>
     <?php }  ?>

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
         <form method="post" enctype="multipart/form-data" action="<?php echo base_url().'user/addContracts';?>">  

                <label >Name Of Company :</label>
                    <input type="text" class="form-control" name="name_of_company" size="50" value="<?php echo set_value('name_of_company');?>">
                      <span style="color:red" class="danger" ><?php echo form_error('name_of_company'); ?> </span>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Company Website :</label>
                      <input type="url" class="form-control" name="company_website" size="50" value="<?php echo set_value('company_website');?>">
                      <span style="color:red" class="danger" ><?php echo form_error('company_website'); ?> </span>
                </div>
                <div class="form-group">
                    <label>Submitted By :</label>
                    <input type="text" class="form-control" name="sub_by" size="50" value="<?php echo set_value('sub_by');?>">
                    <span style="color:red" class="danger" ><?php echo form_error('sub_by'); ?> </span>
                  </div>
                  <div class="form-group">
                  <label> Upload File :</label>
                  <input type="file"  class="form-control" name="upload_file" value="<?php echo set_value('upload_file');?>">
                  <span style="color:red" class="danger" ><?php echo form_error('upload_file'); ?> </span>
                </div> 
                <div class="form-group">
                  <label>Blacklisted :</label>
                  <span style="width:10px;display:inline-block"></span>
                  <input type="checkbox"  name="blacklisted"  value="YES" <?php echo set_checkbox('blacklisted','NO') ?> />
                  <label>Yes</label> <span style="width:20px;display:inline-block"></span>
                  <input type="checkbox" name="blacklisted"  value="NO" <?php echo set_checkbox('blacklisted','NO',true) ?>/>
                  <label>No</label> <?php echo form_error('blacklisted');?><br>
                  <br>
                </div>
                <div class="form-group">
                <button  style="font-size:15px;" class="btn btn-primary btn-lg"  name="create">Submit</button>
                <a style="font-size:15px;" href="<?php echo base_url().'user/dashboard';?>" class="btn btn-secondary btn-lg">Cancel</a>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                <label>Employer Email :</label>
                    <input type="email" class="form-control" name="employer_email" size="50" value="<?php echo set_value('employer_email');?>">  <span style="color:red;" class="danger" ><?php echo form_error('employer_email'); ?> </span>
                </div>
                <div class="form-group">
                    <label>Employe Phone :</label>
                    <input type="tel" class="form-control" name="employer_phn" size="50" value="<?php echo set_value('employer_phn');?>">
                    <span style="color:red" class="danger" ><?php echo form_error('employer_phn'); ?> </span>
                  </div> 
                  <div class="form-group">
                    <br><br>
                  <label>Submitted For Company :</label>
                  <input type="radio"  name="sub_for_company"  value="CAT SOFTWARE" <?php echo set_radio('sub_for_company','CAT SOFTWARE',TRUE) ?>>
                  <label>CAT SOFTWARE</label>
                  <span style="width:20px;display:inline-block"></span>
                  <span style="color:red" class="danger" ><?php echo form_error('sub_by'); ?> </span>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
              </form>
          </div>
        </div>
      </div>
    </div>
            <!-- /.card -->

