<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php

include "plugins/mailer/mailapp.php";
$emp_id = $_POST['emp_id'];

//uploading file to a folde
$filename = $_FILES['fileInput']['name'];

if(!empty($filename)){
	//Rename the file
	$temp = explode(".", $filename);
	$filename = "police_report_".round(microtime(true)) .'_'.$emp_id.'.' . end($temp);
	/* Location */
	$location = "uploads/appraisal/".$filename;
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf','PNG','JPG','GIV','PDF'); // valid extensions
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	/* Upload file */
	if(in_array($ext, $valid_extensions)) 
	{
		if(move_uploaded_file($_FILES['fileInput']['tmp_name'],$location)){
			//echo "loca:".$location;
		}else{
			//echo 0;
		}
	}
}else{
	if(!empty($_POST['id']) && !empty($_POST['exist_file'])){
		$filename =$_POST['exist_file'];
	}else{
		$filename = "";
	}
}

$reviewed_date="0000-00-00";
$written_date="0000-00-00";
$incident_date="0000-00-00";
if($_POST['reviewed_date']!=""){
	$reviewed_date=date("Y-m-d", strtotime($_POST['reviewed_date']));
}
if($_POST['written_date']!=""){
	$written_date=date("Y-m-d", strtotime($_POST['written_date']));
}
if($_POST['incident_date']!=""){
	$incident_date=date("Y-m-d", strtotime($_POST['incident_date']));
}


//date("Y-m-d", strtotime($claim_date))
// End a the file upload

