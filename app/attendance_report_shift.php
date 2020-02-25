<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>
<?php
$string="";
  if (isset($_COOKIE["igen_id"]) == true) {
        $sqlLevel = 'SELECT * FROM user_permission WHERE id=1';
    } elseif (isset($_COOKIE["igen_user_id"]) == true) {
$sqlLevel = 'SELECT up.* FROM user_permission AS up INNER JOIN employee AS e ON e.level_id = up.id WHERE e.id=' . $_COOKIE['igen_user_id'];
}

$queryLevel = mysql_query($sqlLevel);
 while($rowLevel = mysql_fetch_array($queryLevel)){
 $str=$rowLevel['report'];
// echo $str;
  $string = explode(",", $str);


 }
 sort($string);
implode('', $string); 
 

?>



<div class="main_div">
   	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Attendance Report</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="header_text">Shift</div>
    <div class="main_content" style="margin-top: 10px;">
        <div class="plugindiv">
            <table id="normal_abnormal" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th class="aligncentertable">User ID</th>
                        <th class="aligncentertable">User Name</th>
                        <th class="aligncentertable">Date In</th>
                        <th class="aligncentertable">Time In</th>
                        <th class="aligncentertable">Date Out</th>
                        <th class="aligncentertable">Time Out</th>
                        <th class="aligncentertable">Total Working Hours</th>
                        <th class="aligncentertable">Total Overtime</th>
                        <th class="aligncentertable">Total Shortage</th>
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
</p></div></div></div>

<span id="branchSpan" style="display: none;"><?php echo $igen_branchlist; ?></span>

