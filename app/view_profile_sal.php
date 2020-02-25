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
if ($_GET['t'] != 's') {
    ?>
    <div id="sal" style="display:none; padding-top:15px;">
	<div style="margin-bottom:8%"> 
        <?php
    } else {
        echo '<div id="sal" style="padding-top:15px;">';
    }
    ?>
    <div id="editModeSAL">
        <table id="titlebar" class="titleBarTo" style="width:98.5%; padding-right: 5px;">
            <tr>
                <td style="font-size:large;font-weight: bold;">
                    &nbsp;&nbsp;&nbsp;Salary
                </td>
                <?php if ($igen_a_hr == "a_hr_edit") { ?>
                    <td onclick="editSal(<?php echo $getID ?>)" id="editBut">Edit</td>
                <?php } ?>
            </tr>
        </table>
        <div >
            <table>
                <tr>
                    <td>
                        <table style="padding-top:20px;padding-left:20px;">
                            <tr>
                                <td style="padding-top:5px;width:200px;">Under Contract</td>
                                <td style="padding-top:5px;">
                                    <?php
                                   echo $row['is_contract'];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Salary Type</td>
                                <td style="padding-top:5px">
                                    <?php
                                    if ($row['salary_type'] == "bs") {
                                        echo "Basic Salary";
                                    } elseif ($row['salary_type'] == "mn") {
                                        echo "Monthly";
                                    } elseif ($row['salary_type'] == "wk") {
                                        echo "Weekly";
                                    } elseif ($row['salary_type'] == "dy") {
                                        echo "Daily";
                                    } elseif ($row['salary_type'] == "hr") {
                                        echo "Hourly";
                                    }
                                    ?>
                                </td>
                            </tr>
							<tr>
                                <td style="padding-top:5px;width:200px;">Payment Type</td>
                                <td style="padding-top:5px">
                                    <?php
                                    if($row['payment_type']!=""){
										echo ucfirst($row['payment_type']);
									}else{
										echo"-";
									}
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Salary Amount (RM)</td>
                                <td style="padding-top:5px"><input type="hidden" id="textsalary" value="<?php echo $row['salary'] ?>"/><?php print number_format($row['salary']); ?></td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Bank Type</td>
                                <td style="padding-top:5px;color:<?php echo $fontColorBank ?>">
                                    <?php
                                    if ($bank != 0) {
                                        $sqlbank = mysql_query('SELECT name FROM bank WHERE id=' . $bank);
                                        $rowbank = mysql_fetch_array($sqlbank);
                                        echo $rowbank["name"];
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:200px">Bank Account Number</td>
                                <td style="padding-top:6px;color:<?php echo $fontColorBankNum ?>">
                                    <?php
                                    if ($bankNum != "") {
                                        print $bankNum;
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                            </tr>
							 <tr>
                                <td style="padding-top:5px;width:200px;">Salary Grade</td>
                                <td style="padding-top:5px;">
                                    <?php
									if($row['salary_grade'] == ""){
										echo "-";
									}else{
										echo $row['salary_grade'];
									}
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">EPF Number</td>
                                <td style="padding-top:5px;color:<?php echo $fontColorEpf ?>">
                                    <?php
                                    if ($epf != "") {
                                        print $epf;
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Socso Number</td>
                                <td style="padding-top:5px;color:<?php echo $fontColorSocso ?>">
                                    <?php
                                    if ($socso != "") {
                                        print $socso;
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Income Tax Number</td>
                                <td style="padding-top:5px;color:<?php echo $fontColorItax ?>">
                                    <?php
                                    if ($iTax != "") {
                                        print $iTax;
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Zakat (RM)</td>
                                <td style="padding-top:5px;color:<?php echo $fontColorZakat ?>">
                                    <?php
                                    if ($zakat != "" && $zakat != 0) {
                                        print number_format($zakat, 2, '.', '');
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            $sqlgetovertime = mysql_query('SELECT e.overtime_type, o.overtime_name FROM overtime AS o INNER JOIN employee AS e ON e.overtime_type=o.id WHERE e.id=' . $getID . ';');
                            $rowOT = mysql_fetch_array($sqlgetovertime);
                            ?>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Overtime</td>
                                <td style="padding-top:5px;width:200px;">
                                    <?php
                                    if ($rowOT['overtime_type'] != 0) {
                                        print $rowOT['overtime_name'];
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
								<td>
								<?php
									if($cap!=""){
										if ($cap=="Y") {
										   $cap = 'checked="checked"';
										}
										echo'<input type="checkbox" name="overtime-cap" value="Y" id="cap" style="margin-left: -121px;"'.$cap.'> Cap &nbsp;&nbsp;&nbsp;';
									}
								?>		
								</td>
								
                            </tr>
							<tr>
                                <td>Include or Exclude From</td>
                                <td>
                                    <?php
									
                                    if ($epf1=="Y") {
                                        $e_epf = 'checked="checked"';
                                    }
									
                                    if ( $socso1 == "Y") {
                                        $e_socso = 'checked="checked"';
                                    }
                                    if ( $pcp1 == "Y") {
                                        $e_pcb = 'checked="checked"';
                                    }
									if ( $eis == "Y") {
                                        $e_eis = 'checked="checked"';
                                    }
									
                                    ?>
                                    <input type="checkbox" name="allowance" value="epf" id="epf" <?php echo $e_epf; ?> />&nbsp;EPF&nbsp;
                                    <input type="checkbox" name="allowance" value="socso" id="socso" <?php echo $e_socso; ?> />&nbsp;SOCSO&nbsp;
									<input type="checkbox" name="allowance" value="eis" id="eis" <?php echo $e_eis; ?> />&nbsp;EIS&nbsp;
                                    <input type="checkbox" name="allowance" value="pcb" id="pcb" <?php echo $e_pcb; ?>/>&nbsp;PCB
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;">Salary History</td>
                                <td style="padding-top:6px;"><a class="blue" onclick="salaryhistory(<?php echo $getID ?>)">View</a></td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;">Payslip History</td>
                                <td style="padding-top:6px;"><a class="blue" onclick="paysliphistory()">View</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
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