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
$workbook->send('Leave_Report(' . $_GET['from'] . " to " . $_GET['to'] . ').xls');
$worksheet1->write(0, 0, "Leave Report For " . $_GET['from'] . " to " . $_GET['to']);
$worksheet1->write(1, 0, "Employee");
$worksheet1->write(1, 1, "From");
$worksheet1->write(1, 2, "To");
$worksheet1->write(1, 3, "Reason");
$worksheet1->write(1, 4, "Leave Type");
$worksheet1->write(1, 5, "Number of days");



$sql = "SELECT * FROM employee_leave AS e 
        INNER JOIN leave_type AS l ON e.leave_type_id = l.id 
        JOIN employee AS emp ON e.emp_id = emp.id 
	WHERE e.request_status = 'Approved' AND e.from_date >= '" . $_GET['from'] . "' AND e.to_date <= '" . $_GET['to'] . "'";
if (!empty($_GET["emp_id"])) {
    $sql.=" AND e.emp_id in(" . $_GET["emp_id"] . ")";
} else {
    if ($_GET["dep_id"] == "0") {
        $sql.=" AND emp.branch_id=" . $_GET["branch_id"];
    } else {
        $sql.=" AND emp.dep_id=" . $_GET["dep_id"];
    }
}
if (!empty($_GET["status"])) {
    $sql.=" AND emp.emp_status = '" . $_GET["status"] . "'";
}
$sql.=" ORDER BY e.from_date";
$i = 2;
$sql_result = mysql_query($sql);
if ($sql_result && mysql_num_rows($sql_result) > 0) {
    while ($newArray = mysql_fetch_array($sql_result)) {
        $worksheet1->write($i, 0, "EMP" . str_pad($newArray['emp_id'], 6, "0", STR_PAD_LEFT) . " " . $newArray['full_name']);
        $worksheet1->write($i, 1, $newArray['from_date']);
        $worksheet1->write($i, 2, $newArray['to_date']);
        $worksheet1->write($i, 3, $newArray['reason']);
        $worksheet1->write($i, 4, $newArray['type_name']);
        $worksheet1->write($i, 5, $newArray['num_days']);
        $i++;
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