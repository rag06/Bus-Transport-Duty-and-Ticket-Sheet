<?php $this->load->view('admin/layout/header.php');?>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
	<?php $this->load->view('admin/layout/mainHeader.php');?>
	<?php $this->load->view('admin/layout/sideBar.php');?>
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Everything you want to know</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
			 <!-- Small boxes (Stat box) -->
			  <div class="row">
				<div class="col-lg-3 col-xs-6">
				  <!-- small box -->
				  <div class="small-box bg-aqua">
					<div class="inner">
					  <h3><?php echo $currentDay ?  $currentDay[0]['TotalSales'] : 0; ?></h3>

					  <p>Today Sales</p>
					</div>
					<div class="icon">
					  <i class="ion ion-bag"></i>
					</div>
					<!--a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a-->
				  </div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
				  <!-- small box -->
				  <div class="small-box bg-green">
					<div class="inner">
					  <h3><?php 
					  $now = new \DateTime('now');
					   $month = $now->format('m');
					   $year = $now->format('Y');
					  foreach($sales as $sale){
								if($sale['SalesMonth'] == $month  && $sale['SalesYear']== $year ){
									echo $sale['TotalSales'];
								}
					  } ?></h3>

					  <p>This Month Sale</p>
					</div>
					<div class="icon">
					  <i class="ion ion-stats-bars"></i>
					</div>
					<!--a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a-->
				  </div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
				  <!-- small box -->
				  <div class="small-box bg-yellow">
					<div class="inner">
					  <h3><?php echo $adminusers[0]['VAL']; ?></h3>

					  <p>Admin User</p>
					</div>
					<div class="icon">
					  <i class="ion ion-person-add"></i>
					</div>
					<!--a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a-->
				  </div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
				  <!-- small box -->
				  <div class="small-box bg-red">
					<div class="inner">
					  <h3><?php echo $routecount[0]['VAL']; ?></h3>

					  <p>Total Routes</p>
					</div>
					<div class="icon">
					  <i class="ion ion-pie-graph"></i>
					</div>
					<!--a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a-->
				  </div>
				</div>
				<!-- ./col -->
			  </div>
			  <!-- /.row -->
			  <div class="row">
				<div class="col-lg-4 col-md-4">
				<!-- DONUT CHART -->
				  <div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Employees </h3>

					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					  </div>
					</div>
					<div class="box-body">
					  <canvas id="pieChart" style="height:250px"></canvas>
					</div>
					<!-- /.box-body -->
				  </div>
				  <!-- /.box -->
				</div>
				<div class="col-lg-4 col-md-4">
				<!-- DONUT CHART -->
				  <div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">No. of Bus Per Route</h3>

					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					  </div>
					</div>
					<div class="box-body">
					  <canvas id="pieChartforBus" style="height:250px"></canvas>
					</div>
					<!-- /.box-body -->
				  </div>
				  <!-- /.box -->
				</div>
			  </div>
			  <div class="row">
				<div class="col-lg-4 col-md-4">
				  <!-- PRODUCT LIST -->
				  <div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Sales per Year Per Month</h3>
					  <div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					  </div>
					</div><!-- /.box-header -->
					<div class="box-body">
					  <table class="table datatable">
						<thead>
							<tr>
								<th>Year</th>
								<th>Month</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i=0;
								foreach($sales as $sale){
									$i++;
									if($i == 3)
										break;
									echo '<tr>
											<td>'.$sale['SalesYear'].'</td>
											<td>'.$sale['SalesMonth'].'</td>
											<td> Rs. '.$sale['TotalSales'].'</td>
										</tr>';
								}
								?>
						</tbody>
					  </table>
					</div><!-- /.box-body -->
					<div class="box-footer text-center">
					  <a href="#" class="uppercase">View All</a>
					</div><!-- /.box-footer -->
				  </div><!-- /.box -->
				</div>
				<div class="col-lg-4 col-md-4">
				  <!-- PRODUCT LIST -->
				  <div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Sales per Ticket per Year Per Month</h3>
					  <div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					  </div>
					</div><!-- /.box-header -->
					<div class="box-body">
					  <table class="table datatable">
						<thead>
							<tr>
								<th>Ticket</th>
								<th>Year</th>
								<th>Month</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i=0;
								foreach($tickets as $ticket){
									$i++;
									if($i == 3)
										break;
									echo '<tr>
											<td>'.$ticketsData[$ticket['cashDeposit_slip_details_TicketId']]->tickets_Price.'</td>
											<td>'.$ticket['SalesYear'].'</td>
											<td>'.$ticket['SalesMonth'].'</td>
											<td> Rs. '.$ticket['TotalSales'].'</td>
										</tr>';
								}
								?>
						</tbody>
					  </table>
					</div><!-- /.box-body -->
					<div class="box-footer text-center">
					  <a href="#" class="uppercase">View All</a>
					</div><!-- /.box-footer -->
				  </div><!-- /.box -->
				</div>
				<div class="col-lg-4 col-md-4">
				  <!-- PRODUCT LIST -->
				  <div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">Sales per Route per Year Per Month</h3>
					  <div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
					  </div>
					</div><!-- /.box-header -->
					<div class="box-body">
					  <table class="table datatable">
						<thead>
							<tr>
								<th>Route</th>
								<th>Year</th>
								<th>Month</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$i=0;
								foreach($routes as $route){
									$i++;
									if($i == 3)
										break;
									echo '<tr>
											<td>'.$routesData[$route['cashDeposit_slip_RouteId']]->Bus_Routes_Number.'</td>
											<td>'.$route['SalesYear'].'</td>
											<td>'.$route['SalesMonth'].'</td>
											<td> Rs. '.$route['TotalSales'].'</td>
										</tr>';
								}
								?>
						</tbody>
					  </table>
					</div><!-- /.box-body -->
					<div class="box-footer text-center">
					  <a href="#" class="uppercase">View All</a>
					</div><!-- /.box-footer -->
				  </div><!-- /.box -->
				</div>
			  </div>
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

     <?php $this->load->view('admin/layout/footer.php');?>
	 
