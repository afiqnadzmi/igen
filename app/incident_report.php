<!DOCTYPE html>
<?php
session_start();

if (isset($_COOKIE["igen_user_id"]) == true) {
	$user_id = $_COOKIE['igen_user_id']; 
}

$incident_type=array("death", );
// Get current login depart id
$sql= "select dep_id from employee where id=".$user_id; 
$sql_result = mysql_query($sql);
$rs = mysql_fetch_array($sql_result);
echo "<input type='hidden' id='dep_id' value='".$rs['dep_id']."'>";

//Select from incident report table 
$query = mysql_query('SELECT *, e.full_name, e.id as empid, ir.id as irid FROM incident_report AS ir INNER JOIN employee AS e ON e.id = ir.name WHERE ir.id='.$_GET['edt']);
$rowQuery = mysql_fetch_array($query);
$unsafe_work=explode(",",$rowQuery['unsafe_work_place']);
$unsafe_people=explode(",",$rowQuery['unsafe_act_people']);
$changes_suggested=explode(",",$rowQuery['changes_suggested']);
$team_members=explode(",",$rowQuery['team_members']);

//Supervisor
$query_sup = mysql_query('SELECT *, e.full_name, e.id as empid FROM incident_report AS ir INNER JOIN employee AS e ON e.id = ir.supervisor_incharge WHERE ir.id='.$_GET['edt']);
$rowQuery_sup = mysql_fetch_array($query_sup);

//Person Resposible Equipment
$query_presonsible = mysql_query('SELECT *, e.full_name, e.id as empid FROM incident_report AS ir INNER JOIN employee AS e ON e.id = ir.equipment_person_resp WHERE ir.id='.$_GET['edt']);
$rowQuery_presonsible = mysql_fetch_array($query_presonsible);

//Written by
$query_writtenby = mysql_query('SELECT *, e.full_name, e.id as empid FROM incident_report AS ir INNER JOIN employee AS e ON e.id = ir.written_by WHERE ir.id='.$_GET['edt']);
$rowQuery_writtenby = mysql_fetch_array($query_writtenby);

//Reviewed by
$query_reviewedby = mysql_query('SELECT *, e.full_name, e.id as empid FROM incident_report AS ir INNER JOIN employee AS e ON e.id = ir.reviewed_by WHERE ir.id='.$_GET['edt']);
$rowQuery_reviewedby = mysql_fetch_array($query_reviewedby);


?>

<html>

<head>
	<meta charset='UTF-8'>
</head> 

<body>
<div class="main_div">
    <div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Accident/Incident Investigation</a>
					</h4>
				</div>
		</div>
	</div>
	
	
	<div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
<div class="incident-redport">
<div class="header_text">
        <span>Accident/Incident Investigation</span>
        <span style="float: right;">
            <?php if ($igen_epr=="epr_view" || $igen_epr=="epr_edit") { ?>
                <table>
                    <tr>
                        <td><input id="editBut" type="button" onclick="back()" value="Back" style="width:100px" /></td>
                    </tr>
                </table>
            <?php } ?>
        </span>
    </div>
	<p><strong><u>INSTRUCTION</u></strong></p>
	<p>*This form is to be completed whenever there&rsquo;s an accident or incident occurs. Please ensure that incident details are filled up completely.</p>
