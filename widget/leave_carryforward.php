<?php


/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn.
  Bhd. */


	
	//This function is calculate the leave carryforward

	$curr= date('Y');// current Year
	$lat_year=date('Y', strtotime('-1 year')); // Last Year
	$sql1 = "select join_date,group_for_leave_id, id from employee where emp_status='Active'"; //Select active employee
	$rs1 = mysql_query($sql1);
	while($row1 = mysql_fetch_array($rs1)){
		$join_date = $row1["join_date"];
		$emp_id1=$row1["id"];
		$group_for_leave_id = $row1["group_for_leave_id"];
		$Anual_leave_id=1;
		$work_year = floor((time(date("Y-m-d")) - strtotime($join_date)) / (365 * 24 * 60 * 60));
		$lastYear_work_year=0;
		if($work_year > 0){
		$lastYear_work_year=$work_year - 1;
		}			
		//Last Year Entitlement Days based on working years
		$sql3 = "SELECT days FROM leave_group l where from_year<=" . $lastYear_work_year . " and to_year>=" . $lastYear_work_year . " and leave_type_id='" .$Anual_leave_id. "' and group_for_leave_id=" . $group_for_leave_id;
		$rs3 = mysql_query($sql3);
		$row3 = mysql_fetch_array($rs3);
		$lastYear_entitlement = $row3['days'];
		$carry_forward=0;
		$sql_leave = "SELECT id FROM employee_leave where request_status='Approved' AND Year(leave_date)='" . $lat_year . "';";
		$rs_leave = mysql_query($sql_leave);
					
		if ($rs_leave && mysql_num_rows($rs_leave) > 0) {// run the following code if the leave application has been used
			//Getting employee last year balance	
			$lastYear_balance="0.00";
			$sql2="SELECT COALESCE(sum(num_days),0) as smd FROM employee_leave e 
			where emp_id='" . $emp_id1 . "' and leave_type_id='" . $Anual_leave_id . "' and request_status='Approved' AND Year(leave_date)='" . $lat_year . "';";
			$rs2 = mysql_query($sql2);
			while($row2 = mysql_fetch_array($rs2)){
				$lastYear_balance = $lastYear_balance + $row2["smd"] ;
			}
			// Getting the last year carry forward
			$sql5="SELECT leave_balance as balance FROM leave_balance where emp_id='" . $emp_id1 . "' AND Date='".$lat_year."'";
			$rs5 = mysql_query($sql5);
			$row5 = mysql_fetch_array($rs5);
			$last_balance = $row5["balance"];

			//update the leave entitlement by adding last year carry forward
			$lastYear_entitlement=$lastYear_entitlement + $last_balance;
			//Leave entitlent for the employee joined mid year
			$y=date('Y', strtotime($join_date ));
			$m_last=0;
			if($y ==$lat_year){
				$m_last=date('m', strtotime($join_date));
				if($m_last!=01){
					$m_last=$m_last-1;
				}
			}
							
			//This year carry forward
			if($lastYear_balance!='0'){
				$carry_forward=$lastYear_entitlement - $lastYear_balance - $m_last;
			}else{
				$carry_forward=$lastYear_entitlement - $m_last;
			}

			if($carry_forward >= 5){
				$carry_forward=5;//Limit to five days 
			}else if($carry_forward < 5 && $carry_forward > 0){
				$carry_forward=$carry_forward; 
			}else{
				$carry_forward=0;
			} 
							
			//Insert this year Carry forward if it has not been already inserted
			// Getting from the leave blance to check if this year leave blance has been inserted
			$sql_lb="SELECT leave_balance as balance FROM leave_balance where emp_id='" . $emp_id1 . "' AND Date = '".$curr."'";
			$rs_lb = mysql_query($sql_lb);
			if ($rs_lb && mysql_num_rows($rs_lb) > 0) {
			}else{
				$sql_cforward =  mysql_query("INSERT INTO leave_balance(Date, leave_balance, emp_id)
				VALUES ('" . $curr . "','" . $carry_forward . "','" . $emp_id1 . "')");
			}

		}
				
				
	}
		 

?>