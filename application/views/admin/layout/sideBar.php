<aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">


        

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">Navigation</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="<?php echo base_url() ;?>admin/dashboard/dashboard"><i class="fa fa-link"></i> <span>Dashbaord</span></a></li>
			
			<?php if($this->session->userdata['logged_in']['role']==1) {
				echo' <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Admin User Management</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="'.base_url() .'admin/admin/users/addUser">Create Admin</a></li>
                <li><a href="'.base_url().'admin/admin/users">Manage Admin</a></li>
              </ul>
            </li>';
				
				
			}?>
           
            <li><a href="<?php echo base_url() ;?>admin/files/files"><i class="fa fa-link"></i> <span>Files Explorer</span></a></li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
