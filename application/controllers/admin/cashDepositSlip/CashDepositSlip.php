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
		$data['routes'] = array();
		$data['employees'] = array();
		foreach ($data['result']['result'] as $row){
			$routeRow= $this->bus_model->getBusRoute($row->cashDeposit_slip_RouteId);
			$empRow= $this->emp_model->getEmployee($row->cashDeposit_slip_ConductorEmpId);
			$data['routes'][$routeRow[0]['Bus_Routes_Id']] = $routeRow;
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
		$data['routes'] = $this->bus_model->listBusRoutes();
		$data['tickets'] = $this->tickets_model->listTickets();
		
		$this->load->view('admin/cashDepositSlip/addCashDepositSlip',$data);
		
	}
	
	public function insertCashDepositSlip()
	{
				$data = array();
				
				$data['header']= array(
					'cashDeposit_slip_Number' => $this->input->post('slipNo'),
					'cashDeposit_slip_ConductorEmpId' => $this->input->post('conductorEmpId'),
					'cashDeposit_slip_RouteId' => $this->input->post('routeId'),
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
		$data['route'] = $this->bus_model->getBusRoute($data['result'][0]['cashDeposit_slip_RouteId']);
		$data['employees'] = $this->emp_model->listEmployees();
		$data['routes'] = $this->bus_model->listBusRoutes();
		
		$tempTickets=$this->tickets_model->listTickets();
		$tempArray=array();
		foreach($tempTickets['result'] as $tickets){
			$tempArray[$tickets->tickets_Id] = $tickets;
		}
		$data['tickets'] = $tempArray;
		$this->load->view('admin/cashDepositSlip/editCashDepositSlip',$data);
		
	}
	
	public function updateCashDepositSlip()
	{
				$data = array();
				
				$data['header']= array(
					'cashDeposit_slip_Id' => $this->input->post('slipId'),
					'cashDeposit_slip_Number' => $this->input->post('slipNo'),
					'cashDeposit_slip_ConductorEmpId' => $this->input->post('conductorEmpId'),
					'cashDeposit_slip_RouteId' => $this->input->post('routeId'),
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
}
