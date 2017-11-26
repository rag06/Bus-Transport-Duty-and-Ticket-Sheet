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
										<?php $curentRoute =0;$i=1;
										$flag =false; $grandTotal=0; $grandCancel=0;
															$grandDriver =0;
															$grandconductor =0;
															$grandworkshop =0;
															$grandbreak =0;
															$grandaccident =0;
															$grandtraffic =0;
															$grandsunday =0;
															$grandroutechange =0;
															$grandscheduleSp =0;$grandactualkm=0; 
															$grandcancelkm=0;
															$grandextrakm=0; 
															$grandtotalamount=0; $grandschedulekm=0;
															$grandschedulekm=0;
														
												foreach($duty['result'] as $dutyrow){
													
													
												 $count = $dutycount[$dutyrow->bus_duty_RouteId]['COUNT'];
													if($i == $count)
													{
														$i=1;
														$flag =true;
													}
													
													$i++; 
													?>
													
										
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
															
															$grandTotal=$totalTrip;
															$grandCancel = $cancelTrip;
															
															?>
													</td>
													<td style="border: 1px solid black;"><?php echo $totalTrip - $cancelTrip ;?></td>
													
													<td style="border: 1px solid black;"><?php echo $cancelTrip ;?>
													</td>
													<?php
													$driver = 0;
													$conductor=0;
													$workshop=0;
													$break=0;
													$accident=0;
													$traffic=0;
													$sunday=0;
													$routechange=0;
													$scheduleSp=0;
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
													 
											$schedulekm = isset($schedule[$dutyrow->bus_duty_Id]['KM']) ? $schedule[$dutyrow->bus_duty_Id]['KM'] : 0 ;
											$grandschedulekm += $schedulekm;
											$actualkm = isset($actual[$dutyrow->bus_duty_Id]['KM']) ?$actual[$dutyrow->bus_duty_Id]['KM'] :0 ;
															$cancelkm=0;
															$extrakm=0;
															if($schedulekm >= $actualkm){
																$cancelkm = $schedulekm - $actualkm;
															} else {
																$extrakm = $actualkm - $schedulekm;
															}
															
													?>
													<td style="border: 1px solid black;">
													<?php 
													if(($driver)) {
														echo $driver;
														$grandDriver +=  $driver;
													} else{
														echo '0';
													};?>
													</td>
													<td style="border: 1px solid black;"><?php  if(($conductor)){
														
														$grandconductor +=  $conductor;
														echo $conductor >0 ? $conductor : '0';
														} else
														{
															echo '0';
														}?></td>
													<td style="border: 1px solid black;"><?php  if(($workshop)){
														
														$grandworkshop +=  $workshop;
														echo $workshop >0 ? $workshop : '0';
													} else{
														echo '0';
													} ?></td>
													<td style="border: 1px solid black;"><?php 
													if(($break)){
														
														$grandbreak +=  $break;
														echo $break >0 ? $break : '0';
													} else{
														echo '0';
													} ?></td>
													<td style="border: 1px solid black;"><?php 
													if(($accident)){
														
														$grandaccident +=  $accident;
														echo $accident >0 ? $accident : '0';
													} else{
														echo '0';
													} ?></td>
													<td style="border: 1px solid black;"><?php 
													if(($traffic)){
														
														$grandtraffic +=  $traffic;
														echo $traffic >0 ? $traffic : '0';
													} else{
														echo '0';
													} ?></td>
													<td style="border: 1px solid black;"><?php 
													if(($sunday)){
														
														$grandsunday +=  $sunday;
														echo $sunday >0 ? $sunday : '0';
													} else{
														echo '0';
													} ?></td>
													<td style="border: 1px solid black;"><?php 
													if(($routechange)){
														
														$grandroutechange +=  $routechange;
														echo $routechange >0 ? $routechange : '0';
													} else{
														echo '0';
													} ?></td>
													<td style="border: 1px solid black;">
													<?php 
													if(($scheduleSp)){
														
														$grandscheduleSp +=  $scheduleSp;
														echo $scheduleSp >0 ? $scheduleSp : '0';
													} else{
														echo '0';
													} ?></td>
													<td style="border: 1px solid black;">
														<?php
															 
															 $grandschedulekm +=$schedulekm;
																echo $schedulekm;
														?>
													</td>
													<td style="border: 1px solid black;">
													<?php   $grandactualkm +=$actualkm; echo $actualkm ; ?>
													</td>
													
													<td style="border: 1px solid black;"><?php   $grandcancelkm +=$cancelkm; echo $cancelkm;?></td>
													<td style="border: 1px solid black;"><?php   $grandextrakm +=$extrakm; echo $extrakm;?></td>
													<td style="border: 1px solid black;">
													<?php $totalamount =0;
													if(isset($amount[$dutyrow->bus_duty_Id]['AMOUNT']))
														$totalamount= $amount[$dutyrow->bus_duty_Id]['AMOUNT'];
													
													 $grandtotalamount +=$totalamount;
													
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
											<?php	if($flag){?>
													<tr>
														<th style="border: 1px solid black;"><?php echo $dutyrow->Bus_Routes_Number;?></th>
														<th style="border: 1px solid black;"><?php echo $grandTotal;?></th>
														<th style="border: 1px solid black;"><?php echo $grandTotal - $grandCancel;?></th>
														<th style="border: 1px solid black;"><?php echo $grandCancel;?></th>
														<th style="border: 1px solid black;"><?php echo $grandDriver;?></th>
														<th style="border: 1px solid black;"><?php echo $grandconductor;?></th>
														<th style="border: 1px solid black;"><?php echo $grandworkshop;?></th>
														<th style="border: 1px solid black;"><?php echo $grandbreak;?></th>
														<th style="border: 1px solid black;"><?php echo $grandaccident;?></th>
														<th style="border: 1px solid black;"><?php echo $grandtraffic;?></th>
														<th style="border: 1px solid black;"><?php echo $grandsunday;?></th>
														<th style="border: 1px solid black;"><?php echo $grandroutechange;?></th>
														<th style="border: 1px solid black;"><?php echo $grandscheduleSp;?></th>
														<th style="border: 1px solid black;"><?php echo $grandschedulekm;?></th>
														<th style="border: 1px solid black;"><?php echo $grandactualkm;?></th>
														<th style="border: 1px solid black;"><?php echo $grandcancelkm;?></th>
														<th style="border: 1px solid black;"><?php echo $grandextrakm;?></th>
														<th style="border: 1px solid black;"><?php echo $grandtotalamount;?></th>
														<th style="border: 1px solid black;"><?php if($grandactualkm !=0){
															echo ($grandtotalamount/$grandactualkm);
														}else{
															echo 0;
														}?></th>
													</tr>
													<?php 
													
															$flag =false; $grandTotal=0; $grandCancel=0;
															$grandDriver =0;
															$grandconductor =0;
															$grandworkshop =0;
															$grandbreak =0;
															$grandaccident =0;
															$grandtraffic =0;
															$grandsunday =0;
															$grandroutechange =0;
															$grandscheduleSp =0;$grandactualkm=0; $grandschedulekm=0;
															$grandcancelkm=0;
															$grandextrakm=0; 
															$grandtotalamount=0; 
															$grandschedulekm=0;
													
													} ?>	
													
										<?php 		
										}
										
										?>
									</table>