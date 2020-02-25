<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$str_arr = explode(";", $_POST['str']);

foreach ($str_arr as $s) {
	
    $s_arr = explode(",", $s);
	//echo  $s_arr[0].":".$s_arr[1];
    $employee_id = $s_arr[0];
    $holiday_rate = $s_arr[1];//allowance and claim ID
    $normal_rate = $s_arr[2]; //Allowance & Claim amount
	$resting_day=$s_arr[3];
	$week_end_rate=$s_arr[4];
	$cub=$s_arr[5];
	if(!empty($_POST['department'])){
		if($_POST['department']!="ALL"){
			$sql_emp = "select * from employee  where emp_status = 'Active' AND dep_id in(".$_POST['department'].") AND branch_id = " .$_POST['branches'];
		}else{
			$sql_emp = "select * from employee  where emp_status = 'Active' AND branch_id = " . $_POST['branches'];
		}
		$result = mysql_query($sql_emp);
		while ($rs = mysql_fetch_array($result)) {
            $sql_delete = 'DELETE FROM overtime WHERE emp_id=' . $rs['id']. '';
			$query_delete = mysql_query($sql_delete);			
			$sql = "INSERT INTO overtime(emp_id,week_end_rate,holiday_rate,normal_rate,cub)
				VALUES ('" . $rs['id'] . "','" . $week_end_rate . "','" . $holiday_rate . "','" . $normal_rate . "' ,'" . $resting_day . "','" . $cub . "')";
			$query = mysql_query($sql);
		}
		
	}else{
		$sql_delete = 'DELETE FROM overtime WHERE emp_id=' . $employee_id. '';
			$query_delete = mysql_query($sql_delete);			
			$sql = "INSERT INTO overtime(emp_id,week_end_rate,holiday_rate,normal_rate, resting_day,cub)
				VALUES ('" . $employee_id . "','" . $week_end_rate . "','" . $holiday_rate . "','" . $normal_rate . "' ,'" . $resting_day . "','" . $cub . "')";
			$query = mysql_query($sql);
	}
}

	if ($query) {
		print true;
	} else {
		print false;
	}
?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>