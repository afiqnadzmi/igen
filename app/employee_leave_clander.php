<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$db_table = "events";

function getmicrotime() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float) $usec + (float) $sec);
}

$time_start = getmicrotime();

IF (!isset($_GET['year'])) {
    $_GET['year'] = date("Y");
}
IF (!isset($_GET['month'])) {
    $_GET['month'] = date("n") + 1;
}
if (isset($_GET["sun_date"]) && $_GET["sun_date"] == "") {
    $date = date('j', time());
    $day = date('N', time());
    $sun_date = get_sun_date($day, $date);
} elseif (isset($_GET["sun_date"]) && $_GET["sun_date"] != "") {
    $date = $_GET["sun_date"];
    $day = 7;
    $sun_date = get_sun_date($day, $date);
}
$month = addslashes($_GET['month'] - 1);
$year = addslashes($_GET['year']);

/* Check user_permission_view if restricted access permission */
if ($igen_branchlist != "") {
    $sqlAdd = ' AND e.branch_id IN (' . $igen_branchlist . ')';
}

$e_sql = "SELECT e.id
          FROM employee_leave el
          join employee e on el.emp_id=e.id
          WHERE (MONTH(from_date) = " . $month . " or  MONTH(to_date) = " . $month . ")
          and (year(from_date) = " . $year . " or  year(to_date) = " . $year . ")
          AND el.request_status = 'Approved'" . $sqlAdd . " GROUP BY e.id";
$e_rs = mysql_query($e_sql);
$e_row = mysql_fetch_array($e_rs);
//$sum_emp = $e_row["cid"];
$sum_emp = mysql_num_rows($e_rs);

/*
  $query = "SELECT event_id,event_title,event_day,event_time FROM $db_table WHERE event_month='$month' AND event_year='$year' ORDER BY event_time";
  $query_result = mysql_query ($query);
  while ($info = mysql_fetch_array($query_result))
  {
  $day = $info['event_day'];
  $event_id = $info['event_id'];
  $events[$day][] = $info['event_id'];
  $event_info[$event_id]['0'] = substr($info['event_title'], 0, 8);;
  $event_info[$event_id]['1'] = $info['event_time'];
  }
 */

$todays_date = date("j");
$todays_month = date("n");

$days_in_month = date("t", mktime(0, 0, 0, $_GET['month'], 0, $_GET['year']));
$first_day_of_month = date("w", mktime(0, 0, 0, $_GET['month'] - 1, 1, $_GET['year']));
$first_day_of_month = $first_day_of_month + 1;
$count_boxes = 0;
$days_so_far = 0;

IF ($_GET['month'] == 13) {
    $next_month = 2;
    $next_year = $_GET['year'] + 1;
} ELSE {
    $next_month = $_GET['month'] + 1;
    $next_year = $_GET['year'];
}

