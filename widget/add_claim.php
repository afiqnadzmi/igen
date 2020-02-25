<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$sql = "INSERT INTO employee_claim (claim_item_title,claim_no,amount,claim_date,insert_date,remark,emp_id) VALUES 
       ('" . $_POST['claim_title'] . "','" . $_POST['claim_number'] . "','" . $_POST['claim_amount'] . "','" . $_POST['claim_date'] . "',
        '" . date('Y-m-d') . "','" . $_POST['claim_remark'] . "','" . $_POST['id'] . "')";
$query = mysql_query($sql);
$sql2 = "SELECT * FROM employee_claim WHERE emp_id = '" . $_POST['id'] . "'";
$sql_result2 = mysql_query($sql2);
if ($query) {
    echo '<table id="tableClaim" style="width:100%;">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th style="width: 150px;">Claim Title</th>
                        <th style="width: 100px;">Claim Number</th>
                        <th style="width: 100px;">Insert Date</th>
                        <th style="width: 100px;">Claim Date</th>
                        <th style="text-align: right; padding-right: 10px; width: 90px;">Amount (RM)</th>
                        <th style="width: 180px;">Remark</th>
                        <th class="aligncenter" style="width: 70px;">Action</th>
                    </tr>
                </thead>';
    $num = 0;
    while ($newArray2 = mysql_fetch_array($sql_result2)) {
        $num = $num + 1;
        echo '<tr class="plugintr">
                        <td>' . $num . '</td>
                        <td>' . $newArray2['claim_item_title'] . '</td>
                        <td >' . $newArray2['claim_no'] . '</td>
                        <td>' . $newArray2['insert_date'] . '</td>
                        <td>' . $newArray2['claim_date'] . '</td>
                        <td style="text-align: right; padding-right: 10px;">' . number_format($newArray2['amount'], 2, '.', '') . '</td>
                        <td>' . $newArray2['remark'] . '</td>
                        <td class="aligncenter"><a href="javascript:onclick=delclaim(' . $newArray2['id'] . ')">Delete</a></td>
                    </tr>';
    }
    echo '</table>';
}
?>

<script type="text/javascript" charset="utf-8">

    $(document).ready(function() {
        oTable = $('#tableClaim').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    });
</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>