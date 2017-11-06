<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">Navigation</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="<?php echo base_url() ;?>admin/dashboard/dashboard"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
			<li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Cash Deposit Slip </span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url()?>admin/">Create a Cash Deposit Slip</a></li>
                <li><a href="<?php echo base_url()?>admin/">Manage Cash Deposit Slip</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Daily Slip Management</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url()?>admin/">Create a Daily Slip</a></li>
                <li><a href="<?php echo base_url()?>admin/">Manage Daily Slip</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Tickets Management</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url()?>admin/tickets/tickets/addTicket">Create Tickets</a></li>
                <li><a href="<?php echo base_url()?>admin/tickets/tickets">Manage Tickets</a></li>
                <li><a href="<?php echo base_url()?>admin/tickets/Ticket_Register/addTicketRegister">Add Entry in Ticket Register</a></li>
                <li><a href="<?php echo base_url()?>admin/tickets/Ticket_Register">Manage Ticket Register</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Bus Management</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url()?>admin/bus/bus/addBusRoute">Add Bus Route</a></li>
                <li><a href="<?php echo base_url()?>admin/bus/bus">Manage Bus Route</a></li>
                <li><a href="<?php echo base_url()?>admin/bus/Bus_Timing/addBusTiming">Add Bus Timing</a></li>
                <li><a href="<?php echo base_url()?>admin/bus/Bus_Timing">Manage Bus Timing</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Employees Management</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url()?>admin/employees/employees/addEmployee">Add Employee</a></li>
                <li><a href="<?php echo base_url()?>admin/employees/employees">Manage Employee</a></li>
                <!--li><a href="<?php echo base_url()?>admin/employees/Employee_Tickets/addTicketEmployee">Assign Tickets </a></li-->
              </ul>
            </li>
			
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
