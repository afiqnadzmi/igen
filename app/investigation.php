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

$query_hr = mysql_query('SELECT u.a_hr FROM employee e, user_permission u WHERE e.level_id=u.id AND u.a_hr!="a_hr_hide" AND u.disc="disc_show" AND e.id="'.$emp_id.'"');
$row_hr = mysql_fetch_array($query_hr);
echo"<input type='hidden' id='sup_id' value='".$emp_id."'>";

?>
<input type="hidden" id="access_user" value="<?php echo $row_hr['a_hr'];?>">
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
		var display="<?php if(isset($_GET['wletter']) && $_GET['wletter']!=""){echo 1;}else{echo 2;}?>";
		if(display==1){
			$("#alleg").show();
			$("<div class='modalWindow'></div>").insertBefore("#MainContainer");
		}else{
			$("#alleg").hide();
		}
	
        oTable = $('#tablecolor, #tableplugin').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		
		if($("#recom").val()=="Warning Letter"){
		   $("table.table-coun.warning").show();
	  }else{
		  $("table.table-coun.warning").hide();
		  $("textarea#misconduct").val("");
		  $("textarea#action_agreed").val("");
	  }
	  $("#recom").change(function(){
		  if($(this).val()=="Warning Letter"){
			  $("table.table-coun.warning").show();
		  }else{
			  $("table.table-coun.warning").hide();
			  $("textarea#misconduct").val("");
			  $("textarea#action_agreed").val("");
		  }
	  });
	  
	  $("#popupBoxClose").click(function(){
		   window.location = "?loc=counselling";
	  });
    });
