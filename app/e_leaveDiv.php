<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
if (isset($_COOKIE["igen_user_id"]) == true) {
    $emp_id = $_COOKIE["igen_user_id"];
}
$sql1 = "select join_date, group_for_leave_id from employee where id=" . $emp_id;
$rs1 = mysql_query($sql1);
$row1 = mysql_fetch_array($rs1);
$join_date = $row1["join_date"];
$group_for_leave_id = $row1["group_for_leave_id"];

//search employee got what kind of leave
$sql = "SELECT distinct(lt.id), lt.type_name FROM employee e
        inner join leave_group lg on lg.group_for_leave_id=e.group_for_leave_id
		inner join leave_type lt on lg.leave_type_id=lt.id
	where e.id=" . $emp_id;
$rs = mysql_query($sql);

$work_year = floor((time(date("Y-m-d")) - strtotime($join_date)) / (365 * 24 * 60 * 60));
?>
<div style="padding-bottom: 5px;">
    <div id="tableLeave" style="width:97%;border:solid;border-color:lightgrey;padding: 8px 10px 10px 10px;">
        <!--<div style="padding-bottom: 5px;"><input class="button" type="button" value="Print" onclick="print(<?php echo $getID ?>)"/></div>-->
        <table style="border-collapse: collapse;" >
            <thead>
                <tr class="tableth">
                    <th style="width: 300px;">Type of Leave</th>
                    <th colspan="2" style="width: 150px; text-align: center;">Amount (Day)</th>
                </tr>
            </thead>
            <?php
            while ($row = mysql_fetch_array($rs)) {
                $year = date('Y');
                $sql2 = "SELECT sum(num_days) as c FROM employee_leave e where request_status='Approved' 
                        and year(from_date)=" . $year . " 
			and leave_type_id='" . $row["id"] . "' and emp_id='" . $emp_id . "'";
                $rs2 = mysql_query($sql2);
                if ($rs2 && mysql_num_rows($rs2) > 0) {
                    $row2 = mysql_fetch_array($rs2);
                    if (!is_null($row2['c'])) {
                        $sum_leave = $row2['c'];
                    } else {
                        $sum_leave = 0;
                    }
                } else {
                    $sum_leave = 0;
                }

                $sql3 = "SELECT days FROM leave_group l
                        where from_year<=" . $work_year . " and to_year>" . $work_year . "
			and leave_type_id='" . $row["id"] . "'
			and group_for_leave_id=" . $group_for_leave_id;
                $rs3 = mysql_query($sql3);

                if ($rs3 && mysql_num_rows($rs3) > 0) {
                    $row3 = mysql_fetch_array($rs3);
                    $days = $row3['days'];
                } else {
                    $days = 0;
                }
                ?>
                <tr class="tabletr">
                    <td><?php echo $row["type_name"]; ?></td>
                    <td style="text-align: right;"><?php echo $sum_leave ?></td>
                    <td> / <?php echo $days ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>