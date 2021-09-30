<?php require_once('includes/header.php'); ?>
<title>List Of Paper Work | Project</title>
<?php require_once('includes/sidebar.php'); ?>

<?php
 $conn = mysqli_connect('localhost', 'root', '', 'r_contracts');
 $getusers = mysqli_query($conn, "SELECT * FROM paper_work ORDER by id ASC");
?>

    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Of Documentations</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Documents</li>
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
                            <h3 class="card-title">Documents</h3>
                    </div>
                        <!-- /.card-header -->
                    <div class="card-body">
                        <div style="overflow-x:auto;">
                            <table id="docTable" class="table tableAll table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Name Of Candidate</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Employer Company Name</th>
                                <th>Employer Website</th>
                                <th>Submitted By</th>
                                <th>Manager Name</th>
                                <th>Upload File</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php while($data = mysqli_fetch_array($getusers)){ ?>
                            <tr>
                                <td><?php echo $data['name_of_candidate'];?></td>
                                <td><?php echo $data['email'];?></td>
                                <td><?php echo $data['phone'];?></td>
                                <td><?php echo $data['employer_company_name'];?></td>
                                <td> <span style="color:dodgerblue" type=button onClick="parent.open" ><?php echo $data['employer_website'];?></td>
                                <td><?php echo $data['sub_by_rec_name'];?></td>
                                <td><?php echo $data['manager_name'];?></td>
                                <td><?php echo $data['upload_files'];?></td>
                                <td>
                                    <a href="<?php echo base_url().'user/editdoc?x='.$data['id']?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo base_url().'user/deletedoc/'.$data['id']?>" class="btn btn-danger"> <i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>
                            <?php  } ?>    
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
    $('#docTable').DataTable({
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