</script>
<div class="main_div">
    <div id="con">
       <div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						Investigation<input type="button" value="Back" class="button" onclick="back()" style="width: 70px;">
					</h4>
					
				</div>
		</div>
	</div>
    <div id="collapseone" class="panel-collapse" >
			<div class="panel-body">
				<div id="form-body">
				
				<?php
					if(isset($_GET['inves']) && $_GET['inves']!=""){
						$dp_id=base64_decode($_GET['inves']);
						//Accused
						$query = mysql_query('SELECT dp.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid, b.id as bid from employee e INNER JOIN disciplinary_pinfo dp on e.id = dp.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id INNER JOIN branch b on e.branch_id=b.id where dp.id='. $dp_id . ';');
						$row = mysql_fetch_array($query);
						
						//Plaintiff
						$query_plaintiff = mysql_query('SELECT dp.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid from employee e INNER JOIN disciplinary_pinfo dp on e.id = dp.alleged_by INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where dp.id='. $dp_id . ';');
						$row_plaintiff = mysql_fetch_array($query_plaintiff);
						
						//Counsellor
						$query_counsellor = mysql_query('SELECT e.full_name, e.id as eid ,p.position_name, d.dep_name from employee e  INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where e.id='. $emp_id . ';');
						$row_counsellor = mysql_fetch_array($query_counsellor);
						
						//Allegation
						$query_all = mysql_query('SELECT * FROM disciplinary_allegation  where ref_id='.$dp_id);
						
						echo"<input type='hidden' id='dep_id' value='".$row['depid']."'>";
						echo"<input type='hidden' id='branch_id' value='".$row['bid']."'>";
						echo"<input type='hidden' id='emp_id' value='".$emp_id."'>";
						echo"<input type='hidden' id='dp_id' value='".$dp_id."'>";
						echo"<input type='hidden' id='permission' value='a_hr_hide'>";
					?>
					
					<div id="invet-title">
						 Accused Employee Detail
					</div>
					<table class="table-coun"> 
					<tr>
					<th style="width:20%"> Name</th> <td style="width:30%"><input type="text" id="e_name" value="<?php echo $row['full_name'] ?>" disabled></td><th style="width:20%"> Employee Number</th><td style="width:30%"><input type="text" id="e_num" value="EMP<?php echo str_pad($row['eid'], 6, "0", STR_PAD_LEFT) ;?>" disabled></td>
					</tr>
					<tr>
					<th style="width:20%"> Position </th><td style="width:30%"><input type="text" id="e_cp" value="<?php echo $row['position_name'] ?>" disabled></td><th style="width:20%"> Deptartment </th><td style="width:30%"><input type="text" id="d_name" value="<?php echo $row['dep_name'] ?>" disabled></td>
					</tr>
					</table>
					
					<div id="invet-title">
						 Plaintiff Employee Detail
					</div>
					<table class="table-coun"> 
					<tr>
					<th style="width:20%"> Name</th> <td style="width:30%"><input type="text" id="coun_name" value="<?php echo $row_plaintiff['full_name'] ?>" disabled></td><th style="width:20%"> Employee Number</th><td style="width:30%"><input type="text" id="reported_by" value="EMP<?php echo str_pad($row_plaintiff['eid'], 6, "0", STR_PAD_LEFT) ;?>" disabled></td>
					</tr>
					<tr>
					<th style="width:20%"> Position </th><td style="width:30%"><input type="text" id="coun_cp" value="<?php echo $row_plaintiff['position_name'] ?>" disabled></td><th style="width:20%"> Deptartment </th><td style="width:30%"><input type="text" id="d_name" value="<?php echo $row_plaintiff['dep_name'] ?>" disabled></td>
					</tr>
					</table>
					<div id="invet-title">
						Investigation Officer
					</div>
					<table class="table-coun"> 
					<tr>
					<th style="width:20%"> Name</th> <td style="width:30%"><input type="text" id="coun_name" value="<?php echo $row_counsellor['full_name'] ?>" disabled></td><th style="width:20%"> Employee Number</th><td style="width:30%"><input type="text" id="coun_num" value="EMP<?php echo str_pad($row_counsellor['eid'], 6, "0", STR_PAD_LEFT) ;?>" disabled></td>
					</tr>
					<tr>
					<th style="width:20%"> Position </th><td style="width:30%"><input type="text" id="coun_cp" value="<?php echo $row_counsellor['position_name'] ?>" disabled></td><th style="width:20%"> Deptartment </th><td style="width:30%"><input type="text" id="d_name" value="<?php echo $row_counsellor['dep_name'] ?>" disabled></td>
					</tr>
					</table>
					<div id="invet-title">
						 Witness’s  Particular
					</div>
					<table class="table-coun"> 
					<tr>
					<th style="width:20%"> Name</th> <td style="width:30%"> <span id="employee_name_ids" style="display: none;"></span>
                      <select multiple class="input_text" name="employee_name_view" id="employee_name_view" style="width: 205px; height: 30px;">
					   
					  </select>
					  <input type="hidden" id="witness_num" value="EMP<?php echo str_pad($row_witness['eid'], 6, "0", STR_PAD_LEFT) ;?>" disabled>
                      <input class="button incident" type="button" value="Search"  onclick="add_emp_list('couns')" style="width: 70px; position: absolute;"/></td>
					  <th style="width:20%"> Name</th> <td style="width:30%"> <span id="employee_name_ids2" style="display: none;"></span>
                      <select multiple class="input_text" name="employee_name_view2" id="employee_name_view2" style="width: 205px; height: 30px;">
					   
					  </select>
					  <input type="hidden" id="witness_num2" value="EMP<?php echo str_pad($row_witness['eid'], 6, "0", STR_PAD_LEFT) ;?>" disabled>
                      <input class="button incident" type="button" value="Search"  onclick="add_emp_list2('couns2')" style="width: 70px; position: absolute;"/></td>
					</tr>
					<tr>
					<th style="width:20%"> Name</th> <td style="width:30%" colspan="3"> <span id="employee_name_ids3" style="display: none;"></span>
                      <select multiple class="input_text" name="employee_name_view3" id="employee_name_view3" style="width: 205px; height: 30px;">
					   
					  </select>
					  <input type="hidden" id="witness_num3" value="EMP<?php echo str_pad($row_witness['eid'], 6, "0", STR_PAD_LEFT) ;?>" disabled>
                      <input class="button incident" type="button" value="Search"  onclick="add_emp_list3('couns3')" style="width: 70px; position: absolute;"/></td>
					  
					</tr>
					<!--<tr>
					<th style="width:20%"> Position </th><td style="width:30%"><input type="text" id="witness_cp" value="" disabled></td><th style="width:20%"> Deptartment </th><td style="width:30%"><input type="text" id="witness_d_name" value="" disabled></td>
					</tr>-->
					</table>
				
						<div id="invet-title">
							Case Background Detail
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%"> Allegation / Issue</th> <td style="width:70%"><textarea style="width:100%;  height: auto;overflow: scroll;padding-left: 6px;padding-bottom: 20px;" id="discussion" disabled><?php
								 $num_rows=mysql_num_rows($query_all);
								 $i=1;
								 while($row_all = mysql_fetch_array($query_all)){
									 if($num_rows > 1){
										echo $i.". ".$row_all['allegation']."\n";
									 }else{
										 $row_all['allegation'];
									 }
									 $i++;
								 }
								?>
								</textarea></td>
							</tr>
							<tr>
								<th style="width:18%"> Type of Investigation</th> <td style="width:70%"><?php echo $row['offence_type'];?></td>
							</tr>
						</table>
						<div id="invet-title">
							Background<span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – What was the allegation / issue, how it happened, where was the location, why did it take place?</span>
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%"> Background</th> <td style="width:70%"><textarea style="width:100%;  height: 200px;overflow: scroll;padding-left: 6px;padding-bottom: 20px;" id="background"></textarea></td>
							</tr>
						</table>
						<div id="invet-title">
							Remit of Investigation <span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – What specific allegations/concerns were investigated?</span>
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%"> Remit of Investigation</th> <td style="width:70%"><textarea style="width:100%;  height: 200px;overflow: scroll;padding-left: 6px;padding-bottom: 20px;" id="remit"></textarea></td>
							</tr>
						</table>
						<div id="invet-title">
							Investigation Process <span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – Describe method used to gather information, what documents will be reviewed?</span>
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%">Investigation Process </th> <td style="width:70%"><textarea style="width:100%;  height: 200px;overflow: scroll;padding-left: 6px;padding-bottom: 20px;" id="investigation"></textarea></td>
							</tr>
						</table>
						<div id="invet-title">
							Findings <span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – Summarize all findings and observations into a perspective</span>
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%">Findings </th> <td style="width:70%"><textarea style="width:100%;  height: 200px;overflow: scroll;padding-left: 6px;padding-bottom: 20px;" id="finding"></textarea></td>
							</tr>
						</table>
						<div id="invet-title">
							Conclusions  <span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – Overall opinion based ‘on the balance of probabilities’ on whether there is evidence to support</span>
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%">Conclusions  </th> <td style="width:70%"><textarea style="width:100%;  height: 200px;overflow: scroll;padding-left: 6px;padding-bottom: 20px;" id="conclusion"></textarea></td>
							</tr>
						</table>
						<div id="invet-title">
							Recommended action to be taken
					   </div>
						<table class="table-coun"> 
							<tr>
								<th style="width:18%"> Recommended action </th> <td style="width:70%"><textarea style="width:100%;  height: 200px;overflow: scroll;padding-left: 6px;padding-bottom: 20px;" id="recomend"></textarea></td>
							</tr>
						</table>
						<div id="invet-title">
							Appendices<span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – List of documents reviewed</span>
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%"> Appendices</th> <td style="width:70%">
								Select File to upload:
								<input type="file" name="fileToUpload" id="fileToUpload" multiple>
								</td>
							</tr>
						</table>

			            <div class="action"><input type="button" value="Submit" class="button" onclick="send()" style="width: 70px;"></div>
					
					<?php }else if(isset($_GET['appedid']) && $_GET['appedid']!=""){
						$dp_id=base64_decode($_GET['appedid']);
						//Accused
						$query = mysql_query('SELECT inves.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid, b.id as bid from employee e INNER JOIN investigation inves on e.id = inves.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id INNER JOIN branch b on e.branch_id=b.id where inves.id='. $dp_id . ';');
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
						echo"<input type='hidden' id='dep_id' value='".$row['depid']."'>";
						echo"<input type='hidden' id='branch_id' value='".$row['bid']."'>";
						echo"<input type='hidden' id='emp_id' value='".$emp_id."'>";
						echo"<input type='hidden' id='dp_id' value='".$dp_id."'>";
						echo"<input type='hidden' id='permission' value='a_hr_hide'>";
					?>
					
					<div id="invet-title">
						 Accused Employee Detail
					</div>
					<table class="table-coun"> 
					<tr>
					<th style="width:20%"> Name</th> <td style="width:30%"><input type="text" id="e_name" value="<?php echo $row['full_name'] ?>" disabled></td><th style="width:20%"> Employee Number</th><td style="width:30%"><input type="text" id="e_num" value="EMP<?php echo str_pad($row['eid'], 6, "0", STR_PAD_LEFT) ;?>" disabled></td>
					</tr>
					<tr>
					<th style="width:20%"> Position </th><td style="width:30%"><input type="text" id="e_cp" value="<?php echo $row['position_name'] ?>" disabled></td><th style="width:20%"> Deptartment </th><td style="width:30%"><input type="text" id="d_name" value="<?php echo $row['dep_name'] ?>" disabled></td>
					</tr>
					</table>
					
					<div id="invet-title">
						 Plaintiff Employee Detail
					</div>
					<table class="table-coun"> 
					<tr>
					<th style="width:20%"> Name</th> <td style="width:30%"><input type="text" id="coun_name" value="<?php echo $row_plaintiff['full_name'] ?>" disabled></td><th style="width:20%"> Employee Number</th><td style="width:30%"><input type="text" id="reported_by" value="EMP<?php echo str_pad($row_plaintiff['eid'], 6, "0", STR_PAD_LEFT) ;?>" disabled></td>
					</tr>
					<tr>
					<th style="width:20%"> Position </th><td style="width:30%"><input type="text" id="coun_cp" value="<?php echo $row_plaintiff['position_name'] ?>" disabled></td><th style="width:20%"> Deptartment </th><td style="width:30%"><input type="text" id="d_name" value="<?php echo $row_plaintiff['dep_name'] ?>" disabled></td>
					</tr>
					</table>
					<div id="invet-title">
						Investigation Officer
					</div>
					<table class="table-coun"> 
					<tr>
					<th style="width:20%"> Name</th> <td style="width:30%"><input type="text" id="coun_name" value="<?php echo $row_counsellor['full_name'] ?>" disabled></td><th style="width:20%"> Employee Number</th><td style="width:30%"><input type="text" id="coun_num" value="EMP<?php echo str_pad($row_counsellor['eid'], 6, "0", STR_PAD_LEFT) ;?>" disabled></td>
					</tr>
					<tr>
					<th style="width:20%"> Position </th><td style="width:30%"><input type="text" id="coun_cp" value="<?php echo $row_counsellor['position_name'] ?>" disabled></td><th style="width:20%"> Deptartment </th><td style="width:30%"><input type="text" id="d_name" value="<?php echo $row_counsellor['dep_name'] ?>" disabled></td>
					</tr>
					</table>
					<div id="invet-title">
						 Witness’s  Particular
					</div>
					<table class="table-coun"> 
					<tr>
					<th style="width:20%"> Name</th> <td style="width:30%"> <span id="employee_name_ids" style="display: none;"></span>
                      <select multiple class="input_text" name="employee_name_view" id="employee_name_view" style="width: 205px; height: 30px;">
					   <option value="<?php echo $row_witness1['eid']; ?>"><?php echo $row_witness1['full_name']; ?> </option>
					  </select>
					  <input type="hidden" id="witness_num" value="EMP<?php echo str_pad($row_witness1['eid'], 6, "0", STR_PAD_LEFT) ;?>" disabled>
                      <input class="button incident" type="button" value="Search"  onclick="add_emp_list('couns')" style="width: 70px; position: absolute;"/></td>
					  <th style="width:20%"> Name</th> <td style="width:30%"> <span id="employee_name_ids2" style="display: none;"></span>
                      <select multiple class="input_text" name="employee_name_view2" id="employee_name_view2" style="width: 205px; height: 30px;">
					     <option value="<?php echo $row_witness2['eid']; ?>"><?php echo $row_witness2['full_name']; ?> </option>
					  </select>
					  <input type="hidden" id="witness_num2" value="EMP<?php echo str_pad($row_witness2['eid'], 6, "0", STR_PAD_LEFT) ;?>" disabled>
                      <input class="button incident" type="button" value="Search"  onclick="add_emp_list2('couns2')" style="width: 70px; position: absolute;"/></td>
					</tr>
					<tr>
					<th style="width:20%"> Name</th> <td style="width:30%" colspan="3"> <span id="employee_name_ids3" style="display: none;"></span>
                      <select multiple class="input_text" name="employee_name_view3" id="employee_name_view3" style="width: 205px; height: 30px;">
					   <option value="<?php echo $row_witness3['eid']; ?>"><?php echo $row_witness3['full_name']; ?> </option>
					  </select>
					  <input type="hidden" id="witness_num3" value="EMP<?php echo str_pad($row_witness3['eid'], 6, "0", STR_PAD_LEFT) ;?>" disabled>
                      <input class="button incident" type="button" value="Search"  onclick="add_emp_list3('couns3')" style="width: 70px; position: absolute;"/></td>
					  
					</tr>
					<!--<tr>
					<th style="width:20%"> Position </th><td style="width:30%"><input type="text" id="witness_cp" value="" disabled></td><th style="width:20%"> Deptartment </th><td style="width:30%"><input type="text" id="witness_d_name" value="" disabled></td>
					</tr>-->
					</table>
				
						<div id="invet-title">
							Case Background Detail
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%"> Allegation / Issue</th> <td style="width:70%"><textarea style="width:100%;  height: auto;overflow: scroll;padding-left: 6px;padding-bottom: 20px;" id="discussion" disabled><?php
								 $num_rows=mysql_num_rows($query_all);
								 $i=1;
								 while($row_all = mysql_fetch_array($query_all)){
									 if($num_rows > 1){
										echo $i.". ".$row_all['allegation']."\n";
									 }else{
										 $row_all['allegation'];
									 }
									 $i++;
								 }
								?>
								</textarea></td>
							</tr>
							<tr>
								<th style="width:18%"> Type of Investigation</th> <td style="width:70%"><?php echo $row['offence_type'];?></td>
							</tr>
						</table>
						<div id="invet-title">
							Background<span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – What was the allegation / issue, how it happened, where was the location, why did it take place?</span>
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%"> Background</th> <td style="width:70%"><textarea style="width:100%;  height: 200px;overflow: scroll;padding-left: 6px;padding-bottom: 20px;" id="background"><?php echo $row['background'];?></textarea></td>
							</tr>
						</table>
						<div id="invet-title">
							Remit of Investigation <span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – What specific allegations/concerns were investigated?</span>
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%"> Remit of Investigation</th> <td style="width:70%"><textarea style="width:100%;  height: 200px;overflow: scroll;padding-left: 6px;padding-bottom: 20px;" id="remit"><?php echo $row['remit'];?></textarea></td>
							</tr>
						</table>
						<div id="invet-title">
							Investigation Process <span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – Describe method used to gather information, what documents will be reviewed?</span>
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%">Investigation Process </th> <td style="width:70%"><textarea style="width:100%;  height: 200px;overflow: scroll;padding-left: 6px;padding-bottom: 20px;" id="investigation"><?php echo $row['process'];?></textarea></td>
							</tr>
						</table>
						<div id="invet-title">
							Findings <span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – Summarize all findings and observations into a perspective</span>
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%">Findings </th> <td style="width:70%"><textarea style="width:100%;  height: 200px;overflow: scroll;padding-left: 6px;padding-bottom: 20px;" id="finding"><?php echo $row['findings'];?></textarea></td>
							</tr>
						</table>
						<div id="invet-title">
							Conclusions  <span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – Overall opinion based ‘on the balance of probabilities’ on whether there is evidence to support</span>
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%">Conclusions  </th> <td style="width:70%"><textarea style="width:100%;  height: 200px;overflow: scroll;padding-left: 6px;padding-bottom: 20px;" id="conclusion"><?php echo $row['Conclusions'];?></textarea></td>
							</tr>
						</table>
						<table class="table-coun"> 
							<tr>
								<th style="width:18%">Recommended action to be taken  </th> <td style="width:70%"><textarea style="width:100%;  height: 200px;overflow: scroll;padding-left: 6px;padding-bottom: 20px;" id="recomend"><?php echo $row['recommended_action'];?></textarea></td>
							</tr>
						</table>
						<div id="invet-title">
							Appendices<span style="text-transform: lowercase;font-weight: 100;font-size: 14px;"> – List of documents reviewed</span>
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%"> Appendices</th> <td style="width:70%">
								Select File to upload:
								<input type="file" name="fileToUpload" id="fileToUpload" multiple>
								</td>
							</tr>
						</table>

			            <div class="action"><input type="button" value="Save" class="button" onclick="save()" style="width: 70px;"></div>
					
					<?php }else{
					?>
					 	<div class="main_content">
						<table id="tableplugin" class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
							<thead>
								<tr class="pluginth" id="alternatecolor">
									<th style="width:30px;">No.</th>
									<th style="width:180px">Employee Name</th>
									<th style="width:180px">Deptartment</th>
									<th style="width:180px">Section/Unit</th>
									<th style="width:100px">Plaintiff</th>
									<th style="width:100px">Investigation Officer</th>
									<th style="width:100px">Date</th>
									<th class="aligncentertable" style="width:100px">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								/*if($row_hr['a_hr']=="a_hr_edit"){
									if(isset($_GET['coun_view']) && $_GET['coun_view']!=""){
										$id=base64_decode($_GET['coun_view']);
										
									}else{
										$query_emSup =mysql_query('SELECT con.*, e.full_name from employee e INNER join counselling con on e.id = con.emp_id');
									}
								}*/
								$query_emSup =mysql_query('SELECT inves.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid, g.group_name from employee e INNER JOIN investigation inves on e.id = inves.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id INNER JOIN emp_group g on e.group_id=g.id');									

								$i=1;
								 
								 while($row_emSup = mysql_fetch_array($query_emSup)){
									 $id=base64_encode($row_emSup['id']);
									 if($row_emSup['date']=="0000-00-00" || $row_emSup['date']==null){
										 $created_date=$row_emSup['date'];
									 }else{
										  $created_date=date('d-m-Y', strtotime($row_emSup['date']));
									 }
								
					                //Plaintiff
									$query_plaintiff = mysql_query('SELECT inves.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid from employee e INNER JOIN investigation inves on e.id = inves.plaintiff INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where inves.id='. $row_emSup['id'] . ';');
									$row_plaintiff = mysql_fetch_array($query_plaintiff);
									
									//Counsellor
									$query_counsellor = mysql_query('SELECT inves.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid from employee e INNER JOIN investigation inves on e.id = inves.invetigated_by INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where inves.id='. $row_emSup['id'] . ';');
									$row_counsellor = mysql_fetch_array($query_counsellor);
									echo '<tr class="plugintr">
									<td>' . $i .'</td>
									<td >' .$row_emSup['full_name']. '</td>
									<td>' .$row_emSup['dep_name']. '</td>
									<td >' .$row_emSup['group_name'].'</td>
									<td >' .$row_plaintiff['full_name']. '</td>
									<td >' .$row_counsellor['full_name']. '</td>';
									
									echo'<td>' .$created_date.'</td>';
									echo'<td style="text-align:center;"><a title="Edit" onclick=edit("'.$id.'") ><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;|&nbsp;<a title="View" onclick=view("'.$id.'")><i style="color:#000;" class="far fa-eye"></i></a></td>';
									echo'</tr>';
									$i++;
									 
								 }
								?>

							</tbody>
					</table>
					
					
					

			</div>
					<?php
					} ?>
				   </div>
			<div id="alleg" style="display:none">
				<input id="popupBoxClose" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: dimgrey;margin-bottom: 3px; margin-top: -8px;" type="button" value="X">
				<table id="allegation" style="border-collapse: collapse;width: 100%; font-size: 13px;">
					<tr>
						<th style="width:5px">
							No.
						</th>
						<th>
							Generated Date
						</th>
						<th>
							Generated by
						</th>
						<th> </th>
					</tr>
						<?php
							if(isset($_GET['wletter']) && $_GET['wletter']!=""){
								$id=base64_decode($_GET['wletter']);
								$i=1;
								$query_all=mysql_query('SELECT wl.*, e.full_name from warning_letter wl INNER JOIN employee e on wl.officer_id=e.id where coun_id ='.$id);
								while($row_all = mysql_fetch_array($query_all)){
									$wl_id=base64_encode($row_all['id']);
									echo '<tr class="plugintr">
										<td>' . $i .'</td>
										<td >' .date('m-d-Y', strtotime($row_all['date'])). '</td>
										<td >' .$row_all['full_name']. '</td>
										<td ><a title="View" onclick=view_letter("'.$wl_id.'")><i style="color:#000;" class="far fa-eye"></i></a></td>
									</tr>';
									$i++; 
								}
							}
						?>
				</table>			
		</div>
			   </div>
		   </div>
		</div>
	</div>

