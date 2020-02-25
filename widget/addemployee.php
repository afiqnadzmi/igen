<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$GETbank = $_POST['bank'];
if($GETbank==""){
	$GETbank="NULL";
}
$contract = $_POST['contract'];
$name = $_POST['name'];
$ic = $_POST['ic'];
$phone = $_POST['phone'];
if($phone==""){
	$phone="NULL";
}
$mobile = $_POST['mobile'];
$emergency=$_POST['emergency'];
$contactText=$_POST['contactText'];
$SpouseName=$_POST['SpouseName'];
$email = $_POST['emailAdd'];
$mail = $_POST['mailAdd'];
if($mail==""){
	$mail="NULL";
}
$race = $_POST['race'];
$profile = $_POST['profile'];
if($profile==""){
	$profile="NULL";
}
$dob = $_POST['dob'];
$note = $_POST['note']; //shift
if($note==""){
	$note="NULL";
}
$shift = $_POST['shift']; //
$pn=$_POST['pn'];
$pe=$_POST['pe'];
$wp=$_POST['wp'];
if($wp==""){
	$wp="NULL";
}
$wpep=$_POST['wpep'];
$salaryGrade=$_POST['salaryGrade'];
if($salaryGrade==""){
	$salaryGrade="NULL";
}
$country=$_POST['country'];
if($pe!=""){
	$pe=date("Y-m-d", strtotime($pe));
}else{
	$pe="0000-00-00";
}

if($wpep!=""){
	$wpep=date("Y-m-d", strtotime($wpep));
}else{
	$wpep="0000-00-00";
}
$company_id = $_POST["company_id"];
$confirmDate=$_POST["confirmDate"];
$pwd = md5($_POST["pwd"]);

$dateOfDay = date("Y-m-d");
$dateOfBirth = $dob;

$yearOfDay = substr($dateOfDay, 0, 4);
$yearOfBirth = substr($dateOfBirth, 0, 4);
$age = $yearOfDay - $yearOfBirth;
$realAge = abs($age);

$img_src = 'images/Gra_ProfilePhoto.png';

if ($realAge >= 55) {
    $category2 = 'Y';
} else {
    $category2 = 'N';
}

$joinDate = $_POST['joinDate'];
$resignDate = $_POST['resignDate'];
if($resignDate!=""){
$resignDate= date("Y-m-d", strtotime($_POST['resignDate']));
}else{
$resignDate="0000-00-00";
}
$position = $_POST['position'];
$group = $_POST['group'];
$branch = $_POST['branch'];
$iTax = $_POST['iTax'];
if($iTax==""){
	$iTax="NULL";
}
$socso = $_POST['socso'];
if($socso==""){
	$socso="NULL";
}
$epf = $_POST['epf'];
if($epf==""){
	$epf="NULL";
}
$gender = $_POST['gender'];
$marital = $_POST['marital'];
$spouse = $_POST['spouse'];
$child = $_POST['child'];
$bankAcc = $_POST['bankAcc'];
if($bankAcc==""){
	$bankAcc="NULL";
}
$username = $_POST['username'];
$overtime = $_POST['overtime'];
if($overtime==""){
	$overtime="0";
}
$status = $_POST['empstatus'];
$religion = $_POST['religion'];
$deptId = $_POST['dept'];
$salaryType = $_POST['salaryType'];
$offDateText=$_POST['offDateText'];
$lastDateText=$_POST['lastDateText'];
$eConRel=$_POST['emergencyContactRelationship'];
$e_date_pk_fz=$_POST['e_date_pk_fz'];
$e_date_westport=$_POST['e_date_westport'];
$e_date_johor_port=$_POST['e_date_johor_port'];
$e_date_ptp=$_POST['e_date_ptp'];
$e_date_tlp=$_POST['e_date_tlp'];

if($lastDateText!=""){
$lastDateText= date("Y-m-d", strtotime($_POST['lastDateText']));
}else{
$lastDateText="0000-00-00";
}
if($offDateText!=""){
	$offDateText= date("Y-m-d", strtotime($_POST['offDateText']));
}else{
	$offDateText="0000-00-00";
}

