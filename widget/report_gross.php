<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
include_once "app/test_jason.php";
include_once "app/test.php";
include_once "app/loh.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        $month = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Gross Pay Report For <?php echo $month[$_GET['month']] ?> <?php echo $_GET['year'] ?></title>
        <style type="text/css">
            .tableth th{
                background-color: black;
                color: white;
                padding-left: 10px;
                text-align: left;
                padding-top: 5px;
                padding-bottom: 2px;
            }
            .tabletr{
                background-color: white;
                color: black;
            }
            .tabletr td{
                padding-top: 5px;
                padding-bottom: 5px;
                padding-left: 10px;
            }
        </style>
    </head>
    <body>
        <p style="text-align: center;font-size:large;"><b>Gross Pay Report For <?php echo $month[$_GET['month']] ?> <?php echo $_GET['year'] ?></b></p>

        <table border="1" style="border-collapse:collapse;width:100%;">
            <tr class="tableth">
                <th>Employee</th>
                <th>Basic Salary (RM)</th>
                <th>Overtime (RM)</th>
                <th>Bonus (RM)</th>
                <th>Allowance (RM)</th>
                <th>Unpaid Leave (RM)</th>
                <th>Absent (RM)</th>
                <th>Loan (RM)</th>
                <th>Late In Early Out (RM)</th>
                <th>Advance Salary (RM)</th>
                <th>Gross Pay (RM)</th>
            </tr>
            <?php
            $month = $_GET['month'];
            $year = $_GET['year'];
            $chk_sql = 'SELECT id FROM payroll_finalised WHERE finalise_month=' . $month . ' AND finalise_year=' . $year;
            $chk_sql_result = mysql_query($chk_sql);
            if ($chk_sql_result && mysql_num_rows($chk_sql_result) > 0) {
                $chk_row = mysql_fetch_array($chk_sql_result);
                $fid = $chk_row["id"];
                $sql1 = "SELECT e.full_name,e.ic,e.epf_num,p.* FROM payroll_report AS p 
                         INNER JOIN employee AS e on e.id=p.emp_id
			 WHERE p.payroll_finalised_id=" . $fid;
                if (!empty($_GET["emp_id"])) {
                    $sql1.=" and p.emp_id in(" . $_GET["emp_id"] . ")";
                } else {
                    if ($_GET["dep_id"] == "0") {
                        $sql1.=" AND e.branch_id = " . $_GET["branch_id"];
                    } else {
                        $sql1.=" AND e.dep_id = " . $_GET["dep_id"];
                    }
                }
                if (!empty($_GET["status"])) {
                    $sql1.=" AND e.emp_status = '" . $_GET["status"] . "'";
                }
                $sql1.=" ORDER BY e.id";

                $sql_result = mysql_query($sql1);
                if ($sql_result && mysql_num_rows($sql_result) > 0) {
                    $basic_salary = 0;
                    $ot_amount = 0;
                    $bonus = 0;
                    $allowance = 0;
                    $unpaid_leave = 0;
                    $absent = 0;
                    $loan = 0;
                    $late_leave_time = 0;
                    $advance_salary = 0;
                    $gross_pay = 0;
                    while ($newArray = mysql_fetch_array($sql_result)) {
                        echo "<tr class='tabletr'>";
                        echo "<td>EMP" . str_pad($newArray['emp_id'], 6, "0", STR_PAD_LEFT) . " " . $newArray['full_name'] . "</td>";
                        echo "<td>" . $newArray['basic_salary'] . "</td>";
                        echo "<td>" . $newArray['ot_amount'] . "</td>";
                        echo "<td>" . $newArray['bonus'] . "</td>";
                        echo "<td>" . $newArray['allowance'] . "</td>";
                        echo "<td>" . $newArray['unpaid_leave'] . "</td>";
                        echo "<td>" . $newArray['absent'] . "</td>";
                        echo "<td>" . $newArray['loan'] . "</td>";
                        echo "<td>" . $newArray['late_leave_time'] . "</td>";
                        echo "<td>" . $newArray['advance_salary'] . "</td>";
                        echo "<td>" . $newArray['gross_pay'] . "</td>";
                        echo "</tr>";
                        $basic_salary+=$newArray['basic_salary'];
                        $ot_amount+=$newArray['ot_amount'];
                        $bonus+= $newArray['bonus'];
                        $allowance+= $newArray['allowance'];
                        $unpaid_leave+=$newArray['unpaid_leave'];
                        $absent+=$newArray['absent'];
                        $loan+=$newArray['loan'];
                        $late_leave_time+=$newArray['late_leave_time'];
                        $advance_salary+=$newArray['advance_salary'];
                        $gross_pay+=$newArray['gross_pay'];
                    }
                    echo "<tr class='tabletr' style='background-color:#E3E4FA'>";
                    echo "<td><b>Total</b>&nbsp;</td>";
                    echo "<td>" . number_format($basic_salary, 2) . "</td>";
                    echo "<td>" . number_format($ot_amount, 2) . "</td>";
                    echo "<td>" . number_format($bonus, 2) . "</td>";
                    echo "<td>" . number_format($allowance, 2) . "</td>";
                    echo "<td>" . number_format($unpaid_leave, 2) . "</td>";
                    echo "<td>" . number_format($absent, 2) . "</td>";
                    echo "<td>" . number_format($loan, 2) . "</td>";
                    echo "<td>" . number_format($late_leave_time, 2) . "</td>";
                    echo "<td>" . number_format($advance_salary, 2) . "</td>";
                    echo "<td>" . number_format($gross_pay, 2) . "</td>";
                    echo "</tr>";
                } else {
                    echo "<tr class='tabletr'>
                          <td colspan='11' style='text-align:center'>No record found.</td>
                          </tr>";
                }
            } else {
                echo "<tr class='tabletr'>
                      <td colspan='11' style='text-align:center'>No record found.</td>
                      </tr>";
            }
            ?>
        </table>
    </body>
</html>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>