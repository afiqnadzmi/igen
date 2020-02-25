<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

include_once "app/loh.php";

$est_bud = $_POST['est_bud'];
$est_in = $_POST['est_in'];
$est_qty = $_POST['est_qty'];
$pos = $_POST['pos'];
$employer_epf = $_POST['employer_epf'];
$employee_epf = $_POST['employee_epf'];
$emp_id=$_POST['emp_id'];
$get_epf = custom_epf($est_in, $employee_epf);
$get_employer_epf = custom_epf($est_in, $employer_epf);
$get_socso = employer_socso($est_in);
$final_in = $est_in + $get_employer_epf + $get_socso;

$ts = $get_socso * $est_qty;
$ta = $final_in * $est_qty;
$te = $get_employer_epf * $est_qty;

$sql = "INSERT INTO planning (Employer_id,position,quantity,income,socso,epf,est_budget, total, status) VALUES 
       ('" . $emp_id . "','" . $pos . "','" . $est_qty . "','" . $est_in . "',
        '" . $ts . "','" . $te . "','" . $est_bud . "','" . $ta . "', 'active')";
$query = mysql_query($sql);
if ($query) {
echo"Successfully added";

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