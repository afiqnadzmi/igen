<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
include_once "app/test_jason.php";
//
include_once "app/test.php";
//
include_once "app/loh.php";

$dep_id = $_POST['dep_id'];
$emp_id = $_POST['new_all_id'];

$stor_total = 0;
$stor_netpay = 0;

$query1 = "select * from department where id = $dep_id";
$rs1 = mysql_query($query1);
$row1 = mysql_fetch_array($rs1);
$dep_name = $row1['dep_name'];

$query = "select * from employee where id not in($emp_id) and dep_id = $dep_id;";
$rs = mysql_query($query);
$head_count = mysql_num_rows($rs);
while ($row = mysql_fetch_array($rs)) {
    $emp_name = "Others employee(s)";
    $basic = $row['salary'];
    $empid = $row['id'];

    $get_basic = basic_salary($empid);
    $get_epf = employer_epf($empid, $get_basic);
    if (chk_age_more_55($empid)) {
        $get_socso = employer_socso2($get_basic); //more than 55 years old
    } else {
        $get_socso = employer_socso($get_basic);
    }

    $stor_netpay += $get_basic + $get_epf + $get_socso;
}

if ($query) {
    echo '<tr class="tabletr">
        <td style="width: 180px;">' . $dep_name . '</td>
        <td><input type="hidden" id="empid" value="' . $empid . '" />' . $emp_name . '</td>
	<td style="width: 130px;"> - </td>
	<td style="width: 220px;"><span name="stotal">' . number_format($stor_netpay, 2, ".", "") . '</span></td>    
        <td style="width: 220px;"><span name="atotal">' . number_format($stor_netpay, 2, ".", "") . '</span></td>
	<td style="width: 150px;"><span name="dtotal">0.00</span></td>    
	</tr>';
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