<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

$workbook->send('EPF_sample.xls');
$worksheet1->write(0, 0, 'EPF Report');
$worksheet1->write(1, 0, "From Amount");
$worksheet1->write(1, 1, "To Amount");
$worksheet1->write(1, 2, "Total Rate");
$worksheet1->write(1, 3, "Employer Rate");
$worksheet1->write(1, 4, "Deduct Rate");


$sql = "SELECT * FROM employee_epf";

if (!empty($_GET["emp_id"])) {
    $sql.=" and e.id in(" . $_GET["emp_id"] . ")";
} else {
    $sql .= "";
}
$sql_result = mysql_query($sql);
$i = 2;
if ($sql_result && mysql_num_rows($sql_result) > 0) {
    while ($newArray = mysql_fetch_array($sql_result)) {

        $worksheet1->write($i, 0, $newArray['fr_amt']);
        $worksheet1->write($i, 1, $newArray['to_amt']);
        $worksheet1->write($i, 2, $newArray['rate']);
        $worksheet1->write($i, 3, $newArray['employer_rate']);
        $worksheet1->write($i, 4, $newArray['deduct_rate']);

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