<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

$leave_id = $_POST["leave_id"];
$list = $_POST["list"];
$getList = explode(",", $list);

for ($i = 0; $i < count($getList); $i++) {
    $sql1 = 'SELECT lg.*, lt.type_name FROM leave_group AS lg RIGHT JOIN leave_type AS lt
             ON lt.id = lg.leave_type_id WHERE lg.leave_type_id=' . $getList[$i] . ' 
             AND lg.group_for_leave_id = ' . $leave_id . ' ORDER BY lt.type_name, lg.from_year';
    $query1 = mysql_query($sql1);
    $num1 = mysql_num_rows($query1);
    $num = 1;
    if ($num1 > 0) {
        while ($row1 = mysql_fetch_array($query1)) {
            echo "<tr name='leave_row' style='background-color: beige; color: black;'>";
            if ($num > 1) {
                echo "<td style='padding-left: 10px;'><input name='tid' value='" . $row1['leave_type_id'] . "' type='hidden' /></td>";
            } else {
                echo "<td style='padding-left: 10px;'>" . $row1['type_name'] . "<input name='tid' value='" . $row1['leave_type_id'] . "' type='hidden' /></td>";
            }
            echo "<td style='padding-left: 10px;'><input name='fy' type='text' value='" . $row1['from_year'] . "' /></td>
              <td style='padding-left: 10px;'><input name='ty' type='text' value='" . $row1['to_year'] . "' /></td>
              <td style='padding-left: 10px;'><input name='days' type='text' value='" . $row1['days'] . "' /></td>
              <td style='padding-left: 10px;'><input type='button' value=' + ' onclick='addrow(this," . $row1['leave_type_id'] . ")' name='addr' /></td>
              </tr>";
            $num = $num + 1;
        }
    } else {
        $query2 = mysql_query('SELECT id, type_name FROM leave_type WHERE id=' . $getList[$i]);
        $row2 = mysql_fetch_array($query2);
        echo "<tr name='leave_row' style='background-color: beige; color: black;'>
              <td style='padding-left: 10px;'>" . $row2['type_name'] . "<input name='tid' value='" . $row2['id'] . "' type='hidden' /></td>
              <td style='padding-left: 10px;'><input name='fy' type='text' value='0' /></td>
              <td style='padding-left: 10px;'><input name='ty' type='text' value='0' /></td>
              <td style='padding-left: 10px;'><input name='days' type='text' value='0' /></td>
              <td style='padding-left: 10px;'><input type='button' value=' + ' onclick='addrow(this," . $row2['id'] . ")' name='addr' /></td>
              </tr>";
    }
}

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>