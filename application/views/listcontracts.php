<?php require_once('includes/header.php'); ?>
<title>List Of Contract | Project</title>
<?php require_once('includes/sidebar.php'); ?>

<body>
<?php
 $conn = mysqli_connect('localhost', 'root', '', 'r_contracts');
 $getusers = mysqli_query($conn, "SELECT * FROM contracts ORDER by id ASC");
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Of Contracts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Contracts</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section> 

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                            <h3 class="card-title"> Contracts </h3>
                    </div>
                        <!-- /.card-header -->
                    <div class="card-body">
                        <div style="overflow-x:auto;">
                            <table id="conTable" class="table tableAll table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>User Email</th>
                                <th>Name Of Company</th>
                                <th>Employer Email</th>
                                <th>Company Website</th>
                                <th>Employer Phone</th>
                                <th>Submitted By</th>
                                <th>Submitted For Company</th>
                                <th>Upload File</th>
                                <th>Blacklisted</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                <?php while($data = mysqli_fetch_array($getusers)){?>
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
                                    <a href="<?php echo base_url().'user/editContract?v='.$data['id']?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo base_url().'user/delete/'.$data['id']?>" class="btn btn-danger"> <i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                                
                                <?php }  ?>      
                            </tbody>
                            <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
        <!-- /.content -->

<script>
  $(function () {
    $('#conTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<?php require_once('includes/footer.php'); ?>
