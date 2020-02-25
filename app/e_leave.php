<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
 
?>
<!--
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
-->
</style>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tablecolor1').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		 oTable = $('#table_r').dataTable({ 
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
    
    function checking(){
        var str1='';
        var str2='';
        var str3='';
        if ($('#pending').is(':checked') )
        {
           
            str1='Pending';
        }
		
        if ($('#approved').is(':checked') )
        {
            
            str2='Approved';
        }
        if ($('#rejected').is(':checked') )
        {
            str3='Rejected';
        }
        var from = $("#fromdate").val()
        var to = $("#todate").val();
		
		
        if(from != "" && to != ""){
            window.location="?loc=e_leave&str1="+str1+"&str2="+str2+"&str3="+str3+"&from="+from+"&to="+to;
        }else{
             window.location="?loc=e_leave&str1="+str1+"&str2="+str2+"&str3="+str3+"&e=edit";
        }
    }
</script>

<div class="main_div" >
<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Leave Application</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
		<p>
   <div class="main_content" > 
	<div class="modal"></div>
        <table class="form_content margincenter">
            <tr>
                <td>Filter By:&nbsp;&nbsp;</td>
                <td> 
                    <?php
                    if (isset($_GET["str1"]) && !empty($_GET["str1"])) {
                        $checked1 = "checked";
                    }
                    ?>
                    <input <?php echo $checked1 ?> class="input_checkbox" type="checkbox" name="status" value="Pending" id="pending" onclick="checking()" /> Pending&nbsp;</td>
                <td><?php
                    if (isset($_GET["str2"]) && !empty($_GET["str2"])) {
                        $checked2 = "checked";
                    }
                    ?>
                    <input  <?php echo $checked2 ?> class="input_checkbox" type="checkbox" name="status" value="Approved" id="approved" onclick="checking()" /> Approved&nbsp;</td>
                <td><?php
                    if (isset($_GET["str3"]) && !empty($_GET["str3"])) {
                        $checked3 = "checked";
                    }
                    ?>
                    <input <?php echo $checked3 ?> class="input_checkbox" type="checkbox" name="status" value="Rejected" id="rejected" onclick="checking()"/> Rejected&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;</td>
				
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
                <td>Date Range&nbsp;<input type="text" id="fromdate" style="width: 90px;" value="<?php echo $from; ?>" />&nbsp;-&nbsp;<input type="text" id="todate" style="width: 90px;" value="<?php echo $to; ?>" /></td>
            </tr>
        </table>
    </div>
    <br/>
	
    <div class="header_text">
        <span>Leave</span>
        <span style="float: right;">
            <?php
            if ($igen_a_ea == "a_ea_edit") {
                if (isset($_GET['e']) && !empty($_GET['e']) || isset($_GET["from"]) & !empty($_GET["from"])) {
                    $val = 'Done';
                } else {
                    $val = 'Edit';
                }
                ?>
                <!--<table>
				
                    <tr>
					<td><input class="button"  type="button" value ="<?php echo $val ?>" onclick="editleave()" style="width: 70px; position:relative; top:2px" id="editBut"/></td></tr>
                </table>-->
            <?php } ?>
			<table>
                    <tr><td><input class="button1"  style="display:none" type="button" value ="Process" onclick="editleave()" style="width: 70px; position:relative; top:2px" id="editBut"/></td></tr>
                </table>
        </span> 
		
    </div>
   
    <div class="main_content" >
        <div class="plugindiv" id="appendDiv">
            <table id="tablecolor1" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th class="aligncentertable" style="width:40px"></th>
                        <th  style="width:150px">Employee</th>
                        <th style="width:100px">Leave Type</th>
                        <th style="width:100px">From (Date)</th>
                        <th style="width:100px">To (Date)</th>
                        <th style="width:100px">No. of Days</th>
                        <th style="width:100px">Apply Date</th>
						<th style="width:100px">Attachment</th>
                        <th style="width:100px" class='aligncentertable'>Status</th> 
                       						
                    </tr>
                </thead>
                <?php
			
                if (isset($_COOKIE["igen_user_id"]) || isset($_COOKIE["igen_id"] )) {
					if($_COOKIE["igen_id"]==""){
						$user_id = $_COOKIE["igen_user_id"];
					}else{
						$user_id = $_COOKIE["igen_id"];
					}

					echo"<input type='hidden' id='user' value='".$user_id."'>";
                    $sql1 = "SELECT position_id, dep_id, group_id FROM employee e where id=" . $user_id;
                    $rs1 = mysql_query($sql1);
                    $row1 = mysql_fetch_array($rs1);
                    $position_id = $row1["position_id"];
                    $dep_id = $row1["dep_id"];
                    $group_id = $row1["group_id"]; 
					/*
					$sql_dep = "select * from approval_m where emp_id='" .$user_id. "'";
    $rs_dep = mysql_query($sql_dep);
	$num_rows= mysql_num_rows($rs_dep);
	//$row_dep = mysql_fetch_array($rs_dep);
	//$row_dep = mysql_fetch_assoc($rs_dep);

	

					
	if($num_rows==0){ 
	
	*/
	
                    $sql2 = "SELECT * FROM approval WHERE
                            (level_pos_1=" . $user_id
                            . " OR level_pos_2=" . $user_id
                            . " OR level_pos_3=" . $user_id . " OR superior_1=" . $user_id
                            . " OR superior_2=" . $user_id . " OR superior_3=" . $user_id . ")";
                    $rs2 = mysql_query($sql2);
					$count= mysql_num_rows( $rs2);
					 
					
                  while($row2 = mysql_fetch_array($rs2)){
				    $dep=$row2['dep_id'];
					$superv1=$row2["superior_1"];
					$superv2=$row2["superior_2"];
					$superv3=$row2["superior_3"]; 
					$level_pos_1=$row2["level_pos_1"];
					$level_pos_2=$row2["level_pos_2"];
					$level_pos_3=$row2["level_pos_3"];
				
					
                 
			
                    if ($row2["level_pos_1"] == $position_id || $row2["superior_1"] == $user_id) {
                        $approval[] = 1;
                    } else {
                        $approval[] = 0;
                    }
                    if ($row2["level_pos_2"] == $position_id || $row2["superior_2"] == $user_id) {
                        $approval[] = 2;
                    } else {
                        $approval[] = 0;
                    }
                    if ($row2["level_pos_3"] == $position_id || $row2["superior_3"] == $user_id) {
                        $approval[] = 3;
                    } else {
                        $approval[] = 0;
                    }

                    for ($i = 0; $i < count($approval); $i++) {
                        $approval_level = $approval_level . $approval[$i] . ',';
                    }
                    echo'<input type="hidden" id="aid" value="'.substr($approval_level, 0, -1) .'">';
                    //echo'<span id="aid" style="display:none;" >' . substr($approval_level, 0, -1) . '</span>';
                  if($superv1==$user_id || $level_pos_1==$user_id){
				 
				  
						if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
						
						   $sql = "SELECT *, e.id AS emp_id, l.id AS lid, l.depid
									FROM employee_leave AS l 
									INNER JOIN employee AS e
									ON e.id = l.emp_id
									INNER JOIN leave_type AS t
									ON l.leave_type_id = t.id
									WHERE l.depid='".$dep."' AND l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND l.request_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "', 'Pending')
									AND l.leave_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
						} else {
								if($superv1!=$user_id && $level_pos_1==$user_id){
								
									
										$sql = "SELECT *, e.id AS emp_id, l.id AS lid, l.depid
											FROM employee_leave AS l
											INNER JOIN employee AS e
											ON e.id = l.emp_id
											INNER JOIN leave_type AS t
											ON l.leave_type_id = t.id WHERE l.depid='".$dep."' AND l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND l.request_status IN ('".$_GET['str1']."') AND l.emp_id!='".$user_id."' ";
								
								}else{
								
										$sql = "SELECT *, e.id AS emp_id, l.id AS lid, l.depid
											FROM employee_leave AS l
											INNER JOIN employee AS e
											ON e.id = l.emp_id
											INNER JOIN leave_type AS t
											ON l.leave_type_id = t.id WHERE l.depid='".$dep."' AND l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND l.request_status IN ('".$_GET['str1']."', '".$_GET['str2']."', '" . $_GET['str3'] . "' ) ";
									
									
								}
						}
						if ($igen_companylist == "") {
							$sql.="";
						} else {
							$sql.=" AND e.company_id = " . $igen_companylist;
						}
						
						$sql.=" ORDER BY l.leave_date DESC";
						
						$rs = mysql_query($sql);
						while ($row = mysql_fetch_array($rs)) {
							$Profile_pic = $row['image_src'];
							$full_name = $row['full_name'];
							$type_name = $row['type_name'];
							$from_date = $row['from_date'];
							$to_date = $row['to_date'];
							$num_days = $row['num_days'];
							$reason = $row['reason'];
							$status = $row['request_status'];
							$id = $row['lid'];
							$emp_id = $row['emp_id'];
							$img_path =$row['img_path'];
							$leave_type_id = $row["leave_type_id"];
							$insert_date = $row['leave_date'];
							$mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $emp_id . ')" onMouseout="emp_app_hide()"';

							echo'<tr class="plugintr">
								<td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $emp_id . ')" onMouseout="emp_app_hide()"><img style="width:40px; height:40px" src="' . $Profile_pic . '"/></td>
								<td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
								<td ' . $mouseover . '>' . $type_name . '</td>
								<td ' . $mouseover . '>' . date("d-m-Y", strtotime($from_date)) . '</td>
								<td ' . $mouseover . '>' . date("d-m-Y", strtotime($to_date)) . '</td>
								<td>' . $num_days . '</td>
								<td>' . date("d-m-Y", strtotime($insert_date)) . '</td>';
							
						 if($img_path!=null){
						echo '<td class="aligncentertable"><a href="uploads/leave/' .$img_path. '" target="_blank"><i class="fas fa-download" style="color:#000;" aria-hidden="true"></i></a></td>';
						}else{
						echo '<td class="aligncentertable">-</td>';
						}
					   
							if (isset($_GET["e"]) && !empty($_GET["e"]) || isset($_GET["from"]) & !empty($_GET["from"])) {
								if ($status != 'Pending') {
									echo '<td class="aligncentertable">' . $status . '</td>';
								} else {
									echo '<td class="aligncentertable" id="updateStatus1' . $id . '">';
									echo '<select name="dropDownLoan" id="drop' . $id . '" onchange="saveValue_admin(' . $id . ', ' . $leave_type_id . ',' . $num_days . ', ' . $emp_id . ')" style="width: 100px;">';
									echo '<option value="Pending">Pending</option>
										<option value="Approved">Approve</option>
										<option value="Rejected">Reject</option>';
									echo '</select>';
									echo '</td>';
								}
							} else {
								echo '<td class="aligncentertable">' . $status . '</td>';
							}
							
							echo '</tr>';
						}
					}
					
					if($superv2==$user_id || $level_pos_2==$user_id){
					
                    if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                       $sql = "SELECT *, e.id AS emp_id, l.id AS lid, l.depid 
                                FROM employee_leave AS l
                                INNER JOIN employee AS e
                                ON e.id = l.emp_id
                                INNER JOIN leave_type AS t
                                ON l.leave_type_id = t.id
                                WHERE l.depid='".$dep."' AND l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND  l.request_status IN ('" . $_GET['str2'] . "','" . $_GET['str3'] . "' , 'Approved_lv1') 
                                AND l.leave_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
					if($superv2!=$user_id && $level_pos_2==$user_id){
					
					
					 $sql = "SELECT *, e.id AS emp_id, l.id AS lid, l.depid
                                FROM employee_leave AS l
                                INNER JOIN employee AS e
                                ON e.id = l.emp_id
                                INNER JOIN leave_type AS t
                                ON l.leave_type_id = t.id WHERE l.depid='".$dep."' 
                               AND l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND l.request_status IN ('Approved_lv1' )";
					
					}else{
					if($superv2!=$superv1){
                        $sql = "SELECT *, e.id AS emp_id, l.id AS lid, l.depid
                                FROM employee_leave AS l
                                INNER JOIN employee AS e
                                ON e.id = l.emp_id
                                INNER JOIN leave_type AS t
                                ON l.leave_type_id = t.id WHERE l.depid='".$dep."' 
                                AND l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND l.request_status IN ('" . $_GET['str2'] . "','" . $_GET['str3'] . "' , 'Approved_lv1' )";
								}
								}
                    }
                    if ($igen_companylist == "") {
                        $sql.=""; 
                    } else {
                        $sql.=" AND e.company_id = " . $igen_companylist;
                    }
					
                    $sql.=" ORDER BY l.leave_date DESC";
                    
                    $rs = mysql_query($sql);
                    while ($row = mysql_fetch_array($rs)) {
                        $Profile_pic = $row['image_src'];
                        $full_name = $row['full_name'];
                        $type_name = $row['type_name'];
                        $from_date = $row['from_date'];
                        $to_date = $row['to_date'];
                        $num_days = $row['num_days'];
                        $reason = $row['reason'];
                        $status = $row['request_status'];
                        $id = $row['lid'];
						$img_path =$row['img_path'];
                        $emp_id = $row['emp_id'];
                        $leave_type_id = $row["leave_type_id"];
                        $insert_date = $row['leave_date'];
                     if($status=="Approved_lv1"){
					
						$status="Pending";
						
						}
                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $emp_id . ')" onMouseout="emp_app_hide()"';

                        echo'<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $emp_id . ')" onMouseout="emp_app_hide()"><img style="width:40px; height:40px" src="' . $Profile_pic . '"/></td>
                            <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $type_name . '</td>
                            <td ' . $mouseover . '>' . date("d-m-Y", strtotime($from_date)) . '</td>
                            <td ' . $mouseover . '>' . date("d-m-Y", strtotime($to_date)) . '</td>
                            <td>' . $num_days . '</td>
                            <td>' . date("d-m-Y", strtotime($insert_date)) . '</td>';
							 if($img_path!=null){
					echo '<td class="aligncentertable"><a href="uploads/leave/' .$img_path. '" target="_blank"><i class="fas fa-download" style="color:#000;" aria-hidden="true"></i></a></td>';
					}else{
					echo '<td class="aligncentertable">-</td>';
					}
                        if (isset($_GET["e"]) && !empty($_GET["e"]) || isset($_GET["from"]) & !empty($_GET["from"])) {
                            if ($status != 'Pending') {
                                echo '<td class="aligncentertable">' . $status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $id . '">';
                                echo '<select name="dropDownLoan" id="drop' . $id . '" onchange="saveValue_admin(' . $id . ', ' . $leave_type_id . ',' . $num_days . ', ' . $emp_id . ')" style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                    <option value="Approved">Approve</option>
                                    <option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
                        } else {
                            echo '<td class="aligncentertable">' . $status . '</td>';
                        }
                        echo '</tr>';
                    }
					}
				if($superv3==$user_id || $level_pos_3==$user_id){
				
                    if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                       $sql = "SELECT *, e.id AS emp_id, l.id AS lid, l.depid
                                FROM employee_leave AS l
                                INNER JOIN employee AS e
                                ON e.id = l.emp_id
                                INNER JOIN leave_type AS t
                                ON l.leave_type_id = t.id
                                WHERE l.depid='".$dep."' AND l.request_status IN ('" . $_GET['str2'] . "','" . $_GET['str3'] . "', 'Approved_lv2')
                               AND l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND l.leave_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
					if($superv3!=$user_id && $level_pos_3==$user_id){
						
					$sql = "SELECT *, e.id AS emp_id, l.id AS lid, l.depid
                                FROM employee_leave AS l
                                INNER JOIN employee AS e
                                ON e.id = l.emp_id
                                INNER JOIN leave_type AS t
                                ON l.leave_type_id = t.id
                                WHERE l.depid='".$dep."' AND l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND l.request_status IN ('Approved_lv2')";
					
					
					}else{
					if($superv3!=$superv1 && $superv3!=$superv2){
                        $sql = "SELECT *, e.id AS emp_id, l.id AS lid, l.depid
                                FROM employee_leave AS l
                                INNER JOIN employee AS e
                                ON e.id = l.emp_id
                                INNER JOIN leave_type AS t
                                ON l.leave_type_id = t.id
                                WHERE l.depid='".$dep."' AND l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND l.request_status IN ('" . $_GET['str2'] . "','" . $_GET['str3'] . "'  , 'Approved_lv2')";
								}
								
								if($superv3==$superv1 && $superv3!=$superv2){
                        $sql = "SELECT *, e.id AS emp_id, l.id AS lid, l.depid
                                FROM employee_leave AS l
                                INNER JOIN employee AS e
                                ON e.id = l.emp_id
                                INNER JOIN leave_type AS t
                                ON l.leave_type_id = t.id
                                WHERE l.depid='".$dep."' AND l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND l.request_status IN ('Approved_lv2')";
								} 
								}
                    }
                    if ($igen_companylist == "") { 
                        $sql.="";
                    } else {
                        $sql.=" AND e.company_id = " . $igen_companylist;
                    }
					
                    $sql.=" ORDER BY l.leave_date DESC";
                    
                    $rs = mysql_query($sql);
                    while ($row = mysql_fetch_array($rs)) {
                        $Profile_pic = $row['image_src'];
                        $full_name = $row['full_name'];
                        $type_name = $row['type_name'];
                        $from_date = $row['from_date'];
                        $to_date = $row['to_date'];
                        $num_days = $row['num_days'];
                        $reason = $row['reason'];
                        $status = $row['request_status'];
						$img_path =$row['img_path'];
                        $id = $row['lid'];
                        $emp_id = $row['emp_id'];
                        $leave_type_id = $row["leave_type_id"];
                        $insert_date = $row['leave_date'];
						
                      if($status=="Approved_lv2"){
					 
						$status="Pending";
						
						}
                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $emp_id . ')" onMouseout="emp_app_hide()"';

                        echo'<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $emp_id . ')" onMouseout="emp_app_hide()"><img style="width:40px; height:40px" src="' . $Profile_pic . '"/></td>
                            <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $type_name . '</td>
                            <td ' . $mouseover . '>' . date("d-m-Y", strtotime($from_date)) . '</td>
                            <td ' . $mouseover . '>' . date("d-m-Y", strtotime($to_date)) . '</td>
                            <td>' . $num_days . '</td>
                            <td>' . date("d-m-Y", strtotime($insert_date)) . '</td>'; 
									 if($img_path!=null){
					echo '<td class="aligncentertable"><a href="uploads/leave/' .$img_path. '" target="_blank"><i class="fas fa-download" style="color:#000;" aria-hidden="true"></i></a></td>';
					}else{
					echo '<td class="aligncentertable">-</td>';
					}
                        if (isset($_GET["e"]) && !empty($_GET["e"]) || isset($_GET["from"]) & !empty($_GET["from"])) {
                            if ($status != 'Pending') {
                                echo '<td class="aligncentertable">' . $status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $id . '">';
                                echo '<select name="dropDownLoan" id="drop' . $id . '" onchange="saveValue_admin(' . $id . ', ' . $leave_type_id . ',' . $num_days . ', ' . $emp_id . ')" style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                    <option value="Approved">Approve</option>
                                    <option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
                        } else {
                            echo '<td class="aligncentertable">' . $status . '</td>';
                        }
                        echo '</tr>';
                    }
					}
					  
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
					
                    if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                       $sql = "SELECT *, e.id AS emp_id, l.id AS lid, l.depid
                                FROM employee_leave AS l 
                                INNER JOIN employee AS e
                                ON e.id = l.emp_id
                                INNER JOIN leave_type AS t
                                ON l.leave_type_id = t.id
                                WHERE l.depid='".$dep."' AND l.emp_id IN('".$lv1."','".$lv2."','".$lv3."') AND l.request_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "', 'Pending')
                                AND l.leave_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
					
					
								$sql = "SELECT *, e.id AS emp_id, l.id AS lid, l.depid
                                FROM employee_leave AS l
                                INNER JOIN employee AS e
                                ON e.id = l.emp_id
                                INNER JOIN leave_type AS t
                                ON l.leave_type_id = t.id WHERE l.depid='".$dep."' AND l.emp_id IN (".$lv1.",".$lv2.",".$lv3.") AND l.request_status IN ('".$_GET['str1']."', '".$_GET['str2']."', '" . $_GET['str3'] . "' )";
								
								
							
                    }
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND e.company_id = " . $igen_companylist;
                    }
					
                    $sql.=" ORDER BY l.leave_date DESC";
                    
                    $rs = mysql_query($sql);
                    while ($row = mysql_fetch_array($rs)) {
                        $Profile_pic = $row['image_src'];
                        $full_name = $row['full_name'];
                        $type_name = $row['type_name'];
                        $from_date = $row['from_date'];
                        $to_date = $row['to_date'];
                        $num_days = $row['num_days'];
                        $reason = $row['reason'];
                        $status = $row['request_status'];
                        $id = $row['lid'];
                        $emp_id = $row['emp_id'];
						$img_path =$row['img_path'];
                        $leave_type_id = $row["leave_type_id"];
                        $insert_date = $row['leave_date'];
                        
                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $emp_id . ')" onMouseout="emp_app_hide()"';

                        echo'<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $emp_id . ')" onMouseout="emp_app_hide()"><img style="width:40px; height:40px" src="' . $Profile_pic . '"/></td>
                            <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $type_name . '</td>
                            <td ' . $mouseover . '>' . date("d-m-Y", strtotime($from_date)) . '</td>
                            <td ' . $mouseover . '>' . date("d-m-Y", strtotime($to_date)) . '</td>
                            <td>' . $num_days . '</td>
                            <td>' . date("d-m-Y", strtotime($insert_date)) . '</td>';
						
					 if($img_path!=null){
					echo '<td class="aligncentertable"><a href="uploads/leave/' .$img_path. '" target="_blank"><i class="fas fa-download" style="color:#000;" aria-hidden="true"></i></a></td>';
					}else{
					echo '<td class="aligncentertable">-</td>';
					}
                   
                        if (isset($_GET["e"]) && !empty($_GET["e"])) {
                            if ($status != 'Pending') {
                                echo '<td class="aligncentertable">' . $status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $id . '">';
                                echo '<select name="dropDownLoan" id="drop' . $id . '" onchange="saveValue_admin(' . $id . ', ' . $leave_type_id . ',' . $num_days . ', ' . $emp_id . ')" style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                    <option value="Approved">Approve</option>
                                    <option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
                        } else {
                            echo '<td class="aligncentertable">' . $status . '</td>';
                        }
						
                        echo '</tr>';
                    }
					
					
					
					}
					}
			
                } 
			  $query_level1 ="SELECT a.superior_1, a.level_pos_1 FROM approval a WHERE  a.superior_1='".$user_id."';";
               $level1 = mysql_query($query_level1);
               $row_level1 = mysql_fetch_assoc($level1);
               $totalRows_level1 = mysql_num_rows($level1);
			   $query_level2 ="SELECT a.superior_2 , a.level_pos_2 FROM approval a WHERE  a.superior_2='".$user_id."';";
               $level2 = mysql_query($query_level2);
               $row_level2 = mysql_fetch_assoc($level2);
               $totalRows_level2 = mysql_num_rows($level2);
			   $query_level3 ="SELECT a.superior_3, a.level_pos_3 FROM approval a WHERE  a.superior_3='".$user_id."';";
               $level3 = mysql_query($query_level3);
               $row_level3 = mysql_fetch_assoc($level3);
               $totalRows_level3 = mysql_num_rows($level3);
			   $query_name1 ="SELECT full_name, id FROM employee WHERE id='".$row_level1['level_pos_1']."';";
               $level_name1 = mysql_query($query_name1);
               $row_name1 = mysql_fetch_assoc($level_name1);
               $totalRows_name1 = mysql_num_rows($level_name1);
			   $e_name1=$row_name1['full_name'];
			 
			    $query_name2 ="SELECT full_name, id FROM employee WHERE id='".$row_level2['level_pos_2']."';";
               $level_name2 = mysql_query($query_name2);
               $row_name2 = mysql_fetch_assoc($level_name2);
               $totalRows_name2 = mysql_num_rows($level_name2);
			   $e_name2=$row_name2['full_name'];
			   
			   $query_name3 ="SELECT full_name, id FROM employee WHERE id='".$row_level3['level_pos_3']."';";
               $level_name3 = mysql_query($query_name3);
               $row_name3 = mysql_fetch_assoc($level_name3);
               $totalRows_name3 = mysql_num_rows($level_name3);
			   $e_name3=$row_name3['full_name'];
			   
			 
				 
				/*
				else {
                    if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                        $sql = "SELECT *, e.id AS emp_id, l.id AS lid
                                FROM employee_leave AS l
                                INNER JOIN employee AS e
                                ON e.id = l.emp_id
                                INNER JOIN leave_type AS t
                                ON l.leave_type_id = t.id
                                WHERE l.request_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')
                                AND l.leave_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
                        $sql = "SELECT *, e.id AS emp_id, l.id AS lid
                                FROM employee_leave AS l
                                INNER JOIN employee AS e
                                ON e.id = l.emp_id
                                INNER JOIN leave_type AS t
                                ON l.leave_type_id = t.id
                                WHERE l.request_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')
                                AND DATE_SUB(CURDATE(),INTERVAL 60 DAY) <= l.leave_date";
                    }
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND e.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY l.leave_date DESC";
                    
                    $rs = mysql_query($sql);

                    while ($row = mysql_fetch_array($rs)) {
                        $Profile_pic = $row['image_src'];
                        $full_name = $row['full_name'];
                        $type_name = $row['type_name'];
                        $from_date = $row['from_date'];
                        $to_date = $row['to_date'];
                        $num_days = $row['num_days'];
                        $reason = $row['reason'];
                        $status = $row['request_status'];
                        $id = $row['lid'];
                        $emp_id = $row['emp_id'];
                        $leave_type_id = $row["leave_type_id"];
                        $insert_date = $row['leave_date'];
                     
                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $emp_id . ')" onMouseout="emp_app_hide()"';

                        echo'<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $emp_id . ')" onMouseout="emp_app_hide()"><img style="width:40px; height:40px" src="' . $Profile_pic . '"/></td>
                            <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $type_name . '</td>
                            <td ' . $mouseover . '>' . $from_date . '</td>
                            <td ' . $mouseover . '>' . $to_date . '</td>
                            <td>' . $num_days . '</td>
                            <td>' . $insert_date . '</td>';
                        if (isset($_GET["e"]) && !empty($_GET["e"])) {
                            if ($status != 'Pending') {
                                echo '<td class="aligncentertable">' . $status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $id . '">';
                                echo '<select name="dropDownLoan" id="drop' . $id . '" onchange="saveValue_admin(' . $id . ', ' . $leave_type_id . ',' . $num_days . ', ' . $emp_id . ')" style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                    <option value="Approved">Approve</option>
                                    <option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
                        } else {
                            echo '<td class="aligncentertable">' . $status . '</td>';
                        }
                        echo '</tr>';
                    }
                }
				*/
                ?>  
            </table>
        </div> 
    </div>
    <div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Employee, Leave Type, From Date & To Date</span> to see more details *</div>
