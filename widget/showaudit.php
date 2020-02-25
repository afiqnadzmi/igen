<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>




<?php

$prev="";
$sql3 = 'SELECT * FROM appraisal_draft WHERE id='.$_POST['id'];
                           $query2 = mysql_query($sql3);
                              while ($row = mysql_fetch_array($query2)) {
							  $prev=$row['rate'];
							  }
	
echo '<table class="TFtable"><tr style="background:#000; color:#fff; font-size:16px">

<td style="padding:10px">No.</td>
<td style="padding:10px; ">Changed<font color="#000">_</font>From</td>
<td style="padding:10px;">Changed<font color="#000">_</font>To</td>

<td style="padding:10px; width:500px;">Changed<font color="#000">_</font>By </td>
<td style="padding:10px; width:200px;">Date<font color="#000">_</font>Changed</td>


</tr>

';
   $count=1;
		$sql3 = 'SELECT * FROM appraisal_audit WHERE q_id='.$_POST['id'];
                           $query2 = mysql_query($sql3);
                              while ($row = mysql_fetch_array($query2)) {
							
									echo'<tr><td style="padding:0 10px 0 10px">'. $count.'</td>
									    <td style="padding:0 10px 0 10px">'. $row['rate'].'</td>
									      <td style="padding:0 10px 0 10px">'. $row['new_rate'].'</td>
										  
										  <td style="padding:0 10px 0 10px; width:300px">'. $row['changed_by'].'</td>
										  <td style="padding:0 10px 0 10px">'. $row['changed_date'].'</td></tr>
										 
									';
									$count++;
									 
									 }
									 
		echo'</table';

?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>