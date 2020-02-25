<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$sql = "SELECT * FROM employee e where shift_id =" . $_POST['id'];
$rs = mysql_query($sql);
if (mysql_num_rows($rs) > 0) {
    echo "Delete not allowed. Some employee is still using this shift. Please change the employee shift first before delete.";
} else {
    $sql1 = "DELETE FROM shift WHERE id =" . $_POST['id'] . ";";
    $sql_result1 = mysql_query($sql1);

    $sql2 = "DELETE FROM emp_time_table WHERE shift_id =" . $_POST['id'] . ";";
    $sql_result2 = mysql_query($sql2);

    if ($sql_result2) {
        echo true;
    } else {
        echo false;
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