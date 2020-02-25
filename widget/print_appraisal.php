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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>iGEN HR & Payroll System - Performance Appraisal Form</title>
    </head>
    <body>
        <div style="padding: 0px 30px; width: 700px; height: 900px">
            <h1>iGEN Performance Appraisal Form</h1>
            <table border="2" style="width: 100%;border-collapse: collapse;">
                <tr>
                    <td style="font-weight: bold;padding-left: 10px;width:30px;">No.</td>
                    <td style="font-weight: bold;padding-left: 10px;">Question(s)</td>
                    <td style="font-weight: bold; text-align: center;width: 100px;">Rating</td>
                </tr>
                <?php
                $sql_result = mysql_query("SELECT * FROM performance_appraisal WHERE is_select = 1");
                $no = 1;
                while ($newArray = mysql_fetch_array($sql_result)) {
                    echo"<tr>
                         <td style='padding-left: 10px;'>" . $no . "</td>
                         <td style='padding-left: 10px;'>" . $newArray['question'] . "</td>
                         <td style='border-bottom: 2px solid black;text-align:center;'></td>";
                    echo "</tr>";
                    $no++;
                }
                ?>
            </table>

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