<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">Navigation</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="<?php echo base_url() ;?>admin/dashboard/dashboard"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
			<li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Waybill Slip </span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url()?>admin/cashDepositSlip/cashDepositSlip/addCashDepositSlip">Create a Waybill Slip</a></li>
                <li><a href="<?php echo base_url()?>admin/cashDepositSlip/cashDepositSlip/index">Manage Waybill Slip</a></li>
                <li><a href="<?php echo base_url()?>admin/cashDepositSlip/cashDepositSlip/reports">Reports Waybill Slip</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Duty Slip Management</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url()?>admin/dailySlip/dailySlip/addDailySlip">Create a Duty  Slip</a></li>
                <li><a href="<?php echo base_url()?>admin/dailySlip/dailySlip/index">Manage Duty  Slip</a></li>
              </ul>
            </li>
			<?php if($this->session->userdata['logged_in']['role']==1) {?>
			<li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Traffic Management</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url()?>admin/bus/bus/addBusRoute">Add Bus Route</a></li>
                <li><a href="<?php echo base_url()?>admin/bus/bus">Manage Bus Route</a></li>
                <li><a href="<?php echo base_url()?>admin/bus/Bus_Duty/addBusDuty">Add Bus Duty</a></li>
                <li><a href="<?php echo base_url()?>admin/bus/Bus_Duty/index">Manage Bus Duty</a></li>
                <li><a href="<?php echo base_url()?>admin/bus/Bus_Timing/addBusTiming">Add Bus Timing</a></li>
                <li><a href="<?php echo base_url()?>admin/bus/Bus_Timing">Manage Bus Timing</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Tickets Management</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url()?>admin/tickets/tickets/addTicket">Create Tickets</a></li>
                <li><a href="<?php echo base_url()?>admin/tickets/tickets">Manage Tickets</a></li>
                <!--li><a href="<?php echo base_url()?>admin/tickets/Ticket_Register/addTicketRegister">Add Entry in Ticket Register</a></li>
                <li><a href="<?php echo base_url()?>admin/tickets/Ticket_Register">Manage Ticket Register</a></li-->
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
			<li class="treeview">
			  <a href="#"><i class="fa fa-link"></i> <span>Admin User Management</span> <i class="fa fa-angle-left pull-right"></i></a>
			  <ul class="treeview-menu">
				<li><a href="<?php echo base_url()?>admin/admin/users/addUser">Create Admin</a></li>
				<li><a href="<?php echo base_url()?>admin/admin/users">Manage Admin</a></li>
			  </ul>
			</li>
					
					
			<?php }?>
           
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
