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
$user_id = $_COOKIE["igen_user_id"];
$subject = 'HR Application'; 


$dep_id = $_POST['dep_id'];
$emp_id = $_POST['new_all_id'];
$form = $_POST['in_type'];
$evaluator = $_POST['in_by'];
$eva_name="";
$count=1;
//Getting the list employee to appraise
	 $sql = 'SELECT e.full_name, e.id, e.email FROM employee e WHERE  e.id IN('.$emp_id.') OR e.id='.$evaluator;
							   $query = mysql_query($sql);
										while ($row_dep = mysql_fetch_array($query))
										{
										if($row_dep['id']==$evaluator){
										
										$ev_email=$row_dep['email'];
										$eva_name=$row_dep['full_name'];
										}
										if($row_dep['id']!=$evaluator){
										 $emp_list.=$count.". ".$row_dep['full_name']."</br>";
										 $count++;
										 }
										 }
// Getting the company name
		$sql_c = "select * from company";
		$rs_c = mysql_query($sql_c);
		$row_c= mysql_fetch_array($rs_c);
		$c_name=$row_c['name'];

//Creating appraisal Cycle
		$sql = "INSERT INTO appraisal_cycle (dep_id,form_id,evaluator,employee) VALUES 
			   ('" . $dep_id . "','" . $form . "','" . $evaluator . "','". $emp_id . "')";
			  
		$query = mysql_query($sql);
		if ($query) {
			  $msg = '<P>Dear ' . $eva_name . ',</p>';
			 
				$msg.='<p>&nbsp</p>';
				$msg.='<P>You have this list to appraise </p><p><B>'.$emp_list.'</B>.</P>' ;
				 $msg.='<p>&nbsp</p>';
				$msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
				 $msg.='<p>&nbsp</p>';
				$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
				 $msg.='<p>&nbsp</p>';
				$msg.= "<p><a href='http://myigen.com:8081/HR/igen/'> Click here </a>, To login to ".$c_name." @WORK  </p>";
				 $msg.='<p>&nbsp</p>';
				 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
				 mailto($ev_email, $subject, $msg, $headers);
		echo true;

		}
?>
