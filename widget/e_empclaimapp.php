<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
include "plugins/mailer/mailapp.php";
if ($_POST["emp_id"] == "0" || $_POST["emp_id"]=="undefined") {
    $emp_id = $_COOKIE['igen_user_id'];
} else {
    $emp_id = $_POST['emp_id'];
}

//uploading file to a folde
$filename = $_FILES['fileInput']['name'];
if(!empty($filename)){
	//Rename the file
	$temp = explode(".", $filename);
	$filename = "Claim_".round(microtime(true)) .'_'.$emp_id.'.' . end($temp);
	/* Location */
	$location = "uploads/claim/".$filename;
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf', 'JPEG', 'JPG', 'PNG', 'GIF', 'PDF'); // valid extensions
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	/* Upload file */
	if(in_array($ext, $valid_extensions)) 
	{
		if(move_uploaded_file($_FILES['fileInput']['tmp_name'],$location)){
			//echo "loca:".$location;
		}else{
			//echo 0;
		}
	}
}else{
	$filename = "";
}

// End a the file upload

//Inserting the data into database
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
		
$sql_dep = "select * from approval_m where (lv1='" .$emp_id . "' OR lv2='" .$emp_id . "' OR lv3='" .$emp_id . "') AND dep_id='".$depid."'";
$rs_dep = mysql_query($sql_dep);
	$num_rows= mysql_num_rows($rs_dep);
	$row_dep = mysql_fetch_array($rs_dep);
	$a_emp = $row_dep['emp_id'];

$claim_id =htmlentities($_POST['claim_title'], ENT_QUOTES, "UTF-8");

$claim_number = $_POST['claim_number'];
$claim_date = $_POST['claim_date'];
$claim_title = $_POST['claim_text'];
$clinic = $_POST['clinic'];
$claim_amount = number_format($_POST['claim_amount'], 2, '.', '');
$pending = "Pending";
$claim_remark =htmlentities($_POST['claim_remark'], ENT_QUOTES, "UTF-8");
$uploaded_img = $_POST['uploaded_img'];
$sql_result1 = mysql_query("DELETE FROM employee_claim WHERE emp_id='" . $emp_id . "' AND claim_id='".$claim_id."' AND MONTH(insert_date)='".date('m')."' AND YEAR(insert_date)='".date('Y')."'");
$sql2 = "INSERT INTO employee_claim (claim_item_title,claim_no,clinic,amount,claim_date,insert_date,remark,emp_id,depid,claim_status,claim_id, created_by, img_path) VALUES 
        ('" . $claim_title . "','" . $claim_number . "','" . $clinic . "','" . $claim_amount . "','" . date("Y-m-d", strtotime($claim_date)) . "','" . date('Y-m-d H:i:s') . "',
        '" . $claim_remark . "','" . $emp_id . "','" . $depid . "','" . $pending . "','" . $claim_id . "','" . $emp_id . "','" .$filename. "');";
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
		
		/*
        $msg = '<p>Dear ' . $full_name . ',</p>';
		$msg.='<p>&nbsp</p>';
        $msg.='<p><B>'.$name.' </B> has applied claim and is pending your approval</p>.';
		$msg.='<p>&nbsp</p>';
        $msg.='<p><i>*Do not reply to this email as this is a computer generated email</i></p>.'; 
		$msg.='<p>&nbsp</p>';
		$msg.= "<p><a href='http://myigen.com:8686/hr-demo'>Click here </a>, To login to ".$c_name." @WORK  </p>";
		$msg.='<p>&nbsp</p>';
		$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
		 $msg.='<p>&nbsp</p>';
     $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 $msg.='<p>&nbsp</p>';
       mailto($email, $subject, $msg,  $headers);
	   */
	   }
	   }
 }else{
$sql1 = "select * from employee e, approval a WHERE (
		a.level_pos_1=e.id OR a.level_pos_2=e.id OR a.level_pos_3=e.id OR a.superior_1=e.id OR a.superior_2=e.id OR a.superior_3=e.id
		) AND a.dep_id='".$depid."'";
                            
    $rs1 = mysql_query($sql1);
   $subject = 'HR Application';
    if ($rs1 && mysql_num_rows($rs1) > 0) {
        while($row1 = mysql_fetch_array($rs1)){
		$email=$row1['email'];
		$full_name =$row1['full_name'];
		

		
        $msg = '<p>Dear ' . $full_name . ',</p>';
		$msg.='<p>&nbsp</p>';
        $msg.='<p><B>'.$name.' </B> has applied claim and is pending your approval</p>.';
		$msg.='<p>&nbsp</p>';
        $msg.='<p><i>*Do not reply to this email as this is a computer generated email</i></p>.'; 
		$msg.='<p>&nbsp</p>';
		$msg.= "<p><a href='http://myigen.com:8686/hr-demo'>Click here </a>, To login to ".$c_name." @WORK  </p>";
		$msg.='<p>&nbsp</p>';
		$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
		 $msg.='<p>&nbsp</p>';
     $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 $msg.='<p>&nbsp</p>';
       //mailto($email, $subject, $msg,  $headers);
		
		}
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