<script type="text/javascript">
    function view(id){
        window.location="?widget=view_investigation&viewid=" + id;
    }
	function edit(id){
        window.location = "?loc=investigation&appedid=" + id;
    }
	
	function close(){
       // window.location = "?loc=counselling";
    }

    function send(){
		
		/*Personal Inforamtion*/
		 var emp_id = $("#e_num").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var coun_id=$("#coun_num").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var reported_by=$("#reported_by").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var witness_id=$("#witness_num").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var witness_id2=$("#witness_num2").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var witness_id3=$("#witness_num3").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var recomend=$.trim($("textarea#recomend").val());
		 var background = $.trim($("textarea#background").val());
		 var investigation = $.trim($("textarea#investigation").val());
		 var finding = $.trim($("textarea#finding").val());
		 var conclusion = $.trim($("textarea#conclusion").val());
		 var remit = $.trim($("textarea#remit").val());
		 var dp_id =$("#dp_id").val();
		 var files = $('#fileToUpload')[0].files[0];
         
		 var formData = new FormData();
	    formData.append("emp_id",emp_id);
        formData.append("coun_id",coun_id);
		formData.append("witness_id",witness_id);
		formData.append("witness_id2",witness_id2);
		formData.append("witness_id3",witness_id3);
		formData.append("background",background);
		formData.append("investigation",investigation);
		formData.append("finding",finding);
		formData.append("conclusion",conclusion);
		formData.append("remit",remit);
		formData.append("ref_id",dp_id);
		formData.append("reported_by",reported_by);
		formData.append("fileInput",files);
		formData.append("recomend",recomend);
		 		
		 var personal = [];
		 if(emp_id==""){
			 personal.push("Employee’s Particular");
		 }
		 if(coun_id==""){
			 personal.push("Counsellor’s Particular");
		 }
		 
		 if(background==""){
			 personal.push("Background");
		 }
		 if(investigation==""){
			 personal.push("Investigation Process");
		 }
		 if(finding==""){
			 personal.push("Finding");
		 }
		 if(conclusion==""){
			 personal.push("Conclusion");
		 }
		 if(remit==""){
			 personal.push("Remit of Investigation");
		 }
		if(recomend==""){
			 personal.push("Recommended action");
		 }

        var error_personal="";
        for(var i=0; i< personal.length; i++){
            error_personal = error_personal + personal[i] + "; "
        }
      
        var pers="";
     
        if(personal.length > 0){
            pers = "Please Insert Personal Information: \n"+error_personal+"\n\n";
        }

		if(error_personal.length > 0){
				alert(pers);
		}else{
			$.ajax({
					type:"POST",
					url:"?widget=add_investigation",
					data: formData,
					processData: false,
					contentType: false,
					success:function(data){
						alert(data)
						exit();
						if(data == true){
							alert("Counselling Inserted");
							window.location = '?loc=counselling';
						}else{
							alert("Error While Processing");
						}
					}
				})
		}
	}
	
	 function save(){
		
		/*Personal Inforamtion*/
		 var emp_id = $("#e_num").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var coun_id=$("#coun_num").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var reported_by=$("#reported_by").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var witness_id=$("#witness_num").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var witness_id2=$("#witness_num2").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var witness_id3=$("#witness_num3").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var recomend=$.trim($("textarea#recomend").val());
		 var background = $.trim($("textarea#background").val());
		 var investigation = $.trim($("textarea#investigation").val());
		 var finding = $.trim($("textarea#finding").val());
		 var conclusion = $.trim($("textarea#conclusion").val());
		 var remit = $.trim($("textarea#remit").val());
		 var dp_id =$("#dp_id").val();
		 var files = $('#fileToUpload')[0].files[0];

		 var formData = new FormData();
	    formData.append("emp_id",emp_id);
        formData.append("coun_id",coun_id);
		formData.append("witness_id",witness_id);
		formData.append("witness_id2",witness_id2);
		formData.append("witness_id3",witness_id3);
		formData.append("background",background);
		formData.append("investigation",investigation);
		formData.append("finding",finding);
		formData.append("conclusion",conclusion);
		formData.append("remit",remit);
		formData.append("id",dp_id);
		formData.append("reported_by",reported_by);
		formData.append("fileInput",files);
		formData.append("recomend",recomend);

		 var personal = [];
		 if(emp_id==""){
			 personal.push("Employee’s Particular");
		 }
		 if(coun_id==""){
			 personal.push("Counsellor’s Particular");
		 }
		 
		 if(background==""){
			 personal.push("Background");
		 }
		 if(investigation==""){
			 personal.push("Investigation Process");
		 }
		 if(finding==""){
			 personal.push("Finding");
		 }
		 if(conclusion==""){
			 personal.push("Conclusion");
		 }
		 if(remit==""){
			 personal.push("Remit of Investigation");
		 }
		if(recomend==""){
			 personal.push("Recommended action");
		 }

        var error_personal="";
        for(var i=0; i< personal.length; i++){
            error_personal = error_personal + personal[i] + "; "
        }
      
        var pers="";
     
        if(personal.length > 0){
            pers = "Please Insert Personal Information: \n"+error_personal+"\n\n";
        }

		if(error_personal.length > 0){
				alert(pers);
		}else{
			$.ajax({
					type:"POST",
					url:"?widget=edit_investigation",
					data: formData,
					processData: false,
					contentType: false,
					success:function(data){
						alert(data)
						exit();
						if(data == true){
							alert("Counselling Inserted");
							window.location = '?loc=counselling';
						}else{
							alert("Error While Processing");
						}
					}
				})
		}
	}
 
	function add_emp_list(action){
	   underContract=0;
        $("#employee_name_view").empty();
        $("#employee_name_ids").html("");
        //var department = $("#department").val();
		department=$("#dep_id").val();
		
       var list = $("#employee_ids").html();
        var status = "Active";
        
        var branch = $("#branch_id").val();
        if(department != ""){
            if(department == "0"){
                department = "ALL";
            }
			department = "ALL";
			var url= "?widget=emp_list&d="+department+"&b="+branch+"&type="+underContract+"&list="+list+"&s="+status+"&inc="+action;
            window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
        }
    }
	function add_emp_list2(action){
	   underContract=0;
        $("#employee_name_view2").empty();
        $("#employee_name_ids2").html("");
        //var department = $("#department").val();
		department=$("#dep_id").val();
		
       var list = $("#employee_ids").html();
        var status = "Active";
        
        var branch = $("#branch_id").val();
        if(department != ""){
            if(department == "0"){
                department = "ALL";
            }
			department = "ALL";
			var url= "?widget=emp_list&d="+department+"&b="+branch+"&type="+underContract+"&list="+list+"&s="+status+"&inc="+action;
            window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
        }
    }
  function add_emp_list3(action){
	   underContract=0;
        $("#employee_name_view3").empty();
        $("#employee_name_ids3").html("");
        //var department = $("#department").val();
		department=$("#dep_id").val();
		
       var list = $("#employee_ids").html();
        var status = "Active";
        
        var branch = $("#branch_id").val();
        if(department != ""){
            if(department == "0"){
                department = "ALL";
            }
			department = "ALL";
			var url= "?widget=emp_list&d="+department+"&b="+branch+"&type="+underContract+"&list="+list+"&s="+status+"&inc="+action;
            window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
        }
    }
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

