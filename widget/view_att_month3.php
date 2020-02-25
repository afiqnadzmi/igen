<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<style type="text/css">
    .tableth th{
        background-color: darkblue;
        color: white;
        padding: 5px 0 5px 20px;
    }
    .tabletr{
        background-color: beige;
        color: black;
    }
    .tabletr td{
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 20px;
    }
</style>
<div style="border: 1px solid black; width: 850px;">
    <table class='tableth bordercollapse' style="width: 100%;">
        <tr>
            <th style="width: 80px;">Date</th>
            <th>Day</th>
            <th style="width: 140px;">In</th>
           <th style="width: 140px;">Out</th>
            <!--<th style="width: 140px;">Lunch (Out)</th>
            <th style="width: 140px;">Lunch (In)</th>-->
        </tr>
        <?php
        $month = $_POST['month'] + 1;
        $year = $_POST['year'];
        $emp_id = $_POST['userid'];
        $day = array(1, 2, 3, 4, 5, 6, 7);
        $days = array("", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");

        $s_sql = 'SELECT e.shift_id, p.late_early FROM employee AS e INNER JOIN position AS p ON p.id=e.position_id where e.id="' . $emp_id . '"';
        $s_rs = mysql_fetch_array(mysql_query($s_sql));
        $shift_id = $s_rs['shift_id'];
        $late_early = $s_rs['late_early'];

        $a_sql = "SELECT * FROM attendance WHERE emp_id='" . $emp_id . "' 
                       AND work_in_date BETWEEN '" . $year . "-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-01'
                       AND '" . $year . "-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-" . date('t', mktime(0, 0, 0, $month, 1, $year)) . "' 
                       GROUP BY work_in_date";
        $a_rs = mysql_query($a_sql);
        $num = mysql_num_rows($a_rs);

        if ($num > 0) {

            while ($a_row = mysql_fetch_array($a_rs)) {
                $date[] = $a_row['work_in_date'];
                $dateDay[] = date('N', strtotime($a_row['work_in_date']));
                $date1[] = $a_row['work_in_time'];
                $date2[] = $a_row['work_out_time'];
                $sqlGet2 = "SELECT * FROM attendance where emp_id='" . $emp_id . "' 
                        AND work_in_date BETWEEN '" . $year . "-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-01'
                        AND '" . $year . "-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-" . date('t', mktime(0, 0, 0, $month, 1, $year)) . "' 
                        AND id > " . $a_row["id"] . "
                        GROUP BY work_in_date LIMIT 1";
                $queryGet2 = mysql_query($sqlGet2);
                $rowGet2 = mysql_fetch_array($queryGet2);
                $dateGet1[] = $rowGet2["work_out_time"];
                $dateGet2[] = $rowGet2["work_in_time"];
            }

            for ($i = 0; $i < count($date); $i++) {
                $sqlCheck1 = 'SELECT * FROM emp_time_table WHERE shift_id=' . $shift_id . ' AND day=' . $dateDay[$i] . ' GROUP BY day';
                $queryCheck1 = mysql_query($sqlCheck1);
                $rowCheck1 = mysql_fetch_array($queryCheck1);

                $checkIn[] = $rowCheck1["from_time"];
                $checkLunchFrom[] = $rowCheck1["to_time"];

                $sqlCheck2 = 'SELECT * FROM emp_time_table WHERE shift_id=' . $shift_id . ' AND day=' . $dateDay[$i] . ' AND id > ' . $rowCheck1["id"] . ' GROUP BY day LIMIT 1';
                $queryCheck2 = mysql_query($sqlCheck2);
                $rowCheck2 = mysql_fetch_array($queryCheck2);

                $checkLunchTo[] = $rowCheck2["from_time"];
                $checkOut[] = $rowCheck2["to_time"];

                if ($date1[$i] > $checkIn[$i]) {
                    $in = ' class="red"';
                } else {
                    $in = '';
                }

                if ($dateGet1[$i] < $checkOut[$i]) {
                    $out = ' class="red"';
                } else {
                    $out = '';
                }

                if ($date2[$i] < $checkLunchFrom[$i]) {
                    if ($late_early == 2) {
                        $lunchin = '';
                    } else {
                        $lunchin = ' class="red"';
                    }
                } else {
                    $lunchin = '';
                }

                if ($dateGet2[$i] > $checkLunchTo[$i]) {
                    if ($late_early == 2) {
                        $lunchout = '';
                    } else {
                        $lunchout = ' class="red"';
                    }
                } else {
                    $lunchout = '';
                }
                echo '<tr class="tabletr"><td>' . $date[$i] . '</td><td>' . $days[$dateDay[$i]] . '</td><td ' . $in . '>' . $date1[$i] . '</td><td ' . $out . '>' . $dateGet1[$i] . '</td></tr>';
				//<td ' . $lunchin . '>' . $date2[$i] . '</td><td ' . $lunchout . '>' . $dateGet2[$i] . '</td> //Remove
            }
        } else {
            echo '<tr class="tabletr"><td colspan="5">-- No Record --</td></tr>';
        }
        ?>
    </table>
</div>	

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>