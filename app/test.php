<?php

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

//test.php, test_json.php, loh.php are using by following files:
//widget: append_others_emp.php, dep_sim.php, printpayroll.php, finalise_payroll.php, finalise_payroll_confirm.php
//app: calculate_payroll.php, payroll.php
//test for allowance
// $allw=allowance("1","N");
// echo $allw;

/*
  test for unpaid leave
  $ul=unpaid_leave(1,4,date("Y"),10);
  echo $ul;
 */

/*
  bonus(1,'2012-4-1');
 */

/*
  loan(1);
 */

//echo late_leave(1,3,10);
/**/
/* echo pcb(1,3000); */

//echo days_in_month(1,2,1996);
include_once 'app/test_jason.php';
include_once 'app/loh.php';

function get_resign_date($emp_id, $month, $year) {
    $sql = "SELECT resign_date FROM employee e where id='" . $emp_id
            . "' and month(resign_date)=" . $month . " and year(resign_date)=" . $year;
    $rs = mysql_query($sql);
    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
        return $row['resign_date'];
    } else {
        return false;
    }
}

function chk_age_more_55($emp_id) {
    //if more than 55, return true
    $sql = 'select dob from employee where id=' . $emp_id . ' limit 1';
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
    $dateOfBirth = date("Y-m-d", strtotime($row['dob']));
    $yearOfDay = date("Y");

    $yearOfBirth = substr($dateOfBirth, 0, 4);
	
    $age = $yearOfDay - $yearOfBirth;
    $year_diff = abs($age);
	
    if ($year_diff > 55) {
        return true;
    } else {
        return false;
    }
}

function chk_position_late($emp_id, $type) {
    if ($type == "attendance") {
        $field = 'time_att'; //0 =count or 1= dont count
    } else {
        $field = 'late_early'; //0 =dont count or 1= all or 2= exclude lunch
    }
    $sql = 'SELECT ' . $field . ' FROM employee e left join `position` p on e.position_id=p.id where e.id=' . $emp_id;
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
    return $row[$field];
}

function employer_total_epf($emp_id, $year, $month) {
    $sql = "SELECT sum(employer_epf) as s
				FROM payroll_report p
				where emp_id=" . $emp_id . " and year(from_date)=" . $year . " and month(from_date)<=" . $month;
    $rs = mysql_query($sql);
    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
        $total = $row['s'];
		
    } else {
        $total = 0;
		
    }
    return $total;
}

function employer_total_socso($emp_id, $year, $month) {

    $sql = "SELECT sum(employer_socso) as s
				FROM payroll_report p
				where emp_id=" . $emp_id . " and year(from_date)=" . $year . " and month(from_date)<=" . $month;
    //echo $sql;
    $rs = mysql_query($sql);
    if ($rs && mysql_num_rows($rs) > 0) {

        $row = mysql_fetch_array($rs);
        $total = $row['s'];
    } else {
        $total = 0;
    }
    return $total;
}

function employee_total_epf($emp_id, $year, $month) {
    $sql = "SELECT sum(epf) as s
				FROM payroll_report p
				where emp_id=" . $emp_id . " and year(from_date)=" . $year . " and month(from_date)<=" . $month;
    $rs = mysql_query($sql);
    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
        $total = $row['s'];
    } else {
        $total = 0;
    }
    return $total;
}

function employee_total_socso($emp_id, $year, $month) {
    $sql = "SELECT sum(socso) as s
				FROM payroll_report p
				where emp_id=" . $emp_id . " and year(from_date)=" . $year . " and month(from_date)<=" . $month;
    $rs = mysql_query($sql);
    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
        $total = $row['s'];
    } else {
        $total = 0;
    }
    return $total;
}

function employee_total_eis($emp_id, $year, $month) {
    $sql = "SELECT sum(employee_eis) as s
				FROM payroll_report p
				where emp_id=" . $emp_id . " and year(from_date)=" . $year . " and month(from_date)<=" . $month;
    $rs = mysql_query($sql);
    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
        $total = $row['s'];
    } else {
        $total = 0;
    }
    return $total;
}

function employer_total_eis($emp_id, $year, $month) {
    $sql = "SELECT sum(employer_eis) as s
				FROM payroll_report p
				where emp_id=" . $emp_id . " and year(from_date)=" . $year . " and month(from_date)<=" . $month;
    $rs = mysql_query($sql);
    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
        $total = $row['s'];
    } else {
        $total = 0;
    }
    return $total;
}


