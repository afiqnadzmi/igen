<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php
        $month = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>EPF Report For <?php echo $month[$_GET['month']] ?> <?php echo $_GET['year'] ?></title>
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
        <p style="text-align: center;font-size:large;"><b>EPF Report For <?php echo $month[$_GET['month']] ?> <?php echo $_GET['year'] ?></b></p>

        <table border="1" style="border-collapse:collapse;width:100%;">
            <tr class="tableth">
                <th>Employee</th>
                <th>I.C.</th>
                <th>EPF Number</th>
                <th>Basic Salary (RM)</th>
                <th>Allowance & Bonus (RM)</th>
                <th>EPF (RM)</th>
                <th>Employer EPF (RM)</th>
            </tr>
            <?php
            $month = $_GET['month'];
            $year = $_GET['year'];
            $chk_sql = 'SELECT id FROM payroll_finalised WHERE finalise_month=' . $month . ' AND finalise_year=' . $year;
            $chk_sql_result = mysql_query($chk_sql);
            if ($chk_sql_result && mysql_num_rows($chk_sql_result) > 0) {
                $chk_row = mysql_fetch_array($chk_sql_result);
                $fid = $chk_row["id"];
                $sql1 = "SELECT e.full_name,e.ic,e.epf_num,p.* 
                        FROM payroll_report AS p 
                        INNER JOIN employee AS e on e.id=p.emp_id
                        WHERE p.payroll_finalised_id=" . $fid;
                if (!empty($_GET["emp_id"])) {
                    $sql1.=" and p.emp_id IN (" . $_GET["emp_id"] . ")";
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

                $basic_salary = 0;
                $allowance = 0;
                $epf = 0;
                $employer_epf = 0;

                $sql_result = mysql_query($sql1);
                if ($sql_result && mysql_num_rows($sql_result) > 0) {
                    while ($newArray = mysql_fetch_array($sql_result)) {
                        echo "<tr class='tabletr'>
                              <td>EMP" . str_pad($newArray['emp_id'], 6, "0", STR_PAD_LEFT) . " " . $newArray['full_name'] . "</td>
			      <td>" . $newArray['ic'] . "</td>";
                        echo "<td>" . $newArray['epf_num'] . "</td>";
                        echo "<td>" . $newArray['basic_salary'] . "</td>";
                        echo "<td>" . ((float) $newArray['allowance'] + (float) $newArray['bonus']) . "</td>";
                        echo "<td>" . $newArray['epf'] . "</td>";
                        echo "<td>" . $newArray['employer_epf'] . "</td>";
                        echo "</tr>";
                        $basic_salary+=$newArray['basic_salary'];
                        $allowance+=$newArray['allowance'];
                        $epf+=$newArray['epf'];
                        $employer_epf += $newArray['employer_epf'];
                    }
                    echo "<tr class='tabletr' style='background-color:#E3E4FA'>";
                    echo "<td><b>Total</b></td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td>" . number_format($basic_salary, 2) . "</td>";
                    echo "<td>" . number_format($allowance, 2) . "</td>";
                    echo "<td>" . number_format($epf, 2) . "</td>";
                    echo "<td>" . number_format($employer_epf, 2) . "</td>";
                    echo "</tr>";
                } else {
                    echo "<tr class='tabletr'>
                          <td colspan='6' style='text-align:center'>No record found.</td>
                          </tr>";
                }
            } else {
                echo "<tr class='tabletr'>
                      <td colspan='6' style='text-align:center'>No record found.</td>
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