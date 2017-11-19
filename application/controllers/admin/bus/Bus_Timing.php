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
		$tempRoutes=$this->bus_model->listBusRoutes();
		$tempArray=array();
		foreach($tempRoutes['result'] as $routes){
			$tempArray[$routes->Bus_Routes_Id] = $routes;
		}
		$data['routesData'] = $tempArray;
		$this->load->view('admin/bus/busTimings',$data);
	}
	
	public function addBusTiming()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['busDuty'] = $this->bus_model->listBusDuty();
		$this->load->view('admin/bus/addBusTiming',$data);
		
	}
	
	public function insertBusTiming()
	{
				$busDutyId = $this->input->post('busDutyId');
				$dutybusroute = explode(',',$busDutyId);
				$data = array(
				'bus_timing_DutyId' => $dutybusroute[0],
				'bus_timing_RouteId' => $dutybusroute[1],
				'bus_timing_Source' => $this->input->post('busSource'),
				'bus_timing_Destination' => $this->input->post('busDest'),
				'bus_timing_Kilometers' => $this->input->post('busKilo'),
				'bus_timing_StartTime' => $this->input->post('busStartTime'),
				'bus_timing_DestinationTime' => $this->input->post('busDestTime'),
				'bus_timing_CreatedOn' => date('Y-m-d H:i:s'),
				'bus_timing_AddedBy' => $this->session->userdata['logged_in']['id']
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
		$data['busDuty'] = $this->bus_model->listBusDuty();
		$this->load->view('admin/bus/editBusTiming',$data);
		
	}
	
	public function updateBusTiming()
	{			
				$busDutyId = $this->input->post('busDutyId');
				$dutybusroute = explode(',',$busDutyId);
				$data = array(
				'bus_timing_Id' => $this->input->post('busTimingId'),
				'bus_timing_DutyId' => $dutybusroute[0],
				'bus_timing_RouteId' => $dutybusroute[1],
				'bus_timing_Source' => $this->input->post('busSource'),
				'bus_timing_Destination' => $this->input->post('busDest'),
				'bus_timing_Kilometers' => $this->input->post('busKilo'),
				'bus_timing_StartTime' => $this->input->post('busStartTime'),
				'bus_timing_DestinationTime' => $this->input->post('busDestTime')
				);
				
				$result = $this->bus_model->updateBusTiming($data);
				if ($result == TRUE) {
					redirect('admin/bus/Bus_Timing');
				}
				 else {
					 redirect('admin/bus/Bus_Timing');
					$data = array(
						'error_message' => 'Error in updating Bus Timing'
					);
					$data['result'] = $this->bus_model->getBusTiming($this->input->post('busTimingId'));
					$data['busRoutes'] = $this->bus_model->listBusRoutes();
					$this->load->view('admin/bus/editBusTiming', $data);
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
	public function downloadBusTimingList(){
		//load mPDF library
		$this->load->library('m_pdf');
		//now pass the data//
		$this->data['title']="Bus Timing List";
		$this->data['description']="Contains all the list of bus duty Timing";
		//now pass the data //
		
		
		$this->data['result'] = $this->bus_model->listBusTiming();
		$this->data['routesData'] = $this->bus_model->listBusDuty();
		 
		$html=$this->load->view('admin/bus/pdf_output_busTiming',$this->data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
		//this the the PDF filename that user will get to download
		$pdfFilePath ="busTimingList-".time()."-download.pdf";
		 
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
		//generate the PDF!
		$pdf->WriteHTML($html,2);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		$pdf->Output($pdfFilePath, "D");
			
	}
}
