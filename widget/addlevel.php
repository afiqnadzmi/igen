<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$name = $_POST['name'];
$dash = $_POST['dash'];
$a_hr = $_POST['a_hr'];
$a_pr = $_POST['a_pr'];
$a_ea = $_POST['a_ea'];
$a_ps = $_POST['a_ps'];
$a_m = $_POST['a_m'];
$a_r = $_POST['a_r'];
$e_ep = $_POST['e_ep'];
$e_ea = $_POST['e_ea'];
$e_ir = $_POST['epr'];
$branch = $_POST['branch'];
$company = $_POST['company'];
$appraisal = $_POST['appraisal'];
$str=$_POST['str'];
$disc = $_POST['disc'];


$sql = 'INSERT INTO user_permission (name, a_hr, a_pr, a_ea, a_ps, a_m, a_r, e_ep, e_ea, dashboard,epr, report, appraisal, disc) VALUES 
        ("' . $name . '", "' . $a_hr . '", "' . $a_pr . '", "' . $a_ea . '", "' . $a_ps . '", "' . $a_m . '", "' . $a_r . '", "' . $e_ep . '", "' . $e_ea . '", "' . $dash . '","' . $e_ir . '", "' . $str . '", "' . $appraisal . '", "' . $disc . '")';

$query = mysql_query($sql);

$id = mysql_insert_id();

if ($branch != "") {
    $query1 = mysql_query('INSERT INTO user_permission_view (user_permission_id, branch_id, company_id) VALUES (' . $id . ', "' . $branch . '", "' . $company . '")');
}

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