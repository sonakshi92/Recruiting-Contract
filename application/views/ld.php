<?php require_once('includes/header.php'); ?>
<title>List Of Paper Work | Project</title>
<?php //('includes/dtsidebar.php'); ?>

<body>

<?php
 $conn = mysqli_connect('localhost', 'root', '', 'r_contracts');
 $getusers = mysqli_query($conn, "SELECT * FROM paper_work ORDER by id ASC");
?>


<div class="col-md-12 col-lg-12 col-md-offset-2">

<br>

<h1 style="text-decoration: underline;"> <b>List Of Documentation :</h1></b>
<div style="overflow-x:auto;">

<div class="table1 container">
        
  <table class="table table-striped" style="font-size:15px">
    <thead class="thead-dark">
    <thead>
        <tr>        
           <th style="text-decoration: underline;">No.</th>
            <th style="text-decoration: underline;">Name Of Candidate</th>
            <th style="text-decoration: underline;">Email</th>
            <th  style="text-decoration: underline;">Phone</th>
            <th  style="text-decoration: underline;">Employer Company Name</th>
            <th style="text-decoration: underline;">Employer Website</th>
            <th style="text-decoration: underline;">Submitted By</th>
            <th style="text-decoration: underline;">Manager Name</th>
            <th style="text-decoration: underline;">Upload File</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       <?php 
       $counter = 0;
   while($data = mysqli_fetch_array($getusers)){
    if(!$data){ ?>
        <tr>
  <td colspan="15" align="center" style=color:Dodgerblue><br><h1><b>No Documentation To Display :(</b></h1></td>
  </tr>
  <?php  } else{
           ?>
<tr>
    <td><?php echo ++$counter; ?></td>        
    <td><?php echo $data['name_of_candidate'];?></td>
    <td><?php echo $data['email'];?></td>
    <td><?php echo $data['phone'];?></td>
    <td><?php echo $data['employer_company_name'];?></td>
    <td> <span style="color:dodgerblue" type=button onClick="parent.open" ><?php echo $data['employer_website'];?></td>
    <td><?php echo $data['sub_by_rec_name'];?></td>
    <td><?php echo $data['manager_name'];?></td>
    <td><?php echo $data['upload_files'];?></td>
    <td>
        <a href="<?php echo base_url().'user/editdoc?x='.$data['id']?>" class="btn btn-primary "style="font-size:15px;">Edit</a>
        <a href="<?php echo base_url().'user/deletedoc/'.$data['id']?>" class="btn btn-danger" style="font-size:15px;">Delete</a>
    </td>
</tr>
           
           <?php  } } ?>    
        </tbody>        
</table>
    </div>
    </div>

<br>
<hr style="width:1000px;">

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
    $(document).ready(function () {
        $('#table_id').DataTable();
    });
</script>
<script>
    $(document).ready(function () {
        $('#table1').DataTable();
    });
</script>
<?php require_once('includes/footer.php'); ?>