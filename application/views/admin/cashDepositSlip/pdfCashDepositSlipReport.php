<?php foreach($result['result'] as $resultRow) { ?>
	<br/>
									<table  cellpadding="10" border="1px" style="width:100%;border:1px solid; border-collapse: collapse;margin:20px;">
										<tr>
										<td style="border: 1px solid black;">
										  <label for="conductorEmpId">Conductor: </label>
												<?php 
												echo '<span>'.$employees[$resultRow['cashDeposit_slip_ConductorEmpId']]->Employee_Number.' ( '.$employees[$resultRow['cashDeposit_slip_ConductorEmpId']]->Employee_Name.' )</span>';
											?>
										</td>
										<td style="border: 1px solid black;" >
										  <label for="routeId">Duty: </label>
										  <?php 
													  echo '<span>'.$duty[$resultRow['cashDeposit_slip_DutyId']]->Bus_Routes_Number.'|'.$duty[$resultRow['cashDeposit_slip_DutyId']]->bus_duty_Number.' ('.$duty[$resultRow['cashDeposit_slip_DutyId']]->Bus_Routes_Name.')</span>';
											?>
										</td>
										<td style="border: 1px solid black;">
										  <label for="slipNo">Waybill Number: </label><?php echo $resultRow['cashDeposit_slip_Number']; ?>
										</td>
									</tr>
									<tr class="">
									
										<td style="border: 1px solid black;">
										  <label for="driverEmpId">Driver:  </label>
										 <?php 
															echo '<span>'.$employees[$resultRow['cashDeposit_slip_DriverEmpId']]->Employee_Number.' ( '.$employees[$resultRow['cashDeposit_slip_ConductorEmpId']]->Employee_Name.' )</span>';
											?>
										</td>
										<td style="border: 1px solid black;">
										  <label for="busNumber">Bus Number: </label>
										  <?php  echo '<span>'.$resultRow['cashDeposit_slip_BusNumber'].'</span>';?>
										  
										</td>
										
										<td style="border: 1px solid black;">
										  <label for="slipDate">Slip Date: </label><?php echo $resultRow['cashDeposit_slip_Date']; ?>
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
												$grandQty=0;
												foreach($details[$resultRow['cashDeposit_slip_Id']] as $detailsRow){
													?>
													
													<tr>
														<td style="text-align:center;border: 1px solid black;">
															
															<span><?php $tcktId= $detailsRow['cashDeposit_slip_details_TicketId'] ; echo $tickets[$tcktId]->tickets_Price;?></span> + <span><?php echo $tickets[$tcktId]->tickets_ExtraPrice;?></span><br/>
															
														</td>
														<td style="border: 1px solid black;"> <?php echo $detailsRow['cashDeposit_slip_details_ticketSeries'] ;?></td>
														<td style="border: 1px solid black;"> <?php echo $detailsRow['cashDeposit_slip_details_TicketStartSerial'] ;?></td>
														<td style="border: 1px solid black;"> <?php echo $detailsRow['cashDeposit_slip_details_TicketEndSerial'] ;?></td>
														<td style="border: 1px solid black;"><?php echo $detailsRow['cashDeposit_slip_details_ActualTicketsSold'] ;?></td>
														<td style="border: 1px solid black;"><?php echo $detailsRow['cashDeposit_slip_details_CalculatedAmount'] ;?></td>
													</tr>
														
											<?php 	$grandTotal = $grandTotal +$detailsRow['cashDeposit_slip_details_CalculatedAmount'] ;
													$grandQty = $grandQty +$detailsRow['cashDeposit_slip_details_ActualTicketsSold']  ;
														
													}
											?>
												<tr>
													<th  style="border: 1px solid black;" colspan="4"></th>
													<th  style="border: 1px solid black;"> <span id="totalQty"><?php echo $grandQty;?></span></th>
													<th  style="border: 1px solid black;">Rs. <span id="totalAmout"><?php echo $grandTotal;?></span></th>
												</tr>
									</table>
									<pagebreak>
<?php } ?>