<?php

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

  

  
$from_time = $_POST["from_time1"] . ':' . $_POST["from_time2"] . ':00';
$to_time = $_POST["to_time1"] . ':' . $_POST["to_time2"] . ':00';
$date = $_POST["date"];
$emp_id = $_POST["emp_id"];
  $checkEmpOT = 'SELECT id FROM employee_overtime WHERE emp_id=' . $emp_id . ' AND ot_date = "' . $date . '"';
    $queryEmpOT = mysql_query($checkEmpOT);
    $numEmpOT = mysql_num_rows($queryEmpOT);

    if ($numEmpOT > 0) {
        echo "applied";
    }else{
echo "true";
}
/*

$queryAtt = mysql_query('SELECT id FROM attendance WHERE emp_id=' . $emp_id . ' AND work_in_date = "' . $date . '"');
$numAtt = mysql_num_rows($queryAtt);
if ($numAtt > 0) {
    $day = date('N', strtotime($date));
    $checkTime = 'SELECT ett.id, ett.to_time FROM emp_time_table AS ett 
                  INNER JOIN employee AS e ON e.shift_id=ett.shift_id 
                  WHERE ett.day=' . $day . ' AND e.id=' . $emp_id . ' 
                  ORDER BY ett.id DESC LIMIT 1';
    $queryTime = mysql_query($checkTime);
    $rowTime = mysql_fetch_array($queryTime);

    $checkEmpAtt = 'SELECT work_out_time FROM attendance WHERE emp_id=' . $emp_id . ' AND work_in_date = "' . $date . '" ORDER BY id DESC LIMIT 1';
    $queryEmpAtt = mysql_query($checkEmpAtt);
    $rowEmpAtt = mysql_fetch_array($queryEmpAtt);

    $checkEmpOT = 'SELECT id FROM employee_overtime WHERE emp_id=' . $emp_id . ' AND ot_date = "' . $date . '"';
    $queryEmpOT = mysql_query($checkEmpOT);
    $numEmpOT = mysql_num_rows($queryEmpOT);

    if ($numEmpOT > 0) {
        echo "applied";
    } elseif ($from_time < $rowTime["to_time"]) {
        echo "from_time";
    } elseif ($to_time < $rowEmpAtt["work_out_time"]) {
        echo "to_time";
    } else {
        echo "true";
    }
} else {
    echo "no_att";
}
*/
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>