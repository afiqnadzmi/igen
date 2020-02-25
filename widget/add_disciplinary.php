<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */


	// Personal Information
	$full_name=$_POST['full_name'];
	$emp_num=$_POST['emp_num'];
	$emp_position=$_POST['emp_position'];
	$dep_name=$_POST['dep_name'];
    $created_by=$_POST['created_by'];
	$all_date=$_POST['all_date'];
    $location=$_POST['location'];
	$off_type=$_POST['off_type'];

	$status="";
	$action="";
	if($_POST['access']=="a_hr_edit"){
		if($_POST['invest_outcome']=="Genuine"){
			if($_POST['termination']=="Yes"){//Send to Managing Director for review
				$status='Pending[Managing Director]';
				$action='Termination';
			}else{
				$status='Reviewed By[HR]';
				$action='Counselling';
			}
		}else{
			$status='Rejected[HR]';
			$action='Not Genuine';
		}	
	}else{
		$status='Pending[HR Review]'; 
		$action='Ongoing';
    }
	$sql =mysql_query("INSERT INTO disciplinary_pinfo(emp_id, alleged_by,md, alleged_date, action, Status, inves_outcome, comments, termination, offence_date, location, offence_type)
			VALUES ('" . $emp_num . "','" . $created_by . "','" .$_POST['md']. "','" . date('Y-m-d') . "','" .  $action ."','".$status."','".$_POST['invest_outcome']."','".$_POST['comment']."','".$_POST['termination']."','".date('Y-m-d', strtotime($_POST['all_date']))."','".$location."','".$off_type."')");
	$lastInserted_id=mysql_insert_id();
			
	//Allegation List
	$str = explode(";", $_POST['str']);
	foreach($str as $al){
		$alegation = explode(",", $al);
		$all= $alegation[0];
		 //Inser into DB
		$sql =mysql_query("INSERT INTO disciplinary_allegation(ref_id,allegation)
			VALUES ('" . $lastInserted_id . "','" . $all . "')");
	}
	if ($sql) {
		echo true;
	} else {
		echo false;
	}


/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>