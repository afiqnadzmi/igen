<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$id=$_POST['sList'];
$arr_id=explode(",", $id);
$status=$_POST['id'];
//Increment
if($status=="del"){

	foreach($arr_id as $val){
		$sql = "Delete FROM simulation_inrement  WHERE id=".$val;
		$query = mysql_query($sql);
	}
	if ($query==false) {
		echo"Successfully deleted";
	}
}
else{
	foreach($arr_id as $val){
		$sql = "UPDATE simulation_inrement SET status='Approved' WHERE id=".$val;
		$query = mysql_query($sql);
		if ($query) {
		$sql3 = 'SELECT * from simulation_inrement WHERE id='.$val;  
		$query2 = mysql_query($sql3);
		while ($row = mysql_fetch_array($query2)) {
			$emp_id=$row['emp_id'];
			$salary=$row['salary'];
			$sql = 'UPDATE employee SET salary= "' . $salary . '" WHERE id = ' . $emp_id ;
			$sql_result = mysql_query($sql);
		}
		if($query2){
		echo" Successfully Incremented";

		}

		}
	}
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