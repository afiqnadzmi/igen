<?php
/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn. Bhd. */

$queryDept = mysql_query('SELECT d.id,d.dep_name FROM department AS d INNER JOIN employee AS e ON d.id = e.dep_id WHERE e.id = ' . $getID . ';');
$rowDept = mysql_fetch_array($queryDept);

$queryGroup = mysql_query('SELECT g.id,g.group_name FROM emp_group AS g INNER JOIN employee AS e ON g.id = e.group_id WHERE e.id=' . $getID . ';');
$rowGroup = mysql_fetch_array($queryGroup);

$queryLevel = mysql_query('SELECT l.id,l.name FROM level AS l INNER JOIN employee AS e ON l.id = e.level_id WHERE e.id = ' . $getID . ';');
$rowLevel = mysql_fetch_array($queryLevel);

$queryPos = mysql_query('SELECT p.id,p.position_name FROM position AS p INNER JOIN employee AS e ON p.id = e.position_id WHERE e.id = ' . $getID . ';');
$rowPos = mysql_fetch_array($queryPos);

$queryBranch = mysql_query('SELECT b.id,b.branch_code FROM branch AS b INNER JOIN employee AS e ON b.id = e.branch_id WHERE e.id = ' . $getID . ';');
$rowBranch = mysql_fetch_array($queryBranch);

$queryCompany = mysql_query('SELECT c.id, c.code FROM company AS c INNER JOIN employee AS e ON c.id = e.company_id WHERE e.id = ' . $getID . ';');
$rowCompany = mysql_fetch_array($queryCompany);


$sqlGetNew = mysql_query('SELECT * FROM employee_edit WHERE emp_id =' . $getID);
$rowGetNew = mysql_fetch_array($sqlGetNew);
$numRow = mysql_num_rows($sqlGetNew);

$sqlGetOld = mysql_query('SELECT * FROM employee WHERE id =' . $getID);
$rowGetOld = mysql_fetch_array($sqlGetOld);
include 'edit_eprofile_validate.php';

?>

