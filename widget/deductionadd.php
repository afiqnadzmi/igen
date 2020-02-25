<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
if ($_POST["action"] == "add") {
	$sql = 'INSERT INTO deduction_payroll (deduction_name, deduction_amount, deduction_type) VALUES ("' . $_POST["name"] . '","' . $_POST["amount"] . '","' . $_POST["type"] . '")';  
} elseif ($_POST["action"] == "edit") {
	$sql = 'UPDATE deduction_payroll SET deduction_name = "' . $_POST["name"] . '", deduction_amount = "' . $_POST["amount"] . '",deduction_type = "' . $_POST["type"] . '" WHERE id ='. $_POST["id"];
} elseif ($_POST["action"] == "del") {
    $sql = 'DELETE FROM deduction_payroll WHERE id=' . $_POST["id"];
}
$query = mysql_query($sql);
if($query==1){
	print true;
}else{
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