<?php
 if (isset($_COOKIE["igen_user_id"])  || isset($_COOKIE["igen_id"])) {
                    if($_COOKIE["igen_id"]==""){
						$user_id = $_COOKIE["igen_user_id"];
					}else{
						$user_id = $_COOKIE["igen_id"];
					}

                    $sql1 = "SELECT position_id, dep_id, group_id FROM employee e where id=" . $user_id;
                    $rs1 = mysql_query($sql1);
                    $row1 = mysql_fetch_array($rs1);
                    $position_id = $row1["position_id"];
                    $dep_id = $row1["dep_id"];
                    $group_id = $row1["group_id"];        
              		
                  $count1=0;
				  $count2=0;
				  $count=0;
				  $count3=0;
				  $count4=0;
				  $count5=0;
				  $count6=0;
			      $count7=0;
								
	
				 $sql_2 = "SELECT * FROM approval WHERE
                            (level_pos_1=" . $user_id
                            . " OR level_pos_2=" . $user_id
                            . " OR level_pos_3=" . $user_id . " OR superior_1=" . $user_id
                            . " OR superior_2=" . $user_id . " OR superior_3=" . $user_id . ")";
                    $rs_2 = mysql_query($sql_2);
					$count_2= mysql_num_rows( $rs_2);
				
					 while($row2 = mysql_fetch_array($rs_2)){
					
					   $dep=$row2['dep_id'];
					$superv1=$row2["superior_1"];
					$superv2=$row2["superior_2"];
					$superv3=$row2["superior_3"];
					$level_pos_1=$row2["level_pos_1"];
					$level_pos_2=$row2["level_pos_2"];
					$level_pos_3=$row2["level_pos_3"];
				 
					 if($superv1==$user_id || $level_pos_1==$user_id){
					
					 $sql2 = "SELECT * FROM employee_leave  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND request_status='Pending'";
					 $rs2 = mysql_query($sql2);
					$count+= mysql_num_rows($rs2);
						
					
					 } 
					 if($superv2==$user_id || $level_pos_2==$user_id){
					   
					 $sql2 = "SELECT * FROM employee_leave  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND request_status='Approved_lv1'";
					 $rs2 = mysql_query($sql2);
					$count+= mysql_num_rows($rs2);
				
					
					 }
					 if($superv3==$user_id || $level_pos_3==$user_id){
					 	
					 $sql2 = "SELECT * FROM employee_leave  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND request_status='Approved_lv2'";
					 $rs2 = mysql_query($sql2);
					$count+= mysql_num_rows($rs2);
					
			    
					
					 }
					 
					
			
                    
				if($superv1==$user_id || $level_pos_1==$user_id){
					
					 $sql3 = "SELECT * FROM employee_claim  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND claim_status='Pending'";
                    $rs3 = mysql_query($sql3);
					$count1+= mysql_num_rows($rs3);
					$row=mysql_fetch_assoc($rs3);
					
				 
					
					}
					if($superv2==$user_id || $level_pos_2==$user_id){
					
					
					 $sql3 = "SELECT * FROM employee_claim  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND claim_status='Approved_lv1'";
                    $rs3 = mysql_query($sql3);
					$count1 += mysql_num_rows($rs3);
					
				
					} 
					if($superv3==$user_id || $level_pos_3==$user_id){
					
					
					 $sql3 = "SELECT * FROM employee_claim  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND claim_status='Approved_lv2'";
                    $rs3 = mysql_query($sql3);
					$count1+= mysql_num_rows($rs3);
					
						
					}
					if($superv1==$user_id || $level_pos_1==$user_id){
                       
					 $sql4 = "SELECT * FROM employee_loan  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND loan_status='Pending'";
                    $rs4 = mysql_query($sql4);
					$count2+= mysql_num_rows($rs4);
				
					}
					
					if($superv2==$user_id || $level_pos_2==$user_id){
				

					 $sql4 = "SELECT * FROM employee_loan  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND loan_status='Approved_lv1'";
                    $rs4 = mysql_query($sql4);
					$count2+= mysql_num_rows($rs4);
					
					}
					if($superv3==$user_id || $level_pos_3==$user_id){

					 $sql4 = "SELECT * FROM employee_loan  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND loan_status='Approved_lv2'";
                    $rs4 = mysql_query($sql4);
					$count2+= mysql_num_rows($rs4);
					
					}
					
					if($superv1==$user_id || $level_pos_1==$user_id){

					 
					 $sql5 = "SELECT * FROM employee_movement1  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND request_status='Pending'";
                    $rs5 = mysql_query($sql5);
					$count3+= mysql_num_rows($rs5);
					
					}
					if($superv2==$user_id || $level_pos_2==$user_id){

					 
					 $sql5 = "SELECT * FROM employee_movement1  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND request_status='Approved_lv1'";
                    $rs5 = mysql_query($sql5);
					$count3+= mysql_num_rows($rs5);
					
					}
					if($superv3==$user_id || $level_pos_3==$user_id){

					 
					 $sql5 = "SELECT * FROM employee_movement1  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND request_status='Approved_lv2'";
                    $rs5 = mysql_query($sql5);
					$count3+= mysql_num_rows($rs5);
					
					}
						if($superv1==$user_id || $level_pos_1==$user_id){

					 
					 $sql6 = "SELECT * FROM employee_movement  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND request_status='Pending'";
                    $rs6 = mysql_query($sql6);
					$count4+= mysql_num_rows($rs6);
					
					}
					if($superv2==$user_id || $level_pos_2==$user_id){

					 
					 $sql6 = "SELECT * FROM employee_movement  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND request_status='Approved_lv1'";
                    $rs6 = mysql_query($sql6);
					$count4+= mysql_num_rows($rs6);
					
					}
					if($superv3==$user_id || $level_pos_3==$user_id){

					$sql6 = "SELECT * FROM employee_movement  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND request_status='Approved_lv2'";
                    $rs6 = mysql_query($sql6);
					$count4+= mysql_num_rows($rs6);
					
					}
						if($superv1==$user_id || $level_pos_1==$user_id){
                      
					 
					 $sql7 = "SELECT * FROM employee_training  WHERE depid='".$dep."' AND employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND request_status='Pending'";
                    $rs7 = mysql_query($sql7);
					$count5+= mysql_num_rows($rs7);
					
					}
					if($superv2==$user_id || $level_pos_2==$user_id){

					 
					 $sql7 = "SELECT * FROM employee_training  WHERE depid='".$dep."' AND employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND request_status='Approved_lv1'";
                    $rs7 = mysql_query($sql7);
					$count5+= mysql_num_rows($rs7);
					
					}
					
					if($superv3==$user_id || $level_pos_3==$user_id){

					$sql7 = "SELECT * FROM employee_training WHERE depid='".$dep."' AND employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND request_status='Approved_lv2'";
                    $rs7 = mysql_query($sql7);
					$count5+= mysql_num_rows($rs7);
					
					}
					
					
						if($superv1==$user_id || $level_pos_1==$user_id){
                      
					 
					 $sql8 = "SELECT * FROM holiday_replacement  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND replacement_status='Pending'";
                    $rs8 = mysql_query($sql8);
					$count6+= mysql_num_rows($rs8);
					
					}
					if($superv2==$user_id || $level_pos_2==$user_id){

					 
					 $sql8 = "SELECT * FROM holiday_replacement  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND replacement_status='Approved_lv1'";
                    $rs8 = mysql_query($sql8);
					$count6+= mysql_num_rows($rs8);
					
					}
					
					if($superv3==$user_id || $level_pos_3==$user_id){

					$sql8 = "SELECT * FROM holiday_replacement  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND replacement_status='Approved_lv2'";
                    $rs8 = mysql_query($sql8);
					$count6+= mysql_num_rows($rs8);
					
					}
					
						if($superv1==$user_id || $level_pos_1==$user_id){
                      
					 
					 $sql9 = "SELECT * FROM employee_overtime  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND ot_status='Pending'";
                    $rs9 = mysql_query($sql9);
					$count7+= mysql_num_rows($rs9);
					
					}
					if($superv2==$user_id || $level_pos_2==$user_id){

					 
					 $sql9 = "SELECT * FROM employee_overtime  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND ot_status='Approved_lv1'";
                    $rs9 = mysql_query($sql9);
					$count7+= mysql_num_rows($rs9);
				
					}
					
					if($superv3==$user_id || $level_pos_3==$user_id){

					$sql9 = "SELECT * FROM employee_overtime  WHERE depid='".$dep."' AND emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND ot_status='Approved_lv2'";
                    $rs9 = mysql_query($sql9);
					$count7+= mysql_num_rows($rs9);
					
					}
					
					}
											$sql_dep = "select * from approval_m where emp_id='" .$user_id. "' OR backup='" .$user_id. "'";
    $rs_dep = mysql_query($sql_dep);
	$num_rows= mysql_num_rows($rs_dep);
	//$row_dep = mysql_fetch_array($rs_dep);
	//$row_dep = mysql_fetch_assoc($rs_dep);


					
	if($num_rows >0){
					
						while($row_dep = mysql_fetch_array($rs_dep)){
					$lv1=$row_dep['lv1'];
					$lv2=$row_dep['lv2'];
					$lv3=$row_dep['lv3'];
					$dep=$row_dep['dep_id'];
					 $sql2 = "SELECT * FROM employee_leave  WHERE depid='".$dep."' AND emp_id IN('".$lv1."', '".$lv2."', '".$lv3."') AND request_status='Pending'";
					 $rs2 = mysql_query($sql2);
					$count+= mysql_num_rows($rs2);
					
					 $sql3 = "SELECT * FROM employee_claim  WHERE depid='".$dep."' AND emp_id IN('".$lv1."', '".$lv2."', '".$lv3."') AND claim_status='Pending'";
                    $rs3 = mysql_query($sql3);
					$count1+= mysql_num_rows($rs3);
					$row=mysql_fetch_assoc($rs3);
					
					$sql4 = "SELECT * FROM employee_loan  WHERE depid='".$dep."' AND emp_id IN('".$lv1."', '".$lv2."', '".$lv3."')  AND loan_status='Pending'";
                    $rs4 = mysql_query($sql4);
					$count2+= mysql_num_rows($rs4);
					$sql6 = "SELECT * FROM employee_movement  WHERE depid='".$dep."' AND emp_id IN('".$lv1."', '".$lv2."', '".$lv3."') AND request_status='Pending'";
                    $rs6 = mysql_query($sql6);
					$count4+= mysql_num_rows($rs6);
					 $sql5 = "SELECT * FROM employee_movement1  WHERE depid='".$dep."' AND emp_id IN('".$lv1."', '".$lv2."', '".$lv3."') AND request_status='Pending'";
                    $rs5 = mysql_query($sql5);
					$count3+= mysql_num_rows($rs5);
					 
					 $sql9 = "SELECT * FROM employee_overtime  WHERE depid='".$dep."' AND emp_id  IN('".$lv1."', '".$lv2."', '".$lv3."') AND ot_status='Pending'";
                    $rs9 = mysql_query($sql9);
					$count7+= mysql_num_rows($rs9);
					
                  $sql7 = "SELECT * FROM employee_training  WHERE depid='".$dep."' AND employee_id IN('".$lv1."', '".$lv2."', '".$lv3."') AND request_status='Pending'";
                    $rs7 = mysql_query($sql7);
					$count5+= mysql_num_rows($rs7);
					
					 $sql8 = "SELECT * FROM holiday_replacement  WHERE depid='".$dep."' AND emp_id IN('".$lv1."', '".$lv2."', '".$lv3."') AND replacement_status='Pending'";
                    $rs8 = mysql_query($sql8);
					$count6+= mysql_num_rows($rs8);
			
					}
					
					}
					$move1_count=$count4 + $count3;
					 $total_count=$count1 + $count2 + $count3 + $count4 + $count + $count5 + $count6 + $count7;
				
						//$total_count=$over1_count + $loan1_count + $move1_count +  $claim1_count + $leave1_count;
					
 }		
				
					
					


?>