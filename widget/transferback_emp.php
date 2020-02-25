<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$et_id = $_POST["et_id"];
$emp_id = $_POST["emp_id"];
$ori_group = $_POST["ori_group"];
$dep_id=$_POST["dep_id"];

$sql = 'UPDATE employee SET group_id = ' . $ori_group . ', dep_id='.$dep_id.' WHERE id = ' . $emp_id;
$query = mysql_query($sql);

$sql1 = 'UPDATE employee_transfer SET is_transfer_back = 1 WHERE id = ' . $et_id;
$query1 = mysql_query($sql1);

if ($query && $query1) {
    echo true;
} else {
    echo false;
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