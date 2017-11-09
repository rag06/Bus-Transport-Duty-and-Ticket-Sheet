<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('Dashboard_Model', 'dashboard_model');
		$this->load->model('Tickets_Model', 'tickets_model');
		$this->load->model('Bus_Model', 'bus_model');
	}
	
	public function index()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/login/index');
		}
		$data['sales'] = $this->dashboard_model->getSalesPerYearPerMonth();
		$data['currentDay'] = $this->dashboard_model->getSalesCurrentDay();
		$data['routes'] = $this->dashboard_model->getSalesPerRoutePerYearPerMonth();
		$data['tickets'] = $this->dashboard_model->getSalesPerTicketPerYearPerMonth();
		$data['employees'] = $this->dashboard_model->getCountOfEmployeesPerType();
		$data['adminusers'] = $this->dashboard_model->getCountOfAdminUsers();
		$data['routecount'] = $this->dashboard_model->getCountOfBusRoutes();
		$data['noOfBusPerRoute'] = $this->dashboard_model->getCountOfNoOfBusPerBusRoutes();
		
		$tempTickets=$this->tickets_model->listTickets();
		$tempRoutes=$this->bus_model->listBusRoutes();
		$tempArray=array();
		foreach($tempTickets['result'] as $tickets){
			$tempArray[$tickets->tickets_Id] = $tickets;
		}
		
		$data['ticketsData'] = $tempArray;
		$tempArray=array();
		foreach($tempRoutes['result'] as $routes){
			$tempArray[$routes->Bus_Routes_Id] = $routes;
		}
		$data['routesData'] = $tempArray;
		$this->load->view('admin/dashboard/dashboard',$data);
	}
}
