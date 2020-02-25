<?php

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

$today = date('Y-m-d');
$emp_id = explode(',', $_POST["emptranid"]);

error_reporting(0);
include "plugins/mailer/mailapp.php";
$subject = 'HR Application';


for ($i = 0; $i < count($emp_id); $i++) {

$sql = "select * from employee where id='" .$emp_id[$i]. "' limit 1";
    $rs = mysql_query($sql);

    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
		$email=$row['email'];
		$name= $row['full_name'];
		}
		

	$sql2 = 'SELECT grp.id, grp.dep_id, d.dep_name FROM emp_group grp, department d WHERE grp.dep_id=d.id AND grp.id = ' . $_POST["combo1"];
    $query2 = mysql_query($sql2);
    $row2 = mysql_fetch_array($query2);
	$sql4 = 'SELECT dep_name, id FROM department WHERE id = ' .$_POST["dep"];
    $query4 = mysql_query($sql4);
    $row4 = mysql_fetch_array($query4);
	$sql5 = 'SELECT id FROM emp_group WHERE dep_id= ' .$_POST["dep"];
    $query5 = mysql_query($sql5);
    $row5 = mysql_fetch_array($query5);
  $var=$row4['dep_name'];
  $var_id=$row4['id'];
  $dep=$row2['dep_name'];
  $ori_group=$row5['id'];

    $sql1 = 'INSERT INTO employee_transfer (emp_id, ori_dep_id, ori_group_id, ori_dep, transfer_dep, from_date, to_date, temp_show, date_transfer) VALUES 
        (' . $emp_id[$i] . ', "' . $var_id . '","' . $ori_group . '","' . $var . '", "' . $dep . '", "' .date('Y-m-d',strtotime($_POST["fromdate"])). '", "' . date('Y-m-d',strtotime($_POST["todate"])) . '", "' . $_POST["temp_show"] . '", "' . $today . '")';
    $query1 = mysql_query($sql1);
	
	 
        $msg = '<p>Dear ' . ucfirst($name). ', </p>';
		 $msg.='<p>&nbsp</p>';
        $msg.='<p>You have been transferred From  <B>'.$var.'</B> To <B>'. $dep.'</B> By HR admin .</P>' ;
         $msg.='<p>&nbsp</p>';
        $msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
		 $msg.='<p>&nbsp</p>';
		$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
		 $msg.='<p>&nbsp</p>';
		$msg.= "<p><a href='http://myigen.com:8081/HR/igen/'>Click here </a>, To login to ".$c_name." @WORK  </p>";
		 $msg.='<p>&nbsp</p>';
      // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "<br>"; 
      // mailto($email, $subject, $msg, $headers);
	   
	 
	  
	   
	   
}

$sql3 = 'SELECT dep_id FROM emp_group WHERE id=' . $_POST["combo1"];
$query3 = mysql_query($sql3);
$row3 = mysql_fetch_array($query3);

$sql = "update employee set group_id='" . $_POST['combo1'] . "', dep_id ='" . $row3['dep_id'] . "' where id in(" . $_POST['emptranid'] . ")";
$query = mysql_query($sql);

if ($query1) {
    print true;
} else {
    print false;
}

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>