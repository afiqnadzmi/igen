
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

$query_hr = mysql_query('SELECT u.a_hr FROM employee e, user_permission u WHERE e.level_id=u.id AND u.a_hr!="a_hr_hide" AND u.disc="disc_show" AND e.id ="'.$emp_id.'"');
$row_hr = mysql_fetch_array($query_hr);



 ?>
 
<input type="hidden" id="access_user" value="<?php echo $row_hr['a_hr'];?>">
<div class="main_div">
    <div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Disciplinary Action</a>
					</h4>
				</div>
		</div>
	</div>
	
	
	<div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
				
				<?php
				    $allegation="";
					if(isset($_GET['appedid']) && $_GET['appedid']!=""){
						$editid=base64_decode($_GET['appedid']);
						//Personal Information
						$sql=mysql_query("SELECT dp.*, e.full_name, e.id as eid ,p.position_name, d.dep_name from employee e INNER JOIN disciplinary_pinfo dp on e.id = dp.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id where dp.id=".$editid);
						$row_pi = mysql_fetch_array($sql);
						if($row_pi['alleged_by']!= $emp_id){
							$allegation="disabled";
						}
					 if($row_pi['offence_date']!="0000-00-00"){
						 $all_date=date('d-m-Y', strtotime($row_pi['offence_date']));
					 }else{
						 $all_date="00-00-0000";
					 }
					$sql_all=mysql_query("SELECT * from disciplinary_allegation where ref_id=".$editid);
					echo"<input type='hidden' id='emp_id' value='".$emp_id."'>";
				  if($row_pi['Inves_status']==1){
				?>
				<input type="button" value="Back" style="float:right; margin-top: -8px;" class="button" onclick="back()" style="width: 70px;">
				<input type="hidden" id="da_id" value="<?php echo $editid;?>">
			<div id="form-body">
					<div id="invet-title">
						 Employee’s Particular
					</div>
					<table class="table-coun"> 
					<tr>
					<th style="width:20%">  Full Name</th> <td style="width:30%"><input type="text" id="e_name" value="<?php echo $row_pi['full_name']; ?>" disabled></td><th style="width:20%"> Employee Number</th><td style="width:30%"><input type="text" id="e_num" value="EMP<?php echo str_pad($row_pi['eid'], 6, "0", STR_PAD_LEFT) ;?>" disabled></td>
					</tr>
					<tr>
					<th style="width:20%"> Current Position </th><td style="width:30%"><input type="text" id="e_cp" value="<?php echo $row_pi['position_name']; ?>" disabled></td><th style="width:20%"> Department </th><td style="width:30%"><input type="text" id="d_name" value="<?php echo $row_pi['dep_name']; ?>" disabled></td>
					</tr>
					<tr>
					<th style="width:20%"> Date of offence</th><td style="width:30%"><input type="text" id="all_date" value="<?php echo $all_date;  ?>" ></td><th style="width:20%"> Location of offence</th><td style="width:30%"><input type="text" id="location" value="<?php echo $row_pi['location']; ?>"></td>
					</tr>
					<tr>
					<th style="width:20%"> Type of Offence</th><td style="width:30%" colspan="3">
						<select id="offence_type">
							<option value="">--None--</option>
							<option value="Major" <?php if($row_pi['offence_type']=="Major"){echo"selected";}  ?>>Major</option>
							<option value="Minor" <?php if($row_pi['offence_type']=="Minor"){echo"selected";}  ?>>Minor</option>
						</select>
					</td>
					</tr>
					</table>
					<div id="invet-title">
							Allegation List
					   </div>
				   
						<div class="table">
								<div style="">
									<table id="tbl"  border="1px solid #000" >
											<tr class="tableth">
												<th width="5px">No.</th>
												<th style="text-align:left;">Allegation</th>
												<th width="100px"></th>
											</tr>
									<?php
									 $i=1;
									 $num_rows=mysql_num_rows($sql_all);
									 while($row_all = mysql_fetch_array($sql_all)){
									?>
											<tr class="tabletr" name='leave_row' style="">
											   <td class="nunmber" name="num"><?php echo $i; ?></td>
												<td>
												<textarea rows="30" cols="30" name="tid" id="kpi" style="height:150px !important; width:100% !important;" <?php echo $allegation; ?>><?php echo $row_all['allegation']; ?>
												</textarea> 
												 </td>
												 
														<td>
															<input type="hidden" id="tableid" name="tableid" value="<?php echo $row_all['id']; ?>">
															<input type="hidden" id="branches" value="">
															
												<?php		
								                   if($i == $num_rows){
													echo '<input type="button" value=" + " onclick="addquestion(this)" name="addr" '.$allegation.'/>';
												   }
												?>			
												</td>
											</tr>
										<?php
										$i++;
									 }
										?>
													
										</table>
										
								</div>
							</div>
						<?php
						 if($row_hr['a_hr']=="a_hr_edit"){
							 
						?>
						
						<br>
						<div id="invet-title">
							 Investigation Outcome
							 <?php 
							 $disable_otype="";
							 if($row_pi['offence_type']!=""){
								 $disable_otype="disabled";
							 }
							?>
					   </div>
						<div id="all_Outcome" style="width:100%;">
							<table style="width:100%; margin-top:2%;" class="outcome-table">
							<tr>
							 <td style="vertical-align:top; font-weight:bold; width: 10%;">Investigation Outcome :</td>
							 <td style="vertical-align:top;"><select id="hr_decis">
									<option value="">--None--</option>
									<option value="Genuine" <?php if($row_pi['inves_outcome']=="Genuine"){echo"selected";} ?>>Genuine</option>
									<option value="Not genuine" <?php if($row_pi['inves_outcome']=="Not genuine"){echo"selected";} ?>>Not genuine</option>
								 </select></td>
								  <td style="vertical-align:top; font-weight:bold; width: 11%; display:none" class="comment-recomm">Comments & Recomendation :</td>
							 <td class="comment-recomm" style="display:none; width: 16%;" class="comment-recomm"><textarea rows="30" cols="30" name="tid" id="comm" style="height:150px !important; width:300px !important;"><?php echo $row_pi['comments']; ?></textarea> </td>
							  <td style="vertical-align:top; font-weight:bold; width: 11%; display:none;" class="comment-recomm">Type of offence :</td>
							 <td style="vertical-align:top; display:none;" class="comment-recomm"><select id="type_offence" <?php echo $disable_otype; ?>>
									<option value="">--None--</option>
									<option value="Major" <?php if($row_pi['offence_type']=="Major"){echo"selected";} ?>>Major</option>
									<option value="Minor" <?php if($row_pi['offence_type']=="Minor"){echo"selected";} ?>>Minor</option>
								 </select></td>
								  <td style="vertical-align:top; font-weight:bold; width: 8%; display:none;" class="comment-recomm punishable">Punishable</td>
							 <td style="vertical-align:top; display:none;" class="comment-recomm punishable"><select id="termination">
									<option value="">--None--</option>
									<option value="Yes" <?php if($row_pi['termination']=="Yes"){echo"selected";} ?>>Yes</option>
									<option value="No" <?php if($row_pi['termination']=="No"){echo"selected";} ?>>No</option>
								 </select></td>
							</tr> 
							</table>
							<table>
							<tr style="display:none;" class="tag-md">
							<td style="vertical-align:top; font-weight:bold;">
							  Review By Managing Director :
							</td>
							<td>
								<select id="tag_md">
								<option value="">--None--</option>
							<?php
							//Managing Director
							$query_MD = mysql_query('SELECT e.full_name, e.level_id, e.id as eid FROM employee e, user_permission u WHERE e.level_id=u.id AND u.a_hr!="a_hr_hide" AND u.disc="disc_show" AND (e.id!="'.$row_pi['alleged_by'].'" AND e.id!="'.$row_pi['emp_id'].'" AND e.id!="'.$emp_id.'") ORDER BY full_name');
							while($row_MD = mysql_fetch_array($query_MD)){
								if($row_pi['md']==$row_MD['eid']){
									echo'<option value="'.$row_MD['eid'].'" selected>'.$row_MD['full_name'].'</option>';
								}else{
									echo'<option value="'.$row_MD['eid'].'">'.$row_MD['full_name'].'</option>';
								}
							}
							?>
							 </select>
							</td>
							</tr>
							</table>
						</div>
						<?php
						 }
						 ?>
			            <div class="action">
						<?php 
							if($row_pi['md']==$emp_id){
								echo'<input type="button" value="Approve" class="button" onclick="send()" style="width: 70px;">';
							}else{
								echo'<input type="button" value="Submit" class="button" onclick="send()" style="width: 70px;">';
							}
						  ?>
						</div>
					</div>
					<?php
				  }else{
					  echo"<h2>Please fill out the investigation form before you proceed the next step.</h2>";
				  }
					}else{
					?>
	
			<div class="main_content">
				  <a href="?loc=home" ><input style="padding-left:10px !important;padding-right:10px !important; float:right; margin-bottom: 5px;" type="button" value="Add" id="editBut"></a>
					<table id="tableplugin" class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
							<thead>
								<tr class="pluginth" id="alternatecolor">
									<th style="width:30px;">No.</th>
									<th style="width:180px">Employee Name</th>
									<th style="width:180px">Department Name</th>
									<th style="width:180px">Section/Unit</th>
									<th style="width:180px">Position</th>
									<th style="width:100px">Allegation Date</th>
									<th style="width:100px">Reported By</th>
									<th style="width:100px">Allegation</th>
									<th style="width:100px">Investigation Outcome</th>
									<?php
									if($row_hr['a_hr']=="a_hr_edit"){
										//echo'<th style="width:100px">Action</th>';
									}
									?>
									<th style="width:100px">Status</th>
									<th class="aligncentertable" style="width:9%;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if($row_hr['a_hr']=="a_hr_edit"){
									
									$query_emSup =mysql_query('SELECT dp.*, e.full_name, p.position_name, d.dep_name, d.id as depid, g.group_name from employee e INNER join disciplinary_pinfo dp on e.id = dp.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id  INNER JOIN emp_group g on e.group_id=g.id');
								}else{
									$query_emSup =mysql_query('SELECT dp.*, e.full_name, p.position_name, d.dep_name, d.id as depid, g.group_name from employee e INNER join disciplinary_pinfo dp on e.id = dp.emp_id INNER JOIN position p on e.position_id = p.id INNER JOIN department d on e.dep_id=d.id  INNER JOIN emp_group g on e.group_id=g.id where (dp.alleged_by="' .$emp_id.'" OR dp.md="' .$emp_id.'")');
								}

								$i=1;
								 
								 while($row_emSup = mysql_fetch_array($query_emSup)){
									 $id=base64_encode($row_emSup['id']);
									 if($row_emSup['alleged_date']=="0000-00-00" || $row_emSup['alleged_date']==null){
										 $created_date=$row_emSup['alleged_date'];
									 }else{
										  $created_date=date('d-m-Y', strtotime($row_emSup['alleged_date']));
									 }
									 $img="<img src='images/Files-Add-List-icon.png' width='19px'>";
									 $concelling='<input type="button" onclick=coun("'.$id.'") style="width:112px;float: none !important;margin-left:0px !important" value="Concelling['.$img.']" id="editBut">';
									 $concelling_view="<img src='images/view.png' width='17px'>";
									 if($row_emSup['action']=="Counselling" && ($row_hr['a_hr']=="a_hr_view" || $row_hr['a_hr']=="a_hr_edit")){
										// $row_emSup['coun_status']
										 if($row_emSup['coun_status']==3){
											//$action='<input type="button" onclick=coun_view("'.$id.'") style="width:112px;float: none !important;margin-left:0px !important" value="Concelling['.$concelling_view.']" id="editBut">';
											$action=$row_emSup['action']."<a title='View Counselling' class='add-action' onclick=coun_view('".$id."')>".$concelling_view."</a>";
											//$action="<a id='councell' title='View Counselling' onclick=coun_view('".$id."')>".$row_emSup['action']."[".$concelling_view."]"."</a>";
										 }else{
											//$action=$row_emSup['action']."[".$concelling."]";
											//$action=$row_emSup['action']."<a   title='Add Counselling' onclick=coun('".$id."')>[<span id='councell'>Issue</span>]</a>";
											$action=$row_emSup['action']."<a class='add-action' title='Add Counselling' onclick=coun('".$id."')>".$img."</a>";
											//$action="<a id='councell'  title='Add Counselling' onclick=coun('".$id."')>".$row_emSup['action']."[".$img."]"."</a>";
											
										 }
									}else{
										$action=$row_emSup['action'];
									}
									if($row_emSup['action']=="Punishable" && $row_hr['a_hr']=="a_hr_edit"){
										 if($row_emSup['di_status']==1){
											//$action='<input type="button" onclick=coun_view("'.$id.'") style="width:112px;float: none !important;margin-left:0px !important" value="Concelling['.$concelling_view.']" id="editBut">';
											//$action="<a id='councell' title='View Counselling' onclick=di_view('".$id."')>".$row_emSup['action']."[".$concelling_view."]"."</a>";
											$action=$row_emSup['action']."<a  class='add-action' title='View Domestic Inquiry' onclick=di_view('".$id."')>".$concelling_view."</a>";
										 }else{
											//$action=$row_emSup['action']."[".$concelling."]";
											$action=$row_emSup['action']."<a class='add-action' title='Add Domestic Inquiry' onclick=di_add('".$id."')>".$img."</a>";
											//$action=$row_emSup['action']."[<a title='Add Counselling' onclick=di_add('".$id."')><span>Issue DI</span></a>]";
										 }
									}
									$disable_inve="";
									$style="";
									if($row_emSup['Inves_status']!=1){
										$disable_inve="disabled";
										$style="background-color: #007dc55e !important;cursor: none !important;";
									}
					                //Get Made By
									$query_madeBy =mysql_query('SELECT e.full_name from employee e where e.id ='.$row_emSup['alleged_by']);
									$row_madeBy = mysql_fetch_array($query_madeBy);
									echo '<tr class="plugintr">
									<td>' . $i .'</td>
									<td >' .$row_emSup['full_name']. '</td>
									<td >' .$row_emSup['dep_name']. '</td>
									<td >' .$row_emSup['group_name']. '</td>
									<td >' .$row_emSup['position_name']. '</td>
									<td >' .$created_date. '</td>
									<td>' .$row_madeBy['full_name']. '</td>
									<td style="text-align:center;"><a title="View" onclick=alleg("'.$id.'") style="width:50px; text-align:center;"><i style="color:#000;" class="far fa-eye"></i></a></td>
									<td>' .$action.'</td>
									<td>' .$row_emSup['Status'].'</td>';
									if($row_hr['a_hr']=="a_hr_edit" && $row_emSup['Inves_status']!=1){
										echo'<td style="color:#000; text-align:center;" ><a title="Investigate" onclick=investigate("'.$id.'")><i class="fas fa-file-alt"></i></a>&nbsp;|&nbsp;<a title="Edit" '.$disable_inve.' onclick=edit("'.$id.'") style="'.$style.'"><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;|&nbsp; <a title="View" onclick=view("'.$id.'") ><i style="color:#000;" class="far fa-eye"></i></a></td>';
										//echo'<td ><input type="button" onclick=investigate("'.$id.'") style="width:83px;float: none !important;margin-left:0px !important" value="Investigate" id="editBut">&nbsp;&nbsp;|&nbsp;&nbsp;<input '.$disable_inve.' type="button" onclick=edit("'.$id.'") style="width:40px;padding-left: 5px !important;float: none !important;margin-left:0px !important; '.$style.'" value="Edit" id="editBut">&nbsp;&nbsp;|&nbsp;&nbsp;<input type="button" onclick=view("'.$id.'") style="width:50px; padding-left: 5px !important;float: none !important;margin-left:0px !important" value="View" id="editBut"></td>';
									}else{
										//echo'<td><input '.$disable_inve.'  type="button"  onclick=edit("'.$id.'")  style="width:40px;padding-left: 5px !important;float: none !important;margin-left:0px !important; '.$style.'" value="Edit" id="editBut">&nbsp;&nbsp;|&nbsp;&nbsp;<input type="button" onclick=view("'.$id.'") style="width:50px; padding-left: 5px !important;float: none !important;margin-left:0px !important" value="View" id="editBut"></td>';
										echo'<td style="color:#000; text-align:center;"><a title="Edit" '.$disable_inve.' onclick=edit("'.$id.'") style="'.$style.'"><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;|&nbsp <a title="View" onclick=view("'.$id.'")><i style="color:#000;" class="far fa-eye"></i></a></td>';
									}
									echo'</tr>';
									$i++;
									 
								 }
								?>

							</tbody>
					</table>
					
					
					

			</div>
					<?php } ?>
		</div>
	</div>
		<div class="alleg" style="display:none">
				<input id="popupBoxClose" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: dimgrey;margin-bottom: 3px; margin-top: -8px;" type="button" value="X">
				<table class="allegation" style="border-collapse: collapse;width: 100%; font-size: 13px;">
					<tr>
						<th style="width:5px">
							No.
						</th>
						<th>
							Allegations
						</th>
					</tr>
						<?php
							if(isset($_GET['alleg']) && $_GET['alleg']!=""){
								$id=base64_decode($_GET['alleg']);
								$i=1;
								$query_all=mysql_query('SELECT allegation from disciplinary_allegation  where ref_id ='.$id);
								while($row_all = mysql_fetch_array($query_all)){
									echo '<tr class="plugintr">
										<td>' . $i .'</td>
										<td >' .$row_all['allegation']. '</td>
									</tr>';
									$i++; 
								}
							}
						?>
				</table>			
		</div>
					
