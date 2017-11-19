<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CashDepositSlip extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('CashDepositSlip_Model', 'cashdepositslip_model');
		$this->load->model('Bus_Model', 'bus_model');
		$this->load->model('Tickets_Model', 'tickets_model');
		$this->load->model('Employee_Model', 'emp_model');
	}
	
	public function index()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/login/index');
		}
		$data['result'] = $this->cashdepositslip_model->listCashDepositSlip();
		$data['duty'] = array();
		$data['employees'] = array();
		foreach ($data['result']['result'] as $row){
			$routeRow= $this->bus_model->getBusDuty($row->cashDeposit_slip_DutyId);
			$empRow= $this->emp_model->getEmployee($row->cashDeposit_slip_ConductorEmpId);
			$data['duty'][$routeRow[0]['bus_duty_Id']] = $routeRow;
			$data['employees'][$empRow[0]['Employee_Id']] = $empRow;
			
		}
		$this->load->view('admin/cashDepositSlip/index',$data);
	}
	
	
	public function addCashDepositSlip()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['employees'] = $this->emp_model->listEmployees();
		$data['duty'] = $this->bus_model->listBusDuty();
		$data['busList'] = $this->bus_model->listBus();
		$data['tickets'] = $this->tickets_model->listTickets();
		$data['waybillno'] = $this->cashdepositslip_model->getCashDepositSlipNextNumber();
		
		$this->load->view('admin/cashDepositSlip/addCashDepositSlip',$data);
		
	}
	
	public function insertCashDepositSlip()
	{
				$data = array();
				
				$data['header']= array(
					'cashDeposit_slip_Number' => $this->input->post('slipNo'),
					'cashDeposit_slip_ConductorEmpId' => $this->input->post('conductorEmpId'),
					'cashDeposit_slip_DutyId' => $this->input->post('routeId'),
					'cashDeposit_slip_BusNumber' => $this->input->post('busNumber'),
					'cashDeposit_slip_DriverEmpId' => $this->input->post('driverEmpId'),
					'cashDeposit_slip_Date' => $this->input->post('slipDate'),
					'cashDeposit_slip_AddedDateTime' => date('Y-m-d H:i:s'),
					'cashDeposit_slip_AddedBy' => $this->session->userdata['logged_in']['id']
					
				);
				
				$tempDetails = array(
				'cashDeposit_slip_details_TicketId' => $this->input->post('ticketId'),
				'cashDeposit_slip_details_ticketSeries' => $this->input->post('ticketSeries'),
				'cashDeposit_slip_details_TicketStartSerial' => $this->input->post('ticketStartSerial'),
				'cashDeposit_slip_details_TicketEndSerial' => $this->input->post('ticketEndSerial'),
				'cashDeposit_slip_details_isEnd' => $this->input->post('ticketisEnd'),
				'cashDeposit_slip_details_ActualTicketsSold' => $this->input->post('ticketsSold'),
				'cashDeposit_slip_details_CalculatedAmount' => $this->input->post('amount')
				);
				$data['details'] = array();
				$total_rows = count($tempDetails['cashDeposit_slip_details_TicketId']);
				 if ($total_rows > 0)
					{
						for ($i=0; $i<$total_rows; $i++)
						{
							$temp=array();
							$temp['cashDeposit_slip_details_TicketId'] = $tempDetails['cashDeposit_slip_details_TicketId'][$i];
							$temp['cashDeposit_slip_details_ticketSeries'] = $tempDetails['cashDeposit_slip_details_ticketSeries'][$i];
							$temp['cashDeposit_slip_details_TicketStartSerial'] = $tempDetails['cashDeposit_slip_details_TicketStartSerial'][$i];
							$temp['cashDeposit_slip_details_TicketEndSerial'] = $tempDetails['cashDeposit_slip_details_TicketEndSerial'][$i];
							$temp['cashDeposit_slip_details_ActualTicketsSold'] = $tempDetails['cashDeposit_slip_details_ActualTicketsSold'][$i];
							$temp['cashDeposit_slip_details_CalculatedAmount'] = $tempDetails['cashDeposit_slip_details_CalculatedAmount'][$i];
							$temp['cashDeposit_slip_details_isEnd'] = $tempDetails['cashDeposit_slip_details_isEnd'][$i];
							array_push($data['details'],$temp);
						}
					}
				//print_r($tempDetails);die;
				$result = $this->cashdepositslip_model->addCashDepositSlip($data);
				if ($result == TRUE) {
					redirect('admin/cashDepositSlip/cashDepositSlip');
				}
				 else {
					$data = array(
						'error_message' => 'Error in inserting dailySlip'
					);
					$this->load->view('admin/cashDepositSlip/editCashDepositSlip', $data);
				}
		
	}
	
	public function editCashDepositSlip($id)
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['result'] = $this->cashdepositslip_model->getCashDepositSlip($id);
		$data['details'] = $this->cashdepositslip_model->getCashDepositSlipDetails($id);
		$data['currentduty'] = $this->bus_model->getBusDuty($data['result'][0]['cashDeposit_slip_DutyId']);
		$data['employees'] = $this->emp_model->listEmployees();
		$data['duty'] = $this->bus_model->listBusDuty();
		$data['busList'] = $this->bus_model->listBus();
		
		$tempTickets=$this->tickets_model->listTickets();
		$tempArray=array();
		foreach($tempTickets['result'] as $tickets){
			$tempArray[$tickets->tickets_Id] = $tickets;
		}
		$data['tickets'] = $tempArray;
		$this->load->view('admin/cashDepositSlip/editCashDepositSlip',$data);
		
	}
	public function viewCashDepositSlip($id)
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['result'] = $this->cashdepositslip_model->getCashDepositSlip($id);
		$data['details'] = $this->cashdepositslip_model->getCashDepositSlipDetails($id);
		$data['currentduty'] = $this->bus_model->getBusDuty($data['result'][0]['cashDeposit_slip_DutyId']);
		$data['employees'] = $this->emp_model->listEmployees();
		$data['duty'] = $this->bus_model->listBusDuty();
		$data['busList'] = $this->bus_model->listBus();
		
		$tempTickets=$this->tickets_model->listTickets();
		$tempArray=array();
		foreach($tempTickets['result'] as $tickets){
			$tempArray[$tickets->tickets_Id] = $tickets;
		}
		$data['tickets'] = $tempArray;
		$data['isView']=true;
		$this->load->view('admin/cashDepositSlip/viewCashDepositSlip',$data);
		
	}
	
	public function updateCashDepositSlip()
	{
				$data = array();
				
				$data['header']= array(
					'cashDeposit_slip_Id' => $this->input->post('slipId'),
					'cashDeposit_slip_Number' => $this->input->post('slipNo'),
					'cashDeposit_slip_ConductorEmpId' => $this->input->post('conductorEmpId'),
					'cashDeposit_slip_DutyId' => $this->input->post('routeId'),
					'cashDeposit_slip_BusNumber' => $this->input->post('busNumber'),
					'cashDeposit_slip_DriverEmpId' => $this->input->post('driverEmpId'),
					'cashDeposit_slip_Date' => $this->input->post('slipDate'),
					'cashDeposit_slip_AddedDateTime' => date('Y-m-d H:i:s'),
					'cashDeposit_slip_AddedBy' => $this->session->userdata['logged_in']['id']
					
				);
				
				$tempDetails = array(
				'cashDeposit_slip_details_Id' => $this->input->post('slipdetailsId'),
				'cashDeposit_slip_details_TicketId' => $this->input->post('ticketId'),
				'cashDeposit_slip_details_ticketSeries' => $this->input->post('ticketSeries'),
				'cashDeposit_slip_details_TicketStartSerial' => $this->input->post('ticketStartSerial'),
				'cashDeposit_slip_details_TicketEndSerial' => $this->input->post('ticketEndSerial'),
				'cashDeposit_slip_details_isEnd' => $this->input->post('ticketisEnd'),
				'cashDeposit_slip_details_ActualTicketsSold' => $this->input->post('ticketsSold'),
				'cashDeposit_slip_details_CalculatedAmount' => $this->input->post('amount')
				);
				$data['details'] = array();
				$total_rows = count($tempDetails['cashDeposit_slip_details_TicketId']);
				 if ($total_rows > 0)
					{
						for ($i=0; $i<$total_rows; $i++)
						{
							$temp=array();
							$temp['cashDeposit_slip_details_Id'] = $tempDetails['cashDeposit_slip_details_Id'][$i];
							$temp['cashDeposit_slip_details_TicketId'] = $tempDetails['cashDeposit_slip_details_TicketId'][$i];
							$temp['cashDeposit_slip_details_ticketSeries'] = $tempDetails['cashDeposit_slip_details_ticketSeries'][$i];
							$temp['cashDeposit_slip_details_TicketStartSerial'] = $tempDetails['cashDeposit_slip_details_TicketStartSerial'][$i];
							$temp['cashDeposit_slip_details_TicketEndSerial'] = $tempDetails['cashDeposit_slip_details_TicketEndSerial'][$i];
							$temp['cashDeposit_slip_details_ActualTicketsSold'] = $tempDetails['cashDeposit_slip_details_ActualTicketsSold'][$i];
							$temp['cashDeposit_slip_details_CalculatedAmount'] = $tempDetails['cashDeposit_slip_details_CalculatedAmount'][$i];
							$temp['cashDeposit_slip_details_isEnd'] = $tempDetails['cashDeposit_slip_details_isEnd'][$i];
							array_push($data['details'],$temp);
						}
					}
				
				$result = $this->cashdepositslip_model->updateCashDepositSlip($data);
				
					redirect('admin/cashDepositSlip/cashDepositSlip');
				/* }
				 else {
					$data = array(
						'error_message' => 'Error in updating dailySlip'
					);
					$this->load->view('admin/dailySlip/editDailySlip', $data);
				} */
		
	}
	
	public function deleteCashDepositSlip() {
				$id =$this->input->post('cashslipId');
				$result = $this->cashdepositslip_model->deleteCashDepositSlip($id);
				if ($result == TRUE) {
					redirect('admin/cashDepositSlip/cashDepositSlip');
				}
				 else {
					$data = array(
						'error_message' => 'Error in deleting dailySlip'
					);
					$this->load->view('admin/cashDepositSlip/index', $data);
				}
		
	}
	
	//downloadcashDepositSlip
	
	public function downloadcashDepositSlip($id){
			
		//load mPDF library
		$this->load->library('m_pdf');
		//now pass the data//
		$this->data['title']="WaybillSlip";
		$this->data['description']="Contains Waybillslip";
		//now pass the data //
		$this->data['result'] = $this->cashdepositslip_model->getCashDepositSlip($id);
		$this->data['details'] = $this->cashdepositslip_model->getCashDepositSlipDetails($id);
		$this->data['currentduty'] = $this->bus_model->getBusDuty($this->data['result'][0]['cashDeposit_slip_DutyId']);
		$this->data['employees'] = $this->emp_model->listEmployees();
		$this->data['duty'] = $this->bus_model->listBusDuty();
		$this->data['busList'] = $this->bus_model->listBus();
		
		$tempTickets=$this->tickets_model->listTickets();
		$tempArray=array();
		foreach($tempTickets['result'] as $tickets){
			$tempArray[$tickets->tickets_Id] = $tickets;
		}
		$this->data['tickets'] = $tempArray;
		
		$html=$this->load->view('admin/cashDepositSlip/pdfSingleCashDepositSlip',$this->data, true);
		
		
		//this the the PDF filename that user will get to download
		$pdfFilePath ="waybill-".$this->data['result'][0]['cashDeposit_slip_Number']."-".time()."-download.pdf";
		 
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
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
			
		$this->load->view('admin/cashDepositSlip/customReports',$data);
	}
	
	
	public function downloadcashDepositSlipReport(){
			//print_r($_REQUEST); die;
		//load mPDF library
		$this->load->library('m_pdf');
		//now pass the data//
		$this->data['title']="WaybillSlip";
		$this->data['description']="Contains Waybillslip";
		//now pass the data //
		if(isset($_REQUEST['dateRange']))
			$daterange = explode(' - ',$_REQUEST['dateRange']);
		
		$this->data['result'] = $this->cashdepositslip_model->listCashDepositSlipReports($_REQUEST['conductorEmpId'],$_REQUEST['dutyId'],$_REQUEST['busNumber'],$daterange[0],$daterange[1]);
		$this->data['details'] = array();
		foreach($this->data['result']['result'] as $record)
		{
			$this->data['details'][$record['cashDeposit_slip_Id']]=array();
			$this->data['details'][$record['cashDeposit_slip_Id']]=$this->cashdepositslip_model->getCashDepositSlipDetails($record['cashDeposit_slip_Id']);
		}
		$this->data['employees'] = $this->emp_model->listEmployees();
		$this->data['duty'] = $this->bus_model->listBusDuty();
		$this->data['busList'] = $this->bus_model->listBus();
		
		$tempTickets=$this->tickets_model->listTickets();
		$tempArray=array();
		foreach($tempTickets['result'] as $tickets){
			$tempArray[$tickets->tickets_Id] = $tickets;
		}
		$this->data['tickets'] = $tempArray;
		
		$tempArray=array();
		foreach($this->data['duty']['result'] as $dutyrow){
			$tempArray[$dutyrow->bus_duty_Id] = $dutyrow;
		}
		$this->data['duty'] = $tempArray;
		
		$tempArray=array();
		foreach($this->data['employees']['result'] as $employees){
			$tempArray[$employees->Employee_Id] = $employees;
		}
		$this->data['employees'] = $tempArray;
		$html=$this->load->view('admin/cashDepositSlip/pdfCashDepositSlipReport',$this->data, true);
		
		
		//this the the PDF filename that user will get to download
		$pdfFilePath ="waybillReportsCustom-".time()."-download.pdf";
		 
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
		
		//generate the PDF!
		$pdf->WriteHTML($html,2);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		$pdf->Output($pdfFilePath, "D");
			
	}
	
	public function getLastTicketSeries(){
		$conductorId = $_GET['conductorId'];
		if(!empty($conductorId)){
			$ticketSeries = $this->cashdepositslip_model->getLastTicketSeries($conductorId);
			if(count($ticketSeries)>0)
			{
				$response= array();
				$response['status']= true;
				$response['data']= $ticketSeries;
				
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
	
}
