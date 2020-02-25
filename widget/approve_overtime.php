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
$id = $_GET['id'];
$emp_id = $_GET['eid'];
$status = $_GET['status'];
$sql = "select * from employee where id='" .$user_id . "' limit 1";
    $rs = mysql_query($sql);

    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
		$depid=$row['dep_id'];
		$full_name= $row['full_name'];
		}
$sql_c = "select * from company";
$rs_c = mysql_query($sql_c);
$row_c= mysql_fetch_array($rs_c);
$c_name=$row_c['name'];


$sql_3 = "SELECT * FROM employee_overtime WHERE
                            id=" . $id ;
                    $rs_3 = mysql_query($sql_3);
					$count_1= mysql_num_rows($sql_3);
$row_3= mysql_fetch_array($rs_3);
$a_status = $row_3['ot_status'];



$sql3 = "SELECT * FROM employee WHERE
                            id=" . $emp_id ;
                    $rs3 = mysql_query($sql3);
					$count1= mysql_num_rows($sql3);
					
					
                  while($row3= mysql_fetch_array($rs3)){
				  $dep=$row3['dep_id'];
				  $name=$row3['full_name'];
				  $email=$row3['email'];
				  }
				  
	$sql_dep = "select * from approval_m where (emp_id='" .$user_id. "' OR backup='" .$user_id. "') AND (lv1='".$emp_id."' OR lv2='".$emp_id."' OR lv3='".$emp_id."')";
    $rs_dep = mysql_query($sql_dep);
	$num_rows= mysql_num_rows($rs_dep);	

	
if($status=="Approved"){

if($num_rows==0){

$sql2 = "SELECT * FROM approval WHERE dep_id=".$dep."
                            AND (superior_1=" . $user_id
                            . " OR superior_2=" . $user_id . " OR superior_3=" . $user_id . " OR level_pos_1=". $user_id." OR level_pos_2=". $user_id." OR level_pos_3=". $user_id.")";
                    $rs2 = mysql_query($sql2);
					$count= mysql_num_rows($rs2);
	

                  while($row2 = mysql_fetch_array($rs2)){


					$superv1=$row2["superior_1"];
					$superv2=$row2["superior_2"];
					$superv3=$row2["superior_3"];
					$level_pos_1=$row2["level_pos_1"];
					$level_pos_2=$row2["level_pos_2"];
					$level_pos_3=$row2["level_pos_3"];

					if($level_pos_1!=0  && $level_pos_1==$user_id && $a_status=="Pending"){


				$user_id=$superv1;

					}else if($level_pos_2!=0 && $level_pos_2==$user_id && $a_status=="Approved_lv1"){
				
					 $user_id=$superv2;
				 
					}else if($level_pos_3!=0 && $level_pos_3==$user_id && $a_status=="Approved_lv2"){
					 $user_id=$superv3;
					
					}

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
				  
					if($user_id==$superv1 && $a_status=="Pending"){

					if($user_id==$superv2){

			
					if($user_id==$superv3){
				
					
					$status="Approved";
			
					}else{

					$status="Approved_lv2";
			
        		$msg = '<P>Dear Sir/Madam ,</P>';
						$msg.='<p>&nbsp</p>';
						$msg.='<p><B>'.$name.'</B> has applied OverTime and is Pending your approval.</p>' ;
						 $msg.='<p>&nbsp</p>';
						$msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
						 $msg.='<p>&nbsp</p>';
						$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
						 $msg.='<p>&nbsp</p>';
						$msg.= "<p><a href='http://myigen.com:8081/HR/igen/'> Click here </a>, To login to ".$c_name." @WORK  </p>";
						 $msg.='<p>&nbsp</p>';
     
        	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     
        
		 mailto($email3, $subject, $msg, $headers);
		 
		 
					}
					
					
					}else{
					
					$status="Approved_lv1";
						
        		$msg = '<P>Dear Sir/Madam ,</P>';
				$msg.='<p>&nbsp</p>';
				$msg.='<p><B>'.$name.'</B> has applied OverTime and is Pending your approval.</p>' ;
				 $msg.='<p>&nbsp</p>';
				$msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
				 $msg.='<p>&nbsp</p>';
				$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
				 $msg.='<p>&nbsp</p>';
				$msg.= "<p><a href='http://myigen.com:8081/HR/igen/'> Click here </a>, To login to ".$c_name." @WORK  </p>";
				 $msg.='<p>&nbsp</p>';
				 
     
        	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     
        
		 mailto($email2, $subject, $msg, $headers);
		 
					
					}
					
					
					}else if($user_id==$superv2 && $a_status=="Approved_lv1"){
			
					
					if($user_id==$superv3){
					
					$status="Approved";
					
						  $msg = '<p>Dear All , </p>';
						   $msg.='<p>&nbsp</p>';
						$msg.='<p><B>'.$name.'</B> has applied  OverTime and is Pending your approval.</p>' ;
						$msg.='<p>&nbsp</p>';
						$msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
						 $msg.='<p>&nbsp</p>';
						$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
						 $msg.='<p>&nbsp</p>';
						$msg.= "<p><a href='http://myigen.com:8081/HR/igen/'> Click here </a>, To login to ".$c_name." @WORK  </p>";
						 $msg.='<p>&nbsp</p>';
		                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
        
		 mailto($email1, $subject, $msg, $headers);
		 
					
					}else{
					$status="Approved_lv2";
					
					$msg = '<p>Dear Sir/Madam ,</p>';
					$msg.='<p>&nbsp</p>';
					$msg.='<p><B>'.$name.'</B> has applied  OverTime and is Pending your approval.</p>' ;
					 $msg.='<p>&nbsp</p>';
					$msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
					 $msg.='<p>&nbsp</p>';
					$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
					 $msg.='<p>&nbsp</p>';
					$msg.= "<p><a href='http://myigen.com:8081/HR/igen/'> Click here </a>, To login to ".$c_name." @WORK  </p>";
					 $msg.='<p>&nbsp</p>';
     
        	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
		    mailto($email3, $subject, $msg, $headers);
		 
					}
					
					
					}else if($user_id==$superv3 && $a_status=="Approved_lv2"){
					
					$status="Approved";
					
						$msg = '<p>Dear All , </p>';
						 $msg.='<p>&nbsp</p>';
						$msg.='<p>The  OverTime application From <B> '.$name.'</B> has been approved by <B>'.$full_name.'</B>.</P>' ;
						$msg.='<p>&nbsp</p>';
						$msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
						 $msg.='<p>&nbsp</p>';
						$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
						 $msg.='<p>&nbsp</p>';
						$msg.= "<p><a href='http://myigen.com:8081/HR/igen/'> Click here </a>, To login to ".$c_name." @WORK  </p>";
						 $msg.='<p>&nbsp</p>';
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
        
		 mailto($email1, $subject, $msg, $headers);
		  mailto($email2, $subject, $msg, $headers);
		  
		  
					}
					
					
					}
					
					}else{
					$status="Approved";
					}
					
					
}

$getAID = explode(",", $_GET["aid"]);

$aid1 = $getAID[0];
$aid2 = $getAID[1];
$aid3 = $getAID[2];

$sql = "SELECT * FROM employee_overtime WHERE id = " . $id;
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs);

