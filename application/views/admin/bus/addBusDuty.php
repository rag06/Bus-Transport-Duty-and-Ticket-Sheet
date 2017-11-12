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
           Add Bus Duty
            <small>Add Your Bus Duty</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>admin/bus/Bus_Duty/index">Manage Bus Duty</a></li>
            <li class="active"><a href="#">Add Bus Duty</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Add Bus Duty</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" action="<?php echo base_url() ;?>/admin/bus/Bus_Duty/insertBusDuty">
								 <?php
								echo "<div class='error_msg'>";
								if (isset($error_message)) {
								echo $error_message;
								}
								echo validation_errors();
								echo "</div>";
								?>
								<div class="form-group">
								  <label for="busRouteId"> Bus Route</label>
								  <select class="form-control" id="busRouteId" name="busRouteId" >
									<?php foreach($busRoutes['result']  as $busRoutesRow){
											echo '<option value="'.$busRoutesRow->Bus_Routes_Id .'">'.$busRoutesRow->Bus_Routes_Number .'('.$busRoutesRow->Bus_Routes_Name.')</option>';
									}?>
								  </select>
								</div>
								<div class="form-group">
								  <label for="busDutyNumber">Bus Duty Number</label>
								  <input type="text" class="form-control" id="busDutyNumber" name="busDutyNumber">
								</div>
								<a href="<?php echo base_url() ;?>admin/bus/Bus_Duty/index" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Save Changes </button>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>