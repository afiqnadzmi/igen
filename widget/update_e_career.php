<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$id = isset($_POST['id']) ? $_POST['id'] : "";
$selectpos = isset($_POST['selectpos']) ? $_POST['selectpos'] : "";
$selectdep = isset($_POST['selectdep']) ? $_POST['selectdep'] : "";
$requirement = isset($_POST['requirement']) ? $_POST['requirement'] : "";
$expectation = isset($_POST['expectation']) ? $_POST['expectation'] : "";
$salary = isset($_POST['salary']) ? $_POST['salary'] : "";
$salary1 = number_format($salary, 2, '.', '');

$sql = "UPDATE employee_career SET position_available = " . $selectpos . ", department = " . $selectdep . ",requirement = '" . $requirement . "', 
        expectation = '" . $expectation . "',salary = '" . $salary1 . "' WHERE id = '" . $id . "'";
$rs = mysql_query($sql);
if ($rs) {
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