<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<script type="text/javascript" charset="utf-8">
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
            window.location="?loc=e_overtime&str1="+str1+"&str2="+str2+"&str3="+str3+"&from="+from+"&to="+to;
        }else{
            window.location="?loc=e_overtime&str1="+str1+"&str2="+str2+"&str3="+str3+"&e=edit";;
        }
    }
</script><div class="main_div">
  <div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">OverTime Application</a>
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
    <div class="header_text" >
        <span>OverTime</span>
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
                    <tr><td><input class="button" type="button" value ="<?php echo $val ?>" onclick="editLoan()" style="width: 70px; position:relative; top:2px" id="editBut"/></td></tr>
                </table>-->
            <?php } ?>
        </span>
    </div>

    <div class="main_content">
        <div class="plugindiv" id="main_content">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th class="aligncentertable" style="width:40px"></th>
                        <th style="width:200px">Employee</th>
                        <th style="width:100px">Overtime Date</th>
                        
                        <th style="width:100px">Start (Time)</th>
                        <th style="width:100px">End (Time)</th>
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
             

                    echo '<span id="aid" style="display: none;">' . substr($approval_level, 0, -1) . '</span>';

                   if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                        $sql = "SELECT o.*, o.id as oid, e.id AS emp_id, e.* 
                                FROM employee_overtime AS o 
                                INNER JOIN employee AS e 
                                ON e.id=o.emp_id
                                WHERE o.depid='".$dep."' AND o.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND o.ot_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "' ,'" . $_GET['str3'] . "')
                                AND o.request_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
					if($superv1!=$user_id && $level_pos_1==$user_id){
					$sql = "SELECT o.*, o.id as oid, e.id AS emp_id, e.* 
                                FROM employee_overtime AS o 
                                INNER JOIN employee AS e 
                                ON e.id=o.emp_id
                                WHERE o.depid='".$dep."' AND o.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND o.ot_status IN ('" . $_GET['str1'] . "')";
					}else{
                        $sql = "SELECT o.*, o.id as oid, e.id AS emp_id, e.* 
                                FROM employee_overtime AS o 
                                INNER JOIN employee AS e 
                                ON e.id=o.emp_id
                                WHERE o.depid='".$dep."' AND o.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND o.ot_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')";
                    }
					
					}
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND e.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY o.request_date DESC";

                    $rs = mysql_query($sql);
                    $i = 0;
                    $j = 1;

                    while ($row = mysql_fetch_array($rs)) {
                        $profile_pic = $row['image_src'];
                        $full_name = $row['full_name'];
                        $emp_id = $row['emp_id'];
                        $r_date = $row['request_date'];
                        $ot_date = $row['ot_date'];
                        $from = $row['from_time'];
                        $to = $row['to_time'];
                        $status = $row['ot_status'];
                        $oid = $row["oid"];

                        $array_from = explode(":", $from);
                        $array_to = explode(":", $to);
                        if ($array_from[0] > 12) {

                            $from_h1 = $array_from[0] - 12;
                            $from_h = "" . $from_h1 . "";
                            $f_time = "pm";
                        } else {

                            if ($array_from[0] >= 10) {
                                $from_h = substr($array_from[0], 0);
                            } else {
                                $from_h = substr($array_from[0], 1);
                            }
                            $f_time = "am";
                        }

                        if ($array_to[0] > 12) {

                            $to_h1 = $array_to[0] - 12;
                            $to_h = "" . $to_h1 . "";
                            $t_time = "pm";
                        } else {

                            if ($array_to[0] >= 10) {
                                $to_h = substr($array_to[0], 0);
                            } else {
                                $to_h = substr($array_to[0], 1);
                            }
                            $t_time = "am";
                        }

                        $from_time1 = $from_h . ":" . $array_from[1] . " " . "$f_time";
                        $to_time1 = $to_h . ":" . $array_to[1] . " " . "$t_time";



                        $weekday = date('N', strtotime($ot_date));

                        $query = "SELECT * FROM emp_time_table WHERE emp_id=" . $row['emp_id'] . "
						  AND day=" . $weekday;
                        $result = mysql_query($query);
                        $num_rows = mysql_num_rows($result);
                        if ($num_rows > 0) {
                            while ($row2 = mysql_fetch_array($result)) {
                                $from = $row2['from_time'];
                                $to = $row2['to_time'];


                                $array_from = explode(":", $from);
                                $array_to = explode(":", $to);
                                if ($array_from[0] > 12) {

                                    $from_h1 = $array_from[0] - 12;
                                    $from_h = "" . $from_h1 . "";
                                    $f_time = "pm";
                                } else {

                                    if ($array_from[0] >= 10) {
                                        $from_h = substr($array_from[0], 0);
                                    } else {
                                        $from_h = substr($array_from[0], 1);
                                    }
                                    $f_time = "am";
                                }

                                if ($array_to[0] > 12) {

                                    $to_h1 = $array_to[0] - 12;
                                    $to_h = "" . $to_h1 . "";
                                    $t_time = "pm";
                                } else {

                                    if ($array_to[0] >= 10) {
                                        $to_h = substr($array_to[0], 0);
                                    } else {
                                        $to_h = substr($array_to[0], 1);
                                    }
                                    $t_time = "am";
                                }

                                $from_time = $from_h . ":" . $array_from[1] . " " . "$f_time";
                                $to_time = $to_h . ":" . $array_to[1] . " " . "$t_time";

                                $f_t[] = $from_time;
                                $t_t[] = $to_time;
                            }
                        } else {
                            $query = "SELECT * FROM time_table WHERE day=" . $weekday;
                            $result = mysql_query($query);
                            while ($row3 = mysql_fetch_array($result)) {

                                $from = $row3['from_time'];
                                $to = $row3['to_time'];


                                $array_from = explode(":", $from);
                                $array_to = explode(":", $to);
                                if ($array_from[0] > 12) {

                                    $from_h1 = $array_from[0] - 12;
                                    $from_h = "" . $from_h1 . "";
                                    $f_time = "pm";
                                } else {

                                    if ($array_from[0] >= 10) {
                                        $from_h = substr($array_from[0], 0);
                                    } else {
                                        $from_h = substr($array_from[0], 1);
                                    }
                                    $f_time = "am";
                                }

                                if ($array_to[0] > 12) {

                                    $to_h1 = $array_to[0] - 12;
                                    $to_h = "" . $to_h1 . "";
                                    $t_time = "pm";
                                } else {

                                    if ($array_to[0] >= 10) {
                                        $to_h = substr($array_to[0], 0);
                                    } else {
                                        $to_h = substr($array_to[0], 1);
                                    }
                                    $t_time = "am";
                                }

                                $from_time = $from_h . ":" . $array_from[1] . " " . "$f_time";
                                $to_time = $to_h . ":" . $array_to[1] . " " . "$t_time";

                                $f_t[] = $from_time;
                                $t_t[] = $to_time;
                            }
                        }

                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $oid . ')" onMouseout="emp_app_hide()"';

                        echo '<tr class="plugintr">
                              <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $oid . ')" onMouseout="emp_app_hide()"><img style="width:40px; height:40px" src="' . $profile_pic . '"></td>
                              <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                              <td ' . $mouseover . '>' . $ot_date . '</td>';
					/*		  
			      <td>' . $f_t[$i] . '-' . $t_t[$i] . '</br>' . $f_t[$j] . '-' . $t_t[$j] . '</td>';
                        $i = $i + 2;
                        $j = $j + 2;
						*/

                        echo'<td>' . $from_time1 . '</td>
                            <td>' . $to_time1 . '</td>
                            <td>' . $r_date . '</td>';
                        if (isset($_GET["e"]) && !empty($_GET["e"])) {
                            if ($status != 'Pending') {
                                echo '<td class="aligncentertable">' . $status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $oid . '">';
                                echo '<select name="dropDownLoan" id="drop' . $oid . '" onchange="saveValue_admin(' . $oid . ', '. $emp_id.')" style="width: 100px;">';
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
             
      
                    echo '<span id="aid" style="display: none;">' . substr($approval_level, 0, -1) . '</span>';

                   if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                        $sql = "SELECT o.*, o.id as oid, e.id AS emp_id, e.* 
                                FROM employee_overtime AS o 
                                INNER JOIN employee AS e 
                                ON e.id=o.emp_id
                                WHERE o.depid='".$dep."' AND o.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND o.ot_status IN ('" . $_GET['str2'] . "','" . $_GET['str3'] . "', 'Approved_lv1')
                                AND o.request_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
					
					if($superv2!=$user_id && $level_pos_2==$user_id){
					$sql = "SELECT o.*, o.id as oid, e.id AS emp_id, e.* 
                                FROM employee_overtime AS o 
                                INNER JOIN employee AS e 
                                ON e.id=o.emp_id
                                WHERE o.depid='".$dep."' AND o.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND o.ot_status IN ('Approved_lv1')";
					}else{
					if($superv2!=$superv1){
                        $sql = "SELECT o.*, o.id as oid, e.id AS emp_id, e.* 
                                FROM employee_overtime AS o 
                                INNER JOIN employee AS e 
                                ON e.id=o.emp_id
                                WHERE o.depid='".$dep."' AND o.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND o.ot_status IN ('" . $_GET['str2'] . "','" . $_GET['str3'] . "', 'Approved_lv1')";
                    }
					}
					
					}
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND e.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY o.request_date DESC";

                    $rs = mysql_query($sql);
                    $i = 0;
                    $j = 1;

                    while ($row = mysql_fetch_array($rs)) {
                        $profile_pic = $row['image_src'];
                        $full_name = $row['full_name'];
                        $emp_id = $row['emp_id'];
                        $r_date = $row['request_date'];
                        $ot_date = $row['ot_date'];
                        $from = $row['from_time'];
                        $to = $row['to_time'];
                        $status = $row['ot_status'];
                        $oid = $row["oid"];
                         if($status=="Approved_lv1"){
					 
						$status="Pending";
						
						}
                        $array_from = explode(":", $from);
                        $array_to = explode(":", $to);
                        if ($array_from[0] > 12) {

                            $from_h1 = $array_from[0] - 12;
                            $from_h = "" . $from_h1 . "";
                            $f_time = "pm";
                        } else {

                            if ($array_from[0] >= 10) {
                                $from_h = substr($array_from[0], 0);
                            } else {
                                $from_h = substr($array_from[0], 1);
                            }
                            $f_time = "am";
                        }

                        if ($array_to[0] > 12) {

                            $to_h1 = $array_to[0] - 12;
                            $to_h = "" . $to_h1 . "";
                            $t_time = "pm";
                        } else {

                            if ($array_to[0] >= 10) {
                                $to_h = substr($array_to[0], 0);
                            } else {
                                $to_h = substr($array_to[0], 1);
                            }
                            $t_time = "am";
                        }

                        $from_time1 = $from_h . ":" . $array_from[1] . " " . "$f_time";
                        $to_time1 = $to_h . ":" . $array_to[1] . " " . "$t_time";



                        $weekday = date('N', strtotime($ot_date));

                        $query = "SELECT * FROM emp_time_table WHERE emp_id=" . $row['emp_id'] . "
						  AND day=" . $weekday;
                        $result = mysql_query($query);
                        $num_rows = mysql_num_rows($result);
                        if ($num_rows > 0) {
                            while ($row2 = mysql_fetch_array($result)) {
                                $from = $row2['from_time'];
                                $to = $row2['to_time'];


                                $array_from = explode(":", $from);
                                $array_to = explode(":", $to);
                                if ($array_from[0] > 12) {

                                    $from_h1 = $array_from[0] - 12;
                                    $from_h = "" . $from_h1 . "";
                                    $f_time = "pm";
                                } else {

                                    if ($array_from[0] >= 10) {
                                        $from_h = substr($array_from[0], 0);
                                    } else {
                                        $from_h = substr($array_from[0], 1);
                                    }
                                    $f_time = "am";
                                }

                                if ($array_to[0] > 12) {

                                    $to_h1 = $array_to[0] - 12;
                                    $to_h = "" . $to_h1 . "";
                                    $t_time = "pm";
                                } else {

                                    if ($array_to[0] >= 10) {
                                        $to_h = substr($array_to[0], 0);
                                    } else {
                                        $to_h = substr($array_to[0], 1);
                                    }
                                    $t_time = "am";
                                }

                                $from_time = $from_h . ":" . $array_from[1] . " " . "$f_time";
                                $to_time = $to_h . ":" . $array_to[1] . " " . "$t_time";

                                $f_t[] = $from_time;
                                $t_t[] = $to_time;
                            }
                        } else {
                            $query = "SELECT * FROM time_table WHERE day=" . $weekday;
                            $result = mysql_query($query);
                            while ($row3 = mysql_fetch_array($result)) {

                                $from = $row3['from_time'];
                                $to = $row3['to_time'];


                                $array_from = explode(":", $from);
                                $array_to = explode(":", $to);
                                if ($array_from[0] > 12) {

                                    $from_h1 = $array_from[0] - 12;
                                    $from_h = "" . $from_h1 . "";
                                    $f_time = "pm";
                                } else {

                                    if ($array_from[0] >= 10) {
                                        $from_h = substr($array_from[0], 0);
                                    } else {
                                        $from_h = substr($array_from[0], 1);
                                    }
                                    $f_time = "am";
                                }

                                if ($array_to[0] > 12) {

                                    $to_h1 = $array_to[0] - 12;
                                    $to_h = "" . $to_h1 . "";
                                    $t_time = "pm";
                                } else {

                                    if ($array_to[0] >= 10) {
                                        $to_h = substr($array_to[0], 0);
                                    } else {
                                        $to_h = substr($array_to[0], 1);
                                    }
                                    $t_time = "am";
                                }

                                $from_time = $from_h . ":" . $array_from[1] . " " . "$f_time";
                                $to_time = $to_h . ":" . $array_to[1] . " " . "$t_time";

                                $f_t[] = $from_time;
                                $t_t[] = $to_time;
                            }
                        }

                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $oid . ')" onMouseout="emp_app_hide()"';

                        echo '<tr class="plugintr">
                              <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $oid . ')" onMouseout="emp_app_hide()"><img style="width:40px; height:40px" src="' . $profile_pic . '"></td>
                              <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                              <td ' . $mouseover . '>' . $ot_date . '</td>';
					/*		  
			      <td>' . $f_t[$i] . '-' . $t_t[$i] . '</br>' . $f_t[$j] . '-' . $t_t[$j] . '</td>';
                        $i = $i + 2;
                        $j = $j + 2;
						*/

                        echo'<td>' . $from_time1 . '</td>
                            <td>' . $to_time1 . '</td>
                            <td>' . $r_date . '</td>';
                        if (isset($_GET["e"]) && !empty($_GET["e"])) {
                            if ($status != 'Pending') {
                                echo '<td class="aligncentertable">' . $status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $oid . '">';
                                echo '<select name="dropDownLoan" id="drop' . $oid . '" onchange="saveValue_admin(' . $oid . ' , '. $emp_id.')" style="width: 100px;">';
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
              

                    echo '<span id="aid" style="display: none;">' . substr($approval_level, 0, -1) . '</span>';

                   if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                        $sql = "SELECT o.*, o.id as oid, e.id AS emp_id, e.* 
                                FROM employee_overtime AS o 
                                INNER JOIN employee AS e 
                                ON e.id=o.emp_id
                                WHERE o.depid='".$dep."' AND o.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND o.ot_status IN ('" . $_GET['str2'] . "','" . $_GET['str3'] . "', 'Approved_lv2')
                                AND o.request_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
					if($superv3!=$user_id && $level_pos_3==$user_id){
					$sql = "SELECT o.*, o.id as oid, e.id AS emp_id, e.* 
                                FROM employee_overtime AS o 
                                INNER JOIN employee AS e 
                                ON e.id=o.emp_id
                                WHERE o.depid='".$dep."' AND o.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND o.ot_status IN ('Approved_lv2')";
					}else{
					if($superv3!=$superv1 && $superv3!=$superv2){
                        $sql = "SELECT o.*, o.id as oid, e.id AS emp_id, e.* 
                                FROM employee_overtime AS o 
                                INNER JOIN employee AS e 
                                ON e.id=o.emp_id
                                WHERE o.depid='".$dep."' AND o.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND o.ot_status IN ('" . $_GET['str2'] . "','" . $_GET['str3'] . "', 'Approved_lv2')";
                    }
					if($superv3==$superv1 && $superv3!=$superv2){
					$sql = "SELECT o.*, o.id as oid, e.id AS emp_id, e.* 
                                FROM employee_overtime AS o 
                                INNER JOIN employee AS e 
                                ON e.id=o.emp_id
                                WHERE o.depid='".$dep."' AND o.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND o.ot_status IN ('Approved_lv2')";
					}
					}
					
					}
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND e.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY o.request_date DESC";

                    $rs = mysql_query($sql);
                    $i = 0;
                    $j = 1;

                    while ($row = mysql_fetch_array($rs)) {
                        $profile_pic = $row['image_src'];
                        $full_name = $row['full_name'];
                        $emp_id = $row['emp_id'];
                        $r_date = $row['request_date'];
                        $ot_date = $row['ot_date'];
                        $from = $row['from_time'];
                        $to = $row['to_time'];
                        $status = $row['ot_status'];
                        $oid = $row["oid"];
                       if($status=="Approved_lv2"){
					 
						$status="Pending";
						
						}
                        $array_from = explode(":", $from);
                        $array_to = explode(":", $to);
                        if ($array_from[0] > 12) {

                            $from_h1 = $array_from[0] - 12;
                            $from_h = "" . $from_h1 . "";
                            $f_time = "pm";
                        } else {

                            if ($array_from[0] >= 10) {
                                $from_h = substr($array_from[0], 0);
                            } else {
                                $from_h = substr($array_from[0], 1);
                            }
                            $f_time = "am";
                        }

                        if ($array_to[0] > 12) {

                            $to_h1 = $array_to[0] - 12;
                            $to_h = "" . $to_h1 . "";
                            $t_time = "pm";
                        } else {

                            if ($array_to[0] >= 10) {
                                $to_h = substr($array_to[0], 0);
                            } else {
                                $to_h = substr($array_to[0], 1);
                            }
                            $t_time = "am";
                        }

                        $from_time1 = $from_h . ":" . $array_from[1] . " " . "$f_time";
                        $to_time1 = $to_h . ":" . $array_to[1] . " " . "$t_time";



                        $weekday = date('N', strtotime($ot_date));

                        $query = "SELECT * FROM emp_time_table WHERE emp_id=" . $row['emp_id'] . "
						  AND day=" . $weekday;
                        $result = mysql_query($query);
                        $num_rows = mysql_num_rows($result);
                        if ($num_rows > 0) {
                            while ($row2 = mysql_fetch_array($result)) {
                                $from = $row2['from_time'];
                                $to = $row2['to_time'];


                                $array_from = explode(":", $from);
                                $array_to = explode(":", $to);
                                if ($array_from[0] > 12) {

                                    $from_h1 = $array_from[0] - 12;
                                    $from_h = "" . $from_h1 . "";
                                    $f_time = "pm";
                                } else {

                                    if ($array_from[0] >= 10) {
                                        $from_h = substr($array_from[0], 0);
                                    } else {
                                        $from_h = substr($array_from[0], 1);
                                    }
                                    $f_time = "am";
                                }

                                if ($array_to[0] > 12) {

                                    $to_h1 = $array_to[0] - 12;
                                    $to_h = "" . $to_h1 . "";
                                    $t_time = "pm";
                                } else {

                                    if ($array_to[0] >= 10) {
                                        $to_h = substr($array_to[0], 0);
                                    } else {
                                        $to_h = substr($array_to[0], 1);
                                    }
                                    $t_time = "am";
                                }

                                $from_time = $from_h . ":" . $array_from[1] . " " . "$f_time";
                                $to_time = $to_h . ":" . $array_to[1] . " " . "$t_time";

                                $f_t[] = $from_time;
                                $t_t[] = $to_time;
                            }
                        } else {
                            $query = "SELECT * FROM time_table WHERE day=" . $weekday;
                            $result = mysql_query($query);
                            while ($row3 = mysql_fetch_array($result)) {

                                $from = $row3['from_time'];
                                $to = $row3['to_time'];


                                $array_from = explode(":", $from);
                                $array_to = explode(":", $to);
                                if ($array_from[0] > 12) {

                                    $from_h1 = $array_from[0] - 12;
                                    $from_h = "" . $from_h1 . "";
                                    $f_time = "pm";
                                } else {

                                    if ($array_from[0] >= 10) {
                                        $from_h = substr($array_from[0], 0);
                                    } else {
                                        $from_h = substr($array_from[0], 1);
                                    }
                                    $f_time = "am";
                                }

                                if ($array_to[0] > 12) {

                                    $to_h1 = $array_to[0] - 12;
                                    $to_h = "" . $to_h1 . "";
                                    $t_time = "pm";
                                } else {

                                    if ($array_to[0] >= 10) {
                                        $to_h = substr($array_to[0], 0);
                                    } else {
                                        $to_h = substr($array_to[0], 1);
                                    }
                                    $t_time = "am";
                                }

                                $from_time = $from_h . ":" . $array_from[1] . " " . "$f_time";
                                $to_time = $to_h . ":" . $array_to[1] . " " . "$t_time";

                                $f_t[] = $from_time;
                                $t_t[] = $to_time;
                            }
                        }

                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $oid . ')" onMouseout="emp_app_hide()"';

                        echo '<tr class="plugintr">
                              <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $oid . ')" onMouseout="emp_app_hide()"><img style="width:40px; height:40px" src="' . $profile_pic . '"></td>
                              <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                              <td ' . $mouseover . '>' . $ot_date . '</td>';
					/*		  
			      <td>' . $f_t[$i] . '-' . $t_t[$i] . '</br>' . $f_t[$j] . '-' . $t_t[$j] . '</td>';
                        $i = $i + 2;
                        $j = $j + 2;
						*/

                        echo'<td>' . $from_time1 . '</td>
                            <td>' . $to_time1 . '</td>
                            <td>' . $r_date . '</td>';
                        if (isset($_GET["e"]) && !empty($_GET["e"])) {
                            if ($status != 'Pending') {
                                echo '<td class="aligncentertable">' . $status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $oid . '">';
                                echo '<select name="dropDownLoan" id="drop' . $oid . '" onchange="saveValue_admin(' . $oid . ' , '. $emp_id.')" style="width: 100px;">';
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
					$backup=$row_dep['backup'];
					$dep=$row_dep['dep_id'];
					
                   if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                        $sql = "SELECT o.*, o.id as oid, e.id AS emp_id, e.* 
                                FROM employee_overtime AS o 
                                INNER JOIN employee AS e 
                                ON e.id=o.emp_id
                                WHERE o.depid='".$dep."' AND o.emp_id IN('".$lv1."','".$lv2."','".$lv3."')  AND o.ot_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')
                                AND o.request_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
				 if($backup==$user_id){
				 $sql = "SELECT o.*, o.id as oid, e.id AS emp_id, e.* 
                                FROM employee_overtime AS o 
                                INNER JOIN employee AS e 
                                ON e.id=o.emp_id
                                WHERE o.depid='".$dep."' AND o.emp_id IN('".$lv1."','".$lv2."','".$lv3."')  AND o.ot_status IN ('" . $_GET['str1'] . "')";
				 }else{
                        $sql = "SELECT o.*, o.id as oid, e.id AS emp_id, e.* 
                                FROM employee_overtime AS o 
                                INNER JOIN employee AS e 
                                ON e.id=o.emp_id
                                WHERE o.depid='".$dep."' AND o.emp_id IN('".$lv1."','".$lv2."','".$lv3."')  AND o.ot_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')";
                    }
					
					}
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND e.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY o.request_date DESC";

                    $rs = mysql_query($sql);
                    $i = 0;
                    $j = 1;

                    while ($row = mysql_fetch_array($rs)) {
                        $profile_pic = $row['image_src'];
                        $full_name = $row['full_name'];
                        $emp_id = $row['emp_id'];
                        $r_date = $row['request_date'];
                        $ot_date = $row['ot_date'];
                        $from = $row['from_time'];
                        $to = $row['to_time'];
                        $status = $row['ot_status'];
                        $oid = $row["oid"];

                        $array_from = explode(":", $from);
                        $array_to = explode(":", $to);
                        if ($array_from[0] > 12) {

                            $from_h1 = $array_from[0] - 12;
                            $from_h = "" . $from_h1 . "";
                            $f_time = "pm";
                        } else {

                            if ($array_from[0] >= 10) {
                                $from_h = substr($array_from[0], 0);
                            } else {
                                $from_h = substr($array_from[0], 1);
                            }
                            $f_time = "am";
                        }

                        if ($array_to[0] > 12) {

                            $to_h1 = $array_to[0] - 12;
                            $to_h = "" . $to_h1 . "";
                            $t_time = "pm";
                        } else {

                            if ($array_to[0] >= 10) {
                                $to_h = substr($array_to[0], 0);
                            } else {
                                $to_h = substr($array_to[0], 1);
                            }
                            $t_time = "am";
                        }

                        $from_time1 = $from_h . ":" . $array_from[1] . " " . "$f_time";
                        $to_time1 = $to_h . ":" . $array_to[1] . " " . "$t_time";



                        $weekday = date('N', strtotime($ot_date));

                        $query = "SELECT * FROM emp_time_table WHERE emp_id=" . $row['emp_id'] . "
						  AND day=" . $weekday;
                        $result = mysql_query($query);
                        $num_rows = mysql_num_rows($result);
                        if ($num_rows > 0) {
                            while ($row2 = mysql_fetch_array($result)) {
                                $from = $row2['from_time'];
                                $to = $row2['to_time'];


                                $array_from = explode(":", $from);
                                $array_to = explode(":", $to);
                                if ($array_from[0] > 12) {

                                    $from_h1 = $array_from[0] - 12;
                                    $from_h = "" . $from_h1 . "";
                                    $f_time = "pm";
                                } else {

                                    if ($array_from[0] >= 10) {
                                        $from_h = substr($array_from[0], 0);
                                    } else {
                                        $from_h = substr($array_from[0], 1);
                                    }
                                    $f_time = "am";
                                }

                                if ($array_to[0] > 12) {

                                    $to_h1 = $array_to[0] - 12;
                                    $to_h = "" . $to_h1 . "";
                                    $t_time = "pm";
                                } else {

                                    if ($array_to[0] >= 10) {
                                        $to_h = substr($array_to[0], 0);
                                    } else {
                                        $to_h = substr($array_to[0], 1);
                                    }
                                    $t_time = "am";
                                }

                                $from_time = $from_h . ":" . $array_from[1] . " " . "$f_time";
                                $to_time = $to_h . ":" . $array_to[1] . " " . "$t_time";

                                $f_t[] = $from_time;
                                $t_t[] = $to_time;
                            }
                        } else {
                            $query = "SELECT * FROM time_table WHERE day=" . $weekday;
                            $result = mysql_query($query);
                            while ($row3 = mysql_fetch_array($result)) {

                                $from = $row3['from_time'];
                                $to = $row3['to_time'];


                                $array_from = explode(":", $from);
                                $array_to = explode(":", $to);
                                if ($array_from[0] > 12) {

                                    $from_h1 = $array_from[0] - 12;
                                    $from_h = "" . $from_h1 . "";
                                    $f_time = "pm";
                                } else {

                                    if ($array_from[0] >= 10) {
                                        $from_h = substr($array_from[0], 0);
                                    } else {
                                        $from_h = substr($array_from[0], 1);
                                    }
                                    $f_time = "am";
                                }

                                if ($array_to[0] > 12) {

                                    $to_h1 = $array_to[0] - 12;
                                    $to_h = "" . $to_h1 . "";
                                    $t_time = "pm";
                                } else {

                                    if ($array_to[0] >= 10) {
                                        $to_h = substr($array_to[0], 0);
                                    } else {
                                        $to_h = substr($array_to[0], 1);
                                    }
                                    $t_time = "am";
                                }

                                $from_time = $from_h . ":" . $array_from[1] . " " . "$f_time";
                                $to_time = $to_h . ":" . $array_to[1] . " " . "$t_time";

                                $f_t[] = $from_time;
                                $t_t[] = $to_time;
                            }
                        }

                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $oid . ')" onMouseout="emp_app_hide()"';

                        echo '<tr class="plugintr">
                              <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $oid . ')" onMouseout="emp_app_hide()"><img style="width:40px; height:40px" src="' . $profile_pic . '"></td>
                              <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                              <td ' . $mouseover . '>' . $ot_date . '</td>';
					/*		  
			      <td>' . $f_t[$i] . '-' . $t_t[$i] . '</br>' . $f_t[$j] . '-' . $t_t[$j] . '</td>';
                        $i = $i + 2;
                        $j = $j + 2;
						*/

                        echo'<td>' . $from_time1 . '</td>
                            <td>' . $to_time1 . '</td>
                            <td>' . $r_date . '</td>';
                        if (isset($_GET["e"]) && !empty($_GET["e"])) {
                            if ($status != 'Pending') {
                                echo '<td class="aligncentertable">' . $status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $oid . '">';
                                echo '<select name="dropDownLoan" id="drop' . $oid . '" onchange="saveValue_admin(' . $oid . ' , '. $emp_id.')" style="width: 100px;">';
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
				
				/*
				
				else {
                    if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                        $sql = "SELECT o.*, o.id as oid, e.id AS emp_id, e.* 
                                FROM employee_overtime AS o 
                                INNER JOIN employee AS e 
                                ON e.id=o.emp_id
                                WHERE o.ot_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')
                                AND o.request_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
                        $sql = "SELECT o.*, o.id as oid, e.id AS emp_id, e.* 
                                FROM employee_overtime AS o 
                                INNER JOIN employee AS e 
                                ON e.id=o.emp_id
                                WHERE o.ot_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')
                                AND DATE_SUB(CURDATE(),INTERVAL 60 DAY) <= o.request_date";
                    }
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND e.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY o.request_date DESC";

                    $rs = mysql_query($sql);
                    $i = 0;
                    $j = 1;

                    while ($row = mysql_fetch_array($rs)) {
                        $profile_pic = $row['image_src'];
                        $full_name = $row['full_name'];
                        $emp_id = $row['emp_id'];
                        $r_date = $row['request_date'];
                        $ot_date = $row['ot_date'];
                        $from = $row['from_time'];
                        $to = $row['to_time'];
                        $status = $row['ot_status'];
                        $oid = $row["oid"];

                        $array_from = explode(":", $from);
                        $array_to = explode(":", $to);
                        if ($array_from[0] > 12) {

                            $from_h1 = $array_from[0] - 12;
                            $from_h = "" . $from_h1 . "";
                            $f_time = "pm";
                        } else {

                            if ($array_from[0] >= 10) {
                                $from_h = substr($array_from[0], 0);
                            } else {
                                $from_h = substr($array_from[0], 1);
                            }
                            $f_time = "am";
                        }

                        if ($array_to[0] > 12) {

                            $to_h1 = $array_to[0] - 12;
                            $to_h = "" . $to_h1 . "";
                            $t_time = "pm";
                        } else {

                            if ($array_to[0] >= 10) {
                                $to_h = substr($array_to[0], 0);
                            } else {
                                $to_h = substr($array_to[0], 1);
                            }
                            $t_time = "am";
                        }

                        $from_time1 = $from_h . ":" . $array_from[1] . " " . "$f_time";
                        $to_time1 = $to_h . ":" . $array_to[1] . " " . "$t_time";



                        $weekday = date('N', strtotime($ot_date));

                        $query = "SELECT * FROM emp_time_table WHERE emp_id=" . $row['emp_id'] . "
						  AND day=" . $weekday;
                        $result = mysql_query($query);
                        $num_rows = mysql_num_rows($result);
                        if ($num_rows > 0) {
                            while ($row2 = mysql_fetch_array($result)) {
                                $from = $row2['from_time'];
                                $to = $row2['to_time'];


                                $array_from = explode(":", $from);
                                $array_to = explode(":", $to);
                                if ($array_from[0] > 12) {

                                    $from_h1 = $array_from[0] - 12;
                                    $from_h = "" . $from_h1 . "";
                                    $f_time = "pm";
                                } else {

                                    if ($array_from[0] >= 10) {
                                        $from_h = substr($array_from[0], 0);
                                    } else {
                                        $from_h = substr($array_from[0], 1);
                                    }
                                    $f_time = "am";
                                }

                                if ($array_to[0] > 12) {

                                    $to_h1 = $array_to[0] - 12;
                                    $to_h = "" . $to_h1 . "";
                                    $t_time = "pm";
                                } else {

                                    if ($array_to[0] >= 10) {
                                        $to_h = substr($array_to[0], 0);
                                    } else {
                                        $to_h = substr($array_to[0], 1);
                                    }
                                    $t_time = "am";
                                }

                                $from_time = $from_h . ":" . $array_from[1] . " " . "$f_time";
                                $to_time = $to_h . ":" . $array_to[1] . " " . "$t_time";

                                $f_t[] = $from_time;
                                $t_t[] = $to_time;
                            }
                        } else {
                            $query = "SELECT * FROM time_table WHERE day=" . $weekday;
                            $result = mysql_query($query);
                            while ($row3 = mysql_fetch_array($result)) {

                                $from = $row3['from_time'];
                                $to = $row3['to_time'];


                                $array_from = explode(":", $from);
                                $array_to = explode(":", $to);
                                if ($array_from[0] > 12) {

                                    $from_h1 = $array_from[0] - 12;
                                    $from_h = "" . $from_h1 . "";
                                    $f_time = "pm";
                                } else {

                                    if ($array_from[0] >= 10) {
                                        $from_h = substr($array_from[0], 0);
                                    } else {
                                        $from_h = substr($array_from[0], 1);
                                    }
                                    $f_time = "am";
                                }

                                if ($array_to[0] > 12) {

                                    $to_h1 = $array_to[0] - 12;
                                    $to_h = "" . $to_h1 . "";
                                    $t_time = "pm";
                                } else {

                                    if ($array_to[0] >= 10) {
                                        $to_h = substr($array_to[0], 0);
                                    } else {
                                        $to_h = substr($array_to[0], 1);
                                    }
                                    $t_time = "am";
                                }

                                $from_time = $from_h . ":" . $array_from[1] . " " . "$f_time";
                                $to_time = $to_h . ":" . $array_to[1] . " " . "$t_time";

                                $f_t[] = $from_time;
                                $t_t[] = $to_time;
                            }
                        }

                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $oid . ')" onMouseout="emp_app_hide()"';

                        echo '<tr class="plugintr">
                              <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $oid . ')" onMouseout="emp_app_hide()"><img style="width:40px; height:40px" src="' . $profile_pic . '"></td>
                              <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                              <td ' . $mouseover . '>' . $ot_date . '</td>';
							/*
			      <td>' . $f_t[$i] . '-' . $t_t[$i] . '</br>' . $f_t[$j] . '-' . $t_t[$j] . '</td>';
                        $i = $i + 2;
                        $j = $j + 2;
                   
                        echo'<td>' . $from_time1 . '</td>
                            <td>' . $to_time1 . '</td>
                            <td>' . $r_date . '</td>';
                        if (isset($_GET["e"]) && !empty($_GET["e"])) {
                            if ($status != 'Pending') {
                                echo '<td class="aligncentertable">' . $status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $oid . '">';
                                echo '<select name="dropDownLoan" id="drop' . $oid . '" onchange="saveValue_admin(' . $oid . ')" style="width: 100px;">';
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
    <div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Employee & Overtime Date</span> to see more details *</div>
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
    
    $("#fromdate, #todate").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function (){
            var from = $("#fromdate").val();
            var to = $("#todate").val();
            if(from != "" && to != ""){
                if(from > to){
                    window.location = '?loc=e_overtime&str1=<?php echo $_GET["str1"]; ?>&str2=<?php echo $_GET["str2"]; ?>&str3=<?php echo $_GET["str3"]; ?>&from='+to+'&to='+from;   
                }else{
                    window.location = '?loc=e_overtime&str1=<?php echo $_GET["str1"]; ?>&str2=<?php echo $_GET["str2"]; ?>&str3=<?php echo $_GET["str3"]; ?>&from='+from+'&to='+to;   
                }    
            }
        },
		onClose: function( selectedDate ) {
    $( "#todate" ).datepicker( "option", "minDate", selectedDate );
	}
    });
    
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
                action:"admin_overtime_emp"
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
    
    $(document).ready(function() {
        oTable = $('#tablecolor').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
    
    function saveValue_admin(id, emp_id){
        //alert(id);
        var e = document.getElementById("drop"+id);
        var status = e.options[e.selectedIndex].value;
        $.ajax({
           // type:"POST",
			dataType:'json',
            url:"?widget=instantUpdate_e_ot",
            data:{
                status:status,
				emp_id:emp_id,
                id:id
            },
            success:function(data){
                if(data.query == "true"){
                  //  alert("E-Overtime Status Updated");
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
            url:"?widget=approve_overtime",
            data:{
                eid:eid,
                id:id,
                status:status,
                aid:aid
            },
            success:function(data){
                if(data.query == "true"){
                    alert("E-Overtime Status Updated");
                    $("#updateStatus"+id).empty().append(data.status);
                }else{
                    alert("Error While Proccessing");
                }
            }
        })
    }
    
    function editLoan(){
        var str1='<?php print $_GET['str1']; ?>';
        var str2='<?php print $_GET['str2']; ?>';
        var str3='<?php print $_GET['str3']; ?>';
        var cur = document.getElementById('editBut').value;
        if(cur == 'Edit'){   
            window.location='?loc=e_overtime&str1='+str1+'&str2='+str2+'&str3='+str3+'&e=edit';
        }else{
            window.location='?loc=e_overtime&str1='+str1+'&str2='+str2+'&str3='+str3+'&e=edit';
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