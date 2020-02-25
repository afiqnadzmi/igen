  <style>

              
table#e{
margin-left:0px;

border:1px solid;
width:80%;
border-collapse:collapse;
}
table#e #up td{

padding:10px;
text-align:left;
		
	
}
table#e .lower td{
padding:10px;
text-align:left;
border:1px solid;	
	
}
#container{

font-size:14px;
margin-left:40px;
}
 
</style>
<?php
$db = mysql_connect("localhost", "root", "");
if(!mysql_select_db("igen", $db)){
    print mysql_error();
}else{

echo 12;
}
$no = 1;
$page = $no / 12;
if ($no % 12)
    $page++;

for ($j = 1; $j <= $page; $j++) {
    
    
  
               
		echo"<table>";
$sql_p = mysql_query("SELECT * FROM p_particular WHERE id=".$_GET['form']);
while($row_p=mysql_fetch_array($sql_p)){

$sql_e = mysql_query("SELECT * FROM employee WHERE id='".$row_p['emp_id']."'");
while($row_e=mysql_fetch_array($sql_e)){
$emp_name=$row_e['full_name'];
$emp_id=$row_e['id'];
}
?> 
<tr><td>
CURRENT REVIEW PERIOD : </td>
<td><input type="text" name="peroid" id="peroid" value="<?php echo $row_p['c_peroid'] ; ?>" readonly></td></tr><tr>
<td> FROM :</td><td>
<input type="text" name="from" id="from" value="<?php echo $row_p['p_from'] ; ?>" readonly></td></tr><tr>
<td> TO :</td><td>
<input type="text" name="to" id="to" value="<?php echo $row_p['p_to'] ; ?>" readonly></td>
</tr>

</table>
<table style="margin-left:450px; margin-top:-70px">
<tr>
<td> Name :</td><td>
<input type="text"   value="<?php echo $emp_name ; ?> " readonly>
<input type="hidden" name="emp_id"  value="<?php echo $emp_id ; ?>">
</td>

</tr>
<tr>
<td> Date Joined :</td>
<td><input type="text" name="date_joined" value="<?php echo $row_p['join_date']; ?>" readonly></td>
</tr>
<tr>
<td> Company :</td>
<td><input type="text" name="company" value="<?php echo $row_p['company']; ?>" readonly></td>
</tr>

</table>
				   
     
				  
				  
                 
<?php 
}

$sql_result8 = mysql_query("SELECT * FROM draft_group WHERE p_id=".$_GET['form']);

?>
<table id="e">
<?php

while($rows_group=mysql_fetch_array($sql_result8)){


?>
<tr id="up" ><td style="font-size:15px; font-weight:bold"> <?php echo $rows_group['group_name'] ;  ?></td>
          <td> </td><td> </td>
</tr>
<?php 
$sql_result10 = mysql_query("SELECT * FROM draft_sub WHERE group_id='".$rows_group['id']."'");
while($row_sub=mysql_fetch_array($sql_result10)){
?>

<tr class="lower"><td style="font-size:15px; font-weight:bold"><?php echo $row_sub['sub_name'];  ?>	
			
</td>
<td style="width:150px; ">
Points </td><td>
Remarks </td>
</tr>
<?php  
$name=""; 
$sql_result9 = mysql_query("SELECT * FROM appraisal_draft  WHERE sub_id=" . $row_sub['id'] . ";");
while($row_q=mysql_fetch_array($sql_result9)){
if($row_q['appraisee_comment']!=""){
$name=$emp_name.":";
}else{
$name="";
}

$sql_audit = mysql_query("SELECT * FROM `appraisal_audit` WHERE q_id=" . $row_q['id'] . ";");
$count=mysql_num_rows($sql_audit);
$row=mysql_fetch_array($sql_audit);
$audit_id=$row['id'];

?>
<tr class="lower">
<td>
<p style="font-size:15px; font-weight:bold"><?php echo $row_q['id']."-".$row_q['question']."</p>".$row_q['description']; ?> 
<input type="hidden" name="question[]" value="<?php echo  $row_q['id']; ?>">
<input type="hidden" name="question1[]" value="<?php echo $row_q['question']; ?>">
<input type="hidden" name="q_desc[]" value="<?php echo $row_q['comment']; ?>" >

</td>
<td> 

<?php  
$sql_rate = mysql_query("SELECT * FROM rating");
echo'<select name="rating[]" id="coment">';
while($row_r=mysql_fetch_array($sql_rate)){
for($i=$row_r['r_from']; $i<=$row_r['r_to'];  $i++){
if($i==$row_q['rate']){
		$selected = "selected";
								
	}else{
	$selected = "";
		}
echo"<option $selected value=".$i.">".$i."</option>";

}
}

echo'</select>';
if($count>0){
$a="Change";

if($count>1){

$a="Changes";
}
?>  


<?php
}
?>
</td>
<td>
<p style="font-weight:bold">Appraiser Remarks:</P>
<textarea col="3" rows="4" style="width:250px; height:100px" name="desc[]"><?php  echo $row_q['comment'] ?> </textarea>
<?php
if($row_q['appraisee_comment']!=""){
?>
<p style="font-weight:bold">Appraisee Remarks:</P>
<textarea col="3" rows="4" style="width:250px; height:100px; background:#ddd" ><?php echo $row_q['appraisee_comment']  ?> </textarea>
<?php
}
?>
</td>
</tr>
<?php
}
?>

<?php
} 
}
?>

</table> 
<?php
}

?>