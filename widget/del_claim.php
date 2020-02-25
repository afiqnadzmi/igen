<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$sql = "DELETE FROM employee_claim WHERE id=" . $_POST['id'];
$query = mysql_query($sql);
$sql3 = "SELECT * FROM employee_claim WHERE emp_id = '" . $_POST['empid'] . "'";
$sql_result3 = mysql_query($sql3);
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
    while ($newArray3 = mysql_fetch_array($sql_result3)) {
        $num = $num + 1;
        echo '<tr class="plugintr">
                        <td>' . $num . '</td>
                        <td>' . $newArray3['claim_item_title'] . '</td>
                        <td >' . $newArray3['claim_no'] . '</td>
                        <td>' . $newArray3['insert_date'] . '</td>
                        <td>' . $newArray3['claim_date'] . '</td>
                        <td style="text-align: right; padding-right: 10px;">' . number_format($newArray3['amount'], 2, '.', '') . '</td>
                        <td>' . $newArray3['remark'] . '</td>
                        <td class="aligncenter"><a href="javascript:onclick=delclaim(' . $newArray3['id'] . ')">Delete</a></td>
                    </tr>';
    }
    echo '</table>';
} else {
    print false;
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