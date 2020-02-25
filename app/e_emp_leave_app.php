<?php


/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn.
  Bhd. */		 

?>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
	
        oTable = $('#tableplugin').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		 oTable = $('#tableplugin_l').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
	
	
</script>

<?php

if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1" || $igen_userpermission == "2") {
    $is_admin = "1";
	$upload_id = $_COOKIE['igen_id'];
} else {
    $is_admin = "0";
	$upload_id = $_COOKIE['igen_user_id']; 
}

$sql = 'select distinct(lt.id),lt.* from leave_group lg
        inner join leave_type lt on lg.leave_type_id=lt.id
	inner join employee e on e.group_for_leave_id=lg.group_for_leave_id
	where e.id="' . $_COOKIE['igen_user_id'] . '" ORDER BY lt.type_name';
$result = mysql_query($sql);

$sql1 = "SELECT balance_annual_leave,position_id, DATEDIFF(CURDATE(),join_date) AS join_date 
	 FROM employee WHERE id=('" . $_COOKIE['igen_user_id'] . "');";
$sql_result1 = mysql_query($sql1);
$newArray1 = mysql_fetch_array($sql_result1);
?>
<style>

.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

</style>
<div class="main_div">
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Employee Leave</a>
					</h4>
				</div>
		</div>
	</div>
    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
		<br />
		<div class="modal"></div>
		<div class="header_text">
			<span>Leave Application</span>
		</div>
		<div class="main_content">
			<div id="container" class="tablediv">
			 <form method="post" action="" enctype="multipart/form-data" id="myform">
				<table>
					<tr>
						<td colspan="2">
							<input class="button" type="button" value="Apply"  onclick="send_func()" style="width: 70px;"/>
							<input class="button" type="button" value="Clear"  onclick="clearNew()" style="width: 70px;"/>
							<span id="is_admin" style="display:none"><?php echo $is_admin; ?></span>
						</td>
					</tr>
					<?php
					if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1" || $igen_userpermission == "2") {
						if (isset($_GET["emp"]) == true && $_GET["emp"] != "" && $igen_a_hr == "a_hr_edit") {
							$emp_id = $_GET["emp"];
							$queryEmp = mysql_query('SELECT full_name, company_id, branch_id, dep_id FROM employee WHERE id=' . $emp_id);
							$rowEmp = mysql_fetch_array($queryEmp);
						}
						?>
						<tr>
							<td>Company<span class="red"> *</span></td>
							<td>
								<select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)">
									<option value="">--Please Select--</option>
									<?php
									$queryCompany = mysql_query('SELECT * FROM company ORDER BY code'); 
									while ($rowCompany = mysql_fetch_array($queryCompany)) {
										if (isset($_GET["emp"]) == true && $_GET["emp"] != "" && $igen_a_hr == "a_hr_edit" ) {
											if ($rowEmp["company_id"] == $rowCompany["id"]) {
												echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
											} else {
												echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
												
											}
										} else {
											if ($rowCompany["is_default"] == "1") {
												echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
											} else {
												echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
											}
										}
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Branch<span class="red"> *</span></td>
							<td>
								<select id="dropBranch" style="width: 250px;" onchange="showDep(this.value)">
									<option value="">--Please Select--</option>
									<?php
									if (isset($_GET["emp"]) == true && $_GET["emp"] != "" && $igen_a_hr == "a_hr_edit") {
										$queryBranch = mysql_query('SELECT * FROM branch WHERE company_id="' . $rowEmp["company_id"] . '" ORDER BY branch_code');
									} else {
										$queryCompany = mysql_query('SELECT * FROM company WHERE is_default=1 LIMIT 1');
										$rowCompany = mysql_fetch_array($queryCompany);
										$queryBranch = mysql_query('SELECT * FROM branch WHERE company_id="' . $rowCompany["id"] . '" ORDER BY branch_code');
									}
									while ($rowBranch = mysql_fetch_array($queryBranch)) {
										if ($rowEmp["branch_id"] == $rowBranch['id']) {
											echo '<option value="' . $rowBranch["id"] . '" selected="true">' . $rowBranch["branch_code"] . '</option>';
										} else {
											echo '<option value="' . $rowBranch["id"] . '">' . $rowBranch["branch_code"] . '</option>';
										}
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Department<span class="red"> *</span></td>
							<td>
								<select id="department" style="width: 250px;" onchange="add_emp_list()">
									<option value="">--Please Select--</option>
									<?php
									if (isset($_GET["emp"]) == true && $_GET["emp"] != "" && $igen_a_hr == "a_hr_edit") {
										$queryDep = mysql_query('SELECT * FROM department WHERE branch_id="' . $rowEmp["branch_id"] . '" ORDER BY dep_name');
									}
									while ($rowDep = mysql_fetch_array($queryDep)) {
										if ($rowEmp["dep_id"] == $rowDep["id"]) {
											echo '<option value="' . $rowDep["id"] . '" selected="true">' . $rowDep["dep_name"] . '</option>';
										} else {
											echo '<option value="' . $rowDep["id"] . '">' . $rowDep["dep_name"] . '</option>';
										}
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Employee<span class="red"> *</span></td>
							<td>
								<input type="hidden" id="employee_id" value="<?php echo $emp_id; ?>" name="employee" />
								<input type="text" id="employee_name" style="width: 250px;" onclick="add_emp_list()" value="<?php echo $rowEmp["full_name"]; ?>" />
							</td>
						</tr>
						<tr><td colspan="4" style="border-bottom: 1px solid gray;">&nbsp;</td></tr>
						<tr><td colspan="4" style="padding-bottom: 5px;"></td></tr>
					<?php }else{
						echo '<input type="hidden" id="employee_id" value="'.$_COOKIE['igen_user_id'].'" name="employee" />';
					} ?>
					<tr>
						<td>Leave Starting From<span class="red"> *</span></td>
						<td style=" padding-right: 50px;"><input class="input_text" id="startdate" type="text"  value=" " style="width: 100px;"/>&nbsp;&nbsp;&nbsp;To&nbsp;&nbsp;&nbsp;<input class="input_text" id="enddate" type="text"  value="" style="width:100px;" onclick="countday()"/></td>
						<td rowspan="4" style="width: 200px; vertical-align: top;">Reason for Leave<span class="red"> *</span></td>
						<td rowspan="4" style="vertical-align: top;"><textarea class="input_textarea" id="Reason" style="width: 250px; height: 100px;" ></textarea></td>
					</tr>
					<tr class='half-days' style="display:none">
						<td style="width: 200px;"></td>
						<td>
							<input class="input_text" id="half-days" type="checkbox"  value="1"  /> Do you want apply half day?
							<input type="hidden" id="getDays" />
						</td>
					</tr>
					<tr>
						<td style="width: 200px;">No. of Days<span class="red"> *</span></td>
						<td>
							<input class="input_text" id="Days_off" type="text"  value="" style="width: 250px;" readonly />
							<input type="hidden" id="getDays" />
						</td>
					</tr>
					<tr>
						<td>Leave Type<span class="red"> *</span></td> 
						<td>
							<select class="input_text" id="Leave_type" onchange="leave_type_change()"  onclick="change()" style="width: 259px;">
								<option value="">--Please Select--</option>
								<?php
								while ($newArray = mysql_fetch_array($result)) {
									?>
									<option value="<?php echo $newArray['id']; ?>"><?php echo $newArray['type_name']; ?></option>
									<?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Leave Balance</td>
						<td>
							<input class="input_text" id="balance_leave" type="text" readonly="readonly" value="" style="width: 250px;" />
						</td>
					</tr>
					<tr style=" display: none;">
						<td>Position_Id</td>
						<td style="padding-top:10px; ">
							<input class="input_text" id="Position_Id" type="text" readonly="readonly" value="" style="width: 250px;"/>
						</td>
					</tr>
					<tr style=" display: none;">
						<td>Join day</td>
						<td style="padding-top:10px; ">
							<input class="input_text" id="total_date" type="text" readonly="readonly" value="" style="width: 250px;"/>
						</td>
					</tr>
					 <tr>
						<td style="vertical-align: top;">Attachment</td>
						<td id="dropFileForm">
							 <input type="file" name="files[]" id="fileInput" multiple onchange="addFiles(event)">

							  <label for="fileInput" id="fileLabel" ondragover="overrideDefault(event);fileHover();" ondragenter="overrideDefault(event);fileHover();" ondragleave="overrideDefault(event);fileHoverEnd();" ondrop="overrideDefault(event);fileHoverEnd();
									addFiles(event);">
								<img src="images/download.png"><br>
								 
								<span id="fileLabelText">
								<input type="text" id="uploaded_img" style="width:250px;" value="Choose a file or drag it here" readonly />
								</span>
								<br>
								<span id="uploadStatus"></span>
							  </label>
							<!--<input id="file_upload" name="file_upload" type="file" multiple="true" style="width:100%" />-->


					   </td>
					</tr> 
				</table></form>
			</div>
		</div>
     </br>
	<?php if($_GET['emp']!="") { ?>
	<!--
	<div id="dis" style="display:none">
	<div id="disp">
	
	
	</div>
	</div> 
	--> 
	<?php 
	}
	?>
    <?php if (isset($_COOKIE['igen_user_id']) == true || $igen_userpermission == "1") {
	?>
		<br />
		<div class="header_text">
			<span>Leave Balance</span>
		</div>
		<br />
			<table  class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
						 <thead><tr>           
			<td class="title_bold" style="width: 100px;">Leave Type</td>
			<td class="title_bold" style="width: 10px;">Utilized leave</td>
			<td class="title_bold" style="width: 10px;">Entitle leave</td>
			<td class="title_bold" style="width: 10px;">Carryforward</td>
			<td class="title_bold" style="width: 10px;">Balance</td>
			</tr>    </thead>
			<?php
            
			$curr= date('Y');
			$lat_year=date('Y', strtotime('-1 year'));
			if($_GET['emp']!="" && $igen_a_hr == "a_hr_edit"){
				$emp_id1=$_GET['emp'];
			}else{
				$emp_id1 = $_COOKIE['igen_user_id'];
				 
			}	
			$sql1 = "select join_date,group_for_leave_id from employee where id=" . $emp_id1;
			$rs1 = mysql_query($sql1);
			$row1 = mysql_fetch_array($rs1);
			$join_date = $row1["join_date"];
			$group_for_leave_id = $row1["group_for_leave_id"];
			$y=date('Y', strtotime($join_date ));

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
					inner join leave_group lg on lg.group_for_leave_id=e.group_for_leave_id
				inner join leave_type lt on lg.leave_type_id=lt.id
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
								//echo"Test".$emp_id1.":".$days;
						//Getting employee last year balance	
							$sql2="SELECT COALESCE(sum(num_days),0) as smd FROM employee_leave e 
							where emp_id='" . $emp_id1 . "' and leave_type_id='" . $row["id"] . "' and request_status='Approved' AND Year(leave_date)='" . $lat_year . "';";
							$rs2 = mysql_query($sql2);
						   $row2 = mysql_fetch_array($rs2);
							if($row2["smd"]!="0.00"){
								$balance = $row2["smd"] + $m_last;	
							}else{
								$balance = $row2["smd"] + $m_last;
							}
							if($balance!="0.00"){
								$balance=$days - $balance;
							}else{
								if($y!=$curr){
									$balance=$days;
								}							
							}
							
					
								
								
			 // Getting the total of all previous balance 

			$sql5="SELECT leave_balance as balance FROM leave_balance
						where emp_id='" . $emp_id1 . "' AND Date='".$curr."'";
			$rs5 = mysql_query($sql5);
			$row5 = mysql_fetch_array($rs5);
			$last_balance = $row5["balance"];

								 
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
							
				if($last_balance!=="0.00" && $row["type_name"]=="Annual Leave"){
					$last_balance=$last_balance + 0;
						
				}else{
					$last_balance="-";
				}
						
			   
					$sum_leave=$sum_leave-$m;   
				 $balance+= $last_balance;
				echo '<tr>
				<td>' . $row["type_name"] . '</td>
				  <td>' .$sum_leave . '</td>
				  <td>' . $days . '</td>
				  <td>' . $last_balance . '</td>
				<td>' . $balance .'</td>
				
				</tr>';
				}
				// <td>' . $last_balance . '</td>
			   ?>
			</table>
 </br></br>
			   
				<p>
				<div class="header_text">
					<span>Leave History</span>
					<span style="float: right; font-size: 13px; font-weight: normal;margin-top: -5px;">
						<?php
						if (isset($_GET["from"]) == true) {
							$from = $_GET["from"];
						} else {
							$from = '';
						}
						if (isset($_GET["to"]) == true) {
							$to = $_GET["to"];
						} else {
							$to = '';
						}
						?>
						<table>
							<tr>
								<td>Date Range&nbsp;<input type="text" id="fromdate" style="width: 90px;" value="<?php echo $from; ?>" />&nbsp;-&nbsp;<input type="text" id="todate" style="width: 90px;" value="<?php echo $to; ?>" /></td>
							</tr>
						</table>
					</span>
				</div>
				<div class="main_content">
					<div class="plugindiv">
						<table id="tableplugin" class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
							<thead>
								<tr class="pluginth" id="alternatecolor">
									<th style="width:30px;">No.</th>
									<th style="width:180px">Leave Type</th>
									<th style="width:120px">From (Date)</th>
									<th style="width:120px">To (Date)</th>
									<th style="width:100px">No. of Days</th>
									<th style="width:120px">Apply Date</th>
									<th style="width:120px">Attachment</th>
									<th class="aligncentertable" style="width:100px">Status</th>
									<th class="aligncentertable" style="width:100px">Action</th>
								</tr>
							</thead>
							<?php
							if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
								$sqlAdd = ' AND l.leave_date BETWEEN "' . $_GET["from"] . '" AND "' . $_GET["to"] . '"';
							} else {
								$sqlAdd = ' AND DATE_SUB(CURDATE(),INTERVAL 1440 DAY) <= l.leave_date';
							}
							
								if($igen_a_hr == "a_hr_edit" && $_GET['emp']!=""){
										$sql = "SELECT *, l.id AS lid FROM employee_leave AS l
											INNER JOIN employee AS e
											ON e.id = l.emp_id
											INNER JOIN leave_type AS d
											ON l.leave_type_id = d.id
											WHERE l.emp_id='" . $_GET['emp'] . "'" . $sqlAdd . "
											ORDER BY l.leave_date DESC";
									
								}else{
									$sql = "SELECT *, l.id AS lid FROM employee_leave AS l
									INNER JOIN employee AS e
									ON e.id = l.emp_id
									INNER JOIN leave_type AS d
									ON l.leave_type_id = d.id
									WHERE l.emp_id='" . $_COOKIE['igen_user_id'] . "'" . $sqlAdd . "
									ORDER BY l.leave_date DESC";	
								}
							$rs = mysql_query($sql);
							$i = 1;
							while ($row = mysql_fetch_array($rs)) {
								$full_name = $row['full_name'];
								$type_name = $row['type_name'];
								$from_date = $row['from_date'];
								$to_date = $row['to_date'];
								$insert_date = $row['leave_date'];
								$num_days = $row['num_days'];
								$status = $row['request_status'];
								if($status=="Approved_lv1" || $status=="Approved_lv2" || $status=="Approved_lv3"){
									$status = $row['status2'];
								}
								
								$img_path =$row['img_path'];
								$id = $row['lid'];

							   // $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $_COOKIE['igen_user_id'] . ')" onMouseout="emp_app_hide()"';

								echo '<tr class="plugintr">
							<td>' . $i . '</td>
							<td ' . $mouseover . '>' . $type_name . '</td>
							<td ' . $mouseover . '>' . date('d-m-Y', strtotime($from_date)) . '</td>
							<td ' . $mouseover . '>' . date('d-m-Y', strtotime($to_date)) . '</td>
							<td>' . $num_days . '</td>
							<td>' . date('d-m-Y', strtotime($insert_date)) . '</td>';
							 if($img_path!=null){
							echo '<td class="aligncentertable"><a title="View" href="uploads/leave/' .$img_path. '" target="_blank"><i class="fas fa-download" style="color:#000;"></i></a></td>';
							}else{
							echo '<td class="aligncentertable"></td>';
							}
							echo '<td class="aligncentertable">' . $status . '</td> ';
								if ($status == "Pending") {
									echo '<td class="aligncentertable"><a title="Cancel" href="javascript:void()" onclick="deleteid(' . $id . ')"><i class="far fa-window-close" style="color:#000;"></i></a></a></td> ';
								} else {
									echo '<td class="aligncentertable">-</td> ';
								}
								echo'</tr>';
								$i++;
							}
							?>
							
						
						</table>
					</div>
				</div>
				</p>
			</div>
		</div>
       <!-- <div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Leave Type, From Date & To Date</span> to see more details *</div> -->
    <?php    
    } else { ?>
        
		<div class="panel-group" id="accordion">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapsethree" data-toggle="collapse" data-parent="accordion">Leave History</a>
					</h4>
				</div>
			</div>
		</div>
        <div id="collapsethree" class="panel-collapse collapse" >
			<div class="panel-body">
				<p>
				<div class="header_text">
					<span>Employee Leave History</span> 
					<span style="float: right; font-size: 13px; font-weight: normal;">
						<?php
						if (isset($_GET["from"]) == true) {
							$from = $_GET["from"];
						} else {
							$from = '';
						}
						if (isset($_GET["to"]) == true) {
							$to = $_GET["to"];
						} else {
							$to = '';
						}
						?>
						<table>
							<tr>
								<td>Date Range&nbsp;<input type="text" id="fromdate" style="width: 90px;" value="<?php echo $from; ?>" />&nbsp;-&nbsp;<input type="text" id="todate" style="width: 90px;" value="<?php echo $to; ?>" /></td>
							</tr>
						</table>
					</span>
				</div>
				<div class="main_content">
					<div class="plugindiv">
						<table id="tableplugin" class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
							<thead>
								<tr class="pluginth" id="alternatecolor">
									<th style="width:30px;">No.</th>
									<th>Leave Type</th>
									<th style="width:180px">From (Date)</th>
									<th style="width:180px">To (Date)</th>
									<th style="width:180px">No. of Days</th>
									<th style="width:120px">Apply Date</th>
									<th style="width:120px">Attachment</th>
									<th class="aligncentertable" style="width:150px">Status</th>
									<th class="aligncentertable" style="width:100px">Action</th>
								</tr>
							</thead>
							<?php
							if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
								$sqlAdd = ' AND l.leave_date BETWEEN "' . $_GET["from"] . '" AND "' . $_GET["to"] . '"';
							} else {
								$sqlAdd = ' AND DATE_SUB(CURDATE(),INTERVAL 60 DAY) <= l.leave_date';
							}
							$sql = "SELECT *, l.id AS lid FROM employee_leave AS l
									INNER JOIN employee AS e
									ON e.id = l.emp_id
									INNER JOIN leave_type AS d
									ON l.leave_type_id = d.id
									WHERE l.emp_id='" . $_COOKIE['igen_user_id'] . "'" . $sqlAdd . "
									ORDER BY l.leave_date DESC";
							$rs = mysql_query($sql);
							$i = 1;
							while ($row = mysql_fetch_array($rs)) {
								$full_name = $row['full_name'];
								$type_name = $row['type_name'];
								$from_date = $row['from_date'];
								$to_date = $row['to_date'];
								$insert_date = $row['leave_date'];
								$num_days = $row['num_days'];
								$status = $row['request_status'];
								$img_path =$row['img_path'];
								$id = $row['lid'];

								$mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $_COOKIE['igen_user_id'] . ')" onMouseout="emp_app_hide()"';

								echo '<tr class="plugintr">
							<td>' . $i . '</td>
							<td ' . $mouseover . '>' . $type_name . '</td>
							<td ' . $mouseover . '>' . $from_date . '</td>
							<td ' . $mouseover . '>' . $to_date . '</td>
							<td>' . $num_days . '</td>
							<td>' . $insert_date . '</td>';
							 if($img_path!=null){
							echo '<td class="aligncentertable"><a title="View" href="uploads/leave/' .$img_path. '" target="_blank"><i class="fas fa-download" style="color:#000;"></i></a></td>';
							}else{
							echo '<td class="aligncentertable"></td>';
							}
							echo '<td class="aligncentertable">' . $status . '</td> ';
								if ($status == "Pending") {
									echo '<td class="aligncentertable"><a title="Cancel" href="javascript:void()" onclick="deleteid(' . $id . ')"><i class="far fa-window-close" style="color:#000;"></i></a></a></td> ';
								} else {
									echo '<td class="aligncentertable">-</td> ';
								}
								echo'</tr>';
								$i++;
							}
							?>
						</table>
					</div>
				</div>
				</p>
			</div>
		</div>
        <div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Leave Type, From Date & To Date</span> to see more details *</div>
    <?php } ?>
