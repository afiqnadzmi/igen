<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$date = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
?>
<div id="timeDiv" style="padding-left: 20px; padding-top: 20px;">
    <table border="0">
        <tr>
            <th style="width: 200px;"></th>
            <th style="width:150px; text-align: center;">IN</th>
            <th style="width:150px; text-align: center;">OUT</th>
            <th style="width:50px;"></th>
            <th style="width:150px; text-align: center;">Lunch From</th>
            <th style="width:150px; text-align: center;">Lunch To</th>
        </tr>
        <?php
        for ($i = 1; $i <= 7; $i++) {
            $sql = 'SELECT from_time,to_time FROM emp_time_table e 
					where shift_id=(SELECT shift_id FROM employee e where id=' . $getID . ') and `day`=' . $i;
            $query = mysql_query($sql);
            ?>
            <tr>
                <td><?php echo $date[$i - 1] ?></td>
                <?php
                $j = 0;
                $part1 = "";
                $part2 = "";
                while ($row = mysql_fetch_array($query)) {
                    if ($j % 2 == 0) {
                        $part1.="<td style='text-align: center;'>" . format_time($row["from_time"]) . "</td>";
                        $part2.="<td style='text-align: center;'>" . format_time($row["to_time"]) . "</td>";
                    } else {
                        $part1.="<td style='text-align: center;'>" . format_time($row["to_time"]) . "</td><td></td>";
                        $part2.="<td style='text-align: center;'>" . format_time($row["from_time"]) . "</td>";
                    }
                    ++$j;
                }
                echo $part1 . $part2;
                ?>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
<?php

function format_time($time) {
    $t = substr($time, 0, -3);
    $t_arr = explode(":", $t);
    if ((int) $t_arr[0] < 12 && $t != "00:00") {
        return $t_arr[0] . ":" . $t_arr[1];
    } else if ((int) $t_arr[0] == 24) {
        return "00:" . $t_arr[1];
    } else {
        if ($t == "00:00") {
            return "-";
        } else {
            return $t_arr[0] . ":" . $t_arr[1];
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