<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus_Timing extends CI_Controller {

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
		$data['result'] = $this->bus_model->listBusTiming();
		$this->load->view('admin/bus/busTimings',$data);
	}
	
	public function addBusTiming()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['busRoutes'] = $this->bus_model->listBusRoutes();
		$this->load->view('admin/bus/addBusTiming',$data);
		
	}
	
	public function insertBusTiming()
	{
				$data = array(
				'bus_timing_routeId' => $this->input->post('busRouteId'),
				'bus_timing_StartTime' => $this->input->post('busStartTime'),
				'bus_timing_DestinationTime' => $this->input->post('busDestTime'),
				'bus_timing_CreatedOn' => date('Y-m-d H:i:s'),
				'bus_timing_AddedBy' => $this->session->userdata['logged_in']['id'],
				'bus_timing_Status' => $this->input->post('busTimingStatus')
				);
				
				$result = $this->bus_model->addBusTiming($data);
				if ($result == TRUE) {
					redirect('admin/bus/Bus_Timing');
				}
				 else {
					$data = array(
						'error_message' => 'Error in inserting Bus Timing'
					);
					$data['busRoutes'] = $this->bus_model->listBusRoutes();
					$this->load->view('admin/bus/editBusTiming', $data);
				}
		
	}
	
	public function editBusTiming($id)
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['result'] = $this->bus_model->getBusTiming($id);
		$data['busRoutes'] = $this->bus_model->listBusRoutes();
		$this->load->view('admin/bus/editBusTiming',$data);
		
	}
	
	public function updateBusTiming()
	{
				$data = array(
				'bus_timing_Id' => $this->input->post('busTimingId'),
				'bus_timing_routeId' => $this->input->post('busRouteId'),
				'bus_timing_StartTime' => $this->input->post('busStartTime'),
				'bus_timing_DestinationTime' => $this->input->post('busDestTime'),
				'bus_timing_Status' => $this->input->post('busTimingStatus')
				);
				
				$result = $this->bus_model->updateBusTiming($data);
				if ($result == TRUE) {
					redirect('admin/bus/Bus_Timing');
				}
				 else {
					$data = array(
						'error_message' => 'Error in updating Bus Timing'
					);
					$data['result'] = $this->bus_model->getBusTiming($id);
					$data['busRoutes'] = $this->bus_model->listBusRoutes();
					$this->load->view('admin/ticket/editBusTiming', $data);
				}
		
	}
	
	public function deleteBusTiming() {
				$id =$this->input->post('busTimingId');
				$result = $this->bus_model->deleteBusTiming($id);
				if ($result == TRUE) {
					redirect('admin/bus/Bus_Timing');
				}
				 else {
					$data = array(
						'error_message' => 'Error in deleting Bus Timing'
					);
					$this->load->view('admin/bus/busTimings', $data);
				}
		
	}
}
