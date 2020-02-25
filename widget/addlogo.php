<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

//$name = $_POST["fileName"];
$company_id = $_POST["company_id"];
//uploading file to a folde
$name = $_FILES['fileInput']['name'];
if(!empty($name)){
	//Rename the file
	$temp = explode(".", $name);
	$name = "Company".round(microtime(true)) .'_'.$company_id.'.' . end($temp);
	/* Location */
	$location = "images/logoPic/".$name;
	$valid_extensions = array('png','jpg','gif','PNG','JPG','GIV'); // valid extensions
	$ext = pathinfo($name, PATHINFO_EXTENSION);
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
	$name = "";
}
if ($name == "" || $name == " ") {
    $sql = "UPDATE company SET logo_img = '' WHERE id = " . $company_id . ";";
} else {
    $sql = "UPDATE company SET logo_img = 'images/logoPic/" . $name . "' WHERE id = " . $company_id . ";";
}

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