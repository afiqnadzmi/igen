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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Reports</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="header_text">Reports</div>
    <div class="main_content">

        <div class="tablediv">
            <table>
                <tr>
                    <td colspan="4" class="view_button" style="display: none;">
                        <input type="button" id="butt" value="View" onclick="view_func()" class="button" style="width: 70px;"/>
                        <input type="button" value="Export" onclick="export_func()" class="button" style="width:70px"/>
                    </td>
                </tr>
				 <tr>
                    <td style="width: 200px;">Select / View</td>
                    <td>
                        <select id="view_by" onchange="check_view(this.value)" style="width: 250px;">
                            <option value="">--Please Select--</option>
							<?php
							 foreach($string as $val){
							
							 if(trim($val)!="ALL"){
							 if($val!=""){
							
							 ?>
							 <option value="<?php echo "\n".trim($val) ?>"><?php echo "\n".$val ?></option>
							 <?php
							 }
							 }else{
							 ?>
							  <option value="Advance Salary Report">Advance Salary Report</option>
                              <option value="Quickpay Payroll Report">Quickpay Payroll Report</option>
							  <option value="Allowance & Deduction">Allowance & Deduction</option>
							  <option value="Annual Income">Annual Income</option>
                             <option value="Attendance Report">Attendance Report</option>
							 <option value="Disciplinary Report">Disciplinary Report</option>
							 <option value="Employee Report">Employee Report</option>
							 <option value="Employee EPF Report">Employee EPF Report</option>
                            <option value="Employer Socso Report">Employer Socso Report</option>
							<option value="Employee transfer Report">Employer transfer Report</option>
							<option value="EPF Report">EPF Report</option>
                            <option value="EPF_Socso_Tax Report">EPF_Socso_Tax Report</option>
							 <option value="Gross Paid Report">Gross Paid Report</option>
							 <option value="Leave Report">Leave Report</option>
							 <option value="Claim Report">Claim Report</option>
							 <option value="Medical / Accident Record">Medical / Accident Record</option>
                            <option value="Net Paid Report">Net Paid Report</option>
                            <option value="PCB Report">PCB Report</option>
							<option value="Resignation Report">Resignation Report</option>
                            <option value="Salary Report">Salary Report</option>
                            <option value="Socso Report">Socso Report</option>
                            <option value="Training Report">Training Report</option>
							<option value="bankAllowance">MyBank Allowance File</option>
							<option value="banksalary">MyBank Salary File</option>
                            
                            
                            
                            
							 
							 <?php
							 
							 }
							 }
							?>
							
                           
                            
                        </select>
                    </td>
                </tr>
                
                <tr id="show_all" style="display: none">
                    <td>Show All</td>
                    <td><input type="checkbox" id="emp_showall" onchange="emp_show()" checked="true" /></td>
                </tr>
				<!--<tr>
                                <td >Filter by Emp Type<span class="red" style="display: none" > *</span></td>
                                <td >
                                    <select id="underContract" style="width:250px">
                                        <option value="0" >--Please Select--</option>
                                        <option value="permanent">Permanent</option>
										<option value="contract worker">Contract Worker</option>
                                        <option value="intern">Intern</option>
										
                                    </select> 
                                </td>
                            </tr>-->
                <tr id="date_picker" style="display: none;">
                    <td >Date Range</td>
                    <td><input type="text" id="from" style="width: 110px;"/>
                        -
                        <input type="text" id="to" style="width: 110px;"/></td>
                </tr>
                <tr id="month_picker" style="display: none">
                    <td>Month Range</td>
                    <td colspan="3">
                        <select id="month" style="width: 250px;">
                            <option value="">--Please Select--</option>
                            <?php
                            for ($i = 1; $i < 13; $i++) {
                                echo"<option value='" . $i . "'>" . date("M", mktime(0, 0, 0, $i, 1, date('Y'))) . "</option>";
                            }
                            ?>
                        </select>-<select id="year" style="width: 250px;">
                            <option value="">--Please Select--</option>
                            <?php
                            for ($j = (date('Y') - 10); $j <= date('Y'); $j++) {
                                echo"<option value='" . $j . "'>" . $j . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr id="year_picker" style="display: none">
                    <td>Year Range</td>
                    <td>
                        <select id="year1" style="width: 250px;">
                            <option value="">--Please Select--</option>
                            <?php
                            for ($k = (date('Y') - 10); $k <= date('Y'); $k++) {
                                echo"<option value='" . $k . "'>" . $k . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Company</td>
                    <td>
                        <select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)">
                            <option value="" selected="true">--Please Select--</option>
                            <option value="0">All Companies</option>
                            <?php
                            if ($igen_companylist != "") {
                                $queryCompany = mysql_query('SELECT * FROM company WHERE id IN (' . $igen_companylist . ') ORDER BY code');
                            } else {
                                $queryCompany = mysql_query('SELECT * FROM company ORDER BY code');
                            }
                            while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                //if ($igen_companylist != "") {
                                   // echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                               // } else {
                                   // if ($rowCompany["is_default"] == "1") {
                                        //echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"]// . '</option>';
                                   // } else {
                                        echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                    //}
                                //}
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr id="tr_branch">
                    <td>Branch</td>
                    <td>
                        <select id="dropBranch" style="width: 250px;" onchange="showDep(this.value)">
                            <option value="">--Please Select--</option>
                            <?php
                            if ($igen_branchlist != "") {
                                $queryBranch = mysql_query('SELECT * FROM branch WHERE id IN (' . $igen_branchlist . ') ORDER BY branch_code');
                            } else {
                                $queryCompany = mysql_query('SELECT * FROM company WHERE is_default=1 LIMIT 1');
                                $rowCompany = mysql_fetch_array($queryCompany);
                                $queryBranch = mysql_query('SELECT * FROM branch WHERE company_id="' . $rowCompany["id"] . '" ORDER BY branch_code');
                            }
                            while ($rowBranch = mysql_fetch_array($queryBranch)) {
                                echo '<option value="' . $rowBranch["id"] . '">' . $rowBranch["branch_code"] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr id="tr_department">
                    <td>Department</td>
                    <td>
                        <select id="department" style="width: 250px;">
                            <option value="">--Please Select--</option>
                        </select>
                    </td>
                </tr>
                <tr id="tr_country" style="display: none">
                    <td style="width: 150px;">Employee Type</td>
                    <td>
                        <select id="emp_country" style="width: 250px;">
                            <option value="">--Please Select--</option>
                            <option value="Malaysia">Local</option>
                            <option value="Foreign">Foreign</option>
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px;">Employee Status</td>
                    <td>
                        <select id="emp_status" style="width: 250px;">
                            <option value="">--Please Select--</option>
                            <option value="Active" selected="true">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select> 
                    </td>
                </tr>
                <tr id="tr_employee">
                    <td id="e_n" style="vertical-align: top;">Employee</td>
                    <td>
                        <span id="employee_ids" style="display: none;"></span>
                        <select multiple class="input_text" name="employee_list_view" id="employee_list_view" style="width: 250px; height: 150px;" ></select>
                      <input class="button" type="button" value="Search"  onclick="add_emp_list()" style="width: 70px;"/>
					</td>
                </tr>
            </table>
        </div>
    </div>
</p></div></div></div>

<span id="branchSpan" style="display: none;"><?php echo $igen_branchlist; ?></span>

<script type="text/javascript">

    function showBranch(company_id){
        var branch = $("#branchSpan").html();
        var dropCompany = $("#dropCompany").val();
        if( dropCompany == "0"){
            $('#tr_branch').hide();
            $('#tr_department').hide();
        }else{
            $('#tr_branch').show();
            $('#tr_department').show();
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
       var report = $("#view_by").val();
	   underContract=0;
        $("#employee_list_view").empty();
        $("#employee_ids").html("");
        var company = $("#dropCompany").val();
        var department = $("#department").val();
        var list = $("#employee_ids").html();
        var status = $("#emp_status").val();
        //var country = $("#tr_country").val();
        var emp_type = $("#emp_country").val();
        var branch = $("#dropBranch").val();
        if(company == "0"){
            department = "ALL";
            branch = "ALL";
            if(emp_type == "Malaysia"){
                emp_type = "Malaysian";
                var url= "?widget=emp_list&d="+department+"&b="+branch+"&type="+underContract+"&list="+list+"&s="+status+"&e="+emp_type;
            }else{
                emp_type = "Foreign"
                var url= "?widget=emp_list&d="+department+"&b="+branch+"&type="+underContract+"&list="+list+"&s="+status;
            }
            window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
        }else if(department != ""){
            if(department == "0"){
                department = "ALL";
            }
            if(report == "Quickpay Payroll Report"){
                 var url= "?widget=emp_list&d="+department+"&b="+branch+"&type="+underContract+"&list="+list+"&s="+status+"&inc=qp";
            }else{
                var url= "?widget=emp_list&d="+department+"&b="+branch+"&type="+underContract+"&list="+list+"&s="+status;
            }
            window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
        }else{
            alert("Pick Company");
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
            $('#tr_country').hide();
        }else if(view == "Allowance & Deduction" || view == "bankAllowance" || view == "banksalary"|| view == "Employee EPF Report"||view == "Employer Socso Report"||view == "Socso Report"|| view == "EPF_Socso_Tax Report" || view == "Gross Paid Report" || view == "Net Paid Report" || view == "PCB Report" || view == "EPF Report" || view == "Salary Report"){
            $('#show_all').hide();
            $('#date_picker').hide();
            $('#year_picker').hide();
            $('#month_picker').show();
            $('.view_button').show();
            $('#tr_country').hide();
			
			
        }else if(view == "Annual Income"){
            $('#show_all').hide();
            $('#date_picker').hide();
            $('#year_picker').show();
            $('#month_picker').hide();
            $('.view_button').show();
            $('#tr_country').hide();
        }else if(view == ""){
            $('#show_all').hide();
            $('#date_picker').hide();
            $('#month_picker').hide();
            $('#year_picker').hide();
            $('.view_button').hide();
            $('#tr_country').hide();
        }else if(view=="Employee Report"){
            $('#show_all').show();
            $('#date_picker').hide();
            $('#month_picker').hide();
            $('#year_picker').hide();
            $('.view_button').show();
            $('#tr_country').show();
        }else if(view=="Leave Report"){
            //$('#show_all').show();
            $('#date_picker').hide();
            $('#month_picker').hide();
            $('#year_picker').hide();
            $('.view_button').show();
            $('#tr_country').hide();
        }else{
            $('#show_all').hide();
            $('#date_picker').show();
            $('#month_picker').hide();
            $('#year_picker').hide();
            $('.view_button').show();
            $('#tr_country').hide();
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
        }else if(view == "Quickpay Payroll Report"){
            if(from != "" && to != ""){
                window.open("?widget=report_qck_payroll&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
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
        }else if(view == "Quickpay Payroll Report"){
            if(from != "" && to != ""){
                window.open("reporting/excel_writer.php?t=report_qck_payroll&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
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