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
		$("#eff_date, #rev_date, #effective_date, #di_date").datepicker({
				dateFormat: 'dd M yy',
				changeMonth: true,
				changeYear: true
		  });
		  
		 $("#print").click(function(){
			 $(".main_div").addClass("print");
			 $("#print, #print_wl, input.button").hide();
			 window.print();
		 });
		$("#print_wl").click(function(){
			var emp_id= $("#emp_id").val();
			var ref_id=$("#ref_id").val();
			var generated_by=$("#officer_id").val();
			var eff_date=$("#eff_date").val();
			var rev_date=$("#rev_date").val();
			var di_date=$("#di_date").val();
			var effective_date=$("#effective_date").val();
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
		 if(di_date==""){
			 personal.push("Domestic Inquiry will be held on");
		 }
		 if(effective_date==""){
			 personal.push("Effect from the");
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
				if (confirm('Do you want to generate Domestic Inquiry Letter?')) {
					$.ajax({
						type:"POST",
						url:"?widget=add_di",
						data:{
							emp_id:emp_id,
							ref_id:ref_id,
							generated_by:generated_by,
							eff_date:eff_date,
							rev_date:rev_date,
							rev_num:rev_num,
							di_date:di_date,
							effective_date:effective_date
						},
						success:function(data){
							if(data == true){
								$(".main_div").addClass("print");
								 $("#print, #print_wl, input.button").hide();
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
		 $("#print").click(function(){
			 $(".main_div").addClass("print");
			 $("#print, #print_wl, input.button").hide();
			 window.print();
		 });
		$("#edit").click(function(){
			var emp_id= $("#emp_id").val();
			var ref_id=$("#ref_id").val();
			var generated_by=$("#officer_id").val();
			var eff_date=$("#eff_date").val();
			var rev_date=$("#rev_date").val();
			var di_date=$("#di_date").val();
			var effective_date=$("#effective_date").val();
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
		 if(di_date==""){
			 personal.push("Domestic Inquiry will be held on");
		 }
		 if(effective_date==""){
			 personal.push("Effect from the");
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
				if (confirm('Do you want to Update?')) {
					$.ajax({
						type:"POST",
						url:"?widget=edit_di",
						data:{
							emp_id:emp_id,
							id:ref_id,
							generated_by:generated_by,
							eff_date:eff_date,
							rev_date:rev_date,
							rev_num:rev_num,
							di_date:di_date,
							effective_date:effective_date
						},
						success:function(data){
							if(data == true){
								alert("Updated");
								window.location = '?loc=domestic_inquiry';
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
	function goto(id){
		var url="";
		if(id==1){
			url="disciplinary";
		}else{
			url="domestic_inquiry";
		}
		window.location="?loc="+url;
	}
</script>
<body onafterprint="myFunction()">
<div class="main_div">
<?php if(isset($_GET['wletter']) && $_GET['wletter']!=""){

	echo '<div id="print_wl" style="float:right;"> 
			<input type="button" value="Print" class="button" style="margin-bottom: 3px">
		</div><input type="button" value="Back" class="button" onclick="goto(1)" style="width: 70px; float: right;"> ';
	}if(isset($_GET['viewid']) && $_GET['viewid']!=""){
		 $url="disciplinary";
		echo '<div id="edit" style="float:right;"> 
			<input type="button" value="Save" class="button" style="margin-bottom: 3px">
		</div><input type="button" value="Back" class="button" onclick="goto(2)" style="width: 70px; float: right;"> ';
	}else{
		echo' 
		 <input type="button" value="Back" class="button" onclick="goto(3)" style="width: 70px; float: right;"><div id="print" style="float:right;"> 
			 <input type="button" value="Print" class="button" style="margin-bottom: 3px">
		</div>';
	}
?>



    <div id="con">
    <div id="collapseone" class="panel-collapse" >
			<div class="panel-body">
				<div id="form-body">
				<?php
					if(isset($_GET['wletter']) && $_GET['wletter']!=""){
						$dp_id=base64_decode($_GET['wletter']);
						//Employee
						$query = mysql_query('SELECT dp.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid, c.logo_img, g.group_name from employee e INNER JOIN disciplinary_pinfo dp on e.id = dp.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id INNER JOIN company c on e.company_id=c.id INNER JOIN emp_group g on e.group_id=g.id where dp.id='. $dp_id . ';');
						$row = mysql_fetch_array($query);
						
						//Counsellor
						$query_officer = mysql_query('SELECT e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid, g.group_name from employee e  INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id  INNER JOIN emp_group g on e.group_id=g.id where e.id='. $emp_id . ';');
						$row_officer = mysql_fetch_array($query_officer);
						//Allegation
						$query_all = mysql_query('SELECT * from disciplinary_allegation where ref_id='. $dp_id. ';');
						
						echo"<input type='hidden' id='emp_id' value='".$row['emp_id']."'>";
						echo"<input type='hidden' id='officer_id' value='".$emp_id."'>";
						echo"<input type='hidden' id='ref_id' value='".$dp_id."'>";

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
					 <input type="text" value="7 AUG 2019" style="background:none; border:none" id="eff_date">
					</td>
				   </tr>
				   <tr>
				    <td>
					TITLE
					</td>
					<td>
					 CHARGE SHEET FOR DOM. INQUIRY 
					</td>
					<td>
					 REVISION NO.
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
					 REVISION DATE
					</td>
					<td>
					 <input type="text" value="7 AUG 2019" style="background:none; border:none" id="rev_date">
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
					<td style="width:20%">Name</td> <td style="width:42%"><?php echo $row['full_name'] ?></td><td style="width:20%"> Employee Number</td><td style="width:30%">EMP<?php echo str_pad($row['eid'], 6, "0", STR_PAD_LEFT) ;?></td>
					</tr>
					<tr>
					<td style="width:20%"> Department </td><td style="width:30%"><?php echo $row['dep_name'] ?></td><td style="width:20%"> Deptartment </td><td style="width:30%"><?php echo $row['group_name'] ?></td>
					</tr>
					<tr>
					<td style="width:20%"> Position </td><td style="width:30%"><?php echo $row['position_name'] ?></td><td style="width:20%"> Grade </td><td style="width:30%"><?php echo $row['salary_grade'] ?></td>
					</tr>
					<tr>
					<td style="width:20%"> Offence Date </td><td style="width:30%"><?php echo date('m-d-Y', strtotime($row['offence_date'])) ?></td><td style="width:20%"> Location of Offence </td><td style="width:30%"><?php echo $row['location'] ?></td>
					</tr>
					</table>
					<div id="invet-title">
						 RE: CHARGE SHEET
					</div>
					<br>
					 <p>We write to advise you that the following allegation(s) has (have) been made against you:</p> 
					 <?php
					   $i=1;
					   echo"<ol class='list-bg'>";
						while($row_all= mysql_fetch_array($query_all)){
							echo"<li> &nbsp;&nbsp;".$row_all['allegation']."</li>";
						}
						echo"</ol>";
					 ?>
				    <p> Since the above charge(s) levied against you is/are of a serious nature tantamount to gross misconduct, the company has decided to hold an inquiry into the above allegation(s). The Domestic Inquiry will be held on:<input type="text" style="background:none; border:none; width:77px" value="" id="di_date">.</p>
					<p> You are required to be present at the inquiry to answer the above allegation(s) made against you. At this inquiry, you will be accorded full opportunity to answer the allegation(s) against you by not only cross-examining such witnesses as may be produced against you but also by examining your own witnesses (if any). </p>
					<p> You may bring along any documentary or other evidence that may help you in answering the allegation(s) against you. Should you fail to be present at the inquiry, at the time, date and place indicated above, the inquiry shall proceed ex parte and appropriate action shall be taken against you.</p>
					<p> Pending the outcome of the inquiry, you are hereby suspended from duty with effect from the <input type="text" style="background:none; border:none; width:79px;" value="" id="effective_date"> on half pay in accordance with Section 14 (2) of the Employment Act 1955. During the period of suspension, you are not permitted to enter the company’s premises unless duly required to do so or with prior written consent from the company.</p>
					<p>You are advised that the company views the above allegation(s) very seriously and should you be found guilty on any one or more of the allegation(s) made against you, you will be liable to severe disciplinary action including the  punishment of dismissal, if so warranted by the facts and circumstances of the case.</p>
					    <p class="inst">Please acknowledge receipt of this letter by affixing your signature on the duplicate.</p>
						<table class="table-coun ack">
                           <tr>
						   <td id="invet-title">
							Acknowledgement
						   </td>
                            </tr>						   
							<tr>
							 <td>
							 <p>I _________________________________ hereby confirmed that the above discussion has taken place, and all the records written above are true and correct.</p>
							  <p>Employee’s Signature:  _________________________________ </p>
							  <p>Date: _______________________________</p>

							 </td>
							</tr>
						</table>
										
					<?php }else if(isset($_GET['viewid']) && $_GET['viewid']!=""){
						$id=base64_decode($_GET['viewid']);
						//Employee
						$query = mysql_query('SELECT di.*, e.full_name,p.position_name, d.dep_name, d.id as depid, g.group_name, c.logo_img from employee e INNER join di_letter di on e.id = di.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id INNER JOIN emp_group g on e.group_id=g.id INNER JOIN company c on e.company_id=c.id where di.id="' .$id.'"');
						$row = mysql_fetch_array($query);
						
						//Employee
						$query_dp = mysql_query('SELECT * from  disciplinary_pinfo where id='.$row['ref_id']. ';');
						$row_dp = mysql_fetch_array($query_dp);

						//Allegation
						$query_all = mysql_query('SELECT * from disciplinary_allegation where ref_id='. $row['ref_id']. ';');
						
						echo"<input type='hidden' id='emp_id' value='".$row['emp_id']."'>";
						echo"<input type='hidden' id='officer_id' value='".$emp_id."'>";
						echo"<input type='hidden' id='ref_id' value='".$id."'>";

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
					 <input type="text" value="<?php echo date('d M Y', strtotime($row['eff_date'])); ?>" style="background:none; border:none" id="eff_date">
					</td>
				   </tr>
				   <tr>
				    <td>
					TITLE
					</td>
					<td>
					 CHARGE SHEET FOR DOM. INQUIRY
					</td>
					<td>
					 REVISION NO.
					</td>
					<td>
					 <input type="text" value="<?php echo $row['rev_num'];?>" style="background:none; border:none" id="rev_num">
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
					 <input type="text" value="<?php echo date('d M Y', strtotime($row['rev_date'])); ?>" style="background:none; border:none" id="rev_date">
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
					<td style="width:20%">Name</td> <td style="width:42%"><?php echo $row['full_name'] ?></td><td style="width:20%"> Employee Number</td><td style="width:30%">EMP<?php echo str_pad($row['eid'], 6, "0", STR_PAD_LEFT) ;?></td>
					</tr>
					<tr>
					<td style="width:20%"> Department </td><td style="width:30%"><?php echo $row['dep_name'] ?></td><td style="width:20%"> Deptartment </td><td style="width:30%"><?php echo $row['group_name'] ?></td>
					</tr>
					<tr>
					<td style="width:20%"> Position </td><td style="width:30%"><?php echo $row['position_name'] ?></td><td style="width:20%"> Grade </td><td style="width:30%"><?php echo $row['salary_grade'] ?></td>
					</tr>
					<tr>
					<td style="width:20%"> Offence Date </td><td style="width:30%"><?php echo date('m-d-Y', strtotime($row_dp['offence_date'])) ?></td><td style="width:20%"> Location of Offence </td><td style="width:30%"><?php echo $row_dp['location'] ?></td>
					</tr>
					</table>
					<div id="invet-title">
						 RE: CHARGE SHEET
					</div>
					<br>
					 <p>We write to advise you that the following allegation(s) has (have) been made against you:</p> 
					 <?php
					   $i=1;
					   echo"<ol class='list-bg'>";
						while($row_all= mysql_fetch_array($query_all)){
							echo"<li> &nbsp;&nbsp;".$row_all['allegation']."</li>";
						}
						echo"</ol>";
					 ?>
				    <p> Since the above charge(s) levied against you is/are of a serious nature tantamount to gross misconduct, the company has decided to hold an inquiry into the above allegation(s). The Domestic Inquiry will be held on:<input type="text" style="background:none; border:none; width:77px" value="<?php echo date('d M Y', strtotime($row['di_date'])); ?>" id="di_date">.</p>
					<p> You are required to be present at the inquiry to answer the above allegation(s) made against you. At this inquiry, you will be accorded full opportunity to answer the allegation(s) against you by not only cross-examining such witnesses as may be produced against you but also by examining your own witnesses (if any). </p>
					<p> You may bring along any documentary or other evidence that may help you in answering the allegation(s) against you. Should you fail to be present at the inquiry, at the time, date and place indicated above, the inquiry shall proceed ex parte and appropriate action shall be taken against you.</p>
					<p> Pending the outcome of the inquiry, you are hereby suspended from duty with effect from the <input type="text" style="background:none; border:none; width:79px;" value="<?php echo date('d M Y', strtotime($row['effective_date'])); ?>" id="effective_date"> on half pay in accordance with Section 14 (2) of the Employment Act 1955. During the period of suspension, you are not permitted to enter the company’s premises unless duly required to do so or with prior written consent from the company.</p>
					<p>You are advised that the company views the above allegation(s) very seriously and should you be found guilty on any one or more of the allegation(s) made against you, you will be liable to severe disciplinary action including the  punishment of dismissal, if so warranted by the facts and circumstances of the case.</p>
					    <p class="inst">Please acknowledge receipt of this letter by affixing your signature on the duplicate.</p>
						<table class="table-coun ack">
                           <tr>
						   <td id="invet-title">
							Acknowledgement
						   </td>
                            </tr>						   
							<tr>
							 <td>
							 <p>I _________________________________ hereby confirmed that the above discussion has taken place, and all the records written above are true and correct.</p>
							  <p>Employee’s Signature:  _________________________________ </p>
							  <p>Date: _______________________________</p>

							 </td>
							</tr>
						</table>
										
					<?php }else if(isset($_GET['viewdi']) && $_GET['viewdi']!=""){
						$id=base64_decode($_GET['viewdi']);
						//Employee
						$query = mysql_query('SELECT di.*, e.full_name,p.position_name, d.dep_name, d.id as depid, g.group_name, c.logo_img from employee e INNER join di_letter di on e.id = di.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id INNER JOIN emp_group g on e.group_id=g.id INNER JOIN company c on e.company_id=c.id where di.id="' .$id.'"');
						$row = mysql_fetch_array($query);
						
						//Employee
						$query_dp = mysql_query('SELECT * from  disciplinary_pinfo where id='.$row['ref_id']. ';');
						$row_dp = mysql_fetch_array($query_dp);

						//Allegation
						$query_all = mysql_query('SELECT * from disciplinary_allegation where ref_id='. $row['ref_id']. ';');
						
						echo"<input type='hidden' id='emp_id' value='".$row['emp_id']."'>";
						echo"<input type='hidden' id='officer_id' value='".$emp_id."'>";
						echo"<input type='hidden' id='ref_id' value='".$id."'>";

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
					 <?php echo date('d M Y', strtotime($row['eff_date'])); ?>
					</td>
				   </tr>
				   <tr>
				    <td>
					TITLE
					</td>
					<td>
					 CHARGE SHEET FOR DOM. INQUIRY
					</td>
					<td>
					 REVISION NO.
					</td>
					<td>
						<?php echo $row['rev_num'];?>
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
					 <?php echo date('d M Y', strtotime($row['rev_date'])); ?>
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
					<td style="width:20%">Name</td> <td style="width:42%"><?php echo $row['full_name'] ?></td><td style="width:20%"> Employee Number</td><td style="width:30%">EMP<?php echo str_pad($row['eid'], 6, "0", STR_PAD_LEFT) ;?></td>
					</tr>
					<tr>
					<td style="width:20%"> Department </td><td style="width:30%"><?php echo $row['dep_name'] ?></td><td style="width:20%"> Deptartment </td><td style="width:30%"><?php echo $row['group_name'] ?></td>
					</tr>
					<tr>
					<td style="width:20%"> Position </td><td style="width:30%"><?php echo $row['position_name'] ?></td><td style="width:20%"> Grade </td><td style="width:30%"><?php echo $row['salary_grade'] ?></td>
					</tr>
					<tr>
					<td style="width:20%"> Offence Date </td><td style="width:30%"><?php echo date('m-d-Y', strtotime($row_dp['offence_date'])) ?></td><td style="width:20%"> Location of Offence </td><td style="width:30%"><?php echo $row_dp['location'] ?></td>
					</tr>
					</table>
					<div id="invet-title">
						 RE: CHARGE SHEET
					</div>
					<br>
					 <p>We write to advise you that the following allegation(s) has (have) been made against you:</p> 
					 <?php
					   $i=1;
					   echo"<ol class='list-bg'>";
						while($row_all= mysql_fetch_array($query_all)){
							echo"<li> &nbsp;&nbsp;".$row_all['allegation']."</li>";
						}
						echo"</ol>";
					 ?>
				    <p> Since the above charge(s) levied against you is/are of a serious nature tantamount to gross misconduct, the company has decided to hold an inquiry into the above allegation(s). The Domestic Inquiry will be held on: <?php echo date('d M Y', strtotime($row['di_date'])); ?>.</p>
					<p> You are required to be present at the inquiry to answer the above allegation(s) made against you. At this inquiry, you will be accorded full opportunity to answer the allegation(s) against you by not only cross-examining such witnesses as may be produced against you but also by examining your own witnesses (if any). </p>
					<p> You may bring along any documentary or other evidence that may help you in answering the allegation(s) against you. Should you fail to be present at the inquiry, at the time, date and place indicated above, the inquiry shall proceed ex parte and appropriate action shall be taken against you.</p>
					<p> Pending the outcome of the inquiry, you are hereby suspended from duty with effect from the <?php echo date('d M Y', strtotime($row['effective_date'])); ?> on half pay in accordance with Section 14 (2) of the Employment Act 1955. During the period of suspension, you are not permitted to enter the company’s premises unless duly required to do so or with prior written consent from the company.</p>
					<p>You are advised that the company views the above allegation(s) very seriously and should you be found guilty on any one or more of the allegation(s) made against you, you will be liable to severe disciplinary action including the  punishment of dismissal, if so warranted by the facts and circumstances of the case.</p>
					    <p class="inst">Please acknowledge receipt of this letter by affixing your signature on the duplicate.</p>
						<table class="table-coun ack">
                           <tr>
						   <td id="invet-title">
							Acknowledgement
						   </td>
                            </tr>						   
							<tr>
							 <td>
							 <p>I _________________________________ hereby confirmed that the above discussion has taken place, and all the records written above are true and correct.</p>
							  <p>Employee’s Signature:  _________________________________ </p>
							  <p>Date: _______________________________</p>

							 </td>
							</tr>
						</table>
					<?php }?>
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
	font-weight: bold;
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
ol.list-bg {
    position: relative;
    right: 3px;
}
table.table-coun.ack tr td {
    border: none;
    padding: 6px 10px;
}
table.table-coun.ack {
    border: 1px solid;
    /* padding: 5px; */
}
td#invet-title {
    text-decoration: underline;
    font-weight: bold;
}
input[type="text"]{
	    font-size: 13px;
}
</style>
