<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$date = $_POST['date'];
$sql = "INSERT INTO advance_salary (advance_amount, emp_id, request_date) 
        VALUES ('" . $_POST['adv_amount'] . "','" . $_POST['emp_id'] . "','" . $date . "');";
$sql_result = mysql_query($sql);
if ($sql_result == 1) {

    echo'<table id="tableadvsal" border="0" style="width:100%; border-collapse: collapse;">
            <thead>
                <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th style="width: 150px;">Date</th>
                        <th style="width: 690px; padding-right: 10px; text-align: right;">Advance Amount (RM)</th>
                        <th class="aligncenter" style="width: 100px;">Action</th>
                </tr>
        </thead>';

    $sql1 = "SELECT * FROM advance_salary WHERE emp_id = '" . $_POST['emp_id'] . "';";
    $sql_result1 = mysql_query($sql1);
    $num = 0;
    while ($newArray = mysql_fetch_array($sql_result1)) {
        $num = $num + 1;
        echo"<tr class='plugintr'>
                    <td>" . $num . "</td>
                    <td>" . $newArray['request_date'] . "</td>
                    <td style='padding-right: 10px; text-align: right;'>" . $newArray['advance_amount'] . "</td>
                    <td class='aligncenter'><a href='javascript:onclick=del_advsal(" . $newArray['id'] . ")'>Delete</a></td>
                    </tr>";
    }

    echo'</table>';
} else {
    print false;
}
?>


<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tableadvsal').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );

</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>