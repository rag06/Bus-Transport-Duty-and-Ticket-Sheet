<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

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
		$data['result'] = $this->emp_model->listEmployees();
		$this->load->view('admin/employee/index',$data);
	}
	
	public function addEmployee()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$this->load->view('admin/employee/addEmployee');
		
	}
	
	public function insertEmployee()
	{
				$data = array(
				'Employee_Number' => $this->input->post('empNo'),
				'Employee_Type' => $this->input->post('empType'),
				'Employee_Name' => $this->input->post('empName'),
				'Employee_AddedDate' => date('Y-m-d H:i:s'),
				'Employee_Status' => $this->input->post('empStatus')
				);
				
				$result = $this->emp_model->addEmployee($data);
				if ($result == TRUE) {
					redirect('admin/employees/employees');
				}
				 else {
					$data = array(
						'error_message' => 'Error in inserting Employee'
					);
					$this->load->view('admin/employee/editEmployee', $data);
				}
		
	}
	
	public function editEmployee($id)
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['result'] = $this->emp_model->getEmployee($id);
		$this->load->view('admin/employee/editEmployee',$data);
		
	}
	
	public function updateEmployee()
	{
				$data = array(
				'Employee_Id' => $this->input->post('empId'),
				'Employee_Number' => $this->input->post('empNo'),
				'Employee_Type' => $this->input->post('empType'),
				'Employee_Name' => $this->input->post('empName'),
				'Employee_Status' => $this->input->post('empStatus')
				);
				
				$result = $this->emp_model->updateEmployee($data);
				if ($result == TRUE) {
					redirect('admin/employees/employees');
				}
				 else {
					$data = array(
						'error_message' => 'Error in updating employee'
					);
					$this->load->view('admin/employee/editEmployee', $data);
				}
		
	}
	
	public function deleteEmployee() {
				$id =$this->input->post('empId');
				$result = $this->emp_model->deleteEmployee($id);
				if ($result == TRUE) {
					redirect('admin/employees/employees');
				}
				 else {
					$data = array(
						'error_message' => 'Error in deleting employee'
					);
					$this->load->view('admin/employee/index', $data);
				}
		
	}
}
