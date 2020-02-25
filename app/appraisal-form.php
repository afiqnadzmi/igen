<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
if (isset($_COOKIE["igen_user_id"]) == true) {	  
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
$action=array(1=>"Save to Draft", 2=>"Submit", 3=>"2nd Evaluator", 4=>"3rd Evaluator", 5=>"3rd Finalize");				  
$query = mysql_query('SELECT e.full_name, e.join_date, d.dep_name, u.a_hr, d.id as depid, p.position_name, e.id as empid from employee e INNER JOIN department d on d.id=e.dep_id INNER JOIN position p on p.id=e.position_id INNER JOIN user_permission u on e.level_id=u.id  WHERE e.id=' . $emp_id . ';');
$row = mysql_fetch_array($query);

//$query_emSup = mysql_query('SELECT e.full_name, e.dep_id, e.id as eid from employee e INNER join approval a on e.id = a.superior_1 where a.dep_id=(SELECT dep_id from employee where id=' .$emp_id. ')');
//Immediate Supervisor
$query_emSup = mysql_query('SELECT e.full_name, e.level_id, e.id as eid FROM employee e, user_permission u WHERE e.level_id=u.id AND u.a_hr!="a_hr_hide" AND u.appraisal="appraisal_show" AND e.id !="'.$emp_id.'"ORDER BY full_name');
//Tagged Manager
$query_emTaged = mysql_query('SELECT e.full_name, e.level_id, e.id as eid FROM employee e, user_permission u WHERE e.level_id=u.id AND u.a_hr!="a_hr_hide" AND u.appraisal="appraisal_show"  ORDER BY full_name');



echo"<input type='hidden' id='emp_id' value='".$emp_id."'>";
echo"<input type='hidden' id='sup_id' value='".$emp_id."'>";

/*$queryDept = mysql_query('SELECT d.dep_name, e.full_name FROM department AS d INNER JOIN  employee AS e ON d.head_emp_id=e.id  WHERE d.id = ' . $row['depid'] . ';');
$rowDept = mysql_fetch_array($queryDept);

$sql = "select full_name, id from employee  where emp_status = 'Active' AND dep_id='".$row['depid']."' AND id != " . $_GET['esemid'];
$result = mysql_query($sql);*/

?>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tablecolor').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    });
</script>
<div class="main_div">
    <div id="con">
       <div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						PERFORMANCE APPRAISAL
					</h4>
				</div>
		</div>
	</div>
    <div id="collapseone" class="panel-collapse" >
			<div class="panel-body">
				<div id="form-body">
				<?php
					$showManager="disabled";
					$emp_rate="";
					$sup_rate="disabled";
					$eval2_rate="disabled";
					$eval3_rate="disabled";
                    $act_target="";
					$evaluator1="disabled";
					$evaluator2="disabled";
					$add="";
					if(isset($_GET['appedid']) && $_GET['appedid']!=""){
						$editid=base64_decode($_GET['appedid']);
						//Personal Information
						$sql=mysql_query("SELECT pi.*, e.full_name,p.position_name, d.dep_name, e.join_date FROM appriasal_personal_info pi INNER JOIN employee e on e.id=pi.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where pi.id=".$editid);
						$row_pi = mysql_fetch_array($sql);
						if($row_pi['evaluator2']== $emp_id || $row_pi['evaluator3']== $emp_id){
							$showManager="";
							$emp_rate="disabled";
							$act_target="disabled";
						}
						if($row_pi['supervisor_id']==$emp_id){
							echo"<input type='hidden' id='eva1_permission' value='yes'>";
							$sup_rate="";
							echo"<input type='hidden' id='s_disable' value='".$sup_rate."'>";
							$emp_rate="disabled";
							$act_target="disabled";
							echo"<input type='hidden' id='e_disable' value='".$emp_rate."'>";
						}else{
							echo"<input type='hidden' id='eva1_permission' value='no'>";
							echo"<input type='hidden' id='s_disable' value='disabled'>";
						}
						if($row_pi['emp_id']!=$emp_id){
							$emp_rate="disabled";
							$act_target="disabled";
							$add="disabled";
						}
						if($row_pi['evaluator2']==$emp_id){
							echo"<input type='hidden' id='eva2_disable' value=''>";
							echo"<input type='hidden' id='eva2_permission' value='yes'>";
							$emp_rate="disabled";
							$act_target="disabled";
							$emp_rate="disabled";
							$evaluator1="";
						}else{
							echo"<input type='hidden' id='eva2_disable' value='".$eval2_rate."'>";
							echo"<input type='hidden' id='eva2_permission' value='no'>";
						}
						if($row_pi['evaluator3']==$emp_id){
							echo"<input type='hidden' id='eva3_disable' value=''>";
							echo"<input type='hidden' id='eva3_permission' value='yes'>";
							$emp_rate="disabled";
							$act_target="disabled";
							$emp_rate="disabled";
							$evaluator2="";
						}else{
							echo"<input type='hidden' id='eva3_disable' value='".$eval3_rate."'>";
							echo"<input type='hidden' id='eva3_permission' value='no'>";
						}
                        if($row_pi['supervisor_id']==$emp_id || $row_pi['evaluator2']==$emp_id || $row_pi['evaluator3']==$emp_id){
							
							echo"<input type='hidden' id='permission' value='a_hr_view'>";
						}else{
							echo"<input type='hidden' id='permission' value='a_hr_hide'>";
						}
						$query_emSup = mysql_query('SELECT e.full_name, e.level_id, e.id as eid FROM employee e, user_permission u WHERE e.level_id=u.id AND u.a_hr!="a_hr_hide" AND u.appraisal="appraisal_show" ORDER BY full_name');
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
					<table id="app-form-top"> 
					<tr>
					<td style="width:20%">  Full Names</td> <td style="width:30%"><input type="text" id="e_name" value="<?php echo $row_pi['full_name'] ?>" disabled></td><td style="width:20%"> Employee Number</td><td style="width:30%"><input type="text" id="e_num" value="EMP<?php echo str_pad($row_pi['emp_id'], 6, "0", STR_PAD_LEFT) ;?>" disabled></td>
					</tr>
					<tr>
					<td style="width:20%"> Current Position </td><td style="width:30%"><input type="text" id="e_cp" value="<?php echo $row_pi['position_name'] ?>" disabled></td><td style="width:20%"> Dept </td><td style="width:30%"><input type="text" id="d_name" value="<?php echo $row_pi['dep_name'] ?>" disabled></td>
					</tr>
					<tr>
					<td style="width:20%">Immediate Supervisor</td> <td style="width:30%">
					<select id="e_supervisor">
						<option value="">--None--</option>
						<?php
						while($row_emSup = mysql_fetch_array($query_emSup)){
							if($row_emSup['eid']==$row_pi['supervisor_id']){
								echo'<option value="'.$row_emSup['eid'].'" selected>'.$row_emSup['full_name'].'</option>';
							}else{
								echo'<option value="'.$row_emSup['eid'].'">'.$row_emSup['full_name'].'</option>';
							}
						}
						?>
					</select>
					</td><td style="width:20%"> Join Date</td> <td style="width:30%"><input type="text" id="e_jd" value="<?php if($row_pi['join_date']=="0000-00-00" || $row_pi['join_date']==""){echo $row_pi['join_date'];}else{ echo date('d-m-Y', strtotime($row_pi['join_date']));} ?>" disabled></td>
					</tr>
					</tr>
					<tr>
					<td style="width:20%">Type of Evaluation</td> <td style="width:30%">
					 <select id="type_evaluation">
						<option value="">--None--</option>
						<option value="Annual" <?php if($row_pi['type_evaluation']=="Annual"){ echo "selected";}?>>Annual</option>
						<option value="Probationary" <?php if($row_pi['type_evaluation']=="Probationary"){ echo "selected";}?>>Probationary</option>
						<option value="First Review" <?php if($row_pi['type_evaluation']=="First Review"){ echo "selected";}?>>First Review</option>
						<option value="Second Review" <?php if($row_pi['type_evaluation']=="Second Review"){ echo "selected";}?>>Second Review</option>
						<!--<option value="Others" <?php //if($row_pi['type_evaluation']=="Others"){ echo "selected";}  ?>>Others</option>-->
					</select> <input type="text" value="<?php if($row_pi['type_evaluation']=="Others"){ echo $row_pi['type_evaluation'];}?>>" class="te-other" style="display:none">
					</td><td style="width:20%"> Peroid of Evaluation </td> <td style="width:30%"> From :&nbsp;&nbsp;<input type="text" id="f_peroid" class="colms-2" value="<?php echo $row_pi['evaluation_from'];?>" readonly>&nbsp;&nbsp To :&nbsp;&nbsp;<input type="text" id="t_peroid" class="colms-2" value="<?php echo $row_pi['evaluation_to'];?>" readonly></td>
					</tr>
					<tr>
					 <td style="width:20%" rowspan="2"> Leave Taken (days) </td> <td style="width:20%"> AL :<input type="text" id="al" class="e-leave" value="<?php echo $row_pi['al'];?>" disabled></td><td>EL :<input type="text" id="el" class="e-leave" value="<?php echo $row_pi['el'];?>" disabled></td><td>SL :<input type="text" id="sl" class="e-leave" value="<?php echo $row_pi['sl'];?>" disabled></td></tr><tr><td>HL :<input type="text" id="hl" class="e-leave" value="<?php echo $row_pi['hl'];?>" disabled></td><td>Unpaid :<input type="text" id="unpaid" class="e-leave" value="<?php echo $row_pi['unpaid_leave'];?>" disabled></td><td style="background:#272625 !important;"></td></tr>
					</table>

					<div class="legend">
						<span> RATING&nbsp;:&nbsp;(1)&nbsp;NEEDS IMPROVEMENT</span>&nbsp;&nbsp;<span>(2)&nbsp;BELOW EXPECTATION</span>&nbsp;&nbsp;<span>&nbsp;&nbsp;(3)&nbsp;&nbsp;MEETS EXPECTATION</span>&nbsp;&nbsp;<span> (4)&nbsp;EXCEEDS EXPECTATION</span>&nbsp;&nbsp;<span> (5)&nbsp;EXCEPTIONAL</span>
					</div>
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a href="#collapsetwo" data-toggle="collapse" data-parent="accordion">Section 1: Job Responsibilities</a>
								</h4>
							</div>
						</div>
					</div>
					<div id="collapsetwo" class="panel-collapse collapse in" >
						<div class="panel-body">
							<div class="table">
								<div style="">
									<table id="tbl"  border="1px solid #000" >
											<tr class="tableth">
												<th rowspan="2">Responsibility/Task/<br>Initiative </th>
												<th colspan="6">Deliverables</th>
												<th colspan="4">Comments</th>
												<th rowspan="2"> </th>
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
												<th></th>
											</tr>
											<?php
												$row_jr_rows=mysql_num_rows($sql_jr);
												while($row_jr = mysql_fetch_array($sql_jr)){
													
												?>
					
													<tr class="tabletr" name='leave_row' style="">
														<td>
														<textarea rows="30" cols="30" name="tid" id="kpi" style="height:100px !important; width:140px !important;" <?php echo $emp_rate; ?>>
														<?php echo $row_jr['resposibility']; ?>
														</textarea> 
														</td>
														<td>
														<input type="text" value="<?php echo $row_jr['target']  ?>" id="precentage"  name='ty'>
														</td>
														<td>
														 <input type="text" value="<?php echo $row_jr['actual']  ?>" id="rating"  name='cn'>
														</td>
														<td>
														<select id="e_rating" style="width: auto;"  name='r1' <?php echo $emp_rate; ?>>
															<option value="">-None-</option>
															  <?php
															  foreach($rating as $val){
																  if($row_jr['emp_rate']==$val){
																	echo'<option value="'.$val.'" selected>'.$val.'</option>';
																  }else{
																	echo'<option value="'.$val.'">'.$val.'</option>'; 
																  }
															  }
															  ?>
														 </select>
														</td>
														<td>
														<select id="s_rating" style="width: auto"  name='r2' <?php echo $sup_rate; ?>>
															<option value="">-None-</option>
															  <?php
															  foreach($rating as $val){
																  if($row_jr['sup_rate']==$val){
																	echo'<option value="'.$val.'" selected>'.$val.'</option>';
																  }else{
																	echo'<option value="'.$val.'" >'.$val.'</option>';
																  }
															  }
															  $row_jr_rows=$row_jr_rows - 1;
															  ?>
														 </select>
														</td>
														<td>
														<select id="s_rating1" style="width: auto"  name='r3' <?php echo $evaluator1; ?>>
															<option value="">-None-</option>
															  <?php
															  foreach($rating as $val){
																  if($row_jr['evaluator2_rate']==$val){
																	echo'<option value="'.$val.'" selected>'.$val.'</option>';
																  }else{
																	echo'<option value="'.$val.'" >'.$val.'</option>';
																  }
															  }
														
															  ?>
														 </select>
														</td>
														<td>
														<select id="s_rating2" style="width: auto"  name='r4' <?php echo $evaluator2; ?>>
															<option value="">-None-</option>
															  <?php
															  foreach($rating as $val){
																  if($row_jr['evaluator3_rate']==$val){
																	echo'<option value="'.$val.'" selected>'.$val.'</option>';
																  }else{
																	echo'<option value="'.$val.'" >'.$val.'</option>';
																  }
															  }
												
															  ?>
														 </select>
														</td>
														<td>
														<textarea rows="30" cols="30" name="fy" id="desc" class="e_comments"  <?php echo $sup_rate; ?>>
															<?php echo $row_jr['sup_comment']; ?>
														</textarea> 
														</td>
														<td>
														<textarea rows="30" cols="30" name="fy1" id="desc" class="e_comments"  <?php echo $evaluator1; ?>>
															<?php echo $row_jr['eva2_comment']; ?>
														</textarea> 
														</td>
														<td>
														<textarea rows="30" cols="30" name="fy2" id="desc" class="e_comments" <?php echo $evaluator2; ?>>
															<?php echo $row_jr['eva3_comment']; ?>
														</textarea> 
														</td>
														<td>
															<input type="hidden" id="resp_id" name="respid" value="<?php echo $row_jr['id'] ?>">
															<input type="hidden" id="branches" value="">
															<?php
															if($row_jr_rows==0){
																echo'<input type="button" value="+" onclick="addquestion(this)" name="addr" '.$add.' />';
															}
															?>
															<?php
															
													//if ($temp_name == $rs['full_name']) {
														
																?>
																<!--<input type='button' value=' x ' onclick='removerow(this)' />-->
																<?php
														//	}
															?>
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
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a href="#collapsethree" data-toggle="collapse" data-parent="accordion">Section 2: General Work Characteristics</a>
								</h4>
							</div>
						</div>
					</div>
					<div id="collapsethree" class="panel-collapse collapse" >
						<div class="panel-body">
							<div class="table">
								<div style="">
									<table id="tbl2"  border="1px solid #000" >
											<tr class="tableth">
												<th rowspan="2">A.Technical Skils</th>
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
										
										while($row_tech = mysql_fetch_array($sql_tech)){
											 $id=$row_tech['id'];
											//foreach($technical_skills as $val){
												echo'<tr class="tabletr" name="technical">
													<td style="background:#fff" name="t1">';
													echo $i.".".$row_tech['technical_skills'];		
												  echo'</td>
													<td>
														<select id="et_rating" style="width: auto;"  name="t2" '.$emp_rate.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	if($row_tech['emp_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';
																	}
																}
													  echo'</select>
													</td>
													<td>
														<select id="st_rating" style="width: auto"  name="t3" '.$sup_rate.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	if($row_tech['sup_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';
																	}
																}
													echo'</select>
													</td>
													<td>
														<select id="st_rating1" style="width: auto"  name="t4" '.$evaluator1.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	if($row_tech['evaluator2_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';
																	}
																}
													echo'</select>
													</td>
													<td>
														<select id="st_rating2" style="width: auto"  name="t5" '.$evaluator2.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	if($row_tech['evaluator3_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';
																	}
																}
													echo'</select>
													<input type="hidden" id="tech_id" name="techid" value="'.$id.'">
													</td>
												</tr>';
												$i++;
											//}
										}
										?>
									<tr class="tableth">
										 <th>B. Leadership/Attitude/Behavarioural Competencies</th>
										 <th ></th>
										 <th></th>
										  <th ></th>
										 <th></th>
									</tr>
									<?php
											$j=1;
										while($row_leadership = mysql_fetch_array($sql_leadership)){
												$id=$row_leadership['id'];
												echo'<tr class="tabletr" name="leadership">
													<td style="background:#fff" name="l1">';
													echo $j.".".$row_leadership['technical_skills'];		
												  echo'</td>
													<td>
														<select id="el_rating" style="width: auto;"  name="l2" '.$emp_rate.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	if($row_leadership['emp_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';
																	}
																}
													  echo'</select>
													</td>
													<td>
														<select id="sl_rating" style="width: auto"  name="l3" '.$sup_rate.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	if($row_leadership['sup_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';
																	}
																}
													echo'</select>
													</td>
													<td>
														<select id="sl_rating1" style="width: auto"  name="l4" '.$evaluator1.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	if($row_leadership['evaluator2_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';
																	}
																}
													echo'</select>
													</td>
													<td>
														<select id="sl_rating2" style="width: auto"  name="l5" '.$evaluator2.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	if($row_leadership['evaluator3_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';
																	}
																}
													echo'</select>
													<input type="hidden" id="lead_id" name="leadid" value="'.$id.'">
													</td>
												</tr>';
												$j++;
											}
										?>
			                        <tr class="tableth">
										 <th>C. Quality</th>
										 <th ></th>
										 <th></th>
										 <th ></th>
										 <th></th>
									</tr>
									<?php
											$j=1;
										while($row_quality = mysql_fetch_array($sql_quality)){
												$id=$row_quality['id'];
												echo'<tr class="tabletr quality" name="quality">
													<td style="background:#fff" id="quality'.$j.'" name="q1">';
													echo $j.".".$row_quality['technical_skills'];		
												  echo'</td>
													<td>
														<select id="eq_rating'.$j.'" style="width: auto;"  name="q2" '.$emp_rate.'>
															<option value="">--Please Select--</option>';
																foreach($rating as $val){
																	if($row_quality['emp_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';	
																	}
																}
													  echo'</select>
													</td>
													<td>
														<select id="sq_rating'.$j.'" style="width: auto"  name="q3" '.$sup_rate.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	if($row_quality['sup_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';
																	}
																}
													echo'</select>
													</td>
													<td>
														<select id="sq_rating'.$j.'" style="width: auto"  name="q4" '.$evaluator1.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	if($row_quality['evaluator2_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';
																	}
																}
													echo'</select>

													</td>
													<td>
														<select id="sq_rating'.$j.'" style="width: auto"  name="q5" '.$evaluator2.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	if($row_quality['evaluator3_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';
																	}
																}
													echo'</select>
													<input type="hidden" id="qty_id" name="qtyid" value="'.$id.'">
													</td>
												</tr>';
												$j++;
											}
										?>
										<tr class="tableth">
										 <th>D. Productivity</th>
										 <th ></th>
										 <th></th>
										 <th ></th>
										 <th></th>
									</tr>
									<?php
											$j=1;
											while($row_prod = mysql_fetch_array($sql_productivity)){
												$id=$row_prod['id'];
												echo'<tr class="tabletr" name="productivity">
													<td style="background:#fff" name="p1">';
													echo $j.".".$row_prod['technical_skills'];		
												  echo'</td>
													<td>
														<select id="ep_rating" style="width: auto;"  name="p2" '.$emp_rate.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	if($row_prod['emp_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';
																	}
																}
													  echo'</select>
													</td>
													<td>
														<select id="sp_rating" style="width: auto"  name="p3" '.$sup_rate.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	if($row_prod['sup_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';
																	}
																}
													echo'</select>
													</td>
													<td>
														<select id="sp_rating1" style="width: auto"  name="p4" '.$evaluator1.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	if($row_prod['evaluator2_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';
																	}
																}
													echo'</select>
													</td>
													<td>
														<select id="sp_rating2" style="width: auto"  name="p5" '.$evaluator2.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	if($row_prod['evaluator3_rate']==$val){
																		echo'<option value="'.$val.'" selected>'.$val.'</option>';
																	}else{
																		echo'<option value="'.$val.'">'.$val.'</option>';
																	}
																}
													echo'</select>
													<input type="hidden" id="prod_id" name="prodid" value="'.$id.'">
													</td>
												</tr>';
												$j++;
											}
										?>
								</table>	
								</div>
							</div>
						</div>
					</div>
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a href="#collapsefour" data-toggle="collapse" data-parent="accordion">Section 3: Employee Development</a>
								</h4>
							</div>
						</div>
					</div>
					<div id="collapsefour" class="panel-collapse collapse" >
						<div class="panel-body">
							<div class="table">
								<div style="">
									<table id="tbl3"  border="1px solid #000" >
											<tr class="tableth" >
												<th>Area of Improvement <br> (For Employer/Supervisor)</th>
												<th>Comments/Action Plan <br> (By Supervisor)</th>
												<th></th>
											</tr>
											<?php
											$row_jr_rows=mysql_num_rows($sql_devel);
											while($row_dev = mysql_fetch_array($sql_devel)){
					                        ?>
													<tr class="tabletr"style="" name="development">
														<td>
														<textarea rows="30" cols="50" name="ad" id="area_imp" style="height:200px !important; width: 100%;" <?php echo $emp_rate; ?>  name="d1"><?php echo trim($row_dev['area_improvement']);?></textarea> 
														</td>
														<td>
														<textarea rows="30" cols="50" id="acction_plan" style="height:200px !important; width: 100%;" <?php echo $sup_rate; ?> name="d2"><?php echo $row_dev['action_plan'];?></textarea> 
														<input type="hidden" id="dev_id" name="devdid" value="<?php echo $row_dev['id'];?>">
														</td>
														<td>
														<?php
														
														$row_jr_rows=$row_jr_rows - 1;
															if($row_jr_rows==0){
																echo'<input type="button" value="+" onclick="adddevl(this)" name="addr" '.$add.' />';
															}
														?>
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
					<!--<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a href="#collapsefive" data-toggle="collapse" data-parent="accordion">Section 4: Performance Evaluation Summary</a>
								</h4>
							</div>
						</div>
					</div>
					<div id="collapsefive" class="panel-collapse collapse" >
						<div class="panel-body">
							<div class="table">
								<div style="">
									<table id="tbl4"  border="1px solid #000" >
											<tr class="tableth" >
												<th>Performance Areas</th>
												<th class="tbl4-center">(a)<br>Weight<br>[%]</th>
												<th class="tbl4-center">(b)<br>Rating<br>[1-5]</th>
											</tr>
											<?php
											
											while($row_performance = mysql_fetch_array($sql_performance)){
												$colspan="";
												$class="";
												$performance=$row_performance['performance_area'];
												if($row_performance['performance_area']=="General Work Characteristic"){
													$performance=$performance." :";
													$colspan="colspan='3'";
												}
												if($row_performance['performance_area']=="Technical Skils"){
													$performance="a) ".$performance;
													$class="class='gwc-center'";
												}
												if($row_performance['performance_area']=="Leadership/Attitude/Behavarioural Competencies"){
													$performance="b) ".$performance;
													$class="class='gwc-center'";
												}
												if($row_performance['performance_area']=="Quality"){
													$performance="c) ".$performance;
													$class="class='gwc-center'";
												}
												if($row_performance['performance_area']=="Productivity"){
													$performance="d) ".$performance;
													$class="class='gwc-center'";
												}
											?>
												<tr name="p_e_summary" class="tabletr">
													<td name='pa1' <?php echo $colspan;?> <?php echo $class;?>> 
														<?php echo $performance;  ?>
													</td>
													<?php
													if($row_performance['performance_area']!="General Work Characteristic"){
													?>
													<td class="tbl4-center">
														<select id="weight" style="width: auto;"  name='w' <?php echo $sup_rate; ?>>
															<option value="">--Please Select--</option>
															  <?php
															  foreach($precentage as $val){
																  if($row_performance['weight']==$val){
																	echo'<option value="'.$val.'" selected>'.$val.'</option>';
																  }else{
																	echo'<option value="'.$val.'">'.$val.'</option>'; 
																  }
															  }
															  ?>
														 </select>
														</td>
														<td class="tbl4-center">
														<select id="e_rating" style="width: auto;"  name='w2' <?php echo $sup_rate; ?>>
															<option value="">--Please Select--</option>
															  <?php
															  foreach($rating as $val){
																  if($row_performance['rating']==$val){
																	echo'<option value="'.$val.'" selected>'.$val.'</option>';
																  }else{
																	echo'<option value="'.$val.'">'.$val.'</option>';  
																  }
															  }
															  ?>
														 </select>
														 <input type="hidden" id="per_id" name="perdid" value="<?php echo $row_performance['id'];?>">
														</td>
														<?php } ?>
												</tr>
											<?php
											}
											?>
												
													
										</table>
										
								</div>
							</div>
						</div>
					</div>-->
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a href="#collapsesix" data-toggle="collapse" data-parent="accordion">Section 4: Comments/Means of Improvements</a>
								</h4>
							</div>
						</div>
					</div>
					<div id="collapsesix" class="panel-collapse collapse" >
						<div class="panel-body">
					   <table style="width:100%">
						<tr>
						<?php
						 $row_comments = mysql_fetch_array($sql_comments);
						?>
						    <td>
								<h5 style="font-weight:bold;"> Employee's Comments</h5>
								<textarea rows="30" cols="50" name="employee" id="employee-comment" style="height:100px !important" <?php echo $emp_rate; ?>><?php echo $row_comments['emp_comment']; ?></textarea> 
								<input type="hidden" id="comment_id" name="commentdid" value="<?php echo $row_comments['id'];?>">
							</td>
							<td>
								<h5 style="font-weight:bold;"> Appraiser 1 Comments</h5>
								<textarea rows="30" cols="50" name="supervisor" id="supervisor-comment" style="height:100px !important" <?php echo $sup_rate; ?>><?php echo $row_comments['eva1_comment']; ?></textarea> 
							</td>
							<td>
								<h5 style="font-weight:bold;"> Appraiser 2 Comments</h5>
								<textarea rows="30" cols="50" name="supervisor2" id="supervisor2-comment" style="height:100px !important" <?php echo $evaluator1; ?>><?php echo $row_comments['eva2_comment']; ?></textarea> 
							</td>
						</tr>
						<tr>
							<td>
								<h5 style="font-weight:bold;"> Appraiser 3 Comments</h5>
								<textarea rows="30" cols="50" name="supervisor3" id="supervisor3-comment" style="height:100px !important" <?php echo $evaluator2; ?>><?php echo $row_comments['eva3_comment']; ?></textarea> 
							</td>							
						
							
						</tr>
					</table>
						</div>
					</div>
					
					<div class="action" style="padding-top: 10px;padding-bottom: 5px;text-align: center;">
						<select id="action">
						<?php
						$disable_emp="";
						$hide_sendTo="";
						if($row_pi['emp_id']!=$emp_id){
							if($row_pi['action']==2){
								  echo'<option value="2" selected>Submit</option>';
								  echo'<option value="3" >2nd Evaluator</option>';
								  echo'<option value="4">3rd Evaluator</option>';
								  echo'<option value="5">Finalize</option>';
							  }else if($row_pi['action']==3){
								  if($emp_id!=$row_pi['evaluator2']){
									echo'<option value="3" selected>2nd Evaluator</option>';
								  }
								  echo'<option value="4">3rd Evaluator</option>';
								  echo'<option value="5">Finalize</option>';
							  }else if($row_pi['action']==4){
								  $hide_sendTo="display:none;";
								  echo'<option value="5">Finalize</option>';
							  }else if($row_pi['action']==5){
								  echo'<option value="5" selected>Finalize</option>';
							  }
						}else{
							if($row_pi['action']==2){
								echo'<option value="2">Submit</option>';
							}else if($row_pi['action']==1){
								echo'<option value="1">Save to Draft</option>';
								echo'<option value="2">Submit</option>';
							}else{
								$disable_emp="disabled";
								foreach($action as $key=>$value){
									if($key==$row_pi['action']){
										echo'<option value="'.$row_pi['action'].'">'.$value.'</option>';
									}
									if($key==5){
										$display="display:none;";
									}
								}
								
							}
						}
						  ?>
						</select>
				        
						<span id="tag_to" style="display:none" <?php echo $hide_sendTo;?>>
							Send to : <select id="tagged_to" <?php echo $disable_emp; ?>>
											<option value="">--None--</option>
											<?php
											
											while($row_emTaged = mysql_fetch_array($query_emTaged)){
												
												if($row_emTaged['eid']==$row_pi['evaluator2'] && $row_pi['action']==3){
													if($row_emTaged['eid']!=$row_pi['supervisor_id'] && $row_emTaged['eid']!=$row_pi['evaluator3'] && $emp_id!=$row_pi['evaluator2']){
														echo'<option value="'.$row_emTaged['eid'].'" selected>'.$row_emTaged['full_name'].'</option>';
													}
												}else if($row_emTaged['eid']==$row_pi['evaluator3'] && $row_pi['action']==4){
													if($row_emTaged['eid']!=$row_pi['supervisor_id'] && $row_emTaged['eid']!=$row_pi['evaluator2'] && $emp_id!=$row_pi['evaluator3']){
														echo'<option value="'.$row_emTaged['eid'].'" selected>'.$row_emTaged['full_name'].'</option>';
													}
												}else{
													if($row_emTaged['eid']!=$row_pi['supervisor_id'] && $row_emTaged['eid']!=$row_pi['evaluator2'] && $row_emTaged['eid']!=$row_pi['evaluator3']){
														echo'<option value="'.$row_emTaged['eid'].'">'.$row_emTaged['full_name'].'</option>';
													}
												}
											}
											?>
							</select>
						</span>
								
						<input type="button" class="button" value="Save" onclick="save_appraisal()" style="width: 70px; <?php echo $display; ?>"/>
				
					</div>
					<?php
					}else{
						echo"<input type='hidden' id='s_disable' value='disabled'>";
						echo"<input type='hidden' id='eva3_disable' value='disabled'>";
						echo"<input type='hidden' id='eva2_disable' value='disabled'>";
						echo"<input type='hidden' id='e_disable' value=''>";
						echo"<input type='hidden' id='permission' value='a_hr_hide'>";
					?>
					<table id="app-form-top"> 
					<tr>
					<td style="width:20%">  Full Name</td> <td style="width:30%"><input type="text" id="e_name" value="<?php echo $row['full_name'] ?>" disabled></td><td style="width:20%"> Employee Number</td><td style="width:30%"><input type="text" id="e_num" value="EMP<?php echo str_pad($row['empid'], 6, "0", STR_PAD_LEFT) ;?>" disabled></td>
					</tr>
					<tr>
					<td style="width:20%"> Current Position </td><td style="width:30%"><input type="text" id="e_cp" value="<?php echo $row['position_name'] ?>" disabled></td><td style="width:20%"> Dept </td><td style="width:30%"><input type="text" id="d_name" value="<?php echo $row['dep_name'] ?>" disabled></td>
					</tr>
					<tr>
					<td style="width:20%">Immediate Supervisor</td> <td style="width:30%">
					<select id="e_supervisor">
						<option value="">--None--</option>
						<?php
						while($row_emSup = mysql_fetch_array($query_emSup)){
							echo'<option value="'.$row_emSup['eid'].'">'.$row_emSup['full_name'].'</option>';
						}
						?>
					</select>
					</td><td style="width:20%"> Join Date</td> <td style="width:30%"><input type="text" id="e_jd" value="<?php if($row['join_date']=="0000-00-00" || $row['join_date']==""){echo $row['join_date'];}else{ echo date('d-m-Y', strtotime($row['join_date']));} ?>" disabled></td>
					</tr>
					</tr>
					<tr>
					<td style="width:20%">Type of Evaluation</td> <td style="width:30%">
					 <select id="type_evaluation">
						<option value="">--None--</option>
						<option value="Annual">Annual</option>
						<option value="Probationary">Probationary</option>
						<option value="First Review">First Review</option>
						<option value="Second Review">Second Review</option>
						<!--<option value="Others">Others</option>-->
					</select> <input type="text" value="" class="te-other" style="display:none">
					</td><td style="width:20%"> Peroid of Evaluation </td> <td style="width:30%"> From :&nbsp;&nbsp;<input type="text" id="f_peroid" class="colms-2" value="" readonly>&nbsp;&nbsp To :&nbsp;&nbsp;<input type="text" id="t_peroid" class="colms-2" value="" readonly></td>
					</tr>
					<tr>
					 <td style="width:20%" rowspan="2"> Leave Taken (days) </td> <td style="width:20%"> AL :<input type="text" id="al" class="e-leave" value="<?php ?>" disabled></td><td>EL :<input type="text" id="el" class="e-leave" value="<?php ?>" disabled></td><td>SL :<input type="text" id="sl" class="e-leave" value="<?php ?>" disabled></td></tr><tr><td>HL :<input type="text" id="hl" class="e-leave" value="<?php ?>" disabled></td><td>Unpaid :<input type="text" id="unpaid" class="e-leave" value="<?php ?>" disabled></td><td style="background:#272625 !important;"></td></tr>
					</table>

					<div class="legend">
						<span> RATING&nbsp;:&nbsp;(1)&nbsp;NEEDS IMPROVEMENT</span>&nbsp;&nbsp;<span>(2)&nbsp;BELOW EXPECTATION</span>&nbsp;&nbsp;<span>&nbsp;&nbsp;(3)&nbsp;&nbsp;MEETS EXPECTATION</span>&nbsp;&nbsp;<span> (4)&nbsp;EXCEEDS EXPECTATION</span>&nbsp;&nbsp;<span> (5)&nbsp;EXCEPTIONAL</span>
					</div>
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a href="#collapsetwo" data-toggle="collapse" data-parent="accordion">Section 1: Job Resposibilities</a>
								</h4>
							</div>
						</div>
					</div>
					<div id="collapsetwo" class="panel-collapse collapse in" >
						<div class="panel-body">
							<div class="table">
								<div style="">
									<table id="tbl"  border="1px solid #000" > 
											<tr class="tableth">
												<th rowspan="2">Responsibility/Task/<br>Initiative </th>
												<th colspan="6">Deliverables</th>
												<th colspan="4">Comments</th>
												<th rowspan="2"> </th>
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
												<th></th>
											</tr>
					
													<tr class="tabletr" name='leave_row' style="">
														<td>
														<textarea rows="30" cols="30" name="tid" id="kpi" style="height:100px !important; width:140px !important;" <?php echo $emp_rate; ?>>

														</textarea> 
														</td>
														<td>
														<input type="text" value="" id="precentage"  name='ty'>
														</td>
														<td>
														 <input type="text" value="" id="rating"  name='cn'>
														</td>
															<td>
														<select id="e_rating" style="width: auto;"  name='r1' <?php echo $emp_rate; ?>>
															<option value="">-None-</option>
															  <?php
															  foreach($rating as $val){
																  echo'<option value="'.$val.'">'.$val.'</option>';
															  }
															  ?>
														 </select>
														</td>
														<td>
														<select id="s_rating" style="width: auto"  name='r2' <?php echo $sup_rate; ?>>
															<option value="">-None-</option>
															  <?php
															  foreach($rating as $val){
																  echo'<option value="'.$val.'">'.$val.'</option>';
															  }
															  ?>
														 </select>
														</td>
														<td>
														<select id="s_rating1" style="width: auto"  name='r3' <?php echo $evaluator1; ?>>
															<option value="">-None-</option>
															  <?php
															  foreach($rating as $val){
																  echo'<option value="'.$val.'">'.$val.'</option>';
															  }
														
															  ?>
														 </select>
														</td>
														<td>
														<select id="s_rating2" style="width: auto"  name='r4' <?php echo $evaluator2; ?>>
															<option value="">-None-</option>
															  <?php
															  foreach($rating as $val){
																  echo'<option value="'.$val.'">'.$val.'</option>';
															  }
												
															  ?>
														 </select>
														</td>
														<td>
														<textarea rows="30" cols="30" name="fy" id="desc" class="e_comments"  <?php echo $sup_rate; ?>>
										
														</textarea> 
														</td>
														<td>
														<textarea rows="30" cols="30" name="fy1" id="desc" class="e_comments"  <?php echo $evaluator2; ?>>
														</textarea> 
														</td>
														<td>
														<textarea rows="30" cols="30" name="fy2" id="desc" class="e_comments" <?php echo $evaluator2; ?>>
														</textarea> 
														</td>
														<td>
															<input type="hidden" id="departments" value="">
															<input type="hidden" id="branches" value="">
															<input type="button" value=" + " onclick="addquestion(this)" name="addr" /><?php
															
													//if ($temp_name == $rs['full_name']) {
																?>
																<input type='button' value=' x ' onclick='removerow(this)' />
																<?php
														//	}
															?>
														</td>
													</tr>
													
										</table>
										
								</div>
							</div>
						</div>
					</div>
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a href="#collapsethree" data-toggle="collapse" data-parent="accordion">Section 2: General Work Characteristics</a>
								</h4>
							</div>
						</div>
					</div>
					<div id="collapsethree" class="panel-collapse collapse" >
						<div class="panel-body">
							<div class="table">
								<div style="">
									<table id="tbl2"  border="1px solid #000" >
												<tr class="tableth">
												<th rowspan="2">A.Technical Skils</th>
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
											foreach($technical_skills as $val){
												echo'<tr class="tabletr" name="technical">
													<td style="background:#fff" name="t1">';
													echo $i.".".$val;		
												  echo'</td>
													<td>
														<select id="et_rating" style="width: auto;"  name="t2" '.$emp_rate.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													  echo'</select>
													</td>
													<td>
														<select id="st_rating" style="width: auto"  name="t3" '.$sup_rate.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													echo'</select>
													</td>
													<td>
														<select id="st_rating1" style="width: auto"  name="t4" '.$evaluator1.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													echo'</select>
													</td>
													<td>
														<select id="st_rating2" style="width: auto"  name="t5" '.$evaluator2.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													echo'</select></td>
												</tr>';
												$i++;
											}
										?>
									<tr class="tableth">
										 <th>B. Leadership/Attitude/Behavarioural Competencies</th>
										 <th ></th>
										 <th></th>
										 <th></th>
										 <th></th>
									</tr>
									<?php
											$j=1;
											foreach($leadership as $val){
												echo'<tr class="tabletr" name="leadership">
													<td style="background:#fff" name="l1">';
													echo $j.".".$val;		
												  echo'</td>
													<td>
														<select id="el_rating" style="width: auto;"  name="l2" '.$emp_rate.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													  echo'</select>
													</td>
													<td>
														<select id="sl_rating" style="width: auto"  name="l3" '.$sup_rate.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													echo'</select>
													</td>
													<td>
														<select id="sl_rating1" style="width: auto"  name="l4" '.$evaluator1.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													echo'</select>
													</td>
													<td>
														<select id="sl_rating2" style="width: auto"  name="l5" '.$evaluator2.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													echo'</select></td>
												</tr>';
												$j++;
											}
										?>
			                        <tr class="tableth">
										 <th>C. Quality</th>
										 <th ></th>
										 <th></th>
										 <th></th>
										 <th></th>
									</tr>
									<?php
											$j=1;
											foreach($quality as $val){
												echo'<tr class="tabletr quality" name="quality">
													<td style="background:#fff" id="quality'.$j.'" name="q1">';
													echo $j.".".$val;		
												  echo'</td>
													<td>
														<select id="eq_rating'.$j.'" style="width: auto;"  name="q2" '.$emp_rate.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													  echo'</select>
													</td>
													<td>
														<select id="sq_rating'.$j.'" style="width: auto"  name="q3" '.$sup_rate.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													echo'</select>
													</td>
													<td>
														<select id="sq_rating'.$j.'" style="width: auto"  name="q4" '.$evaluator1.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													echo'</select>

													</td>
													<td>
														<select id="sq_rating'.$j.'" style="width: auto"  name="q5" '.$evaluator2.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													echo'</select></td>
												</tr>';
												$j++;
											}
										?>
										<tr class="tableth">
										 <th>D. Productivity</th>
										 <th ></th>
										 <th></th>
										 <th></th>
										 <th></th>
									</tr>
									<?php
											$j=1;
											foreach($productivity as $val){
												echo'<tr class="tabletr" name="productivity">
													<td style="background:#fff" name="p1">';
													echo $j.".".$val;		
												  echo'</td>
													<td>
														<select id="ep_rating" style="width: auto;"  name="p2" '.$emp_rate.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													  echo'</select>
													</td>
													<td>
														<select id="sp_rating" style="width: auto"  name="p3" '.$sup_rate.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													echo'</select>
													</td>
													<td>
														<select id="sp_rating1" style="width: auto"  name="p4" '.$evaluator1.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													echo'</select>
													</td>
													<td>
														<select id="sp_rating2" style="width: auto"  name="p5" '.$evaluator2.'>
															<option value="">-None-</option>';
																foreach($rating as $val){
																	echo'<option value="'.$val.'">'.$val.'</option>';
																}
													echo'</select></td>
												</tr>';
												$j++;
											}
										?>
								</table>	
								</div>
							</div>
						</div>
					</div>
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a href="#collapsefour" data-toggle="collapse" data-parent="accordion">Section 3: Employee Development</a>
								</h4>
							</div>
						</div>
					</div>
					<div id="collapsefour" class="panel-collapse collapse" >
						<div class="panel-body">
							<div class="table">
								<div style="">
									<table id="tbl3"  border="1px solid #000" >
											<tr class="tableth" >
												<th>Area of Improvement <br> (For Employer/Supervisor)</th>
												<th>Comments/Action Plan <br> (By Supervisor)</th>
												<th></th>
											</tr>
											
					
													<tr class="tabletr"style="" name="development">
														<td>
														<textarea rows="30" cols="50" name="ad" id="area_imp" style="height:200px !important; width: 100%;" <?php echo $emp_rate; ?>  name="d1">

														</textarea> 
														</td>
														<td>
														<textarea rows="30" cols="50" id="acction_plan" style="height:200px !important; width: 100%;" <?php echo $sup_rate; ?> name="d2">

														</textarea> 
														</td>
														<td>
														<input type="button" value="+" onclick="adddevl(this)" name="addr"/>
														</td>
													</tr>
													
										</table>
										
								</div>
							</div>
						</div>
					</div>
					<!--<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a href="#collapsefive" data-toggle="collapse" data-parent="accordion">Section 4: Performance Evaluation Summary</a>
								</h4>
							</div>
						</div>
					</div>
					<div id="collapsefive" class="panel-collapse collapse" >
						<div class="panel-body">
							<div class="table">
								<div style="">
									<table id="tbl4"  border="1px solid #000" >
											<tr class="tableth" >
												<th>Performance Areas</th>
												<th class="tbl4-center">(a)<br>Weight<br>[%]</th>
												<th class="tbl4-center">(b)<br>Rating<br>[1-5]</th>
											</tr>
												<tr name="p_e_summary" class="tabletr">
													<td name='pa1'> 
													Job Resposibilities
													</td>
													<td class="tbl4-center">
														<select id="weight" style="width: auto;"  name='w' <?php echo $sup_rate; ?>>
															<option value="">--Please Select--</option>
															  <?php
															  foreach($precentage as $val){
																  echo'<option value="'.$val.'">'.$val.'</option>';
															  }
															  ?>
														 </select>
														</td>
														<td class="tbl4-center">
														<select id="e_rating" style="width: auto;"  name='w2' <?php echo $sup_rate; ?>>
															<option value="">--Please Select--</option>
															  <?php
															  foreach($rating as $val){
																  echo'<option value="'.$val.'">'.$val.'</option>';
															  }
															  ?>
														 </select>
														</td>
												</tr>
												<tr name="p_e_summary" class="tabletr">
													<td colspan="3"> 
													 <span name='pa1'>General Work Characteristic</span>:
													</td>
												</tr>
												<tr name="p_e_summary" class="tabletr">
													<td class="gwc-center"> 
														a) <span name='pa1'>Technical Skils</span>
													</td>
													<td class="tbl4-center">
														<select id="weight" style="width: auto;"  name='w' <?php echo $sup_rate; ?>>
															<option value="">--Please Select--</option>
															  <?php
															  foreach($precentage as $val){
																  echo'<option value="'.$val.'">'.$val.'</option>';
															  }
															  ?>
														 </select>
														</td>
														<td class="tbl4-center">
														<select id="e_rating" style="width: auto;"  name='w2' <?php echo $sup_rate; ?>>
															<option value="">--Please Select--</option>
															  <?php
															  foreach($rating as $val){
																  echo'<option value="'.$val.'">'.$val.'</option>';
															  }
															  ?>
														 </select>
														</td>
												</tr>
												<tr name="p_e_summary" class="tabletr">
													<td class="gwc-center"> 
														b) <span name='pa1'>Leadership/Attitude/Behavarioural Competencies</span>
													</td>
													<td class="tbl4-center">
														<select id="weight" style="width: auto;"  name='w' <?php echo $sup_rate; ?>>
															<option value="">--Please Select--</option>
															  <?php
															  foreach($precentage as $val){
																  echo'<option value="'.$val.'">'.$val.'</option>';
															  }
															  ?>
														 </select>
														</td>
														<td class="tbl4-center">
														<select id="e_rating" style="width: auto;"  name='w2' <?php echo $sup_rate; ?>>
															<option value="">--Please Select--</option>
															  <?php
															  foreach($rating as $val){
																  echo'<option value="'.$val.'">'.$val.'</option>';
															  }
															  ?>
														 </select>
														</td>
												</tr>
												<tr name="p_e_summary" class="tabletr">
													<td class="gwc-center"> 
														c) <span name='pa1'>Quality</span>
													</td>
													<td class="tbl4-center">
														<select id="weight" style="width: auto;"  name='w' <?php echo $sup_rate; ?>>
															<option value="">--Please Select--</option>
															  <?php
															  foreach($precentage as $val){
																  echo'<option value="'.$val.'">'.$val.'</option>';
															  }
															  ?>
														 </select>
														</td>
														<td class="tbl4-center">
														<select id="e_rating" style="width: auto;"  name='w2' <?php echo $sup_rate; ?>>
															<option value="">--Please Select--</option>
															  <?php
															  foreach($rating as $val){
																  echo'<option value="'.$val.'">'.$val.'</option>';
															  }
															  ?>
														 </select>
														</td>
												</tr>
												<tr name="p_e_summary" class="tabletr">
													<td class="gwc-center"> 
														d) <span name='pa1'>Productivity</span>
													</td>
													<td class="tbl4-center">
														<select id="weight" style="width: auto;"  name='w' <?php echo $sup_rate; ?>>
															<option value="">--Please Select--</option>
															  <?php
															  foreach($precentage as $val){
																  echo'<option value="'.$val.'">'.$val.'</option>';
															  }
															  ?>
														 </select>
														</td>
														<td class="tbl4-center">
														<select id="e_rating" style="width: auto;"  name='w2' <?php echo $sup_rate; ?>>
															<option value="">--Please Select--</option>
															  <?php
															  foreach($rating as $val){
																  echo'<option value="'.$val.'">'.$val.'</option>';
															  }
															  ?>
														 </select>
														</td>
												</tr>
												
													
										</table>
										
								</div>
							</div>
						</div>
					</div> -->
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a href="#collapsesix" data-toggle="collapse" data-parent="accordion">Section 4: Comments/Means of Improvements</a>
								</h4>
							</div>
						</div>
					</div>
					<div id="collapsesix" class="panel-collapse collapse" >
						<div class="panel-body">
					   <table style="width:100%">
						<tr>
						<td>
								<h5 style="font-weight:bold;"> Employee's Comments</h5>
								<textarea rows="30" cols="50" name="employee" id="employee-comment" style="height:100px !important" <?php echo $emp_rate; ?>></textarea> 
							</td>
							<td>
								<h5 style="font-weight:bold;"> Appraiser 1 Comments</h5>
								<textarea rows="30" cols="50" name="supervisor" id="supervisor-comment" style="height:100px !important" <?php echo $sup_rate; ?>></textarea> 
							</td>
							<td>
								<h5 style="font-weight:bold;"> Appraiser 2 Comments</h5>
								<textarea rows="30" cols="50" name="supervisor2" id="supervisor2-comment" style="height:100px !important" <?php echo $evaluator1; ?>></textarea> 
							</td>
						</tr>
						<tr>
							<td>
								<h5 style="font-weight:bold;"> Appraiser 3 Comments</h5>
								<textarea rows="30" cols="50" name="supervisor3" id="supervisor3-comment" style="height:100px !important" <?php echo $evaluator2; ?>></textarea> 
							</td>							
						
							
						</tr>
					</table>
						</div>
					</div>
					
					<div class="action" style="padding-top: 10px;padding-bottom: 5px;text-align: center;"> 
						<select id="action">
						  <option value="1"> Save to Draft</option>
						  <option value="2">Submit</option>
						</select>
						<input type="button" class="button" value="Save" onclick="save_appraisal()" style="width: 70px;"/>
					</div>
					<?php
					}
					?>
				   </div>
			   </div>
		   </div>
		</div>
	</div>

