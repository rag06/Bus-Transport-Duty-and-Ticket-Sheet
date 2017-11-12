<?php $this->load->view('admin/layout/header.php');?>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
	<?php $this->load->view('admin/layout/mainHeader.php');?>
	<?php $this->load->view('admin/layout/sideBar.php');?>
      
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
							<form method="post" name="addEmployee" action="<?php echo base_url() ;?>/admin/employees/employees/updateEmployee">
								<input type="hidden" name="empId" value="<?php echo$result[0]['Employee_Id'];?>" />
								 <?php
								echo "<div class='error_msg'>";
								if (isset($error_message)) {
								echo $error_message;
								}
								echo validation_errors();
								echo "</div>";
								?>
								<div class="row">
									<div class="form-group col-md-4">
									  <label for="empNo"> Employee No.</label>
									  <input type="text" class="form-control" id="empNo" name="empNo" value="<?php echo$result[0]['Employee_Number'];?>">
									</div>
									<div class="form-group col-md-4">
									  <label for="empName"> Employee Name</label>
									  <input type="text" class="form-control" id="empName" name="empName" value="<?php echo$result[0]['Employee_Name'];?>">
									</div>
									<div class="form-group col-md-4">
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
								</div>
								<a href="<?php echo base_url() ;?>/admin/bus/bus/index" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Save Changes </button>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>
	 
	 <script>
	 $(function() {
	  $("form[name='addEmployee']").validate({
		// Specify validation rules
		rules: {
		  // The key name on the left side is the name attribute
		  // of an input field. Validation rules are defined
		  // on the right side
		  empNo: {
			required:true,
			digits: true
		  },
		  empName: "required",
		  empType: "required"
		},
		// Specify validation error messages
		messages: {
		  empNo: "Please enter a valid Employee Number",
		  empName: "Please enter Employee Name",
		  empType: "Please enter Employee Type"
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
		  form.submit();
		}
	  });
	});
	 </script>