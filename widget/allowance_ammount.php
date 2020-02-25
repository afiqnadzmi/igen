<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$id=$_POST['id'];
$type=$_POST['type'];// Allowance=1, Deduction=3
if($type==1){
	$sql = "select * from allowance where id=".$id;
	$result = mysql_query($sql);
	while ($rs = mysql_fetch_array($result)) {
		echo $rs['allowance_amount'];
	}
}else{
	$sql = "select * from deduction_payroll where id=".$id;
	$result = mysql_query($sql);
	while ($rs = mysql_fetch_array($result)) {
		echo $rs['deduction_amount'];
	}
}

?>
  