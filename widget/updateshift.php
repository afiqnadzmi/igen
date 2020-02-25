<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

function timeDiff($firstTime, $lastTime) {

// convert to unix timestamps
    $firstTime = strtotime($firstTime);
    $lastTime = strtotime($lastTime);

// perform subtraction to get the difference (in seconds) between times
    $timeDiff = $lastTime - $firstTime;

// return the difference
    return (int) ($timeDiff / 3600) + number_format(((($timeDiff / 60) % 60) / 100), 2);
}

$sid = $_POST['id'];
$shift_name = $_POST['shift_name'];
$shift_description = $_POST['shift_description'];

$sql = "update shift set name='" . $shift_name . "', description='" . $shift_description . "', total_hours='" . $_POST['total_hours'] . "' where id='" . $sid . "'";

$query = mysql_query($sql);


$sql2 = "delete from emp_time_table where shift_id='" . $sid . "'";
$query2 = mysql_query($sql2);
//echo $_POST['str'];
$time = explode(";", $_POST['str']);
$day = 1;
$j=0;
$r=1;
$s=0;
for ($i = 0; $i < count($time) / 2; $i++) { 
   // $single = explode("*", $time[$i]);
		$single=$time;
	
   if (timeDiff($single[$i + $s], $single[$i + $r]) == 0) {
        $is_work_day = "N";
    } else {
        $is_work_day = "Y";
    }
   
   $sql = "insert into emp_time_table(`day`,from_time,to_time,hour,shift_id,is_work_day)
            values ('" . $day . "','" . $single[$i + $s] . "','" . $single[$i + $r] . "','" . timeDiff($single[$i + $s], $single[$i + $r]) . "','" . $sid . "','" . $is_work_day . "')";
   
   $sql_r = "insert into emp_time_table(`day`,from_time,to_time,hour,shift_id,is_work_day)
            values ('" . $day . "','" . $single[$i + $s] . "','" . $single[$i + $r] . "','" . timeDiff($single[$i + $s], $single[$i + $r]) . "','" . $sid . "','" . $is_work_day . "')";	

    $sql_result = mysql_query($sql);
	mysql_query($sql_r);

    //if (($i + 1) % 2 == 0) {
        //++$day;
    //}
	$day++;
	$r++;
	$s++;
}

if ($query) {
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