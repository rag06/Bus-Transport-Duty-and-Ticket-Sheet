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
            Edit Bus Route
            <small>Update Your Bus Route</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>/admin/admin/users/index">Manage Bus Routes</a></li>
            <li class="active"><a href="#">Edit Bus Route</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Edit Bus Route </h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post"  name="editBusRoute"  action="<?php echo base_url() ;?>admin/bus/bus/updateBusRoute">
								<input type="hidden" name="busRouteId" value="<?php echo$result[0]['Bus_Routes_Id'];?>" />
								 <?php
								echo "<div class='error_msg'>";
								if (isset($error_message)) {
								echo $error_message;
								}
								echo validation_errors();
								echo "</div>";
								?>
								<div class="row">
									<div class="form-group col-md-6">
									  <label for="busRouteNo"> Bus Route No.</label>
									  <input type="text" class="form-control" id="busRouteNo" name="busRouteNo" value="<?php echo$result[0]['Bus_Routes_Number'];?>">
									</div>
									<div class="form-group col-md-6">
									  <label for="busRouteName"> Bus Route Source</label>
									  <input type="text" class="form-control" id="busRouteName" name="busRouteName" value="<?php echo$result[0]['Bus_Routes_Name'];?>">
									</div>
								</div>
							
								<a href="<?php echo base_url() ;?>admin/bus/bus/index" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn admin-btn btn-primary pull-right">Save Changes </button>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>
	 <script>
	 $(function() {
	  $("form[name='editBusRoute']").validate({
		// Specify validation rules
		rules: {
		  // The key name on the left side is the name attribute
		  // of an input field. Validation rules are defined
		  // on the right side
		  busRouteNo: {
			required:true,
			digits: true
		  },
		  busRouteName: "required"
		},
		// Specify validation error messages
		messages: {
		  busRouteNo: "Please enter a valid Bus Route Number",
		  busRouteName: "Please enter Bus Route Name"
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
		  form.submit();
		}
	  });
	});
	 </script>