if($e_date_pk_fz!=""){
	$e_date_pk_fz= date("Y-m-d", strtotime($_POST['e_date_pk_fz']));
}else{
	$e_date_pk_fz="0000-00-00";
}
if($e_date_westport!=""){
	$e_date_westport= date("Y-m-d", strtotime($_POST['e_date_westport']));
}else{
	$e_date_westport="0000-00-00";
}
if($e_date_johor_port!=""){
	$e_date_johor_port= date("Y-m-d", strtotime($_POST['e_date_johor_port']));
}else{
	$e_date_johor_port="0000-00-00";
}
if($e_date_ptp!=""){
	$e_date_ptp= date("Y-m-d", strtotime($_POST['e_date_ptp']));
}else{
	$e_date_ptp="0000-00-00";
}
if($e_date_tlp!=""){
	$e_date_tlp= date("Y-m-d", strtotime($_POST['e_date_tlp']));
}else{
	$e_date_tlp="0000-00-00";
}

if($dob!=""){
	$dob= date("Y-m-d", strtotime($dob));
}else{
	$dob="0000-00-00";
}

if($joinDate!=""){
	$joinDate= date("Y-m-d", strtotime($joinDate));
}else{
	$joinDate="0000-00-00";
}

if($confirmDate!=""){
	$confirmDate= date("Y-m-d", strtotime($confirmDate));
}else{
	$confirmDate="0000-00-00";
}


$zakatnum =$_POST['zakatnum'];
if($zakatnum==""){
	$zakatnum="NULL";
}
$paymentType=$_POST['paymentType'];
$spouse_companyName=$_POST['spouse_companyName'];
if($spouse_companyName==""){
	$spouse_companyName="NULL";
}
$salaryAmt = number_format($_POST['salaryAmt'], 2, '.', '');
$leave = $_POST['leave'];
$userpermission = $_POST["userpermission"];

$extrainfo = $_POST["extrainfo"];

if ($_POST["zakat"] == "") {
    $zakat = 0;
} else {
    $zakat = number_format($_POST['zakat'], 2, '.', '');
}
if($ic==""){
	$sql1 = "SELECT * FROM employee WHERE 	passport='" . $pn . "'";
	
}else{
   $sql1 = "SELECT * FROM employee WHERE 	ic='" . $ic . "'";
}
$query1 = mysql_query($sql1);

