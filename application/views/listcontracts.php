<?php require_once('includes/header.php'); ?>
<title>List Of Contract | Project</title>
<?php require_once('includes/dtsidebar.php'); ?>

<body>
<?php
 $conn = mysqli_connect('localhost', 'root', '', 'r_contracts');
 $getusers = mysqli_query($conn, "SELECT * FROM contracts ORDER by id ASC");
?>
<div class="navbar navbar-dark bg-dark">
    <h3 style="color:white"><b>List Of Contract</b></h3>
    </div>
<div class="col-sm-10 col-md-offset-2">
<thead class="thead-dark">
<div style="overflow-x:auto;">

<table id="table1" style="font-size:15px;">
    <thead>
        <tr>
            <th style="text-decoration: underline;">User Email</th>
            <th style="text-decoration: underline;">Name Of Company</th>
            <th  style="text-decoration: underline;">Employer Email</th>
            <th  style="text-decoration: underline;">Company Website</th>
            <th style="text-decoration: underline;">Employer Phone</th>
            <th style="text-decoration: underline;">Submitted By</th>
            <th style="text-decoration: underline;">Submitted For Company</th>
            <th style="text-decoration: underline;">Upload File</th>
            <th style="text-decoration: underline;">Blacklisted</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       <?php 
       while($data = mysqli_fetch_array($getusers)){
           ?>
           <tr>
           <td><?php echo $data['user_email_id'];?></td>
        <td><?php echo $data['name_of_company'];?></td>
    <td><?php echo $data['employer_email'];?></td>
    <td> <span style="color:dodgerblue" type=button onClick="parent.open" ><?php echo $data['company_website'];?></td>
    <td><?php echo $data['employer_phn'];?></td>
    <td><?php echo $data['sub_by'];?></td>
    <td><?php echo $data['sub_for_company'];?></td>
    <td><?php echo $data['upload_file'];?></td>
    <td><?php echo $data['blacklisted'];?></td>
    
    <td>
  <a href="<?php echo base_url().'user/editContract?v='.$data['id']?>" class="btn btn-warning" >-</a>
  <a href="<?php echo base_url().'user/delete/'.$data['id']?>" class="btn btn-danger">x</a>
</td>
    </tr>
           
           <?php
       }
?>    
        </tbody>        
</table>
    </div>
<br>

</div>
<br>
<script src="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js">

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
<?php require_once('includes/footer.php'); ?>