</div>
<div id="popup"></div>
<style type="text/css">
    #popup{
        position: absolute; 
        float: left; 
        display: none; 
        width: 350px; 
        border: 1px solid mistyrose;
        background-color: mistyrose;
        padding: 15px 20px 10px 20px;
        -moz-box-shadow: 0 0 5px #mistyrose;
        -webkit-box-shadow: 0 0 5px #mistyrose;
        box-shadow: 0 0 5px #mistyrose;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -khtml-border-radius: 5px;
        border-radius: 5px;
    }
</style>


  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
 
<script type="text/javascript">

    $(document).ready(function() {
	
        /*$(this).bind("contextmenu", function(e) {
            e.preventDefault();
        });*/

        var is_admin = $('#is_admin').html();
        var emp_id = $("#employee_id").val();
        if(is_admin == "1"){
            if(emp_id != "" && emp_id != null){
                $.ajax({
                    type:"POST",
                    url:"?widget=getEmpLeave",
                    data:{
                        emp_id:emp_id
                    },
                    success:function(data){
                        $("#Leave_type").empty().append(data);
                    }
                });
            }
        }
    });
	
	function change(){ 
	
	var startdate1=$("#startdate").val();
		var date1= startdate1.split("-");
var day=date1[0]; 
var month=date1[1];
var year =date1[2];
startdate1=year+"-"+month+"-"+day;
	var enddate1=$("#enddate").val();
var date1= enddate1.split("-");
var day=date1[0];
var month=date1[1];
var year =date1[2];
enddate1=year+"-"+month+"-"+day; 

	var today = new Date(startdate1); 
	var today1 = new Date(enddate1); 
	
 if((today.getDay() == 6 || today.getDay() == 0)){ 
//alert('Sorry the date: '+ startdate1+' is Weekend!');
}else if ((today1.getDay() == 6 || today1.getDay() == 0)){
//alert('Sorry the date : '+ enddate1+' is Weekend!');
}else{

$.ajax({
                    type:"POST",
                    url:"?widget=checkholidays",
                    data:{
                        startdate1:startdate1,
						enddate1:enddate1
                    },
                    success:function(data){
					 if(data!=""){
                        alert(data);
						}
                    }
                });



	}
	}
	
		function checkholiday(){
	
	var startdate1=$("#startdate").val();
		var date1= startdate1.split("-");
var day=date1[0]; 
var month=date1[1];
var year =date1[2];
startdate1=year+"-"+month+"-"+day;
	var enddate1=$("#enddate").val();
var date1= enddate1.split("-");
var day=date1[0];
var month=date1[1];
var year =date1[2];
enddate1=year+"-"+month+"-"+day; 

	var today = new Date(startdate1); 
	var today1 = new Date(enddate1); 

$.ajax({
                    type:"POST",
                    url:"?widget=checkholidays",
                    data:{
                        startdate1:startdate1,
						enddate1:enddate1,
						holiday:'holiday'
                    },
                    success:function(data){
					 if(data!=""){
                          days_off(data);
						}
                    }
                });


	}
    
    $("#fromdate, #todate").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function (){
            var from = $("#fromdate").val();
            var to = $("#todate").val();
            if(from != "" && to != ""){
                if(from > to){
                    window.location = '?eloc=emp_leave_app&from='+to+'&to='+from;
                }else{
                    window.location = '?eloc=emp_leave_app&from='+from+'&to='+to;
                }
            }
        },
		onClose: function( selectedDate ) {
    $( "#todate" ).datepicker( "option", "minDate", selectedDate );
	
  }
    })
                
    function showBranch(company_id){
        var branch = "";
        $.ajax({
            type:"POST",
            url:"?widget=showbranch_form",
            data:{
                company_id:company_id,
                branch:branch
            },
            success:function(data){
                $("#dropBranch").empty().append(data);
                $("#department").empty().append("<option value=''>--Please Select--</option>");
                $("#employee_id").val("");
                $("#employee_name").val("");
                $("#Leave_type").empty().append('<option value="">--Please Select--</option>');
                $("#balance_leave").val("");
            }
        });
    }
    
    function showDep(branch_id){
        $.ajax({
            type:"POST",
            url:"?widget=showdept_form",
            data:{
                branch_id:branch_id
            },
            success:function(data){
                $("#department").empty().append(data);
                $("#employee_id").val("");
                $("#employee_name").val("");
                $("#Leave_type").empty().append('<option value="">--Please Select--</option>');
                $("#balance_leave").val("");
            }
        });
    }

    function add_emp_list(){
        var department = $("#department").val();
        var branch = $("#dropBranch").val();
        var url= "?widget=search_emp_e_app&d="+department+"&b="+branch+"&t=leave";
        window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
    }
	$(document).ready(function(){
		var employee_id=$("#employee_id").val()
		if(employee_id!=""){
		$.ajax({
				type:"POST",
				url:"?widget=showdept_form1",
				data:{
					employee_id:employee_id
				},
				success:function(data){
				$("#dis").show(1000);
				$("#disp").html(data);
				  
					
				}
			});

		}
	
	})
    
    function emp_app(id){ 
        var doc = $(document).height(); 
        var popup = parseInt($(".plugindiv").height())+parseInt($(".plugindiv").position().top+parseInt($("#popup").height()));
        var difference = doc-popup;
        var total;
        
        if(difference >= 0){
            total = 0;
        }else{
            total = difference;
        }
        
        $.ajax({ 
            type:'POST',
            url:'?widget=emp_app_info_loan',
            data:{
                id:id,
                action:"leave"
            },
            success:function(data){ 
                $("#popup").html(data);
            }  
        });   
        $(document).mousemove(function(e){
            $('#popup').show();
            $('#popup').css({
                left:  e.pageX + 20,
                top:   e.pageY + total
            });
        });
    }
    
    function emp_app_hide(){
        $(document).mousemove(function(){
            $('#popup').hide();
        });
    }
    
    $("#startdate, #enddate").datepicker({
        dateFormat: 'dd-mm-yy',
        onSelect: function (){
            var from = $("#startdate").val();
			 var from1= from.split("-");
			var day=from1[0];
			var month=from1[1];
			var year =from1[2];
			
			from1=year+"-"+month+"-"+day;
            var to = $("#enddate").val();
			 var to1 = to .split("-");
			var day1=to1[0];
			var month1=to1[1];
			var year1 =to1[2];
			to1 =year1+"-"+month1+"-"+day1;
            var is_admin = $('#is_admin').html();
            var emp_id = $('#employee_id').val();
        
            if(is_admin == "0"){
                emp_id = "0";
            }
			
            if(from != "" && to != ""){
			
                if(from1 > to1){
                    alert("Wrong Leave Range");
                    $("#Days_off").val("0"); 
                }else{
				
                    $.ajax({
                        type:"POST",
                        url:"?widget=checkempleave",
                        data:{
                            from:from,
                            to:to,
                            emp_id:emp_id 
                        },
                        success:function(data){
						
                           $("#Days_off").val(data);
                           $("#getDays").val(data);
							week();
							checkholiday(); 
							
                        }
                    })
                }
            }
        },
		onClose: function( selectedDate ) {
    $( "#enddate" ).datepicker( "option", "minDate", selectedDate );
  }
    });

	
