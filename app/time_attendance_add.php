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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Time Attendance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="header_text">
        <span>Time Attendance</span>
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
                <tr id="month_picker">
                    <td colspan="2" style="width: 200px;">Month Range</td>
                    <td>
                        <select id="month" style="width: 259px;" onchange="time_att()">
                            <option value="">--Please Select--</option>
                            <?php
                            for ($i = 1; $i < 13; $i++) {
                                $selected = "";
                                if ($i == $_GET["month"]) {
                                    $selected = "selected";
                                }
                                echo "<option " . $selected . " value='" . $i . "'>" . date("F", mktime(0, 0, 0, $i, 1, date('Y'))) . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr id="year_picker">
                    <td colspan="2" >Year Range</td>
                    <td>
                        <select id="year" style="width: 259px;" onchange="time_att()">
                            <option value="">--Please Select--</option>
                            <?php
                            for ($k = (date('Y') - 5); $k <= date('Y'); $k++) {
                                $selected = "";
                                if ($k == $_GET["year"]) {
                                    $selected = "selected";
                                }
                                echo"<option " . $selected . " value='" . $k . "'>" . $k . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr style="display: none;">
                    <td colspan="2">Date</td>
                    <td><input id="date" type="text" style="width: 250px;"/></td>
                    <td colspan="2" style="width: 200px;"></td>
                </tr>
                <tr style="display: none;">
                    <td>Time In</td>
                    <td>(E.g. 09:00)</td>
                    <td style="width: 300px;"><input id="timein" type="text" style="width: 250px;"/></td>
                    <td>Lunch From</td>
                    <td>(E.g. 12:00)</td>
                    <td><input id="lunchfrom" type="text" style="width: 250px;"/></td>
                </tr>
                <tr style="display: none;">
                    <td>Time Out</td>
                    <td>(E.g. 17:30)</td>
                    <td><input id="timeout" type="text" style="width: 250px;"/></td>
                    <td>Lunch To</td>
                    <td>(E.g. 13:00)</td>
                    <td><input id="lunchto" type="text" style="width: 250px;"/></td>
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
                        <td style="width:120px;">Date</td>
                        <td style="width:80px;">Day</td>
                        <td style="text-align: center;width:150px;">In</td>
                        <td style="text-align: center;width:150px;">Out</td>
                        <td>&nbsp;</td>
                        <td style="text-align: center;width:150px;">Lunch From</td>
                        <td style="text-align: center;width:150px;">Lunch To</td>
                    </tr>
                    <?php
                    for ($ii = 1; $ii <= $total_date; $ii++) {
                        ?>
                        <tr>
                            <td><span id="d<?php echo $ii ?>"><?php echo date('Y-m-d', mktime(0, 0, 0, $_GET['month'], $ii, $_GET['year'])) ?></span></td>
                            <td><?php echo date('D', mktime(0, 0, 0, $_GET['month'], $ii, $_GET['year'])) ?></td>
                            <td>
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
                            <td style="text-align: center;">
                                <select id="to1_h<?php echo $ii ?>">
                                    <?php
                                    for ($hi = 0; $hi <= 23; $hi++) {
                                        $selected = "";
                                        $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                        if ($lunch_from_h == $hour) {
                                            $selected = "selected";
                                        }
                                        echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                                    }
                                    ?>
                                </select>:<select id="to1_m<?php echo $ii ?>">
                                    <?php
                                    for ($ti = 0; $ti <= 59; $ti++) {
                                        $selected = "";
                                        $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                        if ($lunch_from_m == $minute) {
                                            $selected = "selected";
                                        }
                                        echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            <td style="text-align: center;">
                                <select id="from2_h<?php echo $ii ?>">
                                    <?php
                                    for ($hi = 0; $hi <= 23; $hi++) {
                                        $selected = "";
                                        $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                        if ($lunch_to_h == $hour) {
                                            $selected = "selected";
                                        }
                                        echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                                    }
                                    ?>
                                </select>:<select id="from2_m<?php echo $ii ?>">
                                    <?php
                                    for ($ti = 0; $ti <= 59; $ti++) {
                                        $selected = "";
                                        $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                        if ($lunch_to_m == $minute) {
                                            $selected = "selected";
                                        }
                                        echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>

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
    
</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>