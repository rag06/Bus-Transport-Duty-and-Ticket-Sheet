<?php
Class DailySlip_Model extends CI_Model {
	
	// insert 
	public function addDailySlip($data) {
		// Query to insert data in database
		$this->db->insert('conductor_daysslip', $data['header']);
		$dailslipId = $this->db->insert_id();
		foreach($data['details'] as $value){
		
			$value['conductor_daysslip_details_SlipId'] = $dailslipId;
			$this->db->insert('conductor_daysslip_details', $value);
		}
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else {
		return false;
		}
	}
	
	public function getDailySlip($id) {
		
		$this->db->select('*');
		$this->db->from('conductor_daysslip');
		$this->db->join('conductor_daysslip_details','conductor_daysslip.conductor_daysSlip_Id = conductor_daysslip_details.conductor_daysslip_details_SlipId');
		$this->db->where('conductor_daysslip.conductor_daysSlip_Id =',$id);
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result();
		$data['records']=$query->num_rows();
		return $data;
		
	}
	
	public function listDailySlip() {
		
		$this->db->select('*');
		$this->db->from('conductor_daysslip');
		$this->db->join('conductor_daysslip_details','conductor_daysslip.conductor_daysSlip_Id = conductor_daysslip_details.conductor_daysslip_details_SlipId');
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result();
		$data['records']=$query->num_rows();
		return $data;
		
	}
	
	public function deleteDailySlip($id) {
		
		$this->db->where('conductor_daysSlip_Id', $id);
		$this->db->delete('conductor_daysslip');
		
		$this->db->where('conductor_daysslip_details_SlipId', $id);
		$this->db->delete('conductor_daysslip_details');
		
		if ($this->db->affected_rows() > 0) {
				return true;
				}
				return false;
		
	}
	
	public function updateDailySlip($data)
	{			
		
		$this->db->where('conductor_daysSlip_Id', $data['conductor_daysSlip_Id']);
		$this->db->update('conductor_daysslip' ,$data['header']);
		
		foreach($data['details'] as $value){
			$this->db->where('conductor_daysslip_details_SlipId', $value['conductor_daysslip_details_SlipId']);
			$this->db->update('conductor_daysslip_details' ,$value);
		}
		
			if ($this->db->affected_rows() > 0) {
				return true;
				}
		
			return false;
		
		
	}
	
}
?>