<title>List Of Paper Work | Project</title>

<?php
 $conn = mysqli_connect('localhost', 'root', '', 'r_contracts');
 $getusers = mysqli_query($conn, "SELECT * FROM paper_work ORDER by id ASC");
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Of Documentations</h1>
            <?php if(isset($_SESSION['success'])) { ?>
                <h3> <div class="alert alert-success"> <?php echo $_SESSION['success']; ?></h3>
                  <?php }  ?></div>
          </div>
          <div class="col-sm-6">
            
          </div>
        </div>
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
                                <th>Sr.No</th>
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
                        <?php 
                            $i=0;
                            foreach($paperwork as $data){
                                $id = $data['id'];
                                $i++;
                        ?>
                        <tr>
                            <td><?= $i;?></td>
                            <td><?php echo $data['name_of_candidate'];?></td>
                            <td><?php echo $data['email'];?></td>
                            <td><?php echo $data['phone'];?></td>
                            <td><?php echo $data['employer_company_name'];?></td>
                            <td> <span style="color:dodgerblue" type=button onClick="parent.open" ><?php echo $data['employer_website'];?></span></td>
                            <td><?php echo $data['sub_by_rec_name'];?></td>
                            <td><?php echo $data['manager_name'];?></td>
                            <td>
                                <table>
                                    <tbody>
                                <?php 
                                    foreach ($paperworkdoc as $key => $docval) {
                                        if($id===$docval['paper_work_id']){
                                            $link = base_url().$docval['media_files'];
                                           echo '<tr><td><a href="'.$link.'" target="_blank"><img style="width:50px;height:20px;" src="'.$link.'"></a></td></tr>' ;
                                        }
                                    }
                                ?>
                                    </tbody>
                                 </table>   
                            </td>
                            <td>
                              <a href="<?php echo base_url().'user/editdoc?x='.$data['id']?>" class="btn btn-sm btn-primary"style="font-size:15px;"><i class="fa fa-edit"></i></a>
                              <button onclick="deletePaperDoc(<?= $id;?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>  
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
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>