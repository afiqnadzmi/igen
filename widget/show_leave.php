<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$month = isset($_GET["this_month"]) ? $_GET["this_month"] : "";
$year = isset($_GET["this_year"]) ? $_GET["this_year"] : "";

/* Check user_permission_view if restricted access permission */
if (isset($_COOKIE["igen_user_id"]) == true) {
    $queryView = mysql_query('SELECT upv.branch_id FROM user_permission AS up
                    INNER JOIN employee AS e ON e.level_id = up.id
                    JOIN user_permission_view AS upv ON upv.user_permission_id = up.id
                    WHERE e.id=' . $_COOKIE['igen_user_id']);
    $rowView = mysql_fetch_array($queryView);
    $igen_branchlist = $rowView["branch_id"];
    if ($igen_branchlist != "") {
        $sqlAdd = ' AND e.branch_id IN (' . $igen_branchlist . ')';
    }
}
?>
<div id="show_leave_monthly" class="rounded_corners" style="border:5px solid #C4C4C7;width:400px;min-height:500px;padding:5px">
    <div style="padding-left:10px;width:390px;color:black;height:25px;">
        <span style='float:left;font-size:13px;font-weight:bold;width:300px'>Employee's Leaves on <?php echo date("M Y", mktime(0, 0, 0, $month + 1, 0, $year)); ?></span>
        <span style='float:right;cursor:pointer;padding-right: 7px;' onclick="$('#show_leave_monthly').remove()">Hide</span>
    </div>
    <div style='overflow:auto;width:400px;'>
        <?php
        $sql = "SELECT e.id,el.num_days, e.full_name as fn, from_date, to_date,DATEDIFF(to_date,from_date) as dd
                FROM employee_leave el
		join employee e on el.emp_id=e.id
		WHERE request_status='Approved' and (MONTH(from_date) = " . $month . " or  MONTH(to_date) = " . $month . ")
		and (year(from_date) = " . $year . " or  year(to_date) = " . $year . ")" . $sqlAdd;
        $rs = mysql_query($sql);
        if ($rs && mysql_num_rows($rs) > 0) {
            ?>
            <div id="mainContainer_left">
                <div class="mainContainer_left_inner" align="left" style="">
                    <table style="width:100%;border-collapse:collapse">
                        <tr style="background-color:#2E4F9E; color: #ffffff; font-weight: bold;">
                            <td style="padding-left: 10px;">No.</td>
                            <td>Full Name</td>
                            <td>From&nbsp;</td>
                            <td>To&nbsp;</td>
                            <td>Day(s)</td>
                        </tr>
                        <?php
                        $i = 1;
                        while ($row = mysql_fetch_array($rs)) {
                            ?>
                            <tr>
                                <td style="padding-left: 10px;">&nbsp;<?php echo $i ?></td>
                                <td><?php echo $row["fn"]; ?></td>
                                <td><?php echo $row["from_date"]; ?></td>
                                <td><?php echo $row["to_date"]; ?></td>
                                <td><?php echo $row["num_days"]; ?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        <tr>
                            <td colspan="5">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php
        } else {
            echo "No employee apply leave on " . date("M Y", mktime(0, 0, 0, $month + 1, 0, $year));
        }
        ?>
        <div style="clear:both;"></div>
    </div>
    <script type="text/javascript">
        function closetemplate(){
            $("#choosetemplate").remove();
        }
    </script>
</div>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>