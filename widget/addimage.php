<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$name = $_POST["fileName"];
$employeeId = $_POST["empid"];
$action=$_POST['action'];

//uploading file to a folde
$filename = $_FILES['fileInput']['name'];
if(!empty($filename)){
	//Rename the file
	$temp = explode(".", $filename);
	$filename = "Leave_".round(microtime(true)) .'_'.$emp_id.'.' . end($temp);
	/* Location */
	$location = "images/profilePic/".$filename;
	$valid_extensions = array('png','jpg','gif','PNG','JPG','GIV'); // valid extensions
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
if($action=="admin"){

$sql = "UPDATE employee SET image_src = 'images/profilePic/" . $filename . "' WHERE id = " . $employeeId . ";";

$query = mysql_query($sql);




//$sql2=mysql_query("INSERT INTO employee_edit(image_src, emp_id) VALUES ('Glenn', 33)");

}else{
$sql1 = mysql_query("SELECT * FROM employee_edit  WHERE emp_id='".$employeeId."'");
                $sql_result1 = mysql_query($sql1);
               $count=mysql_num_rows($sql1);
			
			   if($count>0){
			   $sql = "UPDATE employee_edit  SET image_src = 'images/profilePic/" . $filename . "' WHERE emp_id= " . $employeeId . ";";

               $query = mysql_query($sql);
			   
			   }else{
				$sql_emp_edit = "INSERT INTO employee_edit(image_src, emp_id) VALUES ('images/profilePic/" . $filename . "', ".$employeeId.");";

				$query = mysql_query($sql_emp_edit);

}

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