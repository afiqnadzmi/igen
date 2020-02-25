<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
echo '<option value="" selected="true">--Please Select--</option>';
$query2 = "SELECT * FROM department WHERE branch_id=" . $_POST["branch_id"] . " AND is_active=1";
$rs3 = mysql_query($query2);
$num_rows = mysql_num_rows($rs3);
if ($num_rows > 0) {
    echo '<option value="0">All Departments</option>';
}
while ($row3 = mysql_fetch_array($rs3)) {
    $dep_name = $row3['dep_name'];
    $dep_id = $row3['id'];
    $depid = $_GET['dep_id'];

    if ($dep_id == $depid) {
        echo '<option  value="' . $dep_id . '" selected="selected">' . $dep_name . '</option>';
    } else {
        echo '<option  value="' . $dep_id . '">' . $dep_name . '</option>';
    }
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