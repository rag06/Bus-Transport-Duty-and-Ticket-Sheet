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
							<form method="post" action="<?php echo base_url() ;?>/admin/bus/bus/updateBusRoute">
								<input type="hidden" name="busRouteId" value="<?php echo$result[0]['Bus_Routes_Id'];?>" />
								 <?php
								echo "<div class='error_msg'>";
								if (isset($error_message)) {
								echo $error_message;
								}
								echo validation_errors();
								echo "</div>";
								?>
								<div class="form-group">
								  <label for="busRouteNo"> Bus Route No.</label>
								  <input type="text" class="form-control" id="busRouteNo" name="busRouteNo" value="<?php echo$result[0]['Bus_Routes_Number'];?>">
								</div>
								<div class="form-group">
								  <label for="busRouteSource"> Bus Route Source</label>
								  <input type="text" class="form-control" id="busRouteSource" name="busRouteSource" value="<?php echo$result[0]['Bus_Routes_Source'];?>">
								</div>
								<div class="form-group">
								  <label for="busRouteDest"> Bus Route Destination</label>
								  <input type="text" class="form-control" id="busRouteDest" name="busRouteDest" value="<?php echo$result[0]['Bus_Routes_Destination'];?>">
								</div>
								<div class="form-group">
								  <label for="busRouteKM"> Bus Route Kilometres .</label>
								  <input type="text" class="form-control" id="busRouteKM" name="busRouteKM" value="<?php echo$result[0]['Bus_Routes_Kilometers'];?>">
								</div>
								<div class="form-group">
								 <label for="busRouteStatus"> Status</label>
								  <select class="form-control" name="busRouteStatus" id="busRouteStatus">
									<?php if($result[0]['Bus_Routes_Status']==1){
												echo'<option value="0">InActive</option>
													<option value="1" selected>Active</option>';}
											else{
												echo'<option value="0" selected>InActive</option>
													<option value="1">Active</option>';
											}?>
								  </select>
								</div>
							
								<a href="<?php echo base_url() ;?>/admin/bus/bus/index" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Save Changes </button>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>