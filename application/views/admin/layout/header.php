<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KDMT Panel </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url() ;?>html/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ;?>html/admin/dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ;?>html/admin/dist/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url() ;?>html/admin/plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ;?>html/admin/dist/css/AdminLTE.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url() ;?>html/admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url() ;?>html/admin/plugins/datatables/dataTables.bootstrap.css">
   
    <link rel="stylesheet" href="<?php echo base_url() ;?>html/admin/dist/css/skins/skin-blue.min.css">
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>html/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
		input .error , select .error{
			    outline: 1px solid red;
		}
		
		input, select{
			    outline: 1px solid #ccc ;
		}
		label.error{
			color:red;
			font-size:12px;
		}
	</style>
	<?php if(isset($this->session->userdata['logged_in']) && $this->session->userdata['logged_in']['role']!=1) {?>
	<style>
		.admin-btn{
			display:none;
		}
	</style>
	<?php } ?>
	<script>
	$(document).ready(function(){
		Number.prototype.zeroPad = function(digits) {
			  var loop = digits;
			  var zeros = "";
			  while (loop) {
				zeros += "0";
				loop--;
			  }
			  return (this.toString().length > digits) ?
				this.toString() : (zeros + this).slice(-digits);
			}
			
		});
	</script>
  </head>
  