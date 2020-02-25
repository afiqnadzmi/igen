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
                                      'Color' => 'white',
                                      'Pattern' => 1,
									  'Bgcolor'=>'blue',
                                      'FgColor' => 'black'));
$format2 =& $workbook->addFormat(array('Size' => 12,
                                      'Align' => 'right',
                                      'Color' => 'white',
                                      'Pattern' => 1,
									  'Bgcolor'=>'blue',
                                      'FgColor' => 'black'));
$format3 =& $workbook->addFormat(array('Size' => 12,
                                      'Align' => 'right',
                                      'Color' => 'white',
                                      'Pattern' => 1,
									  'Bgcolor'=>'blue',
                                      'FgColor' => 'blue'));
$format4 =& $workbook->addFormat(array('Size' => 12,
                                      'Align' => 'right',
                                      'Color' => 'black',
                                      'Pattern' => 1,
									  'Bgcolor'=>'blue',
                                      'FgColor' => 'gray'));
$format5 =& $workbook->addFormat(array('Size' => 12,
                                      'Align' => 'right',
                                      'Color' => 'black',
                                      'Pattern' => 1,
									  'Bgcolor'=>'blue',
                                      'FgColor' => 'silver'));
$format6 =& $workbook->addFormat(array('Size' => 10,
                                      'Align' => 'left'));
