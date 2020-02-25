<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

$month = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

$workbook->send("Salary_Report(" . $month[$_GET['month']] . " " . $_GET['year'] . ").xls");
$worksheet1->write(0, 0, "Salary Report(" . $month[$_GET['month']] . " " . $_GET['year'] . ").xls");
$worksheet1->write(1, 0, "Employee");
$worksheet1->write(1, 1, "Bank Account");
$worksheet1->write(1, 2, "Basic Salary");
$worksheet1->write(1, 3, "Overtime (RM)");
$worksheet1->write(1, 4, "Allowance (RM)");
$worksheet1->write(1, 5, "Claim (RM)");
$worksheet1->write(1, 6, "EPF (RM)");
$worksheet1->write(1, 7, "Socso (RM)");
$worksheet1->write(1, 8, "PCB (RM)");
$worksheet1->write(1, 9, "Advance Salary (RM)");
$worksheet1->write(1, 10, "Net Pay (RM)");

$month = $_GET['month'];
$year = $_GET['year'];
$i = 2;
$chk_sql = 'SELECT id FROM payroll_finalised WHERE finalise_month=' . $month . ' AND finalise_year=' . $year;
$chk_sql_result = mysql_query($chk_sql);
if ($chk_sql_result && mysql_num_rows($chk_sql_result) > 0) {
    $chk_row = mysql_fetch_array($chk_sql_result);
    $fid = $chk_row["id"];
    $sql1 = "SELECT e.full_name,e.ic,e.epf_num,b.name as bank_name,p.* FROM payroll_report AS p 
            INNER JOIN employee AS e ON e.id=p.emp_id
            LEFT JOIN bank AS b ON b.id=e.bank_acc_id
            WHERE p.payroll_finalised_id=" . $fid;
    if (!empty($_GET["emp_id"])) {
        $sql1.=" AND p.emp_id IN (" . $_GET["emp_id"] . ")";
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
            $worksheet1->write($i, 1, $newArray['bank_name']);
			$worksheet1->write($i, 2, $newArray['basic_salary']);
            $worksheet1->write($i, 3, $newArray['ot_amount']);
            $worksheet1->write($i, 4, $newArray['allowance']);
            $worksheet1->write($i, 5, $newArray['claim']);
            $worksheet1->write($i, 6, $newArray['epf']);
            $worksheet1->write($i, 7, $newArray['socso']);
            $worksheet1->write($i, 8, $newArray['pcb']);
            $worksheet1->write($i, 9, $newArray['advance_salary']);
            $worksheet1->write($i, 10, $newArray['netpaid']);
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