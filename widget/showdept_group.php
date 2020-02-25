<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

echo "<option value=''>--Please Select--</option>";
$sql = "SELECT d.id,d.dep_name,b.branch_code 
        FROM department d left join branch b on d.branch_id=b.id 
        WHERE d.is_active=1 AND b.company_id = " . $_POST["company_id"] . " 
        ORDER BY b.branch_code, d.dep_name";
$sql_result = mysql_query($sql);
while ($newArray = mysql_fetch_array($sql_result)) {
    echo"<option value='" . $newArray['id'] . "'>" . $newArray['branch_code'] . " - " . $newArray['dep_name'] . "</option>";
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