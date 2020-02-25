<?php
/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn. Bhd. */
?>
<div style="padding: 5px 10px;"><span class="_14 red">* - Mandatory Fields</span></div>
<table>
    <tr>
        <td>
            
                <table>
                    <tr>
                        <td style="padding-top:6px;width:150px">Full Name<span class="red"> *</span></td>
                        <td style="padding-top:6px;"><input id="fullNameText" style="width:250px" type="Text" value="<?php echo $row['full_name'] ?>" /></td>
                    </tr>
					<input type="hidden" id="country" value="<?php echo $row['country']; ?>" >
					<?php  
	
				
				if($row['country']=="Malaysia"){ 
				?>
                    <tr>
                        <?php
                        $ic = explode('-', $row['ic']);
                        ?>
                        <td style="padding-top:6px;width:150px">IC<span class="red"> *</span></td>
                        <td style="padding-top:6px;">
                            <input id="ICText1" style="width:99px" type="Text" maxlength="6" value="<?php echo $ic[0]; ?>" />&nbsp;-&nbsp;<input id="ICText2" style="width:30px" type="Text" maxlength="2" value="<?php echo $ic[1]; ?>" />&nbsp;-&nbsp;<input id="ICText3" style="width:80px" type="Text" maxlength="4" value="<?php echo $ic[2]; ?>" />
                        </td>
                    </tr>
					<?php
				}else{
				?>
				<tr>
                    <td style="padding-top:5px;width:200px;">Passport Number</td>
                    <td style="padding-top:5px;color:<?php print $fontColorIc ?>;"><input type="text" id="pass" value="<?php print $row['passport']; ?>"></td>
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Passport Expiry</td>
                    <td style="padding-top:5px;color:<?php print $fontColorpe ?>;"><input type="text" id="pe" value="<?php print date("d-m-Y", strtotime($row['passport_expiry'])) ?>"></td>
                </tr>
				<tr>
                    <td style="padding-top:5px;width:200px;">Work Permit</td>
                    <td style="padding-top:5px;color:<?php print $fontColorwp ?>;"><input disabled="disabled" type="text" id="wp" value="<?php print $row['work_permit']; ?>"></td>
                </tr>
			
				<?php
				
				} 
				?>
                    <tr>
                        <td style="padding-top:6px;width:150px">Contact Number (Home)</td>
                        <td style="padding-top:6px;"><input id="phoneText" style="width:250px" type="Text" value="<?php echo $row['phone'] ?>" /></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:150px">Contact Number (Mobile)<span class="red"> *</span></td>
                        <td style="padding-top:6px;"><input id="mobileText" style="width:250px" type="Text" value="<?php echo $row['mobile'] ?>" /></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:150px">Email Address<span class="red"> *</span></td>
                        <td style="padding-top:6px;"><input id="emailAddText" style="width:250px" type="Text" value="<?php echo $row['email'] ?>" /></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:150px;" valign="top">Mailing Address</td>
                        <td style="padding-top:6px"><textarea id="mailAddText" style="height:90px;width:250px"><?php echo $row['address'] ?></textarea></td>
                    </tr>
                    <tr>
                        <td style="width:30px">Gender<span class="red"> *</span></td>
                        <td style="">
                            <select id="dropGender" style="width:250px;">
                                <option value="0">--Please Select--</option>
                                <option value="M" <?php
                        if ($row['gender'] == 'M') {
                            echo 'selected = "selected"';
                        }
                        ?>>Male</option>
                                <option value="F" <?php
                                        if ($row['gender'] == 'F') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Female</option>
                            </select>
                        </td>
                    </tr>
					</table>
					<table style="position:relative; top:-325px; left:500px">
                    <tr>
                        <td style="padding-top:6px;width:200px">Race<span class="red"> *</span></td>
                        <td style="padding-top:6px;">
                            <select id="dropRace" style="width:250px;">
                                <option value="0">--Please Select--</option>
                                <option value="Chinese" <?php
                                        if ($row['race'] == 'Chinese') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Chinese</option>
                                <option value="Indian" <?php
                                        if ($row['race'] == 'Indian') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Indian</option>
                                <option value="Malay" <?php
                                        if ($row['race'] == 'Malay') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Malay</option>
                                <option value="Others" <?php
                                        if ($row['race'] == 'Others') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Others</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Religion<span class="red"> *</span></td>
                        <td style="padding-top:6px;">
                            <select id="dropReligion" style="width:250px;">
                                <option value="0">--Please Select--</option>
                                <option value="Buddhist" <?php
                                        if ($row['religion'] == 'Buddhist') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Buddhist</option>
                                <option value="Catholic" <?php
                                        if ($row['religion'] == 'Catholic') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Catholic</option>
                                <option value="Christian" <?php
                                        if ($row['religion'] == 'Christian') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Christian</option>
                                <option value="Hindu" <?php
                                        if ($row['religion'] == 'Hindu') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Hindu</option>
                                <option value="Islam" <?php
                                        if ($row['religion'] == 'Islam') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Islam</option>
                                <option value="Others" <?php
                                        if ($row['religion'] == 'Others') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Others</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-top:6px;width:200px">Marital Status<span class="red"> *</span></td>
                        <td style="padding-top:6px;width:200px;">
                            <select id="dropMarital" style="width:250px;" onchange="checkMarital(this.value)">
                                <option value="0">--Please Select--</option>
                                <option value="S" <?php
                                        if ($row['marital'] == 'S') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Single</option>
                                <option value="M" <?php
                                        if ($row['marital'] == 'M') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Married</option>
                                <option value="D" <?php
                                        if ($row['marital'] == 'D') {
                                            echo 'selected = "selected"';
                                        }
                        ?>>Divorced</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:30px" id="marital_spouse">Spouse Working<?php
                                        if ($row['marital'] == 'M') {
                                            echo '<span class="red"> *</span>';
                                        }
                        ?></td>
                        <td style="padding-top:6px;">
                            <?php
                            if ($row['marital'] == 'S' || $row['marital'] == 'D') {
                                $dis_spouse = 'disabled="disabled"';
                            }
                            ?>
                            <select id="dropSpouse" style="width:250px;" <?php echo $dis_spouse; ?> onchange="dropSpouse(this.value)">
                                <option value="0">--Please Select--</option>
                                <option value="Y" <?php
                            if ($row['spouse_work'] == 'Y') {
                                echo 'selected = "selected"';
                            }else{
								
							}
                            ?>>Yes</option>
                                <option value="N" <?php
                                        if ($row['spouse_work'] == 'N') {
                                            echo 'selected = "selected"';
											$diable_spouse_company="none";
                                        }else{
											$diable_spouse_company="";
										}
                            ?>>No</option>
                            </select>
                        </td>
                    </tr>
					
					<tr style="display: <?php echo $diable_spouse_company;?>" class="company_name">
                                <td style="padding-top:6px;width:200px">Company Name</td>
                                <td style="padding-top:6px;width:200px">
								  <input id="company_name" type="Text" style="width:250px;" value="<?php echo $row['spouse_company'];?>"/>
								</td>
                     </tr>
                    <tr>
                        <?php
                        if ($row['marital'] == 'S') {
                            $dis_child = 'disabled="disabled"';
                        }
                        ?>
                        <td style="padding-top:6px;width:200px" id="marital_child">Number of Children<?php echo $diable_spouse_company;
                        if ($row['marital'] == 'M' || $row['marital'] == 'D') {
                            echo '<span class="red"> *</span>';
                        }
                        ?></td>
                        <td style="padding-top:6px;width:200px"><input id="numChildText" <?php echo $dis_child; ?> type="Text" value="<?php echo $row['num_of_kids'] ?>" style="width:250px;"/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:150px">Date of Birth<span class="red"> *</span></td>
                        <td style="padding-top:6px;"><input id="dobText" type="Text" value="<?php echo  date("d-m-Y", strtotime($row['dob'])) ?>" style="width:250px;" /></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:150px">Join Date<span class="red"> *</span></td>
                        <td style="padding-top:6px;"><input id="joinDateText" style="width:250px;" disabled="disabled" type="Text" value="<?php
                            if ($row['join_date'] != "0000-00-00" && $row['join_date'] != "") {
                                print date("d-m-Y", strtotime($row['join_date']));
                            } else {
                                print "";
                            }
                        ?>" /></td>
                    </tr>
                    <tr style="display: none;">
                        <td style="padding-top:6px;width:150px">Resign Date</td>
                        <td style="padding-top:6px;"><input disabled="disabled" id="resignDateText" style="width:250px;" type="Text" value="<?php
                                                            if ($row['resign_date'] != "0000-00-00" && $row['resign_date'] != "") {
                                                                print $row['resign_date'];
                                                            } else {
                                                                print "";
                                                            }
                        ?>" /></td>
                    </tr>
                    <tr style="display: none;">
                        <td style="padding-top:6px;width:200px;" valign="top">Employee Profile</td>
                        <td style="padding-top:6px;width:200px"><textarea id="profileText" style="height:30px;width:250px"><?php echo $row['profile'] ?></textarea></td>
                    </tr>
                    <tr style="display: none;">
                        <td style="padding-top:6px;width:150px;" valign="top">Extra Information/Note</td>
                        <td style="padding-top:6px"><textarea class="input_textarea" id="noteText" style="height:50px;width:250px"><?php echo $row['notes'] ?></textarea></td>
                    </tr>
                </table>
				   
           	<div style="position:relative; top:-353px; left:500px">
                <h3>Next of kin</h3>
                <table>
             
					<tr>
                                    <td style="padding-top:5px;width:200px;">Emergency Contact Person</td>
                                    <td style="padding-top:5px"><input type="text" style="width:250px;" id="ecp" value="<?php print $row['contact_person']; ?>" ></td>
                                </tr>
								<tr>
                                    <td style="padding-top:5px;width:200px;">Emergency Contact Number</td>
                                    <td style="padding-top:5px"><input type="text" style="width:250px;" id="ecn" value="<?php print $row['emergency']; ?>"></td>
                                </tr>
								<tr>
                                    <td style="padding-top:5px;width:200px;">Relationship</td>
                                    <td style="padding-top:5px"><input type="text" style="width:250px;" id="emr" value="<?php print $row['emergency_relationship']; ?>" ></td>
                                </tr>
                   
                </table>
         
            
			
  
