<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<div class="main_div">
   <div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Training Application</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="main_content" >
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
                <td>&nbsp;|&nbsp;&nbsp;</td>
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
        <span>Training</span>
        <span style="float: right;">
            <?php
            if ($igen_a_ea == "a_ea_edit") {
                if (isset($_GET['e']) && !empty($_GET['e'])) {
                    $val = 'Done';
                } else {
                    $val = 'Edit';
                }
                ?>
               <!-- <table>
                    <tr><td><input class="button" type="button" value ="<?php echo $val ?>" onclick="edittrain()" style="width: 70px; position:relative; top:2px" id="editBut"/></td></tr>
                </table>-->
            <?php } ?>
        </span>
    </div>

    <div class="main_content">
        <div class="plugindiv" id="appendDiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th class="aligncentertable" style="width:40px"></th>
                        <th style="width:200px">Employee</th>
                        <th style="width:200px">Training Name</th>
                        <th style="width:150px">Training For</th>
                        <th style="width:100px">Start Date</th>
                        <th style="width:100px">End Date</th>
                        <th style="width:100px">Apply Date</th>
                        <th class='aligncentertable' style="width:100px">Status</th>
                    </tr>
                </thead>
                <?php
                if (isset($_COOKIE["igen_user_id"]) || isset($_COOKIE["igen_id"])) {
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
                        $sql = "SELECT * , emp_t.id as emptid
                            FROM employee_training as emp_t
                            inner join employee as emp
                            on emp_t.employee_id = emp.id
                            join training as train
                            on train.id = emp_t.training_id
                            WHERE emp_t.depid='".$dep."' AND emp_t.employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_t.request_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')
                            AND emp_t.request_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
					if($superv1!=$user_id && $level_pos_1==$user_id){
					 $sql = "SELECT * , emp_t.id as emptid, train.position
                            FROM employee_training as emp_t
                            inner join employee as emp
                            on emp_t.employee_id = emp.id
                            join training as train
                            on train.id = emp_t.training_id
                            WHERE emp_t.depid='".$dep."' AND emp_t.employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_t.request_status IN ('" . $_GET['str1'] . "')";
					
					}else{
                        $sql = "SELECT * , emp_t.id as emptid, train.position
                            FROM employee_training as emp_t
                            inner join employee as emp
                            on emp_t.employee_id = emp.id
                            join training as train
                            on train.id = emp_t.training_id
                            WHERE emp_t.depid='".$dep."' AND emp_t.employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_t.request_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')";
                    }
					}
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND emp.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY emp_t.request_date DESC";

                    $rs = mysql_query($sql);

                    while ($row = mysql_fetch_array($rs)) {
                        $img = $row['image_src'];
                        $training_name = $row['training_name'];
                        $position = $row['position'];
                        $request_date = $row['request_date'];
                        $from_date = $row['from_date'];
                        $to_date = $row['to_date'];
                        $request_status = $row['request_status'];
                        $full_name = $row['full_name'];
                        $empid = $row['employee_id'];
                        $emp_id = "EMP" . str_pad($empid, 6, "0", STR_PAD_LEFT);
                        $id = $row['emptid'];

                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $id . ')" onMouseout="emp_app_hide()"';

                        echo '<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $id . ')" onMouseout="emp_app_hide()"><img src="' . $img . '" style="width:40px;height:40px"/></td> 
                            <td ' . $mouseover . '><span class="bold">' . $emp_id . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $training_name . '</td>
                            <td ' . $mouseover . '>' . $position . '</td>
                            <td>' . $from_date . '</td>
                            <td>' . $to_date . '</td>
                            <td>' . $request_date . '</td>';
                        if (isset($_GET["e"]) && !empty($_GET["e"])) {
                            if ($request_status != 'Pending') {
                                echo '<td class="aligncentertable">' . $request_status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $id . '">';
                                echo '<select name="dropDownLoan" id="drop' . $id . '" onchange="saveValue_admin(' . $id . ', ' . $empid . ' )" style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                        <option value="Approved">Approve</option>
					<option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
                        } else {
                            echo '<td class="aligncentertable">' . $request_status . '</td>';
                        }
                        echo '</tr>';
                    }
                } 
				
				   if($superv2==$user_id || $level_pos_2==$user_id){
                    if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                        $sql = "SELECT * , emp_t.id as emptid
                            FROM employee_training as emp_t
                            inner join employee as emp
                            on emp_t.employee_id = emp.id
                            join training as train
                            on train.id = emp_t.training_id
                            WHERE emp_t.depid='".$dep."' AND emp_t.employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_t.request_status IN ('" . $_GET['str2'] . "','" . $_GET['str3'] . "', 'Approved_lv1')
                            AND emp_t.request_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
					if($superv2!=$user_id && $level_pos_2==$user_id){
					 $sql = "SELECT * , emp_t.id as emptid, train.position
                            FROM employee_training as emp_t
                            inner join employee as emp
                            on emp_t.employee_id = emp.id
                            join training as train
                            on train.id = emp_t.training_id
                            WHERE emp_t.depid='".$dep."' AND emp_t.employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_t.request_status IN ('Approved_lv1')";
					
					}else{
					if($superv2!=$superv1){
                        $sql = "SELECT * , emp_t.id as emptid, train.position
                            FROM employee_training as emp_t
                            inner join employee as emp
                            on emp_t.employee_id = emp.id
                            join training as train
                            on train.id = emp_t.training_id
                            WHERE emp_t.depid='".$dep."' AND emp_t.employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_t.request_status IN ('" . $_GET['str2'] . "','" . $_GET['str3'] . "' , 'Approved_lv1')";
                    }
					}
					}
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND emp.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY emp_t.request_date DESC";

                    $rs = mysql_query($sql);

                    while ($row = mysql_fetch_array($rs)) {
                        $img = $row['image_src'];
                        $training_name = $row['training_name'];
                        $position = $row['position'];
                        $request_date = $row['request_date'];
                        $from_date = $row['from_date'];
                        $to_date = $row['to_date'];
                        $request_status = $row['request_status'];
                        $full_name = $row['full_name'];
                        $empid = $row['employee_id'];
                        $emp_id = "EMP" . str_pad($empid, 6, "0", STR_PAD_LEFT);
                        $id = $row['emptid'];
                       if($request_status=="Approved_lv1"){
					
						 $request_status="Pending";
						
						}
                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $id . ')" onMouseout="emp_app_hide()"';

                        echo '<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $id . ')" onMouseout="emp_app_hide()"><img src="' . $img . '" style="width:40px;height:40px"/></td> 
                            <td ' . $mouseover . '><span class="bold">' . $emp_id . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $training_name . '</td>
                            <td ' . $mouseover . '>' . $position . '</td>
                            <td>' . $from_date . '</td>
                            <td>' . $to_date . '</td>
                            <td>' . $request_date . '</td>';
                        if (isset($_GET["e"]) && !empty($_GET["e"])) {
                            if ($request_status != 'Pending') {
                                echo '<td class="aligncentertable">' . $request_status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $id . '">';
                                echo '<select name="dropDownLoan" id="drop' . $id . '" onchange="saveValue_admin(' . $id . ', ' . $empid . ' )" style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                        <option value="Approved">Approve</option>
					<option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
                        } else {
                            echo '<td class="aligncentertable">' . $request_status . '</td>';
                        }
                        echo '</tr>';
                    }
                }
				 if($superv3==$user_id || $level_pos_3==$user_id){
                    if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                        $sql = "SELECT * , emp_t.id as emptid
                            FROM employee_training as emp_t
                            inner join employee as emp
                            on emp_t.employee_id = emp.id
                            join training as train
                            on train.id = emp_t.training_id
                            WHERE emp_t.depid='".$dep."' AND emp_t.employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_t.request_status IN ('" . $_GET['str2'] . "','" . $_GET['str3'] . "', 'Approved_lv2')
                            AND emp_t.request_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
					if($superv3!=$user_id && $level_pos_3==$user_id){
					 $sql = "SELECT * , emp_t.id as emptid, train.position
                            FROM employee_training as emp_t
                            inner join employee as emp
                            on emp_t.employee_id = emp.id
                            join training as train
                            on train.id = emp_t.training_id
                            WHERE emp_t.depid='".$dep."' AND emp_t.employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_t.request_status IN ('Approved_lv2')";
					
					}else{
					if($superv3!=$superv1 && $superv3!=$superv2){
                        $sql = "SELECT * , emp_t.id as emptid, train.position
                            FROM employee_training as emp_t
                            inner join employee as emp
                            on emp_t.employee_id = emp.id
                            join training as train
                            on train.id = emp_t.training_id
                            WHERE emp_t.depid='".$dep."' AND emp_t.employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_t.request_status IN ('" . $_GET['str2'] . "','" . $_GET['str3'] . "' , 'Approved_lv2')";
                    }
					if($superv3==$superv1 && $superv3!=$superv2){
					$sql = "SELECT * , emp_t.id as emptid, train.position
                            FROM employee_training as emp_t
                            inner join employee as emp
                            on emp_t.employee_id = emp.id
                            join training as train
                            on train.id = emp_t.training_id
                            WHERE emp_t.depid='".$dep."' AND emp_t.employee_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_t.request_status IN ('Approved_lv2')";
					
					}
					}
					}
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND emp.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY emp_t.request_date DESC";

                    $rs = mysql_query($sql);

                    while ($row = mysql_fetch_array($rs)) {
                        $img = $row['image_src'];
                        $training_name = $row['training_name'];
                        $position = $row['position'];
                        $request_date = $row['request_date'];
                        $from_date = $row['from_date'];
                        $to_date = $row['to_date'];
                        $request_status = $row['request_status'];
                        $full_name = $row['full_name'];
                        $empid = $row['employee_id'];
                        $emp_id = "EMP" . str_pad($empid, 6, "0", STR_PAD_LEFT);
                        $id = $row['emptid'];
                       if($request_status=="Approved_lv2"){
					
						 $request_status="Pending";
						
						}
                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $id . ')" onMouseout="emp_app_hide()"';

                        echo '<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $id . ')" onMouseout="emp_app_hide()"><img src="' . $img . '" style="width:40px;height:40px"/></td> 
                            <td ' . $mouseover . '><span class="bold">' . $emp_id . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $training_name . '</td>
                            <td ' . $mouseover . '>' . $position . '</td>
                            <td>' . $from_date . '</td>
                            <td>' . $to_date . '</td>
                            <td>' . $request_date . '</td>';
                        if (isset($_GET["e"]) && !empty($_GET["e"])) {
                            if ($request_status != 'Pending') {
                                echo '<td class="aligncentertable">' . $request_status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $id . '">';
                                echo '<select name="dropDownLoan" id="drop' . $id . '" onchange="saveValue_admin(' . $id . ', ' . $empid . ' )" style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                        <option value="Approved">Approve</option>
					<option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
                        } else {
                            echo '<td class="aligncentertable">' . $request_status . '</td>';
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
					$backup=$row_dep['backup'];
					
			
                    if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                        $sql = "SELECT * , emp_t.id as emptid
                            FROM employee_training as emp_t
                            inner join employee as emp
                            on emp_t.employee_id = emp.id
                            join training as train
                            on train.id = emp_t.training_id
                            WHERE emp_t.depid='".$dep."' AND emp_t.employee_id IN('".$lv1."','".$lv2."','".$lv3."')AND emp_t.request_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')
                            AND emp_t.request_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
					if($backup==$user_id){
					 $sql = "SELECT * , emp_t.id as emptid, train.position
                            FROM employee_training as emp_t
                            inner join employee as emp
                            on emp_t.employee_id = emp.id
                            join training as train
                            on train.id = emp_t.training_id
                            WHERE emp_t.depid='".$dep."' AND emp_t.employee_id  IN('".$lv1."','".$lv2."','".$lv3."') AND emp_t.request_status IN ('" . $_GET['str1'] . "')";
					
					}else{
                        $sql = "SELECT * , emp_t.id as emptid, train.position
                            FROM employee_training as emp_t
                            inner join employee as emp
                            on emp_t.employee_id = emp.id
                            join training as train
                            on train.id = emp_t.training_id
                            WHERE emp_t.depid='".$dep."' AND emp_t.employee_id IN('".$lv1."','".$lv2."','".$lv3."') AND emp_t.request_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')";
                    }
					}
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND emp.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY emp_t.request_date DESC";

                    $rs = mysql_query($sql);

                    while ($row = mysql_fetch_array($rs)) {
                        $img = $row['image_src'];
                        $training_name = $row['training_name'];
                        $position = $row['position'];
                        $request_date = $row['request_date'];
                        $from_date = $row['from_date'];
                        $to_date = $row['to_date'];
                        $request_status = $row['request_status'];
                        $full_name = $row['full_name'];
                        $empid = $row['employee_id'];
                        $emp_id = "EMP" . str_pad($empid, 6, "0", STR_PAD_LEFT);
                        $id = $row['emptid'];

                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $id . ')" onMouseout="emp_app_hide()"';

                        echo '<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $id . ')" onMouseout="emp_app_hide()"><img src="' . $img . '" style="width:40px;height:40px"/></td> 
                            <td ' . $mouseover . '><span class="bold">' . $emp_id . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $training_name . '</td>
                            <td ' . $mouseover . '>' . $position . '</td>
                            <td>' . $from_date . '</td>
                            <td>' . $to_date . '</td>
                            <td>' . $request_date . '</td>';
                        if (isset($_GET["e"]) && !empty($_GET["e"])) {
                            if ($request_status != 'Pending') {
                                echo '<td class="aligncentertable">' . $request_status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $id . '">';
                                echo '<select name="dropDownLoan" id="drop' . $id . '" onchange="saveValue_admin(' . $id . ', ' . $empid . ' )" style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                        <option value="Approved">Approve</option>
					<option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
                        } else {
                            echo '<td class="aligncentertable">' . $request_status . '</td>';
                        }
                        echo '</tr>';
                    }
					
					
					}
					}
					}
                ?>  
            </table>
        </div> 
    </div>
    <div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Employee, Training Name & Training For</span> to see more details *</div>
