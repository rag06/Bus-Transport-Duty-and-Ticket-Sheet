	<br/>
			<br/>
			<br/>
			<br/>
									<table  cellpadding="10" border="1px" style="width:100%;border:1px solid; border-collapse: collapse;margin:20px;">
										<tr>
										<td style="border: 1px solid black;">
										  <label for="conductorEmpId">Conductor: </label>
												<?php 
												foreach($employees['result'] as $emp){
													if($emp->Employee_Type == 1){
														if($emp->Employee_Id == $result[0]['cashDeposit_slip_ConductorEmpId']){
															echo '<span>'.$emp->Employee_Number.' ( '.$emp->Employee_Name.' )</span>';
														}
													}
												}
											?>
										</td>
										<td style="border: 1px solid black;" >
										  <label for="routeId">Duty: </label>
										  <?php 
												foreach($duty['result'] as $dutyrow){
													if($dutyrow->bus_duty_Id == $result[0]['cashDeposit_slip_DutyId']){
													  echo '<span>'.$dutyrow->Bus_Routes_Number.'|'.$dutyrow->bus_duty_Number.' ('.$dutyrow->Bus_Routes_Name.')</span>';
													}
												}
											?>
										</td>
										<td style="border: 1px solid black;">
										  <label for="slipNo">Waybill Number: </label><?php echo $result[0]['cashDeposit_slip_Number']; ?>
										</td>
									</tr>
									<tr class="">
									
										<td style="border: 1px solid black;">
										  <label for="driverEmpId">Driver:  </label>
										 <?php 
												foreach($employees['result'] as $emp){
													if($emp->Employee_Type == 0){
														if($emp->Employee_Id == $result[0]['cashDeposit_slip_DriverEmpId']){
															echo '<span>'.$emp->Employee_Number.' ( '.$emp->Employee_Name.' )</span>';
														}
													}
												}
											?>
										</td>
										<td style="border: 1px solid black;">
										  <label for="busNumber">Bus Number: </label>
										  <?php 
												foreach($busList['result'] as $busrow){
													if($busrow->bus_number == $result[0]['cashDeposit_slip_BusNumber']){
													 echo '<span>'.$busrow->bus_number.'</span>';
													 }
												}
										  ?>
										  
										</td>
										
										<td style="border: 1px solid black;">
										  <label for="slipDate">Slip Date: </label><?php echo $result[0]['cashDeposit_slip_Date']; ?>
										</td>
									</tr>
									</table>
									
									<table  cellpadding="10" border="1px" style="width:100%;border:1px solid; border-collapse: collapse;margin:20px;">
											<tr>
												<th style="border: 1px solid black;">Ticket</th>
												<th style="border: 1px solid black;">Ticket Series</th>
												<th style="border: 1px solid black;">Ticket Start Series</th>
												<th style="border: 1px solid black;">Ticket End Series</th>
												<th style="border: 1px solid black;">Tickets Sold</th>
												<th style="border: 1px solid black;">Amount</th>
											</tr>
											<?php
												$grandTotal=0;
												foreach($details as $detailsRow){?>
													<tr>
														<td style="text-align:center;border: 1px solid black;">
															
															<span><?php $tcktId= $detailsRow['cashDeposit_slip_details_TicketId'] ; echo $tickets[$tcktId]->tickets_Price;?></span> + <span><?php echo $tickets[$tcktId]->tickets_ExtraPrice;?></span><br/>
															
														</td>
														<td style="border: 1px solid black;"> <?php echo $detailsRow['cashDeposit_slip_details_ticketSeries'] ;?></td>
														<td style="border: 1px solid black;"> <?php echo $detailsRow['cashDeposit_slip_details_TicketStartSerial'] ;?></td>
														<td style="border: 1px solid black;"> <?php echo $detailsRow['cashDeposit_slip_details_TicketEndSerial'] ;?></td>
														<td style="border: 1px solid black;"><?php echo $detailsRow['cashDeposit_slip_details_ActualTicketsSold'] ;?>"</td>
														<td style="border: 1px solid black;"><?php echo $detailsRow['cashDeposit_slip_details_CalculatedAmount'] ;?></td>
													</tr>
														
											<?php 	$grandTotal = $grandTotal +$detailsRow['cashDeposit_slip_details_CalculatedAmount'] ;
														
													}
											?>
											<tr>
												<th colspan="4"></th>
												<th>Total Amount</th>
												<th>Rs. <span id="totalAmout"><?php echo $grandTotal;?></span></th>
											</tr>
									</table>
								