<div style="padding: 5px 10px;"><span class="_14 red">* - Mandatory Fields</span></div>
<table>
    <tr>
        <td>
           
                
                <table>
                    <tr>
                        <td style="padding-top:6px;width:150px">Full Name<span class="red"> *</span></td>
                        <td style="padding-top:6px;"><input id="fullNameText" style="width:250px;color:<?php echo $fontColorName ?>;" type="Text" value="<?php echo $name ?>" /></td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgName ?>;"/></td>
                    </tr>
					<?php
					if($rowGetOld['country']=="Malaysia"){
					
					?>
                    <tr>
                        <?php
                        $ic_edit = explode('-', $ic);
                        ?>
                        <td style="padding-top:6px;width:200px">IC<span class="red"> *</span></td>
                        <td style="padding-top:6px;">
                            <input id="ICText1" style="width:60px;color:<?php echo $fontColorIc ?>;" type="Text" maxlength="6" value="<?php echo $ic_edit[0]; ?>" />&nbsp;-&nbsp;<input id="ICText2" style="width:30px;color:<?php echo $fontColorIc ?>;" type="Text" maxlength="2" value="<?php echo $ic_edit[1]; ?>" />&nbsp;-&nbsp;<input id="ICText3" style="width:80px;color:<?php echo $fontColorIc ?>;" type="Text" maxlength="4" value="<?php echo $ic_edit[2]; ?>" />
                        </td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgIc ?>;"/></td>
                    </tr>
					
					<?php
					}else{
					
					?>
					<tr>
					 <td style="padding-top:6px;width:200px">Passport<span class="red"> *</span></td>
                        <td style="padding-top:6px;">
                            <input id="pass" style="width:250px;color:<?php echo $fontColorp ?>;" type="Text" value="<?php echo  $passport; ?>">
                        </td>
						<td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgp ;?>"/></td>
						</tr>
						<tr>
					 <td style="padding-top:6px;width:200px">Passport Expiry<span class="red"> *</span></td>
                        <td style="padding-top:6px;">
                            <input id="pe" style="width:250px;color:<?php echo $fontColorpe ?>;" type="Text" value="<?php echo  date("d-m-Y", strtotime($passport_expiry)); ?>">
                        </td>
						<td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgpe ;?>"/></td>
						</tr>
						<tr>
					 <td style="padding-top:6px;width:200px">Work Permit<span class="red"> *</span></td>
                        <td style="padding-top:6px;">
                            <input id="wp" style="width:250px;color:<?php echo $fontColorwp ?>;" type="Text" value="<?php echo  $work_permit; ?>">
                        </td>
						<td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgwp; ?>"/></td>
						</tr>
						
						<?php
						}
						?>
                    <tr>
                        <td style="padding-top:6px;width:150px">Contact Number (Home)</td>
                        <td style="padding-top:6px;"><input id="phoneText" style="width:250px;color:<?php echo $fontColorPhone ?>;" type="Text" value="<?php echo $phone ?>" /></td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgPhone ?>;"/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:150px">Contact Number (Mobile)<span class="red"> *</span></td>
                        <td style="padding-top:6px;"><input id="mobileText" style="width:250px;color:<?php echo $fontColorMobile ?>;" type="Text" value="<?php echo $mobile ?>" /></td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgMobile ?>;"/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:150px">Email Address<span class="red"> *</span></td>
                        <td style="padding-top:6px;"><input id="emailAddText" style="width:250px;color:<?php echo $fontColorEmail ?>;" type="Text" value="<?php echo $email ?>" /></td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgEmail ?>;"/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:150px;" valign="top">Mailing Address</td>
                        <td style="padding-top:6px;"><textarea id="mailAddText" style="height:90px;width:250px;color:<?php echo $fontColorMail ?>;"><?php echo $address ?></textarea></td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgAddress ?>;"/></td>
                    </tr>
                    <tr>
                        <td style="width:30px">Gender<span class="red"> *</span></td>
                        <td style="">
                            <select id="dropGender" style="width:250px;color:<?php echo $fontColorGender ?>;">
                                <option value="0">--Please Select--</option>
                                <option value="M" <?php
                        if ($gender == 'M') {
                            echo 'selected = "selected"';
                        }
                        ?>>Male</option>
                                <option value="F" <?php
                                        if ($gender == 'F') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Female</option>
                            </select>
                        </td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgGender ?>;"/></td>
                    </tr></table>
					<table style="position:relative; top:-325px; left:500px">
                    <tr>
                        <td style="padding-top:6px;width:200px">Race<span class="red"> *</span></td>
                        <td style="padding-top:6px;">
                            <select id="dropRace" style="width:250px;color:<?php echo $fontColorRace ?>;">
                                <option value="0">--Please Select--</option>
                                <option value="Chinese" <?php
                                        if ($race == 'Chinese') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Chinese</option>
                                <option value="Indian" <?php
                                        if ($race == 'Indian') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Indian</option>
                                <option value="Malay" <?php
                                        if ($race == 'Malay') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Malay</option>
                                <option value="Others" <?php
                                        if ($race == 'Others') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Others</option>
                            </select>
                        </td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgRace ?>;"/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Religion<span class="red"> *</span></td>
                        <td style="padding-top:6px;">
                            <select id="dropReligion" style="width:250px;color:<?php echo $fontColorReligion ?>;">
                                <option value="0">--Please Select--</option>
                                <option value="Buddhist" <?php
                                        if ($religion == 'Buddhist') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Buddhist</option>
                                <option value="Catholic" <?php
                                        if ($religion == 'Catholic') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Catholic</option>
                                <option value="Christian" <?php
                                        if ($religion == 'Christian') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Christian</option>
                                <option value="Hindu" <?php
                                        if ($religion == 'Hindu') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Hindu</option>
                                <option value="Islam" <?php
                                        if ($religion == 'Islam') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Islam</option>
                                <option value="Others" <?php
                                        if ($religion == 'Others') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Others</option>
                            </select>
                        </td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgReligion ?>;"/></td>
                    </tr>

                    <tr>
                        <td style="padding-top:6px;width:200px">Marital Status<span class="red"> *</span></td>
                        <td style="padding-top:6px;width:200px;">
                            <select id="dropMarital" style="width:250px;color:<?php echo $fontColorMarital ?>;" onchange="checkMarital(this.value)">
                                <option value="0">--Please Select--</option>
                                <option value="S" <?php
                                        if ($marital == 'S') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Single</option>
                                <option value="M" <?php
                                        if ($marital == 'M') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Married</option>
                                <option value="D" <?php
                                        if ($marital == 'D') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Divorced</option>
                            </select>
                        </td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgMarital ?>;"/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:30px" id="marital_spouse">Spouse Working<?php
                                        if ($marital == 'M') {
                                            echo '<span class="red"> *</span>';
                                        }
                        ?></td>
                        <td style="padding-top:6px;">
                            <?php
                            if ($marital == 'S' || $marital == 'D') {
                                $dis_spouse = 'disabled="disabled"';
                            }
                            ?>
                            <select id="dropSpouse" style="width:250px;color:<?php echo $fontColorSpouse ?>;" <?php echo $dis_spouse; ?> onchange="dropSpouse(this.value)">
                                <option value="0">--Please Select--</option>
                                <option value="Y" <?php
                            if ($spouseWork == 'Y') {
                                echo 'selected = "selected"';
                            }
                            ?>>Yes</option>
                                <option value="N" <?php
                                        if ($spouseWork == 'N') {
                                            echo 'selected = "selected"';
											$diable_spouse_company="none";
                                        }else{
											$diable_spouse_company="";
										}
                            ?>>No</option>
                            </select>
                        </td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgSpouse ?>;"/></td>
                    </tr>
					
					<tr style="display: <?php echo $diable_spouse_company;?>" class="company_name">
                                <td style="padding-top:6px;width:200px">Company Name</td>
                                <td style="padding-top:6px;width:200px">
								  <input id="company_name" type="Text" style="width:250px;color:<?php echo $fontColorSpouseCompany ?>;"  value="<?php echo $spouseCompany;?>"/>
								</td> <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgSpouseCompany ?>;"/></td>
                     </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px" id="marital_child">Number of Children<?php
                                        if ($marital == 'M' || $marital == "D") {
                                            echo '<span class="red"> *</span>';
                                        }
                            ?></td>
                        <?php
                        if ($marital == 'S') {
                            $dis_child = 'disabled="disabled"';
                        }
                        ?>
                        <td style="padding-top:6px;width:200px"><input <?php echo $dis_child; ?> id="numChildText" type="Text" value="<?php echo $child ?>" style="width:250px;color:<?php echo $fontColorChild ?>;"/></td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgChild ?>;"/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:150px">Date of Birth<span class="red"> *</span></td>
                        <td style="padding-top:6px;"><input id="dobText" type="Text" value="<?php echo date("d-m-Y", strtotime($dob)); ?>" style="width:250px;color:<?php echo $fontColorDob ?>;" /></td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgDob ?>;"/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:150px">Join Date<span class="red"> *</span></td>
                        <td style="padding-top:6px;"><input id="joinDateText" disabled="disabled" style="width:250px;color:<?php echo $fontColorJoin ?>;" type="text" value="<?php
                        if ($join != "0000-00-00" && $join != "") {
                            print date("d-m-Y", strtotime($join));;
                        } else {
                            print "";
                        }
                        ?>" /></td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgJoin ?>;"/></td>
                    </tr>
                    <tr style="display: none;">
                        <td style="padding-top:6px;width:150px">Resign Date</td>
                        <td style="padding-top:6px;"><input disabled="disabled" id="resignDateText" style="width:250px;color:<?php echo $fontColorResign ?>;" type="Text"
                                                            value="<?php
                                                            if ($resign != "0000-00-00" && $resign != "") {
                                                                print date("d-m-Y", strtotime($resign));
                                                            } else {
                                                                print "";
                                                            }
                        ?>" /></td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgResign ?>;"/></td>
                    </tr>
                    <tr style="display: none;">
                        <td style="padding-top:6px;width:200px;" valign="top">Employee profile</td>
                        <td style="padding-top:6px;width:200px"><textarea id="profileText" style="height:30px;width:250px;color:<?php echo $fontColorProfile ?>;"><?php echo $profile ?></textarea></td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgProfile ?>;"/></td>
                    </tr>
                    <tr style="display: none;">
                        <td style="padding-top:6px;width:150px;" valign="top">Extra Information/Note</td>
                        <td style="padding-top:6px"><textarea class="input_textarea" id="noteText" style="height:50px;width:250px"></textarea></td>
                    </tr>
                </table>
           	<div style="position:relative; top:-353px; left:500px">
                <h3>Next of kin</h3>
                <table>
             
					<tr>
                                    <td style="padding-top:5px;width:200px;">Emergency Contact Person</td>
                                    <td style="padding-top:5px"><input type="text" style="width:250px;color:<?php echo $fontColorcontactPerson ?>;" id="ecp" value="<?php print $contact_person; ?>" ></td>
									<td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgcontactPerson ?>;"/></td>
                                </tr>
								<tr>
                                    <td style="padding-top:5px;width:200px;">Emergency Contact Number</td>
                                    <td style="padding-top:5px"><input type="text" style="width:250px;color:<?php echo $fontColorEmergency ?>;" id="ecn" value="<?php print $emergency; ?>"></td>
									<td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgEmergency ?>;"/></td>
                                </tr>
								<tr>
                                    <td style="padding-top:5px;width:200px;">Relationship</td>
                                    <td style="padding-top:5px"><input type="text" style="width:250px;color:<?php echo $fontColorErelationship ?>;" id="emr" value="<?php print $emergency_relationship; ?>" ></td>
									<td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgErelationship ?>;"/></td>
                                </tr>
                   
                </table>
         
            
			
  
