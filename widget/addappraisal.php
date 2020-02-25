<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$question = $_POST['question'];
$action = $_POST['action'];
$group = $_POST['group'];
$a_group=$_POST['a_group'];
$id=$_POST['form'];
$questions=$_POST['questions'];
$desc=$_POST['desc'];
$rate=$_POST['rate'];
$code=$_POST['code'];
$from=$_POST['r_from'];
$to=$_POST['to'];
$sub_title=$_POST['sub_title'];
$sub_old=$_POST['sub_old'];
$g_title=$_POST['g_title'];
$sub_id="";

if($action=='g'){
	$sql = "INSERT INTO appraisal_group (group_name, form_id) VALUES ('" . $group . "', '" . $id . "')";
	$query = mysql_query($sql);
}else if($action=='q'){
	if($g_title!=""){
		$sql = "INSERT INTO appraisal_group(group_name, form_id) VALUES ('" . $g_title . "', '" . $id . "')";
		$query = mysql_query($sql);
		$a_group=mysql_insert_id();
	}
	if($sub_title!=""){
		$sql = "INSERT INTO sub_group(sub_title, group_id, form_id) VALUES ('" . $sub_title . "','" . $a_group . "','" . $id . "')";
		$query = mysql_query($sql);
		$sub_id=mysql_insert_id();
	}else{
		$sub_id=$sub_old;
	}

	$sql = "INSERT INTO appraisal_questions(form_id, group_id, sub_id, question, description) VALUES ('" . $id . "','" . $a_group . "','" . $sub_id . "','" . $questions . "','" . $desc. "')";
	$query = mysql_query($sql);
}else if($action=='r'){
	$sql = "INSERT INTO rating(rate, code, r_from, r_to) VALUES ('" . $rate . "','" . $code . "','" . $from . "','" .$to. "')";
	$query = mysql_query($sql);
 }else{
	$sql = "INSERT INTO performance_forms (forms) VALUES ('" . $question . "')";
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