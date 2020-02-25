<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
 $random = substr(md5(rand()),1,6);
error_reporting(0);
include "plugins/mailer/mailapp.php";
$username = (isset($_POST['username'])) ? $_POST['username'] : "";

$sql = "select * from employee where username='" . $username . "'";
$query = mysql_query($sql);
 $random1=md5($random);
if ($query) {
    if (mysql_num_rows($query) > 0) {
        $row = mysql_fetch_array($query);
        $full_name = $row['full_name'];
        $email = $row['email'];
        $pwd = $row['pwd'];

     

          $sql = "update employee set pwd = '" .$random1. "'  where username='" . $username . "'";
    if (mysql_query($sql))
        $m="1";
    else
        $m="2";
        
    }
	if($m=="1"){
	   $subject = 'Password Reset';

        $msg = '<br />Dear ' . $full_name . '<br /><br />';
		 $msg.='Your new password is:   '.$random.'<br /><br />';
        $msg.='Please login using following address: http://myigenios.com:8081/HR/igen <br /><br />';
		$msg.='Thank You<br /><br />';
       
        $msg.='Do not reply to this email as this was a computer generated email.<br /><br />';

        $headers .= 'Content-type: text/html; charset=iso-8859-1'; 
       mailto($email, $subject, $msg, $headers);
echo "The new Password has been sent to your email.";	

}else{
echo "Error while processing.";
}
}else{
echo "Please provide the valid information.";

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