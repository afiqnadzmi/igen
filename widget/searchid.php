<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
/* Check user_permission_view if restricted access permission */
if (isset($_COOKIE["igen_user_id"]) == true) {
    $queryView = mysql_query('SELECT upv.branch_id FROM user_permission AS up
                    INNER JOIN employee AS e ON e.level_id = up.id
                    JOIN user_permission_view AS upv ON upv.user_permission_id = up.id
                    WHERE e.id=' . $_COOKIE['igen_user_id']);
    $rowView = mysql_fetch_array($queryView);
    $igen_branchlist = $rowView["branch_id"];
    if ($igen_branchlist != "") {
        $sqlAdd = ' AND emp.branch_id IN (' . $igen_branchlist . ')';
    }
}
?>
<div style="padding-bottom: 15px;">
    <div class="tablecolor">
        <table>
            <tr class="tableth">
                <th style="width:100px; text-align: center;">Employee ID</th>
                <th>Employee name</th>
                <th style="width:220px;">Department name</th>
                <th style="width:170px;">Group name</th>
                <th style="width: 100px; text-align: center;">Select</th>
            </tr>

            <?php
            $emp_name = $_POST['emp_name'];
            $sql = "SELECT * , emp.id as empid
            FROM employee as emp
            inner join emp_group as grp
            on emp.group_id = grp.id
            join department as dep
            on dep.id = grp.dep_id
            WHERE full_name like '%" . $emp_name . "%'" . $sqlAdd;

            $rs = mysql_query($sql);

            if ($rs) {
                while ($row = mysql_fetch_array($rs)) {
                    $fullname = $row['full_name'];
                    $empid = $row['empid'];
                    $dep_name = $row['dep_name'];
                    $group_name = $row['group_name'];

                    echo '<tr class="tabletr">
                        <td>' . $empid . '</td>
                        <td>' . $fullname . '</td>
                        <td>' . $dep_name . '</td>
                        <td>' . $group_name . '</td>
                        <td style="text-align: center;"><input type="checkbox" id="checkid' . $empid . '" value=' . $empid . ' name="emp' . $empid . '" " /></td>
                    <tr>';
                }
                ?>
            </table>
        </div>    
    </div>
    <?php
} else {
    print false;
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