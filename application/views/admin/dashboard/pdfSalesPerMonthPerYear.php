	<br/>
			<br/>
			<br/>
			<br/>
									
									<table  cellpadding="10" border="1px" style="width:100%;border:1px solid; border-collapse: collapse;margin:20px;">
											<tr>
													<th style="border: 1px solid black;">Year</th>
													<th style="border: 1px solid black;">Month</th>
													<th style="border: 1px solid black;">Amount</th>
											</tr>
												<?php 
													$innerHTML = '';
													foreach($sales as $sale){
													$innerHTML .= '<tr>';
												
													$innerHTML .=  '<td style="border: 1px solid black;">'.$sale['SalesYear'].'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$sale['SalesMonth'].'</td>';
													$innerHTML .=  '<td style="border: 1px solid black;">'.$sale['TotalSales'].'</td>';
													
													}
													echo $innerHTML;
												?>
												
									</table>
								