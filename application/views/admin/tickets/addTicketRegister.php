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
            Add Entry in Ticket Register
            <small>Add Entry in  Your Ticket Register</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url() ;?>admin/tickets/Ticket_Register/index">Manage Ticket Registers</a></li>
            <li class="active"><a href="#">Add Entry in Ticket Register</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Add Entry in Ticket Register</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<form method="post" action="<?php echo base_url() ;?>/admin/tickets/Ticket_Register/insertTicketRegister">
								 <?php
								echo "<div class='error_msg'>";
								if (isset($error_message)) {
								echo $error_message;
								}
								echo validation_errors();
								echo "</div>";
								?>
								<div class="form-group">
								  <label for="ticketId"> Ticket</label>
								  <select class="form-control" id="ticketId" name="ticketId" >
									<?php foreach($tickets['result']  as $ticketRow){
											echo '<option value="'.$ticketRow->tickets_Id .'">'.$ticketRow->tickets_Price .' + '. $ticketRow->tickets_ExtraPrice .'</option>';
										}
									?>
								  </select>
								</div>
								<div class="form-group">
								  <label for="ticketQty">Quantity</label>
								  <input type="text" class="form-control" id="ticketQty" name="ticketQty">
								</div>
								<div class="form-group">
								 <label for="ticketRegisterStatus"> Status</label>
								  <select class="form-control" name="ticketRegisterStatus" id="ticketRegisterStatus">
									<?php 	echo'<option value="0" >InActive</option>
													<option value="1" selected>Active</option>';
									?>
								  </select>
								</div>
							
								<a href="<?php echo base_url() ;?>admin/tickets/Ticket_Register/index" class="btn btn-success btn-sm">Cancel</a>
								<button type="submit" class="btn btn-primary pull-right">Add Entry </button>
							</form>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		
     <?php $this->load->view('admin/layout/footer.php');?>