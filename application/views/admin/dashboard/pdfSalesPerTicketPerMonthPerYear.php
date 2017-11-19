	<br/>
									
									<table  cellpadding="10" border="1px" style="width:100%;border:1px solid; border-collapse: collapse;margin:20px;">
											<tr>
													<th style="border: 1px solid black;">Tickets</th>
													<th style="border: 1px solid black;">Year</th>
													<th style="border: 1px solid black;">Month</th>
													<th style="border: 1px solid black;">Amount</th>
											</tr>
												<?php 
													$innerHTML = '';
													foreach($tickets as $ticket){
													$innerHTML .= '<tr>';
												
													$innerHTML .=  '<td style="border: 1px solid black;">'.$ticketsData[$ticket['cashDeposit_slip_details_TicketId']]->tickets_Price.'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$ticket['SalesYear'].'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$ticket['SalesMonth'].'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$ticket['TotalSales'].'</td>';
													
													}
													echo $innerHTML;
												?>
												
									</table>
								