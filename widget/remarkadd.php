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
$remarkType = $_POST['remarkType'];


$sql = "INSERT INTO employee_note(emp_id, note, note_date,type)
        VALUE('" . $_POST['userid'] . "','" . $_POST['note'] . "','" . $date . "','" . $remarkType . "');";
$sql_result = mysql_query($sql);
if ($sql_result == 1) {

    echo'<table id="tableRemark" style="width:100%;">
            <thead>
                <tr class="pluginth">
                    <th style="width: 30px;">No.</th>
                    <th style="width: 150px;">Date</th>
                    <th style="width: 200px;">Type</th>
                    <th style="width: 300px;">Note</th>
                    <th class="aligncenter" style="text-align:center; width: 150px;">Action</th>
                </tr>
        </thead>';
    $num = 0;
    $sql1 = "SELECT * FROM employee_note WHERE emp_id = '" . $_POST['userid'] . "';";
    $sql_result1 = mysql_query($sql1);
    while ($newArray = mysql_fetch_array($sql_result1)) {
        $num = $num + 1;
        $mouseover = 'class="cursor_pointer" onMouseover="emp_app_note(' . $newArray['id'] . ')" onMouseout="emp_app_note_hide()"';

        echo"<tr class='plugintr'>
                    <td>" . $num . "</td>
                    <td " . $mouseover . ">" . $newArray['note_date'] . "</td>
                    <td " . $mouseover . ">" . $newArray['type'] . "</td>
                    <td>" . substr($newArray['note'], 0, 50) . "</td>
                    <td class='aligncenter'><a href='javascript:onclick=del(" . $newArray['id'] . ")'>Delete</a></td>
                    </tr>";
    }

    echo'</table>';
} else {
    print false;
}
?>


<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tableRemark').dataTable({
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