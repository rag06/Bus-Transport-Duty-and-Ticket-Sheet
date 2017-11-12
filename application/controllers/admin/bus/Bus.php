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
				'Bus_Routes_Name' => $this->input->post('busRouteName'),
				'Bus_Routes_AddedDateandTime' => date('Y-m-d H:i:s'),
				'Bus_Routes_CreatedBy' => $this->session->userdata['logged_in']['id'],
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
				'Bus_Routes_Name' => $this->input->post('busRouteName'),
				'Bus_Routes_AddedDateandTime' => date('Y-m-d H:i:s'),
				'Bus_Routes_CreatedBy' => $this->session->userdata['logged_in']['id']
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
	
	public function downloadBusRouteList(){
		
		
		//load mPDF library
		$this->load->library('m_pdf');
		//now pass the data//
		$this->data['title']="Bus Route List";
		$this->data['description']="Contains all the list of bus route";
		//now pass the data //
		
		
		$this->data['result'] = $this->bus_model->listBusRoutes();
		 
		$html=$this->load->view('admin/bus/pdf_output_busRoute',$this->data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
		//this the the PDF filename that user will get to download
		$pdfFilePath ="busRouteList-".time()."-download.pdf";
		 
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
		// Define the Header/Footer before writing anything so they appear on the first page
		$pdf->SetHTMLHeader('
		<div style=" font-weight: bold;height:50px;">
			 <h1>KDMT Transport</h1>
		</div>');
		$pdf->SetHTMLFooter('
		<table width="100%">
			<tr>
				<td width="33%">Generated On : {DATE j-m-Y}</td>
				<td width="33%" align="center">{PAGENO}/{nbpg}</td>
				<td width="33%" style="text-align: right;">KDMT document</td>
			</tr>
		</table>');
		
		//generate the PDF!
		$pdf->WriteHTML($html,2);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		$pdf->Output($pdfFilePath, "D");
			
	}
}
