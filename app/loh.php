<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

//print countepf(1000);
//ok
function custom_epf($gross_pay, $percentage) {
    $gross_pay_count = ($gross_pay * ($percentage / 100));
    return $gross_pay_count;
}


//ok
function countepf($gross_pay) {
    $gross_pay_count = ($gross_pay * (11 / 100));
    return $gross_pay_count;
}

//print epf(1000). '<br/>';
/* function epf($gross_pay) {
  $sql = "select deduct_rate from employee_epf where fr_amt <='" . $gross_pay . "' and to_amt >'" . $gross_pay . "'   ";
  $query = mysql_query($sql);
  if ($query) {
  while ($row = mysql_fetch_array($query)) {
  return $row['deduct_rate'];
  }
  } else {
  return 0;
  }
  } */

//ok
/* function epf($emp_id){
  $sql="SELECT epf_rate FROM `position` p
  where id=(SELECT position_id FROM employee e where id=".$emp_id.")";
  $rs=mysql_query($sql);
  if($rs&&mysql_num_rows($rs)>0){
  $row = mysql_fetch_array($rs);p
  return $row["epf_rate"];
  }else{
  return 0;
  } 
  } */

function epf($emp_id, $gross_pay) {
    $sql = "SELECT epf_rate FROM `position` p 
			where id=(SELECT position_id FROM employee e where id=" . $emp_id . " AND epf='Y')";
    //echo $sql;
    $rs = mysql_query($sql);
    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
        if ($row["epf_rate"] == '' || $row["epf_rate"] == '0') {
            //$sql1 = "select deduct_rate from employee_epf where fr_amt <='" . $gross_pay . "' and to_amt >'" . $gross_pay . "' limit 1";
            $sql1 = "select deduct_rate from employee_epf where fr_amt <'" . $gross_pay . "' and to_amt >='" . $gross_pay . "' limit 1";
            $query1 = mysql_query($sql1);
            if ($query1 && mysql_num_rows($query1) > 0) {
                $row1 = mysql_fetch_array($query1);
                return $row1['deduct_rate'];
            } else {
                return default_epf($gross_pay, 'employee');
            }
        } else {
            return ($row["epf_rate"] / 100) * $gross_pay;
        }
    } else {
        return 0;
    }
}
function increment_emp($id, $incre){
$sql = 'UPDATE employee SET salary= "' . $incre . '" WHERE id = ' . $id . ';';
        $sql_result = mysql_query($sql);

        if ($sql_result) {
            $query_status = "true";
        } else { 
            $query_status = "false";
        }
     return $query_status;

}
function employer_epf($emp_id, $gross_pay) {

    $sql = "SELECT employer_epf_rate FROM `position` p 
			where id=(SELECT position_id FROM employee e where id=" . $emp_id . " AND epf='Y')";
    //echo $sql;
    $rs = mysql_query($sql);
    if ($rs && mysql_num_rows($rs) > 0) {
	
        $row = mysql_fetch_array($rs);
        if ($row["employer_epf_rate"] == '' || $row["employer_epf_rate"] == '0') {
            $sql1 = "select employer_rate from employee_epf where fr_amt <'" . $gross_pay . "' and to_amt >='" . $gross_pay . "' limit 1";
            //echo $sql1;
            $query1 = mysql_query($sql1);
            if ($query1 && mysql_num_rows($query1) > 0) {
                $row1 = mysql_fetch_array($query1);
                return $row1['employer_rate'];
            } else {
                return default_epf($gross_pay, 'employer');
            }
        } else {
            return ($row["employer_epf_rate"] / 100) * $gross_pay;
        }
    } else {
        return 0;
    }
}
function employer_epf_inc($emp_id, $gross_pay) {

    $sql = "SELECT epf_rate FROM `position` p 
			where id=(SELECT position_id FROM employee e where id=" . $emp_id . ")";
    //echo $sql;
    $rs = mysql_query($sql);
    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
        if ($row["epf_rate"] == '' || $row["epf_rate"] == '0') {
            $sql1 = "select employer_rate from employee_epf where fr_amt <'" . $gross_pay . "' and to_amt >='" . $gross_pay . "' limit 1";
            //echo $sql1;
            $query1 = mysql_query($sql1);
            if ($query1 && mysql_num_rows($query1) > 0) {
                $row1 = mysql_fetch_array($query1);
                return $row1['employer_rate'];
            } else {
                return default_epf($gross_pay, 'employer');
            }
        } else {
            return ($row["epf_rate"] / 100) * $gross_pay;
        }
    } else {
        return 0;
    }
}

function employer_epf_sim($emp_id, $bonus) {
    $sql = 'SELECT employer_rate FROM default_epf_bonus';
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
    return ($row["employer_rate"] / 100) * $bonus;
}

function employer_epf_bonus($emp_id, $gross_pay, $get_basic, $get_bonus) {
    $total_wage_bonus = $get_bonus + $get_basic;
    if ($get_basic <= 5000 && $total_wage_bonus > 5000) {
        $sql = 'SELECT employer_rate FROM default_epf_bonus';
        $query = mysql_query($sql);
        $row = mysql_fetch_array($query);
        return ($row["employer_rate"] / 100) * $gross_pay;
    } else {
        return employer_epf($emp_id, $gross_pay);
    }
}

function default_epf($gross_pay, $type) {
    if ($type == 'employee') {
        $sql = 'SELECT employee_epf FROM default_epf limit 1';
        $rs = mysql_query($sql);
        $row = mysql_fetch_array($rs);
        return ((int) $row['employee_epf'] / 100) * $gross_pay;
    } else {
        $sql = 'SELECT employer_epf FROM default_epf limit 1';
        $rs = mysql_query($sql);
        $row = mysql_fetch_array($rs);
        return ((int) $row['employer_epf'] / 100) * $gross_pay;
    }
}

