<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

$gn = $_POST['gn'];
$str = substr($_POST['str'], 0, -1);

$sql = "INSERT INTO group_for_leave(group_name)VALUE('" . $gn . "')";
$query = mysql_query($sql);
$gid = mysql_insert_id();

$str_arr = explode(";", $str);
foreach ($str_arr as $s) {
    $s_arr = explode(",", $s);
    $id = $s_arr[0];
    $fy = $s_arr[1];
    $ty = $s_arr[2];
    $day = $s_arr[3];
    $sql1 = "INSERT INTO leave_group(leave_type_id, from_year, to_year, days, group_for_leave_id)
				VALUE('" . $id . "','" . $fy . "','" . $ty . "','" . $day . "','" . $gid . "')";
    mysql_query($sql1);
}

if ($query) {
    echo true;
} else {
    echo false;
}

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>