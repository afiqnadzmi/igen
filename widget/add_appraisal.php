<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

// Check if the appraisal record already existed
$sql_query=mysql_query("Select id from appriasal_personal_info where emp_id='".$_POST['emp_num']."' AND(Year(evaluation_from)=".date('Y', strtotime($_POST['f_peroid']))." and Month(evaluation_from)=".date('m', strtotime($_POST['f_peroid'])).") AND (Year(evaluation_to)=".date('Y', strtotime($_POST['t_peroid']))." and Month(evaluation_to)=".date('m', strtotime($_POST['t_peroid'])).")");
$num_rows=mysql_num_rows($sql_query);

if($num_rows==0){
	// Personal Information
	$full_name=$_POST['full_name'];
	$emp_num=$_POST['emp_num'];
	$emp_position=$_POST['emp_position'];
	$dep_name=$_POST['dep_name'];
	$immed_supervisor=$_POST['immed_supervisor'];
	$join_date=$_POST['join_date'];
	$type_evaluation=$_POST['type_evaluation'];
	$f_peroid=$_POST['f_peroid'];
	$t_peroid=$_POST['t_peroid'];
	$ann_leave=$_POST['ann_leave'];
	$emer_leave=$_POST['emer_leave'];
	$mc=$_POST['mc'];
	$holiday_leave=$_POST['holiday_leave'];
	$unpaid=$_POST['unpaid'];
	if($f_peroid!=""){
		$f_peroid = date('Y-m-d', strtotime($f_peroid));
	}
	if($t_peroid!=""){
		$t_peroid = date('Y-m-d', strtotime($t_peroid));
	}

	$sql =mysql_query("INSERT INTO appriasal_personal_info(emp_id, supervisor_id,tagged, type_evaluation, evaluation_from, evaluation_to, al, el, sl, hl, unpaid_leave,created_by,created_date,action)
			VALUES ('" . $emp_num . "','" . $immed_supervisor . "','0','" . $type_evaluation . "','" . $f_peroid . "','" . $t_peroid . "','" . $ann_leave . "','" . $emer_leave . "','" . $mc . "','" . $holiday_leave . "','" . $unpaid . "','" . $emp_num . "','" . date('Y-m-d') . "','" . $_POST['action'] . "')");
echo "wwww".$num_rows;
exit();
	$lastInserted_id=mysql_insert_id();
			
	//Job Responsibilities
	$job_resp = explode(";", $_POST['responsibility']);
	$resp_avarage=0;
	foreach($job_resp as $jr){
		$respo = explode(",", $jr);
		$resposibility= $respo[0];
		$target = $respo[1];
		$actual = $respo[2]; 
		$emp_rate=$respo[3];
		$sup_rate=$respo[4];
		$eval2_rate=$respo[5];
		$eval3_rate=$respo[6];
		$resp_avarage = $resp_avarage + $eval2_rate + $eval3_rate + $sup_rate;
		if($sup_rate==0){
			$sup_rate="";
		}
		$sup_comment=$respo[7];
		$eval2_comment=$respo[8];
		$eval3_comment=$respo[9];
		 //Inser into DB
		$sql =mysql_query("INSERT INTO appraisal_jr(ref_id,resposibility,target,actual,emp_rate,sup_rate,evaluator2_rate,evaluator3_rate, sup_comment,eva2_comment,eva3_comment)
			VALUES ('" . $lastInserted_id . "','" . $resposibility . "','" . $target . "','" . $actual . "','" . $emp_rate . "','" . $sup_rate . "','" . $eval2_rate . "','" . $eval3_rate . "','" . $sup_comment . "','" . $eval2_comment . "','" . $eval3_comment . "')");
	}
	//Calculate the average rate of evaluators (Job Responsibilities)
	if($resp_avarage/sizeof($job_resp) > 5){
		$resp_avarage=5;
	}else{
		$resp_avarage=$resp_avarage/sizeof($job_resp);
	}
	// Techical Skills
	$tech = explode(";", $_POST['technical']);
	$tech_avarage =0;
	foreach($tech as $t){
		$technical = explode(".", $t);
		$tech_skill= $technical[0];
		$emp_rate=$technical[1];
		$sup_rate=$technical[2];
		$eval2_rate=$technical[3];
		$eval3_rate=$technical[4];
		$tech_avarage = $tech_avarage + $eval2_rate + $eval3_rate + $sup_rate;
		if($sup_rate==0 || $sup_rate==null){
			$sup_rate="";
		}
		 //Inser into DB
		$sql =mysql_query("INSERT INTO appraisal_gwc(ref_id,technical_skills,emp_rate,sup_rate,evaluator2_rate,evaluator3_rate,type)
			VALUES ('" . $lastInserted_id . "','" . $tech_skill . "','" . $emp_rate . "','" . $sup_rate . "','" . $eval2_rate . "','" . $eval3_rate . "','technical')");
	}
	//Calculate the average rate of evaluators (Techical Skills)
	if($tech_avarage/sizeof($tech) > 5){
		$tech_avarage=5;
	}else{
		$tech_avarage=$tech_avarage/sizeof($tech);
	}

	// Leadership
	$lead = explode(";", $_POST['leadership']);
	$lead_avarage =0;
	foreach($lead as $l){
		$leadership = explode(",", $l);
		$leader= $leadership[0];
		$emp_rate=$leadership[1];
		$sup_rate=$leadership[2];
		$eval2_rate=$leadership[3];
		$eval3_rate=$leadership[4];
		$lead_id=$leadership[5];
		$lead_avarage = $lead_avarage + $eval2_rate + $eval3_rate + $sup_rate;
		if($sup_rate==0 || $sup_rate==null){
			$sup_rate="";
		}
		//Inser into DB
		$sql =mysql_query("INSERT INTO appraisal_gwc(ref_id,technical_skills,emp_rate,sup_rate,evaluator2_rate,evaluator3_rate,type)
			VALUES ('" . $lastInserted_id . "','" . $leader . "','" . $emp_rate . "','" . $sup_rate . "','" . $eval2_rate . "','" . $eval3_rate . "','leadership')");
	}
	//Calculate the average rate of evaluators (Leadership)
	if($lead_avarage/sizeof($lead) > 5){
		$lead_avarage=5;
	}else{
		$lead_avarage=$lead_avarage/sizeof($lead);
	}
	// Quality
	$quality = explode(";", $_POST['quality']);
	$qlty_avarage =0;
	foreach($quality as $q){
		$qual = explode(",", $q);
		$qty= $qual[0];
		$emp_rate=$qual[1];
		$sup_rate=$qual[2];
		$eval2_rate=$qual[3];
		$eval3_rate=$qual[4];
		$qty_id=$qual[5];
		$qlty_avarage = $qlty_avarage + $eval2_rate + $eval3_rate + $sup_rate;
		if($sup_rate==0 || $sup_rate==null){
			$sup_rate="";
		}
		//Inser into DB
		$sql =mysql_query("INSERT INTO appraisal_gwc(ref_id,technical_skills,emp_rate,sup_rate,evaluator2_rate,evaluator3_rate,type)
			VALUES ('" . $lastInserted_id . "','" . $qty . "','" . $emp_rate . "','" . $sup_rate . "','" . $eval2_rate . "','" . $eval3_rate . "','quality')");
	}
	//Calculate the average rate of evaluators (Quality)
	if($qlty_avarage/sizeof($quality) > 5){
		//$qlty_avarage=5;
		$qlty_avarage=$qlty_avarage/sizeof($quality);
	}else{
		$qlty_avarage=$qlty_avarage/sizeof($quality);
	}
	

	// Productivity
	$productivity = explode(";", $_POST['productivity']);
	$pro_avarage =0;
	foreach($productivity as $p){
		$pro = explode(",", $p);
		$prod= $pro[0];
		$emp_rate=$pro[1];
		$sup_rate=$pro[2];
		$eval2_rate=$pro[3];
		$eval3_rate=$pro[4];
		$prod_id=$pro[5];
		$pro_avarage = $pro_avarage + $eval2_rate + $eval3_rate + $sup_rate;
		if($sup_rate==0 || $sup_rate==null){
			$sup_rate="";
		}
		//Inser into DB
		$sql =mysql_query("INSERT INTO appraisal_gwc(ref_id,technical_skills,emp_rate,sup_rate,evaluator2_rate,evaluator3_rate,type)
			VALUES ('" . $lastInserted_id . "','" . $prod . "','" . $emp_rate . "','" . $sup_rate . "','" . $eval2_rate . "','" . $eval3_rate . "','productivity')");
	}
	//Calculate the average rate of evaluators (Productivity)
		if($pro_avarage/sizeof($productivity) > 5){
			 $pro_avarage=5;
		}else{
			$pro_avarage=$pro_avarage/sizeof($productivity);
		}
		//Calculate the final Rating 
		$final_rating= number_format((0.10 * $pro_avarage) + (0.15 * $qlty_avarage) + (0.10 * $lead_avarage) + (0.25 * $tech_avarage) + (0.40 * $resp_avarage), 1);
		if($final_rating>5){
			$final_rating=5;
		}
		
		//Update the final rating
		$sql =mysql_query("UPDATE appriasal_personal_info SET final_rating='".$final_rating."'WHERE id=".$lastInserted_id);


	// Employee Development
	$e_development = explode(";", $_POST['e_development']);
	foreach($e_development as $ed){
		$emp_dev = explode(",", $ed);
		$area_of_imp= $emp_dev[0];
		$action_plan=$emp_dev[1];
		//Inser into DB
		$sql =mysql_query("INSERT INTO appraisal_ed(ref_id,area_improvement,action_plan)
			VALUES ('" . $lastInserted_id . "','" . $area_of_imp . "','" . $action_plan . "')");
		
	}

	// Performance Evaluation Summary
	/*$p_evaluation = explode(";", $_POST['p_evaluation']);
	foreach($p_evaluation as $pe){
		$performance = explode(",", $pe);
		$p_area= $performance[0];
		$weight=$performance[1];
		$rating=$performance[2];
		$final_rating = ($weight/100) * $rating;
		//Inser into DB
		$sql =mysql_query("INSERT INTO appraisal_pes(ref_id,performance_area,weight,rating,final_rating)
			VALUES ('" . $lastInserted_id . "','" . $p_area . "','" . $weight . "','" . $rating . "','" . $final_rating . "')");
		
	}*/

	//Comments
	$sup_comment=$_POST['sup_comment'];
	$emp_comment=$_POST['emp_comment'];
	$supervisor2=$_POST['supervisor2'];
	$supervisor3=$_POST['supervisor3'];
	//Inser into DB (comments)
		$sql =mysql_query("INSERT INTO appraisal_comments(ref_id,eva1_comment,eva2_comment,eva3_comment,emp_comment)
			VALUES ('" . $lastInserted_id . "','" . $sup_comment . "','" . $supervisor2 . "','" . $supervisor3 . "','" . $emp_comment . "')");
	if ($sql) {
		echo true;
	} else {
		echo false;
	}
}else{
	echo 2;
}

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>