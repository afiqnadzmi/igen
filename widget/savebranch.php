<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$branch_code = $_POST['branch_code'];
$add1 = $_POST['add1'];
$add2 = $_POST['add2'];
$postcode = $_POST['postcode'];
$state = $_POST['state'];
$bId = $_POST['bid'];
$grp_id = $_POST['group_id'];
$company_id = $_POST['company_id'];
$branch_name = $_POST['branch_name'];
$country = $_POST['country'];
$tel1 = $_POST['tel1'];
$tel2 = $_POST['tel2'];
$fax1 = $_POST['fax1'];
$fax2 = $_POST['fax2'];

$sql = 'UPDATE branch SET branch_code = "' . $branch_code . '",
        address1 = "' . $add1 . '",
        address2 = "' . $add2 . '",
        postal_code = "' . $postcode . '",
        state = "' . $state . '",
        holi_group_id = ' . $grp_id . ',
        company_id = ' . $company_id . ',
        branch_name = "' . $branch_name . '",
        country = "' . $country . '",
        tel1 = "' . $tel1 . '",
        tel2 = "' . $tel2 . '",
        fax1 = "' . $fax1 . '",
        fax2 = "' . $fax2 . '"
        WHERE id = ' . $bId;
$query = mysql_query($sql);

$query_update = mysql_query('UPDATE employee SET company_id = ' . $company_id . ' WHERE branch_id=' . $bId);
if ($query && $query_update) {
    print true;
} else {
    print false;
}
?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>