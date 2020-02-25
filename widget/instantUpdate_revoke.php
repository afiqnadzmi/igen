<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$from =$_POST['from'];
$to =$_POST['to'];

error_reporting(0);
include "plugins/mailer/mailapp.php";
$user_id = $_COOKIE["igen_user_id"]; 
$sql_c = "select * from company";
$rs_c = mysql_query($sql_c);
$row_c= mysql_fetch_array($rs_c);
$c_name=$row_c['name'];
$subject = 'HR Application';
$sql = "select * from employee where id='" .$user_id . "' limit 1";
    $rs = mysql_query($sql);

    if ($rs && mysql_num_rows($rs) > 0) { 
        $row = mysql_fetch_array($rs);
		$depid=$row['dep_id'];
		$full_name= $row['full_name'];
		}
$emp_id = $_POST["emp_id"]; 
$status =$_POST['status'];

$id = isset($_POST['id']) ? $_POST['id'] : "";
$sql3 = "SELECT * FROM employee WHERE
                            id=" . $emp_id ;
                    $rs3 = mysql_query($sql3);
					$count1= mysql_num_rows($sql3);
					
					
                  while($row3= mysql_fetch_array($rs3)){
				  $dep=$row3['dep_id'];
				  $name=$row3['full_name'];
				  $email=$row3['email'];
				  }
					
				  


$sql2 = "SELECT * FROM approval WHERE dep_id='".$dep."'";
                           
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

					$msg = '<p>Dear All ,</p>';
				    $msg.='<p>&nbsp</p>';
					$msg.='<p>The Leave application on <B>'.$from. '</B> to <B>'.$to.  '</B> From <B>'.$name.'</B> has been Revoked by <B>'.$full_name.'</B>.<br>' ;
				   $msg.='<p>&nbsp</p>';
					$msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
					 $msg.='<p>&nbsp</p>';
					$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
					$msg.='<p>&nbsp</p>';
					$msg.= "<p><a href='http://myigen.com:8081/HR/igen'>Click here </a>, To login to ".$c_name." @WORK  </p>";
					$msg.='<p>&nbsp</p>';
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
					
		 mailto($email1, $subject, $msg, $headers);
		 
		 mailto($email3, $subject, $msg, $headers);
		  mailto($email2, $subject, $msg, $headers);
					
					
					
					}
					
					





    $sql = 'Delete From employee_leave WHERE id = ' . $id . ';';
    $sql_result = mysql_query($sql);

    if ($sql_result) {

	  $msg = '<p>Dear ' . $name . ', </p>';
	  $msg.='<p>&nbsp</p>';
        $msg.='<p>Your leave application on <B>'.$from. '</B> to <B>'.$to.  '</B> has been Revoked by  <B>'.$full_name.'</B>. </p>' ;
        $msg.='<p>&nbsp</p>';
        $msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
		 $msg.='<p>&nbsp</p>';
		$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
	    $msg.='<p>&nbsp</p>';
		$msg.= "<p><a href='http://myigen.com:8081/HR/igen'>Click here </a>, To login to ".$c_name." @WORK  </p>";
	    $msg.='<p>&nbsp</p>';
      
	   
	   
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