</div>
		  
        </td>
        <td>
            <fieldset style="width:300px;padding-left: 50px;height:280px; display:none">
                <legend style="font-size: 16px; font-weight: bold;">&nbsp;&nbsp;Profile&nbsp;&nbsp;</legend>
                <table>

                    <tr>
                        <td style="padding-top:6px;width:200px">Username</td>
                        <td style="padding-top:6px;width:200px;"><input type="text" id="usernameText" value="<?php echo $rowGetOld['username'] ?>" style="width:250px;" readonly/>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Employee Status</td>
                        <td style="padding-top:6px;width:200px">
                            <input type="text" id="empStatusText" value="<?php echo $rowGetOld['emp_status'] ?>" style="width:250px;" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Company</td>
                        <td style="padding-top:6px;width:200px">
                            <input type="text" value="<?php echo $rowCompany['code'] ?>" style="width:250px;" readonly/><input id="branchText" type="hidden" value="<?php echo $rowCompany['id'] ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Branch</td>
                        <td style="padding-top:6px;width:200px">
                            <input type="text" value="<?php echo $rowBranch['branch_code'] ?>" style="width:250px;" readonly/><input id="branchText" type="hidden" value="<?php echo $rowBranch['id'] ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Department</td>
                        <td style="padding-top:6px;width:200px">
                            <input type="text" value="<?php echo $rowDept['dep_name'] ?>" style="width:250px;" readonly/><input id="deptText" type="hidden" value="<?php echo $rowDept['id'] ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Group</td>
                        <td style="padding-top:6px;width:200px">
                            <input type="text" value="<?php echo $rowGroup['group_name'] ?>" style="width:250px;" readonly/><input id="groupText" type="hidden" value="<?php echo $rowGroup['id'] ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Position</td>
                        <td style="padding-top:6px;width:200px">
                            <input type="text" value="<?php echo $rowPos['position_name'] ?>" style="width:250px;" readonly/><input id="posText" type="hidden" value="<?php echo $rowPos['id'] ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">User Permission</td>
                        <td style="padding-top:6px;width:200px">
                            <input type="text" value="<?php echo $rowLevel['name'] ?>" style="width:250px;" readonly/><input id="levelText" type="hidden" value="<?php echo $rowLevel['id'] ?>"/>
                        </td>
                    </tr>
                    <tr style="display: none;">
                        <td style="padding-top:6px;width:200px">Overtime</td>
                        <td style="padding-top:6px;width:200px">
                            <?php
                            $sqlgetovertime = mysql_query('SELECT o.id,o.overtime_name FROM overtime AS o INNER JOIN employee AS e ON e.overtime_type=o.id WHERE e.id=' . $getID . ';');
                            $rowOT = mysql_fetch_array($sqlgetovertime);
                            ?>
                            <input type="text" value="<?php echo $rowOT['overtime_name'] ?>" style="width:250px;" readonly/><input id="overtimeText" type="hidden" value="<?php echo $rowOT['id'] ?>"/>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset style="width:400px;padding-left: 50px;margin-top:10px;height:420px; display:none" >
                <legend style="font-size: 16px; font-weight: bold;">&nbsp;&nbsp;Payroll&nbsp;&nbsp;</legend>
                <table>
                    <tr>
                        <td style="padding-top:6px;width:150px">Under Contract</td>
                        <td style="padding-top:6px;width:200px;">
                            <input type="text" value="<?php
                            if ($rowGNew['is_contract'] == 'Y') {
                                echo 'Yes';
                            } else {
                                echo 'No';
                            }
                            ?>" style="width:250px;" readonly/>
                            <input id="contractText" type="hidden" value="<?php echo $rowGNew['is_contract'] ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:5px;width:200px;">Salary Type</td>
                        <td style="padding-top:5px;">
                            <input type="text" value="<?php
                                   if ($rowGetOld['salary_type'] == 'bs') {
                                       echo 'Basic Salary';
                                   } else if ($rowGetOld['salary_type'] == 'hr') {
                                       echo 'Hourly';
                                   } else if ($rowGetOld['salary_type'] == 'dy') {
                                       echo 'Daily';
                                   } else if ($rowGetOld['salary_type'] == 'wk') {
                                       echo 'Weekly';
                                   } else if ($rowGetOld['salary_type'] == 'mn') {
                                       echo 'Monthly';
                                   } else {
                                       echo 'Undefined';
                                   }
                            ?>" style="width:250px;" readonly/><input id="salaryTypeText"type="hidden" value="<?php echo $rowGetOld['salary_type'] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:5px;width:200px;">Salary Amount</td>
                        <td style="padding-top:5px;"><input id="salaryAmtText" type="Text" value="<?php echo $rowGetOld['salary'] ?>" style="width:250px" readonly/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:30px">Bank Account</td>
                        <td style="padding-top:6px;">
                            <select id="dropBank" style="width:250px;color:<?php echo $fontColorBank ?>;">
                                <option value="0" >--Please Select--</option>
                                <?php
                                $sqlbank = mysql_query('SELECT * FROM bank ORDER BY name');
                                while ($rowBank = mysql_fetch_array($sqlbank)) {
                                    echo '<option value="' . $rowBank['id'] . '" ';
                                    if ($rowBank['id'] == $rowBankSelected['bank_acc_id']) {
                                        echo 'selected="selected"';
                                    } else {
                                        echo '';
                                    }

                                    echo '>' . $rowBank['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgBank ?>;"/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Bank Account Number</td>
                        <td style="padding-top:6px;width:200px"><input class="bankAccNumText" type="Text" value="<?php echo $bankNum ?>" style="width:250px;color:<?php echo $fontColorBankNum ?>;"/></td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgBankNum ?>;"/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">EPF Number</td>
                        <td style="padding-top:6px;width:200px"><input id="epfText" type="Text" value="<?php echo $epf ?>" style="width:250px;color:<?php echo $fontColorEpf ?>;" /></td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgEpf ?>;"/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">SOCSO Number</td>
                        <td style="padding-top:6px;width:200px"><input id="socsoText" type="Text" value="<?php echo $socso ?>" style="width:250px;color:<?php echo $fontColorSocso ?>;" /></td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgSocso ?>;"/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">In.Tax Number</td>
                        <td style="padding-top:6px;width:200px"><input id="iTaxText" type="Text" value="<?php echo $iTax ?>" style="width:250px;color:<?php echo $fontColorItax ?>;" /></td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgItax ?>;"/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:150px">Zakat Account</td>
                        <td style="padding-top:6px;"><input id="zakatText" type="Text" value="<?php echo $zakat ?>" style="width:250px;color:<?php echo $fontColorZakat ?>;" /></td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgZakat ?>;"/></td>
                    </tr>
                </table>
           
        </td>
    </tr>
</table> 

<?php
/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn. Bhd. */
?>