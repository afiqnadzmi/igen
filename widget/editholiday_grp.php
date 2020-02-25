<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$grp_name = $_POST['grp_name'];
$grp_desc = $_POST['grp_desc'];
$holi_grp_id = $_POST['holi_grp_id'];
$joinid = $_POST['newStr'];

$sql2 = "UPDATE holiday_group SET group_name = '" . $grp_name . "', group_desc = '" . $grp_desc . "' WHERE id = '" . $holi_grp_id . "'";
$query2 = mysql_query($sql2);

$sql3 = "DELETE FROM holiday_for_group WHERE group_id = '" . $holi_grp_id . "'";
$query3 = mysql_query($sql3);

$sql4 = "SELECT * FROM public_holiday WHERE id in(" . $joinid . ")";
$query4 = mysql_query($sql4);
while ($row = mysql_fetch_array($query4)) {
    $id = $row['id'];
    $sql = "INSERT INTO holiday_for_group(group_id,holiday_id) VALUES ('" . $holi_grp_id . "','" . $id . "')";
    $query = mysql_query($sql);
}
if ($query4) {
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