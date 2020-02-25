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
$sql = "select * from employee where id='" .$user_id . "' limit 1";
    $rs = mysql_query($sql);

    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
		$depid=$row['dep_id'];
		$full_name= $row['full_name'];
		}
		$emp_id = $_POST["emp_id"];
$sql3 = "SELECT * FROM employee WHERE
                            id=" . $emp_id ;
                    $rs3 = mysql_query($sql3);
					$count1= mysql_num_rows($sql3);
					
					
                  while($row3= mysql_fetch_array($rs3)){
				  $dep=$row3['dep_id'];
				  $name=$row3['full_name'];
				  $email=$row3['email'];
				  }
$status = isset($_POST['status']) ? $_POST['status'] : "";
$id = isset($_POST['id']) ? $_POST['id'] : "";


if($status=="Approved"){

$sql2 = "SELECT * FROM approval WHERE dep_id=".$dep."
                            AND (superior_1=" . $user_id
                            . " OR superior_2=" . $user_id . " OR superior_3=" . $user_id . ")";
                    $rs2 = mysql_query($sql2);
					$count= mysql_num_rows($sql2);
					
					
                  while($row2 = mysql_fetch_array($rs2)){
				    
					$superv1=$row2["superior_1"];
					$superv2=$row2["superior_2"];
					$superv3=$row2["superior_3"];
					$sql1 = "select * from employee where id='" .$superv1 . "' limit 1";
                   $rs1 = mysql_query($sql1);
				    $row10 = mysql_fetch_array($rs1);
					$email1=$row10['email'];
					
					$sql3 = "select * from employee where id='" .$superv2 . "' limit 1";
                   $rs3 = mysql_query($sql3);
				    $row11 = mysql_fetch_array($rs3);
					$email2=$row11['email'];
					 
					$sql4 = "select * from employee where id='" .$superv3 . "' limit 1";
                   $rs4 = mysql_query($sql4);
				    $row12 = mysql_fetch_array($rs4);
					$email3=$row12['email'];
					
					if($user_id==$superv1){
					 
					if($user_id==$superv2){
					if($user_id==$superv3){
					
					
					$status="Approved";
					/*
				   $msg = 'Dear All ,<br>';
        $msg.='The loan application From  '.$name.' has been approved by '.$full_name.'.<br>' ;
        $msg.='Do not reply to this email as this was a computer generated email.<br>'; 
		$msg.= "Please login using following address: http://myigenios.com:8081/HR/simplysiti/ <br>";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
        
		 mailto($email2, $subject, $msg, $headers);
		  mailto($email3, $subject, $msg, $headers);
					*/
					}else{
					

        		$msg = 'Dear Sir/Madam ,<br>';
        $msg.='There is a Movement application From"'.$name.'"  and is waiting for your approval.  <br> ';
        $msg.='Do not reply to this email as this was a computer generated email. <br>'; 
		$msg.= "Please login using following address: http://myigenios.com:8081/HR/simplysiti/ <br>";
     
        	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     
        
		 mailto($email3, $subject, $msg, $headers);
					}
					
					
					}else{
					
					$status="Approved_lv1";
										

								
        		$msg = 'Dear Sir/Madam ,<br>';
        $msg.='There is a Movement application From"'.$name.'"  and is waiting for your approval.  <br> ';
        $msg.='Do not reply to this email as this was a computer generated email. <br>'; 
		$msg.= "Please login using following address: http://myigenios.com:8081/HR/simplysiti/ <br>";
     
        	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     
        
		 mailto($email2, $subject, $msg, $headers);
					
					}
					
					
					}else if($user_id==$superv2){
					
					if($user_id==$superv3){
					
					$status="Approved";
						   $msg = 'Dear All , <br>';
        $msg.='The Movement application From  '.$name.' has been approved by '.$full_name.'.<br>' ;
        $msg.='Do not reply to this email as this was a computer generated email.<br>'; 
		$msg.= "Please login using following address: http://myigenios.com:8081/HR/simplysiti/ <br>";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
         
		 mailto($email1, $subject, $msg, $headers);
		 
					
					}else{
					$status="Approved_lv2";
					$msg = 'Dear Sir/Madam ,<br>';
        $msg.='There is a Movement application From"'.$name.'"  and is waiting for your approval.  <br> ';
        $msg.='Do not reply to this email as this was a computer generated email. <br>'; 
		$msg.= "Please login using following address: http://myigenios.com:8081/HR/simplysiti/ <br>";
     
        	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
		 mailto($email3, $subject, $msg, $headers);
					}
					
					
					}else{
					
					$status="Approved";
									   $msg = 'Dear All ,<br>';
        $msg.='The Movement application From  '.$name.' has been approved by '.$full_name.'.<br>' ;
        $msg.='Do not reply to this email as this was a computer generated email.<br>'; 
		$msg.= "Please login using following address: http://myigenios.com:8081/HR/simplysiti/ <br>";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
        
		 mailto($email1, $subject, $msg, $headers);
		  mailto($email2, $subject, $msg, $headers);
					}
					
					
					}
					
					
}




$sql = 'UPDATE employee_movement SET request_status	= "' . $status . '" WHERE id = ' . $id . ';';
$sql_result = mysql_query($sql);

if ($sql_result) {
if ($status == "Approved"){
	 $msg = 'Dear ' . $name . ',';
        $msg.='Your Movement application has been approved by '.$full_name.'.<br>' ;
        $msg.='Do not reply to this email as this was a computer generated email.<br>'; 
		$msg.= "Please login using following address: http://myigenios.com:8081/HR/simplysiti/ <br>";
		}
		if ($status == "Rejected") {
	    $msg = 'Dear ' . $name . ',';
        $msg.='Your Movement application has been Rejected by  '.$full_name.'. <br>' ;
        $msg.='Do not reply to this email as this was a computer generated email. <br>'; 
		$msg.= "Please login using following address: http://myigenios.com:8081/HR/simplysiti/ <br>";
      
	   
	   }
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
	  
       mailto($email, $subject, $msg, $headers);
    $query_status = "true";
} else {
    $query_status = "false";
}

$data = array('query' => $query_status, 'status' => $status);
print json_encode($data);
?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>