function week(){
	var emp_id=$('#employee_id').val();
	var from=$("#startdate").val();
	var date1= from.split("-");
	var day=date1[0];
	var month=date1[1]; 
	var year =date1[2];
	from=year+"-"+month+"-"+day;

    var to = $("#enddate").val();
	var date1= to.split("-");
	var day=date1[0];
	var month=date1[1];
	var year =date1[2];
	to=year+"-"+month+"-"+day;

	var days=$("#Days_off").val();
	var start = new Date(from),
    finish = new Date(to),
    dayMilliseconds = 1000 * 60 * 60 * 24;
     //alert(start + ":" + finish);
	 //exit();
	var weekendDays = 0;
	while (start <= finish) { 
		var day = start.getDay()
		if(day==0){
			day=7;
		}
	     $.ajax({
            type:"POST",
            url:"?widget=empTimeTable",
            data:{
                day:day,
                emp_id:emp_id 
            },
            success:function(data){
				
				if ($.trim(data)=="N") {
					weekendDays(data);
				}						
            }
         });
	
	
		start = new Date(+start + dayMilliseconds);
	
	}
	
	exit();
	alert(3333)
   days_off(weekendDays);
	
} 
function weekendDays(weekendDays){
	alert(weekendDays);
	
}
$("#half-days").click(function(){
  if($('#half-days').is(':checked')) {
	  $("#Days_off").val("0.5");
  } 
})
function days_off(days_deduction){
    // days_deduction)
    var start_date=$("#startdate").val();
	var end_date = $("#enddate").val();
	if(start_date == end_date){
		$(".half-days").show();
	}else{
		$(".half-days").hide();
	}
	var day="";
	var days=$("#Days_off").val();
	var days_deduction=days_deduction;
	if(days > days_deduction){
	  var day=days - days_deduction;
	}else{
		
		alert("Your leave is either public holdiday or weekend.");
		$('#half-days').prop("checked", false);
	}
	
	$("#Days_off").val(day);
}
function days_off(days_deduction){
    // days_deduction)
    var start_date=$("#startdate").val();
	var end_date = $("#enddate").val();
	if(start_date == end_date){
		$(".half-days").show();
	}else{
		$(".half-days").hide();
	}
	var day="";
	var days=$("#Days_off").val();
	var days_deduction=days_deduction;
	alert(days)
	if(days > days_deduction){
	  var day=days - days_deduction;
	}else{
		
		alert("Your leave is either public holdiday or weekend.");
		$('#half-days').prop("checked", false);
		window.location.reload(true);
	}
	
	$("#Days_off").val(day);
}
	
    function clearNew(){
        window.location='?eloc=emp_leave_app';
    }
    function leave_type_change(){ 
        var leave_type_id = document.getElementById("Leave_type").value;
        var is_admin = $('#is_admin').html();
        var emp_id = $('#employee_id').val();
     
        if(is_admin == "0"){
            emp_id = "0";
        }
        
        $.ajax({
            type:"POST",
            url:"?ewidget=leaveType",
            data:{
                leave_type_id:leave_type_id,
                emp_id:emp_id
            },
            success:function(data){
                $("#balance_leave").val(data);
            }
        }) 
    }
    function send_func(){ 
	
        var num_days = document.getElementById("Days_off").value;
        var getDays = document.getElementById("getDays").value;
        var from_date = document.getElementById("startdate").value;
        var to_date = document.getElementById("enddate").value;
        var leave_type_id = document.getElementById("Leave_type").value;
        var reason = document.getElementById("Reason").value;
        var balance_leave = document.getElementById("balance_leave").value;          
        var new_balance_leave=balance_leave-num_days;

		//alert(new_balance_leave)
         var uploaded_img = $('#uploaded_img').val();
        var is_admin = $('#is_admin').html();
        var emp_id = $('#employee_id').val();
		var files = $('#fileInput')[0].files[0];
		
        var formData = new FormData();
	    formData.append("employee_id",emp_id);
        formData.append("uploaded_img",uploaded_img);
		formData.append("Days_off",num_days);
		formData.append("getDays",getDays);
		formData.append("startdate",from_date);
		formData.append("enddate",to_date);
		formData.append("Leave_type",leave_type_id);
		formData.append("Reason",reason);
		formData.append("fileInput",files);
	
		var ext_arr = ['png','jpg','gif','pdf','PNG','JPG','GIV','PDF'];
		var ext =$('#uploaded_img').val().replace(/^.*\./, '');

		if(jQuery.inArray(ext, ext_arr)==-1 && uploaded_img!="Choose a file or drag it here"){
			alert("Please upload image or pdf file only");
			exit;
		}
	
        var error1 = [];
        var error2 = []; 
        var error3 = [];
        
        if(is_admin == "1"){
            if(emp_id == "" || emp_id == " "){
                error3.push("Employee");
            }
        }else{
            emp_id = "0";
        }
        if(from_date == "" || from_date == " " || to_date == "" || to_date == " "){
            error1.push("From Date & To Date");
        }
        if(num_days == "" || num_days == " "){
            error1.push("No. of Days");
        }
        if(num_days == "0"){
            error2.push("From Date & To Date");
        }
        //if(num_days > getDays){
        //    error2.push("No. of Days");
        //}
        if(leave_type_id == ""){
            error3.push("Leave Type");
        }else{
            if(new_balance_leave<0){
                error2.push("Insufficient of Paid Leave");
            }
        }
        if(reason == "" || reason == " "){
            error1.push("Reason for Leave");
        }
                        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data1 = "";
        var data2 = "";
        var data3 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Check :\n"+error_data2+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
                
        if(error1.length > 0 || error2.length > 0 || error3.length > 0){
            alert(data1 + data2 + data3);
        }else{
			if (confirm('Would you like to proceed?')) {
				$(".modal").show();
				$.ajax({
					type:"POST",
					url:"?ewidget=leaveSend",
					/*data:{
						num_days:num_days,
						from_date:from_date,
						to_date:to_date,
						leave_type_id:leave_type_id,
						reason:reason,
						uploaded_img:uploaded_img,
						emp_id:emp_id
					},*/
					data: formData,
					processData: false,
					contentType: false,
					success:function(data){
						if(data == true){
							alert("E-Leave Applied");
							window.location = '?eloc=emp_leave_app';
						}else{
							alert("Error While Proccessing");
							 window.location = '?eloc=emp_leave_app';
						}
					}
				})
			}else {
				return false;
			}
		}
    }
    function deleteid(id){ 
        var result = confirm("Are you sure you want to cancel this leave application?");
        if(result == true){
            $.ajax({
                type:'POST',
                url:'?ewidget=deleteleaveapp',
                data:{
                    id:id
                },
                success:function(data){
                    if(data==true){
                        alert("E-Leave Application Cancelled");
                        window.location='?eloc=emp_leave_app';
                    }else{
                        alert('Error While Processing');
                    }
                }
            })
        }
    } 
	
