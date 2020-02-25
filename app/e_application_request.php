<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

echo '<table style="width: 100%;">';
if (isset($_COOKIE["igen_user_id"])) {
    $emp_id = $_COOKIE["igen_user_id"];
	 $user_id=$_COOKIE["igen_user_id"];
    $sql1 = "SELECT position_id,branch_id,dep_id,group_id FROM employee e where id=" . $emp_id; /* dep_id,group_id */
    $rs1 = mysql_query($sql1);
    $row1 = mysql_fetch_array($rs1);
    $position_id = $row1["position_id"];
    $dep_id = $row1["dep_id"];
    $group_id = $row1["group_id"];
 /*
    $sql2 = "SELECT * FROM approval a where dep_id='" . $dep_id . "' and (level_pos_1=" . $position_id . " or level_pos_2=" . $position_id
            . " or level_pos_3=" . $position_id . " or superior_1=" . $emp_id
            . " or superior_2=" . $emp_id . " or superior_3=" . $emp_id . ")"; //.".$emp_id; /*dep_id,group_id*/
    //$rs2 = mysql_query($sql2);

	$sql2  = "SELECT * FROM approval WHERE
                            (level_pos_1=" . $user_id
                            . " OR level_pos_2=" . $user_id
                            . " OR level_pos_3=" . $user_id . " OR superior_1=" . $user_id
                            . " OR superior_2=" . $user_id . " OR superior_3=" . $user_id . ")";
                     $rs2 = mysql_query($sql2 );
					
				
					
    $got_record1 = "";
    $got_record2 = "";
    $got_record3 = "";
    $got_record4 = "";
    $got_record5 = "";
	
    while ($row2 = mysql_fetch_array($rs2)) {
	   $dep=$row2['dep_id'];
	   $superv1=$row2["superior_1"];
	   $superv2=$row2["superior_2"];
	   $superv3=$row2["superior_3"];
	
        //training only
		   if ($row2["superior_1"] == $emp_id) {
        $sql3 = "SELECT et.id, et.employee_id,et.depid, e.full_name, et.approval_1, et.approval_2
                 FROM employee_training et join employee e on et.employee_id=e.id
                 where request_status='Pending' and et.depid=" . $row2["dep_id"] . " AND et.employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs3 = mysql_query($sql3);
	
 
        //employee_leave
        $sql4 = "SELECT l.id, l.emp_id,e.full_name, l.depid, l.approval_1, l.approval_2
                 FROM employee_leave l
                 join employee e on l.emp_id=e.id
		 where request_status='Pending' and (l.depid=" . $row2["dep_id"] . ") AND l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs4 = mysql_query($sql4);

        //employee_overtime
        $sql5 = "SELECT eo.id, eo.emp_id, eo.depid, e.full_name, eo.approval_1, eo.approval_2
                 FROM employee_overtime eo
		 join employee e on eo.emp_id=e.id
		 where ot_status='Pending' and eo.depid=" . $row2["dep_id"] . " AND eo.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs5 = mysql_query($sql5);

        //holiday_replacement
        $sql6 = "SELECT hr.id, hr.emp_id,e.full_name, hr.depid, hr.approval_1,hr.approval_2
		 FROM holiday_replacement hr
		 join employee e on hr.emp_id=e.id
		 where replacement_status='Pending' and hr.depid=" . $row2["dep_id"] . " AND hr.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs6 = mysql_query($sql6);

        //employee_loan
        $sql7 = "SELECT *, el.id, el.emp_id, el.depid, e.full_name,el.approval_1,el.approval_2
		 FROM employee_loan el
		 join employee e on el.emp_id=e.id
		 where loan_status='Pending'  and (el.depid=" . $row2["dep_id"] . ") AND el.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."');";
        $rs7 = mysql_query($sql7);

        //employee_claim
        $sql8 = "SELECT *, ec.id, ec.emp_id,ec.depid,e.full_name,ec.approval_1,ec.approval_2
		 FROM employee_claim ec
		 join employee e on ec.emp_id=e.id
		 where claim_status='Pending' and ec.depid=" . $row2["dep_id"] . " AND ec.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs8 = mysql_query($sql8);
		//employee movement
        $sql9 = "SELECT*, ec.id, ec.emp_id, ec.depid, e.full_name,ec.approval_1,ec.approval_2
		 FROM employee_movement ec
		 join employee e on ec.emp_id=e.id
		 where request_status='Pending'  and ec.depid=" . $row2["dep_id"] . " AND ec.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs9 = mysql_query($sql9);

		//Replacement movement
        $sql10 = "SELECT *, ec.id, ec.emp_id,e.full_name, ec.depid, ec.approval_1,ec.approval_2
		 FROM employee_movement1 ec
		 join employee e on ec.emp_id=e.id
		 where request_status='Pending' and ec.depid=" . $row2["dep_id"] . " AND ec.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs10 = mysql_query($sql10);
      
     
				
		
            if (mysql_num_rows($rs3) > 0 && $rs3) {
                while ($row3 = mysql_fetch_array($rs3)) {
                   
                        $got_record1 = "yes";
                        training_req($row3["id"], $row3["full_name"], '1st level');
                    
                }
            }
            if (mysql_num_rows($rs4) > 0 && $rs4) {
                while ($row4 = mysql_fetch_array($rs4)) {
                  
                        $got_record2 = "yes";
                        leave_req($row4["id"], $row4["full_name"], '1st level');
                    
                }
            }
            if (mysql_num_rows($rs5) > 0 && $rs5) {
                while ($row5 = mysql_fetch_array($rs5)) {
                  
                        $got_record3 = "yes";
                        overtime_req($row5["id"], $row5["full_name"], '1st level');
                    
                }
            }
            if (mysql_num_rows($rs6) > 0 && $rs6) {
                while ($row6 = mysql_fetch_array($rs6)) {
                   
                        $got_record4 = "yes";
                        holiday_replacement_req($row6["id"], $row6["full_name"], '1st level');
                    
                }
            }
            if (mysql_num_rows($rs7) > 0 && $rs7) {
                while ($row7 = mysql_fetch_array($rs7)) {
                    if ($row7['loan_status']=='Pending') {
                        $got_record5 = "yes";
                        loan_req($row7["id"], $row7["full_name"], '1st level');
                    }
                }
            }
            if (mysql_num_rows($rs8) > 0 && $rs8) {
                while ($row8 = mysql_fetch_array($rs8)) {
                    if ($row8['claim_status']=='Pending') {
                        $got_record6 = "yes";
                        claim_req($row8["id"], $row8["full_name"], '1st level');
                    }
                }
            }
			if (mysql_num_rows($rs9) > 0 && $rs9) {
	
                while ($row9 = mysql_fetch_array($rs9)) {
                    if ($row9["request_status"] == "Pending") {
                        $got_record9 = "yes";
                        move_req($row9["id"], $row9["full_name"], '1st level');
                    }
                }
            }
			if (mysql_num_rows($rs10) > 0 && $rs10) {
                while ($row10 = mysql_fetch_array($rs10)) {
                    if ($row10["request_status"] == "Pending") {
                        $got_record10 = "yes";
                        move_req1($row10["id"], $row10["full_name"], '1st level');
                    }
                }
            }
        }
		
		   //training only
		   if ($row2["superior_2"] == $emp_id) {
        $sql3 = "SELECT et.id, et.employee_id,et.depid, e.full_name, et.approval_1, et.approval_2
                 FROM employee_training et join employee e on et.employee_id=e.id
                 where request_status='Approved_lv1' and et.depid=" . $row2["dep_id"] . " AND et.employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs3 = mysql_query($sql3);
	
 
        //employee_leave
        $sql4 = "SELECT l.id, l.emp_id,e.full_name, l.depid, l.approval_1, l.approval_2
                 FROM employee_leave l
                 join employee e on l.emp_id=e.id
		 where request_status='Approved_lv1' and (l.depid=" . $row2["dep_id"] . ") AND l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs4 = mysql_query($sql4);

        //employee_overtime
        $sql5 = "SELECT eo.id, eo.emp_id, eo.depid, e.full_name, eo.approval_1, eo.approval_2
                 FROM employee_overtime eo
		 join employee e on eo.emp_id=e.id
		 where ot_status='Approved_lv1' and eo.depid=" . $row2["dep_id"] . " AND eo.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs5 = mysql_query($sql5);

        //holiday_replacement
        $sql6 = "SELECT hr.id, hr.emp_id,e.full_name, hr.depid, hr.approval_1,hr.approval_2
		 FROM holiday_replacement hr
		 join employee e on hr.emp_id=e.id
		 where replacement_status='Approved_lv1' and hr.depid=" . $row2["dep_id"] . " AND hr.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs6 = mysql_query($sql6);

        //employee_loan
        $sql7 = "SELECT *, el.id, el.emp_id, el.depid, e.full_name,el.approval_1,el.approval_2
		 FROM employee_loan el
		 join employee e on el.emp_id=e.id
		 where loan_status='Approved_lv1'  and (el.depid=" . $row2["dep_id"] . ") AND el.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."');";
        $rs7 = mysql_query($sql7);

        //employee_claim
        $sql8 = "SELECT *, ec.id, ec.emp_id,ec.depid,e.full_name,ec.approval_1,ec.approval_2
		 FROM employee_claim ec
		 join employee e on ec.emp_id=e.id
		 where claim_status='Approved_lv1' and ec.depid=" . $row2["dep_id"] . " AND ec.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs8 = mysql_query($sql8);
		//employee movement
        $sql9 = "SELECT*, ec.id, ec.emp_id, ec.depid, e.full_name,ec.approval_1,ec.approval_2
		 FROM employee_movement ec
		 join employee e on ec.emp_id=e.id
		 where request_status='Approved_lv1'  and ec.depid=" . $row2["dep_id"] . " AND ec.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs9 = mysql_query($sql9);

		//Replacement movement
        $sql10 = "SELECT *, ec.id, ec.emp_id,e.full_name, ec.depid, ec.approval_1,ec.approval_2
		 FROM employee_movement1 ec
		 join employee e on ec.emp_id=e.id
		 where request_status='Approved_lv1' and ec.depid=" . $row2["dep_id"] . " AND ec.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs10 = mysql_query($sql10);
      
     
				
		
            if (mysql_num_rows($rs3) > 0 && $rs3) {
                while ($row3 = mysql_fetch_array($rs3)) {
                   
                        $got_record1 = "yes";
                        training_req($row3["id"], $row3["full_name"], '2nd level');
                    
                }
            }
            if (mysql_num_rows($rs4) > 0 && $rs4) {
                while ($row4 = mysql_fetch_array($rs4)) {
                  
                        $got_record2 = "yes";
                        leave_req($row4["id"], $row4["full_name"], '2nd level');
                    
                }
            }
            if (mysql_num_rows($rs5) > 0 && $rs5) {
                while ($row5 = mysql_fetch_array($rs5)) {
                  
                        $got_record3 = "yes";
                        overtime_req($row5["id"], $row5["full_name"], '2nd level');
                    
                }
            }
            if (mysql_num_rows($rs6) > 0 && $rs6) {
                while ($row6 = mysql_fetch_array($rs6)) {
                   
                        $got_record4 = "yes";
                        holiday_replacement_req($row6["id"], $row6["full_name"], '2nd level');
                    
                }
            }
            if (mysql_num_rows($rs7) > 0 && $rs7) {
				echo"slls";
                while ($row7 = mysql_fetch_array($rs7)) {
			
                    if ($row7['loan_status']=='Approved_lv1') {
                        $got_record5 = "yes";
                        loan_req($row7["id"], $row7["full_name"], '2nd level');
                    }
                }
            }
            if (mysql_num_rows($rs8) > 0 && $rs8) {
                while ($row8 = mysql_fetch_array($rs8)) {
                    if ($row8['claim_status']=='Approved_lv1') {
                        $got_record6 = "yes";
                        claim_req($row8["id"], $row8["full_name"], '2nd level');
                    }
                }
            }
			if (mysql_num_rows($rs9) > 0 && $rs9) {
			
                while ($row9 = mysql_fetch_array($rs9)) {
                    if ($row9["request_status"] == 'Approved_lv1') {
                        $got_record9 = "yes";
                        move_req($row9["id"], $row9["full_name"], '2nd level');
                    }
                }
            }
			if (mysql_num_rows($rs10) > 0 && $rs10) {
                while ($row10 = mysql_fetch_array($rs10)) {
                    if ($row10["request_status"] == 'Approved_lv1') {
                        $got_record10 = "yes";
                        move_req1($row10["id"], $row10["full_name"], '2nd level');
                    }
                }
            }
        }
		   //training only
		   if ($row2["superior_3"] == $emp_id) {
        $sql3 = "SELECT et.id, et.employee_id,et.depid, e.full_name, et.approval_1, et.approval_2
                 FROM employee_training et join employee e on et.employee_id=e.id
                 where request_status='Approved_lv2' and et.depid=" . $row2["dep_id"] . " AND et.employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs3 = mysql_query($sql3);
	
 
        //employee_leave
        $sql4 = "SELECT l.id, l.emp_id,e.full_name, l.depid, l.approval_1, l.approval_2
                 FROM employee_leave l
                 join employee e on l.emp_id=e.id
		 where request_status='Approved_lv2' and (l.depid=" . $row2["dep_id"] . ") AND l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs4 = mysql_query($sql4);

        //employee_overtime
        $sql5 = "SELECT eo.id, eo.emp_id, eo.depid, e.full_name, eo.approval_1, eo.approval_2
                 FROM employee_overtime eo
		 join employee e on eo.emp_id=e.id
		 where ot_status='Approved_lv2' and eo.depid=" . $row2["dep_id"] . " AND eo.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs5 = mysql_query($sql5);

        //holiday_replacement
        $sql6 = "SELECT hr.id, hr.emp_id,e.full_name, hr.depid, hr.approval_1,hr.approval_2
		 FROM holiday_replacement hr
		 join employee e on hr.emp_id=e.id
		 where replacement_status='Approved_lv2' and hr.depid=" . $row2["dep_id"] . " AND hr.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs6 = mysql_query($sql6);

        //employee_loan
        $sql7 = "SELECT *, el.id, el.emp_id, el.depid, e.full_name,el.approval_1,el.approval_2
		 FROM employee_loan el
		 join employee e on el.emp_id=e.id
		 where loan_status='Approved_lv2'  and (el.depid=" . $row2["dep_id"] . ") AND el.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."');";
        $rs7 = mysql_query($sql7);

        //employee_claim
        $sql8 = "SELECT *, ec.id, ec.emp_id,ec.depid,e.full_name,ec.approval_1,ec.approval_2
		 FROM employee_claim ec
		 join employee e on ec.emp_id=e.id
		 where claim_status='Approved_lv2' and ec.depid=" . $row2["dep_id"] . " AND ec.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs8 = mysql_query($sql8);
		//employee movement
        $sql9 = "SELECT*, ec.id, ec.emp_id, ec.depid, e.full_name,ec.approval_1,ec.approval_2
		 FROM employee_movement ec
		 join employee e on ec.emp_id=e.id
		 where request_status='Approved_lv2'  and ec.depid=" . $row2["dep_id"] . " AND ec.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs9 = mysql_query($sql9);

		//Replacement movement
        $sql10 = "SELECT *, ec.id, ec.emp_id,e.full_name, ec.depid, ec.approval_1,ec.approval_2
		 FROM employee_movement1 ec
		 join employee e on ec.emp_id=e.id
		 where request_status='Approved_lv2' and ec.depid=" . $row2["dep_id"] . " AND ec.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')";
        $rs10 = mysql_query($sql10);
      
     
				
		
            if (mysql_num_rows($rs3) > 0 && $rs3) {
                while ($row3 = mysql_fetch_array($rs3)) {
                   
                        $got_record1 = "yes";
                        training_req($row3["id"], $row3["full_name"], '3rd level');
                    
                }
            }
            if (mysql_num_rows($rs4) > 0 && $rs4) {
                while ($row4 = mysql_fetch_array($rs4)) {
                  
                        $got_record2 = "yes";
                        leave_req($row4["id"], $row4["full_name"], '3rd level');
                    
                }
            }
            if (mysql_num_rows($rs5) > 0 && $rs5) {
                while ($row5 = mysql_fetch_array($rs5)) {
                  
                        $got_record3 = "yes";
                        overtime_req($row5["id"], $row5["full_name"], '3rd level');
                    
                }
            }
            if (mysql_num_rows($rs6) > 0 && $rs6) {
                while ($row6 = mysql_fetch_array($rs6)) {
                   
                        $got_record4 = "yes";
                        holiday_replacement_req($row6["id"], $row6["full_name"], '3rd level');
                    
                }
            }
            if (mysql_num_rows($rs7) > 0 && $rs7) {
			
                while ($row7 = mysql_fetch_array($rs7)) {
			
                    if ($row7['loan_status']=='Approved_lv2') {
                        $got_record5 = "yes";
                        loan_req($row7["id"], $row7["full_name"], '3rd level');
                    }
                }
            }
            if (mysql_num_rows($rs8) > 0 && $rs8) {
                while ($row8 = mysql_fetch_array($rs8)) {
                    if ($row8['claim_status']=='Approved_lv2') {
                        $got_record6 = "yes";
                        claim_req($row8["id"], $row8["full_name"], '3rd level');
                    }
                }
            }
			if (mysql_num_rows($rs9) > 0 && $rs9) {
			
                while ($row9 = mysql_fetch_array($rs9)) {
                    if ($row9["request_status"] == 'Approved_lv2') {
                        $got_record9 = "yes";
                        move_req($row9["id"], $row9["full_name"], '3rd level');
                    }
                }
            }
			if (mysql_num_rows($rs10) > 0 && $rs10) {
                while ($row10 = mysql_fetch_array($rs10)) {
                    if ($row10["request_status"] == 'Approved_lv2') {
                        $got_record10 = "yes";
                        move_req1($row10["id"], $row10["full_name"], '3rd level');
                    }
                }
            }
        }
		/*
		else if ($row2["level_pos_2"] == $position_id || $row2["superior_2"] == $emp_id) {
		
            if (mysql_num_rows($rs3) > 0 && $rs3) {
                while ($row3 = mysql_fetch_array($rs3)) {
                    if ($row3["approval_1"] != "" && $row3["approval_2"] == "") {
                        $got_record1 = "yes";
                        training_req($row3["id"], $row3["full_name"], '2nd level');
                    }
                }
            }
            if (mysql_num_rows($rs4) > 0 && $rs4) {
                while ($row4 = mysql_fetch_array($rs4)) {
                    if ($row4["approval_1"] != "" && $row4["approval_2"] == "") {
                        $got_record2 = "yes";
                        leave_req($row4["id"], $row4["full_name"], '2nd level');
                    }
                }
            }
            if (mysql_num_rows($rs5) > 0 && $rs5) {
                while ($row5 = mysql_fetch_array($rs5)) {
                    if ($row5["approval_1"] != "" && $row5["approval_2"] == "") {
                        $got_record3 = "yes";
                        overtime_req($row5["id"], $row5["full_name"], '2nd level');
                    }
                }
            }
            if (mysql_num_rows($rs6) > 0 && $rs6) {
                while ($row6 = mysql_fetch_array($rs6)) {
                    if ($row6["approval_1"] != "" && $row6["approval_2"] == "") {
                        $got_record4 = "yes";
                        holiday_replacement_req($row6["id"], $row6["full_name"], '2nd level');
                    }
                }
            }
            if (mysql_num_rows($rs7) > 0 && $rs7) {
                while ($row7 = mysql_fetch_array($rs7)) {
                    if ($row7['loan_status']=='Approved_lv1') {
                        $got_record5 = "yes";
                        loan_req($row7["id"], $row7["full_name"], '2nd level');
                    }
                }
            }
            if (mysql_num_rows($rs8) > 0 && $rs8) {
                while ($row8 = mysql_fetch_array($rs8)) {
                    if ($row8['claim_status']=='Approved_lv1') {
                        $got_record6 = "yes";
                        claim_req($row8["id"], $row8["full_name"], '2nd level');
                    }
                }
            }
			if (mysql_num_rows($rs9) > 0 && $rs9) {
                while ($row9 = mysql_fetch_array($rs9)) {
                    if ($row9["request_status"] == "Approved_lv1") {
                        $got_record9 = "yes";
                        move_req($row9["id"], $row9["full_name"], '2st level');
                    }
                }
            }
			if (mysql_num_rows($rs10) > 0 && $rs10) {
                while ($row10 = mysql_fetch_array($rs10)) {
                    if ($row10["request_status"] == "Approved_lv1") {
                        $got_record10 = "yes";
                        move_req1($row10["id"], $row10["full_name"], '2st level');
                    }
                }
            }
        } else if ($row2["level_pos_3"] == $position_id || $row2["superior_3"] == $emp_id) {
		
            if (mysql_num_rows($rs3) > 0 && $rs3) {
                while ($row3 = mysql_fetch_array($rs3)) {
                    if ($row3["approval_1"] != "" && $row3["approval_2"] != "") {
                        $got_record1 = "yes";
                        training_req($row3["id"], $row3["full_name"], '3rd level');
                    }
                }
            }
            if (mysql_num_rows($rs4) > 0 && $rs4) {
                while ($row4 = mysql_fetch_array($rs4)) {
                    if ($row4["approval_1"] != "" && $row4["approval_2"] != "") {
                        $got_record2 = "yes";
                        leave_req($row4["id"], $row4["full_name"], '3rd level');
                    }
                }
            }
            if (mysql_num_rows($rs5) > 0 && $rs5) {
                while ($row5 = mysql_fetch_array($rs5)) {
                    if ($row5["approval_1"] != "" && $row5["approval_2"] != "") {
                        $got_record3 = "yes";
                        overtime_req($row5["id"], $row5["full_name"], '3rd level');
                    }
                }
            }
            if (mysql_num_rows($rs6) > 0 && $rs6) {
                while ($row6 = mysql_fetch_array($rs6)) {
                    if ($row6["approval_1"] != "" && $row6["approval_2"] != "") {
                        $got_record4 = "yes";
                        holiday_replacement_req($row6["id"], $row6["full_name"], '3rd level');
                    }
                }
            }
            if (mysql_num_rows($rs7) > 0 && $rs7) {
                while ($row7 = mysql_fetch_array($rs7)) {
                    if ($row7['loan_status']=='Approved_lv2') {
                        $got_record5 = "yes";
                        loan_req($row7["id"], $row7["full_name"], '3rd level');
                    }
                }
            }
            if (mysql_num_rows($rs8) > 0 && $rs8) {
                while ($row8 = mysql_fetch_array($rs8)) {
                    if ($row8['claim_status']=='Approved_lv2') {
                        $got_record6 = "yes";
                        claim_req($row8["id"], $row8["full_name"], '3rd level');
                    }
                }
            }
			if (mysql_num_rows($rs9) > 0 && $rs9) {
                while ($row9 = mysql_fetch_array($rs9)) {
                    if ($row9["request_status"] == "Approved_lv2") {
                        $got_record9 = "yes";
                        move_req($row9["id"], $row9["full_name"], '3st level');
                    }
                }
            }
			
			if (mysql_num_rows($rs10) > 0 && $rs10) {
			
                while ($row10 = mysql_fetch_array($rs10)) {
                    if ($row10["request_status"] == "Approved_lv2") {
                        $got_record10 = "yes";
                        move_req1($row10["id"], $row10["full_name"], '3st level');
                    }
                }
            }
        }
		*/
    }
   $sql_dep = "select * from approval_m where emp_id='" .$user_id. "' OR backup='" .$user_id. "'";
    $rs_dep = mysql_query($sql_dep);
	$num_rows= mysql_num_rows($rs_dep);
	//$row_dep = mysql_fetch_array($rs_dep);
	//$row_dep = mysql_fetch_assoc($rs_dep);

	

					
	if($num_rows>0){
	while($row_dep = mysql_fetch_array($rs_dep)){
					$lv1=$row_dep['lv1'];
					$lv2=$row_dep['lv2'];
					$lv3=$row_dep['lv3'];
					$dep=$row_dep['dep_id'];
					    $sql3 = "SELECT et.id, et.employee_id,et.depid, e.full_name, et.approval_1, et.approval_2
                 FROM employee_training et join employee e on et.employee_id=e.id
                 where request_status='Pending' and et.depid=" . $row_dep["dep_id"] . " AND et.employee_id IN('".$lv1."', '".$lv2."', '".$lv3."')";
        $rs3 = mysql_query($sql3);
	
 
        //employee_leave
        $sql4 = "SELECT l.id, l.emp_id,e.full_name, l.depid, l.approval_1, l.approval_2
                 FROM employee_leave l
                 join employee e on l.emp_id=e.id
		 where request_status='Pending' and (l.depid=" . $row_dep["dep_id"] . ") AND l.emp_id IN('".$lv1."', '".$lv2."', '".$lv3."')";
        $rs4 = mysql_query($sql4);

        //employee_overtime
        $sql5 = "SELECT eo.id, eo.emp_id, eo.depid, e.full_name, eo.approval_1, eo.approval_2
                 FROM employee_overtime eo
		 join employee e on eo.emp_id=e.id
		 where ot_status='Pending' and eo.depid=" . $row_dep["dep_id"] . " AND eo.emp_id IN('".$lv1."', '".$lv2."', '".$lv3."')";
        $rs5 = mysql_query($sql5);

        //holiday_replacement
        $sql6 = "SELECT hr.id, hr.emp_id,e.full_name, hr.depid, hr.approval_1,hr.approval_2
		 FROM holiday_replacement hr
		 join employee e on hr.emp_id=e.id
		 where replacement_status='Pending' and hr.depid=" . $row_dep["dep_id"] . " AND hr.emp_id IN('".$lv1."', '".$lv2."', '".$lv3."')";
        $rs6 = mysql_query($sql6);

        //employee_loan
        $sql7 = "SELECT *, el.id, el.emp_id, el.depid, e.full_name,el.approval_1,el.approval_2
		 FROM employee_loan el
		 join employee e on el.emp_id=e.id
		 where loan_status='Pending'  and (el.depid=" . $row_dep["dep_id"] . ") AND el.emp_id IN('".$lv1."', '".$lv2."', '".$lv3."')";
        $rs7 = mysql_query($sql7);

        //employee_claim
        $sql8 = "SELECT *, ec.id, ec.emp_id,ec.depid,e.full_name,ec.approval_1,ec.approval_2
		 FROM employee_claim ec
		 join employee e on ec.emp_id=e.id
		 where claim_status='Pending' and ec.depid=" . $row_dep["dep_id"] . " AND ec.emp_id IN('".$lv1."', '".$lv2."', '".$lv3."')";
        $rs8 = mysql_query($sql8);
		//employee movement
        $sql9 = "SELECT*, ec.id, ec.emp_id, ec.depid, e.full_name,ec.approval_1,ec.approval_2
		 FROM employee_movement ec
		 join employee e on ec.emp_id=e.id
		 where request_status='Pending'  and ec.depid=" . $row_dep["dep_id"] . " AND ec.emp_id IN('".$lv1."', '".$lv2."', '".$lv3."')";
        $rs9 = mysql_query($sql9);

		//Replacement movement
        $sql10 = "SELECT *, ec.id, ec.emp_id,e.full_name, ec.depid, ec.approval_1,ec.approval_2
		 FROM employee_movement1 ec
		 join employee e on ec.emp_id=e.id
		 where request_status='Pending' and ec.depid=" . $row_dep["dep_id"] . " AND ec.emp_id IN('".$lv1."', '".$lv2."', '".$lv3."')";
        $rs10 = mysql_query($sql10);
      
     
				
		
            if (mysql_num_rows($rs3) > 0 && $rs3) {
                while ($row3 = mysql_fetch_array($rs3)) {
                   
                        $got_record1 = "yes";
                        training_req($row3["id"], $row3["full_name"], '1st level');
                    
                }
            }
            if (mysql_num_rows($rs4) > 0 && $rs4) {
                while ($row4 = mysql_fetch_array($rs4)) {
                  
                        $got_record2 = "yes";
                        leave_req($row4["id"], $row4["full_name"], '1st level');
                    
                }
            }
            if (mysql_num_rows($rs5) > 0 && $rs5) {
                while ($row5 = mysql_fetch_array($rs5)) {
                  
                        $got_record3 = "yes";
                        overtime_req($row5["id"], $row5["full_name"], '1st level');
                    
                }
            }
            if (mysql_num_rows($rs6) > 0 && $rs6) {
                while ($row6 = mysql_fetch_array($rs6)) {
                   
                        $got_record4 = "yes";
                        holiday_replacement_req($row6["id"], $row6["full_name"], '1st level');
                    
                }
            }
            if (mysql_num_rows($rs7) > 0 && $rs7) {
                while ($row7 = mysql_fetch_array($rs7)) {
                    if ($row7['loan_status']=='Pending') {
                        $got_record5 = "yes";
                        loan_req($row7["id"], $row7["full_name"], '1st level');
                    }
                }
            }
            if (mysql_num_rows($rs8) > 0 && $rs8) {
                while ($row8 = mysql_fetch_array($rs8)) {
                    if ($row8['claim_status']=='Pending') {
                        $got_record6 = "yes";
                        claim_req($row8["id"], $row8["full_name"], '1st level');
                    }
                }
            }
			if (mysql_num_rows($rs9) > 0 && $rs9) {
	
                while ($row9 = mysql_fetch_array($rs9)) {
                    if ($row9["request_status"] == "Pending") {
                        $got_record9 = "yes";
                        move_req($row9["id"], $row9["full_name"], '1st level');
                    }
                }
            }
			if (mysql_num_rows($rs10) > 0 && $rs10) {
                while ($row10 = mysql_fetch_array($rs10)) {
                    if ($row10["request_status"] == "Pending") {
                        $got_record10 = "yes";
                        move_req1($row10["id"], $row10["full_name"], '1st level');
                    }
                }
            }
					
					}
	
	
	}
    if ($got_record1 == "" && $got_record2 == "" && $got_record3 == "" && $got_record4 == "" && $got_record5 == "" && $got_record6 == ""  && $got_record9 == "" && $got_record10 == "") {
        echo "No Pending Request.";
    }
}
echo '</table>';

function training_req($id, $full_name, $extra) {
    echo "<tr><td style='width: 220px;'>Training Request</td><td><a href='?loc=training_approval&id=" . $id . "'>" . $full_name . ' ( ' . $extra . " )</a></td></tr>";
}

function leave_req($id, $full_name, $extra) { 

    echo "<tr><td style='width: 220px;'>Leave Request</td><td><a href='?loc=leave_approval&id=" . $id . "'>" . $full_name . ' ( ' . $extra . " )</a></td></tr>";
}

function overtime_req($id, $full_name, $extra) {
    echo "<tr><td style='width: 220px;'>Overtime Request</td><td><a href='?loc=overtime_approval&id=" . $id . "'>" . $full_name . ' ( ' . $extra . " )</a></td></tr>";
}

function holiday_replacement_req($id, $full_name, $extra) {
    echo "<tr><td style='width: 220px;'>Holiday Replacement Request</td><td><a href='?loc=replacement_approval&id=" . $id . "'>" . $full_name . ' ( ' . $extra . " )</a></td></tr>";
}

function loan_req($id, $full_name, $extra) {
    echo "<tr><td style='width: 220px;'>Loan Request</td><td><a href='?loc=loan_approval&id=" . $id . "'>" . $full_name . ' ( ' . $extra . " )</a></td></tr>";
}

function claim_req($id, $full_name, $extra) {
    echo "<tr><td style='width: 220px;'>Claim Request</td><td><a href='?loc=claim_approval&id=" . $id . "'>" . $full_name . ' ( ' . $extra . " )</a></td></tr>";
}
function move_req($id, $full_name, $extra) {
    echo "<tr><td style='width: 220px;'>Off Time Request</td><td><a href='?loc=move_approval&id=" . $id . "'>" . $full_name . ' ( ' . $extra . " )</a></td></tr>";
} 
function move_req1($id, $full_name, $extra) {
    echo "<tr><td style='width: 220px;'>Movement Request</td><td><a href='?loc=movement_approval&id=" . $id . "'>" . $full_name . ' ( ' . $extra . " )</a></td></tr>";
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