<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tablecolor').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
</script>

<div class="main_div">
<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">User Permission</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
		<p>
    <div class="header_text">
        <span>User Permission</span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <?php if ($igen_a_m == "a_m_edit") { ?> 
                <table>
                    <?php
                    if (isset($_GET['id'])) {
                        $sql_result = mysql_query("SELECT * FROM user_permission WHERE id='" . $_GET['id'] . "';");
                        $newArray = mysql_fetch_array($sql_result);
                        $a_hr = $newArray["a_hr"];
                        $a_pr = $newArray["a_pr"];
                        $a_ea = $newArray["a_ea"];
                        $a_ps = $newArray["a_ps"];
                        $a_m = $newArray["a_m"];
                        $a_r = $newArray["a_r"];
						$report = $newArray["report"];
                        $e_ep = $newArray["e_ep"];
                        $e_ea = $newArray["e_ea"];
						$epr = $newArray["epr"];
						$appraisal = $newArray["appraisal"];
						$disc = $newArray["disc"];
                        $dashboard = $newArray["dashboard"];
                        $checked = 'checked="checked"'; 

                        $sql_result1 = mysql_query("SELECT branch_id, company_id FROM user_permission_view WHERE user_permission_id='" . $_GET['id'] . "';");
                        $newArray1 = mysql_fetch_array($sql_result1);
                        $getBranchAll = $newArray1["branch_id"];
                        $getBranch = explode(',', $getBranchAll);

                        for ($c = 0; $c < count($getBranch); $c++) {
                            $queryGetCompany = mysql_query('SELECT company_id FROM branch WHERE id = ' . $getBranch[$c]);
                            $rowGetCompany = mysql_fetch_array($queryGetCompany);
                            $getCompanyAll = $getCompanyAll . $rowGetCompany["company_id"] . ',';
                        }
                        $getCompanyAll = substr($getCompanyAll, 0, -1);
                        $getCompany = explode(',', $getCompanyAll);
                        ?>
                        <tr>
                            <td colspan="2">
                                <input class="button" type="button" value="Save" onclick="savelevel(<?php echo $_GET['id'] ?>)" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;"/>
                            </td>
                        </tr>   
                        <tr>
                            <td style="width: 200px;">User Permission Name</td>
                            <td><input class="input_text" type="text" name="level" id="e_level" value="<?php echo $newArray['name'] ?>" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-top: 20px;">
                                <table>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <fieldset style='width: 700px; height: 100%; padding:5px 5px 20px 10px; border: 1px solid lightgray;'>
                                                <legend class="bold">&nbsp;&nbsp;Administrator&nbsp;&nbsp;</legend>
                                                <table style="padding-left: 20px; width: 100%;">
                                                    <tr>
                                                        <td colspan="2">
                                                            <?php
                                                            if ($dashboard == "dash_show") {
                                                                $cdash_show = $checked;
                                                            } elseif ($dashboard == "dash_hide") {
                                                                $cdash_hide = $checked;
                                                            }
                                                            ?>
                                                            <table>
                                                                <tr><td class="bold underline">Dashboard</td></tr>
                                                                <tr>
                                                                    <td id="dash">
                                                                        <input type="radio" name="dash" value="dash_show" <?php echo $cdash_show; ?> />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="dash" value="dash_hide" <?php echo $cdash_hide; ?> />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 50%;">
                                                            <?php
                                                            if ($a_hr == "a_hr_edit") {
                                                                $ca_hr_edit = $checked;
                                                            } elseif ($a_hr == "a_hr_view") {
                                                                $ca_hr_view = $checked;
                                                            } elseif ($a_hr == "a_hr_hide") {
                                                                $ca_hr_hide = $checked;
                                                            }
                                                            ?>
                                                            <table>
                                                                <tr><td class="bold underline">Human Resource Module</td></tr>
                                                                <tr>
                                                                    <td id="a_hr">
                                                                        <input type="radio" name="a_hr" value="a_hr_edit" <?php echo $ca_hr_edit; ?> />&nbsp;Full Access&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_hr" value="a_hr_view" <?php echo $ca_hr_view; ?> />&nbsp;View Only&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_hr" value="a_hr_hide" <?php echo $ca_hr_hide; ?> />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($a_ps == "a_ps_show") {
                                                                $ca_ps_show = $checked;
                                                            } elseif ($a_ps == "a_ps_hide") {
                                                                $ca_ps_hide = $checked;
                                                            }
                                                            ?>
                                                            <table>
                                                                <tr><td class="bold underline">Planning & Simulation Module</td></tr>
                                                                <tr>
                                                                    <td id="a_ps">
                                                                        <input type="radio" name="a_ps" value="a_ps_show" <?php echo $ca_ps_show; ?> />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_ps" value="a_ps_hide" <?php echo $ca_ps_hide; ?> />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            if ($a_pr == "a_pr_show") {
                                                                $ca_pr_show = $checked;
                                                            } elseif ($a_pr == "a_pr_hide") {
                                                                $ca_pr_hide = $checked;
                                                            }
                                                            ?>
                                                            <table>
                                                                <tr><td class="bold underline">Payroll Module</td></tr>
                                                                <tr>
                                                                    <td id="a_pr">
                                                                        <input type="radio" name="a_pr" value="a_pr_show" <?php echo $ca_pr_show; ?> />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_pr" value="a_pr_hide" <?php echo $ca_pr_hide; ?> />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($a_m == "a_m_edit") {
                                                                $ca_m_edit = $checked;
                                                            } elseif ($a_m == "a_m_view") {
                                                                $ca_m_view = $checked;
                                                            } elseif ($a_m == "a_m_hide") {
                                                                $ca_m_hide = $checked;
                                                            }
                                                            ?>
                                                            <table>
                                                                <tr><td class="bold underline">Maintenance Module</td></tr>
                                                                <tr>
                                                                    <td id="a_m">
                                                                        <input type="radio" name="a_m" value="a_m_edit" <?php echo $ca_m_edit; ?> />&nbsp;Full Access&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_m" value="a_m_view" <?php echo $ca_m_view; ?> />&nbsp;View Only&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_m" value="a_m_hide" <?php echo $ca_m_hide; ?> />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            if ($a_ea == "a_ea_edit") {
                                                                $ca_ea_edit = $checked;
                                                            } elseif ($a_ea == "a_ea_view") {
                                                                $ca_ea_view = $checked;
                                                            } elseif ($a_ea == "a_ea_hide") {
                                                                $ca_ea_hide = $checked;
                                                            }
                                                            ?>
                                                            <table>
                                                                <tr><td class="bold underline">E-Application Management Module</td></tr>
                                                                <tr>
                                                                    <td id="a_ea">
                                                                        <input type="radio" name="a_ea" value="a_ea_edit" <?php echo $ca_ea_edit; ?> />&nbsp;Full Access&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_ea" value="a_ea_view" <?php echo $ca_ea_view; ?> />&nbsp;View Only&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_ea" value="a_ea_hide" <?php echo $ca_ea_hide; ?> />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($a_r == "a_r_show") {
                                                                $ca_r_show = $checked;
																$all="selected";
                                                            } elseif ($a_r == "a_r_hide") {
                                                                $ca_r_hide = $checked;
                                                            }
															  $report_arr=explode(",",$report);
															
                                                            ?>
                                                            <table>
                                                                <tr><td class="bold underline">Reporting Module</td></tr>
                                                                <tr>
                                                                    <td id="a_r">
                                                                        <input type="radio" class="a_r" name="a_r" value="a_r_show" <?php echo $ca_r_show; ?> />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_r" value="a_r_hide" <?php echo $ca_r_hide; ?> />&nbsp;Hide
                                                                    </td>
                                                                </tr>
																 <tr class="report" style="display:none"><td class="bold underline">Select Report</td></tr>
                                                                <tr class="report" style="display:none">
                                                                    <td id="a_r">
																	    <input type="checkbox"  id="all" name="a_report[]" value="ALL" onclick="check()" />&nbsp;All&nbsp;&nbsp;&nbsp</br>
                                                                        <input class="check" type="checkbox" name="a_report[]" value="Employee Report" />&nbsp;Employee Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="Allowance & Deduction" />&nbsp;Allowance & Deduction&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="Advance Salary Report" />&nbsp;Advance Salary Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="Attendance Report" />&nbsp;Attendance Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="EPF Report" />&nbsp;EPF Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="EPF_Socso_Tax Report" />&nbsp;EPF_Socso_Tax Report&nbsp;&nbsp;&nbsp;
                                                                       
                                                                    </td>
                                                                </tr> 
																
															<?php
															
															if ($a_r == "a_r_show"){
															?>
															 <tr class="report"><td class="bold underline">Select Report</td></tr>
                                                                <tr class="report">
                                                                    <td id="a_r">
																	    <input type="checkbox"  id="all" name="a_report[]" value="ALL" onclick="check()" <?php foreach($report_arr as $val){if($val=="ALL"){echo"checked";}} ?> />&nbsp;All&nbsp;&nbsp;&nbsp</br>
                                                                        <input class="check" type="checkbox" name="a_report[]" value="Employee Report" <?php foreach($report_arr as $val){if($val=="Employee Report"){echo"checked";}} ?> />&nbsp;Employee Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="Allowance & Deduction" <?php foreach($report_arr as $val){if($val=="Allowance & Deduction"){echo"checked";}} ?> />&nbsp;Allowance & Deduction&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="Advance Salary Report" <?php foreach($report_arr as $val){if($val=="Advance Salary Report"){echo"checked";}} ?> />&nbsp;Advance Salary Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="Attendance Report" <?php foreach($report_arr as $val){if($val=="Attendance Report"){echo"checked";}} ?> />&nbsp;Attendance Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="EPF Report" <?php foreach($report_arr as $val){if($val=="EPF Report"){echo"checked";}} ?> />&nbsp;EPF Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="EPF_Socso_Tax Report" <?php foreach($report_arr as $val){if($val=="EPF_Socso_Tax Report"){echo"checked";}} ?> />&nbsp;EPF_Socso_Tax Report&nbsp;&nbsp;&nbsp;
                                                                       
                                                                    </td>
                                                                </tr>
															
															<?php
															
															
															}
															
															?>
                                                            </table>
                                                        </td>
                                                    </tr>
													<tr>
													 <?php
                                                       if ($epr == "epr_view") {
                                                            $ca_epr_view =$checked;
                                                        } elseif ($epr == "epr_hide") {
                                                            $ca_epr_hide = $checked;
                                                        }elseif ($epr == "epr_edit") {
                                                            $ca_epr_edit = $checked;
                                                        }
														
                                                        ?>
														 <td>
                                                            <table>
                                                                <tr><td class="bold underline">Incident/Accident Management</td></tr>
                                                                <tr>
                                                                    <td id="epr">
                                                                        <input type="radio" name="epr" value="epr_edit"  <?php echo $ca_epr_edit; ?>  />&nbsp;Full Access&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="epr" value="epr_view"  <?php echo $ca_epr_view; ?> />&nbsp;View Only&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="epr" value="epr_hide" <?php echo $ca_epr_hide; ?>  />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
													 <tr>
													 <?php
                                                       if ($disc == "disc_show") {
                                                            $disc_show =$checked;
													   }elseif ($disc == "disc_hide") {
                                                            $disc_hide = $checked;
                                                        }
														
                                                        ?>
                                                        <td>
                                                            <table style="padding-left: 20px;">
                                                                <tr><td class="bold underline">Disciplinary</td></tr>
                                                                <tr>
                                                                    <td id="disc">
                                                                        <input type="radio" name="disc" value="disc_show" <?php echo $disc_show; ?>/>&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="disc" value="disc_hide" <?php echo $disc_hide; ?> />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </td>
                                        <td rowspan="2" style="padding-left: 10px; vertical-align: top;">
                                            <fieldset style='width: auto; height: 315px; padding:5px 5px 20px 10px; border: 1px solid lightgray;'>
                                                <legend class="bold">&nbsp;&nbsp;Authority to View&nbsp;&nbsp;</legend>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <table style="padding-left: 20px;">
                                                                <tr><td><span class="bold underline">Company</span>&nbsp;&nbsp;(<a href="javascript:void()" onclick="clearCompany()">Clear</a>)</td></tr>
                                                                <tr>
                                                                    <td>
                                                                        <select multiple="multiple" id="dropCompany" style="width: 250px; height: 90px;" onchange="showBranch(this.value)">
                                                                            <?php
                                                                            if ($getCompanyAll != "") {
                                                                                if (count($getCompany) > 0) {
                                                                                    for ($i = 0; $i < count($getCompany); $i++) {
                                                                                        $forQuery1 = $forQuery1 . 'id="' . $getCompany[$i] . '" OR ';
                                                                                        $forQuery2 = $forQuery2 . 'id<>' . $getCompany[$i] . ' AND ';
                                                                                    }
                                                                                    $forQuery1 = ' WHERE ' . substr($forQuery1, 0, -4);
                                                                                    $forQuery2 = ' WHERE ' . substr($forQuery2, 0, -5);
                                                                                }
                                                                                $queryCompany1 = mysql_query('SELECT id, code FROM company ' . $forQuery1 . ' ORDER BY code');
                                                                                while ($rowCompany1 = mysql_fetch_array($queryCompany1)) {
                                                                                    echo '<option value="' . $rowCompany1["id"] . '" selected="true">' . $rowCompany1["code"] . '</option>';
                                                                                }
                                                                            }
                                                                            $queryCompany = mysql_query('SELECT id, code FROM company ' . $forQuery2 . ' ORDER BY code');
                                                                            while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                                                                echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table style="padding-left: 20px;">
                                                                <tr><td class="bold underline">Branch</td></tr>
                                                                <tr>
                                                                    <td>
                                                                        <select id="dropBranch" style="width: 250px; height: 90px;" multiple="multiple">
                                                                            <?php
                                                                            if (isset($_GET["id"]) == true) {
                                                                                if ($getBranchAll != "") {
                                                                                    if (count($getBranch) > 0) {
                                                                                        for ($i = 0; $i < count($getBranch); $i++) {
                                                                                            $forQuery3 = $forQuery3 . 'id="' . $getBranch[$i] . '" OR ';
                                                                                            $forQuery4 = $forQuery4 . 'id<>' . $getBranch[$i] . ' AND ';
                                                                                        }
                                                                                        $forQuery3 = ' AND ' . substr($forQuery3, 0, -4);
                                                                                        $forQuery4 = ' AND ' . substr($forQuery4, 0, -5);
                                                                                    }
                                                                                    $queryBranch1 = mysql_query('SELECT id, branch_code FROM branch WHERE company_id IN (' . $getCompanyAll . ')' . $forQuery3 . ' ORDER BY branch_code');
                                                                                    while ($rowBranch1 = mysql_fetch_array($queryBranch1)) {
                                                                                        echo '<option value="' . $rowBranch1["id"] . '" selected="true">' . $rowBranch1["branch_code"] . '</option>';
                                                                                    }
                                                                                    $queryBranch = mysql_query('SELECT id, branch_code FROM branch WHERE company_id IN (' . $getCompanyAll . ') ' . $forQuery4 . ' ORDER BY branch_code');
                                                                                    while ($rowBranch = mysql_fetch_array($queryBranch)) {
                                                                                        echo '<option value="' . $rowBranch["id"] . '">' . $rowBranch["branch_code"] . '</option>';
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <fieldset style='width: 700px; height: 100%; padding:5px 5px 20px 10px; border: 1px solid lightgray;'>
                                                <legend class="bold">&nbsp;&nbsp;Employee&nbsp;&nbsp;</legend>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            if ($e_ep == "e_ep_show") {
                                                                $ce_ep_show = $checked;
                                                            } elseif ($e_ep == "e_ep_hide") {
                                                                $ce_ep_hide = $checked;
                                                            }
                                                            ?>
                                                            <table style="padding-left: 20px;">
                                                                <tr><td class="bold underline">Employee Profile</td></tr>
                                                                <tr>
                                                                    <td id="e_ep">
                                                                        <input type="radio" name="e_ep" value="e_ep_show" <?php echo $ce_ep_show; ?> />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="e_ep" value="e_ep_hide" <?php echo $ce_ep_hide; ?> />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            if ($e_ea == "e_ea_show") {
                                                                $ce_ea_show = $checked;
                                                            } elseif ($e_ea == "e_ea_hide") {
                                                                $ce_ea_hide = $checked;
                                                            }
                                                            ?>
                                                            <table style="padding-left: 20px;">
                                                                <tr><td class="bold underline">E-Application Module</td></tr>
                                                                <tr>
                                                                    <td id="e_ea">
                                                                        <input type="radio" name="e_ea" value="e_ea_show" <?php echo $ce_ea_show; ?> />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="e_ea" value="e_ea_hide" <?php echo $ce_ea_hide; ?> />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
													 <tr>
                                                        <td>
														   <?php
                                                            if ($appraisal == "appraisal_show") {
                                                                $ce_appraisal_show = $checked;
                                                            } elseif ($appraisal == "_hide") {
                                                                $ce_appraisal_hide = $checked;
                                                            }
                                                            ?>
                                                            <table style="padding-left: 20px;">
                                                                <tr><td class="bold underline">Appraisal Module</td></tr>
                                                                <tr>
                                                                    <td id="appraisal">
                                                                        <input type="radio" name="appraisal" value="appraisal_show" <?php echo $ce_appraisal_show; ?> />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="appraisal" value="appraisal_hide" <?php echo $ce_appraisal_hide; ?> />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>  
                    <?php } else { ?>
                        <tr>
                            <td colspan="2">
                                <input class="button" type="button" value="Add" onclick="addlevel()" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;"/>
                            </td>
                        </tr>  
                        <tr>
                            <td style="width: 200px;">User Permission Name</td>
                            <td><input class="input_text" type="text" name="level" id="level" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-top: 20px;">
                                <table>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <fieldset style='width: 700px; height: 100%; padding:5px 5px 20px 10px; border: 1px solid lightgray;'>
                                                <legend class="bold">&nbsp;&nbsp;Administrator&nbsp;&nbsp;</legend>
                                                <table style="padding-left: 20px; width: 100%;">
                                                    <tr>
                                                        <td colspan="2">
                                                            <table>
                                                                <tr><td class="bold underline">Dashboard</td></tr>
                                                                <tr>
                                                                    <td id="dash">
                                                                        <input type="radio" name="dash" value="dash_show" />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="dash" value="dash_hide" />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 50%;">
                                                            <table>
                                                                <tr><td class="bold underline">Human Resource Module</td></tr>
                                                                <tr>
                                                                    <td id="a_hr">
                                                                        <input type="radio" name="a_hr" value="a_hr_edit" />&nbsp;Full Access&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_hr" value="a_hr_view" />&nbsp;View Only&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_hr" value="a_hr_hide" />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td>
                                                            <table>
                                                                <tr><td class="bold underline">Planning & Simulation Module</td></tr>
                                                                <tr>
                                                                    <td id="a_ps">
                                                                        <input type="radio" name="a_ps" value="a_ps_show" />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_ps" value="a_ps_hide" />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table>
                                                                <tr><td class="bold underline">Payroll Module</td></tr>
                                                                <tr>
                                                                    <td id="a_pr">
                                                                        <input type="radio" name="a_pr" value="a_pr_show" />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_pr" value="a_pr_hide" />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td>
                                                            <table>
                                                                <tr><td class="bold underline">Maintenance Module</td></tr>
                                                                <tr>
                                                                    <td id="a_m">
                                                                        <input type="radio" name="a_m" value="a_m_edit" />&nbsp;Full Access&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_m" value="a_m_view" />&nbsp;View Only&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_m" value="a_m_hide" />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table>
                                                                <tr><td class="bold underline">E-Application Management Module</td></tr>
                                                                <tr>
                                                                    <td id="a_ea">
                                                                        <input type="radio" name="a_ea" value="a_ea_edit" />&nbsp;Full Access&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_ea" value="a_ea_view" />&nbsp;View Only&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="a_ea" value="a_ea_hide" />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td>
                                                            <table>
                                                                <tr><td class="bold underline">Reporting Module</td></tr>
                                                                <tr>
                                                                    <td id="a_r">
                                                                        <input type="radio" class="a_r" name="a_r" value="a_r_show" />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" class="a_r" name="a_r" value="a_r_hide" />&nbsp;Hide
                                                                    </td>
                                                                </tr>
																
																 <tr class="report" style="display:none"><td class="bold underline">Select Report</td></tr>
                                                                <tr class="report" style="display:none">
                                                                    <td id="a_r">
																	    <input type="checkbox"  id="all" name="a_report[]" value="ALL" onclick="check()" />&nbsp;All&nbsp;&nbsp;&nbsp</br>
                                                                        <input class="check" type="checkbox" name="a_report[]" value="Employee Report" />&nbsp;Employee Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="Allowance & Deduction" />&nbsp;Allowance & Deduction&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="Advance Salary Report" />&nbsp;Advance Salary Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="Attendance Report" />&nbsp;Attendance Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="EPF Report" />&nbsp;EPF Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="EPF_Socso_Tax Report" />&nbsp;EPF_Socso_Tax Report&nbsp;&nbsp;&nbsp;
                                                                       
                                                                    </td>
                                                                </tr> 
							
                                                            </table>
                                                        </td>
														</tr>
														<tr>
														 <td>
                                                            <table>
                                                                <tr><td class="bold underline">Incident/Accident Management</td></tr>
                                                                <tr>
                                                                    <td id="epr">
                                                                        <input type="radio" name="epr" value="epr_edit"  <?php echo $ca_epr_edit; ?>  />&nbsp;Full Access&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="epr" value="epr_view" />&nbsp;View Only &nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="epr" value="epr_hide" />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
													 <tr>
                                                        <td>
                                                            <table style="padding-left: 20px;">
                                                                <tr><td class="bold underline">Disciplinary</td></tr>
                                                                <tr>
                                                                    <td id="disc">
                                                                        <input type="radio" name="disc" value="disc_show" />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="disc" value="disc_hide" />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </td>
                                        <td rowspan="2" style="padding-left: 10px; vertical-align: top;">
                                            <fieldset style='width: auto; height: 315px; padding:5px 5px 20px 10px; border: 1px solid lightgray;'>
                                                <legend class="bold">&nbsp;&nbsp;Authority to View&nbsp;&nbsp;</legend>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <table style="padding-left: 20px;">
                                                                <tr><td><span class="bold underline">Company</span>&nbsp;&nbsp;(<a href="javascript:void()" onclick="clearCompany()">Clear</a>)</td></tr>
                                                                <tr>
                                                                    <td>
                                                                        <select multiple="multiple" id="dropCompany" style="width: 250px; height: 90px;" onchange="showBranch(this.value)">
                                                                            <?php
                                                                            $queryCompany = mysql_query('SELECT id, code FROM company');
                                                                            while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                                                                echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table style="padding-left: 20px;">
                                                                <tr><td class="bold underline">Branch</td></tr>
                                                                <tr>
                                                                    <td>
                                                                        <select id="dropBranch" style="width: 250px; height: 90px;" multiple="multiple"></select>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <fieldset style='width: 700px; height: 100%; padding:5px 5px 20px 10px; border: 1px solid lightgray;'>
                                                <legend class="bold">&nbsp;&nbsp;Employee&nbsp;&nbsp;</legend>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <table style="padding-left: 20px;">
                                                                <tr><td class="bold underline">Employee Profile</td></tr>
                                                                <tr>
                                                                    <td id="e_ep">
                                                                        <input type="radio" name="e_ep" value="e_ep_show" />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="e_ep" value="e_ep_hide" />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table style="padding-left: 20px;">
                                                                <tr><td class="bold underline">Application Module</td></tr>
                                                                <tr>
                                                                    <td id="e_ea">
                                                                        <input type="radio" name="e_ea" value="e_ea_show" />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="e_ea" value="e_ea_hide" />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
													 <tr>
                                                        <td>
                                                            <table style="padding-left: 20px;">
                                                                <tr><td class="bold underline">Appraisal Module</td></tr>
                                                                <tr>
                                                                    <td id="appraisal">
                                                                        <input type="radio" name="appraisal" value="appraisal_show" />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" name="appraisal" value="appraisal_hide" />&nbsp;Hide
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>  
                    <?php } ?>
                </table>
                <?php
            } elseif ($igen_a_m == "a_m_view") {
                $sql_result = mysql_query("SELECT * FROM user_permission WHERE id='" . $_GET['view_id'] . "';");
                $newArray = mysql_fetch_array($sql_result);
                $a_hr = $newArray["a_hr"];
                $a_pr = $newArray["a_pr"];
                $a_ea = $newArray["a_ea"];
                $a_ps = $newArray["a_ps"];
                $a_m = $newArray["a_m"];
                $a_r = $newArray["a_r"];
                $e_ep = $newArray["e_ep"];
                $e_ea = $newArray["e_ea"];
				$epr = $newArray["epr"];
                $dashboard = $newArray["dashboard"];
                $checked = 'checked="checked"';

                $sql_result1 = mysql_query("SELECT branch_id, company_id FROM user_permission_view WHERE user_permission_id='" . $_GET['view_id'] . "';");
                $newArray1 = mysql_fetch_array($sql_result1);
                $getBranchAll = $newArray1["branch_id"];
                $getBranch = explode(',', $getBranchAll);

                for ($c = 0; $c < count($getBranch); $c++) {
                    $queryGetCompany = mysql_query('SELECT company_id FROM branch WHERE id = ' . $getBranch[$c]);
                    $rowGetCompany = mysql_fetch_array($queryGetCompany);
                    $getCompanyAll = $getCompanyAll . $rowGetCompany["company_id"] . ',';
                }
                $getCompanyAll = substr($getCompanyAll, 0, -1);
                $getCompany = explode(',', $getCompanyAll);
                ?>
                <table>
                    <tr>
                        <td style="width: 200px;">User Permission Name</td>
                        <td><input class="input_text" type="text" name="level" id="e_level" value="<?php echo $newArray['name'] ?>" style="width: 250px" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top: 20px;">
                            <table>
                                <tr>
                                    <td style="vertical-align: top;">
                                        <fieldset style='width: auto; height: 100%; padding:5px 5px 20px 10px; border: 1px solid lightgray;'>
                                            <legend class="bold">&nbsp;&nbsp;Administrator&nbsp;&nbsp;</legend>
                                            <table style="padding-left: 20px; width: 100%;">
                                                <tr>
                                                    <td colspan="2">
                                                        <?php
                                                        if ($dashboard == "dash_show") {
                                                            $cdash_show = $checked;
                                                        } elseif ($dashboard == "dash_hide") {
                                                            $cdash_hide = $checked;
                                                        }
                                                        ?>
                                                        <table>
                                                            <tr><td class="bold underline">Dashboard</td></tr>
                                                            <tr>
                                                                <td id="dash">
                                                                    <input type="radio" name="dash" value="dash_show" <?php echo $cdash_show; ?> disabled="disabled" />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="dash" value="dash_hide" <?php echo $cdash_hide; ?> disabled="disabled" />&nbsp;Hide
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 50%;">
                                                        <?php
                                                        if ($a_hr == "a_hr_edit") {
                                                            $ca_hr_edit = $checked;
                                                        } elseif ($a_hr == "a_hr_view") {
                                                            $ca_hr_view = $checked;
                                                        } elseif ($a_hr == "a_hr_hide") {
                                                            $ca_hr_hide = $checked;
                                                        }
                                                        ?>
                                                        <table>
                                                            <tr><td class="bold underline">Human Resource Module</td></tr>
                                                            <tr>
                                                                <td id="a_hr">
                                                                    <input type="radio" name="a_hr" value="a_hr_edit" <?php echo $ca_hr_edit; ?> disabled="disabled" />&nbsp;Full Access&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="a_hr" value="a_hr_view" <?php echo $ca_hr_view; ?> disabled="disabled" />&nbsp;View Only&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="a_hr" value="a_hr_hide" <?php echo $ca_hr_hide; ?> disabled="disabled" />&nbsp;Hide
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($a_ps == "a_ps_show") {
                                                            $ca_ps_show = $checked;
                                                        } elseif ($a_ps == "a_ps_hide") {
                                                            $ca_ps_hide = $checked;
                                                        }
                                                        ?>
                                                        <table>
                                                            <tr><td class="bold underline">Planning & Simulation Module</td></tr>
                                                            <tr>
                                                                <td id="a_ps">
                                                                    <input type="radio" name="a_ps" value="a_ps_show" <?php echo $ca_ps_show; ?> disabled="disabled" />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="a_ps" value="a_ps_hide" <?php echo $ca_ps_hide; ?> disabled="disabled" />&nbsp;Hide
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        if ($a_pr == "a_pr_show") {
                                                            $ca_pr_show = $checked;
                                                        } elseif ($a_pr == "a_pr_hide") {
                                                            $ca_pr_hide = $checked;
                                                        }
                                                        ?>
                                                        <table>
                                                            <tr><td class="bold underline">Payroll Module</td></tr>
                                                            <tr>
                                                                <td id="a_pr">
                                                                    <input type="radio" name="a_pr" value="a_pr_show" <?php echo $ca_pr_show; ?> disabled="disabled" />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="a_pr" value="a_pr_hide" <?php echo $ca_pr_hide; ?> disabled="disabled" />&nbsp;Hide
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($a_m == "a_m_edit") {
                                                            $ca_m_edit = $checked;
                                                        } elseif ($a_m == "a_m_view") {
                                                            $ca_m_view = $checked;
                                                        } elseif ($a_m == "a_m_hide") {
                                                            $ca_m_hide = $checked;
                                                        }
                                                        ?>
                                                        <table>
                                                            <tr><td class="bold underline">Maintenance Module</td></tr>
                                                            <tr>
                                                                <td id="a_m">
                                                                    <input type="radio" name="a_m" value="a_m_edit" <?php echo $ca_m_edit; ?> disabled="disabled" />&nbsp;Full Access&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="a_m" value="a_m_view" <?php echo $ca_m_view; ?> disabled="disabled" />&nbsp;View Only&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="a_m" value="a_m_hide" <?php echo $ca_m_hide; ?> disabled="disabled" />&nbsp;Hide
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        if ($a_ea == "a_ea_edit") {
                                                            $ca_ea_edit = $checked;
                                                        } elseif ($a_ea == "a_ea_view") {
                                                            $ca_ea_view = $checked;
                                                        } elseif ($a_ea == "a_ea_hide") {
                                                            $ca_ea_hide = $checked;
                                                        }
                                                        ?>
                                                        <table>
                                                            <tr><td class="bold underline">E-Application Management Module</td></tr>
                                                            <tr>
                                                                <td id="a_ea">
                                                                    <input type="radio" name="a_ea" value="a_ea_edit" <?php echo $ca_ea_edit; ?> disabled="disabled" />&nbsp;Full Access&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="a_ea" value="a_ea_view" <?php echo $ca_ea_view; ?> disabled="disabled" />&nbsp;View Only&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="a_ea" value="a_ea_hide" <?php echo $ca_ea_hide; ?> disabled="disabled" />&nbsp;Hide
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
													
                                                    <td>
                                                        <?php
                                                        if ($a_r == "a_r_show") {
                                                            $ca_r_show = $checked;
                                                        } elseif ($a_r == "a_r_hide") {
                                                            $ca_r_hide = $checked;
                                                        }
                                                        ?>
                                                        <table> 
                                                            <tr><td class="bold underline">Reporting Module</td></tr>
                                                            <tr> 
                                                                <td id="a_r">
                                                                    <input type="radio" name="a_r" value="a_r_show" <?php echo $ca_r_show; ?> disabled="disabled" />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="a_r" value="a_r_hide" <?php echo $ca_r_hide; ?> disabled="disabled" />&nbsp;Hide
                                                                </td>
                                                            </tr>
															 <tr class="report" style="display:none"><td class="bold underline">Select Report</td></tr>
                                                                <tr class="report" style="display:none">
                                                                    <td id="a_r">
																	    <input type="checkbox"  id="all" name="a_report[]" value="ALL" onclick="check()" />&nbsp;All&nbsp;&nbsp;&nbsp</br>
                                                                        <input class="check" type="checkbox" name="a_report[]" value="Employee Report" />&nbsp;Employee Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="Allowance & Deduction" />&nbsp;Allowance & Deduction&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="Advance Salary Report" />&nbsp;Advance Salary Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="Attendance Report" />&nbsp;Attendance Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="EPF Report" />&nbsp;EPF Report&nbsp;&nbsp;&nbsp;
																		<input class="check" type="checkbox" name="a_report[]" value="EPF_Socso_Tax Report" />&nbsp;EPF_Socso_Tax Report&nbsp;&nbsp;&nbsp;
                                                                       
                                                                    </td>
                                                                </tr> 
															
                                                        </table>
                                                    </td>
													
                                                </tr>
													
												
                                            </table>
                                        </fieldset>
                                    </td>
                                    <td rowspan="2" style="padding-left: 10px; vertical-align: top;">
                                        <fieldset style='width: auto; height: 315px; padding:5px 5px 20px 10px; border: 1px solid lightgray;'>
                                            <legend class="bold">&nbsp;&nbsp;Authority to View&nbsp;&nbsp;</legend>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <table style="padding-left: 20px;">
                                                            <tr><td><span class="bold underline">Company</span></td></tr>
                                                            <tr>
                                                                <td>
                                                                    <select multiple="multiple" id="dropCompany" style="width: 250px; height: 90px;" readonly="readonly">
                                                                        <?php
                                                                        if ($getCompanyAll != "") {
                                                                            if (count($getCompany) > 0) {
                                                                                for ($i = 0; $i < count($getCompany); $i++) {
                                                                                    $forQuery1 = $forQuery1 . 'id="' . $getCompany[$i] . '" OR ';
                                                                                }
                                                                                $forQuery1 = ' WHERE ' . substr($forQuery1, 0, -4);
                                                                            }
                                                                            $queryCompany1 = mysql_query('SELECT id, code FROM company ' . $forQuery1 . ' ORDER BY code');
                                                                            while ($rowCompany1 = mysql_fetch_array($queryCompany1)) {
                                                                                echo '<option value="' . $rowCompany1["id"] . '">' . $rowCompany1["code"] . '</option>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table style="padding-left: 20px;">
                                                            <tr><td class="bold underline">Branch</td></tr>
                                                            <tr>
                                                                <td>
                                                                    <select id="dropBranch" style="width: 250px; height: 90px;" multiple="multiple" readonly="readonly">
                                                                        <?php
                                                                        if (isset($_GET["view_id"]) == true) {
                                                                            if ($getBranchAll != "") {
                                                                                if (count($getBranch) > 0) {
                                                                                    for ($i = 0; $i < count($getBranch); $i++) {
                                                                                        $forQuery3 = $forQuery3 . 'id="' . $getBranch[$i] . '" OR ';
                                                                                    }
                                                                                    $forQuery3 = ' WHERE ' . substr($forQuery3, 0, -4);
                                                                                }
                                                                                $queryBranch1 = mysql_query('SELECT id, branch_code FROM branch ' . $forQuery3 . ' ORDER BY branch_code');
                                                                                while ($rowBranch1 = mysql_fetch_array($queryBranch1)) {
                                                                                    echo '<option value="' . $rowBranch1["id"] . '">' . $rowBranch1["branch_code"] . '</option>';
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </fieldset>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <fieldset style='width: 700px; height: 100%; padding:5px 5px 20px 10px; border: 1px solid lightgray;'>
                                            <legend class="bold">&nbsp;&nbsp;Employee&nbsp;&nbsp;</legend>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        if ($e_ep == "e_ep_show") {
                                                            $ce_ep_show = $checked;
                                                        } elseif ($e_ep == "e_ep_hide") {
                                                            $ce_ep_hide = $checked;
                                                        }
                                                        ?>
                                                        <table style="padding-left: 20px;">
                                                            <tr><td class="bold underline">Employee Profile</td></tr>
                                                            <tr>
                                                                <td id="e_ep">
                                                                    <input type="radio" name="e_ep" value="e_ep_show" <?php echo $ce_ep_show; ?> disabled="disabled" />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="e_ep" value="e_ep_hide" <?php echo $ce_ep_hide; ?> disabled="disabled" />&nbsp;Hide
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        if ($e_ea == "e_ea_show") {
                                                            $ce_ea_show = $checked;
                                                        } elseif ($e_ea == "e_ea_hide") {
                                                            $ce_ea_hide = $checked;
                                                        }
                                                        ?>
                                                        <table style="padding-left: 20px;">
                                                            <tr><td class="bold underline">E-Application Module</td></tr>
                                                            <tr>
                                                                <td id="e_ea">
                                                                    <input type="radio" name="e_ea" value="e_ea_show" <?php echo $ce_ea_show; ?> disabled="disabled" />&nbsp;Show&nbsp;&nbsp;&nbsp;
                                                                    <input type="radio" name="e_ea" value="e_ea_hide" <?php echo $ce_ea_hide; ?> disabled="disabled" />&nbsp;Hide
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </fieldset>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            <?php } ?>
        </div>
    </div>
    <br/><br/>
    <div class="header_text">
        <span>User Permission List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th>No.</th>
                        <th>User Permission Name</th>
                        <th class="aligncentertable">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = 'SELECT * FROM user_permission';
                $rs = mysql_query($sql);
				

                while ($row = mysql_fetch_array($rs)) {
                    $i = $i + 1;
                    $name = $row['name'];
                    $level_id = $row['id'];

                    echo'<tr class="plugintr">
                        <td>' . $i . '</td>
                    <td>' . $name . '</td>';
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a title="Edit" href="?loc=level_management&id=' . $level_id . '"><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a title="Delete" href="javascript:void()" onclick="deletelevel(' . $level_id . ')" ><i class="fas fa-trash-alt" style="color:#000;"></i></a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td class="aligncentertable"><a href="?loc=level_management&view_id=' . $level_id . '"><i class="far fa-eye" aria-hidden="true"></i></a></td>';
                    }
                    echo '</tr>';
                }
                ?>  
            </table>
        </div>
    </div>
</p></div></div></div>

<script type="text/javascript"> 
    function clearCompany(){
        $("#dropCompany option:selected").removeAttr("selected");
        $("#dropBranch").empty();
    }
    function showBranch(id){
        var company = $('#dropCompany').val();
        if(company == null){
            company = "";
        }else{
            company = $('#dropCompany').val().toString();
        }
        $.ajax({
            type:'POST',
            url:'?widget=showbranch_levelmgt',
            data:{
                company_id:company
            },
            success:function(data){
                $("#dropBranch").empty().append(data);
            }
        })
    }
    function view(id){
        window.location="?loc=level_management&view_id=" + id;
    }
    function clearNew(){
        window.location="?loc=level_management";
    }
    function addlevel(){
		
		var str="0";
        var name = $('#level').val();
        var dash = $("#dash input[type='radio']:checked").val();
        var a_hr = $("#a_hr input[type='radio']:checked").val();
        var a_pr = $("#a_pr input[type='radio']:checked").val();
        var a_ea = $("#a_ea input[type='radio']:checked").val();
		var epr = $("#epr input[type='radio']:checked").val();
        var a_ps = $("#a_ps input[type='radio']:checked").val();
        var a_m = $("#a_m input[type='radio']:checked").val();
        var a_r = $("#a_r input[type='radio']:checked").val();
        var e_ep = $("#e_ep input[type='radio']:checked").val();
        var e_ea = $("#e_ea input[type='radio']:checked").val();
		var appraisal = $("#appraisal input[type='radio']:checked").val();
		var disc = $("#disc input[type='radio']:checked").val();

		if(a_r=="a_r_show"){
			$("input[name='a_report[]']:checked").each(function ()
			{
				str+=$(this).val()+"," 
			});
		}

        var company = $('#dropCompany').val();
        if(company == null){
            company = "";
        }else{
            company = $('#dropCompany').val().toString();
        }
        var branch = $('#dropBranch').val();
        if(branch == null){
            branch = "";
        }else{
            branch = $('#dropBranch').val().toString();
        }
        
        var error1 = [];
        var error2 = [];
        var error3 = [];

        if(name == "" || name == " "){
            error1.push("User Permission Name");
        }
		if(str == "" && a_r=="a_r_show"){
            error2.push("Select the report");
        }
        if(dash == null){
            error2.push("Dashboard");
        }
        if(a_hr == null){
            error2.push("Human Resource Module");
        }
        if(a_pr == null){
            error2.push("Payroll Module");
        }
        if(a_ea == null){
            error2.push("E-Application Module");
        }
		if(epr == null){
            error2.push("Incident/Accident");
        }
        if(a_ps == null){
            error2.push("Planning & Simulation Module");
        }
        if(a_m == null){
            error2.push("Maintenance Module");
        }
        if(a_r == null){
            error2.push("Reporting Module");
        }
        if(e_ep == null){
            error3.push("Employee Profile");
        }
        if(e_ea == null){
            error3.push("Application Module");
        }
		
		if(appraisal == null){
            error3.push("Appraisal Module");
        }
		if(disc == null){
            error3.push("Disciplinary");
        }
                                            
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data1 = "";
        var data2 = "";
        var data3 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Select for Administrator :\n"+error_data2+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select for Employee :\n"+error_data3;
        }
                
        if(error1.length > 0 || error2.length > 0 || error3.length > 0){
            alert(data1 + data2 + data3);
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=addlevel", 
                data:{
                    name:name,
                    dash:dash,
                    a_hr:a_hr,
                    a_pr:a_pr,
                    a_ea:a_ea,
                    a_ps:a_ps,
                    a_m:a_m,
                    a_r:a_r,
                    e_ep:e_ep,
                    e_ea:e_ea,
                    branch:branch,
					str:str,
					epr:epr,
                    company:company,
					appraisal:appraisal,
					disc:disc
                },
                success:function(data){
                    if(data == true){
                        alert("User Permission Added");
                        window.location='?loc=level_management';
                    }else{
                        alert('Error While Processing');
                    }
					
                }                        
            });
        }
    }
    $(function(){
	 $(".a_r").click(function(){
	
	 if($(this).val()=="a_r_show"){
	 $(".report").show(1000)
	 }else{
	 $(".report").hide(100)
	 }
	 
	 })
	 
	})
	
	function check(){
	if ($('input#all').is(':checked')){
	
	$(".check").attr ( "disabled" , true )
	}else{
	$(".check").removeAttr( "disabled")                   
	
	}
	}
    function savelevel(id){ 
       var str="0";
        var name = $('#e_level').val();
        var dash = $("#dash input[type='radio']:checked").val();
        var a_hr = $("#a_hr input[type='radio']:checked").val();
        var a_pr = $("#a_pr input[type='radio']:checked").val();
        var a_ea = $("#a_ea input[type='radio']:checked").val();
		var epr = $("#epr input[type='radio']:checked").val();
        var a_ps = $("#a_ps input[type='radio']:checked").val();
        var a_m = $("#a_m input[type='radio']:checked").val();
        var a_r = $("#a_r input[type='radio']:checked").val();
        var e_ep = $("#e_ep input[type='radio']:checked").val();
        var e_ea = $("#e_ea input[type='radio']:checked").val();
		var appraisal = $("#appraisal input[type='radio']:checked").val();
		var disc = $("#disc input[type='radio']:checked").val();

        	if(a_r=="a_r_show"){
        $("input[name='a_report[]']:checked").each(function ()
{

	str+=$(this).val()+","
	
	
});
}

        var company = $('#dropCompany').val();
		if(str == "" && a_r=="a_r_show"){
            alert("Please Select report");
			exit();
        }
        if(company == null){
            company = "";
        }else{
            company = $('#dropCompany').val().toString();
        }
        var branch = $('#dropBranch').val();
        if(branch == null){
            branch = "";
        }else{
            branch = $('#dropBranch').val().toString();
        }
        if(name == "" || name == " "){
            alert("Please Insert :\nUser Permission Name");
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=editlevel",
                data:{
                    id:id,
                    dash:dash,
                    name:name,
                    a_hr:a_hr,
                    a_pr:a_pr,
                    a_ea:a_ea,
                    a_ps:a_ps,
                    a_m:a_m,
                    a_r:a_r,
                    e_ep:e_ep,
                    e_ea:e_ea,
                    branch:branch,
					str:str,
					epr:epr,
                    company:company,
					appraisal:appraisal,
					disc:disc
                },
                success:function(data){
                    if(data == true){
                        alert("User Permission Updated");
                        window.location='?loc=level_management';
                    }else{
                        alert('Error While Processing');
                    }
                }
                
            });
        }
    }
    
    function deletelevel(levelid){

        var result = confirm("Are you sure you want to delete this record?");
        
        if(result){
            $.ajax({
                type:'POST',
                url:'?widget=deletelevel',
                data:{
                    levelid:levelid
                },

                success:function(data){
                    if(data==true){
                        alert("User Permission Deleted");
                        window.location='?loc=level_management';
                    }else{
                        alert('Error While Processing');
                    }
                }
            })
        }
    }
</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>