<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<style type="text/css">
    #emp_trans td{
        vertical-align: top;
        padding-bottom: 5px;
    }
    .title_bold{
        font-weight: bold;
    }
</style>
<?php

$sql = 'SELECT e.full_name, et.ori_group, et.transfer_group, et.from_date, et.to_date FROM employee_transfer AS et
        INNER JOIN employee AS e
        ON e.id = et.emp_id
        WHERE et.id = ' . $_POST["trans_id"];
$query = mysql_query($sql);
$row = mysql_fetch_array($query);
echo '<table id="emp_trans">';

echo '<tr><td class="title_bold" style="width: 120px;">Employee</td><td>' . $row["full_name"] . '</td></tr>';

$sql1 = 'SELECT d.dep_name, eg.group_name FROM emp_group AS eg INNER JOIN department AS d ON d.id = eg.dep_id WHERE eg.id = ' . $row["ori_group"];
$query1 = mysql_query($sql1);
$row1 = mysql_fetch_array($query1);
echo '<tr><td class="title_bold">Originally From</td><td>' . $row1["dep_name"] . ' (' . $row1["group_name"] . ')</td></tr>';

$sql2 = 'SELECT d.dep_name, eg.group_name FROM emp_group AS eg INNER JOIN department AS d ON d.id = eg.dep_id WHERE eg.id = ' . $row["transfer_group"];
$query2 = mysql_query($sql2);
$row2 = mysql_fetch_array($query2);
echo '<tr><td class="title_bold">Transfer To</td><td>' . $row2["dep_name"] . ' (' . $row2["group_name"] . ')</td></tr>';

echo '<tr><td class="title_bold">From Date</td><td>' . $row["from_date"] . '</td></tr>';
echo '<tr><td class="title_bold">To Date</td><td>' . $row["to_date"] . '</td></tr>';

echo '</table>';
?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>