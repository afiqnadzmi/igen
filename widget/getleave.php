<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
//echo 
/* Anaul Leave */
$sql_al = "SELECT sum(num_days) as numdays from employee_leave where (leave_date >='".date('Y-m-d', strtotime($_GET['p_from']))."' and 	leave_date <='".date('Y-m-d', strtotime($_GET['p_to']))."') and emp_id='" .$_GET['emp_id']. "'  and leave_type_id =1 and 	request_status='Approved'";
$rs_al = mysql_query($sql_al);
$row_al = mysql_fetch_array($rs_al);
$data1=$row_al['numdays'];
/* MC Leave */
$sql_mc = "SELECT sum(num_days) as numdays from employee_leave where (leave_date >='".date('Y-m-d', strtotime($_GET['p_from']))."' and leave_date <='".date('Y-m-d', strtotime($_GET['p_to']))."') and emp_id='" .$_GET['emp_id']. "'  and leave_type_id =2 and 	request_status='Approved'";
$rs_mc = mysql_query($sql_mc);
$row_mc = mysql_fetch_array($rs_mc);

/* Unpaid Leave */
$sql_unpaid = "SELECT sum(num_days) as numdays from employee_leave where (leave_date >='".date('Y-m-d', strtotime($_GET['p_from']))."' and leave_date <='".date('Y-m-d', strtotime($_GET['p_to']))."') and emp_id='" .$_GET['emp_id']. "'  and leave_type_id =5 and 	request_status='Approved'";
$rs_unpaid = mysql_query($sql_unpaid);
$row_unpaid = mysql_fetch_array($rs_unpaid);

/* EM Leave */
$sql_el = "SELECT sum(num_days) as numdays from employee_leave where (leave_date >='".date('Y-m-d', strtotime($_GET['p_from']))."' and leave_date <='".date('Y-m-d', strtotime($_GET['p_to']))."') and emp_id='" .$_GET['emp_id']. "'  and leave_type_id =9 and 	request_status='Approved'";
$rs_el = mysql_query($sql_el);
$row_el = mysql_fetch_array($rs_el);

/* Holiday Replacement */
$sql_hr = "SELECT id from holiday_replacement where (insert_date >='".date('Y-m-d', strtotime($_GET['p_from']))."' and insert_date <='".date('Y-m-d', strtotime($_GET['p_to']))."') and emp_id='" .$_GET['emp_id']. "'  and replacement_status='Approved'";
$rs_hr = mysql_query($sql_hr);
$row_hr = mysql_num_rows($rs_hr);

$data = array('al' =>$row_al['numdays'], 'mc' => $row_mc['numdays'], 'unpaid' => $row_unpaid['numdays'], 'em' => $row_el['numdays'], 'hr' => $row_hr);

print json_encode($data);
?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>