function days_in_month($emp_id, $month, $year, $resigner_day='') {
    $type = 'partial_month'; //partial_month //full_month
	
    if ($resigner_day == '') {
        $total_date = date("t", mktime(0, 0, 0, $month, 1, $year));
    } else {
        $total_date = $resigner_day;
    }
   
    $num_days = 0;
    if ($type != 'full_month') {
        for ($i = 1; $i <= $total_date; $i++) {
            $day = date("N", mktime(0, 0, 0, $month, $i, $year));
            $sql = 'SELECT ett.id
						FROM employee e join emp_time_table ett
						on e.shift_id=ett.shift_id
						where is_work_day="Y" and e.id=' . $emp_id . ' and ett.`day`=' . $day;
            $rs = mysql_query($sql);
            $c = mysql_num_rows($rs);
            if ($c == 2) {
                $num_days+=1; //full day
            } elseif ($c == 1) {
                $num_days+=0.5; //half day
		
            }
        }
    } else {
        $num_days = $total_date;
    }
    return $num_days;
}

// Allowance
function allowance($emp_id, $month, $year, $got_criteria="") {//call by 4 type only: (eid,'epf'),(eid,'socso'),(eid,'pcb'),(eid)

    if ($got_criteria == 'epf') {
        $criteria = ' and epf="Y"';
    } elseif ($got_criteria == 'socso') {
        $criteria = ' and socso="Y"';
    } elseif ($got_criteria == 'pcb') { 
        $criteria = ' and pcb="Y"';
    } else {
        $criteria = '';
    }
	// Fixed Allowance
    $sql = "SELECT * FROM employee_allowance ea
				left join allowance a
				on ea.allowance_id=a.id
				where ea.emp_id=" . $emp_id; //. $criteria;
    $rs = mysql_query($sql);
    $sum = 0;
    while ($row = mysql_fetch_array($rs)) {
        $sum+=$row["allowance_amount"];
    }
	
	// Evolved Allowance
	$evolved_sum=0;
    $sql_ev = "SELECT * FROM employee_evallowance where emp_id='" . $emp_id ."' AND  month='" . $month ."' AND  year='" . $year ."'" ;
    $rs_ev = mysql_query($sql_ev);
    while ($row_ev = mysql_fetch_array($rs_ev)) {
        $evolved_sum+=$row_ev["allowance_amount"];
    }
    return $sum + $evolved_sum;
}

// Deduction
function deduction($emp_id, $month, $year) {

	// Fixed Deduction
    $sql = "SELECT * FROM employee_deduction
				where emp_id='" . $emp_id ."' AND  type='1'" ;
    $rs = mysql_query($sql);
    $sum = 0;
    while ($row = mysql_fetch_array($rs)) {
        $sum+=$row["deduction_amount"];
    }
	
	// Evolved Deduction
	$evolved_sum=0;
    $sql_ev = "SELECT * FROM employee_deduction where emp_id='" . $emp_id ."' AND  type='2' AND  month='" . $month ."' AND  year='" . $year ."'" ;
    $rs_ev = mysql_query($sql_ev);
    while ($row_ev = mysql_fetch_array($rs_ev)) {
        $evolved_sum+=$row_ev["deduction_amount"];
    }
    return $sum + $evolved_sum;
}

function comission($emp_id, $month) {//call by 4 type only: (eid,'epf'),(eid,'socso'),(eid,'pcb'),(eid)

    $sql = "SELECT * FROM comission WHERE emp_id='" . $emp_id ."'AND Month='".$month."'";
    $rs = mysql_query($sql);
    $sum = 0;
    while ($row = mysql_fetch_array($rs)) {
        $sum+=$row["amount"];
    }
    return $sum;
}

/* function all_allowance($emp_id){
  $sql="SELECT * FROM employee_allowance ea
  left join allowance a
  on ea.allowance_id=a.id
  where ea.emp_id=".$emp_id;
  $rs=mysql_query($sql);
  $sum=0;
  while($row=mysql_fetch_array($rs)){
  $sum+=$row["allowance_amount"];
  }
  return $sum;
  } */

function paid_leave($user_id, $month, $year) {
    $sql = "SELECT sum(num_days) as sum_days
				FROM employee_leave e
				where emp_id='" . $user_id . "' and leave_type_id!='2' and year(from_date) = " . $year . "
				AND month(from_date) =" . $month . " AND request_status = 'Approved'";
    $rs = mysql_query($sql);
    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
        return (float) $row["sum_days"];
    } else {
        return 0;
    }
}

