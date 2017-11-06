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
            Bus Routes List
            <small>Manage Your Bus Routes</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="#">Bus Routes List</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
				 <div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title">Bus Routes List</h3>
						</div><!-- /.box-header -->
						  <div class="box-body">
							<table id="webpagesList" class="table table-bordered table-hover">
								<thead>
								<tr>
								  <th style="width: 10px">#</th>
								  <th>Number</th>
								  <th>Source</th>
								  <th>Destination</th>
								  <th>Kilometres</th>
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
									  <td><?php echo $row->Bus_Routes_Number;?></td>
									  <td><?php echo $row->Bus_Routes_Source;?></td>
									  <td><?php echo $row->Bus_Routes_Destination;?></td>
									  <td><?php echo $row->Bus_Routes_Kilometers;?></td>
									<td>
									  <?php if($row->Bus_Routes_Status==1){
												echo'<span class="badge bg-green"> Active </span>';
											}else{
													echo'<span class="badge bg-warning">InActive</span>';
											}
										?>
									</td>
									  <td>
										<a href="<?php echo base_url() ;?>admin/bus/bus/editBusRoute/<?php echo $row->Bus_Routes_Id;?>" class="btn  btn-info btn-sm" >Edit</a>
										
										<button onclick="deleteBusRoute(<?php echo $row->Bus_Routes_Id;?>)" class="btn  btn-danger btn-sm">Delete</button>
									  </td>
									</tr>
										<?php $i++;}?>
								</tbody>
								
							  </table>
						  </div><!-- /.box-body -->
					</div><!--box end-->
			</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
		 <div class="modal fade modal-danger" id="deleteBusRoute" >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirm Delete</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are You Sure You Want to Delete ??</p>
					<form action="<?php echo base_url() ;?>admin/bus/bus/deleteBusRoute" method="post">
						<input type="hidden" name="busRouteId" id="busRouteId"/>
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
		function deleteBusRoute(id){
			$('#busRouteId').val(id);
			$("#deleteBusRoute").modal();
			
		}
	</script>