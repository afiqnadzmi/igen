<?php
if($_POST['dept']!=0){
	
	$payroll_sql = "SELECT * FROM payroll_report WHERE  dep_id='".$_POST['dept']."' AND branch_id='".$_POST['branch_id']."' AND  MONTH(from_date)='".$_POST['month']."'  AND YEAR(from_date)='".$_POST['year']."'";
   
}else{
	$payroll_sql = "SELECT * FROM payroll_report WHERE  branch_id='".$_POST['branch_id']."' AND  MONTH(from_date)='".$_POST['month']."'  AND YEAR(from_date)='".$_POST['year']."'";
}
$payroll_rs=mysql_query($payroll_sql);

if(mysql_num_rows($payroll_rs) > 0){
		$pf_sql = "SELECT * FROM payroll_finalised WHERE is_close = 0";
        $pf_rs = mysql_query($pf_sql);
		
        if (mysql_num_rows($pf_rs) > 0) {
				while($row=mysql_fetch_assoc($pf_rs)){
				  $year=$row['finalise_year'];
				  $month=$row['finalise_month'];
				  echo"Please Close Month ".$month." Year ".$year;
				}
        } else {
            echo"false";
        }
}else{	
	echo"false";
}


?>