//ok
function socso($gross_pay, $emp_id) {
    $sql = "select s.deduct_rate, e.socso, e.id from employee_socso s, employee e WHERE e.id='".$emp_id."'  AND e.socso='Y' AND (fr_amt <'" . $gross_pay . "' and to_amt >='" . $gross_pay . "')";
    $query = mysql_query($sql);
    if ($query) {
        $row = mysql_fetch_array($query);
        return $row['deduct_rate'];
    } else {
        return 0;
    }
}

function employer_socso($gross_pay, $emp_id) {
    $sql = "select es.employer_rate, e.socso, e.id from employee_socso es, employee e
				where  e.id='".$emp_id."'  AND e.socso='Y' and fr_amt <'" . $gross_pay . "' and to_amt >='" . $gross_pay . "'   ";
    $query = mysql_query($sql);
    if ($query) {
        $row = mysql_fetch_array($query);
        return $row['employer_rate'];
    } else {
        return 0;
    }
}

function employer_socso2($gross_pay, $emp_id) {
    //only for those who is more than 55 years old, himself no need pay socso, only majikan need to pay only
    $sql = "select es.employer_rate2 ,e.socso, e.id from employee_socso , employee e
				where e.id='".$emp_id."'  AND e.socso='Y' and fr_amt <'" . $gross_pay . "' and to_amt >='" . $gross_pay . "'   ";
    $query = mysql_query($sql);
    if ($query) {
        $row = mysql_fetch_array($query);
        return $row['employer_rate2'];
    } else {
        return 0;
    }
}

function eis($gross_pay, $emp_id) {
    $sql = "select total_rate from employee_eis  where fr_amt <'" . $gross_pay . "' and to_amt >='" . $gross_pay . "'";
    $query = mysql_query($sql);
    if ($query) {
        $row = mysql_fetch_array($query);
        return $row['total_rate'];
    } else {
        return 0;
    }
}

function employer_eis($gross_pay, $emp_id) {
    $sql = "select employer_rate from employee_eis  where fr_amt <'" . $gross_pay . "' and to_amt >='" . $gross_pay . "'";
    $query = mysql_query($sql);
    if ($query) {
        $row = mysql_fetch_array($query);
        return $row['employer_rate'];
    } else {
        return 0;
    }
}

function employee_eis($gross_pay, $emp_id) {
    $sql = "select employee_rate from employee_eis  where fr_amt <'" . $gross_pay . "' and to_amt >='" . $gross_pay . "'";
    $query = mysql_query($sql);
    if ($query) {
        $row = mysql_fetch_array($query);
        return $row['employee_rate'];
    } else {
        return 0;
    }
}

function employer_fweis($gross_pay, $emp_id) {
    $sql = "select employer_rate from employee_fweis  where fr_amt <'" . $gross_pay . "' and to_amt >='" . $gross_pay . "'";
    $query = mysql_query($sql);
    if ($query) {
        $row = mysql_fetch_array($query);
        return $row['employer_rate'];
    } else {
        return 0;
    }
}

function employer_hrdf($gross_pay, $emp_id) {
    return $gross_pay * 0.01;
}

//ok
function advance_salary($emp_id, $month, $year) { 
    //$sql = "select advance_amount from advance_salary where emp_id ='".$emp_id."' and  request_date like '$year-$month-%'";
    $sql = "select advance_amount, id, count, i_month from advance_salary where emp_id ='". $emp_id."' and year(request_date)=". $year . " and month(request_date)<=".$month." AND count<i_month";
	
    $query = mysql_query($sql);
    if ($query) {
	   
        $advance_amount = 0;
        while ($row = mysql_fetch_array($query)) {
		  $count=$row['count']+ 1;
		  $in_month=$row['i_month'];
		  if($in_month!="0"){
		  $advance_amount=$row['advance_amount']/$in_month;
		  }else{
            $advance_amount = $advance_amount + $row['advance_amount'];
			}
			$sql = 'UPDATE advance_salary SET count= "' .  $count . '" WHERE id = ' .$row['id']. ';';
        $sql_result = mysql_query($sql);
        }
        return $advance_amount;
    } else {
        return 0;
    }
}

function advance_salary_1($emp_id, $month, $year) { 
    //$sql = "select advance_amount from advance_salary where emp_id ='".$emp_id."' and  request_date like '$year-$month-%'";
    $sql = "select advance_amount, id, count, i_month from advance_salary where emp_id ='". $emp_id."' and year(request_date)=". $year . " and month(request_date)<=".$month." AND count<i_month";
	
    $query = mysql_query($sql);
    if ($query) {
	 
        $advance_amount = 0;
		
        while ($row = mysql_fetch_array($query)) {
	
		  $count=$row['count']+ 1;
		  $in_month=$row['i_month'];
		  if($in_month!="0"){
		  $advance_amount=$row['advance_amount']/$in_month;
		  }else{
            $advance_amount = $advance_amount + $row['advance_amount'];
			}
			//$sql = 'UPDATE advance_salary SET count= "' .  $count . '" WHERE id = ' .$row['id']. ';';
       // $sql_result = mysql_query($sql);
        }
        return $advance_amount;
    } else {
        return 0;
    }
}
//ok
function claim($emp_id, $month, $year) {
    $sql = "select * from employee_claim where emp_id ='" . $emp_id
            . "'  and year(claim_date)=" . $year . " and month(claim_date)=" . $month . " and claim_status='Approved'";
    $query = mysql_query($sql);
    if ($query) {
        $advance_amount = 0;
        while ($row = mysql_fetch_array($query)) {
            $advance_amount = $advance_amount + $row['amount'];
        }
        return $advance_amount;
    } else {
        return 0;
    }
}

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>