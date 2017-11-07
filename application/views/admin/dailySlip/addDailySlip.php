<?php $this->load->view('admin/layout/header.php');?>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
	<?php $this->load->view('admin/layout/mainHeader.php');?>
	<?php $this->load->view('admin/layout/sideBar.php');?>
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Daily Slip
            <small>Create Your Daily Slip</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>/admin/dailySlip/dailySlip/index">Manage  Daily Slip</a></li>
            <li class="active"><a href="#">Create Daily Slip</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Add New  Daily Slip :</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" action="<?php echo base_url() ;?>/admin/dailySlip/dailySlip/insertDailySlip">
								 <?php
								echo "<div class='error_msg'>";
								if (isset($error_message)) {
								echo $error_message;
								}
								echo validation_errors();
								echo "</div>";
								?>
								<div class="form-group">
								  <label for="name"> Name</label>
								  <input type="text" class="form-control" id="name" name="name" placeholder="Enter  Name">
								</div>
								<div class="form-group">
								  <label for="email">Email</label>
								  <input type="email" class="form-control" id="email" name="email" placeholder="Enter  Email ID">
								</div>
								<div class="form-group">
								  <label for="username">Username</label>
								  <input type="text" class="form-control" id="username" name="username" placeholder="Enter  Username">
								</div>
								<div class="form-group">
								  <label for="password">Password</label>
								  <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
								</div>
								<div class="form-group">
								 <label for="role"> Admin Role</label>
								  <select class="form-control" name="role" id="role">
									<?php
												echo'<option value="0">General</option>
													<option value="1">Admin</option>';
									?>
								  </select>
								</div>
								<div class="form-group">
								 <label for="status"> Status</label>
								  <select class="form-control" name="status" id="status">
									<?php 
												echo'<option value="0">InActive</option>
													<option value="1" >Active</option>';
									?>
								  </select>
								</div>
							
								<a href="<?php echo base_url() ;?>/admin/admin/users" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Add User </button>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>