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
	
	public function getTicketsSold() {
		
		$query=$this->db->query("SELECT SUM(  `cashDeposit_slip_details_ActualTicketsSold` ) AS QTY,  `cashDeposit_slip_details_TicketId`  AS TicketId FROM  `cashdeposit_slip_details` GROUP BY  `cashDeposit_slip_details_TicketId` ");
				return $query->result_array();
		
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
	public function getLastTicketSeries($id) {
		
		$finalObject =array();
		
		$query=$this->db->query("SELECT MAX(cashDeposit_slip_Number) AS WaybillNum , cashDeposit_slip_Id FROM cashdeposit_slip  WHERE cashDeposit_slip_ConductorEmpId = $id");
		$temp = $query->result_array();
		$slipID = $temp[0]['cashDeposit_slip_Id'];
		if(!empty($slipID)){ 
			$query = $this->db->query("SELECT * FROM `cashdeposit_slip_details` WHERE `cashDeposit_slip_details_SlipId` = $slipID AND `cashDeposit_slip_details_isEnd`!=1");
			$temp = $query->result_array();
			foreach($temp as $detail){
				$finalObject[$detail['cashDeposit_slip_details_TicketId']]=array();
				array_push($finalObject[$detail['cashDeposit_slip_details_TicketId']],$detail);
			}
			
		}
		return $finalObject;
		
	}
	
	public function listCashDepositSlip() {
		
		$this->db->select('*');
		$this->db->from('cashdeposit_slip');
		$this->db->order_by('cashDeposit_slip_Date','desc');
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result();
		$data['records']=$query->num_rows();
		return $data;
		
	}
	public function listCashDepositSlipReports($conductor='',$dutyId='',$busNumber='',$startDate,$endDate) {
		
		$this->db->select('*');
		$this->db->from('cashdeposit_slip');
		$where = "";
		$where .= "cashDeposit_slip_Date BETWEEN '".$startDate."' AND '".$endDate."'";
		if(!empty($condutor))
			$where .= " AND cashDeposit_slip_ConductorEmpId='".$conductor;
		if(!empty($dutyId))
			$where .= " AND cashDeposit_slip_DutyId='".$dutyId;
		if(!empty($busNumber))
			$where .= " AND cashDeposit_slip_BusNumber='".$busNumber;
			
		$this->db->where($where);
		$this->db->order_by('cashDeposit_slip_Date','desc');
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result_array();
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