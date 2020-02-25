<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

if ($_POST["emp_id"] == "0") {
    $emp_id = $_COOKIE['igen_user_id'];
} else {
    $emp_id = $_POST["emp_id"];
}
$starting_date=date('Y-m-d', strtotime($_POST["from"]));
$ending_date=date('Y-m-d', strtotime($_POST["to"]));

$from_date = explode('-', $starting_date);
$to_date = explode('-', $ending_date);

$from_year = $from_date[0];
$to_year = $to_date[0];

$from_month = $from_date[1];
$to_month = $to_date[1];

$from_day = $from_date[2];
$to_day = $to_date[2];

$count = 0;
$countJ = 0;

if ($from_year == $to_year) {
    if ($from_month == $to_month) {
        for ($i = $from_day; $i <= $to_day; $i++) {
            $to = str_pad($i, 2, "0", STR_PAD_LEFT);
            $checkDate = $from_year . '-' . $from_month . '-' . $to;
            $day = date('N', strtotime($checkDate));

            $sqlCheckWork = 'SELECT ett.day, is_work_day FROM emp_time_table AS ett INNER JOIN employee AS e ON e.shift_id=ett.shift_id 
                             WHERE ett.day=' . $day . ' AND e.id=' . $emp_id . ' LIMIT 1';
            $queryCheckWork = mysql_query($sqlCheckWork);
            $rowCheckWork = mysql_fetch_array($queryCheckWork);
            if ($rowCheckWork["is_work_day"] == "Y") {
                $count = $count + 1;
            }
            $sqlCheckHol = 'SELECT ph.id FROM employee AS e INNER JOIN branch AS b ON e.branch_id=b.id 
                            JOIN holiday_for_group AS hfg ON hfg.group_id = b.holi_group_id
                            JOIN public_holiday AS ph ON ph.id=hfg.holiday_id
                            WHERE e.id=' . $emp_id . ' AND ph.from_date <= "' . $checkDate . '" AND ph.to_date >= "' . $checkDate . '"';
            $queryCheckHol = mysql_query($sqlCheckHol);
            $numCheckHol = mysql_num_rows($queryCheckHol);
            if ($numCheckHol > 0) {
                $count = $count - 1;
            }
        }
    } else {
        for ($m = $from_month; $m <= $to_month; $m++) {
            $getMonth[] = cal_days_in_month(CAL_GREGORIAN, $m, $from_year);
        }

        for ($j = 0; $j < count($getMonth); $j++) {
            $countJ = $countJ + 1;
            $month = $getMonth[$j];
            if ($j > 0) {
                $from_day = 1;
                if ($countJ == count($getMonth)) {
                    $month = $to_day;
                } else {
                    $month = $getMonth[$j];
                }
            }
            for ($i = $from_day; $i <= $month; $i++) {
                $to = str_pad($i, 2, "0", STR_PAD_LEFT);
                $checkDate = $from_year . '-' . $from_month . '-' . $to;
                $day = date('N', strtotime($checkDate));

                $sqlCheckWork = 'SELECT ett.day, is_work_day FROM emp_time_table AS ett INNER JOIN employee AS e ON e.shift_id=ett.shift_id 
                             WHERE ett.day=' . $day . ' AND e.id=' . $emp_id . ' LIMIT 1';
                $queryCheckWork = mysql_query($sqlCheckWork);
                $rowCheckWork = mysql_fetch_array($queryCheckWork);
                if ($rowCheckWork["is_work_day"] == "Y") {
                    $count = $count + 1;
                }
                $sqlCheckHol = 'SELECT ph.id FROM employee AS e INNER JOIN branch AS b ON e.branch_id=b.id 
                                JOIN holiday_for_group AS hfg ON hfg.group_id = b.holi_group_id
                                JOIN public_holiday AS ph ON ph.id=hfg.holiday_id
                                WHERE e.id=' . $emp_id . ' AND ph.from_date <= "' . $checkDate . '" AND ph.to_date >= "' . $checkDate . '"';
                $queryCheckHol = mysql_query($sqlCheckHol);
                $numCheckHol = mysql_num_rows($queryCheckHol);
                if ($numCheckHol > 0) {
                    $count = $count - 1;
                }
            }
            $from_month = str_pad(($from_month + 1), 2, "0", STR_PAD_LEFT);
        }
    }
} else {
    $countY = 0;
    for ($y = $from_year; $y <= $to_year; $y++) {
        $getYear[] = $y;
    }
    for ($y = $from_year; $y <= $to_year; $y++) {
        $countY = $countY + 1;
        if ($countY == count($getYear)) {
            $monthY = $to_month;
        } else {
            $monthY = 12;
        }
        if ($countY == 1) {
            $monthYStart = $from_month;
        } else {
            $monthYStart = 1;
        }

        for ($m = $monthYStart; $m <= $monthY; $m++) {
            $countM = $countM + 1;
            $getMonth = cal_days_in_month(CAL_GREGORIAN, $m, $from_year);
            if (($countY == count($getYear)) && ($m == $monthY)) {
                $dayY = $to_day;
            } else {
                $dayY = $getMonth;
            }
            if ($countY == 1) {
                $dayYStart = $from_day;
            } else {
                $dayYStart = 1;
            }
            for ($t = $dayYStart; $t <= $dayY; $t++) {
                $to = str_pad($t, 2, "0", STR_PAD_LEFT);
                $month = str_pad($m, 2, "0", STR_PAD_LEFT);
                $checkDate = $from_year . '-' . $month . '-' . $to;
                $day = date('N', strtotime($checkDate));

                $sqlCheckWork = 'SELECT ett.day, is_work_day FROM emp_time_table AS ett INNER JOIN employee AS e ON e.shift_id=ett.shift_id 
                                 WHERE ett.day=' . $day . ' AND e.id=' . $emp_id . ' LIMIT 1';
                $queryCheckWork = mysql_query($sqlCheckWork);
                $rowCheckWork = mysql_fetch_array($queryCheckWork);
                if ($rowCheckWork["is_work_day"] == "Y") {
                    $count = $count + 1;
                }
                $sqlCheckHol = 'SELECT ph.id FROM employee AS e INNER JOIN branch AS b ON e.branch_id=b.id 
                                JOIN holiday_for_group AS hfg ON hfg.group_id = b.holi_group_id
                                JOIN public_holiday AS ph ON ph.id=hfg.holiday_id
                                WHERE e.id=' . $emp_id . ' AND ph.from_date <= "' . $checkDate . '" AND ph.to_date >= "' . $checkDate . '"';
                $queryCheckHol = mysql_query($sqlCheckHol);
                $numCheckHol = mysql_num_rows($queryCheckHol);
                if ($numCheckHol > 0) {
                    $count = $count - 1;
                }
            }
        }
        $from_year = $from_year + 1;
    }
}

function dateDiff($dateStart, $dateEnd) 
{
    $start = strtotime($dateStart);
    $end = strtotime($dateEnd);
    $days = $end - $start;
    $days = ceil($days/86400);
    return $days;
}

echo dateDiff($starting_date, $ending_date) + 1;
//echo $count;

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>