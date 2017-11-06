<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('Bus_Model', 'bus_model');
	}
	
	public function index()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/login/index');
		}
		$data['result'] = $this->bus_model->listBusRoutes();
		$this->load->view('admin/bus/index',$data);
	}
	
	public function addBusRoute()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$this->load->view('admin/bus/addBusRoute');
		
	}
	
	public function insertBusRoute()
	{
				$data = array(
				'Bus_Routes_Number' => $this->input->post('busRouteNo'),
				'Bus_Routes_Source' => $this->input->post('busRouteSource'),
				'Bus_Routes_Destination' => $this->input->post('busRouteDest'),
				'Bus_Routes_Kilometers' => $this->input->post('busRouteKM'),
				'Bus_Routes_AddedDateandTime' => date('Y-m-d H:i:s'),
				'Bus_Routes_CreatedBy' => $this->session->userdata['logged_in']['id'],
				'Bus_Routes_Status' => $this->input->post('busRouteStatus'),
				);
				
				$result = $this->bus_model->addBusRoute($data);
				if ($result == TRUE) {
					redirect('admin/bus/bus');
				}
				 else {
					$data = array(
						'error_message' => 'Error in inserting busRoute'
					);
					$this->load->view('admin/bus/editBusRoute', $data);
				}
		
	}
	
	public function editBusRoute($id)
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['result'] = $this->bus_model->getBusRoute($id);
		$this->load->view('admin/bus/editBusRoute',$data);
		
	}
	
	public function updateBusRoute()
	{
				$data = array(
				'Bus_Routes_Id' => $this->input->post('busRouteId'),
				'Bus_Routes_Number' => $this->input->post('busRouteNo'),
				'Bus_Routes_Source' => $this->input->post('busRouteSource'),
				'Bus_Routes_Destination' => $this->input->post('busRouteDest'),
				'Bus_Routes_Kilometers' => $this->input->post('busRouteKM'),
				'Bus_Routes_AddedDateandTime' => date('Y-m-d H:i:s'),
				'Bus_Routes_CreatedBy' => $this->session->userdata['logged_in']['id'],
				'Bus_Routes_Status' => $this->input->post('busRouteStatus')
				);
				
				$result = $this->bus_model->updateBusRoute($data);
				if ($result == TRUE) {
					redirect('admin/bus/bus');
				}
				 else {
					$data = array(
						'error_message' => 'Error in updating busRoute'
					);
					$this->load->view('admin/bus/editBusRoute', $data);
				}
		
	}
	
	public function deleteBusRoute() {
				$id =$this->input->post('busRouteId');
				$result = $this->bus_model->deleteBusRoute($id);
				if ($result == TRUE) {
					redirect('admin/bus/bus');
				}
				 else {
					$data = array(
						'error_message' => 'Error in deleting busRoute'
					);
					$this->load->view('admin/bus/index', $data);
				}
		
	}
}