if(empty($_POST['id'])){
	$sql = "INSERT INTO incident_report(report_of,incident_date,report_done_by,report_done_by_other,time,name,department,sex,age,victim_job_title, nature_of_injury, nature_of_injury_other, employee_works, months_employer, months_of_job, location_of_accident, supervisor_incharge, part_employee_workdays, part_employee_workdays_other, witness_name, incident_description, ppe, mc, mc_yes, unsafe_work_place, unsafe_work_place_other, unsafe_act_people, unsafe_act_people_other, similar_incident, changes_suggested	, list_of_equipment, equipment_location, equipment_person_resp, estimated_cost_repair, equipment_damage_list, police_report, police_report_file, written_by, written_title, team_members, written_date, reviewed_department, reviewed_title, reviewed_by, reviewed_date,created_by,created_date, action) VALUES 
			('" . $_POST['report_of_a'] . "','" . $incident_date . "','" . $_POST['report_is_done'] . "','" . $_POST['report_is_done_other'] . "','" . $_POST['incident_time'] . "',
			'" . $_POST['employee_name'] . "','" . $_POST['department'] . "','" . $_POST['gender'] . "','" . $_POST['age'] . "','" . $_POST['job_title'] . "','" . $_POST['injury_nature'] . "','" .$_POST['injury_nature_other']. "',
			'" . $_POST['employee_works'] . "','" . $_POST['month_employee'] . "','" . $_POST['month_job'] . "','" . $_POST['location_accident'] . "','" . $_POST['supervisor_incharge'] . "','" . $_POST['part_employee_workday'] . "','" . $_POST['part_employee_workday_other'] . "','" .$_POST['witness_name']. "',
			'" .$_POST['incident_description']. "','" .$_POST['ppe_used']. "','" .$_POST['mc_rec']. "','" .$_POST['mc_yes']. "','" .$_POST['unsafe_workplace']. "','" .$_POST['unsafe_workplace_other']. "','" .$_POST['unsafe_bypeople']. "','" .$_POST['unsafe_bypeople_other']. "','" .$_POST['similar_incident']. "',
			'" .$_POST['suggested_changes']. "','" .$_POST['list_equipment']. "','" .$_POST['eq_location']. "','" .$_POST['eq_presponsible']. "','" .$_POST['repair_cost']. "','" .$_POST['list_damage_equipment']. "','" . $_POST['police_report'] . "','" . $filename . "','" . $_POST['writtenby'] . "','" . $_POST['written_by_title'] . "',
			'" . $_POST['team_memebers'] . "','" . $written_date . "','" . $_POST['written_department'] . "','" . $_POST['reviewed_title'] . "','" . $_POST['reviewed_by'] . "','" . $reviewed_date . "','" . $_POST['emp_id'] . "','" . date("Y-m-d") . "','" . $_POST['action'] . "');";
}else{//Update
	$queryEDIT = mysql_query('UPDATE incident_report SET
                                    report_of = "' . $_POST['report_of_a'] . '",
									incident_date = "' . $incident_date . '",
                                    report_done_by = "' . $_POST['report_is_done'] . '",
                                    report_done_by_other = "' . $_POST['report_is_done_other'] . '",
                                    time = "' . $_POST['incident_time'] . '",
									name = "' . $_POST['employee_name'] . '",
									department = "' . $_POST['department'] . '",
									sex = "' . $_POST['gender'] . '",
                                    age = "' . $_POST['age'] . '",
                                    victim_job_title = "' . $_POST['job_title'] . '",
									nature_of_injury = "' . $_POST['injury_nature'] . '",
                                    nature_of_injury_other = "' . $_POST['injury_nature_other'] . '",
									employee_works = "' . $_POST['employee_works'] . '",
									months_employer ="' . $_POST['month_employee'] . '",
									months_of_job = "' . $_POST['month_job'] . '",
                                    location_of_accident = "' . $_POST['location_accident'] . '",
                                    supervisor_incharge = "' . $_POST['supervisor_incharge'] . '",
                                    part_employee_workdays = "' . $_POST['part_employee_workday'] . '",
                                    part_employee_workdays_other = "' . $_POST['part_employee_workday_other'] . '",
                                    witness_name = "' . $_POST['witness_name'] . '",
                                    incident_description = "' . $_POST['incident_description'] . '",
									ppe = "' . $_POST['ppe_used'] . '",
                                    mc= "' . $_POST['mc_rec'] . '",
									mc_yes = "' . $_POST['mc_yes'] . '",
									unsafe_work_place = "' .$_POST['unsafe_workplace']. '",
									unsafe_work_place_other = "' . $_POST['unsafe_workplace_other'] . '",
									unsafe_act_people = "' . $_POST['unsafe_bypeople'] . '",
                                    unsafe_act_people_other = "' . $_POST['unsafe_bypeople_other'] . '",
									similar_incident= "' . $_POST['similar_incident'] . '",
									changes_suggested= "' . $_POST['suggested_changes'] . '",
									list_of_equipment= "' . $_POST['list_equipment'] . '",
									equipment_location= "' . $_POST['eq_location'] . '",
									equipment_person_resp= "' . $_POST['eq_presponsible'] . '",
									estimated_cost_repair= "' . $_POST['repair_cost'] . '",
									equipment_damage_list= "' . $_POST['list_damage_equipment'] . '",
									police_report= "' . $_POST['police_report'] . '",
									police_report_file= "' . $filename . '",
									written_by= "' . $_POST['writtenby'] . '",
									written_title= "' . $_POST['written_by_title'] . '",
									team_members= "' . $_POST['team_memebers'] . '",
									written_date= "' . $written_date. '",
									reviewed_department= "' . $_POST['written_department'] . '",
									reviewed_title= "' . $_POST['reviewed_title'] . '",
									reviewed_by= "' . $_POST['reviewed_by'] . '",
									reviewed_date= "' . $reviewed_date . '",
									updated_by= "' . $_POST['emp_id'] . '",
									updated_date= "' . date("Y-m-d") . '",
									action= "' . $_POST['action']. '"
                                    WHERE id=' . $_POST['id'] . ';');
}

$query = mysql_query($sql);

if ($query > 0 || $queryEDIT > 0) {
    print true;
} else {
    print false;
}

?>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>