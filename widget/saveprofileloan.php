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
$getselection = $_POST['selection'];

$getEach = explode(',', substr($getselection, 0, -1));
$rowGE = count($getEach);
for ($q = 0; $q < $rowGE; $q++) {
    $r = $q + 1;
    $sql = 'UPDATE employee_loan SET loan_status = "' . $getEach[$q] . '" WHERE id = ' . $getEach[$r];
    //echo $sql;
    $query = mysql_query($sql);
    $q++;
}

$sql1 = 'SELECT * FROM employee_loan WHERE emp_id = ' . $id;
$rs = mysql_query($sql1);

if ($rs) {
    echo '<div id="loanDiv" style="width:97%;border:solid;border-color:lightgrey;padding: 8px 10px 10px 10px;">
        <input type="button" class="button" onclick="editLoan()" value="Edit"/>
         <div style="padding-bottom:20px;width:1000px;">
                <table border="0" id="loantable" style="width:100%">
                        <thead>
                            <tr class="pluginth">
                                <th style="width:150px">Type of loan</th>
                                <th style="width:150px; text-align: right; padding-right: 10px;">Loan amount (RM)</th>
                                <th style="width:150px">Installment</th>
                                <th style="width:500px">Reason of loan</th>
                                <th style="width:150px">Status</th>
                            </tr>
                        </thead>';

    while ($row = mysql_fetch_array($rs)) {
        $type_of_loan = $row['type_of_loan'];
        $loan_amount = $row['loan_amount'];
        $installment = $row['installment'];
        $reason_for_loan = $row['reason_for_loan'];
        $loan_status = $row['loan_status'];

        echo'<tr>
                            <td style="width:150px">' . $type_of_loan . '</td>
                            <td style="width:150px">' . $loan_amount . '</td>
                            <td style="width:150px">' . $installment . '</td>
                            <td style="width:500px">' . $reason_for_loan . '</td>
                            <td style="width:150px">' . $loan_status . '</td>
                        </tr>';
    }

    echo '</table></div></div>';
} else {
    print false;
}
?>


<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#loantable').dataTable({
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