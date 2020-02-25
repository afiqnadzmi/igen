<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

$allowance_type= $_POST['allowance_type'];//Allowance Types: Fixed & Evolved
$type= $_POST['type'];//Allowance & Claim
$str = substr($_POST['str'], 0, -1);
$date=$_POST['date'];
$claim_date=date("Y-m-d", strtotime($_POST['claim_date']));
$claim_insert_date=date('Y-m-d');
$parts = explode(' ',$date);
$month = $parts[0];
$year = $parts[1];
$str_arr = explode(";", $str);
$created_by="";

if($_COOKIE['igen_id']!=""){
	$created_by=$_COOKIE['igen_id'];
}else if($_COOKIE['igen_user_id']!=""){
	$created_by=$_COOKIE['igen_user_id'];
}


foreach ($str_arr as $s) {
    $s_arr = explode(",", $s);
    $employee_id = $s_arr[0];
    $allowance_id = $s_arr[1];//allowance and claim ID
    $allowance_amount = trim($s_arr[2]); //Allowance & Claim amount
	$claim_number=$s_arr[3];
	$claim_title=$s_arr[4];
	$require_approval=$s_arr[5];
	if($require_approval=="Yes"){
		$claim_action="Pending";
		// Get employee department id : Approval Purpose
		$sql1 = "SELECT dep_id FROM employee  where id=" . $employee_id;
         $rs1 = mysql_query($sql1);
         $row1 = mysql_fetch_array($rs1);
		 $dep_id=$row1['dep_id'];
	}else{
		$claim_action="Approved";
		 $dep_id="0";
	}

    //$allowance_amount = $s_arr[3];
	
	 if($type==1){//Allowance
		if($allowance_type==1){
				$sql_result1 = mysql_query("DELETE FROM employee_allowance WHERE emp_id='" . $employee_id . "' AND allowance_id='".$allowance_id."'");
				$sql2 = "INSERT INTO employee_allowance(allowance_id, emp_id)
					 VALUES ('" . $allowance_id . "','" . $employee_id . "')";
			}else{
				$sql_result1 = mysql_query("DELETE FROM employee_evallowance WHERE emp_id='" . $employee_id . "' AND allowance_id='".$allowance_id."' AND month='".$month."' AND year='".$year."'");
				$sql2 = "INSERT INTO employee_evallowance(allowance_id, emp_id,	allowance_amount, year, month)
					 VALUES ('" . $allowance_id . "','" . $employee_id . "','" . $allowance_amount . "','" . $year . "','" . $month . "')";
			}
			
	}else if($type==2){// Claim
				$sql_result1 = mysql_query("DELETE FROM employee_claim WHERE emp_id='" . $employee_id . "' AND claim_id='".$allowance_id."' AND MONTH(insert_date)='".date('m')."' AND YEAR(insert_date)='".date('Y')."'");
				$sql2 = "INSERT INTO employee_claim(claim_item_title,claim_no,amount,claim_date,insert_date, emp_id,depid,claim_id, claim_status, require_approval, created_by)
				 VALUES ('" . $claim_title . "','" . $claim_number . "','" . $allowance_amount . "','" . $claim_date . "','" . $claim_insert_date . "','" . $employee_id . "','" . $dep_id . "','" . $allowance_id . "','".$claim_action."','".$require_approval."','".$created_by."')";
	}else if($type==3){ //Deduction
			if($allowance_type==1){
				$sql_result1 = mysql_query("DELETE FROM employee_deduction WHERE emp_id='" . $employee_id . "' AND deduction_id='".$allowance_id."' AND type='".$allowance_type."'");
				$sql2 = "INSERT INTO employee_deduction(deduction_id, emp_id, deduction_amount, type)
					 VALUES ('" . $allowance_id . "','" . $employee_id . "','" . $allowance_amount . "','" . $allowance_type . "')";
			}else{
				$sql_result1 = mysql_query("DELETE FROM employee_deduction WHERE emp_id='" . $employee_id . "' AND deduction_id='".$allowance_id."' AND type='".$allowance_type."' AND month='".$month."' AND year='".$year."'");
				$sql2 = "INSERT INTO employee_deduction(deduction_id, emp_id,deduction_amount,type,year, month)
					 VALUES ('" . $allowance_id . "','" . $employee_id . "','" . $allowance_amount . "','" . $allowance_type . "','" . $year . "','" . $month . "')";
			}
			
	}
	mysql_query($sql2);
}

if ($sql2) {
    echo true;
} else {
    echo false;
}

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>