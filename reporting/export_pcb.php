<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

$workbook->send('pcb_sample.xls');
$worksheet1->write(0, 0, 'PCB Report');
$worksheet1->write(1, 0, "From Amount");
$worksheet1->write(1, 1, "To Amount");
$worksheet1->write(1, 2, "Category 1 - B");
$worksheet1->write(1, 3, "Category 2 - K");
$worksheet1->write(1, 4, "Category 2 - KA1");
$worksheet1->write(1, 5, "Category 2 - KA2");
$worksheet1->write(1, 6, "Category 2 - KA3");
$worksheet1->write(1, 7, "Category 2 - KA4");
$worksheet1->write(1, 8, "Category 2 - KA5");
$worksheet1->write(1, 9, "Category 2 - KA6");
$worksheet1->write(1, 10, "Category 2 - KA7");
$worksheet1->write(1, 11, "Category 2 - KA8");
$worksheet1->write(1, 12, "Category 2 - KA9");
$worksheet1->write(1, 13, "Category 2 - KA10");
$worksheet1->write(1, 14, "Category 3 - K");
$worksheet1->write(1, 15, "Category 3 - KA1");
$worksheet1->write(1, 16, "Category 3 - KA2");
$worksheet1->write(1, 17, "Category 3 - KA3");
$worksheet1->write(1, 18, "Category 3 - KA4");
$worksheet1->write(1, 19, "Category 3 - KA5");
$worksheet1->write(1, 20, "Category 3 - KA6");
$worksheet1->write(1, 21, "Category 3 - KA7");
$worksheet1->write(1, 22, "Category 3 - KA8");
$worksheet1->write(1, 23, "Category 3 - KA9");
$worksheet1->write(1, 24, "Category 3 - KA10");
$worksheet1->write(1, 25, "Is more 10");

$sql = "SELECT * FROM employee_pcb where true";

if (!empty($_GET["emp_id"])) {
    $sql.=" and id in(" . $_GET["emp_id"] . ")";
} else {
    $sql .= "";
}
$sql_result = mysql_query($sql);
$i = 2;
$worksheet1->write(4, 1, $sql);
if ($sql_result && mysql_num_rows($sql_result) > 0) {
    while ($newArray = mysql_fetch_array($sql_result)) {
        $worksheet1->write($i, 0, $newArray['fr_amt']);
        $worksheet1->write($i, 1, $newArray['to_amt']);
        $worksheet1->write($i, 2, $newArray['single']);
        $worksheet1->write($i, 3, $newArray['married_separate']);
        $worksheet1->write($i, 4, $newArray['married_separate1']);
        $worksheet1->write($i, 5, $newArray['married_separate2']);
        $worksheet1->write($i, 6, $newArray['married_separate3']);
        $worksheet1->write($i, 7, $newArray['married_separate4']);
        $worksheet1->write($i, 8, $newArray['married_separate5']);
        $worksheet1->write($i, 9, $newArray['married_separate6']);
        $worksheet1->write($i, 10, $newArray['married_separate7']);
        $worksheet1->write($i, 11, $newArray['married_separate8']);
        $worksheet1->write($i, 12, $newArray['married_separate9']);
        $worksheet1->write($i, 13, $newArray['married_separate10']);
        $worksheet1->write($i, 14, $newArray['married_combine']);
        $worksheet1->write($i, 15, $newArray['married_combine1']);
        $worksheet1->write($i, 16, $newArray['married_combine2']);
        $worksheet1->write($i, 17, $newArray['married_combine3']);
        $worksheet1->write($i, 18, $newArray['married_combine4']);
        $worksheet1->write($i, 19, $newArray['married_combine5']);
        $worksheet1->write($i, 20, $newArray['married_combine6']);
        $worksheet1->write($i, 21, $newArray['married_combine7']);
        $worksheet1->write($i, 22, $newArray['married_combine8']);
        $worksheet1->write($i, 23, $newArray['married_combine9']);
        $worksheet1->write($i, 24, $newArray['married_combine10']);
        $worksheet1->write($i, 25, $newArray['is_more_10']);
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