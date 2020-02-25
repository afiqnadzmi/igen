
<?php
$employee=$_POST['employee'];
$arr=explode(",", $employee);
foreach($arr as $val){
$sql_del = "DELETE FROM increment_approval WHERE employer_id =" .$val. ";";
$sql_result = mysql_query($sql_del);
$sql = "INSERT INTO increment_approval (employer_id) VALUES ('" . $val . "')";
$query = mysql_query($sql);

}
if ($query) {
echo"Successfully added";

}

    
?>