<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$action = $_POST['action'];
$id=$_POST['id'];
$questions=$_POST['questions'];
$question=$_POST['question'];
$a_group=$_POST['a_group'];
$form=$_POST['form'];
$questions=$_POST['questions'];
$desc=$_POST['desc'];
$form_id=$_POST['form_id'];
$sub_group=$_POST['sub_group'];
$rate=$_POST['rate'];
$code=$_POST['code'];
$r_from=$_POST['r_from'];
$to=$_POST['to'];

if($action=="q"){
$sql_result = mysql_query("UPDATE  appraisal_group SET group_name='" . $_POST['questions'] . "' WHERE id = " . $_POST['id'] . ";");
}else if($action=="f"){
$sql_result = mysql_query("UPDATE  performance_forms SET forms='" . $_POST['question'] . "' WHERE id = " . $_POST['id'] . ";");
}else if($action=="qu"){
$sql_result = mysql_query("UPDATE  appraisal_questions SET form_id='" . $form . "',group_id='" . $a_group . "',sub_id='" . $sub_group . "',question='" . $questions . "',description='" . $desc . "' WHERE id = " . $form_id . ";");
}else if($action=="r"){
$sql_result = mysql_query("UPDATE  rating SET rate='" . $rate . "',code='" . $code . "',r_from='" . $r_from . "',r_to='" . $to . "' WHERE id = " . $_POST['r_id'] . ";");
}
if ($sql_result) {
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