</p></div></div></div>
<div id="popup"></div>


<style type="text/css">
    #popup{
        position: absolute; 
        float: left; 
        display: none; 
        width: 550px; 
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
        oTable = $('#tablecolor').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
    
    $("#fromdate, #todate").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function (){
            var from = $("#fromdate").val();
            var to = $("#todate").val();
            if(from != "" && to != ""){
                if(from > to){
                    window.location = '?loc=e_leave&str1=<?php echo $_GET["str1"]; ?>&str2=<?php echo $_GET["str2"]; ?>&str3=<?php echo $_GET["str3"]; ?>&from='+to+'&to='+from;
                }else{
                    window.location = '?loc=e_leave&str1=<?php echo $_GET["str1"]; ?>&str2=<?php echo $_GET["str2"]; ?>&str3=<?php echo $_GET["str3"]; ?>&from='+from+'&to='+to;
                }
            }
        },
		onClose: function( selectedDate ) {
    $( "#todate" ).datepicker( "option", "minDate", selectedDate );
	}
    });


function cleartext1(id){
	
	var sList = "";
	var x = confirm("Are you sure you want perform this action ?");
$('input[type=checkbox]:checked').each(function () {

    sList += $(this).val() + "," ;
	
	
});
if(sList==""){
alert("tick the check box");

}else{

  if (x){
        $.ajax({
                type:'POST',
                url:"?widget=delete_simulation",
                data:{
				   sList:sList,
                   id:id
                },
                success:function(data){
				     alert(data);
					  window.location='?loc=simulation'; 
                }
            });
			}
			}
    }
    
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
                action:"admin_leave"
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
    
    function editleave(){
        var str1='<?php print $_GET['str1']; ?>';
        var str2='<?php print $_GET['str2']; ?>';
        var str3='<?php print $_GET['str3']; ?>';
        var cur = document.getElementById('editBut').value;
        if(cur == 'Edit'){
            window.location='?loc=e_leave&str1='+str1+'&str2='+str2+'&str3='+str3+'&e=edit';
        }else{
             window.location='?loc=e_leave&str1='+str1+'&str2='+str2+'&str3='+str3+'&e=edit';
        }
    }
        
    function saveValue_admin(id, leave_type_id, num_days, emp_id){
		// $(".modal").show();
        var e = document.getElementById("drop"+id);
        var status = e.options[e.selectedIndex].value;
		if(status=="Rejected"){
			var reason = prompt("Please enter the reason of reject", "");
			if (reason == null || reason == "") {
			    alert("Sorry, Reason of rejected is required");
				exit();
			}
		}
	
		
        $.ajax({
            //type:"POST",
            dataType:'json',
            url:"?widget=instantUpdate_e_leave",  
            data:{
                status:status,
                id:id,
                leave_type_id:leave_type_id,
                num_days:num_days,
                emp_id:emp_id,
				reason:reason
				
            },
            success:function(data){
                if(data.query == "true"){
                    //alert("E-Leave Status Updated");
                    $("#updateStatus1"+id).empty().append(data.status);
					// window.location = '?loc=e_leave&str1=Pending&str2=Approved&str3=Rejected';
                }else if(data.query == "exceed"){
                    alert("Insufficient of Leave.\nE-Leave Application Will Not be Processed.");
                    $("#updateStatus1"+id).empty().append(data.status);
                }else{
                    alert("Error While Proccessing");
                }
            }
        })
    }

    function saveValue_user(id, eid, leave_type_id, num_days){
        var aid = $("#aid").html();
        var e = document.getElementById("drop"+id);
        var status = e.options[e.selectedIndex].value;
        $.ajax({
            dataType:'json',
            url:"?widget=approve_leave",
            data:{
                eid:eid,
                id:id,
                status:status,
                aid:aid,
                leave_type_id:leave_type_id,
                num_days:num_days
            },
            success:function(data){
                if(data.query == "true"){
                    alert("E-Leave Status Updated");
                    $("#updateStatus"+id).empty().append(data.status);
                }else if(data.query == "exceed"){
                    alert("Insufficient of Leave.\nE-Leave Application Will Not be Processed.");
                    $("#updateStatus"+id).empty().append(data.status);
                }else{
                    alert("Error While Proccessing");
                }
            }
        }) 
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
