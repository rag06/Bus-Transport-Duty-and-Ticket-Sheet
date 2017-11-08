<?php
Class Dashboard_Model extends CI_Model {
	
	public function getSalesPerYearPerMonth()
	{			$query=$this->db->query("SELECT YEAR(  `cashDeposit_slip_Date` ) AS SalesYear, MONTH(  `cashDeposit_slip_Date` ) AS SalesMonth, SUM( cashDeposit_slip_details_CalculatedAmount ) AS TotalSales FROM cashdeposit_slip c, cashdeposit_slip_details d WHERE c.`cashDeposit_slip_Id` = d.cashDeposit_slip_details_SlipId GROUP BY YEAR(  `cashDeposit_slip_Date` ) , MONTH(  `cashDeposit_slip_Date` ) ORDER BY YEAR(  `cashDeposit_slip_Date` ) , MONTH(  `cashDeposit_slip_Date` )");
				return $query->result_array();
	}
	
	public function getSalesPerRoutePerYearPerMonth()
	{			$query=$this->db->query("SELECT YEAR(  `cashDeposit_slip_Date` ) AS SalesYear, MONTH(  `cashDeposit_slip_Date` ) AS SalesMonth, cashDeposit_slip_RouteId, SUM( cashDeposit_slip_details_CalculatedAmount ) AS TotalSales FROM cashdeposit_slip c, cashdeposit_slip_details d WHERE c.`cashDeposit_slip_Id` = d.cashDeposit_slip_details_SlipId GROUP BY c.cashDeposit_slip_RouteId, YEAR(  `cashDeposit_slip_Date` ) , MONTH(  `cashDeposit_slip_Date` ) ORDER BY YEAR(  `cashDeposit_slip_Date` ) , MONTH(  `cashDeposit_slip_Date` ) ");
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
	
}
?>