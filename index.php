<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

error_reporting(0);
header("Cache-Control: no-cache, must-revalidate");
date_default_timezone_set("Asia/Kuala_Lumpur");

require_once("excel/phpexcelreader.php");
require_once("function/function.php");
require_once("function/db.php");
require_once("function/db_conn.php");


if (isset($_GET['widget']) && $_GET['widget'] != "editletter") {
    require_once("plugins/html2pdf/html2pdf.class.php");
}

if ($_GET['loc'] == "forget_password") {
    include "app/forget_password.php";
} elseif (isset($_GET['loc'])) {
    include 'app/main.php';
} elseif (isset($_GET['widget'])) {
    include 'widget/' . $_GET['widget'] . '.php';
} elseif (isset($_GET['admin'])) {
    include 'app/login.php';
} elseif (isset($_GET['eloc'])) {
    include 'app/main.php';
} elseif (isset($_GET['ewidget'])) {
    include 'widget/e_' . $_GET['ewidget'] . '.php';
} elseif (isset($_COOKIE['igen_user_id']) || isset($_COOKIE['igen_is_admin'])) {
    include 'app/main.php';
} else {
    include 'app/login.php';
}

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>
