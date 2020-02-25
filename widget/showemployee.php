<?php
/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn. Bhd. */
?>




<?php
echo '<table class="TFtable"><tr style="background:#66A3D2; color:#000; font-size:14px">

<td style="padding:10px">No.</td>

<td style="padding:10px">Employee </td>
<td style="padding:10px">Department</td>


</tr>

';
   $count=1;
		$sql3 = 'SELECT * FROM appraisal_cycle WHERE id='.$_POST['id'];
                           $query2 = mysql_query($sql3);
                              while ($row = mysql_fetch_array($query2)) {
							  $sql = 'SELECT e.full_name, d.dep_name FROM employee e, department d WHERE e.dep_id=d.id AND e.id IN('.$row['employee'].')';
                           $query = mysql_query($sql);
									while ($row_dep = mysql_fetch_array($query))
									{
									echo'<tr><td style="padding:0 10px 0 10px">'. $count.'</td>
									      <td style="padding:0 10px 0 10px">'. $row_dep['full_name'].'</td>
										  <td style="padding:0 10px 0 10px">'. $row_dep['dep_name'].'</td></tr>
										 
									';
									$count++;
									 }
									 }
									 
		echo'</table';

?>

<?php
/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn. Bhd. */
?>