<?php
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
	

$uploaded_img=$_POST['uploaded_img']; 
$type_of_loan = htmlentities($_POST['type_of_loan'], ENT_QUOTES, "UTF-8");
$reason_for_loan = htmlentities($_POST['reason_for_loan'], ENT_QUOTES, "UTF-8");
$loan_amount = number_format($_POST['loan_amount'], 2, '.', '');
$installment = number_format($_POST['installment'], 2, '.', '');
$guarantor = $_POST['guarantor'];

$sql_dep = "select * from approval_m where (lv1='" .$emp_id . "' OR lv2='" .$emp_id . "' OR lv3='" .$emp_id . "') AND dep_id='".$depid."'";
    $rs_dep = mysql_query($sql_dep);
	$num_rows= mysql_num_rows($rs_dep);
	$row_dep = mysql_fetch_array($rs_dep);
	$a_emp = $row_dep['emp_id'];

$pending = "Pending";
$repay_month = $_POST['repay_month'];
$today = date("Y-m-d");
$start_date=date("Y-m-d");
$end_date = date('Y-m-d', strtotime("+".$repay_month."months", strtotime($start_date)));

$sql2 = "INSERT INTO employee_loan(type_of_loan,loan_amount,installment,reason_for_loan,guarantor,loan_status,emp_id, depid, start_date, end_date,rep_month,loan_date, img_path) VALUES
        ('$type_of_loan','$loan_amount','$installment','" . $reason_for_loan . "','" . $guarantor . "','" . $pending . "','" . $emp_id . "','" . $depid . "','" . $start_date. "','". $end_date. "','". $repay_month . "','" . $today . "','" . $uploaded_img . "');";
$query2 = mysql_query($sql2);

if ($query2) {
if($num_rows>0){
 $sql1 = "select * from employee  WHERE id='".$a_emp."'";
                            
    $rs1 = mysql_query($sql1);
   $subject = 'HR Application';
    if ($rs1 && mysql_num_rows($rs1) > 0) {
        while($row1 = mysql_fetch_array($rs1)){
		$email=$row1['email'];
		$full_name =$row1['full_name'];
		
        $msg = '<p>Dear ' . $full_name . ',</p>';
		$msg.='<p>&nbsp</p>';
        $msg.='<p> <B>'.$name.'</B>  has applied loan and is pending your approval.</p>';
		$msg.='<p>&nbsp</p>';
        $msg.='<p><i>*Do not reply to this email as this is a computer generated email.</i></p>'; 
		$msg.='<p>&nbsp</p>';
		$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
		 $msg.='<p>&nbsp</p>';
		$msg.= "<p><a href='http://myigen.com:8081/HR/igen'>Click here </a>, To login to ".$c_name." @WORK  </p>";
          $msg.='<p>&nbsp</p>';
      	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     
        // mailto($email, $subject, $msg, $headers);
	   
		}
		}
		}else{
	
			$sql1 = "select * from employee e, approval a WHERE (
			a.level_pos_1=e.id OR a.superior_1=e.id) AND a.dep_id='".$depid."'";
								
			$rs1 = mysql_query($sql1);
			$subject = 'HR Application';
			if ($rs1 && mysql_num_rows($rs1) > 0) {
				while($row1 = mysql_fetch_array($rs1)){
					$email=$row1['email'];
					$full_name =$row1['full_name'];
					
					$msg = '<p>Dear '. $full_name .',</p>';
					$msg.='<p>&nbsp</p>';
					$msg.='<p> <B>'.$name.'</B>  has applied loan and is pending your approval.</p>';
					$msg.='<p>&nbsp</p>';
					$msg.='<p><i>*Do not reply to this email as this is a computer generated email.</i></p>'; 
					$msg.='<p>&nbsp</p>';
					$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
					 $msg.='<p>&nbsp</p>';
					$msg.= "<p><a href='http://myigen.com:8081/HR/igen'>Click here </a>, To login to ".$c_name." @WORK  </p>";
					  $msg.='<p>&nbsp</p>';
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				 
				   //mailto($email, $subject, $msg, $headers);
				   
			
				}
			}
		
			print true;
}
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