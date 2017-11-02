<?php
Class Employee_Model extends CI_Model {
	
	public function addEmployee($data) {
		// Query to insert data in database
		$this->db->insert('employees', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else {
		return false;
		}
	}
	
	public function listEmployees() {
		
		$this->db->select('*');
		$this->db->from('employees');
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result();
		$data['records']=$query->num_rows();
		return $data;
		
	}
	
	public function deleteEmployee($id) {
		
		$this->db->where('Employee_Id', $id);
		$this->db->delete('employees');
		if ($this->db->affected_rows() > 0) {
				return true;
				}
				return false;
		
	}
	
	public function getEmployee($id)
	{			$query=$this->db->query("SELECT * FROM employees  WHERE Employee_Id = $id");
				return $query->result_array();
	}
	
	public function updateEmployee($id,$data)
	{			
		$this->db->where('Employee_Id', $data['Employee_Id']);
		$this->db->update('employees' ,$data);
			if ($this->db->affected_rows() > 0) {
				return true;
				}
		
			return false;
		
		
	}
	
	/********************* tickets - employee assignment ***********************************/
	
	public function addTicketEmployee($data) {
		// Query to insert data in database
		$this->db->insert('tickets_employee', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else {
		return false;
		}
	}
	
	public function listTicketEmployee() {
		
		$this->db->select('*');
		$this->db->from('tickets_employee');
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result();
		$data['records']=$query->num_rows();
		return $data;
		
	}
	
	public function deleteTicketEmployee($id) {
		
		$this->db->where('tickets_employee_Id', $id);
		$this->db->delete('tickets_employee');
		if ($this->db->affected_rows() > 0) {
				return true;
				}
				return false;
		
	}
	
	public function getTicketEmployee($id)
	{			$query=$this->db->query("SELECT * FROM tickets_employee   WHERE tickets_employee_Id = $id");
				return $query->result_array();
	}
	
	public function updateTicketEmployee($id,$data)
	{			
		$this->db->where('tickets_employee_Id', $data['tickets_employee_Id']);
		$this->db->update('tickets_employee' ,$data);
			if ($this->db->affected_rows() > 0) {
				return true;
				}
		
			return false;
		
		
	}
}
?>