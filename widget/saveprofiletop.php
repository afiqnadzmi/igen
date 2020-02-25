<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$userID = $_POST['userID'];

include 'app/view_old_new.php';
if($_COOKIE["igen_id"]==""){
	$user_id = $_COOKIE["igen_user_id"];
}else{
	$user_id = $_COOKIE["igen_id"];
}


					 
$date = date('Y-m-d');
$name = $_POST['name'];
$group = $_POST['group'];
$username = $_POST['username'];
$dept = $_POST['dept'];
$level = $_POST['level'];
$type = $_POST['type'];
$position = $_POST['position'];
$company = $_POST['company'];
$branch = $_POST['branch'];
$salary = $_POST['salary'];
$shift = $_POST['shift'];
$status = $_POST['status'];
$country =$_POST['country'];
$last_working_day = "";
$last_working_day = "";
$reasnresign = "";
$resigndate ="";
if($status=="Resigned"){
	$last_working_day = date("Y-m-d", strtotime($_POST['last_working_day']));
	$last_official_day = date("Y-m-d", strtotime($_POST['last_official_day']));
	$reasnresign = $_POST['reasnresign'];
	$resigndate =date("Y-m-d", strtotime($_POST['resigndate']));
}

$countedit = $totaledit - $topedit;

//Record status changes;
if($status!=$rowGetOld['emp_status']){
$sql2 = "INSERT INTO resign_history(emp_id, status, resign_reason, date, updated_by)
					 VALUES ('" . $userID . "','" . $status . "','" . $reasnresign . "','" . $date . "','" . $user_id . "')";
$rs1 = mysql_query($sql2);
}

