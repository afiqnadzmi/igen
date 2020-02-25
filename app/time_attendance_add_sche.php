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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Time Attendance for Schedule Shift</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="header_text">
        <span>Time Attendance for Schedule Shift</span>
        <span style="float: right; margin-top: -4px;">
            <table>
                <tr>
                    <td><input class="button" type="button" onclick="back()" value="Back" style="width:100px" /></td>
                </tr>
            </table>
        </span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <table>

                <tr>
                    <td colspan="2">
                        <input type="button" class="button" value="Clear" style="width:70px;" onclick="clearNew()"/>
                    </td>
                </tr>


                <tr id="company_picker">
                    <td colspan="2" style="width: 200px;">Company<span class="red"> *</span></td>
                    <td>
                        <select id="dropCompany" style="width: 259px;" onchange="showBranch(this.value)">
                            <option value="">--Please Select--</option>
                            <?php
                                        $queryCompany = mysql_query('SELECT * FROM company ORDER BY code'); 
                                        while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                            if (isset($_GET["emp"]) == true && $_GET["emp"] != "" && $igen_a_hr == "a_hr_edit" ) {
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
                                <td colspan="2" style="width: 200px;">Branch<span class="red"> *</span></td>
                                <td>
                                    <select id="dropBranch" style="width: 259px;" onchange="showDep(this.value)">
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
                            <tr id="tr_department">
                                <td colspan="2" style="width: 200px;">Department<span class="red"> *</span></td>                                <td>
                                    <select id="department" style="width: 259px;" onchange="time_att()">
                                        <option value="">--Please Select--</option>
                                        <?php
                                        if (isset($_GET["emp"]) == true && $_GET["emp"] != "" && $igen_a_hr == "a_hr_edit") {
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

                
                <tr><td colspan="4" style="border-bottom: 1px solid gray;">&nbsp;</td></tr>
                <tr><td colspan="4" style="padding-bottom: 5px;"></td></tr>
                <tr style="display: none;">
                    <td colspan="2">Date</td>
                    <td><input id="date" type="text" style="width: 250px;"/></td>
                    <td colspan="2" style="width: 200px;"></td>
                </tr>
                <tr style="display: none;">
                    <td>Time In</td>
                    <td>(E.g. 09:00)</td>
                    <td style="width: 300px;"><input id="timein" type="text" style="width: 250px;"/></td>
                </tr>
                <tr style="display: none;">
                    <td>Time Out</td>
                    <td>(E.g. 17:30)</td>
                    <td><input id="timeout" type="text" style="width: 250px;"/></td>
                </tr>
            </table>
        </div>
    </div>
    <br/>
    <?php
    if (isset($_GET["month"]) && isset($_GET["year"])) {
        $total_date = date('t', mktime(0, 0, 0, $_GET["month"], 1, $_GET["year"]));
        ?>
        <div id="content_time_att" class="main_content">
            <div class="tablediv">
                <table style="padding-bottom: 10px;">
                    <tr>
                        <td colspan="2">
                            <input type="button" class="button" value="Save" style="width:70px;" onclick="save_time()"/>
                            <input type="button" class="button" value="Clear" style="width:70px;" onclick="time_att()"/>
                            <span id="days" style="display: none;"><?php echo $total_date ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="width:200px; font-weight: bold;">Employee Name</td>
                        <td>
                            <input id="name" type="text" style="width: 250px;" readonly="readonly"/>&nbsp;&nbsp;<a class="blue cursor_pointer" onclick="searchemp_time()">Search</a>
                            <input id="id" type="hidden" />
                        </td>
                    </tr>
                </table>
                <div style="padding: 10px 0px">Hint: Time Format (24 hour), E.g. 09:00&nbsp;&nbsp;|&nbsp;&nbsp;12:00&nbsp;&nbsp;|&nbsp;&nbsp;13:00&nbsp;&nbsp;|&nbsp;&nbsp;17:30</div>
                <table id="table_time_att">
                    <tr>
                        <td style="text-align: center;width:150px;">Date</td>
                        <td style="text-align: center;width:150px;">In</td>
                        <td style="text-align: center;width:150px;">Out</td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php
                    for ($ii = 1; $ii <= $total_date; $ii++) {
                        ?>
                        <tr>
                            <!-- <td><span id="d<?php echo $ii ?>"><?php echo date('Y-m-d', mktime(0, 0, 0, $_GET['month'], $ii, $_GET['year'])) ?></span></td>
                            <td><?php echo date('D', mktime(0, 0, 0, $_GET['month'], $ii, $_GET['year'])) ?></td> -->
                            <td style="text-align: center;width:150px;">
                                <!-- <select id="from1_h<?php echo $ii ?>">
                                    <?php
                                    for ($hi = 0; $hi <= 23; $hi++) {
                                        $selected = "";
                                        $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                        if ($time_in_h == $hour) {
                                            $selected = "selected";
                                        }
                                        echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                                    }
                                    ?>
                                </select>:<select id="from1_m<?php echo $ii ?>">
                                    <?php
                                    for ($ti = 0; $ti <= 59; $ti++) {
                                        $selected = "";
                                        $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                        if ($time_in_m == $minute) {
                                            $selected = "selected";
                                        }
                                        echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                                    }
                                    ?>
                                </select> -->
                                <input type="text"  class="input_text" id="claim_date" style="width: 250px" />
                            </td>
                            <td style="text-align: center;width:150px;">
                                <select id="from1_h<?php echo $ii ?>">
                                    <?php
                                    for ($hi = 0; $hi <= 23; $hi++) {
                                        $selected = "";
                                        $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                        if ($time_in_h == $hour) {
                                            $selected = "selected";
                                        }
                                        echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                                    }
                                    ?>
                                </select>:<select id="from1_m<?php echo $ii ?>">
                                    <?php
                                    for ($ti = 0; $ti <= 59; $ti++) {
                                        $selected = "";
                                        $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                        if ($time_in_m == $minute) {
                                            $selected = "selected";
                                        }
                                        echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td style="text-align: center;">
                                <select id="to2_h<?php echo $ii ?>">
                                    <?php
                                    for ($hi = 0; $hi <= 23; $hi++) {
                                        $selected = "";
                                        $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                        if ($time_out_h == $hour) {
                                            $selected = "selected";
                                        }
                                        echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                                    }
                                    ?>
                                </select>:<select id="to2_m<?php echo $ii ?>">
                                    <?php
                                    for ($ti = 0; $ti <= 59; $ti++) {
                                        $selected = "";
                                        $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                        if ($time_out_m == $minute) {
                                            $selected = "selected";
                                        }
                                        echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>&nbsp;</td>
                            

                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    <?php } ?>
</p></div></div></div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tablecolor1').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
    function back(){
        window.location = '?loc=time_attendance';
    }
    $(function() {
        $("#date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });
    function daysInMonth(month, year) {
        return new Date(year, month, 0).getDate();
    }
    function time_att(){
        var year = $("#year").val();
        var month = $("#month").val();
        if(year != "" && month != ""){
            window.location="?loc=time_attendance_add&year="+year+"&month="+month;
        }
    }
    function searchemp_time(){
        var url = '?widget=searchemp_time';
        window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
    }
    function clearNew(){
        window.location='?loc=time_attendance_add';
    }
    function save_time(){
        var year = $("#year").val();
        var month = $("#month").val();
        if(month.length == 1){
            month = "0" + month;
        }
        var id = $("#id").val();
        var days = $("#days").html();
        var data_full = "";
		
        var timein='';
        var timeout='';
        var lunchfrom='';
        var lunchto='';
        for(var i = 1; i <= days; i++) {
            timein=$("#from1_h"+i).val()+':'+$("#from1_m"+i).val();
            timeout=$("#to2_h"+i).val()+':'+$("#to2_m"+i).val();
            lunchfrom=$("#to1_h"+i).val()+':'+$("#to1_m"+i).val();
            lunchto=$("#from2_h"+i).val()+':'+$("#from2_m"+i).val();
            if(timein!='00:00'||timeout!='00:00'||lunchfrom!='00:00'||lunchto!='00:00'){
                data_full += $("#d"+i).html() + "," + timein + "," + timeout + "," + lunchfrom + "," + lunchto + "|";
            }
        }
        
        if(id == ""){
            alert("Please Select Employee");
        }else{
            $.ajax({
                dataType:'json',
                type:"POST",
                url:"?widget=addattendance",
                data:{
                    id:id,
                    data_full:data_full,
                    year:year,
                    month:month
                },
                success:function(data){
                    if(data.msg == "correct"){
                        alert("Time Attendance Added");
                        window.location = "?loc=time_attendance_add";
                    }else if(data.msg == "month_existed"){
                        alert("Year & Month for Time Attendance Existed, Choose Another Year & Month!");
                    }else if(data.msg == "empty_field"){
                        alert("Empty Field(s):"+data.date);
                    }else if(data.msg == "wrong_format"){
                        alert("Wrong Time Format (E.g. 09:00):"+data.date);
                    }else if(data.msg == "empty"){
                        alert("Empty Time Attendance Will Not be Saved");
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }  
    }

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
                $("#employee_id").val();
                $("#employee_name").val("");
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
                $("#employee_id").val();
                $("#employee_name").val("");
            }
        });
    }
    function time_att(){
        var year = $("#year").val();
        var month = $("#month").val();
        if(year != "" && month != ""){
            window.location="?loc=time_attendance_add_sche&year="+year+"&month="+month;
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