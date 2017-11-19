			<br/>
						  <h3 class="box-title" style="margin:20px;">Tickets List  </h3>
							<table id="webpagesList" cellpadding="10" border="1px" style="width:100%;border:1px solid; border-collapse: collapse;margin:20px;">
								<thead>
								<tr>
								  <th style="width: 10px;border: 1px solid black;">#</th>
								  <th style="border: 1px solid black;">Price</th>
								  <th  style="text-align:left;border: 1px solid black;">Extra Price</th>
								  <th   style="text-align:left;border: 1px solid black;">Type</th>
								  <th   style="text-align:left;border: 1px solid black;">Quantity</th>
								</tr>
								</thead>
								<tbody>
								<?php 
								$i=1;
									foreach($result['result'] as $row){
										?>
									<tr>
									  <td style="border: 1px solid black;"><?php echo $i;?>.</td>
									  <td style="text-align:center;border: 1px solid black;"><?php echo $row->tickets_Price;?></td>
									  <td style="border: 1px solid black;"><?php echo $row->tickets_ExtraPrice;?></td>
									  <td style="border: 1px solid black;">
									 <?php if($row->tickets_Type==1){
												echo'Concessional';
											}else{
													echo'General';
											}
										?>
									</td>
									  <td style="border: 1px solid black;"><?php
												if(isset($ticketQty[$row->tickets_Id]) && isset($ticketSoldQty[$row->tickets_Id])) {
													
													echo ($ticketQty[$row->tickets_Id] - $ticketSoldQty[$row->tickets_Id]); 
												}
												else {
													if(isset($ticketQty[$row->tickets_Id]) ) {
													
														echo ($ticketQty[$row->tickets_Id]); 
													}
													else {
														if(isset($ticketSoldQty[$row->tickets_Id]) ) {
														
															echo (-$ticketSoldQty[$row->tickets_Id]); 
														}
														else {
															echo '0';
														}
														
													}
													
												}
													
												?>
										</td>
									 
									</tr>
										<?php $i++;}?>
								</tbody>
								
							  </table>