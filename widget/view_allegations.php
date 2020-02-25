<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1" || $igen_userpermission == "2") {	  
    $emp_id = $_COOKIE['igen_id'];
} else {
    $emp_id = $_COOKIE['igen_user_id'];  
}

?>
<link type="text/css"  rel="stylesheet" href="plugins/datepicker/css/ui-lightness/jquery-ui-1.8.4.custom.css" />

<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
		$("#eff_date, #rev_date").datepicker({
				dateFormat: 'dd M yy',
				changeMonth: true,
				changeYear: true
		  });
		$("#print").click(function(){
			$(".main_div").addClass("print");
			$("#print").hide();
			window.print();
		});
    });
	function myFunction(){
		$(".main_div").removeClass("print");
		$("#print").show();
	}
	function goto(){
		window.location="?loc=disciplinary";
	}
	
</script>
<body onafterprint="myFunction()">
<div class="main_div">
<div id="print" style="float:right;"> 
    <input type="button" value="Back" class="button" onclick="goto()" style="width: 70px;"> <input type="button" value="Print" class="button" style="margin-bottom: 3px">
</div>
    <div id="con">
    <div id="collapseone" class="panel-collapse" >
			<div class="panel-body">
				<div id="form-body">
				<?php
					if(isset($_GET['appedid']) && $_GET['appedid']!=""){
						$dp_id=base64_decode($_GET['appedid']);
						//Employee
						$query = mysql_query('SELECT alleg.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid, c.logo_img from employee e INNER JOIN disciplinary_pinfo alleg on e.id = alleg.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id INNER JOIN company c on e.company_id=c.id where alleg.id='. $dp_id . ';');
						$row = mysql_fetch_array($query);
						//Counsellor
						$query_counsellor = mysql_query('SELECT alleg.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid from employee e INNER JOIN disciplinary_pinfo alleg on e.id = alleg.alleged_by INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where alleg.id='. $dp_id . ';');
						$row_counsellor = mysql_fetch_array($query_counsellor);
						//Allegation List
						$query_all_list = mysql_query('SELECT * from disciplinary_allegation where ref_id='. $dp_id . ';');
						
						//Managing Director
						$query_md = mysql_query('SELECT alleg.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid from employee e INNER JOIN disciplinary_pinfo alleg on e.id = alleg.md INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where alleg.id='. $dp_id . ';');
						$row_md = mysql_fetch_array($query_md);
						$rowNum_md=mysql_num_rows($query_md);
						echo"<input type='hidden' id='dep_id' value='".$row['depid']."'>";
						echo"<input type='hidden' id='emp_id' value='".$emp_id."'>";
						echo"<input type='hidden' id='dp_id' value='".$dp_id."'>";
						echo"<input type='hidden' id='permission' value='a_hr_hide'>";
					?>
					<table class="header">
				   <tr>
				    <td class='logo' style="width: 10%;" rowspan="4">
					 <img src="<?php echo $row['logo_img'];?>">
					</td>
				   </tr>
				   <tr>
				    
				    <td>
					 DOC TYPE
					</td>
					<td>
					 STD OPERATING PROCEDURE
					</td>
				   </tr>
				   <tr>
				    <td>
					TITLE
					</td>
					<td>
					 ALLEGATION
					</td></tr>
					 <tr><td>
					 DOC NO
					</td>
					<td>
					 HR/SOP/DISCP<?php echo str_pad($row['eid'], 3, "0", STR_PAD_LEFT) ;?>
					</td>
				   </tr>
				   
				  </table>
					<table class="table-coun"> 
					<tr>
					<td colspan="5">
						Employee’s Particular
					</td>
					</tr>
					<tr>
					<td style="width:20%"> Name</td> <td style="width:47%"><?php echo $row['full_name'] ?></td><td style="width:20%"> Employee Number</td><td style="width:30%">EMP<?php echo str_pad($row['eid'], 6, "0", STR_PAD_LEFT) ;?></td>
					</tr>
					<tr>
					<td style="width:20%"> Position </td><td style="width:30%"><?php echo $row['position_name'] ?></td><td style="width:20%"> Deptartment </td><td style="width:30%"><?php echo $row['dep_name'] ?></td>
					</tr>
					</table>
					<table class="table-coun"> 
					<tr>
					<td colspan="5">
						Made By
					</td>
					</tr>
					<tr>
					<td style="width:20%"> Name</td> <td style="width:47%"><?php echo $row_counsellor['full_name']; ?></td><td style="width:20%"> Employee Number</td><td style="width:30%">EMP<?php echo str_pad($row_counsellor['eid'], 6, "0", STR_PAD_LEFT) ;?></td>
					</tr>
					<tr>
					<td style="width:20%"> Position </td><td style="width:30%"><?php echo $row_counsellor['position_name']; ?></td><td style="width:20%"> Deptartment </td><td style="width:30%"><?php echo $row_counsellor['dep_name']; ?></td>
					</tr>
					</table>
					<table class="table-coun">
					<tr>
					<td colspan="3">
						ALLEGATION LIST
					</td>
					</tr>
                   <?php 
				    $i=1;
					while($row_all_list = mysql_fetch_array($query_all_list)){
                    ?>				   
						<tr>
						<td style="width:5%"><?php echo $i;  ?></td> <td style="width:47%"><?php echo $row_all_list['allegation'] ;?></td>
						</tr>
					<?php
					$i++;
					}
					?>
				
						</table>
					<?php if($row['inves_outcome']!=''){ ?>
					<table class="table-coun">
					<tr>
					<td colspan="<?php if($row['inves_outcome']=='Genuine'){echo 6;}else{echo 3;}  ?>">
						INVESTIGATION OUTCOME
					</td></tr><tr>
					<td>Investigation Outcome</td>
					<?php if($row['inves_outcome']=='Genuine'){?>
					<td >Comments & Recomendation </td>
					<td>Termination</td> 
					<?php }?>
					</tr>	   
					<tr>
					 <td style="width:47%"><?php echo $row['inves_outcome'] ;?></td>
					<?php if($row['inves_outcome']=='Genuine'){?>
						 <td style="width:47%"><?php echo $row['comments'] ;?></td>
						<td style="width:47%"><?php echo $row['termination'] ;?></td>
					<?php }?>
					</tr>
					</table>
					<?php } ?>
					<?php if($rowNum_md>0){?>
						<table class="table-coun"> 
						<tr>
						<td colspan="5">
							Managing Director’s Particular
						</td>
						</tr>
						<tr>
						<td style="width:20%"> Name</td> <td style="width:47%"><?php echo $row_md['full_name'] ?></td><td style="width:20%"> Employee Number</td><td style="width:30%">EMP<?php echo str_pad($row_md['eid'], 6, "0", STR_PAD_LEFT) ;?></td>
						</tr>
						<tr>
						<td style="width:20%"> Position </td><td style="width:30%"><?php echo $row_md['position_name'] ?></td><td style="width:20%"> Deptartment </td><td style="width:30%"><?php echo $row_md['dep_name'] ?></td>
						</tr>
						</table>
					<?php } ?>
										
					<?php } ?>
				   </div>
			   </div>
		   </div>
		</div>
	</div>
