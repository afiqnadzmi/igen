<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */


	// Personal Information
	
	 $sql =mysql_query("UPDATE di_letter SET eff_date='".date('Y-m-d', strtotime($_POST['eff_date']))."',rev_date='" .date('Y-m-d', strtotime($_POST['rev_date'])). "',rev_num='" .$_POST['rev_num']. "',di_date='" .date('Y-m-d', strtotime($_POST['di_date'])). "',effective_date='" .date('Y-m-d', strtotime($_POST['effective_date'])). "',updated_by='" .$_POST['generated_by']. "', updated_date='" .date("Y-m-d"). "' WHERE id=".$_POST['id']);
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