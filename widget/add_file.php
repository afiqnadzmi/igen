<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>




<?php
//uploading file to a folde
$filename = $_FILES['fileInput']['name'];

if(!empty($filename)){
	//Rename the file
	$temp = explode(".", $filename);
	$filename = "transcript_".round(microtime(true)) .'_'.$_POST['id'].'.' . end($temp);
	/* Location */
	$location = "uploads/transcript/".$filename;
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf','PNG','JPG','GIV','PDF'); // valid extensions
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
}

$sql = 'UPDATE employee_training SET attachment="'.$filename.'" WHERE id='.$_POST['id'];

$query = mysql_query($sql);
if ($query) {
	echo 1;
}else{
	echo 0;
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