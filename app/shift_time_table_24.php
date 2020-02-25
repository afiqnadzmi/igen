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
<br><br>
<div class="main_div" style="width:auto !important;">
    <br/>
    <div class="tablediv" style="padding-top: 10px;">
        <table id="time_table" style="width:1000px;">
            <tr>
                <th style="width:150px;"></th>
                <th style="width:150px;text-align: center;">In</th>
                <th style="width:150px;text-align: center;">Out</th>
                <th style="width:50px;"></th>
                <th style="width:150px;text-align: center; display:none">Lunch From</th>
                <th style="width:150px;text-align: center; display:none">Lunch To</th>
            </tr>
            <?php
            $t1 = 1;
            $t2 = 2;
            $num_rows = 7;

            if (isset($_GET["id"]) == true) {
                $id = $_GET["id"];
            } elseif (isset($_GET["view_id"]) == true) {
                $id = $_GET["view_id"];
            }

            for ($i = 1; $i <= $num_rows; $i++) {
                $sql1 = 'SELECT * FROM emp_time_table WHERE `day` = ' . $i . ' and shift_id="' . $id . '"';
                $query1 = mysql_query($sql1);
                $row1 = mysql_fetch_array($query1);

                $sql = 'SELECT (SELECT from_time FROM emp_time_table WHERE id = ' . $row1["id"] . ' and day = ' . $i . ' and shift_id="' . $id . '") AS time_in, 
						(SELECT to_time FROM emp_time_table WHERE id > ' . $row1["id"] . ' and day = ' . $i . ' and shift_id="' . $id . '") AS time_out, 
						(SELECT to_time FROM emp_time_table WHERE id = ' . $row1["id"] . ' and day = ' . $i . ' and shift_id="' . $id . '") AS lunch_from, 
						(SELECT from_time FROM emp_time_table WHERE id > ' . $row1["id"] . ' and day = ' . $i . ' and shift_id="' . $id . '") AS lunch_to';
                $query = mysql_query($sql);
                $row = mysql_fetch_array($query);

                $array_time_in = explode(":", $row["time_in"]);
                $array_time_out = explode(":", $row["time_out"]);
                $array_lunch_from = explode(":", $row["lunch_from"]);
                $array_lunch_to = explode(":", $row["lunch_to"]);

                $time_in_h = $array_time_in[0];
                $time_out_h = $array_time_out[0];
                $lunch_from_h = $array_lunch_from[0];
                $lunch_to_h = $array_lunch_to[0];

                $time_in_m = $array_time_in[1];
                $time_out_m = $array_time_out[1];
                $lunch_from_m = $array_lunch_from[1];
                $lunch_to_m = $array_lunch_to[1];
                ?>
                <tr>
                    <td class="bold"><?php echo $date[$i - 1] ?></td>
                    <td style="text-align: center;">
                        <select id="from1_h<?php echo $t1 ?>">
                            <?php
                            for ($hi = 0; $hi <= 23; $hi++) {
                                $selected = "";
                                $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                if ($time_in_h == $hour) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                            }
                            ?>
                        </select>:<select id="from1_m<?php echo $t1 ?>">
                            <?php
                            for ($ti = 0; $ti <= 55; $ti = $ti + 5) {
                                $selected = "";
                                $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                if ($time_in_m == $minute) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td style="text-align: center;">
                        <select id="to2_h<?php echo $t2 ?>">
                            <?php
                            for ($hi = 0; $hi <= 23; $hi++) {
                                $selected = "";
                                $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                if ($time_out_h == $hour) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                            }
                            ?>
                        </select>:<select id="to2_m<?php echo $t2 ?>">
                            <?php
                            for ($ti = 0; $ti <= 55; $ti = $ti + 5) {
                                $selected = "";
                                $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                if ($time_out_m == $minute) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td>&nbsp;</td>
                    <td style="text-align: center; display:none">
                        <select id="to1_h<?php echo $t1 ?>">
                            <?php
                            for ($hi = 0; $hi <= 23; $hi++) {
                                $selected = "";
                                $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                if ($lunch_from_h == $hour) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                            }
                            ?>
                        </select>:<select id="to1_m<?php echo $t1 ?>">
                            <?php
                            for ($ti = 0; $ti <= 55; $ti = $ti + 5) {
                                $selected = "";
                                $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                if ($lunch_from_m == $minute) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td style="text-align: center; display:none">
                        <select id="from2_h<?php echo $t2 ?>">
                            <?php
                            for ($hi = 0; $hi <= 23; $hi++) {
                                $selected = "";
                                $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                if ($lunch_to_h == $hour) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                            }
                            ?>
                        </select>:<select id="from2_m<?php echo $t2 ?>">
                            <?php
                            for ($ti = 0; $ti <= 55; $ti = $ti + 5) {
                                $selected = "";
                                $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                if ($lunch_to_m == $minute) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <?php
                $t1 = $t1 + 2;
                $t2 = $t2 + 2;
            }
            ?>
        </table>
    </div>
</div>

<?php

function reformat_time_hour($time) {
    $time_arr = explode(":", $time);
    if ($time_arr[0] == 24 || $time_arr[0] < 12) {
        $is_afternoon = 0;
    } else {
        $is_afternoon = 1;
    }

    if ($time_arr[0] == 24) {
        $hour = 12;
    } else if ($time_arr[0] > 12 && $time_arr[0] < 24) {
        $hour = $time_arr[0] % 12;
    } else if ($time_arr[0] < 12) {
        $hour = $time_arr[0];
    }
    return $hour . "/" . $is_afternoon;
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