//need improvement : dont hardcode total hour to 8 hours
function unpaid_leave($user_id, $month, $year, $salary_per_hour, $total_working_hours) {
    //what will happen if cross month unpaid leave available?
    $total_hour_per_day = $total_working_hours;
    //$sql="SELECT sum(num_days) as sum_days FROM employee_leave e where emp_id='".$user_id."' and leave_type_id='2'";
    $sql = "SELECT sum(num_days) as sum_days
				FROM employee_leave e
				where emp_id='" . $user_id . "' and leave_type_id='2' and year(from_date) = " . $year . "
				AND month(from_date) =" . $month . " AND request_status = 'Approved'";
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
    return (float) $row["sum_days"] * $salary_per_hour * $total_hour_per_day;

    //get all dates within that month
    /*
      $total_date=date("t",mktime(0, 0, 0, $month, 1, $year));
      for($i=1;$i<=$total_date;$i++){
      $day_timestamp=mktime(0, 0, 0, $month, $i, $year);
      $day=date("N",$day_timestamp);
      echo $day."<br />";
      }
     */
    /*
      $sql="SELECT `join_date`,group_for_leave_id FROM employee where id='".$user_id."' limit 1";
      $rs=mysql_query($sql);
      $row=mysql_fetch_array($rs);

      $diff = abs(time() - strtotime($row["join_date"]));
      $years = floor($diff / (365*60*60*24));

      $sql1="SELECT * FROM leave_group l where group_for_leave_id='".$row["group_for_leave_id"]."' and leave_type_id='2' limit 1";
      $rs1=mysql_query($sql1);
      $row1=mysql_fetch_array($rs1);
      if($years<2){
      echo $row1["y0_y2"];
      }elseif($years>=2&&$years<5){
      echo $row1["y3_y5"];
      }elseif($years>=5){
      echo $row1["y5_above"];
      }
     */
}

//ok
function bonus($emp_id, $current_date) {
    $sql = "SELECT sum(salary*bonus_rate) as all_bonus FROM employee e left join bonus b on e.position_id=b.position_id 
				where e.id=" . $emp_id . " and b.emp_id=" . $emp_id . " and Extract(month from issue_date) = DATE_FORMAT('" . $current_date . "', '%c') 
				and Extract(year from issue_date) = DATE_FORMAT('" . $current_date . "', '%Y') 
				limit 1";
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
    if ($row["all_bonus"])
        return $row["all_bonus"];
    else
        return 0;
}

//ok
function loan($emp_id) {
    $sum_installment = 0;
    $sql = "SELECT id,loan_amount,installment, rep_month FROM employee_loan WHERE loan_status='Approved' 
            AND paid_status='active' AND emp_id='" . $emp_id . "'";
    $rs = mysql_query($sql);
    while ($row = mysql_fetch_array($rs)) {
        $sql1 = "SELECT id FROM paid_loan where emp_loan_id='" . $row["id"] . "'";
        $rs1 = mysql_query($sql1);
        $countMonth = mysql_num_rows($rs1);

        $row1 = mysql_fetch_array($rs1);
        if ($countMonth < $row["rep_month"]) {
            $sum_installment+=$row["installment"];
        } else {
            $sql2 = "update employee_loan set paid_status='done' where id=" . $row["id"];
            $rs2 = mysql_query($sql2);
        }
    }
    return $sum_installment;
}

//ok
function late_leave($emp_id, $month, $year, $salary_per_hour) {
    $chk = chk_position_late($emp_id, 'late_early');
    if ($chk == '1') {
        $t = late_leave_time1($emp_id, $month, $year);
    } elseif ($chk == '2') {
        $t = late_leave_time2($emp_id, $month, $year);
    } else {
        $t = 0;
    }
    //$t=late_leave_time($emp_id,$month,$year);
    return $t * $salary_per_hour;
}

//OK
function pcb($emp_id, $gross_pay, $deduct_epf) {
   /*
   $default_deduct_epf = 500;
	
    //$deduct_epf=epf($emp_id,$gross_pay);
    if ($deduct_epf > $default_deduct_epf) {
        $deduct_epf = $default_deduct_epf;
    }
	*/
	$deduct_epf=round($deduct_epf, 0, PHP_ROUND_HALF_UP);
    $gross_pay = $gross_pay - $deduct_epf;
  
    $marital_sql = "SELECT marital,num_of_kids,spouse_work FROM employee e where e.pcp='Y' AND e.id=" . $emp_id;
    $m_rs = mysql_query($marital_sql);
    $m_row = mysql_fetch_array($m_rs);
	$num_row=mysql_num_rows($m_rs);
if($num_row>0){
 
    $marrital_status = $m_row["marital"];
    $num_of_kids = $m_row["num_of_kids"];
    $spouse_work = $m_row["spouse_work"];

    $field_name = "";
    $where_clause = "";
	
    if (strtolower($marrital_status) == "m") {

	
        if (strtolower($spouse_work) == "y") {

            //married_combine
            //$field_name=num_kids("married_combine",$num_of_kids)
            if ($num_of_kids > 0) {
                //child at least more than 1
                if ($num_of_kids > 20) {
                    //in table, field is_more_10 must be : y
                    $field_name = "married_combine" . ((int) $num_of_kids % 20);
                    $where_clause = "is_more_20='y' and ";
                } else {
                    //in table, field is_more_10 must be : n
                    $field_name = "married_combine" . $num_of_kids;
                    $where_clause = "is_more_20='n' and ";
                }
            } else {
                $field_name = "married_combine";
            }
        } else {

	
            //married_separate
            //$field_name=num_kids("married_separate",$num_of_kids)
			
		
            if ($num_of_kids > 0) {
	
                //child at least more than 1
                if ($num_of_kids > 20) {

                    //in table, field is_more_10 must be : y
                    $field_name = "married_separate" . ((int) $num_of_kids % 20);
                    $where_clause = "is_more_20='y' and ";
                } else {
  
                    //in table, field is_more_10 must be : n
                    $field_name = "married_separate" . $num_of_kids;
                    $where_clause = "is_more_20='n' and ";
                    
                }
            } else {
                $field_name = "married_separate";
	
            }
        }
    } elseif (strtolower($marrital_status) == "d") {
	
        //divorced use married_combine
        //$field_name=num_kids("married_combine",$num_of_kids)
        if ($num_of_kids > 0) {
            //child at least more than 1
            if ($num_of_kids > 20) {
                //in table, field is_more_10 must be : y
                $field_name = "married_combine" . ((int) $num_of_kids % 10);
                $where_clause = "is_more_20='y' and ";
            } else { 
                //in table, field is_more_10 must be : n
                $field_name = "married_combine" . $num_of_kids;
                $where_clause = "is_more_20='n' and ";
            }
        } else {
            $field_name = "married_combine";
        }
    } else {
	
        // not married
        $field_name = "single";
	
    }
	
	 $gross_pay=round($gross_pay, 0, PHP_ROUND_HALF_UP);

    $sql = "SELECT " . $field_name . " FROM employee_pcb e where 1 and " . $where_clause . " 1 and fr_amt<=" . $gross_pay . " and to_amt>=" . $gross_pay;
    $rs = mysql_query($sql);
    if ($rs) {
	
        $row = mysql_fetch_array($rs);
	
        if ($row[$field_name] > 0) {
	
            return $row[$field_name];
        } else {
            return 0;
        }
    } else {
        return 0;
    }
	}else{
	return 0;
	}
}