if($ic==""){
	$ic="NULL";
}
if($pn==""){
	$pn="NULL";
}
if (mysql_num_rows($query1) > 0) {

echo true;
}else{
if(trim($SpouseName)==""){ 
$sql = 'INSERT INTO employee (is_contract, full_name, phone, mobile, email, contact_person, emergency,emergency_relationship,country, ic,passport,work_permit,passport_expiry,work_permit_expirty, address, profile,
            join_date, confirm_date, resign_date, officail_working_day, last_working_day, gender, race, marital, dob, spouse_work,spouse_company, num_of_kids,
            epf_num, socso_num, income_tax_num, bank_acc_id, bank_acc_num, position_id, group_id, emp_status,
            branch_id, category2, username, pwd, overtime_type, religion, dep_id, salary, salary_type,payment_type, zakat, zakat_num,
            group_for_leave_id, level_id, notes,shift_id, image_src, company_id, e_date_pk_fz, e_date_westport, e_date_johor_port, e_date_ptp, e_date_tlp, salary_grade)
            VALUES
            ("' . $contract . '", "' . $name . '","' . $phone . '","' . $mobile . '","' . $email .'","'. $contactText .'","'. $emergency . '","'. $eConRel . '","'. $country . '",
			"'. $ic . '","' . $pn . '","' . $wp . '","' . $pe . '","' . $wpep . '","' . $mail . '","' . $profile . '","' .$joinDate. '","' .$confirmDate. '","' .$resignDate. '","' .$offDateText. '","' .$lastDateText. '", "' . $gender
 . '","' . $race . '","' . $marital . '","' .$dob. '","' . $spouse . '","' . $spouse_companyName . '","' . $child . '","' . $epf . '","'
 . $socso . '","' . $iTax . '","' . $GETbank . '","' . $bankAcc . '","' . $position . '","' . $group . '","'
 . $status . '","' . $branch . '","' . $category2 . '","' . $username . '","' . $pwd . '","' . $overtime . '","'
 . $religion . '","' . $deptId . '","' . $salaryAmt . '","' . $salaryType . '","' . $paymentType . '","' . $zakat . '","' . $zakatnum . '","' . $leave . '", "'
 . $userpermission . '", "' . $note . '", "' . $shift . '", "' . $img_src . '", "' . $company_id . '", "' . $e_date_pk_fz . '", "' . $e_date_westport . '", "' . $e_date_johor_port . '", "' . $e_date_ptp . '", "' . $e_date_tlp . '", "' . $salaryGrade . '")';
 }else{
 $sql = 'INSERT INTO employee (is_contract, full_name, phone, mobile, email, contact_person, emergency ,emergency_relationship,country, ic, passport,work_permit,passport_expiry,work_permit_expirty,address, profile,
            join_date, confirm_date, resign_date, officail_working_day, last_working_day, gender, race, marital, dob, spouse_name, spouse_work,spouse_company, num_of_kids,
            epf_num, socso_num, income_tax_num, bank_acc_id, bank_acc_num, position_id, group_id, emp_status,
            branch_id, category2, username, pwd, overtime_type, religion, dep_id, salary, salary_type, payment_type,zakat,zakat_num, 
            group_for_leave_id, level_id, notes,shift_id, image_src, company_id, e_date_pk_fz, e_date_westport, e_date_johor_port, e_date_ptp, e_date_tlp, salary_grade)
            VALUES
            ("' . $contract . '", "' . $name . '","' . $phone . '","' . $mobile . '","' . $email .'","' . $contactText .'","'. $emergency . '","'. $eConRel . '","'. $country . '","'
 . $ic . '","' . $pn . '","' . $wp . '","' . $pe . '","' . $wpep . '","' . $mail . '","' . $profile . '","' .$joinDate. '","' .$confirmDate. '","' .$resignDate. '","' .$offDateText. '","' .$lastDateText. '",  "' . $gender
 . '","' . $race . '","' . $marital . '","' .$dob. '","'. $SpouseName . '","' . $spouse . '","' . $spouse_companyName . '","' . $child . '","' . $epf . '","'
 . $socso . '","' . $iTax . '","' . $GETbank . '","' . $bankAcc . '","' . $position . '","' . $group . '","'
 . $status . '","' . $branch . '","' . $category2 . '","' . $username . '","' . $pwd . '","' . $overtime . '","'
 . $religion . '","' . $deptId . '","' . $salaryAmt . '","' . $salaryType . '","' . $paymentType . '","' . $zakat . '","' . $zakatnum . '","' . $leave . '", "'
 . $userpermission . '", "' . $note . '", "' . $shift . '", "' . $img_src . '", "' . $company_id . '", "' . $e_date_pk_fz . '", "' . $e_date_westport . '", "' . $e_date_johor_port . '", "' . $e_date_ptp . '", "' . $e_date_tlp . '", "' . $salaryGrade . '")';
 
 }
 

$queryINSERT = mysql_query($sql);
echo "aaaa".$sql ;
exit();
$id = mysql_insert_id();
$date = date('Y-m-d');
$sql = 'INSERT INTO emp_promotion (emp_id, date_updated, position_id, salary) VALUES (' . $id . ', "' . $date . '", ' . $position . ', "' . $salaryAmt . '")';
$query = mysql_query($sql);

if ($extrainfo != "") {
    $extrainfo1 = explode(';', $extrainfo);
    for ($i = 0; $i < count($extrainfo1) - 1; $i++) {
        $extrainfo2 = explode(',', $extrainfo1[$i]);
        $sql1 = 'INSERT INTO employee_info (emp_id, field_name, field_value) VALUES (' . $id . ', "' . $extrainfo2[0] . '", "' . $extrainfo2[1] . '")';
        $query1 = mysql_query($sql1);
    }
}

if ($queryINSERT && $query) {
    print $id;
} else {
    print false;
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