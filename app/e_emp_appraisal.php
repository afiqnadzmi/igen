
<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
  
  if (isset($_COOKIE["igen_user_id"]) == true ) {	  
    $emp_id = $_COOKIE['igen_user_id'];  
}

$query_hr = mysql_query('SELECT u.a_hr FROM employee e, user_permission u WHERE e.level_id=u.id AND u.a_hr!="a_hr_hide" AND u.appraisal="appraisal_show" AND e.id ="'.$emp_id.'"');
$row_hr = mysql_fetch_array($query_hr);

if($row_hr['a_hr']=="a_hr_edit"){
	$query_emSup =mysql_query('SELECT ai.*, e.full_name from employee e INNER join appriasal_personal_info ai on e.id = ai.emp_id where (ai.action=5 OR ai.emp_id="'.$emp_id.'") ORDER BY final_rating ASC');
}else{
	echo  $emp_id;
	$query_emSup =mysql_query('SELECT ai.*, e.full_name from employee e INNER join appriasal_personal_info ai on e.id = ai.emp_id where ai.emp_id="' .$emp_id.'" ORDER BY final_rating ASC');
}

 ?>

<div class="main_div">
    <div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Performance Appraisal</a>
					</h4>
				</div>
		</div>
	</div>
	
	
	<div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
		<div class="header_text">
					<span>Performance Appraisal</span>
	</div>
	
			<div class="main_content">
				  <a class="add-plus" href="?loc=appraisal-form" style="padding-left:10px !important;padding-right:10px !important; float:right; margin-bottom: 5px;" ><i class="far fa-plus-square"></i>Add</a>
					<table id="tableplugin" class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
							<thead>
								<tr class="pluginth" id="alternatecolor">
									<th style="width:30px;">No.</th>
									<th style="width:180px">Employee Name</th>
									<th style="width:100px">Type of Evaluation</th>
									<th style="width:100px">Peroid of Evaluation (From)</th>
									<th style="width:100px">Peroid of Evaluation (To)</th>
									<th style="width:100px">Initiated Date</th>
									<th style="width:100px">Result</th>
									<th class="aligncentertable" style="width:100px">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i=1;
								 
								 while($row_emSup = mysql_fetch_array($query_emSup)){
									 $id=base64_encode($row_emSup['id']);
									 if($row_emSup['created_date']=="0000-00-00" || $row_emSup['created_date']==null){
										 $created_date=$row_emSup['created_date'];
									 }else{
										  $created_date=date('d-m-Y', strtotime($row_emSup['created_date']));
									 }
					                 if($row_emSup['final_rating'] >=1 && $row_emSup['final_rating'] <=1.89){
										 $style='style="background:red; color:#fff; text-align:center;"';
									 }else if($row_emSup['final_rating'] >=190 && $row_emSup['final_rating'] <=2.89){
										 $style='style="background:#900909; color:#fff; text-align:center;"';
									 }else if($row_emSup['final_rating'] >=2.90 && $row_emSup['final_rating'] <=3.89){
										 $style='style="background:#bbc514; color:#fff; text-align:center;"';
									 }else if($row_emSup['final_rating'] >=3.90 && $row_emSup['final_rating'] <=4.50){
										 $style='style="background:#48b710; color:#fff; text-align:center;"';
									 }else if($row_emSup['final_rating'] >=4.51 && $row_emSup['final_rating'] <=5.00){
										 $style='style="background:#2a7305; color:#fff; text-align:center;"';
									 }
									echo '<tr class="plugintr">
									<td>' . $i .'</td>
									<td >' . $row_emSup['full_name'] . '</td>
									<td >' . $row_emSup['type_evaluation'] . '</td>
									<td>' . date('d-m-Y', strtotime($row_emSup['evaluation_from'])) . '</td>
									<td >' . date('d-m-Y', strtotime($row_emSup['evaluation_to'])) . '</td>
									<td>' .$created_date.'</td>
									<td '.$style.'>' .$row_emSup['final_rating'].'</td>
									<td style="text-align:center;"><a title="Edit" onclick=edit("'.$id.'")><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;|&nbsp;<a title="View" onclick=view("'.$id.'")><i style="color:#000;" class="far fa-eye"></i></a></td>
									</tr>';
									$i++;
									 
								 }
								?>
							</tbody>
					</table>
					
                 <div class="legend">
					<span class="legend-text">NEEDS IMPROVEMENT</span><span class="legend-color" style="background:red;">&nbsp;</span><span class="legend-text">BELOW EXPECTATION</span><span class="legend-color" style="background:#900909;">&nbsp;</span><span class="legend-text">MEETS EXPECTATION</span><span class="legend-color" style="background:#bbc514;">&nbsp;</span><span class="legend-text">EXCEEDS EXPECTATION</span><span class="legend-color" style="background:#48b710;">&nbsp;</span><span class="legend-text">EXCEPTIONAL</span><span class="legend-color" style="background:#2a7305;">&nbsp;</span>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
	
        oTable = $('#tableplugin').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		 
    } );
	
	function edit(id){
        window.location = "?loc=appraisal-form&appedid=" + id;
    }
	function view(id){
        window.location = "?widget=view_appraisal&appedid=" + id;
    }
</script>

<style>
.legend {
   font-weight: bold;
    font-size: 12px !important;
    padding: 10px;
    background: #007DC5;
    color: #fff;
    width: 100%;
    border-radius: 3px;
    /* margin-bottom: 7px; */
    margin-top: 12px;
    margin-bottom: -11px;
    padding-top: 15px;
    padding-bottom: 15px;
    /* padding-left: 19px; */
}
.legend .legend-color {
    /* padding: 9px; */
    border-radius: 2px;
    /* padding-top: 2px; */
    /* padding-bottom: 2px; */
    padding: 5px 13px 5px 6px;
	margin-right: 1%;
}
span.legend-text {
    padding-right: 3px;
}
</style>