//OK
//error_reporting(E_ALL);
//echo 'absent='.days_absent(1,6,2012);
function days_absent($emp_id, $month, $year, $total_working_hours) {
	
    //echo 'days_absent='.$emp_id.",".$month.",".$year;
    if (chk_position_late($emp_id, 'attendance') == '1') {//0=count att; 1=dont count
        return 0;
    } else {
	
        //take full days in month to calculate
        $resign_date = get_resign_date($emp_id, $month, $year);
        if ($resign_date == false) {
            $total_day_month = date('t', mktime(0, 0, 0, $month, 1, $year));
        } else {
            $total_day_month = date('j', strtotime($resign_date));
        }
        $mod_month = str_pad($month, 2, '0', STR_PAD_LEFT);
        $sum_of_hours = 0;

        for ($i = 1; $i <= $total_day_month; $i++) {
            $day = date('N', mktime(0, 0, 0, $month, $i, $year));
            $w_sql = 'SELECT id
						FROM emp_time_table e
						where shift_id=(SELECT shift_id FROM employee e where id="' . $emp_id . '")
						and `day`="' . $day . '" and is_work_day="Y"'; //YY
            $w_rs = mysql_query($w_sql);
            if ($w_rs && mysql_num_rows($w_rs) > 0) {
	
                $date = str_pad($i, 2, '0', STR_PAD_LEFT);
                $sql = 'select * from attendance where emp_id = ' . $emp_id . ' and work_in_date = "' . $year . '-' . $mod_month . '-' . $date . '"';
                $rs = mysql_query($sql);
                $num_row = mysql_num_rows($rs);
                if ($num_row == 0) {
	
                    $absent_date = $year . '-' . $mod_month . '-' . $date;
	
                    if (!chk_training($emp_id, $absent_date)) {
                        $abs_date_re = public_holiday($absent_date, $emp_id);
	
                        //$abs_date_re is true if got public holiday
                        if ($abs_date_re == FALSE) {

                            $holi_rep_re = holiday_replacement($absent_date, $emp_id);
                            //$holi_rep_re is true if got holiday replacement
                            if ($holi_rep_re == false) {
		
                                $leave_check_re = chk_leave($absent_date, $emp_id);
                                //$leave_check_re is true if employee got apply leave
                                if ($leave_check_re == false) {
	
                                    $emp_tt_re = chk_emp_tt($emp_id, $absent_date);
                                    //$emp_tt_re is session number 1,2 if employee is working that day
                                    if ($emp_tt_re == 2) {

                                        $full_work_hrs = $total_working_hours;
                                        $sum_of_hours += $full_work_hrs;
					
                                    } else if ($emp_tt_re == 1) {
                                        $half_work_hrs = $total_working_hours / 2;
                                        $sum_of_hours += $half_work_hrs;
                                    }
                                    /* if($emp_tt_re == FALSE)
                                      {
                                      $emp_def_tt = chk_tt($absent_date);
                                      if($emp_def_tt == 2)
                                      {
                                      $full_work_hrs = 8;
                                      $sum_of_hours += $full_work_hrs;
                                      }
                                      }
                                      else
                                      {
                                      if($emp_tt_re == 2)
                                      {
                                      $full_work_hrs = 8;
                                      $sum_of_hours += $full_work_hrs;
                                      //echo '@8@ </br>';
                                      }
                                      else
                                      {
                                      $half_work_hrs = 4;
                                      $sum_of_hours += $half_work_hrs;
                                      //echo '#4# </br>';
                                      }
                                      } */
                                }
                            }
                        }
                    }
					
                }/*else if ($num_row == 1) {
                    $absent_date = $year . '-' . $mod_month . '-' . $date;
                    //echo $absent_date.'---- 1 (half)</br>';
                    $emp_tt_re = chk_emp_tt($emp_id, $absent_date);
                    if ($emp_tt_re == 2) {
                        if (!chk_training($emp_id, $absent_date)) {
                            $half_work_hrs = $total_working_hours / 2;
                            $sum_of_hours += $half_work_hrs;
                        }
                    }
                    /* if($emp_tt_re == 1)
                      {
                      $half_work_hrs = 4;
                      $sum_of_hours += $half_work_hrs;
                      }
                      else
                      {
                      $emp_def_tt = chk_tt($absent_date);
                      if($emp_def_tt == 2)
                      {
                      $half_work_hrs = 4;
                      $sum_of_hours += $half_work_hrs;
                      }
                      } 
                }*/
            }
        }
         return $sum_of_hours / $total_working_hours;
    }
}

