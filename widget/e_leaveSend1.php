<?php
session_start();//Session start
error_reporting(0);//Error recording
include "plugins/mailer/mailapp.php";//Calling php mailer
if ($_POST["emp_id"] == "0") {
    $emp_id = $_COOKIE['igen_user_id'];
} else {
    $emp_id = $_POST['emp_id'];
}
//uploading file to a folde
$filename = $_FILES['fileInput']['name'];
$location="";
if(!empty($filename)){
	//Rename the file
	$temp = explode(".", $filename);
	$filename = "Leave_".round(microtime(true)) .'_'.$emp_id.'.' . end($temp);
	/* Location */
	$location = "uploads/leave/".$filename;
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf'); // valid extensions
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
	


if ($_POST["emp_id"] == "0") {
    $emp_id = $_COOKIE['igen_user_id'];
} else {
    $emp_id = $_POST['emp_id'];
}
$reason=htmlentities($_POST['reason'], ENT_QUOTES, "UTF-8");
$sql = "INSERT INTO employee_leave (emp_id, depid, from_date,to_date,reason,leave_type_id,leave_date,request_status,num_days, img_path)
        VALUES ('" . $emp_id . "','" . $depid. "','". date('Y-m-d', strtotime($_POST['from_date'])) . "','" . date('Y-m-d', strtotime($_POST['to_date'])) . "','" .$reason 
        . "','" . $_POST['leave_type_id'] . "','" . date('Y-m-d') . "','Pending','" . $_POST['num_days'] . "','" .$location. "');";
$sql_result = mysql_query($sql);
if ($sql_result) {
/*if($num_rows>0){
 $sql1 = "select * from employee  WHERE id='".$a_emp."'";
                            
    $rs1 = mysql_query($sql1);
   $subject = 'HR Application';
    if ($rs1 && mysql_num_rows($rs1) > 0) {
        while($row1 = mysql_fetch_array($rs1)){
		$email=$row1['email'];
		$full_name =$row1['full_name'];
		
	//Sending email

        $msg = '<p>Dear ' . ucfirst($full_name) . ',</p>';
		 $msg.='<p>&nbsp</p>';
        $msg.='<p><B>'.$name.'</B> has applied for leave from <B>'.$_POST['from_date'].'</B> to <B>'.$_POST['to_date'].'</B>  and is Pending your approval.</p>' ;
		 $msg.='<p>&nbsp</p>';
        $msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
		 $msg.='<p>&nbsp</p>';
		$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
		 $msg.='<p>&nbsp</p>';
		$msg.= "<p><a  href='http://myigen.com:8081/HR/igen/'>Click here </a>, To login to ".$c_name." @WORK  </p>";
		 $msg.='<p>&nbsp</p>';
        $headers .= '<p>Content-type: text/html; charset=iso-8859-1' . "</p>"; 
        mailto($email, $subject, $msg, $headers);
		
		}
		}


}else{

 $sql1 = "select * from employee e, approval a WHERE (
		a.level_pos_1=e.id OR a.superior_1=e.id ) AND a.dep_id='".$depid."'";
                            
    $rs1 = mysql_query($sql1);
   $subject = 'HR Application';
    if ($rs1 && mysql_num_rows($rs1) > 0) {
        while($row1 = mysql_fetch_array($rs1)){
		$email=$row1['email'];
		$full_name =$row1['full_name'];
	//Sending email
	
        $msg = '<p>Dear ' . ucfirst($full_name) . ',</p>';
		 $msg.='<p>&nbsp</p>';
        $msg.='<p><B>'.$name.'</B> has applied for leave from <B>'.$_POST['from_date'].'</B> to <B>'.$_POST['to_date'].'</B>  and is Pending your approval.</p>' ;
		 $msg.='<p>&nbsp</p>';
        $msg.='<p><i>*Do not reply to this email as this is a computer generated email</i>.</p>'; 
		 $msg.='<p>&nbsp</p>';
		$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
		 $msg.='<p>&nbsp</p>';
		$msg.= "<p><a  href='http://myigen.com:8081/HR/igen/'>Click here </a>, To login to ".$c_name." @WORK  </p>";
		 $msg.='<p>&nbsp</p>';
        $headers .= '<p>Content-type: text/html; charset=iso-8859-1' . "</p>"; 
        mailto($email, $subject, $msg, $headers);
		
		}
		}
		}*/
    print true;
} else {
    print false;
}
?>


