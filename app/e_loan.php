<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Loan Application</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
		<p>
		<div class="modal"></div>
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
        <span>Loan</span>
        <span style="float: right;">
            <?php
            if ($igen_a_ea == "a_ea_edit") {
                if (isset($_GET['e']) && !empty($_GET['e'])) {
				
                    $val = 'Back';
                
                ?>
                <table>
                    <tr><td><input class="button" type="button" value ="<?php echo $val ?>" onClick="history.back(-1)" style="width: 70px; position:relative; top:2px" id="editBut"/></td></tr>
                </table>
            <?php 
			}else{
			  ?>
               <!-- <table>
                    <tr><td><input class="button" type="button" value ="Done" onClick="ref()" style="width: 70px; position:relative; top:2px" id="editBut"/></td></tr>
                </table>-->
            <?php
			
			}
			} ?>
        </span>
    </div>

    <div class="main_content">
        <div class="plugindiv" id="loanDiv">
            <table id="tablecolor" class="TFtable" >
                <thead>
                    <tr class="pluginth">
                        <th class="aligncentertable" style="width:40px"></th>
                        <th style="width:200px">Employee</th>
                        <th style="width:100px">Loan Type</th>
                        <th class="alignrighttable" style="width:100px">Loan Amount (RM)</th>
						<th class="aligncentertable" style="width:100px">Start date</th>
						<th class="aligncentertable" style="width:100px">End date</th>
                        <th class="aligncentertable" style="width:50px">Installment (Month)</th>
			
                        <th style="width:100px">Apply Date</th>
						<th style="width:150px">Reason</th>
						<!--<th style="width: 50px;">Attachment</th>-->
                        <th class="aligncentertable" style="width:100px">Status</th>
						<th class="aligncentertable" style="width:100px">Action</th>
                    </tr>
                </thead>
                <?php
				 if($_COOKIE["igen_id"]==""){
						$user_id = $_COOKIE["igen_user_id"];
					}else{
						$user_id = $_COOKIE["igen_id"];
					}
	
				 $sql2 = "SELECT * FROM approval WHERE
                            (level_pos_1=" . $user_id
                            . " OR level_pos_2=" . $user_id
                            . " OR level_pos_3=" . $user_id . " OR superior_1=" . $user_id
                            . " OR superior_2=" . $user_id . " OR superior_3=" . $user_id . ")";
                    $rs2 = mysql_query($sql2);
					$count= mysql_num_rows($rs2);
					
					
                  while($row2 = mysql_fetch_array($rs2)){ 
				    $dep=$row2['dep_id'];
					$superv1=$row2["superior_1"];
					$superv2=$row2["superior_2"];
					$superv3=$row2["superior_3"];
					$level_pos_1=$row2["level_pos_1"];
					$level_pos_2=$row2["level_pos_2"];
					$level_pos_3=$row2["level_pos_3"];
					if($superv1==$user_id || $level_pos_1==$user_id){
					
				 if (isset($_GET["e"]) && !empty($_GET["e"])) {
                           $id=$_GET['id'];
                           
                           $sql = "SELECT emp_l.*, emp.full_name, emp.image_src
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_l.id='".$id."' AND emp_l.loan_status ='Pending'";
                          $rs = mysql_query($sql);
                          while ($row = mysql_fetch_array($rs)) {
						  $type_of_loan = $row['type_of_loan'];
                        $loan_amount = $row['loan_amount'];
                        $installment = $row['installment'];
                        $reason_for_loan = $row['reason_for_loan'];
                        $loan_status = $row['loan_status'];
                        $full_name = $row['full_name'];
                        $emp_id = $row['emp_id'];
                        $rep_month = $row['rep_month'];
                        $loan_date = $row['loan_date'];
                        $img = $row['image_src'];
                        $loanid = $row['id'];
						$img_path =$row['img_path'];
						$start_date=$row['start_date'];
						$end_date = $row['end_date'];
						

                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"';

                        echo'<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()">sss<img src="' . $img . '" style="width:40px;
                        height:40px"/></td> 
                            <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $type_of_loan . '</td>
                            <td class="alignrighttable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()">' . number_format($loan_amount, 2, '.', '') . '</td>';
                           if ($loan_status == 'Pending') {
                               
                            
							echo'<td class="aligncentertable"><input type="text" class="fromdate1" value="'.date("d-m-Y", strtotime($start_date)).'" onchange="saveValue_admin1(' . $loanid . ' ) " style="width: 100px;"></td>
							     <td class="aligncentertable"><input type="text" class="todate1" value="'.date("d-m-Y", strtotime( $end_date)) .'" onchange="saveValue_admin1(' . $loanid . ' ) " style="width: 100px;"></td>';
							
							}else{
							echo'<td class="aligncentertable">' .date("d-m-Y", strtotime( $start_date)).'</td>';
							echo'<td class="aligncentertable">' .date("d-m-Y", strtotime( $end_date)).'</td>';
							
							}
							
							
							
						  echo'<td class="aligncentertable">' . $rep_month . '</td>
                            <td>' . date("d-m-Y", strtotime( $loan_date)) . '</td>
							<td>' . $reason_for_loan . '</td>';
							
                        
					if($img_path!=null){
					//echo '<td class="aligncentertable"><a href="uploads/loan/' .$img_path. '" target="_blank">View</a></td>';
					}else{
					//echo '<td class="aligncentertable"></td>';
					}
                    
                            //if ($loan_status != 'Pending') {
                                echo '<td class="aligncentertable">' . $loan_status . '</td>';
                            /*} else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $loanid . '">';
                                echo '<select name="dropDownLoan" id="drop"  style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                      <option value="Approved">Approve</option>
                                      <option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }*/
                          if ($loan_status == 'Pending') {
						echo'<td><input class="button" type="button" value ="Done" onclick="saveValue_admin1('.$loanid.', '.$emp_id .')" id="editBut"/></td>';
						}else{
						echo '<td>- </td>';
						}
                        echo '</tr>';
					
					
					
					}
                        }else{
						//
						
						
                   if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                        $sql = "SELECT emp_l.*, emp.full_name, emp.image_src 
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_l.loan_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')
                                 AND emp_l.loan_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
					if($superv1!=$user_id && $level_pos_1==$user_id){
					                        $sql = "SELECT emp_l.*, emp.full_name, emp.image_src
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_l.loan_status IN ('" . $_GET['str1'] . "')";
					}else{
                        $sql = "SELECT emp_l.*, emp.full_name, emp.image_src
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_l.loan_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')";
								}
                    }
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND emp.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY emp_l.loan_date DESC";

                    $rs = mysql_query($sql);
                    while ($row = mysql_fetch_array($rs)) {
                        $type_of_loan = $row['type_of_loan'];
                        $loan_amount = $row['loan_amount'];
                        $installment = $row['installment'];
                        $reason_for_loan = $row['reason_for_loan'];
                        $loan_status = $row['loan_status'];
                        $full_name = $row['full_name'];
                        $emp_id = $row['emp_id'];
                        $rep_month = $row['rep_month'];
                        $loan_date = $row['loan_date'];
                        $img = $row['image_src'];
                        $loanid = $row['id'];
						$start_date=$row['start_date'];
						$end_date = $row['end_date'];
						$img_path =$row['img_path'];
						

                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"';

                        echo'<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"><img src="' . $img . '" style="width:40px;
                        height:40px"/></td> 
                            <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $type_of_loan . '</td>
                            <td class="alignrighttable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()">' . number_format($loan_amount, 2, '.', '') . '</td>
                            <td class="aligncentertable">'.date("d-m-Y", strtotime( $start_date)).'</td>
							
							<td class="aligncentertable">' . date("d-m-Y", strtotime( $end_date)) . '</td>
							<td class="aligncentertable">' . $rep_month . '</td>
                            <td>' . date("d-m-Y", strtotime($loan_date)) . '</td>
							<td>' . $reason_for_loan . '</td>';
						if($img_path!=null){
					//echo '<td class="aligncentertable"><a href="uploads/loan/' .$img_path. '" target="_blank">View</a></td>';
					}else{
					//echo '<td class="aligncentertable"></td>';
					}
                       
                            if ($loan_status != 'Pending') {
                                echo '<td class="aligncentertable">' . $loan_status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $loanid . '">';
                                echo '<select name="dropDownLoan" id="drop' . $loanid . '" onchange="saveValue_admin('.$loanid.', '.$emp_id.')"  style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                      <option value="Approved">Approve</option>
                                      <option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
							if($loan_status =="Pending"){
                            echo'<td onclick="editLoan('.$loanid.')"><i class="far fa-edit" style="color:#000;" aria-hidden="true"></i></td>';
							}else{
							echo'<td>-</td>';
							
							}
                        echo '</tr>';
                    }
					}
					
						//
						}
						
						if($superv2==$user_id || $level_pos_2==$user_id){
						
						if (isset($_GET["e"]) && !empty($_GET["e"])) {
                           $id=$_GET['id'];

                           $sql = "SELECT emp_l.*, emp.full_name, emp.image_src
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."')  AND emp_l.id='".$id."' AND emp_l.loan_status='Approved_lv1'";
                          $rs = mysql_query($sql);
                          while ($row = mysql_fetch_array($rs)) {
						  $type_of_loan = $row['type_of_loan'];
                        $loan_amount = $row['loan_amount'];
                        $installment = $row['installment'];
                        $reason_for_loan = $row['reason_for_loan'];
                        $loan_status = $row['loan_status'];
                        $full_name = $row['full_name'];
                        $emp_id = $row['emp_id'];
                        $rep_month = $row['rep_month'];
                        $loan_date = $row['loan_date'];
                        $img = $row['image_src'];
                        $loanid = $row['id'];
						$img_path =$row['img_path'];
						$start_date=$row['start_date']; 
						$end_date = $row['end_date'];
						
                      if($loan_status =="Approved_lv1"){
						$loan_status ="Pending";
						
						}
                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"';

                        echo'<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"><img src="' . $img . '" style="width:40px;
                        height:40px"/></td> 
                            <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $type_of_loan . '</td>
                            <td class="alignrighttable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()">' . number_format($loan_amount, 2, '.', '') . '</td>';
                           if ($loan_status == 'Pending') {
                               
                            
							echo'<td class="aligncentertable"><input type="text" class="fromdate1" value="'.date("d-m-Y", strtotime( $start_date)).'" onchange="saveValue_admin1(' . $loanid . ' ) " style="width: 100px;"></td>
							     <td class="aligncentertable"><input type="text" class="todate1" value="'.date("d-m-Y", strtotime( $end_date )).'" onchange="saveValue_admin1(' . $loanid . ' ) " style="width: 100px;"></td>';
							
							}else{
							echo'<td class="aligncentertable">' .date("d-m-Y", strtotime( $start_date)).'</td>';
							echo'<td class="aligncentertable">' .date("d-m-Y", strtotime($end_date)).'</td>';
							
							}
							
						  echo'<td class="aligncentertable">' . $rep_month . '</td>
                            <td>' . date("d-m-Y", strtotime( $loan_date)) . '</td>
							<td>' . $reason_for_loan . '</td>';
							
                      if($img_path!=null){
					//echo '<td class="aligncentertable"><a href="uploads/loan/' .$img_path. '" target="_blank">View</a></td>';
					}else{
					//echo '<td class="aligncentertable"></td>';
					}
                            if ($loan_status != 'Pending') {
                                echo '<td class="aligncentertable">' . $loan_status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $loanid . '">';
                                echo '<select name="dropDownLoan" id="drop"  style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                      <option value="Approved">Approve</option>
                                      <option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
                        
						 if ($loan_status == 'Pending') {
						echo'<td><input class="button" type="button" value ="Done" onclick="saveValue_admin1('.$loanid.', '.$emp_id .')" id="editBut"/></td>';
						}else{
						echo '<td>- </td>';
						}
                        echo '</tr>';
					
					
					
					}
                        }else{
						//
						
						
                   if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                        $sql = "SELECT emp_l.*, emp.full_name, emp.image_src 
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_l.loan_status IN ('Approved','Rejected','Approved_lv1')
                                 AND emp_l.loan_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
					if($superv2!=$user_id && $level_pos_2==$user_id){
					$sql = "SELECT emp_l.*, emp.full_name, emp.image_src
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_l.loan_status IN ('Approved_lv1')";
					
					}else{
					if($superv2!=$superv1){
                        $sql = "SELECT emp_l.*, emp.full_name, emp.image_src
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_l.loan_status IN ('Approved','Rejected','Approved_lv1')";
								}
						}
                    }
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND emp.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY emp_l.loan_date DESC";

                    $rs = mysql_query($sql);
                    while ($row = mysql_fetch_array($rs)) {
                        $type_of_loan = $row['type_of_loan'];
                        $loan_amount = $row['loan_amount'];
                        $installment = $row['installment'];
                        $reason_for_loan = $row['reason_for_loan'];
                        $loan_status = $row['loan_status'];
                        $full_name = $row['full_name'];
                        $emp_id = $row['emp_id'];
                        $rep_month = $row['rep_month'];
                        $loan_date = $row['loan_date'];
                        $img = $row['image_src'];
                        $loanid = $row['id'];
						$start_date=$row['start_date'];
						$end_date = $row['end_date'];
						$img_path =$row['img_path'];
						if($loan_status =="Approved_lv1"){
						$loan_status ="Pending";
						
						}

                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"';

                        echo'<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"><img src="' . $img . '" style="width:40px;
                        height:40px"/></td> 
                            <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $type_of_loan . '</td>
                            <td class="alignrighttable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()">' . number_format($loan_amount, 2, '.', '') . '</td>
                            <td class="aligncentertable">'.date("d-m-Y", strtotime( $start_date)).'</td>
							
							<td class="aligncentertable">' . date("d-m-Y", strtotime( $end_date)) . '</td>
							<td class="aligncentertable">' . $rep_month . '</td>
                            <td>' . date("d-m-Y", strtotime($loan_date)) . '</td>
							<td>' . $reason_for_loan . '</td>';
						   if($img_path!=null){
					//echo '<td class="aligncentertable"><a href="uploads/loan/' .$img_path. '" target="_blank">View</a></td>';
					}else{
					//echo '<td class="aligncentertable"></td>';
					}
                       
                              if ($loan_status != 'Pending') {
                                echo '<td class="aligncentertable">' . $loan_status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $loanid . '">';
                                echo '<select name="dropDownLoan" id="drop' . $loanid . '" onchange="saveValue_admin(' . $loanid . ', ' . $emp_id . ')"   style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                      <option value="Approved">Approve</option>
                                      <option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
							if($loan_status =="Pending"){
                            echo'<td onclick="editLoan('.$loanid.')"><i class="far fa-edit" style="color:#000;" aria-hidden="true"></i></td>';
							}else{
							echo'<td>-</td>';
							
							}
                        echo '</tr>';
                    }
					}
					
						//
						
						}
						if($superv3==$user_id || $level_pos_3==$user_id){
						
						if (isset($_GET["e"]) && !empty($_GET["e"])) {
                           $id=$_GET['id'];
                           
                           $sql = "SELECT emp_l.*, emp.full_name, emp.image_src
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."'  AND emp_l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_l.id='".$id."' AND emp_l.loan_status='Approved_lv2'";
                          $rs = mysql_query($sql);
                          while ($row = mysql_fetch_array($rs)) {
						  $type_of_loan = $row['type_of_loan'];
                        $loan_amount = $row['loan_amount'];
                        $installment = $row['installment'];
                        $reason_for_loan = $row['reason_for_loan'];
                        $loan_status = $row['loan_status'];
                        $full_name = $row['full_name'];
                        $emp_id = $row['emp_id'];
                        $rep_month = $row['rep_month'];
                        $loan_date = $row['loan_date'];
                        $img = $row['image_src'];
                        $loanid = $row['id'];
						$start_date=$row['start_date'];
						$end_date = $row['end_date'];
						
						$img_path =$row['img_path'];
						
                      if($loan_status =="Approved_lv2"){
						$loan_status ="Pending";
						
						}
                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"';

                        echo'<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"><img src="' . $img . '" style="width:40px;
                        height:40px"/></td> 
                            <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $type_of_loan . '</td>
                            <td class="alignrighttable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()">' . number_format($loan_amount, 2, '.', '') . '</td>';
                          if ($loan_status == 'Pending') {
                               
                            
							echo'<td class="aligncentertable"><input type="text" class="fromdate1" value="'.date("d-m-Y", strtotime($start_date)).'" onchange="saveValue_admin1(' . $loanid . ' ) " style="width: 100px;"></td>
							     <td class="aligncentertable"><input type="text" class="todate1" value="'.date("d-m-Y", strtotime($end_date)).'" onchange="saveValue_admin1(' . $loanid . ' ) " style="width: 100px;"></td>';
							
							}else{
							echo'<td class="aligncentertable">' .date("d-m-Y", strtotime($start_date)).'</td>';
							echo'<td class="aligncentertable">' .date("d-m-Y", strtotime( $end_date)).'</td>';
							
							}
							
						  echo'<td class="aligncentertable">' . $rep_month . '</td>
                            <td>' . date("d-m-Y", strtotime( $loan_date)) . '</td>
							<td>' . $reason_for_loan . '</td>';
							
                           if($img_path!=null){
					//echo '<td class="aligncentertable"><a href="uploads/loan/' .$img_path. '" target="_blank">View</a></td>';
					}else{
					//echo '<td class="aligncentertable"></td>';
					}
                            //if ($loan_status != 'Pending') {
                                echo '<td class="aligncentertable">' . $loan_status . '</td>';
								/*
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $loanid . '">';
                                echo '<select name="dropDownLoan" id="drop"  style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                      <option value="Approved">Approve</option>
                                      <option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
							*/
                        
						 if ($loan_status == 'Pending') {
						echo'<td><input class="button" type="button" value ="Done" onclick="saveValue_admin1('.$loanid.', '.$emp_id .')" id="editBut"/></td>';
						}else{
						echo '<td>- </td>';
						}
                        echo '</tr>';
					
					
					
					}
                        }
						else{
						//
						
						
                   if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                        $sql = "SELECT emp_l.*, emp.full_name, emp.image_src 
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_l.loan_status IN ('Approved','Rejected','Approved_lv2')
                                 AND emp_l.loan_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
					if($superv3!=$user_id && $level_pos_3==$user_id){
					$sql = "SELECT emp_l.*, emp.full_name, emp.image_src
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_l.loan_status IN ('Approved_lv2')";
					
					}else{
					if($superv3!=$superv1 && $superv3!=$superv2){
                        $sql = "SELECT emp_l.*, emp.full_name, emp.image_src
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_l.loan_status IN ('Approved','Rejected','Approved_lv2')";
								}
								if($superv3==$superv1 && $superv3!=$superv2){
								$sql = "SELECT emp_l.*, emp.full_name, emp.image_src
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.emp_id NOT IN('".$user_id."', '".$superv1."', '".$superv2."','".$superv3."') AND emp_l.loan_status IN ('Approved_lv2')";
								
								}
								}
                    }
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND emp.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY emp_l.loan_date DESC";

                    $rs = mysql_query($sql);
                    while ($row = mysql_fetch_array($rs)) {
                        $type_of_loan = $row['type_of_loan'];
                        $loan_amount = $row['loan_amount'];
                        $installment = $row['installment'];
                        $reason_for_loan = $row['reason_for_loan'];
                        $loan_status = $row['loan_status'];
                        $full_name = $row['full_name'];
                        $emp_id = $row['emp_id'];
                        $rep_month = $row['rep_month'];
                        $loan_date = $row['loan_date'];
                        $img = $row['image_src'];
                        $loanid = $row['id'];
						$start_date=$row['start_date'];
						$end_date = $row['end_date'];
						$img_path =$row['img_path'];
						if($loan_status =="Approved_lv2"){
						$loan_status ="Pending";
						
						} 

                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"';

                        echo'<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"><img src="' . $img . '" style="width:40px;
                        height:40px"/></td> 
                            <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $type_of_loan . '</td>
                            <td class="alignrighttable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()">' . number_format($loan_amount, 2, '.', '') . '</td>
                            <td class="aligncentertable">'.date("d-m-Y", strtotime( $start_date)).'</td>
							
							<td class="aligncentertable">' . date("d-m-Y", strtotime( $end_date)) . '</td>
							<td class="aligncentertable">' . $rep_month . '</td>
                            <td>' . date("d-m-Y", strtotime( $loan_date)) . '</td>
							<td>' . $reason_for_loan . '</td>';
						if($img_path!=null){
					//echo '<td class="aligncentertable"><a href="uploads/loan/' .$img_path. '" target="_blank">View</a></td>';
					}else{
					//echo '<td class="aligncentertable"></td>';
					}
                       
                              if ($loan_status != 'Pending') {
                                echo '<td class="aligncentertable">' . $loan_status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $loanid . '">';
                                echo '<select name="dropDownLoan" id="drop' . $loanid . '" onchange="saveValue_admin(' . $loanid . ', ' . $emp_id . ')"   style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                      <option value="Approved">Approve</option>
                                      <option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
							if($loan_status =="Pending"){
                            echo'<td onclick="editLoan('.$loanid.')"><i class="far fa-edit" style="color:#000;" aria-hidden="true"></i></td>';
							}else{
							echo'<td>-</td>';
							
							}
                        echo '</tr>';
                    }
					}
					
						//
						
						}
				}
					$sql_dep = "select * from approval_m where emp_id='" .$user_id. "'";
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
                        $sql = "SELECT emp_l.*, emp.full_name, emp.image_src 
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.emp_id IN('".$lv1."','".$lv2."','".$lv3."') AND emp_l.loan_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')
                                 AND emp_l.loan_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
					if($backup==$user_id){
					                        $sql = "SELECT emp_l.*, emp.full_name, emp.image_src
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.emp_id IN('".$lv1."','".$lv2."','".$lv3."') AND emp_l.loan_status IN ('" . $_GET['str1'] . "')";
					}else{
                        $sql = "SELECT emp_l.*, emp.full_name, emp.image_src
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.emp_id IN('".$lv1."','".$lv2."','".$lv3."') AND emp_l.loan_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')";
								}
                    }
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND emp.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY emp_l.loan_date DESC";

                    $rs = mysql_query($sql);
                    while ($row = mysql_fetch_array($rs)) {
                        $type_of_loan = $row['type_of_loan'];
                        $loan_amount = $row['loan_amount'];
                        $installment = $row['installment'];
                        $reason_for_loan = $row['reason_for_loan'];
                        $loan_status = $row['loan_status'];
                        $full_name = $row['full_name'];
                        $emp_id = $row['emp_id'];
                        $rep_month = $row['rep_month'];
                        $loan_date = $row['loan_date'];
                        $img = $row['image_src'];
                        $loanid = $row['id'];
						$start_date=$row['start_date'];
						$end_date = $row['end_date'];
						$img_path =$row['img_path'];
						

                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"';

                        echo'<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"><img src="' . $img . '" style="width:40px;
                        height:40px"/></td> 
                            <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $type_of_loan . '</td>
                            <td class="alignrighttable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()">' . number_format($loan_amount, 2, '.', '') . '</td>
                            <td class="aligncentertable">'.date("d-m-Y", strtotime( $start_date)).'</td>
							
							<td class="aligncentertable">' . date("d-m-Y", strtotime( $end_date)) . '</td>
							<td class="aligncentertable">' . $rep_month . '</td>
                            <td>' . date("d-m-Y", strtotime($loan_date)) . '</td>
							<td>' . $reason_for_loan . '</td>';
						if($img_path!=null){
					//echo '<td class="aligncentertable"><a href="uploads/loan/' .$img_path. '" target="_blank">View</a></td>';
					}else{
					//echo '<td class="aligncentertable"></td>';
					}
                       
                            if ($loan_status != 'Pending') {
                                echo '<td class="aligncentertable">' . $loan_status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $loanid . '">';
                                echo '<select name="dropDownLoan" id="drop' . $loanid . '" onchange="saveValue_admin('.$loanid.', '.$emp_id.')"  style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                      <option value="Approved">Approve</option>
                                      <option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
							if($loan_status =="Pending"){
                            echo'<td onclick="editLoan('.$loanid.')"><i class="far fa-edit" style="color:#000;" aria-hidden="true"></i></td>';
							}else{
							echo'<td>-</td>';
							
							}
                        echo '</tr>';
                    }
				}
				}
						/*
						else{ 
						
                if (isset($_COOKIE["igen_user_id"]) || isset($_COOKIE["igen_id"])) {
                    $user_id = $_COOKIE["igen_user_id"];
                    $sql1 = "SELECT position_id, dep_id, group_id FROM employee e where id=" . $user_id;
                    $rs1 = mysql_query($sql1);
                    $row1 = mysql_fetch_array($rs1);
                    $position_id = $row1["position_id"];
                    $dep_id = $row1["dep_id"];
                    $group_id = $row1["group_id"];

                    $sql2 = "SELECT * FROM approval WHERE
         
                            (level_pos_1=" . $position_id
                            . " OR level_pos_2=" . $position_id
                            . " OR level_pos_3=" . $position_id . " OR superior_1=" . $user_id
                            . " OR superior_2=" . $user_id . " OR superior_3=" . $user_id . ")";
                    $rs2 = mysql_query($sql2);
                   $count= mysql_num_rows($sql2);
					
					
                  while($row2 = mysql_fetch_array($rs2)){
				    $dep=$row2['dep_id'];

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

                    echo '<span id="aid" style="display: none;">' . substr($approval_level, 0, -1) . '</span>';

                   if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                        $sql = "SELECT emp_l.*, emp.full_name, emp.image_src 
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.loan_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')
                                 AND emp_l.loan_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
                        $sql = "SELECT emp_l.*, emp.full_name, emp.image_src
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.depid='".$dep."' AND emp_l.loan_status IN ('" . $_GET['str1'] . "', '" . $_GET['str2'] . "', '" . $_GET['str3'] . "' )
                                AND DATE_SUB(CURDATE(), INTERVAL 60 DAY) <= emp_l.loan_date";
                    }
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND emp.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY emp_l.loan_date DESC";

                    $rs = mysql_query($sql);
                    while ($row = mysql_fetch_array($rs)) {
                        $type_of_loan = $row['type_of_loan'];
                        $loan_amount = $row['loan_amount'];
                        $installment = $row['installment'];
                        $reason_for_loan = $row['reason_for_loan'];
                        $loan_status = $row['loan_status'];
                        $full_name = $row['full_name'];
                        $emp_id = $row['emp_id'];
                        $rep_month = $row['rep_month'];
                        $loan_date = $row['loan_date'];
                        $img = $row['image_src'];
                        $loanid = $row['id'];
						$start_date=$row['start_date'];
						$end_date = $row['end_date'];
						

                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"';

                        echo'<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"><img src="' . $img . '" style="width:40px;
                        height:40px"/></td> 
                            <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $type_of_loan . '</td>
                            <td class="alignrighttable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()">' . number_format($loan_amount, 2, '.', '') . '</td>
                            <td class="aligncentertable">'.$start_date.'</td>
							
							<td class="aligncentertable">' . $end_date . '</td>
							<td class="aligncentertable">' . $rep_month . '</td>
                            <td>' . $loan_date . '</td>';
						
                       
                            echo '<td class="aligncentertable">' . $loan_status . '</td>';
                            echo'<td><input class="button" type="button" value ="Edit" onclick="editLoan('.$loanid.')" id="editBut"/></td>';
                        echo '</tr>';
                    }
					}
                } else {
                    if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                        $sql = "SELECT emp_l.*, emp.full_name, emp.image_src 
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.loan_status IN ('" . $_GET['str1'] . "','" . $_GET['str2'] . "','" . $_GET['str3'] . "')
                                AND emp_l.loan_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
                    } else {
                        $sql = "SELECT emp_l.*, emp.full_name, emp.image_src
                                FROM employee as emp
                                inner join employee_loan as emp_l
                                on emp.id = emp_l.emp_id
                                WHERE emp_l.loan_status IN ('" . $_GET['str1'] . "', '" . $_GET['str2'] . "', '" . $_GET['str3'] . "' )
                                AND DATE_SUB(CURDATE(), INTERVAL 60 DAY) <= emp_l.loan_date";
                    }
                    if ($igen_companylist == "") {
                        $sql.="";
                    } else {
                        $sql.=" AND emp.company_id = " . $igen_companylist;
                    }
                    $sql.=" ORDER BY emp_l.loan_date DESC";

                    $rs = mysql_query($sql);
                    while ($row = mysql_fetch_array($rs)) {
                        $type_of_loan = $row['type_of_loan'];
                        $loan_amount = $row['loan_amount'];
                        $installment = $row['installment'];
                        $reason_for_loan = $row['reason_for_loan'];
                        $loan_status = $row['loan_status'];
                        $full_name = $row['full_name'];
                        $emp_id = $row['emp_id'];
                        $rep_month = $row['rep_month'];
                        $loan_date = $row['loan_date'];
                        $img = $row['image_src'];
                        $loanid = $row['id'];
						$start_date=$row['start_date'];
						$end_date = $row['end_date'];
						

                        $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"';

                        echo'<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()"><img src="' . $img . '" style="width:40px;
                        height:40px"/></td> 
                            <td ' . $mouseover . '><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                            <td ' . $mouseover . '>' . $type_of_loan . '</td>
                            <td class="alignrighttable cursor_pointer" onMouseover="emp_app(' . $loanid . ' ) " onMouseout="emp_app_hide()">' . number_format($loan_amount, 2, '.', '') . '</td>';
                          
							echo'<td class="aligncentertable">'.$start_date.'</td>
							
							<td class="aligncentertable">' . $end_date . '</td>';
							
							
						  echo'<td class="aligncentertable">' . $rep_month . '</td>
                            <td>' . $loan_date . '</td>';
							/*
                       // if (isset($_GET["e"]) && !empty($_GET["e"])) {
                            if ($loan_status != 'Pending') {
                                echo '<td class="aligncentertable">' . $loan_status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $loanid . '">';
                                echo '<select name="dropDownLoan" id="drop' . $loanid . '" onchange="saveValue_admin(' . $loanid . ' ) " style="width: 100px;">';
                                echo '<option value="Pending">Pending</option>
                                      <option value="Approved">Approve</option>
                                      <option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
                        } else {
						
                            echo '<td class="aligncentertable">' . $loan_status . '</td>';
                       // }
						echo'<td><input class="button" type="button" value ="Edit" onclick="editLoan('.$loanid.')" id="editBut"/></td>';
                        echo '</tr>';
                    }
                }
				
				}
				*/
				
                ?>  
            </table>
        </div> 
    </div>
    <div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Employee, Loan Type & Loan Amount</span> to see more details *</div>
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
                    window.location = '?loc=e_loan&str1=<?php echo $_GET["str1"]; ?>&str2=<?php echo $_GET["str2"]; ?>&str3=<?php echo $_GET["str3"]; ?>&from='+to+'&to='+from;   
                }else{
                    window.location = '?loc=e_loan&str1=<?php echo $_GET["str1"]; ?>&str2=<?php echo $_GET["str2"]; ?>&str3=<?php echo $_GET["str3"]; ?>&from='+from+'&to='+to;   
                }
            }
        },
		onClose: function( selectedDate ) {
    $( "#todate" ).datepicker( "option", "minDate", selectedDate );
	}
    });
	
	$(".fromdate1, .todate1").datepicker({
        dateFormat: 'dd-mm-yy',
        onSelect: function (){
            var from = $(".fromdate1").val();
            var to = $(".todate1").val();
           
        },
		onClose: function( selectedDate ) {
    $( ".todate1" ).datepicker( "option", "minDate", selectedDate );
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
            window.location="?loc=e_loan&str1="+str1+"&str2="+str2+"&str3="+str3+"&from="+from+"&to="+to;
        }else{
            window.location="?loc=e_loan&str1="+str1+"&str2="+str2+"&str3="+str3+"&e=edit";;
        }
    }
	
    function emp_app(id){ 
        var doc = $(document).height(); 
        var popup = parseInt($(".plugindiv").height())+parseInt($(".plugindiv").position().top+parseInt($("#popup").height()));
        var difference = doc-popup;
        var total;

        if(difference >= 0){
            total = 0;
        } else{
            total = difference;
        }

        $.ajax({
            type:'POST',
            url:'?widget=emp_app_info',
            data:{
                id:id,
                action:"admin_loan_emp"
            },
            success:function(data){
                $("#popup").html(data);
            }
        });
        $(document).mousemove(function(e){
            $('#popup').show();
            $('#popup').css({
                left: e.pageX + 20,
                top: e.pageY + total
            });
        });
    }

    function emp_app_hide(){
        $(document).mousemove(function(){
            $('#popup').hide();
        });
    }
   
   function editLoan(id){
   //alert(id);
     window.location='?loc=e_loan&id='+id+'&e=edit';
        
    }

    function saveValue_admin(id, emp_id){
	   // $(".modal").show();
        var e = document.getElementById("drop"+id);
        var status = e.options[e.selectedIndex].value;
	
 
        $.ajax({
            //type:"POST",
            dataType:'json',
            url:"?widget=instantUpdate_e_loan",
            data:{
                status:status,
				emp_id:emp_id,
                id:id
            },
            success:function(data){
		
				if(data.query == "true"){
                    //alert("E-Claim Status Updated");
                    $("#updateStatus1"+id).empty().append(data.status);
                }else{
                    alert("Error While Proccessing");
                }
            }
        })
    }
	function saveValue_admin1(id, emp_id){
	   var loan_id=id;
       var status=$("#drop").val();
	   var emp_id =emp_id; 
	   var fromdate1=$(".fromdate1").val();
	   var todate1=$(".todate1").val();
	    //$(".modal").show();
	    $.ajax({
            type:"POST",
			//dataType:'json',
            url:"?widget=instantUpdate_e_loan1",
            data:{
			    status:status, 
				fromdate1:fromdate1,
				todate1:todate1,
				emp_id:emp_id,
                id:loan_id
            },
            success:function(data){ 
                if(data!="true"){
                    alert("E-Loan application has been Updated");
                    window.location="?loc=e_loan&str1=Pending&str2=Approved&str3=Rejected";
                } else{
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
            url:"?widget=approve_loan",
            data:{
                eid:eid,
                id:id,
                status:status,
                aid:aid
            },
            success:function(data){
                if(data.query == "true"){
                    alert("E-Loan Status Updated");
                    $("#updateStatus"+id).empty().append(data.status);
                } else{
                    alert("Error While Proccessing");
                }
            }
        })
    }
	
	function ref(){
	location.reload(true)
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