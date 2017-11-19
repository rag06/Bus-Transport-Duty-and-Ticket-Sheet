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
		
		$query=$this->db->query("SELECT * FROM conductor_daysslip  WHERE conductor_daysSlip_Id = $id");
				return $query->result_array();
		
	}
	
	public function getDailySlipDetails($id) {
		
		$query=$this->db->query("SELECT * FROM conductor_daysslip_details  WHERE conductor_daysslip_details_SlipId = $id");
				return $query->result_array();
		
	}
	
	public function listDailySlip() {
		
		$this->db->select('*');
		$this->db->from('conductor_daysslip');
		
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result();
		$data['records']=$query->num_rows();
		return $data;
		
	}
	
	public function listDutySlipReports($conductor='',$dutyId='',$busNumber='',$startDate,$endDate) {
		
		$this->db->select('*');
		$this->db->from('conductor_daysslip');
		$where = "";
		$where .= "conductor_daysslip_date BETWEEN '".$startDate."' AND '".$endDate."'";
		if(!empty($condutor))
			$where .= " AND conductor_daysSlip_ConductorEmpId='".$conductor;
		if(!empty($dutyId))
			$where .= " AND conductor_daysSlip_DutyId='".$dutyId;
		if(!empty($busNumber))
			$where .= " AND conductor_daysSlip_BusNumber='".$busNumber;

		$this->db->where($where);
		$this->db->order_by('conductor_daysslip_date','desc');
		$query = $this->db->get();
		$data=array();
		$data['result']=$query->result_array();
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
		
		$this->db->where('conductor_daysSlip_Id', $data['header']['conductor_daysSlip_Id']);
		$this->db->update('conductor_daysslip' ,$data['header']);
		
		foreach($data['details'] as $value){
			$this->db->where('conductor_daysslip_details_Id', $value['conductor_daysslip_details_Id']);
			$this->db->update('conductor_daysslip_details' ,$value);
		}
		
			if ($this->db->affected_rows() > 0) {
				return true;
				}
		
			return false;
		
		
	}
	
	public function getEPKM($date){
		$cancelReason = array();
		$data =array();
		array_push($cancelReason,"Cancel Trip","Driver","Conductor","Workshop","Break Down","Accident","Traffic","Sunday","Route Change","Schedule Sp");
		/********* ALL SCHEDULE KM AND TRIPS PER DUTY***********/
		$query= "SELECT SUM(`bus_timing_Kilometers`) AS KM, COUNT(bus_timing_Id) AS TRIP ,bus_timing_DutyId  AS DUTY FROM `bus_timing` GROUP BY `bus_timing_DutyId` ORDER BY `bus_timing_DutyId`";
		
		$result=$this->db->query($query);
		$tempschedule = $result->result_array();
		$schedule = array();
		foreach($tempschedule as $row)
		{
			$schedule[$row['DUTY']]	= $row;
		}
		$data['schedule'] =$schedule;
		/******** AMOUNT PER DUTY FOR DATE**************/
		
		$query= "SELECT SUM(`cashDeposit_slip_details_CalculatedAmount`) AS AMOUNT ,cashDeposit_slip_DutyId AS DUTY FROM `cashdeposit_slip_details` d , cashdeposit_slip c  WHERE d.`cashDeposit_slip_details_SlipId` = c.cashDeposit_slip_Id AND cashDeposit_slip_Date='".$date."' GROUP BY c.cashDeposit_slip_DutyId";
		
		$result=$this->db->query($query);
		$tempamount = $result->result_array();
		$amount = array();
		foreach($tempamount as $row)
		{
			$amount[$row['DUTY']]	= $row;
		}
		
		$data['amount'] =$amount;
		/************* ACTUAL KM AND CANCEL PER DUTY FOR DATE ************************/
		
		
		$query= "SELECT SUM(`conductor_daysslip_details_ActualKm`) AS KM,SUM(`conductor_daysslip_details_cancel`) AS TOTALCANCEL,COUNT(conductor_daysslip_details_SlipId) AS TOTALTRIP, conductor_daysSlip_DutyId AS DUTY FROM `conductor_daysslip_details` c, conductor_daysslip d  WHERE c.`conductor_daysslip_details_SlipId` =d.conductor_daysSlip_Id AND conductor_daysslip_date='".$date."' GROUP BY d.conductor_daysSlip_DutyId";
		
		$result=$this->db->query($query);
		$tempactual = $result->result_array();
		$actual = array();
		foreach($tempactual as $row)
		{
			$actual[$row['DUTY']]	= $row;
		}
		
		$data['actual'] =$actual;
		
		/************* COUNT REASON PER DUTY FOR DATE ************************/
		
			$cancelCount = array();
		foreach($cancelReason as $reason){
			$query= "SELECT SUM(  `conductor_daysslip_details_cancel` ) AS Cancel, conductor_daysSlip_DutyId AS DUTY FROM  `conductor_daysslip_details` c, conductor_daysslip d WHERE c.`conductor_daysslip_details_SlipId` = d.conductor_daysSlip_Id AND conductor_daysslip_date =  '".$date."' AND conductor_daysslip_details_Reason =  '".$reason."' GROUP BY conductor_daysSlip_DutyId";
			
			$result=$this->db->query($query);
			$tempactual = $result->result_array();
			foreach($tempactual as $row)
			{
				$cancelCount[$row['DUTY']][$reason]	= $row['Cancel'];
			}
		}
		
		$data['cancelCount'] =$cancelCount;
		
		return $data;
		
	}
	
}
?>