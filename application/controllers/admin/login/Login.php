<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('UserModel');
		}
	public function index()
	{
		if(isset($this->session->userdata['logged_in'])){
			redirect('admin/dashboard/dashboard');
		}else{
			$this->load->view('admin/login/index');
		}
		
	}
		// Check for user login process
	public function user_login_process() {
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
		if(isset($this->session->userdata['logged_in'])){
			redirect('admin/dashboard/dashboard');
		}else{
			redirect('admin/login/login');
		}
		} else {
		$data = array(
		'username' => $this->input->post('username'),
		'password' => $this->input->post('password')
		);
		$result = $this->UserModel->login($data);
		if ($result == TRUE) {

		$username = $this->input->post('username');
		$result = $this->UserModel->read_user_information($username);
		if ($result != false) {
		$session_data = array(
		'username' => $result[0]->Admin_Uname,
		'email' => $result[0]->Admin_Email,
		'id' => $result[0]->Admin_Id,
		'name' => $result[0]->Admin_Name,
		'role'=>$result[0]->Admin_Role,
		);
		// Add user data in session
		$this->session->set_userdata('logged_in', $session_data);
			redirect('admin/dashboard/dashboard');
		}
		} else {
		$data = array(
		'error_message' => 'Invalid Username or Password'
		);
		$this->load->view('admin/login/index', $data);
		}
		}
	}

	// Logout from admin page
	public function logout() {

	// Removing session data
	$sess_array = array(
	'username' => '',
	'email' =>'',
	'id' => '',
	'name' => '',
	);
	$this->session->unset_userdata('logged_in', $sess_array);
	$data['message_display'] = 'Successfully Logout';
	$this->load->view('admin/login/index', $data);
	}

}
