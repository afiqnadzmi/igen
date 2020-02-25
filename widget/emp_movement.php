<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$this_date = isset($_GET["this_date"]) ? $_GET["this_date"] : "";

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
<div class="rounded_corners" id="choosetemplate" style='position:absolute;z-index:1000;top:160px;background-color:white;border:10px solid #C4C4C7;margin-left:150px;width:500px;height:325px;'>
    <div style="padding:5px;width:490px;color:black;height:25px;">
        <span style='float:left;font-size:13px;font-weight:bold;width:300px'>Employee's Movement on <?php echo $this_date ?></span>
        <input class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: dimgrey;" type="button" value="X" onclick="closetemplate()" />
    </div>
    <div style='overflow:auto;width:500px;height:300px;'>
        <?php
        $sql = "SELECT e.id,el.num_hours, e.full_name as fn, from_time, movement_type, to_time,DATEDIFF(to_time,from_time) as dd FROM employee_movement1 el
                join employee e on el.emp_id=e.id
		where request_status='Approved' and (from_time='" . $this_date . "' or to_time='" . $this_date . "' or (from_time<'" . $this_date
                . "' and to_time>'" . $this_date . "'))" . $sqlAdd;
        $rs = mysql_query($sql);
        if ($rs && mysql_num_rows($rs) > 0) {
            ?>
            <div id="mainContainer_left">
                <div class="mainContainer_left_inner" align="left">
                    <table style="width:100%;border-collapse:collapse">
                        <tr style="background-color:#2E4F9E; color: #ffffff; font-weight: bold;">
                            <td style="padding-left: 10px;">No.</td>
                            <td>Full Name</td>
							 <td>Movement Type</td>
                            <td>From</td>
                            <td>To</td>
                            <td>Day(s)</td>
                        </tr>
                        <?php
                        $i = 1;
                        while ($row = mysql_fetch_array($rs)) {
                            ?>
                            <tr>
                                <td style="padding-left: 10px;">&nbsp;<?php echo $i ?></td>
                                <td><?php echo $row["fn"]; ?></td>
								<td><?php echo $row["movement_type"]; ?></td>
                                <td><?php echo $row["from_time"]; ?></td>
                                <td><?php echo $row["to_time"]; ?></td>
                                <td><?php echo $row["num_hours"]; ?></td>
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
            echo "No employee apply Movement on " . $this_date;
        }
        ?>
        <div style="clear:both;"></div>
    </div>
</div>
<script type="text/javascript">
    function closetemplate(){
        $("#choosetemplate").remove();
    }
</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>