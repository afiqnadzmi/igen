<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$getID = $_POST['empid'];
$query = mysql_query('SELECT * FROM employee WHERE id=' . $getID . ';');
$row = mysql_fetch_array($query);
$sqlGetNew = mysql_query('SELECT * FROM employee_edit WHERE emp_id =' . $getID);
$rowGetNew = mysql_fetch_array($sqlGetNew);
$rowCount = mysql_num_rows($sqlGetNew);

$queryJoin = mysql_query('SELECT b.name FROM employee AS e INNER JOIN bank AS b WHERE e.bank_acc_id=b.id AND e.id=' . $getID . ';');
$rowJoin = mysql_fetch_array($queryJoin);

$userID = $getID;
include 'app/view_old_new.php';

if ($queryJoin) {
    echo '<table id="titlebar" style="width:98.5%; padding-right: 5px;">
                <tr>
                    <td style="font-size:large;font-weight: bold;">
                        &nbsp;&nbsp;&nbsp;Salary
                    </td>
                    <td onclick="editSal(' . $getID . ')" id="editBut">Edit</td>
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
        echo '';
    }

    echo'</td>
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
                            <td style="padding-top:5px;width:200px;">Payment Type</td>
                            <td style="padding-top:5px">';
								if ($row['payment_type'] != "0") {
									echo ucfirst($row['payment_type']);
								} else {
									echo '-';
								}
    echo '</td>
                        </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Bank Type</td>
                                <td style="padding-top:5px;color:' . $fontColorBank . '">';
    if ($bank != 0) {
        $sqlbank = mysql_query('SELECT name FROM bank WHERE id=' . $bank);
        $rowbank = mysql_fetch_array($sqlbank);
        echo $rowbank['name'];
    } else {
        echo '-';
    }
    echo '</td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;width:200px">Bank Account Number</td>
                                <td style="padding-top:6px;color:' . $fontColorBankNum . '"">';
    if ($bankNum != "") {
        echo $bankNum;
    } else {
        echo '-';
    }
    echo '</td>
                            </tr>';

    echo '<tr>
                                <td style="padding-top:5px;width:200px;">EPF Number</td>
                                <td style="padding-top:5px;color:' . $fontColorEpf . '">';
    if ($epf != "") {
        echo $epf;
    } else {
        echo '-';
    }
    echo '</td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Socso Number</td>
                                <td style="padding-top:5px;color:' . $fontColorSocso . '">';
    if ($socso != "") {
        echo $socso;
    } else {
        echo '-';
    }
    echo '</td>
                            </tr>
                            <tr>
                                <td style="padding-top:5px;width:200px;">Income Tax Number</td>
                                <td style="padding-top:5px;color:' . $fontColorItax . '">';

    if ($iTax != "") {
        echo $iTax;
    } else {
        echo '-';
    }
    echo '</td>
                            </tr>';

    $sqlgetovertime = mysql_query('SELECT e.overtime_type, o.overtime_name FROM overtime AS o INNER JOIN employee AS e ON e.overtime_type=o.id WHERE e.id=' . $getID . ';');
    $rowOT = mysql_fetch_array($sqlgetovertime);

    echo '<tr>
            <td style="padding-top:5px;width:200px;">Zakat (RM)</td>
            <td style="padding-top:5px;color:' . $fontColorZakat . '">';
    if ($zakat == "" || $zakat == 0) {
        echo "-";
    } else {
        echo number_format($zakat, 2, '.', '');
    }
    echo '</td>
          </tr>
          <tr>
            <td style="padding-top:5px;width:200px;">Overtime</td>
            <td style="padding-top:5px">';
    if ($rowOT['overtime_type'] != 0) {
        echo $rowOT['overtime_name'];
    } else {
        echo '-';
    }
    echo '</td>
          </tr>';

    echo '<tr>
                                <td style="padding-top:6px;">Salary History</td>
                                <td style="padding-top:6px;"><a class="blue" onclick="salaryhistory(' . $getID . ')">View</a></td>
                            </tr>
                            <tr>
                                <td style="padding-top:6px;">Payslip History</td>
                                <td style="padding-top:6px;"><a class="blue" onclick="paysliphistory()">View</a></td>
                            </tr>';
    echo '</table>
                    </td>
                </tr>
            </table>';
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