<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DailySlip extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('DailySlip_Model', 'dailyslip_model');
		$this->load->model('Bus_Model', 'bus_model');
		$this->load->model('Employee_Model', 'emp_model');
	}
	
	public function index()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/login/index');
		}
		$data['result'] = $this->dailyslip_model->listDailySlip();
		$data['duty'] = array();
		$data['employees'] = array();
		foreach ($data['result']['result'] as $row){
			$routeRow= $this->bus_model->getBusDuty($row->conductor_daysSlip_DutyId);
			$empRow= $this->emp_model->getEmployee($row->conductor_daysSlip_ConductorEmpId);
			$data['duty'][$routeRow[0]['bus_duty_Id']] = $routeRow;
			$data['employees'][$empRow[0]['Employee_Id']] = $empRow;
			
		}
		$this->load->view('admin/dailySlip/index',$data);
	}
	
	public function getBusTimings(){
		$dutyId = $_GET['dutyId'];
		if(!empty($dutyId)){
			$busTimings = $this->bus_model->getBusTimingByDuty($dutyId);
			if(count($busTimings)>0)
			{
				$response= array();
				$response['status']= true;
				$response['data']= $busTimings;
				
			}else{
				$response= array();
				$response['status']= false;
				$response['errorMessage']= "No Values Found";
			}
		}else{
			$response= array();
			$response['status']= false;
			$response['errorMessage']= "No Parameters";
			
		}
		echo json_encode($response);
	}
	
	public function addDailySlip()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['employees'] = $this->emp_model->listEmployees();
		$data['duty'] = $this->bus_model->listBusDuty();
		$data['busList'] = $this->bus_model->listBus();
		
		$this->load->view('admin/dailySlip/addDailySlip',$data);
		
	}
	
	public function insertDailySlip()
	{
				$data = array();
				
				$data['header']= array(
					'conductor_daysSlip_ConductorEmpId' => $this->input->post('conductorEmpId'),
					'conductor_daysSlip_DutyId' => $this->input->post('routeId'),
					'conductor_daysSlip_BusNumber' => $this->input->post('busNumber'),
					'conductor_daysSlip_DriveEmpId' => $this->input->post('driverEmpId'),
					'conductor_daysslip_date' => $this->input->post('dailslipDate'),
					'conductor_daysSlip_AddedDateTime' => date('Y-m-d H:i:s'),
					'conductor_daysSlip_AddedBy' => $this->session->userdata['logged_in']['id']
					
				);
				
				$tempDetails = array(
				'conductor_daysslip_details_ActSourceTime' => $this->input->post('actSourceTime'),
				'conductor_daysslip_details_ActDestTime' => $this->input->post('actDestTime'),
				'conductor_daysslip_details_ActualKm' => $this->input->post('actKm'),
				'conductor_daysslip_details_cancel' => $this->input->post('busIsCancel'),
				'conductor_daysslip_details_comments' => $this->input->post('comments')
				);
				$data['details'] = array();
				$total_rows = count($tempDetails['conductor_daysslip_details_ActSourceTime']);
				 if ($total_rows > 0)
					{
						for ($i=0; $i<$total_rows; $i++)
						{
							$temp=array();
							$temp['conductor_daysslip_details_ActSourceTime'] = $tempDetails['conductor_daysslip_details_ActSourceTime'][$i];
							$temp['conductor_daysslip_details_ActDestTime'] = $tempDetails['conductor_daysslip_details_ActDestTime'][$i];
							$temp['conductor_daysslip_details_ActualKm'] = $tempDetails['conductor_daysslip_details_ActualKm'][$i];
							$temp['conductor_daysslip_details_cancel'] = $tempDetails['conductor_daysslip_details_cancel'][$i];
							$temp['conductor_daysslip_details_comments'] = $tempDetails['conductor_daysslip_details_comments'][$i];
							array_push($data['details'],$temp);
						}
					}
				//print_r($tempDetails);die;
				$result = $this->dailyslip_model->addDailySlip($data);
				if ($result == TRUE) {
					redirect('admin/dailySlip/dailySlip');
				}
				 else {
					$data = array(
						'error_message' => 'Error in inserting dailySlip'
					);
					$this->load->view('admin/dailySlip/editDailySlip', $data);
				}
		
	}
	
	public function editDailySlip($id)
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['result'] = $this->dailyslip_model->getDailySlip($id);
		$data['details'] = $this->dailyslip_model->getDailySlipDetails($id);
		$data['actdetails'] = $this->bus_model->getBusTimingByDuty($data['result'][0]['conductor_daysSlip_DutyId']);
		$data['employees'] = $this->emp_model->listEmployees();
		$data['duty'] = $this->bus_model->listBusDuty();
		$data['busList'] = $this->bus_model->listBus();
		
		$this->load->view('admin/dailySlip/editDailySlip',$data);
		
	}
	
	public function updateDailySlip()
	{
				$data = array();
				
				$data['header']= array(
					'conductor_daysSlip_Id' => $this->input->post('slipId'),
					'conductor_daysSlip_ConductorEmpId' => $this->input->post('conductorEmpId'),
					'conductor_daysSlip_DutyId' => $this->input->post('routeId'),
					'conductor_daysSlip_BusNumber' => $this->input->post('busNumber'),
					'conductor_daysSlip_DriveEmpId' => $this->input->post('driverEmpId'),
					'conductor_daysslip_date' => $this->input->post('dailslipDate'),
					'conductor_daysSlip_AddedDateTime' => date('Y-m-d H:i:s'),
					'conductor_daysSlip_AddedBy' => $this->session->userdata['logged_in']['id']
					
				);
				
				$tempDetails = array(
				'conductor_daysslip_details_Id' => $this->input->post('slipDetailsId'),
				'conductor_daysslip_details_SlipId' => $this->input->post('slipId'),
				'conductor_daysslip_details_ActSourceTime' => $this->input->post('actSourceTime'),
				'conductor_daysslip_details_ActDestTime' => $this->input->post('actDestTime'),
				'conductor_daysslip_details_ActualKm' => $this->input->post('actKm'),
				'conductor_daysslip_details_cancel' => $this->input->post('busIsCancel'),
				'conductor_daysslip_details_comments' => $this->input->post('comments')
				);
				$data['details'] = array();
				$total_rows = count($tempDetails['conductor_daysslip_details_Id']);
				 if ($total_rows > 0)
					{
						for ($i=0; $i<$total_rows; $i++)
						{
							$temp=array();
							$temp['conductor_daysslip_details_Id'] = $tempDetails['conductor_daysslip_details_Id'][$i];
							$temp['conductor_daysslip_details_SlipId'] = $data['header']['conductor_daysSlip_Id'];
							$temp['conductor_daysslip_details_ActSourceTime'] = $tempDetails['conductor_daysslip_details_ActSourceTime'][$i];
							$temp['conductor_daysslip_details_ActDestTime'] = $tempDetails['conductor_daysslip_details_ActDestTime'][$i];
							$temp['conductor_daysslip_details_ActualKm'] = $tempDetails['conductor_daysslip_details_ActualKm'][$i];
							$temp['conductor_daysslip_details_cancel'] = $tempDetails['conductor_daysslip_details_cancel'][$i];
							$temp['conductor_daysslip_details_comments'] = $tempDetails['conductor_daysslip_details_comments'][$i];
							array_push($data['details'],$temp);
						}
					}
				 
				
				$result = $this->dailyslip_model->updateDailySlip($data);
				
					redirect('admin/dailySlip/dailySlip');
				/* }
				 else {
					$data = array(
						'error_message' => 'Error in updating dailySlip'
					);
					$this->load->view('admin/dailySlip/editDailySlip', $data);
				} */
		
	}
	
	public function deleteDailySlip() {
				$id =$this->input->post('dailyslipId');
				$result = $this->dailyslip_model->deleteDailySlip($id);
				if ($result == TRUE) {
					redirect('admin/dailySlip/dailySlip');
				}
				 else {
					$data = array(
						'error_message' => 'Error in deleting dailySlip'
					);
					$this->load->view('admin/dailySlip/index', $data);
				}
		
	}
	
	public function viewDailySlip($id)
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['result'] = $this->dailyslip_model->getDailySlip($id);
		$data['details'] = $this->dailyslip_model->getDailySlipDetails($id);
		$data['actdetails'] = $this->bus_model->getBusTimingByDuty($data['result'][0]['conductor_daysSlip_DutyId']);
		$data['employees'] = $this->emp_model->listEmployees();
		$data['duty'] = $this->bus_model->listBusDuty();
		$data['busList'] = $this->bus_model->listBus();
		
		$this->load->view('admin/dailySlip/viewDailySlip',$data);
		
	}
	
	public function downloadDutySlip($id){
			
		//load mPDF library
		$this->load->library('m_pdf');
		//now pass the data//
		$this->data['title']="DutySlip";
		$this->data['description']="Contains DutySlips";
		//now pass the data //
		$this->data['result'] = $this->dailyslip_model->getDailySlip($id);
		$this->data['details'] = $this->dailyslip_model->getDailySlipDetails($id);
		$this->data['actdetails'] = $this->bus_model->getBusTimingByDuty($this->data['result'][0]['conductor_daysSlip_DutyId']);
		$this->data['employees'] = $this->emp_model->listEmployees();
		$this->data['duty'] = $this->bus_model->listBusDuty();
		$this->data['busList'] = $this->bus_model->listBus();
		
		$html=$this->load->view('admin/dailySlip/pdfSingleDutySlip',$this->data, true);
		
		
		//this the the PDF filename that user will get to download
		$pdfFilePath ="dutySlip-".time()."-download.pdf";
		 
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
	
	public function reports(){
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/login/index');
		}
		$data['employees']=$this->emp_model->listEmployees();
		$data['busList'] = $this->bus_model->listBus();
		$data['duty'] = $this->bus_model->listBusDuty();
			
		$this->load->view('admin/dailySlip/customReports',$data);
	}
	
}
