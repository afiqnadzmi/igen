<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
include_once "app/test_jason.php";
include_once "app/test.php";
include_once "app/loh.php";

?>
<div class="main_div">
<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Employee Payroll</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="header_text">
        <span>Employee Payroll</span> 
        <span style="float: right;">
            <table>
                <tr>
                    <td><input style="width: 120px;" id="finalise_payroll" type="button" value="Monthly Closing" class="editBut" onclick="loadPopupBox()" /></td>
                </tr>
            </table>
        </span>
    </div>
    <div class="main_content">
        <div id="container" class="tablediv">
            <?php
            if (isset($_GET["show"]) == false) {
                if (isset($_GET['emp_id']) == true && isset($_GET["mon"]) && isset($_GET["year"])) {
                    $emp_id = $_GET['emp_id'];
                    $month = isset($_GET["mon"]) ? $_GET["mon"] : date('n');
                    $year = isset($_GET["year"]) ? $_GET["year"] : date('Y');
                    $checkJoin = checkEmpJoinIn($emp_id, $month, $year);
                    $start_date = 1;

                    $getEmpStatus = mysql_query('SELECT emp_status FROM employee WHERE id=' . $emp_id);
                    $rowEmpStatus = mysql_fetch_array($getEmpStatus);
                    $emp_status = $rowEmpStatus["emp_status"];

                    $chk_sql = "select id, is_close from payroll_finalised where finalise_month='" . $month . "' and finalise_year='" . $year . "' limit 1";
                    $chk_rs = mysql_query($chk_sql);
                    $chk_row = mysql_fetch_array($chk_rs);
                    if ($chk_rs && mysql_num_rows($chk_rs) > 0) {
                        $p_rs = mysql_query('SELECT * FROM payroll_report WHERE payroll_finalised_id = ' . $chk_row['id'] . ' AND emp_id=' . $emp_id);
                        $p_num = mysql_num_rows($p_rs);
                        $p_row = mysql_fetch_array($p_rs);
                        if ($chk_row["is_close"] == "1" || $p_num > 0) {
                            $finalised = true;
                            $finalised_id = $chk_row['id'];
                            $pid = $p_row['id'];
                            $mod_month = str_pad($month, 2, '0', STR_PAD_LEFT);
                            $mod_date = str_pad($start_date, 2, '0', STR_PAD_LEFT);
                            $total_day_month = date('t', mktime(0, 0, 0, $month, 1, $year));

                            $complete_start_date = $p_row['from_date'];
                            $complete_end_date = $p_row['to_date'];

                            $get_unpaid_leave = $p_row['unpaid_leave'];
                            $get_absent = $p_row['absent'];
                            $get_advance_salary = $p_row['advance_salary'];
                            $get_late_leave_time = $p_row['late_leave_time'];

                            $get_basic = $p_row['basic_salary'];
                            $get_salary_per_hours = $p_row['hourly_rate'];
                            $get_overtime = $p_row['ot_amount'];
                            $total_allowance = $p_row['allowance'];
                             $get_comission_epf=$p_row['comission'];
                            $get_bonus = $p_row['bonus'];
                            $get_loan = $p_row['loan'];
                            $get_late_leave = $p_row['late_early_leave'];

                            $get_epf = $p_row['epf'];
                            $get_socso = $p_row['socso'];
                            $get_employer_epf = $p_row['employer_epf'];
                            $get_employer_socso = $p_row['employer_socso'];
                            $get_pcb = $p_row['pcb'];
                            $get_claim = $p_row['claim'];
                            $get_paid_leave = $p_row['paid_leave'];
                            $get_days_absent = $p_row['days_absent'];
                            $get_days_at_work = $p_row['days_at_work'];

                            $get_unpaid_leave_time = $p_row['unpaid_leave_hour'];
                            $get_designation = $p_row['designation'];
                            $ot_dur = $p_row['ot_duration'];
                            $gross_pay = $p_row['gross_pay'];
                            $net_pay = $p_row['netpaid'];
                            $get_name = emp_name($emp_id);
                            $total_working_hours = $p_row['daily_hour'];
                            $daily_rate = $p_row['daily_rate'];
                        } else {
                            if ($emp_status == "Active" && $checkJoin != 0) {
                                $finalised = false;
                                include 'app/calculate_payroll.php';
                            }
                        }
                    } else {
                        if ($emp_status == "Active" && $checkJoin != 0) {
                            $finalised = false;
                            include 'app/calculate_payroll.php';
                        }
                    }
                }
				
                if ($finalised == true) {
                    $employer_total_epf = employer_total_epf($emp_id, $year, $month);
                    $employer_total_socso = employer_total_socso($emp_id, $year, $month);
                    $employee_total_epf = employee_total_epf($emp_id, $year, $month);
                    $employee_total_socso = employee_total_socso($emp_id, $year, $month);
                } elseif ($finalised == false) {
                    $employer_total_epf = employer_total_epf($emp_id, $year, $month) + $get_employer_epf;
                    $employer_total_socso = employer_total_socso($emp_id, $year, $month) + $get_employer_socso;
                    $employee_total_epf = employee_total_epf($emp_id, $year, $month) + $get_epf;
                    $employee_total_socso = employee_total_socso($emp_id, $year, $month) + $get_socso;
					
                }
				
            }
            include_once 'app/payroll_search.php';
			
            ?>
        </div>
    </div>
    <br/><br/>
    <div class="header_text">
        <span>Payroll Summary</span>
        <?php if (isset($_GET["selection"]) == true && $_GET["selection"] == "all") { ?>
            <span style="float: right;">
                <?php
                if ($_GET["status"] == "") {
                    $sqlAdd = '';
                } elseif ($_GET["status"] == "Active") {
                    $sqlAdd = ' AND emp_status = "Active"';
                } elseif ($_GET["status"] == "Inactive") {
                    $sqlAdd = ' AND emp_status = "Inactive"';
                }
                if ($_GET["dep"] == "0") {
                    $sqlDep = 'INNER JOIN department AS d ON d.id = e.dep_id';
                    $sqlDepActive = ' AND d.is_active=1';
                    $queryLessEmp = mysql_query('SELECT e.id, e.full_name FROM employee AS e ' . $sqlDep . ' WHERE e.branch_id=' . $_GET["branch"] . ' AND e.id < ' . $_GET["emp_id"] . $sqlAdd . $sqlDepActive . ' ORDER BY e.id DESC LIMIT 1');
                    $queryMoreEmp = mysql_query('SELECT e.id, e.full_name FROM employee AS e ' . $sqlDep . ' WHERE e.branch_id=' . $_GET["branch"] . ' AND e.id > ' . $_GET["emp_id"] . $sqlAdd . $sqlDepActive . ' ORDER BY e.id ASC LIMIT 1');
                    $queryGetEmp = mysql_query('SELECT e.id, e.full_name FROM employee AS e ' . $sqlDep . ' WHERE e.branch_id = ' . $_GET["branch"] . $sqlAdd . $sqlDepActive . ' ORDER BY e.id');
                } else {
                    $queryLessEmp = mysql_query('SELECT id, full_name FROM employee WHERE dep_id=' . $_GET["dep"] . ' AND id < ' . $_GET["emp_id"] . $sqlAdd . ' ORDER BY id DESC LIMIT 1');
                    $queryMoreEmp = mysql_query('SELECT id, full_name FROM employee WHERE dep_id=' . $_GET["dep"] . ' AND id > ' . $_GET["emp_id"] . $sqlAdd . ' ORDER BY id ASC LIMIT 1');
                    $queryGetEmp = mysql_query('SELECT id, full_name FROM employee WHERE dep_id = ' . $_GET["dep"] . $sqlAdd . ' ORDER BY id');
                }
                ?>
                <?php if (isset($_GET["print"]) == true && $_GET["print"] == "true") { ?>
                    <table id="showAllEmpTable">
                        <tr>
                            <td style="width: 30px;">
                                <?php
                                $rowLessEmp = mysql_fetch_array($queryLessEmp);
                                $numLessEmp = mysql_num_rows($queryLessEmp);
                                if ($numLessEmp > 0) {
                                    echo '<a style="color: white;" title="' . $rowLessEmp["full_name"] . '" href="?loc=payroll&print=true&selection=all&status=' . $_GET["status"] . '&emp_id=' . $rowLessEmp["id"] . '&company=' . $_GET["company"] . '&branch=' . $_GET["branch"] . '&dep=' . $_GET["dep"] . '&mon=' . $_GET["mon"] . '&year=' . $_GET["year"] . '">&#60;&#60;</a>';
                                }
                                ?>
                            </td>
                            <td>
                                <select style="width: 250px;" onchange="view_payroll(this.value, <?php echo $_GET["company"]; ?>, <?php echo $_GET["branch"]; ?>, <?php echo $_GET["dep"]; ?>, <?php echo $_GET["mon"]; ?>, <?php echo $_GET["year"]; ?>)">
                                    <option value="">--Please Select--</option>
                                    <?php
                                    while ($rowGetEmp = mysql_fetch_array($queryGetEmp)) {
                                        if (isset($_GET["emp_id"]) == true && $_GET["emp_id"] == $rowGetEmp["id"]) {
                                            echo '<option value="' . $rowGetEmp["id"] . '" selected="selected">' . $rowGetEmp["full_name"] . '</option>';
                                        } else {
                                            echo '<option value="' . $rowGetEmp["id"] . '">' . $rowGetEmp["full_name"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                            <td style="width: 30px; text-align: right;">
                                <?php
                                $rowMoreEmp = mysql_fetch_array($queryMoreEmp);
                                $numMoreEmp = mysql_num_rows($queryMoreEmp);
                                if ($numMoreEmp > 0) {
                                    echo '<a style="color: white;" title="' . $rowMoreEmp["full_name"] . '" href="?loc=payroll&print=true&selection=all&status=' . $_GET["status"] . '&emp_id=' . $rowMoreEmp["id"] . '&company=' . $_GET["company"] . '&branch=' . $_GET["branch"] . '&dep=' . $_GET["dep"] . '&mon=' . $_GET["mon"] . '&year=' . $_GET["year"] . '">&#62;&#62;</a>';
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                <?php } ?>
            </span>
        <?php } ?>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <table>
			<!--
                <tr>
                    <td style="padding-top:10px; width: 200px;">Working Days</td> 
                    <td style="width: 50px;">(Day)</td>
                    <td style="padding-top:10px;"><input type="text" class="input_text"  name="days_at_work" id="days_at_work" style="width: 200px" readonly value="<?php echo $get_days_at_work ?>"/></td>
                    <td style="padding-top:10px;padding-left: 50px; width: 200px;">Daily Rate</td>
                    <td style="width: 50px;">(RM)</td>
                    <td style="padding-top:10px;"><input type="text" class="input_text"  name="daily_rate" id="daily_rate" style="width: 200px" readonly value="<?php echo number_format($daily_rate, 2) ?>"/></td>
                </tr>

                <tr>
                    <td style="padding-top:10px;" >Days Absent</td>
                    <td>(Day)</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="days_absent" name="days_absent"  style="width: 200px" readonly value="<?php echo $get_days_absent ?>"/></td>
                    <td style="padding-top:10px;padding-left: 50px;">Hourly Rate</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;"><input type="text" class="input_text"  name="hourly_rate" id="hourly_rate" style="width: 200px" readonly value="<?php echo number_format($get_salary_per_hours, 2) ?>"/></td>
                </tr>
              -->
                <tr>
                    <td style="padding-top:10px;" >Basic Salary</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="basic_salary" name="basic_salary" style="width: 200px" readonly value="<?php echo number_format($get_basic, 2) ?>"/></td>
                   <!-- <td style="padding-top:10px;padding-left: 50px;">Late In Early Out</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;"><input type="text" class="input_text"  name="late_early" id="late_early" style="width: 200px" readonly value="<?php echo number_format($get_late_leave, 2) ?>"/></td> -->
                </tr>

                <tr>
                    <td style="padding-top:10px;" >OT Amount</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="ot" name="ot" style="width: 200px" readonly value="<?php echo number_format($get_overtime, 2) ?>"/></td>
                    <td style="padding-top:10px;padding-left: 50px;">Net Paid Out Amount</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;"><input type="text" class="input_text"  name="net_paid" id="net_paid" style="width: 200px" readonly value="<?php echo number_format($net_pay, 2) ?>"/></td>
                </tr>
            </table>
        </div>
    </div>
    <br/><br/>
    <div class="header_text">
        <span>Payroll Detail</span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <table>
                <tr>
                  <!--  <td style="padding-top:10px; width: 200px;">Payroll Number</td>
                    <td></td>
                    <td style="padding-top:10px;"><input type="text" class="input_text"  name="payroll_num" id="payroll_num" style="width: 200px" readonly value="<?php echo isset($pid) ? str_pad($pid, 6, '0', STR_PAD_LEFT) : '00001' ?>"/></td>-->
                </tr>
                <tr>
                    <td style="padding-top:10px;" >Employee ID</td>
                    <td style="width: 50px;">&nbsp;</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="emp_id" name="emp_id"  style="width: 200px" readonly value="<?php echo 'EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) ?>"/></td>
                    <td style="padding-top:10px;padding-left: 50px; width: 200px;" >Date From</td>
                    <td style="width: 50px;">&nbsp;</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="date_from" name="date_from" style="width: 200px" readonly value="<?php echo date("d-m-Y", strtotime($complete_start_date)); ?>" /></td>                   
                </tr>

                <tr>
                    <td style="padding-top:10px;" >Employee Name</td>
                    <td>&nbsp;</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="emp_name" name="emp_name" style="width: 200px" readonly value="<?php echo $get_name ?>"/></td>
                    <td style="padding-top:10px;padding-left: 50px;" >Date To</td>
                    <td>&nbsp;</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="date_to" name="date_to" style="width: 200px" readonly value="<?php echo date("d-m-Y", strtotime($complete_end_date)); ?>" /></td>
                </tr>

                <tr><td colspan="6" style="border-bottom: 1px solid lightgray;">&nbsp;</td></tr>

                <tr>
                    <td style="padding-top:10px;" >Basic Salary</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="basic_amount" name="basic_amount" style="width: 200px" readonly value="<?php echo number_format($get_basic, 2) ?>"/></td>
                    <td style="padding-top:10px;padding-left: 50px;">Working Hours / Day</td>
                    <td>(Hour)</td>
                    <td style="padding-top:10px;"><input type="text" class="input_text"  name="days_hours" id="days_hours" style="width: 200px" readonly value="<?php echo $total_working_hours ?>" /></td>
                </tr>
                <tr>
                    <td style="padding-top:10px;">Allowance</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;"><input type="text" class="input_text"  name="allowance" id="allowance" style="width: 200px" readonly value="<?php echo number_format($total_allowance, 2) ?>"/></td>
					<td style="padding-top:10px;padding-left: 50px;">Paid Leave</td>
                    <td>(Day)</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="pay_leave" name="pay_leave" style="width: 200px" readonly value="<?php echo $get_paid_leave ?>"/></td>
                    <!--<td style="padding-top:10px;padding-left: 50px;">Working Days</td>
                    <td>(Day)</td>
                    <td style="padding-top:10px;"><input type="text" class="input_text"  name="days_at_work" id="days_at_work" style="width: 200px" readonly value="<?php echo $get_days_at_work ?>"/></td> -->
                </tr>

                <tr>
                    <td style="padding-top:10px;">Commission Amount</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;"><input type="text" class="input_text"  name="bonus_amount" id="bonus_amount" style="width: 200px" readonly value="<?php echo number_format($get_comission_epf, 2) ?>"/></td>
					 <td style="padding-top:10px;padding-left: 50px;">Loan Deduction</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;"><input type="text" class="input_text"  name="loan_deduction" id="loan_deduction" style="width: 200px" readonly value="<?php echo number_format($get_loan, 2) ?>"/></td>
                   <!-- <td style="padding-top:10px;padding-left: 50px;">Days Absent</td>
                    <td>(Day)</td>
                    <td style="padding-top:10px;"><input type="text" class="input_text"  name="days_absent" id="days_absent" style="width: 200px" readonly value="<?php echo $get_days_absent ?>" /></td> -->
                </tr>
                <tr>
                    <td style="padding-top:10px;">OT Total Duration</td>
                    <td>(Hour)</td>
                    <td style="padding-top:10px;"><input type="text" class="input_text"  name="ot_duration" id="ot_duration" style="width: 200px" readonly value="<?php echo number_format($ot_dur, 1) ?>"/></td>
					
                   <td style="padding-top:10px;padding-left: 50px;">Unpaid Leave</td>
                    <td>(Day)</td>
                    <td style="padding-top:10px;"><input type="text" class="input_text"  name="unpaid" id="unpaid" style="width: 200px" readonly value="<?php echo ($get_unpaid_leave_time / 8) ?>"/></td>
                </tr>

                <!--<tr>
                    <td style="padding-top:10px;" >OT Amount</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="ot" name="ot" style="width: 200px" readonly value="<?php //echo number_format($get_overtime, 2) ?>"/></td>

                    
                </tr>-->
				
				<?php
					if ($finalised) {
						// Claims
						$sql_claim = 'SELECT * FROM  payroll_claim  where emp_id = "' . $emp_id . '" and payout_month=' . $month . ' and payout_year=' . $year . ' and payroll_finalised_id=' . $finalised_id;
						$rs_claim = mysql_query($sql_claim);
						$num_row = mysql_num_rows($rs_claim);
				
						//Deduction
						$sql_deduction = 'SELECT * FROM  payroll_deduction  where emp_id = "' . $emp_id . '" and payout_month=' . $month . ' and payout_year=' . $year . ' and payroll_finalised_id=' . $finalised_id;
						$rs_deduction = mysql_query($sql_deduction);
						$num_row_deduction = mysql_num_rows($rs_deduction);
					}
				?>
	
				<?php
					if (isset($_GET['emp_id']) == TRUE) {
						//Claims
						if ($num_row > 0) {
				             if($num_row>1){
								echo "  <tr><td colspan='6' style='border-bottom: 1px solid lightgray;'>Claims</td></tr>";
							 }
							while ($row = mysql_fetch_array($rs_claim)) {
							?>	
							
									<tr><td style="padding-top:10px;" ><?php echo ucfirst($row['claim_type']);  ?></td>
									<td>(RM)</td>
									<td style="padding-top:10px;" ><input type="text" class="input_text" id="claim" name="claim" style="width: 200px" readonly value="<?php echo number_format($row['claim_amount'], 2) ?>"/></td></tr>                  
									
				<?php
							}
							  if($num_row>1){
									echo'<tr>
										<td style="padding-top:10px;" >Total</td>
										<td>(RM)</td>
										<td style="padding-top:10px;" ><input type="text" class="input_text" id="claim" name="claim" style="width: 200px" readonly value="'.number_format($get_claim, 2).'"/></td>    
								   
									</tr>';
							  }
						}
						// Deduction
						if ($num_row_deduction > 0) {
							if($num_row_deduction > 1){
								echo "  <tr><td colspan='6' style='border-bottom: 1px solid lightgray;'>Deduction</td></tr>";
							}
							while ($row_deduction = mysql_fetch_array($rs_deduction)) {
							?>	
							
									<tr><td style="padding-top:10px;" ><?php echo ucfirst($row_deduction['deduction_title']);  ?></td>
									<td>(RM)</td>
									<td style="padding-top:10px;" ><input type="text" class="input_text" id="deduction" name="deduction" style="width: 200px" readonly value="<?php echo number_format($row_deduction['deduction_amount'], 2) ?>"/></td> </tr>                 
									
				<?php
							}
					}
				}
				?>
			
                
                <?php
                $i = 1;
                if ($finalised) {
                    $sql = 'SELECT * FROM payroll_advance_salary where emp_id = "' . $emp_id . '" and month(request_date)=' . $month . ' and year(request_date)=' . $year . ' and payroll_finalised_id=' . $finalised_id;
                } else {
                    $sql = 'SELECT * FROM advance_salary where emp_id = "' . $emp_id . '" and month(request_date)=' . $month . ' and year(request_date)=' . $year;
                }
                $rs = mysql_query($sql);
                $num_row = mysql_num_rows($rs);
                if (isset($_GET['emp_id']) == TRUE) {
                    if ($num_row > 0) {
                        ?>
                        <tr><td colspan="6" style="border-bottom: 1px solid lightgray;">&nbsp;</td></tr>

                        <tr>
                            <td colspan="4" style="vertical-align: top;">
                                <table>    
                                    <tr>
                                        <th style="width: 200px;"></th>
                                        <th style="padding-left: 5px;">Amount (RM)</th>
                                        <th style="padding-left: 10px;">Date</th>
                                    </tr> 
                                    <?php
                                    while ($row = mysql_fetch_array($rs)) {
                                        $adv_amount = $row['advance_amount'];
                                        $request_date = $row['request_date'];
                                        echo '<tr>
                                      <td style="padding-top:10px;">Advance Salary ' . $i . '</td>
                                      <td style="padding-top:10px;"><input type="text" class="input_text"  name="adv_amount_' . $i . '" id="adv_amount_' . $i . '" style="width: 90px" value="' . $adv_amount . '"/></td>
                                      <td style="padding-top:10px; padding-left: 10px;"><input type="text" class="input_text"  name="adv_date_' . $i . '" id="adv_date_' . $i . '" style="width: 90px" value=' . $request_date . '></td>
                                      </tr>';
                                        $i++;
                                    }
                                    ?>
                                </table>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>  

                <tr><td colspan="6" style="border-bottom: 1px solid lightgray;">&nbsp;</td></tr>

                <tr>
                    <td style="padding-top:10px;" >EPF Deduction</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="epf" name="epf" style="width: 200px" readonly value="<?php echo number_format($get_epf, 2) ?>"/></td>
                    <td style="padding-top:10px;padding-left: 50px;" >Employer EPF</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="ot_amount" name="ot_amount" style="width: 200px" readonly value="<?php echo number_format($get_employer_epf, 2) ?>"/></td>
                </tr> 

                <tr>
                    <td style="padding-top:10px;" >Socso Deduction</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="socso" name="socso" style="width: 200px" readonly value="<?php echo number_format($get_socso, 2) ?>"/></td>
                    <td style="padding-top:10px;padding-left: 50px;" >Employer Socso</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="ot" name="ot" style="width: 200px" readonly value="<?php echo number_format($get_employer_socso, 2) ?>"/></td>
                </tr> 

                <tr>
                    <td style="padding-top:10px;">Income Tax Amount</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;"><input type="text" class="input_text"  name="income_tax_amount" id="income_tax_amount" style="width: 200px" readonly value="<?php echo number_format($get_pcb, 2) ?>"/></td>
                </tr>

                <tr><td colspan="6" style="border-bottom: 1px solid lightgray;">&nbsp;</td></tr>

                <tr>
                    <td style="padding-top:10px;" >Total EPF</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="ot" name="ot" style="width: 200px" readonly value="<?php echo number_format($employee_total_epf, 2) ?>"/></td>
                    <td style="padding-top:10px;padding-left: 50px;" >Total Employer EPF</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="ot" name="ot" style="width: 200px" readonly value="<?php echo number_format($employer_total_epf, 2) ?>"/></td>
                </tr>
                <tr>
                    <td style="padding-top:10px;" >Total Socso</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="ot" name="ot" style="width: 200px" readonly value="<?php echo number_format($employee_total_socso, 2) ?>"/></td>
                    <td style="padding-top:10px;padding-left: 50px;" >Total Employer Socso</td>
                    <td>(RM)</td>
                    <td style="padding-top:10px;" ><input type="text" class="input_text" id="ot" name="ot" style="width: 200px" readonly value="<?php echo number_format($employer_total_socso, 2) ?>"/></td>
                </tr>
                <tr><td colspan="4" style="padding-bottom: 20px;"></td></tr>
            </table>
        </div>
    </div>
</p></div></div></div>


<div id="popup_box">	 
    <div style="padding-top: 5px;">
        <input class='button' type='button' value='Process12' onclick='finalisepayroll()' id='buttonFinalize' style='width:100px' />
    </div>
    <input id="popupBoxClose" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: dimgrey;" type="button" value="X" onclick="unloadPopupBox()" />
    <table style="padding-top: 10px;">
        <tr>
            <td style="font-weight: bold; font-size: 15px;">Monthly Closing for&nbsp;&nbsp;</td>
            <td>
                <select id="finalmonth" style="width: auto;">
                    <?php
                    $count = 0;
                    for ($i = 1; $i < 13; $i++) {
                        $m = date('n');
                        $pf_sql = "SELECT id FROM payroll_finalised WHERE finalise_month='" . $i . "' AND finalise_year='" . date('Y') . "' AND is_close = 1";
                        $pf_rs = mysql_query($pf_sql);
                        if ($pf_rs && mysql_num_rows($pf_rs) > 0) {
                            $finalised = "disabled";
                            $count = $count + 1;
                        } else {
                            $finalised = "";
                        }
                        ?>
                        <option <?php echo $finalised ?> value="<?php echo $i ?>"><?php echo date('M', mktime(0, 0, 0, $i, 1, date("Y"))) ?></option>
                    <?php } ?>
                </select>
            </td>
            <td style="padding-left: 5px;">
                <select style="width: 80px;" id="finalyear" onchange="changeYearFinal(this.value)">
                    <?php for ($i = date("Y"); $i >= date("Y") - 5; $i--) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
    </table>
    <span id="finalizedcount" style="display: none;"><?php echo $count; ?></span>
    <br/>
</div>


<script type="text/javascript">
<?php
if (isset($_GET["message"])) {
    ?>
            alert("Selected month has been finalised.");
    <?php
}
?>
</script>
<script type="text/javascript">
    function changeYearFinal(year){
        var month=$('#finalmonth').val();
        $.ajax({
            type:"POST",
            url:"?widget=monthDis_payroll",
            data:{
                action:"dropdown",
                month : month,
                year : year
            },
            success:function(data){
                $('#finalmonth').empty().append(data);
                $.ajax({
                    type:"POST",
                    url:"?widget=monthDis_payroll",
                    data:{
                        action:"getcount",
                        month : month,
                        year : year
                    },
                    success:function(data){
                        $('#finalizedcount').empty().html(data);
                    }
                });
            }
        });
    }
    
    function loadPopupBox() {
        $('#popup_box').fadeIn("slow");
        $(".main_div").css({
            "opacity": "0.3"  
        }); 		
    }

    function unloadPopupBox() {
        $('#popup_box').fadeOut("slow");
        $(".main_div").css({
            "opacity": "1"  
        }); 
    }	
    
    function view_payroll(emp, company, branch, dep, mon, year){
        var status = $("#emp_status").val();
        window.location='?loc=payroll&print=true&selection=all&status='+status+'&emp_id='+emp+'&company='+company+'&branch='+branch+'&dep='+dep+'&mon='+mon+'&year='+year;
    }
    
    function printpay(month,year,emp_id){
        if(emp_id == ""){
            alert("Please Select Employee");
        }else{
            window.open("?widget=printpayroll&selection=1&emp_id="+emp_id+"&month="+month+"&year="+year);
        }
    }
    
    function printpayall(month,year,branch,emp,dep){
	    var emp_id=emp;
        var status = $("#emp_status").val(); 
        window.open("?widget=printpayroll&selection=2&status="+status+"&emp_id="+emp_id+"&branch_id="+branch+"&dep_id="+dep+"&month="+month+"&year="+year);
    }
	function printpreview(){
		var month="<?php echo $_GET['mon'] ?>";
		var year="<?php echo $_GET['year'] ?>";
		var branch="<?php echo $_GET['branch'] ?>";
		var dep="<?php echo $_GET['dep'] ?>";
		var emp_id="<?php echo $_GET['emp_id'] ?>";
		var branch="<?php echo $_GET['branch'] ?>";	   
        var status = $("#emp_status").val(); 
        window.open("?widget=payroll_preview&selection=2&status="+status+"&emp_id="+emp_id+"&branch="+branch+"&dep="+dep+"&mon="+month+"&year="+year);
    }

    function displaytable(selection){

        if(selection == 1){
            $('#table1').css({"display": "block"});
        }
        else if(selection == 2){
            $('#table1').css({"display": "none"});
        }
        
        $("#showresult").css({"display": "none"});
        $('#printpay').css({"display": "none"});
        $('#confirmBtn').css({"display": "none"});
        $("#dropBranch").val("");
        $("#emp_name").val("");
        $("#showAllEmpTable").empty();
        $("#selectdep").empty().append("<option value=''>--Please Select--</option>");
    }

    function showresult(){
		var dept = $("#selectdep").val();
		var month="<?php echo $_GET['mon'];?>";
		var year="<?php echo $_GET['year'];?>";
		var branch_id="<?php echo $_GET['branch'];?>";
	$checking=false;
	 $.ajax({
            type:"POST",
            url:"?widget=check_payroll",
            data:{
                dept:dept,
				branch_id:branch_id,
				month:month,
				year:year
            },
            success:function(data){
				
				if(data=="false"){
					var company = $("#dropCompany").val();
					var branch = $("#dropBranch").val();
					var dept = $("#selectdep").val();
					var selection = $("#selection").val();
					var emp_name = $("#emp_name").val();
					var emp_status = $("#emp_status").val();
			
					var error1 = [];
					
					if(selection == 1){
						if(emp_name == ""){
							error1.push("Employee");
						}
					}
					
					if(company == ""){
						error1.push("Company");
					}
					if(branch == ""){
						error1.push("Branch");
					}
					if(dept == ""){
						error1.push("Department");
					}
					
					var error_data1 = '';
					for(var i=0; i< error1.length; i++){
						error_data1 = error_data1 + error1[i] + "; "
					}
					var data1 = "";
					if(error1.length > 0){
						data1 = "Please Select :\n"+error_data1;
					}
							
					if(error1.length > 0){
						alert(data1);
					}else{
						if(selection == "1"){
							window.location="?loc=payroll&print=true&emp_id=<?php echo $_GET["emp_id"] ?>&mon="+$("#ddlmon").val()+"&year="+$("#ddlyear").val();
						}else if(selection == "2"){
							window.location="?loc=payroll&print=true&selection=all&status="+emp_status+"&company="+company+"&branch="+branch+"&dep="+dept+"&emp_id=<?php echo $_GET["emp_id"] ?>&mon="+$("#ddlmon").val()+"&year="+$("#ddlyear").val();
						}
					}
			   }else{
			   alert(data);
			   
			   }
            }
        });
    }
    
    function finalisepayroll(){
        var getcount = $("#finalizedcount").html();
        var month=$('#finalmonth').val();
        var year=$('#finalyear').val();
        $.ajax({
            type:"POST",
            url:"?widget=monthDis_payroll",
            data:{
                action:"getEmpAmt",
                month : month,
                year : year
            },
            success:function(data){
                if(data != "0"){
                    var confirmView = confirm(data);
                    if(confirmView){
                        $.ajax({
                            type:"POST",
                            url:"?widget=monthDis_payroll",
                            data:{
                                action:"getpayrollid",
                                month : month,
                                year : year
                            },
                            success:function(data){
                                if(getcount == 12){
                                }else{
                                    var result = confirm('Are you sure you want to finalize for this month?');
                                    if(result){
                                        window.location='?widget=finalise_payroll&payroll_id='+data+'&month='+month+'&year='+year;
                                    }
                                }
                            }
                        });        
                    }else{
                        $.ajax({
                            type:'POST',
                            url:"?widget=monthDis_payroll",
                            data:{
                                action:"getEmpID",
                                month : month,
                                year : year
                            },
                            success:function(data){
                                window.open('?widget=notconfirm_emplist&emp='+data,'mywindow','location=1,status=1,scrollbars=1,width=850,height=700');  
                            }
                        })
                    }
                }else{
                    $.ajax({
                        type:"POST",
                        url:"?widget=monthDis_payroll",
                        data:{
                            action:"getpayrollid",
                            month : month,
                            year : year
                        },
                        success:function(data){
                            if(getcount == 12){
                            }else{
                                var result = confirm('Are you sure you want to finalize for this month?');
                                if(result){
                                    window.location='?widget=finalise_payroll&payroll_id='+data+'&month='+month+'&year='+year;
                                }
                            }
                        }
                    });        
                }
            }
        });  
    }

    /*Original Closing Function*/
    //    function finalisepayroll(){
    //        var getcount = $("#finalizedcount").html();
    //        var month=$('#finalmonth').val();
    //        var year=$('#finalyear').val();
    //        $.ajax({
    //            type:"POST",
    //            url:"?widget=monthDis_payroll",
    //            data:{
    //                action:"getpayrollid",
    //                month : month,
    //                year : year
    //            },
    //            success:function(data){
    //                if(getcount == 12){
    //                }else{
    //                    var result = confirm('Are you sure you want to finalize for this month?');
    //                    if(result){
    //                        window.location='?widget=finalise_payroll&payroll_id='+data+'&month='+month+'&year='+year;
    //                    }
    //                }
    //            }
    //        });
    //    }
</script>

<style type="text/css">
    #popup_box { 
        display: none;
        position:fixed;  
        _position:absolute; /* hack for internet explorer 6 */  
        height:150px;  
        width:350px;  
        background:#FFFFFF;  
        left: 500px;
        top: 200px;
        z-index:100; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */
        margin-left: 15px;  	
        /* additional features, can be omitted */
        /*        border:2px solid #ff0000;  */
        border:10px solid #C4C4C7;
        padding:15px;  
        font-size:15px;  
        -moz-box-shadow: 0 0 5px #EAEAEB;
        -webkit-box-shadow: 0 0 5px #EAEAEB;
        box-shadow: 0 0 5px #EAEAEB;
        overflow: auto;
    }

    #popupBoxClose { 
        line-height:15px;  
        right:5px;  
        top:5px;  
        position:absolute;  
        color:#6fa5e2;  
        font-weight:500;  	
    }
</style>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>