<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
  $sql_emp = mysql_query("SELECT DISTINCT e.full_name, e.id as eid from employee e , multiple_appraisee m WHERE e.id=m.emp_id");
  if(isset($_GET['emp'])){
	   $id="";
	   $sql_e = mysql_query("SELECT e.id as ed,e.join_date, c.name from employee e, company c where e.company_id=c.id AND e.id=".$_GET['emp']);
	   $row=mysql_fetch_array($sql_e);
	   $id=$row['ed'];
	   $j_date=date('d-m-Y', strtotime($row['join_date']));
	   $c_name=$row['name'];
  
   }
   
?>
         
		  
<script>
$(function() {
	$("select").selectBoxIt({ 

		// Uses the Twitter Bootstrap theme for the drop down
		theme: "bootstrap"

	  });

 });
</script>
<style>

              
table#e{
margin-left:-50px;

border:1px solid;
width:105.7%;
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
select#coment{
width:150px;


}
 
</style>



<div id="app">
	<div class="main_div">
		<div class="panel-group" id="accordion">
				<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a href="#collapseone" data-toggle="collapse" data-parent="accordion">PERFORMANCE APPRAISAL</a>
							</h4>
						</div>
				</div>
		</div>
		<div id="collapseone" class="panel-collapse collapse in" >
			<div class="panel-body"> 
				<p>
				<div class="header_text">
					<span>PERFORMANCE APPRAISAL ON STAFF</span> 
					<input type="button"  id="editBut" value="Done" onclick="clear1()"><input type="button" style="margin-left:5px" id="editBut" value="Back" onclick="back()">
				</div>
				<div class="main_content" >
					<div id="container" class="tablediv">
						<form action="?widget=appraisal_group" name="form1" method="post"class="appraisal-group-form">

							 <fieldset>
								<legend style="font-size: 14px; ">&nbsp;&nbsp; Part 1 Personal Particulars &nbsp;&nbsp;</legend>
								<table >

								<td> FROM :</td><td>
								<input type="text" name="from" id="from" value="<?php echo $_GET['from'];   ?>"></td></tr><tr>
								<td> TO :</td><td>
								<input type="text" name="to" id="to" value="<?php echo $_GET['to'];   ?>"></td>
								</tr>
								<tr><td>
								Appraisal Period: </td>
								<td><input type="text" name="peroid" id="peroid" value="<?php echo $_GET['peroid'];   ?>"></td></tr><tr>
								</table>

								<table style="margin-left:450px; margin-top:-120px">
								<tr>
								<td> Name :</td><td>
								<select id="emp_id" name="emp_id" onchange="getemp(this.value)">
								<option value="">--Please Select-- </option>

								<?php
								  while($row=mysql_fetch_array($sql_emp)){
								  if($id==$row['eid']){
								  $select="selected";
								  
								  }else{
								  $select="";
								  }
								  ?>
								<option <?php  echo $select; ?> value="<?php echo $row['eid'] ?>">

								<?php echo $row['full_name']  ?>
								</option>
								<?php
								}

								?>
								</select>

								</td>

								</tr>
								<tr>
								<td> Date Joined :</td>
								<td><input type="text" name="date_joined" value="<?php echo $j_date ; ?>" readonly></td>
								</tr>
								<tr>
								<td> Company :</td>
								<td><input type="text" name="company" value="<?php echo $c_name ; ?>" readonly></td>
								</tr>
								</table>
							 </fieldset>
							 <br><br>
							<fieldset>
							<legend style="font-size: 14px; ">&nbsp;&nbsp; Part 2 Personal Rating &nbsp;&nbsp;</legend>
							<p style="text-align:left;  padding-top:20px; font-weight:bold; font-size:16px">Please evaluate employee based on following point system</p>
							<table class="tabe-rating">
								<tr><td>
								RATING </td>
								<td>
								CODE </td><td>
								POINTS </td>
								</tr>
								<?php
								$sql_rating = mysql_query("SELECT * FROM rating");
								while($row_r=mysql_fetch_array($sql_rating)){

								?>
								<tr><td><?php echo $row_r['rate']; ?></td> <td><?php echo $row_r['code']; ?></td><td><?php echo $row_r['r_from']."-".$row_r['r_to']; ?></td></tr>


								<?php
								}
								?>
							</table>
							<?php
							 
						   $sql_ev = mysql_query("SELECT * FROM appraisal_cycle WHERE employee LIKE '%".$_GET['emp_id']."%';");

							$row=mysql_fetch_array($sql_ev);
							$e_name=$row['form_id'];
							$sql_result8 = mysql_query("SELECT * FROM appraisal_group where form_id=".$e_name);

							?>
							<table id="e">
							<?php

							while($rows_group=mysql_fetch_array($sql_result8)){


							?>
							<tr id="up" ><td style="font-size:15px; font-weight:bold"> <?php echo $rows_group['group_name'] ;  ?></td>
							  <td></td><td></td>
							</tr>
							<?php 
							$sql_result10 = mysql_query("SELECT * FROM sub_group WHERE group_id='".$rows_group['id']."' AND form_id='".$e_name."'");
							while($row_sub=mysql_fetch_array($sql_result10)){

							$sql_result13 = mysql_query("SELECT * FROM appraisal_questions  WHERE sub_id=" . $row_sub['id']." AND group_id=" . $rows_group['id']." AND form_id=" . $e_name);
							$coun=mysql_num_rows($sql_result13);

							?>
							<tr ><td>
							<?php

							if($coun!=0){

							?>
							<tr class="lower"><td style="font-size:15px; font-weight:bold"><?php echo $row_sub['sub_title'];  ?>	
										
							</td>
							<td style="width:150px; ">
							Points </td><td>
							Remarks </td>
							</tr>
							<?php  
							}else{
							echo"<tr>
							  <td></td>  <td></td> <td></td>
							 </tr>
							";

							} 
							$sql_result9 = mysql_query("SELECT * FROM appraisal_questions  WHERE sub_id=" . $row_sub['id'] . "  AND form_id=" . $e_name . "  AND group_id=" . $rows_group['id'] . " ;");
							while($row_q=mysql_fetch_array($sql_result9)){
							?>
							<tr class="lower">
							<td>
							<p style="font-size:15px; font-weight:bold"><?php echo $row_q['id']."-".$row_q['question']."</p>".$row_q['description']; ?> 
							<input type="hidden" name="question[]" value="<?php echo  $row_q['id']; ?>">
							<input type="hidden" name="question1[]" value="<?php echo $row_q['question']; ?>">
							<input type="hidden" name="q_desc[]" value="<?php echo $row_q['description']; ?>">
							<input type="hidden" name="sub[]" value="<?php echo $row_sub['sub_title']; ?>">
							<input type="hidden" name="group[]" value="<?php echo $rows_group['group_name']; ?>">
							</td>
							<td>

							<?php  
							$sql_rate = mysql_query("SELECT * FROM rating");
							echo'<select name="rating[]" id="coment">';
							while($row_r=mysql_fetch_array($sql_rate)){
							for($i=$row_r['r_from']; $i<=$row_r['r_to'];  $i++){

							echo"<option value=".$i.">".$i."</option>";

							}
							}
							echo'</select>';
							?>  

							</td>
							<td><textarea col="3" rows="4"  style="width:250px; height:100px"  name="desc[]"> </textarea></td>
							</tr>
							<?php
							}
							?>
							</td></tr>
							<?php 
							}
							}
							?>

							</table><br>
							<div class="action">
								<span style="font-size:16; font-weight:bold; padding-left:250px;"> Action : </span>
								<select name="act" id="coment" >
								<option value="INITIATED">Save To Draft</option>
								<option value="SUBMITTED"> Send To Appraisee </option>
								</select>
								  <span><input type="submit" value="Process" name="submit" class="button"></span>
							 </div> 
							 </fieldset>


						</form>







					 </div>
				</div></p>
			  </div>
			</div>
		</div>
	</div>
<script>
$(document).ready(function(){
    $.multistepform({
        container:'multistepform-example-container',
        form_method:'GET',
    })
	
	
	 $("select").selectBoxIt();
});

$("#from, #to").datepicker({
        dateFormat: 'dd-mm-yy'
		
		})
		$("#peroid").datepicker({
        dateFormat: 'dd-mm-yy'
		
		})
function getemp(id){
    var from =$("#from").val();
   var to =$("#to").val();
  var peroid =$("#peroid").val();
  

if(id!=""){
window.open('?loc=appraisal_group&from='+from+'&to='+to +'&peroid='+peroid +'&emp='+id, '_parent')

}

}

function clear1(){
window.open('?loc=apraisal', '_parent')

}


</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
   