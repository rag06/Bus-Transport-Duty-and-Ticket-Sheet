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
            Bus Timing List
            <small>Manage Your Bus Timing </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="#">Bus Timing  List</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Bus Timing  List
							<a class="btn btn-warning btn-sm " href="<?php echo base_url() ;?>admin/bus/Bus_Timing/downloadBusTimingList" target="_blank">Export as PDF</a>
							</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<table id="webpagesList" class="table table-bordered table-hover">
								<thead>
								<tr>
								  <th style="width: 10px">#</th>
								  <th>Duty Number</th>
								  <th>Source</th>
								  <th>Destination</th>
								  <th>Start Time</th>
								  <th>End Time</th>
								  <th>Kilometers</th>
								  <th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php 
								$i=1;
									foreach($result['result'] as $row){
										?>
									<tr>
									  <td><?php echo $i;?>.</td>
									  <td><?php echo $routesData[$row->bus_timing_RouteId]->Bus_Routes_Number .' | '.$row->bus_duty_Number ;?></td>
									  <td><?php echo $row->bus_timing_Source;?></td>
									  <td><?php echo $row->bus_timing_Destination;?></td>
									  <td><?php echo $row->bus_timing_StartTime;?></td>
									  <td><?php echo $row->bus_timing_DestinationTime;?></td>
									  <td><?php echo $row->bus_timing_Kilometers;?></td>
									  <td>
										<a href="<?php echo base_url() ;?>/admin/bus/Bus_Timing/editBusTiming/<?php echo $row->bus_timing_Id;?>" class="btn   admin-btn btn-info btn-sm" >Edit</a>
										
										<button onclick="deleteBusTiming(<?php echo $row->bus_timing_Id;?>)" class="btn admin-btn btn-danger btn-sm">Delete</button>
									  </td>
									</tr>
										<?php $i++;}?>
								</tbody>
								
							  </table>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		 <div class="modal fade modal-danger" id="deleteBusTiming" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm Delete</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are You Sure You Want to Delete ??</p>
					<form action="<?php echo base_url() ;?>/admin/bus/Bus_Timing/deleteBusTiming" method="post">
						<input type="hidden" name="busTimingId" id="busTimingId"/>
						<input type="submit" class="btn btn-outline" value="Yes">
					</form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
					
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
     <?php $this->load->view('admin/layout/footer.php');?>
	 
	<!-- admin manage page-->
	<script>
		function deleteBusTiming(id){
			$('#busTimingId').val(id);
			$("#deleteBusTiming").modal();
			
		}
	</script>