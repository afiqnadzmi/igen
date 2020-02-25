<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
if(trim($_POST['action'])=="fall"){ // Fixed Allowance
	$sql = "DELETE FROM employee_allowance WHERE id =" . $_POST['id'] . ";";
}else if(trim($_POST['action'])=="evall"){// Evolved Allowance
	$sql = "DELETE FROM employee_evallowance WHERE id =" . $_POST['id'] . ";";
}else if(trim($_POST['action'])=="cl"){ // Claim
	$sql = "DELETE FROM employee_claim WHERE id =" . $_POST['id'] . ";";
}else if(trim($_POST['action'])=="dva"){ // Claim
	$sql = "DELETE FROM employee_deduction WHERE id =" . $_POST['id'] . ";";
}

$sql_result = mysql_query($sql);

if ($sql_result == 1) {
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