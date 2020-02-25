<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

if ($_POST["action"] == "dropdown") {
    for ($i = 1; $i < 13; $i++) {
        $m = date('n');

        $pf_sql = "SELECT id FROM payroll_finalised WHERE finalise_month='" . $i . "' AND finalise_year='" . $_POST["year"] . "' AND is_close = 1";
        $pf_rs = mysql_query($pf_sql);
        if ($pf_rs && mysql_num_rows($pf_rs) > 0) {
            $finalised = "disabled";
        } else {
            $finalised = "";
        }
        echo '<option ' . $finalised . ' value="' . $i . '">' . date('M', mktime(0, 0, 0, $i, 1, date("Y"))) . '</option>';
    }
} elseif ($_POST["action"] == "getcount") {
    $count = 0;
    for ($i = 1; $i < 13; $i++) {
        $m = date('n');

        $pf_sql = "SELECT id FROM payroll_finalised WHERE finalise_month='" . $i . "' AND finalise_year='" . $_POST["year"] . "' AND is_close = 1";
        $pf_rs = mysql_query($pf_sql);
        if ($pf_rs && mysql_num_rows($pf_rs) > 0) {
            $count = $count + 1;
        }
    }
    echo $count;
} elseif ($_POST["action"] == "getpayrollid") {
    $query = mysql_query("SELECT id FROM payroll_finalised WHERE finalise_month='" . $_POST["month"] . "' AND finalise_year='" . $_POST["year"] . "'");
    $row = mysql_fetch_array($query);
    $count = mysql_num_rows($query);
    if ($count > 0) {
        $payroll_id = $row["id"];
    } else {
        $payroll_id = 0;
    }
    echo $payroll_id;
} elseif ($_POST["action"] == "getEmpAmt") {
    $query = mysql_query("SELECT id FROM payroll_finalised WHERE finalise_month='" . $_POST["month"] . "' AND finalise_year='" . $_POST["year"] . "'");
    $row = mysql_fetch_array($query);
    $count = mysql_num_rows($query);
    if ($count > 0) {
        $payroll_id = $row["id"];
        $queryGetEmp = mysql_query('SELECT emp_id FROM payroll_report WHERE payroll_finalised_id=' . $payroll_id);
        $rowGetEmp = mysql_num_rows($queryGetEmp);
        if ($rowGetEmp > 0) {
            while ($rowGetEmp = mysql_fetch_array($queryGetEmp)) {
                $emp_id = $emp_id . 'id <> ' . $rowGetEmp["emp_id"] . ' AND ';
            }
            $emp_id = substr($emp_id, 0, -5);
            $sqlAdd = ' AND ' . $emp_id;
        } else {
            $sqlAdd = '';
        }
        $queryGetEmp2 = mysql_query('SELECT id, full_name FROM employee WHERE emp_status = "Active"' . $sqlAdd);
        $countGetEmp2 = mysql_num_rows($queryGetEmp2);
        while ($rowGetEmp2 = mysql_fetch_array($queryGetEmp2)) {
            $emp_name = $emp_name . '\n' . $rowGetEmp2["full_name"];
        }
    } else {
        $payroll_id = 0;
        $queryGetEmp2 = mysql_query('SELECT id, full_name FROM employee WHERE emp_status = "Active"');
        $countGetEmp2 = mysql_num_rows($queryGetEmp2);
        while ($rowGetEmp2 = mysql_fetch_array($queryGetEmp2)) {
            $emp_name = $emp_name . '\n' . $rowGetEmp2["full_name"];
        }
    }
    if ($countGetEmp2 > 0) {
		
		$message="Note: Please be informed that if you proceed monthly closing, You will not be able to process the payroll of the ".$countGetEmp2." Employees which has not been processed";
        echo "Not confirm payroll: " . $countGetEmp2 . " employee(s)\n\n".$message."\n\nClick OK to proceed monthly closing or Cancel to view list";
    } else {
        echo "0";
    }
} elseif ($_POST["action"] == "getEmpID") {
    $query = mysql_query("SELECT id FROM payroll_finalised WHERE finalise_month='" . $_POST["month"] . "' AND finalise_year='" . $_POST["year"] . "'");
    $row = mysql_fetch_array($query);
    $count = mysql_num_rows($query);
    if ($count > 0) {
        $payroll_id = $row["id"];
        $queryGetEmp = mysql_query('SELECT emp_id FROM payroll_report WHERE payroll_finalised_id=' . $payroll_id);
        $rowGetEmp = mysql_num_rows($queryGetEmp);
        if ($rowGetEmp > 0) {
            while ($rowGetEmp = mysql_fetch_array($queryGetEmp)) {
                $emp_id = $emp_id . 'id <> ' . $rowGetEmp["emp_id"] . ' AND ';
            }
            $emp_id = substr($emp_id, 0, -5);
            $sqlAdd = ' AND ' . $emp_id;
        } else {
            $sqlAdd = '';
        }
        $queryGetEmp2 = mysql_query('SELECT id FROM employee WHERE emp_status = "Active"' . $sqlAdd);
        $countGetEmp2 = mysql_num_rows($queryGetEmp2);
        while ($rowGetEmp2 = mysql_fetch_array($queryGetEmp2)) {
            $emp_name = $emp_name . $rowGetEmp2["id"] . ',';
        }
        $emp_name = substr($emp_name, 0, -1);
    } else {
        $payroll_id = 0;
        $queryGetEmp2 = mysql_query('SELECT id FROM employee WHERE emp_status = "Active"');
        $countGetEmp2 = mysql_num_rows($queryGetEmp2);
        while ($rowGetEmp2 = mysql_fetch_array($queryGetEmp2)) {
            $emp_name = $emp_name . $rowGetEmp2["id"] . ',';
        }
        $emp_name = substr($emp_name, 0, -1);
    }
    echo $emp_name;
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