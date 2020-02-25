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
$startdate=$_POST['startdate'];

$selectintype = $_POST['selectintype'];
//$time = explode(",",$_POST['new_all_id']);

$query = "select * , emp.id as empid 
          from employee as emp
          inner join department as dep
          on emp.dep_id = dep.id
	  where emp.dep_id in($dep_id)
	  and emp.id in($emp_id)";
$rs = mysql_query($query);
while ($row = mysql_fetch_array($rs)) {
    $dep_name = $row['dep_name'];
    $emp_name = $row['full_name'];
	$position_id = $row['position_id'];
    $sum = $row['salary'];
    $empid = $row['empid'];

    $get_basic = basic_salary($empid);
    $get_epf = employer_epf_inc($empid, $get_basic);
	$get_socso = employer_socso($get_basic);
    /*if (chk_age_more_55($empid)) {
        $get_socso = employer_socso2($get_basic); //more than 55 years old
    } else {
        
    }*/

    $net_pay = $get_basic; //($get_basic  + $get_socso) - $get_epf;


    if ($in_type == "p") {// Increment
	 
        if ($selectintype == "ia") {
            $total_in = $get_basic + $in_by;
			$cur_salry=$total_in;
        } elseif ($selectintype == "ip") {
            $total_in = $get_basic * (($in_by / 100) + 1);
			$cur_salry=$total_in;
        }
        $get_epf2 = employer_epf_inc($empid, $total_in);
	
		
        $get_socso2 = employer_socso($total_in);
        //$total = $total_in;
      
        $diff = $total_in - $net_pay ;
        if ($selectintype == "ia") {//Amount
            $sym = "RM";
        } elseif ($selectintype == "ip") {//Precentafe
            $sym = "%";
        }
    } elseif ($in_type == "m") {//Bonus

        $total= $get_basic * $in_by;
        $diff = $total - $net_pay;
        $sym = "Month";
    }

    //if ($query) {
        if ($in_type == "p" || $in_type == "a") {
	
		//$salary_updated=($get_basic +  $in_by);
	
			  //increment_emp($empid, $salary_updated);
			  if ($selectintype == "ia") {
	
				 $sql = "INSERT INTO simulation_inrement (emp_id,dep_name,emp_name,increment_by_amount,Before_Increment,after_increment,difference,incre_date,salary,status) VALUES 
				   ('" . $empid . "','" . $dep_name . "','" . $emp_name . "','". $in_by . "','" . $net_pay . "','" . $total_in . "','" . $diff. "','" .date('Y-m-d'). "','" . $cur_salry. "','Pending')";
		   }else if ($selectintype == "ip") {
				$sql = "INSERT INTO simulation_inrement (emp_id,dep_name,emp_name,increment_by_precentage,Before_Increment,after_increment,difference,incre_date,salary,status) VALUES 
			   ('" . $empid . "','" . $dep_name . "','" . $emp_name . "','". $in_by . "','" . $net_pay . "','" . $total_in . "','" . $diff. "','" .date('Y-m-d'). "','" . $cur_salry. "','Pending')";
		   }
	
				$query = mysql_query($sql);
				if ($query) {
				echo"Successfully added";

				}

        } elseif ($in_type == "m") {
		
				   $sql = "INSERT INTO simulation (emp_id,dep_name,emp_name,salary,bonus,total_bonus,status, bonus_status) VALUES 
				   ('" . $empid . "','" . $dep_name . "','" . $emp_name . "','". $get_basic . "','" . $in_by . "','" . $total . "','active', 'Pending')";
					$query = mysql_query($sql);
					$ref_id=mysql_insert_id();
					$sql_bonus = "INSERT INTO bonus (emp_id,position_id,bonus_rate	,ref_id,issue_date, bonus_status) VALUES 
				   ('" . $empid . "','" . $position_id . "','" . $in_by . "','". $ref_id . "','" . date('Y-m-d'). "', 'Pending')";
					$query_bonus = mysql_query($sql_bonus);
					if ($query) {
					echo"Successfully added";

					}

        }
    //} else {
    //    print false;
    //}
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