<?php	
//echo $upload_id;
$curr= date('Y');// current Year
$lat_year=date('Y', strtotime('-1 year')); // Last Year
$sql1 = "select join_date,group_for_leave_id from employee where emp_status='Active' and id=".$upload_id; //Select active employee
$rs1 = mysql_query($sql1);
while($row1 = mysql_fetch_array($rs1)){
$join_date = $row1["join_date"];
$emp_id1=$row1["id"];
$group_for_leave_id = $row1["group_for_leave_id"];

//search employee got what kind of leave
/*$sql = "SELECT distinct(lt.id), lt.type_name FROM employee e
		 left join leave_group lg on lg.group_for_leave_id=e.group_for_leave_id
		 left join leave_type lt on lg.leave_type_id=lt.id
		 where e.id=" . $emp_id1;
		 $rs = mysql_query($sql);
		 $row = mysql_fetch_array($rs);*/
		 $Anual_leave_id=1;
		 $join_date="2018-02-10";
		 $work_year = floor((time(date("Y-m-d")) - strtotime($join_date)) / (365 * 24 * 60 * 60));
		 
		 $lastYear_work_year=0;
         if($work_year > 0){
			 $lastYear_work_year=$work_year - 1
		 }
			
			//Last Year Entitlement Days based on working years
			$sql3 = "SELECT days FROM leave_group l where from_year<=" . $lastYear_work_year . " and to_year>=" . $lastYear_work_year . " and leave_type_id='" .$Anual_leave_id. "' and group_for_leave_id=" . $group_for_leave_id;
			$rs3 = mysql_query($sql3);
			$row3 = mysql_fetch_array($rs3);
			$lastYear_entitlement = $row3['days'];
			
			//This Year Entitlement Days based on working years
			$sql_curr = "SELECT days FROM leave_group l where from_year<=" . $lastYear_work_year . " and to_year>=" . $lastYear_work_year . " and leave_type_id='" .$Anual_leave_id. "' and group_for_leave_id=" . $group_for_leave_id;
			$rs_curr = mysql_query($sql_curr);
			$row_curr = mysql_fetch_array($rs_curr);
			$thisYear_entitlement = $row_curr['days'];
			
			 //Getting employee last year balance	
			 $lastYear_balance="0.00";
			$sql2="SELECT COALESCE(sum(num_days),0) as smd FROM employee_leave e 
			where emp_id='" . $emp_id1 . "' and leave_type_id='" . $Anual_leave_id . "' and request_status='Approved' AND Year(leave_date)='" . $lat_year . "';";
			$rs2 = mysql_query($sql2);
			while($row2 = mysql_fetch_array($rs2)){
					$lastYear_balance = $lastYear_balance + $row2["smd"] ;
			}
			
			// Getting the last year carry forward
			$sql5="SELECT leave_balance as balance FROM leave_balance
						where emp_id='" . $emp_id1 . "' AND Date='".$lat_year."'";
			$rs5 = mysql_query($sql5);
			$row5 = mysql_fetch_array($rs5);
			$last_balance = $row5["balance"];
			
			//update the leave entitlement by adding last year carry forward
			$lastYear_entitlement=$lastYear_entitlement + $last_balance 
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
			if($lastYear_balance!='0.00'){
				$carry_forward=$lastYear_entitlement - $lastYear_balance - $m_last;
			}else{
				$carry_forward=$lastYear_entitlement - $m_last;
			}
			
			
			
echo "Test".$work_year ;
}
		 
?>