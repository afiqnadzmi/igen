<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$a_b=$_POST['a_b'];
$b_a=$_POST['b_a'];

$emp_id=$_POST['new_all_id'];
$training_name = $_POST['training_name'];
$start_date = date('Y-m-d', strtotime($_POST['start_date']));
$end_date = date('Y-m-d', strtotime($_POST['end_date']));
$venue = $_POST['venue'];
$train_desc = $_POST['train_desc'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$comp_id=$_POST['comp_id'];
$duration=$_POST['duration'];
$position = ",".$_POST['position'];


$str = substr($_POST['str'], 1);
$str_arr = explode(";", $str);
array_push($str_arr, $position);
$position_name="";
$pos_id="";
foreach ($str_arr as $s) {
$s_arr = explode(",", $s);
for($i=0; $i<sizeof($s_arr); $i++){
$fy=$s_arr[$i];

$query = "SELECT * FROM `position` WHERE id = " . $fy;
$rs = mysql_query($query);
while ($row = mysql_fetch_array($rs)) {
    $position_name .= $row['position_name'].",";
    $pos_id .= $row['id'].",";
	}
	}
}
	
	$position_name = substr($position_name, 0, -1);


    $sql = "INSERT INTO training (training_name,from_date,to_date,duration,venue,train_desc,start_time,end_time,position,pos_id,emp_id,b_a,a_b, companyID)
            VALUES ('" . $training_name . "','" . $start_date . "','" . $end_date . "','" . $duration . "','" . $venue . "','" . $train_desc . "','" . $start_time . "','" . $end_time . "','" . $position_name . "','" . $pos_id . "','" . $emp_id . "','" .$b_a . "','" .$a_b. "','" . $comp_id . "')";

   $query2 = mysql_query($sql);


if ($query2) {
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