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

$id = $_GET['id'];
$emp_id = $_GET['eid'];
$status = $_GET['status'];
$user_id = $_COOKIE["igen_user_id"];
$subject = 'HR Application';
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


$sql_3 = "SELECT * FROM employee_leave WHERE
                            id=" . $id ;
                    $rs_3 = mysql_query($sql_3);
					$count_1= mysql_num_rows($sql_3);
$row_3= mysql_fetch_array($rs_3);
$a_status = $row_3['request_status'];

;
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
						$msg.='<p><B>'.$name.'</B> has applied leave and is Pending your approval.</p>' ;
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
				$msg.='<p><B>'.$name.'</B> has applied leave and is Pending your approval.</p>' ;
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
						$msg.='<p><B>'.$name.'</B> has applied leave and is Pending your approval.</p>' ;
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
					$msg.='<p><B>'.$name.'</B> has applied leave and is Pending your approval.</p>' ;
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
						$msg.='<p>The Leave application From <B> '.$name.'</B> has been approved by <B>'.$full_name.'</B>.</P>' ;
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

$leave_type_id = $_GET["leave_type_id"];
$num_days = $_GET["num_days"];

$sql_emp = 'SELECT join_date,group_for_leave_id FROM employee WHERE id=' . $emp_id;
$query_emp = mysql_query($sql_emp);
$row_emp = mysql_fetch_array($query_emp);

$group_for_leave_id = $row_emp["group_for_leave_id"];
$diff = abs(time(date("Y-m-d")) - strtotime($row_emp["join_date"]));
$years = floor($diff / (365 * 60 * 60 * 24));

$sql_bal1 = "SELECT COALESCE(days,0) as days FROM leave_group lg
            where from_year<=" . $years . " and to_year>=" . $years . " and group_for_leave_id='" . $group_for_leave_id . "' 
            and leave_type_id='" . $leave_type_id . "'";
$rs_bal1 = mysql_query($sql_bal1);
$row_bal1 = mysql_fetch_array($rs_bal1);
$total_leave = $row_bal1["days"];
$sql10 = "SELECT lt.type_name FROM leave_type lt where id='".$leave_type_id."'";
	
$rs10 = mysql_query($sql10);
 while ($row10 = mysql_fetch_array($rs10)) {
 $type_name=$row10['type_name'];
 }
 $year = date('Y');
$sql_bal2 = "SELECT COALESCE(sum(num_days),0) as nd FROM employee_leave e 
             where year(from_date)=" . $year . " and emp_id='" . $emp_id . "' and leave_type_id='" . $leave_type_id . "' and request_status='Approved';";
$rs_bal2 = mysql_query($sql_bal2);
$row_bal2 = mysql_fetch_array($rs_bal2);
$used_leave = $row_bal2["nd"];
// Getting the total of all previous balance 
$curr= date('Y');
$sql5="SELECT COALESCE(sum(leave_balance),0) as balance FROM leave_balance
			where emp_id='" . $emp_id . "' AND Date='".$curr."'";
$rs5 = mysql_query($sql5);
$row5 = mysql_fetch_array($rs5);
$all_balance = $row5["balance"];
if($type_name=="Annual Leave"){
$total_leave=$total_leave + $all_balance;
}

$leavedays = ($total_leave - $used_leave);
$leavebal = ($leavedays - $num_days);

if ($leavebal >= 0) {

    $sql = 'UPDATE employee_leave SET request_status = "' . $status . '" WHERE id = ' . $id . ';';
    $sql_result = mysql_query($sql);

    if ($sql_result) {

        $query_status = "true";

    } else {
        $query_status = "false";
    }

    $data = array('query' => $query_status, 'status' => $status);
					        
    //print json_encode($data);
	print  json_encode($data);

	if ($status == "Approved"){
	    $msg = '<P>Dear ' . $name . ',</p>';
        $msg.='<p>&nbsp</p>';
        $msg.='<P>Your leave application has been approved by <B>'.$full_name.'</B>.</P>' ;
		 $msg.='<p>&nbsp</p>';
        $msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
		 $msg.='<p>&nbsp</p>';
		$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
		 $msg.='<p>&nbsp</p>';
		$msg.= "<p><a href='http://myigen.com:8081/HR/igen/'>Click here </a>, To login to ".$c_name." @WORK  </p>";
		 $msg.='<p>&nbsp</p>';
		}
		if ($status == "Rejected") {
		$msg = '<P>Dear ' . $name . ', </P>';
		$msg.='<p>&nbsp</p>';
        $msg.='<P>Your leave application has been Rejected by</P><B> '.$full_name.'</B>. <br>' ;
        $msg.='<p>&nbsp</p>';
		$msg.='<p>Please refer to your immediate superior for more details</p>';
		$msg.='<p>&nbsp</p>';
        $msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
		 $msg.='<p>&nbsp</p>';
		$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
		 $msg.='<p>&nbsp</p>';
		$msg.= "<p><a href='http://myigen.com:8081/HR/igen/'>Click here </a>, To login to ".$c_name." @WORK  </p>";
		 $msg.='<p>&nbsp</p>';
      
	   
	   }
     $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
     mailto($email, $subject, $msg, $headers);
 
} else {
    if ($status == "Approved") {

        $data = array('query' => "exceed", 'status' => "Pending");
		
        print json_encode($data);
    } else {
        $sql = 'UPDATE employee_leave SET request_status = "' . $status . '" WHERE id = ' . $id . ';';
        $sql_result = mysql_query($sql);

        if ($sql_result) {
            $query_status = "true";
        } else {
            $query_status = "false";
        }
//        app_mail_process($emp_id, 'leave', $id, $status);

        $data = array('query' => $query_status, 'status' => $status);
        print json_encode($data);
    }
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