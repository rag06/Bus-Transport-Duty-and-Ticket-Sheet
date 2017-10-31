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
            Edit Admin User
            <small>Update Your Admin User</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>/admin/admin/users/index">Manage Admin Users</a></li>
            <li class="active"><a href="#">Edit Admin User</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Edit User : <?php echo $result[0]['Admin_Name'];?></h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" action="<?php echo base_url() ;?>/admin/admin/users/updateUsers">
								<input type="hidden" name="adminid" value="<?php echo$result[0]['Admin_Id'];?>" />
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
								  <input type="text" class="form-control" id="name" name="name" value="<?php echo$result[0]['Admin_Name'];?>">
								</div>
								<div class="form-group">
								  <label for="email">Email</label>
								  <input type="email" class="form-control" id="email" name="email" value="<?php echo$result[0]['Admin_Email'];?>">
								</div>
								<div class="form-group">
								  <label for="username">Username</label>
								  <input type="text" class="form-control" id="username" name="username" value="<?php echo$result[0]['Admin_Uname'];?>">
								</div>
								<div class="form-group">
								  <label for="password">Password</label>
								  <input type="password" class="form-control" id="password" name="password" value="<?php echo$result[0]['Admin_Pass'];?>">
								</div>
								<div class="form-group">
								 <label for="role"> Admin Role</label>
								  <select class="form-control" name="role" id="role">
									<?php if($result[0]['Admin_Role']==1){
												echo'<option value="0">General</option>
													<option value="1" selected>Admin</option>';}
											else{
												echo'<option value="0" selected>General</option>
													<option value="1">Admin</option>';
											}?>
								  </select>
								</div>
								<div class="form-group">
								 <label for="status"> Status</label>
								  <select class="form-control" name="status" id="status">
									<?php if($result[0]['Admin_Status']==1){
												echo'<option value="0">InActive</option>
													<option value="1" selected>Active</option>';}
											else{
												echo'<option value="0" selected>InActive</option>
													<option value="1">Active</option>';
											}?>
								  </select>
								</div>
							
								<a href="<?php echo base_url() ;?>/admin/admin/users" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Save Changes </button>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>