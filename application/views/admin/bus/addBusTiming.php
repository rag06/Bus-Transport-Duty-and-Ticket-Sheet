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
           Add Bus Timings
            <small>Add Your Bus Timing</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>admin/bus/Bus_Timing/index">Manage Bus Timings</a></li>
            <li class="active"><a href="#">Add Bus Timing</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Add Bus Timing</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" name="addBusTiming" action="<?php echo base_url() ;?>admin/bus/Bus_Timing/insertBusTiming">
								 <?php
								echo "<div class='error_msg'>";
								if (isset($error_message)) {
								echo $error_message;
								}
								echo validation_errors();
								echo "</div>";
								?>
								<div class="row">
									<div class="form-group  col-md-4">
									  <label for="busDutyId"> Bus Route</label>
									  <select class="form-control" id="busDutyId" name="busDutyId" >
										<?php foreach($busDuty['result']  as $busDutyRow){
												echo '<option value="'.$busDutyRow->bus_duty_Id .','.$busDutyRow->Bus_Routes_Id.'">'.$busDutyRow->Bus_Routes_Number .'::'.$busDutyRow->bus_duty_Number .' ( '. $busDutyRow->Bus_Routes_Name .' )</option>';
										}?>
									  </select>
									</div>
									<div class="form-group  col-md-4">
									  <label for="busSource">Bus Start Point</label>
									  <input type="text" class="form-control" id="busSource" name="busSource">
									</div>
									<div class="form-group  col-md-4">
									  <label for="busDest">Bus End Point</label>
									  <input type="text" class="form-control" id="busDest" name="busDest">
									</div>
								</div>
								<div class="row">
									<div class="form-group  col-md-4">
									  <label for="busKilo"> Kilometers</label>
									  <input type="text" class="form-control" id="busKilo" name="busKilo">
									</div>
									<div class="form-group  col-md-4">
									  <label for="busStartTime">Bus Start Time</label>
									  <input type="time" class="form-control" id="busStartTime" name="busStartTime">
									</div>
									<div class="form-group  col-md-4">
									  <label for="busDestTime">Bus Destination Time</label>
									  <input type="time" class="form-control" id="busDestTime" name="busDestTime" >
									</div>
								</div>
							
								<a href="<?php echo base_url() ;?>admin/bus/Bus_Timing/index" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right admin-btn">Save Changes </button>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>
	 <script>
	 $(function() {
		
			
	  $("form[name='addBusTiming']").validate({
		// Specify validation rules
		rules: {
		  // The key name on the left side is the name attribute
		  // of an input field. Validation rules are defined
		  // on the right side
		  busDutyId: {
			required:true
		  },
		  busSource: {
			  required:true
		  },
		  busDest: {
			  required:true
		  },
		  busKilo: {
			  required:true,
			  number:true
		  },
		  busStartTime: {
			  required:true
		  },
		  busDestTime: {
			  required:true
		  }
		},
		// Specify validation error messages
		messages: {
		  busDutyId: "Please enter a valid Bus Duty Number",
		  busSource: "Please enter Bus Source",
		  busDest: "Please enter Bus Destination",
		  busKilo: "Please enter Bus Kilometer",
		  busStartTime: "Please enter Bus Start Time",
		  busDestTime: "Please enter Bus Destination Time",
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
		  form.submit();
		}
	  });
	});
	 </script>