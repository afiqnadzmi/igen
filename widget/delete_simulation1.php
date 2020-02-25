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
$arr_id=explode(",", $id);
$status=$_POST['status'];
if($status=="del"){
	foreach($arr_id as $val){
		//Bonus Simulation
		$sql = "Delete FROM simulation WHERE id=".$val;
		$query = mysql_query($sql);

		//Bonus
		$sql_bonus = "Delete FROM bonus  WHERE ref_id=".$val;
		$query_bonus = mysql_query($sql_bonus);
	}
}else{
	foreach($arr_id as $val){
			//Bonus Simulation
		$sql = "UPDATE simulation SET bonus_status='Approved' WHERE id=".$val;
		$query = mysql_query($sql);

		//Bonus
		$sql_bonus = "UPDATE bonus SET bonus_status='Approved' WHERE ref_id=".$val;
		$query_bonus = mysql_query($sql_bonus);
	}
}

if ($query) {
	echo"Successfully deleted";
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