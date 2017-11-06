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
            Edit Employee
            <small>Update Your Employee</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>/admin/employees/employees/index">Manage Employees</a></li>
            <li class="active"><a href="#">Edit Employee</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Edit Employee </h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" action="<?php echo base_url() ;?>/admin/employees/employees/updateEmployee">
								<input type="hidden" name="empId" value="<?php echo$result[0]['Employee_Id'];?>" />
								 <?php
								echo "<div class='error_msg'>";
								if (isset($error_message)) {
								echo $error_message;
								}
								echo validation_errors();
								echo "</div>";
								?>
								<div class="form-group">
								  <label for="empNo"> Employee No.</label>
								  <input type="text" class="form-control" id="empNo" name="empNo" value="<?php echo$result[0]['Employee_Number'];?>">
								</div>
								<div class="form-group">
								  <label for="empName"> Employee Name</label>
								  <input type="text" class="form-control" id="empName" name="empName" value="<?php echo$result[0]['Employee_Name'];?>">
								</div>
								<div class="form-group">
								  <label for="empType"> Employee Type</label>
								  <select class="form-control" name="empType" id="empType">
									<?php if($result[0]['Employee_Type']==1){
												echo'<option value="0">Driver</option>
													<option value="1" selected>Conductor</option>';}
											else{
												echo'<option value="0" selected>Driver</option>
													<option value="1">Conductor</option>';
											}?>
								  </select>
								</div>
								<div class="form-group">
								 <label for="empStatus"> Status</label>
								  <select class="form-control" name="empStatus" id="empStatus">
									<?php if($result[0]['Employee_Status']==1){
												echo'<option value="0">InActive</option>
													<option value="1" selected>Active</option>';}
											else{
												echo'<option value="0" selected>InActive</option>
													<option value="1">Active</option>';
											}?>
								  </select>
								</div>
							
								<a href="<?php echo base_url() ;?>/admin/bus/bus/index" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Save Changes </button>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>