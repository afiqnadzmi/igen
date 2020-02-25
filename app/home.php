<?php
/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn. Bhd. */
?>

<script type="text/javascript" charset="utf-8">
    $(function() {
        oTable = $('#normal_abnormal').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
   
</script>
<?php

$query1 = mysql_query('SELECT e.id FROM employee AS e INNER JOIN employee_edit AS ee ON e.id = ee.emp_id;');
while ($rowQuery = mysql_fetch_array($query1)) {


    $getID = $rowQuery['id'];

    $query = mysql_query('SELECT * FROM employee WHERE id=' . $getID);
    $rowGetOld = mysql_fetch_array($query);

    $sqlGetNew = mysql_query('SELECT * FROM employee_edit WHERE emp_id =' . $getID);
    $rowGetNew = mysql_fetch_array($sqlGetNew);

    if ($rowGetNew['profile'] == $rowGetOld['profile'] && $rowGetNew['ic'] == $rowGetOld['ic'] && $rowGetNew['phone'] == $rowGetOld['phone']
            && $rowGetNew['mobile'] == $rowGetOld['mobile'] && $rowGetNew['email'] == $rowGetOld['email'] && $rowGetNew['address'] == $rowGetOld['address']
            && $rowGetNew['gender'] == $rowGetOld['gender'] && $rowGetNew['race'] == $rowGetOld['race'] && $rowGetNew['religion'] == $rowGetOld['religion']
            && $rowGetNew['marital'] == $rowGetOld['marital'] && $rowGetNew['spouse_work'] == $rowGetOld['spouse_work'] && $rowGetNew['dob'] == $rowGetOld['dob']
            && $rowGetNew['num_of_kids'] == $rowGetOld['num_of_kids'] && $rowGetNew['join_date'] == $rowGetOld['join_date'] && $rowGetNew['resign_date'] == $rowGetOld['resign_date']
            && $rowGetNew['profile'] == $rowGetOld['profile'] && $rowGetNew['zakat'] == $rowGetOld['zakat'] && $rowGetNew['epf_num'] == $rowGetOld['epf_num']
            && $rowGetNew['socso_num'] == $rowGetOld['socso_num'] && $rowGetNew['income_tax_num'] == $rowGetOld['income_tax_num'] && $rowGetNew['bank_acc_id'] == $rowGetOld['bank_acc_id']
            && $rowGetNew['bank_acc_num'] == $rowGetOld['bank_acc_num'] && $rowGetNew['full_name'] == $rowGetOld['full_name']) {
        $status = 'Same';
        $deleteSql = mysql_query('DELETE FROM employee_edit WHERE emp_id=' . $getID);
    } else {
        $status = 'NotSame';
    }
}
	
$sqlGetdep1 = mysql_query('SELECT dep_id FROM employee WHERE id ="'.$user_id.'"');
$rowGetdep1 = mysql_fetch_array($sqlGetdep1);
$numRow1 = mysql_num_rows($sqlGetdep1);
$get_dep1=$rowGetdep1['dep_id'];

$get_dep="";
$sqlGetdep = mysql_query('SELECT dep_id FROM approval WHERE superior_1="'.$user_id.'"  OR superior_2="'.$user_id.'" OR superior_3="'.$user_id.'"');
$numRow= mysql_num_rows($sqlGetdep);
while($rowGetdep = mysql_fetch_array($sqlGetdep)){
$get_dep.=$rowGetdep['dep_id'].",";
}
$get_dep.=50000;

//Check if the current logged in user has the permission to take disciplinary action on the employees under him
$query_emSup = mysql_query('SELECT e.level_id, e.id as eid, u.disc FROM employee e, user_permission u WHERE e.level_id=u.id AND u.a_hr!="a_hr_hide" AND u.disc="disc_show" AND e.id !="'.$user_id.'"');
$rowGetPermission = mysql_fetch_array($query_emSup);

?>
<div class="main_div" style="margin-left:0px">
   <div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Employee List</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 

    <div class="header_text">
        <span>Employee List</span>
        <span style="float: right;">
            <?php if ($igen_a_hr == "a_hr_edit") { ?>
                <table>
                    <tr>
                        <td><input id="editBut" type="button" onclick="addData()" value="Add New" style="width:100px" /></td>
                        <td><input id="editBut" type="button" onclick="importData()" value="Import Data" style="width:100px" /></td>
                    </tr>
                </table>
            <?php } ?>
        </span>
    </div>
    <div class="main_content" style="margin-top: 10px;">
        <div class="plugindiv">
            <table id="normal_abnormal" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width:100px;">ID</th>
                        <th>Name</th>
                        <th class="aligncentertable" style="width:60px;">Gender</th>
						<th style="width:60px;">Nationality</th>
						<th class="aligncentertable" style="width:60px;">Race</th>
                        <th class="aligncentertable" style="width:110px;">Under contract</th>
                        <th style="width:300px;">Department (Section/Unit)</th>
						 <?php
						 // Add one more column of employee status for HR Admin
						 if ($igen_a_hr == "a_hr_edit"){echo'<th style="width:300px;">Employee status</th>';}
						 ?>
                        <th class="aligncentertable" style="width:100px;">Attendance</th>
						<?php
						 // Add one more column of employee status for HR Admin
						 if ($rowGetPermission['disc']=="disc_show"){echo'<th style="width:100px;">Disciplinary</th>';}
						
						?>
                    </tr>
                </thead>

                <?php
                /* Check user_permission_view if restricted access permission */
				if ($igen_a_hr == "a_hr_edit") {
				// Query list of all staff for HR Admin 
				
                if ($igen_branchlist != "") {
                    $queryList = mysql_query('SELECT * FROM employee WHERE branch_id IN (' . $igen_branchlist . ')');
                } else {
                    if ($igen_companylist != "") {
                        $queryList = mysql_query('SELECT * FROM employee WHERE company_id IN (' . $igen_companylist . ')');
                    } else {
                       $queryList = mysql_query('SELECT * FROM employee');
                    }
                }

                while ($rowList = mysql_fetch_array($queryList)) {
                    $id = $rowList['id'];
                    $name = $rowList['full_name'];
                    $gender = $rowList['gender'];
                    $contract = $rowList['is_contract'];
                    $group_id = $rowList['group_id'];
					$emp_status = $rowList['emp_status'];
					$race = $rowList['race'];
					$country = $rowList['country'];
                    $g_sql = "SELECT * FROM emp_group eg
                            left join department d
                            on eg.dep_id=d.id where eg.id='" . $group_id . "'";
                    $g_rs = mysql_query($g_sql);
                    $g_row = mysql_fetch_array($g_rs);
					$disc_id=base64_encode($id);
                    echo '<tr class="plugintr">';


                    $sqlGetModify = mysql_query('SELECT * FROM employee_edit WHERE emp_id =' . $id);
                    $rowModify = mysql_fetch_array($sqlGetModify);
                    if ($rowModify['emp_id'] == $id) {
                        $edited = 'Y';
                    } else {
                        $edited = 'N';
                    }

                    echo '<td><a href="?loc=view_profile_new&viewId=' . $id . '">EMP' . str_pad($id, 6, "0", STR_PAD_LEFT) . '</a></td>';
                    echo '<td>' . $name . '</td>
                          <td class="aligncentertable">' . $gender . '</td>
						  <td>' . $country . '</td>
						  <td class="aligncentertable">' . $race . '</td>
                          <td class="aligncentertable">' . $contract . '</td>
                          <td>' . ucwords($g_row["dep_name"]) . ' (' . ucwords($g_row["group_name"]) . ')</td>
						  <td class="aligncentertable">' . $emp_status . '</td>
						<td class="aligncentertable"><a title="View" href="?loc=view_attendance&viewattend=' . $id .'"><i class="far fa-eye"></i><a></td>';
						if ($rowGetPermission['disc']=="disc_show"){ echo'<td class="aligncentertable"><a title="Select" href="?loc=disciplinary_record&recorddisc=' .$disc_id. '"><i style="color:#000" class="fas fa-address-book"></i><a></td>';}
						
						echo'</tr>';
                }
				}else{
					
				 // Query list of the staff under the department of the current logged in manager
				if ($igen_branchlist != "") {
				   
				   if($get_dep!="" && $get_dep!=50000){
					
                    $queryList = mysql_query('SELECT * FROM employee WHERE branch_id IN (' . $igen_branchlist . ') AND dep_id IN (' . $get_dep . ') AND emp_status="Active"');
					}else{
						
					$queryList = mysql_query('SELECT * FROM employee WHERE branch_id IN (' . $igen_branchlist . ') AND dep_id="'.$get_dep1.'" AND emp_status="Active"');
					}
                } else {
				
                    if ($igen_companylist != "") {
						
					if($get_dep!="" && $get_dep!=50000){
                        $queryList = mysql_query('SELECT * FROM employee WHERE company_id IN (' . $igen_companylist . ') AND dep_id IN(' . $get_dep . ')AND emp_status="Active"');
						}else{
					$queryList = mysql_query('SELECT * FROM employee WHERE company_id IN  (' . $igen_branchlist . ') AND dep_id="'.$get_dep1.'" AND emp_status="Active"');
					}
                    } else {
						
					
					if($get_dep!="" && $get_dep!=50000){				
                        $queryList = mysql_query('SELECT DISTINCT * FROM employee WHERE dep_id IN(' . $get_dep . ') OR dep_id="'.$get_dep1.'" AND emp_status="Active"');
						}else{
						
					$queryList = mysql_query('SELECT * FROM employee WHERE  dep_id="'.$get_dep1.'" AND emp_status="Active"');
					}
                    }
                }

                while ($rowList = mysql_fetch_array($queryList)) {
                    $id = $rowList['id'];
                    $name = $rowList['full_name'];
                    $gender = $rowList['gender'];
                    $contract = $rowList['is_contract'];
                    $group_id = $rowList['group_id'];
					$disc_id=base64_encode($id);
                    $g_sql = "SELECT * FROM emp_group eg
                            left join department d
                            on eg.dep_id=d.id where eg.id='" . $group_id . "'";
                    $g_rs = mysql_query($g_sql);
                    $g_row = mysql_fetch_array($g_rs);

                    echo '<tr class="plugintr">';


                    $sqlGetModify = mysql_query('SELECT * FROM employee_edit WHERE emp_id =' . $id);
                    $rowModify = mysql_fetch_array($sqlGetModify);
                    if ($rowModify['emp_id'] == $id) {
                        $edited = 'Y';
                    } else {
                        $edited = 'N';
                    }

                    echo '<td><a href="?loc=view_profile_new&viewId=' . $id . '">EMP' . str_pad($id, 6, "0", STR_PAD_LEFT) . '</a></td>';
                    echo '<td>' . $name . '</td>
                          <td class="aligncentertable">' . $gender . '</td>
						  <td>' . $country . '</td>
						  <td class="aligncentertable">' . $race . '</td>
                          <td class="aligncentertable">' . $contract . '</td>
                          <td>' . ucwords($g_row["dep_name"]) . ' (' . ucwords($g_row["group_name"]) . ')</td>
                          <td class="aligncentertable"><a title="View" href="?loc=view_attendance&viewattend=' . $id . '"><i class="far fa-eye"></i><a></td>';
						  if ($rowGetPermission['disc']=="disc_show"){ echo'<td class="aligncentertable"><a title="Seelct" href="?loc=disciplinary_record&recorddisc=' .$disc_id. '"><i style="color:#000" class="fas fa-address-book"></i><a></td>';}
						  echo'</tr>';
                }
				
         }                ?>
            </table>
        </div>
    </div>
</div></div></div>
<script type="text/javascript">
    function addData(){
        window.location='?loc=new_profile';
    }
    
    function importData(){
        window.location='?loc=import_excel';
    }
    
    function findData(){
        var search = $('#searchInput').val()
        window.location='?loc=home&search='+search;
    }

    function clearData(){
        document.getElementById('searchInput').value="";
        window.location='?loc=home'
    }
</script>

<?php
/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn. Bhd. */
?>