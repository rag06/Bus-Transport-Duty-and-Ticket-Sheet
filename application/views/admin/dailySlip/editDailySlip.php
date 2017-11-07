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
							<form method="post" action="<?php echo base_url() ;?>/admin/dailySlip/dailySlip/updateDailySlip">
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
										  <select class="form-control" id="conductorEmpId" name="conductorEmpId">
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
										  <select class="form-control" id="routeId" name="routeId" required readonly>
											<option value="">Select Route</option>
										  <?php 
												foreach($routes['result'] as $route){
													if($route->Bus_Routes_Id == $result[0]['conductor_daysSlip_RoutesId']){
													 echo '<option value="'.$route->Bus_Routes_Id.'" selected>'.$route->Bus_Routes_Number.' ( '.$route->Bus_Routes_Source.' - '.$route->Bus_Routes_Destination.' )</option>';
													} else{
														 echo '<option value="'.$route->Bus_Routes_Id.'" >'.$route->Bus_Routes_Number.' ( '.$route->Bus_Routes_Source.' - '.$route->Bus_Routes_Destination.' )</option>';
													}
												}
											?>
											</select>
										</div>
									</div>
									<div class="">
									
										<div class="form-group col-md-6">
										  <label for="driverEmpId">Driver </label>
										  <select class="form-control" id="driverEmpId" name="driverEmpId">
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
										  <input type="text" class="form-control" id="busNumber" name="busNumber" placeholder="Enter Bus Number" value="<?php echo $result[0]['conductor_daysSlip_BusNumber']; ?>">
										</div>
										
										<div class="form-group col-md-3">
										  <label for="dailslipDate">Slip Date</label>
										  <input type="text" class="form-control" id="dailslipDate" name="dailslipDate" placeholder="yyyy-mm-dd"  value="<?php echo $result[0]['conductor_daysslip_date']; ?>">
										</div>
									</div>
								</fieldset>
								
								<fieldset>
									<legend>Timings:</legend>
										<table class="table dataTables">
											<thead>
												<tr>
													<th>Start Time</th>
													<th>End Time</th>
													<th>Actual Start Time</th>
													<th>Actual End Time</th>
													<th>Kilometres</th>
													<th>Actual Kilometres</th>
												</tr>
											</thead>
											<tbody id="bustiming">
												<?php 
													$innerHTML = '';
													foreach($details as $key => $row){
													$innerHTML .= '<tr>';
													$innerHTML .= '<input type="hidden" name="slipDetailsId[]" value="'.$row['conductor_daysslip_details_Id'].'"/ >';
													$innerHTML .=  '<td>'.$actdetails[$key]['bus_timing_StartTime'].'</td>';
													$innerHTML .=  '<td>'.$actdetails[$key]['bus_timing_DestinationTime'].'</td>';
													$innerHTML .=  '<td>'.$actdetails[$key]['bus_timing_DestinationTime'].'</td>';
													$innerHTML .=  '<td><input type="text" name="actSourceTime[]"  class="form-control input-sm" value="'.$row['conductor_daysslip_details_ActSourceTime'].'"/></td>';
													$innerHTML .=  '<td><input type="text" name="actDestTime[]"  class="form-control input-sm"  value="'.$row['conductor_daysslip_details_ActDestTime'].'"/></td>';
													$innerHTML .=  '<td>'.$route->Bus_Routes_Kilometers.'</td>';
													$innerHTML .=  '<td><input type="text" name="actKm[]"  class="form-control input-sm"  value="'.$row['conductor_daysslip_details_ActualKm'].'"/></td>';
													$innerHTML .=  '</tr>';
													}
													echo $innerHTML;
												?>
												
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
				var routeId = $(this).val();
				var innerHTML ='';
				if(routeId){
					$.ajax( {
						url: '<?php echo base_url() ;?>admin/dailySlip/dailySlip/getBusTimings',
						data: {routeId: routeId},
						success: function(data) {
						console.log(data);
						data = $.parseJSON(data)
							if(data.status == true){
								for(var i in data.data ){
									innerHTML += '<tr>';
									innerHTML +=  '<td>'+data.data[i].bus_timing_StartTime+'</td>';
									innerHTML +=  '<td>'+data.data[i].bus_timing_DestinationTime+'</td>';
									innerHTML +=  '<td><input type="text" name="actSourceTime[]"  class="form-control input-sm"/></td>';
									innerHTML +=  '<td><input type="text" name="actDestTime[]"  class="form-control input-sm"/></td>';
									innerHTML +=  '<td>'+data.route[0].Bus_Routes_Kilometers+'</td>';
									innerHTML +=  '<td><input type="text" name="actKm[]"  class="form-control input-sm"/></td>';
									innerHTML +=  '</tr>';
								}
								
								$('#bustiming').html(innerHTML);
							}
						},
						error: function() {
							 alert('No Timings found');
						}
					   });
					   
				}
		});

	 });
			
	 </script>