$('body').on('drop', '#wrapper', function(e) {
    var file = e.originalEvent.dataTransfer.files[0];
      $("input[type='file']").prop("files", e.originalEvent.dataTransfer.files);
	  alert(file);
    // I have the file.. now what?
});
</script>


<script>
var dropFileForm = document.getElementById("dropFileForm");
//var #uploaded_img = document.getElementById("uploaded_img");
var uploadStatus = document.getElementById("uploadStatus");
var fileInput = document.getElementById("fileInput");
var droppedFiles;

function overrideDefault(event) {
  event.preventDefault();
  event.stopPropagation();
}

function fileHover() {
  dropFileForm.classList.add("fileHover");
  
}

function fileHoverEnd() {
  dropFileForm.classList.remove("fileHover");
}

function addFiles(event) {
  droppedFiles = event.target.files || event.dataTransfer.files;
  //$("input[type='file']").prop("files", e.originalEvent.dataTransfer.files);
  showFiles(droppedFiles);
}

function showFiles(files) {
	$("input[type='file']").prop("files", files);
  if (files.length > 1) {
	 $("#uploaded_img").val(files.length + " files selected");
    //fileLabelText.innerText = files.length + " files selected";
  } else {
	 $("#uploaded_img").val(files[0].name);
    //fileLabelText.innerText = files[0].name;
  }
}

function changeStatus(text) {
  uploadStatus.innerText = text;
}

</script>




<?php


/*
for($i = $begin; $i <= $end; $i->modify('+1 day')){
    echo $i->format("d-m-Y");
}
*/
/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn. Bhd. */
?>
