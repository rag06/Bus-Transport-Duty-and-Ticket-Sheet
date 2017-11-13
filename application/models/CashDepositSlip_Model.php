<?php
Class CashDepositSlip_Model extends CI_Model {
	
	// insert 
	public function addCashDepositSlip($data) {
		// Query to insert data in database
		$this->db->insert('cashdeposit_slip', $data['header']);
		$cashslipId = $this->db->insert_id();
		foreach($data['details'] as $value){
		
			$value['cashDeposit_slip_details_SlipId'] = $cashslipId;
			$this->db->insert('cashdeposit_slip_details', $value);
		}
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else {
		return false;
		}
	}
	
	public function getCashDepositSlipNextNumber() {
		
		$query=$this->db->query("SELECT MAX(`cashDeposit_slip_Number` ) +1 AS WaybillNum FROM cashdeposit_slip");
				return $query->result_array();
		
	}
	
	public function getCashDepositSlip($id) {
		
		$query=$this->db->query("SELECT * FROM cashdeposit_slip  WHERE cashDeposit_slip_Id = $id");
				return $query->result_array();
		
	}
	
	public function getCashDepositSlipDetails($id) {
		
		$query=$this->db->query("SELECT * FROM cashdeposit_slip_details  WHERE cashDeposit_slip_details_SlipId = $id");
				return $query->result_array();
		
	}
	
	public function listCashDepositSlip() {
		
		$this->db->select('*');
		$this->db->from('cashdeposit_slip');
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result();
		$data['records']=$query->num_rows();
		return $data;
		
	}
	
	public function deleteCashDepositSlip($id) {
		
		$this->db->where('cashDeposit_slip_Id', $id);
		$this->db->delete('cashdeposit_slip');
		
		$this->db->where('cashDeposit_slip_details_SlipId', $id);
		$this->db->delete('cashdeposit_slip_details');
		
		if ($this->db->affected_rows() > 0) {
				return true;
				}
				return false;
		
	}
	
	public function updateCashDepositSlip($data)
	{			
		
		$this->db->where('cashDeposit_slip_Id', $data['header']['cashDeposit_slip_Id']);
		$this->db->update('cashdeposit_slip' ,$data['header']);
		
		foreach($data['details'] as $value){
			$this->db->where('cashDeposit_slip_details_Id', $value['cashDeposit_slip_details_Id']);
			$this->db->update('cashdeposit_slip_details' ,$value);
		}
		
			if ($this->db->affected_rows() > 0) {
				return true;
				}
		
			return false;
		
		
	}
	
}
?>