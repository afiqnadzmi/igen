<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$head_department=0;
if($_POST['head_id']!=""){
	$head_department=$_POST['head_id'];
}
$sql = "UPDATE department 
        SET dep_name = '" . $_POST['dep_name'] . "', dep_description = '" . $_POST['dep_description'] . "', head_emp_id = '" . $head_department . "', 
        dep_quota = '" . $_POST['department_quota'] . "', branch_id = " . $_POST["branch_id"] . ", is_active = " . $_POST["dep_status"] . "
        WHERE id = " . $_POST['id'] . ";";
$sql_result = mysql_query($sql);
$query_update = mysql_query('UPDATE employee SET branch_id = ' . $_POST['branch_id'] . ' WHERE dep_id=' . $_POST['id']);
if ($sql_result && $query_update) {
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