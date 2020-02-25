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
$query_count4 = mysql_query('SELECT name FROM bank WHERE name ="'.$_POST["company_name"].'"');
        $count4 = mysql_num_rows($query_count4);
		
        if ($count4>0) {
		echo $count4;
		
	     
			
		}else{
		$sql = 'INSERT INTO bank (code, name) VALUES ("' . $_POST["company_code"] . '","' . $_POST["company_name"] . '")';
    $query = mysql_query($sql);
	if ($query) {
    $data_query =2;
	echo $data_query;
} else {
    $data_query = 3;
	echo  $data_query ;
}
}
	

   
    
} elseif ($action == "edit") {

      
            $sql = 'UPDATE bank SET code = "' . $_POST["company_code"] . '", name = "' . $_POST["company_name"] . '" WHERE id ='. $_POST["id"];
            $query = mysql_query($sql);
			 $data_query=$_POST["company_code"];
			echo 1 ;
        
    
} elseif ($action == "del") {
    $sql = 'DELETE FROM bank WHERE id=' . $_POST["id"];
    $query = mysql_query($sql);
   echo 1;
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