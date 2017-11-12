<?php $this->load->view('admin/layout/header.php');?>
  <body class="hold-transition login-page">
     <div class="login-box">
      <div class="login-logo">
        <a href="#">Admin Panel : <b></b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
			  <?php
					if (isset($logout_message)) {
					echo "<div class='message'>";
					echo $logout_message;
					echo "</div>";
					}
					?>
					<?php
					if (isset($message_display)) {
					echo "<div class='message'>";
					echo $message_display;
					echo "</div>";
					}
					?>
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="<?php echo base_url();?>/admin/login/login/user_login_process" method="post">
			<?php
				echo "<div class='error_msg'>";
				if (isset($error_message)) {
				echo $error_message;
				}
				echo validation_errors();
				echo "</div>";
				?>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" placeholder="UserName">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

     
    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>html/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>html/admin/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>html/admin/dist/js/app.min.js"></script>

  </body>
</html>