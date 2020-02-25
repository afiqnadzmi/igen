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
$curren_date=date("d");

$month = isset($_POST['month']) ? $_POST['month'] : '';
$year = isset($_POST['year']) ? $_POST['year'] : '';


if ($payroll_id == 0) {
    $f_sql = "insert into payroll_finalised(finalise_month,finalise_year) 
				values('" . $month . "','" . $year . "')";
    $f_rs = mysql_query($f_sql);
    $new_id = mysql_insert_id();
} else {
    $new_id = $payroll_id;
}

$total_working_hours = 8;
//$total_working_day = days_in_month($emp_id, $month, $year);
$mod_month = str_pad($month, 2, '0', STR_PAD_LEFT);
$total_day_month = date('t', mktime(0, 0, 0, $month, 1, $year));
$from_date = $year . '-' . $mod_month . '-01';
$to_date = $year . '-' . $mod_month . '-' . $total_day_month;

if ($action == "all") {
    $sql = "SELECT * FROM employee WHERE id IN (" . $newStr . ")";
} elseif ($action == "single") {
    $sql = "SELECT * FROM employee WHERE id=" . $newStr;
}

$rs = mysql_query($sql);
while ($row = mysql_fetch_array($rs)) {
    $emp_id = $row['id'];

    $total_working_day = days_in_month($emp_id, $month, $year);

    $dep_id = $row['dep_id'];
    $emp_name = $row['full_name'];
    $get_days_at_work = days_at_work($emp_id, $month, $year);
    $get_days_absent = days_absent($emp_id, $month, $year);
    $get_basic = basic_salary($emp_id);
    $get_overtime = overtime($emp_id, $month, $year);
    $get_designation = designation($emp_id);
	$sql_inc = 'SELECT MONTH(incre_date) as month, Year(incre_date) as year,  increment_by_amount FROM simulation_inrement WHERE emp_id = ' . $emp_id . ' limit 1 ';
    $rs_inc = mysql_query($sql_inc);
    $row_inc = mysql_fetch_array($rs_inc);
    $incre_month=$row_inc['month'];
	$increment_b=$row_inc['increment_by_amount'];
	$yearinc_b=$row_inc['year'];
	if($incre_month>$month && ($year<=$yearinc_b )){
	
	$get_basic=($get_basic - $increment_b);
	
	}
	

    $daily_rate = $get_basic / $total_working_day;
    $get_salary_per_hours = salary_per_hours($get_basic, $emp_id, $month, $year);
    $get_late_leave = late_leave($emp_id, $month, $year, $get_salary_per_hours);
    //$get_salary_per_hours = salary_per_hours($get_basic,$emp_id,$month,$year);
    $get_unpaid_leave_time = unpaid_leave_time($emp_id, $month, $year);

    $get_bonus = bonus($emp_id, date("Y-m-d", mktime(0, 0, 0, $month, 1, $year)));

    $get_late_leave_time = late_leave_time($emp_id, $month, $year);

    $get_allowance_epf = allowance($emp_id, "epf");
    $get_allowance_socso = allowance($emp_id, "socso");
    $get_allowance_pcb = allowance($emp_id, "pcb");
   $get_comission_epf=comission($emp_id, $month);
    $total_allowance = allowance($emp_id);  


    $get_unpaid_leave = unpaid_leave($emp_id, $month, $year, $get_salary_per_hours);

    $get_unpaid_leave_days = $get_unpaid_leave_time / 8;
    $ot_dur = ot_duration($emp_id, $month, $year);
    $get_loan = loan($emp_id);
    $get_absent = absent($emp_id, $month, $year, $get_salary_per_hours);
    $get_advance_salary = advance_salary($emp_id, $month, $year);
    $get_claim = claim($emp_id, $month, $year);
    $get_paid_leave = paid_leave($emp_id, $month, $year);

//$gross_pay = $get_basic + $get_overtime + $get_bonus - $get_unpaid_leave - $get_absent - $get_loan - $get_late_leave - $get_advance_salary;
//$gross_pay = $get_basic + $get_overtime + $get_bonus - $get_unpaid_leave - $get_absent - $get_loan - $get_late_leave;
//$gross_pay = $get_basic + $get_overtime + $get_bonus - $get_unpaid_leave - $get_absent - $get_late_leave;
//
//check employee join date
    $checkJoin = checkEmpJoinIn($emp_id, $month, $year);
    $emp_joindate = getEmpJoinDate($emp_id);


    if (chk_position_late($emp_id, 'attendance') == '1') {
//if employee join in that particular month
        if ($checkJoin == "1") {
            $getDate = explode('-', $emp_joindate);
            $countJoin = 0;
            for ($i = 1; $i < $getDate[2]; $i++) {
                $chk_date = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
                $chkDate = chk_emp_tt($emp_id, $chk_date);
                if ($chkDate != false) {
                    $countJoin = $countJoin + 1;
                }
            }
            $get_days_absent = 0;
            $minusJoin = $daily_rate * $countJoin;
        }
    } else {
        $minusJoin = 0;
    }
    $resign_date = get_resign_date($emp_id, $month, $year);
    if ($resign_date == false) {
        $gross_pay = $get_basic + $get_overtime + $get_bonus - $get_unpaid_leave - $get_absent - $get_late_leave - $minusJoin;
    } else {
        $ori_gross_pay = $get_basic;
        $resigner_no_work_days = days_in_month($emp_id, $month, $year, date('j', strtotime($resign_date))) - days_absent($emp_id, $month, $year);
        $resigner_total_work_day = days_in_month($emp_id, $month, $year);
        $gross_pay = $ori_gross_pay / $resigner_total_work_day * $resigner_no_work_days + $get_overtime + $get_bonus - $get_unpaid_leave - $get_late_leave - $minusJoin;
        $get_days_at_work = $resigner_no_work_days - $get_paid_leave - ($get_unpaid_leave_time / 8);
    }


    $get_socso = socso($gross_pay + $get_allowance_socso + $get_comission_epf, $emp_id);
    $get_epf = epf($emp_id, $gross_pay + $get_allowance_epf + $get_comission_epf);
    $get_pcb = pcb($emp_id, $gross_pay + $get_allowance_pcb + $get_comission_epf, $get_epf); 
  if($get_basic<=5000.01){
  $get_employer_epf = ($gross_pay + $get_allowance_epf + $get_comission_epf)*0.13;
  }else{
    if ($get_bonus == 0) {
        $get_employer_epf = employer_epf($emp_id, $gross_pay + $get_allowance_epf + $get_comission_epf);
    } else {
        $get_employer_epf = employer_epf_bonus($emp_id, $gross_pay + $get_allowance_epf + $get_comission_epf, $get_basic, $get_bonus);
    }
	}


    $gross_pay = $gross_pay + $total_allowance + $get_comission_epf;
    $zakat = "";
    if (is_muslim($emp_id)) {
        $zakat = get_zakat($emp_id);
        $get_pcb = ($get_pcb - $zakat);
        if ($get_pcb < 0) {
            $get_pcb = 0;
        }
    }

    if (chk_age_more_55($emp_id)) {
        $get_employer_socso = employer_socso2($gross_pay + $get_allowance_socso + $get_comission_epf); //more than 55 years old
        $get_socso = 0; //more than 55 years old no need pay socso
    } else {
        $get_employer_socso = employer_socso($gross_pay + $get_allowance_socso + $get_comission_epf);
    }

    $net_pay = $gross_pay - $get_epf - $get_socso - $get_pcb + $get_claim - $get_advance_salary - $get_loan;

    //id, emp_id, basic_salary, epf, socso, ot_amount, pcb, allowance, bonus, days_at_work, 
    //days_absent, unpaid_days_off, ot_duration, loan, netpaid, payroll_finalised_id, 
    //designation, daily_rate, late_early_leave, unpaid_leave_hour, hourly_rate, from_date, 
    //to_date, daily_hour, zakat


    $queryLoan = mysql_query("SELECT id,installment FROM employee_loan where emp_id=" . $emp_id . " and loan_status='Approved' and paid_status='active'");
    $numLoan = mysql_num_rows($queryLoan);

    $table = "payroll_report";
    $arr[] = insertkeyvalue("emp_id", $emp_id);
    $arr[] = insertkeyvalue("basic_salary", $get_basic);
    $arr[] = insertkeyvalue("epf", $get_epf);
    $arr[] = insertkeyvalue("socso", $get_socso);
    $arr[] = insertkeyvalue("ot_amount", $get_overtime);

    $arr[] = insertkeyvalue("pcb", $get_pcb);
    $arr[] = insertkeyvalue("allowance", $total_allowance);
	$arr[] = insertkeyvalue("comission", $get_comission_epf);
    $arr[] = insertkeyvalue("bonus", $get_bonus);
    $arr[] = insertkeyvalue("days_at_work", $get_days_at_work);
    $arr[] = insertkeyvalue("days_absent", $get_days_absent);

    $arr[] = insertkeyvalue("unpaid_days_off", $get_unpaid_leave_days);
    $arr[] = insertkeyvalue("ot_duration", $ot_dur);

    if ($numLoan > 0) {
        $arr[] = insertkeyvalue("loan", $get_loan);
    } else {
        $arr[] = insertkeyvalue("loan", "0.00");
    }

    $arr[] = insertkeyvalue("netpaid", $net_pay);
    $arr[] = insertkeyvalue("payroll_finalised_id", $new_id);

    $arr[] = insertkeyvalue("designation", $get_designation);
    $arr[] = insertkeyvalue("daily_rate", $daily_rate);
    $arr[] = insertkeyvalue("late_early_leave", $get_late_leave);
    $arr[] = insertkeyvalue("unpaid_leave_hour", $get_unpaid_leave_time);
    $arr[] = insertkeyvalue("hourly_rate", $get_salary_per_hours);

    $arr[] = insertkeyvalue("from_date", $from_date);
    $arr[] = insertkeyvalue("to_date", $to_date);
    $arr[] = insertkeyvalue("daily_hour", $total_working_hours);
    $arr[] = insertkeyvalue("zakat", $zakat);

    $arr[] = insertkeyvalue("gross_pay", $gross_pay);
    $arr[] = insertkeyvalue("claim", $get_claim);
    $arr[] = insertkeyvalue("paid_leave", $get_paid_leave);
    $arr[] = insertkeyvalue("unpaid_leave", $get_unpaid_leave);
    $arr[] = insertkeyvalue("absent", $get_absent);
    $arr[] = insertkeyvalue("advance_salary", $get_advance_salary);
    $arr[] = insertkeyvalue("late_leave_time", $get_late_leave_time); //$dep_id
    $arr[] = insertkeyvalue("dep_id", $dep_id);
    $arr[] = insertkeyvalue("employer_epf", $get_employer_epf);
    $arr[] = insertkeyvalue("employer_socso", $get_employer_socso);
    insert2($table, $arr);
    unset($arr);

    if ($get_loan > 0) {
        if ($numLoan > 0) {
            while ($rowLoan = mysql_fetch_array($queryLoan)) {
                $loan_sql = "INSERT INTO paid_loan (emp_loan_id, amount) VALUES (" . $rowLoan["id"] . ",'" . $rowLoan["installment"] . "')";
                mysql_query($loan_sql);
            }
        }
    }

    $sql = 'insert into payroll_advance_salary(advance_amount, emp_id, request_date,payout_month,payout_year,payroll_finalised_id) 
					SELECT advance_amount, emp_id, request_date,'.$month.','.$year.',' . $new_id . ' FROM advance_salary 
					where emp_id = "' . $emp_id . '" and month(request_date)=' . $month . ' and year(request_date)=' . $year;
    $query = mysql_query($sql);
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