$month = array("", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
$ref="24".$_GET['month']."".$_GET['year'];
$workbook->send('MyBank_Salary_Report(' . $month[$_GET['month']] . ' ' . $_GET['year'] . ').xls');
$worksheet1->write(0, 0, "", $format1);
$worksheet1->write(0, 1, "", $format1);
$worksheet1->write(0, 2, "", $format1);
$worksheet1->write(0, 3, "", $format1);
$worksheet1->write(0, 4, "Maybank2e.net HRPay File Generator", $format1);
for($i=5; $i<=14; $i++){
$worksheet1->write(0, $i, "", $format1);

}
//Top rows 
$date1= strtoupper(Date('M'));
$date= Date('y');
$Year= Date('Y');
$cont=Date('m')."".$Year;
$RE_date="SALARY  ".$date1."  ".$date;
$deb_desc="SALARY FOR MONTH OF  ".$date1."  ".$Year;
$worksheet1->write(2, 0, "Client Code",$format6);
$worksheet1->write(3, 0, "PIR Reference No",$format6);
$worksheet1->write(4, 0, "Debit Account No",$format6);
$worksheet1->write(5, 0, "Mode of Processing",$format6);
$worksheet1->write(6, 0, "Debit Reference",$format6);
$worksheet1->write(7, 0, "Debit Description",$format6);
$worksheet1->write(8, 0, "Payment Date(YYYYMMDD",$format6);
$worksheet1->write(9, 0, "Testing File?",$format6);
$worksheet1->write(10, 0, "Confidential?",$format6);
$worksheet1->write(11, 0, "EPF Registration File",$format6);
$worksheet1->write(2, 1, "IGENTECH",$format6);
$worksheet1->write(3, 1, $RE_date,$format6);
$worksheet1->write(4, 1, "514495204777", $date_format);
$worksheet1->write(5, 1, "BATCH",$format6);
$worksheet1->write(6, 1,  $RE_date,$format6);
$worksheet1->write(7, 1, $deb_desc,$format6);
$worksheet1->write(8, 1, " ");
$worksheet1->write(9, 1, "NO",$format6);
$worksheet1->write(10, 1, "NO",$format6);
$worksheet1->write(11, 1, "NO",$format6);
$worksheet1->write(2, 2, " ",$format6);
$worksheet1->write(2, 3, " ",$format6);
$worksheet1->write(2, 4, "Contribution Month, Year (MMYYYY) ",$format6);
$worksheet1->write(2, 5, $cont,$format6);

//lower columns 
$worksheet1->write(13, 3,"Staff Details", $format1);
for($j=0; $j<=7;  $j++){
if($j==3){

continue;
}
$worksheet1->write(13, $j,"", $format2);
}
$worksheet1->write(13, 11,"EPF", $format3);
for($j=8; $j<=14;  $j++){
if($j==11){

continue;
}
$worksheet1->write(13, $j,"", $format3);
}
$worksheet1->write(13, 15,"SOCSO", $format4);
for($j=14; $j<=16;  $j++){
if($j==15){

continue;
}
$worksheet1->write(13, $j,"", $format4);
}
$worksheet1->write(13, 18,"IRB", $format5);
for($j=17; $j<=21;  $j++){
if($j==18){

continue;
}
$worksheet1->write(13, $j,"", $format5);
}
$worksheet1->write(13, 22,"ZAKAT", $format3);
for($j=22; $j<=23;  $j++){
if($j==22){

continue;
}
$worksheet1->write(13, $j,"", $format3);
}
$worksheet1->write(14, 0, "Staff Name" ,$format);
$worksheet1->write(14, 1, "" ,$format);
$worksheet1->write(14, 2, "Staff Bank" ,$format);
$worksheet1->write(14, 3, "Staff Account No" ,$format);
$worksheet1->write(14, 4, "Company Staff No" ,$format);
$worksheet1->write(14, 5, "New IC No" ,$format);
$worksheet1->write(14, 6, "Old IC" ,$format);
$worksheet1->write(14, 7, "Passport No" ,$format);
$worksheet1->write(14, 8, "Salary Amount" ,$format);
$worksheet1->write(14, 9, "Employee Ref No" ,$format);
$worksheet1->write(14, 10, "Employee Initial" ,$format);
$worksheet1->write(14, 11, "Employee Identifying Key" ,$format);
$worksheet1->write(14, 12, "Employee Amount" ,$format);
$worksheet1->write(14, 13, "Employer Amount",$format);
$worksheet1->write(14, 14, "Member Wages",$format);
$worksheet1->write(14, 15, "SOCSO Employee Ref No",$format);
$worksheet1->write(14, 16, "Employee Amount",$format);
$worksheet1->write(14, 17, "Employee Amount",$format);
$worksheet1->write(14, 18, "Employee IT Group",$format);
$worksheet1->write(14, 19, "Employee Ref No",$format);
$worksheet1->write(14, 20, "Wife Code",$format);
$worksheet1->write(14, 21, "PCB Amount",$format);
$worksheet1->write(14, 22, "CP38 Amount",$format);
$worksheet1->write(14, 23, "EmployeeAmount",$format);
$worksheet1->write(14, 24, "Zakat Classification",$format);

?>
<?php

$month = $_GET['month'];
$year = $_GET['year'];
$i = 15;
$allo="Allowance".$ref;
$account="514495204777";
$chk_sql = 'SELECT id FROM payroll_finalised WHERE finalise_month=' . $month . ' AND finalise_year=' . $year;
$chk_sql_result = mysql_query($chk_sql);
if ($chk_sql_result && mysql_num_rows($chk_sql_result) > 0) {
    $chk_row = mysql_fetch_array($chk_sql_result);
    $fid = $chk_row["id"];
    $sql1 = "SELECT e.full_name,e.id as eid, e.bank_acc_num, e.ic, p.* FROM payroll_report AS p 
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
		  $socso=$newArray['socso'];
		  $epf=$newArray['epf'];
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
		  if($newArray['basic_salary']=="0.00"){
		  $basic_salary="";
		  }else{
		      $basic_salary=$newArray['basic_salary'] - $epf - $socso;
		  }
		  
		 $account=$account.""; 
		 $bank=$newArray['bank_acc_num']."";
		 
		 $emp_id=str_pad($newArray['eid'], 6, "0", STR_PAD_LEFT);
            $worksheet1->write($i, 0, $newArray['full_name']);
			$worksheet1->write($i, 1,"");
			 $worksheet1->write($i,2, "MBBEMYKL");
            $worksheet1->write($i, 3,  $bank, $date_format);
			$worksheet1->write($i, 4, $emp_id, $date_format);
            $worksheet1->write($i, 5, $ic, $date_format);
            $worksheet1->write($i, 6,"");
			$worksheet1->write($i, 7, $p);
			$worksheet1->write($i, 8, $basic_salary);
			$worksheet1->write($i, 9, "");
			$worksheet1->write($i, 10, "");
			$worksheet1->write($i, 11, "");
			$worksheet1->write($i, 13, "");
			$worksheet1->write($i, 13, "");
			$worksheet1->write($i, 14,"");
			$worksheet1->write($i, 15,"");
			$worksheet1->write($i, 16,"");
			$worksheet1->write($i, 17,"");
			$worksheet1->write($i, 18,"");
			$worksheet1->write($i, 19,"");
			$worksheet1->write($i, 20,"");
			$worksheet1->write($i, 21,"");
			$worksheet1->write($i, 22,"");
			$worksheet1->write($i, 23,"");
			$worksheet1->write($i, 24,"");
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