$query = mysql_query('UPDATE employee SET
                            full_name = "' . $name . '",
							is_contract = "' . $type . '",
                            group_id = "' . $group . '",
                            position_id = "' . $position . '",
							country = "' . $country . '",
                            dep_id = "' . $dept . '",
                            shift_id = "' . $shift . '",
                            branch_id = "' . $branch . '",
                            level_id = "' . $level . '",
                            company_id = "' . $company . '",
							resign_date = "' . $resigndate . '",
							last_working_day = "' . $last_working_day . '",
							officail_working_day = "' . $last_official_day . '",
							reasign_reason = "' . $reasnresign . '",
                            emp_status= "' . $status . '"
                            WHERE id = ' . $userID . ';');

if ($countedit > 0) {
    $queryTemp = mysql_query('UPDATE employee_edit SET full_name = "' . $name . '" WHERE emp_id = ' . $userID . ';');
} else {
    $queryTemp = mysql_query('DELETE FROM employee_edit WHERE emp_id = ' . $userID . ';');
}

$sql = 'SELECT id, position_id FROM emp_promotion WHERE date_updated = "' . $date . '" AND emp_id = ' . $userID;
$query = mysql_query($sql);
$promo_num = mysql_num_rows($query);
$row = mysql_fetch_array($query);

$pro_id = $row["id"];

if ($promo_num > 0) {
    $sql1 = 'UPDATE emp_promotion SET position_id = ' . $position . ' WHERE id = ' . $pro_id;
    $query1 = mysql_query($sql1);
} else {
    $sqlInsert = mysql_query('INSERT INTO emp_promotion(emp_id,date_updated,position_id,salary)
                              VALUES(' . $userID . ',"' . $date . '",' . $position . ',' . $salary . ')');
}

if ($query) {
    $query = mysql_query('SELECT * FROM employee WHERE id=' . $userID . ';');
    $row = mysql_fetch_array($query);
    $queryDept = mysql_query('SELECT d.dep_name FROM department AS d INNER JOIN emp_group AS eg JOIN employee AS e ON d.id=eg.dep_id AND e.group_id = eg.id WHERE e.id = ' . $userID . ';');
    $rowDept = mysql_fetch_array($queryDept);

    $queryGroup = mysql_query('SELECT g.group_name FROM emp_group AS g INNER JOIN employee AS e ON g.id = e.group_id WHERE e.id=' . $userID . ';');
    $rowGroup = mysql_fetch_array($queryGroup);

    $queryLevel = mysql_query('SELECT l.name FROM level AS l INNER JOIN employee AS e ON l.id = e.level_id WHERE e.id = ' . $userID . ';');
    $rowLevel = mysql_fetch_array($queryLevel);

    $queryPos = mysql_query('SELECT p.position_name FROM position AS p INNER JOIN employee AS e ON p.id = e.position_id WHERE e.id = ' . $userID . ';');
    $rowPos = mysql_fetch_array($queryPos);

    $queryBranch = mysql_query('SELECT b.branch_code FROM branch AS b INNER JOIN employee AS e ON b.id = e.branch_id WHERE e.id = ' . $userID . ';');
    $rowBranch = mysql_fetch_array($queryBranch);

    $queryCompany = mysql_query('SELECT c.code FROM company AS c INNER JOIN employee AS e ON c.id = e.company_id WHERE e.id = ' . $userID . ';');
    $rowCompany = mysql_fetch_array($queryCompany);

    $sqlShift = "SELECT s.name as name FROM employee e
					left join shift s
					on e.shift_id=s.id where e.id=" . $userID . " limit 1";
    $rsShift = mysql_query($sqlShift);
    $rowShift = mysql_fetch_array($rsShift);


    echo '<div style="padding-top:20px">
            <table id="titlebar" style="width:98%; padding-right: 5px;">
                <tr>
                    <td style="font-size:large;font-weight: bold;">
                        &nbsp;&nbsp;&nbsp;Employee Details
                    </td>
                    <td onclick="editTop()" id="editBut">Edit</td>
                    <td onclick="back()" id="editBut">Back</td>
                </tr>
            </table>
        </div>';
    $new_id = 'EMP' . str_pad($userID, 6, "0", STR_PAD_LEFT);
	
    echo '
	<div style="margin-bottom:-3%">
	<table style="padding-top:20px;padding-left:20px;">
            <tr>
                <td style="padding-top:5px;width:200px;">Employee ID</td>
                <td style="padding-top:5px">' . $new_id . '</td>
            </tr> 
            <tr>
                <td style="padding-top:5px;width:200px;">Full Name</td>
                <td style="padding-top:5px">' . $row['full_name'] . '</td>
            </tr>
			<tr>
                <td style="padding-top:5px;width:200px;">Nationality</td>
                <td style="padding-top:5px">' . $row['country'] . '</td>
            </tr>
            <tr>
                <td style="padding-top:5px;width:200px;">Status</td>
                <td style="padding-top:5px;">' . $row["emp_status"] . '</td>
            </tr>
			<tr>
                <td style="padding-top:5px;width:200px;">Permanent</td>
                <td style="padding-top:5px;">' . $row["is_contract"] . '</td>
            </tr>
            <tr>
                <td style="padding-top:5px;width:200px;">Company</td>
                <td style="padding-top:5px">' . $rowCompany['code'] . '</td>
            </tr>
            <tr>
                <td style="padding-top:5px;width:200px;">Branch</td>
                <td style="padding-top:5px">' . $rowBranch['branch_code'] . '</td>
            </tr>
            <tr>
                <td style="padding-top:5px;width:200px;">Department</td>
                <td style="padding-top:5px">' . $rowDept['dep_name'] . '</td>
            </tr>
            <tr>
                <td style="padding-top:5px;width:200px;">Group</td>
                <td style="padding-top:5px">' . $rowGroup['group_name'] . '</td>
            </tr>
            <tr>
                <td style="padding-top:5px;width:200px;">Position</td>
                <td style="padding-top:5px"><input type="hidden" id="droppos" value="' . $rowPos['position_name'] . '" />' . $rowPos['position_name'] . '</td>
            </tr>
            <tr>
                <td style="padding-top:5px;width:200px;">Shift </td>
		<td style="padding-top:5px">' . $rowShift['name'] . '</td>
            </tr>
            <tr>
                <td style="padding-top:5px;width:200px;">User Permission</td>
                <td style="padding-top:5px">';
    $sql_up = 'SELECT name FROM user_permission WHERE id = ' . $row['level_id'];
    $query_up = mysql_query($sql_up);
    $row_up = mysql_fetch_array($query_up);
    echo $row_up['name'];
    echo '</td></td>
            </tr>
        </table></div>';
} else {
    print false;
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