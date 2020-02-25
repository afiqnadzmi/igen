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
    header("location:?loc=import_eis&m=done");
} else {
    header("location:?loc=import_eis&m=error");
}

function parseExcel($excel_file_name_with_path) {
    $d_sql = 'delete from employee_eis';
    $d_rs = mysql_query($d_sql);
    $data = new Spreadsheet_Excel_Reader();

    $data->setUTFEncoder('iconv');
    $data->setOutputEncoding('UTF-8'); //UTF-8
    $data->read($excel_file_name_with_path);
    
    for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++) {
        if ($data->sheets[0]['cells'][$i][2] != "") {
            $fr_amt = $data->sheets[0]['cells'][$i][1];
            $to_amt = $data->sheets[0]['cells'][$i][2];
            $employer_rate = $data->sheets[0]['cells'][$i][3];
            $employee_rate = $data->sheets[0]['cells'][$i][4];
            $total = $data->sheets[0]['cells'][$i][5];
			
			$table = "employee_eis";
            $key = array();
            $values = array();
			
            $key[] = "fr_amt";
            $values[] = insertvalue($fr_amt);
            $key[] = "to_amt";
            $values[] = insertvalue($to_amt);
            $key[] = "employer_rate";
            $values[] = insertvalue($employer_rate);
            $key[] = "employee_rate";
            $values[] = insertvalue($employee_rate);
            $key[] = "total_rate";
            $values[] = insertvalue($total);
			
            $keysdata = join(",", $key);
            $valuedata = join(",", $values);
            insert($table, $keysdata, $valuedata, "getid");
            //$sql = "update employee_eis set employer_rate=" . $employer_rate . ",employee_rate=" . $employer_rate2 . ",total_rate=" . $total . " where fr_amt=" . $fr_amt . " and to_amt=" . $to_amt;
           // mysql_query($sql);
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