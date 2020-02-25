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
        <title>Employee Report</title>
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
        <p style="text-align: center;font-size:large;"><b>Employee Report</b></p>

        <table border="1" style="border-collapse:collapse;width:100%;">
            <tr class="tableth">
                <th>ID</th>
                <th>Name</th>
                <th>I.C.</th>
                <th>Position</th>
                <th>Join Date</th>
                <th>Status</th>
                <th>Mobile</th>
                <th>Salary</th>
				<!--
                <th>EPF</th>
				<th>Socso</th>
				<th>PCB</th> -->
            </tr>
            <?php
            if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
                $from = $_GET['from'];
                $to = $_GET['to'];

                $sql = "SELECT e.id AS eid, e.*, p.position_name FROM employee AS e 
                        INNER JOIN position AS p ON e.position_id = p.id 
                        WHERE e.join_date >= '" . $from . "' AND e.join_date <= '" . $to . "'";
                if (!empty($_GET["emp_id"])) {
                    $sql.=" and e.id in(" . $_GET["emp_id"] . ")";
                } else {
                    if ($_GET["dep_id"] == "0") {
                        $sql.=" AND e.branch_id = " . $_GET["branch_id"];
                    } else {
                        $sql.=" AND e.dep_id = " . $_GET["dep_id"];
                    }
                }
                if (!empty($_GET["status"])) {
                    $sql.=" AND e.emp_status = '" . $_GET["status"] . "'";
                }
                $sql.=" ORDER BY e.id";
                $sql_result = mysql_query($sql);
                if ($sql_result && mysql_num_rows($sql_result) > 0) {
                    while ($newArray = mysql_fetch_array($sql_result)) {
                        echo "<tr class='tabletr'>
                              <td>EMP" . str_pad($newArray['eid'], 6, "0", STR_PAD_LEFT) . "</td>
                              <td>" . $newArray['full_name'] . "</td>
                              <td>" . $newArray['ic'] . "</td>
                              <td>" . $newArray['position_name'] . "</td>
                              <td>" . $newArray['join_date'] . "</td>
                              <td>" . $newArray['emp_status'] . "</td>
                              <td>" . $newArray['mobile'] . "</td>
                              <td>" . number_format($newArray['salary'], 2) . "</td>
							 
                
                              </tr>";
                    }
                } else {
                    echo "<tr class='tabletr'>
                          <td colspan='6' style='text-align:center'>No record found.</td>
                          </tr>";
                }
            } else {
                $sql = "SELECT e.*, e.id AS eid, p.position_name FROM employee AS e 
                        INNER JOIN position AS p ON e.position_id = p.id";


                if (!empty($_GET["emp_id"]) && $_GET["emp_id"] != "all") {
                    $sql.=" and e.id in (" . $_GET["emp_id"] . ")";
                } else {
                    if ($_GET["dep_id"] == "0") {
                        $sql.=" AND e.branch_id = " . $_GET["branch_id"];
                    } else {
                        $sql.=" AND e.dep_id = " . $_GET["dep_id"];
                    }
                }
                if (!empty($_GET["status"])) {
                    $sql.=" AND e.emp_status = '" . $_GET["status"] . "'";
                }
                $sql.=" ORDER BY e.id";

                echo $sql;

                $sql_result = mysql_query($sql);
                if ($sql_result && mysql_num_rows($sql_result) > 0) {
                    while ($newArray = mysql_fetch_array($sql_result)) {
                        echo"<tr class='tabletr'>
                             <td>EMP" . str_pad($newArray['eid'], 6, "0", STR_PAD_LEFT) . "</td>
                             <td>" . $newArray['full_name'] . "</td>
                             <td>" . $newArray['ic'] . "</td>
                             <td>" . $newArray['position_name'] . "</td>
                             <td>" . $newArray['join_date'] . "</td>
                             <td>" . $newArray['emp_status'] . "</td>
                             <td>" . $newArray['mobile'] . "</td>
                             <td>" . number_format($newArray['salary'], 2) . "</td>
                             
                             </tr>";
                    }
                } else {
                    echo "<tr class='tabletr'>
			  <td colspan='9' style='text-align:center'>No record found.</td>
			  </tr>";
                }
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