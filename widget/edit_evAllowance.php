<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php


if($_POST['action']=="evall"){// Allowance
	$sql = "UPDATE employee_evallowance SET allowance_amount = '" . $_POST['amount'] . "' WHERE id =". $_POST['id']; 
}else if($_POST['action']=="dva"){// Deduction
	$sql = "UPDATE employee_deduction SET deduction_amount = '" . $_POST['amount'] . "' WHERE id =". $_POST['id']; 
}else if($_POST['action']=="cl"){// Claim

	$sql = "UPDATE employee_claim SET amount = '" . $_POST['amount'] . "',	claim_no = '" . $_POST['claim_number'] . "',	claim_date = '" . date("Y-m-d", strtotime($_POST['claim_date'])) . "' WHERE id =". $_POST['id']; 
}

$sql_result = mysql_query($sql);
if ($sql_result==1) {
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