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

$precentage=array('5','10','15','20','25','30','35','40','45','50','55','60','65','70','75','80','85','90','95','100');
$rating=array('1','2','3','4','5', 'N/A');
$technical_skills=array("Technical accuracy of work","Ability to resolve technical problems ","Ability to check wrk carefully and accurately","Lateral thinking ability (extent to which this is applied)",
						"Knowledge of appropriate codes, standards, and industry norms","Presentation skills","Computer literacy","Report Writing");
$leadership=array("Personal appearance","Motivation","Interpersonal Relationship(peirs)","Interpersonal Relationship(with supervisor)",
				  "Sense of urgency","Participation","Committment");
$quality=array("Flawless execution","Teamwork","Edge in performance","Meticulous",
				  "Work planning","Flexibility","Creative","Consistency");
$productivity=array("Time management","Housekeeping","Value added","Cost saving",
				  "Responsiveness","Punctuality","Attendance");				  
$query = mysql_query('SELECT e.full_name, e.join_date, d.dep_name, u.a_hr, d.id as depid, p.position_name, e.id as empid, c.logo_img from employee e INNER JOIN department d on d.id=e.dep_id INNER JOIN position p on p.id=e.position_id INNER JOIN user_permission u on e.level_id=u.id INNER JOIN company c on e.company_id = c.id WHERE e.id=' . $emp_id . ';');
$row = mysql_fetch_array($query);

//$query_emSup = mysql_query('SELECT e.full_name, e.dep_id, e.id as eid from employee e INNER join approval a on e.id = a.superior_1 where a.dep_id=(SELECT dep_id from employee where id=' .$emp_id. ')');
//Immediate Supervisor
$query_emSup = mysql_query('SELECT e.full_name, e.level_id, e.id as eid FROM employee e, user_permission u WHERE e.level_id=u.id AND u.a_hr!="a_hr_hide" AND u.appraisal="appraisal_show" ORDER BY full_name');
//Tagged Manager
$query_emTaged = mysql_query('SELECT e.full_name, e.level_id, e.id as eid FROM employee e, user_permission u WHERE e.level_id=u.id AND u.a_hr!="a_hr_hide" AND u.appraisal="appraisal_show" AND e.id!="'.$emp_id.'" ORDER BY full_name');


$emp_rate="";
$sup_rate="";
if($row['a_hr']=="a_hr_hide"){
	$sup_rate="disabled";
	echo"<input type='hidden' id='s_disable' value='".$sup_rate."'>";
}else{
	$emp_rate="disabled";
	echo"<input type='hidden' id='e_disable' value='".$emp_rate."'>";
}
echo"<input type='hidden' id='emp_id' value='".$emp_id."'>";
echo"<input type='hidden' id='sup_id' value='".$emp_id."'>";
echo"<input type='hidden' id='permission' value='".$row['a_hr']."'>";

/*$queryDept = mysql_query('SELECT d.dep_name, e.full_name FROM department AS d INNER JOIN  employee AS e ON d.head_emp_id=e.id  WHERE d.id = ' . $row['depid'] . ';');
$rowDept = mysql_fetch_array($queryDept);

$sql = "select full_name, id from employee  where emp_status = 'Active' AND dep_id='".$row['depid']."' AND id != " . $_GET['esemid'];
$result = mysql_query($sql);*/

