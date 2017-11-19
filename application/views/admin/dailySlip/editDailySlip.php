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
            Edit Daily Slip
            <small>Create Your Daily Slip</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>/admin/dailySlip/dailySlip/index">Manage  Daily Slip</a></li>
            <li class="active"><a href="#">Edit Daily Slip</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Edit Daily Slip :</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" name="editDutySlip" action="<?php echo base_url() ;?>/admin/dailySlip/dailySlip/updateDailySlip">
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
										  <select class="form-control select2" id="conductorEmpId" name="conductorEmpId">
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
										  <label for="routeId">Duty Number</label>
										  <select class="form-control" id="routeId" name="routeId" required readonly>
											<option value="">Select Duty Number</option>
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
										  <select class="form-control select2" id="driverEmpId" name="driverEmpId">
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
										   <select class="form-control select2" id="busNumber" name="busNumber" placeholder="Enter Bus Number">
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
										  <input type="text" class="form-control input-date" id="dailslipDate" name="dailslipDate" placeholder="yyyy-mm-dd"  value="<?php echo $result[0]['conductor_daysslip_date']; ?>">
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
													<th>Reason</th>
													<th>Comments</th>
												</tr>
											</thead>
											<tbody id="bustiming">
												<?php 
													$innerHTML = '';
													foreach($details as $key => $row){
													$innerHTML .= '<tr>';
													$innerHTML .= '<input type="hidden" name="slipDetailsId[]" value="'.$row['conductor_daysslip_details_Id'].'"/ >';
													$innerHTML .=  '<td>'.$actdetails[$key]['bus_timing_Source'].'</td>';
													$innerHTML .=  '<td>'.$actdetails[$key]['bus_timing_Destination'].'</td>';
													$innerHTML .=  '<td>'.$actdetails[$key]['bus_timing_StartTime'].'</td>';
													$innerHTML .=  '<td>'.$actdetails[$key]['bus_timing_DestinationTime'].'</td>';
													$innerHTML .=  '<td><input type="time" name="actSourceTime[]"  class="form-control input-sm" value="'.$row['conductor_daysslip_details_ActSourceTime'].'"/></td>';
													$innerHTML .=  '<td><input type="time" name="actDestTime[]"  class="form-control input-sm"  value="'.$row['conductor_daysslip_details_ActDestTime'].'"/></td>';
													$innerHTML .=  '<td>'.$actdetails[$key]['bus_timing_Kilometers'].'</td>';
													$innerHTML .=  '<td><input type="text" name="actKm[]"  class="form-control input-sm"  value="'.$row['conductor_daysslip_details_ActualKm'].'"/></td>';
													$innerHTML .=  '<td>
																		<select name="busIsCancel[]"  class="form-control input-sm">
																		<option value="0" ';
														if($row['conductor_daysslip_details_cancel']==0)
															$innerHTML .= 'selected';
														
													$innerHTML .=  '>No</option>
																<option value="1" ';
														if($row['conductor_daysslip_details_cancel']==1)
															$innerHTML .= 'selected';
																
																
													$innerHTML .=  '>Yes</option>
																		</select>
																	</td>';
													$innerHTML .=  '<td><select name="busIsCancelReason[]"  class="form-control input-sm"><option value="" >Select</option>';
													foreach ($cancelReason as $reason){
														if($reason == $row['conductor_daysslip_details_Reason']){
															$innerHTML .=  	'<option value="'.$reason.'" selected >'.$reason.'</option>';
														} else{
															$innerHTML .=  	'<option value="'.$reason.'" >'.$reason.'</option>';
														}
													}
													$innerHTML .= '</select></td>';
													$innerHTML .=  '<td><textarea name="comments[]"  class="form-control input-sm">'.$row['conductor_daysslip_details_comments'].'</textarea></td>';
										
													$innerHTML .=  '</tr>';
													}
													echo $innerHTML;
												?>
												
											</tbody>
										<table>
								</fieldset>
								
								
								
								<a href="<?php echo base_url() ;?>admin/dailySlip/dailySlip" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Update Daily Slip </button>
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