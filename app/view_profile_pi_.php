<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$userID = $_GET['viewId'];
include 'view_old_new.php';
$getID = $_GET['viewId'];

if (isset($_GET['t']) == true) {
    ?>
    <div id="pi" style="display:none; padding-top:15px;">
        <?php
    } else {
        echo '<div id="pi" style="padding-top:15px;">'; 
    }
    ?>
    <div id="editModePI">
        <table class="titleBarTo" style="width:98.5%;padding-right: 5px;">
            <tr>
                <td style="font-size:large;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;Personal Information
                </td>
                <?php if ($igen_a_hr == "a_hr_edit" || $user_id==$getID) { ?>
                    <td onclick="editPI(<?php echo $getID ?>)" id="editBut">Edit</td>  
                <?php } ?>
            </tr>
        </table>
        <div style="overflow:auto;width:94%;min-height: 500px;padding-top:20px;padding-left:20px;">
            <table>
                <tr>
                    <td style="padding-top:5px;width:200px;">Usernames</td>
                    <td style="width:250px;color:<?php echo $fontColoruname ?>; padding-top:5px;"><?php print $username; ?></td>
                </tr>
                <tr style="display: none;">
                    <td style="padding-top:5px;width:200px;">Profile</td>
                    <td style="padding-top:5px;color:<?php print $fontColorProfile ?>;"><?php print $row['profile']; ?></td>
                </tr>
				
				<?php  
	
				
				if($country =="Malaysia"){
				?>
                <tr>
                    <td style="padding-top:5px;width:200px;">IC</td>
                    <td style="padding-top:5px;color:<?php print $fontColorIc ?>;"><?php print $ic; ?></td>
                </tr>
				
				<?php
				}else{
				?>
				<tr>
                    <td style="padding-top:5px;width:200px;">Passport Number</td>
                    <td style="padding-top:5px;color:<?php print $fontColorp ?>;"><?php print $passport; ?></td>
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Passport Expiry</td>
                    <td style="padding-top:5px;color:<?php print $fontColorpe ?>;"><?php print date("d-m-Y", strtotime($passport_expiry)); ?></td>
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Work Permit</td>
                    <td style="padding-top:5px;color:<?php print $fontColorwp ?>;"><?php print $work_permit; ?></td>
                </tr>
			
				<?php
				
				}
				?>
                <tr>
                    <td style="padding-top:5px;width:200px;">Contact Number (Home)</td>
                    <td style="padding-top:5px;color:<?php print $fontColorPhone ?>;">
                        <?php
                        if ($phone != "") {
                            print $phone;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr> 
                <tr>
                    <td style="padding-top:5px;width:200px;">Contact Number (Mobile)</td>
                    <td style="padding-top:5px;color:<?php print $fontColorMobile ?>;"><?php print $mobile; ?></td>
                </tr>
				<tr>
                                    <td style="padding-top:5px;width:200px;">Emergency Contact</td>
                                    <td style="padding-top:5px"><?php print $row['contact_person']; ?></td>
                                </tr>
								<tr>
                                    <td style="padding-top:5px;width:200px;">Emergency Number</td>
                                    <td style="padding-top:5px"><?php print $row['emergency']; ?></td>
                                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Email</td>
                    <td style="padding-top:5px;color:<?php print $fontColorEmail ?>;"><?php print $email; ?></td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Address</td>
                    <td style="padding-top:5px;color:<?php print $fontColorMail ?>;">
                        <?php
                        if ($address != "") {
                            print $address;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Gender</td>
                    <td style="padding-top:5px;color:<?php print $fontColorGender ?>;">
                        <?php
                        if ($gender == 'F') {
                            echo 'Female';
                        } elseif ($gender == 'M') {
                            echo 'Male';
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px">Race</td>
                    <td style="padding-top:5px;color:<?php print $fontColorRace ?>;"><?php echo $race ?></td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px">Religion</td>
                    <td style="padding-top:5px;color:<?php print $fontColorReligion ?>;"><?php echo $religion ?></td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px">Marital Status</td>
                    <td style="padding-top:5px;color:<?php print $fontColorMarital ?>;">
                        <?php
                        if ($marital == 'M') {
                            echo 'Married';
                        } else if ($marital == 'D') {
                            echo 'Divorced';
                        } else if ($marital == 'S') {
                            echo 'Single';
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
				<tr>
								    <?php
                                        if ($row['spouse_name'] !="") {
										?>
                                    <td style="padding-top:5px;width:200px">Spouse Name</td>
                                    <td style="padding-top:5px;">
                                       <?php
                                            echo $row['spouse_name'];
                                      
                                        }else{
										?>
										<td style="padding-top:5px;width:200px">Spouse Name</td>
                                    <td style="padding-top:5px;">
                                       <?php
                                            echo "-";
										
										}
                                        ?>
                                    </td>
                                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Spouse Working</td>
                    <td style="padding-top:5px;color:<?php print $fontColorSpouse ?>;">
                        <?php
                        if ($spouseWork == 'N') {
                            echo 'No';
                        } else if ($spouseWork == 'Y') {
                            echo 'Yes';
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Number of Children</td>
                    <td style="padding-top:5px;color:<?php print $fontColorChild ?>;">
                        <?php
                        if ($child == "" || $child == 0) {
                            print "-";
                        } else {
                            print $child;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Date of Birth</td>
                    <td style="padding-top:5px;color:<?php print $fontColorDob ?>;">
                        <?php
                        $dateOfDay = date("Y-m-d");
                        $dateOfBirth = $row['dob'];

                        $yearOfDay = substr($dateOfDay, 0, 4);
                        $yearOfBirth = substr($dateOfBirth, 0, 4);
                        $age = $yearOfDay - $yearOfBirth;
                        $realAge = abs($age);
 
                        if ($realAge >= 55) {
                            echo date("d-m-Y", strtotime($dob)) ;
                        } else {
                            echo date("d-m-Y", strtotime($dob)) ;
                        }
                        ?>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px;">Join Date</td>
                    <td style="padding-top:5px;color:<?php print $fontColorJoin ?>;"><?php print date("d-m-Y", strtotime($join)); ?></td>
                </tr>
				 <tr>
                    <td style="padding-top:5px;width:200px">Confirm Date</td>
                    <td style="padding-top:5px;color:<?php// print $fontColorResign ?>;"><?php
                        if ($row['confirm_date']  != "0000-00-00" && $row['confirm_date'] != "") {
                            print date("d-m-Y", strtotime($row['confirm_date']));
                        } else {
                            print "-";
                        }
                        ?></td>
                </tr>
                <tr>
                    <td style="padding-top:5px;width:200px">Resign Date</td>
                    <td style="padding-top:5px;color:<?php //print $fontColorResign ?>;"><?php
                        if ($resign != "0000-00-00" && $resign != "") {
                            print date("d-m-Y", strtotime($resign));
                        } else {
                            print "-";
                        }
                        ?></td>
                </tr>
				
               
				
							<tr>
                    <td style="padding-top:5px;width:200px">Last Working Day</td>
                    <td style="padding-top:5px;color:<?php print $fontColorlastn ?>;"><?php
                        if ($rowGetOld['last_working_day']!= "0000-00-00" && $rowGetOld['last_working_day'] != "") {
                            print date("d-m-Y", strtotime($rowGetOld['last_working_day']));
                        } else {
                            print "-";
                        }
                        ?></td>
                </tr>
					<tr>
                    <td style="padding-top:5px;width:200px">Last Official Day</td>
                    <td style="padding-top:5px;color:<?php print $fontColoroff ?>;"><?php
                        if ($rowGetOld['officail_working_day'] != "0000-00-00" && $rowGetOld['officail_working_day']!= "") {
                            print date("d-m-Y", strtotime($rowGetOld['officail_working_day']));
                        } else {
                            print "-";
                        }
                        ?></td>
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px">Reason For Resign</td>
                    <td style="padding-top:5px;color:<?php print $fontColorReason ?>;"><?php
                        if ($rowGetOld['reasign_reason'] != " " && $rowGetOld['reasign_reason'] != "") {
                            print $rowGetOld['reasign_reason'];
                        } else {
                            print "-";
                        }
                        ?></td>
                </tr>
                <?php
                $sqlGetLeave = mysql_query('SELECT e.group_for_leave_id, g.group_name FROM group_for_leave AS g INNER JOIN employee AS e ON g.id=e.group_for_leave_id WHERE e.id=' . $getID);
                $rowGetLeave = mysql_fetch_array($sqlGetLeave);
                ?>
                <tr>
                    <td style="padding-top:6px;width:200px">Leave Group</td>
                    <td style="padding-top:6px;">
                        <?php
                        if ($rowGetLeave['group_for_leave_id'] != 0) {
                            print $rowGetLeave['group_name'];
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                </tr>
                <tr style="display: none;">
                    <td style="padding-top:6px;width:200px">Extra Information/Note</td> 
                    <td style="padding-top:6px;"><?php print $row['notes']; ?></td>
                </tr>
                <?php
                $sql1 = 'SELECT field_name, field_value FROM employee_info WHERE emp_id=' . $getID;
                $query1 = mysql_query($sql1);
                while ($row1 = mysql_fetch_array($query1)) {
                    echo '<tr><td style="padding-top:5px;width:200px;">' . $row1["field_name"] . '</td><td style="padding-top:5px;">' . $row1["field_value"] . '</td></tr>';
                }
                ?>
            </table>
        </div>
    </div>
</div>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>