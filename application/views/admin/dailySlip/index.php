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
            Daily Slip List
            <small>Manage Your Daily Slip</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="#">Daily Slip List</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Daily Slip List</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<table id="webpagesList" class="table table-bordered table-hover">
								<thead>
								<tr>
								  <th style="width: 10px">#</th>
								  <th>Route Number</th>
								  <th>Conductor Employee Id</th>
								  <th>TotalIncome</th>
								  <th>Bus Number</th>
								  <th>Date</th>
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
									  <td><?php echo $routes[$row->conductor_daysSlip_RoutesId][0]['Bus_Routes_Number'];?></td>
									  <td><?php echo $employees[$row->conductor_daysSlip_RoutesId][0]['Employee_Number'];?></td>
									  <td><?php echo $row->conductor_daysslip_TotalIncome;?></td>
									  <td><?php echo $row->conductor_daysSlip_BusNumber;?></td>
									  <td><?php echo $row->conductor_daysslip_date;?></td>
									  <td>
										<a href="<?php echo base_url() ;?>admin/dailySlip/dailySlip/editDailySlip/<?php echo $row->conductor_daysSlip_Id;?>" class="btn  btn-info btn-sm" >Edit</a>
										
										<button onclick="deleteDailySlip(<?php echo $row->conductor_daysSlip_Id;?>)" class="btn  btn-danger btn-sm">Delete</button>
									  </td>
									</tr>
										<?php $i++;}?>
								</tbody>
								
							  </table>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		 <div class="modal fade modal-danger" id="deleteDailySlip" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm Delete</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are You Sure You Want to Delete ??</p>
					<form action="<?php echo base_url() ;?>admin/dailySlip/dailySlip/deleteDailySlip" method="post">
						<input type="hidden" name="dailyslipId" id="dailyslipId"/>
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
		function deleteDailySlip(id){
			$('#dailyslipId').val(id);
			$("#deleteDailySlip").modal();
			
		}
	</script>