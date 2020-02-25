<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$inchage=0;
$quota=0;
if($_POST['emp']!=""){
	$inchage=$_POST['emp'];
}
if($_POST['quota']!=""){
	$quota=$_POST['quota'];
}

$sql = "UPDATE emp_group SET group_name = '" . $_POST['group_name'] . "', dep_id = '" . $_POST['dept'] . "', 
        incharge_emp_id = '" . $inchage . "', g_quota = '" . $quota . "',
        is_active = " . $_POST['groupstatus'] . " WHERE id = " . $_POST['id'];
$sql_result = mysql_query($sql);

$query_update = mysql_query('UPDATE employee SET dep_id = ' . $_POST['dept'] . ' WHERE group_id=' . $_POST['id']);

if ($sql_result && $query_update) {
    print true;
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