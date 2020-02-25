  <style>

              
table#e{
margin-left:0px;

border:1px solid;
width:80%;
border-collapse:collapse;
}
table#e #up td{

border:1px solid;
padding:10px;
text-align:left;
		
	
}
table#e .lower td{
padding:10px;
text-align:left;
border:1px solid;	
	
}

#footer {
   position:absolute;
   bottom:0;
   width:100%;
   height:60px;   /* Height of the footer */
   background:#6cf;
}
</style>
<?php 
$db = mysql_connect("localhost", "root", "");
if(!mysql_select_db("igen", $db)){
    print mysql_error();
}

$no = 1;
$page = $no / 12;
if ($no % 12)
    $page++;

for ($j = 1; $j <= $page; $j++) {
    
    
  
               
		echo"<table>";
$sql_p = mysql_query("SELECT * FROM p_particular WHERE id='".$_GET['from']."'");
while($row_p=mysql_fetch_array($sql_p)){

$sql_e = mysql_query("SELECT * FROM employee WHERE id='".$row_p['emp_id']."'");
while($row_e=mysql_fetch_array($sql_e)){
$emp_name=$row_e['full_name'];
$emp_id=$row_e['id'];
}
?> 
<tr><td>
CURRENT REVIEW PERIOD : </td>
<td><?php echo $row_p['c_peroid'] ; ?></td></tr><tr>
<td> FROM :</td><td>
<?php echo $row_p['p_from'] ; ?></td></tr><tr>
<td> TO :</td><td>
<?php echo $row_p['p_to'] ; ?></td>
</tr>

</table>
<table style="margin-left:450px; margin-top:-70px">
<tr>
<td> Name :</td><td>
<?php echo $emp_name ; ?> 

</td>

</tr>
<tr>
<td> Date Joined :</td>
<td><?php echo $row_p['join_date']; ?></td>
</tr>
<tr>
<td> Company :</td>
<td><?php echo $row_p['company']; ?></td>
</tr>

</table><br><br>
				   
     
                 
<?php 
}

$sql_result8 = mysql_query("SELECT * FROM draft_group WHERE p_id='".$_GET['from']."'");

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
<td style="width:300px">
<p style="font-size:15px; font-weight:bold"><?php echo $row_q['id']."-".$row_q['question']."</p>".$row_q['description']; ?> 
<input type="hidden" name="question[]" value="<?php echo  $row_q['id']; ?>">
<input type="hidden" name="question1[]" value="<?php echo $row_q['question']; ?>">
<input type="hidden" name="q_desc[]" value="<?php echo $row_q['comment']; ?>" >

</td>
<td> 

<?php  
$sql_rate = mysql_query("SELECT * FROM rating");

while($row_r=mysql_fetch_array($sql_rate)){
for($i=$row_r['r_from']; $i<=$row_r['r_to'];  $i++){
if($i==$row_q['rate']){
		echo $i;
								
	}else{
	
		}


}
}


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
<?php  echo $row_q['comment']; ?>
<?php
if($row_q['appraisee_comment']!=""){
?>
<p style="font-weight:bold">Appraisee Remarks:</P>
<?php echo $row_q['appraisee_comment'] ;?> 
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
<br><br>
<span >
<p> ----------------------------------------------- </p>
<h3>Name:</h3>
<h3>Date:</h3>

</span>

     
<?php
}

?>