

<?php
$emp_id=$_POST['emp_id'];
$month=$_POST['month'];
$year=$_POST['year'];
$epf=$_POST['epf'];
$nt=$_POST['nt'];

$queryCheckReport = mysql_query('SELECT netpaid FROM payroll_report WHERE emp_id="'.$emp_id.'"');
    $num = mysql_num_rows($queryCheckReport);
    while ($rowCheckReport = mysql_fetch_array($queryCheckReport)) {
      $net= $nt + $epf;
	  
	   
	   $sql = 'UPDATE payroll_report SET netpaid = "' .$net. '", epf="0.00", employer_epf="0.00" WHERE emp_id="'.$emp_id.'"';
        $sql_result = mysql_query($sql);

        if ($sql_result) {
            $query_status = "true";
        } else {
            $query_status = "false";
        }
		
    }
	echo $query_status;
exit();

          //  $sql2 = "UPDATE employee_leave SET approval_1='" . $status . "' where id='" . $id . "'";
       
?>
