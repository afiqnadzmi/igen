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
						Counselling<input type="button" value="Back" class="button" onclick="back()" style="width: 70px;">
					</h4>
					
				</div>
		</div>
	</div>
    <div id="collapseone" class="panel-collapse" >
			<div class="panel-body">
				<div id="form-body">
				
				<?php
					if(isset($_GET['coun']) && $_GET['coun']!=""){
						$dp_id=base64_decode($_GET['coun']);
						//Employee
						$query = mysql_query('SELECT dp.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid from employee e INNER JOIN disciplinary_pinfo dp on e.id = dp.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where dp.id='. $dp_id . ';');
						$row = mysql_fetch_array($query);
						
						//Counsellor
						$query_counsellor = mysql_query('SELECT e.full_name, e.id as eid ,p.position_name, d.dep_name from employee e  INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where e.id='. $emp_id . ';');
						$row_counsellor = mysql_fetch_array($query_counsellor);
						echo"<input type='hidden' id='dep_id' value='".$row['depid']."'>";
						echo"<input type='hidden' id='emp_id' value='".$emp_id."'>";
						echo"<input type='hidden' id='dp_id' value='".$dp_id."'>";
						echo"<input type='hidden' id='permission' value='a_hr_hide'>";
						echo"<input type='hidden' id='cstatus_id' value='".$row['coun_status']."'>";

					?>
					
					<div id="invet-title">
						 Employee’s Particular
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
						 Counsellor’s Particular
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
                      <input class="button incident" type="button" value="Search"  onclick="add_emp_list('couns')" style="width: 70px; position: absolute;"/></td><th style="width:20%"> Employee Number</th><td style="width:30%"><input type="text" id="witness_num" value="" disabled></td>
					</tr>
					<tr>
					<th style="width:20%"> Position </th><td style="width:30%"><input type="text" id="witness_cp" value="" disabled></td><th style="width:20%"> Deptartment </th><td style="width:30%"><input type="text" id="witness_d_name" value="" disabled></td>
					</tr>
					</table>
				
						<div id="invet-title">
							Content of discussion
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%"> Discussion</th> <td style="width:70%"><textarea style="width:100%;  height:200px" id="discussion"></textarea></td>
							</tr>
						</table>
						<div id="invet-title">
							Recomendation
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%"> Recomendation</th> <td style="width:70%"> 
										<select id="recom">
											<option value="none">- None -</option>
											<option value="No action taken – Verbal Warning Only">No action taken – Verbal Warning Only</option>
											<option value="Performance Improvement Plan">Performance Improvement Plan</option>
											<option value="Warning Letter">Warning Letter</option>
										</select>
									</td>
							</tr>
						</table>
						<table class="table-coun warning" style="display:none"> 
							<tr>
								<th style="width:18%"> NATURE OF MISCONDUCT</th> <td style="width:70%"> 
											<textarea style="width:100%;  height:200px" id="misconduct"></textarea>
									</td>
							</tr>
							<tr>
								<th style="width:18%"> ACTION AGREED FOR IMPROVEMENT BY THE EMPLOYEE COMMITTING THE OFFENCE</th> <td style="width:70%"> 
											<textarea style="width:100%;  height:200px" id="action_agreed"></textarea>
									</td>
							</tr>
						</table>
			            <div class="action"><input type="button" value="Submit" class="button" onclick="send()" style="width: 70px;"></div>
					
					<?php }else if(isset($_GET['appedid']) && $_GET['appedid']!=""){
						$dp_id=base64_decode($_GET['appedid']);
						//Employee
						$query = mysql_query('SELECT coun.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid from employee e INNER JOIN counselling coun on e.id = coun.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where coun.id='. $dp_id . ';');
						$row = mysql_fetch_array($query);
						
						//Counsellor
						$query_counsellor = mysql_query('SELECT coun.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid from employee e INNER JOIN counselling coun on e.id = coun.counsellor_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where coun.id='. $dp_id . ';');
						$row_counsellor = mysql_fetch_array($query_counsellor);
						//witness
						$query_witness = mysql_query('SELECT coun.*, e.full_name, e.id as eid ,p.position_name, d.dep_name, d.id as depid from employee e INNER JOIN counselling coun on e.id =coun.witness_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where coun.id='. $dp_id . ';');
						$row_witness = mysql_fetch_array($query_witness);
						echo"<input type='hidden' id='dep_id' value='".$row['depid']."'>";
						echo"<input type='hidden' id='emp_id' value='".$emp_id."'>";
						echo"<input type='hidden' id='dp_id' value='".$dp_id."'>";
						echo"<input type='hidden' id='permission' value='a_hr_hide'>";
					?>
					
					<div id="invet-title">
						 Employee’s Particular
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
						 Counsellor’s Particular
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
						<option value="<?php echo $row_witness['eid'] ;?>"><?php echo $row_witness['full_name'] ;?></option>
					   
					  </select>
                      <input class="button incident" type="button" value="Search"  onclick="add_emp_list('couns')" style="width: 70px; position: absolute;"/></td><th style="width:20%"> Employee Number</th><td style="width:30%"><input type="text" id="witness_num" value="EMP<?php echo str_pad($row_witness['eid'], 6, "0", STR_PAD_LEFT) ;?>" disabled></td>
					</tr>
					<tr>
					<th style="width:20%"> Position </th><td style="width:30%"><input type="text" id="witness_cp" value="<?php echo $row_witness['position_name'] ?>" disabled></td><th style="width:20%"> Deptartment </th><td style="width:30%"><input type="text" id="witness_d_name" value="<?php echo $row_witness['dep_name'] ?>" disabled></td>
					</tr>
					</table>
				
						<div id="invet-title">
							Content of discussion
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%"> Discussion</th> <td style="width:70%"><textarea style="width:100%;  height:200px" id="discussion"><?php echo $row['discussion'] ?></textarea></td>
							</tr>
						</table>
						<div id="invet-title">
							Recomendation
					   </div>
					   <table class="table-coun"> 
							<tr>
								<th style="width:18%"> Recomendation</th> <td style="width:70%"> 
										<select id="recom">
											<option value="none">- None -</option>
											<option value="No action taken – Verbal Warning Only" <?php if($row['recommendation']=="No action taken – Verbal Warning Only"){echo"selected";} ?>>No action taken – Verbal Warning Only</option>
											<option value="Performance Improvement Plan" <?php if($row['recommendation']=="Performance Improvement Plan"){echo"selected";} ?>>Performance Improvement Plan</option>
											<option value="Warning Letter" <?php if($row['recommendation']=="Warning Letter"){echo"selected";} ?>>Warning Letter</option>
										</select>
									</td>
							</tr>
						</table>
							<table class="table-coun warning" style="display:none"> 
							<tr>
								<th style="width:18%"> NATURE OF MISCONDUCT</th> <td style="width:70%"> 
											<textarea style="width:100%;  height:200px" id="misconduct"><?php echo $row['misconduct']; ?></textarea>
									</td> 
							</tr>
							<tr>
								<th style="width:18%"> ACTION AGREED FOR IMPROVEMENT BY THE EMPLOYEE COMMITTING THE OFFENCE</th> <td style="width:70%"> 
											<textarea style="width:100%;  height:200px" id="action_agreed"><?php echo $row['action_agreed']; ?></textarea>
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
									<th style="width:100px">Counsellor</th>
									<th style="width:100px">Recomendation</th>
									<th style="width:100px">Warning Letter</th>
									<th style="width:100px">Date</th>
									<th class="aligncentertable" style="width:9%">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if($row_hr['a_hr']=="a_hr_edit"){
									if(isset($_GET['coun_view']) && $_GET['coun_view']!=""){
										$id=base64_decode($_GET['coun_view']);
										$query_emSup =mysql_query('SELECT con.*, e.full_name from employee e INNER join counselling con on e.id = con.emp_id where con.ref_id="' .$id.'"');									
									}else{
										$query_emSup =mysql_query('SELECT con.*, e.full_name from employee e INNER join counselling con on e.id = con.emp_id');
									}
								}else{
									if(isset($_GET['coun_view']) && $_GET['coun_view']!=""){
										$id=base64_decode($_GET['coun_view']);
										$query_emSup =mysql_query('SELECT con.*, e.full_name from employee e INNER join counselling con on e.id = con.emp_id where con.counsellor_id="'.$emp_id.'" and con.ref_id="' .$id.'"');									
									}else{
										$query_emSup =mysql_query('SELECT con.*, e.full_name from employee e INNER join counselling con on e.id = con.emp_id where con.counsellor_id="'.$emp_id.'"');
									}
								}

								$i=1;
								 
								 while($row_emSup = mysql_fetch_array($query_emSup)){
									 $id=base64_encode($row_emSup['id']);
									 if($row_emSup['date']=="0000-00-00" || $row_emSup['date']==null){
										 $created_date=$row_emSup['date'];
									 }else{
										  $created_date=date('d-m-Y', strtotime($row_emSup['date']));
									 }
									 $concelling="<a id='councell' onclick=coun('".$id."')><img src='images/editing.png' width='16px'></a>";
									 $concelling_view="<img src='images/view.png' width='14px'></a>";
									  $query_wl =mysql_query('SELECT id from warning_letter where coun_id='.$row_emSup['id']);
									$num_wl=mysql_num_rows($query_wl);
									 if($row_emSup['action']=="Counselling" && $row_hr['a_hr']=="a_hr_edit"){
										
										 if($row_emSup['coun_status']==1){
											$action="<a id='councell' style='color:gray !important;'onclick=coun_view('".$id."')>".$row_emSup['action']."[".$concelling_view."]"."</a>";
										 }else{
											$action=$row_emSup['action']."[".$concelling."]"; 
										 }
									}else{
										$action=$row_emSup['action'];
									}
					                //Get Made By
									$query_madeBy =mysql_query('SELECT e.full_name from employee e where e.id ='.$row_emSup['counsellor_id']);
									$row_madeBy = mysql_fetch_array($query_madeBy);
									echo '<tr class="plugintr">
									<td>' . $i .'</td>
									<td >' .$row_emSup['full_name']. '</td>
									<td>' .$row_madeBy['full_name']. '</td>
									<td >' .$row_emSup['recommendation'].'</td>';
									if($row_emSup['recommendation']=="Warning Letter" && $row_hr['a_hr']=="a_hr_edit"){
										echo'<td><input type="button" onclick=wLetter("'.$id.'") style="width:65px;padding-left: 5px !important;float: none !important;margin-left:0px !important" value="Generate" id="editBut"> <a id="wl" onclick=wl("'.$id.'")>'.$num_wl.'</a></td>';
									}else{
										echo'<td> - </td>';
									}
									echo'<td>' .$created_date.'</td>';
									if($num_wl>0){
									echo'<td style="text-align:center;"><a title="Edit" onclick=edit("'.$id.'") ><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;|&nbsp;<a title="View" onclick=view("'.$id.'")><i style="color:#000;" class="far fa-eye"></i></a></td>';
									}else{
										echo'<td style="text-align:center;"><a title="Edit" onclick=edit("'.$id.'") ><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;|&nbsp;<a title="View" onclick=view("'.$id.'")><i style="color:#000;" class="far fa-eye"></i></a></td>';
									}
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
        window.location="?widget=view_counselling&viewid=" + id;
    }
	function edit(id){
        window.location = "?loc=counselling&appedid=" + id;
    }
	function wLetter(id){
        window.location = "?widget=view_worningLetter&viewid=" + id;
    }
	function wl(id){
		 window.location = "?loc=counselling&wletter=" + id;
	}
	function view_letter(id){
        window.location = "?widget=view_worningLetter&wletter=" + id;
    }
	
	function close(){
		alert(1)
       // window.location = "?loc=counselling";
    }

    function send(){
		
		/*Personal Inforamtion*/
		 var emp_id = $("#e_num").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var coun_id=$("#coun_num").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var witness_id=$("#witness_num").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var discussion = $.trim($("textarea#discussion").val());
		 var recomendation=$("#recom").val();
		 var misconduct="",action_agreed="";
		 var dp_id =$("#dp_id").val();
		 var coun_status=$("#cstatus_id").val();
		 var personal = [];
		 
		 if(recomendation=="Warning Letter"){
			  misconduct=$.trim($("textarea#misconduct").val());
			  action_agreed=$.trim($("textarea#action_agreed").val());
			  if(misconduct==""){
				   personal.push("Nature of misconduct");
			  }
			  if(action_agreed==""){
				   personal.push("Action agreed for improvement by the employee committinging the offence");
			  }
		}
		 if(emp_id==""){
			 personal.push("Employee’s Particular");
		 }
		 if(coun_id==""){
			 personal.push("Counsellor’s Particular");
		 }
		 if(witness_id==""){
			 personal.push("Witness’s Particular");
		 }
		 if(discussion==""){
			 personal.push("Content of Discussion");
		 }
		 if(recomendation==""){
			 personal.push("Recomendation");
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
					url:"?widget=add_counselling",
					data:{
						emp_id:emp_id,
						coun_id:coun_id,
						witness_id:witness_id,
						discussion:discussion,
						recomendation:recomendation,
						misconduct:misconduct,
						action_agreed:action_agreed,
						coun_status:coun_status,
						ref_id:dp_id
					},
					success:function(data){
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
		 var witness_id=$("#witness_num").val().replace( /[^\d.]/g, '').replace(/^0+/, '');
		 var discussion = $.trim($("textarea#discussion").val());
		 var recomendation=$("#recom").val();
		 var updated_by =$("#emp_id").val();
		 var id =$("#dp_id").val();
		 var misconduct="",action_agreed="";
		 var personal = [];
		 if(recomendation=="Warning Letter"){
			  misconduct=$.trim($("textarea#misconduct").val());
			  action_agreed=$.trim($("textarea#action_agreed").val());
			  if(misconduct==""){
				   personal.push("Nature of misconduct");
			  }
			  if(action_agreed==""){
				   personal.push("Action agreed for improvement by the employee committinging the offence");
			  }
		}
		 if(emp_id==""){
			 personal.push("Employee’s Particular");
		 }
		 if(coun_id==""){
			 personal.push("Counsellor’s Particular");
		 }
		 if(witness_id==""){
			 personal.push("Witness’s Particular");
		 }
		 if(discussion==""){
			 personal.push("Content of Discussion");
		 }
		 if(recomendation==""){
			 personal.push("Recomendation");
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
					url:"?widget=edit_counselling",
					data:{
						emp_id:emp_id,
						coun_id:coun_id,
						witness_id:witness_id,
						discussion:discussion,
						recomendation:recomendation,
						updated_by:updated_by,
						misconduct:misconduct,
						action_agreed:action_agreed,
						id:id
					},
					success:function(data){
						if(data == true){
							alert("Counselling Updated");
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