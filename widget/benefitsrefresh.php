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


$checkBoxPro = $_POST['checkBoxPro']; //get the new assign plus the stored property
$getSingle = explode(',', $checkBoxPro); //get the new assign plus the stored property
$arrayUnique = array_unique($getSingle); //remove duplicate values
$numSingle = count($getSingle); //to get the length of the array

for ($i = 0; $i < $numSingle; $i++) {
	$query1 = mysql_query('DELETE FROM employee_benefits WHERE benefits_id="'.$getSingle[$i].'" and emp_id = ' . $id . ';'); //delete current property of the employee
    $query2 = mysql_query('INSERT INTO employee_benefits(emp_id,benefits_id) VALUES(' . $id . ',"' . $getSingle[$i] . '")'); //insert in to emp_property the new property + the previous property
}

$queryPro = mysql_query('SELECT b.name, b.description, eb.id as ebid from benefits b inner join employee_benefits eb on b.id=eb.benefits_id WHERE eb.emp_id=' . $id . ';');
if ($queryPro) {
    echo '<div class="pluginDiv" style="padding-bottom: 5px;"><input class="button" type="button" value="Add" onclick="loadBenPopupBox()"/></div>
        <table id="benefitsTable" class="TFtable dataTable" style="width:100%">
        <thead>
        <tr class="pluginth">
            <th style="width: 30px;">No.</th>
            <th style="width: 300px;">Name</th>
            <th style="width: 300px;">Description</th>
            <th class="aligncenter" style="width: 150px;">Action</th>
        </tr>
        </thead>';
    $num = 0;
    while ($rowPro = mysql_fetch_array($queryPro)) {
        $num = $num + 1;
       // $mouseover = 'class="cursor_pointer" onMouseover="emp_app_pro(' . $rowPro['ep_id'] . ')" onMouseout="emp_app_pro_hide()"';
        echo '<tr class="plugintr">
            <td>' . $num . '</td>
            <td >' . $rowPro['name'] . '</td>
            <td>' . $rowPro['description'] . '</td>
            <td class="aligncenter"><a onclick="returnBen(' . $rowPro['ebid'] . ')" style="cursor:pointer">Return</a></td>
            </tr>';
    }

    echo '</table>';
} else {
    print false;
}
?>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#benefitsTable').dataTable({
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