<script type="text/javascript">
    function view(id){
        window.location="?loc=allowance_processing&eid=" + id;
    }

	function addquestion(obj,id){
        var emp_disable=$("#e_disable").val();	
		var sup_disable=$("#s_disable").val();	
		var eva2_disable =$("#eva2_disable").val();
		var eva3_disable =$("#eva3_disable").val();		
		$.ajax({
                dataType:'json',
                url:"?widget=showappraisal_sim",
				//dataType: 'json',
               data:{
					
				},
                success:function(data){
					//var allowance=allowance("All");
					$(obj).parent().parent().after("<tr class='tabletr' name='leave_row'><td><textarea rows='30' cols='30' name='tid' id='kpi' style='height:100px !important; width:140px !important;' "+emp_disable+"></textarea></td><td><input type='text' value='' id='precentage' name='ty' autocomplete='off'></td><td><input type='text' value='' id='rating' name='cn' autocomplete='off'></td><td><select id='e_rating'  name='r1' "+emp_disable+">"+data.data2+"</select></td><td><select id='s_rating' name='r2' "+sup_disable+">"+data.data2+"</select></td><td><select id='s_rating1' name='r3' "+eva2_disable+">"+data.data2+"</select></td><td><select id='s_rating2' name='r4' "+eva3_disable+">"+data.data2+"</select></td><td><textarea rows='30' cols='30' name='fy' id='desc' class='e_comments' style='height:100px !important' "+sup_disable+"></textarea></td><td><textarea rows='30' cols='30' name='fy1' id='desc' class='e_comments' style='height:100px !important' "+eva2_disable+"></textarea></td><td><textarea rows='30' cols='30' name='fy2' id='desc' class='e_comments' style='height:100px !important' "+eva3_disable+"></textarea></td><td><input type='hidden' id='resp_id' value='' name='respid'><input type='button' value=' + ' onclick='addquestion(this)' name='addr' /><input type='button' value=' x ' onclick='removerow(this)' /></td></tr>");
					//$(obj).parent().parent().after("<tr class='tabletr' name='leave_row'><td><select id='employee' style='width: 250px;'>"+data+"</select></td><td><input name='fy' type='text' value=''/></td><td><input name='ty' type='text' value='' /></td><td><input name='days' type='text' value='' /></td><td><input type='button' value=' + ' onclick='addemployee(this,"+id+")' name='addr' /><input type='button' value=' x ' onclick='removerow(this)' /></td></tr>");
					$(obj).hide();
                    
                } 

            });	
	}
	function adddevl(obj,id){
		 var emp_disable=$("#e_disable").val();	
		 var sup_disable=$("#s_disable").val();
		$(obj).parent().parent().after("<tr class='tabletr' name='development'><td><textarea rows='30' cols='50' name='ad' id='area_imp' style='height:200px !important; width: 100%;'"+emp_disable+"></textarea></td><td><textarea rows='30' cols='50' name='d2' id='acction_plan' style='height:200px !important; width: 100%;'"+sup_disable+"></textarea></td><td><input type='hidden' id='dev_id' value='' name='devpid'><input type='button' value=' + ' onclick='adddevl(this)' name='addr' /><input type='button' value=' x ' onclick='removerow(this)' /></td></tr>");
	}
    function removerow(obj){
        $(obj).parent().parent().prev().find("[name=addr]").show();
        $(obj).parent().parent().remove();
    }
    function clearNew(){
        window.location='?loc=allowance_processing';
    }
    function addnewbox(){
        $('#addnewbox').toggle('slow');
    }
    
    function save_appraisal(){
		/*Personal Inforamtion*/
		 var full_name = $("#e_name").val();
		 var emp_num = $("#e_num").val();
		 var emp_position = $("#e_cp").val();
		 var dep_name = $("#d_name").val();
		 var immed_supervisor = $("#e_supervisor").val();
		 var join_date = $("#e_jd").val();
		 var type_evaluation = $("#type_evaluation").val();
		 var f_peroid = $("#f_peroid").val();
		 var t_peroid = $("#t_peroid").val();
		 var ann_leave = $("#al").val();
		 var emer_leave = $("#el").val();
		 var mc = $("#sl").val();
		 var holiday_leave = $("#hl").val();
		 var unpaid = $("#unpaid").val();
		 var action = $("#action").val();
		 var emp_id = $("#emp_id").val();
		 var edit_id=$("#edit_id").val();
		 var tagged="";
		 if($("#action").val()==3 || $("#action").val()==4){
			tagged=$("#tagged_to").val();
			if(tagged==""){
				alert("Please choose who to send to");
				exit();
			}
		 }


		 if(emp_id==""){
			 exit();
		 }
		var personal = [];
        var sec1 = []; 
        var sec2 = [];
		var sec3 = [];
        var sec4 = []; 
        var sec5 = [];
		var sec6 = [];
		var sec7 = [];
		var sec8 = [];

		var respon = "", target="", actual="", emp_rate="", sup_rate="", eval2_rate="", eval3_rate="", sup_comment="",eval2_comment="",eval3_comment="", resp_id=""; //Section 1
		var q_type="", e_rate="", s_rate="", ev2_rate="",ev3_rate="", gw_id=""; //Section 2
		var performance_area="", weight="" , w_rating="", perfid=""; //Section 3
		var area_of_imp="", action_plan="", devid=""; //Section 4
		var sup_comment= $("#supervisor-comment").val(); 
		var emp_comment=$("#employee-comment").val(); 
		var manager_comment=$("#manager-comment").val();
		var quality="", technical="",leadership="",productivity="",responsibility="",e_development="",p_evaluation="";//All
		var resp_empRate_empty="no", resp_supRate_empty="no", eval2_rate_empty="no", eval3_rate_empty="no",resp_supRate_empty="no", qual_empR_empty="no";
		var qual_supR_empty="no",qual_eval2R_empty="no",qual_eval3R_empty="no", lead_empR_empty="no" , lead_supR_empty="no", lead_eval2R_empty="no", lead_eval3R_empty="no";
		var tech_empR_empty="no" , tech_supR_empty="no", tech_eval2R_empty="no", tech_eval3R_empty="no",prod_empR_empty="no" , prod_supR_empty="no", prod_eval2R_empty="no", prod_eval3R_empty="no";

		$("#tbl").children().find("[name=leave_row]").each(function(i,dom){//Resposibilities
            respon=$.trim($(dom).find("[name=tid]").val()); 
            target=$(dom).find("[name=ty]").val();
			actual=$(dom).find("[name=cn]").val();
			emp_rate=$(dom).find("[name=r1]").val();
			sup_rate=$(dom).find("[name=r2]").val();
			eval2_rate=$(dom).find("[name=r3]").val();
		
			eval3_rate=$(dom).find("[name=r4]").val();
			sup_comment=$.trim($(dom).find("[name=fy]").val());
			eval2_comment=$.trim($(dom).find("[name=fy1]").val());
			eval3_comment=$.trim($(dom).find("[name=fy2]").val());
			resp_id=$.trim($(dom).find("[name=respid]").val());
			
			if($.trim($("#permission").val())=="a_hr_hide"){
				
				if(respon==""){
					sec1.push("Responsibility/Task/Initiative"); 
				}
				if(target==""){
					sec1.push("Target");
				}
				if(actual==""){
					sec1.push("Actual");
				}
				if(emp_rate==""){
					resp_empRate_empty="yes";
				}
			}else{
				if($.trim($("#eva1_permission").val())=="yes"){
					if(sup_rate==""){
						resp_supRate_empty="yes";
						
					}
					if(sup_comment==""){
						sec1.push("Supervisor Comments");
					}
				}
				
				if($.trim($("#eva2_permission").val())=="yes"){
					if(eval2_rate==""){
						eval2_rate_empty="yes";
					}
					if(eval2_comment==""){
						sec1.push("Evaluator 2 Comments");
					}
				}
				if($.trim($("#eva3_permission").val())=="yes"){
					if(eval3_rate==""){
						eval3_rate_empty="yes";	
					}
					if(eval3_comment==""){
						sec1.push("Evaluator 3 Comments");
					}
				}
			}
			if($("#editable").val()=="yes"){
				responsibility +=respon +',' + target +',' + actual +','+ emp_rate +','+ sup_rate +','+ eval2_rate +','+ eval3_rate +','+ sup_comment +','+ eval2_comment +','+ eval3_comment +','+ resp_id +';';
			}else{
				responsibility +=respon +',' + target +',' + actual +','+ emp_rate +','+ sup_rate +','+ sup_comment +eval2_rate +','+ eval3_rate+','+ eval2_comment +','+ eval3_comment +';';
			}
		});
	
		responsibility=responsibility.slice(0, -1);
		if(resp_empRate_empty=="yes"){
			sec1.push("employee Rate");
		}
	
		if(resp_supRate_empty=="yes"){
			sec1.push("Evaluator 1 Rate");
		}

		if(eval2_rate_empty=="yes"){
			sec1.push("Evaluator 2 Rate");
		}

		if(eval3_rate_empty=="yes"){
			sec1.push("Evaluator 3 Rate");
		}

	
		$("#tbl2").children().find("[name=quality]").each(function(i,dom){//Quality
            q_type=$(dom).find("[name=q1]").text().slice(2); 
            e_rate=$(dom).find("[name=q2]").val();
			s_rate=$(dom).find("[name=q3]").val();
			ev2_rate=$(dom).find("[name=q4]").val();
			ev3_rate=$(dom).find("[name=q5]").val();
			gw_id=$(dom).find("[name=qtyid]").val();
			if($.trim($("#permission").val())=="a_hr_hide"){
				if(q_type==""){
					sec2.push("Technical Skils");
				}
				if(e_rate==""){
					qual_empR_empty="yes";
					
				}
			}else{
				if($.trim($("#eva1_permission").val())=="yes"){
					if(q_type==""){
					sec2.push("Technical Skils");
					}
					if(s_rate==""){
						qual_supR_empty="yes";
						
					}
				}
				if($.trim($("#eva2_permission").val())=="yes"){
					if(q_type==""){
					sec2.push("Technical Skils");
					}
					if(ev2_rate==""){
						qual_eval2R_empty="yes";
					}
				}
				if($.trim($("#eva3_permission").val())=="yes"){
					if(q_type==""){
					sec2.push("Technical Skils");
					}
					if(ev3_rate==""){
						qual_eval3R_empty="yes";
					}
				}
				
			}
			if($("#editable").val()=="yes"){
				quality += q_type +',' + e_rate +',' + s_rate+',' + ev2_rate+',' + ev3_rate+',' + gw_id+';';
			}else{
				quality += q_type +',' + e_rate +',' + s_rate +',' + ev2_rate+',' + ev3_rate+';';
			}
		});
		quality=quality.slice(0, -1);
		if(qual_empR_empty=="yes"){
			sec2.push("Employee Rate");
		}
		if(qual_supR_empty=="yes"){
			sec2.push("Evaluator 1 Rate");
		}
		if(qual_eval2R_empty=="yes"){
			sec2.push("Evaluator 2 Rate");
		}
		if(qual_eval3R_empty=="yes"){
			sec2.push("Evaluator 3 Rate");
		}
		
		$("#tbl2").children().find("[name=leadership]").each(function(i,dom){//Leadership
            q_type=$(dom).find("[name=l1]").text().slice(2); 
            e_rate=$(dom).find("[name=l2]").val();
			s_rate=$(dom).find("[name=l3]").val();
			ev2_rate=$(dom).find("[name=l4]").val();
			ev3_rate=$(dom).find("[name=l5]").val();
			gw_id=$(dom).find("[name=leadid]").val();
			if($.trim($("#permission").val())=="a_hr_hide"){
				if(q_type==""){
					sec3.push("Technical Skils");
				}
				if(e_rate==""){
					lead_empR_empty="yes";
				}
			}else{
				if($.trim($("#eva1_permission").val())=="yes"){
						if(q_type==""){
							sec3.push("Technical Skils");
						}
						if(s_rate==""){
							lead_supR_empty="yes";
							
						}
					}
					if($.trim($("#eva2_permission").val())=="yes"){
						if(q_type==""){
						sec2.push("Technical Skils");
						}
						if(ev2_rate==""){
							lead_eval2R_empty="yes";
						}
					}
					if($.trim($("#eva3_permission").val())=="yes"){
						if(q_type==""){
							sec2.push("Technical Skils");
						}
						if(ev3_rate==""){
							lead_eval3R_empty="yes";
						}
					}
				
			}
			if($("#editable").val()=="yes"){
				leadership += q_type +',' + e_rate +',' + s_rate+',' + ev2_rate+',' + ev3_rate+',' + gw_id +';';
			}else{
				leadership += q_type +',' + e_rate +',' + s_rate +',' + ev2_rate+',' + ev3_rate+';';
			}
		});
		leadership=leadership.slice(0, -1);

		if(lead_empR_empty=="yes"){
			sec3.push("Employee Rate");
		}
		if(lead_supR_empty=="yes"){
			sec3.push("Evaluator 1 Rate");
		}
		if(lead_eval2R_empty=="yes"){
			sec3.push("Evaluator 2 Rate");
		}
		if(lead_eval3R_empty=="yes"){
			sec3.push("Evaluator 3 Rate");
		}
		$("#tbl2").children().find("[name=technical]").each(function(i,dom){//Technical
            q_type=$(dom).find("[name=t1]").text().slice(2); 
            e_rate=$(dom).find("[name=t2]").val();
			s_rate=$(dom).find("[name=t3]").val()
			ev2_rate=$(dom).find("[name=t4]").val();
			ev3_rate=$(dom).find("[name=t5]").val();
			gw_id=$(dom).find("[name=techid]").val();
			if($.trim($("#permission").val())=="a_hr_hide"){
				if(q_type==""){
					sec4.push("Technical Skils");
				}
				if(e_rate==""){
					tech_empR_empty="yes";
				}
			}else{
				if($.trim($("#eva1_permission").val())=="yes"){
						if(q_type==""){
							sec4.push("Technical Skils");
						}
						if(s_rate==""){
							tech_supR_empty="yes";
						}
					}
					if($.trim($("#eva2_permission").val())=="yes"){
						if(q_type==""){
						sec2.push("Technical Skils");
						}
						if(ev2_rate==""){
							tech_eval2R_empty="yes";
						}
					}
					if($.trim($("#eva3_permission").val())=="yes"){
						if(q_type==""){
							sec2.push("Technical Skils");
						}
						if(ev3_rate==""){
							tech_eval3R_empty="yes";
						}
					}
			}
			if($("#editable").val()=="yes"){
				technical += q_type +'.' + e_rate +'.' +s_rate+'.'+ev2_rate+'.'+ev3_rate+'.'+gw_id+';';
			}else{
				technical += q_type +'.' + e_rate +'.' + s_rate+'.' + ev2_rate+'.' + ev3_rate +';';
			}
		});
		technical=technical.slice(0, -1);
		
		if(tech_empR_empty=="yes"){
			sec4.push("Employee Rate");
		}
		if(tech_supR_empty=="yes"){
			sec4.push("Evaluator 1 Rate");
		}
		if(tech_eval2R_empty=="yes"){
			sec4.push("Evaluator 2 Rate");
		}
		if(tech_eval3R_empty=="yes"){
			sec4.push("Evaluator 3 Rate");
		}
		
		$("#tbl2").children().find("[name=productivity]").each(function(i,dom){//productivity
            q_type=$(dom).find("[name=p1]").text().slice(2); 
            e_rate=$(dom).find("[name=p2]").val();
			s_rate=$(dom).find("[name=p3]").val();
			ev2_rate=$(dom).find("[name=p4]").val();
			ev3_rate=$(dom).find("[name=p5]").val();
			gw_id=$(dom).find("[name=prodid]").val();
			if($.trim($("#permission").val())=="a_hr_hide"){
				if(q_type==""){
					sec5.push("Technical Skils");
				}
				if(e_rate==""){
					prod_empR_empty="yes";
				}
			}else{
				if($.trim($("#eva1_permission").val())=="yes"){
						if(q_type==""){
							sec5.push("Technical Skils");
						}
						if(s_rate==""){
							prod_supR_empty="yes";
						}
					}
					if($.trim($("#eva2_permission").val())=="yes"){
						if(q_type==""){
						sec2.push("Technical Skils");
						}
						if(ev2_rate==""){
							prod_eval2R_empty="yes";
						}
					}
					if($.trim($("#eva3_permission").val())=="yes"){
						if(q_type==""){
							sec2.push("Technical Skils");
						}
						if(ev3_rate==""){
							prod_eval3R_empty="yes";
						}
					}
			}
			if($("#editable").val()=="yes"){
				productivity += q_type +',' + e_rate +',' + s_rate+',' + ev2_rate+',' + ev3_rate+',' + gw_id +';';
			}else{
				productivity += q_type +',' + e_rate +',' + s_rate +',' + ev2_rate+',' + ev3_rate+';';
			}
		});
		productivity=productivity.slice(0, -1);
		
		if(prod_empR_empty=="yes"){
			sec5.push("Employee Rate");
		}
		if(prod_supR_empty=="yes"){
			sec5.push("Evaluator 1 Rate");
		}
		if(prod_eval2R_empty=="yes"){
			sec5.push("Evaluator 2 Rate");
		}
		if(prod_eval3R_empty=="yes"){
			sec5.push("Evaluator 3 Rate");
		}
		$("#tbl3").children().find("[name=development]").each(function(i,dom){//Development
            area_of_imp=$.trim($(dom).find("[name=ad]").val()); 
			action_plan=$.trim($(dom).find("[name=d2]").val());
			devid=$(dom).find("[name=devdid]").val()
			if($("#permission").val()=="a_hr_hide"){
				if(area_of_imp==""){
					sec6.push("Area of Improvement");
				}
			}else{
				if(area_of_imp==""){
					sec6.push("Area of Improvement");
				}
				if(action_plan==""){
					sec6.push("Comments/Action Plan");
				}
			}
			if($("#editable").val()=="yes"){
				e_development +=area_of_imp +','+ action_plan+','+devid+';';
			}else{
				e_development +=area_of_imp +',' + action_plan +';';
			}
		});
		e_development=e_development.slice(0, -1);
	
		$("#tbl4").children().find("[name=p_e_summary]").each(function(i,dom){//Resposibilities
		
             performance_area=$.trim($(dom).find("[name=pa1]").text());
			 if($(dom).find("[name=w]").length == 0) {
				 weight='';
			 }else{
				 
				 weight=$(dom).find("[name=w]").val();
				 if($.trim($("#permission").val())!="a_hr_hide"){
					if(weight==""){
						sec7.push("Weight");
					}
				}
			 }
			 if($(dom).find("[name=w2]").length == 0) {
				 w_rating='';
			 }else{
				w_rating=$(dom).find("[name=w2]").val();
				if($("#permission").val()!="a_hr_hide"){
					if(w_rating==""){
						sec7.push("Rating");
					}
				}
			 }
			 perfid=$(dom).find("[name=perdid]").val();
			 if($("#editable").val()=="yes"){
				 p_evaluation +=performance_area + ',' + weight + ','+w_rating+ ','+perfid+';';
			 }else{
				p_evaluation +=performance_area + ',' + weight + ','+w_rating+';';
			 }
		});
		p_evaluation=p_evaluation.slice(0, -1);
		
		var sup_comment= $.trim($("#supervisor-comment").val()); 
		var emp_comment= $.trim($("#employee-comment").val()); 
		var supervisor2 = $.trim($("#supervisor2-comment").val());
		var supervisor3 = $.trim($("#supervisor3-comment").val());
		var commentid="";
		if($("#editable").val()=="yes"){
			commentid=$("#comment_id").val();
		}
      
		if($.trim($("#permission").val())=="a_hr_hide"){
			
			if(emp_comment==""){
				sec8.push("Employee Comment");
			}
		}else{
			if(sup_comment==""){
				sec8.push("Supervisor Comment");
			}
		}

		if(full_name==""){
			personal.push("Full Name");
		}
		if(emp_num==""){
			personal.push("Employee Number");
		}
		if(emp_position==""){
			personal.push("Employee Position");
		}
		if(dep_name==""){
			personal.push("Department Name");
		}
		if(immed_supervisor==""){
			personal.push("Immediate Supervisor");
		}
		if(join_date==""){
			personal.push("Join Date");
		}
		if(type_evaluation==""){
			personal.push("Type of evaluation");
		}
		if(f_peroid==""){
			personal.push("Evaluation Peroid (From)");
		}
		if(t_peroid==""){
			personal.push("Evaluation Peroid (To)");
		}
		if(ann_leave==""){
			personal.push("AL");
		}
		if(emer_leave==""){
			personal.push("EL");
		}
		if(mc==""){
			personal.push("SL");
		}
		if(holiday_leave==""){
			personal.push("HL");
		}
		if(unpaid==""){
			personal.push("Unpaid");
		}

        var error_personal="";
        for(var i=0; i< personal.length; i++){
            error_personal = error_personal + personal[i] + "; "
        }
        var error_sec1 = '';
        for(var i=0; i< sec1.length; i++){
            error_sec1 = error_sec1 + sec1[i] + "; "
        }
        var error_sec2 = '';
        for(var i=0; i< sec2.length; i++){
            error_sec2 = error_sec2 + sec2[i] + "; "
        }
		var error_sec3 = '';
        for(var i=0; i< sec3.length; i++){
            error_sec3 = error_sec3 + sec3[i] + "; "
        }
		var error_sec4 = '';
        for(var i=0; i< sec4.length; i++){
            error_sec4 = error_sec4 + sec4[i] + "; "
        }
		var error_sec5 = '';
        for(var i=0; i< sec5.length; i++){
            error_sec5 = error_sec5 + sec5[i] + "; "
        }
		var error_sec6 = '';
        for(var i=0; i< sec6.length; i++){
            error_sec6 = error_sec6 + sec6[i] + "; "
        }
		var error_sec7 = '';
        for(var i=0; i< sec7.length; i++){
            error_sec7 = error_sec7 + sec7[i] + "; "
        }
		var error_sec8 = '';
        for(var i=0; i< sec8.length; i++){
            error_sec8 = error_sec8 + sec8[i] + "; "
			
        }
                
        var sect1 = "",sect2="",sect3="",sect4="",sect5="",sect6="",sect7="",sect8="",pers="";
     
        if(personal.length > 0){
            pers = "Please Insert Personal Information: \n"+error_personal+"\n\n";
        }
		if(sec1.length > 0){
            sect1 = "Please Insert Job Resposibilities of: \n"+error_sec1+"\n\n";
        }
		if(sec2.length > 0){
            sect2 = "Please Insert General Work Characteristics (C) of: \n"+error_sec2+"\n\n";
        }
		if(sec3.length > 0){
            sect3 = "Please Insert General Work Characteristics (B) of: \n"+error_sec3+"\n\n";
        }
		if(sec4.length > 0){
            sect4 = "Please Insert General Work Characteristics (A) of: \n"+error_sec4+"\n\n";
        }
		if(sec5.length > 0){
            sect5 = "Please Insert General Work Characteristics (D) of: \n"+error_sec5+"\n\n";
        }
		if(sec6.length > 0){
            sect6 = "Please Insert Employee Development of: \n"+error_sec6+"\n\n";
        }
		if(sec7.length > 0){
            sect7 = "Please Insert Performance Evaluation Summary of : \n"+error_sec7+"\n\n";
        }
        if(sec8.length > 0){
            sect8 = "Please Insert Comments/Means of Improvements of : \n"+error_sec8+"\n\n";
        }
        if(error_personal.length > 0){
			alert(pers)
			exit();
		}
		//if($("#action").val()==2 || $("#action").val()==3){
		if((error_personal.length > 0 || error_sec1.length > 0 || error_sec2.length > 0 || error_sec3.length > 0 || error_sec4.length > 0 || error_sec5.length > 0 || error_sec6.length > 0 || error_sec7.length > 0 || error_sec8.length > 0) && $("#action").val()!=1){
				alert(pers + sect1 + sect2 + sect3 + sect4 + sect5 + sect6 + sect7 + sect8);
		}else{
			if($("#editable").val()=="yes"){
					$.ajax({
						type:"POST",
						url:"?widget=edit_appraisal",
						data:{
							//Personal information
							full_name:full_name,
							emp_num:emp_id,
							emp_position:emp_position,
							dep_name:dep_name,
							immed_supervisor:immed_supervisor,
							join_date:join_date,
							type_evaluation:type_evaluation,
							f_peroid:f_peroid,
							t_peroid:t_peroid,
							ann_leave:ann_leave,
							emer_leave:emer_leave,
							mc:mc,
							tagged:tagged,
							holiday_leave:holiday_leave,
							unpaid:unpaid,
							supervisor:immed_supervisor,
							edit_id:edit_id,
							//End
							//Array
							responsibility:responsibility,
							quality:quality,
							leadership:leadership,
							technical:technical,
							productivity:productivity,
							e_development:e_development,
							p_evaluation:p_evaluation,
							//End
							sup_comment:sup_comment,
							emp_comment:emp_comment,
							supervisor2:supervisor2,
							supervisor3:supervisor3,
							commentid:commentid,
							action:action
							
						},
						success:function(data){
							if(data == true){
								
									alert("Appraisal Updated");
									window.location = '?eloc=emp_appraisal';
								}else{
									alert("Error While Processing");
								}
						}
				})
			}else{
				$.ajax({
					type:"POST",
					url:"?widget=add_appraisal",
					data:{
						//Personal information
						full_name:full_name,
						emp_num:emp_id,
						emp_position:emp_position,
						dep_name:dep_name,
						immed_supervisor:immed_supervisor,
						join_date:join_date,
						type_evaluation:type_evaluation,
						f_peroid:f_peroid,
						t_peroid:t_peroid,
						ann_leave:ann_leave,
						emer_leave:emer_leave,
						mc:mc,
						holiday_leave:holiday_leave,
						unpaid:unpaid,
						supervisor:immed_supervisor,
						//End
						//Array
						responsibility:responsibility,
						quality:quality,
						leadership:leadership,
						technical:technical,
						productivity:productivity,
						e_development:e_development,
						p_evaluation:p_evaluation,
						//End
						sup_comment:sup_comment,
						emp_comment:emp_comment,
						supervisor2:supervisor2,
						supervisor3:supervisor3,
						action:action
						
					},
					success:function(data){
						alert(data)
						exit();
						if(data==2){
							alert("Record already existed");
								window.location = '?loc=appraisal-form';
						}else{
							if(data == true){
								alert("Appraisal Inserted");
								window.location = '?eloc=emp_appraisal';
							}else{
								alert("Error While Processing");
							}
						}
					}
				})
			}
		}
	}
    
    $(document).ready(function(){
		$("#type_evaluation").change(function(){
			var val =$(this).val();
			if(val=="Others"){
				$("#type_evaluation").addClass("te-other");
				$(".te-other").show();
			}else{
				$("#type_evaluation").removeClass("te-other");
				$(".te-other").hide();
			}
		});
		if($("#action").val()==1){
				$(".action .button").val("Save");
				$("#tagged_to").val("");
				$("#tag_to").hide();
			}else if($("#action").val()==2){
				$(".action .button").val("Submit");
				$("#tagged_to").val("");
				$("#tag_to").hide();
			}else if($("#action").val()==5){
				$(".action .button").val("Submit");
				$("#tagged_to").val("");
				$("#tag_to").hide();
			}else if($("#action").val()==3 || $("#action").val()==4){
				$(".action .button").val("Send");
				$("#tag_to").show();
			}
		$("#action").change(function(){
			if($(this).val()==1){
				$(".action .button").val("Save");
				$("#tagged_to").val("");
				$("#tag_to").hide();
			}else if($(this).val()==2){
				$(".action .button").val("Submit");
				$("#tagged_to").val("");
				$("#tag_to").hide();
			}else if($(this).val()==5){
				$(".action .button").val("Submit");
				$("#tagged_to").val("");
				$("#tag_to").hide();
			}else if($(this).val()==3 || $(this).val()==4){
				$(".action .button").val("Send");
				$("#tag_to").show();
			}
		});
		
		/*$("#f_peroid, #t_peroid").datepicker({
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true
		});*/
		$("#type_evaluation").on("change paste keyup",function(){
			var d = new Date();
			var month = d.getMonth()+1;
			var day = d.getDate();
			var year = d.getFullYear();
			if($(this).val()=="Annual"){
				$("#f_peroid").val("01-01-"+year);
				$("#t_peroid").val("31-12-"+year).focus();
			}else if($(this).val()=="Probationary"){
				var from_e = d.getFullYear() + '-' +
							(month<10 ? '0' : '') + month + '-' +
							(day<10 ? '0' : '') + day;
				new Date(d.setMonth(d.getMonth() + 6));
				month = d.getMonth()+1;
				day = d.getDate();
				year = d.getFullYear();
				var to = year + '-' +
							(month<10 ? '0' : '') + month + '-' +
							(day<10 ? '0' : '') +day;
				$("#f_peroid").val(from_e);
				$("#t_peroid").val(to).focus();
			}else if($(this).val()=="First Review"){
				var from_e = d.getFullYear() + '-' +
							(month<10 ? '0' : '') + month + '-' +
							(day<10 ? '0' : '') + day;
				new Date(d.setMonth(d.getMonth() + 3));
				month = d.getMonth()+1;
				day = d.getDate();
				year = d.getFullYear();
				var to = year + '-' +
							(month<10 ? '0' : '') + month + '-' +
							(day<10 ? '0' : '') +day;
				$("#f_peroid").val(from_e);
				$("#t_peroid").val(to).focus();
			}else if($(this).val()=="Second Review"){
				var from_e = d.getFullYear() + '-' +
							(month<10 ? '0' : '') + month + '-' +
							(day<10 ? '0' : '') + day;
				new Date(d.setMonth(d.getMonth() + 3));
				month = d.getMonth()+1;
				day = d.getDate();
				year = d.getFullYear();
				var to = year + '-' +
							(month<10 ? '0' : '') + month + '-' +
							(day<10 ? '0' : '') +day;
				$("#f_peroid").val(from_e);
				$("#t_peroid").val(to).focus();
			}
		});
		$("#t_peroid").on("focus",function(){
			
			var p_from = $("#f_peroid").val();
			var p_to = $("#t_peroid").val();
			
			var emp_id="";
			if($("#editable").val()=="yes"){
				emp_id =$("#emp_id_edit").val();
			}else{
				emp_id =$("#emp_id").val();
			}
         
			if(emp_id==""){
				exit();
			}
			if(p_from==""){
				//alert("Please select Peroid of evaluation");
				//$("#t_peroid").val("");
			}else if(p_from > p_to) {
				alert("Wrong Range");
				$("#t_peroid").val("");
				 $("#f_peroid").val("");
			}else{
				$.ajax({
                    dataType:'json',
                    url:"?widget=getleave",
                    data:{
                        p_from,
                        p_to,
                        emp_id:emp_id 
                    },
                    success:function(data){
						$("#al").empty().val(Math.trunc(data.al));
						$("#sl").empty().val(Math.trunc(data.mc));
						$("#unpaid").empty().val(Math.trunc(data.unpaid));
						$("#el").empty().val(Math.trunc(data.em));
						$("#hl").empty().val(Math.trunc(data.hr));
						
					}
                });
			}
		});
	});
	
