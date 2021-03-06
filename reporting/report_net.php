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

$month = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

$workbook->send("Net_Paid_Report(" . $month[$_GET['month']] . " " . $_GET['year'] . ").xls");
$worksheet1->write(0, 0, "Net Paid Report For " . $month[$_GET['month']] . " " . $_GET['year'] . ".xls");
$worksheet1->write(1, 0, "Employee");
$worksheet1->write(1, 1, "Basic Salary (RM)");
$worksheet1->write(1, 2, "Overtime (RM)");
$worksheet1->write(1, 3, "Bonus (RM)");
$worksheet1->write(1, 4, "Allowance (RM)");
$worksheet1->write(1, 5, "Unpaid Leave (RM)");
$worksheet1->write(1, 6, "Absent (RM)");
$worksheet1->write(1, 7, "Loan (RM)");
$worksheet1->write(1, 8, "Late In Early Out (RM)");
$worksheet1->write(1, 9, "Gross Pay (RM)");
$worksheet1->write(1, 10, "EPF (RM)");
$worksheet1->write(1, 11, "Socso (RM)");
$worksheet1->write(1, 12, "PCB (RM)");
$worksheet1->write(1, 13, "Claim (RM)");
$worksheet1->write(1, 14, "Net Pay (RM)");
?>
<?php

$month = $_GET['month'];
$year = $_GET['year'];
$chk_sql = 'SELECT id FROM payroll_finalised WHERE finalise_month=' . $month . ' AND finalise_year=' . $year;
$chk_sql_result = mysql_query($chk_sql);
$i = 2;
if ($chk_sql_result && mysql_num_rows($chk_sql_result) > 0) {
    $chk_row = mysql_fetch_array($chk_sql_result);
    $fid = $chk_row["id"];
    $sql1 = "SELECT e.full_name,e.ic,e.epf_num,p.* FROM payroll_report AS p 
            INNER JOIN employee AS e ON e.id=p.emp_id
            WHERE p.payroll_finalised_id=" . $fid;
    if (!empty($_GET["emp_id"])) {
        $sql1.=" and p.emp_id in(" . $_GET["emp_id"] . ")";
    } else {
        if ($_GET["dep_id"] == "0") {
            $sql1.=" AND e.branch_id = " . $_GET["branch_id"];
        } else {
            $sql1.=" AND e.dep_id = " . $_GET["dep_id"];
        }
    }
    if (!empty($_GET["status"])) {
        $sql1.=" AND e.emp_status = '" . $_GET["status"] . "'";
    }
    $sql1.=" ORDER BY e.id";

    $sql_result = mysql_query($sql1);
    if ($sql_result && mysql_num_rows($sql_result) > 0) {
        while ($newArray = mysql_fetch_array($sql_result)) {
            $worksheet1->write($i, 0, "EMP" . str_pad($newArray['emp_id'], 6, "0", STR_PAD_LEFT) . " " . $newArray['full_name']);
            $worksheet1->write($i, 1, $newArray['basic_salary']);
            $worksheet1->write($i, 2, $newArray['ot_amount']);
            $worksheet1->write($i, 3, $newArray['bonus']);
            $worksheet1->write($i, 4, $newArray['allowance']);
            $worksheet1->write($i, 5, $newArray['unpaid_leave']);
            $worksheet1->write($i, 6, $newArray['absent']);
            $worksheet1->write($i, 7, $newArray['loan']);
            $worksheet1->write($i, 8, $newArray['late_leave_time']);
            $worksheet1->write($i, 9, $newArray['advance_salary']);
            $worksheet1->write($i, 10, $newArray['gross_pay']);
            $worksheet1->write($i, 11, $newArray['socso']);
            $worksheet1->write($i, 12, $newArray['pcb']);
            $worksheet1->write($i, 13, $newArray['claim']);
            $worksheet1->write($i, 14, $newArray['netpaid']);
            $i++;
        }
    } else {
        $worksheet1->write($i, 0, "No record found.");
    }
} else {
    $worksheet1->write($i, 0, "No record found.");
}

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>