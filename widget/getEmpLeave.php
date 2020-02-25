<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

echo '<option value="">--Please Select--</option>';
$sql = 'select distinct(lt.id),lt.* from leave_group lg
			left join leave_type lt on lg.leave_type_id=lt.id
			left join employee e on e.group_for_leave_id=lg.group_for_leave_id
			where e.id="' . $_POST['emp_id'] . '" ORDER BY lt.type_name';
$result = mysql_query($sql);

$sql1 = "SELECT balance_annual_leave,position_id, DATEDIFF(CURDATE(),join_date) AS join_date 
			FROM employee WHERE id=('" . $_POST['emp_id'] . "');";
$sql_result1 = mysql_query($sql1);
$newArray1 = mysql_fetch_array($sql_result1);
while ($newArray = mysql_fetch_array($result)) {
    echo '<option value="' . $newArray['id'] . '">' . $newArray['type_name'] . '</option>';
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