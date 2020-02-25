<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$company = $_POST["company_id"];
$branch = $_POST["branch"];
echo '<option value="">--Please Select--</option>';
if ($branch != "") {
    $sql = 'SELECT id, branch_code FROM branch WHERE id IN (' . $branch . ') AND company_id = ' . $company . ' ORDER BY branch_code';
} else {
    $sql = 'SELECT id, branch_code FROM branch WHERE company_id=' . $company . ' ORDER BY branch_code';
}
$query = mysql_query($sql);
while ($row = mysql_fetch_array($query)) {
    echo '<option value="' . $row["id"] . '">' . $row["branch_code"] . '</option>';
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