<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url();?>html/admin/plugins/chartjs/Chart.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>html/admin/plugins/fastclick/fastclick.js"></script>
	 <script>
	  //-------------
		//- PIE CHART -
		//-------------
		// Get context with jQuery - using jQuery's .get() method.
		var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
		var pieChartforBus = $("#pieChartforBus").get(0).getContext("2d");
		var pieChart = new Chart(pieChartCanvas);
		var pieChartforBus = new Chart(pieChartforBus);
		var PieData = [
		<?php foreach($employees as $emp){
			$color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
		?>
		  {
			value: "<?php echo $emp['VAL']; ?>",
			color: "<?php echo $color; ?>",
			highlight: "<?php echo $color; ?>",
			label: "<?php echo  $emp['Employee_Type'] == 1 ?  "Conductor" :  "Driver" ; ?>"
		  },
		  <?php } ?>
		];
		var pieChartforBusData = [
		<?php 	foreach($noOfBusPerRoute as $noOfBus){
			$color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
		?>
		  {
			value: "<?php echo $noOfBus['COUNT']; ?>",
			color: "<?php echo $color; ?>",
			highlight: "<?php echo $color; ?>",
			label: "Route-<?php echo  $routesData[$noOfBus['bus_timing_routeId']]->Bus_Routes_Number; ?>"
		  },
		  <?php } ?>
		];
		var pieOptions = {
		  //Boolean - Whether we should show a stroke on each segment
		  segmentShowStroke: true,
		  //String - The colour of each segment stroke
		  segmentStrokeColor: "#fff",
		  //Number - The width of each segment stroke
		  segmentStrokeWidth: 2,
		  //Number - The percentage of the chart that we cut out of the middle
		  percentageInnerCutout: 50, // This is 0 for Pie charts
		  //Number - Amount of animation steps
		  animationSteps: 100,
		  //String - Animation easing effect
		  animationEasing: "easeOutBounce",
		  //Boolean - Whether we animate the rotation of the Doughnut
		  animateRotate: true,
		  //Boolean - Whether we animate scaling the Doughnut from the centre
		  animateScale: false,
		  //Boolean - whether to make the chart responsive to window resizing
		  responsive: true,
		  // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		  maintainAspectRatio: true,
		  //String - A legend template
		  legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
		};
		//Create pie or douhnut chart
		// You can switch between pie and douhnut using the method below.
		pieChart.Doughnut(PieData, pieOptions);
		pieChartforBus.Doughnut(pieChartforBusData, pieOptions);
	 </script>