<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$checkBoxPro = $_POST['selected'];
$getSingle = explode(',', $checkBoxPro);
$numSingle = count($getSingle);
$num = 0;

$sql_result1 = mysql_query("DELETE FROM employee_allowance WHERE emp_id='" . $_POST['id'] . "'");

for ($i = 0; $i < $numSingle; $i++) {
    $sql_result = mysql_query('INSERT INTO employee_allowance(allowance_id, emp_id) VALUES("' . $getSingle[$i] . '","' . $_POST['id'] . '");');
    $j = 1;
}

if ($j == 1) {
    echo'<input class="button" type="button" value="Add" onclick="addAllowance()"/>
            <table id="tableAllowance" border="0" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr class="pluginth">
                        <th style="width:10%;">No.</th>
                        <th style="width:50%;">Allowance Type</th>
                        <th style="width:40%;">Amount (RM)</th>
                    </tr>
                </thead>';

    $sql1 = "SELECT a.allowance_name, a.allowance_amount
                    FROM employee_allowance AS e
                    INNER JOIN 	allowance AS a
                    on e.allowance_id = a.id
                    WHERE emp_id = '" . $_POST['id'] . "';";
    $sql_result1 = mysql_query($sql1);
    while ($newArray = mysql_fetch_array($sql_result1)) {
        $num = $num + 1;
        echo"<tr class='plugintr'>
                            <td style= 'width:10%;'>" . $num . "</td>
                        <td>" . $newArray['allowance_name'] . "</td>
                        <td>" . $newArray['allowance_amount'] . "</td>
                    </tr>";
    }

    echo'</table>';
} else {
    print false;
}
?>

<script type="text/javascript" charset="utf-8">

    $(document).ready(function() {
        oTable = $('#tableAllowance').dataTable({
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