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
		  
		 $("#print_wl").click(function(){
			 $(".main_div").addClass("print");
			 $("#print, #print_wl, input.button").hide();
			 window.print();
		 });
		$("#print").click(function(){
			var emp_id = $("#emp_id").val();
			var coun_id=$("#coun_id").val();
			var all_id=$("#all_id").val();
			var office=$("#officer_id").val();
			var eff_date=$("#eff_date").val();
			var rev_date=$("#rev_date").val();
			var rev_num=$("#rev_num").val();
			var personal = [];
		 
		 if(eff_date==""){
			 personal.push("Effective Date");
		 }
		 if(rev_num==""){
			 personal.push("Revission Number");
		 }
		 if(rev_date==""){
			 personal.push("Revission Date");
		 }
		 
        var error_personal="";
        for(var i=0; i< personal.length; i++){
            error_personal = error_personal + personal[i] + "; "
        }
      
        var pers="";
     
        if(personal.length > 0){
            pers = "Please Insert : \n"+error_personal+"\n\n";
        }
		
			if(error_personal.length > 0){
					alert(pers);
			}else{
				if (confirm('Do you want to generate this warning letter?')) {
					$.ajax({
						type:"POST",
						url:"?widget=add_warningLetter",
						data:{
							emp_id:emp_id,
							coun_id:coun_id,
							all_id:all_id,
							office:office,
							eff_date:eff_date,
							rev_date:rev_date,
							rev_num:rev_num
						},
						success:function(data){
							if(data == true){
								$(".main_div").addClass("print");
								$("#print").hide();
								window.print();
							}else{
								alert("Error While Processing");
							}
						}
					})

				} else {

				}
			}
		});
    });
	function myFunction(){
		$(".main_div").removeClass("print");
		$("#print, #print_wl, input.button").show();
		location.reload();
	}
	function goto(){
		window.location="?loc=counselling";
	}
</script>
<body onafterprint="myFunction()">
<div class="main_div">
<?php if(isset($_GET['wletter']) && $_GET['wletter']!=""){
	echo '<div id="print_wl" style="float:right;"> 
			<input type="button" value="Back" class="button" onclick="goto()" style="width: 70px;"> <input type="button" value="Print" class="button" style="margin-bottom: 3px">
		</div>';
	}else{
		echo' 
		 <input type="button" value="Back" class="button" onclick="goto()" style="width: 70px; float: right;"><div id="print" style="float:right;"> 
			 <input type="button" value="Print" class="button" style="margin-bottom: 3px">
		</div>';
	}
