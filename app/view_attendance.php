<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$date = date('Y-m-d'); //get current date
$yr_mth = substr($date, 0, 7); //get current month e.g 03
$today = date("F"); //get current month e.g March
$time = date("H:i:s");
if (isset($_GET['viewattend']) == true) {
    $getID = $_GET['viewattend'];

    $sql1 = 'SELECT * FROM attendance WHERE emp_id=' . $getID . ' and work_in_date LIKE "%' . $yr_mth . '%" ;';
    $query = mysql_query($sql1);

    $sql2 = 'SELECT e.full_name,e.join_date FROM employee AS e WHERE e.id=' . $getID . ';';
    $queryJoin = mysql_query($sql2);

    $rowJoin = mysql_fetch_array($queryJoin);
    $plan = $rowJoin['plan_name'];
    $planid = $rowJoin['id'];

    $sql3 = 'SELECT from_time, to_time,day FROM time_table  WHERE time_plan_id=' . $planid . ';';
    $query2 = mysql_query($sql3);
    while ($row = mysql_fetch_array($query2)) {
        $from_time = $row['from_time'];
    }

    $a = date("l Y-m-d H:i:s");
    $date = '2012-03-12';
    $weekday = date('l', strtotime($date));

    $time_in = $rowJoin['from_time'];
    $name = $rowJoin['full_name'];
    $join_date = $rowJoin['join_date'];
    $time_out = $rowJoin['to_time'];
    $lunch_in = $rowJoin['lunch_in_time'];

    $basedate = strtotime($time_out);   //time for OT calculation
    $date1 = strtotime("+1 hours", $basedate); //time for OT calculation

    $basedate1 = strtotime($time_in);
    $date2 = strtotime("+1 minutes", $basedate1);
    $newtime = date('H:i:s', $date2);

    $basedate2 = strtotime($lunch_in);
    $date3 = strtotime("+1 minutes", $basedate2);
    $newlunch = date('H:i:s', $date3);

    $i = 0;
    $j = 0;
    $k = 0;
}

$getYearMonth = explode('-', $yr_mth);
$today_year = $getYearMonth[0];
$today_month = $getYearMonth[1] - 1;
?>

<div class="main_div"> 
    <br/>
    <div class="header_text">
        <span>View Attendancesss</span>  
        <span style="float: right;">
            <table>
                <tr>
                    <td><input type="button" value="Back" class="button" onclick="back()" style="width: 70px;" /></td>
                </tr>
            </table>
        </span>
    </div>
    <?php
    $array1 = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    ?>
    <div class="main_content" style="margin-top: 10px;">
        <div class="tablediv">
            <table>
                <tr><td style="font-weight: bold; width: 170px;">Employee Name:&nbsp;</td><td> <?php echo $name; ?></td></tr>
                <tr><td style="font-weight: bold;">Join since:&nbsp;</td><td> <?php echo $join_date; ?></td></tr>
                <tr>
                    <td style="font-weight: bold;">Month:</td> 
                    <td>
                        <select id="month" onchange="view_month()">
                            <option value="0">--Please Select--</option>
                            <?php
                            for ($i = 0; $i < 12; $i++) {
                                if ($today_month == $i) {
                                    echo"<option value='" . $i . "' selected='selected'>" . $array1[$i] . "</option>";
                                } else {
                                    echo"<option value='" . $i . "'>" . $array1[$i] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <select id="year" onchange="view_month()">
                            <?php
                            for ($i = date('Y'); $i > (date('Y') - 2); $i--) {
                                if ($i == $today_year) {
                                    echo"<option value='" . $i . "' selected>" . $i . "</option>";
                                } else {
                                    echo"<option value='" . $i . "'>" . $i . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <br/>
   <div id="contain"></div> 
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#month").val(<?php echo $today_month ?>);
        $("#year").val(<?php echo $today_year ?>);
        view_month();
    });
    
    function view_month(){
	
        var month = $('#month').val();
        var year=$('#year').val();
        var userid = <?php echo $_GET['viewattend'] ?>;
    
        $.ajax({
            type:"POST",
            url:"?widget=view_att_month3",
            data:{
                month:month,
                year:year,
                userid:userid
            },
            success:function(data){
                if(data != false){
                    $("#contain").empty().append(data);
                }else{
                    alert("Error While Processing");
                }
            }
        })
    }
    function back(){
        window.location='?loc=home';
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