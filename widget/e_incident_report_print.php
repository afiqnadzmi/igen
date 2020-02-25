
<?php

//Select from incident report table 
$query = mysql_query('SELECT *, e.full_name, e.id as empid, ir.id as irid FROM incident_report AS ir INNER JOIN employee AS e ON e.id = ir.name WHERE ir.id='.$_GET['viewid']);
$rowQuery = mysql_fetch_array($query);
$unsafe_work=explode(",",$rowQuery['unsafe_work_place']);
$unsafe_people=explode(",",$rowQuery['unsafe_act_people']);
$changes_suggested=explode(",",$rowQuery['changes_suggested']);
$team_members=explode(",",$rowQuery['team_members']);
$emp_id=$rowQuery['empid'];

//Supervisor
$query_sup = mysql_query('SELECT *, e.full_name, e.id as empid FROM incident_report AS ir INNER JOIN employee AS e ON e.id = ir.supervisor_incharge WHERE ir.id='.$_GET['viewid']);
$rowQuery_sup = mysql_fetch_array($query_sup);

//Person Resposible Equipment
$query_presonsible = mysql_query('SELECT *, e.full_name, e.id as empid FROM incident_report AS ir INNER JOIN employee AS e ON e.id = ir.equipment_person_resp WHERE ir.id='.$_GET['viewid']);
$rowQuery_presonsible = mysql_fetch_array($query_presonsible);

//Written by
$query_writtenby = mysql_query('SELECT *, e.full_name, e.id as empid FROM incident_report AS ir INNER JOIN employee AS e ON e.id = ir.written_by WHERE ir.id='.$_GET['viewid']);
$rowQuery_writtenby = mysql_fetch_array($query_writtenby);

