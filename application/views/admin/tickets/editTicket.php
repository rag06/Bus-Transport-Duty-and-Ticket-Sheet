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
            Edit Ticket
            <small>Update Your Ticket</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>/admin/tickets/tickets/index">Manage Tickets</a></li>
            <li class="active"><a href="#">Edit Ticket</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Edit Ticket : <?php echo $result[0]['tickets_Price'];?></h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" action="<?php echo base_url() ;?>admin/tickets/tickets/updateTicket">
								<input type="hidden" name="tickets_Id" value="<?php echo$result[0]['tickets_Id'];?>" />
								 <?php
								echo "<div class='error_msg'>";
								if (isset($error_message)) {
								echo $error_message;
								}
								echo validation_errors();
								echo "</div>";
								?>
								<div class="form-group">
								  <label for="ticketPrice">Ticket Price</label>
								  <input type="text" class="form-control" id="ticketPrice" name="ticketPrice" placeholder="Enter  Ticket Price" value="<?php echo$result[0]['tickets_Price'];?>" >
								</div>
								<div class="form-group">
								  <label for="ticketExtraPrice">Ticket Extra Price</label>
								  <input type="text" class="form-control" id="ticketExtraPrice" name="ticketExtraPrice" placeholder="Enter  Ticket Extra Price" value="<?php echo$result[0]['tickets_ExtraPrice'];?>" >
								</div>
								<div class="form-group">
								 <label for="ticketType">Ticket Type</label>
								  <select class="form-control" name="ticketType" id="ticketType">
									<?php if($result[0]['tickets_Type']==1){
												echo'<option value="0">General</option>
													<option value="1" selected>Concessional</option>';
											}else{
												echo'<option value="0" selected>General</option>
													<option value="1">Concessional</option>';
											}?>
								  </select>
								</div>
								<div class="form-group">
								 <label for="ticketStatus"> Status</label>
								  <select class="form-control" name="ticketStatus" id="ticketStatus">
									<?php if($result[0]['tickets_Status']==1){
												echo'<option value="0">InActive</option>
													<option value="1" selected>Active</option>';}
											else{
												echo'<option value="0" selected>InActive</option>
													<option value="1">Active</option>';
											}?>
								  </select>
								</div>
								<a href="<?php echo base_url() ;?>/admin/tickets/tickets" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Save Changes </button>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>