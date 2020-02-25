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
        <title>Claim Report For <?php echo $_GET['from'] ?> to <?php echo $_GET['to'] ?></title>
        <style type="text/css">
            .tableth th{
                /*    background-color:#F8F8F8;*/
                background-color: black;
                color: white;
                padding-left: 10px;
                text-align: left;
                padding-top: 5px;
                padding-bottom: 2px;
            }
            .tabletr{
                /*    background-color:#F8F8F8;*/
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
        <p style="text-align: center;font-size:large;"><b>Claim Report For <?php echo $_GET['from'] ?> to <?php echo $_GET['to'] ?></b></p>

        <table border="1" style="border-collapse:collapse;width:100%;">
            <tr class="tableth">
                <th>Employee</th>
                <th>Claim Name</th>
                <th>Claim Number</th>
				<th>Amount (RM)</th>
                <th>Claim Date</th>
                <th>Apply Date</th>
                <th>Reason</th>
            </tr>
            <?php
            $sql = "SELECT * FROM employee_claim AS e 
                    JOIN employee AS emp ON e.emp_id=emp.id
                    WHERE e.emp_id in(".$_GET["emp_id"].") AND e.claim_status = 'Approved' AND e.insert_date >= '" . $_GET['from'] . "' AND e.insert_date<= '" . $_GET['to'] . "'";

           
                if ($_GET["dep_id"] == "0") {
                    $sql.=" AND emp.branch_id=" . $_GET["branch_id"];
                } else {
                    $sql.=" AND emp.dep_id=" . $_GET["dep_id"];
                }
            
            if (!empty($_GET["status"])) {
                $sql.=" AND emp.emp_status = '" . $_GET["status"] . "'";
            }

            $sql.=" ORDER BY e.insert_date";

            $sql_result = mysql_query($sql);
            if ($sql_result && mysql_num_rows($sql_result) > 0) {
                while ($newArray = mysql_fetch_array($sql_result)) {
                    echo "<tr class='tabletr'>
                          <td>EMP" . str_pad($newArray['emp_id'], 6, "0", STR_PAD_LEFT) . " " . $newArray['full_name'] . "</td>
                          <td>" . $newArray['claim_item_title'] . "</td>
						  <td>" . $newArray['claim_no'] . "</td>
						  <td>" . $newArray['amount'] . "</td>
                          <td>" . $newArray['claim_date'] . "</td>
                          <td>" . $newArray['insert_date'] . "</td>
						  <td>" . $newArray['remark'] . "</td> 
			 
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