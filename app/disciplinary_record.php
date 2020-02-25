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

$query_hr = mysql_query('SELECT u.a_hr FROM employee e, user_permission u WHERE e.level_id=u.id AND u.a_hr!="a_hr_hide" AND u.disc="disc_show" AND e.id ="'.$emp_id.'"');
$row_hr = mysql_fetch_array($query_hr);
echo"<input type='hidden' id='sup_id' value='".$emp_id."'>";

?>
<input type="hidden" id="access_user" value="<?php echo $row_hr['a_hr'];?>">
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
						DISCIPLINARY ACTION <input type="button" value="Back" class="button" onclick="back()" style="width: 70px;">
					</h4>
					
				</div>
		</div>
	</div>
    <div id="collapseone" class="panel-collapse" >
			<div class="panel-body">
				<div id="form-body">
				
				<?php
					if(isset($_GET['recorddisc']) && $_GET['recorddisc']!=""){
						$userID=base64_decode($_GET['recorddisc']);
						$query = mysql_query('SELECT e.full_name, e.id as empid, p.position_name, d.dep_name from employee e INNER JOIN position p on p.id=e.position_id INNER JOIN department d on d.id= e.dep_id WHERE e.id='. $userID . ';');
						$row = mysql_fetch_array($query);
						echo"<input type='hidden' id='emp_id' value='".$userID."'>";
						echo"<input type='hidden' id='permission' value='a_hr_hide'>";
					?>
					<div id="invet-title">
						 Employee’s Particular
					</div>
					<table class="table-coun"> 
					<tr>
					<th style="width:20%">  Full Name</th> <td style="width:30%"><input type="text" id="e_name" value="<?php echo $row['full_name'] ?>" disabled></td><th style="width:20%"> Employee Number</th><td style="width:30%"><input type="text" id="e_num" value="EMP<?php echo str_pad($row['empid'], 6, "0", STR_PAD_LEFT) ;?>" disabled></td>
					</tr>
					<tr>
					<th style="width:20%"> Current Position </th><td style="width:30%"><input type="text" id="e_cp" value="<?php echo $row['position_name'] ?>" disabled></td><th style="width:20%"> Department</th><td style="width:30%"><input type="text" id="d_name" value="<?php echo $row['dep_name'] ?>" disabled></td>
					</tr>
					<tr>
					<th style="width:20%"> Date of offence</th><td style="width:30%"><input type="text" id="all_date" value="" ></td><th style="width:20%"> Location of offence</th><td style="width:30%"><input type="text" id="location" value=""></td>
					</tr>
					<tr>
					<th style="width:20%"> Type of Offence</th><td style="width:30%" colspan="3">
						<select id="offence_type">
							<option value="">--None--</option>
							<option value="Major">Major</option>
							<option value="Minor">Minor</option>
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
											<tr class="tabletr" name='leave_row' style="">
											   <td class="nunmber" name="num">1</td>
												<td>
												<textarea rows="30" cols="30" name="tid" id="kpi" style="height:150px !important; width:100% !important;" <?php echo $emp_rate; ?>>
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
							<?php
						 if($row_hr['a_hr']=="a_hr_edit"){
							 
						?>
						
						<br>
						<div id="invet-title">
							 Investigation Outcome
					   </div>
						<div id="all_Outcome" style="width:100%;">
							<table style="width:100%; margin-top:2%;">
							<tr>
							 <td style="vertical-align:top; font-weight:bold; width: 14%;">Inverstigation Outcome :</td>
							 <td style="vertical-align:top;"><select id="hr_decis">
									<option value="">--None--</option>
									<option value="Genuine">Genuine</option>
									<option value="Not genuine" >Not genuine</option>
								 </select></td>
								  <td style="vertical-align:top; font-weight:bold; width: 17%; display:none" class="comment-recomm">Comments & Recomendation :</td>
							 <td class="comment-recomm" style="display:none; width: 33%;" class="comment-recomm"><textarea rows="30" cols="30" name="tid" id="comm" style="height:150px !important; width:300px !important;"></textarea> </td>
							  <td style="vertical-align:top; font-weight:bold; width: 8%; display:none;" class="comment-recomm">Termination :</td>
							 <td style="vertical-align:top; display:none;" class="comment-recomm"><select id="termination">
									<option value="">--None--</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								 </select></td>
							</tr> 
							<tr>
							 <td>&nbsp;</td>
							</tr>
							
							<tr style="display:none;" class="tag-md">
							<td style="vertical-align:top; font-weight:bold; width: 18%;">
							  Review By Managing Director :
							</td>
							<td>
								<select id="tag_md">
								<option value="">--None--</option>
							<?php
							//Managing Director
							$query_MD = mysql_query('SELECT e.full_name, e.level_id, e.id as eid FROM employee e, user_permission u WHERE e.level_id=u.id AND u.a_hr!="a_hr_hide" AND u.disc="disc_show"  AND e.id!="'.$emp_id.'" ORDER BY full_name');
							while($row_MD = mysql_fetch_array($query_MD)){
									echo'<option value="'.$row_MD['eid'].'">'.$row_MD['full_name'].'</option>';
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
			            <div class="action"><input type="button" value="Submit" class="button" onclick="send()" style="width: 70px;"></div>
					
					<?php } ?>
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
    function clearNew(){
        window.location='?loc=allowance_processing';
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
		 var all_date =$("#all_date").val();
		 var location =$("#location").val();
		 var off_type=$("#offence_type").val();
		 var personal = [];
		 var hrAcess = [];
		 var allegation = "", str=""; //allegation
		  var invest_outcome="", comment="", termination="", md="";
		 var access =$("#access_user").val();
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
			 if(invest_outcome=="Genuine" && termination==""){
				 hrAcess.push("Termination");
			 }
			 if(termination=="Yes" && md==""){
				 hrAcess.push("Review By Managing Director");
			 }
			 
		 }
	
		$("#tbl").children().find("[name=leave_row]").each(function(i,dom){//Resposibilities
				allegation=$.trim($(dom).find("[name=tid]").val()); 
				if(allegation==""){
					if(personal.length < 1){
						personal.push("Allegation");
					}
				}
				str += allegation +','+';';
			});
			 str=str.slice(0, -1);

		if(all_date==""){
			personal.push("Date of offence");
		}
		
		if(location==""){
			personal.push("Location of offence");
		}
		if(off_type==""){
			personal.push("Offence Type");
		}

        var error_personal="", error_hrAcess="";
        for(var i=0; i< personal.length; i++){
            error_personal = error_personal + personal[i] + "; "
        }
       for(var i=0; i< hrAcess.length; i++){
            error_hrAcess = error_hrAcess + hrAcess[i] + "; "
        }
        var pers="", hrac="";
     
        if(personal.length > 0){
            pers = "Please Insert Personal Information: \n"+error_personal+"\n\n";
        }
		
		if(hrAcess.length > 0){
            hrac = "Please Insert: \n"+error_hrAcess+"\n\n";
        }
		
		if(error_personal.length > 0 || error_hrAcess.length ){
				alert(pers +"\n"+ hrac);
		}else{
				$.ajax({
					type:"POST",
					url:"?widget=add_disciplinary",
					data:{
						//Personal information
						full_name:full_name,
						emp_num:emp_id,
						emp_position:emp_position,
						dep_name:dep_name,
						created_by:created_by,
						invest_outcome:invest_outcome,
						comment:comment,
						termination:termination,
						md:md,
						access:access,
						all_date:all_date,
						location:location,
						off_type:off_type,
						str:str
					},
					success:function(data){
						if(data == true){
							alert("Diiciplinary Inserted");
							window.location = '?loc=disciplinary';
						}else{
							alert("Error While Processing");
						}
					}
				})
		}
	}
    $(document).ready(function() {
		  $("#all_date").datepicker({
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
				changeYear: true
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
input[type=text] {
    width: 252px !important;
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