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
            Add Bus Route
            <small>Add Your Bus Route</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>/admin/bus/bus/index">Manage Bus Routes</a></li>
            <li class="active"><a href="#">Add Bus Route</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Add Bus Route </h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" action="<?php echo base_url() ;?>/admin/bus/bus/insertBusRoute">
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
								  <input type="text" class="form-control" id="busRouteNo" name="busRouteNo" >
								</div>
								<div class="form-group">
								  <label for="busRouteName"> Bus Route Name</label>
								  <input type="text" class="form-control" id="busRouteName" name="busRouteName" >
								</div>
								<div class="form-group">
								 <label for="busRouteStatus"> Status</label>
								  <select class="form-control" name="busRouteStatus" id="busRouteStatus">
									<?php 
												echo'<option value="0">InActive</option>
													<option value="1" selected>Active</option>';
									?>
								  </select>
								</div>
							
								<a href="<?php echo base_url() ;?>/admin/bus/bus/index" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn admin-btn btn-primary pull-right">Save Changes </button>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>