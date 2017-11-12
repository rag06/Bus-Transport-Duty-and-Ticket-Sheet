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
            Edit Bus Duty
            <small>Update Your Bus Duty</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>admin/bus/Bus_Duty/index">Manage Bus Duty</a></li>
            <li class="active"><a href="#">Edit Bus Timing</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Edit Bus Duty</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" name="editBusDuty" action="<?php echo base_url() ;?>admin/bus/Bus_Duty/updateBusDuty">
								<input type="hidden" name="busTimingId" value="<?php echo$result[0]['bus_duty_Id'];?>" />
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
									  <label for="busRouteId"> Bus Route</label>
									  <select class="form-control" id="busRouteId" name="busRouteId" >
										<?php foreach($busRoutes['result']  as $busRoutesRow){
												if($busRoutesRow->Bus_Routes_Id == $result[0]['bus_timing_routeId'] )
													echo '<option value="'.$busRoutesRow->Bus_Routes_Id .'" selected>'.$busRoutesRow->Bus_Routes_Number .'('.$busRoutesRow->Bus_Routes_Name.')</option>';
												else
													echo '<option value="'.$busRoutesRow->Bus_Routes_Id .'">'.$busRoutesRow->Bus_Routes_Number .'('.$busRoutesRow->Bus_Routes_Name.')</option>';
										}?>
									  </select>
									</div>
									<div class="form-group col-md-6">
									  <label for="busDutyNumber">Bus Duty Number</label>
									  <input type="text" class="form-control" id="busDutyNumber" name="busDutyNumber" value="<?php echo$result[0]['bus_duty_Number'];?>">
									</div>
								</div>
								<a href="<?php echo base_url() ;?>admin/bus/Bus_Duty/index" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn admin-btn btn-primary pull-right">Save Changes </button>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>
	 <script>
	 $(function() {
	  $("form[name='editBusDuty']").validate({
		// Specify validation rules
		rules: {
		  // The key name on the left side is the name attribute
		  // of an input field. Validation rules are defined
		  // on the right side
		  busRouteId: {
			required:true
		  },
		  busDutyNumber: {
			required:true,
			digits: true
		  }
		},
		// Specify validation error messages
		messages: {
		  busRouteId: "Please enter a valid Bus Route No",
		  busDutyNumber: "Please enter Bus Duty Number"
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
		  form.submit();
		}
	  });
	});
	 </script>