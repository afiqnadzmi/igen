<?php
session_start();
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

$password = md5($_POST['pw1']);
$id = $_POST['id'];

$sqlchange = mysql_query('UPDATE employee SET pwd = "' .$password. '" WHERE username="'. $id.'"');

if ($sqlchange) {
   //print false;
    $sql = "select * from employee where username='" .$id. "' limit 1";
    $rs = mysql_query($sql);

    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
		
        
            $id1 = $row['id'];
			
			$dep=$row['dep_id'];
			
            setcookie('igen_user_id', $id1, 0, '/');
            setcookie('igen_is_admin', '0', 0, '/');
            setcookie('igen_user_username', $id, 0, '/');
            setcookie('igen_view', "0", 0, '/');
            $sql1 = 'SELECT u.dashboard FROM user_permission AS u INNER JOIN employee AS e ON e.level_id = u.id WHERE e.id = ' . $id1;
            $query1 = mysql_query($sql1);
            $row1 = mysql_fetch_array($query1);
			
		
            echo $row1["dashboard"];
			
				if ($row1["dashboard"]=="dash_hide"){
			$_SESSION["userid"] = $id1;
			$_SESSION["depid"] = $dep;
			}
       
    } else {
        print 1;
    }
} else {
    print 2;
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