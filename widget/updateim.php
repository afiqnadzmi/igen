
<?php
$employeeId=$_POST['id'];
$action=$_POST['m'];

$sql1 = mysql_query("SELECT * FROM employee_edit  WHERE emp_id='".$employeeId."'");
              
               $count=mysql_num_rows($sql1);
			   $rowGetNew = mysql_fetch_array($sql1);
			$name=$rowGetNew['image_src'];
			   if($count>0){
			   $sql_delete = "DELETE FROM employee_edit  WHERE emp_id=".$employeeId;
			   $query1 = mysql_query($sql_delete);
			   if($action=="approve"){
               $sql = "UPDATE employee  SET image_src ='" . $name . "' WHERE id= " . $employeeId . ";";
			   }
               $query = mysql_query($sql);
			   
			   }
			   
if ($query1) {
    print true;
} else {
    print false;
}
?>
