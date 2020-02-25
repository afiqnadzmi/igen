<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$deptId = $_POST['dept_id'];
$sqlgroup = mysql_query('SELECT * FROM emp_group WHERE dep_id=' . $deptId . ' AND is_active = 1 ORDER BY group_name');

if ($deptId != '0') {
    if ($sqlgroup) {
        echo '<select id="dropGroup" style="width:250px;">
              <option value="0">--Please Select--</option>';
        while ($rowgroup = mysql_fetch_array($sqlgroup)) {
            echo '<option value="' . $rowgroup['id'] . '">' . $rowgroup['group_name'] . '</option>';
        }
        echo '</select>';
    } else {
        print false;
    }
} else {
    if ($sqlgroup) {
        echo '<select id="dropGroup" style="width:250px;">
              <option value="0" selected="selected">--Please Select--</option>
              </select>';
    } else {
        print false;
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