<?php
Class Tickets_Model extends CI_Model {
	
	// insert a ticket
	public function addTicket($data) {
		// Query to insert data in database
		$this->db->insert('tickets', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else {
		return false;
		}
	}
	
	public function listTickets() {
		
		$this->db->select('*');
		$this->db->from('tickets');
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result();
		$data['records']=$query->num_rows();
		return $data;
		
	}
	
	public function deleteTicket($id) {
		
		$this->db->where('tickets_Id', $id);
		$this->db->delete('tickets');
		if ($this->db->affected_rows() > 0) {
				return true;
				}
				return false;
		
	}
	
	public function getTicket($id)
	{			$query=$this->db->query("SELECT * FROM tickets   WHERE tickets_Id = $id");
				return $query->result_array();
	}
	
	public function updateTicket($data)
	{			
		$this->db->where('tickets_Id', $data['tickets_Id']);
		$this->db->update('tickets' ,$data);
			if ($this->db->affected_rows() > 0) {
				return true;
				}
		
			return false;
		
		
	}
	
	/********************* ticket Register ***********************************/
	
	public function addTicketRegister($data) {
		// Query to insert data in database
		$this->db->insert('ticket_register', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else {
		return false;
		}
	}
	
	public function listTicketRegister() {
		
		$this->db->select('*');
		$this->db->from('ticket_register');
		$this->db->join('tickets', 'ticket_register.TicketRegister_TicketId = tickets.tickets_Id');
		$this->db->order_by("TicketRegister_DateTime", "desc");
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result();
		$data['records']=$query->num_rows();
		return $data;
		
	}
	
	public function deleteTicketRegister($id) {
		
		$this->db->where('TicketRegister_Id', $id);
		$this->db->delete('ticket_register');
		if ($this->db->affected_rows() > 0) {
				return true;
				}
				return false;
		
	}
	
	public function getTicketRegister($id)
	{			$query=$this->db->query("SELECT * FROM ticket_register   WHERE TicketRegister_Id = $id");
				return $query->result_array();
	}
	
	public function updateTicketRegister($data)
	{			
		$this->db->where('TicketRegister_Id', $data['TicketRegister_Id']);
		$this->db->update('ticket_register' ,$data);
			if ($this->db->affected_rows() > 0) {
				return true;
				}
		
			return false;
		
		
	}
}
?>