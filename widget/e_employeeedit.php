<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$getID = $_POST['id'];
$GETbank = $_POST['bank'];
$name = $_POST['name'];
$ic = $_POST['ic'];
$phone = $_POST['phone'];
$mobile = $_POST['mobile'];
$email = $_POST['emailAdd'];
$mail = $_POST['mailAdd'];
$race = $_POST['race'];
$profile = $_POST['profile'];
$dob = date("Y-m-d", strtotime($_POST['dob']));
$note = $_POST['note'];
$username=$_POST['username'];

$dateOfDay = date("Y-m-d");
$dateOfBirth = $row['dob'];
$pn=$_POST['pn'];
$pe=$_POST['pe'];
$wp=$_POST['wp'];
$country=$_POST['country'];
if($pe!=""){
$pe = date("Y-m-d", strtotime($pe));
}else{
$pe="0000-00-00";
}

$ecp=$_POST['ecp'];
$ecn=$_POST['ecn'];
$ecr=$_POST['ecr'];

$yearOfDay = substr($dateOfDay, 0, 4);
$yearOfBirth = substr($dateOfBirth, 0, 4);
$age = $yearOfDay - $yearOfBirth;
$realAge = abs($age);

if ($realAge >= 55) {
    $category2 = 'Y';
} else { 
    $category2 = 'N';
}

$joinDate =date("Y-m-d", strtotime($_POST['joinDate']));
//$resignDate = date("Y-m-d", strtotime($_POST['resignDate']));


$resignDate=$_POST['resignDate'];
//echo "real-age:".$realAge."dob:".$resignDate;

$socso = $_POST['socso'];
$itax = $_POST['iTax'];
$epf = $_POST['epf'];
$gender = $_POST['gender'];
$marital = $_POST['marital'];
$spouse = $_POST['spouse'];
$child = $_POST['child'];
$bankAccNum = $_POST['bankAccNum'];
$religion = $_POST['religion'];
$zakat = $_POST['zakat'];

$delete = mysql_query('DELETE FROM employee_edit WHERE emp_id = ' . $getID); 
if ($zakat != 0) {
    $queryUpdate = mysql_query('INSERT INTO employee_edit (full_name,ic,username,country,passport,work_permit, passport_expiry, phone,mobile,email,contact_person,emergency,emergency_relationship,
                                                                   address,dob,num_of_kids,join_date,resign_date,
                                                                   profile,gender,race,religion,marital,
                                                                   spouse_work,bank_acc_id,bank_acc_num,epf_num,socso_num,
                                                                   income_tax_num,zakat,emp_id,date_edit)
                                                            VALUES ("' . $name . '","' . $ic . '","' . $username . '","' . $country . '","' . $pn. '","' . $wp . '","' . $pe . '","' . $phone . '","' . $mobile . '","' . $email . '",
                                                                   "' . $ecp . '","' . $ecn . '","' . $ecr . '","' . $mail . '","' . $dob . '","' . $child . '","' . $joinDate . '","' . $resignDate . '",
                                                                   "' . $profile . '","' . $gender . '","' . $race . '","' . $religion . '","' . $marital . '",
                                                                   "' . $spouse . '",' . $GETbank . ',"' . $bankAccNum . '","' . $epf . '","' . $socso . '",
                                                                   "' . $itax . '",' . $zakat . ',' . $getID . ',"' . $dateOfDay . '");');
} else {
    $queryUpdate = mysql_query('INSERT INTO employee_edit (full_name,ic,username,country,passport,work_permit, passport_expiry,phone,mobile,email,contact_person,emergency,emergency_relationship,
                                                                   address,dob,num_of_kids,join_date,resign_date,
                                                                   profile,gender,race,religion,marital,
                                                                   spouse_work,bank_acc_id,bank_acc_num,epf_num,socso_num,
                                                                   income_tax_num,emp_id,date_edit)
                                                            VALUES ("' . $name . '","' . $ic . '","' . $username . '","' . $country . '","' . $pn. '","' . $wp . '","' . $pe . '","' . $phone . '","' . $mobile . '","' . $email . '",
                                                                   "' . $ecp . '","' . $ecn . '","' . $ecr . '","' . $mail . '","' . $dob . '","' . $child . '","' . $joinDate . '","' . $resignDate . '",
                                                                   "' . $profile . '","' . $gender . '","' . $race . '","' . $religion . '","' . $marital . '",
                                                                   "' . $spouse . '",' . $GETbank . ',"' . $bankAccNum . '","' . $epf . '","' . $socso . '",
                                                                   "' . $itax . '",' . $getID . ',"' . $dateOfDay . '");');
}

if ($queryUpdate) {
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