</p></div></div></div>
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
                    window.location = '?loc=e_training&str1=<?php echo $_GET["str1"]; ?>&str2=<?php echo $_GET["str2"]; ?>&str3=<?php echo $_GET["str3"]; ?>&from='+to+'&to='+from;   
                }else{
                    window.location = '?loc=e_training&str1=<?php echo $_GET["str1"]; ?>&str2=<?php echo $_GET["str2"]; ?>&str3=<?php echo $_GET["str3"]; ?>&from='+from+'&to='+to;   
                } 
            }
        },
		onClose: function( selectedDate ) {
    $( "#todate" ).datepicker( "option", "minDate", selectedDate );
	}
    });
    
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
            window.location="?loc=e_training&str1="+str1+"&str2="+str2+"&str3="+str3+"&from="+from+"&to="+to;
        }else{
            window.location="?loc=e_training&str1="+str1+"&str2="+str2+"&str3="+str3+"&e=edit";;
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
            url:'?widget=emp_app_info',
            data:{
                id:id,
                action:"admin_training"
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
    
    function edittrain(){
        var str1='<?php print $_GET['str1']; ?>';
        var str2='<?php print $_GET['str2']; ?>';
        var str3='<?php print $_GET['str3']; ?>';
        var cur = document.getElementById('editBut').value;
        if(cur == 'Edit'){
            window.location='?loc=e_training&str1='+str1+'&str2='+str2+'&str3='+str3+'&e=edit';
        }else{
            window.location='?loc=e_training&str1='+str1+'&str2='+str2+'&str3='+str3+'&e=edit';
        }
    }
        
    function saveValue_admin(id, emp_id){
        var e = document.getElementById("drop"+id);
        var status = e.options[e.selectedIndex].value;
        $.ajax({
           // type:"POST",
            dataType:'json',
            url:"?widget=instantUpdate_e_train",
            data:{
                status:status,
				emp_id:emp_id,
                id:id
            },
            success:function(data){
                if(data.query == "true"){
                    alert("E-Training Status Updated");
                    $("#updateStatus1"+id).empty().append(data.status);
                }else{
                    alert("Error While Proccessing");
                }
            }
        })
    }
    
    function saveValue_user(id, eid){
        var aid = $("#aid").html();
        var e = document.getElementById("drop"+id);
        var status = e.options[e.selectedIndex].value;
        $.ajax({
            dataType:'json',
            url:"?widget=approve_training",
            data:{
                eid:eid,
                id:id,
                status:status,
                aid:aid
            },
            success:function(data){
                if(data.query == "true"){
                    alert("E-Training Status Updated");
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