<table width="100%" cellpadding="10" class="report">
		<tbody>
			<tr  class="header-part">
				<td colspan="7" width="100%">
				<p><strong>PART A : DETAILS </strong></p>
				</td>
				<td width="0">&nbsp;</td>
			</tr>
			<tr class="body-part">
				<td class="report_of_a">
				 This is a report of a<br>
				<input type="radio" name="reportType" value="death" <?php if($rowQuery['report_of']=="death"){echo"checked";}  ?>> Death &nbsp;&nbsp <input type="radio" name="reportType" value="First Aid/Minor Injury" <?php if($rowQuery['report_of']=="First Aid/Minor Injury"){echo"checked";}  ?>> First Aid/Minor Injury &nbsp;&nbsp; <input type="radio" name="reportType" value="Property Damage" <?php if($rowQuery['report_of']=="Property Damage"){echo"checked";}  ?>> Property Damage
				&nbsp;&nybsp; <input type="radio" name="reportType" value="Dr.Visit Only"  <?php if($rowQuery['report_of']=="Dr.Visit Only"){echo"checked";}  ?>> Dr.Visit Only &nbsp;&nbsp; <input type="radio" name="reportType" value="Property Damage" <?php if($rowQuery['report_of']=="Property Damage"){echo"checked";}  ?>> Property Damage &nbsp;&nbsp; <input type="radio" name="reportType" value="Dangerous Occurrence" <?php if($rowQuery['report_of']=="Dangerous Occurrence"){echo"checked";}  ?>> Dangerous Occurrence
	
				</td>
			</tr>
			<tr class="body-part">
				<td>Date of incident <br> <input type="text" id="incident_date" value="<?php echo $rowQuery['incident_date']; ?>"></td>
				<td class="report_is_done">Report is done by <br><input type="radio" name="reportdoneby" value="employee" <?php if($rowQuery['report_done_by']=="employee"){echo"checked";}  ?>> Employee &nbsp;&nbsp <input type="radio" name="reportdoneby" value="supervisor" <?php if($rowQuery['report_done_by']=="supervisor"){echo"checked";}  ?>>Supervisor &nbsp;&nbsp; <input type="radio" name="reportdoneby" value="team" <?php if($rowQuery['report_done_by']=="supervisor"){echo"checked";}  ?>> Team &nbsp;&nbsp <input type="radio" name="reportdoneby" value="supervisor" <?php if($rowQuery['report_done_by']=="supervisor"){echo"checked";}  ?>>Supervisor &nbsp;&nbsp; <input type="radio" name="reportdoneby" value="others" <?php if($rowQuery['report_done_by']=="others"){echo"checked";}  ?>> Others &nbsp;&nbsp; <input style="display:none" type="text" id="donebyothers" value="<?php if($rowQuery['report_done_by']=="others"){echo $rowQuery['report_done_by_other'];}?>"></td>
			</tr>
			<tr class="body-part">
				<td>Time<br> <input type="text" id="incident_time" value="<?php echo $rowQuery['time']; ?>"></td>
				<td>
				
				</td>
			</tr>
			<tr  class="header-part">
				<td colspan="7">
				<p><strong>PART B : PERSON INJURED/ PERSON INVOLVED</strong></p>
				</td>
				<td width="0">&nbsp;</td>
			</tr>
			<tr class="body-part">
				<td class="width-control">
				 Name<br>
				  <span id="employee_name_ids" style="display: none;"><?php  if($rowQuery['name']!=null){ echo $rowQuery['name']; }?></span>
                      <select multiple class="input_text" name="employee_name_view" id="employee_name_view" style="width: 205px; height: 30px;">
					   <?php if($rowQuery['name']!=null){ echo"<option value='".$rowQuery['name']."'>".$rowQuery['full_name']."</option>";}?>
					  </select>
                      <input class="button incident" type="button" value="Search"  onclick="add_emp_list('emp')" style="width: 70px;"/>
				</td>
				<td class="gender"><p>Sex<br> <input type="radio" name="gender" value="male" id="male" disabled <?php if($rowQuery['sex']=="male"){ echo"checked";}?>>&nbsp;&nbsp; Male &nbsp;&nbsp;  <input type="radio" name="gender" value="female" id="female" disabled <?php if($rowQuery['sex']=="female"){ echo"checked";}?>> &nbsp;&nbsp; Female </td>
			</tr>
			<tr class="body-part">
				<td>Department<br><input type="text" id="department" value="<?php echo $rowQuery['department']; ?>" disabled></td>
				<td>Job title at time of incident<br> <input type="text" id="job-title" value="<?php echo $rowQuery['victim_job_title']; ?>" disabled></td>
			</tr>
			<tr class="body-part">
				<td>
					 Age <br><input type="text" id="age" value="<?php echo $rowQuery['age']; ?>" disabled>
				</td>
				<td width="0">
			
					Nature of injury: (most serious one) <br>
					<select id="injury-nature">
					   <option value="none" > None </option>
					   <option value="abrasion, scrapes" <?php if($rowQuery['nature_of_injury']=="abrasion, scrapes"){ echo"selected";}?> > Abrasion, scrapes </option>
					   <option value="amputation" <?php if($rowQuery['nature_of_injury']=="amputation"){ echo"selected";}?>> Amputation </option>
					   <option value="broken bone" <?php if($rowQuery['nature_of_injury']=="broken bone"){ echo"selected";}?>> Broken bone </option>
					   <option value="bruise" <?php if($rowQuery['nature_of_injury']=="bruise"){ echo"selected";}?> > Bruise </option>
					   <option value="burn-heat" <?php if($rowQuery['nature_of_injury']=="burn-heat"){ echo"selected";}?>> Burn-heat </option>
					   <option value="burn-chemical" <?php if($rowQuery['nature_of_injury']=="burn-chemical"){ echo"selected";}?>> Burn-chemical </option>
					   <option value="concussion to head" <?php if($rowQuery['nature_of_injury']=="concussion to head"){ echo"selected";}?>> Concussion to head </option>
					   <option value="crushing injury" <?php if($rowQuery['nature_of_injury']=="crushing injury"){ echo"selected";}?>> Crushing Injury </option>
					   <option value="cut, laceration, puncture" <?php if($rowQuery['nature_of_injury']=="cut, laceration, puncture"){ echo"selected";}?>> Cut, laceration, puncture </option>
					   <option value="hernia" <?php if($rowQuery['nature_of_injury']=="hernia"){ echo"selected";}?>> Hernia </option>
					   <option value="illness" <?php if($rowQuery['nature_of_injury']=="illness"){ echo"selected";}?>> Illness </option>
					   <option value="sprain, strain" <?php if($rowQuery['nature_of_injury']=="sprain, strain"){ echo"selected";}?>> Sprain, strain </option>
					   <option value="damage to body system" <?php if($rowQuery['nature_of_injury']=="damage to body system"){ echo"selected";}?>> damage to body system </option>
					   <option value="other" <?php if($rowQuery['nature_of_injury']=="other"){ echo"selected";}?>> Other </option>
					</select> &nbsp;&nbsp;<input style="display:none" type="text" id="other_of_injury" value="<?php if($rowQuery['nature_of_injury']=="other"){ echo $rowQuery['nature_of_injury_other'];}?>">
				</td>
			</tr>
			<tr class="body-part">
				<td >
				 This employee works<br><input type="text" id="employee_works" value="<?php echo $rowQuery['employee_works']; ?>">
				</td>
				<td width="0">Months with this employer<br><input type="text" id="month_employee" value="<?php echo $rowQuery['months_employer']; ?>"></td>
			</tr>
			<tr class="body-part">
			<td>
				Months doing this job<br><input type="text" id="month_job" value="<?php echo $rowQuery['months_of_job']; ?>">
			</td>
			<td width="0">&nbsp;</td>
			</tr>
			<tr  class="header-part">
				<td colspan="7">
					<p><strong>PART 3 : DESCRIBE THE INCIDENT</strong></p>
				</td>
				<td width="0">&nbsp;</td>
			</tr>
			<tr class="body-part">
				<td>
					<p>Location of Accident: </p><input type="text" id="location-of-accident" value="<?php echo $rowQuery['location_of_accident']; ?>">
					<p>&nbsp;</p>
				</td>
				<td>
						What part of employee&rsquo;s workday?<br>
						 <select id="part-of-employee-workday">
							<option value="none">- None -</option>
							<option value="entering or leaving work" <?php if($rowQuery['part_employee_workdays']=="entering or leaving work"){ echo"selected";}?>>Entering or leaving work</option>
							<option value="doing normal work activity" <?php if($rowQuery['part_employee_workdays']=="doing normal work activity"){ echo"selected";}?>>Doing normal work activity</option>
							<option value="during meal period" <?php if($rowQuery['part_employee_workdays']=="during meal period"){ echo"selected";}?>>During meal period</option>
							<option value="during break" <?php if($rowQuery['part_employee_workdays']=="during break"){ echo"selected";}?>>During break</option>
							<option value="working overtime" <?php if($rowQuery['part_employee_workdays']=="working overtime"){ echo"selected";}?>>Working overtime</option>
							<option value="other" <?php if($rowQuery['part_employee_workdays']=="other"){ echo"selected";}?>>Other</option>
						 </select> &nbsp; <input style="display:none" type="text" value="<?php if($rowQuery['part_employee_workdays']=="other"){ echo $rowQuery['part_employee_workdays_other'];}?>" id="other-workdays" >
				</td>
			</tr>
			<tr class="body-part">
				<td>
					Supervisor In Charge<br>
					<span id="supervisor_ids" style="display: none;"><?php if($rowQuery['supervisor_incharge']!=null){ echo $rowQuery['supervisor_incharge'];}?></span>
                      <select multiple class="input_text" name="supervisor_incharge" id="supervisor_incharge" style="width: 205px; height: 30px;">
					   <?php if($rowQuery['supervisor_incharge']!=null){ echo"<option value='".$rowQuery['supervisor_incharge']."'>".$rowQuery_sup['full_name']."</option>";}?>
					  </select>
                      <input class="button incident" type="button" value="Search"  onclick="add_emp_list('sup')" style="width: 70px;"/>
				</td>
				<td >
					Name of Witness (if any)<br><input type="text" id="witness-name" value="<?php echo $rowQuery['witness_name']; ?>">
				</td>
			</tr>
			<tr class="body-part">
				<td class="width:200px"><br>
					<p>
						Describe step by step events that led up to injury/accident. Includes names of <br> any machines, parts, objects, tools, materials and other important details
						 <br><textarea style="width:400px;  height:97px" id="incident_description"><?php echo $rowQuery['incident_description']; ?></textarea>
					</p>
				</td>
				<td width="0">What PPE being used (if any)?<br> <input type="text" value="<?php echo $rowQuery['ppe']; ?>" id="ppe_used"></td>
			</tr>
			<tr class="body-part">
				<td class="mc_received">
					 There is any MC received? <br> <input type="radio" name="mc-received" value="yes" <?php if($rowQuery['mc']=="yes"){ echo"checked";}?>> Yes &nbsp;&nbsp; <input type="radio" name="mc-received" value="no" <?php if($rowQuery['mc']=="no"){ echo"checked";}?>> No
					<br>
					 <span class="mc_yes" style="display:none">If YES, how many days of MC? <br><input type="text" value="<?php if($rowQuery['mc']=="yes"){ echo $rowQuery['mc_yes'];}?>" id="mc-days"></span>
				</td>
			</tr>
			<tr  class="header-part">
			<td colspan="7" width="510">
			<p><strong>PART 4: WHY DID INCIDENT HAPPEN?</strong></p>
			</td>
			<td width="0">&nbsp;</td>
			</tr>
			<tr class="body-part">
				<td class="unsafe_workplace">
					 Unsafe workplace conditions (Check all that apply)<br>
					<p><input type="checkbox" name="cond1" value="1" <?php foreach($unsafe_work as $val){if ($val== 1){ echo"checked";}}?>>&nbsp;&nbsp;Inadequate guard</p>
					<p><input type="checkbox" name="cond2" value="2" <?php foreach($unsafe_work as $val){if ($val== 2){ echo"checked";}}?>>&nbsp;&nbsp;Unguarded guard</p>
					<p><input type="checkbox" name="cond3" value="3" <?php foreach($unsafe_work as $val){if ($val== 3){ echo"checked";}}?>>&nbsp;&nbsp;Safety device is defective</p>
					<p><input type="checkbox" name="cond4" value="4" <?php foreach($unsafe_work as $val){if ($val== 4){ echo"checked";}}?>>&nbsp;&nbsp;Tool or equipment defective</p>
					<p><input type="checkbox" name="cond5" value="5" <?php foreach($unsafe_work as $val){if ($val== 5){ echo"checked";}}?>>&nbsp;&nbsp;Workstation or layout is hazardous</p>
					<p><input type="checkbox" name="cond6" value="6" <?php foreach($unsafe_work as $val){if ($val== 6){ echo"checked";}}?>>&nbsp;&nbsp;Unsafe lighting</p>
					<p><input type="checkbox" name="cond7" value="7" <?php foreach($unsafe_work as $val){if ($val== 7){ echo"checked";}}?>>&nbsp;&nbsp;UnsafeVentilation</p>
					<p><input type="checkbox" name="cond8" value="8" <?php foreach($unsafe_work as $val){if ($val== 8){ echo"checked";}}?>>&nbsp;&nbsp;Lack of needed PPE</p>
					<p><input type="checkbox" name="cond9" value="9" <?php foreach($unsafe_work as $val){if ($val== 9){ echo"checked";}}?>>&nbsp;&nbsp;Lack of appropriate equipment/ tools</p>
					<p><input type="checkbox" name="cond10" value="10" <?php foreach($unsafe_work as $val){if ($val==10){ echo"checked";}}?>>&nbsp;&nbsp;Unsafe clothing</p>
					<p><input type="checkbox" name="cond11" value="11" <?php foreach($unsafe_work as $val){if ($val== 11){ echo"checked";}}?>>&nbsp;&nbsp;No training or insufficient training</p>
					<p><input type="checkbox" name="cond12" value="12" <?php foreach($unsafe_work as $val){if ($val== 12){ echo"checked";}}?>>&nbsp;&nbsp;Others <input style="display:none" type="text" value="<?php foreach($unsafe_work as $val){if ($val== 12){ echo $rowQuery['unsafe_work_place_other'];}}?>" id="unsafe_cond_others"></p>
				</td>
				<td class="unsafe_bypeople">
					 Unsafe act by people ( Check all that apply)<br>
					<p><input type="checkbox" name="condp1" value="1" <?php foreach($unsafe_people as $val){if ($val== 1){ echo"checked";}}?>>&nbsp;&nbsp;Operating without permission</p>
					<p><input type="checkbox" name="condp2" value="2" <?php foreach($unsafe_people as $val){if ($val== 2){ echo"checked";}}?>>&nbsp;&nbsp;Operating at unsafe speed</p>
					<p><input type="checkbox" name="condp3" value="3" <?php foreach($unsafe_people as $val){if ($val== 3){ echo"checked";}}?>>&nbsp;&nbsp;Servicing equipment without turning off the power</p>
					<p><input type="checkbox" name="condp4" value="4" <?php foreach($unsafe_people as $val){if ($val== 4){ echo"checked";}}?>>&nbsp;&nbsp;Making a safety device incorperative</p>
					<p><input type="checkbox" name="condp5" value="5" <?php foreach($unsafe_people as $val){if ($val== 5){ echo"checked";}}?>>&nbsp;&nbsp;Using defective equipment</p>
					<p><input type="checkbox" name="condp6" value="6" <?php foreach($unsafe_people as $val){if ($val== 6){ echo"checked";}}?>>&nbsp;&nbsp;Using equipment in unapproved way</p>
					<p><input type="checkbox" name="condp7" value="7" <?php foreach($unsafe_people as $val){if ($val== 7){ echo"checked";}}?>>&nbsp;&nbsp;Unsafe lifting</p>
					<p><input type="checkbox" name="condp8" value="8" <?php foreach($unsafe_people as $val){if ($val== 8){ echo"checked";}}?>>&nbsp;&nbsp;Taking unsafe position or posture</p>
					<p><input type="checkbox" name="condp9" value="9" <?php foreach($unsafe_people as $val){if ($val== 9){ echo"checked";}}?>>&nbsp;&nbsp;Distraction, teasing, horseplay</p>
					<p><input type="checkbox" name="condp10" value="10" <?php foreach($unsafe_people as $val){if ($val== 10){ echo"checked";}}?>>&nbsp;&nbsp;Failure to wear PPE</p>
					<p><input type="checkbox" name="condp11" value="11" <?php foreach($unsafe_people as $val){if ($val== 11){ echo"checked";}}?>>&nbsp;&nbsp;Failure to use the available equipment/tools</p>
					<p><input type="checkbox" name="condp12" value="12" <?php foreach($unsafe_people as $val){if ($val== 12){ echo"checked";}}?>>&nbsp;&nbsp;Others <input style="display:none" type="text" value="<?php foreach($unsafe_people as $val){if ($val== 12){ echo $rowQuery['unsafe_work_place_other'];}}?>" id="unsafe_condp_others"></p>
				</td>
			</tr>
			<tr class="body-part">
			<td class="similar_incident">
			 Have there been similar incident or near misses prior to this one?<br>
			 <input type="radio" name="similar-incident" value="yes" <?php if($rowQuery['similar_incident']=="yes"){ echo"checked";}?>> Yes &nbsp;&nbsp; <input type="radio" name="similar-incident" value="no" <?php if($rowQuery['similar_incident']=="no"){ echo"checked";}?>> No
			</td>
			<td width="0">&nbsp;</td>
			</tr>
			<tr  class="header-part">
			<td colspan="7" width="510">
			<p><strong>PART 5: HOW CAN FUTURE INCIDENTS BE PREVENTED?</strong></p>
			</td>
			<td width="0">&nbsp;</td>
			</tr>
			<tr class="body-part">
			<td class="suggested_changes">
			<p>&nbsp;</p>
			 What changes can you suggest to prevent this incident /near miss from happening again?<br>
					<p><input type="checkbox" name="prevent1" value="1" <?php foreach($changes_suggested as $val){if ($val== 1){ echo"checked";}}?>>&nbsp;&nbsp;Stop this activity</p>
					<p><input type="checkbox" name="prevent2" value="2" <?php foreach($changes_suggested as $val){if ($val== 2){ echo"checked";}}?>>&nbsp;&nbsp;Redesign task steps</p>
					<p><input type="checkbox" name="prevent3" value="3" <?php foreach($changes_suggested as $val){if ($val== 3){ echo"checked";}}?>>&nbsp;&nbsp;Routinely inspect the hazard</p>
					<p><input type="checkbox" name="prevent4" value="4" <?php foreach($changes_suggested as $val){if ($val== 4){ echo"checked";}}?>>&nbsp;&nbsp;Guard the hazard</p>
					<p><input type="checkbox" name="prevent5" value="5" <?php foreach($changes_suggested as $val){if ($val== 5){ echo"checked";}}?>>&nbsp;&nbsp;Redesign work station</p>
					<p><input type="checkbox" name="prevent6" value="6" <?php foreach($changes_suggested as $val){if ($val== 6){ echo"checked";}}?>>&nbsp;&nbsp;PPE</p>
					<p><input type="checkbox" name="prevent7" value="7" <?php foreach($changes_suggested as $val){if ($val== 7){ echo"checked";}}?>>&nbsp;&nbsp;Train the employee</p>
					<p><input type="checkbox" name="prevent8" value="8" <?php foreach($changes_suggested as $val){if ($val== 8){ echo"checked";}}?>>&nbsp;&nbsp;Write a new policy/rule</p>
					<p><input type="checkbox" name="prevent9" value="9" <?php foreach($changes_suggested as $val){if ($val== 9){ echo"checked";}}?>>&nbsp;&nbsp;Train the supervisor</p>
					<p><input type="checkbox" name="prevent10" value="10" <?php foreach($changes_suggested as $val){if ($val== 10){ echo"checked";}}?>>&nbsp;&nbsp;Enforce existing policy</p>
			</td>
			<td width="0">&nbsp;</td>
			</tr>
			<tr  class="header-part">
			<td colspan="7" width="510" >
			<p><strong>PART 6: EQUIPMENT DAMAGED DETAILS (Must be filled in if there is any equipment damage)</strong></p>
			</td>
			<td width="0">&nbsp;</td>
			</tr>
			<tr class="body-part">
			<td>
			List of equipment (please specify) with equipment number<br>
			<textarea style="width:400px;  height:97px" id="list-of-equipment"><?php echo $rowQuery['list_of_equipment']; ?></textarea>
			</td>
			<td>
			 Person responsible for the equipment<br>
				<span id="presponsible_ids" style="display: none;"><?php if($rowQuery_presonsible['equipment_person_resp']!=null){echo $rowQuery['equipment_person_resp'];}?></span>
                <select multiple class="input_text" name="presponsible" id="presponsible" style="width: 205px; height: 30px;">
				 <?php if($rowQuery_presonsible['equipment_person_resp']!=null){ echo"<option value='".$rowQuery_presonsible['equipment_person_resp']."'>".$rowQuery_presonsible['full_name']."</option>";}?>
				</select>
                <input class="button incident" type="button" value="Search"  onclick="add_emp_list('pres')" style="width: 70px;"/>
			</td>
			</tr>
			<tr class="body-part">
			<td>
			Equipment location at time of accident<br><input type="text" id="eq-location-time" value="<?php echo $rowQuery['equipment_location']; ?>">
			</td>
			<td>Estimated cost of repair/replacement<br><input type="text" id="repair-cost" value="<?php echo $rowQuery['estimated_cost_repair']; ?>"></td>
			</tr>
			<tr class="body-part">
			<td>
			List of damage to equipment<br>
			<textarea style="width:400px;  height:97px" id="list-of-damage-equipment"> <?php echo $rowQuery['equipment_damage_list']; ?></textarea>
			</td>
			<td id="dropFileForm">
			Was the equipment damage reported to Police?<br>
			 <input type="radio" name="equipment-damage-reported" value="yes" <?php if($rowQuery['police_report']=="yes"){ echo"checked";}?>> Yes &nbsp;&nbsp; <input type="radio" name="equipment-damage-reported" value="no" <?php if($rowQuery['police_report']=="no"){ echo"checked";}?>> No
						<p class="upload-police-report" style="display:none">
								 <input type="file" name="files[]" id="fileInput" multiple onchange="addFiles(event)">

								  <label for="fileInput" id="fileLabel" ondragover="overrideDefault(event);fileHover();" ondragenter="overrideDefault(event);fileHover();" ondragleave="overrideDefault(event);fileHoverEnd();" ondrop="overrideDefault(event);fileHoverEnd();
										addFiles(event);">
									<img src="images/download.png"><br>
									 
									<span id="fileLabelText">
									<input type="text" id="uploaded_img" style="width:250px;" value="Choose a file or drag it here" readonly />
									<?php if($rowQuery['police_report']=="yes"){ echo'<a href="uploads/appraisal/'.$rowQuery['police_report_file'].'" target="_blank">View</a>';}?>
									</span>
									<span class="exist_file" style="display:none"><?php echo $rowQuery['police_report_file'];?></span>
									<br>
									<span id="uploadStatus"></span>
								  </label>
					    </p>
			</td>
			</tr>
	
			<tr  class="header-part">
			<td colspan="7" width="510">
			<p><strong>PART 7: WHO COMPLETED AND REVIEWED THIS FORM?</strong></p>
			</td>
			<td width="0">&nbsp;</td>
			</tr>
			<tr class="body-part">
			<td>
			 Written by <br>
				<span id="writtenby_ids" style="display: none;"><?php if($rowQuery_writtenby['written_by']!=null){ echo $rowQuery_writtenby['written_by'];}?></span>
                <select multiple class="input_text" name="writtenby" id="writtenby" style="width: 205px; height: 30px;">
				<?php if($rowQuery_writtenby['written_by']!=null){ echo"<option value='".$rowQuery_writtenby['written_by']."'>".$rowQuery_writtenby['full_name']."</option>";}?>
				</select>
                <input class="button incident" type="button" value="Search"  onclick="add_emp_list('wby')" style="width: 70px;"/>			 
			 </td>
			 <td>
			  Title <br><input type="text" id="written-by-title" value="<?php echo $rowQuery['written_title']; ?>"> 
			 </td>
			 </tr>
			 <tr class="body-part">
			 <td>
			   List of team members(if any) <br>
			   <span id="lteam_ids" style="display: none;"><?php echo $rowQuery['team_members'];?></span>
                <select multiple class="input_text" name="list_of_team_members" id="list_of_team_members" style="width: 300px; height: 69px;">
				<?php 
				foreach($team_members as $val){
					$query_team = mysql_query('SELECT e.full_name, e.id as empid FROM employee e where id='.$val);
					$rowQuery_team = mysql_fetch_array($query_team);
					echo"<option value='".$val."'>".$rowQuery_team['full_name']."</option>";
				}
				?>
				</select>
                <input class="button incident" type="button" value="Search"  onclick="add_emp_list('lteam')" style="width: 70px;"/>

			 </td>
			 <td>
			  Date <br><input type="text" id="written-date" value="<?php echo $rowQuery['written_date']; ?>"> 
			 </td>
			 </tr>
			 <tr class="body-part">
			<td>
			  Department<br><input type="text" id="written-department" value="<?php echo $rowQuery['reviewed_department']; ?>"> 
			  <p>&nbsp;</p>
			  Reviewed by (HOD)<br>
				<span id="reviewed_by_ids" style="display: none;"><?php if($rowQuery_reviewedby['reviewed_by']!=null){ echo $rowQuery_reviewedby['reviewed_by'];}?></span>
                <select multiple class="input_text" name="reviewed_by" id="reviewed_by" style="width: 205px; height: 30px;">
				<?php if($rowQuery_reviewedby['reviewed_by']!=null){ echo"<option value='".$rowQuery_reviewedby['reviewed_by']."'>".$rowQuery_reviewedby['full_name']."</option>";}?>
				</select>
                <input class="button incident" type="button" value="Search"  onclick="add_emp_list('rby')" style="width: 70px;"/>
			</td>
			<td>
			Title <br><input type="text" id="reviewed-title" value="<?php echo $rowQuery['reviewed_title']; ?>">
			<p>&nbsp;</p>
			  Date<br><input type="text" id="reviewed-date" value="<?php echo $rowQuery['reviewed_date']; ?>"> 
			<p>&nbsp;</p>
			</td>
			</tr>
		</tbody>
	</table>
