<?php
Class Bus_Model extends CI_Model {
	
	public function addBusRoute($data) {
		// Query to insert data in database
		$this->db->insert('bus_routes', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else {
		return false;
		}
	}
	
	public function listBusRoutes() {
		
		$this->db->select('*');
		$this->db->from('bus_routes');
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result();
		$data['records']=$query->num_rows();
		return $data;
		
	}
	
	public function deleteBusRoute($id) {
		
		$this->db->where('Bus_Routes_Id', $id);
		$this->db->delete('bus_routes');
		if ($this->db->affected_rows() > 0) {
				return true;
				}
				return false;
		
	}
	
	public function getBusRoute($id)
	{			$query=$this->db->query("SELECT * FROM bus_routes  WHERE Bus_Routes_Id = $id");
				return $query->result_array();
	}
	
	public function updateBusRoute($id,$data)
	{			
		$this->db->where('Bus_Routes_Id', $data['Bus_Routes_Id']);
		$this->db->update('bus_routes' ,$data);
			if ($this->db->affected_rows() > 0) {
				return true;
				}
		
			return false;
		
		
	}
	
	/********************* Bus Timings ***********************************/
	
	public function addBusTiming($data) {
		// Query to insert data in database
		$this->db->insert('bus_timing', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else {
		return false;
		}
	}
	
	public function listBusTiming() {
		
		$this->db->select('*');
		$this->db->from('bus_timing');
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result();
		$data['records']=$query->num_rows();
		return $data;
		
	}
	
	public function deleteBusTiming($id) {
		
		$this->db->where('bus_timing_Id', $id);
		$this->db->delete('bus_timing');
		if ($this->db->affected_rows() > 0) {
				return true;
				}
				return false;
		
	}
	
	public function getBusTiming($id)
	{			$query=$this->db->query("SELECT * FROM bus_timing   WHERE bus_timing_Id = $id");
				return $query->result_array();
	}
	
	public function updateBusTiming($id,$data)
	{			
		$this->db->where('bus_timing_Id', $data['bus_timing_Id']);
		$this->db->update('bus_timing' ,$data);
			if ($this->db->affected_rows() > 0) {
				return true;
				}
		
			return false;
		
		
	}
}
?>