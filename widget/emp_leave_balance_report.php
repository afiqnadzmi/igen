<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
include_once "function/db_conn.php";

$emp_id = $_GET['empid'];
$sql1 = "select join_date from employee where id=" . $emp_id;
$rs1 = mysql_query($sql1);
$row1 = mysql_fetch_array($rs1);
$join_date = $row1["join_date"];

$sql = "SELECT lt.id, lt.type_name, y0_y2, y3_y5, y5_above FROM employee e
		left join leave_group lg on lg.group_for_leave_id=e.group_for_leave_id
		left join leave_type lt on lg.leave_type_id=lt.id
		where e.id=" . $emp_id;
$rs = mysql_query($sql);

$work_year = floor((time() - strtotime($join_date)) / (365 * 24 * 60 * 60));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Baiduri HR & Payroll System - Leave Balance Report</title>
    </head>
    <body>
        <div style="padding:10px 50px 10px 50px; width: 700px; height: 900px">
            <div style="border-bottom: 2px solid black;"><h1>Baiduri HR & Payroll System</h1></div>
            <h3 style="text-decoration: underline;">Leave Balance Report</h3>
            <table style="padding-bottom: 20px;">
                <?php
                $sql10 = 'SELECT * FROM employee WHERE id = ' . $_GET['empid'] . ' limit 1';
                $rs10 = mysql_query($sql10);

                while ($row10 = mysql_fetch_array($rs10)) {
                    $emp_id = $row10['id'];
                    //echo $sql10." = '".$emp_id."'";
                    $emp_name = $row10['full_name'];

                    echo '<tr>
                        <th style="text-align: left;">Employee id </th>
                        <td>: <td>
                        <td>EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</td>
                    </tr>
                    <tr>
                        <th style="text-align: left;">Employee name </th>
                        <td>: <td>
                        <td>' . $emp_name . '</td>
                    </tr>';
                }
                while ($row = mysql_fetch_array($rs)) {
                    $year = date('Y');
                    $sql2 = "SELECT count(id) as c FROM employee_leave e where year(from_date)=" . $year . " 
								and leave_type_id='" . $row["id"] . "' and emp_id='" . $emp_id . "'";
                    $rs2 = mysql_query($sql2);
                    $row2 = mysql_fetch_array($rs2);
                    ?>
                    <tr class="tabletr">
                        <th style="width:200px;text-align:left;"><?php echo $row["type_name"]; ?></th>
                        <td>: <td>
                        <td style="width:200px;text-align:left;">
                            <?php echo $row2["c"] ?> / <?php
                        if ($work_year < 2) {
                            echo $row["y0_y2"];
                        } else if ($work_year > 2 && $work_year < 5) {
                            echo $row["y3_y5"];
                        } else if ($work_year > 5) {
                            echo $row["y5_above"];
                        }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <h3 style="text-decoration: underline;">Leave History</h3>

            <table style="border-bottom: 1px solid dimgray;">
                <tr>
                    <th style="width:150px;text-align: left;">Leave Type</th>
                    <th style="width:150px;text-align: left;">From date</th>
                    <th style="width:150px;text-align: left;">To date</th>
                    <th style="width:200px;text-align: left;">Number Of Days</th>
                    <th style="width:200px;text-align: left;">Reason</th>
                    <th style="width:250px;text-align: left;">Leave date</th>
                </tr>    
                <?php
                $year = date('Y');
                $sql3 = 'SELECT * FROM employee_leave el
							left join leave_type lt on el.leave_type_id=lt.id
							WHERE request_status="Approved" and emp_id= ' . $_GET['empid'] . ' and year(to_date)="' . $year . '" ';
                $rs3 = mysql_query($sql3);

                while ($row3 = mysql_fetch_array($rs3)) {
                    $from_date = $row3['from_date'];
                    $to_date = $row3['to_date'];
                    $reason = $row3['reason'];
                    $leave_date = $row3['leave_date'];

                    echo '<tr>	
			<td style="width:200px">' . $row3["type_name"] . '</td>
                        <td style="width:150px">' . $from_date . '</td>
                        <td style="width:150px">' . $to_date . '</td>
						<td style="width:150px">' . $row3["num_days"] . '</td>
                        <td style="width:200px">' . $reason . '</td>
                        <td style="width:150px">' . $leave_date . '</td>
                    </tr>';
                }
                ?>
            </table>
        </div>
    </body>
</html>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>