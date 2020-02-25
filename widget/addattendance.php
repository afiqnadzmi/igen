<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$emp_id = $_POST["id"];
$year = $_POST["year"];
$month = $_POST["month"];
$data_full = explode('|', $_POST["data_full"]);

$sql = 'SELECT id FROM attendance WHERE emp_id = ' . $emp_id . ' AND YEAR(work_in_date) = "' . $year . '" AND MONTH(work_in_date) = "' . $month . '"';
$query = mysql_query($sql);
$num_rows = mysql_num_rows($query);

if ($num_rows > 0) {
    print json_encode(array('msg' => "month_existed"));
} else {
    for ($i = 0; $i < count($data_full); $i++) {
        $data = explode(',', $data_full[$i]);
        if ($data[1] != "" && $data[2] != "" && $data[3] != "" && $data[4] != "") {
            if ((preg_match('/([0-1][0-9]|2[0-3]):([0-5][0-9])/', $data[1])) && (preg_match('/([0-1][0-9]|2[0-3]):([0-5][0-9])/', $data[2])) && (preg_match('/([0-1][0-9]|2[0-3]):([0-5][0-9])/', $data[3])) && (preg_match('/([0-1][0-9]|2[0-3]):([0-5][0-9])/', $data[4]))) {
                $correct = $correct . $data[0] . "," . $data[1] . "," . $data[2] . "," . $data[3] . "," . $data[4] . "|";
            } else {
                $wrong = $wrong . "\n" . $data[0];
                $wrong_data = $data[0] . "|" . $wrong_data;
            }
        } else {
            if ($data[1] != "" || $data[2] != "" || $data[3] != "" || $data[4] != "") {
                $missing = $missing . "\n" . $data[0];
                $missing_data = $data[0] . "|" . $missing_data;
            }
        }
    }

    if ($wrong_data == "" || $wrong_data == " ") {
        $wrong_num = 0;
    } else {
        $wrong1 = explode('|', $wrong_data);
        $wrong_num = count($wrong1) - 1;
    }

    if ($missing_data == "" || $missing_data == " ") {
        $missing_num = 0;
    } else {
        $missing1 = explode('|', $missing_data);
        $missing_num = count($missing1) - 1;
    }

    if ($missing_num == 0) {
        if ($wrong_num > 0) {
            print json_encode(array('msg' => "wrong_format", 'date' => $wrong));
        } else {
            if ($correct == "" || $correct == " ") {
                print json_encode(array('msg' => "empty"));
            } else {
                $correct_full = explode('|', $correct);
                $correct_count = count($correct_full) - 2;
                for ($i = 0; $i <= $correct_count; $i++) {
                    $correct_data = explode(',', $correct_full[$i]);
                    $sql1 = 'INSERT INTO attendance (emp_id, work_in_date, work_in_time, work_out_time) VALUES (' . $emp_id . ', "' . $correct_data[0] . '", "' . $correct_data[1] . '", "' . $correct_data[3] . '")';
                    $sql2 = 'INSERT INTO attendance (emp_id, work_in_date, work_in_time, work_out_time) VALUES (' . $emp_id . ', "' . $correct_data[0] . '", "' . $correct_data[4] . '", "' . $correct_data[2] . '")';
                    $query1 = mysql_query($sql1);
                    $query2 = mysql_query($sql2);
                }
                print json_encode(array('msg' => "correct"));
            }
        }
    } else {
        if ($missing_num > 0) {
            print json_encode(array('msg' => "empty_field", 'date' => $missing));
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