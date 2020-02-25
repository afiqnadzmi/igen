<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

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
<div style="margin-bottom:-29px">
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
					</table>
					<table style="position:relative; top:-370px; left:500px">
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
                    </tr>
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
                            <select id="dropSpouse" style="width:250px;color:<?php echo $fontColorSpouse ?>;" <?php echo $dis_spouse; ?>>
                                <option value="0">--Please Select--</option>
                                <option value="Y" <?php
                            if ($spouseWork == 'Y') {
                                echo 'selected = "selected"';
                            }
                            ?>>Yes</option>
                                <option value="N" <?php
                                        if ($spouseWork == 'N') {
                                            echo 'selected = "selected"';
                                        }
                            ?>>No</option>
                            </select>
                        </td>
                        <td style="padding-top:6px;"><img src="images/pencil.png" style="width:15px;height:15px;display:<?php echo $imgSpouse ?>;"/></td>
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
          
			
        </td>
        <td>
		<div style="width:440px;padding-left: 10px;height:auto; position:relative; left:40px; top:30px">
                Next of kin
                <table>
             
					<tr>
                                    <td style="padding-top:5px;width:250px;">Emergency Contact Person</td>
                                    <td style="padding-top:5px"><input type="text" style="width:250px;" id="ecp" value="<?php print $row['contact_person']; ?>" ></td>
                                </tr>
								<tr>
                                    <td style="padding-top:5px;width:250px;">Emergency Contact Number</td>
                                    <td style="padding-top:5px"><input type="text" style="width:250px;" id="ecn" value="<?php print $row['emergency']; ?>"></td>
                                </tr>
								<tr>
                                    <td style="padding-top:5px;width:200px;">Relationship</td>
                                    <td style="padding-top:5px"><input type="text" style="width:250px;" id="emr" value="Sister" ></td>
                                </tr>
                   
                </table>
            </fieldset>
            
			
        </td>
    </tr>
</table>
</div>
<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>