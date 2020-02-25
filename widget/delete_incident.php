<?php

$id=$_POST['val'];
foreach($id as $val){




$sql = "Delete FROM incident_detail  WHERE id=".$val;
$query = mysql_query($sql);

}
if ($query==true) {
echo"Successfully deleted";

}
?>
