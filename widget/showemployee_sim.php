<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$dep_id=$_GET['departments'];

//$_POST['branches']
//$data1="";
if($_GET['action']=="ot"){
	$data1='<option value="0">--Please Select--</option>';
	$data1.='<option value="All">All Employee</option>';
	if($dep_id!="ALL"){
		$sql = "select * from employee where emp_status = 'Active' AND dep_id in($dep_id) AND branch_id =".$_GET['branches'];
	}else{
		$sql = "select * from employee where emp_status = 'Active' AND branch_id =".$_GET['branches'];
	}
	$result = mysql_query($sql);
	while ($rs = mysql_fetch_array($result)) {
		$data1.='<option value="' . $rs["id"] . '">' . $rs["full_name"] . '</option>';
	}
	$data = array('data1' => $data1);
	print json_encode($data);
}else{
	$data1='<option value="0">--Please Select--</option>';
	$sql = "select * from employee where emp_status = 'Active' AND dep_id in($dep_id) AND branch_id =".$_GET['branches'];
	$result = mysql_query($sql);
	while ($rs = mysql_fetch_array($result)) {
		$data1.='<option value="' . $rs["id"] . '">' . $rs["full_name"] . '</option>';
	}

	//Allowance and Claim
	$data2='<option value="0">--Please Select--</option>';
	if($_GET['action']=="claim"){//Claim Payroll
		$sql_claim = "select * from claim_payroll";
		$sql_claim = mysql_query($sql_claim);
		while ($rs_claim = mysql_fetch_array($sql_claim)) {
			  $data2.='<option value="' . $rs_claim["id"] . '">' . $rs_claim["claim_name"] . '</option>';
		}
	}else{//Allowance Payroll
	  if($_GET['types']==1){// Allowance
		   if($_GET['type']==0){
			   $sql_allowance = "select * from allowance";
		   }else{
			   $sql_allowance = "select * from allowance where allowance_type=".$_GET['type'];
		   }
			$result_allowance = mysql_query($sql_allowance);
			while ($rs_allowance = mysql_fetch_array($result_allowance)) {
				  $data2.='<option value="' . $rs_allowance["id"] . '">' . $rs_allowance["allowance_name"] . '</option>';
			}
	  }else{// Deduction
		   if($_GET['type']==0){
			   $sql_deduction = "select * from deduction_payroll";
		   }else{
			   $sql_deduction = "select * from deduction_payroll where deduction_type=".$_GET['type'];
		   }
			$result_deduction = mysql_query($sql_deduction);
			while ($rs_deduction = mysql_fetch_array($result_deduction)) {
				  $data2.='<option value="' . $rs_deduction["id"] . '">' . $rs_deduction["deduction_name"] . '</option>';
			}
	  }
	}

	$data = array('data1' => $data1, 'data2' => $data2);
	print json_encode($data);
}
?>
  