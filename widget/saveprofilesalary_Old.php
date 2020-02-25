<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$userID = $_POST['id'];

include 'app/view_old_new.php';

$date = date('Y-m-d');
$id = $_POST['id'];
$type = $_POST['type'];
$epf = $_POST['epf'];
$socso = $_POST['socso'];
$itax = $_POST['itax'];
$bankacc = $_POST['bankacc'];
$bank = $_POST['bank'];
$timeplan = $_POST['timeplan'];
$salary = number_format($_POST['salary'], 2, '.', '');
$contract = $_POST['contract'];
$overtime = $_POST['overtime'];
$position = $_POST['position'];

if ($_POST["zakat"] == "") {
    $zakat = 0;
} else {
    $zakat = number_format($_POST['zakat'], 2, '.', '');
}

$countedit = $totaledit - $saledit;

$salaryType = $_POST['salaryType'];

$sql_sal = 'SELECT salary FROM employee WHERE id=' . $id;
$query_sql = mysql_query($sql_sal);
$row_sal = mysql_fetch_array($query_sql);

$queryEDIT = mysql_query('UPDATE employee SET
                                    epf_num = "' . $epf . '",
                                    socso_num = "' . $socso . '",
                                    income_tax_num = "' . $itax . '",
                                    bank_acc_id = "' . $bank . '",
                                    bank_acc_num = "' . $bankacc . '",
                                    time_plan_id = "' . $timeplan . '",
                                    salary = "' . $salary . '",
                                    is_contract ="' . $contract . '",
                                    overtime_type= "' . $overtime . '",
                                    salary_type = "' . $salaryType . '",
                                    zakat = "' . $zakat . '"
                                    WHERE id=' . $id . ';');


if ($countedit > 0) {
    $queryUpdate = mysql_query('UPDATE employee_edit SET
                                    epf_num = "' . $epf . '",
                                    socso_num = "' . $socso . '",
                                    income_tax_num = "' . $itax . '",
                                    bank_acc_id = "' . $bank . '",
                                    bank_acc_num = "' . $bankacc . '",
                                    zakat = "' . $zakat . '"
                                    WHERE emp_id=' . $id . ';');
} else {
    $queryUpdate = mysql_query('DELETE FROM employee_edit WHERE emp_id = ' . $id . ';');
}

if ($row_sal["salary"] != $salary) {
    $sql = 'SELECT id FROM emp_promotion WHERE date_updated = "' . $date . '" AND emp_id =' . $id;
    $query = mysql_query($sql);
    $promo_num = mysql_num_rows($query);
    $row = mysql_fetch_array($query);

    $pro_id = $row["id"];

    if ($promo_num > 0) {
        $sql1 = 'UPDATE emp_promotion SET salary = ' . $salary . ' WHERE id = ' . $pro_id;
        $query1 = mysql_query($sql1);
    } else {
        $sqlInsert = mysql_query('INSERT INTO emp_promotion(emp_id,date_updated,position_id,salary)
                              VALUES(' . $id . ',"' . $date . '",' . $position . ',' . $salary . ')');
    }
}

if ($queryEDIT) {

    $query = mysql_query('SELECT * FROM employee WHERE id=' . $id . ';');
    $row = mysql_fetch_array($query);

    $queryJoin = mysql_query('SELECT e.bank_acc_id, b.code, b.name FROM employee AS e INNER JOIN bank AS b WHERE e.bank_acc_id=b.id AND e.id=' . $id . ';');
    $rowJoin = mysql_fetch_array($queryJoin);

    $sqlgetovertime = mysql_query('SELECT * FROM overtime WHERE id=' . $overtime . ';');
    $rowovertime = mysql_fetch_array($sqlgetovertime);



    echo '
         <table id="titlebar" style="width:95%;">
            <tr>
                <td style="font-size:large;font-weight: bold;">
                    &nbsp;&nbsp; Salary
                </td>
                <td onclick="editSal(' . $id . ')" id="editBut">Edit</td>
            </tr>
        </table>
        <div style="min-height:500px;">
            <table style="padding-top:20px;padding-left:20px">
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Under Contract</td>
                                <td style="padding-top:5px;">';
    if ($row['is_contract'] == 'N') {
        echo 'No';
    } else if ($row['is_contract'] == 'Y') {
        echo 'Yes';
    } else {
        echo '-';
    }
    echo '</td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Salary Type</td>
                                <td style="padding-top:5px">';
    if ($row['salary_type'] == "bs") {
        echo "Basic Salary";
    } elseif ($row['salary_type'] == "mn") {
        echo "Monthly";
    } elseif ($row['salary_type'] == "wk") {
        echo "Weekly";
    } elseif ($row['salary_type'] == "dy") {
        echo "Daily";
    } elseif ($row['salary_type'] == "hr") {
        echo "Hourly";
    }
    echo '</td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Salary Amount (RM)</td>
                                <td style="padding-top:5px"><input type="hidden" id="textsalary" value="' . $row['salary'] . '"/>' . number_format($row['salary'], 2, '.', '') . '</td>
                            </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Bank Type</td>
                            <td style="padding-top:5px;">';
    if ($rowJoin['bank_acc_id'] != 0) {
        echo $rowJoin["name"];
    } else {
        echo '-';
    }
    echo '</td>
                        </tr>
                        <tr>
                            <td style="padding-top:6px;width:200px">Bank Account Number</td>
                            <td style="padding-top:6px;">';
    if ($row['bank_acc_num'] != "") {
        echo $row['bank_acc_num'];
    } else {
        echo '-';
    }
    echo '</td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">EPF Number</td>
                            <td style="padding-top:5px">';
    if ($row['epf_num'] != "") {
        echo $row['epf_num'];
    } else {
        echo '-';
    }
    echo '</td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Socso Number</td>
                            <td style="padding-top:5px">';
    if ($row['socso_num'] != "") {
        echo $row['socso_num'];
    } else {
        echo '-';
    }
    echo '</td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Income Tax Number</td>
                            <td style="padding-top:5px">';
    if ($row['income_tax_num'] != "") {
        echo $row['income_tax_num'];
    } else {
        echo '-';
    }
    echo '</td>
                        </tr>
                        <tr>
                            <td style="padding-top:5px;width:200px;">Zakat (RM)</td>
                            <td style="padding-top:5px">';
    if ($row['zakat'] == "" || $row['zakat'] == 0) {
        echo "-";
    } else {
        echo number_format($row['zakat'], 2, '.', '');
    }
    echo '</td>
                        </tr>';

    $sqlgetovertime = mysql_query('SELECT e.overtime_type, o.overtime_name FROM overtime AS o INNER JOIN employee AS e ON e.overtime_type=o.id WHERE e.id=' . $userID . ';');
    $rowOT = mysql_fetch_array($sqlgetovertime);

    echo '<tr>
                            <td style="padding-top:5px;width:200px;">Overtime</td>
                            <td style="padding-top:5px">';

    if ($rowOT["overtime_type"] != 0) {
        echo $rowOT['overtime_name'];
    } else {
        echo '-';
    }
    echo '</td>
                            </tr>';

    echo '<tr>
                            <td style="padding-top:6px;">Salary History</td>
                            <td style="padding-top:6px;"><a class="blue" onclick="salaryhistory(' . $id . ')">View</a></td>
                            </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>';
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