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
            Bus Duty List
            <small>Manage Your Bus Duty </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="#">Bus Duty  List</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Bus Duty  List
							<a class="btn btn-warning btn-sm " href="<?php echo base_url() ;?>admin/bus/Bus_Duty/downloadBusDutyList" target="_blank">Export as PDF</a>
							</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<table id="webpagesList" class="table table-bordered table-hover">
								<thead>
								<tr>
								  <th style="width: 10px">#</th>
								  <th>Route Number</th>
								  <th>Duty Number</th>
								  <th>Created On Date Time</th>
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
									  <td><?php echo $row->Bus_Routes_Number .' :: '. $row->Bus_Routes_Name;?></td>
									  <td><?php echo $row->bus_duty_Number;?></td>
									  <td><?php echo $row->bus_duty_CreatedOn;?></td>
									  <td>
										<a href="<?php echo base_url() ;?>/admin/bus/Bus_Duty/editBusDuty/<?php echo $row->bus_duty_Id;?>" class=" admin-btn btn  btn-info btn-sm" >Edit</a>
										
										<button onclick="deleteBusDuty(<?php echo $row->bus_duty_Id;?>)" class="btn admin-btn  btn-danger btn-sm">Delete</button>
									  </td>
									</tr>
										<?php $i++;}?>
								</tbody>
								
							  </table>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		 <div class="modal fade modal-danger" id="deleteBusDuty" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm Delete</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are You Sure You Want to Delete ??</p>
					<form action="<?php echo base_url() ;?>/admin/bus/Bus_Duty/deleteBusDuty" method="post">
						<input type="hidden" name="busDutyId" id="busDutyId"/>
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
		function deleteBusDuty(id){
			$('#busDutyId').val(id);
			$("#deleteBusDuty").modal();
			
		}
	</script>