//Reviewed by
$query_reviewedby = mysql_query('SELECT *, e.full_name, e.id as empid FROM incident_report AS ir INNER JOIN employee AS e ON e.id = ir.reviewed_by WHERE ir.id='.$_GET['viewid']);
$rowQuery_reviewedby = mysql_fetch_array($query_reviewedby);
$queryCompany = mysql_query('SELECT c.name,c.logo_img, b.address1, b.address2, b.postal_code, b.state, b.country FROM company AS c 
                                       INNER JOIN branch AS b
                                       ON c.id = b.company_id
                                       JOIN employee AS e
                                       ON e.branch_id = b.id  WHERE e.id="'.$emp_id.'"' );
            $rowCompany = mysql_fetch_array($queryCompany);
?>
<table class="header-part">
<tbody>
<tr>
<td style="vertical-align: top; background: white;" width="166">
<table width="100%">
<tbody>
<tr>
<td>&nbsp;<p>&nbsp; <img src="<?php echo $rowCompany["logo_img"] ; ?> "  style=" width: 193px;" ></p></td>
</tr>
</tbody>
</table>
&nbsp;</td>
</tr>
</tbody>
</table>
<p style="line-height: normal;"><strong><span style="font-size: 10.0pt;">&nbsp;</span></strong></p>

<p style="ine-height: normal;" class="header"><strong><span style="font-size: 9.0pt;">ACCIDENT/INCIDENT INVESTIGATION REPORT FORM</span></strong></p>
<table style="border-collapse: collapse; border: none;" id="body-parts">
<tbody>
<tr style="height: 10.0pt;">
<td style="width: 510.3pt; border: solid windowtext 1.0pt; background: #F2F2F2; padding: 0in 5.4pt 0in 5.4pt; height: 10.0pt;" colspan="7" width="510">
<p style="margin-bottom: .0001pt; line-height: normal;"><strong><span style="font-size: 10.0pt;">PART A : DETAILS </span></strong></p>
</td>
<td style="height: 10.0pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 28.9pt;">
<td style="width: 510.3pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 28.9pt;" colspan="7" width="510">
<p style="margin-bottom: .0001pt; line-height: normal; "><span style="font-size: 10.0pt;">This is a report of a: <?php echo $rowQuery['report_of']; ?></span></p>
</td>
<td style="height: 28.9pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 42.4pt;">
<td style="width: 223.0pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 42.4pt;" width="223">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Date of incident: <?php echo date('d-m-Y', strtotime($rowQuery['incident_date'])); ?></span></p>
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Time: <?php echo $rowQuery['time']; ?></span></p>
</td>
<td style="width: 287.3pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 42.4pt;" colspan="6" width="287">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Report is done by: <?php echo $rowQuery['report_done_by']; ?></span></p>

</td>
<td style="height: 42.4pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 10.0pt;">
<td style="width: 510.3pt; border: solid windowtext 1.0pt; border-top: none; background: #F2F2F2; padding: 0in 5.4pt 0in 5.4pt; height: 10.0pt;" colspan="7" width="510">
<p style="margin-bottom: .0001pt; line-height: normal;"><strong><span style="font-size: 10.0pt;">PART B : PERSON INJURED/ PERSON INVOLVED</span></strong></p>
</td>
<td style="height: 10.0pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 20.0pt;">
<td style="width: 233.7pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 20.0pt;" colspan="2" width="234">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Name: <?php echo strtoupper($rowQuery['full_name']); ?></span></p>
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Department: <?php echo $rowQuery['department']; ?></span></p>
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Job title at time of incident: <?php echo $rowQuery['victim_job_title']; ?></span></p><br>
</td>
<td style="width: 276.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 20.0pt;" colspan="5" width="277">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Sex: <?php echo $rowQuery['sex']; ?></span></p>
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">&nbsp;</span></p>
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Age: <?php echo $rowQuery['age']; ?></span></p>
</td>
<td style="height: 20.0pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 83.9pt;">
<td style="width: 233.7pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 83.9pt;" colspan="2" rowspan="3" width="234">&nbsp; <img src="images/body_part.png"></td>
<td style="width: 134.85pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 83.9pt;" colspan="4" rowspan="3" width="135">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Nature of injury:
<?php 
	if($rowQuery['nature_of_injury']!="other"){ 
	   echo $rowQuery['nature_of_injury'];
	}else{
	   echo $rowQuery['nature_of_injury_other'];
	}
?>
</span></p>
</td>
<td style="width: 141.75pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 83.9pt;" width="142">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">This employee works: <?php echo $rowQuery['employee_works']; ?></span></p>
</td>
<td style="height: 83.9pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 66.55pt;">
<td style="width: 141.75pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 66.55pt;" width="142">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Months with this employer: <?php echo ucwords($rowQuery['months_employer']); ?></span></p>
</td>
<td style="height: 66.55pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 59.75pt;">
<td style="width: 141.75pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 59.75pt;" width="142">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Months doing this job: <?php echo ucwords($rowQuery['months_of_job']); ?></span></p>
</td>
<td style="height: 59.75pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 10.0pt;">
<td style="width: 510.3pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 10.0pt;" colspan="7" width="510">
<p style="margin-bottom: .0001pt; line-height: normal;"><strong><span style="font-size: 10.0pt;">PART 3 : DESCRIBE THE INCIDENT</span></strong></p>
</td>
<td style="height: 10.0pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 27.6pt;">
<td style="width: 233.7pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 27.6pt;" colspan="2" width="234">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Location of Accident: <?php echo $rowQuery['location_of_accident']; ?></span></p>
</td>
<td style="width: 276.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 27.6pt;" colspan="5" rowspan="3" width="277">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">What part of employee&rsquo;s workday?
	<?php 
		if($rowQuery['part_employee_workdays']!="other"){
			echo $rowQuery['part_employee_workdays'];
		}else{
			echo $rowQuery['part_employee_workdays_other'];
		}
	
	?>
</span></p>
</td>
<td style="height: 27.6pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 25.7pt;">
<td style="width: 233.7pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 25.7pt;" colspan="2" width="234">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Supervisor In Charge: <?php echo strtoupper($rowQuery_sup['full_name']);?></span></p>
</td>
<td style="height: 25.7pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: .6in;">
<td style="width: 233.7pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: .6in;" colspan="2" width="234">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Name of Witness (if any): <?php echo strtoupper($rowQuery['witness_name']); ?></span></p>
</td>
<td style="height: .6in; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 31.05pt;">
<td style="width: 510.3pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 31.05pt;" colspan="7" width="510">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Describe step by step events that led up to injury/accident. Includes names of any machines, parts, objects, tools, materials and other important details:</span></p>
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">
<ul>
<?php 
$descriptionList = preg_split('/\r\n|\r|\n/', $rowQuery['incident_description']);
foreach($descriptionList as $val){
 echo "<li>".$val."</li>"; 
}
?>
</ul>
</span></p><br>
</td>
<td style="height: 31.05pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 23.75pt;">
<td style="width: 256.75pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 23.75pt;" colspan="5" width="257">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">What PPE being used (if any)?:</span></p>
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;"><?php echo $rowQuery['ppe']; ?></span></p><br>
</td>
<td style="width: 253.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 23.75pt;" colspan="2" width="254">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Is there is any MC received?:&nbsp; <?php echo $rowQuery['mc'];?></span></p>
<?php if($rowQuery['mc']=="yes"){
	echo'<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">If YES, how many days of MC?:'.$rowQuery['mc_yes'].'</span></p>';
}else{
	echo'<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">&nbsp;</span></p>';
}
?>
<br>
</td>
<td style="height: 23.75pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 13.7pt;">
<td style="width: 510.3pt; border: solid windowtext 1.0pt; border-top: none; background: #F2F2F2; padding: 0in 5.4pt 0in 5.4pt; height: 13.7pt;" colspan="7" width="510">
<p style="margin-bottom: .0001pt; line-height: normal;"><strong><span style="font-size: 10.0pt;">PART 4: WHY DID INCIDENT HAPPEN?</span></strong></p>
</td>
<td style="height: 13.7pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 190.35pt;">
<td style="width: 248.1pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 190.35pt;" colspan="3" width="248">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Unsafe workplace conditions (Check all that apply)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; </span></p>
<ul>
<?php foreach($unsafe_work as $val){
	if ($val== 1){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Inadequate guard</span></p></li>';
	}
	if ($val== 2){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Unguarded guard </span></p></li>';
	}
	if ($val== 3){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Safety device is defective </span></p></li>';
	}
	if ($val== 4){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Tool or equipment defective </span></p></li>';
	}
	if ($val== 5){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Workstation or layout is hazardous </span></p></li>';
	}
	if ($val== 6){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Unsafe lighting</span></p></li>';
	}
	if ($val== 7){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">UnsafeVentilation </span></p></li>';
	}
	if ($val== 8){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Lack of needed PPE </span></p></li>';
	}
	if ($val== 9){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Lack of appropriate equipment/ tools </span></p></li>';
	}
	if ($val== 10){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Unsafe clothing</span></p></li>';
	}
	if ($val== 11){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">No training or insufficient training</span></p></li>';
	}
	if ($val== 12){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">'.$rowQuery['unsafe_work_place_other'].'</span></p></li>';
	}
}
?>
</ul>
</td>
<td style="width: 262.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 190.35pt;" colspan="4" width="262">
 Unsafe act by people ( Check all that apply)<br>
 <ul>
 <?php 
 foreach($unsafe_people as $val){
	 if ($val== 1){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Operating without permission</span></p></li>';
	 }
	 if ($val== 2){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Operating at unsafe speed</span></p></li>';
	 }
	 if ($val== 3){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Servicing equipment without turning off the power</span></p></li>';
	 }
	 if ($val== 4){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Making a safety device incorperative</span></p></li>';
	 }
	 if ($val== 5){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Using defective equipment</span></p></li>';
	 }
	 if ($val== 6){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Using equipment in unapproved way</span></p></li>';
	 }
	 if ($val== 7){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Unsafe lifting</span></p></li>';
	 }
	 if ($val== 8){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Taking unsafe position or posture</span></p></li>';
	 }
	 if ($val== 9){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Distraction, teasing, horseplay</span></p></li>';
	 }
	 if ($val== 10){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Failure to wear PPE</span></p></li>';
	 }
	 if ($val== 11){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Failure to use the available equipment/tools</span></p></li>';
	 }
	 if ($val== 12){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Others: '.$rowQuery['unsafe_work_place_other'].'</span></p></li>';
	 }
	 
}
?>
</ul>
</td>
<td style="height: 190.35pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 14.15pt;">
<td style="width: 510.3pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 14.15pt;" colspan="7" width="510">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Have there been similar incident or near misses prior to this one? : <?php echo $rowQuery['similar_incident']; ?></span></p><br>
</td>
<td style="height: 14.15pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr>
<td style="width: 510.3pt; border: solid windowtext 1.0pt; border-top: none; background: #F2F2F2; padding: 0in 5.4pt 0in 5.4pt; height: 14.15pt;" colspan="7" width="510">
<p style="margin-bottom: .0001pt; line-height: normal;"><strong><span style="font-size: 10.0pt;">PART 5: HOW CAN FUTURE INCIDENTS BE PREVENTED?</span></strong></p>
</td>
<td style="height: 14.15pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 14.15pt;">
<td style="width: 510.3pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 14.15pt;" colspan="7" width="510">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">&nbsp;</span></p>
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">What changes can you suggest to prevent this incident /near miss from happening again?</span></p>
<ul>
<?php foreach($changes_suggested as $val){
	if ($val== 1){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Stop this activity</span></p></li>';
	}
	if ($val== 2){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Redesign task steps</span></p></li>';
	}
	if ($val== 3){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Routinely inspect the hazard</span></p></li>';
	}
	if ($val== 4){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Guard the hazard</span></p></li>';
	}
	if ($val== 5){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Redesign work station</span></p></li>';
	}
	if ($val== 6){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">PPE</span></p></li>';
	}
	if ($val== 7){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Train the employee</span></p></li>';
	}
	if ($val== 8){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Write a new policy/rule</span></p></li>';
	}
	if ($val== 9){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Train the supervisor</span></p></li>';
	}
	if ($val== 10){ 
		echo'<li><p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Enforce existing policy</span></p></li>';
	}
}
?>
</ul>
<br>
</td>
<td style="height: 14.15pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 14.15pt;">
<td style="width: 510.3pt; border: solid windowtext 1.0pt; border-top: none; background: #F2F2F2; padding: 0in 5.4pt 0in 5.4pt; height: 14.15pt;" colspan="7" width="510">
<p style="margin-bottom: .0001pt; line-height: normal;"><strong><span style="font-size: 10.0pt;">PART 6: EQUIPMENT DAMAGED DETAILS (Must be filled in if there is any equipment damage)</span></strong></p>
</td>
<td style="height: 14.15pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 36.65pt;">
<td style="width: 256.1pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 36.65pt;" colspan="4" width="256">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">List of equipment (please specify) with equipment number:</span></p>
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">
<ul>
<?php 
$equipmentList = preg_split('/\r\n|\r|\n/', $rowQuery['list_of_equipment']);
foreach($equipmentList as $val){
 echo "<li>".$val."</li>"; 
}
?>
</ul>
</span></p>
<br>
</td>
<td style="width: 254.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 36.65pt;" colspan="3" rowspan="2" width="254">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Person responsible for the equipment: <?php echo $rowQuery_presonsible['full_name']; ?></span></p>
</td>
<td style="height: 36.65pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 12.2pt;">
<td style="width: 256.1pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 12.2pt;" colspan="4" rowspan="2" width="256">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Equipment location at time of accident: <?php echo $rowQuery['equipment_location']; ?></span></p>
<br>
</td>
<td style="height: 12.2pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 15.6pt;">
<td style="width: 254.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 15.6pt;" colspan="3" rowspan="2" width="254">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Estimated cost of repair/replacement: <?php echo number_format($rowQuery['estimated_cost_repair'],2); ?></span></p>
</td>
<td style="height: 15.6pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 20.35pt;">
<td style="width: 256.1pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 20.35pt;" colspan="4" rowspan="2" width="256">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">List of damage to equipment:<br>
<ul>
<?php 
$equipmentDamageList = preg_split('/\r\n|\r|\n/', $rowQuery['equipment_damage_list']);
foreach($equipmentDamageList as $val){
	echo "<li>".$val."</li>"; 
}
?>
</ul>
</span></p>
</td>
<td style="height: 20.35pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 33.95pt;">
<td style="width: 254.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 33.95pt;" colspan="3" width="254">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Was the equipment damage reported to Police?<br>
<?php echo $rowQuery['police_report']; ?>
</span></p>

</td>
<td style="height: 33.95pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 14.15pt;">
<td style="width: 510.3pt; border: solid windowtext 1.0pt; border-top: none; background: #F2F2F2; padding: 0in 5.4pt 0in 5.4pt; height: 14.15pt;" colspan="7" width="510">
<p style="margin-bottom: .0001pt; line-height: normal;"><strong><span style="font-size: 10.0pt;">PART 7: WHO COMPLETED AND REVIEWED THIS FORM?</span></strong></p>
</td>
<td style="height: 14.15pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 47.9pt;">
<td style="width: 256.75pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 47.9pt;" colspan="5" width="257">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Written by: <?php echo strtoupper($rowQuery_writtenby['full_name']); ?><br>
</span></p>

<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">List of team members(if any):<br>
<ul>
<?php 
				foreach($team_members as $val){
					$query_team = mysql_query('SELECT e.full_name, e.id as empid FROM employee e where id='.$val);
					$rowQuery_team = mysql_fetch_array($query_team);
					echo "<li>".strtoupper($rowQuery_team['full_name'])."</li>";
				}
	?>
</ul>
</span></p>

<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Department: <?php echo $rowQuery['reviewed_department']; ?> <br></span></p><br>
</td>
<td style="width: 253.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 47.9pt;" colspan="2" width="254">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Title: <?php echo $rowQuery['written_title']; ?><br> </span></p>

<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Date: <?php echo date('d-m-Y', strtotime($rowQuery['written_date'])); ?><br></span></p>
</td>
<td style="height: 47.9pt; border: none;" width="0">&nbsp;</td>
</tr>
<tr style="height: 34.6pt;">
<td style="width: 256.75pt; border: solid windowtext 1.0pt; border-top: none; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 34.6pt;" colspan="5" width="257">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Reviewed by (HOD): <?php echo strtoupper($rowQuery_reviewedby['full_name']); ?></span></p><br>
</td>
<td style="width: 253.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: white; padding: 0in 5.4pt 0in 5.4pt; height: 34.6pt;" colspan="2" width="254">
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Title : <?php echo $rowQuery['reviewed_title']; ?></span></p>
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">&nbsp;</span></p>
<p style="margin-bottom: .0001pt; line-height: normal;"><span style="font-size: 10.0pt;">Date: <?php echo  date('d-m-Y', strtotime($rowQuery['reviewed_date'])); ?></span></p><br>
</td>
<td style="height: 34.6pt; border: none;" width="0">&nbsp;</td>
</tr>
</tbody>
</table>
<table>
<tbody>
<tr>
<td width="268">&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<!--<td style="border: .75pt solid black; vertical-align: top; background: white;" width="228">
<table width="100%">
<tbody>
<tr>
<td>
<p style="text-align: center;">Report Received by Safety Officer:</p>
</td>
</tr>
</tbody>
</table>
&nbsp;</td>-->
</tr>
</tbody>
</table>
<p style="line-height: normal;"><strong>&nbsp;</strong></p>

<style>
table#body-parts {
    width: 70%;
    margin: auto;
}
table#body-parts tr td {
    vertical-align: top;
    font-size: 12px;
    font-family: Arial;
}

p.header {
    text-align: center;
    margin: auto;
    margin-bottom: 4px;
}
table.header-part {
    width: 18%;
    margin: auto;
    margin-bottom: -59px;
}
</style>