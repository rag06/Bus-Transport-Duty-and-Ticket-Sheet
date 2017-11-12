 <!-- Main Footer -->
      <!--footer class="main-footer">
        <!-- To the right 
        <div class="pull-right hidden-xs">
          Anything you want
        </div>
        <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
      </footer-->

     

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>html/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>html/admin/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>html/admin/dist/js/app.min.js"></script>
    <script src="<?php echo base_url();?>html/admin/dist/js/jquery.validate.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url();?>html/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>html/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- date-range-picker -->
    <script src="<?php echo base_url();?>html/admin/dist/js/moment.min.js"></script>
    <script src="<?php echo base_url();?>html/admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- InputMask -->
    <script src="<?php echo base_url();?>html/admin/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo base_url();?>html/admin/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo base_url();?>html/admin/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	
	<!-- webpages page-->
	<script>
		
		$(function () {
        $('#webpagesList').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true
        });
		
      });
	</script>
	<!-- admin manage page-->
	<script>
		function deleteAdmin(id){
			$('#adminId').val(id);
			$("#deleteAdmin").modal();
			
		}
	</script>
  </body>
</html>
