<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
if (isset($_POST['id']) == true) { //for the edit_profile(assigning new property for employee)
    $Pid = $_POST['id'];
    $userID = $_POST['userID'];

    $queryRemove = mysql_query('DELETE FROM employee_property WHERE property_id=' . $Pid);
    $queryUpdate = mysql_query('UPDATE property SET is_occupy ="N" WHERE id =' . $Pid);


    $queryPro = mysql_query('SELECT DISTINCT ep.id AS ep_id, p.id, p.property_name, pc.name, p.serial_no FROM employee_property AS ep
                                    INNER JOIN property AS p
                                    ON ep.property_id = p.id 
                                    JOIN property_category AS pc
                                    ON pc.id = p.category_id
                                    WHERE ep.emp_id=' . $userID . ';');
    if ($queryPro) {

        echo '<div style="padding-bottom: 5px;"><input class="button" type="button" value="Add" onclick="loadPopupBox()"/></div>
            <table id="propertyTable" style="width:100%">
            <thead>
            <tr class="pluginth">
                <th style="width: 30px;">No.</th>
                <th style="width: 300px;">Property Category</th>
                <th style="width: 300px;">Property Name</th>
                <th style="width: 200px;">Serial No.</th>
                <th class="aligncenter" style="width: 150px;">Action</th>
            </tr>
        </thead>';
        $num = 0;
        while ($rowPro = mysql_fetch_array($queryPro)) {
            $num = $num + 1;
            $mouseover = 'class="cursor_pointer" onMouseover="emp_app_pro(' . $rowPro['ep_id'] . ')" onMouseout="emp_app_pro_hide()"';
            echo '<tr class="plugintr">
                <td>' . $num . '</td>
                <td ' . $mouseover . '>' . $rowPro['name'] . '</td>
                <td ' . $mouseover . '>' . $rowPro['property_name'] . '</td>
                <td>' . $rowPro['serial_no'] . '</td>
                <td class="aligncenter"><a onclick="returnPro(' . $rowPro['id'] . ')" style="cursor:pointer">Return</a></td>
                </tr>';
        }

        echo '</table>';
    } else {
        print false;
    }
}
?>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#propertyTable').dataTable({
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