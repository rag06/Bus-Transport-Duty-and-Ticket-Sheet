<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus_Duty extends CI_Controller {

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
		$data['result'] = $this->bus_model->listBusDuty();
		$this->load->view('admin/bus/busDuty',$data);
	}
	
	public function addBusDuty()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['busRoutes'] = $this->bus_model->listBusRoutes();
		$this->load->view('admin/bus/addBusDuty',$data);
		
	}
	
	public function insertBusDuty()
	{
				$data = array(
				'bus_duty_RouteId' => $this->input->post('busRouteId'),
				'bus_duty_Number' => $this->input->post('busDutyNumber'),
				'bus_duty_CreatedOn' => date('Y-m-d H:i:s'),
				'bus_duty_AddedBy' => $this->session->userdata['logged_in']['id']
				);
				
				$result = $this->bus_model->addBusDuty($data);
				if ($result == TRUE) {
					redirect('admin/bus/Bus_Duty');
				}
				 else {
					$data = array(
						'error_message' => 'Error in inserting Bus Duty'
					);
					$data['busRoutes'] = $this->bus_model->listBusRoutes();
					$this->load->view('admin/bus/editBusDuty', $data);
				}
		
	}
	
	public function editBusDuty($id)
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['result'] = $this->bus_model->getBusDuty($id);
		$data['busRoutes'] = $this->bus_model->listBusDuty();
		$this->load->view('admin/bus/editBusDuty',$data);
		
	}
	
	public function updateBusDuty()
	{
				$data = array(
				'bus_duty_Id' => $this->input->post('busDutyId'),
				'bus_duty_RouteId' => $this->input->post('busRouteId'),
				'bus_duty_Number' => $this->input->post('busDutyNumber'),
				);
				
				$result = $this->bus_model->updateBusDuty($data);
				if ($result == TRUE) {
					redirect('admin/bus/Bus_Duty');
				}
				 else {
					$data = array(
						'error_message' => 'Error in updating Bus Duty'
					);
					$data['result'] = $this->bus_model->getBusDuty($id);
					$data['busRoutes'] = $this->bus_model->listBusRoutes();
					$this->load->view('admin/bus/editBusDuty', $data);
				}
		
	}
	
	public function deleteBusDuty() {
				$id =$this->input->post('busDutyId');
				$result = $this->bus_model->deleteBusDuty($id);
				if ($result == TRUE) {
					redirect('admin/bus/Bus_Duty');
				}
				 else {
					$data = array(
						'error_message' => 'Error in deleting Bus Duty'
					);
					$this->load->view('admin/bus/busDuty', $data);
				}
		
	}
	
	public function downloadBusDutyList(){
		//load mPDF library
		$this->load->library('m_pdf');
		//now pass the data//
		$this->data['title']="Bus Duty List";
		$this->data['description']="Contains all the list of bus duty List";
		//now pass the data //
		
		
		$this->data['result'] = $this->bus_model->listBusDuty();
		 
		$html=$this->load->view('admin/bus/pdf_output_busDuty',$this->data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
		//this the the PDF filename that user will get to download
		$pdfFilePath ="busDutyList-".time()."-download.pdf";
		 
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
