<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

include_once "app/test_jason.php";
include_once "app/test.php";
include_once "app/loh.php";
$date_format =& $workbook->addFormat();
$date_format->setNumFormat('##');
$format =& $workbook->addFormat(array('Size' => 12,
                                      'Align' => 'center',
                                      'Color' => 'white',
                                      'Pattern' => 1,
									  'Bgcolor'=>'red',
                                      'FgColor' => 'magenta'));
$format1 =& $workbook->addFormat(array('Size' => 12,
                                      'Align' => 'right',
                                      'Color' => 'black',
                                      'Pattern' => 1,
									  'Bgcolor'=>'blue',
                                      'FgColor' => 'orange'));
$format2 =& $workbook->addFormat(array('Size' => 10,
                                      'Align' => 'left'));
$month = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
$ref="24".$_GET['month']."".$_GET['year'];
$workbook->send('MyBank_Allowance_Report(' . $month[$_GET['month']] . ' ' . $_GET['year'] . ').xls');
$worksheet1->write(0, 0, "", $format1);
$worksheet1->write(0, 1, "", $format1);
$worksheet1->write(0, 2, "", $format1);
$worksheet1->write(0, 3, "", $format1);
$worksheet1->write(0, 4, "Maybank2e.net HRPay File Generator", $format1);
for($i=5; $i<=14; $i++){
$worksheet1->write(0, $i, "", $format1);

}
$worksheet1->write(2, 0, "Client Code", $format2 );
$worksheet1->write(3, 0, "PIR Reference No", $format2);
$worksheet1->write(4, 0, "Mode of Processing", $format2);
$worksheet1->write(5, 0, "Testing File?", $format2);
$worksheet1->write(6, 0, "Confidential?", $format2);
//$worksheet1->write(0, 5, "Late In Early Out (RM)");
$worksheet1->write(2, 1, "IGENTECH", $format2);
$worksheet1->write(3, 1, $ref, $format2);
$worksheet1->write(4, 1, "BATCH", $format2);
$worksheet1->write(5, 1, "NO", $format2);
$worksheet1->write(6, 1, "NO", $format2);
$worksheet1->write(8, 0, "Bene Name" ,$format);
$worksheet1->write(8, 1, "" ,$format);
$worksheet1->write(8, 2, "Debit Account No" ,$format);
$worksheet1->write(8, 3, "Receiving Bank Code" ,$format);
$worksheet1->write(8, 4, "Bene Account No" ,$format);
$worksheet1->write(8, 5, "Amount" ,$format);
$worksheet1->write(8, 6, "New IC" ,$format);
$worksheet1->write(8, 7, "Old IC" ,$format);
$worksheet1->write(8, 8, "Bene Business Registration No" ,$format);
$worksheet1->write(8, 9, "Bene Police/Army/ID/Passport No" ,$format);
$worksheet1->write(8, 10, "Payment Date" ,$format);
$worksheet1->write(8, 11, "Transaction Ref No" ,$format);
$worksheet1->write(8, 12, "Debit Ref" ,$format);
$worksheet1->write(8, 13, "Debit Description",$format);
$worksheet1->write(8, 14, "Credit Ref",$format);
$worksheet1->write(8, 15, "credit Description",$format);
?>
<?php

$month = $_GET['month'];
$year = $_GET['year'];
$i = 9;
$allo="Allowance".$ref;
$account="514495204777";
$chk_sql = 'SELECT id FROM payroll_finalised WHERE finalise_month=' . $month . ' AND finalise_year=' . $year;
$chk_sql_result = mysql_query($chk_sql);
if ($chk_sql_result && mysql_num_rows($chk_sql_result) > 0) {
    $chk_row = mysql_fetch_array($chk_sql_result);
    $fid = $chk_row["id"];
    $sql1 = "SELECT e.full_name, e.bank_acc_num, e.ic, p.* FROM payroll_report AS p 
            INNER JOIN employee AS e ON e.id=p.emp_id
            WHERE p.payroll_finalised_id=" . $fid;
    if (!empty($_GET["emp_id"])) {
        $sql1.=" AND p.emp_id IN (" . $_GET["emp_id"] . ")";
    } else {
        if ($_GET["dep_id"] == "0") {
            $sql1.=" AND e.branch_id = " . $_GET["branch_id"];
        } else {
            $sql1.=" AND e.dep_id = " . $_GET["dep_id"];
        }
    }
    if (!empty($_GET["status"])) {
        $sql1.=" AND e.emp_status = '" . $_GET["status"] . "'";
    }
    $sql1.=" ORDER BY e.id";

    $sql_result = mysql_query($sql1);
    if ($sql_result && mysql_num_rows($sql_result) > 0) {
        while ($newArray = mysql_fetch_array($sql_result)) {
		  if($newArray['ic']=="000000-00-0000"){
		  
		  }
		  if (is_numeric(substr($newArray['ic'], 0, 1))) {
		  
		  $value=$newArray['ic'];
             $fir6=substr($value, 0, 6);
            $mid2=substr($value, 7, 2);
            $last4=substr($value, 10, 4);

             $ic= $fir6."".$mid2."".$last4;
		  $p="";
		  }else{
		  $p=$newArray['ic'];
		  }
		  if($newArray['allowance']=="0.00"){
		  $allowance="";
		  }else{
		      $allowance=$newArray['allowance'];
		  }
		 $account=$account.""; 
		 $bank=$newArray['bank_acc_num']."";
            $worksheet1->write($i, 0, $newArray['full_name']);
			$worksheet1->write($i, 1, "");
            $worksheet1->write($i, 2,  $account, $date_format);
            $worksheet1->write($i, 3, "MBBEMYKL");
            $worksheet1->write($i, 4,   $bank , $date_format);
            $worksheet1->write($i, 5, $allowance);
            $worksheet1->write($i, 6, $ic , $date_format);
			$worksheet1->write($i, 7, "");
			$worksheet1->write($i, 8, "");
			$worksheet1->write($i, 9, $p);
			$worksheet1->write($i, 10, "");
			$worksheet1->write($i, 11, $ref);
			$worksheet1->write($i, 12, $allo);
			$worksheet1->write($i, 13, $allo);
			$worksheet1->write($i, 14, $allo);
			$worksheet1->write($i, 15, $allo);
            $i++;
        }
    } else {
        $worksheet1->write($i, 0, "No record found.");
    }
} else {
    $worksheet1->write($i, 0, "No record found.");
}

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>