<script type="text/javascript">

    function showBranch(company_id){
        var branch = $("#branchSpan").html();
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
                $("#employee_list_view").val("");
                $("#employee_ids").html("");
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
                $("#employee_list_view").val("");
                $("#employee_ids").html("");
            }
        });
    }

    function add_emp_list(){
	   var underContract=$("#underContract").val();
	   underContract=0;
        $("#employee_list_view").empty();
        $("#employee_ids").html("");
        var department = $("#department").val();
        var list = $("#employee_ids").html();
        var status = $("#emp_status").val();
        
        var branch = $("#dropBranch").val();
        if(department != ""){
            if(department == "0"){
                department = "ALL";
            }
            var url= "?widget=emp_list&d="+department+"&b="+branch+"&type="+underContract+"&list="+list+"&s="+status;
            window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
        }
    }

    $(function() {
        $("#from").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });
    $(function() {
        $("#to").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });
    
    function emp_show(){
        var emp_show = $('#emp_showall').is(':checked');
        if(emp_show == false){
            $('#date_picker').show();
        }else{
            $('#date_picker').hide();
        }
    }
    function check_view(view){
	   view=view.trim(); 
	   if(view == "bankAllowance"  || view == "banksalary"){
			$('#butt').hide();
			
			}else{
			$('#butt').show();
			}
        if(view == "Resignation Report"){ 
            $('#show_all').hide();
            $('#date_picker').hide();
            $('#month_picker').hide();
            $('#year_picker').hide();
            $('.view_button').show();
        }else if(view == "Allowance & Deduction" || view == "bankAllowance" || view == "banksalary"|| view == "Employee EPF Report"||view == "Employer Socso Report"||view == "Socso Report"|| view == "EPF_Socso_Tax Report" || view == "Gross Paid Report" || view == "Net Paid Report" || view == "PCB Report" || view == "EPF Report" || view == "Salary Report"){
            $('#show_all').hide();
            $('#date_picker').hide();
            $('#year_picker').hide();
            $('#month_picker').show();
            $('.view_button').show();
			
			
        }else if(view == "Annual Income"){
            $('#show_all').hide();
            $('#date_picker').hide();
            $('#year_picker').show();
            $('#month_picker').hide();
            $('.view_button').show();
        }else if(view == ""){
            $('#show_all').hide();
            $('#date_picker').hide();
            $('#month_picker').hide();
            $('#year_picker').hide();
            $('.view_button').hide();
        }else if(view=="Employee Report"){
            $('#show_all').show();
            $('#date_picker').hide();
            $('#month_picker').hide();
            $('#year_picker').hide();
            $('.view_button').show();
        }else if(view=="Leave Report"){
            //$('#show_all').show();
            $('#date_picker').hide();
            $('#month_picker').hide();
            $('#year_picker').hide();
            $('.view_button').show();
        }else{
            $('#show_all').hide();
            $('#date_picker').show();
            $('#month_picker').hide();
            $('#year_picker').hide();
            $('.view_button').show();
        }
    }
    
    function view_func(){
        var view = $("#view_by").val();
        var from = $("#from").val();
        var to = $("#to").val();
        var month = $("#month").val();
        var year = $("#year").val();
        var year1 = $("#year1").val();
        var department = $("#department").val();
        var employee=$("#employee_ids").html();
        var branch = $("#dropBranch").val();
        var status = $("#emp_status").val();
		
        if(view == "Leave Report"){
            //if(from != "" && to != ""){
                window.open("?widget=report_leave&from="+from+"&to="+to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            //}else{
               // alert("Pick Duration");
            //}
        }else if(view == "Claim Report"){
            if(from != "" && to != ""){
                window.open("?widget=report_claim&from="+from+"&to="+to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }
		else if(view == "Employee Report"){
            var emp_show = $('#emp_showall').is(':checked');
            if(emp_show == false){
                if(from != "" && to != ""){
                    window.open("?widget=report_emp&from="+from+"&to="+to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
                }else{
                    alert("Pick Duration");
                }
            }else{
                window.open("?widget=report_emp&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }
        }else if(view == "Allowance & Deduction"){
            if(month != "" && year != ""){
                window.open("?widget=report_all_deduct&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Advance Salary Report"){
            if(from != "" && to != ""){
                window.open("?widget=report_adv_salary&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Employee transfer Report"){
            if(from != "" && to != ""){
                window.open("?widget=employee_trans_rep&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Attendance Report"){
            if(from != "" && to != ""){
                window.open("?widget=report_attendance&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "EPF Report"){
            if(month != "" && year != ""){
                window.open("?widget=report_epf&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Employee EPF Report"){
            if(month != "" && year != ""){
                window.open("?widget=report_employer_epf&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Employer Socso Report"){
            if(month != "" && year != ""){
                window.open("?widget=report_employer_socso&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "EPF_Socso_Tax Report"){
            window.open("?widget=report_est&month="+month+"&year="+year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
        }else if(view == "Gross Paid Report"){
            if(month != "" && year != ""){
                window.open("?widget=report_gross&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Net Paid Report"){
            if(month != "" && year != ""){
                window.open("?widget=report_net&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "PCB Report"){
            if(month != "" && year != ""){
                window.open("?widget=report_pcb&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Salary Report"){
            if(month != "" && year != ""){
                window.open("?widget=report_salary&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Socso Report"){
            window.open("?widget=report_socso&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
        }else if(view == "Annual Income"){
            if(year1 != ""){
                window.open("?widget=report_annual&year=" + year1+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Training Report"){
            if(from != "" && to != ""){
                window.open("?widget=report_training&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Disciplinary Report"){
            if(from != "" && to != ""){
                window.open("?widget=report_disciplinary&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Medical / Accident Record"){
            if(from != "" && to != ""){
                window.open("?widget=report_medic_acciden&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Resignation Report"){
            window.open("?widget=report_resignation&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
        }else{
            alert("Please Select Report");
        }
    }
	
    function export_func(){
        var view = $("#view_by").val();
        var from = $("#from").val();
        var to = $("#to").val();
        var month = $("#month").val();
        var year = $("#year").val();
        var year1 = $("#year1").val();
        var department = $("#department").val();
        var employee=$("#employee_ids").html();
        var branch = $("#dropBranch").val();
        var status = $("#emp_status").val();
		
        if(view == "Leave Report"){
            if(from != "" && to != ""){
                window.open("reporting/excel_writer.php?t=report_leave&from="+from+"&to="+to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Employee Report"){
		
            var emp_show = $('#emp_showall').is(':checked');
            if(emp_show == false){
                if(from != "" && to != ""){
                    window.open("reporting/excel_writer.php?t=report_emp&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
                }else{
                    alert("Pick Duration");
                }
            }else{
                window.open("reporting/excel_writer.php?t=report_emp&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }
        }else if(view == "Allowance & Deduction"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=report_all_deduct&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "bankAllowance"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=bank_allowance&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "banksalary"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=bank_salary&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Advance Salary Report"){
            if(from != "" && to != ""){
                window.open("reporting/excel_writer.php?t=report_adv_salary&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Attendance Report"){
            if(from != "" && to != ""){
                window.open("reporting/excel_writer.php?t=report_attendance&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "EPF Report"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=report_epf&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "EPF_Socso_Tax Report"){
            window.open("reporting/excel_writer.php?t=report_est&month="+month+"&year="+year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
        }else if(view == "Gross Paid Report"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=report_gross&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Net Paid Report"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=report_net&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "PCB Report"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=report_pcb&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Salary Report"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=report_salary&month=" + month+"&year="+year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Socso Report"){
            window.open("reporting/excel_writer.php?t=report_socso&month="+month+"&year="+year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
        }else if(view == "Annual Income"){
            if(year1 != ""){
                window.open("reporting/excel_writer.php?t=report_annual&year="+year1+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Training Report"){
            if(from != "" && to != ""){
                window.open("reporting/excel_writer.php?t=report_training&from="+from+"&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Disciplinary Report"){
            if(from != "" && to != ""){
                window.open("reporting/excel_writer.php?t=report_disciplinary&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Medical / Accident Record"){
            if(from != "" && to != ""){
                window.open("reporting/excel_writer.php?t=report_medic_acciden&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Resignation Report"){
            window.open("reporting/excel_writer.php?t=report_resignation&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
        }else if(view == "Employee EPF Report"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=report_employer_epf&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "Employer Socso Report"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=report_employer_socso&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else{
            alert("Please Select Report!");
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