//ok
function days_at_work($emp_id, $month, $year, $total_working_hours) {
    $all_days = day_have_work($emp_id, $month, $year);
    if (chk_position_late($emp_id, 'attendance') == '1') {//0=count att; 1=dont count
        //check employee join date
        $checkJoin = checkEmpJoinIn($emp_id, $month, $year);
        $emp_joindate = getEmpJoinDate($emp_id);

        $paid_leave = paid_leave($emp_id, $month, $year);
        $unpaid_leave = unpaid_leave_time($emp_id, $month, $year, $total_working_hours) / $total_working_hours;

        //if employee join in that particular month
        if ($checkJoin == "1") {
            $getDate = explode('-', $emp_joindate);
            $count = 0;
            for ($i = 1; $i < $getDate[2]; $i++) {
                $chk_date = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
                $chkDate = chk_emp_tt($emp_id, $chk_date);
                if ($chkDate != false) {
                    $count = $count + 1;
                }
            }
            $all_days = $all_days - $count;
        }
        return $all_days - $paid_leave - $unpaid_leave;
    } else {
        $abs_days = days_absent($emp_id, $month, $year, $total_working_hours);
        $paid_leave = paid_leave($emp_id, $month, $year);
        $unpaid_leave = unpaid_leave_time($emp_id, $month, $year, $total_working_hours) / $total_working_hours;
        return $all_days - $abs_days - $paid_leave - $unpaid_leave;
    }
}

function getEmpJoinDate($emp_id) {
    $query = mysql_query('SELECT join_date FROM employee WHERE id=' . $emp_id);
    $row = mysql_fetch_array($query);
    return $row["join_date"];
}

