<?php require_once('includes/header.php'); ?>
<title>Edit Contract | Project </title>
<?php require_once('includes/sidebar.php'); ?>
<?php require_once('includes/header.php');?>
<title>Add Documentation | Project</title>
<?php require_once('includes/sidebar.php'); ?>

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
                <form method="post" enctype="multipart/form-data" action="<?php echo site_url().'user/updatedoc';?>">  
                  <label>Name Of Candidate :</labele=><br>
                  <input type="text" class="form-control" name="name_of_candidate" size="50" value="<?php echo $data['name_of_candidate'];?>">
                  <input type="hidden" name="id" value="<?php echo $data['id']; ?>"  id="id"> 
                </div>
                <div class="form-group">
                <label>Contact Number :</label><br>
                <input type="tel" class="form-control" name="phone" size="50" value="<?php echo $data['phone'];?>">
                  <?php echo form_error('phone');?>
                </div>
                <div class="form-group">
                  <label>Employer Website :</label><br>
                  <input type="url" class="form-control" name="employer_website" size="50" value="<?php echo $data['employer_website'];?>">
                  <?php echo form_error('employer_website');?>
                </div>                
                <div class="form-group">
                  <label>Manager's Name :</label><br>
                  <input type="text" class="form-control" name="manager_name" size="50" value="<?php echo $data['manager_name'];?>">
                  <?php echo form_error('manager_name');?>
                </div>
                <button type="submit" style="font-size:15px;" class="btn btn-primary btn-lg"  name="create">Update</button>
                <a style="font-size:15px;" href="<?php echo base_url().'user/dashboard';?>" class="btn btn-secondary btn-lg">Cancel</a>
              </div>
              <!-- /.col -->


              <div class="col-md-6">
              <div class="form-group">
                <label> E-mail Address :</label><br>
                <input type="email" class="form-control" name="email" size="50" value="<?php echo $data['email'];?>">   <?php echo form_error('email');?>
              </div>
        
              <div class="form-group">
              <label>Employee company name :</label><br>
              <input type="text" class="form-control" name="employer_company_name" size="50" value="<?php echo $data['employer_company_name'];?>">
              <?php echo form_error('employer_company_name');?>
            </div>

            
            <div class="form-group">
              <label>Submitted By [Recruiter's Name]:</label><br>
              <input type="text" class="form-control" name="sub_by_rec_name" size="50" value="<?php echo $data['sub_by_rec_name'];?>">
              <?php echo form_error('sub_by_rec_name');?>
            </div>
    

            <div class="form-group">
              <label>Upload Multi Files :</label><br>          
              <input type="file" class="form-control" name="upload_files[]" multiple="multiple">
              <?php
                $files = $data['upload_files'];
                if($files!=""){
                $v=  explode(",",$files);
                $id = $data['id'];
                foreach($v as $key=>$imgval){
                  echo  '<div class="card" id="del-'.$imgval.'"  style="height:100px;width:100px;float:left;margin-top:5px;margin-left:8px;border:0px !important"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="position: absolute;color:red;cursor: pointer;" title="delete" onclick="deleteImg('."'".$imgval."'".')"></span><br>';
                  echo '<img class="card-img-top" src="'.base_url().'doc_folder/'.$imgval.'"></div>';
                  
                }
                echo '<div style="clear:both;"></div>';
                }
              ?> 
              <?php //echo $data['upload_files'];?>
              <?php echo form_error('upload_files');?>

        
              </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
            <!-- /.card -->

<?php require_once('includes/footer.php'); ?>

<script>
function deleteImg(imgnm){
  var id = $("#id").val();
  $.ajax({
    url:"<?= site_url('User/deleteImg');?>",
    type:"POST",
    data:{id:id,imgnm:imgnm},
    success:function(response){
      alert(response);
    }

  })
}
</script>

<?php require_once('includes/footer.php'); ?>
