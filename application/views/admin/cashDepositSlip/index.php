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
            Cash Deposit Slip List
            <small>Manage Your Cash Deposit Slip</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="#">Cash Deposit Slip List</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Cash Deposit Slip List</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<table id="webpagesList" class="table table-bordered table-hover">
								<thead>
								<tr>
								  <th style="width: 10px">#</th>
								  <th>Slip Number</th>
								  <th>Route Number</th>
								  <th>Conductor Employee</th>
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
									  <td><?php echo $row->cashDeposit_slip_Number;?></td>
									  <td><?php echo $routes[$row->cashDeposit_slip_RouteId][0]['Bus_Routes_Number'];?></td>
									  <td><?php echo $employees[$row->cashDeposit_slip_RouteId][0]['Employee_Number'];?></td>
									  <td><?php echo $row->cashDeposit_slip_BusNumber;?></td>
									  <td><?php echo $row->cashDeposit_slip_Date;?></td>
									  <td>
										<a href="<?php echo base_url() ;?>admin/cashDepositSlip/cashDepositSlip/editCashDepositSlip/<?php echo $row->cashDeposit_slip_Id;?>" class="btn  btn-info btn-sm" >Edit</a>
										
										<button onclick="deleteCashDepositSlip(<?php echo $row->cashDeposit_slip_Id;?>)" class="btn  btn-danger btn-sm">Delete</button>
									  </td>
									</tr>
										<?php $i++;}?>
								</tbody>
								
							  </table>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		 <div class="modal fade modal-danger" id="deleteCashDepositSlip" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm Delete</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are You Sure You Want to Delete ??</p>
					<form action="<?php echo base_url() ;?>admin/cashDepositSlip/cashDepositSlip/deleteCashDepositSlip" method="post">
						<input type="hidden" name="cashslipId" id="cashslipId"/>
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
		function deleteCashDepositSlip(id){
			$('#cashslipId').val(id);
			$("#deleteCashDepositSlip").modal();
			
		}
	</script>