</div>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
		var display="<?php if(isset($_GET['alleg']) && $_GET['alleg']!=""){echo 1;}else{echo 2;}?>";
		if(display==1){
			$(".alleg").show();
			$("<div class='modalWindow'></div>").insertBefore("#MainContainer");
		}else{
			$(".alleg").hide();
		}
	
        oTable = $('#tableplugin').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		
		$("#popupBoxClose").click(function(){
			clear();
		});
		if($("#hr_decis").val()=="Genuine"){
			$(".comment-recomm").show();
		}else{
				$(".comment-recomm").hide();
				$("#termination").val("");
				$("textarea#comm").val("");
		}
		$("#hr_decis").change(function(){
			var val =$(this).val();
			if(val=="Genuine"){
				$(".comment-recomm").show();
			}else{
				$(".comment-recomm").hide();
				$("#termination").val("");
				$("textarea#comm").val("");
			}
		})
		
		if($("#type_offence").val()=="Major" && $("#hr_decis").val()=="Genuine"){
			$(".comment-recomm.punishable").show();
		}else{
			$(".comment-recomm.punishable").hide();
			$("#termination").val("");
		}
		$("#type_offence").change(function(){
			var val =$(this).val();
			if(val=="Major"){
				$(".comment-recomm.punishable").show();
			}else{
				$(".comment-recomm.punishable").hide();
				$("#termination").val("");
			}

		})
		if($("#termination").val()=="Yes"){
			$(".tag-md").show();
		}else{
			$(".tag-md").hide();
			$("#tag_md").val("");
		}
		$("#termination").change(function(){
			var val =$(this).val();
			if(val=="Yes"){
				$(".tag-md").show();
			}else{
				$(".tag-md").hide();
				$("#tag_md").val("");
			}

		})
		
		 $("#all_date").datepicker({
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
				changeYear: true
		  });
		 
    } );
	
	
	function clear(){
		window.location = "?loc=disciplinary";
	}
	function edit(id){
        window.location = "?loc=disciplinary&appedid=" + id;
    }
	function view(id){
        window.location = "?widget=view_allegations&appedid=" + id;
    }
	function coun(id){
		window.location = "?loc=counselling&coun=" + id;
	}
	function di_add(id){
		window.location = "?widget=view_di_letter&wletter=" + id;
	}
	
	function investigate(id){
		window.location = "?loc=investigation&inves=" + id;
	}
	
	function coun_view(id){
		window.location = "?loc=counselling&coun_view=" + id;
	}
	function di_view(id){
		window.location = "?loc=domestic_inquiry&di_view=" + id;
	}

	function alleg(id){
		 window.location = "?loc=disciplinary&alleg=" + id;
	}
	
	
	function addquestion(obj,id){
		    var num =1;
			$("#tbl").children().find("[name=leave_row]").each(function(i,dom){//Resposibilities
				num = num + 1;
			});
			
			$(obj).parent().parent().after("<tr class='tabletr' name='leave_row'><td class='nunmber' name='num'>"+ num +"</td><td><textarea rows='30' cols='30' name='tid' id='kpi' style='height:150px !important; width:100% !important;'></textarea></td><td><input type='hidden' id='resp_id' value='' name='respid'><input type='button' value=' + ' onclick='addquestion(this)' name='addr' /><input type='button' value=' x ' onclick='removerow(this)' /></td></tr>");
			$(obj).hide();
    } 

    function removerow(obj){
        $(obj).parent().parent().prev().find("[name=addr]").show();
        $(obj).parent().parent().remove();
    }
    
    function addnewbox(){
        $('#addnewbox').toggle('slow');
    }
    
    function send(){
		
		/*Personal Inforamtion*/
		
		 var full_name = $("#e_name").val();
		 var emp_num = $("#e_num").val();
		 var emp_position = $("#e_cp").val();
		 var dep_name = $("#d_name").val();
		 var emp_id=$("#emp_id").val();
		 var created_by = $("#sup_id").val();
		 var off_type=$("#offence_type").val();
		 var personal = [];
		 var hrAcess = [];
		 var allegation = "", str=""; //allegation
		 var alleg_id="";
		 var invest_outcome="", comment="", termination="", md="";
		 var access =$("#access_user").val();
		 var da_id =$("#da_id").val();
		 var all_date =$("#all_date").val();
		 var location =$("#location").val();
		 if(access=="a_hr_edit"){
			 invest_outcome = $("#hr_decis").val();
			 comment = $.trim($("textarea#comm").val());
			// alert(comment)
			 termination = $("#termination").val();
			 md=$("#tag_md").val();
			 if(invest_outcome==""){
				 hrAcess.push("Inverstigation Outcome");
			 }
			 if(invest_outcome=="Genuine" && comment==""){
				 hrAcess.push("Comments & Recomendation");
			 }
			 if($("#type_offence").val()=="Major" && termination==""){
				 hrAcess.push("Termination");
			 }

			 if(termination=="Yes" && md==""){
				 hrAcess.push("Review By Managing Director");
			 }
			 
		 }
		 
		  if(all_date==""){
				personal.push("Date of offence");
			}
			
			if(location==""){
				personal.push("Location of offence");
			}
			if(off_type==""){
				personal.push("Offence Type");
			}
			
			$("#tbl").children().find("[name=leave_row]").each(function(i,dom){//Resposibilities
				allegation=$.trim($(dom).find("[name=tid]").val()); 
				alleg_id =$(dom).find("[name=tableid]").val();
				if(allegation==""){
					if(personal.length < 1){
						personal.push("Allegation");
					}
				}
				str += allegation +','+ alleg_id +';';
			});
			 str=str.slice(0, -1);
        var error_personal="", error_hrAcess="";
        for(var i=0; i< personal.length; i++){
            error_personal = error_personal + personal[i] + "; "
        }
		for(var i=0; i< hrAcess.length; i++){
            error_hrAcess = error_hrAcess + hrAcess[i] + "; "
        }
        var pers="", hrac="";
    
        if(personal.length > 0){
            pers = "Please Insert: \n"+error_personal+"\n\n";
        }
		if(hrAcess.length > 0){
            hrac = "Please Insert: \n"+error_hrAcess+"\n\n";
        }
		

		if(error_personal.length > 0 || error_hrAcess.length ){
				alert(pers +"\n"+ hrac);
		}else{
				$.ajax({
					type:"POST",
					url:"?widget=edit_disciplinary",
					data:{
						//Personal information
						str:str,
						invest_outcome:invest_outcome,
						comment:comment,
						termination:termination,
						md:md,
						da_id:da_id,
						emp_id:emp_id,
						all_date:all_date,
						location:location,
						off_type:off_type,
						access:access
					},
					success:function(data){
	
						if(data == true){
							alert("Disciplinary Updated");
							window.location = '?loc=disciplinary';
						}else{
							alert("Error While Processing");
						}
					}
				})
			
		}
	}
    
</script>
<style>

.tableth th {
		background-color: #093750 !important;
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
.header_text {
    padding: 1px 1px 2px 7px !important;
}
#form-body .table {
    margin-top: 20px;
}

div#invet-title {
    font-size: 16px;
    text-transform: uppercase;
    font-weight: bold;
    border-bottom: 1px solid #000;
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
input[type=text] {
    width: 252px !important;
}
span#councell {
    width: 40px;
    padding-left: 5px !important;
    float: none !important;
    margin-left: 0px !important;
    background-color: #007DC5;
    cursor: pointer;
    text-align: center;
    border-radius: 5px;
    color: white !important;
    padding: 4px;
    color: #fff !important;
}
table.outcome-table tr td{
	padding: 6px;
}
/* Tooltip container */
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;
 
  /* Position the tooltip text - see examples below! */
  position: absolute;
  z-index: 1;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltip:hover .tooltiptext {
  visibility: visible;
}
a.add-action img {
    position: relative;
    top: -7px;
}
</style>
