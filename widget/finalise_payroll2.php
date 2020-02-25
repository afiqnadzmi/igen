<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

include_once "app/test_jason.php";
include_once "app/test.php";
include_once "app/loh.php";

$month = isset($_GET['month']) ? $_GET['month'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';
$new_id = isset($_GET['payroll_id']) ? $_GET['payroll_id'] : '';

$chk_query = mysql_query('SELECT id FROM payroll_finalised WHERE finalise_month="' . $month . '" AND finalise_year="' . $year . '"');
$chk_num = mysql_num_rows($chk_query);
if ($new_id == "0") {
    $f_sql = "INSERT INTO payroll_finalised (finalise_month, finalise_year, is_close) VALUES ('" . $month . "' ,'" . $year . "' ,1)";
    $f_rs = mysql_query($f_sql);
    $new_id = mysql_insert_id();
} else {
    $f_sql = "UPDATE payroll_finalised SET is_close = 1 WHERE id=" . $new_id;
    $f_rs = mysql_query($f_sql);
}

$queryGetEmp = mysql_query('SELECT emp_id FROM payroll_report WHERE payroll_finalised_id=' . $new_id);
$numGetEmp = mysql_num_rows($queryGetEmp);
if ($numGetEmp > 0) {
    while ($rowGetEmp = mysql_fetch_array($queryGetEmp)) {
        $getEmp = $getEmp . ' id <> ' . $rowGetEmp["emp_id"] . ' AND ';
    }
    $getEmp = substr($getEmp, 0, -5);
    $sqlAdd = " AND" . $getEmp;
}

$total_working_hours = 8;
$mod_month = str_pad($month, 2, '0', STR_PAD_LEFT);
$total_day_month = date('t', mktime(0, 0, 0, $month, 1, $year));
$from_date = $year . '-' . $mod_month . '-01';
$to_date = $year . '-' . $mod_month . '-' . $total_day_month;

$sql = "SELECT * FROM employee WHERE (resign_date is null OR resign_date='000000-00-00' 
        OR (year(resign_date)='" . $year . "' AND month(resign_date)='" . $month . "'))" . $sqlAdd;
$rs = mysql_query($sql);
while ($row = mysql_fetch_array($rs)) {
    $emp_id = $row['id'];

    $total_working_day = days_in_month($emp_id, $month, $year);
    $get_designation = designation($emp_id);

    $dep_id = $row['dep_id'];
    $emp_name = $row['full_name'];

    $table = "payroll_report";
    $arr[] = insertkeyvalue("emp_id", $emp_id);
    $arr[] = insertkeyvalue("basic_salary", '');
    $arr[] = insertkeyvalue("epf", '');
    $arr[] = insertkeyvalue("socso", '');
    $arr[] = insertkeyvalue("ot_amount", '');

    $arr[] = insertkeyvalue("pcb", '');
    $arr[] = insertkeyvalue("allowance", '');
    $arr[] = insertkeyvalue("bonus", '');
    $arr[] = insertkeyvalue("days_at_work", '');
    $arr[] = insertkeyvalue("days_absent", '');

    $arr[] = insertkeyvalue("unpaid_days_off", '');
    $arr[] = insertkeyvalue("ot_duration", '');
    $arr[] = insertkeyvalue("loan", '');
    $arr[] = insertkeyvalue("netpaid", '');
    $arr[] = insertkeyvalue("payroll_finalised_id", $new_id);

    $arr[] = insertkeyvalue("designation", $get_designation);
    $arr[] = insertkeyvalue("daily_rate", '');
    $arr[] = insertkeyvalue("late_early_leave", '');
    $arr[] = insertkeyvalue("unpaid_leave_hour", '');
    $arr[] = insertkeyvalue("hourly_rate", '');

    $arr[] = insertkeyvalue("from_date", $from_date);
    $arr[] = insertkeyvalue("to_date", $to_date);
    $arr[] = insertkeyvalue("daily_hour", '');
    $arr[] = insertkeyvalue("zakat", '');

    $arr[] = insertkeyvalue("gross_pay", '');
    $arr[] = insertkeyvalue("claim", '');
    $arr[] = insertkeyvalue("unpaid_leave", '');
    $arr[] = insertkeyvalue("absent", '');
    $arr[] = insertkeyvalue("advance_salary", '');
    $arr[] = insertkeyvalue("late_leave_time", ''); //$dep_id
    $arr[] = insertkeyvalue("dep_id", $dep_id);
    $arr[] = insertkeyvalue("employer_epf", '');
    $arr[] = insertkeyvalue("employer_socso", '');
    insert2($table, $arr);
    unset($arr);
}

if ($f_rs) {
    header('location:?loc=payroll&message=success');
}

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>