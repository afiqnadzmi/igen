<?php
$time = explode(",",$_POST['sList']);
$plist=array_filter(explode(",",$_POST['plist']));
$count=0;
if(isset($plist) && sizeof($plist)!=0){
	
	foreach($plist as $val){
		 $sql = "DELETE  FROM p_particular WHERE id=".$val;
		 $query = mysql_query($sql);
		 $sql = "DELETE  FROM  appraisal_draft WHERE p_id=".$val;
		 $query = mysql_query($sql);
	 }
	 if($query){
		echo"Successfully deleted";
	}
}else{
	$sql = "DELETE  FROM multiple_appraisee ";
	$query = mysql_query($sql);
	foreach($time as $val){
		$sql = "INSERT INTO multiple_appraisee(emp_id) VALUES ('" . $val . "')";
		$query = mysql_query($sql);
		if($query){
			$count=1;		  
		}				  
	}

	if($count==1){
		echo true;
	}
}
?>