<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php


$precentage=array('5','10','15','20','25','30','35','40','45','50','55','60','65','70','75','80','85','90','95','100');
$rating=array('1','2','3','4','5');
$data1='<option value="">-None-</option>';
$data2='<option value="">-None-</option>';
foreach($precentage as $val){
	$data1.='<option value="' . $val . '">' . $val . '</option>';
}
foreach($rating as $val){
	$data2.='<option value="' . $val . '">' . $val . '</option>';
}
$data = array('data1' => $data1, 'data2' => $data2);
print json_encode($data);
?>
  