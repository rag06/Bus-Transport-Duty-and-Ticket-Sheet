<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('Dashboard_Model', 'dashboard_model');
	}
	
	public function index()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/login/index');
		}
		$data['sales'] = $this->dashboard_model->getSalesPerYearPerMonth();
		$data['routes'] = $this->dashboard_model->getSalesPerRoutePerYearPerMonth();
		$data['tickets'] = $this->dashboard_model->getSalesPerTicketPerYearPerMonth();
		$data['employees'] = $this->dashboard_model->getCountOfEmployeesPerType();
		$this->load->view('admin/dashboard/dashboard',$data);
	}
}
