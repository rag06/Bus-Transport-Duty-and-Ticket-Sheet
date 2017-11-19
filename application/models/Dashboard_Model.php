<?php
Class Dashboard_Model extends CI_Model {
	
	public function getSalesPerYearPerMonth()
	{			$query=$this->db->query("SELECT YEAR(  `cashDeposit_slip_Date` ) AS SalesYear, MONTH(  `cashDeposit_slip_Date` ) AS SalesMonth, SUM( cashDeposit_slip_details_CalculatedAmount ) AS TotalSales FROM cashdeposit_slip c, cashdeposit_slip_details d WHERE c.`cashDeposit_slip_Id` = d.cashDeposit_slip_details_SlipId GROUP BY YEAR(  `cashDeposit_slip_Date` ) , MONTH(  `cashDeposit_slip_Date` ) ORDER BY YEAR(  `cashDeposit_slip_Date` ) , MONTH(  `cashDeposit_slip_Date` )");
				return $query->result_array();
	}
	public function getSalesCurrentDay()
	{			$query=$this->db->query("SELECT YEAR(  `cashDeposit_slip_Date` ) AS SalesYear, MONTH(  `cashDeposit_slip_Date` ) AS SalesMonth, SUM( cashDeposit_slip_details_CalculatedAmount ) AS TotalSales FROM cashdeposit_slip c, cashdeposit_slip_details d WHERE c.`cashDeposit_slip_Id` = d.cashDeposit_slip_details_SlipId AND DAY(cashDeposit_slip_Date) = DAY(NOW()) GROUP BY YEAR(  `cashDeposit_slip_Date` ) , MONTH(  `cashDeposit_slip_Date` ) ORDER BY YEAR(  `cashDeposit_slip_Date` ) , MONTH(  `cashDeposit_slip_Date` )");
				return $query->result_array();
	}
	
	public function getSalesPerConductorPerYearPerMonth()
	{			$query=$this->db->query("SELECT YEAR(  `cashDeposit_slip_Date` ) AS SalesYear, MONTH(  `cashDeposit_slip_Date` ) AS SalesMonth, cashDeposit_slip_ConductorEmpId, SUM( cashDeposit_slip_details_CalculatedAmount ) AS TotalSales FROM cashdeposit_slip c, cashdeposit_slip_details d WHERE c.`cashDeposit_slip_Id` = d.cashDeposit_slip_details_SlipId GROUP BY c.cashDeposit_slip_ConductorEmpId, YEAR(  `cashDeposit_slip_Date` ) , MONTH(  `cashDeposit_slip_Date` ) ORDER BY YEAR(  `cashDeposit_slip_Date` ) , MONTH(  `cashDeposit_slip_Date` ) ");
				return $query->result_array();
	}
	public function getSalesPerDutyPerYearPerMonth()
	{			$query=$this->db->query("SELECT YEAR(  `cashDeposit_slip_Date` ) AS SalesYear, MONTH(  `cashDeposit_slip_Date` ) AS SalesMonth, cashDeposit_slip_DutyId, SUM( cashDeposit_slip_details_CalculatedAmount ) AS TotalSales FROM cashdeposit_slip c, cashdeposit_slip_details d WHERE c.`cashDeposit_slip_Id` = d.cashDeposit_slip_details_SlipId GROUP BY c.cashDeposit_slip_DutyId, YEAR(  `cashDeposit_slip_Date` ) , MONTH(  `cashDeposit_slip_Date` ) ORDER BY YEAR(  `cashDeposit_slip_Date` ) , MONTH(  `cashDeposit_slip_Date` ) ");
				return $query->result_array();
	}
	
	public function getSalesPerTicketPerYearPerMonth()
	{			$query=$this->db->query("SELECT YEAR(  `cashDeposit_slip_Date` ) AS SalesYear, MONTH(  `cashDeposit_slip_Date` ) AS SalesMonth,  `cashDeposit_slip_details_TicketId` , SUM( cashDeposit_slip_details_CalculatedAmount ) AS TotalSales FROM cashdeposit_slip c, cashdeposit_slip_details d WHERE c.`cashDeposit_slip_Id` = d.cashDeposit_slip_details_SlipId GROUP BY  `cashDeposit_slip_details_TicketId` , YEAR(  `cashDeposit_slip_Date` ) , MONTH(  `cashDeposit_slip_Date` )  ORDER BY cashDeposit_slip_details_TicketId, YEAR(  `cashDeposit_slip_Date` ) , MONTH(  `cashDeposit_slip_Date` )");
				return $query->result_array();
	}
	public function getCountOfEmployeesPerType()
	{			$query=$this->db->query("SELECT COUNT(`Employee_Id`) AS VAL , Employee_Type FROM `employees` GROUP BY `Employee_Type`");
				return $query->result_array();
	}
	public function getCountOfAdminUsers()
	{			$query=$this->db->query("SELECT COUNT(Admin_Id) AS VAL  FROM `admin_users`  WHERE Admin_Id!=1 ");
				return $query->result_array();
	}
	public function getCountOfBusRoutes()
	{			$query=$this->db->query("SELECT COUNT(Bus_Routes_Id) AS VAL  FROM `bus_routes`");
				return $query->result_array();
	}
	public function getCountOfNoOfBusPerBusRoutes()
	{			$query=$this->db->query("SELECT COUNT(  `bus_timing_Id` ) AS COUNT, bus_timing_routeId FROM  `bus_timing` GROUP BY  `bus_timing_routeId` ");
				return $query->result_array();
	}
	
	public function getCountOfTodaysDutySlip(){
		$query=$this->db->query("SELECT COUNT( conductor_daysslip_Id ) AS dutySlip FROM  `conductor_daysslip` WHERE DATE(  `conductor_daysslip_date` ) = DATE( NOW( ) ) ");
				return $query->result_array();
		
	}
	
	public function getCountOfTodaysWayBillSlip(){
		$query=$this->db->query("SELECT COUNT( `cashDeposit_slip_Id` ) AS WayBillSlip FROM  `cashdeposit_slip` WHERE DATE(  `cashDeposit_slip_Date` ) = DATE( NOW( ) ) ");
				return $query->result_array();
		
	}
	
}
?>