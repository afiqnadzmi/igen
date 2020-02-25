<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$userID = $_POST['id'];

include 'app/view_old_new.php';


$id = $_POST['id'];
$ic = $_POST['ic'];
$phone = $_POST['phone'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$mail = $_POST['address'];
$reasnresign= $_POST['reasnresign'];
$race = $_POST['race'];
$profile = $_POST['profile'];
$e_date_pk_fz=$_POST['e_date_pk_fz'];
$e_date_westport=$_POST['e_date_westport'];
$e_date_johor_port=$_POST['e_date_johor_port'];
$e_date_ptp=$_POST['e_date_ptp'];
$e_date_tlp=$_POST['e_date_tlp'];
$e_date_north_port=$_POST['e_date_north_port'];
$wpep=$_POST['wpep']; 
if($wpep!=""){
	$wpep=date("Y-m-d", strtotime($wpep));
}else{
	$wpep="0000-00-00";
}

$dob =$_POST['dob'];
$joinDate = $_POST['joindate'];

if($joinDate!=""){
	$joinDate= date("Y-m-d", strtotime($_POST['joindate']));
}else{
	$joinDate="0000-00-00";
}
if($dob!=""){
	$dob= date("Y-m-d", strtotime($_POST['dob']));
}else{
	$dob="0000-00-00";
}
if($lastDateTex!=""){
	$lastDateText= date("Y-m-d", strtotime($_POST['lastDateText']));
}else{
	$lastDateTex="0000-00-00";
}
if($offDateText!=""){
	$offDateText= date("Y-m-d", strtotime($_POST['offDateText']));
}else{
	$offDateText="0000-00-00";
}
$pn=$_POST['pn'];
$pe=$_POST['pe'];
$wp=$_POST['wp'];
$country=$_POST['country'];
//$pe=date("Y-m-d", strtotime($pe));
if($pe!=""){
	$pe= date("Y-m-d", strtotime($_POST['pe']));
}else{
	$pe="0000-00-00";
}

if(trim($_POST['resigndate'])!=""){
	$resignDate = date("Y-m-d", strtotime($_POST['resigndate']));
}else{
	$resignDate="0000-00-00";
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
if($e_date_north_port!=""){
    $e_date_north_port= date("Y-m-d", strtotime($_POST['e_date_north_port']));
}else{
    $e_date_north_port="0000-00-00";
}
$gender = $_POST['gender'];
$marital = $_POST['marital'];
$spouse = $_POST['spouse'];
$child = $_POST['child'];
$category = $_POST['category'];
$religion = $_POST['religion'];
$username = $_POST['username'];
$leaveGroup = $_POST['leaveGroup'];
$confirm=$_POST['confirm'];
$extrainfo = $_POST["extrainfo"];
$spouse_company=$_POST["spouse_company"];
if($confirm!=""){
	$confirm= date("Y-m-d", strtotime($_POST['confirm']));
}else{
	$confirm="0000-00-00";
}
$countedit = $totaledit - $piedit;

$type = $_POST['type'];
$emergency_cont = $_POST['emergency_contact'];
$emergency_num = $_POST['emergency_num'];
$emergency_rel = $_POST['emergency_relationship'];
$kin_emergency_cont = $_POST['kin_emergency_contact'];
$kin_emergency_num = $_POST['kin_emergency_num'];
$kin_emergency_rel = $_POST['kin_emergency_relationship'];
$kin_ic = $_POST['kin_ic'];

$spousename = $_POST['spousename'];


$queryEDIT = mysql_query('UPDATE employee SET
                                    phone = "' . $phone . '",
									username = "' . $username . '",
                                    mobile = "' . $mobile . '",
                                    email = "' . $email . '",
                                    ic = "' . $ic . '",
									passport = "' . $pn . '",
									work_permit = "' . $wp . '",
									passport_expiry = "' . $pe . '",
									work_permit_expirty = "' . $wpep . '",
                                    address = "' . $mail . '",
                                    join_date = "' . $joinDate . '",
									confirm_date = "' . $confirm . '",
                                    resign_date = "' . $resignDate . '",
									last_working_day = "' . $lastDateText . '",
									officail_working_day ="' . $offDateText . '",
									reasign_reason = "' . $reasnresign . '",
                                    gender = "' . $gender . '",
                                    race = "' . $race . '",
                                    religion = "' . $religion . '",
                                    marital = "' . $marital . '",
                                    dob = "' . $dob . '",
                                    spouse_work = "' . $spouse . '",
									spouse_company = "' . $spouse_company . '",
                                    contact_person= "' . $emergency_cont . '",
									emergency = "' . $emergency_num . '",
									emergency_relationship = "' .$emergency_rel. '",
                                    kin_contact_person= "' . $kin_emergency_cont . '",
                                    kin_emergency = "' . $kin_emergency_num . '",
                                    kin_emergency_relationship = "' .$kin_emergency_rel. '",
                                    kin_ic = "' .$kin_ic. '",
									spouse_name = "' . $spousename . '",
									num_of_kids = "' . $child . '",
									e_date_pk_fz = "' . $e_date_pk_fz . '",
									e_date_westport = "' . $e_date_westport . '",
									e_date_johor_port = "' . $e_date_johor_port . '",
									e_date_ptp = "' . $e_date_ptp . '",
									e_date_tlp = "' . $e_date_tlp . '",
                                    e_date_north_port = "' . $e_date_north_port . '",
                                    group_for_leave_id = ' . $leaveGroup . '
                                    WHERE id=' . $id . ';');


 

 $queryEDIT1 = mysql_query('DELETE FROM employee_edit WHERE emp_id =' . $id);

$sql = 'DELETE FROM employee_info WHERE emp_id = ' . $id;
$query = mysql_query($sql);

if ($extrainfo != "") {
    $extrainfo1 = explode(';', $extrainfo);
    for ($i = 0; $i < count($extrainfo1) - 1; $i++) {
        $extrainfo2 = explode(',', $extrainfo1[$i]);
        $sql1 = 'INSERT INTO employee_info (emp_id, field_name, field_value) VALUES (' . $id . ', "' . $extrainfo2[0] . '", "' . $extrainfo2[1] . '")';
        $query1 = mysql_query($sql1);
    }
}

//Passaport, Work Permit and Passes extenstion record
$passport_expiry = $rowGetOld['passport_expiry'];
$work_permitn= $rowGetOld['work_permit'];
$work_permit_expiry = $rowGetOld['work_permit_expirty'];
$passport = $rowGetOld['passport'];
$e_date_pk_fz_old = $rowGetOld['e_date_pk_fz'];
$e_date_westport_old = $rowGetOld['e_date_westport'];
$e_date_johor_port_old = $rowGetOld['e_date_johor_port'];
$e_date_ptp_old = $rowGetOld['e_date_ptp'];
$e_date_tlp_old = $rowGetOld['e_date_tlp'];
$e_date_north_port_old = $rowGetOld['e_date_north_port'];

if($_POST['renew_passport']=="yes"){ // Insert Passport Renewal 
	if(($passport!="" && $pn!=$passport && $pn!="") || ($pe!="0000-00-00" && $pe!=$passport_expiry)){
	
		$sql3 =mysql_query('INSERT INTO employee_renewal (emp_id,type,number,expired_date, renew_date,updated_date, updated_by) VALUES ("' . $id . '","Passport","' . $passport . '","' . $passport_expiry . '", "' . date("Y-m-d", strtotime($_POST['pissue_date'])) . '", "' . date("Y-m-d") . '", "' . $_COOKIE['igen_user_id'] . '")');
	}
}

if($_POST['renew_workPermit']=="yes"){// Insert Work Permit Renewal
	if(($work_permit!="" && $wp!=$work_permit && $wp!="") || ($wpep!="0000-00-00" && $wpep!=$work_permit_expiry)){
		$sql3 = mysql_query('INSERT INTO employee_renewal (emp_id,type,number,expired_date, renew_date,updated_date, updated_by) VALUES ("' . $id . '", "Work Permit","' . $work_permit . '","' . $work_permit_expiry . '", "' . date("Y-m-d", strtotime($_POST['wp_issuedate'])) . '", "' . date("Y-m-d") . '", "' . $_COOKIE['igen_user_id'] . '")');
	}
}

if($_POST['renew_pkfz']=="yes"){// Insert K FZ Pass Renewal
	if(($e_date_pk_fz_old!="0000-00-00" && $e_date_pk_fz!="0000-00-00" && $e_date_pk_fz!=$e_date_pk_fz_old)){
		$sql3 = mysql_query('INSERT INTO employee_renewal (emp_id,type,expired_date, renew_date,updated_date, updated_by) VALUES ("' . $id . '", "K FZ Pass","' . $e_date_pk_fz_old . '", "' . date("Y-m-d", strtotime($_POST['pkfz_issuedate'])) . '", "' . date("Y-m-d") . '", "' . $_COOKIE['igen_user_id'] . '")');
	}
}
if($_POST['renew_westport']=="yes"){// Insert Westport Pass Renewal
	if(($e_date_westport_old!="0000-00-00" && $e_date_westport!="0000-00-00" && $e_date_westport!=$e_date_westport_old)){
		$sql3 = mysql_query('INSERT INTO employee_renewal (emp_id,type,expired_date,renew_date,updated_date, updated_by) VALUES ("' . $id . '", "Westport Pass","' . $e_date_westport_old . '", "' . date("Y-m-d", strtotime($_POST['westport_issuedate'])) . '", "' . date("Y-m-d") . '", "' . $_COOKIE['igen_user_id'] . '")');
	}
}
if($_POST['renew_johor']=="yes"){// Insert Johor Port Pass Renewal
	if(($e_date_johor_port_old!="0000-00-00" && $e_date_johor_port!="0000-00-00" && $e_date_johor_port!=$e_date_johor_port_old)){
		$sql3 = mysql_query('INSERT INTO employee_renewal (emp_id,type,expired_date,renew_date,updated_date, updated_by) VALUES ("' . $id . '", "Johor Port Pass","' . $e_date_johor_port_old . '", "' . date("Y-m-d", strtotime($_POST['johor_issuedate'])) . '", "' . date("Y-m-d") . '", "' . $_COOKIE['igen_user_id'] . '")');
	}
}
if($_POST['renew_ptp']=="yes"){// Insert PTP Pass Renewal
	if(($e_date_ptp_old!="0000-00-00" && $e_date_ptp!="0000-00-00" && $e_date_ptp!=$e_date_ptp_old)){
		$sql3 = mysql_query('INSERT INTO employee_renewal (emp_id,type,expired_date,renew_date,updated_date, updated_by) VALUES ("' . $id . '", "PTP Pass","' . $e_date_ptp_old . '", "' . date("Y-m-d", strtotime($_POST['ptp_issuedate'])) . '", "' . date("Y-m-d") . '", "' . $_COOKIE['igen_user_id'] . '")');
	}
}
if($_POST['renew_tpl']=="yes"){// Insert TPL Pass Renewal
	if(($e_date_tlp_old!="0000-00-00" && $e_date_tlp!="0000-00-00" && $e_date_tlp!=$e_date_tlp_old)){
		$sql3 = mysql_query('INSERT INTO employee_renewal (emp_id,type,expired_date,renew_date,updated_date, updated_by) VALUES ("' . $id . '", "PTP Pass","' . $e_date_tlp_old . '", "' . date("Y-m-d", strtotime($_POST['tpl_issuedate'])) . '", "' . date("Y-m-d") . '", "' . $_COOKIE['igen_user_id'] . '")');
	}
}
if($_POST['renew_north_port']=="yes"){// Insert TPL Pass Renewal
    if(($e_date_north_port_old!="0000-00-00" && $e_date_north_port!="0000-00-00" && $e_date_north_port!=$e_date_north_port_old)){
        $sql3 = mysql_query('INSERT INTO employee_renewal (emp_id,type,expired_date,renew_date,updated_date, updated_by) VALUES ("' . $id . '", "North Port Pass","' . $e_date_north_port_old . '", "' . date("Y-m-d", strtotime($_POST['NorthPort_issuedate'])) . '", "' . date("Y-m-d") . '", "' . $_COOKIE['igen_user_id'] . '")');
    }
}

if ($queryEDIT) {

    $query = mysql_query('SELECT * FROM employee WHERE id=' . $id . ';');
    $row = mysql_fetch_array($query);

    echo '<table id="titlebar" class="titleBarTo" style="width:98.5%; padding-right: 5px;">
            <tr>
                <td style="font-size:large;font-weight: bold;">
                    &nbsp;&nbsp; Personal Information
                </td>
                <td onclick="editPI(' . $id . ')" id="editBut">Edit</td>
            </tr>
        </table>
        <div style="overflow:auto;width:94%;min-height: 500px; margin-bottom:11.5%">
			<p class="personal-information"> Personal Detail</p>
            <table style="padding-top:20px;padding-left:20px">
                <tr>
                    <td style="padding-top:5px;width:200px;">Username</td>
                    <td style="padding-top:5px">' . $row['username'] . '</td>
                </tr>
                <tr style="display:none;">
                    <td style="padding-top:5px;width:200px;">Profile:</td>
                    <td style="padding-top:5px">' . $row['profile'] . '</td>
                </tr>';
				
				if($country =="Malaysia"){
               echo '<tr>
                    <td style="padding-top:5px;width:200px;">IC</td>
                    <td style="padding-top:5px">' . $row['ic'] . '</td>
                </tr>';
				}else{
				
				echo '<tr>
                    <td style="padding-top:5px;width:200px;">Passport Number</td>
                    <td style="padding-top:5px">' . $row['passport'] . '</td>
                </tr>';
				echo '<tr>
                    <td style="padding-top:5px;width:200px;">Passport Expiry</td>
                    <td style="padding-top:5px">' . $row['passport_expiry'] . '</td>
                </tr>';
				echo '<tr>
                    <td style="padding-top:5px;width:200px;">Work Permit</td>
                    <td style="padding-top:5px">' . $row['work_permit'] . '</td>
                </tr>';
				}
				
               echo'<tr>
                    <td style="padding-top:5px;width:200px;">Contact Number (Home)</td>
                    <td style="padding-top:5px">';
    if ($row['phone'] != "") {
        echo $row['phone'];
    } else {
        echo '-';
    }
    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Contact Number (Mobile)</td>
                    <td style="padding-top:5px">' . $row['mobile'] . '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Email</td>
                    <td style="padding-top:5px">' . $row['email'] . '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Address 1</td>
                    <td style="padding-top:5px">';
                        if ($row['address'] != "") {
                            echo $row['address'];
                        } else {
                            echo '-';
                        }
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Address 2</td>
                    <td style="padding-top:5px">';
                        if ($row['address1'] != "") {
                            echo $row['address1'];
                        } else {
                            echo '-';
                        }
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Postal Code</td>
                    <td style="padding-top:5px">';
                        if ($row['postal_code'] != "") {
                            echo $row['postal_code'];
                        } else {
                            echo '-';
                        }
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">City</td>
                    <td style="padding-top:5px">';
                        if ($row['city'] != "") {
                            echo $row['city'];
                        } else {
                            echo '-';
                        }
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">State</td>
                    <td style="padding-top:5px">';
                        if ($row['state'] != "") {
                            echo $row['state'];
                        } else {
                            echo '-';
                        }
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Country</td>
                    <td style="padding-top:5px">';
                        if ($row['adrsCountry'] != "") {
                            echo $row['adrsCountry'];
                        } else {
                            echo '-';
                        }
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Gender</td>
                    <td style="padding-top:5px">';
    if ($row['gender'] == 'F') {
        echo 'Female';
    } else if ($row['gender'] == 'M') {
        echo 'Male';
    } else {
        echo '-';
    }

    echo '  </td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px">Race</td>
                    <td style="padding-top:5px;">' . $row['race'] . '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px">Religion</td>
                    <td style="padding-top:5px;">' . $row['religion'] . '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px">Marital Status</td>
                    <td style="padding-top:5px;">';
    if ($row['marital'] == 'M') {
        echo 'Married';
    } else if ($row['marital'] == 'D') {
        echo 'Divorced';
    } else if ($row['marital'] == 'S') {
        echo 'Single';
    } else {
        echo '-';
    }

    echo '</td>
                </tr>';
				
				echo'<tr>
                    <td style="padding-top:5px;width:200px;">Spouse Name</td>
                    <td style="padding-top:5px;">';

    if ($row['spouse_name'] !="") {
    
       echo $row["spouse_name"];
    } else {
        echo '-';
    }
 echo'</td></tr>';

   
				echo'<tr>
                    <td style="padding-top:5px;width:200px;">Spouse Working</td>
                    <td style="padding-top:5px;">';

    if ($row['spouse_work'] == 'N') {
        echo 'No';
    } else if ($row['spouse_work'] == 'Y') {
        echo 'Yes';
    } else {
        echo '-';
    }


    echo '</td>
         </tr>';
	echo'<tr>
          <td style="padding-top:5px;width:200px;">Company Name</td>
          <td style="padding-top:5px;">';

			if ($row['spouse_company'] != '') {
				echo $row['spouse_company'];
			}else {
				echo '-';
			}


			echo '</td>
         </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Number of Children</td>
                    <td style="padding-top:5px">' . $row['num_of_kids'] . '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Date of Birth</td>
                    <td style="padding-top:5px">';
    $dateOfDay = date("Y-m-d");
    $dateOfBirth = $row['dob'];

    $yearOfDay = substr($dateOfDay, 0, 4);
    $yearOfBirth = substr($dateOfBirth, 0, 4);
    $age = $yearOfDay - $yearOfBirth;
    $realAge = abs($age);

    if ($realAge <= 55) {
        echo date("d-m-Y", strtotime($row['dob'])).' ('.$realAge.')';
    } else {
        echo date("d-m-Y", strtotime($row['dob'])) . ' (above 55)';
    }
    echo '</tr><tr>
                    <td style="padding-top:5px;width:200px;">Join Date</td>
                    <td style="padding-top:5px">'; //. date("d-m-Y", strtotime($row['join_date'])) .
                    if ($row['join_date'] != "0000-00-00" && $row['join_date'] != "") {
                        print date("d-m-Y", strtotime($row['join_date']));
                    } else {
                        print "-";
                    }
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Confirm Date</td>
                    <td style="padding-top:5px">'; //. date("d-m-Y", strtotime($row['confirm_date'])) .
                    if ($row['confirm_date'] != "0000-00-00" && $row['confirm_date'] != "") {
                        print date("d-m-Y", strtotime($row['confirm_date']));
                    } else {
                        print "-";
                    }
                    echo '</td>
                </tr>
				
                <tr>
                    <td style="padding-top:5px;width:200px">Resign Date</td>
                    <td style="padding-top:5px;">';
    if ($row['resign_date'] != "0000-00-00" && $row['resign_date'] != "") {
        print date("d-m-Y", strtotime($row['resign_date']));
    } else {
        print "-";
    }
    echo '</td>
                </tr>';

    $sqlGetLeave = mysql_query('SELECT e.group_for_leave_id, g.group_name FROM group_for_leave AS g INNER JOIN employee AS e ON g.id=e.group_for_leave_id WHERE e.id=' . $id);
    $rowGetLeave = mysql_fetch_array($sqlGetLeave);
    echo '<tr>
                            <td style="padding-top:6px;width:200px">Leave Group</td>
                            <td style="padding-top:6px;">';
    if ($rowGetLeave['group_for_leave_id'] != 0) {
        echo $rowGetLeave['group_name'];
    } else {
        echo '-';
    }
    echo '</td>
                        </tr></table>
		<table>
			    <p class="personal-information">Emergency Contact Detail</p>
				<tr>
                    <td style="padding-top:5px;width:200px;">Emergency Contact Person</td>
                    <td style="padding-top:5px">' . $row['contact_person'] . '</td>
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Emergency Contact Number</td>
                    <td style="padding-top:5px">' . $row['emergency'] . '</td>
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Emergency Contact Relationship</td>
                    <td style="padding-top:5px">'; //. $row['emergency_relationship'] . 
                    if ($row['emergency_relationship'] != " " && $row['emergency_relationship'] != "") {
                        print $row['emergency_relationship'];
                    } else {
                        print "-";
                    }
                    echo '</td>
                </tr>
	    </table>

        <table>
                <p class="personal-information">Next of Kin Detail</p>
                <tr>
                    <td style="padding-top:5px;width:200px;">Next Of Kin Name</td>
                    <td style="padding-top:5px">' . $row['kin_contact_person'] . '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Next Of Kin Contact Number</td>
                    <td style="padding-top:5px">'; //. $row['kin_emergency'] .
                    if ($row['kin_emergency'] != " " && $row['kin_emergency'] != "") {
                        print $row['kin_emergency'];
                    } else {
                        print "-";
                    }
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Next Of Kin Contact Relationship</td>
                    <td style="padding-top:5px">'; //. $row['kin_emergency_relationship'] . 
                    if ($row['kin_emergency_relationship'] != "0000-00-00" && $row['kin_emergency_relationship'] != "") {
                        print $row['kin_emergency_relationship'];
                    } else {
                        print "-";
                    }
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Next Of Kin IC</td>
                    <td style="padding-top:5px">' . $row['kin_ic'] . '</td>
                </tr>
        </table>
                   
         <table>
                <p class="personal-information">Pass Expiry</p>
                <tr>
                    <td style="padding-top:5px;width:200px;">PKFZ Expiry Date (Pass)</td>
                    <td style="padding-top:5px">';
                    if ($row['e_date_pk_fz']!= "0000-00-00" && $row['e_date_pk_fz'] != "") {
                        echo date("d-m-Y", strtotime($row['e_date_pk_fz']));
                    } else {
                        echo "-";
                    } 
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Westport Expiry Date (Pass)</td>
                    <td style="padding-top:5px">'; 
                    if ($row['e_date_westport']!= "0000-00-00" && $row['e_date_westport'] != "") {
                        echo date("d-m-Y", strtotime($row['e_date_westport']));
                    } else {
                        echo "-";
                    } 
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Johor Port Expiry Date (Pass)</td>
                    <td style="padding-top:5px">';
                    if ($row['e_date_johor_port']!= "0000-00-00" && $row['e_date_johor_port'] != "") {
                        echo date("d-m-Y", strtotime($row['e_date_johor_port']));
                    } else {
                        echo "-";
                    }  
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">PTP Expiry Date (Pass)</td>
                    <td style="padding-top:5px">'; 
                    if ($row['e_date_ptp']!= "0000-00-00" && $row['e_date_ptp'] != "") {
                        echo date("d-m-Y", strtotime($row['e_date_ptp']));
                    } else {
                        echo "-";
                    } 
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">TLP Expiry Date (Pass)</td>
                    <td style="padding-top:5px">';
                    if ($row['e_date_tlp']!= "0000-00-00" && $row['e_date_tlp'] != "") {
                        echo date("d-m-Y", strtotime($row['e_date_tlp']));
                    } else {
                        echo "-";
                    } 
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">North Port Expiry Date (Pass)</td>
                    <td style="padding-top:5px">'; 
                    if ($row['e_date_north_port']!= "0000-00-00" && $row['e_date_north_port'] != "") {
                        echo date("d-m-Y", strtotime($row['e_date_north_port']));
                    } else {
                        echo "-";
                    } 
                    echo '</td>
                </tr>
        </table>

        <table>
                <p class="personal-information">Resign Details</p>
                <tr>
                    <td style="padding-top:5px;width:200px;">Resign Date</td>
                    <td style="padding-top:5px">';
                    if ($row['resign_date']!= "0000-00-00" && $row['resign_date'] != "") {
                        echo date("d-m-Y", strtotime($row['resign_date']));
                    } else {
                        echo "-";
                    } 
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Last Working Day</td>
                    <td style="padding-top:5px">';   
                    if ($row['last_working_day']!= "0000-00-00" && $row['last_working_day'] != "") {
                        echo date("d-m-Y", strtotime($row['last_working_day']));
                    } else {
                        echo "-";
                    }
                    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Reason For Resign</td>
                    <td style="padding-top:5px">'; 
                    if ($row['reasign_reason']!= "0000-00-00" && $row['reasign_reason'] != "") {
                        echo date("d-m-Y", strtotime($row['reasign_reason']));
                    } else {
                        echo "-";
                    }
                    echo '</td>
                </tr>
        </table>
                    
         <table>     
    		 <tr style="display: none;">
                    <td style="padding-top:6px;width:200px">Extra Information/Note</td>
                    <td style="padding-top:6px;">' . $row["notes"] . '</td>
                </tr>';

    $sql1 = 'SELECT field_name, field_value FROM employee_info WHERE emp_id=' . $id;
    $query1 = mysql_query($sql1);
	if($query1>0){
		echo'<p class="personal-information">Extra Information</p>';
		while ($row1 = mysql_fetch_array($query1)) {
			echo '<tr><td style="padding-top:5px;width:200px;">' . $row1["field_name"] . '</td><td style="padding-top:5px;">' . $row1["field_value"] . '</td></tr > ';
		}
	}
    echo '</table>
        </div>';
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