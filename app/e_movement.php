<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn.
  Bhd. */
  if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1") {
  
    $is_admin = "1";
    $upload_id = $_COOKIE['igen_id'];
} else {
    $is_admin = "0";
    $upload_id = $_COOKIE['igen_user_id']; 
}
?>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
	
        oTable = $('#tableplugin').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		 oTable = $('#tableplugin1').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
	
</script>

<?php

if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1") {
    $is_admin = "1";
} else {
    $is_admin = "0";
}

$sql = 'select distinct(lt.id),lt.* from leave_group lg
        left join leave_type lt on lg.leave_type_id=lt.id
	left join employee e on e.group_for_leave_id=lg.group_for_leave_id
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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Employee Movement Application</a>
					</h4>
				</div>
		</div>
	</div>
  <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
			<div class="modal"></div>
			<div class="header_text">
				<span>Movement Application</span>
			</div>

			<div class="main_content" >
				<div id="container" class="tablediv">
					<table>
						<tr>
							<td colspan="2">
								<input class="button" type="button" value="Apply"  onclick="send_func()" style="width: 70px;"/>
								<input class="button" type="button" value="Clear"  onclick="clearNew()" style="width: 70px;"/>
								<span id="is_admin" style="display: none;"><?php echo $is_admin; ?></span>
							</td>
						</tr>
						<!--<tr><td>&nbsp;&nbsp;&nbsp;</td></tr>-->
						<?php
						if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1") {
							if (isset($_GET["emp"]) == true && $_GET["emp"] != "") {
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
											if (isset($_GET["emp"]) == true && $_GET["emp"] != "") {
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
										if (isset($_GET["emp"]) == true && $_GET["emp"] != "") {
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
										if (isset($_GET["emp"]) == true && $_GET["emp"] != "") {
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
									<input type="hidden" id="employee_id" value="<?php echo $emp_id; ?>" />
									<input type="text" id="employee_name" style="width: 250px;" onclick="add_emp_list()" value="<?php echo $rowEmp["full_name"]; ?>" />
								</td>
							</tr>
							<tr><td colspan="4" style="border-bottom: 1px solid gray;">&nbsp;</td></tr>
							<tr><td colspan="4" style="padding-bottom: 5px;"></td></tr>
						<?php } ?>
						<tr>
							<td>Movement Type<span class="red">*</span></td>  
							<td>
							<input type="hidden" value="" id="Leav">
								<select class="input_text" id="Leave_type1" onchange="leave_type_change(this.value)"  style="width: 259px;">
									<option value="">--Please Select--</option>
									
									  <option value="Meeting">Meeting</option>
									  <option value="Seminar">Seminar</option>
									  <option value="Business Trip">Business Trip</option>
									  <option value="Training">Training</option>
									  
									 <!-- <option value="Replacement">Replacement</option> -->
									  <!--<option value="Personal">Time Off</option>-->
									   
										
								</select> 
							</td> 
						</tr>
						<tr style="display:none" class="time"> 
							<td>Movement Date<span class="red">*</span></td> 
							<td style=" padding-right: 50px;"><input class="input_text" id="startdate1" type="text"  value=" " style="width: 100px;"/></td>
							<td rowspan="4" style="width: 200px; vertical-align: top;">Reason for Time Off<span class="red"> *</span></td>
							<td rowspan="4" style="vertical-align: top;"><textarea class="input_textarea" id="Reason" style="width: 250px; height: 100px;" ></textarea></td>
						</tr>
						<tr style="display:none" class="start">
							<td> Start From<span class="red">*</span></td>
							<td style=" padding-right: 50px;"><input class="input_text" id="startdate" type="text"  value=" " style="width: 100px;"/>&nbsp;&nbsp;&nbsp;To&nbsp;&nbsp;&nbsp;<input class="input_text" id="enddate" type="text"  value="" style="width:100px;" onclick="countday()"/></td>
							<td rowspan="4" style="width: 200px; vertical-align: top;">Reason for movement<span class="red"> *</span></td>
							<td rowspan="4" style="vertical-align: top;"><textarea class="input_textarea" id="Reason1" style="width: 250px; height: 100px;" onclick="week()"></textarea></td>
						</tr>
						 <tr style="display:none" class="start"> 
							<td style="width: 200px;">No. of Days<span class="red">*</span></td>
							<td>
								<input class="input_text" id="Days_off" type="text"  value="" style="width: 250px;" />
								<input type="hidden" id="getDays" />
							</td>
						</tr>
						<tr style="display:none" class="time"> 
							<td>From Time<span class="red">*</span></td>
							<td style=" padding-right: 50px;"><input class="input_text" id="starttime" type="text"  value=" " style="width: 100px;"/>&nbsp;&nbsp;&nbsp;To&nbsp;&nbsp;&nbsp;<input class="input_text" id="endtime" type="text"  value="" style="width:100px;" onclick="countday()"/></td>
							</tr>
							<tr style="display:none" id="allow">
							<td style=" padding-right: 50px;" id="cur">  </td> 
							<td id="curr"> </td>
							</tr> 
							
						<tr style="display:none" class="time">
							<!--<td style="width: 200px;">No. of Hours<span class="red"> *</span></td>-->
							<td>
								<input class="input_text" id="hours_off" type="hidden"  value="" style="width: 250px;" readonly=true />
								<input type="hidden" id="getDays" /> 
							</td>
						</tr>
					   
						<!--
						<tr style=" display: none;">
							<td>Position_Id</td>
							<td style="padding-top:10px; ">
								<input class="input_text" id="Position_Id" type="text" readonly="readonly" value="" style="width: 250px;"/>
							</td>
						</tr>
					   
						 <tr>
							<td style="vertical-align: top;">PDF Attachment</td>
							<td>
								<input id="file_upload" name="file_upload" type="file" multiple="true" style="width:100px" />
								<input type="text" id="uploaded_img" style="width:250px; display: none;" readonly />
							</td>
						</tr> 
						-->
					</table>
				</div>
			</div>
	
<br><br>
			<div class="header_text">
				<span>Movement History</span>
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
	<!--<td>Date Range&nbsp;<input type="text" id="fromdate" style="width: 90px;" value="<?php echo $from; ?>" />&nbsp;-&nbsp;<input type="text" id="todate" style="width: 90px;" value="<?php echo $to; ?>" /></td>-->
						</tr>
					</table>
				</span>
			</div><br>
			 <div class="main_content">
			
				<div class="plugindiv">
			 <table id="tableplugin1" class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
						<thead>
							<tr class="pluginth" id="alternatecolor">
								<th style="width:30px;">No.</th>
							   
								<th style="width:100px">From (Date)</th>
								<th style="width:100px">To (Date)sss</th>
								<th style="width:50px">No. of Days</th>
								<th style="width:100px">Movement Type</th>
								
								<th class="aligncentertable" style="width:100px">Status</th>
								<th class="aligncentertable" style="width:100px">Action</th>
							</tr>
						</thead> 
						<?php
						if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
							$sqlAdd = ' AND l.leave_date BETWEEN "' . $_GET["from"] . '" AND "' . $_GET["to"] . '"';
						} else {
							$sqlAdd = ' AND DATE_SUB(CURDATE(),INTERVAL 60 DAY) <= l.leave_date';
						}
						if($igen_a_hr == "a_hr_edit" && $_GET['emp']!=""){
								$sql = "SELECT *, l.id AS lid FROM employee_movement1 AS l
									INNER JOIN employee AS e
									ON e.id = l.emp_id
									WHERE l.emp_id='" .$_GET['emp']."'
									ORDER BY l.from_time DESC";
						}else{
							$sql = "SELECT *, l.id AS lid FROM employee_movement1 AS l
									INNER JOIN employee AS e
									ON e.id = l.emp_id
									WHERE l.emp_id='" . $_COOKIE['igen_user_id']."'
									ORDER BY l.from_time DESC";
						}
						$rs = mysql_query($sql);
						$i = 1;
						while ($row = mysql_fetch_array($rs)) {
							$full_name = $row['full_name'];
							$type_name = $row['type_name'];
							$from_date = $row['from_time'];
							$to_date = $row['to_time'];
							$insert_date = $row['movement_type'];
							$num_days = $row['num_hours'];
							$status = $row['request_status'];
							
							//$img_path =$row['img_path'];
							$id = $row['lid'];
							if($status=="Approved_lv1" || $status=="Approved_lv2" || $status=="Approved_lv3"){
									$status = $row['status2'];
								}
						   // $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $_COOKIE['igen_user_id'] . ')" onMouseout="emp_app_hide()"';

							echo '<tr class="plugintr">
						<td>' . $i . '</td>
						
						<td ' . $mouseover . '>' . date("d-m-Y", strtotime($from_date)) . '</td>
						<td ' . $mouseover . '>' . date("d-m-Y", strtotime($to_date)) . '</td>
						<td>' . $num_days . '</td>
						<td>' . $insert_date . '</td>';
						
						echo '<td class="aligncentertable">' . $status . '</td> ';
							if ($status == "Pending") {
								echo '<td class="aligncentertable"><a title="Cancel" href="javascript:void()" onclick="deleteid1(' . $id . ')"><i class="far fa-window-close" style="color:#000;"></i></a></td> ';
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
		<br><br>
			<?php if (isset($_COOKIE['igen_user_id']) == true || $igen_userpermission == "1") {
			?>
			  
			
				<div class="header_text"> 
					<span id="per">Movement(Meeting) History</span>
					
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
		<!--<td>Date Range&nbsp;<input type="text" id="fromdate" style="width: 90px;" value="<?php echo $from; ?>" />&nbsp;-&nbsp;<input type="text" id="todate" style="width: 90px;" value="<?php echo $to; ?>" /></td>-->
							</tr>
						</table>
					</span>
				</div>
						
				<div class="main_content">
				
					<div class="plugindiv">
					
					
						<table id="tableplugin" class="TFtable" >
							<thead>
								<tr class="pluginth" id="alternatecolor">
									<th style="width:30px;">No.</th>
								  
									<th style="width:100px">From (Time)</th> 
									<th style="width:100px">To (Time)</th>
									<th style="width:50px">No. of Hours</th>
									<th style="width:100px">Apply Date</th>
									 <th style="width:30px;">Movement Type</th>
									<th class="aligncentertable" style="width:100px">Status</th>
									<th class="aligncentertable" style="width:100px">Action</th>
								</tr>
							</thead> 
							<?php
							if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
								$sqlAdd = ' AND l.leave_date BETWEEN "' . $_GET["from"] . '" AND "' . $_GET["to"] . '"';
							} else {
								$sqlAdd = ' AND DATE_SUB(CURDATE(),INTERVAL 60 DAY) <= l.leave_date';
							}
							if($igen_a_hr == "a_hr_edit" && $_GET['emp']!=""){
								$sql = "SELECT *, l.id AS lid FROM employee_movement AS l
									INNER JOIN employee AS e
									ON e.id = l.emp_id
									WHERE l.emp_id='" .$_GET['emp']."'
									ORDER BY l.leave_date DESC";
							}else{
								$sql = "SELECT *, l.id AS lid FROM employee_movement AS l
									INNER JOIN employee AS e
									ON e.id = l.emp_id
									WHERE l.emp_id='" . $_COOKIE['igen_user_id']."'
									ORDER BY l.leave_date DESC";
							}
							$rs = mysql_query($sql);
							$i = 1;
							while ($row = mysql_fetch_array($rs)) {
								$full_name = $row['full_name'];
								$type_name = $row['type_name'];
								$from_date = $row['from_time'];
								$to_date = $row['to_time'];
								$insert_date = $row['leave_date'];
								$num_days = $row['num_hours'];
								$leav_type= $row['movement_type'];
								$status = $row['request_status'];
								$type= $row['movement_type'];
								//$img_path =$row['img_path'];
								$id = $row['lid']; 
								if($status=="Approved_lv1" || $status=="Approved_lv2" || $status=="Approved_lv3"){
									$status = $row['status2'];
								}
								$mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $_COOKIE['igen_user_id'] . ')" onMouseout="emp_app_hide()"';
								$mouseover="";
								echo '<tr class="plugintr">
							<td>' . $i . '</td>
							
							<td ' . $mouseover . '>' . $from_date . '</td>
							<td ' . $mouseover . '>' . $to_date . '</td>
							<td>' . $num_days . '</td>
							
							<td>' . date("d-m-Y", strtotime($insert_date)) . '</td>
							<td>' . $type . '</td>
							';
							
							echo '<td class="aligncentertable">' . $status . '</td> ';
								if ($status == "Pending") {
									echo '<td class="aligncentertable"><a title="Cancel" href="javascript:void()" onclick="deleteid(' . $id . ')"><i class="far fa-window-close" style="color:#000;"></i></a></td> ';
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

	    
		
				
       <!-- <div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Leave Type, From Date & To Date</span> to see more details *</div> -->
    <?php    
    } else { ?>
    
				<div class="header_text">
					<span>Movement History</span>
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
							  <!--  <td>Date Range&nbsp;<input type="text" id="fromdate" style="width: 90px;" value="<?php echo $from; ?>" />&nbsp;-&nbsp;<input type="text" id="todate" style="width: 90px;" value="<?php echo $to; ?>" /></td> -->
							</tr>
						</table>
					</span>
				</div>
				<div class="main_content">
					<div class="plugindiv">
						<table id="tableplugin" style="border-collapse: collapse;width: 100%; font-size: 13px;">
							<thead>
								<tr class="pluginth" id="alternatecolor">
									<th style="width:30px;">No.</th>
									
									<th style="width:180px">From (Time)</th>
									<th style="width:180px">To (Time)</th>
									<th style="width:180px">No. of Hours</th>
									<th style="width:120px">Apply Date</th>
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
							$sql = "SELECT *, l.id AS lid FROM employee_movement AS l
									INNER JOIN employee AS e
									ON e.id = l.emp_id
									WHERE l.emp_id='" . $_COOKIE['igen_user_id'] . "'" . $sqlAdd . "
									ORDER BY l.leave_date DESC";
							$rs = mysql_query($sql);
							$i = 1;
							while ($row = mysql_fetch_array($rs)) {
								$full_name = $row['full_name'];
								$type_name = $row['type_name'];
								$from_date = $row['from_time'];
								$to_date = $row['to_time']; 
								$insert_date = $row['leave_date'];
								$num_days = $row['num_hours'];
								$status = $row['request_status'];
								//$img_path =$row['img_path'];
								$id = $row['lid'];
								if($status=="Approved_lv1" || $status=="Approved_lv2" || $status=="Approved_lv3"){
									$status = $row['status2'];
								}
								$mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $_COOKIE['igen_user_id'] . ')" onMouseout="emp_app_hide()"';
							 
								echo '<tr class="plugintr">
							<td>' . $i . '</td>
							<td ' . $mouseover . '>' . $from_date . '</td>
							<td ' . $mouseover . '>' . $to_date . '</td>
							<td>' . $num_days . '</td>
							<td>' . $insert_date . '</td>';
							echo '<td class="aligncentertable">' . $status . '</td> ';
								if ($status == "Pending") {
									echo '<td class="aligncentertable"><a title="Cancel" href="javascript:void()" onclick="deleteid(' . $id . ')"><i class="far fa-window-close" style="color:#000;"></i></a></td> ';
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
			
			   <!-- <div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Leave Type, From Date & To Date</span> to see more details *</div>-->
			<?php } ?>
</div>
	</div>
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
<script type="text/javascript" src="js/date.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
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
		
		
	$('#starttime').timepicker({
	hourGrid: 4,
	minuteGrid: 10,
	width:'1000px',
	timeFormat: 'hh:mm tt'
	
});
$('#endtime').on('change', function() {
 var date = $("#startdate1").val();
var date1= date.split("-");
var day=date1[0];
var month=date1[1];
var year =date1[2];
date=year+"-"+month+"-"+day;

var valuestart = $('#endtime').val();
var valuestop = $('#starttime').val();
var Leave_type=$("#Leave_type1").val();;

	  


//create date format          
 var timeStart = new Date('"' + date +'"' + valuestart);
         var timeEnd = new Date('"' + date +'"' + valuestop);

         var difference =timeStart - timeEnd;             

         difference = difference / 60 / 60 / 1000;
	$("#allow").show();
	if(Leave_type=="meeting"){
	$("#cur").text("Allowed Hours : 8");
	}else{
	$("#cur").text("Allowed Hours : 2");
	}
	
	if(difference>0){
	if(Leave_type=="meeting"){
	
	
	if(difference<=8){
	
	$("#curr").text(difference);
	}else{
	alert("Sorry, You reach the limit");
	location.reload(true);
	
	}  
	}else{
	
	if(difference<=2){
	$("#curr").text(difference);
	}else{
	alert("Sorry, You reach the limit");
	location.reload(true);
	
	}
	
	}
	}
	
});

	$('#endtime').timepicker({
	hourGrid: 4,
	
	minuteGrid: 10,
	width:'1000px',
	timeFormat: 'hh:mm tt',
	 onSelect: function (){
	 dura();
	 }
	
});
    });
	function week(){  
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

var weekendDays = 0;

while (start <= finish) { 
    var day = start.getDay()
    if (day == 0 || day == 6) {
        weekendDays++;
    }
    start = new Date(+start + dayMilliseconds);
}
var day=days - weekendDays;

$("#Days_off").val(day);
	
	}
	
	
	function dura(){
var date = $("#startdate1").val();
var date1= date.split("-");
var day=date1[0];
var month=date1[1];
var year =date1[2];
date=year+"-"+month+"-"+day;

var valuestart = $('#endtime').val();
var valuestop = $('#starttime').val();
var Leave_type=$("#Leave_type1").val();;

	   


//create date format          
 var timeStart = new Date('"' + date +'"' + valuestart);
         var timeEnd = new Date('"' + date +'"' + valuestop);

         var difference =timeStart - timeEnd;             

         difference = difference / 60 / 60 / 1000;
	 if(Leave_type=="Personal"){
	if(difference>2){
	
	alert("Time off is only allowed for 2 hrs")
	$("#endtime").val("");
	// window.location='?eloc=movement';
	}else{
	$("#hours_off").val(difference); 
	
	} 
	}
	 if(Leave_type=="meeting"){
	if(difference>8){
	
	alert("Meeting is only allowed for 8 hrs")
	$("#endtime").val("");
	// window.location='?eloc=movement';
	}else{
	$("#hours_off").val(difference); 
	
	} 
	}
	}
	
	/*
	function change(){
	var startdate1=$("#startdate").val();
	var enddate1=$("#enddate").val();
	var today = new Date(startdate1);
	var today1 = new Date(enddate1);

if((today.getDay() == 6 || today.getDay() == 0)){ 
alert('Sorry the date : '+ startdate1+' is Weekend!');
}else if ((today1.getDay() == 6 || today1.getDay() == 0)){
alert('Sorry the date : '+ enddate1+' is Weekend!');
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
	*/
    
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
        var url= "?widget=search_emp_e_app&d="+department+"&b="+branch+"&t=move";
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
	$("#startdate1").datepicker({
        dateFormat: 'dd-mm-yy'
		
		}
		)
    
    $("#startdate, #enddate").datepicker({
        dateFormat: 'dd-mm-yy',
        onSelect: function (){
            var from = $("#startdate").val();
            var to = $("#enddate").val();
            var is_admin = $('#is_admin').html();
            var emp_id = $('#employee_id').val();
        
            if(is_admin == "0"){
                emp_id = "0";
            }
            if(from != "" && to != ""){
                if(from > to){
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
                        }
                    })
                }
            }
        },
		onClose: function( selectedDate ) {
    $( "#enddate" ).datepicker( "option", "minDate", selectedDate );
  }
    });

    function clearNew(){
        window.location='?eloc=movement';
    }
	
    function leave_type_change(leave){
  	
	var leave =leave;

	if(leave!=""){ 
	if(leave!="Personal" && leave!="meeting"){
	
	$(".start").show();
	$(".time").hide();
	 $("#mo").show();
	$("#me").hide();
	}else{
	$(".time").show();
	$(".start").hide();
	$("#mo").hide();
	$("#me").show();
	
	}
	
	
	}else{
	$(".start").hide();
	$(".time").hide();
	
	}
      
    }
	
    function send_func(){
	   var Leave_type=$("#Leave_type1").val();;

	   if(Leave_type=="Personal" || Leave_type=="meeting"){ 
	     var emp_id = $("#employee_id").val();
        var num_hour =$("#hours_off").val();
   
        var from_date =$("#startdate1").val();
     
     var valuestart = $('#endtime').val();
      var valuestop = $('#starttime').val();
        var reason = document.getElementById("Reason").value;
            var endTime = $('#endtime').val().slice(0,-3).replace(":", "");
			var startTime = $('#starttime').val().slice(0,-3).replace(":", "");
			var difference= startTime - startTime;
        var error1 = [];
        var error2 = [];
        var error3 = [];
      
        if(from_date == "" || from_date == " "){
            error1.push("Leave Date ");
        }
        if(num_hour == "" || num_hour == " "){
            error1.push("No. of Hours");
        }
		if(valuestart == "" || valuestart == " "){
            error1.push("From Time");
        }
		
		if(valuestop == "" || valuestop == " "){
            error1.push("To Time");
        }
     
        //if(num_days > getDays){
        //    error2.push("No. of Days");
        //}
    
        if(reason == "" || reason == " "){
            error1.push("Reason for Leave");
        }
                        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        
        var data1 = "";
     
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        
                
        if(error1.length > 0){
            alert(data1);
        }else{
		 $(".modal").show();
            $.ajax({
                type:"POST",
                url:"?widget=movementSend",
                data:{
                    num_hour:num_hour,
                    from_date:from_date,
                    valuestop:valuestop,
					valuestart:valuestart,
					Leave_type:Leave_type,
                    reason:reason,
                    emp_id:emp_id
                },
                success:function(data){
                    if(data == true){
                        alert("E-Movement Applied");
                        window.location = '?eloc=movement'; 
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
		}else{
		
		 var emp_id = $("#employee_id").val();
        var num_hour =$("#Days_off").val();
   
        //var from_date =$("#startdate").val();
      
     var valuestart = $('#startdate').val();
      var valuestop = $('#enddate').val();
        var reason = document.getElementById("Reason1").value;
       
        var error1 = [];
        var error2 = [];
        var error3 = [];
      
        
        if(num_hour == "" || num_hour == " "){
            error1.push("No. of days");
        }
		if(valuestart == "" || valuestart == " "){
            error1.push("From date ");
        }
		
		if(valuestop == "" || valuestop == " "){
            error1.push("To date");
        }
     
        //if(num_days > getDays){
        //    error2.push("No. of Days");
        //}
    
        if(reason == "" || reason == " "){
            error1.push("Reason for Leave");
        }
                        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        
        var data1 = "";
     
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        
                
        if(error1.length > 0){
            alert(data1);
        }else{
		$(".modal").show();
            $.ajax({
                type:"POST",
                url:"?widget=movementSend",
                data:{
                    num_hour:num_hour,
                    valuestop:valuestop,
					valuestart:valuestart,
                    reason:reason,
					Leave_type:Leave_type,
                    emp_id:emp_id
                },
                success:function(data){
			
                    if(data == true){
                        alert("E-Movement Applied");
                        window.location = '?eloc=movement'; 
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
		
		
		}
    }
	
    function deleteid(id){
	
        var result = confirm("Are you sure you want to cancel this e-movement application?");
        if(result == true){
            $.ajax({
                type:'POST',
                url:'?widget=deletemovapp',
                data:{
                    id:id
                },
                success:function(data){
                    if(data==true){
                        alert("E-Movement Application Cancelled");
                        window.location='?eloc=movement';
                    }else{
                        alert('Error While Processing');
                    }
                }
            })
        }
    }
	function deleteid1(id){
	
        var result = confirm("Are you sure you want to cancel this e-movement application?");
        if(result == true){
            $.ajax({
                type:'POST',
                url:'?widget=deletemovapp1',
                data:{
                    id:id
                },
                success:function(data){
                    if(data==true){
                        alert("E-Movement Application Cancelled");
                        window.location='?eloc=movement';
                    }else{
                        alert('Error While Processing');
                    }
                }
            })
        }
    }
</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>