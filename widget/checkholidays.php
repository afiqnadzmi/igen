<?php

//$startdate1=$_POST['startdate1'];
//$enddate1=$_POST['enddate1'];
$startdate1 = $_POST['startdate1'];// Strat date of the leave 
$enddate1 =$_POST['enddate1']; // End date of the leave
$count=0;
if(isset($_POST['holiday'])){
// Loop the date between the start date and the end date to count the number of public holidays
while (strtotime($startdate1) <= strtotime($enddate1)) {
	 
			$query2 = "SELECT * FROM `public_holiday` WHERE  `from_date`='".$startdate1."' Limit 1";
			$rs3 = mysql_query($query2);
			$num_rows = mysql_num_rows($rs3);

			if ($num_rows > 0) {
			   

			while ($row3 = mysql_fetch_array($rs3)) {
				$holyday_name = $row3['occasion_name'];
				$From = $row3['from_date'];
				$to = $row3['to_date'];
			  
			   $count=$count + 1;;
				
			}
			}
		 $startdate1 = date ("Y-m-d", strtotime("+1 day", strtotime($startdate1)));
			
	} 


  echo $count;// return the number of the public holidays
}else{
	$query2 = "SELECT * FROM `public_holiday` WHERE  `from_date` IN('".$startdate1."','".$enddate1."')";
$rs3 = mysql_query($query2);
$num_rows = mysql_num_rows($rs3);
if ($num_rows > 0) {
   

while ($row3 = mysql_fetch_array($rs3)) {
    $holyday_name = $row3['occasion_name'];
	$From = $row3['from_date'];
	$to = $row3['to_date'];
 
echo "The date From ".$From." to ".$to." is public holy day fro ".$holyday_name."\n";
    
}
}
	
}

/*
while (strtotime($startdate1) <= strtotime($enddate1)) {
             $count++;
}
echo $count;

$startdate1 = strtotime($startdate1);
$enddate1  = strtotime($enddate1);

$count=0;
for($i = $startdate1; $i <= $enddate1; $i->modify('+1 day')){
    $count++;
}
echo $count;
/*
$query2 = "SELECT * FROM `public_holiday` WHERE  `from_date` IN('".$startdate1."','".$enddate1."')";
$rs3 = mysql_query($query2);
$num_rows = mysql_num_rows($rs3);
if ($num_rows > 0) {
   

while ($row3 = mysql_fetch_array($rs3)) {
    $holyday_name = $row3['occasion_name'];
	$From = $row3['from_date'];
	$to = $row3['to_date'];
 
echo "The date From ".$From." to ".$to." is public holy day fro ".$holyday_name;
    
}
}

}

*/

/*

$query2 = "SELECT * FROM `public_holiday` WHERE  `from_date` IN('".$startdate1."','".$enddate1."')";
$rs3 = mysql_query($query2);
$num_rows = mysql_num_rows($rs3);
if ($num_rows > 0) {
   

while ($row3 = mysql_fetch_array($rs3)) {
    $holyday_name = $row3['occasion_name'];
	$From = $row3['from_date'];
	$to = $row3['to_date'];
 
echo "The date From ".$From." to ".$to." is public holy day fro ".$holyday_name;
    
}
}
*/
?>