<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
	// Personal Information
	
	$emp_id=$_POST['emp_id'];
		
	$coun_id=$_POST['coun_id'];
	$witness_id=$_POST['witness_id'];
	$witness_id2=$_POST['witness_id2'];
	$witness_id3=$_POST['witness_id3'];
	$background=$_POST['background'];
    $investigation=$_POST['investigation'];
	$finding=$_POST['finding'];
	$conclusion=$_POST['conclusion'];
	$remit=$_POST['remit'];
	$reported_by=$_POST['reported_by'];
	$recomend=$_POST['recomend'];

//uploading file to a folde
$filename = $_FILES['fileInput']['name'];

if(!empty($filename)){
	//Rename the file
	$temp = explode(".", $filename);
	$filename = "disciplinary_".round(microtime(true)) .'.'. end($temp);
	/* Location */ 
	$location = "uploads/disciplinary/".$filename;
	
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf', 'JPEG', 'JPG', 'PNG', 'GIF', 'PDF'); // valid extensions
	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	/* Upload file */
	if(in_array($ext, $valid_extensions)) 
	{
		if(move_uploaded_file($_FILES['fileInput']['tmp_name'],$location)){
			//echo "loca:".$location;
		}else{
			//echo 0;
		}
	}
}else{
	$filename = ""; 
}

	$sql =mysql_query("INSERT INTO investigation(ref_id, emp_id, plaintiff,invetigated_by, witness,witness2,witness3, background,remit, process, findings,Conclusions,recommended_action, files, date)
			VALUES ('" . $_POST['ref_id'] . "','" . $emp_id . "','" . $reported_by . "','" .$coun_id. "','" . $witness_id . "','" . $witness_id2 ."','".$witness_id3."','".$background."','".$remit."','".$investigation."','".$finding."','".$conclusion."','".$recomend."','".$filename."','".date('Y-m-d')."')");
   //Update Disciplany action councellling status
   $sql_dp =mysql_query("UPDATE disciplinary_pinfo SET Inves_status='1' WHERE id=".$_POST['ref_id']);
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