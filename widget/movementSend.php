<?php
session_start();
?>

<?php
error_reporting(0);
include "plugins/mailer/mailapp.php";
$emp_id = $_COOKIE['igen_user_id'];
$Leave_type=$_POST['Leave_type'];

$sql = "select * from employee where id='" .$emp_id . "' limit 1";
    $rs = mysql_query($sql);

    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
		$depid=$row['dep_id'];
		$name= $row['full_name'];
		}
		
		



if ($_POST["emp_id"] == "0" || $_POST["emp_id"]=="") {
    $emp_id = $_COOKIE['igen_user_id'];
} else {
    $emp_id = $_POST['emp_id'];
}
$sql_c = "select * from company";
$rs_c = mysql_query($sql_c);
$row_c= mysql_fetch_array($rs_c);
$c_name=$row_c['name'];

$sql_dep = "select * from approval_m where (lv1='" .$emp_id . "' OR lv2='" .$emp_id . "' OR lv3='" .$emp_id . "') AND dep_id='".$depid."'";
    $rs_dep = mysql_query($sql_dep);
	$num_rows= mysql_num_rows($rs_dep);
	$row_dep = mysql_fetch_array($rs_dep);
	$a_emp = $row_dep['emp_id'];
$reason=htmlentities($_POST['reason'], ENT_QUOTES, "UTF-8");
if($Leave_type=="Personal" || $Leave_type=="meeting"){

$sql = "INSERT INTO employee_movement(emp_id, depid, from_time,to_time,movement_type,reason,leave_date,request_status,num_hours)
        VALUES ('" . $emp_id . "','" . $depid. "','".$_POST['valuestop']. "','" .$_POST['valuestart'] . "','" . $Leave_type . "','" .$reason  . "','" .date("Y-m-d", strtotime($_POST['from_date'])) . "','Pending','" . $_POST['num_hour'] . "');";
}else{
$sql = "INSERT INTO employee_movement1(emp_id, depid, from_time,to_time,reason,movement_type,request_status,num_hours)
        VALUES ('" . $emp_id . "','" . $depid. "','". date("Y-m-d", strtotime($_POST['valuestart'])). "','" . date("Y-m-d", strtotime($_POST['valuestop'])). "','" .$reason  . "','" .$Leave_type. "','Pending','" . $_POST['num_hour'] . "');";



}
$sql_result = mysql_query($sql);
if ($sql_result) {

if($num_rows>0){
 $sql1 = "select * from employee  WHERE id='".$a_emp."'";
                            
    $rs1 = mysql_query($sql1);
   $subject = 'HR Application';
    if ($rs1 && mysql_num_rows($rs1) > 0) {
        while($row1 = mysql_fetch_array($rs1)){
		$email=$row1['email'];
		$full_name =$row1['full_name'];
	
		
       
        $msg = '<p>Dear ' . $full_name . ', </p>';
		$msg.='<p>&nbsp</p>';
        $msg.='<p>There is a Movement application From <B>'.$name.'</B>  and is pending to your approval.</p>' ;
		$msg.='<p>&nbsp</p>';
        $msg.='<p><i>*Do not reply to this email as this is a computer generated email.</i></p>'; 
		$msg.='<p>&nbsp</p>';
		$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
		 $msg.='<p>&nbsp</p>';
		$msg.= "<p><a href='http://myigen.com:8081/HR/igen'>Click here </a>, To login to ".$c_name." @WORK  </p>";
		$msg.='<p>&nbsp</p>';
       $headers .= 'Content-type: text/html; charset=iso-8859-1' . "<br>"; 
      // mailto($email, $subject, $msg, $headers);
		
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
	
		
       
        $msg = '<p>Dear ' . $full_name . ', </p>';
		$msg.='<p>&nbsp</p>';
        $msg.='<p>There is a Movement application From <B>'.$name.'</B>  and is pending to your approval.</p>' ;
		$msg.='<p>&nbsp</p>';
        $msg.='<p><i>*Do not reply to this email as this is a computer generated email.</i></p>'; 
		$msg.='<p>&nbsp</p>';
		$msg.='<p><B>Sent By '.$c_name.'  HR Dept</B>.</br></br></p>' ;
		 $msg.='<p>&nbsp</p>';
		$msg.= "<p><a href='http://myigen.com:8081/HR/igen'>Click here </a>, To login to ".$c_name." @WORK  </p>";
		$msg.='<p>&nbsp</p>';
       $headers .= 'Content-type: text/html; charset=iso-8859-1' . "<br>"; 
       //mailto($email, $subject, $msg, $headers);
	   
		
		}
		}
		}
    print true;
} else {
    print false;
}
?>

<?php
?>