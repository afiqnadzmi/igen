<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Payroll Slip(s)</title>
    </head>
    <body style="font-family: 'century gothic';">
        <?php
		$str=explode(",",$_GET['month']);
		foreach($str as $val){
		
        //error_reporting(E_ALL);
        include_once "app/test_jason.php";
        include_once "app/test.php";
        include_once "app/loh.php";

        $selection = isset($_GET['selection']) ? $_GET['selection'] : "";
        $status ="Active";
		$status1 ="Inactive";
       $selection=2;
        $depid = isset($_GET['dep_id']) ? $_GET['dep_id'] : "";
        $branch_id = isset($_GET['branch_id']) ? $_GET['branch_id'] : "";
        $emp_id = isset($_GET['emp_id']) ? $_GET['emp_id'] : "";
        $month = isset($_GET['month']) ? $_GET['month'] : "";
        $year = isset($_GET['year']) ? $_GET['year'] : "";
                $month = $val;
        $queryCheck = mysql_query("SELECT id, is_close from payroll_finalised where finalise_month='" . $month . "' and finalise_year='" . $year . "' limit 1");
        $rowCheck = mysql_fetch_array($queryCheck);
        $finalised_id = $rowCheck["id"]; 
		$is_close=$rowCheck["is_close"];
     
        $queryCheckReport = mysql_query('SELECT emp_id FROM payroll_report WHERE payroll_finalised_id="'.$finalised_id.'" AND emp_id="'.$emp_id.'"');
        while ($rowCheckReport = mysql_fetch_array($queryCheckReport)) { 
            $getEmp = $getEmp . $rowCheckReport["emp_id"] . ',';
        }
        $getEmp = substr($getEmp, 0, -1);
        /*
        if ($status == "") {
            $sqlAdd = '';
        } elseif ($status == "Active") {
            $sqlAdd = ' AND e.emp_status = "Active"';
        } elseif ($status1 == "Inactive") {
            $sqlAdd = ' AND e.emp_status = "Inactive"';
        }
          */
		  if($branch_id!=null || $depid!=null){ 
        if ($selection == "2") {
            if ($depid == 0) {
                $sql = 'SELECT e.* FROM employee AS e INNER JOIN department AS d ON d.id=e.dep_id WHERE d.is_active=1 AND e.branch_id="' . $branch_id ;
            } else {
                $sql = 'SELECT e.* FROM employee AS e INNER JOIN department AS d ON d.id=e.dep_id WHERE d.is_active=1 AND e.dep_id="' . $depid . '"';
            }
            $sql .= ' AND e.id IN (' . $getEmp . ')';
        }
		}else{
		 $sql = 'SELECT e.* FROM employee AS e INNER JOIN department AS d ON d.id=e.dep_id WHERE d.is_active=1';
            $sql .= ' AND e.id IN (' . $getEmp . ')';
		
		}

        $rs = mysql_query($sql);
		$row = mysql_fetch_array($rs);
        //while ($row = mysql_fetch_array($rs)) {
            $i = 1;
            $start_date = 1;
            $full_month = date('F', mktime(0, 0, 0, $month, $i, $year));
            $total_working_day = 30;

            $emp_id = $_GET['emp_id'];

            $employer_total_epf = employer_total_epf($emp_id, $year, $month);
            $employer_total_socso = employer_total_socso($emp_id, $year, $month);
            $employee_total_epf = employee_total_epf($emp_id, $year, $month);
            $employee_total_socso = employee_total_socso($emp_id, $year, $month);

            $p_sql = "select * from payroll_report where payroll_finalised_id='" . $finalised_id . "' and emp_id='" . $emp_id . "' limit 1";
            $p_rs = mysql_query($p_sql);
			$p_num = mysql_num_rows($p_rs);
            $p_row = mysql_fetch_array($p_rs);
   
            if ($is_close == "1" || $p_num > 0) {
					$finalised = true;
			}else{
					$finalised = false;
			}

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
            $comission = $p_row['comission'];
            $get_bonus = $p_row['bonus'];
            $get_loan = $p_row['loan'];
            $get_late_leave = $p_row['late_early_leave'];

            $get_epf = $p_row['epf'];
            $get_socso = $p_row['socso'];
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

            $get_employer_epf = $p_row['employer_epf'];
            $get_employer_socso = $p_row['employer_socso'];

            $queryCompany = mysql_query('SELECT c.name,c.logo_img, b.address1, b.address2, b.postal_code, b.state, b.country FROM company AS c 
                                       INNER JOIN branch AS b
                                       ON c.id = b.company_id
                                       JOIN employee AS e
                                       ON e.branch_id = b.id  WHERE e.id="'.$emp_id.'"' );
            $rowCompany = mysql_fetch_array($queryCompany);
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

            //Calculating Leave Balance
			$ann_type="";
			$annu_balance="";
			$mc_type="";
			$mc_balance="";
			$curr= date('Y');
			$lat_year=date('Y', strtotime('-1 year'));
			$emp_id1=$emp_id;
			$sql1 = "select join_date,group_for_leave_id from employee where id=".$emp_id1;
			$rs1 = mysql_query($sql1);
			$row1 = mysql_fetch_array($rs1);
			$join_date = $row1["join_date"];
			$group_for_leave_id = $row1["group_for_leave_id"];
			$y=date('Y', strtotime($join_date ));
			if($y==$curr){
				$m=date('m', strtotime($join_date));
				if($m!=01){
				  $m=$m-1;						
				}else{
				  $m=0;
				}
			}

			if($y ==$lat_year){
				$m_last=date('m', strtotime($join_date));
				if($m_last!=01){
					$m_last=$m_last-1;
				}
			}

			//search employee got what kind of leave
			$sql = "SELECT distinct(lt.id), lt.type_name FROM employee e
					left join leave_group lg on lg.group_for_leave_id=e.group_for_leave_id
				left join leave_type lt on lg.leave_type_id=lt.id
				where e.id=" . $emp_id1;
			$rs = mysql_query($sql);

			$work_year = floor((time(date("Y-m-d")) - strtotime($join_date)) / (365 * 24 * 60 * 60));

				   while ($row = mysql_fetch_array($rs)) {
							$year = date('Y');
							$sql2 = "SELECT sum(num_days) as c FROM employee_leave e where request_status='Approved' 
									and year(leave_date)=" . $year . " and leave_type_id='" . $row["id"] . "' and emp_id='" . $emp_id1 . "'";
							$rs2 = mysql_query($sql2);
							if ($rs2 && mysql_num_rows($rs2) > 0) {
								$row2 = mysql_fetch_array($rs2);
								if (!is_null($row2['c'])) {
									$sum_leave = $row2['c'];
								} else {
									$sum_leave = 0;
								}
							} else {
								$sum_leave = 0;
							}
						
						
					   $sum_leave=$sum_leave + $m;
					   
					

							$sql3 = "SELECT days FROM leave_group l
									where from_year<=" . $work_year . " and to_year>=" . $work_year . "
						and leave_type_id='" . $row["id"] . "'
						and group_for_leave_id=" . $group_for_leave_id;
							$rs3 = mysql_query($sql3);

							if ($rs3 && mysql_num_rows($rs3) > 0) {
								$row3 = mysql_fetch_array($rs3);
								$days = $row3['days'];
						//Getting employee last year balance	
							$sql2="SELECT COALESCE(sum(num_days),0) as smd FROM employee_leave e 
							where emp_id='" . $emp_id1 . "' and leave_type_id='" . $row["id"] . "' and request_status='Approved' AND Year(leave_date)='" . $lat_year . "';";
							$rs2 = mysql_query($sql2);
						   $row2 = mysql_fetch_array($rs2);
					//Getting Balance for the year before last year
						   $sql_ba="SELECT * FROM leave_balance where emp_id='" . $emp_id1 . "' AND Date='" . $lat_year . "';";
							$rs_ba = mysql_query($sql_ba);
						   $row_ba = mysql_fetch_array($rs_ba);
						   if($row2["smd"]!="0.00"){
							$balance = $row2["smd"] + $m_last;
						}else{
						
						 $balance = $row2["smd"] + $m_last;
						}
						
						if($row["type_name"]=="Annual Leave"){
							if($balance>=$row_ba['leave_balance']){
							
							$balance=$balance - $row_ba['leave_balance'];
							
							}
						}

						if($balance!="0.00"){
							$balance=$days - $balance;
						 }else{
							if($y!=$curr){
							$balance=$days;
						}	
					}
						
								
								
			 // Getting the total of all previous balance 

			$sql5="SELECT COALESCE(sum(leave_balance),0) as balance FROM leave_balance
						where emp_id='" . $emp_id1 . "' AND Date='".$curr."'";
			$rs5 = mysql_query($sql5);
			$row5 = mysql_fetch_array($rs5);
			$last_balance = $row5["balance"];

								 $last_balance=    $days  - $last_balance;
								if($row["type_name"]=="Annual Leave"){

								$days1=$days;
								
								}else{
								$days1=$days;
								}
								$balance=$days1 - $sum_leave;
							} else {
								$days = 0;
							}
							if($days==0){
							$balance=0;
							}
					/*if($row["type_name"]=="Annual Leave"){		
						echo $days1."-".$balance;
					}*/
							
					
						if($last_balance!=="0.00" && $row["type_name"]=="Annual Leave"){
						$last_balance=$last_balance;
						
						}else{
						$last_balance="";
						}
						
			   
					$sum_leave=$sum_leave-$m; 
			
				 if($row["type_name"]=="Annual Leave"){
					       $ann_type= $row["type_name"];
						   $ann_balance=$balance;
						   $ann_utilized=$sum_leave;
						   
							
				 }
				  if($row["type_name"]=="MC"){
					   $mc_type= $row["type_name"];
					   $mc_balance=$balance;
					   $mc_utilized=$sum_leave;
				  }
				}
			
				// <td>' . $last_balance . '</td>
			   ?>
			
            <div style="border: 1px solid black; width:850px;">
			<img src="<?php echo $rowCompany["logo_img"] ; ?>" width="100px" style="padding-left: 350px;" >
                <table style="width: 100%;">
                    <tr><td style="text-align: center;font-weight: bold; font-size: 30px; padding-top: 0px;"><?php echo $rowCompany["name"]; ?></td></tr>
                    <tr>
				
                        <td style="text-align: center; padding-bottom: 30px;">
						
                            <?php echo $rowCompany["address1"] . '&nbsp;' . $rowCompany["address2"] . '<br/>' . $rowCompany["postal_code"] .'<br/>' . $rowCompany["country"]; ?>
                        </td>
                    </tr>
                    <tr><td style="text-align: center; border-bottom: 1px solid black; border-top: 1px solid black; font-size: 18px; padding: 15px;; font-weight: bold">
					Employee Payslip &nbsp&nbsp 
					 <input type="hidden" id="emp" value="<?php echo $emp_id ;?>">
					 <input type="hidden" id="mon" value="<?php echo $month; ?>">
					 <input type="hidden" id="yr" value="<?php echo $year ;?>">
					 <input type="hidden" id="epf" value="<?php echo $get_epf ;?>">
					 <input type="hidden" id="nt" value="<?php echo $net_pay ;?>">
					 <?php if($get_epf!="0.00"){ ?>
					<!-- <input type="button" id="btn" value="Exclude EPF" onclick="excludeepf()">
					 <input type="button" id="hd" value="Hide" onclick="hd()">
					 -->
					 <?php 
					 
					 }
					 ?>
					</td>
					
 
					</tr>
                    <tr>
                        <td>
                            <div style="margin-left: 30px; padding: 10px 0px;">
                                <table style="border-spacing: 20px; font-weight: bold; font-size: 14px;">
                                    <tr>
                                        <td style="width: 200px;">Employee Name</td>
                                        <td style="width: 300px; padding-left: 10px;"><?php echo $get_name ?></td>
                                    </tr>
                                    <tr>
                                        <td>Position</td>
                                        <td style="padding-left: 10px;"><?php echo $get_designation; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Month & Year</td>
                                        <td style="padding-left: 10px;"><?php echo $full_month . ' ' . $year; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="border-style: solid; border-width: 1px; width: 800px; padding: 20px 0px 30px 0px; margin-left: 20px;">
                                <table border="0" style="border-spacing: 10px; font-size: 14px;">
                                    <tr style="display: none;">
                                        <td style="width: 200px; padding-left: 20px;">Date From</td>
                                        <td colspan="2" style="padding-right: 50px"><?php echo $complete_start_date ?></td>
                                    </tr>
                                    <tr style="display: none;">
                                        <td style=" width: 200px; padding-left: 20px;">Date To</td>
                                        <td colspan="2" style="padding-right: 50px"><?php echo $complete_end_date ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 195px; padding-left: 20px;">Basic Salary </td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style="padding-right: 50px"><?php echo number_format($get_basic, 2) ?></td>    
										<td>Bonus Amount </td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style="padding-right: 50px"><?php echo number_format($get_bonus, 2) ?></td>
										</tr>
						
                                        <!--<td style=" width: 195px">Days Hours </td>
                                        <td style="padding-right: 20px">(Hour)</td>
                                        <td style=""><?php echo $total_working_hours ?></td>-->
                               
                                    <tr>
                                        <td style="padding-left: 20px;">Allowance </td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style="padding-right: 50px"><?php echo number_format($total_allowance, 2) ?></td>
										<td>Loan Deduction </td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style=""><?php echo number_format($get_loan, 2) ?></td>
                                       <!--<td>Unpaid Leave</td>
                                        <td style="padding-right: 20px">(Day)</td>
                                        <td style=""><?php echo $get_unpaid_leave_time / 8  ?></td>-->
                                    </tr>
		
									<tr>
                                        <td style="padding-left: 20px;">Commission </td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style="padding-right: 50px"><?php echo number_format($comission, 2) ?></td>
										<td>OT Amount </td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style="padding-right: 50px"><?php echo number_format($get_overtime, 2) ?></td>
										
                                         <!--<td style="padding-right: 20px;">Paid Leave</td>
                                        <td style="padding-right: 20px">(Dat)</td>
                                        <td style="padding-right: 50px"><?php echo $get_paid_leave; ?></td>-->
                                    </tr>
                                   <!-- <tr>
                                        <!--<td style="padding-left: 20px;">OT Total Duration </td>
                                        <td style="padding-right: 20px">(Hour)</td>
                                        <td style="padding-right: 50px"><?php echo number_format($ot_dur, 1) ?></td
                                         <td style="padding-left: 20px;">OT Amount </td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style="padding-right: 50px"><?php echo number_format($get_overtime, 2) ?></td>
                                         <td style="padding-left: 0px;">Claim Amount</td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style="padding-right: 50px"><?php echo number_format($get_claim, 2) ?></td>
                                    </tr>-->
                                   
				<?php
					if (isset($_GET['emp_id']) == TRUE) {
						//Claims
						$i=1;
						$style="padding-left: 20px";
						if ($num_row > 0) {
				            /* if($num_row>1){
								echo "  <tr><td colspan='6' style='border-bottom: 1px solid lightgray;'>Claims</td></tr>";
							 }*/
						  echo'<tr>';
							while ($row = mysql_fetch_array($rs_claim)) {
								if($i / 2 == 1){
								  $style="";
								}
							?>	
							
									<td style="<?php echo $style; ?>" ><?php echo ucfirst($row['claim_type']);  ?></td>
									<td style="padding-right: 20px">(RM)</td>
									<td style="padding-right: 50px" ><?php echo number_format($row['claim_amount'], 2) ?></td>                 
									
				<?php
					   $i++;
							}
						 echo"</tr>";
						
						}
						?>
						
                   
				   <?php     
						// Deduction
						$style_d="padding-left: 20px";
						$d=1;
						if ($num_row_deduction > 0) {
							
							echo"<tr>";
							while ($row_deduction = mysql_fetch_array($rs_deduction)) {
								if($d / 2 == 1){
								  $style="";
								}
							?>	
							
									<td style="<?php echo $style_d;?>" ><?php echo ucfirst($row_deduction['deduction_title']);  ?></td>
									<td>(RM)</td>
									<td style="padding-top:10px;" ><?php echo number_format($row_deduction['deduction_amount'], 2) ?></td> </tr>                 
									
				<?php
							$d++;
							}
					echo"</tr>";
					}				   
				   
					}
					?>
					
		
					     <tr>
                                        <?php if ($get_advance_salary > 0) { ?>
                                        
                                         
                                            <td>Advance Salary </td>
                                            <td style="padding-right: 20px">(RM)</td>
                                            <td style=""><?php echo number_format($get_advance_salary, 2) ?></td>   
                                        
                                    <?php } ?>
                                    </tr>
                                  
                                   

                                    <tr><td colspan="6" style="border-bottom: 1px solid lightgray;">&nbsp;</td></tr>

                                    <tr>
                                        <td style="padding-left: 20px;">EPF Deduction</td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style="padding-right: 50px"><?php echo number_format($get_epf, 2) ?></td>
                                        <td>Employer EPF </td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style=""><?php echo number_format($get_employer_epf, 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 20px;">Socso Deduction</td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style="padding-right: 50px"><?php echo number_format($get_socso, 2) ?></td>
                                        <td>Employer Socso</td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style=""><?php echo number_format($get_employer_socso, 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 20px;">Income Tax Amount </td>
                                        <td>(RM)</td>
                                        <td style="padding-right: 50px"><?php echo number_format($get_pcb, 2) ?></td>
                                    </tr>

                                    <tr><td colspan="6" style="border-bottom: 1px solid lightgray;">&nbsp;</td></tr>

                                    <tr>
                                        <td style="padding-left: 20px;">Total EPF</td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style="padding-right: 50px"><?php echo number_format($employee_total_epf, 2) ?></td>
                                        <td>Total Employer EPF</td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style=""><?php echo number_format($employer_total_epf, 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left: 20px;">Total Socso</td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style="padding-right: 50px"><?php echo number_format($employee_total_socso, 2) ?></td>
                                        <td>Total Employer Socso</td>
                                        <td style="padding-right: 20px">(RM)</td>
                                        <td style=""><?php echo number_format($employer_total_socso, 2) ?></td>
                                    </tr>

                                    <tr><td colspan="6" style="border-bottom: 1px solid lightgray;">&nbsp;</td></tr>
	
                                    <tr>
                                        <td style="padding-left: 20px;"> ANNL Leave Taken &nbsp;&nbsp; : <?php echo $ann_utilized; ?> </td>
										 <td style="padding-right: 20px">Balance  : &nbsp;&nbsp<?php echo $ann_balance; ?> </td>
                                        <td style="padding-right: 20px;"></td>
                                        <td style="font-weight: bold;">Net Paid Out Amount</td>
                                        <td style="padding-right: 20px;font-weight: bold;">(RM)</td>
                                        <td style="text-decoration: underline;font-weight: bold;"><?php echo number_format($net_pay, 2) ?></td>            
                                    </tr> 
									 <tr>
                                        <td style="padding-left: 20px;"> Sick Leave Taken &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $mc_utilized; ?> </td>
										 <td style="padding-right: 20px">Balance  : &nbsp;&nbsp<?php echo $mc_balance; ?> </td>
                                        <td style="padding-right: 20px;"></td>
                                        <td style="font-weight: bold;"></td>
                                        <td style="padding-right: 20px;font-weight: bold;"></td>
                                        <td style="text-decoration: underline;font-weight: bold;"></td>            
                                    </tr> 
									
								

                                </table>
                            </div>    
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid black;">
                            <div style="margin-left: 30px; padding: 20px 0px;">
                                <table style="border-spacing: 10px; font-size: 14px;">
								
                                    
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 10px; padding-top: 10px;">
                            <div style="margin-left: 30px;">
                                <table style="border-spacing: 10px; font-size: 14px;">
                                    <tr>
                                        <td style="width: 200px; vertical-align: bottom;">Company Stamp</td>
                                        <td style="width: 300px; border-bottom: 1px solid black; padding-left: 10px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: bottom;">Director Signature</td>
                                        <td style="border-bottom: 1px solid black; padding-left: 10px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table> 
				
            </div><br>
            <div style="page-break-after:always"></div>
            <?php
        //}
		}
        ?>
    </body>
</html>
<script type="text/javascript">
$("document").ready(function(){
$("#btn").show(100);
$("#hd").show(100);

})


function hd(){
$("#btn").hide(100);
$("#hd").hide(100);
}
function excludeepf(){
        var emp_id=$("#emp").val();
		var month=$("#mon").val();
		var year=$("#yr").val();
		var epf=$("#epf").val();
        var nt=$("#nt").val();		
		var result = confirm('Are you sure you want to perform this action?');
		if(result){
        $.ajax({
            type:'POST',
            url:"?widget=excludeepf",
            data:{
               emp_id:emp_id,
			   month:month,
			   year:year,
			   nt:nt,
			   epf:epf
            },
            success:function(data){
			
               if(data="true"){
			   alert("EPF excluded")
			   window.location.reload(true);
			   }else{
			   alert("Erro: While processing");
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
