<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_Register extends CI_Controller {

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
		$data['result'] = $this->tickets_model->listTicketRegister();
		$this->load->view('admin/tickets/ticketRegister',$data);
	}
	
	public function addTicketRegister()
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$this->load->view('admin/tickets/addTicketRegister');
		
	}
	
	public function insertTicketRegister()
	{
				$data = array(
				'TicketRegister_TicketId' => $this->input->post('ticketId'),
				'TicketRegister_Qty' => $this->input->post('ticketQty'),
				'TicketRegister_DateTime' => date('Y-m-d H:i:s'),
				'TicketRegister_AddedBy' => $this->session->userdata['logged_in']['id'],
				'TicketRegister_Status' => $this->input->post('ticketRegisterStatus')
				);
				
				$result = $this->tickets_model->addTicket($data);
				if ($result == TRUE) {
					redirect('admin/tickets/Ticket_Register');
				}
				 else {
					$data = array(
						'error_message' => 'Error in inserting ticket register'
					);
					$this->load->view('admin/tickets/editTicketRegister', $data);
				}
		
	}
	
	public function editTicketRegister($id)
	{
		if(!isset($this->session->userdata['logged_in'])){
			redirect('admin/login/index');
		}
		$data['result'] = $this->tickets_model->getTicketRegister($id);
		$this->load->view('admin/tickets/editTicketRegister',$data);
		
	}
	
	public function updateTicketRegister()
	{
				$data = array(
				'TicketRegister_Id' => $this->input->post('ticketRegisterId'),
				'TicketRegister_TicketId' => $this->input->post('ticketId'),
				'TicketRegister_Qty' => $this->input->post('ticketQty'),
				'TicketRegister_Status' => $this->input->post('ticketRegisterStatus')
				);
				
				$result = $this->tickets_model->updateTicketRegister($data);
				if ($result == TRUE) {
					redirect('admin/tickets/Ticket_Register');
				}
				 else {
					$data = array(
						'error_message' => 'Error in updating TicketRegister'
					);
					$this->load->view('admin/ticket/editTicketRegister', $data);
				}
		
	}
	
	public function deleteTicket() {
				$id =$this->input->post('ticketRegisterId');
				$result = $this->tickets_model->deleteTicketRegister($id);
				if ($result == TRUE) {
					redirect('admin/tickets/Ticket_Register');
				}
				 else {
					$data = array(
						'error_message' => 'Error in deleting TicketRegister'
					);
					$this->load->view('admin/tickets/ticketRegister', $data);
				}
		
	}
}
