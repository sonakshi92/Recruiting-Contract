<?php require_once('includes/header.php'); ?>
<title>Edit Contract | Project </title>
<?php require_once('includes/dtsidebar.php'); ?>

<div class="navbar navbar-dark bg-dark">
    <h3 style="color:white" ><b>Edit Contract Form</b></h3>
</div>

<div class="col-md-11 col-md-offset-1">
  
         <form method="post" enctype="multipart/form-data" action="<?php echo site_url().'user/updatedoc';?>">  
         <div class="container" style="font-size:13px;">
      

          <div class="form-group">
            <label style="text-decoration: underline;">Name Of Candidate :</label><br>
            <input type="text" name="name_of_candidate" size="50" value="<?php echo $data['name_of_candidate'];?>">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>"  id="id"> 
      
    </div>
    <div class="form-group">
      <label style="text-decoration: underline;"> E-mail Address :</label><br>
      <input type="email"  name="email" size="50" value="<?php echo $data['email'];?>">   <?php echo form_error('email');?>
        </div>
        <div class="form-group">
          <label style="text-decoration: underline;">Contact No :</label><br>
          <input type="tel" name="phone" size="50" value="<?php echo $data['phone'];?>">
          <?php echo form_error('phone');?>
        </div>
          <div class="form-group">
          <label style="text-decoration: underline;">Employee company name :</label><br>
          <input type="text" name="employer_company_name" size="50" value="<?php echo $data['employer_company_name'];?>">
          <?php echo form_error('employer_company_name');?>
        </div>

        <div class="form-group">
          <label style="text-decoration: underline;">Employer Website :</label><br>
          <input type="url" name="employer_website" size="50" value="<?php echo $data['employer_website'];?>">
          <?php echo form_error('employer_website');?>
        </div>
        <div class="form-group">
          <label style="text-decoration: underline;">Submitted By [Recruiter's Name]:</label><br>
          <input type="text" name="sub_by_rec_name" size="50" value="<?php echo $data['sub_by_rec_name'];?>">
          <?php echo form_error('sub_by_rec_name');?>
        </div>
  <div class="form-group">
          <label style="text-decoration: underline;">Manager's Name :</label><br>
          <input type="text" name="manager_name" size="50" value="<?php echo $data['manager_name'];?>">
          <?php echo form_error('manager_name');?>
        </div>

        <div class="form-group">
          <label style="text-decoration: underline;">Upload Multi Files :</label><br>          
          <input type="file" name="upload_files[]" multiple="multiple">
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
        <button type="submit" style="font-size:15px;" class="btn btn-primary btn-lg"  name="create">Update</button>
  <a style="font-size:15px;" href="<?php echo base_url().'user/dashboard';?>" class="btn btn-secondary btn-lg">Cancel</a>
</div>

</div>
</div>
</div>
<br>
</div>
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
