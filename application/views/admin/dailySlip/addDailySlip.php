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
							<form method="post" action="<?php echo base_url() ;?>/admin/dailySlip/dailySlip/insertDailySlip">
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
													if($emp->Employee_Type == 1)
													 echo '<option value="'.$emp->Employee_Id.'" >'.$emp->Employee_Number.' ( '.$emp->Employee_Name.' )</option>';
												}
											?>
										  </select>
										</div>
										<div class="form-group  col-md-6">
										  <label for="routeId">Route</label>
										  <select class="form-control" id="routeId" name="routeId" required>
											<option value="">Select Route</option>
										  <?php 
												foreach($routes['result'] as $route){
													 echo '<option value="'.$route->Bus_Routes_Id.'" >'.$route->Bus_Routes_Number.' ( '.$route->Bus_Routes_Source.' - '.$route->Bus_Routes_Destination.' )</option>';
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
													if($emp->Employee_Type == 0)
													 echo '<option value="'.$emp->Employee_Id.'" >'.$emp->Employee_Number.' ( '.$emp->Employee_Name.' )</option>';
												}
											?>
											</select>
										</div>
										<div class="form-group col-md-3">
										  <label for="busNumber">Bus Number</label>
										  <input type="text" class="form-control" id="busNumber" name="busNumber" placeholder="Enter Bus Number">
										</div>
										
										<div class="form-group col-md-3">
										  <label for="dailslipDate">Slip Date</label>
										  <input type="text" class="form-control" id="dailslipDate" name="dailslipDate" placeholder="yyyy-mm-dd">
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
					$.ajax( 
						url: '<?php echo base_url() ;?>admin/dailySlip/getBusTimings',
						data: {routeId: routeId},
						success: function(data) {
							innerHTML += '<tr>';
							innerHTML +=  '<td>Start Time</td>';
							innerHTML +=  '<td>Start Time</td>';
							innerHTML +=  '<td><input type="text" name="actSourceTime[]"  class="form-control input-sm"/></td>';
							innerHTML +=  '<td><input type="text" name="actDestTime[]"  class="form-control input-sm"/></td>';
							innerHTML +=  '<td>100 km</td>';
							innerHTML +=  '<td><input type="text" name="actKm[]"  class="form-control input-sm"/></td>';
							innerHTML +=  '</tr>';
						},
						error: function() {
							 alert('No Timings found');
						}
					   });
				}
				$('#bustiming').html(innerHTML);
		});
	 });
			
	 </script>