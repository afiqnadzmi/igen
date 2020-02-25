<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */


	// Personal Information
	if($_POST['access']=="a_hr_edit"){
		$status="";
		$action="";
		if($_POST['invest_outcome']=="Genuine"){
			if($_POST['off_type']=="Major"){
				if($_POST['termination']=="Yes"){//Send to Managing Director for review
					$status='Pending[Managing Director]';
					$action='Punishable';
				}else{
					$status='Reviewed By[HR]';
					$action='Counselling';
				}
			}else{
				$status='Reviewed By[HR]';
				$action='Counselling';
			}
			
		}else{
			$status='Rejected[HR]';
			$action='Not Genuine';
		}	
		$sql =mysql_query("UPDATE disciplinary_pinfo SET md='".$_POST['md']."', inves_outcome='".$_POST['invest_outcome']."', comments='".$_POST['comment']."', termination='".$_POST['termination']."',Status='".$status."',offence_date='".date('Y-m-d', strtotime($_POST['all_date']))."',location='".$_POST['location']."', updated_by='".$_POST['emp_id']."',updated_date='" . date('Y-m-d'). "',action='".$action."',offence_type='".$_POST['off_type']."' WHERE id=".$_POST['da_id']);
	}else{
		$query_md = mysql_query('SELECT md FROM disciplinary_pinfo where id ='.$_POST['da_id']);
		$row_md = mysql_fetch_array($query_md);
		if($row_md['md']==$_POST['emp_id']){//if the current logged in is Managing Director
			$sql =mysql_query("UPDATE disciplinary_pinfo SET updated_by='".$_POST['emp_id']."',updated_date='" . date('Y-m-d'). "', Status='Approved[MD]' WHERE id=".$_POST['da_id']);
		}else{
			$sql =mysql_query("UPDATE disciplinary_pinfo SET updated_by='".$_POST['emp_id']."',updated_date='" . date('Y-m-d'). "',offence_date='".date('Y-m-d', strtotime($_POST['all_date']))."',location='".$_POST['location']."' ,offence_type='".$_POST['off_type']."' WHERE id=".$_POST['da_id']);
		}
	}	

	//Allegation List
	$str = explode(";", $_POST['str']);
	foreach($str as $al){
		$alegation = explode(",", $al);
		$all= $alegation[0];
		$id=$alegation[1];
		 //Inser into DB
		 if($id!=""){
			$sql =mysql_query("UPDATE disciplinary_allegation SET allegation='".$all."' WHERE id=".$id);
		 }else{
			$sql =mysql_query("INSERT INTO disciplinary_allegation(ref_id,allegation)
			VALUES ('" .$_POST['da_id']. "','" . $all . "')");
		 }
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