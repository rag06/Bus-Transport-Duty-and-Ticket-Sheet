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
            Add Employee
            <small>Add Your Employee</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>/admin/employees/employees/index">Manage Employees</a></li>
            <li class="active"><a href="#">Add Employee</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Add Employee </h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" name="addEmployee" action="<?php echo base_url() ;?>/admin/employees/employees/insertEmployee">
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
									  <input type="text" class="form-control" id="empNo" name="empNo" >
									</div>
									<div class="form-group  col-md-4">
									  <label for="empName"> Employee Name</label>
									  <input type="text" class="form-control" id="empName" name="empName">
									</div>
									<div class="form-group col-md-4">
									  <label for="empType"> Employee Type</label>
									  <select class="form-control" name="empType" id="empType">
										<?php 
													echo'<option value="0" >Driver</option>
														<option value="1" selected>Conductor</option>';
										?>
									  </select>
									</div>
								</div>
							
								<a href="<?php echo base_url() ;?>/admin/employees/employees/index" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right admin-btn">Save Changes </button>
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
		  empNo: "Please enter Employee Number",
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