<?php

$id=$_POST['val'];
foreach($id as $val){




$sql = "Delete FROM injury_details  WHERE id=".$val;
$query = mysql_query($sql);

}
if ($query==true) {
echo"Successfully deleted";

}
?>
