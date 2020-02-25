<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$type=$_POST['type'];
$date_report=date("Y-m-d", strtotime($_POST['date_report']));
$name=$_POST['name'];
$added=$_POST['added'];
$date=date("Y-m-d", strtotime($_POST['date']));
$datetime=date("Y-m-d H:i:s", strtotime($_POST['datetime']));
$incident_happen=$_POST['incident_happen'];
$location=$_POST['location'];
$date_time=date("Y-m-d H:i:s", strtotime($_POST['date_time']));
$inc_desc=$_POST['inc_desc'];
$dangerous=$_POST['dangerous'];

$emp_id=$_POST['emp_id'];
$uploaded_img=$_POST['uploaded_img'];
$sql = 'INSERT INTO incident_detail(emp_id, type, date_report, name, added, date, datetime,incident_happen, location,date_time,inc_desc,dangerous,photo)
            VALUES
            ("' . $emp_id. '", "' . $type . '","' . $date_report . '","' .$name . '","' .$added .'","'. $date .'","'. $datetime . '","'. $incident_happen. '",
			"'. $location . '","' . $date_time . '","' . $inc_desc . '","' . $dangerous. '","' . $uploaded_img. '")';

$query=mysql_query($sql);
if ($query) {
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