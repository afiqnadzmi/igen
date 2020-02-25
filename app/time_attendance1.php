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
    <div class="header_text">
        <span>Employee Attendance List</span>
        <span style="float: right">
            <?php if ($igen_a_m == "a_m_edit") { ?>
                <table>
                    <tr>
                        <td><input class="button" type="button" onclick="window.location = '?loc=import_attendance';" value="Import" style="width:100px" /></td>
                        <td><input class="button" type="button" onclick="window.location = '?loc=time_attendance_add';" value="Key In" style="width:100px" /></td>
                    </tr>
                </table>
            <?php } ?>
        </span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor1">
                <thead>
                    <tr class="pluginth">
                        <th style="width:30px">No.</th>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th style="width:300px">Year & Month</th>
                        <th class='aligncentertable' style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <?php
                if ($igen_branchlist != "") {
                    $sqlAdd = ' WHERE e.branch_id IN (' . $igen_branchlist . ')';
                } else {
                    $sqlAdd = '';
                }
                $sql = 'SELECT DISTINCT YEAR(a.work_in_date) AS att_year, MONTH(a.work_in_date) AS att_month, e.full_name, a.emp_id FROM attendance AS a 
                        INNER JOIN employee AS e 
                        ON e.id = a.emp_id
                        ' . $sqlAdd . '
                        ORDER BY a.emp_id, YEAR(a.work_in_date), MONTH(a.work_in_date)';
                $rs = mysql_query($sql);
                $month = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

                while ($row = mysql_fetch_array($rs)) {
                    $i = $i + 1;
                    $att_year = $row['att_year'];
                    $att_month = $row['att_month'];
                    $emp_id = $row['emp_id'];
                    $emp_name = $row['full_name'];
                    echo '<tr class="plugintr">
                          <td>' . $i . '</td>
                          <td><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span>&nbsp;&nbsp;&nbsp;' . $emp_name . '</td> 
                          <td>' . $att_year . ' ' . $month[$att_month] . '</td>';
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a href="?loc=time_attendance&action=1&emp_id=' . $emp_id . '&year=' . $att_year . '&month=' . $att_month . '">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:deleteatt(' . $emp_id . ', ' . $att_year . ', ' . $att_month . ')">Delete</a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td class="aligncentertable"><a href="?loc=time_attendance&action=2&emp_id=' . $emp_id . '&year=' . $att_year . '&month=' . $att_month . '">View</a></td>';
                    }
                    echo '</tr>';
                }
                ?>  
            </table>
        </div>
    </div>
    <?php
    if (isset($_GET["action"]) == true && ($_GET["action"] == "1" || $_GET["action"] == "2")) {
        $getyear = $_GET["year"];
        $getmonth = $_GET["month"];
        $month1 = str_pad($getmonth, 2, '0', STR_PAD_LEFT);
        $get_emp = $_GET["emp_id"];
        $sql1 = 'SELECT full_name FROM employee WHERE id = ' . $get_emp;
        $query1 = mysql_query($sql1);
        $row1 = mysql_fetch_array($query1);

        $total_days = date('t', mktime(0, 0, 0, $getmonth, 1, $getyear));
        ?>
        <span id="edit_data" style="display: none;"><?php echo $data; ?></span>
        <br/><br/>
        <span id="year" style="display: none;"><?php echo $getyear; ?></span>
        <span id="month" style="display: none;"><?php echo $month1; ?></span>
        <div id="content_time_att" class="main_content">
            <div class="tablediv">
                <table style="padding-bottom: 10px;">
                    <?php if ($igen_a_m == "a_m_edit") { ?>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Save" style="width:70px;" onclick="edit_time(<?php echo $get_emp; ?>, <?php echo $getyear; ?>, <?php echo $getmonth; ?>)"/>
                                <input type="button" class="button" value="Clear" style="width:70px;" onclick="time_att(<?php echo $_GET["emp_id"]; ?>,<?php echo $_GET["year"]; ?>,<?php echo $_GET["month"]; ?>)"/>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2" style="width:200px; font-weight: bold;">Employee Name <span class="red">*</span></td>
                        <td>
                            <input id="name" type="text" style="width: 250px;" readonly="readonly" value="<?php echo $row1["full_name"]; ?>" />
                            <input id="id" type="hidden" value="<?php echo $get_emp; ?>" />
                        </td>
                    </tr>
                </table>
                <table id="table_time_att">
                    <tr>
                        <td style='width: 200px; font-weight: bold;'>Date</td>
                        <td style='width: 150px; font-weight: bold;'>Time In</td>
                        <td style='width: 200px; font-weight: bold;'>Time Out</td>
                        <td style='width: 150px; font-weight: bold;'>Lunch From</td>
                        <td style='width: 150px; font-weight: bold;'>Lunch To</td>
                    </tr>
                    <?php
                    for ($ii = 1; $ii <= $total_days; ++$ii) {
                        $sql2 = 'SELECT a.id, a.work_in_date, a.work_in_time AS workin,
                                 (SELECT a2.work_out_time FROM attendance AS a2 WHERE a2.id > a.id LIMIT 1) AS workout,
				 a.work_out_time AS lunchfrom,
				 (SELECT a1.work_in_time FROM attendance AS a1 WHERE a1.id > a.id LIMIT 1) AS lunchto
				 FROM attendance AS a
				 WHERE a.work_in_date= "' . $getyear . '-' . str_pad($getmonth, 2, "0", STR_PAD_LEFT) . '-' . str_pad($ii, 2, "0", STR_PAD_LEFT) . '" AND a.emp_id = ' . $get_emp . '
				 GROUP BY a.work_in_date';
                        $query2 = mysql_query($sql2);
                        if (mysql_num_rows($query2) > 0) {
                            while ($row2 = mysql_fetch_array($query2)) {
                                $workin_hour = substr($row2["workin"], 0, 2);
                                $workin_minute = substr($row2["workin"], 3, 2);

                                $workout_hour = substr($row2["workout"], 0, 2);
                                $workout_minute = substr($row2["workout"], 3, 2);

                                $lunchfrom_hour = substr($row2["lunchfrom"], 0, 2);
                                $lunchfrom_minute = substr($row2["lunchfrom"], 3, 2);

                                $lunchto_hour = substr($row2["lunchto"], 0, 2);
                                $lunchto_minute = substr($row2["lunchto"], 3, 2);

                                echo "<tr>";
                                echo "<td style='width: 200px;'><span id='date" . $ii . "'>" . $row2['work_in_date'] . "</span>&nbsp;&nbsp;&nbsp;" . date('D', strtotime($row2['work_in_date'])) . "</td>";
                                echo "<td>";
                                echo "<select id='timein_hour_" . $ii . "'>";
                                for ($hi = 0; $hi < 24; $hi++) {
                                    $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                    $selected = "";
                                    if ($workin_hour == $hour) {
                                        $selected = "selected";
                                    }
                                    echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                                }
                                echo "</select>";
                                echo "<select id='timein_minute_" . $ii . "'>";
                                for ($ti = 0; $ti <= 59; ++$ti) {
                                    $selected = "";
                                    $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                    if ($workin_minute == $minute) {
                                        $selected = "selected";
                                    }
                                    echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                                }
                                echo "</select>";
                                echo "</td>";
                                echo "<td>";
                                echo "<select id='timeout_hour_" . $ii . "'>";
                                for ($hi = 0; $hi < 24; $hi++) {
                                    $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                    $selected = "";
                                    if ($workout_hour == $hour) {
                                        $selected = "selected";
                                    }
                                    echo $workout_hour . "  " . $hour . '<br />';
                                    echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                                }
                                echo "</select>";
                                echo "<select id='timeout_minute_" . $ii . "'>";
                                for ($ti = 0; $ti <= 59; ++$ti) {
                                    $selected = "";
                                    $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                    if ($workout_minute == $minute) {
                                        $selected = "selected";
                                    }
                                    echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                                }
                                echo "</select>";
                                echo "</td>";
                                echo "<td>";
                                echo "<select id='lunchfrom_hour_" . $ii . "'>";
                                for ($hi = 0; $hi < 24; $hi++) {
                                    $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                    $selected = "";
                                    if ($lunchfrom_hour == $hour) {
                                        $selected = "selected";
                                    }
                                    echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                                }
                                echo "</select>";
                                echo "<select id='lunchfrom_minute_" . $ii . "'>";
                                for ($ti = 0; $ti <= 59; ++$ti) {
                                    $selected = "";
                                    $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                    if ($lunchfrom_minute == $minute) {
                                        $selected = "selected";
                                    }
                                    echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                                }
                                echo "</select>";
                                echo "</td>";
                                echo "<td>";
                                echo "<select id='lunchto_hour_" . $ii . "'>";
                                for ($hi = 0; $hi < 24; $hi++) {
                                    $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                    $selected = "";
                                    if ($lunchto_hour == $hour) {
                                        $selected = "selected";
                                    }
                                    echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                                }
                                echo "</select>";
                                echo "<select id='lunchto_minute_" . $ii . "'>";
                                for ($ti = 0; $ti <= 59; ++$ti) {
                                    $selected = "";
                                    $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                    if ($lunchto_minute == $minute) {
                                        $selected = "selected";
                                    }
                                    echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                                }
                                echo "</select>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            //not found date
                            $workin_hour = '00';
                            $workin_minute = '00';

                            $workout_hour = '00';
                            $workout_minute = '00';

                            $lunchfrom_hour = '00';
                            $lunchfrom_minute = '00';

                            $lunchto_hour = '00';
                            $lunchto_minute = '00';

                            echo "<tr>";
                            echo "<td style='width: 200px;'><span id='date" . $ii . "'>" . str_pad($getyear, 2, "0", STR_PAD_LEFT) . '-' . str_pad($getmonth, 2, "0", STR_PAD_LEFT) . '-' . str_pad($ii, 2, "0", STR_PAD_LEFT) . "</span>&nbsp;&nbsp;&nbsp;" . date('D', strtotime(str_pad($getyear, 2, "0", STR_PAD_LEFT) . '-' . str_pad($getmonth, 2, "0", STR_PAD_LEFT) . '-' . str_pad($ii, 2, "0", STR_PAD_LEFT))) . "</td>";
                            echo "<td>";
                            echo "<select id='timein_hour_" . $ii . "'>";
                            for ($hi = 0; $hi < 24; $hi++) {
                                $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                $selected = "";
                                if ($workin_hour == $hour) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                            }
                            echo "</select>";
                            echo "<select id='timein_minute_" . $ii . "'>";
                            for ($ti = 0; $ti <= 59; ++$ti) {
                                $selected = "";
                                $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                if ($workin_minute == $minute) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                            }
                            echo "</select>";
                            echo "</td>";
                            echo "<td>";
                            echo "<select id='timeout_hour_" . $ii . "'>";
                            for ($hi = 0; $hi < 24; $hi++) {
                                $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                $selected = "";
                                if ($workout_hour == $hour) {
                                    $selected = "selected";
                                }
                                echo $workout_hour . "  " . $hour . '<br />';
                                echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                            }
                            echo "</select>";
                            echo "<select id='timeout_minute_" . $ii . "'>";
                            for ($ti = 0; $ti <= 59; ++$ti) {
                                $selected = "";
                                $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                if ($workout_minute == $minute) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                            }
                            echo "</select>";
                            echo "</td>";
                            echo "<td>";
                            echo "<select id='lunchfrom_hour_" . $ii . "'>";
                            for ($hi = 0; $hi < 24; $hi++) {
                                $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                $selected = "";
                                if ($lunchfrom_hour == $hour) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                            }
                            echo "</select>";
                            echo "<select id='lunchfrom_minute_" . $ii . "'>";
                            for ($ti = 0; $ti <= 59; ++$ti) {
                                $selected = "";
                                $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                if ($lunchfrom_minute == $minute) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                            }
                            echo "</select>";
                            echo "</td>";
                            echo "<td>";
                            echo "<select id='lunchto_hour_" . $ii . "'>";
                            for ($hi = 0; $hi < 24; $hi++) {
                                $hour = str_pad($hi, 2, "0", STR_PAD_LEFT);
                                $selected = "";
                                if ($lunchto_hour == $hour) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $hour . '">' . $hour . '</option>';
                            }
                            echo "</select>";
                            echo "<select id='lunchto_minute_" . $ii . "'>";
                            for ($ti = 0; $ti <= 59; ++$ti) {
                                $selected = "";
                                $minute = str_pad($ti, 2, "0", STR_PAD_LEFT);
                                if ($lunchto_minute == $minute) {
                                    $selected = "selected";
                                }
                                echo '<option ' . $selected . ' value="' . $minute . '">' . $minute . '</option>';
                            }
                            echo "</select>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
                <span id="days" style="display: none;"><?php echo $ii - 1; ?></span>
            </div>
        </div>
    <?php } ?>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tablecolor1').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
    function deleteatt(id, year, month){
        var result = confirm("Are you sure you want to delete this record?");

        if(result){
            $.ajax({
                type:"POST",
                url:"?widget=delattendance",
                data:{
                    id:id,
                    year:year,
                    month:month
                },
                success:function(data){
                    if(data == true){
                        alert("Time Attendance Deleted Successfully");
                        window.location = "?loc=time_attendance";
                    }else{
                        alert("Error While Proccessing.\nPlease Try Again Later.");
                    }
                }
            })
        }
    }
    
    function daysInMonth(month, year) {
        return new Date(year, month, 0).getDate();
    }
    
    function time_att(emp, year, month){
        window.location='?loc=time_attendance&action=1&emp_id='+emp+'&year='+year+'&month='+month;
        //        var date = "";
        //        var year = $("#year").html();
        //        var month = $("#month").html();
        //            
        //        $("#table_time_att").empty();
        //        $("#table_time_att").append("<tr><td style='width: 200px; font-weight: bold;'>Date</td><td style='width: 150px; font-weight: bold;'>Time In</td><td style='width: 200px; font-weight: bold;'>Time Out</td><td style='width: 150px; font-weight: bold;'>Lunch From</td><td style='width: 150px; font-weight: bold;'>Lunch To</td></tr>");
        //        var weekday = new Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
        //        var date = "";
        //        var days = daysInMonth(month, year);
        //        $("#days").html(days);
        //        for(var i = 1; i <= days; i++) {
        //            if(i == 1 || i == 2 || i == 3 || i == 4 || i == 5 || i == 6 || i == 7 || i == 8 || i == 9){
        //                var day = "0" + i;
        //            }else{
        //                var day = i;
        //            }
        //                
        //            date = new Date(year + "-" +  month + "-" + day);
        //                
        //            var str = $("#edit_data").html(); 
        //            var temp1 = new Array();
        //            var temp2 = new Array();
        //            var workin = "";
        //            var workout = "";
        //            var lunchfrom = "";
        //            var lunchto = "";
        //                
        //            temp1 = str.split("|");
        //            for(var t = 0; t < temp1.length; t++){
        //                temp2 = temp1[t].split(",");
        //                if(temp2[0] == year+"-"+month+"-"+day){
        //                    workin = temp2[1];
        //                    workout = temp2[2];
        //                    lunchfrom = temp2[3];
        //                    lunchto = temp2[4];
        //                }
        //            }
        //            $("#table_time_att").append("<tr><td style='width: 200px;'>"+year+"-"+month+"-"+day+"&nbsp;&nbsp;&nbsp;"+ weekday[date.getDay()] +" </td><td><input type='text' style='width: 100px;' id='timein"+i+"' maxlength='5' value='"+workin+"' /></td><td><input type='text' style='width: 100px;' id='timeout"+i+"' maxlength='5' value='"+workout+"' /></td><td><input type='text' style='width: 100px;' id='lunchfrom"+i+"' maxlength='5' value='"+lunchfrom+"' /></td><td><input type='text' style='width: 100px;' id='lunchto"+i+"' maxlength='5' value='"+lunchto+"' /></td><td id='date"+i+"' style='display: none;'>"+year+"-"+month+"-"+day+"</td></tr>");
        //        }
    }
    
    function edit_time(id, year, month){
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
            timein= $("#timein_hour_"+i).val()+':'+$("#timein_minute_"+i).val();
            timeout= $("#timeout_hour_"+i).val()+':'+$("#timeout_minute_"+i).val();
            lunchfrom= $("#lunchfrom_hour_"+i).val()+':'+$("#lunchfrom_minute_"+i).val();
            lunchto= $("#lunchto_hour_"+i).val()+':'+$("#lunchto_minute_"+i).val();
            if(timein!='00:00'||timeout!='00:00'||lunchfrom!='00:00'||lunchto!='00:00'){
                data_full += $("#date"+i).html() + "," + timein + "," + timeout + "," + lunchfrom + "," + lunchto + "|";
            }
        }
        
        if(id == ""){
            alert("Please Select Employee");
        }else{
            $.ajax({
                dataType:'json',
                type:"POST",
                url:"?widget=editattendance",
                data:{
                    id:id,
                    data_full:data_full,
                    year:year,
                    month:month
                },
                success:function(data){
                    if(data.msg == "correct"){
                        alert("Time Attendance Updated Successfully");
                        window.location = "?loc=time_attendance";
                    }else if(data.msg == "empty_field"){
                        alert("Empty Field(s):"+data.date);
                    }else if(data.msg == "wrong_format"){
                        alert("Wrong Time Format (E.g. 09:00):"+data.date);
                    }else{
                        alert("Error While Proccessing.\nPlease Try Again Later.");
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