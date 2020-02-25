<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

/*This function is to send notification to the HR department regarding the expiry of passport and port passes*/
 include "plugins/mailer/mailapp.php";
 //Get the employee information
 $sql = "select a.evaluation_from, a.evaluation_to,a.type_evaluation,a.notified, a.id as aid, e.full_name from employee e inner join appriasal_personal_info a on a.emp_id=e.id where e.emp_status='Active'";
 $result=mysql_query( $sql);
 
 //Get the information of the HR department
 $query_hr = mysql_query('SELECT u.a_hr, e.email, e.full_name FROM employee e, user_permission u WHERE e.level_id=u.id AND u.a_hr="a_hr_edit"');

 while ($rs = mysql_fetch_array($result)) {
	
	$type_evaluation=$rs['type_evaluation'];
	$evaluation_from=$rs['evaluation_from'];
	$evaluation_to=$rs['evaluation_to'];
	$app_id=$rs['aid'];
	$notified=$rs['notified'];

	if($notified==0){
		
		//Notify HR Admin 60 days before the Probation Peroid of the employee expired
		if($type_evaluation=="Probationary"){
			if(strtotime($evaluation_to."-60 days") < time() && $evaluation_to !="0000-00-00"){
				 $subject = 'HR Notification (Probation)';
				 $msg1="The probation peroid of";
				 $msg2="60";
				while($row_hr = mysql_fetch_array($query_hr)){
					email($row_hr['full_name'],$rs['full_name'], $row_hr['email'], $subject, $app_id,$msg1,$msg2);
				 }
			}
		}
		//Notify HR Admin 30 days before the first review of the employee probation expired
		if($type_evaluation=="First Review"){
			if(strtotime($evaluation_to."-30 days") < time() && $evaluation_to !="0000-00-00"){
				 $subject = 'HR Notification (First Review)';
				 $msg1="The first review(probation) of";
				 $msg2="30";
				while($row_hr = mysql_fetch_array($query_hr)){
					email($row_hr['full_name'],$rs['full_name'], $row_hr['email'], $subject, $app_id,$msg1,$msg2);
				 }
			}
		}
		//Notify HR Admin 30 days before the second review of the employee probation expired
		if($type_evaluation=="Second Review"){
			if(strtotime($evaluation_to."-30 days") < time() && $evaluation_to !="0000-00-00"){
				 $subject = 'HR Notification (Second Review)';
				 $msg1="The second review(probation) of";
				 $msg2="30";
				while($row_hr = mysql_fetch_array($query_hr)){
					email($row_hr['full_name'],$rs['full_name'], $row_hr['email'], $subject, $app_id,$msg1,$msg2);
				 }
			}
		}
	}
 }
 
 //Send Email;
 function email($hr_name,$emp_name, $hr_email, $subject, $id,$msg1,$msg2){

	 	$msg = '<p>Dear ' . ucfirst($hr_name) . ',</p></br>';
		$msg.='<p>'.$msg1.' <B>'.ucfirst($emp_name).'</B> will expire within '.$msg2.' days.</p>' ;
		$msg.='<p><i>*Please do not reply to this email as it is a computer generated email</i>.</p>'; 
		$msg.='<p>&nbsp</p>';
		$msg.='<p>&nbsp</p>';
		$msg.='<p><B>Sent By Biaduri HR Dept</B>.</br></br></p>' ;
		$msg.='<p>&nbsp</p>';
		$headers .= '<p>Content-type: text/html; charset=iso-8859-1' . "</p>"; 
		mailto($hr_email, $subject, $msg, $headers);
		//Set notified to 1 after email sent
		$sql = mysql_query('UPDATE appriasal_personal_info SET notified="1" WHERE id='.$id);
	 		
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