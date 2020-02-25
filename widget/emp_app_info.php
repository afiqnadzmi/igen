<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<style type="text/css">
    #emp_trans td{
        vertical-align: top;
        padding-bottom: 5px;
    }
    .title_bold{
        font-weight: bold;
    }
</style>
<?php

echo '<table id="emp_trans">';
$action = $_POST["action"];


if ($action == "claim") {

    $sql = 'SELECT * FROM employee_claim WHERE id = ' . $_POST["id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
    echo '<tr><td class="title_bold">Apply Date</td><td>' . date('d-m-Y',strtotime($row["insert_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold" style="width: 120px;">Claim Type</td><td>' . $row["claim_item_title"] . '</td></tr>';
    echo '<tr><td class="title_bold">Receipt Number</td><td>' . $row["claim_no"] . '</td></tr>';
    echo '<tr><td class="title_bold">Claim Date</td><td>' . date('d-m-Y',strtotime($row["claim_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold">Amount (RM)</td><td>' . number_format($row["amount"], 2, '.', '') . '</td></tr>';
    echo '<tr><td class="title_bold">Remark</td><td>' . $row["remark"] . '</td></tr>';
    echo '<tr><td class="title_bold">Status</td><td>' . $row["claim_status"] . '</td></tr>';
} elseif ($action == "leave") {

    $sql = 'SELECT el.*, lt.type_name FROM employee_leave AS el 
            INNER JOIN leave_type AS lt
            ON lt.id = el.leave_type_id
            WHERE el.id = ' . $_POST["id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
    echo '<tr><td class="title_bold">Apply Date</td><td>' . date('d-m-Y',strtotime($row["leave_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold" style="width: 120px;">From (Date)</td><td>' . date('d-m-Y',strtotime($row["from_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold">To (Date)</td><td>' . date('d-m-Y',strtotime($row["to_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold">No. of Day</td><td>' . $row["num_days"] . '</td></tr>';
    echo '<tr><td class="title_bold">Leave Type</td><td>' . $row["type_name"] . '</td></tr>';
    echo '<tr><td class="title_bold">Reason</td><td>' . $row["reason"] . '</td></tr>';
    echo '<tr><td class="title_bold">Status</td><td>' . $row["request_status"] . '</td></tr>';
} elseif ($action == "loan") {

    $sql = 'SELECT * FROM employee_loan WHERE id = ' . $_POST["id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
    echo '<tr><td class="title_bold">Apply Date</td><td>' . date('d-m-Y',strtotime($row["loan_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold" style="width: 160px;">Loan Type</td><td>' . $row["type_of_loan"] . '</td></tr>';
    echo '<tr><td class="title_bold">Loan Amount (RM)</td><td>' . number_format($row["loan_amount"], 2, '.', '') . '</td></tr>';
	echo '<tr><td class="title_bold">Loan Duration (RM)</td><td>' .date('d-m-Y',strtotime($row["start_date"]))." - ".date('d-m-Y',strtotime($row["end_date"])). '</td></tr>';
    echo '<tr><td class="title_bold">Installment (Month)</td><td>' . $row["rep_month"] . '</td></tr>';
    echo '<tr><td class="title_bold">Installment/Month (RM)</td><td>' . number_format($row["installment"], 2, '.', '') . '</td></tr>';
    echo '<tr><td class="title_bold">Reason</td><td>' . $row["reason_for_loan"] . '</td></tr>';
    echo '<tr><td class="title_bold">Status</td><td>' . $row["loan_status"] . '</td></tr>';
} elseif ($action == "training") {

    $sql = 'SELECT * FROM training WHERE id = ' . $_POST["id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);

    $sql1 = 'SELECT request_date, request_status 
             FROM employee_training
             WHERE training_id = ' . $row["id"] . ' AND employee_id = ' . $_COOKIE['igen_user_id'];
    $query1 = mysql_query($sql1);
    $row1 = mysql_fetch_array($query1);
    $num_rows1 = mysql_num_rows($query1);

    $request_status = $row1["request_status"];
    $request_date = $row1["request_date"];

    if ($num_rows1 == 0) {
        echo '<tr><td class="title_bold" style="width: 120px;">Traning Name</td><td>' . $row["training_name"] . '</td></tr>';
        echo '<tr><td class="title_bold">Description</td><td>' . $row["train_desc"] . '</td></tr>';
        echo '<tr><td class="title_bold">From - End (Date)</td><td>' . date('d-m-Y',strtotime($row["from_date"])) . ' - ' . date('d-m-Y',strtotime($row["to_date"])) . '</td></tr>';
        echo '<tr><td class="title_bold">Start - End (Time)</td><td>' . $row["start_time"] . ' - ' . $row["end_time"] . '</td></tr>';
        echo '<tr><td class="title_bold">Venue</td><td>' . $row["venue"] . '</td></tr>';
    } else {
        echo '<tr><td class="title_bold">Apply Date</td><td>' . date('d-m-Y',strtotime($request_date)) . '</td></tr>';
        echo '<tr><td class="title_bold" style="width: 120px;">Traning Name</td><td>' . $row["training_name"] . '</td></tr>';
        echo '<tr><td class="title_bold">Description</td><td>' . $row["train_desc"] . '</td></tr>';
        echo '<tr><td class="title_bold">From - End (Date)</td><td>' . date('d-m-Y',strtotime($row["from_date"])) . ' - ' . date('d-m-Y',strtotime($row["to_date"])) . '</td></tr>';
        echo '<tr><td class="title_bold">Start - End (Time)</td><td>' . $row["start_time"] . ' - ' . $row["end_time"] . '</td></tr>';
        echo '<tr><td class="title_bold">Venue</td><td>' . $row["venue"] . '</td></tr>';
        echo '<tr><td class="title_bold">Status</td><td>' . $request_status . '</td></tr>';
    }
} elseif ($action == "admin_loan") {

    $sql = 'SELECT * FROM employee_loan WHERE id = ' . $_POST["id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
    echo '<tr><td class="title_bold" style="width: 160px;">Loan Type</td><td>' . $row["type_of_loan"] . '</td></tr>';
    echo '<tr><td class="title_bold">Apply Date</td><td>' . $row["loan_date"] . '</td></tr>';
    echo '<tr><td class="title_bold">Loan Amount (RM)</td><td>' . number_format($row["loan_amount"], 2, '.', '') . '</td></tr>';
	echo '<tr><td class="title_bold">Loan Duration (RM)</td><td>' .date('d-m-Y',strtotime($row["start_date"]))." - ".date('d-m-Y',strtotime($row["end_date"])). '</td></tr>';
    echo '<tr><td class="title_bold">Installment (Month)</td><td>' . $row["rep_month"] . '</td></tr>';
    echo '<tr><td class="title_bold">Installment/Month (RM)</td><td>' . number_format($row["installment"], 2, '.', '') . '</td></tr>';
    echo '<tr><td class="title_bold">Reason</td><td>' . $row["reason_for_loan"] . '</td></tr>';
    echo '<tr><td class="title_bold">Status</td><td>Level 1: ' . $row["approval_1"] . '</td></tr>';
    echo '<tr><td class="title_bold"></td><td>Level 2: ' . $row["approval_2"] . '</td></tr>';
    echo '<tr><td class="title_bold"></td><td>Level 3: ' . $row["loan_status"] . '</td></tr>';
} elseif ($action == "admin_pro") {

    $sql = 'SELECT pc.name, p.property_name, p.specification, p.serial_no
            FROM employee_property AS ep
            INNER JOIN property AS p
            ON p.id = ep.property_id
            JOIN property_category AS pc
            ON pc.id = p.category_id
            WHERE ep.id = ' . $_POST["id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
    echo '<tr><td class="title_bold" style="width: 120px;">Property Category</td><td>' . $row["name"] . '</td></tr>';
    echo '<tr><td class="title_bold">Property Name</td><td>' . $row["property_name"] . '</td></tr>';
    echo '<tr><td class="title_bold">Serial No.</td><td>' . $row["serial_no"] . '</td></tr>';
    echo '<tr><td class="title_bold">Specification</td><td>' . $row["specification"] . '</td></tr>';
} elseif ($action == "admin_remark") {
 

    $sql = 'SELECT * FROM incident_detail WHERE id = ' . $_POST["id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
    echo '<tr><td class="title_bold" style="width: 120px;">Incident<font color="#E6E6E6">_</font>date<font color="#E6E6E6">_</font>and<font color="#E6E6E6">_</font>time</td><td>&nbsp&nbsp' . date('d-m-Y g:i:s',strtotime($row["datetime"])) . '</td></tr>';
    echo '<tr><td class="title_bold">Time<font color="#E6E6E6">_</font>start<font color="#E6E6E6">_</font>work</td><td>&nbsp&nbsp' . date('d-m-Y g:i:s',strtotime($row["date_time"])) . '</td></tr>';
    echo '<tr><td class="title_bold">Incident<font color="#E6E6E6">_</font>Description</td><td>&nbsp&nbsp' . $row["inc_desc"] . '</td></tr>';
	echo '<tr><td class="title_bold">Dangerous<font color="#E6E6E6">_</font>Occurrence</td><td>&nbsp&nbsp&nbsp' . $row["dangerous"] . '</td></tr>';
} elseif ($action == "admin_remark1") {
 

    $sql = 'SELECT * FROM injury_details WHERE id = ' . $_POST["id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);  
    echo '<tr><td class="title_bold" style="width: 120px;">Type<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Accident<font color="#E6E6E6">_</font>1</td><td>&nbsp&nbsp' . $row["accident1"] . '</td></tr>';
	echo '<tr><td class="title_bold" style="width: 120px;">Type<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Accident<font color="#E6E6E6">_</font>2</td><td>&nbsp&nbsp' . $row["accident2"] . '</td></tr>';
	echo '<tr><td class="title_bold" style="width: 120px;">Type<font color="#E6E6E6">_</font>of<font color="#E6E6E6">_</font>Injury</td><td>&nbsp&nbsp' . $row["t_injury"] . '</td></tr>';
    echo '<tr><td class="title_bold">Agent<font color="#E6E6E6">_</font>Causing<font color="#E6E6E6">_</font>Injury<font color="#E6E6E6">_</font>1</td><td>&nbsp&nbsp' . $row["a_c_injury"] . '</td></tr>';
	echo '<tr><td class="title_bold">Agent<font color="#E6E6E6">_</font>Causing<font color="#E6E6E6">_</font>Injury<font color="#E6E6E6">_</font>2</td><td>&nbsp&nbsp' . $row["a_c_injury1"] . '</td></tr>';
    echo '<tr><td class="title_bold">Injury<font color="#E6E6E6">_</font>Description</td><td>&nbsp&nbsp' . $row["i_desc"] . '</td></tr>';
} elseif ($action == "admin_claim") {

    $sql = 'SELECT e.full_name, ec.* FROM employee_claim AS ec
            INNER JOIN employee AS e
            ON e.id = ec.emp_id
            WHERE ec.id = ' . $_POST["id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
    echo '<tr><td class="title_bold" style="width: 120px;">Employee</td><td>' . $row["full_name"] . '</td></tr>';
    echo '<tr><td class="title_bold">Apply Date</td><td>' . date('d-m-Y',strtotime($row["insert_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold">Claim Title</td><td>' . $row["claim_item_title"] . '</td></tr>';
    echo '<tr><td class="title_bold">Claim Number</td><td>' . $row["claim_no"] . '</td></tr>';
    echo '<tr><td class="title_bold">Claim Date</td><td>' . date('d-m-Y',strtotime($row["claim_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold">Amount (RM)</td><td>' . number_format($row["amount"], 2, '.', '') . '</td></tr>';
    echo '<tr><td class="title_bold">Remark</td><td>' . $row["remark"] . '</td></tr>';

    if ($row["approval_1"] == "") {
        $approval1 = "Pending";
    } else {
        $approval1 = $row["approval_1"];
    }
    if ($row["approval_2"] == "") {
        $approval2 = "Pending";
    } else {
        $approval2 = $row["approval_2"];
    }
    if ($row["claim_status"] != "Pending") {
        echo '<tr><td class="title_bold">Status</td><td>' . $row["claim_status"] . '</td></tr>';
    } else {
        echo '<tr><td class="title_bold">Status</td><td>Level 1: ' . $approval1 . '</td></tr>';
        echo '<tr><td class="title_bold"></td><td>Level 2: ' . $approval2 . '</td></tr>';
        echo '<tr><td class="title_bold"></td><td>Level 3: ' . $row["claim_status"] . '</td></tr>';
    }
} elseif ($action == "admin_leave") {

    $sql = 'SELECT e.full_name, el.*, lt.type_name 
            FROM employee_leave AS el 
            INNER JOIN leave_type AS lt
            ON lt.id = el.leave_type_id
            JOIN employee AS e
            ON e.id = el.emp_id
            WHERE el.id = ' . $_POST["id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
    echo '<tr><td class="title_bold" style="width: 120px;">Employee</td><td>' . $row["full_name"] . '</td></tr>';
    echo '<tr><td class="title_bold">Apply Date</td><td>' . date('d-m-Y',strtotime($row["leave_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold">From (Date)</td><td>' . date('d-m-Y',strtotime($row["from_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold">To (Date)</td><td>' . date('d-m-Y',strtotime($row["to_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold">No. of Day</td><td>' . $row["num_days"] . '</td></tr>';
    echo '<tr><td class="title_bold">Leave Type</td><td>' . $row["type_name"] . '</td></tr>';
    echo '<tr><td class="title_bold">Reason</td><td>' . $row["reason"] . '</td></tr>';

    if ($row["approval_1"] == "") {
        $approval1 = "Pending";
    } else {
        $approval1 = $row["approval_1"];
    }
    if ($row["approval_2"] == "") {
        $approval2 = "Pending";
    } else {
        $approval2 = $row["approval_2"];
    }
    if ($row["request_status"] != "Pending") {
        echo '<tr><td class="title_bold">Status</td><td>' . $row["request_status"] . '</td></tr>';
    } else {
        echo '<tr><td class="title_bold">Status</td><td>Level 1: ' . $approval1 . '</td></tr>';
        echo '<tr><td class="title_bold"></td><td>Level 2: ' . $approval2 . '</td></tr>';
        echo '<tr><td class="title_bold"></td><td>Level 3: ' . $row["request_status"] . '</td></tr>';
    }
} elseif ($action == "admin_loan_emp") {

    $sql = 'SELECT emp.full_name, emp_l.*
            FROM employee AS emp
            INNER JOIN employee_loan AS emp_l
            ON emp.id = emp_l.emp_id
            WHERE emp_l.id = ' . $_POST["id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
    echo '<tr><td class="title_bold" style="width: 160px;">Employee</td><td>' . $row["full_name"] . '</td></tr>';
    echo '<tr><td class="title_bold">Apply Date</td><td>' . date('d-m-Y',strtotime($row["loan_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold">Loan Type</td><td>' . $row["type_of_loan"] . '</td></tr>';
    echo '<tr><td class="title_bold">Loan Amount (RM)</td><td>' . number_format($row["loan_amount"], 2, '.', '') . '</td></tr>';
	echo '<tr><td class="title_bold">Loan Duration (RM)</td><td>' .date('d-m-Y',strtotime($row["start_date"]))." - ".date('d-m-Y',strtotime($row["end_date"])). '</td></tr>';
    echo '<tr><td class="title_bold">Installment (Month)</td><td>' . $row["rep_month"] . '</td></tr>';
    echo '<tr><td class="title_bold">Installment/Month (RM)</td><td>' . number_format($row["installment"], 2, '.', '') . '</td></tr>';
    echo '<tr><td class="title_bold">Reason</td><td>' . $row["reason_for_loan"] . '</td></tr>';

    if ($row["approval_1"] == "") {
        $approval1 = "Pending";
    } else {
        $approval1 = $row["approval_1"];
    }
    if ($row["approval_2"] == "") {
        $approval2 = "Pending";
    } else {
        $approval2 = $row["approval_2"];
    }
    if ($row["loan_status"] != "Pending") {
        echo '<tr><td class="title_bold">Status</td><td>' . $row["loan_status"] . '</td></tr>';
    } else {
        echo '<tr><td class="title_bold">Status</td><td>Level 1: ' . $approval1 . '</td></tr>';
        echo '<tr><td class="title_bold"></td><td>Level 2: ' . $approval2 . '</td></tr>';
        echo '<tr><td class="title_bold"></td><td>Level 3: ' . $row["loan_status"] . '</td></tr>';
    }
} elseif ($action == "admin_training") {

    $sql = 'SELECT t.*, et.request_status, et.approval_1, et.approval_2, et.request_date, e.full_name FROM training AS t
            LEFT JOIN employee_training AS et
            ON t.id = et.training_id
            JOIN employee AS e
            ON e.id = et.employee_id
            WHERE et.id = ' . $_POST["id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);

    echo '<tr><td class="title_bold" style="width: 120px;">Employee</td><td>' . $row["full_name"] . '</td></tr>';
    echo '<tr><td class="title_bold">Apply Date</td><td>' . date('d-m-Y',strtotime($row["request_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold">Traning Name</td><td>' . $row["training_name"] . '</td></tr>';
    echo '<tr><td class="title_bold">Description</td><td>' . $row["train_desc"] . '</td></tr>';
    echo '<tr><td class="title_bold">From - End (Date)</td><td>' . date('d-m-Y',strtotime($row["from_date"])) . ' - ' . date('d-m-Y',strtotime($row["to_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold">Start - End (Time)</td><td>' . $row["start_time"] . ' - ' . $row["end_time"] . '</td></tr>';
    echo '<tr><td class="title_bold">Venue</td><td>' . $row["venue"] . '</td></tr>';

    if ($row["approval_1"] == "") {
        $approval1 = "Pending";
    } else {
        $approval1 = $row["approval_1"];
    }
    if ($row["approval_2"] == "") {
        $approval2 = "Pending";
    } else {
        $approval2 = $row["approval_2"];
    }
    if ($row["request_status"] != "Pending") {
        echo '<tr><td class="title_bold">Status</td><td>' . $row["request_status"] . '</td></tr>';
    } else {
        echo '<tr><td class="title_bold">Status</td><td>Level 1: ' . $approval1 . '</td></tr>';
        echo '<tr><td class="title_bold"></td><td>Level 2: ' . $approval2 . '</td></tr>';
        echo '<tr><td class="title_bold"></td><td>Level 3: ' . $row["request_status"] . '</td></tr>';
    }
} elseif ($action == "admin_replacement_emp") {

    $sql = 'SELECT hr.id as id, hr.*, e.id AS empid, replace_date,occasion_name,full_name,replacement_status,insert_date
            FROM holiday_replacement hr
            left join public_holiday ph on hr.pub_holiday_id=ph.id
            left join employee e on hr.emp_id=e.id
            WHERE hr.id = ' . $_POST["id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);

    echo '<tr><td class="title_bold" style="width: 140px;">Employee</td><td>' . $row["full_name"] . '</td></tr>';
    echo '<tr><td class="title_bold">Apply Date</td><td>' . date('d-m-Y',strtotime($row["insert_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold">Public Holiday</td><td>' . $row["occasion_name"] . '</td></tr>';
    echo '<tr><td class="title_bold">Replacement Date</td><td>' . date('d-m-Y',strtotime($row["replace_date"])) . '</td></tr>';

    if ($row["approval_1"] == "") {
        $approval1 = "Pending";
    } else {
        $approval1 = $row["approval_1"];
    }
    if ($row["approval_2"] == "") {
        $approval2 = "Pending";
    } else {
        $approval2 = $row["approval_2"];
    }
    if ($row["replacement_status"] != "Pending") {
        echo '<tr><td class="title_bold">Status</td><td>' . $row["replacement_status"] . '</td></tr>';
    } else {
        echo '<tr><td class="title_bold">Status</td><td>Level 1: ' . $approval1 . '</td></tr>';
        echo '<tr><td class="title_bold"></td><td>Level 2: ' . $approval2 . '</td></tr>';
        echo '<tr><td class="title_bold"></td><td>Level 3: ' . $row["replacement_status"] . '</td></tr>';
    }
} elseif ($action == "admin_overtime_emp") {

    $sql = 'SELECT emp.full_name, o.*
            FROM employee_overtime AS o 
            INNER JOIN employee AS emp
            ON emp.id=o.emp_id
            WHERE o.id = ' . $_POST["id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);

    $array_from = explode(":", $row["from_time"]);
    $array_to = explode(":", $row["to_time"]);
    if ($array_from[0] > 12) {

        $from_h1 = $array_from[0] - 12;
        $from_h = "" . $from_h1 . "";
        $f_time = "pm";
    } else {

        if ($array_from[0] >= 10) {
            $from_h = substr($array_from[0], 0);
        } else {
            $from_h = substr($array_from[0], 1);
        }
        $f_time = "am";
    }

    if ($array_to[0] > 12) {

        $to_h1 = $array_to[0] - 12;
        $to_h = "" . $to_h1 . "";
        $t_time = "pm";
    } else {

        if ($array_to[0] >= 10) {
            $to_h = substr($array_to[0], 0);
        } else {
            $to_h = substr($array_to[0], 1);
        }
        $t_time = "am";
    }

    $from_time1 = $from_h . ":" . $array_from[1] . " " . "$f_time";
    $to_time1 = $to_h . ":" . $array_to[1] . " " . "$t_time";

    echo '<tr><td class="title_bold" style="width: 140px;">Employee</td><td>' . $row["full_name"] . '</td></tr>';
    echo '<tr><td class="title_bold">Apply Date</td><td>' . date('d-m-Y',strtotime($row["request_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold">Overtime Date</td><td>' . date('d-m-Y',strtotime($row["ot_date"])) . '</td></tr>';
    echo '<tr><td class="title_bold">Overtime From</td><td>' . $from_time1 . '</td></tr>';
    echo '<tr><td class="title_bold">Overtime To</td><td>' . $to_time1 . '</td></tr>';
    echo '<tr><td class="title_bold">Total Minutes</td><td>' . $row["total_minutes"] . ' minutes</td></tr>';

    if ($row["approval_1"] == "") {
        $approval1 = "Pending";
    } else {
        $approval1 = $row["approval_1"];
    }
    if ($row["approval_2"] == "") {
        $approval2 = "Pending";
    } else {
        $approval2 = $row["approval_2"];
    }
    if ($row["ot_status"] != "Pending") {
        echo '<tr><td class="title_bold">Status</td><td>' . $row["ot_status"] . '</td></tr>';
    } else {
        echo '<tr><td class="title_bold">Status</td><td>Level 1: ' . $approval1 . '</td></tr>';
        echo '<tr><td class="title_bold"></td><td>Level 2: ' . $approval2 . '</td></tr>';
        echo '<tr><td class="title_bold"></td><td>Level 3: ' . $row["ot_status"] . '</td></tr>';
    }
}

echo '</table>';
?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>