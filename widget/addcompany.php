<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$action = $_POST["action"];

if ($action == "add") {
    if ($_POST["is_default"] == "1") {
        $query_default = mysql_query('UPDATE company SET is_default = 0');
    }
    $sql = 'INSERT INTO company (code, name, reg_no, is_default, website,income_tax_no) VALUES ("' . $_POST["company_code"] . '","' . $_POST["company_name"] . '","' . $_POST["reg_no"] . '",' . $_POST["is_default"] . ',"' . $_POST["website"] . '","' . $_POST['income_tax'] . '")';
    $query = mysql_query($sql);
} elseif ($action == "edit") {
    if ($_POST["is_default"] == "1") {
        $query_default = mysql_query('UPDATE company SET is_default = 0');
        $sql = 'UPDATE company SET code = "' . $_POST["company_code"] . '", name = "' . $_POST["company_name"] . '", reg_no = "' . $_POST["reg_no"] . '", is_default = ' . $_POST["is_default"] . ', website = "' . $_POST["website"] . '", income_tax_no="' . $_POST['income_tax'] . '" WHERE id =' . $_POST["id"];
        $query = mysql_query($sql);
    } elseif ($_POST["is_default"] == "0") {
        $query_default = mysql_query('UPDATE company SET is_default = 0');
        $query_count = mysql_query('SELECT id FROM company WHERE is_default = 1');
        $count1 = mysql_num_rows($query_count);
        if ($count1 == 0) {
            $query_reset = mysql_query('SELECT MIN(id) AS id FROM company');
            $row_reset = mysql_fetch_array($query_reset);
            $sql = 'UPDATE company SET code = "' . $_POST["company_code"] . '", name = "' . $_POST["company_name"] . '", reg_no = "' . $_POST["reg_no"] . '", website = "' . $_POST["website"] . '" , income_tax_no="' . $_POST['income_tax'] . '" WHERE id =' . $_POST["id"];
            $query_default = mysql_query('UPDATE company SET is_default = 1 WHERE id=' . $row_reset['id']);
            $query = mysql_query($sql);
        }
    }
} elseif ($action == "del") {
    $sql = 'DELETE FROM company WHERE id=' . $_POST["id"];
    $query = mysql_query($sql);
    $query_count = mysql_query('SELECT id FROM company WHERE is_default = 1');
    $row_count = mysql_num_rows($query_count);
    if ($row_count == 0) {
        $query_reset = mysql_query('SELECT MIN(id) AS id FROM company');
        $row_reset = mysql_fetch_array($query_reset);
        $query_default = mysql_query('UPDATE company SET is_default = 1 WHERE id=' . $row_reset['id']);
    }
}
$id = mysql_insert_id();
if ($query) {
    $data_query = "true";
} else {
    $data_query = "false";
}
$data = array('query' => $data_query, 'id' => $id, 'action' => $_POST["is_default"]);
print json_encode($data);
?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>