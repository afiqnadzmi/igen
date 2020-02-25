<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$career_id = isset($_POST['career_id']) ? $_POST['career_id'] : "";

$sql = 'SELECT * FROM employee_career WHERE id=' . $career_id . '';
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs);

$position_available = $row['position_available'];
$department = $row['department'];
$requirement = $row['requirement'];
$expectation = $row['expectation'];
$salary = $row['salary'];
$career_id = $row['id'];

$sqlPos = "SELECT id,position_name FROM position WHERE position_name = '" . $position_available . "'";
$rsPos = mysql_query($sqlPos);
$rowPos = mysql_fetch_array($rsPos);

$sqlDep = "SELECT id,dep_name FROM department WHERE dep_name = '" . $department . "'";
$rsDep = mysql_query($sqlDep);
$rowDep = mysql_fetch_array($rsDep);

print $career_id . "," . $rowPos['id'] . "," . $rowDep['id'] . "," . $requirement . "," . $expectation . "," . $salary;
?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>