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
	}
	
	public function index()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/login/index');
		}
		$data['result'] = $this->dailyslip_model->listDailySlip();
		$this->load->view('admin/dailySlip/index',$data);
	}
	
	public function addDailySlip()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$this->load->view('admin/dailySlip/addDailySlip');
		
	}
	
	public function insertDailySlip()
	{
				$data = array();
				
				$data['header']= array(
					'conductor_daysSlip_ConductorEmpId' => $this->input->post('conductorEmpId'),
					'conductor_daysSlip_RoutesId' => $this->input->post('routeId'),
					'conductor_daysSlip_BusNumber' => $this->input->post('busNumber'),
					'conductor_daysSlip_DriveEmpId' => $this->input->post('driverEmpId'),
					'conductor_daysslip_date' => $this->input->post('dailslipDate'),
					'conductor_daysslip_TotalIncome' => $this->input->post('totalIncome'),
					'conductor_daysSlip_AddedDateTime' => date('Y-m-d H:i:s'),
					'conductor_daysSlip_AddedBy' => $this->session->userdata['logged_in']['id']
					
				);
				
				$tempDetails = array(,
				'conductor_daysslip_details_ActSourceTime' => $this->input->post('actSourceTime'),
				'conductor_daysslip_details_ActDestTime' => $this->input->post('actDestTime'),
				'conductor_daysslip_details_ActualKm' => $this->input->post('actKm')
				);
				$data['details'] = array();
				$total_rows = count($tempDetails['conductor_daysslip_details_SlipId']);
				 if ($total_rows > 0)
					{
						for ($i=1; $i<=$total_rows; $i++)
						{
							$temp=array();
							$temp['conductor_daysslip_details_ActSourceTime'] = $tempDetails['conductor_daysslip_details_ActSourceTime'][$i];
							$temp['conductor_daysslip_details_ActDestTime'] = $tempDetails['conductor_daysslip_details_ActDestTime'][$i];
							$temp['conductor_daysslip_details_ActualKm'] = $tempDetails['conductor_daysslip_details_ActualKm'][$i];
						}
					}
				 
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
		$this->load->view('admin/dailySlip/editDailySlip',$data);
		
	}
	
	public function updateDailySlip()
	{
				$data = array();
				
				
				$data['header']= array(
					'conductor_daysSlip_Id' => $this->input->post('slipId'),
					'conductor_daysSlip_ConductorEmpId' => $this->input->post('conductorEmpId'),
					'conductor_daysSlip_RoutesId' => $this->input->post('routeId'),
					'conductor_daysSlip_BusNumber' => $this->input->post('busNumber'),
					'conductor_daysSlip_DriveEmpId' => $this->input->post('driverEmpId'),
					'conductor_daysslip_date' => $this->input->post('dailslipDate'),
					'conductor_daysslip_TotalIncome' => $this->input->post('totalIncome'),
					'conductor_daysSlip_AddedDateTime' => date('Y-m-d H:i:s'),
					'conductor_daysSlip_AddedBy' => $this->session->userdata['logged_in']['id']
					
				);
				
				$tempDetails = array(,
				'conductor_daysslip_details_Id' => $this->input->post('slipDetailsId'),
				'conductor_daysslip_details_SlipId' => $this->input->post('slipId'),
				'conductor_daysslip_details_ActSourceTime' => $this->input->post('actSourceTime'),
				'conductor_daysslip_details_ActDestTime' => $this->input->post('actDestTime'),
				'conductor_daysslip_details_ActualKm' => $this->input->post('actKm')
				);
				$data['details'] = array();
				$total_rows = count($tempDetails['conductor_daysslip_details_Id']);
				 if ($total_rows > 0)
					{
						for ($i=1; $i<=$total_rows; $i++)
						{
							$temp=array();
							$temp['conductor_daysslip_details_Id'] = $tempDetails['conductor_daysslip_details_Id'][$i];
							$temp['conductor_daysslip_details_SlipId'] = $tempDetails['conductor_daysslip_details_SlipId'][$i];
							$temp['conductor_daysslip_details_ActSourceTime'] = $tempDetails['conductor_daysslip_details_ActSourceTime'][$i];
							$temp['conductor_daysslip_details_ActDestTime'] = $tempDetails['conductor_daysslip_details_ActDestTime'][$i];
							$temp['conductor_daysslip_details_ActualKm'] = $tempDetails['conductor_daysslip_details_ActualKm'][$i];
						}
					}
				 
				
				$result = $this->dailyslip_model->updateDailySlip($data);
				if ($result == TRUE) {
					redirect('admin/dailySlip/dailySlip');
				}
				 else {
					$data = array(
						'error_message' => 'Error in updating dailySlip'
					);
					$this->load->view('admin/dailySlip/editDailySlip', $data);
				}
		
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
}
