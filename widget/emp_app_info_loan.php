<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<style type="text/css">
    #emp_trans td{
        vertical-align: top;
        padding-bottom: 5px;
    }
    .title_bold{
        font-weight: bold;
    }
	#emp_trans .middle{
        text-align: center;
    }
</style>
<table id="emp_trans">
<td class="title_bold" style="width: 160px;">Leave Type</td>
<td class="title_bold" style="width: 160px;">Utilized leave</td>
<td class="title_bold" style="width: 160px;">Entitle leave</td>
<td class="title_bold" style="width: 160px;">Carryforward</td>
<td class="title_bold" style="width: 160px;">Balance</td>
<?php
$curr= date('Y');
$lat_year=date('Y', strtotime('-1 year'));
$action = $_POST["action"];

if ($action == "leave" || $action == "admin_leave") {
  
    $emp_id = $_POST['id'];		
$sql1 = "select join_date,group_for_leave_id from employee where id=" . $emp_id;
$rs1 = mysql_query($sql1);
$row1 = mysql_fetch_array($rs1);
$join_date = $row1["join_date"];
$group_for_leave_id = $row1["group_for_leave_id"];
//search employee got what kind of leave
$sql = "SELECT distinct(lt.id), lt.type_name FROM employee e
        left join leave_group lg on lg.group_for_leave_id=e.group_for_leave_id
	left join leave_type lt on lg.leave_type_id=lt.id
	where e.id=" . $emp_id;
$rs = mysql_query($sql);
$work_year = floor((time(date("Y-m-d")) - strtotime($join_date)) / (365 * 24 * 60 * 60));

       while ($row = mysql_fetch_array($rs)) {
                $year = date('Y');
                $sql2 = "SELECT sum(num_days) as c FROM employee_leave e where request_status='Approved' 
                        and year(from_date)=" . $year . " 
			and leave_type_id='" . $row["id"] . "' and emp_id='" . $emp_id . "'";
                $rs2 = mysql_query($sql2);
                if ($rs2 && mysql_num_rows($rs2) > 0) {
                    $row2 = mysql_fetch_array($rs2);
                    if (!is_null($row2['c'])) {
                        $sum_leave = $row2['c'];
                    } else {
                        $sum_leave = 0;
                    }
                } else {
                    $sum_leave = 0;
                }
			$curr= date('Y');
			$sql2="SELECT leave_balance as smd FROM leave_balance
			where emp_id='" . $emp_id . "' AND Date='".$curr."'";
			$rs2 = mysql_query($sql2);
			$row2 = mysql_fetch_array($rs2);
			$last_balance = $row2["smd"];

            $sql3 = "SELECT days FROM leave_group l
             where from_year<=" . $work_year . " and to_year>=" . $work_year . "
			and leave_type_id='" . $row["id"] . "'
			and group_for_leave_id=" . $group_for_leave_id;
                $rs3 = mysql_query($sql3);

                if ($rs3 && mysql_num_rows($rs3) > 0) {
                    $row3 = mysql_fetch_array($rs3);
                    $days = $row3['days'];
					if($row['type_name']=="Annual Leave"){
					$days1=$days+ $last_balance;
					}else{
					$days1=$days;
					}
					$balance=$days1 - $sum_leave;
                } else {
                    $days = 0;
                }
				if($days==0){
				$balance=0;
				}
   
if($row['type_name']!="Annual Leave"){
$last_balance ="0";
}
              
    echo '<tr>
	 <td>' . $row["type_name"] . '</td>
	  <td class="middle">' .$sum_leave . '</td>
	  <td class="middle">' . $days . '</td>
	  <td class="middle">' . $last_balance  . '</td>
	  <td class="middle">' . $balance  . '</td>
	</tr>';
   
	

                   
                
     
  }
           
	
} 

echo '</table>';
?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>