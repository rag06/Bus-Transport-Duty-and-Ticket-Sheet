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
		$data['duty'] = $this->dashboard_model->getSalesPerDutyPerYearPerMonth();
		$data['tickets'] = $this->dashboard_model->getSalesPerTicketPerYearPerMonth();
		$data['employees'] = $this->dashboard_model->getCountOfEmployeesPerType();
		$data['adminusers'] = $this->dashboard_model->getCountOfAdminUsers();
		$data['routecount'] = $this->dashboard_model->getCountOfBusRoutes();
		$data['dutyslipcount'] = $this->dashboard_model->getCountOfTodaysDutySlip();
		$data['waybillcount'] = $this->dashboard_model->getCountOfTodaysWayBillSlip();
		$data['noOfBusPerRoute'] = $this->dashboard_model->getCountOfNoOfBusPerBusRoutes();
		
		$tempTickets=$this->tickets_model->listTickets();
		$tempDuty=$this->bus_model->listBusDuty();
		$tempArray=array();
		foreach($tempTickets['result'] as $tickets){
			$tempArray[$tickets->tickets_Id] = $tickets;
		}
		
		$data['ticketsData'] = $tempArray;
		$tempArray=array();
		foreach($tempDuty['result'] as $duty){
			$tempArray[$duty->bus_duty_Id] = $duty;
		}
		$data['dutyData'] = $tempArray;
		$this->load->view('admin/dashboard/dashboard',$data);
	}
	//pdfSalesPerMonthPerYear
	
	
	public function downloadSalesPerMonthPerYear(){
			
		//load mPDF library
		$this->load->library('m_pdf');
		//now pass the data//
		$this->data['title']="SalesPerMonthPerYear";
		$this->data['description']="Contains SalesPerMonthPerYear Report";
		//now pass the data //
		$this->data['sales'] = $this->dashboard_model->getSalesPerYearPerMonth();
		
		$html=$this->load->view('admin/dashboard/pdfSalesPerMonthPerYear',$this->data, true);
		
		
		//this the the PDF filename that user will get to download
		$pdfFilePath ="report-SalesPerMonthPerYear-".time()."-download.pdf";
		 
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
	
	public function downloadSalesPerTicketPerMonthPerYear(){
			
		//load mPDF library
		$this->load->library('m_pdf');
		//now pass the data//
		$this->data['title']="SalesPerTicketPerMonthPerYear";
		$this->data['description']="Contains SalesPerTicketPerMonthPerYear Report";
		//now pass the data //
		$this->data['tickets'] = $this->dashboard_model->getSalesPerTicketPerYearPerMonth();
		$tempTickets=$this->tickets_model->listTickets();
		$tempDuty=$this->bus_model->listBusDuty();
		$tempArray=array();
		foreach($tempTickets['result'] as $tickets){
			$tempArray[$tickets->tickets_Id] = $tickets;
		}
		
		$this->data['ticketsData'] = $tempArray;
		$html=$this->load->view('admin/dashboard/pdfSalesPerTicketPerMonthPerYear',$this->data, true);
		
		
		//this the the PDF filename that user will get to download
		$pdfFilePath ="report-SalesPerTicketPerMonthPerYear-".time()."-download.pdf";
		 
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
	public function downloadSalesPerDutyPerMonthPerYear(){
			
		//load mPDF library
		$this->load->library('m_pdf');
		//now pass the data//
		$this->data['title']="SalesPerDutyPerMonthPerYear";
		$this->data['description']="Contains SalesPerDutyPerMonthPerYear Report";
		//now pass the data //
		$this->data['duty'] = $this->dashboard_model->getSalesPerDutyPerYearPerMonth();
		$tempDuty=$this->bus_model->listBusDuty();
		$tempArray=array();
		foreach($tempDuty['result'] as $duty){
			$tempArray[$duty->bus_duty_Id] = $duty;
		}
		$this->data['dutyData'] = $tempArray;
		$html=$this->load->view('admin/dashboard/pdfSalesPerDutyPerMonthPerYear',$this->data, true);
		
		
		//this the the PDF filename that user will get to download
		$pdfFilePath ="report-SalesPerDutyPerMonthPerYear-".time()."-download.pdf";
		 
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
