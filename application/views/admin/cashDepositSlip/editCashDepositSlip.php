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
            Edit Cash Deposit Slip
            <small>Update Your Cash Deposit Slip</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>admin/cashDepositSlip/cashDepositSlip/index">Manage Cash Deposit Slip</a></li>
            <li class="active"><a href="#">Update Cash Deposit Slip</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Edit  Cash Deposit Slip :</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" action="<?php echo base_url() ;?>admin/cashDepositSlip/cashDepositSlip/updateCashDepositSlip">
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
														if($emp->Employee_Id == $result[0]['cashDeposit_slip_ConductorEmpId']){
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
										<div class="form-group  col-md-3">
										  <label for="routeId">Route</label>
										  <select class="form-control" id="routeId" name="routeId" required>
											<option value="">Select Route</option>
										  <?php 
												foreach($duty['result'] as $dutyrrow){
													if($dutyrrow->bus_duty_Id == $result[0]['cashDeposit_slip_DutyId']){
													  echo '<option value="'.$dutyrow->bus_duty_Id.'" selected >'.$dutyrow->Bus_Routes_Number.'|'.$dutyrow->bus_duty_Number.' ('.$dutyrow->Bus_Routes_Name.')</option>';
													} else{
														  echo '<option value="'.$dutyrow->bus_duty_Id.'" >'.$dutyrow->Bus_Routes_Number.'|'.$dutyrow->bus_duty_Number.' ('.$dutyrow->Bus_Routes_Name.')</option>';
													}
												}
											?>
											</select>
										</div>
										<div class="form-group col-md-3">
										  <label for="slipNo">Waybill Number</label>
										  <input type="text" class="form-control" id="slipNo" name="slipNo" placeholder="Enter Waybill Number"  value="<?php echo $result[0]['cashDeposit_slip_Number']; ?>">
										</div>
									</div>
									<div class="">
									
										<div class="form-group col-md-6">
										  <label for="driverEmpId">Driver </label>
										  <select class="form-control" id="driverEmpId" name="driverEmpId">
										 <?php 
												foreach($employees['result'] as $emp){
													if($emp->Employee_Type == 0){
														if($emp->Employee_Id == $result[0]['cashDeposit_slip_DriverEmpId']){
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
										  <input type="text" class="form-control" id="busNumber" name="busNumber" placeholder="Enter Bus Number"  value="<?php echo $result[0]['cashDeposit_slip_BusNumber']; ?>">
										</div>
										
										<div class="form-group col-md-3">
										  <label for="slipDate">Slip Date</label>
										  <input type="text" class="form-control" id="slipDate" name="slipDate" placeholder="yyyy-mm-dd"  value="<?php echo $result[0]['cashDeposit_slip_Date']; ?>">
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
													foreach($details as $detailsRow){?>
														<tr>
															<td style="text-align:center">
																<input type="hidden"  name="ticketId[]" value="<?php echo $detailsRow['cashDeposit_slip_details_TicketId'] ;?>">
																<input type="hidden"  name="slipdetailsId[]" value="<?php echo $detailsRow['cashDeposit_slip_details_Id'] ;?>">
																<span><?php $tcktId= $detailsRow['cashDeposit_slip_details_TicketId'] ; echo $tickets[$tcktId]->tickets_Price;?></span> + <span><?php echo $tickets[$tcktId]->tickets_ExtraPrice;?></span><br/>
																<!--a href="javascript:void(0);" class="cloneTicketRow"><i class="fa fa-plus-circle" aria-hidden="true"></i></a-->
															</td>
															<td> <input type="text" class="form-control input-sm" name="ticketSeries[]" placeholder="Enter Series"  value="<?php echo $detailsRow['cashDeposit_slip_details_ticketSeries'] ;?>"></td>
															<td> <input type="text" class="form-control input-sm"  name="ticketStartSerial[]" placeholder="Enter Start Serial"  value="<?php echo $detailsRow['cashDeposit_slip_details_TicketStartSerial'] ;?>"></td>
															<td> <input type="text" class="form-control input-sm" name="ticketEndSerial[]" placeholder="Enter End Serial"  value="<?php echo $detailsRow['cashDeposit_slip_details_TicketEndSerial'] ;?>"></td>
															<td> <input type="text" class="form-control input-sm"  name="ticketsSold[]" placeholder="Enter Sold"  value="<?php echo $detailsRow['cashDeposit_slip_details_ActualTicketsSold'] ;?>"></td>
															<td> <input type="text" class="form-control input-sm" name="amount[]" placeholder="Enter amount"  value="<?php echo $detailsRow['cashDeposit_slip_details_CalculatedAmount'] ;?>"></td>
														</tr>
													
												<?php }
												?>
											</tbody>
										<table>
								</fieldset>
								
								
								
								<a href="<?php echo base_url() ;?>admin/cashDepositSlip/cashDepositSlip/index" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Update Cash Deposit Slip </button>
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