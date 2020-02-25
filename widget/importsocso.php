<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$uploaddir = 'tmp/';
$file = basename($_FILES['excel_file']['name']);
$new_path = $uploaddir . basename($_FILES['excel_file']['name']);

if (move_uploaded_file($_FILES['excel_file']['tmp_name'], $new_path)) {
    parseExcel($new_path);
    header("location:?loc=import_socso&m=done");
} else {
    header("location:?loc=import_socso&m=error");
}

function parseExcel($excel_file_name_with_path) {

    $data = new Spreadsheet_Excel_Reader();

    $data->setUTFEncoder('iconv');
    $data->setOutputEncoding('UTF-8'); //UTF-8
    $data->read($excel_file_name_with_path);

    for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
        if ($data->sheets[0]['cells'][$i][2] != "") {
            $fr_amt = $data->sheets[0]['cells'][$i][1];
            $to_amt = $data->sheets[0]['cells'][$i][2];
            $employer_rate = $data->sheets[0]['cells'][$i][3];
            $employer_rate2 = $data->sheets[0]['cells'][$i][4];
            $deduct_rate = $data->sheets[0]['cells'][$i][5];

            $sql = "update employee_socso set employer_rate=" . $employer_rate . ",employer_rate2=" . $employer_rate2 . ",deduct_rate=" . $deduct_rate . " where fr_amt=" . $fr_amt . " and to_amt=" . $to_amt;
            mysql_query($sql);
        }
    }
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