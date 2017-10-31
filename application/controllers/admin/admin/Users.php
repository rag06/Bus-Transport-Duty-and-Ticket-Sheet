<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('userModel');
		}
	public function index()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		if($this->session->userdata['logged_in']['role']==0){
			$error['heading']="Not Authorized";
			$error['message']="You are not Authorized to view";
			redirect('errors/html/error_general',$error);
		}
		$data['result'] = $this->userModel->listAdminUsers();
			$this->load->view('admin/admin/index',$data);
		
	}
	public function addUser()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		if($this->session->userdata['logged_in']['role']==0){
			$error['heading']="Not Authorized";
			$error['message']="You are not Authorized to view";
			redirect('errors/html/error_general',$error);
		}
			$this->load->view('admin/admin/addUsers');
		
	}
	public function insertUser()
	{
				$data = array(
				'Admin_Name' => $this->input->post('name'),
				'Admin_Email' => $this->input->post('email'),
				'Admin_CreatedOn' => date('Y-m-d H:i:s'),
				'Admin_CreatedBy' => $this->session->userdata['logged_in']['id'],
				'Admin_Status' => $this->input->post('status'),
				'Admin_Uname' => $this->input->post('username'),
				'Admin_Pass' => $this->input->post('password'),
				'Admin_Role' => $this->input->post('role')
				);
				
				$result = $this->userModel->registration_insert($data);
				if ($result == TRUE) {
					redirect('admin/admin/users');
				}
				 else {
					$data = array(
						'error_message' => 'Error in updating category'
					);
					$this->load->view('admin/admin/editUsers', $data);
				}
		
	}
	public function editAdminUser($id)
	{
		if($this->session->userdata['logged_in']['role']==0){
			$error['heading']="Not Authorized";
			$error['message']="You are not Authorized to view";
			redirect('errors/html/error_general',$error);
		}
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['result'] = $this->userModel->getAdminUser($id);
		$this->load->view('admin/admin/editUsers',$data);
		
	}
	public function deleteUser() {
				$id =$this->input->post('adminId');
				$result = $this->userModel->deleteUser($id);
				if ($result == TRUE) {
					redirect('admin/admin/users');
				}
				 else {
					$data = array(
						'error_message' => 'Error in deleting users'
					);
					$this->load->view('admin/admin/index', $data);
				}
		
	}
	
	public function updateUsers()
	{
				$data = array(
				'Admin_Id' => $this->input->post('adminid'),
				'Admin_Name' => $this->input->post('name'),
				'Admin_Email' => $this->input->post('email'),
				'Admin_CreatedOn' => date('Y-m-d H:i:s'),
				'Admin_CreatedBy' => $this->session->userdata['logged_in']['id'],
				'Admin_Status' => $this->input->post('status'),
				'Admin_Uname' => $this->input->post('username'),
				'Admin_Pass' => $this->input->post('password'),
				'Admin_Role' => $this->input->post('role')
				);
				
				$result = $this->userModel->updateUsers($data);
				if ($result == TRUE) {
					redirect('admin/admin/users');
				}
				 else {
					$data = array(
						'error_message' => 'Error in updating category'
					);
					$this->load->view('admin/admin/editUsers', $data);
				}
		
	}
	
	

}
?>