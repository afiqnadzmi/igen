<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$position_name = $_POST['position_name'];
$desc = $_POST['desc'];
$epf_rate = $_POST['epf_rate'];
$employer_epf_rate = $_POST['employer_epf_rate'];
$time_attr = $_POST['time_attr'];
$late_cal = $_POST['late_cal'];
if($employer_epf_rate ==""){
	$employer_epf_rate =0;
}
if($epf_rate ==""){
	$epf_rate =0;
}
$sql = 'INSERT INTO position (position_name, position_desc, epf_rate,time_att,late_early,employer_epf_rate) VALUES ("' . $position_name . '", "' . $desc . '", "' . $epf_rate . '","' . $time_attr . '","' . $late_cal . '","' . $employer_epf_rate . '")';
$query = mysql_query($sql);

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