<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$sql2 = "SELECT * FROM employee WHERE id = '" . $getID . "';";
$sql_result2 = mysql_query($sql2);
while ($newArray2 = mysql_fetch_array($sql_result2)) {
    $basic_salary = $newArray2['salary'];
}
?>    
<div style="padding-bottom: 5px;">
    <div id="tableLeave" style="width:97%;border:solid;border-color:lightgrey;padding: 8px 10px 10px 10px;">
        <table id="eadvsaltable" class="TFtable" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr class="pluginth">
                    <th style="width: 5px;">No.</th>
                    <th style="width: 150px;">Date</th>
                    <th style="width: 200px; padding-right: 10px;">Advance Amount (RM)</th>
                </tr>
            </thead>            

            <?php
            $sql1 = "SELECT * FROM advance_salary WHERE emp_id = '" . $getID . "';";
            $sql_result1 = mysql_query($sql1);
            while ($newArray = mysql_fetch_array($sql_result1)) {
                $i = $i + 1;
                ?><tr class="plugintr">
                    <td style="width:5px"><?php echo $i ?></td>
                    <td><?php echo $newArray['request_date'] ?></td>
                    <td style="padding-right: 10px;"><?php echo number_format($newArray['advance_amount'], 2, '.', '') ?></td>
                </tr>
            <?php } ?>

        </table>
    </div>
</div>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>