if ($status == "Rejected") {
    if ($aid1 == 1) {
        $sql2 = "UPDATE employee_overtime SET approval_1='" . $status . "' where id='" . $id . "'";
    } elseif ($aid2 == 2) {
        $sql2 = "UPDATE employee_overtime SET approval_2='" . $status . "' where id='" . $id . "'";
    }
    $sql1 = "UPDATE employee_overtime SET ot_status='" . $status . "' where id='" . $id . "'";
} else {
    if ($aid1 == 1) {
        $app[] = "approval_1='" . $status . "'";
    }
    if ($aid2 == 2) {
        $app[] = "approval_2='" . $status . "'";
    }
    if ($aid3 == 3) {
        $app[] = "ot_status='" . $status . "'";
    }
    for ($i = 0; $i < count($app); $i++) {
        $approve = $approve . $app[$i] . ',';
    }
    $approve = substr($approve, 0, -1);
    $sql1 = "UPDATE employee_overtime SET " . $approve . " where id='" . $id . "'";
}

if ($status == "Rejected" || $aid3 == 3) {
//        app_mail_process($emp_id, 'overtime', $id, $status);
}
if ($status == "Approved"){
	 $msg = '<p>Dear ' . $name . ',</p>';
	 $msg.='<p>&nbsp</p>';
        $msg.='<p>Your OverTime application has been approved by<B> '.$full_name.'</B>.</p>' ;
		 $msg.='<p>&nbsp</p>';
							$msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
							 $msg.='<p>&nbsp</p>';
							$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
							$msg.='<p>&nbsp</p>';
							$msg.= "<p><a href='http://myigen.com:8081/HR/igen'>Click here </a>, To login to ".$c_name." @WORK  </p>";
							$msg.='<p>&nbsp</p>';
		}
		if ($status == "Rejected") {
	    $msg = '<p>Dear ' . $name . ',</p>';
		$msg.='<p>&nbsp</p>';
        $msg.='<p>Your OverTime application has been Rejected by<B>  '.$full_name.'</B>. </p>' ;
		$msg.='<p>&nbsp</p>';
		$msg.='<p>Please refer to your immediate superior for more details</p>';
		$msg.='<p>&nbsp</p>';
        $msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
	    $msg.='<p>&nbsp</p>';
		$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
		$msg.='<p>&nbsp</p>';
		$msg.= "<p><a href='http://myigen.com:8081/HR/igen'>Click here </a>, To login to ".$c_name." @WORK  </p>";
		$msg.='<p>&nbsp</p>';
      
	   
	   }
	 
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
       mailto($email, $subject, $msg, $headers);
 $sql1 = "UPDATE employee_overtime SET ot_status='" . $status . "' where id='" . $id . "'";
$query1 = mysql_query($sql1);
$query2 = mysql_query($sql2);

if ($query1) {
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