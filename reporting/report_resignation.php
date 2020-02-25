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
$workbook->send('Resignation_Report.xls');
$worksheet1->write(0, 0, 'Resignation Report');
$worksheet1->write(1, 0, "Employee");
$worksheet1->write(1, 1, "I.C.");
$worksheet1->write(1, 2, "Position");
$worksheet1->write(1, 3, "Gender");
$worksheet1->write(1, 4, "Race");
$worksheet1->write(1, 5, "Join Date");
$worksheet1->write(1, 6, "Resign Date");
$worksheet1->write(1, 7, "Mobile");
$worksheet1->write(1, 8, "E-mail");
$worksheet1->write(1, 9, "Address");


$from = $_GET['fy'] . "-" . $_GET['fm'] . "-01";
$to = $_GET['ty'] . "-" . $_GET['tm'] . "-31";
$sql = "SELECT e.*, p.position_name FROM employee AS e 
        INNER JOIN position AS p ON e.position_id = p.id 
        WHERE e.resign_date != '0000-00-00'";
if (!empty($_GET["emp_id"])) {
    $sql.=" AND e.id IN (" . $_GET["emp_id"] . ")";
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
        $worksheet1->write($i, 1, $newArray['ic']);
        $worksheet1->write($i, 2, $newArray['position_name']);
        $worksheet1->write($i, 3, $newArray['gender']);
        $worksheet1->write($i, 4, $newArray['race']);
        $worksheet1->write($i, 5, $newArray['join_date']);
        $worksheet1->write($i, 6, $newArray['resign_date']);
        $worksheet1->write($i, 7, $newArray['mobile']);
        $worksheet1->write($i, 8, $newArray['email']);
        $worksheet1->write($i, 9, $newArray['address']);

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