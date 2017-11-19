	<br/>
									
									<table  cellpadding="10" border="1px" style="width:100%;border:1px solid; border-collapse: collapse;margin:20px;">
											<tr>
													<th style="border: 1px solid black;">Conductor</th>
													<th style="border: 1px solid black;">Year</th>
													<th style="border: 1px solid black;">Month</th>
													<th style="border: 1px solid black;">Amount</th>
											</tr>
												<?php 
													$innerHTML = '';
													foreach($conductor as $conductorRow){
													$innerHTML .= '<tr>';
												
													$innerHTML .=  '<td style="border: 1px solid black;">'.$empData[$conductorRow['cashDeposit_slip_ConductorEmpId']]->Employee_Number.' ( '.$empData[$conductorRow['cashDeposit_slip_ConductorEmpId']]->Employee_Name.' )</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$conductorRow['SalesYear'].'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$conductorRow['SalesMonth'].'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$conductorRow['TotalSales'].'</td>';
													
													}
													echo $innerHTML;
												?>
												
									</table>
								