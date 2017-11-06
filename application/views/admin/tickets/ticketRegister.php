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
            Ticket Register List
            <small>Manage Your Ticket  Register </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="#">Ticket  Register  List</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Ticket  Register  List</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<table id="webpagesList" class="table table-bordered table-hover">
								<thead>
								<tr>
								  <th style="width: 10px">#</th>
								  <th>Ticket</th>
								  <th>Quantity</th>
								  <th>Ticket Type</th>
								  <th>Date Time</th>
								  <th>Status</th>
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
									  <td><?php echo $row->tickets_Price;?> + <?php echo $row->tickets_ExtraPrice ;?></td>
									  <td><?php echo $row->TicketRegister_Qty;?></td>
									  <td>
									  <?php if($row->tickets_Type==1){
												echo'Concessional';
											}else{
													echo'General';
											}
										?>
									</td>
									  <td><?php echo $row->TicketRegister_DateTime;?></td>
									<td>
									  <?php if($row->TicketRegister_Status==1){
												echo'<span class="badge bg-green"> Active </span>';
											}else{
													echo'<span class="badge bg-warning">InActive</span>';
											}
										?>
									</td>
									  <td>
										<a href="<?php echo base_url() ;?>/admin/tickets/Ticket_Register/editTicketRegister/<?php echo $row->TicketRegister_Id;?>" class="btn  btn-info btn-sm" >Edit</a>
										
										<button onclick="deleteTicketRegister(<?php echo $row->TicketRegister_Id;?>)" class="btn  btn-danger btn-sm">Delete</button>
									  </td>
									</tr>
										<?php $i++;}?>
								</tbody>
								
							  </table>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		 <div class="modal fade modal-danger" id="deleteTicketRegister" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm Delete</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are You Sure You Want to Delete ??</p>
					<form action="<?php echo base_url() ;?>/admin/tickets/Ticket_Register/deleteTicketRegister" method="post">
						<input type="hidden" name="ticketRegisterId" id="ticketRegisterId"/>
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
		function deleteTicketRegister(id){
			$('#ticketRegisterId').val(id);
			$("#deleteTicketRegister").modal();
			
		}
	</script>