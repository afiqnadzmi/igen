<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<div class="main_div">
    <br/>
    <div class="header_text">Reports</div>
    <div class="main_content">

        <div class="tablediv">
            <table>
                <tr>
                    <td colspan="4" class="view_button" style="display: none;">
                        <input type="button" value="View" onclick="view_func()" class="button" style="width: 70px;"/>
                        <input type="button" value="Export" onclick="export_func()" class="button" style="width:70px"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 200px;">Select / View</td>
                    <td>
                        <select id="view_by" onchange="check_view(this.value)" style="width: 250px;">
                            <option value="">--Please Select--</option>
                            <option value="leave">Leave Report</option>
                            <option value="emp">Employee Report</option>
                            <option value="a&d">Allowance & Deduction</option>
                            <option value="advance">Advance Salary Report</option>
                            <option value="attend">Attendance Report</option>
                            <option value="epf">EPF Report</option>
                            <option value="est">EPF_Socso_Tax Report</option>
                            <option value="gross">Gross Paid Report</option>
                            <option value="net">Net Paid Report</option>
                            <option value="pcb">PCB Report</option>
                            <option value="salary">Salary Report</option>
                            <option value="socso">Socso Report</option>
                            <option value="annual">Annual Income</option>
                            <option value="training">Training Report</option>
                            <option value="discplin">Disciplinary Report</option>
                            <option value="ma">Medical / Accident Record</option>
                            <option value="resign">Resignation Report</option>
                            <option value="employer_epf">Employee EPF Report</option>
                            <option value="employer_socso">Employer Socso Report</option>
                        </select>
                    </td>
                </tr>
                <tr id="show_all" style="display: none">
                    <td>Show All</td>
                    <td><input type="checkbox" id="emp_showall" onchange="emp_show()" checked="true" /></td>
                </tr>
				<tr>
                                <td >Filter by Emp Type<span class="red" style="display: none" > *</span></td>
                                <td >
                                    <select id="underContract" style="width:250px">
                                        <option value="0" >--Please Select--</option>
                                        <option value="permanent">Permanent</option>
										<option value="contract worker">Contract Worker</option>
                                        <option value="intern">Intern</option>
										
                                    </select> 
                                </td>
                            </tr>
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
                            <option value="">--Please Select--</option>
                            <?php
                            if ($igen_companylist != "") {
                                $queryCompany = mysql_query('SELECT * FROM company WHERE id IN (' . $igen_companylist . ') ORDER BY code');
                            } else {
                                $queryCompany = mysql_query('SELECT * FROM company ORDER BY code');
                            }
                            while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                if ($igen_companylist != "") {
                                    echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
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
</div>

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
        if(view == "resign"){
            $('#show_all').hide();
            $('#date_picker').hide();
            $('#month_picker').hide();
            $('#year_picker').hide();
            $('.view_button').show();
        }else if(view == "a&d" || view == "employer_epf"||view == "employer_socso"||view == "socso"|| view == "est" || view == "gross" || view == "net" || view == "pcb" || view == "epf" || view == "salary"){
            $('#show_all').hide();
            $('#date_picker').hide();
            $('#year_picker').hide();
            $('#month_picker').show();
            $('.view_button').show();
        }else if(view == "annual"){
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
        }else if(view == "emp"){
            $('#show_all').show();
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
		
        if(view == "leave"){
            if(from != "" && to != ""){
                window.open("?widget=report_leave&from="+from+"&to="+to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "emp"){
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
        }else if(view == "a&d"){
            if(month != "" && year != ""){
                window.open("?widget=report_all_deduct&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "advance"){
            if(from != "" && to != ""){
                window.open("?widget=report_adv_salary&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "attend"){
            if(from != "" && to != ""){
                window.open("?widget=report_attendance&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "epf"){
            if(month != "" && year != ""){
                window.open("?widget=report_epf&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "employer_epf"){
            if(month != "" && year != ""){
                window.open("?widget=report_employer_epf&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "employer_socso"){
            if(month != "" && year != ""){
                window.open("?widget=report_employer_socso&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "est"){
            window.open("?widget=report_est&month="+month+"&year="+year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
        }else if(view == "gross"){
            if(month != "" && year != ""){
                window.open("?widget=report_gross&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "net"){
            if(month != "" && year != ""){
                window.open("?widget=report_net&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "pcb"){
            if(month != "" && year != ""){
                window.open("?widget=report_pcb&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "salary"){
            if(month != "" && year != ""){
                window.open("?widget=report_salary&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "socso"){
            window.open("?widget=report_socso&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
        }else if(view == "annual"){
            if(year1 != ""){
                window.open("?widget=report_annual&year=" + year1+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "training"){
            if(from != "" && to != ""){
                window.open("?widget=report_training&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "discplin"){
            if(from != "" && to != ""){
                window.open("?widget=report_disciplinary&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "ma"){
            if(from != "" && to != ""){
                window.open("?widget=report_medic_acciden&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "resign"){
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
		
        if(view == "leave"){
            if(from != "" && to != ""){
                window.open("reporting/excel_writer.php?t=report_leave&from="+from+"&to="+to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "emp"){
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
        }else if(view == "a&d"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=report_all_deduct&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "advance"){
            if(from != "" && to != ""){
                window.open("reporting/excel_writer.php?t=report_adv_salary&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "attend"){
            if(from != "" && to != ""){
                window.open("reporting/excel_writer.php?t=report_attendance&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "epf"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=report_epf&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "est"){
            window.open("reporting/excel_writer.php?t=report_est&month="+month+"&year="+year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
        }else if(view == "gross"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=report_gross&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "net"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=report_net&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "pcb"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=report_pcb&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "salary"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=report_salary&month=" + month+"&year="+year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "socso"){
            window.open("reporting/excel_writer.php?t=report_socso&month="+month+"&year="+year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
        }else if(view == "annual"){
            if(year1 != ""){
                window.open("reporting/excel_writer.php?t=report_annual&year="+year1+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "training"){
            if(from != "" && to != ""){
                window.open("reporting/excel_writer.php?t=report_training&from="+from+"&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "discplin"){
            if(from != "" && to != ""){
                window.open("reporting/excel_writer.php?t=report_disciplinary&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "ma"){
            if(from != "" && to != ""){
                window.open("reporting/excel_writer.php?t=report_medic_acciden&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "resign"){
            window.open("reporting/excel_writer.php?t=report_resignation&from=" + from + "&to=" + to+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
        }else if(view == "employer_epf"){
            if(month != "" && year != ""){
                window.open("reporting/excel_writer.php?t=report_employer_epf&month=" + month + "&year=" + year+"&branch_id="+branch+"&dep_id="+department+"&status="+status+"&emp_id="+employee);
            }else{
                alert("Pick Duration");
            }
        }else if(view == "employer_socso"){
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