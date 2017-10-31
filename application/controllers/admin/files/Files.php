<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load session library
		$this->load->library('session');
		}
	public function index()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
			$this->load->view('admin/files/index');
		
	}

}
?>