</script>
<style>
	.tableth th {
		background-color:#2b2a2a !important;
		text-align: center;
	}
	.tabletr {
		background-color: #cccccc85 !important;
	}
	.tabletr td {
		padding-right: 10px;
	}

	table#app-form-top {
		width: 99% !important;
		font-weight: bold;
		/* border: 2px solid; */
		margin-bottom: 20px;
}
table#app-form-top tr td {
    padding: 6px;
}
table#app-form-top tbody tr td {
    border: 1rem solid #272625;/*#07334e;*/ /*#2d2c2c;*/
    /* border-radius: 16px; */
}
div#collapseone {
    /* border: 1px solid; */
    border: 1px solid #ddd;
}
#tbl2 .tableth th, #tbl3 .tableth th , #tbl4 .tableth th {
    background-color: #2b2a2a !important;
    text-align: left;
}
#tbl4 td.gwc-center {
    padding-left: 24px !important;
}
#tbl4 .tbl4-center{
	text-align:center !important;
}
textarea {
    background: #fff !important;
}
.table {
    overflow: scroll;
}
table#tbl input[type=text] {
    width: 86px !important;
}
#tbl select, #tbl2 select {
    width: 87px !important;
}
#tbl .tableth th {
    padding: 5px 0 5px 0px;
}
#tbl .e_comments {
    width: 100px;
    height: 108px;
}
</style>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>