IF ($_GET['month'] == 2) {
    $prev_month = 13;
    $prev_year = $_GET['year'] - 1;
} ELSE {
    $prev_month = $_GET['month'] - 1;
    $prev_year = $_GET['year'];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="images/cal.css" rel="stylesheet" type="text/css">
        <script language="JavaScript" type="text/JavaScript">
            <!--
            function MM_jumpMenu(targ,selObj,restore){ //v3.0
                eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
                if (restore) selObj.selectedIndex=0;
            }
            function MM_openBrWindow(theURL,winName,features) { //v2.0
                window.open(theURL,winName,features);
            }
            function show_emp(obj,this_date){
                if($(obj).find("#loader").length==0){
                    $(obj).prepend("<img id='loader' src='images/loading.gif' style='margin-bottom:-3px' />");
                }
                if($("body").find("#choosetemplate").length>0){
                    $("#choosetemplate").remove();
                }
                $.ajax({
                    url: '?widget=emp_leave',
                    data:{
                        this_date:this_date
                    },
                    success: function(data) {
                        $("body").append(data);
                        $(obj).find("#loader").remove();
                    }
                });
            }
            function show_leave(this_month,this_year){
                $("#loader").show();
                $.ajax({
                    url: '?widget=show_leave',
                    data:{
                        this_month:this_month,
                        this_year:this_year
                    },
                    success: function(data) {
                        if(data!=false){
                            $("#show_all_emp").empty().append(data);
                        }else{
                            alert("Error occured. Please try again.");
                        }
                        $("#loader").hide();
                    }
                });
            }
            //-->
        </script>
        <style type="text/css">
            .lbl{
                font-size: 25px;
                font-weight: bold;
                color: #2B2B2B;
                height: 95px;
                text-align: center;
            }
            .bg{
                border:3px solid #CECED1;
                background:#F0F0F0;
                padding:0px 2px 2px 0px;
                height:18px
            }
            .thead{
                background-color:#D6D6D6;
                font-size:13px;
                font-weight:bold;
                padding:5px 0 5px 0;
            }
            .rounded_corners {
                -moz-border-radius: 5px;
                -webkit-border-radius: 5px;
                -khtml-border-radius: 5px;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class="main_div" style="width:100%">
            <br/>
            <div class="header_text">
                <span>Employee Leave Calendar</span>
            </div>
            <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style='padding-top:20px;width:100%;margin-left: auto; margin-right: auto;'>
                <tr>
                    <td style="vertical-align: top;">
                        <table>
                            <tr>
                                <td>
                                    <div style="height:25px;padding:4px;float:left;width:300px">
                                        <span class="currentdate" style='margin-top:5px'><a href="?loc=leave_calendar">Monthly</a></span>
                                        &nbsp;|&nbsp;
                                        <span class="currentdate" style='margin-top:5px'><a href="?loc=leave_calendar&sun_date=">Weekly</a></span>
                                    </div>
                                    <div style="height:25px;padding:4px;float:right;width:310px">
                                        <span class="currentdate" style='margin-top:5px; font-weight: bold;'><?php echo date("M Y", mktime(0, 0, 0, $_GET['month'] - 1, 1, $_GET['year'])); ?></span>
                                        &nbsp;|&nbsp;
                                        <span style="cursor:pointer;text-decoration:underline;color:blue;" onclick="show_leave('<?php echo date("m", mktime(0, 0, 0, $_GET['month'] - 1, 1, $_GET['year'])) ?>','<?php echo date("Y", mktime(0, 0, 0, $_GET['month'] - 1, 1, $_GET['year'])) ?>')">Show All <?php echo $sum_emp ?> Employees' Leaves</span>
                                        &nbsp;<img id="loader" style='display:none;height:16px;margin-bottom:-3px' src='images/loading.gif' />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 10px;">
                                    <div align="center">
                                        <table width="700" border="0" cellspacing="0" cellpadding="0">
                                            <?php
                                            if (!isset($_GET["sun_date"])) {
                                                ?>
                                                <tr> 
                                                    <td>
                                                        <div align="left">
                                                            <a href="<?php echo "?loc=leave_calendar&month=$prev_month&amp;year=$prev_year"; ?>">
                                                                <img style="border:0" src="images/prev_month.gif" />
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td width="200">
                                                        <div align="center">
                                                            <select name="month" id="month" onChange="MM_jumpMenu('parent',this,0)">
                                                                <?php
                                                                for ($i = 1; $i <= 12; $i++) {
                                                                    $link = $i + 1;
                                                                    IF ($_GET['month'] == $link) {
                                                                        $selected = "selected";
                                                                    } ELSE {
                                                                        $selected = "";
                                                                    }
                                                                    echo "<option value=\"?loc=leave_calendar&month=$link&amp;year=$_GET[year]\" $selected>" . date("F", mktime(0, 0, 0, $i, 1, $_GET['year'])) . "</option>\n";
                                                                }
                                                                ?>
                                                            </select>
                                                            <select name="year" id="year" onChange="MM_jumpMenu('parent',this,0)">
                                                                <?php
                                                                for ($i = (int) date('Y') - 1; $i <= ((int) date('Y') + 1); $i++) {
                                                                    IF ($i == $_GET['year']) {
                                                                        $selected = "selected";
                                                                    } ELSE {
                                                                        $selected = "";
                                                                    }
                                                                    echo "<option value=\"?loc=leave_calendar&month=$_GET[month]&amp;year=$i\" $selected>$i</option>\n";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div align="right">
                                                            <a href="<?php echo "?loc=leave_calendar&month=$next_month&amp;year=$next_year"; ?>">
                                                                <img style="border:0" src="images/next_month.gif" />
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            } else {
                                                ?>
                                                <tr> 
                                                    <td>
                                                        <div align="left">
                                                            <a href="<?php echo "?loc=leave_calendar&month=" . ((int) date("n", mktime(0, 0, 0, $_GET['month'] - 1, ($sun_date - 7), $_GET['year'])) + 1) . "&amp;year=" . date("Y", mktime(0, 0, 0, $_GET['month'] - 1, ($sun_date - 7), $_GET['year'])) . "&sun_date=" . date("j", mktime(0, 0, 0, $_GET['month'] - 1, ($sun_date - 7), $_GET['year'])); ?>">
                                                                <img style="border:0" src="images/prev_month.gif" />
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td width="200">&nbsp;</td>
                                                    <td>
                                                        <div align="right">
                                                            <a href="<?php echo "?loc=leave_calendar&month=" . ((int) date("n", mktime(0, 0, 0, $_GET['month'] - 1, ($sun_date + 7), $_GET['year'])) + 1) . "&amp;year=" . date("Y", mktime(0, 0, 0, $_GET['month'] - 1, ($sun_date + 7), $_GET['year'])) . "&sun_date=" . date("j", mktime(0, 0, 0, $_GET['month'] - 1, ($sun_date + 7), $_GET['year'])); ?>">
                                                                <img style="border:0" src="images/next_month.gif" />
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </table>
                                        <br/>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table border="1" cellpadding="0" cellspacing="1" style="border-collapse:collapse;width:100%">
                            <tr class="topdays" > 
                                <td><div align="center" class="thead" >Sunday</div></td>
                                <td><div align="center" class="thead">Monday</div></td>
                                <td><div align="center" class="thead">Tuesday</div></td>
                                <td><div align="center" class="thead">Wednesday</div></td>
                                <td><div align="center" class="thead">Thursday</div></td>
                                <td><div align="center" class="thead">Friday</div></td>
                                <td><div align="center" class="thead">Saturday</div></td>
                            </tr>
                            <tr valign="" bgcolor="#FFFFFF"> 
                                <?php
                                if (!isset($_GET["sun_date"])) {
                                    for ($i = 1; $i <= $first_day_of_month - 1; $i++) {
                                        $days_so_far = $days_so_far + 1;
                                        $count_boxes = $count_boxes + 1;
                                        echo "<td width=\"100\" height=\"60\" class=\"beforedayboxes\"></td>\n";
                                    }
                                    for ($i = 1; $i <= $days_in_month; $i++) {
                                        $days_so_far = $days_so_far + 1;
                                        $count_boxes = $count_boxes + 1;
                                        $this_date = date("Y-m-d", mktime(0, 0, 0, $_GET['month'] - 1, $i, $_GET['year']));

                                        //if today then highight it
                                        $today = date("Y-m-d", time());
                                        if ($this_date == $today) {
                                            $today_style = "style='background:#F0F0F0'";
                                        } else {
                                            $today_style = "";
                                        }

                                        echo "<td " . $today_style . " width=\"100\" height=\"60\">\n";
                                        $sql = "select count(el.id) as s from employee_leave AS el
                                                JOIN employee AS e
                                                ON e.id = el.emp_id
                                                where el.request_status='Approved' " . $sqlAdd . " and 
                                                (el.from_date='" . $this_date . "' or el.to_date='" . $this_date . "' or (el.from_date<'" . $this_date . "' and el.to_date>'" . $this_date . "'))";
                                        $rs = mysql_query($sql);
                                        if ($rs && mysql_num_rows($rs) > 0) {
                                            $row = mysql_fetch_array($rs);
                                            $num_date = $row["s"];
											$c=$this_date;
                                            if ($num_date > 0) {
											   $is_saturday = date('l', strtotime($c)) == 'Saturday';
												$is_sunday = date('l', strtotime($c)) == 'Sunday';
												if($is_saturday!=true && $is_sunday!=true) {
                                                echo "<div class='bg cursor_pointer' align='right' onclick=\"show_emp(this,'$this_date')\"><span style='color:#0e52c9;font-weight:bold;'>\n<img style='width:11px' src='images/alert.png'>&nbsp;&nbsp;$num_date&nbsp;</span></div>\n";
												}
                                            } else {
                                                echo "<div align=\"right\" style='height:22px' >&nbsp;</div>\n";
                                            }
                                        } else {
                                            $num_date = "0";
                                        }

                                        $link_month = $_GET['month'] - 1;

                                        echo "<div align=\"center\"><span class=\"lbl\">\n$i&nbsp;</span></div>\n";
                                        echo "</td>\n";
                                        IF (($count_boxes == 7) AND ($days_so_far != (($first_day_of_month - 1) + $days_in_month))) {
                                            $count_boxes = 0;
                                            echo "</TR><TR valign=\"top\" bgcolor=\"#FFFFFF\">\n";
                                        }
                                    }
                                    $extra_boxes = 7 - $count_boxes;
                                    for ($i = 1; $i <= $extra_boxes; $i++) {
                                        echo "<td width=\"100\" height=\"100\" class=\"afterdayboxes\"></td>\n";
                                    }
                                    $time_end = getmicrotime();
                                    $time = round($time_end - $time_start, 3);
                                } else {
                                    create_date($sun_date, $_GET['month'] - 1, $_GET['year'], $igen_branchlist);
                                }

                                $d1 = date("Y-m-d", mktime(0, 0, 0, $_GET['month'] - 1, $sun_date, $_GET['year']));
                                $d2 = date("Y-m-d", mktime(0, 0, 0, $_GET['month'] - 1, $sun_date + 6, $_GET['year']));
                                ?>
                            </tr>
                        </table>
                        <br />
                        <?php
                        if (isset($_GET["sun_date"])) {
                            ?>
                            <table style="width:730px;border-collapse:collapse;border:5px solid #C4C4C7;">
                                <tr>
                                    <td colspan="5" style="padding: 5px;">Employees' Leaves from <b><?php echo $d1 ?></b> to <b><?php echo $d2 ?></b></td>
                                </tr>
                                <tr style="background-color: #2E4F9E; color: #ffffff;">
                                    <td style="padding-left:10px;"><b>No.</b></td>
                                    <td><b>Full Name</b></td>
                                    <td><b>From</b></td>
                                    <td><b>To</b></td>
                                    <td><b>Day(s)</b></td>
                                </tr>
                                <?php
                                $el_sql = "select * from employee_leave el join employee e on el.emp_id=e.id
                                           where request_status='Approved' and ((el.from_date>='" . $d1 . "' and el.from_date<='" . $d2 . "')
                                           or (el.to_date>='" . $d1 . "' and el.to_date<='" . $d2 . "')
                                           or (el.from_date<='" . $d1 . "' and el.to_date>='" . $d2 . "'))" . $sqlAdd;
                                //echo $el_sql;
                                $el_rs = mysql_query($el_sql);
                                $i = 1;
                                if ($el_rs && mysql_num_rows($el_rs) > 0) {
                                    while ($el_row = mysql_fetch_array($el_rs)) {
                                        ?>
                                        <tr>
                                            <td style="padding-left:10px;"><?php echo $i; ?></td>
                                            <td><?php echo $el_row["full_name"]; ?></td>
                                            <td><?php echo $el_row["from_date"]; ?></td>
                                            <td><?php echo $el_row["to_date"]; ?></td>
                                            <td><?php echo $el_row["num_days"]; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='5' align='center'>";
                                    echo "<div style='color:#C91715;font-weight:bold;padding:5px 0 5px 0'>No record found.</div>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        <?php } ?>
                    </td>
                    <td style="vertical-align: top; padding-left: 30px;">
                        <div id="show_all_emp" style="min-height:400px;"></div>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
<?php

function create_date($sun_date, $month, $year, $igen_branchlist) {
    if ($igen_branchlist != "") {
        $sqlAdd = ' AND e.branch_id IN (' . $igen_branchlist . ')';
    }
    $today = date("Y-m-d", time());
    for ($i = 0; $i < 7; $i++) {
        $this_date = date("Y-m-d", mktime(0, 0, 0, $_GET['month'] - 1, ($sun_date + $i), $_GET['year'])); //($sun_date+$i);
        if ($this_date == $today) {
            $today_style = "style='background:#F0F0F0'";
        } else {
            $today_style = "";
        }
        echo "<td " . $today_style . " width=\"100\" height=\"60\">\n";
        $sql = "select count(el.id) as s from employee_leave AS el
                JOIN employee AS e
                ON e.id=el.emp_id
                where el.request_status='Approved' 
                and (el.from_date='" . $this_date . "' or el.to_date='" . $this_date . "' or (el.from_date<'" . $this_date . "' and el.to_date>'" . $this_date . "'))"
                . $sqlAdd;
        $rs = mysql_query($sql);
        if ($rs && mysql_num_rows($rs) > 0) {
            $row = mysql_fetch_array($rs);
            $num_date = $row["s"];
            if ($num_date > 0) {
                echo "<div class='bg cursor_pointer' align='right' onclick=\"show_emp(this,'$this_date')\"><span style='color:#0e52c9;font-weight:bold;'>\n<img style='width:11px' src='images/alert.png'>&nbsp;&nbsp;$num_date&nbsp;</span></div>\n";
            } else {
                echo "<div align=\"right\" style='height:22px' >&nbsp;</div>\n";
            }
        } else {
            $num_date = "0";
        }
        echo "<div align=\"center\"><span class=\"lbl\">\n" . date("j", mktime(0, 0, 0, $month, ($sun_date + $i), $year)) . "&nbsp;</span></div>\n";
        echo "</td>\n";
    }
}

function get_sun_date($day, $date) {
    if ($day == 7) {
        return $date;
    } else if ($day < 7) {
        return $date - $day;
    }
}
?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>