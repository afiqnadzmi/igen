<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

if($_POST['action']=="edit"){
	$sql = "UPDATE loan_management SET name = '" . $_POST['name'] . "', description = '" .$_POST['desc']."' WHERE id = '" . $_POST['id'] . "';";

$sql_result = mysql_query($sql);
	
}else if($_POST['action']=="del"){
	$sql = "DELETE from loan_management WHERE id = '" . $_POST['id'] . "';";
	$sql_result = mysql_query($sql);
}else{
	$sql = "INSERT INTO loan_management (name, description) 
			VALUES ('" . $_POST['name'] . "','" .$_POST['desc']. "');";
	$sql_result = mysql_query($sql);
}

if ($sql_result) {
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