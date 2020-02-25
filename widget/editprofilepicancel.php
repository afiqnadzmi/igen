<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$getID = $_POST['empid'];
$query = mysql_query('SELECT * FROM employee WHERE id=' . $getID . ';');
$row = mysql_fetch_array($query);


$sqlGetNew = mysql_query('SELECT * FROM employee_edit WHERE emp_id =' . $getID);
$rowGetNew = mysql_fetch_array($sqlGetNew);
$rowCount = mysql_num_rows($sqlGetNew);

$sqlGetOld = mysql_query('SELECT * FROM employee WHERE id =' . $getID);
$rowGetOld = mysql_fetch_array($sqlGetOld);

$userID = $getID;
include 'app/view_old_new.php';

if ($query) {
    echo'
        <table id="titlebar" class="titleBarTo"  style="width:98.5%; padding-right: 5px;">
            <tr>
                <td style="font-size:large;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;Personal Information
                </td>
                <td onclick="editPI(' . $getID . ')" id="editBut">Edit</td>
            </tr>
        </table>
        <div style="overflow:auto;width:94%;min-height: 500px; margin-bottom:11.8%">
		<p class="personal-information"> Personal Detail</p>
            <table style="padding-top:20px;padding-left:20px">
                <tr>
                    <td style="padding-top:5px;width:200px;">Username</td>
                    <td style="padding-top:5px">' . $row['username'] . '</td>
                </tr>
                <tr style="display: none;">
                    <td style="padding-top:5px;width:200px;">Profile</td>
                    <td style="padding-top:5px;color:' . $fontColorProfile . '">' . $row['profile'] . '</td>
                </tr>';
			      if($country=="Malaysia"){
                    echo'<tr><td style="padding-top:5px;width:200px;">IC</td>
                    <td style="padding-top:5px;color:' . $fontColorIc . '">'.$ic.'</td></tr>';
				  }else{
					  echo'<tr><td style="padding-top:5px;width:200px;">Passport</td>
							<td style="padding-top:5px;color:' . $fontColorp . '">'.$passport.'</td></tr>';
					 echo'<tr><td style="padding-top:5px;width:200px;">Passport Expiry</td>
							<td style="padding-top:5px;color:' . $fontColorpe . '">'.$passport_expiry.'</td></tr>';
					 echo'<tr><td style="padding-top:5px;width:200px;">Work Permit</td>
							<td style="padding-top:5px;color:' . $fontColorwp . '">'.$work_permit.'</td></tr>';
				  }						 				 
				echo'
                <tr>
                    <td style="padding-top:5px;width:200px;">Contact Number (Home)</td>
                    <td style="padding-top:5px;color:' . $fontColorPhone . '">';
    if ($phone != "") {
        echo $phone;
    } else {
        echo '-';
    }
    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Contact Number (Mobile)</td>
                    <td style="padding-top:5px;color:' . $fontColorMobile . '">' . $mobile . '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Email</td>
                    <td style="padding-top:5px;color:' . $fontColorEmail . '">' . $email . '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Address</td>
                    <td style="padding-top:5px;color:' . $fontColorMail . '">';
    if ($address != "") {
        echo $address;
    } else {
        echo '-';
    }
    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Gender</td>
                    <td style="padding-top:5px;color:' . $fontColorGender . '">';
    if ($gender == 'F') {
        echo 'Female';
    } else if ($gender == 'M') {
        echo 'Male';
    }
    echo '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px">Race</td>
                    <td style="padding-top:5px;;color:' . $fontColorRace . '">' . $race . '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px">Religion</td>
                    <td style="padding-top:5px;;color:' . $fontColorReligion . '">' . $religion . '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px">Marital Status</td>
                    <td style="padding-top:5px;;color:' . $fontColorMarital . '">';
    if ($marital == 'M') {
        echo 'Married';
    } else if ($marital == 'D') {
        echo 'Divorced';
    } else if ($marital == 'S') {
        echo 'Single';
    } else {
        echo '-';
    }

    echo '</td>
                </tr>
					<tr>
                    <td style="padding-top:5px;width:200px;">Spouse Name</td>
                    <td style="padding-top:5px;color:' . $fontColorSpouseName . '">';
					 if ($marital == 'M') {
								echo $spouse_name;
						}else{
							echo"-";
						}
			 echo'</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Spouse Working</td>
                    <td style="padding-top:5px;color:' . $fontColorSpouse . '">';
    if ($spouseWork == 'N') {
        echo 'No';
    } else if ($spouseWork == 'Y') {
        echo 'Yes';
    } else {
        echo '-';
    }


    echo '</td>
                </tr>
                    <td style="padding-top:5px;width:200px;">Number of Children</td>
                    <td style="padding-top:5px;color:' . $fontColorChild . '">' . $child . '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Date of Birth</td>
                    <td style="padding-top:5px;color:' . $fontColorDob . '">';
    $dateOfDay = date("Y-m-d");
    $dateOfBirth = $row['dob'];

    $yearOfDay = substr($dateOfDay, 0, 4);
    $yearOfBirth = substr($dateOfBirth, 0, 4);
    $age = $yearOfDay - $yearOfBirth;
    $realAge = abs($age);

    if ($realAge >= 55) {
        echo $dob . ' (Category 2)';
    } else {
        echo $dob . ' (under 55)';
    }

    echo '</tr>
                <tr>
                <tr>
                    <td style="padding-top:3px;width:200px;">Join Date</td>
                    <td style="padding-top:3px;color:' . $fontColorJoin . '">' . $join . '</td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px">Resign Date</td>
                    <td style="padding-top:5px;color:' . $fontColorResign . '">';
    if ($resign != "0000-00-00" && $resign != "") {
        print $resign;
    } else {
        print "-";
    }
    echo '</td>
                </tr>';
    
    $sqlGetLeave = mysql_query('SELECT e.group_for_leave_id, g.group_name FROM group_for_leave AS g INNER JOIN employee AS e ON g.id=e.group_for_leave_id WHERE e.id=' . $getID);
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
                        </tr>
		</table>
		<table>
			    <p class="personal-information">Next of kin</p>
				<tr>
                    <td style="padding-top:5px;width:200px;">Emergency Contact</td>
                    <td style="padding-top:5px">' . $row['contact_person'] . '</td>
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Emergency Number</td>
                    <td style="padding-top:5px">' . $row['emergency'] . '</td>
                </tr>
	    </table><table>
            <tr style="display: none;">
                    <td style="padding-top:6px;width:200px">Extra Information/Note</td>
                    <td style="padding-top:6px;">' . $row["notes"] . '</td>
                </tr>';

    $sql1 = 'SELECT field_name, field_value FROM employee_info WHERE emp_id=' . $getID;
    $query1 = mysql_query($sql1);
	if($query1>0){
		echo'<p class="personal-information">Extra Information</p>';
		while ($row1 = mysql_fetch_array($query1)) {
			echo '<tr><td style="padding-top:5px;width:200px;">' . $row1["field_name"] . '</td><td style="padding-top:5px;">' . $row1["field_value"] . '</td></tr > ';
		}
    }
    echo '</table></div>';
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