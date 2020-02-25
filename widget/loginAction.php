<?php
session_start();
$_SESSION['epr']="epr";
$_SESSION['user_id']=149;
$_SESSION['login_user']=$_GET["username"];
$_SESSION['type']="requestor";
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

$sql = "select * from users where username='" . $_GET["username"] . "' limit 1";
$rs = mysql_query($sql);

if ($rs && mysql_num_rows($rs) > 0) {

    $row = mysql_fetch_array($rs);
	

    if ($row["pwd"]== md5($_GET["password"])) {
        $id = $row['id'];
        setcookie('igen_id', $id, 0, '/');
        setcookie('igen_is_admin', '1', 0, '/');
        setcookie('igen_username', $_GET["username"], 0, '/');
        setcookie('igen_view', "0", 0, '/');
		
        echo "admin_true";
    } else {
        echo false;
    }
} else {
    //print false;
    $sql = "select * from employee where username='" . $_GET["username"] . "' limit 1";
    $rs = mysql_query($sql);

    if ($rs && mysql_num_rows($rs) > 0) {
        $row = mysql_fetch_array($rs);
		if ($row["pwd"]==md5("123456")){
		echo $row["username"];
		exit();
		}
        if ($row["pwd"] == md5($_GET["password"])) {
            $id = $row['id'];
			$dep=$row['dep_id'];
			$_SESSION["full_name"]=$row["full_name"];
			
            setcookie('igen_user_id', $id, 0, '/');
            setcookie('igen_is_admin', '0', 0, '/');
            setcookie('igen_user_username', $_GET["username"], 0, '/');
            setcookie('igen_view', "0", 0, '/');
            $sql1 = 'SELECT u.dashboard FROM user_permission AS u INNER JOIN employee AS e ON e.level_id = u.id WHERE e.id = ' . $id;
            $query1 = mysql_query($sql1);
            $row1 = mysql_fetch_array($query1);
			

            echo $row1["dashboard"];
			if ($row1["dashboard"]=="dash_hide"){
			$_SESSION["userid"] = $id;
			$_SESSION["depid"] = $dep;
			}
			
        } else {
            echo false;
        }
    } else {
        print false;
    }
}

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>