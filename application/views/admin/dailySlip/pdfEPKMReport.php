							<table  cellpadding="10" border="1px" style="width:100%;border:1px solid; border-collapse: collapse;margin:20px;">
										<tr>
											<th style="border: 1px solid black;">Duty Number</th>
											<th style="border: 1px solid black;">Total Trip</th>
											<th style="border: 1px solid black;">Actual Trip</th>
											<th style="border: 1px solid black;">Cancel Trip</th>
											<th style="border: 1px solid black;">Driver</th>
											<th style="border: 1px solid black;">Conductor</th>
											<th style="border: 1px solid black;">Workshop</th>
											<th style="border: 1px solid black;">Break Down</th>
											<th style="border: 1px solid black;">Accident</th>
											<th style="border: 1px solid black;">Traffic</th>
											<th style="border: 1px solid black;">Sunday</th>
											<th style="border: 1px solid black;">Route Change</th>
											<th style="border: 1px solid black;">Schedule Sp.</th>
											<th style="border: 1px solid black;">Schedule Km</th>
											<th style="border: 1px solid black;">Actual Km</th>
											<th style="border: 1px solid black;">Cancel Km</th>
											<th style="border: 1px solid black;">Extra Km</th>
											<th style="border: 1px solid black;">Amount</th>
											<th style="border: 1px solid black;">EPKM</th>
										</tr>
										<?php
												foreach($duty['result'] as $dutyrow){?>
												<tr>
													<td style="border: 1px solid black;"><?php echo $dutyrow->Bus_Routes_Number.' | '.$dutyrow->bus_duty_Number;?></td>
													<td style="border: 1px solid black;">
														<?php $totalTrip=0; $cancelTrip=0; 
														if(isset($actual[$dutyrow->bus_duty_Id]['TOTALTRIP'])){
																$totalTrip = $actual[$dutyrow->bus_duty_Id]['TOTALTRIP'];
															}
															echo $totalTrip;
														if(isset($actual[$dutyrow->bus_duty_Id]['TOTALCANCEL'])){
																$cancelTrip = $actual[$dutyrow->bus_duty_Id]['TOTALCANCEL'];
															}
															?>
													</td>
													<td style="border: 1px solid black;"><?php echo $totalTrip - $cancelTrip ;?></td>
													
													<td style="border: 1px solid black;"><?php
													$cantrip = 0;
													$driver = 0;
													$conductor=0;
													$workshop=0;
													$break=0;
													$accident=0;
													$traffic=0;
													$sunday=0;
													$routechange=0;
													$scheduleSp=0;
													if(isset($cancelCount[$dutyrow->bus_duty_Id]['Cancel Trip']))
														 $cantrip = $cancelCount[$dutyrow->bus_duty_Id]['Cancel Trip'];
													if(isset($cancelCount[$dutyrow->bus_duty_Id]['Driver']))
														 $driver = $cancelCount[$dutyrow->bus_duty_Id]['Driver'];
													if(isset($cancelCount[$dutyrow->bus_duty_Id]['Conductor']))
														 $conductor = $cancelCount[$dutyrow->bus_duty_Id]['Conductor'];
													if(isset($cancelCount[$dutyrow->bus_duty_Id]['Workshop']))
														 $workshop = $cancelCount[$dutyrow->bus_duty_Id]['Workshop'];
													if(isset($cancelCount[$dutyrow->bus_duty_Id]['Break Down']))
														 $break = $cancelCount[$dutyrow->bus_duty_Id]['Break Down'];
													if(isset($cancelCount[$dutyrow->bus_duty_Id]['Accident']))
														 $accident = $cancelCount[$dutyrow->bus_duty_Id]['Accident'];
													if(isset($cancelCount[$dutyrow->bus_duty_Id]['Traffic']))
														 $traffic = $cancelCount[$dutyrow->bus_duty_Id]['Traffic'];
													if(isset($cancelCount[$dutyrow->bus_duty_Id]['Sunday']))
														 $sunday = $cancelCount[$dutyrow->bus_duty_Id]['Sunday'];
													if(isset($cancelCount[$dutyrow->bus_duty_Id]['Route Change']))
														 $routechange = $cancelCount[$dutyrow->bus_duty_Id]['Route Change'];
													if(isset($cancelCount[$dutyrow->bus_duty_Id]['Schedule Sp']))
														 $scheduleSp = $cancelCount[$dutyrow->bus_duty_Id]['Schedule Sp'];
													 
													  echo  $cantrip
													?></td>
													<td style="border: 1px solid black;">
													<?php echo  $driver ;?>
													</td>
													<td style="border: 1px solid black;"><?php echo  $conductor ;?></td>
													<td style="border: 1px solid black;"><?php echo  $workshop ;?></td>
													<td style="border: 1px solid black;"><?php echo  $break ;?></td>
													<td style="border: 1px solid black;"><?php echo  $accident ;?></td>
													<td style="border: 1px solid black;"><?php echo  $traffic ;?></td>
													<td style="border: 1px solid black;"><?php echo  $sunday ;?></td>
													<td style="border: 1px solid black;"><?php echo  $routechange ;?></td>
													<td style="border: 1px solid black;"><?php echo  $scheduleSp ;?></td>
													<td style="border: 1px solid black;">
														<?php $schedulekm = isset($schedule[$dutyrow->bus_duty_Id]['KM']) ? $schedule[$dutyrow->bus_duty_Id]['KM'] : 0 ;
															$actualkm = isset($actual[$dutyrow->bus_duty_Id]['KM']) ?$actual[$dutyrow->bus_duty_Id]['KM'] :0 ;
															$cancelkm=0;
															$extrakm=0;
															if($schedulekm >= $actualkm){
																$cancelkm = $schedulekm - $actualkm;
															} else {
																$extrakm = $actualkm - $schedulekm;
															}
													echo $schedulekm
													?>
													</td>
													<td style="border: 1px solid black;">
													<?php echo $actualkm ;?>
													</td>
													
													<td style="border: 1px solid black;"><?php echo $cancelkm;?></td>
													<td style="border: 1px solid black;"><?php echo $extrakm;?></td>
													<td style="border: 1px solid black;">
													<?php $totalamount =0;
													if(isset($amount[$dutyrow->bus_duty_Id]['AMOUNT']))
														$totalamount= $amount[$dutyrow->bus_duty_Id]['AMOUNT'];
													echo $totalamount;
													?>
													</td>
													<td style="border: 1px solid black;">
														<?php if($actualkm !=0){
															echo ($totalamount/$actualkm);
														}else{
															echo 0;
														}?>
													</td>
											</tr>
										<?php		}
										
										?>
									</table>