h4.panel-title input {
    float: right;
    position: relative;
    top: -6px;
}
.action {
    text-align: center;
}
div#invet-title {
    font-size: 16px;
    text-transform: uppercase;
    font-weight: bold;
    border-bottom: 1px solid #000;
	margin-bottom:5px;
} 
table.table-coun tr th {
    padding: 8px;
    border: 1px solid;
}
table.table-coun tr td {
    padding: 8px;
    border: 1px solid;
    background: #fff;
}
table.table-coun {
    border-collapse: collapse;
    border: 1px solid #000;
    width: 100%;
    margin-top: 16px;
    margin-bottom: 18px;
}
a#wl {
    background: #9c0909;
    padding-left: 3px;
    padding-right: 3px;
    border-radius: 3px;
    color: #fff !important;
    position: relative;
    /* left: 3px; */
    top: -10px;
    right: 7px;
    height: 7px;
	text-decoration: none;
}

table#allegation tr td {
    border: 1px solid #000;
	
}
table#allegation tr th {
    background: #333;
    padding: 3px;
    color: #fff;
    text-transform: uppercase;
    border: 1px solid #000;
}

table#allegation {
    border: 1px solid #000;
	width: 100% !important;
    margin: auto;
}

.modalWindow {
    width: 100%;
    background: rgba(0,0,0,.5);
    z-index: 9999;
    height: 1200px;
    position: absolute;
}
#alleg{
	 position: fixed;
    _position: absolute;
    min-height: 300px;
    width: 600px;
    background: #FFFFFF;
    left: 300px;
    top: 150px;
    z-index: 9999;
    margin-left: 15px;
    padding: 15px;
    font-size: 15px;
    -moz-box-shadow: 0 0 5px #EAEAEB;
    -webkit-box-shadow: 0 0 5px #EAEAEB;
    box-shadow: 0 0 5px #EAEAEB;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    -khtml-border-radius: 5px;
    border-radius: 5px;
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