function checkEmpJoinIn($emp_id, $month, $year) {
    $query = mysql_query('SELECT MONTH(join_date) AS month, YEAR(join_date) AS year FROM employee WHERE id=' . $emp_id);
    $row = mysql_fetch_array($query);
    if ($month == $row["month"] && $year == $row["year"]) {
        return 1;
    } else {
        if ($year > $row["year"]) {
            return 2;
        } elseif ($year == $row["year"]) {
            if ($month > $row["month"]) {
                return 2;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
}

//ok
//echo "day have work=".day_have_work(1,5,2012);
function day_have_work($emp_id, $month, $year) {
    $total_date = date('t', mktime(0, 0, 0, $month, 1, $year));
    $num_day_got_work = 0;
    for ($i = 1; $i <= $total_date; $i++) {
        $day = date('N', mktime(0, 0, 0, $month, $i, $year));
        $sql = 'SELECT is_work_day
                FROM emp_time_table e
		where shift_id=(SELECT shift_id FROM employee e where id="' . $emp_id . '")
		and `day`="' . $day . '" and is_work_day="Y"';
        $rs = mysql_query($sql);
        if ($rs && mysql_num_rows($rs) > 0) {
            $num_day_got_work+=1;
        }
    }
    return $num_day_got_work;
}

//need to improve: dont hard code it to 8 hours
function unpaid_leave_time($user_id, $month, $year,  $total_working_hours) {
    $total_hour_per_day = $total_working_hours;
    $sql = "SELECT sum(num_days) as sum_days
				FROM employee_leave e
				where request_status='Approved' and emp_id='" . $user_id . "' and leave_type_id='2' 
				and year(from_date) = " . $year . " AND month(from_date) =" . $month;
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
    return (float) $row["sum_days"] * $total_hour_per_day;
}

//ok
function designation($user_id) {
    $sql = "SELECT position_name FROM employee e left join `position` p on e.position_id=p.id where e.id='" . $user_id . "'";
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
    return $row["position_name"];
}

//ok
function emp_name($user_id) {
    $sql = "SELECT full_name FROM employee e where e.id='" . $user_id . "'";
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
    return $row["full_name"];
}

//need improvement: this function just cover a "beautiful" attendance scenario, "ugly" attendance not included.
function late_leave_time($emp_id, $month, $year) {
    $total_date = date('t', mktime(0, 0, 0, $month, 1, $year));
    $t = 0;
    for ($i = 1; $i <= $total_date; $i++) {
        $day = date('N', mktime(0, 0, 0, $month, $i, $year));
        $d = date('Y-m-d', mktime(0, 0, 0, $month, $i, $year));
        $times = get_time_table($emp_id, $day);
        $a = get_att($emp_id, $d);
        if ($times && $a && (count($a) == count($times))) {
            for ($j = 0; $j < count($times); $j++) {
                $times_arr = explode(':', $times[$j]);
                //echo '$a[$j]='.$a[$j];
                $a_arr = explode(':', $a[$j]);
                //print_r($a_arr);
                $a1 = mktime($a_arr[0], $a_arr[1], $a_arr[2], $month, 1, $year);
                $times1 = mktime($times_arr[0], $times_arr[1], $times_arr[2], $month, 1, $year);
                if ($j % 2 == 0) {
                    //Late
                    if ($a1 > $times1) {
                        //	echo $a[$j]." - ".$times[$j]."; ".$a1."  -  ".$times1." =  ".($a1-$times1)/(60*60)." <br />";
                        if ($a1 != "" && $times1 != "") {
                            $t+=$a1 - $times1;
                        }
                    }
                } else {
                    //Early Out
                    if ($a1 < $times1) {
                        //echo "-".$a[$j]." - ".$times[$j]."; ".$times1."  -  ".$a1." =  ".($times1-$a1)/(60*60)." <br />";
                        //$t+=$times1-$a1;
                        if ($a1 != "" && $times1 != "") {
                            $t+=$times1 - $a1;
                        }
                    }
                }
            }
        }
    }
    return $t / (60 * 60);
    //return 0;
}

//this function will count all working hour: in, lunch out, lunch in, out
function late_leave_time1($emp_id, $month, $year) {
    $total_date = date('t', mktime(0, 0, 0, $month, 1, $year));
    $t = 0;
    $deduct_time = 0;
    $tmp = '';
    for ($i = 1; $i <= $total_date; $i++) {
        $day = date('N', mktime(0, 0, 0, $month, $i, $year));
        $d = date('Y-m-d', mktime(0, 0, 0, $month, $i, $year));
        $times = get_time_table($emp_id, $day);
        $a = get_att($emp_id, $d);

        if ((($a[0] != "" && $a[1] != "" && $a[2] != "" && $a[3] != "") || ($a[0] != "" && $a[1] != "" && $a[2] == "" && $a[3] == "")) && count($a) > 1) {
            if ($a[0] > $times[0] && $times[0] != "") {
                // come in late
                $to_time = strtotime($times[0]);
                $from_time = strtotime($a[0]);
                $deduct_time+=late_time($to_time, $from_time, $d);
            }

            //attendance table got 2 punch only
            if ($a[0] != "" && $a[1] != "" && $a[2] == "" && $a[3] == "" && $times[0] != "") {
                //following if else will compare: out only
                //check employee out time got leave early or not, if leave early:attendance < time table
                if (count($times) == 4) {
                    //2 punch for attendance card only:in and out
                    $att = strtotime($a[1]);
                    $tt = strtotime($times[3]);
                } else {
                    //emp time table just 2 type of time only:in and out
                    $att = strtotime($a[1]);
                    $tt = strtotime($times[1]);
                }
                if ($att < $tt) {
                    //leave early 
                    $deduct_time+=late_time($att, $tt, $d);
                }
            } else {
                //following ifelse will compare: lunch out, lunch in, out
                if ($a[1] < $times[1]) {//leave early for lunch
                    $to_time = strtotime($a[1]);
                    $from_time = strtotime($times[1]);
                    $deduct_time+=late_time($to_time, $from_time, $d);
                }
                if ($a[2] > $times[2] && (count($a) > 3) && $times[2] != "") {//late in for lunch
                    $to_time = strtotime($times[2]);
                    $from_time = strtotime($a[2]);
                    $deduct_time+=late_time($to_time, $from_time, $d);
                }
                if ($a[3] < $times[3] && (count($a) > 3)) { //leave early when out
                    $to_time = strtotime($a[3]);
                    $from_time = strtotime($times[3]);
                    $deduct_time+=late_time($to_time, $from_time, $d);
                }
            }
        }
    }
    return $deduct_time / 60; //minutes
}

function late_time($att, $time_table, $i) {
    $temp_time = round(abs($att - $time_table) / 60, 2);
    if ($temp_time % 15 > 0) {
        $temp_time1 = $temp_time + (15 - $temp_time % 15);
    } else {
        $temp_time1 = $temp_time;
    }
    //echo $i.'late or early='.$temp_time.'   '.$temp_time1.'<br />';
    //echo "$temp_time1=".$temp_time."+(15-$temp_time%15)<br />";
    return $temp_time1;
}

//ok 20june2012, note: this function will ignore 1 and 3 attendance
//this function will ignore lunch hour, just count in and out only
function late_leave_time2($emp_id, $month, $year) {
    $total_date = date('t', mktime(0, 0, 0, $month, 1, $year));
    $t = 0;
    $deduct_time = 0;
    for ($i = 1; $i <= $total_date; $i++) {
        $day = date('N', mktime(0, 0, 0, $month, $i, $year));
        $d = date('Y-m-d', mktime(0, 0, 0, $month, $i, $year));
        $times = get_time_table($emp_id, $day);
        $a = get_att($emp_id, $d);

        // print "<br/>".count($a).".".count($times).".".$i."Attendance: ";
        // print_r($a);
        // print "<br/>Timetable:  ";
        // print_r($times);
        // print "<span style='color:red'>";
        if ((($a[0] != "" && $a[1] != "" && $a[2] != "" && $a[3] != "") || ($a[0] != "" && $a[1] != "" && $a[2] == "" && $a[3] == "")) && count($a) > 1 && $times[0] != "") {
            if ($a[0] > $times[0]) {
                $to_time = strtotime($a[0]);
                $from_time = strtotime($times[0]);
                $deduct_time+=late_time($to_time, $from_time);
            }
            if ($a[count($a) - 1] < $times[count($times) - 1]) {
                $to_time = strtotime($times[count($times) - 1]);
                $from_time = strtotime($a[count($a) - 1]);
                $deduct_time+=late_time($to_time, $from_time);
            }
        }
    }
    return $deduct_time / 60; //minutes
}

//ok
function get_time_table($emp_id, $day) {
    //$sql='SELECT * FROM emp_time_table where emp_id="'.$emp_id.'" and `day`="'.$day.'"';
    $sql = 'SELECT * FROM emp_time_table e
					where shift_id=(SELECT shift_id FROM employee e where id="' . $emp_id . '") and `day`="' . $day . '"';
    $rs = mysql_query($sql);
    $times = false;
    if ($rs && mysql_num_rows($rs) > 0) {
        while ($row = mysql_fetch_array($rs)) {
            if ($row["from_time"] != '00:00:00' && $row["to_time"] != '00:00:00') {
                $times[] = $row["from_time"];
                $times[] = $row["to_time"];
            }
        }
        return $times;
    } else {
        /* $sql1='SELECT * FROM time_table where `day`="'.$day.'"';
          $rs1=mysql_query($sql1);
          while($row1=mysql_fetch_array($rs1)){
          if($row1["from_time"]!='00:00:00'&&$row1["to_time"]!='00:00:00'){
          $times[]=$row1["from_time"];
          $times[]=$row1["to_time"];
          }
          } */
        return false;
    }
}

//ok
function get_att($emp_id, $date) {
    $sql = "SELECT * FROM attendance where emp_id='" . $emp_id . "' and work_in_date='" . $date . "'";
    $rs = mysql_query($sql);
    $times = false;
    if ($rs && mysql_num_rows($rs) > 0) {
        while ($row1 = mysql_fetch_array($rs)) {
            if ($row1["work_in_time"] != '00:00:00') {
                $times[] = $row1["work_in_time"];
            }
            if ($row1["work_out_time"] != '00:00:00') {
                $times[] = $row1["work_out_time"];
            }
        }
    }
    return $times;
}

function is_muslim($emp_id) {
    $sql = "SELECT religion FROM employee e where id=" . $emp_id;
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
    if ($row["religion"] == "Islam") {
        return true;
    } else {
        return false;
    }
}

function get_zakat($emp_id) {
    $sql = "SELECT zakat FROM employee e where id=" . $emp_id;
    $rs = mysql_query($sql);
    if ($rs && mysql_num_rows($rs)) {
        $row = mysql_fetch_array($rs);
        if ($row["zakat"] != "" || $row["zakat"] != "0") {
            return $row['zakat'];
        } else {
            return 0;
        }
    }
}

//unused
//late_leave_time($emp_id,$month);
function late_leave_time_ori($emp_id, $month) {
    return 0;
    /* $sql = "SELECT * FROM attendance WHERE emp_id=".$emp_id." AND MONTH(work_in_date)='".$month."';";
      $sql_result = mysql_query($sql);

      $sql1="SELECT * FROM time_table";
      $sql_result1 = mysql_query($sql1);

      $id=0;
      while($newArray1 = mysql_fetch_array($sql_result1)){
      $sql2="SELECT * FROM emp_time_table WHERE emp_id = ".$emp_id." and `day`='".$newArray1["day"]."' and id!='".$id."'";
      $sql_result2 = mysql_query($sql2);
      if($sql_result2&&mysql_num_rows($sql_result2)>0){
      $newArray2 = mysql_fetch_array($sql_result2);
      $id=$newArray2["id"];
      $fromary[] = $newArray2['from_time'];
      $toary[] = $newArray2['to_time'];
      }else{
      $id=0;
      $fromary[] = $newArray1['from_time'];
      $toary[] = $newArray1['to_time'];
      }
      }
      if($sql_result){
      $k=0;
      $late_time=0;
      while($newArray3 = mysql_fetch_array($sql_result)){
      if(strtotime($newArray3['work_in_time'])-strtotime($fromary[$k%7])>0){
      $late_time+=(strtotime($newArray3['work_in_time'])-strtotime($fromary[$k%7]));
      }
      if(strtotime($toary[$k%7]) - strtotime($newArray3['work_out_time'])>0){
      $late_time+=(strtotime($toary[$k%7]) - strtotime($newArray3['work_out_time']));
      }
      $k++;
      }
      return ($late_time/60)/60;
      }else{
      return 0;
      } */
}

/*
  function num_kids($fieldset,$num_of_kids){
  if($num_of_kids>0){
  //child at least more than 1
  if($num_of_kids>10){
  //in table, field is_more_10 must be : y
  return $fieldset.((int)$num_of_kids%10);
  }else{
  //in table, field is_more_10 must be : n
  return $fieldset.$num_of_kids;
  }
  }else{
  return $fieldset;
  }
  }
 */

//attendance1();
//used to dumb data on attendance
/* function attendance1(){
  for($i=1;$i<31;$i++){
  $date=mktime(0,0,0,5,$i,2012);
  $r1=rand(10,100);
  $r2=rand(9,199);
  if($r1%2!=0){
  $sql="insert into attendance(emp_id, work_in_date, work_in_time, work_out_time)
  values (1,'".date('Y-m-d',$date)."','09:00:00','14:00:00');";
  mysql_query($sql);
  }
  if($r2%3!=0){
  $sql="insert into attendance(emp_id, work_in_date, work_in_time, work_out_time)
  values (1,'".date('Y-m-d',$date)."','15:00:00','18:00:00');";
  mysql_query($sql);
  }
  }
  } */

//$r=chk_emp_tt(1,"2012-03-04");
/* function chk_emp_tt($emp_id,$chk_date){
  $day=date("N",strtotime($chk_date));
  $sql="SELECT * FROM emp_time_table where emp_id='".$emp_id."' and `day`='".$day."'";
  $rs=mysql_query($sql);
  $c=0;
  if($rs&&mysql_num_rows($rs)>0){
  $row=mysql_fetch_array($rs);
  while($row["from_time"]!='00:00:00'&&$row["to_time"]!='00:00:00'){
  $c=$c+1;
  }
  return $c;
  }else{
  return false;
  }
  } */
/* function late_leave2($emp_id,$month,$salary_per_hour){//late_leave_time($emp_id,$month,$year)
  $salary_per_min=$salary_per_hour / 60;
  $sql = "SELECT * FROM attendance WHERE emp_id=".$emp_id." AND MONTH(work_in_date)='".$month."';";
  $sql_result = mysql_query($sql);
  //echo $sql;

  $sql1="SELECT * FROM time_table";
  $sql_result1 = mysql_query($sql1);

  $id=0;
  while($newArray1 = mysql_fetch_array($sql_result1)){
  $sql2="SELECT * FROM emp_time_table WHERE emp_id = ".$emp_id." and `day`='".$newArray1["day"]."' and id!='".$id."'";
  $sql_result2 = mysql_query($sql2);
  if($sql_result2&&mysql_num_rows($sql_result2)>0){
  $newArray2 = mysql_fetch_array($sql_result2);
  $id=$newArray2["id"];
  $fromary[] = $newArray2['from_time'];
  $toary[] = $newArray2['to_time'];
  }else{
  $id=0;
  $fromary[] = $newArray1['from_time'];
  $toary[] = $newArray1['to_time'];
  }
  }
  if($sql_result){
  $k=0;
  $late_time=0;
  while($newArray3 = mysql_fetch_array($sql_result)){
  if(strtotime($newArray3['work_in_time'])-strtotime($fromary[$k%7])>0){
  //echo "aaa".strtotime($newArray3['work_in_time'])."-".strtotime($fromary[$k]);
  $late_time+=strtotime($newArray3['work_in_time'])-strtotime($fromary[$k%7]);
  }
  if(strtotime($toary[$k%7]) - strtotime($newArray3['work_out_time'])>0){
  //echo "aaa".strtotime($toary[$k])."-".strtotime($newArray3['work_out_time']);
  $late_time+=strtotime($toary[$k%7]) - strtotime($newArray3['work_out_time']);
  }
  $k++;
  }
  return ($late_time/60)*$salary_per_min;
  }else{
  return 0;
  }
  } */

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>