</body>
<style>

.main_div {
    border: 5px solid #847c7c;
    padding: 12px;
    margin: auto;
    width: 70%;
}
table tr td{
    border: 1px solid;
	padding: 3px;
}
table th {
    padding-left: 3px;
}
table {
   border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
}
td.title {
    text-align: center;
    font-size: 1.2em;
}
td.logo img {
    width: 76px;
}

table tr td {
    border: 1px solid;
    padding: 3px;
}
td.title span.private {
    padding: 0px !important;
    font-size: 14px;
    font-style: italic;
    position: relative;
    top: 20px;
    float: right;
}
tr.legend th {
    border: 1px solid;
    text-align: left;
}


.button {
    height: 30px;
    width: 70px;
    -moz-border-radius: 7px;
    border-radius: 7px;
    padding: 2px 2px;
    color: #fff;
    cursor: pointer;
    position: relative;
    /* top: -6px; */
    background: #4a6eb1;
    background-repeat: repeat-x;
    font-size: 13px;
}
table.table-coun.recommendation {
    width: 50%;
}
div#invet-title {
    position: relative;
    top: 16px;
    text-decoration: underline;
}
.main_div.print {
    padding: 4px !important;
    width: auto !important;
	border:1px solid #000 !important;
}
input[type="text"] {
    font-size: 13px;
}
</style>
