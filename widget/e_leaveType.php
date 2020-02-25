<?php
/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn. Bhd. */
?>

<?php
$curr= date('Y');

$lat_year=date('Y', strtotime('-1 year'));
if ($_POST["emp_id"] == "0") {
    $emp_id = $_COOKIE['igen_user_id'];
} else {
    $emp_id = $_POST["emp_id"];
}

$leave_type_id = isset($_POST["leave_type_id"]) ? $_POST["leave_type_id"] : "";
$sql10 = "SELECT lt.type_name FROM leave_type lt where id='".$leave_type_id."'";
	
$rs10 = mysql_query($sql10);
 while ($row10 = mysql_fetch_array($rs10)) {
 $type_name=$row10['type_name'];
 }

$sql = "SELECT join_date,group_for_leave_id FROM employee e where e.id='" . $emp_id . "'";
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs);

$group_for_leave_id = $row["group_for_leave_id"];
$diff = abs(time(date("Y-m-d")) - strtotime($row["join_date"]));
$years = floor($diff / (365 * 60 * 60 * 24));
$y=date('Y', strtotime($row["join_date"]));
$m=date('m', strtotime($row["join_date"]));
$j_date=$row["join_date"];

$sql = "SELECT COALESCE(days,0) as days FROM leave_group lg
			where from_year<=" . $years . " and to_year>=" . $years . " and group_for_leave_id='" . $group_for_leave_id . "' 
			and leave_type_id='" . $leave_type_id . "'";
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs);
$total_leave = $row["days"];


$sql1 = "SELECT COALESCE(sum(num_days),0) as nd FROM employee_leave e 
			where emp_id='" . $emp_id . "' and leave_type_id='" . $leave_type_id . "' and request_status='Approved' AND Year(leave_date)='" . $curr . "'; ";
$rs1 = mysql_query($sql1);
$row1 = mysql_fetch_array($rs1);
$used_leave = $row1["nd"];
//Calculate the leave balance for the new employee

if($y==$curr){



if($m!=01){

$m=$m-1;
 


$used_leave=$used_leave +$m;
}

}


// Getting last year balance
$sql2="SELECT COALESCE(sum(num_days),0) as smd FROM employee_leave e 
			where emp_id='" . $emp_id . "' and leave_type_id='" . $leave_type_id . "' and request_status='Approved' AND Year(leave_date)='" . $lat_year . "';";
$rs2 = mysql_query($sql2);
$row2 = mysql_fetch_array($rs2);
$last_balance = $row2["smd"];

//Getting Balance for the year before last year
/*		
			   $sql_ba="SELECT * FROM leave_balance where emp_id='" . $emp_id . "' AND Date='" . $lat_year . "';";
                $rs_ba = mysql_query($sql_ba);
               $row_ba = mysql_fetch_array($rs_ba);
if($type_name=="Annual Leave"){
			 
   
			if($last_balance>=$row_ba['leave_balance']){
			
			$last_balance=$last_balance - $row_ba['leave_balance'];
			
			}
			}

*/
if($last_balance!="0.00"){
$last_balance=$total_leave - $last_balance;
}else{
if($y!=$curr){
$last_balance=$total_leave;
}


}

//add last year balance to used leave for the employee


if($y==$lat_year){
$m=date('m', strtotime($j_date));
	if($m!=01){
		$m=$m-1;
		$last_balance=$last_balance - $m ;
	}
}


// inserting last year balance into database if the leave is annual leave
/*if($type_name=="Annual Leave"){


$sql1 = mysql_query("SELECT * FROM leave_balance  WHERE emp_id='".$emp_id."' AND Date='".$curr."'");
                $sql_result1 = mysql_query($sql1);
               $count=mysql_num_rows($sql1);
			
			   if($count>0){
				$sql = "UPDATE leave_balance SET leave_balance='".$last_balance."' WHERE emp_id = '" . $emp_id . "' AND Date='".$curr."'" ;
        
                $sql_result = mysql_query($sql);
				
				}else{
			
	   	$sql = "INSERT INTO leave_balance (Date,leave_balance,emp_id) VALUES 
       ('" . $curr . "','" . $last_balance . "','" . $emp_id . "')";
				$query = mysql_query($sql);
				}
					
               
					
					
					}
*/
			
// Getting the carryForward of this year
$sql5="SELECT leave_balance as balance FROM leave_balance
			where emp_id='" . $emp_id . "' AND Date='".$curr."'";
$rs5 = mysql_query($sql5);
$row5 = mysql_fetch_array($rs5);
$carryForward = $row5["balance"];

if($type_name=="Annual Leave"){
	$total_leave=$total_leave + $carryForward;
}


echo ($total_leave - $used_leave);
?>

<?php
/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn. Bhd. */
?>