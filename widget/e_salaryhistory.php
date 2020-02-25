<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
if (isset($_COOKIE["igen_user_id"]) == true) {
    $sql = 'SELECT * FROM employee WHERE id=' . $_COOKIE["igen_user_id"];
    $query = mysql_query($sql);
    $row = mysql_fetch_array($query);
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Salary History for <?php echo $row["full_name"] ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <style>
            .tableth th
            {
                /*    background-color:#F8F8F8;*/
                background-color: darkblue;
                color: white;
                padding: 5px 0 5px 10px;
                text-align: left;
            }
            .tabletr
            {
                /*    background-color:#F8F8F8;*/
                background-color: beige;
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
        <div style="padding: 10px; width: 560px;">
            <div>
                <span style="font-weight: bold; ">Salary History for <?php echo $row["full_name"] ?></span>
            </div>
            <div style="border: 1px solid black; margin-top: 15px;">
                <table style="border-collapse: collapse;width: 100%; font-size: 13px;">
                    <tr class="tableth">
                        <th style='width: 100px;'>Date</th>
                        <th>Position</th>
                        <th class="alignrighttable" style='width: 150px;'>Salary (RM)</th>
                    </tr>
                    <?php
                    $sql = 'SELECT ep.date_updated, p.position_name, ep.salary FROM emp_promotion AS ep
                        INNER JOIN position AS p
                        ON p.id = ep.position_id
                        WHERE ep.emp_id = ' . $_COOKIE["igen_user_id"];
                    $sql_result = mysql_query($sql);
                    while ($row = mysql_fetch_array($sql_result)) {

                        echo "<tr class='tabletr'>
                <td>" . $row['date_updated'] . "</td>
                <td>" . $row['position_name'] . " </td> 
                <td class='alignrighttable'>" . number_format($row['salary'], 2, '.', '') . " </td> 
                </tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
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