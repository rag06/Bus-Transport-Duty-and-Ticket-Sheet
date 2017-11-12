			<br/>
			<br/>
			<br/>
			<br/>
						  <h3 class="box-title" style="margin:20px;">Bus Duty List  </h3>
							<table id="webpagesList" cellpadding="10" border="1px" style="width:100%;border:1px solid; border-collapse: collapse;margin:20px;">
								<thead>
								<tr>
								  <th style="width: 10px;border: 1px solid black;">#</th>
								  <th style="border: 1px solid black;">Route no.</th>
								  <th  style="text-align:left;border: 1px solid black;">Route Name</th>
								  <th  style="text-align:left;border: 1px solid black;">Duty Number</th>
								</tr>
								</thead>
								<tbody>
								<?php 
								$i=1;
									foreach($result['result'] as $row){
										?>
									<tr>
									  <td style="border: 1px solid black;"><?php echo $i;?>.</td>
									  <td style="text-align:center;border: 1px solid black"><?php echo $row->Bus_Routes_Number;?></td>
									  <td style="text-align:center;border: 1px solid black;"><?php echo $row->Bus_Routes_Name;?></td>
									  <td style="border: 1px solid black;"><?php echo $row->bus_duty_Number;?></td>
									 
									</tr>
										<?php $i++;}?>
								</tbody>
								
							  </table>