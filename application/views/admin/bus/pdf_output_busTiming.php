			<br/>
			<br/>
			<br/>
			<br/>
						  <h3 class="box-title" style="margin:20px;">Bus Duty List  </h3>
							<table id="webpagesList" cellpadding="10" border="1px" style="width:100%;border:1px solid; border-collapse: collapse;margin:20px;">
								<thead>
								<tr>
								  <th style="width: 10px;border: 1px solid black;">#</th>
								  <th style="border: 1px solid black;">Source</th>
								  <th style="border: 1px solid black;">Destination</th>
								  <th style="border: 1px solid black;">Start Time</th>
								  <th style="border: 1px solid black;">End Time</th>
								  <th style="border: 1px solid black;">Kilometers</th>
								</tr>
								</thead>
								<tbody>
								<?php function print_details($routeId , $dutyId){
									$i=1;
									$str='';
									foreach($result['result'] as $row){
										return $row->bus_timing_RouteId == $routeId;
										if($row->bus_timing_RouteId == $routeId && $row->bus_timing_DutyId == $dutyId){
										
									$str .= '<tr>
									  <td style="border: 1px solid black;">'.$i.'</td>
									  <td style="text-align:left;border: 1px solid black">'.$row->bus_timing_Source.'</td>
									  <td style="text-align:left;border: 1px solid black">'. $row->bus_timing_Destination.'</td>
									  <td style="text-align:left;border: 1px solid black">'.$row->bus_timing_StartTime.'</td>
									  <td style="text-align:left;border: 1px solid black">'.$row->bus_timing_DestinationTime.'</td>
									  <td style="text-align:left;border: 1px solid black">'.$row->bus_timing_Kilometers.'</td>
									</tr>';
								
									$i++;
										}
								
									}
									return $str;
								}
								
									foreach($routesData['result'] as $routeRow){
										echo '<tr>
											  <td colspan="6" style="text-align:left;border: 1px solid black"> <b>'.$routeRow->Bus_Routes_Number.'|'.$routeRow->bus_duty_Number.'</b>.</td>
											</tr>';
											
										$i=1;
										$str='';
										$routeId = $routeRow->Bus_Routes_Id;
										$dutyId = $routeRow->bus_duty_Id;
										foreach($result['result'] as $row){
											if($row->bus_timing_RouteId == $routeId && $row->bus_timing_DutyId == $dutyId){
											
												echo '<tr>
												  <td style="border: 1px solid black;">'.$i.'</td>
												  <td style="text-align:left;border: 1px solid black">'.$row->bus_timing_Source.'</td>
												  <td style="text-align:left;border: 1px solid black">'. $row->bus_timing_Destination.'</td>
												  <td style="text-align:left;border: 1px solid black">'.$row->bus_timing_StartTime.'</td>
												  <td style="text-align:left;border: 1px solid black">'.$row->bus_timing_DestinationTime.'</td>
												  <td style="text-align:left;border: 1px solid black">'.$row->bus_timing_Kilometers.'</td>
												</tr>';
											
												$i++;
											}
									
										}
										if($i<2)
										echo '<tr>
											  <td colspan="6" style="text-align:left;border: 1px solid black">No Bus Timings Found.</td>
											</tr>';
									}?>
								</tbody>
								
							  </table>