?>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {

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
	
</script>
<body onafterprint="myFunction()">
<div class="main_div">
<div id="print" style="float:right;"> 
    <input type="button" value="Print" class="button">
</div>
    <div id="con">
    <div id="collapseone" class="panel-collapse" >
			<div class="panel-body">
				<div id="form-body">
				<?php
					if(isset($_GET['appedid']) && $_GET['appedid']!=""){
						$editid=base64_decode($_GET['appedid']);
						//Personal Information
						$sql=mysql_query("SELECT pi.*, e.full_name,p.position_name, d.dep_name, e.join_date, c.logo_img FROM appriasal_personal_info pi INNER JOIN employee e on e.id=pi.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id INNER JOIN company c on e.company_id=c.id where pi.id=".$editid);
						$row_pi = mysql_fetch_array($sql);
			            //Job Responsibilities
						$sql_jr=mysql_query("select * from appraisal_jr where ref_id=".$row_pi['id']);
						//Technical Skills
						$sql_tech=mysql_query("select * from appraisal_gwc where type='technical' and ref_id=".$row_pi['id']);
						//Leadership
						$sql_leadership=mysql_query("select * from appraisal_gwc where type='leadership' and ref_id=".$row_pi['id']);
						//Quality
						$sql_quality=mysql_query("select * from appraisal_gwc where type='quality' and ref_id=".$row_pi['id']);
						//Productivity
						$sql_productivity=mysql_query("select * from appraisal_gwc where type='productivity' and ref_id=".$row_pi['id']);
						//employee development
						$sql_devel=mysql_query("select * from appraisal_ed where ref_id=".$row_pi['id']);
						//Performance Evaluation
						$sql_performance=mysql_query("select * from appraisal_pes where ref_id=".$row_pi['id']);
						//Comments
						$sql_comments=mysql_query("select * from appraisal_comments where ref_id=".$row_pi['id']);
						echo"<input type='hidden' id='emp_id_edit' value='".$row_pi['emp_id']."'>";
						echo"<input type='hidden' id='editable' value='yes'>";
						echo"<input type='hidden' id='edit_id' value='".$editid."'>";
				?>
				  <table class="header">
				   <tr>
				    <td class='logo' style="">
					 <img src="<?php echo $row_pi['logo_img'];?>">
					</td>
					<td class="title">
					  EMPLOYEE PERFORMANCE <br> APPRAISAL REPORT<br>
					  <span class="private">Strictly Private & Confidential </span> 
					</td>
				   </tr>
				  </table>
					<table id="app-form-top"> 
					<tr>
					<td style="width:20%"> Name</td> <td style="width:30%"><?php echo ucwords(strtolower($row_pi['full_name'])); ?></td><td style="width:20%"> Employee Number</td><td style="width:30%">EMP<?php echo str_pad($row_pi['emp_id'], 6, "0", STR_PAD_LEFT) ;?></td>
					</tr>
					<tr>
					<td style="width:20%"> Current Position </td><td style="width:30%"><?php echo $row_pi['position_name'] ?></td><td style="width:20%"> Department </td><td style="width:30%"><?php echo $row_pi['dep_name']; ?></td>
					</tr>
					<tr>
					<td style="width:20%">Immediate Supervisor</td> <td style="width:30%">
					<?php
						$row_emSup = mysql_fetch_array($query_emSup);
								echo ucwords(strtolower($row_emSup['full_name']));
							
						?>
					</td><td style="width:20%"> Join Date</td> <td style="width:30%"><?php if($row_pi['join_date']=="0000-00-00" || $row_pi['join_date']==""){echo $row_pi['join_date'];}else{ echo date('d-m-Y', strtotime($row_pi['join_date']));} ?></td>
					</tr>
					</tr>
					<tr>
					<td style="width:20%">Type of Evaluation</td> <td style="width:30%">
						<?php echo $row_pi['type_evaluation']; ?>
					</td><td style="width:20%"> Peroid of Evaluation </td> <td style="width:30%"><?php echo $row_pi['evaluation_from'];?>&nbsp;-&nbsp;<?php echo $row_pi['evaluation_to'];?></td>
					</tr>
					<tr>
					 <td style="width:20%"> Leave Taken (days) </td> <td colspan="3">AL :<?php echo $row_pi['al'];?> &nbsp;&nbsp;EL :<?php echo $row_pi['el'];?>&nbsp;&nbsp;SL :<?php echo $row_pi['sl'];?>&nbsp;&nbsp;HL :<?php echo $row_pi['hl'];?>&nbsp;&nbsp;Unpaid :<?php echo $row_pi['unpaid_leave'];?></td></tr>
					</table>
					<table>
						<tr >
						<th colspan="3">
						LEGEND (For the purpose of rating)
						</th>
					
						</tr>
						<tr class="legend">
						<th>
						Points
						</td>
						<th style="text-align:center;">
						Code / Rating
						</td>
						<th>
						Description
						</td>
						</tr>
						<tr>
						<td>
						1.00 < x < 1.89
						</td>
						<td style="text-align:center;">
						1
						</td>
						<td>
						Needs Improvement
						</td>
						</tr>
						<tr>
						<td>
						1.90 < x < 2.89
						</td>
						<td style="text-align:center;">
						2
						</td>
						<td>
						Below Expection
						</td>
						</tr>
						<tr>
						<td>
						2.90 < x < 3.89
						</td>
						<td style="text-align:center;">
						3
						</td>
						<td>
						Meets Expectations
						</td>
						</tr>
						<tr>
						<td>
						3.90 < x < 4.50
						</td>
						<td style="text-align:center;">
						4
						</td>
						<td>
						Exceeds Expectations
						</td>
						</tr>
						<tr>
						<td>
						4.50 < x < 5.00
						</td>
						<td style="text-align:center;">
						5
						</td>
						<td>
						Exeptional
						</td>
						</tr>
					</table>
				
								<h4 class="panel-title">
									Section 1: Job Responsibilities
								</h4>
					<div id="collapsetwo" class="panel-collapse collapse in" >
						<div class="panel-body">
							<div class="table">
								<div style="">
									<table id="tbl"  border="1px solid #000" >
											<tr class="tableth">
												<th rowspan="2">Responsibility/Task/<br>Initiative </th>
												<th colspan="6">Deliverables</th>
												<th colspan="4">Comments</th>
							
											</tr>
											<tr class="tableth">
												<th >Target</th>
												<th >Actual</th>
												<th >Employee Rate</th>
												<th>Evaluator 1</th>
												<th>Evaluator 2</th>
												<th>Evaluator 3</th>
												<th>Evaluator 1</th>
												<th>Evaluator 2</th>
												<th>Evaluator 3</th>
											</tr>
											<?php
											    $total_Res_ev1=0;
												$total_Res_ev2=0;
												$total_Res_ev3=0;
												$total_Res_emp=0;
												$average_rating_jr=0;
												$row_jr_rows=mysql_num_rows($sql_jr);
												while($row_jr = mysql_fetch_array($sql_jr)){
													$total_Res_ev1=$total_Res_ev1 + $row_jr['sup_rate'];
													$total_Res_ev2=$total_Res_ev2 + $row_jr['evaluator2_rate'];
													$total_Res_ev3= $total_Res_ev3 +  $row_jr['evaluator3_rate'];
													$total_Res_emp= $total_Res_emp +  $row_jr['emp_rate'];													
												?>
					
													<tr class="tabletr" name='leave_row' style="">
														<td>
														<?php echo $row_jr['resposibility']; ?>
														</td>
														<td style="text-align:center;">
														<?php echo $row_jr['target']; ?>
														</td>
														<td style="text-align:center;">
														<?php echo $row_jr['actual']; ?>
														</td>
														<td style="text-align:center;">
														<?php echo $row_jr['emp_rate'];?>
														</td>
														<td style="text-align:center;">
														<?php echo $row_jr['sup_rate'];  ?>
														</td>
														<td style="text-align:center;">
														<?php echo $row_jr['evaluator2_rate'];  ?>
														</td>
														<td style="text-align:center;">
														<?php echo $row_jr['evaluator3_rate'];  ?>
														</td>
														<td>
														<?php echo $row_jr['sup_comment']; ?>
														</td>
														<td>
														<?php echo $row_jr['eva2_comment']; ?>
														</td>
														<td>
														<?php echo $row_jr['eva3_comment']; ?>
														</td>
		
													</tr>
												<?php
												}
												$average_rating_jr=number_format(($total_Res_ev1 + $total_Res_ev2 + $total_Res_ev3)/$row_jr_rows, 1);
												if($average_rating_jr > 5){
													$average_rating_jr=5;
												}
												?>
												<tr>
												<td colspan="3" style="text-align:right">Total</td>
												<td style="text-align:center"><?php echo $total_Res_emp; ?></td>
												<td style="text-align:center"><?php echo $total_Res_ev1; ?></td>
												<td style="text-align:center"><?php echo $total_Res_ev2; ?></td>
												<td style="text-align:center"><?php echo $total_Res_ev3; ?></td>
												<td colspan="3"></td>
												<tr>
										</table>
										
										
										
								</div>
							</div>
						</div>
					</div>
			         <footer></footer>
					<h4 class="panel-title">
						Section 2: General Work Characteristics
					</h4>
							
					<div id="collapsethree" class="panel-collapse collapse" >
						<div class="panel-body">
							<div class="table">
								<div style="">
									<table id="tbl2"  border="1px solid #000" >
											<tr class="tableth">
												<th rowspan="2" style="text-align:left;">A.Technical Skils</th>
												<th rowspan="2">Employee Rate</th>
												<th colspan="4" style="text-align:center">Evaluator Rate</th>
											</tr>
											<tr class="tableth">
												<th >Evaluator 1</th>
												<th >Evaluator 2</th>
												<th >Evaluator 3</th>
											</tr>

									<?php
											$i=1;
										    $tech_eSum=0;
											$tech_sSum=0;
											$tech_e2Sum=0;
											$tech_e3Sum=0;
											$average_rating_tech=0;
											$row_tech_rows=mysql_num_rows($sql_tech);
										while($row_tech = mysql_fetch_array($sql_tech)){
											 $id=$row_tech['id'];
											 $tech_eSum+=$row_tech['emp_rate'];
											 $tech_sSum+=$row_tech['sup_rate'];
											 $tech_e2Sum+=$row_tech['evaluator2_rate'];
											 $tech_e3Sum+=$row_tech['evaluator3_rate'];
											//foreach($technical_skills as $val){
												echo'<tr class="tabletr" name="technical">
													<td style="text-align:left;" name="t1">';
													echo $i.".".$row_tech['technical_skills'];		
												  echo'</td>
													<td style="text-align:center;">'
													.$row_tech['emp_rate'].
													'</td>
													<td style="text-align:center;">'
										             .$row_tech['sup_rate'].
													'</td>
													<td style="text-align:center;">'
										             .$row_tech['evaluator2_rate'].
													'</td>
													<td style="text-align:center;">'
										             .$row_tech['evaluator3_rate'].
													'</td>
												</tr>';
												$i++;
											//}
										}
										$i-=1;
										$average_rating_tech=number_format(($tech_sSum + $tech_e2Sum + $tech_e3Sum )/$row_tech_rows, 1);
										if($average_rating_tech > 5){
											$average_rating_tech=5;
										}
										echo'
											<tr>
											<td>Average Score :</td>
											<td style="text-align:center;">'.$tech_eSum."/".$i."=".number_format($tech_eSum/$i, 2)."=".$average_rating_tech.'</td>
											<td style="text-align:center;">'.$tech_sSum."/".$i."=".number_format($tech_sSum/$i, 2).'</td>
											<td style="text-align:center;">'.$tech_e2Sum."/".$i."=".number_format($tech_e2Sum/$i, 2).'</td>
											<td style="text-align:center;">'.$tech_e3Sum."/".$i."=".number_format($tech_e3Sum/$i, 2).'</td>
											</tr>
										';
										?>
										
									<tr class="tableth" style="text-align:left;">
										 <th colspan="3">B. Leadership/Attitude/Behavarioural Competencies</th>
	
									</tr>
									<?php
											$j=1;
											 $lead_eSum=0;
											$lead_sSum=0;
											$lead_e2Sum=0;
											$lead_e3Sum=0;
											$average_rating_lead=0;
											$row_lead_rows=mysql_num_rows($sql_leadership);
										while($row_leadership = mysql_fetch_array($sql_leadership)){
												$id=$row_leadership['id'];
												$lead_eSum +=$row_leadership['emp_rate'];
												$lead_sSum +=$row_leadership['sup_rate'];
												$lead_e2Sum +=$row_leadership['evaluator2_rate'];
												$lead_e3Sum +=$row_leadership['evaluator3_rate'];
												echo'<tr class="tabletr" name="leadership">
													<td style="text-align:left" name="l1">';
													echo $j.".".$row_leadership['technical_skills'];		
												  echo'</td>
													<td style="text-align:center;">'
														.$row_leadership['emp_rate'].
													'</td>
													<td style="text-align:center;">'
														.$row_leadership['sup_rate'].
													'</td>
													<td style="text-align:center;">'
										             .$row_leadership['evaluator2_rate'].
													'</td>
													<td style="text-align:center;">'
										             .$row_leadership['evaluator3_rate'].
													'</td>
												</tr>';
												$j++;
											}
											$j -=1;
											$average_rating_lead=number_format(($lead_sSum + $lead_e2Sum + $lead_e3Sum)/$row_lead_rows, 1);
											if($average_rating_lead > 5){
												$average_rating_lead=5;
											}
											echo'
											<tr>
											<td>Average Score :</td>
											<td style="text-align:center;">'.$lead_eSum."/".$j."=".number_format($lead_eSum/$j, 2).'</td>
											<td style="text-align:center;">'.$lead_sSum."/".$j."=".number_format($lead_sSum/$j, 2).'</td>
											<td style="text-align:center;">'.$lead_e2Sum."/".$j."=".number_format($lead_e2Sum/$j, 2).'</td>
											<td style="text-align:center;">'.$lead_e3Sum."/".$j."=".number_format($lead_e3Sum/$j, 2).'</td>
											</tr>
										';
										?>
			                        <tr class="tableth" style="text-align:left;">
										 <th colspan="3">C. Quality</th>
									</tr>
									<?php
											$j=1;
											$qlty_eSum=0;
											$qlty_sSum=0;
											$qlty_e2Sum=0;
											$qlty_e3Sum=0;
											$average_rating_qty=0;
											$row_qty_rows=mysql_num_rows($sql_quality);
										while($row_quality = mysql_fetch_array($sql_quality)){
												$id=$row_quality['id'];
												$qlty_eSum +=$row_quality['emp_rate'];
												$qlty_sSum +=$row_quality['sup_rate'];
												$qlty_e2Sum +=$row_quality['evaluator2_rate'];
												$qlty_e3Sum +=$row_quality['evaluator3_rate'];
												echo'<tr class="tabletr quality" name="quality">
													<td style="text-align:left;" id="quality'.$j.'" name="q1">';
													echo $j.".".$row_quality['technical_skills'];		
												  echo'</td>
													<td style="text-align:center;">'
													.$row_quality['emp_rate'].
													'</td>
													<td style="text-align:center;">'
													.$row_quality['sup_rate'].
													'</td>
													<td style="text-align:center;">'
										             .$row_quality['evaluator2_rate'].
													'</td>
													<td style="text-align:center;">'
										             .$row_quality['evaluator3_rate'].
													'</td>
												</tr>';
												$j++;
											}
												$j -=1;
												$average_rating_qty=number_format(($qlty_sSum + $qlty_e2Sum + $qlty_e3Sum)/$row_tech_rows, 1);
												if($average_rating_qty > 5){
													$average_rating_qty=5;
												}
											echo'
											<tr>
											<td>Average Score :</td>
											<td style="text-align:center;">'.$qlty_eSum."/".$j."=".number_format($qlty_eSum/$j, 2).'</td>
											<td style="text-align:center;">'.$qlty_sSum."/".$j."=".number_format($qlty_sSum/$j, 2).'</td>
											<td style="text-align:center;">'.$qlty_e2Sum."/".$j."=".number_format($qlty_e2Sum/$j, 2).'</td>
											<td style="text-align:center;">'.$qlty_e3Sum."/".$j."=".number_format($qlty_e3Sum/$j, 2).'</td>
											</tr>
										';
										?>
										<tr class="tableth" style="text-align:left;">
										 <th colspan="3">D. Productivity</th>
									</tr>
									<?php
											$j=1;
											$prod_eSum=0;
											$prod_sSum=0;
											$prod_e2Sum=0;
											$prod_e3Sum=0;
											$average_rating_prod=0;
											$row_prod_rows=mysql_num_rows($sql_productivity);
											while($row_prod = mysql_fetch_array($sql_productivity)){
												$id=$row_prod['id'];
												$prod_eSum +=$row_prod['emp_rate'];
												$prod_sSum +=$row_prod['sup_rate'];
												$prod_e2Sum +=$row_prod['evaluator2_rate'];
												$prod_e3Sum +=$row_prod['evaluator3_rate'];
												echo'<tr class="tabletr" name="productivity">
													<td style="text-align:left;" name="p1">';
													echo $j.".".$row_prod['technical_skills'];		
												  echo'</td>
													<td style="text-align:center;">'
													.$row_prod['emp_rate'].
													'</td>
													<td style="text-align:center;">'
													.$row_prod['sup_rate'].
													'</td>
													<td style="text-align:center;">'
										             .$row_prod['evaluator2_rate'].
													'</td>
													<td style="text-align:center;">'
										             .$row_prod['evaluator3_rate'].
													'</td>
												</tr>';
												$j++;
											}
												$j -=1;
												$average_rating_prod=number_format(($prod_sSum + $qlty_e2Sum + $qlty_e3Sum)/$row_prod_rows, 1);
												if($average_rating_prod > 5){
													$average_rating_prod=5;
												}
											echo'
											<tr>
											<td>Average Score :</td>
											<td style="text-align:center;">'.$prod_eSum."/".$j."=".number_format($prod_eSum/$j, 2).'</td>
											<td style="text-align:center;">'.$prod_sSum."/".$j."=".number_format($prod_sSum/$j, 2).'</td>
											<td style="text-align:center;">'.$prod_e2Sum."/".$j."=".number_format($prod_e2Sum/$j, 2).'</td>
											<td style="text-align:center;">'.$prod_e3Sum."/".$j."=".number_format($prod_e3Sum/$j, 2).'</td>
											</tr>
										';
										?>
								</table>	
								</div>
							</div>
						</div>
					</div>
					<footer></footer>
					<h4 class="panel-title">
						Section 3: Employee Development
					</h4>
					<div id="collapsefour" class="panel-collapse collapse" >
						<div class="panel-body">
							<div class="table">
								<div style="">
									<table id="tbl4">
											<tr class="tableth" >
												<th style="text-align:left;">Area of Improvement (For Employer/Supervisor)</th>
												<th style="text-align:left;">Comments/Action Plan (By Supervisor)</th>
											</tr>
											<?php
											while($row_dev = mysql_fetch_array($sql_devel)){
					                        ?>
													<tr class="tabletr"style="" name="development">
														<td>
														<?php echo trim($row_dev['area_improvement']);?> 
														</td>
														<td>
														<?php echo $row_dev['action_plan'];?>
														</td>
													</tr>
											<?php
											}
											?>
													
										</table>
										
								</div>
							</div>
						</div>
					</div>
						<h4 class="panel-title">
							Section 4: Performance Evaluation Summary
						</h4>
					<div id="collapsefive" class="panel-collapse collapse" >
						<div class="panel-body">
							<div class="table">
								<div style="">

									<table id="tbl4"  border="1px solid #000" >
											<tr class="tableth" >
												<th style="text-align:left;">Performance Areas</th>
												<th class="tbl4-center">(a)<br>Weight<br>[%]</th>
												<th class="tbl4-center">(b)<br>Rating<br>[1-5]</th>
												<th class="tbl4-center">(a*b)<br>Final Rating</th>
											</tr>
											
												<tr name="p_e_summary" class="tabletr">
													<td name='pa1'> 
													Job Responsibilities
													</td>
													<td class="tbl4-center" style="text-align:center;">
													 40
													</td>
													<td class="tbl4-center" style="text-align:center;">
													  <?php echo $average_rating_jr;?>
													</td>
													<td class="tbl4-center" style="text-align:center;">
													 <?php echo ($average_rating_jr * 0.40) ;?>
													</td>
												</tr>
												<tr name="p_e_summary" class="tabletr">
													<td name='pa1' colspan="4"> 
													 General Work Characteristics
													</td>
												</tr>
												<tr name="p_e_summary" class="tabletr">
													<td name='pa1' class="dep_perf_padding"> 
													 a) Technical Skills
													</td>
													<td class="tbl4-center" style="text-align:center;">
													 25
													</td>
													<td class="tbl4-center" style="text-align:center;">
													  <?php echo $average_rating_tech ;?>
													</td>
													<td class="tbl4-center" style="text-align:center;">
													 <?php echo ($average_rating_tech*0.25) ;?>
													</td>
													<tr name="p_e_summary" class="tabletr">
													<td name='pa1' class="dep_perf_padding"> 
													 b) Leadership/Attitude/Behavarioural Competencies
													</td>
													<td class="tbl4-center" style="text-align:center;">
													 10
													</td>
													<td class="tbl4-center" style="text-align:center;">
													  <?php echo $average_rating_lead ;?>
													</td>
													<td class="tbl4-center" style="text-align:center;">
													 <?php echo ($average_rating_lead*0.10) ;?>
													</td>
													<tr name="p_e_summary" class="tabletr">
													<td name='pa1' class="dep_perf_padding"> 
													 c) Quality
													</td>
													<td class="tbl4-center" style="text-align:center;">
													 15
													</td>
													<td class="tbl4-center" style="text-align:center;">
													  <?php echo $average_rating_qty ;?>
													</td>
													<td class="tbl4-center" style="text-align:center;">
													 <?php echo ($average_rating_qty*0.15) ;?>
													</td>
													<tr name="p_e_summary" class="tabletr">
													<td name='pa1' class="dep_perf_padding"> 
													 d) Productivity
													</td>
													<td class="tbl4-center" style="text-align:center;">
													 10
													</td>
													<td class="tbl4-center" style="text-align:center;">
													  <?php echo $average_rating_prod ;?>
													</td>
													<td class="tbl4-center" style="text-align:center;">
													 <?php echo ($average_rating_prod*0.10) ;?>
													</td>
												</tr>
											<?php
											$final_sum= ($average_rating_prod*0.10) + ($average_rating_qty*0.15) + ($average_rating_lead*0.10) + ($average_rating_tech*0.25) + ($average_rating_jr * 0.40);
											$rating_sum=$average_rating_prod + $average_rating_qty + $average_rating_lead + $average_rating_tech + $average_rating_jr;
											echo'
											<tr>
											<td style="text-align:right;">Total :</td>
											<td style="text-align:center;"> 100% </td>
											<td style="text-align:center;">'.number_format($rating_sum, 2).'</td>
											<td style="text-align:center;">'.number_format($final_sum, 2).'</td>
											</tr>
										';
											?>
												
													
										</table>
										<div class="final-res">
										  <p class="line">Overall Performance Rating : Final Point:____________________________________________________________________________ </p>
										 <span class="rect"><?php if($final_sum>=1.00 && $final_sum<=1.89){echo'<img src="images/tig.png" width="15px">';}else{echo"&nbsp;&nbsp;&nbsp;";} ?></span><span class="num">1</span>
										 <span class="rect"><?php if($final_sum>=1.90 && $final_sum<=2.89){echo'<img src="images/tig.png" width="15px">';}else{echo"&nbsp;&nbsp;&nbsp;";}?></span><span class="num">2</span>
										 <span class="rect"><?php if($final_sum>=2.90 && $final_sum<=3.89){echo'<img src="images/tig.png" width="15px">';}else{echo"&nbsp;&nbsp;&nbsp;";} ?></span><span class="num">3</span>
										 <span class="rect"><?php if($final_sum>=3.90 && $final_sum<=4.50){echo'<img src="images/tig.png" width="15px">';}else{echo"&nbsp;&nbsp;&nbsp;";} ?></span><span class="num">4</span>
										 <span class="rect"><?php if($final_sum>=4.51 && $final_sum<=5.00){echo'<img src="images/tig.png" width="15px">';}else{echo"&nbsp;&nbsp;&nbsp;";} ?></span><span class="num">5</span>
										</div>
										
								</div>
							</div>
						</div>
					</div>
						<h4 class="panel-title">
							Section 5: Comments/Means of Improvements
						</h4>
					<div id="collapsesix" class="panel-collapse collapse" >
						<div class="panel-body">
					   <table style="width:100%">
						<tr>
						<?php
						 $row_comments = mysql_fetch_array($sql_comments);
						?>
						
							<th>
							Super's Comments
							</th>									
							<th>
							 Manager's Comments
							</th>
							<th>
							 Employee's Comments
							</th>
						</tr>
						<tr>
						<td>
							<?php echo $row_comments['sup_comment']; ?>
						</td>									
						<td>
							<?php echo $row_comments['manager_comment']; ?>
						</td>
						<td>
						<?php echo $row_comments['emp_comment']; ?>
						</td>
						</tr>
					</table>
						</div>
					</div>
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
    border: 1px solid #000;
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
	border-width:2px;
}
td.title {
    text-align: center;
    font-size: 1.2em;
}
td.logo img {
    width: 212px;
}
td.logo {
    width: 28%;
    padding: 20px;
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

@page {
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
.main_div.print {
    padding: 10px !important;
    width: 90% !important;
	border:1px solid #000 !important;
}
span.rect {
    border: 1px solid #000;
    padding-left: 45px;
	padding-top: 2px;
    padding-bottom: 2px;
    border-width: 2;
}
span.num {
    padding-right: 7%;
    padding-left: 6px;
}
.final-res {
    margin-top: 20px;
}
div#print {
    margin-bottom: 3px;
}
span.rect img {
    position: relative;
    right: 21px;
}
td.dep_perf_padding {
    padding-left: 17px;
}
</style>