?>



    <div id="con">
    <div id="collapseone" class="panel-collapse" >
			<div class="panel-body">
				<div id="form-body">
				<?php
					if(isset($_GET['viewid']) && $_GET['viewid']!=""){
						$dp_id=base64_decode($_GET['viewid']);
						//Employee
						$query = mysql_query('SELECT coun.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid, c.logo_img, g.group_name from employee e INNER JOIN counselling coun on e.id = coun.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id INNER JOIN company c on e.company_id=c.id INNER JOIN emp_group g on e.group_id=g.id where coun.id='. $dp_id . ';');
						$row = mysql_fetch_array($query);
						
						//Counsellor
						$query_officer = mysql_query('SELECT e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid, g.group_name from employee e  INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id  INNER JOIN emp_group g on e.group_id=g.id where e.id='. $emp_id . ';');
						$row_officer = mysql_fetch_array($query_officer);
						//Allegation
						$query_all = mysql_query('SELECT offence_date, location from disciplinary_pinfo where id='. $row['ref_id']. ';');
						$row_all= mysql_fetch_array($query_all);
						echo"<input type='hidden' id='emp_id' value='".$row['emp_id']."'>";
						echo"<input type='hidden' id='officer_id' value='".$emp_id."'>";
						echo"<input type='hidden' id='coun_id' value='".$dp_id."'>";
						echo"<input type='hidden' id='all_id' value='".$row['ref_id']."'>";
						echo"<input type='hidden' id='permission' value='a_hr_hide'>";
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
					<td>
					 EFFECTIVE DATE
					</td>
					<td>
					 <input type="text" value="" style="background:none; border:none" id="eff_date">
					</td>
				   </tr>
				   <tr>
				    <td>
					TITLE
					</td>
					<td>
					 STD WARNING LETTER
					</td>
					<td>
					 REVISSION NO.
					</td>
					<td>
					 <input type="text" value="" style="background:none; border:none" id="rev_num">
					</td>
				   </tr>
				   <tr>
				    <td>
					 DOC NO
					</td>
					<td>
					 HR/SOP/DISCP<?php echo str_pad($row['eid'], 3, "0", STR_PAD_LEFT) ;?>
					</td>
					<td>
					 REVISSION DATE
					</td>
					<td>
					 <input type="text" value="" style="background:none; border:none" id="rev_date">
					</td>
				   </tr>
				  </table>
					<table class="table-coun"> 
					<tr>
					<td colspan="5">
						DETAIL OF THE EMPLOYEE COMMITING OFFENCE
					</td>
					</tr>
					<tr>
					<td style="width:20%">Name</td> <td style="width:30%"><?php echo $row['full_name'] ?></td><td style="width:20%"> Employee Number</td><td style="width:30%">EMP<?php echo str_pad($row['eid'], 6, "0", STR_PAD_LEFT) ;?></td>
					</tr>
					<tr>
					<td style="width:20%"> Department </td><td style="width:30%"><?php echo $row['dep_name'] ?></td><td style="width:20%"> Deptartment </td><td style="width:30%"><?php echo $row['group_name'] ?></td>
					</tr>
					<tr>
					<td style="width:20%"> Position </td><td style="width:30%"><?php echo $row['position_name'] ?></td><td style="width:20%"> Grade </td><td style="width:30%"><?php echo $row['salary_grade'] ?></td>
					</tr>
					<tr>
					<td style="width:20%"> Offence Date </td><td style="width:30%"><?php echo date('m-d-Y', strtotime($row_all['offence_date'])) ?></td><td style="width:20%"> Location of Offence </td><td style="width:30%"><?php echo $row_all['location'] ?></td>
					</tr>
					</table>
				
					<table class="table-coun"> 
					        <tr>
							  <td>
							   NATURE OF MISCONDUCT
							  </td>
							</tr>
							<tr>
								<td><?php echo $row['misconduct'] ?></td> 
							</tr>
					</table>
					<table class="table-coun"> 
					        <tr>
							  <td>
							   ACTION AGREED FOR IMPROVEMENT BY THE EMPLOYEE COMMITTING THE OFFENCE:
							  </td>
							</tr>
							<tr>
								<td><?php echo $row['action_agreed'] ?></td>
							</tr>
					</table>
					<table class="table-coun"> 
					<tr>
					<td colspan="5">
						DETAIL OF THE OFFICER ISSUING WRITTEN WARNING
					</td>
					</tr>
					<tr>
					<td style="width:20%">Name</td> <td style="width:30%"><?php echo $row_officer['full_name'] ?></td><td style="width:20%"> Employee Number</td><td style="width:30%">EMP<?php echo str_pad($row_officer['eid'], 6, "0", STR_PAD_LEFT) ;?></td>
					</tr>
					<tr>
					<td style="width:20%"> Department </td><td style="width:30%"><?php echo $row_officer['dep_name'] ?></td><td style="width:20%"> Deptartment </td><td style="width:30%"><?php echo $row_officer['group_name'] ?></td>
					</tr>
					<tr>
					<td style="width:20%"> Position </td><td style="width:30%"><?php echo $row_officer['position_name'] ?></td><td style="width:20%"> Grade </td><td style="width:30%"><?php echo $row_officer['salary_grade'] ?></td>
					</tr>
					</table>
					    <p class="inst">Please acknowledge receipt of this letter by affixing your signature on the duplicate.</p>
						<div id="invet-title">
							Acknowledgement
					   </div>
					    <ol type="i">
							<li>I hereby confirmed that the above discussion has taken place, and all the records written above are true and correct. Acknowledge receipt of this warning</li>
							<li>I understand the nature of the misconduct and the remedial action referred to above</li>
							<li>I am aware of the fact that, in the event of this being a FINAL Warning, any further misconduct may result in dismissal.</li>
						</ol>
						<table class="table-coun"> 
							<tr>
							 <td>
							  Employee’s Signature:  _________________________________ <br><br>
							  Date: _______________________________<br><br>

							 </td>
							</tr>
						</table>
										
					<?php }else if(isset($_GET['wletter']) && $_GET['wletter']!=""){
						$dp_id=base64_decode($_GET['wletter']);
						//Employee
						$query = mysql_query('SELECT wl.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid, c.logo_img, g.group_name, coun.misconduct, coun.action_agreed from employee e INNER JOIN warning_letter wl on e.id = wl.emp_id INNER JOIN counselling coun on wl.coun_id = coun.id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id INNER JOIN company c on e.company_id=c.id INNER JOIN emp_group g on e.group_id=g.id where wl.id='. $dp_id . ';');
						$row = mysql_fetch_array($query);
						
						//Counsellor
						$query_officer = mysql_query('SELECT wl.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid, c.logo_img, g.group_name from employee e INNER JOIN warning_letter wl on e.id = wl.officer_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id INNER JOIN company c on e.company_id=c.id INNER JOIN emp_group g on e.group_id=g.id where wl.id='. $dp_id . ';');
						$row_officer = mysql_fetch_array($query_officer);
						//Allegation
						$query_all = mysql_query('SELECT offence_date, location from disciplinary_pinfo where id='. $row['alleg_id']. ';');
						$row_all= mysql_fetch_array($query_all);

						echo"<input type='hidden' id='emp_id' value='".$row['emp_id']."'>";
						echo"<input type='hidden' id='officer_id' value='".$emp_id."'>";
						echo"<input type='hidden' id='coun_id' value='".$dp_id."'>";
						echo"<input type='hidden' id='permission' value='a_hr_hide'>";
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
					<td>
					 EFFECTIVE DATE
					</td>
					<td>
					 <?php echo date('m-d-Y', strtotime($row['eff_date'])); ?>
					</td>
				   </tr>
				   <tr>
				    <td>
					TITLE
					</td>
					<td>
					 STD WARNING LETTER
					</td>
					<td>
					 REVISSION NO.
					</td>
					<td>
					 <?php echo $row['rev_num']; ?>
					</td>
				   </tr>
				   <tr>
				    <td>
					 DOC NO
					</td>
					<td>
					 HR/SOP/DISCP<?php echo str_pad($row['eid'], 3, "0", STR_PAD_LEFT) ;?>
					</td>
					<td>
					 REVISSION DATE
					</td>
					<td>
					  <?php echo date('m-d-Y', strtotime($row['rev_date']));?>
					</td>
				   </tr>
				  </table>
					<table class="table-coun"> 
					<tr>
					<td colspan="5">
						DETAIL OF THE EMPLOYEE COMMITING OFFENCE
					</td>
					</tr>
					<tr>
					<td style="width:20%">Name</td> <td style="width:30%"><?php echo $row['full_name'] ?></td><td style="width:20%"> Employee Number</td><td style="width:30%">EMP<?php echo str_pad($row['eid'], 6, "0", STR_PAD_LEFT) ;?></td>
					</tr>
					<tr>
					<td style="width:20%"> Department </td><td style="width:30%"><?php echo $row['dep_name'] ?></td><td style="width:20%"> Deptartment </td><td style="width:30%"><?php echo $row['group_name'] ?></td>
					</tr>
					<tr>
					<td style="width:20%"> Position </td><td style="width:30%"><?php echo $row['position_name'] ?></td><td style="width:20%"> Grade </td><td style="width:30%"><?php echo $row['salary_grade'] ?></td>
					</tr>
					<tr>
					<td style="width:20%"> Offence Date </td><td style="width:30%"><?php echo date('m-d-Y', strtotime($row_all['offence_date'])) ?></td><td style="width:20%"> Location of Offence </td><td style="width:30%"><?php echo $row_all['location'] ?></td>
					</tr>
					</table>
				
					<table class="table-coun"> 
					        <tr>
							  <td>
							   NATURE OF MISCONDUCT
							  </td>
							</tr>
							<tr>
								<td><?php echo $row['misconduct'] ?></td> 
							</tr>
					</table>
					<table class="table-coun"> 
					        <tr>
							  <td>
							   ACTION AGREED FOR IMPROVEMENT BY THE EMPLOYEE COMMITTING THE OFFENCE:
							  </td>
							</tr>
							<tr>
								<td><?php echo $row['action_agreed'] ?></td>
							</tr>
					</table>
					<table class="table-coun"> 
					<tr>
					<td colspan="5">
						DETAIL OF THE OFFICER ISSUING WRITTEN WARNING
					</td>
					</tr>
					<tr>
					<td style="width:20%">Name</td> <td style="width:30%"><?php echo $row_officer['full_name'] ?></td><td style="width:20%"> Employee Number</td><td style="width:30%">EMP<?php echo str_pad($row_officer['eid'], 6, "0", STR_PAD_LEFT) ;?></td>
					</tr>
					<tr>
					<td style="width:20%"> Department </td><td style="width:30%"><?php echo $row_officer['dep_name'] ?></td><td style="width:20%"> Deptartment </td><td style="width:30%"><?php echo $row_officer['group_name'] ?></td>
					</tr>
					<tr>
					<td style="width:20%"> Position </td><td style="width:30%"><?php echo $row_officer['position_name'] ?></td><td style="width:20%"> Grade </td><td style="width:30%"><?php echo $row_officer['salary_grade'] ?></td>
					</tr>
					</table>
					    <p class="inst">Please acknowledge receipt of this letter by affixing your signature on the duplicate.</p>
						<div id="invet-title">
							Acknowledgement
					   </div>
					    <ol type="i">
							<li>I hereby confirmed that the above discussion has taken place, and all the records written above are true and correct. Acknowledge receipt of this warning</li>
							<li>I understand the nature of the misconduct and the remedial action referred to above</li>
							<li>I am aware of the fact that, in the event of this being a FINAL Warning, any further misconduct may result in dismissal.</li>
						</ol>
						<table class="table-coun"> 
							<tr>
							 <td>
							  Employee’s Signature:  _________________________________ <br><br>
							  Date: _______________________________<br><br>

							 </td>
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
p.inst {
    position: relative;
    top: 16px;
}
</style>
