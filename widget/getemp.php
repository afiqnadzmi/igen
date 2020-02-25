<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<option value="">--Please Select--</option>
<?php
$group_id = $_POST['group_id'];
$dep_id=$_POST['dept_id'];
$sql = 'SELECT p.id as p_id, p.position_name, e.level_id,e.position_id, e.id as e_id, e.full_name, u.a_ea, u.id FROM position p, employee e, user_permission u WHERE (e.level_id=u.id AND p.id=e.position_id)AND u.a_ea="a_ea_edit" ORDER BY position_name';
$rs = mysql_query($sql);
while ($row = mysql_fetch_array($rs)) {
    echo"<option value='" . $row["e_id"] . "'>" . $row["full_name"] . "</option>";
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