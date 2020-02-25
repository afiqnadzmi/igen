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

$workbook->send("Training_Report(" . $_GET['from'] . " to " . $_GET['to'] . ").xls");
$worksheet1->write(0, 0, "Training Report For " . $_GET['from'] . " to " . $_GET['to']);
$worksheet1->write(1, 0, "Employee");
$worksheet1->write(1, 1, "Training Name");
$worksheet1->write(1, 2, "Request Date");
$worksheet1->write(1, 3, "Feedback");
$worksheet1->write(1, 4, "Result");

$sql = "SELECT et.*, t.*, e.full_name FROM employee_training AS et 
        INNER JOIN employee AS e ON et.employee_id = e.id 
        JOIN training AS t ON et.training_id = t.id 
        WHERE et.request_status = 'Approved' AND et.request_date >= '" . $_GET['from'] . "' AND et.request_date <= '" . $_GET['to'] . "'";
if (!empty($_GET["emp_id"])) {
    $sql.=" and et.employee_id IN (" . $_GET["emp_id"] . ")";
} else {
    if ($_GET["dep_id"] == "0") {
        $sql.=" AND e.branch_id = " . $_GET["branch_id"];
    } else {
        $sql.=" AND e.dep_id = " . $_GET["dep_id"];
    }
}
if (!empty($_GET["status"])) {
    $sql.=" AND e.emp_status = '" . $_GET["status"] . "'";
}
$sql.=" ORDER BY e.id";

$sql_result = mysql_query($sql);
$i = 2;
if ($sql_result && mysql_num_rows($sql_result) > 0) {
    while ($newArray = mysql_fetch_array($sql_result)) {
        $worksheet1->write($i, 0, "EMP" . str_pad($newArray['emp_id'], 6, "0", STR_PAD_LEFT) . " " . $newArray['full_name']);
        $worksheet1->write($i, 1, $newArray['training_name']);
        $worksheet1->write($i, 2, $newArray['request_date']);
        $worksheet1->write($i, 3, $newArray['feedback']);
        $worksheet1->write($i, 4, $newArray['result']);
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