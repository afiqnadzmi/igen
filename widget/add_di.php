<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */


	// Personal Information
	$sql =mysql_query("INSERT INTO di_letter(generated_by, ref_id,eff_date, rev_date, rev_num, emp_id, di_date,effective_date,date)
			VALUES ('" . $_POST['generated_by'] . "','" . $_POST['ref_id'] . "','" . date('Y-m-d', strtotime($_POST['eff_date'])). "','" . date('Y-m-d', strtotime($_POST['rev_date'])) . "','" . $_POST['rev_num'] ."','".$_POST['emp_id']."','" . date('Y-m-d', strtotime($_POST['di_date'])) . "','" . date('Y-m-d', strtotime($_POST['effective_date'])) . "','".date('Y-m-d')."')");
	if ($sql) {
		  //Update Disciplany action councellling status
   $sql_dp =mysql_query("UPDATE disciplinary_pinfo SET di_status='1' WHERE id=".$_POST['ref_id']);
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