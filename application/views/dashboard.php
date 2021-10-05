<?php require_once('includes/header.php'); ?>

<?php require_once('includes/sidebar.php'); ?>
<title>Dashboard | Project</title>

    <div class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
              <?php if(isset($_SESSION['login'])) { ?>
                <h3> <div class="alert alert-success"> <?php echo $_SESSION['login']; ?></div></h3>
                 <?php }  ?>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
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
              <i class="fas fa-file-contract"></i>

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
              <i class="fa fa-files-o"></i>

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
   
