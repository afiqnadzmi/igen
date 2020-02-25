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
 $sql = "select passport_expiry, work_permit_expirty, e_date_pk_fz,	e_date_westport,e_date_johor_port,e_date_ptp,e_date_tlp,notified,full_name, id from employee where emp_status='Active'";
 $result=mysql_query( $sql);
 
 //Get the information of the HR department
 $query_hr = mysql_query('SELECT u.a_hr, e.email, e.full_name FROM employee e, user_permission u WHERE e.level_id=u.id AND u.a_hr="a_hr_edit"');

 while ($rs = mysql_fetch_array($result)) {
	
	$passport_expiry=$rs['passport_expiry'];
	$work_permit_expirty=$rs['work_permit_expirty'];
	$e_date_pk_fz=$rs['e_date_pk_fz'];
	$e_date_westport=$rs['e_date_westport'];
	$e_date_johor_port=$rs['e_date_johor_port'];
	$e_date_ptp=$rs['e_date_ptp'];
	$e_date_tlp=$rs['e_date_tlp'];
	$notified=$rs['notified'];

	if($notified==0){
		
		//Notify HR Admin 90 days before the work permit of the employee expired
		if(strtotime($work_permit_expirty."-90 days") < time() && $work_permit_expirty !="0000-00-00"){
			 $subject = 'HR Notification (Work Permit Expiry)';
			while($row_hr = mysql_fetch_array($query_hr)){
				email($row_hr['full_name'],$rs['full_name'], $row_hr['email'], $subject, $rs['id']);
			 }
		}
		
		//Notify HR Admin 90 days before the Passport of the employee expired
		if(strtotime($passport_expiry."-90 days") < time() && $passport_expiry !="0000-00-00"){
			 $subject = 'HR Notification (Passport Expiry)';
			while($row_hr = mysql_fetch_array($query_hr)){
				email($row_hr['full_name'],$rs['full_name'], $row_hr['email'], $subject, $rs['id']);
			 }
		}
		//Notify HR Admin 90 days before the PK FZ pass of the employee expired
		if(strtotime($e_date_pk_fz."-90 days") < time() && $e_date_pk_fz !="0000-00-00"){
			 $subject = 'HR Notification (PK FZ Pass Expiry)';
			while($row_hr = mysql_fetch_array($query_hr)){
				email($row_hr['full_name'],$rs['full_name'], $row_hr['email'], $subject, $rs['id']);
			 }
		}
		//Notify HR Admin 90 days before the Westport pass of the employee expired
		if(strtotime($e_date_westport."-90 days") < time() && $e_date_westport !="0000-00-00"){
			 $subject = 'HR Notification (Westport Pass Expiry)';
			while($row_hr = mysql_fetch_array($query_hr)){
				email($row_hr['full_name'],$rs['full_name'], $row_hr['email'], $subject, $rs['id']);
			 }
		}
		//Notify HR Admin 90 days before the Johor Port pass of the employee expired
		if(strtotime($e_date_johor_port."-90 days") < time() && $e_date_johor_port !="0000-00-00"){
			 $subject = 'HR Notification (Johor Port Pass Expiry)';
			while($row_hr = mysql_fetch_array($query_hr)){
				email($row_hr['full_name'],$rs['full_name'], $row_hr['email'], $subject, $rs['id']);
			 }
		}
		
		//Notify HR Admin 90 days before the PTP pass of the employee expired
		if(strtotime($e_date_ptp."-90 days") < time() && $e_date_ptp !="0000-00-00"){
			 $subject = 'HR Notification (PTP Pass Expiry)';
			while($row_hr = mysql_fetch_array($query_hr)){
				email($row_hr['full_name'],$rs['full_name'], $row_hr['email'], $subject, $rs['id']);
			 }
		}
		
		//Notify HR Admin 90 days before the TPL pass of the employee expired
		if(strtotime($e_date_tlp."-90 days") < time() && $e_date_tlp !="0000-00-00"){
			 $subject = 'HR Notification (TPL Pass Expiry)';
			while($row_hr = mysql_fetch_array($query_hr)){
				email($row_hr['full_name'],$rs['full_name'], $row_hr['email'], $subject, $rs['id']);
			 }
		}
		
		
	}
 }
 
 //Send Email;
 function email($hr_name,$emp_name, $hr_email, $subject, $id){

	 	$msg = '<p>Dear ' . ucfirst($hr_name) . ',</p></br>';
		$msg.='<p> The work Permit of <B>'.ucfirst($emp_name).'</B> will expire within 90 days.</p>' ;
		$msg.='<p><i>*Please do not reply to this email as it is a computer generated email</i>.</p>'; 
		$msg.='<p>&nbsp</p>';
		$msg.='<p>&nbsp</p>';
		$msg.='<p><B>Sent By Biaduri HR Dept</B>.</br></br></p>' ;
		$msg.='<p>&nbsp</p>';
		$headers .= '<p>Content-type: text/html; charset=iso-8859-1' . "</p>"; 
		mailto($hr_email, $subject, $msg, $headers);
		//Set notified to 1 after email sent
		$sql = mysql_query('UPDATE employee SET notified="1" WHERE id='.$id);
	 		
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