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
		window.location="?loc=investigation";
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
					if(isset($_GET['viewid']) && $_GET['viewid']!=""){
						$dp_id=base64_decode($_GET['viewid']);
						
						//Accused
						$query = mysql_query('SELECT inves.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid, c.logo_img  from employee e INNER JOIN investigation inves on e.id = inves.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id INNER JOIN company c on e.company_id=c.id where inves.id='. $dp_id . ';');
						$row = mysql_fetch_array($query);
						
						//Plaintiff
						$query_plaintiff = mysql_query('SELECT inves.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid from employee e INNER JOIN investigation inves on e.id = inves.plaintiff INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where inves.id='. $dp_id . ';');
						$row_plaintiff = mysql_fetch_array($query_plaintiff);
						
						//Counsellor
						$query_counsellor = mysql_query('SELECT inves.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid from employee e INNER JOIN investigation inves on e.id = inves.invetigated_by INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where inves.id='. $dp_id . ';');
						$row_counsellor = mysql_fetch_array($query_counsellor);
						
						//Allegation
						$query_all = mysql_query('SELECT * FROM disciplinary_allegation  where ref_id='.$row['ref_id']);
						
						//witness1
						$query_witness1 = mysql_query('SELECT inves.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid from employee e INNER JOIN investigation inves on e.id = inves.witness INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where inves.id='. $dp_id . ';');
						$row_witness1 = mysql_fetch_array($query_witness1);
						//witness2
						$query_witness2 = mysql_query('SELECT inves.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid from employee e INNER JOIN investigation inves on e.id = inves.witness2 INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where inves.id='. $dp_id . ';');
						$row_witness2 = mysql_fetch_array($query_witness2);
						//witness3
						$query_witness3 = mysql_query('SELECT inves.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid from employee e INNER JOIN investigation inves on e.id = inves.witness3 INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where inves.id='. $dp_id . ';');
						$row_witness3 = mysql_fetch_array($query_witness3);
						
						$witnesses=array('1'=>$row_witness1['eid'],'2'=>$row_witness2['eid'],'3'=>$row_witness3['eid']);
					?>
					<table class="header">
				   <tr>
				    <td class='logo' style="" rowspan="4">
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
					 INVETIGATION
					</td>
				   </tr>
				   <tr>
				    <td>
					 DOC NO
					</td>
					<td>
					 HR/SOP/DISCP<?php echo str_pad($row['eid'], 3, "0", STR_PAD_LEFT) ;?>
					</td>
					
				   </tr>
				  </table>
					<table class="table-coun"> 
					<tr>
					<td colspan="5" class="top_header">
						Accused Employee Detail
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
					<td colspan="5" class="top_header">
						Plaintiff Employee Detail
					</td>
					</tr>
					<tr>
					<td style="width:20%"> Name</td> <td style="width:47%"><?php echo $row_plaintiff['full_name']; ?></td><td style="width:20%"> Employee Number</td><td style="width:30%">EMP<?php echo str_pad($row_plaintiff['eid'], 6, "0", STR_PAD_LEFT) ;?></td>
					</tr>
					<tr>
					<td style="width:20%"> Position </td><td style="width:30%"><?php echo $row_plaintiff['position_name']; ?></td><td style="width:20%"> Deptartment </td><td style="width:30%"><?php echo $row_plaintiff['dep_name']; ?></td>
					</tr>
					</table>
					<table class="table-coun">
					<tr>
					<td colspan="5" class="top_header">
						Investigation Officer
					</td>
					</tr>					
					<tr>
					<td style="width:20%"> Name</td> <td style="width:47%"><?php echo $row_counsellor['full_name'] ;?></td><td style="width:20%"> Employee Number</td><td style="width:30%">EMP<?php echo str_pad($row_counsellor['eid'], 6, "0", STR_PAD_LEFT) ;?></td>
					</tr>
					<tr>
					<td style="width:20%"> Position </td><td style="width:30%"><?php echo $row_counsellor['position_name']; ?></td><td style="width:20%"> Deptartment </td><td style="width:30%"><?php echo $row_counsellor['dep_name']; ?></td>
					</tr>
					</table>
					<table class="table-coun">
					<tr>
					<td colspan="6" class="top_header">
						Witnesses
					</td>
					</tr>	
					
					<tr>
					<td>No.</td><td> Employee Number</td> <td>Name</td><td> Department </td><td>Position</td>
					</tr>
					<?php 
					$i=1;
					 foreach($witnesses as $value){
						 $query_witnesses= mysql_query('SELECT inves.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid from employee e INNER JOIN investigation inves on e.id = inves.witness3 INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where inves.id='. $dp_id . ';');
						$row_witnesses = mysql_fetch_array($query_witnesses);
						if($row_witnesses['eid']!=""){
					?>
						<tr>
						<td> <?php echo $i;?></td><td>EMP<?php echo str_pad($row_witnesses['eid'], 6, "0", STR_PAD_LEFT) ;?></td> <td><?php echo $row_witnesses['full_name'];?></td><td> <?php echo $row_witnesses['dep_name'];?> </td><td><?php echo $row_witnesses['position_name'];?></td>
						</tr>
					<?php
							$i++;
						}					
					 }
					?>
					
					</table>
					
					<?php
					
					?>
					   <table class="table-coun"> 
						   <td colspan="4" class="top_header">
							Case Background Detail
							</td>
					        <tr>
							 <td style="width:5px;">No.</td>
							  <td>
							   Allegation/Issue
							  </td>
							</tr>
							<?php
							$i=1;
							$num_rows=mysql_num_rows($query_all);
							while($row_all = mysql_fetch_array($query_all)){
							?>
								<tr>
									<td><?php echo $i;?></td><td><?php echo $row_all['allegation'] ?></td>
								</tr>
							<?php 
								$i++;
							}
							?>
						</table>
						<?php
							if($num_rows>4){
								echo'<footer></footer>';
							}
						?>
						 <table class="table-coun"> 
					        <tr>
							  <td class="top_header">
							   Background<span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – What was the allegation / issue, how it happened, where was the location, why did it take place?</span>
							  </td>
							</tr>
							<tr>
								<td><?php echo $row['background']; ?></td>
							</tr>
						</table>
						<?php
							if($num_rows < 4){
								echo'<footer></footer>';
							}
						?>
						 <table class="table-coun"> 
					        <tr>
							  <td class="top_header">
							   Remit of Investigation <span style="text-transform: lowercase;font-weight: 100;font-size: 14px;">- What specific allegations/concerns were investigated?</span>
							  </td>
							</tr>
							<tr>
								<td><?php echo $row['remit']; ?></td>
							</tr>
						</table>
						 <table class="table-coun"> 
					        <tr>
							  <td class="top_header">
							   Investigation Process<span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – Describe method used to gather information, what documents will be reviewed?</span>
							  </td>
							</tr>
							<tr>
								<td><?php echo $row['process']; ?></td>
							</tr>
						</table>
						 <table class="table-coun"> 
					        <tr>
							  <td class="top_header">
							   Findings<span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – Summarize all findings and observations into a perspective</span>
							  </td>
							</tr>
							<tr>
								<td><?php echo $row['findings']; ?></td>
							</tr>
						</table>
						<table class="table-coun"> 
					        <tr>
							  <td class="top_header">
							   Conclusions <span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – Overall opinion based ‘on the balance of probabilities’ on whether there is evidence to support</span>
							  </td>
							</tr>
							<tr>
								<td><?php echo $row['Conclusions']; ?></td>
							</tr>
						</table>
						<table class="table-coun"> 
					        <tr>
							  <td class="top_header">
							   Recommended action 
							  </td>
							</tr>
							<tr>
								<td><?php echo $row['recommended_action']; ?></td>
							</tr>
						</table>
							
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
td.top_header {
    text-transform: uppercase;
    font-weight: bold;
   /* background: #333333;*/
   /* color: #fff;*/
    border: 1px solid #000;
}
@page {
    size: A4;
    margin: 0;
}
@media print {
    html, body {
        width: 210mm;
        height: 297mm;
    }
    footer::after {
        content: ''; display: block;
        page-break-after: always;
        page-break-inside: avoid;
        page-break-before: avoid;        
    }
    
  
}

</style>
