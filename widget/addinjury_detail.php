<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$m_location=$_POST['m_location'];
$G_injuries =$_POST['G_injuries'];
$head=$_POST['head'];
$Neck=$_POST['Neck'];
$upper_limb=$_POST['upper_limb'];
$trunk=$_POST['trunk'];
$lower_limb=$_POST['lower_limb'];
$accident1=$_POST['accident1'];
$accident2=$_POST['accident2'];
$t_injury=$_POST['t_injury'];
$a_c_injury=$_POST['a_c_injury'];
$a_c_injury1=$_POST['a_c_injury1'];
$emp_id=$_POST['emp_id'];
$i_desc=$_POST['i_desc'];

$sql = 'INSERT INTO injury_details(m_location, G_injuries, head, Neck, upper_limb, trunk,lower_limb, accident1, accident2,t_injury, a_c_injury,a_c_injury1,i_desc,emp_id)
            VALUES
            ("' . $m_location. '", "' .$G_injuries . '","' . $head . '","' .$Neck . '","' .$upper_limb .'","'.$trunk .'","'. $lower_limb . '","'. $accident1. '",
			"'. $accident2 . '","' . $t_injury . '","' . $a_c_injury . '","' . $a_c_injury1. '","' . $i_desc. '","' . $emp_id. '")';

$query=mysql_query($sql);
if ($query) {
   echo true;
} else {
  echo false;
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