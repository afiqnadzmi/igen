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

$workbook->send('Quickpay_Payroll_Report(' . $_GET['from'] . ' to ' . $_GET['to'] . ').xls');
$worksheet1->write(0, 0, 'Quickpay Payroll Report For ' . $_GET['from'] . ' to ' . $_GET['to']);
$worksheet1->write(1, 0, "Employee");
$worksheet1->write(1, 1, "Amount (RM)");
$worksheet1->write(1, 2, "Request Date");

$month_f = date("F", strtotime($_GET['from']));
$year_f = date("Y", strtotime($_GET['from']));
$month_t = date("F", strtotime($_GET['to']));
$year_t = date("Y", strtotime($_GET['to']));


$sql = "SELECT e.*, d.dep_name FROM quickpay_payroll e, department d WHERE e.dep_id = d.id";
if (!empty($_GET["emp_id"]) && $_GET["emp_id"] != "all") {

    $emp_id=explode (",", $_GET["emp_id"]);
                  $a="";
                  foreach($emp_id as $val){
                    $a.="'".$val."',";
                  }
                  $a=mb_substr($a, 0, -1);
                  //echo $a;
                    //$a = $_GET['emp_id'];
                    $sql.=" AND e.emp_no in ($a) AND e.emp_month='$month_f' AND e.emp_year = $year_f AND e. GROUP BY e.emp_name";
                }
//$sql_test = mysql_num_rows($sql_result);
//$newArray = mysql_fetch_array($sql_result);
$sql_result = mysql_query($sql);
$i = 2;
//echo "EMP" . str_pad($newArray['e.emp_id'], 6, "0", STR_PAD_LEFT). " " . $newArray['e.emp_name'];

if ($sql_result && mysql_num_rows($sql_result) > 0) {
    while ($newArray = mysql_fetch_array($sql_result)) {
        $worksheet1->write($i, 0, "haha");
        $worksheet1->write($i, 0, $newArray['emp_id']);
        $worksheet1->write($i, 1, $newArray['emp_id']);
        $worksheet1->write($i, 2, $newArray['emp_name']);
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