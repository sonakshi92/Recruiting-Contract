<title>List Of Contract | Project</title>

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
            <?php if(isset($_SESSION['success'])) { ?>
    <h3> <div class="alert alert-success"> <?php echo $_SESSION['success']; ?></div></h3>
     <?php }  ?>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="addcontracts">Add Contract</a></li>
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
							                	<th>Sr.NO</th>
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
                            <?php
                                $i = 0;
                                foreach($contractor as $data){
                                  $files = $data['media_files']; 
                                  $i++;
                            ?>
                            <tr>
					                			<td><?= $i;?></td>
                                <td><?php echo $data['user_email_id'];?></td>
                                <td><?php echo $data['name_of_company'];?></td>
                                <td><?php echo $data['employer_email'];?></td>
                                <td> <span style="color:dodgerblue" type=button onClick="parent.open" ><?php echo $data['company_website'];?></td>
                                <td><?php echo $data['employer_phn'];?></td>
                                <td><?php echo $data['sub_by'];?></td>
                                <td><?php echo $data['sub_for_company'];?></td>
								                <td><a href ="<?= base_url().$files;?>" target="_blank"><?= substr($files,strrpos($files,'/',0)+1);?></td>
                                <td><?php echo $data['blacklisted'];?></td>
                                <td>
                                  <a href="<?php echo base_url().'user/editContract?v='.$data['id'];?>" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                  <button onclick="deleteContractor(<?= $data['id']?>);" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash" ></i></button>
                                </td>
                            </tr>
                                <?php }  ?>      
                            </tbody>
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
<br><br>
<br><br>
<br><br>
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

