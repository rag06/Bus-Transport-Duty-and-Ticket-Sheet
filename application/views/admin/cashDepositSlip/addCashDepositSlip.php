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
            Add Cash Deposit Slip
            <small>Create Your Cash Deposit Slip</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>admin/cashDepositSlip/cashDepositSlip/index">Manage Cash Deposit Slip</a></li>
            <li class="active"><a href="#">Create Cash Deposit Slip</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Add New  Cash Deposit Slip :</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" action="<?php echo base_url() ;?>admin/cashDepositSlip/cashDepositSlip/insertCashDepositSlip">
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
										<div class="form-group  col-md-3">
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
										<div class="form-group col-md-3">
										  <label for="slipNo">Slip Number</label>
										  <input type="text" class="form-control" id="slipNo" name="slipNo" placeholder="Enter slip Number">
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
										  <label for="slipDate">Slip Date</label>
										  <input type="text" class="form-control" id="slipDate" name="slipDate" placeholder="yyyy-mm-dd">
										</div>
									</div>
								</fieldset>
								
								<fieldset>
									<legend>Tickets Accounting:</legend>
										<table class="table dataTables">
											<thead>
												<tr>
													<th>Ticket</th>
													<th>Ticket Series</th>
													<th>Ticket Start Series</th>
													<th>Ticket End Series</th>
													<th>Tickets Sold</th>
													<th>Amount</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													foreach($tickets['result'] as $ticketRow){?>
														<tr>
															<td style="text-align:center">
																<input type="hidden"  name="ticketId[]" value="<?php echo $ticketRow->tickets_Id ;?>">
																<span><?php echo $ticketRow->tickets_Price ;?></span> + <span><?php echo $ticketRow->tickets_ExtraPrice ;?></span><br/>
																<a href="javascript:void(0);" class="cloneTicketRow"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
															</td>
															<td> <input type="text" class="form-control input-sm" name="ticketSeries[]" placeholder="Enter Series"></td>
															<td> <input type="text" class="form-control input-sm"  name="ticketStartSerial[]" placeholder="Enter Start Serial"></td>
															<td> <input type="text" class="form-control input-sm" name="ticketEndSerial[]" placeholder="Enter End Serial"></td>
															<td> <input type="text" class="form-control input-sm"  name="ticketsSold[]" placeholder="Enter Sold"></td>
															<td> <input type="text" class="form-control input-sm" name="amount[]" placeholder="Enter amount"></td>
														</tr>
													
												<?php }
												?>
											</tbody>
										<table>
								</fieldset>
								
								
								
								<a href="<?php echo base_url() ;?>admin/cashDepositSlip/cashDepositSlip/index" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Add Cash Deposit Slip </button>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>
	 <script>
		$(document).ready(function(){
			$('.cloneTicketRow').click(function(){
				var $this     = $(this);
				var $parentTR = $this.closest('tr');
				 var $newTR = $parentTR.clone();
				 $newTR.find('.cloneTicketRow').hide();
				$newTR.insertAfter($parentTR);
			});
		});
	 </script>