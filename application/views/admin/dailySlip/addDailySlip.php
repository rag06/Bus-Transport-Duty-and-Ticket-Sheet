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
							<form method="post" name="addDutySlip" action="<?php echo base_url() ;?>/admin/dailySlip/dailySlip/insertDailySlip">
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
												<option value="">Select a Conductor </option>
											<?php 
												foreach($employees['result'] as $emp){
													if($emp->Employee_Type == 1)
													 echo '<option value="'.$emp->Employee_Id.'" >'.$emp->Employee_Number.' ( '.$emp->Employee_Name.' )</option>';
												}
											?>
										  </select>
										</div>
										<div class="form-group  col-md-6">
										  <label for="routeId">Duty Number</label>
										  <select class="form-control select2" id="routeId" name="routeId" required>
											<option value="">Select Duty Number</option>
										  <?php 
												foreach($duty['result'] as $dutyRow){
													 echo '<option value="'.$dutyRow->bus_duty_Id.'" >'.$dutyRow->Bus_Routes_Number	.' | '.$dutyRow->bus_duty_Number.' ( '.$dutyRow->Bus_Routes_Name.' )</option>';
												}
											?>
											</select>
										</div>
									</div>
									<div class="">
									
										<div class="form-group col-md-6">
										  <label for="driverEmpId">Driver </label>
										  <select class="form-control select2" id="driverEmpId" name="driverEmpId">
												<option value="">Select a Driver </option>
										  <?php 
												foreach($employees['result'] as $emp){
													if($emp->Employee_Type == 0)
													 echo '<option value="'.$emp->Employee_Id.'" >'.$emp->Employee_Number.' ( '.$emp->Employee_Name.' )</option>';
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
													 echo '<option value="'.$busrow->bus_number.'" >'.$busrow->bus_number.'</option>';
												}
											?>
										  </select>
										</div>
										
										<div class="form-group col-md-3">
										  <label for="dailslipDate">Slip Date</label>
										  <input type="text" class="form-control input-date" id="dailslipDate" name="dailslipDate" placeholder="yyyy-mm-dd"  value="<?php echo date("Y-m-d");?>"/>
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
											</tbody>
										<table>
								</fieldset>
								
								
								
								<a href="<?php echo base_url() ;?>admin/dailySlip/dailySlip" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Add Daily Slip </button>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>
	 <script>
	 $(document).ready(function(){
		$('#routeId').change(function(){
				var dutyId = $(this).val();
				var innerHTML ='';
				if(dutyId){
					$.ajax( {
						url: '<?php echo base_url() ;?>admin/dailySlip/dailySlip/getBusTimings',
						data: {dutyId: dutyId},
						success: function(data) {
						data = $.parseJSON(data)
							if(data.status == true){
								if(data.data.length>0){
									for(var i in data.data ){
										innerHTML += '<tr>';
										innerHTML +=  '<td>'+data.data[i].bus_timing_Source+'</td>';
										innerHTML +=  '<td>'+data.data[i].bus_timing_Destination+'</td>';
										innerHTML +=  '<td>'+data.data[i].bus_timing_StartTime+'</td>';
										innerHTML +=  '<td>'+data.data[i].bus_timing_DestinationTime+'</td>';
										innerHTML +=  '<td><input type="time" name="actSourceTime[]"  class="form-control input-sm" value="'+data.data[i].bus_timing_StartTime+'"/></td>';
										innerHTML +=  '<td><input type="time" name="actDestTime[]"  class="form-control input-sm"/ value="'+data.data[i].bus_timing_DestinationTime+'"></td>';
										innerHTML +=  '<td><input type="hidden" name="km[]"  class="form-control input-sm"/ value="'+data.data[i].bus_timing_Kilometers+'">'+data.data[i].bus_timing_Kilometers+'</td>';
										innerHTML +=  '<td><input type="text" name="actKm[]"  class="form-control input-sm"/></td>';
										innerHTML +=  '<td><select name="busIsCancel[]"  class="form-control input-sm"><option value="0" selected>No</option><option value="1">Yes</option></select></td>';
										innerHTML +=  '<td><select name="busIsCancelReason[]"  class="form-control input-sm"><option value="" selected>Select</option><option value="Driver">Driver</option><option value="Conductor">Conductor</option><option value="Workshop">Workshop</option><option value="Break Down">Break Down</option><option value="Accident">Accident</option><option value="Traffic">Traffic</option><option value="Sunday">Sunday</option><option value="Route Change">Route Change</option><option value="Schedule Sp">Schedule Sp</option></select></td>';
										innerHTML +=  '<td><textarea name="comments[]"  class="form-control input-sm"></textarea></td>';
										innerHTML +=  '</tr>';
									}
								}else{
									innerHTML = '<tr>';
										innerHTML +=  '<td> No Bus Timing  Found</td>';
										innerHTML +=  '</tr>';
										 alert('No Timings found');
								}
								
								
							}else{
										innerHTML = '<tr>';
										innerHTML +=  '<td> No Bus Timing  Found</td>';
										innerHTML +=  '</tr>';
										 alert('No Timings found');
							}
							$('#bustiming').html(innerHTML);
						},
						error: function() {
							 alert('No Timings found');
						}
					   });
					   
				}else{
					$('#bustiming').html('');
				}
		});
		
		
	 });
			
	 </script>
	   <script>
	 $(function() {
	  $("form[name='addDutySlip']").validate({
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