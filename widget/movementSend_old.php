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

$reason=htmlentities($_POST['reason'], ENT_QUOTES, "UTF-8");
if($Leave_type=="Personal"){
$sql = "INSERT INTO employee_movement(emp_id, depid, from_time,to_time,movement_type,reason,leave_date,request_status,num_hours)
        VALUES ('" . $emp_id . "','" . $depid. "','". $_POST['valuestop'] . "','" . $_POST['valuestart'] . "','" . $Leave_type . "','" .$reason  . "','" . $_POST['from_date'] . "','Pending','" . $_POST['num_hour'] . "');";
}else{
$sql = "INSERT INTO employee_movement1(emp_id, depid, from_time,to_time,reason,movement_type,request_status,num_hours)
        VALUES ('" . $emp_id . "','" . $depid. "','". $_POST['valuestop'] . "','" . $_POST['valuestart'] . "','" .$reason  . "','" .$Leave_type. "','Pending','" . $_POST['num_hour'] . "');";



}
$sql_result = mysql_query($sql);
if ($sql_result) {

 $sql1 = "select * from employee e, approval a WHERE (
		a.level_pos_1=e.id OR a.superior_1=e.id ) AND a.dep_id='".$depid."'";
                            
    $rs1 = mysql_query($sql1);
   $subject = 'HR Application';
    if ($rs1 && mysql_num_rows($rs1) > 0) {
        while($row1 = mysql_fetch_array($rs1)){ 
		$email=$row1['email'];
		$full_name =$row1['full_name'];
	
		
        $email="abdiaziz@myigen.com";
        $msg = 'Dear ' . $full_name . ', <br>';
        $msg.='There is a leave application From"'.$name.'"  and is waiting for your approval.<br>' ;
        $msg.='Do not reply to this email as this was a computer generated email.<br>'; 
		$msg.= "Please login using following address: http://myigen.com:8686/simplysiti  <br>";
       $headers .= 'Content-type: text/html; charset=iso-8859-1' . "<br>"; 
       mailto($email, $subject, $msg, $headers);
		
		}
		}
    print true;
} else {
    print false;
}
?>

<?php
?>