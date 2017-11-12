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
		$this->db->order_by('Bus_Routes_Number','asc');
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
	
	public function updateBusRoute($data)
	{			
		$this->db->where('Bus_Routes_Id', $data['Bus_Routes_Id']);
		$this->db->update('bus_routes' ,$data);
			if ($this->db->affected_rows() > 0) {
				return true;
				}
		
			return false;
		
		
	}
	
	/******************************* Bus Duty    ******************************************/
	
	
	public function addBusDuty($data) {
		// Query to insert data in database
		$this->db->insert('bus_duty', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else {
		return false;
		}
	}
	
	public function listBusDuty() {
		
		$this->db->select('*');
		$this->db->from('bus_duty');
		$this->db->join('bus_routes','bus_duty.bus_duty_RouteId = bus_routes.Bus_Routes_Id');
		$this->db->order_by("bus_routes.Bus_Routes_Number", "asc");
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result();
		$data['records']=$query->num_rows();
		return $data;
		
	}
	
	public function deleteBusDuty($id) {
		
		$this->db->where('bus_duty_Id', $id);
		$this->db->delete('bus_duty');
		if ($this->db->affected_rows() > 0) {
				return true;
				}
				return false;
		
	}
	
	public function getBusDuty($id)
	{			$query=$this->db->query("SELECT * FROM bus_duty  WHERE bus_duty_Id = $id");
				return $query->result_array();
	}
	
	public function updateBusDuty($data)
	{			
		$this->db->where('bus_duty_Id', $data['bus_duty_Id']);
		$this->db->update('bus_duty' ,$data);
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
		$this->db->join('bus_duty','bus_duty.bus_duty_Id = bus_timing.bus_timing_DutyId');
		$this->db->order_by("bus_timing.bus_timing_CreatedOn", "desc");
		
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
	
	public function getBusTimingByRoute($id)
	{			$query=$this->db->query("SELECT * FROM bus_timing   WHERE bus_timing_RouteId = $id");
				return $query->result_array();
	}
	public function getBusTimingByDuty($id)
	{			$query=$this->db->query("SELECT * FROM bus_timing   WHERE bus_timing_DutyId = $id");
				return $query->result_array();
	}
	
	public function updateBusTiming($data)
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