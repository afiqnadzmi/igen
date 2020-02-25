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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Government Forms</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
    <div class="header_text">Government Forms</div>
    <div class="main_content">
        <div class="tablediv">
            <table>
                <tr>
                    <td colspan="4" id="show_view" class="view_button" style="display: none;">
                        <input type="button" value="View" onclick="view_func()" class="button" style="width: 70px;"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 200px;">Select / View</td>
                    <td>
                        <select id="view_by" style="width: 250px;" onchange="check_view(this.value)">
                            <option value="">--Please Select--</option>
                            <optgroup label="View">
                                <option value="borang_tp1">Borang TP 1</option>
                                <option value="borang_tp2">Borang TP 2</option>
                                <option value="borang_tp3">Borang TP 3</option>
                                <option value="borang_ea">Borang EA</option>
                            </optgroup>
                            <optgroup label="Download">
                                <option value="borang_a">Borang A</option>
                                <option value="borang_8a">Borang 8A</option>
                                <option value="borang_cp39">Borang CP39</option>
                            </optgroup>
                        </select>
                    </td>
                </tr>
                <tr id="month_picker" style="display: none">
                    <td>Month Range</td>
                    <td colspan="3">
                        <select id="dropMonth" style="width: 250px;">
                            <option value="">--Please Select--</option>
                            <?php
                            for ($i = 1; $i < 13; $i++) {
                                echo"<option value='" . $i . "'>" . date("M", mktime(0, 0, 0, $i, 1, date('Y'))) . "</option>";
                            }
                            ?>
                        </select>-<select id="dropYear" style="width: 250px;">
                            <option value="">--Please Select--</option>
                            <?php
                            for ($j = (date('Y') - 10); $j <= date('Y'); $j++) {
                                echo"<option value='" . $j . "'>" . $j . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
				<!--
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
                            </tr>  -->
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
                            <option value="Active" selected="selected">Active</option>
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
	   underContract=0;
        $("#employee_list_view").empty();
        $("#employee_ids").html("");
        var department = $("#department").val();
        var branch = $("#dropBranch").val();
        var status = $("#emp_status").val();
        
        if(department != ""){
            if(department == "0"){
                department = "ALL";
            }
            var url= "?widget=emp_list&d="+department+"&b="+branch+"&type="+underContract+"&s="+status;
            window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
        }
    }

    function check_view(view){
        if(view == "borang_a" ||  view == "borang_8a" || view == "borang_cp39" ){
            $("#show_view").show();
            $('#month_picker').show();
        }else if(view == "borang_tp1" ||  view == "borang_tp2" || view == "borang_tp3" || view == "borang_ea"){
            $("#show_view").show();
            $('#month_picker').hide();
        }else{
            $("#show_view").hide();
            $('#month_picker').hide();
        }
    }
    
    function view_func(){
        var view = $("#view_by").val();
        var department = $("#department").val();	
        var employee = $("#employee_ids").html();
        var month = $("#dropMonth").val();
        var year = $("#dropYear").val(); 
        var branch = $("#dropBranch").val();
        var status = $("#emp_status").val();
        
        if(department == ""){
            alert("Please Select Department");
        }else{
            if(view == "borang_tp1"){
                window.open("?widget=borang_tp1&dep_id="+department+"&emp_id="+employee);
            }else if(view == "borang_tp2"){
                window.open("?widget=borang_tp2&dep_id="+department+"&emp_id="+employee);
            }else if(view == "borang_tp3"){
                window.open("?widget=borang_tp3&dep_id="+department+"&emp_id="+employee);
            }else if(view == "borang_ea"){
                window.open("?widget=borang_ea&dep_id="+department+"&emp_id="+employee);
            }else if(view=="borang_a"){
                window.open("?widget=pdf_borang_a&dep_id="+department+"&emp_id="+employee+"&branch_id="+branch+"&status="+status+"&month="+month+"&year="+year);
            }else if(view=="borang_8a"){
                window.open("?widget=pdf_borang_8a&dep_id="+department+"&emp_id="+employee+"&branch_id="+branch+"&status="+status+"&month="+month+"&year="+year);
            }else if(view=="borang_cp39"){
                window.open("?widget=pdf_borang_cp39&dep_id="+department+"&emp_id="+employee+"&branch_id="+branch+"&status="+status+"&month="+month+"&year="+year);
            }
        }
    }

    function select_all(){
        var ids = new Array();
        $(".check").each(function(i,dom){
            $(dom).attr("checked","checked");
        });
    }
    function deselect_all(){
        var ids = new Array();
        $(".check").each(function(i,dom){
            $(dom).attr("checked",false);	
        });
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