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
$group_id = $_POST['group_id'];
$company_id = $_POST['company_id'];
$branch_name = $_POST['branch_name'];
$country = $_POST['country'];
$tel1 = $_POST['tel1'];
$tel2 = $_POST['tel2'];
$fax1 = $_POST['fax1'];
$fax2 = $_POST['fax2'];

$sql = "INSERT INTO branch (branch_code,address1,address2,postal_code,state,holi_group_id,company_id,branch_name,country,tel1,tel2,fax1,fax2)
        VALUES ('" . $branch_code . "','" . $add1 . "','" . $add2 . "','" . $postcode . "','" . $state . "','" . $group_id . "','" . $company_id . "',
        '" . $branch_name . "','" . $country . "','" . $tel1 . "','" . $tel2 . "','" . $fax1 . "','" . $fax2 . "')";
$query = mysql_query($sql);

if ($query) {
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