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
            View Daily Slip
            <small>View Your Daily Slip</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>admin/dailySlip/dailySlip/index">Manage  Daily Slip</a></li>
            <li class="active"><a href="#">View Daily Slip</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">View Daily Slip :</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" name="editDutySlip" action="<?php echo base_url() ;?>admin/dailySlip/dailySlip/updateDailySlip">
								<input type="hidden" name="slipId"  value="<?php echo $result[0]['conductor_daysSlip_Id']; ?>"/>
								 <?php
								echo "<div class='error_msg'>";
								if (isset($error_message)) {
								echo $error_message;
								}
								echo validation_errors();
								echo "</div>";
								?>
								<fieldset>
									<legend>Slip:</legend>
									<div class="">
										<div class="form-group col-md-6">
										  <label for="conductorEmpId">Conductor</label>
										  <select class="form-control" id="conductorEmpId" name="conductorEmpId" disabled>
											<?php 
												foreach($employees['result'] as $emp){
													if($emp->Employee_Type == 1){
														if($emp->Employee_Id == $result[0]['conductor_daysSlip_ConductorEmpId']){
															echo '<option value="'.$emp->Employee_Id.'" selected>'.$emp->Employee_Number.' ( '.$emp->Employee_Name.' )</option>';
														}
														else{
															echo '<option value="'.$emp->Employee_Id.'" >'.$emp->Employee_Number.' ( '.$emp->Employee_Name.' )</option>';
														}
													}
												}
											?>
										  </select>
										</div>
										<div class="form-group  col-md-6">
										  <label for="routeId">Route</label>
										  <select class="form-control" id="routeId" name="routeId" required disabled>
											<option value="">Select Route</option>
										  <?php 
												foreach($duty['result'] as $dutyRow){
													if($dutyRow->bus_duty_Id == $result[0]['conductor_daysSlip_DutyId']){
													  echo '<option value="'.$dutyRow->bus_duty_Id.'" selected>'.$dutyRow->Bus_Routes_Number	.' | '.$dutyRow->bus_duty_Number.' ( '.$dutyRow->Bus_Routes_Name.' )</option>';
													} else{
														  echo '<option value="'.$dutyRow->bus_duty_Id.'" >'.$dutyRow->Bus_Routes_Number	.' | '.$dutyRow->bus_duty_Number.' ( '.$dutyRow->Bus_Routes_Name.' )</option>';
													}
												}
											?>
											</select>
										</div>
									</div>
									<div class="">
									
										<div class="form-group col-md-6">
										  <label for="driverEmpId">Driver </label>
										  <select class="form-control" id="driverEmpId" name="driverEmpId" disabled>
										  <?php 
												foreach($employees['result'] as $emp){
													if($emp->Employee_Type == 0){
														if($emp->Employee_Id == $result[0]['conductor_daysSlip_DriveEmpId']){
															echo '<option value="'.$emp->Employee_Id.'" selected>'.$emp->Employee_Number.' ( '.$emp->Employee_Name.' )</option>';
														}
														else{
															echo '<option value="'.$emp->Employee_Id.'" >'.$emp->Employee_Number.' ( '.$emp->Employee_Name.' )</option>';
														}
													}
												}
											?>
											</select>
										</div>
										<div class="form-group col-md-3">
										  <label for="busNumber">Bus Number</label>
										   <select class="form-control" id="busNumber" name="busNumber" placeholder="Enter Bus Number" disabled>
												<option value="">Select a Bus </option>
											  <?php 
												foreach($busList['result'] as $busrow){
													if($busrow->bus_number == $result[0]['conductor_daysSlip_BusNumber']){
													 echo '<option value="'.$busrow->bus_number.'" selected>'.$busrow->bus_number.'</option>';
													}
													else{
														echo '<option value="'.$busrow->bus_number.'" >'.$busrow->bus_number.'</option>';
													}
												}
											?>
										  </select>
										</div>
										
										<div class="form-group col-md-3">
										  <label for="dailslipDate">Slip Date</label>
										  <input type="text" class="form-control" id="dailslipDate" name="dailslipDate" placeholder="yyyy-mm-dd"  value="<?php echo $result[0]['conductor_daysslip_date']; ?>" disabled>
										</div>
									</div>
								</fieldset>
								
								<fieldset>
									<legend>Timings:</legend>
										<table class="table dataTables">
											<thead>
												<tr>
													<th>Source</th>
													<th>Destination</th>
													<th style="width:50px;">Start Time</th>
													<th style="width:50px;">End Time</th>
													<th style="width:100px;">Actual Start Time</th>
													<th style="width:100px;">Actual End Time</th>
													<th style="width:50px;">Kilometres</th>
													<th style="width:50px;">Actual Kilometres</th>
													<th>Cancel</th>
													<th>Comments</th>
												</tr>
											</thead>
											<tbody id="bustiming">
												<?php  
													$totalAckKM=0;
													$totalOPTKM=0;
													$innerHTML = '';
													foreach($details as $key => $row){
													$innerHTML .= '<tr>';
													$innerHTML .= '<input type="hidden" name="slipDetailsId[]" value="'.$row['conductor_daysslip_details_Id'].'"readonly />';
													$innerHTML .=  '<td>'.$actdetails[$key]['bus_timing_Source'].'</td>';
													$innerHTML .=  '<td>'.$actdetails[$key]['bus_timing_Destination'].'</td>';
													$innerHTML .=  '<td>'.$actdetails[$key]['bus_timing_StartTime'].'</td>';
													$innerHTML .=  '<td>'.$actdetails[$key]['bus_timing_DestinationTime'].'</td>';
													$innerHTML .=  '<td>'.$row['conductor_daysslip_details_ActSourceTime'].'</td>';
													$innerHTML .=  '<td>'.$row['conductor_daysslip_details_ActDestTime'].'</td>';
													$innerHTML .=  '<td>'.$actdetails[$key]['bus_timing_Kilometers'].'</td>';
													$innerHTML .=  '<td>'.$row['conductor_daysslip_details_ActualKm'].'</td>';
													$innerHTML .=  '<td>';
														if($row['conductor_daysslip_details_cancel']==0)
															$innerHTML .= 'No';
														else
															$innerHTML .= 'Yes';
																
																
													$innerHTML .= '</td>';
													$innerHTML .=  '<td>'.$row['conductor_daysslip_details_comments'].'</td>';
										
													$innerHTML .=  '</tr>';
													$totalAckKM = $totalAckKM + $actdetails[$key]['bus_timing_Kilometers'];
													$totalOPTKM = $totalOPTKM + $row['conductor_daysslip_details_ActualKm'];
													}
													echo $innerHTML;
													
												?>
												
											</tbody>
											<tfoot>
												<tr>
													<th colspan="6" ></th>
													<th><?php echo $totalAckKM;?></th>
													<th><?php echo $totalOPTKM;?></th>
													<th colspan="2"></th>
												<tr>
											</tfoot>
										<table>
								</fieldset>
								
								
								
								<a href="<?php echo base_url() ;?>admin/dailySlip/dailySlip" class="btn btn-success btn-sm">Back</a>
								<a class="btn btn-warning btn-sm pull-right" href="<?php echo base_url() ;?>admin/dailySlip/dailySlip/downloadDutySlip/<?php echo $result[0]['conductor_daysSlip_Id'] ;?>" target="_blank">Export as PDF</a>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>
	   <script>
	 $(function() {
	  $("form[name='editDutySlip']").validate({
		// Specify validation rules
		rules: {
		  // The key name on the left side is the name attribute
		  // of an input field. Validation rules are defined
		  // on the right side
		  conductorEmpId: {
			required:true
		  },
		  routeId: "required",
		  driverEmpId: "required",
		  busNumber: "required",
		  dailslipDate: {
			required:true,
			date: true
		  }
		},
		// Specify validation error messages
		messages: {
		  conductorEmpId: "Please select a valid Condutor",
		  routeId: "Please select a valid  Duty ",
		  driverEmpId: "Please select a valid Driver",
		  busNumber: "Please enter a valid Bus Number",
		  dailslipDate: "Please enter a valid Slip Date"
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
		  form.submit();
		}
	  });
	});
	 </script>