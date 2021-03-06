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
										<div class="form-group  col-md-3">
										  <label for="routeId">Duty Number</label>
										  <select class="form-control select2" id="routeId" name="routeId" required>
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
									
										<div class="form-group col-md-3">
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
										  <label for="busNumber ">Bus Number</label>
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
										  <label for="slipDate">Slip Date</label>
										  <input type="text" class="form-control input-date" id="slipDate" name="slipDate" placeholder="yyyy-mm-dd" value="<?php echo date("Y-m-d");?>">
										</div>
										
										<div class="form-group col-md-3">
										  <label for="collectedAmount">Collected Amount</label>
										  <input type="text" class="form-control" id="collectedAmount" name="collectedAmount"  value="0" required>
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
													<th>Ticket Series is Last</th>
													<th>Tickets Sold</th>
													<th>Amount</th>
												</tr>
											</thead>
											<tbody id="ticketdetail">
												
											</tbody>
											<tfoot>
												<tr>
													<th colspan="5"></th>
													<th> <span id="totalQty">0</span></th>
													<th>Rs. <span id="totalAmout">0</span></th>
												</tr>
												<tr>
													<th colspan="5"></th>
													<th>Extra Amount</th>
													<th>Rs. <span id="lbl-extraAmount">0</span>
														<input type="hidden"  id="extraAmount" name="extraAmount"  />
													</th>
												</tr>
												<tr>
													<th colspan="5"></th>
													<th>Shot Amount</th>
													<th>Rs. <span id="lbl-shotAmount">0</span>
														<input type="hidden"  id="shotAmount" name="shotAmount"  />
													</th>
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
	  <table id="clonetrticket" style="display:none">
			<?php 
			foreach($tickets['result'] as $ticketRow){?>
				<tr id="ticketRow_<?php echo $ticketRow->tickets_Id ;?>">
					<td style="text-align:center">
						<input type="hidden"  name="ticketId[]" value="<?php echo $ticketRow->tickets_Id ;?>">
						<input type="hidden" class="ticketRate" name="ticketvalue[]" value="<?php echo ($ticketRow->tickets_Price+$ticketRow->tickets_ExtraPrice) ;?>">
						<span><?php echo $ticketRow->tickets_Price ;?></span> + <span><?php echo $ticketRow->tickets_ExtraPrice ;?></span><br/>
						<a href="javascript:void(0);" class="cloneTicketRow"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
						<a href="javascript:void(0);" class="removeCloneTicketRow" style="display:none"><i class="fa fa-minus-circle btn btn-sm btn-danger" aria-hidden="true"></i></a>
					</td>
					<td> <input type="text" class="form-control ticketSeries input-sm" name="ticketSeries[]" placeholder="Enter Series"></td>
					<td> <input type="text" class="form-control ticketStart input-sm"  name="ticketStartSerial[]" placeholder="Enter Start Serial"></td>
					<td> <input type="text" class="form-control ticketEnd input-sm" name="ticketEndSerial[]" placeholder="Enter End Serial"></td>
					<td> 
						<select class="form-control input-sm" name="ticketisEnd[]">
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					</td>
					<td> <input type="text" class="form-control  ticketQty input-sm" name="ticketsSold[]" placeholder="Enter Sold" value="0" /></td>
					<td> <input type="text" class="form-control ticketAmount input-sm" onblur="calcTotal()" name="amount[]" placeholder="Enter amount"value="0"></td>
				</tr>
			
		<?php }
		?>
	  </table>
		
     <?php $this->load->view('admin/layout/footer.php');?>
	 <script>
	 var newRows={};
		$(document).ready(function(){
			function generateEmptyRow(){
				
				  $('#ticketdetail').html('');
				$( "#clonetrticket tr" ).each(function( index ) {
				  var $curTr = $( this ).clone(true,true);
				  $('#ticketdetail').append($curTr);
				});
			}
			

			$('#conductorEmpId').change(function(){
				var conductorId = $('#conductorEmpId').val();
				if(conductorId){
					
					$.ajax( {
						url: '<?php echo base_url() ;?>admin/cashDepositSlip/cashDepositSlip/getLastTicketSeries',
						data: {conductorId: conductorId},
						success: function(data) {
						data = $.parseJSON(data)
							if(data.status == true){
								
								$('#ticketdetail').html('');
									for(var i in data.data ){
										for(var j in data.data[i] ){
											var $tr = $('#clonetrticket #ticketRow_'+i);
												var $newTR = $tr.clone(true,true);
												var series = data.data[i][j].cashDeposit_slip_details_ticketSeries;
												$newTR.find('.ticketSeries').val(parseInt(series).zeroPad(3));
												$newTR.find('.ticketStart').val(data.data[i][j].cashDeposit_slip_details_TicketEndSerial);
											if(j>0){
												
													 $newTR.find('.cloneTicketRow').hide();
													 $newTR.find('.removeCloneTicketRow').show();
											}
											
											$('#ticketdetail').append($newTR);
										}
									}
								
							} else{
								alert('No Series  found');
								$('.ticketSeries').val('');
								$('.ticketStart').val('');
								$('.ticketEnd').val('');
								generateEmptyRow();
							}
						},
						error: function() {
							 alert('No Series  found');
								generateEmptyRow();
						}
					   });
					   
				}
				
			});
			$('.cloneTicketRow').click(function(){
				var $this     = $(this);
				var $parentTR = $this.closest('tr');
				 var $newTR = $parentTR.clone(true,true);
				 $newTR.find('.cloneTicketRow').hide();
				 $newTR.find('.removeCloneTicketRow').show();
				 $newTR.find('.ticketSeries').val('');
				 $newTR.find('.ticketStart').val('');
				 $newTR.find('.ticketEnd').val('');
				 
				$newTR.find('.ticketQty').val(0);
				$newTR.find('.ticketAmount').val(0);
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
				var qty = (end)-(start);
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
			var qty=0;
			$(".ticketQty").each(function() {
				var val = $.trim( $(this).val() );

				if ( val ) {
					val = parseFloat( val.replace( /^\$/, "" ) );

					qty += !isNaN( val ) ? val : 0;
				}
			});

			$("#totalQty").text(qty); 
			adjustExtraandShot(sum);
		}
		function adjustExtraandShot(sum){
			var collected = $('#collectedAmount').val();
			var extra = 0;
			var shot =0;
			if((collected - sum) >0 ){
				extra = (collected - sum);
			} else{
				shot = sum - collected  ;
			}
			$('#extraAmount').val(extra);
			$('#shotAmount').val(shot);
			
			$('#lbl-extraAmount').text(extra);
			$('#lbl-shotAmount').text(shot);
			
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
		  collectedAmount: "required",
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
		  collectedAmount: "Please enter a valid  Collected Amount",
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