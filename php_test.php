<?php
/*$str="4:00 AM";
$str1="11:30 PM";
$datetime1 = new DateTime($str);
$datetime2 = new DateTime($str1);
$interval = $datetime1->diff($datetime2);
$hrs=$interval->format('%h');
$minutes=$interval->format('%i');
$ot="0:00";
$short="0:00";
if(($hrs - 1) >8){
	$ot=(($hrs - 1) - 8).":".$minutes;
}else if(($hrs - 1)==8){
	if($minutes!=0){
		$ot="0".":".$minutes;
	}
}else{
	$hr_start=$hrs.":".$minutes;
	$minus="1:00";
	$start_time=short($hr_start, $minus);
	$end_time ="8:00";
	$short= short($end_time,$start_time);
	
	//;
}
echo "Worked = ".$interval->format('%hh %im');
echo "<br> OT = ".$ot;
echo "<br> Short = ".$short;
$ot ="4:30";
$short="4:30";
echo "OT - short = ".cal_short($ot, $short);


function short($start_time, $end_time){

	list($hours, $minutes) = split(':', $start_time);
	$startTimestamp = mktime($hours, $minutes);
	
	list($hours, $minutes) = split(':', $end_time);
	$endTimestamp = mktime($hours, $minutes);
	
	$seconds = $endTimestamp - $startTimestamp;
	$minutes = ($seconds / 60) % 60;
	$hours = round($seconds / (60 * 60));

	return $hours.":".$minutes;

}

function cal_short($start_time, $end_time){
	$time1 = new DateTime($end_time);
	$time2 = new DateTime($start_time);
	$interval = $time1->diff($time2);
	$hrs=$interval->format('%h');
	$minutes=$interval->format('%i');
	return $hrs.":".$minutes;
}
$start="8:00";
*/


//$a=array(1, 3, 6, 4,1,2);
$a=array(-10000, -30000,  7, 3, 2);
//echo sizeof($a);
echo solutions($a);
function solutions($a){
	$smallest=1;
	for($i=0; $i <sizeof($a); $i++){

		for($j=$i; $j <sizeof($a) - $i; $j++){
			if($smallest==$a[$j]){
				$smallest = $smallest + 1;
			}
		}
	}
	
	return $smallest;
}




//$total = (strtotime($ot) - strtotime($short))/3600;
//echo date('H:i',strtotime('+1 hour +20 minutes',strtotime($start)));
//echo date("H:i", $total);

/*$total = (strtotime($ot_time) - strtotime($shot_time))/3600;
//echo date("H:i", $total);
//echo $total ;
//$to_time = "0.18";

$datetime1 = new DateTime('09:30 PM');
$datetime2 = new DateTime('10:45 PM');
$interval = $datetime1->diff($datetime2);
//echo $interval->format('%hh %im');

 $t = EXPLODE(".", $str); 
            $h = $t[0]; 
            IF (ISSET($t[1])) { 
                $m = $t[1]; 
            } ELSE { 
                $m = "00"; 
            } 
            $mm = ($h * 60); 
          //  echo $mm; 
echo strtotime($shot_time)/3600;*/

?>
 
