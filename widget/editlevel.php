<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$id = $_POST["id"];
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
$str = $_POST['str'];
$company = $_POST['company'];
$appraisal = $_POST['appraisal'];
$disc = $_POST['disc'];

$sql = 'UPDATE user_permission SET name = "' . $name . '", a_hr = "' . $a_hr . '", a_pr = "' . $a_pr . '", a_ea = "' . $a_ea . '", a_ps = "' . $a_ps . '", 
        a_m = "' . $a_m . '", a_r = "' . $a_r . '", e_ep = "' . $e_ep . '", e_ea = "' . $e_ea . '", dashboard = "' . $dash . '" ,epr = "' . $e_ir . '" , report = "' . $str . '", appraisal="' . $appraisal . '" , disc="' . $disc . '"  WHERE id = ' . $id;
$query = mysql_query($sql);

$query1 = mysql_query('DELETE FROM user_permission_view WHERE user_permission_id=' .$id);
if ($branch != "") {
    $query2 = mysql_query('INSERT INTO user_permission_view (user_permission_id, branch_id, company_id) VALUES (' . $id . ', "' . $branch . '", "' . $company . '")');
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