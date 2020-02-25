<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

if ($_POST['type'] == 'OK') {
    $SQL = mysql_query('SELECT * FROM employee ORDER BY id DESC LIMIT 1 ;');
    $ROW = mysql_fetch_array($SQL);
    $id = $ROW['id'];
    $getPro = $_POST['checkBoxPro'];

    $proArray = explode(',', $getPro);

    $arrayUnique = array_unique($proArray);

    $numSingle = count($proArray);

    for ($i = 0; $i < $numSingle; $i++) {
        $queryOccupy = mysql_query('UPDATE property SET is_occupy = "N" WHERE id = ' . $proArray[$i]); //update the is_occupy attributes(The previous )
        $query2 = mysql_query('INSERT INTO employee_property(emp_id,property_id) VALUES(' . $id . ',"' . $proArray[$i] . '")'); //insert in to emp_property the new property + the previous property
        $queryOccupy2 = mysql_query('UPDATE property SET is_occupy = "Y" WHERE id = ' . $proArray[$i]);
    }

    if ($queryOccupy2) {
        print $id;
    } else {
        print false;
    }
} else {

    $sql = mysql_query('SELECT id FROM employee ORDER BY id DESC LIMIT 1');
    $rowID = mysql_fetch_array($sql);
    $id = $rowID['id'];

    if ($sql) {
        print $id;
    } else {
        print false;
    }
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