<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_Tickets extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('Employee_Model', 'emp_model');
	}
	
	public function index()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/login/index');
		}
		$data['result'] = $this->emp_model->listTicketEmployee();
		$this->load->view('admin/employee/employeeTickets',$data);
	}
	
	public function addTicketEmployee()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$this->load->view('admin/employee/addTicketEmployee');
		
	}
	
	public function insertTicketEmployee()
	{
				$data = array(
				'tickets_employee_ticketId' => $this->input->post('ticketId'),
				'tickets_employee_empId' => $this->input->post('empId'),
				'tickets_employee_Series' => $this->input->post('series'),
				'tickets_employee_StartSerial' => $this->input->post('startSerial'),
				'tickets_employee_EndSerial' => $this->input->post('endSerial'),
				'tickets_employee_CreatedOn' => date('Y-m-d H:i:s'),
				'tickets_employee_Addedby' => $this->session->userdata['logged_in']['id']
				);
				
				$result = $this->emp_model->addTicketEmployee($data);
				if ($result == TRUE) {
					redirect('admin/employees/Employee_Tickets');
				}
				 else {
					$data = array(
						'error_message' => 'Error in inserting Ticket Employee'
					);
					$this->load->view('admin/employee/editTicketEmployee', $data);
				}
		
	}
	
	public function editTicketEmployee($id)
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['result'] = $this->emp_model->getTicketEmployee($id);
		$this->load->view('admin/employee/editTicketEmployee',$data);
		
	}
	
	public function updateTicketEmployee()
	{
				$data = array(
				'tickets_employee_Id' => $this->input->post('ticketEmployeeId'),
				'tickets_employee_ticketId' => $this->input->post('ticketId'),
				'tickets_employee_empId' => $this->input->post('empId'),
				'tickets_employee_Series' => $this->input->post('series'),
				'tickets_employee_StartSerial' => $this->input->post('startSerial'),
				'tickets_employee_EndSerial' => $this->input->post('endSerial')
				);
				
				$result = $this->emp_model->updateTicketEmployee($data);
				if ($result == TRUE) {
					redirect('admin/employees/Employee_Tickets');
				}
				 else {
					$data = array(
						'error_message' => 'Error in updating Employee Tickets'
					);
					$this->load->view('admin/employee/editTicketEmployee', $data);
				}
		
	}
	
	public function deleteTicketEmployee() {
				$id =$this->input->post('ticketEmployeeId');
				$result = $this->emp_model->deleteTicketEmployee($id);
				if ($result == TRUE) {
					redirect('admin/employees/Employee_Tickets');
				}
				 else {
					$data = array(
						'error_message' => 'Error in deleting Employee Tickets'
					);
					$this->load->view('admin/employee/employeeTickets', $data);
				}
		
	}
}