</div>
            
        </td>
        <td>
            <fieldset style="width:300px;padding-left: 50px;height:280px; display:none" >
                <legend style="font-size: 16px; font-weight: bold;">&nbsp;&nbsp;Profile&nbsp;&nbsp;</legend>
                <table>

                    <tr>
                        <td style="padding-top:6px;width:200px">Username</td>
                        <td style="padding-top:6px;width:200px;"><input type="text" id="usernameText" disabled="disabled" value="<?php echo $row['username'] ?>" style="width:250px;" readonly/>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Employee Status</td>
                        <td style="padding-top:6px;width:200px">
                            <input type="text" id="empStatusText"  disabled="disabled" value="<?php echo $row['emp_status'] ?>" style="width:250px;" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Company</td>
                        <td style="padding-top:6px;width:200px">
                            <input type="text" value="<?php echo $rowCompany['code'] ?>" disabled="disabled" style="width:250px;" readonly/><input id="branchText" type="hidden" value="<?php echo $rowCompany['id'] ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Division</td>
                        <td style="padding-top:6px;width:200px">
                            <input type="text" value="<?php echo $rowBranch['branch_code'] ?>" disabled="disabled" style="width:250px;" readonly/><input id="branchText" type="hidden" value="<?php echo $rowBranch['id'] ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Department</td>
                        <td style="padding-top:6px;width:200px">
                            <input type="text" value="<?php echo $rowDept['dep_name'] ?>" disabled="disabled" style="width:250px;" readonly/><input id="deptText" type="hidden" value="<?php echo $rowDept['id'] ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Section/Unit</td>
                        <td style="padding-top:6px;width:200px">
                            <input type="text" value="<?php echo $rowGroup['group_name'] ?>" disabled="disabled" style="width:250px;" readonly/><input id="groupText" type="hidden" value="<?php echo $rowGroup['id'] ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Position</td>
                        <td style="padding-top:6px;width:200px">
                            <input type="text" value="<?php echo $rowPos['position_name'] ?>" disabled="disabled" style="width:250px;" readonly/><input id="posText" type="hidden" value="<?php echo $rowPos['id'] ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">User Permission</td>
                        <td style="padding-top:6px;width:200px">
                            <input type="text" value="<?php echo $rowLevel['name'] ?>" disabled="disabled" style="width:250px;" readonly/><input id="levelText" type="hidden" value="<?php echo $rowLevel['id'] ?>"/>
                        </td>
                    </tr>

                    <tr style="display: none;">
                        <td style="padding-top:6px;width:200px">Overtime</td>
                        <td style="padding-top:6px;width:200px">
                            <?php
                            $sqlgetovertime = mysql_query('SELECT o.id,o.overtime_name FROM overtime AS o INNER JOIN employee AS e ON e.overtime_type=o.id WHERE e.id=' . $getID . ';');
                            $rowOT = mysql_fetch_array($sqlgetovertime);
                            ?>
                            <input type="text" value="<?php echo $rowOT['overtime_name'] ?>" disabled="disabled" style="width:250px;" readonly/><input id="overtimeText" type="hidden" value="<?php echo $rowOT['id'] ?>"/>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset style="width:550px;padding-left: 50px;margin-top:5px;height:420px; display:none">
                <legend style="font-size: 16px; font-weight: bold;">&nbsp;&nbsp;Payroll&nbsp;&nbsp;</legend>
                <table>
                    <tr>
                        <td style="padding-top:6px;width:150px">Under Contract</td>
                        <td style="padding-top:6px;width:200px;">
                            <input type="text" value="<?php
                            if ($row['is_contract'] == 'Y') {
                                echo 'Yes';
                            } else {
                                echo 'No';
                            }
                            ?>" disabled="disabled" style="width:250px;" readonly/><input id="contractText" type="hidden" value="<?php echo $row['is_contract'] ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:5px;width:200px;">Salary Type</td>
                        <td style="padding-top:5px;">
                            <input type="text" value="<?php
                                   if ($row['salary_type'] == 'bs') {
                                       echo 'Basic Salary';
                                   } else if ($row['salary_type'] == 'hr') {
                                       echo 'Hourly';
                                   } else if ($row['salary_type'] == 'dy') {
                                       echo 'Daily';
                                   } else if ($row['salary_type'] == 'wk') {
                                       echo 'Weekly';
                                   } else if ($row['salary_type'] == 'mn') {
                                       echo 'Monthly';
                                   } else {
                                       echo 'Undefined';
                                   }
                            ?>" style="width:250px;" disabled="disabled" readonly/><input id="salaryTypeText"type="hidden" value="<?php echo $row['salary_type'] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:5px;width:200px;">Salary Amount</td>
                        <td style="padding-top:5px;"><input id="salaryAmtText" type="Text" value="<?php echo $row['salary'] ?>" disabled="disabled" style="width:250px" readonly/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:30px">Bank Account</td>
                        <td style="padding-top:6px;">
                            <select id="dropBank" style="width:250px">
                                <option value="0" >--Please Select--</option>
                                <?php
                                $sqlbank = mysql_query('SELECT * FROM bank ORDER BY name');
                                while ($rowBank = mysql_fetch_array($sqlbank)) {
                                    echo '<option value="' . $rowBank['id'] . '"';
                                    if ($rowBank['id'] == $row['bank_acc_id']) {
                                        echo ' selected="selected"';
                                    } else {
                                        echo '';
                                    }

                                    echo '>' . $rowBank['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Bank Account Number12</td>
                        <td style="padding-top:6px;width:200px"><input class="bankAccNumText" type="Text" value="<?php echo $row['bank_acc_num'] ?>" disabled="disabled" style="width:250px"/></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">EPF Number</td>
                        <td style="padding-top:6px;width:200px"><input id="epfText" type="Text" value="<?php echo $row['epf_num'] ?>" style="width:250px" /></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">SOCSO Number</td>
                        <td style="padding-top:6px;width:200px"><input id="socsoText" type="Text" value="<?php echo $row['socso_num'] ?>" style="width:250px" /></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:200px">Income Tax Number</td>
                        <td style="padding-top:6px;width:200px"><input id="iTaxText" type="Text" value="<?php echo $row['income_tax_num'] ?>" style="width:250px" /></td>
                    </tr>
                    <tr>
                        <td style="padding-top:6px;width:150px">Zakat Account</td>
                        <td style="padding-top:6px;"><input id="zakatText" type="Text" value="<?php echo $row['zakat'] ?>" style="width:250px" /></td>
                    </tr>
                </table>
            </fieldset>
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