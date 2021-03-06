<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('Tickets_Model', 'tickets_model');
		$this->load->model('CashDepositSlip_Model', 'cash_model');
	}
	
	public function index()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/login/index');
		}
		$data['result'] = $this->tickets_model->listTickets();
		
		$tempqty = $this->tickets_model->getTicketsQty();
		$data['ticketQty'] = array();
		foreach($tempqty as $qty)
		{
			$data['ticketQty'][$qty['TicketId']] = $qty['QTY'];
		}
		
		$tempsoldqty = $this->cash_model->getTicketsSold();
		$data['ticketSoldQty'] = array();
		foreach($tempsoldqty as $qty)
		{
			$data['ticketSoldQty'][$qty['TicketId']] = $qty['QTY'];
		}
		$this->load->view('admin/tickets/index',$data);
	}
	
	public function addTicket()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$this->load->view('admin/tickets/addTicket');
		
	}
	
	public function insertTicket()
	{
				$data = array(
				'tickets_Price' => $this->input->post('ticketPrice'),
				'tickets_ExtraPrice' => $this->input->post('ticketExtraPrice'),
				'tickets_CreatedOn' => date('Y-m-d H:i:s'),
				'tickets_CreatedBy' => $this->session->userdata['logged_in']['id'],
				'tickets_Type' => $this->input->post('ticketType')
				);
				
				$result = $this->tickets_model->addTicket($data);
				if ($result == TRUE) {
					redirect('admin/tickets/tickets');
				}
				 else {
					$data = array(
						'error_message' => 'Error in inserting tickets'
					);
					$this->load->view('admin/tickets/editTicket', $data);
				}
		
	}
	
	public function editTicket($id)
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['result'] = $this->tickets_model->getTicket($id);
		$this->load->view('admin/tickets/editTicket',$data);
		
	}
	
	public function updateTicket()
	{
				$data = array(
				'tickets_Id' => $this->input->post('ticketId'),
				'tickets_Price' => $this->input->post('ticketPrice'),
				'tickets_ExtraPrice' => $this->input->post('ticketExtraPrice'),
				'tickets_Type' => $this->input->post('ticketType')
				);
				
				$result = $this->tickets_model->updateTicket($data);
				if ($result == TRUE) {
					redirect('admin/tickets/tickets');
				}
				 else {
					$data = array(
						'error_message' => 'Error in updating ticket',
						'result' =>  $this->tickets_model->getTicket($data['tickets_Id'])
					);
					$this->load->view('admin/tickets/editTicket', $data);
				}
		
	}
	
	public function deleteTicket() {
				$id =$this->input->post('ticketId');
				$result = $this->tickets_model->deleteTicket($id);
				if ($result == TRUE) {
					redirect('admin/tickets/tickets');
				}
				 else {
					$data = array(
						'error_message' => 'Error in deleting tickets'
					);
					$this->load->view('admin/tickets/index', $data);
				}
		
	}
	
	public function downloadTicketList(){
			
		 
		//load mPDF library
		$this->load->library('m_pdf');
		//now pass the data//
		$this->data['title']="Tickets List";
		$this->data['description']="Contains all the list of tickets";
		//now pass the data //
		
		
		$this->data['result'] = $this->tickets_model->listTickets();
		
		$tempqty = $this->tickets_model->getTicketsQty();
		$tempsoldqty = $this->cash_model->getTicketsSold();
		$data['ticketQty'] = array();
		foreach($tempqty as $qty)
		{
			$this->data['ticketQty'][$qty['TicketId']] = $qty['QTY'];
		}
		$data['ticketSoldQty'] = array();
		foreach($tempsoldqty as $qty)
		{
			$this->data['ticketSoldQty'][$qty['TicketId']] = $qty['QTY'];
		}
		 
		$html=$this->load->view('admin/tickets/pdf_output',$this->data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
		//this the the PDF filename that user will get to download
		$pdfFilePath ="ticketList-".time()."-download.pdf";
		 
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
		//generate the PDF!
		$pdf->WriteHTML($html,2);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		$pdf->Output($pdfFilePath, "D");
			
	}
}
