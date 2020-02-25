<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$action=$_POST['action'];
$emp_id=$_POST['userid'];

if($action=="1"){
$sql_result = mysql_query("DELETE FROM incident_detail WHERE id = '" . $_POST['id'] . "'");

if ($sql_result == 1) {

  print "'?loc=incident_management&emp_id=".$emp_id;
} else {
    print false;
}

}else if($action=="2"){

$sql_result = mysql_query("DELETE FROM injury_details  WHERE id = '" . $_POST['id'] . "'");
if ($sql_result == 1) {
  print "?loc=incident_management&emp_id=".$emp_id;
} else {
    print false;
}
}else if($action=="3"){

$sql_result = mysql_query("DELETE FROM injury_management  WHERE id = '" . $_POST['id'] . "'");
if ($sql_result == 1) {
    print "?loc=incident_management&emp_id=".$emp_id;
} else {
    print false;
}
}
?>
