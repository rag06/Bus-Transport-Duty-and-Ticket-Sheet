	<br/>
	<?php $i=1;
									foreach($result['result'] as $row){?>
									<table  cellpadding="10" border="1px" style="width:100%;border:1px solid; border-collapse: collapse;margin:20px;">
										<tr>
											<th style="border: 1px solid black;">Sr. No.</th>
											<th style="border: 1px solid black;">Date </th>
											<th style="border: 1px solid black;">Conductor</th>
											<th style="border: 1px solid black;" >Waybill Number</th>
											<th style="border: 1px solid black;">Extra  Amount</th>
											<th style="border: 1px solid black;">Shot Amount:</th>
										</tr>
										<tr>
											<td style="border: 1px solid black;"><?php echo $i; ?></td>
											<td style="border: 1px solid black;"><?php echo $row['cashDeposit_slip_Date']; ?></td>
											<td style="border: 1px solid black;"><?php echo $employees[$row['cashDeposit_slip_ConductorEmpId']]->Employee_Number; ?></td>
											<td style="border: 1px solid black;" ><?php echo $row['cashDeposit_slip_Number']; ?></td>
											<td style="border: 1px solid black;"><?php echo $row['cashdeposit_slip_ExtraAmount']; ?></td>
											<td style="border: 1px solid black;"><?php echo $row['cashdeposit_slip_ShotAmount']; ?></td>
										</tr>
									</table>
	<?php } ?>
									
									
								