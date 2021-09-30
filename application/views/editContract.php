<?php require_once('includes/header.php'); ?>
<title>Edit Contract | Project </title>
<?php require_once('includes/dtsidebar.php'); ?>

<div class="navbar navbar-dark bg-dark">
    <h3 style="color:white" ><b>Edit Contract Form</b></h3>
</div>

<div class="col-md-11 col-md-offset-1">
  
         <form method="post" enctype="multipart/form-data" action="<?php echo site_url().'user/update';?>">  
         <div class="container" style="font-size:13px;">
      

          <div class="form-group">
            <label style="text-decoration: underline;">Name Of Company :</label><br>
            <input type="text" name="name_of_company" size="50" value="<?php echo $user['name_of_company'];?>">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>"> 
    </div>
    <div class="form-group">
      <label style="text-decoration: underline;">Employer Email :</label><br>
      <input type="email"  name="employer_email" size="50" value="<?php echo $user['employer_email'];?>">   <?php echo form_error('employer_email');?>
        </div>
        <div class="form-group">
          <label style="text-decoration: underline;">Company Website :</label><br>
          <input type="url" name="company_website" size="50" value="<?php echo $user['company_website'];?>">
          <?php echo form_error('company_website');?>
        </div>
          <div class="form-group">
          <label style="text-decoration: underline;">Employer Phone :</label><br>
          <input type="tel" name="employer_phn" size="50" value="<?php echo $user['employer_phn'];?>">
          <?php echo form_error('employer_phn');?>
        </div>

  <div class="form-group">
          <label style="text-decoration: underline;">Submitted By :</label><br>
          <input type="text" name="sub_by" size="50" value="<?php echo $user['sub_by'];?>">
          <?php echo form_error('sub_by');?>
        </div>

        <label style="text-decoration: underline;">Submitted For Company :</label>
<br>
<input style="font-size:15px;" type="radio" name="sub_for_company"  value="CAT SOFTWARE" <?php echo set_radio('sub_for_company','CAT SOFTWARE', TRUE) ?>>
<label>CAT SOFTWARE</label><span style="width:20px;display:inline-block"></span>
<?php echo form_error('sub_for_company');?>
<br>

<div class="form-group">
          <label style="text-decoration: underline;">Upload File :</label><br>          
          <input type="file" name="upload_file" size="50">  
          <img src="<?php echo base_url().$user['upload_file'];?>" style="width:100px;height:100px;margin-top:3px;">
          <input type="hidden" name="old_img_file" value="<?= $user['upload_file'];?>">
        <?php  if($this->session->flashdata('error')){echo $this->session->flashdata('error');}?>
        </div>
        
<label style="text-decoration: underline;">Blacklisted :</label>
<span style="width:10px;display:inline-block"></span>
<input type="checkbox" name="blacklisted"  value="YES" <?php echo set_checkbox('blacklisted','YES') ?> />
<label>Yes</label> <span style="width:20px;display:inline-block"></span>
<input type="checkbox" name="blacklisted"  value="NO" <?php echo set_checkbox('blacklisted','NO',true) ?>/>
<label>No</label> <?php echo form_error('blacklisted');?><br>
<br>

  <button type="submit" style="font-size:15px;" class="btn btn-primary btn-lg">Update</button>
  <a style="font-size:15px;" href="<?php echo base_url().'user/dashboard';?>" class="btn btn-secondary btn-lg">Cancel</a>
</div>

</div>
</div>
</div>
<br>
</div>

<?php require_once('includes/footer.php'); ?>

