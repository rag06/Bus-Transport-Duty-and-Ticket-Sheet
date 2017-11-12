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
            Edit Bus Timings
            <small>Update Your Bus Timing</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>admin/bus/Bus_Timing/index">Manage Bus Timings</a></li>
            <li class="active"><a href="#">Edit Bus Timing</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Edit Bus Timing</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" action="<?php echo base_url() ;?>/admin/bus/Bus_Timing/updateBusTiming">
								<input type="hidden" name="busTimingId" value="<?php echo$result[0]['bus_timing_Id'];?>" />
								 <?php
								echo "<div class='error_msg'>";
								if (isset($error_message)) {
								echo $error_message;
								}
								echo validation_errors();
								echo "</div>";
								?>
								<div class="form-group">
								  <label for="busDutyId"> Bus Route</label>
								  <select class="form-control" id="busDutyId" name="busDutyId" >
									<?php foreach($busDuty['result']  as $busDutyRow){
											if($busDutyRow->bus_duty_Id == $result[0]['bus_timing_DutyId'] )
												echo '<option value="'.$busDutyRow->bus_duty_Id .','.$busDutyRow->Bus_Routes_Id.'" selected>'.$busDutyRow->Bus_Routes_Number .'::'.$busDutyRow->bus_duty_Number .' ( '. $busDutyRow->Bus_Routes_Name .' )</option>';
											else
												echo '<option value="'.$busDutyRow->bus_duty_Id .','.$busDutyRow->Bus_Routes_Id.'">'.$busDutyRow->Bus_Routes_Number .'::'.$busDutyRow->bus_duty_Number .' ( '. $busDutyRow->Bus_Routes_Name .' )</option>';
									}?>
								  </select>
								</div>
								<div class="form-group">
								  <label for="busSource">Bus Start Point</label>
								  <input type="text" class="form-control" id="busSource" name="busSource"  value="<?php echo$result[0]['bus_timing_Source'];?>">
								</div>
								<div class="form-group">
								  <label for="busDest">Bus End Point</label>
								  <input type="text" class="form-control" id="busDest" name="busDest"  value="<?php echo$result[0]['bus_timing_Destination'];?>">
								</div>
								<div class="form-group">
								  <label for="busKilo"> Kilometers</label>
								  <input type="text" class="form-control" id="busKilo" name="busKilo"  value="<?php echo$result[0]['bus_timing_Kilometers'];?>">
								</div>
								<div class="form-group">
								  <label for="busStartTime">Bus Start Time</label>
								  <input type="text" class="form-control" id="busStartTime" name="busStartTime" value="<?php echo$result[0]['bus_timing_StartTime'];?>">
								</div>
								<div class="form-group">
								  <label for="busDestTime">Bus Destination Time</label>
								  <input type="text" class="form-control" id="busDestTime" name="busDestTime" value="<?php echo$result[0]['bus_timing_DestinationTime'];?>">
								</div>
							
								<a href="<?php echo base_url() ;?>admin/bus/Bus_Timing/index" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Save Changes </button>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>