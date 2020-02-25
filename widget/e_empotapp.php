<?php
session_start();
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
error_reporting(0);
include "plugins/mailer/mailapp.php";
if ($_POST["emp_id"] == "0") {
    $emp_id = $_COOKIE['igen_user_id'];
} else {
    $emp_id = $_POST['emp_id'];
}
$sql_c = "select * from company";
$rs_c = mysql_query($sql_c);
$row_c= mysql_fetch_array($rs_c);
$c_name=$row_c['name'];
$sql = "select * from employee where id='" .$emp_id . "' limit 1";
    $rs = mysql_query($sql);

    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
		$depid=$row['dep_id'];
		$name= $row['full_name'];
		}
		


$today = date("Y-m-d");
$from_time = $_POST['from_time1'] . ':' . $_POST['from_time2'];
$to_time = $_POST['to_time1'] . ':' . $_POST['to_time2'];
$date = $_POST['date'];
$status = "Pending";

$total = (strtotime($to_time) - strtotime($from_time)) / 60;

$sql = "INSERT INTO employee_overtime(emp_id,depid, ot_date,request_date,from_time,to_time,ot_status,total_minutes)
        VALUES (" . $emp_id . "," . $depid . ",'" . date('Y-m-d', strtotime($date)) . "','" . $today . "','" . $from_time . "','" . $to_time . "','" . $status . "','" . $total . "')";
$query = mysql_query($sql);
if ($query) {
 $sql1 = "select * from employee e, approval a WHERE (
		a.level_pos_1=e.id OR a.superior_1=e.id ) AND a.dep_id='".$depid."'";
                            
    $rs1 = mysql_query($sql1);
   $subject = 'HR Application';
    if ($rs1 && mysql_num_rows($rs1) > 0) {
        while($row1 = mysql_fetch_array($rs1)){
		$email=$row1['email'];
		$full_name =$row1['full_name'];
	
		
      
			$msg = '<p>Dear ' . $full_name . ',</p>';
			$msg.='<p>&nbsp</p>';
			$msg.='<p> <B>'.$name.'</B> has applied Over Time and is pending your approval.<br>' ;
			$msg.='<p>&nbsp</p>';
			$msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
			$msg.='<p>&nbsp</p>';
			$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
			$msg.='<p>&nbsp</p>';
			$msg.= "<p><a href='http://myigen.com:8686/hr-demo'>Click here </a>, To login to ".$c_name." @WORK  </p>";
			$msg.='<p>&nbsp</p>';
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "<br>"; 
			//mailto($email, $subject, $msg, $headers);
		
		}
		}
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