<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$id=$_GET['id'];

$sql= "select e.*, d.dep_name, p.position_name from employee e inner join department d on e.dep_id=d.id inner join position p on e.position_id=p.id where e.id=".$id;
$sql_result = mysql_query($sql);
$rs = mysql_fetch_array($sql_result);

/* Calculate Month based on employee join date*/
$current_date = new DateTime(date('Y-m-d'));
$join_date = new DateTime($rs['join_date']);
$interval = date_diff($current_date, $join_date);
$month = $interval->m;
if($interval->y > 1){
	$year = $interval->y." Years and ";
}
$join_in_month= $year." ".$month.' Months';
/*End*/

$data = array('data1' => $rs['gender'], 'data2' => $rs['dob'], 'data3' => $rs['dep_name'], 'data4' => $rs['position_name'], 'data5' => $rs['is_contract'], 'data6' => $join_in_month, 'data7' => $rs['id']);
print json_encode($data);
?>
  