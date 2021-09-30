<?php require_once('includes/header.php'); ?>

<?php require_once('includes/sidebar.php'); ?>
<title>Dashboard | Project</title>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div>
        <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-5 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner ">
                <h3 style="text-decoration: underline;"><b>Contracts :</h3></b>
                  <h1 class="fas fa-file-alt" style="font-size:60px;"><?php echo $this->db->count_all_results('contracts'); ?> </h1>                                                     
                </div>
                
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-5 col-6">
              <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
  <h3 style="text-decoration: underline;"><b>Documentations :</h3></b>
  <h1 class="fas fa-file-alt" style="font-size:60px;"><?php echo $this->db->count_all_results('paper_work'); ?> </h1>                                                     
              </div>
                        </div>
  
        </div>
</section>
<br>
<div class="col-md-10 col-md-offset-2">
          
      <?php if(isset($_SESSION['success'])) { ?>

    
    <h3> <div class="alert alert-success"> <?php echo $_SESSION['success']; ?></div></h3>
     <?php }    ?>
<br><br>
   
  
          <hr style="width:130%">

<h1 style="text-decoration: underline;"> <b>List Of Contracts :</h1></b>
    <div class="table">
  <!-- <table id="myTable" class="table table-striped" style="font-size:14px"> -->
  <table  class="table table-striped" style="font-size:14px">
    <thead class="thead-dark">
      <tr>
            <th>No.</th>
            <th>Name Of Company</th>
            <th>Employer Email</th>
            <th>Company Website</th>
            <th>Employer Phone</th>
            <th>Submitted By</th>
            <th>Submitted For Company</th>
            <th>Upload File</th>
            <th>Blacklisted</th>
            <th style="text-center">Action</th>
            <th></th>
          </tr>
        </thead>
        <?php
  $i=1;
  if(!empty($data)){ foreach($data as $user) { ?>
 <?php
  echo "<tr>.";
  echo "<td>".$i."</td>";
  echo "<td>".$user['name_of_company']."</td>";
  echo "<td>".$user['employer_email']."</td>"; ?>
  <td> <span style="color:dodgerblue" type=button onClick="parent.open"><?php echo $user['company_website'];?></span></td>
  <?php
  echo "<td>".$user['employer_phn']."</td>";
  echo "<td>".$user['sub_by']."</td>";
  echo "<td>".$user['sub_for_company']."</td>";
  echo "<td>".$user['upload_file']."</td>";
  echo "<td>".$user['blacklisted']."</td>";
  $i++;
 ?>
<td>
  <a href="<?php echo base_url().'user/editContract?v='.$user['id']?>" class="btn btn-primary" style="font-size:15px;">Edit</a>
</td>
<td>
  <a href="<?php echo base_url().'user/delete/'.$user['id']?>" class="btn btn-danger"style="font-size:15px;">Delete</a>
</td>
</tr>
<?php } } else{ ?>
<tr>
  <td colspan="15" align="center" style=color:Dodgerblue><br><h1><b>No Contracts To Display :(</b></h1></td>
  </tr>

<?php } ?>
          </table>
          <hr>
          </div>
        
        </div>
   </div>
      </div>
    </div>
<br>

<script src="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js">



</script>
<style>
.dataTables_wrapper {
    font-family: tahoma;
    font-size: 15px;
    direction: ltr;
    position: relative;
}
</style>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<script>
    $(document).ready(function () {
        $('#table_id').DataTable();
    });
</script>
<script>
    $(document).ready(function () {
        $('#table1').DataTable();
    });
</script>

