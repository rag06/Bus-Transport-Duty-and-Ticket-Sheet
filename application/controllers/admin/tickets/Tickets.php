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
	}
	
	public function index()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/login/index');
		}
		$data['result'] = $this->tickets_model->listTickets();
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
				'tickets_Status' => $this->input->post('ticketStatus'),
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
				'tickets_Status' => $this->input->post('ticketStatus'),
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
}
