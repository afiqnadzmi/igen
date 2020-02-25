<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$dep = isset($_GET["dep"]) ? $_GET["dep"] : "";
$group = isset($_GET["group"]) ? $_GET["group"] : "";
$level1 = isset($_GET["level1"]) ? $_GET["level1"] : "";
$level2 = isset($_GET["level2"]) ? $_GET["level2"] : "";
$level3 = isset($_GET["level3"]) ? $_GET["level3"] : "";
$emp1 = isset($_GET["emp1"]) ? $_GET["emp1"] : "";
$emp2 = isset($_GET["emp2"]) ? $_GET["emp2"] : "";
$emp3 = isset($_GET["emp3"]) ? $_GET["emp3"] : "";
$e_head_id = isset($_GET["e_head_id"]) ? $_GET["e_head_id"] : "";
$notify=isset($_GET["s"]) ? $_GET["s"] : "";
if($notify!=""){
$notify=explode(",",$notify);
foreach($notify as $val){

$sql = "INSERT INTO notify(emp_id, dep_id) 
        VALUES ('" . $val. "','" . $dep . "')";
$query = mysql_query($sql);

}

};



$sql = "INSERT INTO approval(dep_id, group_id, level_pos_1, level_pos_2, level_pos_3, superior_1, superior_2, superior_3) 
        VALUES ('" . $dep . "','" . $group . "','" . $emp1 . "','" . $emp2 . "','" . $emp3 . "','" . $emp1 . "','" . $emp2 . "','" . $emp3 . "')";

$query = mysql_query($sql);
$id=mysql_insert_id();

if($e_head_id!=""){

$sql = "INSERT INTO approval_m(app_id, dep_id, emp_id, lv1, lv2, lv3) 
        VALUES ('" . $id. "','" . $dep . "','" .$e_head_id. "','" .$emp1. "','" .$emp2. "','" .$emp3. "')";
$query = mysql_query($sql);

}
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