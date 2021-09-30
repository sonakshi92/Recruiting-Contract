<?php require_once('includes/header.php'); ?>

<?php require_once('includes/sidebar.php'); ?>
<title>Dashboard | Project</title>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $this->db->count_all_results('contracts'); ?></h3>
                <p>Contracts</p>
              </div>
              <div class="icon">
              <i class="fa fa-pencil-square"></i>

              </div>
              <a href="addContracts" class="small-box-footer"> Add More Contracts <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $this->db->count_all_results('paper_work');?></h3>
                <p>Documents</p>
              </div>
              <div class="icon">
              <i class="fa fa-file" style="font-size:50px;"></i>

              </div>
              <a href="addpaperwork" class="small-box-footer">Add More Documents <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>0<?php //echo $this->db->count_all_results('contracts'); ?></h3>
                <p>User</p>
              </div>
              <div class="icon">
              <i class="fa fa-user"></i>

              </div>
              <a href="addContracts" class="small-box-footer"> Add User <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>0<?php //echo $this->db->count_all_results('paper_work');?></h3>
                <p>views</p>
              </div>
              <div class="icon">
              <i class="fa fa-bar" style="font-size:50px;"></i>

              </div>
              <a href="addpaperwork" class="small-box-footer"> View <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- /.content -->
        </div>
      </div>
    </section>
    <?php
 $conn = mysqli_connect('localhost', 'root', '', 'r_contracts');
 $getusers = mysqli_query($conn, "SELECT * FROM contracts ORDER by id ASC");
?>

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





          
          <?php
 $conn = mysqli_connect('localhost', 'root', '', 'r_contracts');
 $getusers = mysqli_query($conn, "SELECT * FROM paper_work ORDER by id ASC");
?>
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
                                    <a href="<?php echo base_url().'user/editdoc?x='.$data['id']?>" class="btn btn-primary"><i class="fa fa-pencil"></i> </a>
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
 
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
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