<table style="margin-left:41%" class="action">
	<tbody>
	<tr>
	<td>
	Action<br>
		<select id="form_action">
			<option value="0">- None -</option>
			<option value="1">Save as Draft</option>
			<option value="2">Submit</option>
		</select> &nbsp;<!--<span id="reviewer-tag" style="display: none;"> Reviewer: &nbsp; 
					<span id="tag_reviewer_ids" style="display: none;"></span>
					<select multiple class="input_text" name="tag_reviewer" id="tag_reviewer" style="width: 205px; height: 30px;"></select>
					<input class="button incident" type="button" value="Search"  onclick="add_emp_list('review')" style="width: 70px;"/>
				</span>-->
	<?php 
		if($_GET['edt']==$rowQuery['irid'] && $_GET['edt']!=""){ 
		  echo'<input type="button" class="button" value="Save" onclick="save('.$_GET['edt'].')" style="width: 70px;">';
		}else if(!isset($_GET['edt'])){
			echo '<input type="button" class="button" value="Send" onclick="send()" style="width: 70px;">';
		}
	?>
	</td>
	</tr>
	</tbody>
	</table>
 </div>
 </div>
</div>
</div>
</body>

</html>
<script type="text/javascript">
$(document).ready(function(){
	$("#incident_date, #reviewed-date, #written-date").datepicker({
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true
		});
	$('#incident_time').timepicker({
		hourGrid: 4,
		minuteGrid: 10,
		width:'1000px',
		timeFormat: 'hh:mm tt'
	});
	$("#form_action").change(function(){
		if($(this).val()==2){
			$("#reviewer-tag").show();
		}else{
		  $("#reviewer-tag").hide();
		}
	})
	//Managing the hide and show of the police report
	if($("#injury-nature").val()=="other"){
			$("#other_of_injury").show();
		}else{
		  $("#other_of_injury").hide();
	}
	$("#injury-nature").change(function(){
		if($(this).val()=="other"){
			$("#other_of_injury").show();
		}else{
		  $("#other_of_injury").hide();
		}
	})
	//Managing the hide and show of the police report
	if($("#part-of-employee-workday").val()=="other"){
		$("#other-workdays").show();
	}else{
		$("#other-workdays").hide();
	}
	$("#part-of-employee-workday").change(function(){
		if($(this).val()=="other"){
			$("#other-workdays").show();
		}else{
		  $("#other-workdays").hide();
		}
	})

	//Managing the hide and show of the police report
	if($(".report_is_done input[type='radio']").is(":checked") && $(".report_is_done input[type='radio']:checked").val()=="others"){
			$("#donebyothers").show();
		}else{
			$("#donebyothers").hide();
		}
	$(".report_is_done input[type='radio']").click(function(){
		if($(this).val()=="others"){
			$("#donebyothers").show();
		}else{
			$("#donebyothers").hide();
		}
	});
	//Managing the hide and show MC received?
	if($(".mc_received input[type='radio']").is(":checked") && $(".mc_received input[type='radio']:checked").val()=="yes"){
			$(".mc_yes").show();
		}else{
			$(".mc_yes").hide();
		}
	$(".mc_received input[type='radio']").click(function(){
		if($(this).val()=="yes"){
			$(".mc_yes").show();
		}else{
			$(".mc_yes").hide();
		}
	});
	//Managing the hide and show of Unsafe act by people ( Check all that apply)
	if($(".unsafe_bypeople input[type='checkbox']").is(':checked') && $(".unsafe_bypeople input[type='checkbox']:checked").val()==12){
			$("#unsafe_condp_others").show();
		}else{
			$("#unsafe_condp_others").hide();
		}
	$(".unsafe_bypeople input[type='checkbox']").click(function(){
		if($(this).is(':checked') && $(this).val()==12){
			$("#unsafe_condp_others").show();
			$(".unsafe_bypeople input[type='checkbox']").prop("checked", false);
			$(".unsafe_bypeople input[name='condp12']").prop("checked", true);
			
		}else{
			$("#unsafe_condp_others").hide();
			$(".unsafe_bypeople input[name='condp12']").prop("checked", false);
		}
		
	});
	
	//Managing the hide and show of Unsafe workplace conditions (Check all that apply)
	if($(".unsafe_workplace input[type='checkbox']").is(':checked') && $(".unsafe_workplace input[type='checkbox']:checked").val()==12){
			$("#unsafe_cond_others").show();
		}else{
			$("#unsafe_cond_others").hide();
		}
	$(".unsafe_workplace input[type='checkbox']").click(function(){
		if($(this).is(':checked') && $(this).val()==12){
			$("#unsafe_cond_others").show();
			$(".unsafe_workplace input[type='checkbox']").prop("checked", false);
			$(".unsafe_workplace input[name='cond12']").prop("checked", true);
		}else{
			$("#unsafe_cond_others").hide();
			$(".unsafe_workplace input[name='cond12']").prop("checked", false);
		}
	});
	//Show the police report file once the load the page 
	if($("#dropFileForm input[type='radio']").is(':checked') && $("#dropFileForm input[type='radio']:checked").val()=="yes"){
			$(".upload-police-report").show();
		}else{
			$(".upload-police-report").hide();
	}
	//Managing the hide and show of the police report
	$("#dropFileForm input[type='radio']").click(function(){
		if($(this).is(':checked') && $(this).val()=="yes"){
			$(".upload-police-report").show();
		}else{
			$(".upload-police-report").hide();
		}
		
	});
	
});
function add_emp_list(action){
	
	   underContract=0;
        $("#employee_list_view").empty();
        $("#employee_ids").html("");
        //var department = $("#department").val();
		department=$("#dep_id").val();
		
       var list = $("#employee_ids").html();
        var status = "Active";
        
        var branch = $("#dropBranch").val();
		branch=0;
        if(department != ""){
            if(department == "0"){
                department = "ALL";
            }
			var url= "?widget=emp_list&d="+department+"&b="+branch+"&type="+underContract+"&list="+list+"&s="+status+"&inc="+action;
            window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
        }
    }

		
	var dropFileForm = document.getElementById("dropFileForm");
	//var #uploaded_img = document.getElementById("uploaded_img");
	var uploadStatus = document.getElementById("uploadStatus");
	var fileInput = document.getElementById("fileInput");
	var droppedFiles;

	function overrideDefault(event) {
	  event.preventDefault();
	  event.stopPropagation();
	}

	function fileHover() {
	  dropFileForm.classList.add("fileHover");
	  
	}

	function fileHoverEnd() {
	  dropFileForm.classList.remove("fileHover");
	}

	function addFiles(event) {
	  droppedFiles = event.target.files || event.dataTransfer.files;
	  //$("input[type='file']").prop("files", e.originalEvent.dataTransfer.files);
	  showFiles(droppedFiles);
	}

	function showFiles(files) {
		$("input[type='file']").prop("files", files);
	  if (files.length > 1) {
		 $("#uploaded_img").val(files.length + " files selected");
		//fileLabelText.innerText = files.length + " files selected";
	  } else {
		 $("#uploaded_img").val(files[0].name);
		//fileLabelText.innerText = files[0].name;
	  }
	}

	function changeStatus(text) {
	  uploadStatus.innerText = text;
	}
	
	function send(){
	   var emp_id="<?php echo $user_id; ?>";
	   var mc_rec="";
	   var similar_incident="";
	   var report_of_a=""
	   var mc_yes="";
	   if($(".mc_received input[type='radio']").is(":checked")){
			mc_rec=$(".mc_received input[type='radio']:checked").val();
	   }
	   
	   if(mc_rec=="yes"){
		   mc_yes=$("#mc-days").val();
	   }
	
	   if($(".similar_incident input[type='radio']").is(":checked")){
			similar_incident=$(".similar_incident input[type='radio']:checked").val();
	   }
	   if($(".report_of_a input[type='radio']").is(":checked")){
			report_of_a=$(".report_of_a input[type='radio']:checked").val();
	   }
	   var police_report="";
	   var unsafe_bypeople="";
	   var unsafe_bypeople_other="";
	   var unsafe_workplace="";
	   var unsafe_workplace_other="";
	   var suggested_changes="";
	   $(".unsafe_bypeople input[type='checkbox']:checked").each(function(){
		   unsafe_bypeople+=$(this).val()+",";
	   });
	   $(".unsafe_workplace input[type='checkbox']:checked").each(function(){
		   unsafe_workplace+=$(this).val()+",";
	   });
	   if(unsafe_workplace=="12"){
		   unsafe_workplace_other=$("#unsafe_cond_others").val()
	   }
	   if(unsafe_bypeople=="12"){
		   unsafe_bypeople_other=$("#unsafe_condp_others").val()
	   }
	   $(".suggested_changes input[type='checkbox']:checked").each(function(){
		   suggested_changes+=$(this).val()+",";
	   });
	   $("#dropFileForm input[type='radio']:checked").each(function(){
		  police_report=$("#dropFileForm input[type='radio']:checked").val();
	   });
	   var incident_date=$("#incident_date").val();
	   var incident_time=$("#incident_time").val();
	   var employee_name=$("#employee_name_ids").html();
	   var department=$("#department").val();
	   var gender="";
	   var report_is_done="";
	   if($(".gender input[type='radio']").is(":checked")){
			gender=$(".gender input[type='radio']:checked").val();
	   }
	   if($(".report_is_done input[type='radio']").is(":checked")){
			report_is_done=$(".report_is_done input[type='radio']:checked").val();
	   }
	   var report_is_done_other="";
	  if(report_is_done=="others"){
		  report_is_done_other=$("#donebyothers").val();
	  }
	   var age=$("#age").val();
	   var job_title=$("#job-title").val();
	   var employee_works=$("#employee_works").val();
	   var month_job=$("#month_job").val();
	  
	   var month_employee=$("#month_employee").val();
	   var injury_nature=$("#injury-nature").val();
	   var eq_location=$("#eq-location-time").val();
	   var eq_presponsible=$("#presponsible_ids").html();
	   var list_damage_equipment=$("#list-of-damage-equipment").val();
	   var repair_cost=$("#repair-cost").val();

	   var injury_nature_other="";
	   if(injury_nature=="other"){
		   injury_nature_other=$("#other_of_injury").val();
	   }
	   var location_accident=$("#location-of-accident").val();
	   var supervisor_incharge=$("#supervisor_ids").html();
	   var part_employee_workday=$("#part-of-employee-workday").val();
	   var part_employee_workday_other="";
	   if(part_employee_workday=="other"){
		   part_employee_workday_other=$("#other-workdays").val();
	   }
	   var witness_name=$("#witness-name").val();
	   var incident_description=$("#incident_description").val();
	   var ppe_used=$("#ppe_used").val();
	   var list_equipment=$("#list-of-equipment").val();
	   var writtenby=$("#writtenby_ids").html();
	   var team_memebers=$("#lteam_ids").html();
	   var written_department=$("#written-department").val();
	   var reviewed_by=$("#reviewed_by_ids").html();
	   var written_by_title=$("#written-by-title").val();
	   var written_date=$("#written-date").val();
	   var reviewed_title=$("#reviewed-title").val();
	   var reviewed_date=$("#reviewed-date").val();
	   //var received_by=$("#received-by").val();
	   var action=$("#form_action").val();
	   var uploaded_img = $('#uploaded_img').val();
	   var files = $('#fileInput')[0].files[0];

	   var ext_arr = ['png','jpg','gif','pdf','PNG','JPG','GIV','PDF'];
	   var ext =$('#uploaded_img').val().replace(/^.*\./, '');
		if(jQuery.inArray(ext, ext_arr)==-1 && uploaded_img!="" && police_report!="" && police_report=="yes"){
			alert("Please upload image or pdf file only");
			exit;
		}
		
		var formData = new FormData();
	    formData.append("action",action);
		formData.append("fileInput",files);
		//formData.append("received_by",received_by);
		formData.append("reviewed_date",reviewed_date);
		formData.append("reviewed_title",reviewed_title);
		formData.append("written_date",written_date);
		formData.append("written_by_title",written_by_title);
		formData.append("reviewed_by",reviewed_by);
		formData.append("written_department",written_department);
		formData.append("team_memebers",team_memebers);
		formData.append("writtenby",writtenby);
		formData.append("list_equipment",list_equipment);
		formData.append("ppe_used",ppe_used);
		formData.append("mc_rec",mc_rec);
		formData.append("mc_yes",mc_yes);
		formData.append("incident_description",incident_description);
		formData.append("witness_name",witness_name);
		formData.append("part_employee_workday",part_employee_workday);
		formData.append("part_employee_workday_other",part_employee_workday_other);
		formData.append("supervisor_incharge",supervisor_incharge);
		formData.append("location_accident",location_accident);
		formData.append("injury_nature",injury_nature);
		formData.append("injury_nature_other",injury_nature_other);
		formData.append("month_employee",month_employee);
		formData.append("month_job",month_job);
		formData.append("employee_works",employee_works);
		formData.append("job_title",job_title);
		formData.append("age",age);
		formData.append("report_is_done",report_is_done);
		formData.append("report_is_done_other",report_is_done_other);
		formData.append("gender",gender);
		formData.append("department",department);
		formData.append("employee_name",employee_name);
		formData.append("incident_time",incident_time);
		formData.append("incident_date",incident_date);
		formData.append("police_report",police_report);
		formData.append("suggested_changes",suggested_changes);
		formData.append("unsafe_workplace",unsafe_workplace);
		formData.append("unsafe_workplace_other",unsafe_workplace_other);
		formData.append("unsafe_bypeople",unsafe_bypeople);
		formData.append("unsafe_bypeople_other",unsafe_bypeople_other);
		formData.append("similar_incident",similar_incident);
		formData.append("eq_location",eq_location);
		formData.append("eq_presponsible",eq_presponsible);
		formData.append("repair_cost",repair_cost);
		formData.append("list_damage_equipment",list_damage_equipment);
		formData.append("report_of_a",report_of_a);
		formData.append("emp_id",emp_id);
	

		var error1 = [];
        var error2 = [];
        var error3 = [];
		
		if(report_of_a == "" || report_of_a == " "){
            error1.push("Date of incident");
        }
		if(eq_location == "" || eq_location == " "){
            error1.push("Equipment location at time of accident");
        }
		if(eq_presponsible == "" || eq_presponsible == " "){
            error1.push("Person responsible for the equipment");
        }
		if($.isNumeric(repair_cost)){
			if((repair_cost == "" || repair_cost == " ")){
				error1.push("Estimated cost of repair/replacement");
			}
		}else{
			 error1.push("Estimated cost of repair/replacement");
		}
		if(list_damage_equipment == "" || list_damage_equipment == " "){
            error1.push("List of damage to equipment");
        }
		
		if(incident_date == "" || incident_date == " "){
            error1.push("Date of incident");
        }
		if(unsafe_workplace=="12" && unsafe_workplace_other==""){
		   error1.push("Unsafe workplace conditions other");
	   }
	   if(unsafe_bypeople=="12" && unsafe_bypeople_other==""){
		  error1.push("UUnsafe act by people other");
	   }
		if(injury_nature=="other" && injury_nature_other==""){
		   error1.push("Nature of injury other: (most serious one) ");
	   }
		if(report_is_done=="others" && report_is_done_other==""){
			error1.push("Report is done by others");
		}
		if(part_employee_workday=="other" && part_employee_workday_other==""){
		  error1.push("What part of employee’s workday?");
	   }
		if(incident_time == "" || incident_time == " "){
            error1.push("Time");
        }
		if(employee_name == "" || employee_name == " "){
            error1.push("Name");
        }
		if(department == "" || department == " "){
            error1.push("Department");
        }
		if(gender == "" || gender == " "){
            error2.push("Sex");
        }
		if(mc_rec=="yes" && mc_yes==""){
		   error1.push("f YES, how many days of MC? ");
	   }
		if(report_is_done == "" || report_is_done == " "){
            error2.push("Report is done by");
        }
		if(mc_rec == "" || mc_rec == " "){
            error2.push("There is any MC received?");
        }
		if(similar_incident == "" || similar_incident == " "){
            error2.push("Have there been similar incident or near misses prior to this one?");
        }
		if(unsafe_bypeople == "" || unsafe_bypeople == " "){
            error2.push("Unsafe act by people ( Check all that apply)");
        }
		if(unsafe_workplace == "" || unsafe_workplace == " "){
            error2.push("Unsafe workplace conditions (Check all that apply)");
        }
		if(suggested_changes == "" || suggested_changes == " "){
            error2.push("What changes can you suggest to prevent this incident /near miss from happening again?");
        }
		if(age == "" || age == " "){
            error1.push("Age");
        }
		if(job_title == "" || job_title == " "){
            error1.push("Job title at time of incident");
        }
		if(employee_works == "" || employee_works == " "){
            error1.push("This employee works");
        }
		if(month_job == "" || month_job == " "){
            error1.push("Months doing this job");
        }
		if(injury_nature == "" || injury_nature == " "){
            error3.push("Nature of injury: (most serious one)");
        }
		if(location_accident == "" || location_accident == " "){
            error1.push("Location of Accident");
        }
		if(supervisor_incharge == "" || supervisor_incharge == " "){
            error1.push("Supervisor In Charge");
        }
		if(part_employee_workday == "" || part_employee_workday == " "){
            error3.push("What part of employee’s workday");
        }
		/*if(witness_name == "" || witness_name == " "){
            error1.push("Name of Witness (if any)");
        }*/
		if(incident_description == "" || incident_description == " "){
            error1.push("Describe step by step events that led up to injury/accident. Includes names of any machines, parts, objects, tools, materials and other important details ");
        }
		/*if(ppe_used == "" || ppe_used == " "){
            error1.push("What PPE being used (if any)?");
        }*/
		if(list_equipment == "" || list_equipment == " "){
            error1.push("List of equipment (please specify) with equipment number");
        }
		if(writtenby == "" || writtenby == " "){
            error1.push("Written by");
        }
		/*if(team_memebers == "" || team_memebers == " "){
            error1.push("List of team members(if any)");
        }*/
		if(written_department == "" || written_department == " "){
            error1.push("Department");
        }
		if(reviewed_by == "" || reviewed_by == " "){
            error1.push("Reviewed by (HOD)");
        }
		if(written_by_title == "" || written_by_title == " "){
            error1.push("Title");
        }
		if(written_date == "" || written_date == " "){
            error1.push("Date");
        }
		if(reviewed_title == "" || reviewed_title == " "){
            error1.push("Title");
        }
		if(reviewed_date == "" || reviewed_date == " "){
            error1.push("Date");
        }
		/*if(received_by == "" || received_by == " "){
            error1.push("Report Received by Safety Officer");
        }*/
		if(reviewed_title == "" || reviewed_title == " "){
            error1.push("Title");
        }
		if(reviewed_title == "" || reviewed_title == " "){
            error1.push("Title");
        }
	
		 var error_data1 = '';
        for(var i=0;
        i< error1.length;
        i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0;
        i< error2.length;
        i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
        var error_data3 = '';
        for(var i=0;
        i< error3.length;
        i++){
            error_data3 = error_data3 + error3[i] + "; "
        }

		 var data1 = "";
        var data2 = "";
        var data3 = "";
        var data4 = "";

		if(action!=1){
			if(error1.length > 0){
				data1 = "Please Insert :\n"+error_data1+"\n\n";
			}
			if(error2.length > 0){
				data2 = "Please Check :\n"+error_data2+"\n\n";
			}
			if(error3.length > 0){
				data3 = "Please Select :\n"+error_data3+"\n\n";
			}
		}
		if(data1!= "" || data2!= "" || data3!= ""){
            alert(data1 + data2 + data3);
        }else{
			if(action!=0){
            $.ajax({
					type:'POST',
					url:"?ewidget=incident_report",
					data: formData,
					processData: false,
					contentType: false,
					success:function(data){
						if(data==true){
							alert("Inccident Report Inserted");
							window.location='?loc=incident_record_view';
						}else{
							alert("Error While Processing");
						}
					}
				});
			}
        }
		
    }
	
	function save(id){
	   var emp_id="<?php echo $user_id; ?>";
	   var mc_rec="";
	   var similar_incident="";
	   var report_of_a=""
	   var mc_yes="";
	   if($(".mc_received input[type='radio']").is(":checked")){
			mc_rec=$(".mc_received input[type='radio']:checked").val();
	   }
	   
	   if(mc_rec=="yes"){
		   mc_yes=$("#mc-days").val();
	   }
	
	   if($(".similar_incident input[type='radio']").is(":checked")){
			similar_incident=$(".similar_incident input[type='radio']:checked").val();
	   }
	   if($(".report_of_a input[type='radio']").is(":checked")){
			report_of_a=$(".report_of_a input[type='radio']:checked").val();
	   }
	   var police_report="";
	   var unsafe_bypeople="";
	   var unsafe_bypeople_other="";
	   var unsafe_workplace="";
	   var unsafe_workplace_other="";
	   var suggested_changes="";
	   $(".unsafe_bypeople input[type='checkbox']:checked").each(function(){
		   unsafe_bypeople+=$(this).val()+",";
	   });
	   $(".unsafe_workplace input[type='checkbox']:checked").each(function(){
		   unsafe_workplace+=$(this).val()+",";
	   });
	   if(unsafe_workplace=="12"){
		   unsafe_workplace_other=$("#unsafe_cond_others").val()
	   }
	   if(unsafe_bypeople=="12"){
		   unsafe_bypeople_other=$("#unsafe_condp_others").val()
	   }
	   $(".suggested_changes input[type='checkbox']:checked").each(function(){
		   suggested_changes+=$(this).val()+",";
	   });
	   $("#dropFileForm input[type='radio']:checked").each(function(){
		  police_report=$("#dropFileForm input[type='radio']:checked").val();
	   });
	   var incident_date=$("#incident_date").val();
	   var incident_time=$("#incident_time").val();
	   var employee_name=$("#employee_name_ids").html();
	   var department=$("#department").val();
	   var gender="";
	   var report_is_done="";
	   if($(".gender input[type='radio']").is(":checked")){
			gender=$(".gender input[type='radio']:checked").val();
	   }
	   if($(".report_is_done input[type='radio']").is(":checked")){
			report_is_done=$(".report_is_done input[type='radio']:checked").val();
	   }
	   var report_is_done_other="";
	  if(report_is_done=="others"){
		  report_is_done_other=$("#donebyothers").val();
	  }
	   var age=$("#age").val();
	   var job_title=$("#job-title").val();
	   var employee_works=$("#employee_works").val();
	   var month_job=$("#month_job").val();
	  
	   var month_employee=$("#month_employee").val();
	   var injury_nature=$("#injury-nature").val();
	   var eq_location=$("#eq-location-time").val();
	   var eq_presponsible=$("#presponsible_ids").html();
	   var list_damage_equipment=$("#list-of-damage-equipment").val();
	   var repair_cost=$("#repair-cost").val();

	   var injury_nature_other="";
	   if(injury_nature=="other"){
		   injury_nature_other=$("#other_of_injury").val();
	   }
	   var location_accident=$("#location-of-accident").val();
	   var supervisor_incharge=$("#supervisor_ids").html();
	   var part_employee_workday=$("#part-of-employee-workday").val();
	   var part_employee_workday_other="";
	   if(part_employee_workday=="other"){
		   part_employee_workday_other=$("#other-workdays").val();
	   }
	   var witness_name=$("#witness-name").val();
	   var incident_description=$("#incident_description").val();
	   var ppe_used=$("#ppe_used").val();
	   var list_equipment=$("#list-of-equipment").val();
	   var writtenby=$("#writtenby_ids").html();
	   var team_memebers=$("#lteam_ids").html();
	   var written_department=$("#written-department").val();
	   var reviewed_by=$("#reviewed_by_ids").html();
	   var written_by_title=$("#written-by-title").val();
	   var written_date=$("#written-date").val();
	   var reviewed_title=$("#reviewed-title").val();
	   var reviewed_date=$("#reviewed-date").val();
	   //var received_by=$("#received-by").val();
	   var action=$("#form_action").val();
	   var uploaded_img = $('#uploaded_img').val();
	   var files = $('#fileInput')[0].files[0];
	   var exist_file="";
	   if(uploaded_img=="Choose a file or drag it here" && $(".exist_file").html()!=""){
            uploaded_img=$(".exist_file").html();
			exist_file=$(".exist_file").html();
		}
	  
	   var ext_arr = ['png','jpg','gif','pdf','PNG','JPG','GIV','PDF'];
	   var ext =uploaded_img.replace(/^.*\./, '');

		if(jQuery.inArray(ext, ext_arr)==-1 && uploaded_img!="" && police_report=="yes"){
			alert("Please upload image or pdf file only");
			exit;
		}
		
		var formData = new FormData();
	    formData.append("action",action);
		formData.append("fileInput",files);
		//formData.append("received_by",received_by);
		formData.append("reviewed_date",reviewed_date);
		formData.append("reviewed_title",reviewed_title);
		formData.append("written_date",written_date);
		formData.append("written_by_title",written_by_title);
		formData.append("reviewed_by",reviewed_by);
		formData.append("written_department",written_department);
		formData.append("team_memebers",team_memebers);
		formData.append("writtenby",writtenby);
		formData.append("list_equipment",list_equipment);
		formData.append("ppe_used",ppe_used);
		formData.append("mc_rec",mc_rec);
		formData.append("mc_yes",mc_yes);
		formData.append("incident_description",incident_description);
		formData.append("witness_name",witness_name);
		formData.append("part_employee_workday",part_employee_workday);
		formData.append("part_employee_workday_other",part_employee_workday_other);
		formData.append("supervisor_incharge",supervisor_incharge);
		formData.append("location_accident",location_accident);
		formData.append("injury_nature",injury_nature);
		formData.append("injury_nature_other",injury_nature_other);
		formData.append("month_employee",month_employee);
		formData.append("month_job",month_job);
		formData.append("employee_works",employee_works);
		formData.append("job_title",job_title);
		formData.append("age",age);
		formData.append("report_is_done",report_is_done);
		formData.append("report_is_done_other",report_is_done_other);
		formData.append("gender",gender);
		formData.append("department",department);
		formData.append("employee_name",employee_name);
		formData.append("incident_time",incident_time);
		formData.append("incident_date",incident_date);
		formData.append("police_report",police_report);
		formData.append("suggested_changes",suggested_changes);
		formData.append("unsafe_workplace",unsafe_workplace);
		formData.append("unsafe_workplace_other",unsafe_workplace_other);
		formData.append("unsafe_bypeople",unsafe_bypeople);
		formData.append("unsafe_bypeople_other",unsafe_bypeople_other);
		formData.append("similar_incident",similar_incident);
		formData.append("eq_location",eq_location);
		formData.append("eq_presponsible",eq_presponsible);
		formData.append("repair_cost",repair_cost);
		formData.append("list_damage_equipment",list_damage_equipment);
		formData.append("report_of_a",report_of_a);
		formData.append("id",id);
		formData.append("exist_file",exist_file);
		formData.append("emp_id",emp_id);

		var error1 = [];
        var error2 = [];
        var error3 = [];
		
		if(report_of_a == "" || report_of_a == " "){
            error1.push("Date of incident");
        }
		if(eq_location == "" || eq_location == " "){
            error1.push("Equipment location at time of accident");
        }
		if(eq_presponsible == "" || eq_presponsible == " "){
            error1.push("Person responsible for the equipment");
        }
		if($.isNumeric(repair_cost)){
			if((repair_cost == "" || repair_cost == " ")){
				error1.push("Estimated cost of repair/replacement");
			}
		}else{
			 error1.push("Estimated cost of repair/replacement");
		}
		if(list_damage_equipment == "" || list_damage_equipment == " "){
            error1.push("List of damage to equipment");
        }
		
		if(incident_date == "" || incident_date == " "){
            error1.push("Date of incident");
        }
		if(unsafe_workplace=="12" && unsafe_workplace_other==""){
		   error1.push("Unsafe workplace conditions other");
	   }
	   if(unsafe_bypeople=="12" && unsafe_bypeople_other==""){
		  error1.push("UUnsafe act by people other");
	   }
		if(injury_nature=="other" && injury_nature_other==""){
		   error1.push("Nature of injury other: (most serious one) ");
	   }
		if(report_is_done=="others" && report_is_done_other==""){
			error1.push("Report is done by others");
		}
		if(part_employee_workday=="other" && part_employee_workday_other==""){
		  error1.push("What part of employee’s workday?");
	   }
		if(incident_time == "" || incident_time == " "){
            error1.push("Time");
        }
		if(employee_name == "" || employee_name == " "){
            error1.push("Name");
        }
		if(department == "" || department == " "){
            error1.push("Department");
        }
		if(gender == "" || gender == " "){
            error2.push("Sex");
        }
		if(mc_rec=="yes" && mc_yes==""){
		   error1.push("f YES, how many days of MC? ");
	   }
		if(report_is_done == "" || report_is_done == " "){
            error2.push("Report is done by");
        }
		if(mc_rec == "" || mc_rec == " "){
            error2.push("There is any MC received?");
        }
		if(similar_incident == "" || similar_incident == " "){
            error2.push("Have there been similar incident or near misses prior to this one?");
        }
		if(unsafe_bypeople == "" || unsafe_bypeople == " "){
            error2.push("Unsafe act by people ( Check all that apply)");
        }
		if(unsafe_workplace == "" || unsafe_workplace == " "){
            error2.push("Unsafe workplace conditions (Check all that apply)");
        }
		if(suggested_changes == "" || suggested_changes == " "){
            error2.push("What changes can you suggest to prevent this incident /near miss from happening again?");
        }
		if(age == "" || age == " "){
            error1.push("Age");
        }
		if(job_title == "" || job_title == " "){
            error1.push("Job title at time of incident");
        }
		if(employee_works == "" || employee_works == " "){
            error1.push("This employee works");
        }
		if(month_job == "" || month_job == " "){
            error1.push("Months doing this job");
        }
		if(injury_nature == "" || injury_nature == " "){
            error3.push("Nature of injury: (most serious one)");
        }
		if(location_accident == "" || location_accident == " "){
            error1.push("Location of Accident");
        }
		if(supervisor_incharge == "" || supervisor_incharge == " "){
            error1.push("Supervisor In Charge");
        }
		if(part_employee_workday == "" || part_employee_workday == " "){
            error3.push("What part of employee’s workday");
        }
		/*if(witness_name == "" || witness_name == " "){
            error1.push("Name of Witness (if any)");
        }*/
		if(incident_description == "" || incident_description == " "){
            error1.push("Describe step by step events that led up to injury/accident. Includes names of any machines, parts, objects, tools, materials and other important details ");
        }
		/*if(ppe_used == "" || ppe_used == " "){
            error1.push("What PPE being used (if any)?");
        }*/
		if(list_equipment == "" || list_equipment == " "){
            error1.push("List of equipment (please specify) with equipment number");
        }
		if(writtenby == "" || writtenby == " "){
            error1.push("Written by");
        }
		/*if(team_memebers == "" || team_memebers == " "){
            error1.push("List of team members(if any)");
        }*/
		if(written_department == "" || written_department == " "){
            error1.push("Department");
        }
		if(reviewed_by == "" || reviewed_by == " "){
            error1.push("Reviewed by (HOD)");
        }
		if(written_by_title == "" || written_by_title == " "){
            error1.push("Title");
        }
		if(written_date == "" || written_date == " "){
            error1.push("Date");
        }
		if(reviewed_title == "" || reviewed_title == " "){
            error1.push("Title");
        }
		if(reviewed_date == "" || reviewed_date == " "){
            error1.push("Date");
        }
		/*if(received_by == "" || received_by == " "){
            error1.push("Report Received by Safety Officer");
        }*/
		if(reviewed_title == "" || reviewed_title == " "){
            error1.push("Title");
        }
		if(reviewed_title == "" || reviewed_title == " "){
            error1.push("Title");
        }
	
		 var error_data1 = '';
        for(var i=0;
        i< error1.length;
        i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0;
        i< error2.length;
        i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
        var error_data3 = '';
        for(var i=0;
        i< error3.length;
        i++){
            error_data3 = error_data3 + error3[i] + "; "
        }

		 var data1 = "";
        var data2 = "";
        var data3 = "";
        var data4 = "";

		if(action!=1){
			if(error1.length > 0){
				data1 = "Please Insert :\n"+error_data1+"\n\n";
			}
			if(error2.length > 0){
				data2 = "Please Check :\n"+error_data2+"\n\n";
			}
			if(error3.length > 0){
				data3 = "Please Select :\n"+error_data3+"\n\n";
			}
		}
		if(data1!= "" || data2!= "" || data3!= ""){
            alert(data1 + data2 + data3);
        }else{
			if(action!=0){
            $.ajax({
					type:'POST',
					url:"?ewidget=incident_report",
					data: formData,
					processData: false,
					contentType: false,
					success:function(data){

						if(data==true){
							alert("Inccident Report updated");
							window.location='?loc=incident_record_view';
						}else{
							alert("Error While Processing");
						}
					}
				});
			}
        }
		
    }
function back(){ 
        history.back(-1);
    }
</script>
<style>
.incident-redport {
    border: 3px solid #ddd;
    padding-left: 17px;
    padding-right: 17px;
    padding-bottom: 2%;
    width: 93%;
    margin: auto;
}
input.button.incident {
    position: relative;
    top: -7px;
}
#reviewer-tag .button.incident {
    position: relative;
    top: 1px;
}

#reviewer-tag #tag_reviewer {
    /* margin-top: 0px; */
    position: relative;
    top: 9px;
}
#dropFileForm #fileLabel {
    width: 73% !important;
    margin-left: 13%;
}
.incident-redport .header_text {
    width: 104%;
    margin-left: -20px;
    margin-top: -3px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
	margin-bottom: 14px;
    text-transform: uppercase;
}
table.report tr>td {
    padding-bottom: 1em;
}

tr.header-part td {
    padding-bottom: 0px !important;
	padding-left: 10px !important;
    padding-top: 5px !important;
}
tr.header-part {
    background: rgb(38,38,38);
    color: #fff;
}

tr.body-part td {
    padding: 10px !important;
}
</style>