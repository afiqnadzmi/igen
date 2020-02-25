<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$id = $_POST['id'];
$query1 = mysql_query('DELETE FROM employee_property WHERE emp_id = ' . $id . ';'); //delete current property of the employee

$checkBoxPro = $_POST['checkBoxPro']; //get the new assign plus the stored property
$getSingle = explode(',', $checkBoxPro); //get the new assign plus the stored property
$arrayUnique = array_unique($getSingle); //remove duplicate values
$numSingle = count($getSingle); //to get the length of the array

for ($i = 0; $i < $numSingle; $i++) {
    $queryOccupy = mysql_query('UPDATE property SET is_occupy = "N" WHERE id = ' . $getSingle[$i]); //update the is_occupy attributes(The previous )
    $query2 = mysql_query('INSERT INTO employee_property(emp_id,property_id) VALUES(' . $id . ',"' . $getSingle[$i] . '")'); //insert in to emp_property the new property + the previous property
    $queryOccupy2 = mysql_query('UPDATE property SET is_occupy = "Y" WHERE id = ' . $getSingle[$i]);
}

$queryPro = mysql_query('SELECT DISTINCT ep.id AS ep_id, p.id,p.property_name, p.serial_no, pc.name FROM employee_property AS ep
                                    INNER JOIN property AS p
                                    ON ep.property_id = p.id 
                                    JOIN property_category AS pc
                                    ON pc.id = p.category_id
                                    WHERE ep.emp_id=' . $id . ';');
if ($queryPro) {
    echo '<div class="pluginDiv" style="padding-bottom: 5px;"><input class="button" type="button" value="Add" onclick="loadPopupBox()"/></div>
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