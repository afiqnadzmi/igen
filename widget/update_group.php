<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

$gn = $_POST['gn'];
$gid = $_POST['gid'];
$str = substr($_POST['str'], 0, -1);

$sql = "update group_for_leave set group_name='" . $gn . "' where id='" . $gid . "'";
$query = mysql_query($sql);

$sql1 = "delete from leave_group where group_for_leave_id='" . $gid . "'";
mysql_query($sql1);

$str_arr = explode(";", $str);
foreach ($str_arr as $s) {
    $s_arr = explode(",", $s);
    $id = $s_arr[0];
    $fy = $s_arr[1];
    $ty = $s_arr[2];
    $day = $s_arr[3];
    $sql2 = "INSERT INTO leave_group(leave_type_id, from_year, to_year, days, group_for_leave_id)
             VALUES ('" . $id . "','" . $fy . "','" . $ty . "','" . $day . "','" . $gid . "')";
    mysql_query($sql2);
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