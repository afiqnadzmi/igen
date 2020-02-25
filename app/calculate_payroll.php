<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$mod_month = str_pad($month, 2, '0', STR_PAD_LEFT);
$mod_date = str_pad($start_date, 2, '0', STR_PAD_LEFT);
$total_day_month = date('t', mktime(0, 0, 0, $month, 1, $year));
$complete_end_date = $year . '-' . $mod_month . '-' . $total_day_month;
$complete_start_date = $year . '-' . $mod_month . '-' . $mod_date;
$total_working_day = days_in_month($emp_id, $month, $year);
$total_working_hours = 8;

//function
$get_basic = basic_salary($emp_id);
$daily_rate = $get_basic / $total_working_day;
$get_salary_per_hours = salary_per_hours($get_basic, $emp_id, $month, $year);
$get_overtime = overtime($emp_id, $month, $year);

$get_allowance_epf = allowance($emp_id, "epf");
$get_allowance_socso = allowance($emp_id, "socso");
$get_allowance_pcb = allowance($emp_id, "pcb");
$total_allowance = allowance($emp_id);
$get_comission_epf=comission($emp_id, $month);
$get_unpaid_leave = unpaid_leave($emp_id, $month, $year, $get_salary_per_hours);
$get_absent = absent($emp_id, $month, $year, $get_salary_per_hours);
$get_bonus = bonus($emp_id, date("Y-m-d", mktime(0, 0, 0, $month, 1, $year)));
$get_loan = loan($emp_id);
$get_late_leave = late_leave($emp_id, $month, $year, $get_salary_per_hours);
$get_advance_salary = advance_salary($emp_id, $month, $year);
$get_claim = claim($emp_id, $month, $year);
$get_paid_leave = paid_leave($emp_id, $month, $year);

$get_days_absent = days_absent($emp_id, $month, $year);
$get_days_at_work = days_at_work($emp_id, $month, $year);
$get_late_leave_time = late_leave_time($emp_id, $month, $year);
$get_unpaid_leave_time = unpaid_leave_time($emp_id, $month, $year);
$get_designation = designation($emp_id);
$get_name = emp_name($emp_id);
$ot_dur = ot_duration($emp_id, $month, $year);

//echo "$get_basic + $get_overtime + $get_bonus + $total_allowance - $get_unpaid_leave - $get_absent - $get_loan - $get_late_leave - $get_advance_salary;<br />";
//$gross_pay = $get_basic + $get_overtime + $get_bonus + $total_allowance - $get_unpaid_leave - $get_absent - $get_loan - $get_late_leave - $get_advance_salary;
//$gross_pay = $get_basic + $get_overtime + $get_bonus - $get_unpaid_leave - $get_absent - $get_loan - $get_late_leave - $get_advance_salary;
//$gross_pay = $get_basic + $get_overtime + $get_bonus - $get_unpaid_leave - $get_absent - $get_loan - $get_late_leave;
//
//check employee join date
$checkJoin = checkEmpJoinIn($emp_id, $month, $year);
$emp_joindate = getEmpJoinDate($emp_id);
$minusJoin = 0;
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
//if employee join in that particular month
    if ($checkJoin == "1") {
        $get_days_absent = 0;
    }
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

//echo $gross_pay;
//echo "$gross_pay= $get_basic + $get_overtime + $get_bonus + $total_allowance - $get_unpaid_leave - $get_absent - $get_loan - $get_late_leave - $get_advance_salary<br />";
//echo "gross pay=".$gross_pay;
//echo "$gross_pay=$get_basic + $get_overtime + $get_bonus + $total_allowance - $get_unpaid_leave - $get_absent - $get_loan - $get_late_leave - $get_advance_salary";
//echo "$get_absent = absent($emp_id, $month, $year, $get_salary_per_hours)";
 $get_socso = socso($gross_pay + $get_allowance_socso + $get_comission_epf, $emp_id);
 $get_epf = epf($emp_id, $gross_pay + $get_allowance_epf + $get_comission_epf);
 $get_pcb = pcb($emp_id, $gross_pay + $total_allowance  + $get_allowance_pcb + $get_comission_epf, $get_epf); 
 $get_employer_eis = employer_eis($gross_pay, $emp_id);
 $get_employee_eis = employee_eis($gross_pay, $emp_id);
 




/* echo "$get_socso = socso($gross_pay+$get_allowance_socso);<br />";
  echo "$get_pcb = pcb($emp_id, $gross_pay+$get_allowance_pcb);<br />";
  echo "$get_epf = epf($emp_id, $gross_pay+$get_allowance_epf);"; */


//echo "$get_epf = epf($emp_id, $gross_pay+$get_allowance_epf)<br />";
if($get_basic<=5000.01){
 $sql = "(SELECT * FROM employee  where id=" . $emp_id . " AND epf='Y')";
    //echo $sql;
    $rs = mysql_query($sql);
    if ($rs && mysql_num_rows($rs) > 0) {
  $get_employer_epf = ($gross_pay + $get_allowance_epf + $get_comission_epf)*0.13;
  }
 
  }else{
    if ($get_bonus == 0) {
        $get_employer_epf = employer_epf($emp_id, $gross_pay + $get_allowance_epf + $get_comission_epf);
		
    } else {
        $get_employer_epf = employer_epf_bonus($emp_id, $gross_pay + $get_allowance_epf + $get_comission_epf, $get_basic, $get_bonus);
		
    }

	}
		
	

if (chk_age_more_55($emp_id)) {
    $get_employer_socso = employer_socso2($gross_pay + $get_allowance_socso + $get_comission_epf, $emp_id); //more than 55 years old
    $get_socso = 0; //more than 55 years old no need pay socso
} else {
    $get_employer_socso = employer_socso($gross_pay + $get_allowance_socso + $get_comission_epf, $emp_id);
	
}

$gross_pay = $gross_pay + $total_allowance + $get_comission_epf;
if (is_muslim($emp_id)) {
    $zakat = get_zakat($emp_id);
    $pcb = ($get_pcb - $zakat);
    if ($pcb < 0) {
        $pcb = 0;
    }
    //echo "$gross_pay - $get_epf - $get_socso - $pcb + $get_claim";
    $net_pay = $gross_pay - $get_epf - $get_socso - $pcb + $get_claim - $get_advance_salary - $get_loan;
    //echo "$net_pay = $gross_pay - $get_epf - $get_socso - $pcb + $get_claim";
} else {
    //echo "$gross_pay - $get_epf - $get_socso - $get_pcb + $get_claim";
    $net_pay = $gross_pay - $get_epf - $get_socso - $get_pcb + $get_claim - $get_advance_salary - $get_loan;
    //echo "$net_pay = $gross_pay - $get_epf - $get_socso - $get_pcb + $get_claim";
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
