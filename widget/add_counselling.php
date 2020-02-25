<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
	// Personal Information
	$emp_id=$_POST['emp_id'];
	$coun_id=$_POST['coun_id'];
	$witness_id=$_POST['witness_id'];
	$discussion=$_POST['discussion'];
    $recomendation=$_POST['recomendation'];
	$misconduct=$_POST['misconduct'];
	$action_agreed=$_POST['action_agreed'];
	$status=(int)$_POST['coun_status'] + 1;

	$sql =mysql_query("INSERT INTO counselling(ref_id, emp_id, counsellor_id,witness_id, discussion, recommendation, date, misconduct,action_agreed)
			VALUES ('" . $_POST['ref_id'] . "','" . $emp_id . "','" .$coun_id. "','" . $witness_id . "','" .  $discussion ."','".$recomendation."','".date('Y-m-d')."','".$misconduct."','".$action_agreed."')");
   //Update Disciplany action councellling status
   $sql_dp =mysql_query("UPDATE disciplinary_pinfo SET coun_status='".$status."' WHERE id=".$_POST['ref_id']);
	if ($sql) {
		echo true;
	} else {
		echo false;
	}


/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>