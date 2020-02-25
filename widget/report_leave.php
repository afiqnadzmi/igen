 <head>
        <?php
        $month = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

		
			<table border="1" class="tableth" style="border-collapse: collapse;width: 100%;">
						 <thead><tr>  
            <th class="title_bold" style="width: 100px;">Employee Name</th>						 
			<th class="title_bold" style="width: 100px;">Leave Type</th>
			<th class="title_bold" style="width: 100px;">Utilized leave</th>
			<th class="title_bold" style="width: 100px;">Entitle leave</td>
			<th class="title_bold" style="width: 100px;">Balance</th>
			</tr>    </thead>
			<?php
			
			$curr= date('Y');
			$lat_year=date('Y', strtotime('-1 year'));
			   if($_GET['emp']==""){
				$emp_id1 = $_COOKIE['igen_user_id'];
			}else{
				 $emp_id1=$_GET['emp'];
			}	
			$sql1 = "select join_date,group_for_leave_id, id, full_name from employee where emp_status = '" . $_GET["status"] . "'";
			if (!empty($_GET["emp_id"])) {
                $sql1.=" AND id in(" . $_GET["emp_id"] . ")";
            } else {
                if ($_GET["dep_id"] == "0") {
                    $sql1.=" AND emp.branch_id=" . $_GET["branch_id"];
                } else {
                    $sql1.=" AND emp.dep_id=" . $_GET["dep_id"];
                }
            }
         
			$rs1 = mysql_query($sql1);
			//$row1 = mysql_fetch_array($rs1);
		  while ($row1 = mysql_fetch_array($rs1)) {  
			$join_date = $row1["join_date"];
			$group_for_leave_id = $row1["group_for_leave_id"];
			$y=date('Y', strtotime($join_date ));
             $emp_id1=$row1['id'];
			if($y==$curr){
				$m=date('m', strtotime($join_date));

						if($m!=01){

						$m=$m-1;
						 


						
						}else{
						$m=0;
						
						}

			}

			if($y ==$lat_year){
				$m_last=date('m', strtotime($join_date));
				if($m_last!=01){
					$m_last=$m_last-1;
				}
			}
			//search employee got what kind of leave

			$sql = "SELECT distinct(lt.id), lt.type_name FROM employee e
					left join leave_group lg on lg.group_for_leave_id=e.group_for_leave_id
				left join leave_type lt on lg.leave_type_id=lt.id
				where e.id=" . $emp_id1;
			$rs = mysql_query($sql);

			$work_year = floor((time(date("Y-m-d")) - strtotime($join_date)) / (365 * 24 * 60 * 60));

				   while ($row = mysql_fetch_array($rs)) {
				
							$year = date('Y');
							$sql2 = "SELECT sum(num_days) as c FROM employee_leave e where request_status='Approved' 
									and year(leave_date)=" . $year . " and leave_type_id='" . $row["id"] . "' and emp_id='" . $emp_id1 . "'";
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
						
						
					   $sum_leave=$sum_leave + $m;
					   
					

							$sql3 = "SELECT days FROM leave_group l
									where from_year<=" . $work_year . " and to_year>=" . $work_year . "
						and leave_type_id='" . $row["id"] . "'
						and group_for_leave_id=" . $group_for_leave_id;
							$rs3 = mysql_query($sql3);

							if ($rs3 && mysql_num_rows($rs3) > 0) {
								$row3 = mysql_fetch_array($rs3);
								$days = $row3['days'];
						//Getting employee last year balance	
							$sql2="SELECT COALESCE(sum(num_days),0) as smd FROM employee_leave e 
							where emp_id='" . $emp_id1 . "' and leave_type_id='" . $row["id"] . "' and request_status='Approved' AND Year(leave_date)='" . $lat_year . "';";
							$rs2 = mysql_query($sql2);
						   $row2 = mysql_fetch_array($rs2);
					//Getting Balance for the year before last year
					   
						   $sql_ba="SELECT * FROM leave_balance where emp_id='" . $emp_id1 . "' AND Date='" . $lat_year . "';";
							$rs_ba = mysql_query($sql_ba);
						   $row_ba = mysql_fetch_array($rs_ba);
						
						
						   if($row2["smd"]!="0.00"){
						   
							$balance = $row2["smd"] + $m_last;
							
						}else{
						
						 $balance = $row2["smd"] + $m_last;
						}
						
						if($row["type_name"]=="Annual Leave"){
						

						if($balance>=$row_ba['leave_balance']){
						
						$balance=$balance - $row_ba['leave_balance'];
						
						}
						}

							if($balance!="0.00"){
						
							$balance=$days - $balance;
						
							}else{
							if($y!=$curr){
							$balance=$days;
							}
							
							
							
							
							}
							
						
						/*	This is to uodate the carry forward for the last year. This function is disabled temporary	
							// inserting last year balance into database if the leave is annual leave
							 if($row["type_name"]=="Annual Leave"){

							  
							 $sql1 = mysql_query("SELECT * FROM leave_balance  WHERE emp_id='".$emp_id1."' AND Date='".$curr."'");
							  $sql_result1 = mysql_query($sql1);
							  $count=mysql_num_rows($sql1);
						
							   if($count>0){
							   $sql = "UPDATE leave_balance SET leave_balance='".$balance."' WHERE emp_id = '" . $emp_id1 . "' AND Date='".$curr."'" ;
					
								 $sql_result = mysql_query($sql);
							
							}else{
						
								$sql = "INSERT INTO leave_balance (Date,leave_balance,emp_id) VALUES 
							   ('" . $curr . "','" . $balance . "','" . $emp_id1 . "')";
								$query = mysql_query($sql);
							   }
								
						   
								
								
								} */
								
								
			 // Getting the total of all previous balance 

			$sql5="SELECT COALESCE(sum(leave_balance),0) as balance FROM leave_balance
						where emp_id='" . $emp_id1 . "' AND Date='".$curr."'";
			$rs5 = mysql_query($sql5);
			$row5 = mysql_fetch_array($rs5);
			$last_balance = $row5["balance"];

								 $last_balance=    $days  - $last_balance;
								if($row["type_name"]=="Annual Leave"){

								$days1=$days;
								
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
					/*if($row["type_name"]=="Annual Leave"){		
						echo $days1."-".$balance;
					}*/
							
					
						if($last_balance!=="0.00" && $row["type_name"]=="Annual Leave"){
						$last_balance=$last_balance;
						
						}else{
						$last_balance="";
						}
						
			   
			   $sum_leave=$sum_leave-$m;   
				
				echo '<tr>';
				if($emp!=$row1['id']){
				 echo'<td>' . $row1['full_name'] . '</td>';
				}else{
					 echo'<td ></td>';
				}
				echo'<td>' . $row["type_name"] . '</td>
				  <td>' .$sum_leave . '</td>
				  <td>' . $days . '</td>
				<td>' . $balance  . '</td>
				</tr>';
				 $emp=$row1['id'];
		
				}
				echo"<tr style='background:#000;'><td></td><td></td><td></td><td></td><td></td></tr>";
		    }


				
			   ?>
		</table>
		<style>
			.tableth th {
				/* background-color: #F8F8F8; */
				background-color: black;
				color: white;
				padding-left: 10px;
				text-align: left;
				padding-top: 5px;
				padding-bottom: 2px;
			}
		</style>