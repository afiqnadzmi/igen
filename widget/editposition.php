<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$employer_epf_rate = $_POST['employer_epf_rate'];
$epf_rate = $_POST['epf_rate'];
if($employer_epf_rate ==""){
	$employer_epf_rate =0;
}
if($epf_rate ==""){
	$epf_rate =0;
}
$sql = "UPDATE position SET position_name='" . $_POST['position_name'] . "', position_desc='" . $_POST['desc'] . "',epf_rate='" .$epf_rate . "',
        time_att='" . $_POST['time_attr'] . "',late_early='" . $_POST['late_cal'] . "',employer_epf_rate='" . $employer_epf_rate . "' 
        WHERE id='" . $_POST['pos_id'] . "'";
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