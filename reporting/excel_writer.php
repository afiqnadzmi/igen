<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

error_reporting(0);
require_once("../function/db_conn.php");

$include_path	= ini_get ('include_path');
ini_set('include_path','../Spreadsheet/Excel/');

require_once '../Spreadsheet/Excel/Writer.php';
 
// Creating a workbook
$workbook = new Spreadsheet_Excel_Writer();
 
/* Sending HTTP headers, this will popup a file save/open
dialog in the browser when this file is run
*/
//$workbook->send('Account Statement.xls');
$workbook->setVersion(13);
//$workbook->send1('excelTest.xls');
 
// Create 2 worksheets

$worksheet1 =& $workbook->addWorksheet('worksheet 1');
$worksheet1->setInputEncoding('UTF-8');
$worksheet1->setColumn(0,35,30);

//$worksheet1->protect("");

//$worksheet1->write(2,0, "Date");
include $_GET['t'].".php";
 
ini_set('include_path', $include_path);
 
// Send the file to the browser
$workbook->close();

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>