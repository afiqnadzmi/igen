<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

/*
//$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$str_arr =explode(";", $start_date);

foreach($str_arr as $val){
http://myigen.com:8081/HR/igen$val;
}
exit();
*/

$fromdate=date("Y-m-d", strtotime($_POST['fromdate1']));
$todate=date("Y-m-d", strtotime($_POST['todate1']));
$id=$_POST['id'];

$ts1 = strtotime($fromdate);
$ts2 = strtotime($todate);

$year1 = date('Y', $ts1); 
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);

$diff = (($year2 - $year1) * 12) + ($month2 - $month1);

$sql = 'UPDATE employee_loan SET start_date = "' . $fromdate . '", 	end_date = "' . $todate . '", rep_month = "' . $diff . '" WHERE id = ' . $id . ';';
$sql_result = mysql_query($sql);

if ($sql_result) {
    $query_status = "true";
} else {
    $query_status = "false";
}
echo $query_status;

?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>