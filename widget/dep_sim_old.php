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
include_once "app/test.php";
include_once "app/loh.php";

$dep_id = $_POST['dep_id'];

$emp_id = $_POST['new_all_id'];

$in_type = $_POST['in_type'];
$in_by = $_POST['in_by'];
$selectintype = $_POST['selectintype'];

$query = "select * , emp.id as empid 
          from employee as emp
          inner join department as dep
          on emp.dep_id=dep.id 
	  where emp.dep_id in($dep_id)
	  and emp.id in($emp_id)";
$rs = mysql_query($query);
while ($row = mysql_fetch_array($rs)) {
    $dep_name = $row['dep_name'];
    $emp_name = $row['full_name'];
    $sum = $row['salary'];
    $empid = $row['empid'];

    $get_basic = basic_salary($empid);
    $get_epf = employer_epf($empid, $get_basic);
    if (chk_age_more_55($empid)) {
        $get_socso = employer_socso2($get_basic); //more than 55 years old
    } else {
        $get_socso = employer_socso($get_basic);
    }

    $net_pay = $get_basic + $get_epf + $get_socso;

    if ($in_type == "p") {
        if ($selectintype == "ia") {
            $total_in = $get_basic + $in_by;
        } elseif ($selectintype == "ip") {
            $total_in = $get_basic * (($in_by / 100) + 1);
        }
        $get_epf2 = employer_epf($empid, $total_in);
        $get_socso2 = employer_socso($total_in);
        $total = $total_in + $get_epf2 + $get_socso2;

        $diff = $total - $net_pay;
        if ($selectintype == "ia") {
            $sym = "RM";
        } elseif ($selectintype == "ip") {
            $sym = "%";
        }
    } elseif ($in_type == "m") {
        /* old */
//        $in_by2 = $in_by + 1; // at least one month add on
//        $total_in = $get_basic * $in_by2;
//        $get_epf2 = employer_epf($empid, $total_in);
//        $get_socso2 = employer_socso2($total_in);
//        $total = $total_in + $get_epf2 + $get_socso2;

        $total_in = $get_basic * $in_by;
        $total_in_bonus = ($get_basic * $in_by) + $get_basic;
        if ($get_basic <= 5000 && $total_in_bonus > 5000) {
            $get_epf2 = employer_epf_sim($empid, $total_in);
        } else {
            $get_epf2 = employer_epf($empid, $total_in);
        }
        $get_socso2 = employer_socso($total_in);
        $total = $total_in + $get_epf2 + $get_socso2;

        $diff = $total - $net_pay;
        $sym = "Month";
    }

    if ($query) {
        if ($in_type == "p" || $in_type == "a") {
		$sql = "INSERT INTO simulation (emp_id, dep_name,emp_name,increment,total_bonus,status) VALUES 
       ('" . $empid . "','" . $dep_name . "','" . $emp_name . "','" . $in_by . "','" . $total . "','active')";
$query = mysql_query($sql);
if ($query) {
echo"Successfully added";

}
/*
            echo '<tr class="tabletr">
            <td style="width: 180px;">' . $dep_name . '</td>
            <td><input type="hidden" id="empid" value=' . $empid . ' />' . $emp_name . '</td>
            <td style="width: 130px;">' . $in_by . ' (' . $sym . ')</td>
            <td style="width: 220px;"><span name="stotal">' . number_format($net_pay, 2, ".", "") . '</span></td>    
            <td style="width: 220px;"><span name="atotal">' . number_format($total, 2, ".", "") . '</span></td>
            <td style="width: 150px;"><span name="dtotal">' . number_format($diff, 2, ".", "") . '</span></td>    
            </tr>';
			*/
        } elseif ($in_type == "m") {
				$sql = "INSERT INTO simulation (emp_id,dep_name,emp_name,salary,bonus,total_bonus,status) VALUES 
       ('" . $empid . "','" . $dep_name . "','" . $emp_name . "','". $get_basic . "','" . $in_by . "','" . $total . "','active')";
$query = mysql_query($sql);
if ($query) {
echo"Successfully added";

}
/*
            echo '<tr class="tabletr">
            <td style="width: 180px;">' . $dep_name . '</td>
            <td><input type="hidden" id="empid" value=' . $empid . ' />' . $emp_name . '</td>
            <td style="width: 180px;">' . number_format($get_basic, 2, ".", "") . '</td>
            <td style="width: 220px;"><span name="stotal">' . $in_by . ' (' . $sym . ')' . '</span></td>    
            <td style="width: 220px;"><span name="atotal">' . number_format($total, 2, ".", "") . '</span></td>
            <td style="width: 150px; display: none"><span name="dtotal">' . number_format($diff, 2, ".", "") . '</span></td>    
            </tr>';
			*/
        }
    } else {
        print false;
    }
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