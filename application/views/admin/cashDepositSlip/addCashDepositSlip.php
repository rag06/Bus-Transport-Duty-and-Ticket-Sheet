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
            Add Waybill Slip
            <small>Create Your Waybill Slip</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>admin/cashDepositSlip/cashDepositSlip/index">Manage Waybill Slip</a></li>
            <li class="active"><a href="#">Create Waybill Slip</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Add New Waybill Slip :</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" name="addWaybill" action="<?php echo base_url() ;?>admin/cashDepositSlip/cashDepositSlip/insertCashDepositSlip">
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
										  <label for="routeId">Duty Number</label>
										  <select class="form-control" id="routeId" name="routeId" required>
											<option value="">Select Duty Number</option>
										  <?php 
												foreach($duty['result'] as $dutyrow){
													 echo '<option value="'.$dutyrow->bus_duty_Id.'" >'.$dutyrow->Bus_Routes_Number.'|'.$dutyrow->bus_duty_Number.' ('.$dutyrow->Bus_Routes_Name.')</option>';
												}
											?>
											</select>
										</div>
										<div class="form-group col-md-3">
										  <label for="slipNo">Waybill Number</label>
										  <input type="text" class="form-control" id="slipNo" name="slipNo" placeholder="Enter Waybill Number" value="<?php echo $waybillno[0]['WaybillNum'];?>">
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
										  <select class="form-control" id="busNumber" name="busNumber" placeholder="Enter Bus Number">
												<option value="">Select a Bus </option>
											  <?php 
												foreach($busList['result'] as $busrow){
													 echo '<option value="'.$busrow->bus_number.'" >'.$busrow->bus_number.'</option>';
												}
											?>
										  </select>
										</div>
										
										<div class="form-group col-md-3">
										  <label for="slipDate">Slip Date</label>
										  <input type="text" class="form-control" id="slipDate" name="slipDate" placeholder="yyyy-mm-dd" value="<?php echo date("Y-m-d");?>">
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
																<input type="hidden" class="ticketRate" name="ticketvalue[]" value="<?php echo ($ticketRow->tickets_Price+$ticketRow->tickets_ExtraPrice) ;?>">
																<span><?php echo $ticketRow->tickets_Price ;?></span> + <span><?php echo $ticketRow->tickets_ExtraPrice ;?></span><br/>
																<a href="javascript:void(0);" class="cloneTicketRow"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
																<a href="javascript:void(0);" class="removeCloneTicketRow" style="display:none"><i class="fa fa-minus-circle btn btn-sm btn-danger" aria-hidden="true"></i></a>
															</td>
															<td> <input type="text" class="form-control input-sm" name="ticketSeries[]" placeholder="Enter Series"></td>
															<td> <input type="text" class="form-control ticketStart input-sm"  name="ticketStartSerial[]" placeholder="Enter Start Serial"></td>
															<td> <input type="text" class="form-control ticketEnd input-sm" name="ticketEndSerial[]" placeholder="Enter End Serial"></td>
															<td> <input type="text" class="form-control  ticketQty input-sm" name="ticketsSold[]" placeholder="Enter Sold" value="0" /></td>
															<td> <input type="text" class="form-control ticketAmount input-sm" onblur="calcTotal()" name="amount[]" placeholder="Enter amount"value="0"></td>
														</tr>
													
												<?php }
												?>
											</tbody>
											<tfoot>
												<tr>
													<th colspan="4"></th>
													<th>Total Amount</th>
													<th>Rs. <span id="totalAmout">0</span></th>
												</tr>
											</tfoot>
										</table>
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
				 var $newTR = $parentTR.clone(true,true);
				 $newTR.find('.cloneTicketRow').hide();
				 $newTR.find('.removeCloneTicketRow').show();
				$newTR.insertAfter($parentTR);
			});
			$('.removeCloneTicketRow').click(function(){
				var $this     = $(this);
				var $parentTR = $this.closest('tr');
				 var $newTR = $parentTR.remove();
			});
						
			
			$('.ticketEnd , .ticketStart').blur(function(){
				var $this     = $(this);
				var $parentTR = $this.closest('tr');
				var start = $parentTR.find('.ticketStart').val();
				var end = $parentTR.find('.ticketEnd').val();
				var rate = $parentTR.find('.ticketRate').val();
				var qty = (end-1)-start;
				if(qty>0){
					$parentTR.find('.ticketQty').val(qty);
					$parentTR.find('.ticketAmount').val(qty *rate );
				}
				else{
					$parentTR.find('.ticketQty').val(0);
					$parentTR.find('.ticketAmount').val(0 );
				}
				calcTotal();
			});
			
			$('.ticketQty').blur(function(){
				var $this     = $(this);
				var $parentTR = $this.closest('tr');
				var qty = $parentTR.find('.ticketQty').val();
				var rate = $parentTR.find('.ticketRate').val();
				$parentTR.find('.ticketAmount').val(qty *rate );
				calcTotal();
			});
			
			
		});
		function calcTotal(){
			var sum = 0;

			$(".ticketAmount").each(function() {
				var val = $.trim( $(this).val() );

				if ( val ) {
					val = parseFloat( val.replace( /^\$/, "" ) );

					sum += !isNaN( val ) ? val : 0;
				}
			});

			$("#totalAmout").text(sum); 
		}
	 </script>
	  <script>
	 $(function() {
	  $("form[name='addWaybill']").validate({
		// Specify validation rules
		rules: {
		  // The key name on the left side is the name attribute
		  // of an input field. Validation rules are defined
		  // on the right side
		  conductorEmpId: {
			required:true
		  },
		  routeId: "required",
		  slipNo: "required",
		  driverEmpId: "required",
		  busNumber: "required",
		  slipDate: {
			required:true,
			date: true
		  }
		},
		// Specify validation error messages
		messages: {
		  conductorEmpId: "Please select a valid Condutor",
		  routeId: "Please select a valid  Duty ",
		  slipNo: "Please enter a valid Waybill Number",
		  driverEmpId: "Please select a valid Driver",
		  busNumber: "Please enter a valid Bus Number",
		  slipDate: "Please enter a valid Slip Date"
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
		  form.submit();
		}
	  });
	});
	 </script>