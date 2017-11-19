<?php foreach($result['result'] as $resultRow) { ?>
			<br/>
									<table  cellpadding="10" border="1px" style="width:100%;border:1px solid; border-collapse: collapse;margin:20px;">
										<tr>
										<td style="border: 1px solid black;">
										  <label for="conductorEmpId">Conductor: </label>
												<?php 
												echo '<span>'.$employees[$resultRow['conductor_daysSlip_ConductorEmpId']]->Employee_Number.' ( '.$employees[$resultRow['conductor_daysSlip_ConductorEmpId']]->Employee_Name.' )</span>';?>
										</td>
										<td style="border: 1px solid black;" >
										  <label for="routeId">Duty: </label>
											 <?php 
													  echo '<span>'.$duty[$resultRow['conductor_daysSlip_DutyId']]->Bus_Routes_Number.'|'.$duty[$resultRow['conductor_daysSlip_DutyId']]->bus_duty_Number.' ('.$duty[$resultRow['conductor_daysSlip_DutyId']]->Bus_Routes_Name.')</span>';
											?>
										</td>
										<td style="border: 1px solid black;" >
										 </td>
									</tr>
									<tr class="">
									
										<td style="border: 1px solid black;">
										  <label for="driverEmpId">Driver:  </label>
											 <?php 
															echo '<span>'.$employees[$resultRow['conductor_daysSlip_DriveEmpId']]->Employee_Number.' ( '.$employees[$resultRow['conductor_daysSlip_DriveEmpId']]->Employee_Name.' )</span>';
											?>
										</td>
										<td style="border: 1px solid black;">
										  <label for="busNumber">Bus Number: </label>
										   <?php  echo '<span>'.$resultRow['conductor_daysSlip_BusNumber'].'</span>';?>
										  
										</td>
										
										<td style="border: 1px solid black;">
										  <label for="slipDate">Slip Date: </label><?php echo $resultRow['conductor_daysslip_date']; ?>
										</td>
									</tr>
									</table>
									
									<table  cellpadding="10" border="1px" style="width:100%;border:1px solid; border-collapse: collapse;margin:20px;">
											<tr>
													<th style="border: 1px solid black;">Source</th>
													<th style="border: 1px solid black;">Destination</th>
													<th style="border: 1px solid black;width:50px;">Start Time</th>
													<th style="border: 1px solid black;width:50px;">End Time</th>
													<th style="border: 1px solid black;width:100px;">Actual Start Time</th>
													<th style="border: 1px solid black;width:100px;">Actual End Time</th>
													<th style="border: 1px solid black;width:50px;">Kilometres</th>
													<th style="border: 1px solid black;width:50px;">Actual Kilometres</th>
													<th style="border: 1px solid black;">Cancel</th>
													<th style="border: 1px solid black;">Reason</th>
													<th style="border: 1px solid black;">Comments</th>
											</tr>
												<?php 
													$totalAckKM=0;
													$totalOPTKM=0;
													$innerHTML = '';
													foreach($details[$resultRow['conductor_daysSlip_Id']] as $key => $row){
													$innerHTML .= '<tr>';
												
													$innerHTML .=  '<td style="border: 1px solid black;">'.$actdetails[$resultRow['conductor_daysSlip_Id']][$key]['bus_timing_Source'].'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$actdetails[$resultRow['conductor_daysSlip_Id']][$key]['bus_timing_Destination'].'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$actdetails[$resultRow['conductor_daysSlip_Id']][$key]['bus_timing_StartTime'].'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$actdetails[$resultRow['conductor_daysSlip_Id']][$key]['bus_timing_DestinationTime'].'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$row['conductor_daysslip_details_ActSourceTime'].'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$row['conductor_daysslip_details_ActDestTime'].'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$actdetails[$resultRow['conductor_daysSlip_Id']][$key]['bus_timing_Kilometers'].'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$row['conductor_daysslip_details_ActualKm'].'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">';
														if($row['conductor_daysslip_details_cancel']==0)
															$innerHTML .= 'No';
														else
															$innerHTML .= 'Yes';
																
																
													$innerHTML .= '</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$row['conductor_daysslip_details_Reason'].'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$row['conductor_daysslip_details_comments'].'</td>';
										
													$innerHTML .=  '</tr>';
													$totalAckKM +=$actdetails[$resultRow['conductor_daysSlip_Id']][$key]['bus_timing_Kilometers'];
													$totalOPTKM +=$row['conductor_daysslip_details_ActualKm'];
													}
													echo $innerHTML;
												?>
												
												<tr>
													<th style="border: 1px solid black;" colspan="6" ></th>
													<th style="border: 1px solid black;"><?php echo $totalAckKM;?></th>
													<th style="border: 1px solid black;"><?php echo $totalOPTKM;?></th>
													<th style="border: 1px solid black;" colspan="3"></th>
												<tr>
									</table>
									<pagebreak>
<?php } ?>
								