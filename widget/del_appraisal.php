<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$occdelete = $_POST['occid'];
$action = $_POST['action'];
$occdelete1 = $_POST['occid1'];
$occdelete_q = $_POST['occid_q'];
$sub_old=$_POST['sub_old'];
$group=$_POST['a_group'];

if($action=="q"){
$sql = "DELETE FROM appraisal_group WHERE id='" . $occdelete . "';";
$query = mysql_query($sql);
}else if($action=="f"){
	$sql_form = "DELETE FROM  performance_forms WHERE id='" . $occdelete1 . "';";
	$sql_cycle = "DELETE FROM  appraisal_cycle WHERE form_id='" . $occdelete1 . "';";
	$sql_q = "DELETE FROM  appraisal_questions WHERE form_id='" . $occdelete1 . "';";
	$sql_r = "DELETE FROM  rating WHERE r_form='" . $occdelete1 . "';";
	$sql_g = "DELETE FROM appraisal_group WHERE form_id='" . $occdelete1. "';";
	$sql_sg = "DELETE FROM  sub_group WHERE form_id='" . $occdelete1. "';";
	$query = mysql_query($sql_form);
	$sql_cycle = mysql_query($sql_cycle);
	$sql_q = mysql_query($sql_q);
	$sql_r = mysql_query($sql_r);
	$sql_g = mysql_query($sql_g);
	$sql_sg = mysql_query($sql_sg);
}else if($action=="qu"){
	$sql = "DELETE FROM  appraisal_questions WHERE id='" . $occdelete_q . "';";
	$query = mysql_query($sql);
}else if($action=="sub"){
	$sql = "DELETE FROM  sub_group WHERE id='" . $sub_old. "';";
	$query = mysql_query($sql);
}else if($action=="group"){
	$sql = "DELETE FROM appraisal_group WHERE id='" . $group. "';";
	$sql = "DELETE FROM  sub_group WHERE group_id='" . $group. "';";
	$query = mysql_query($sql);
}
if ($query) {
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