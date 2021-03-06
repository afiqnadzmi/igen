<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
   if (isset($_COOKIE["igen_user_id"]) || isset($_COOKIE["igen_id"] )) {
		if($_COOKIE["igen_id"]==""){
			$user_id = $_COOKIE["igen_user_id"];
		}else{
			$user_id = $_COOKIE["igen_id"];
		}
   }
  
  $sql = 'SELECT * from increment_approval WHERE employer_id='.$user_id;
  $query= mysql_query($sql);
  $row_10 = mysql_fetch_array($query);
							 
?>

<div class="main_div">
<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Bonus & Increment</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 

   
	<?php 
		if($igen_a_hr == "a_hr_edit"){
	?>
	 <div id="con">
        <br/>
        <div class="header_text">
            <span>Bonus & Increment</span>
        </div>
		 <div class="main_content">
            <div class="tablediv">
                <table id="tbl"> 
                    <tr>
                        <td colspan="3">
                            <input class="button" type="button" value="Add" onclick="cal()" style="width: 70px;"/>
                            <input class="button" type="button" value="Clear" onclick="clearfield()" style="width: 70px;"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Company <span class="red"> *</span></td>
                        <td>
                            <select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)">
                                <option value="">--Please Select--</option>
                                <?php
                                if ($igen_companylist != "") {
                                    $queryCompany = mysql_query('SELECT * FROM company WHERE id IN (' . $igen_companylist . ') ORDER BY code');
                                } else {
                                    $queryCompany = mysql_query('SELECT * FROM company ORDER BY code');
                                }
                                while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                    if ($igen_companylist != "") {
                                        echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                    } else {
                                        if ($rowCompany["is_default"] == "1") {
                                            echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                        } else {
                                            echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Branch <span class="red"> *</span></td>
                        <td>
                            <select id="dropBranch" style="width: 250px;" onchange="showDep(this.value)">
                                <option value="">--Please Select--</option>
                                <?php
                                if ($igen_branchlist == "") {
                                    $queryCompany = mysql_query('SELECT * FROM company WHERE is_default=1 LIMIT 1');
                                    $rowCompany = mysql_fetch_array($queryCompany);
                                    $queryBranch = mysql_query('SELECT * FROM branch WHERE company_id="' . $rowCompany["id"] . '" ORDER BY branch_code');
                                }
                                while ($rowBranch = mysql_fetch_array($queryBranch)) {
                                    echo '<option value="' . $rowBranch["id"] . '">' . $rowBranch["branch_code"] . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px;">Departments <span class="red"> *</span></td>
                        <td><select class="input_text" name="selectdep" id="selectdep" style="width: 250px;" onchange="selectdep()">
                                <option value="">--Please Select--</option>
                            </select> 
							<input type="hidden" id="b_id" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>Simulation Type <span class="red"> *</span></td>
                        <td>
                            <select id="selecttype" style="width: 250px;" onchange="selecttype(this.value)">
                                <option value="">--Please Select--</option>    
                                <option value="m">Bonus</option>
                                <option value="p">Increment</option>
								<!--<option value="s">Salary</option>-->
                            </select>
                        </td>
                    </tr>
                    <tr style="display: none;" id="selectintypetr">
                        <td>Increment By <span class="red"> *</span></td>
                        <td>
                            <select id="selectintype" style="width: 250px;" onchange="selectintype(this.value)">
                                <option value="">--Please Select--</option>   
                                <option value="ia">Amount (RM)</option> 
                                <option value="ip">Percentage (%)</option>
                            </select>
                        </td>
                    </tr>
                    <tr style="display: none;" id="selecttypetr">
                        <td id="selecttypetd"></td>
                        <td><input type="text" id="in_by" style="width: 243px;" /></td>
                    </tr>
                    <tr>
                        <td style="vertical-align:top">Employee <span class="red"> *</span></td>
                        <td>
                            <select multiple size="10" class="input_text" name="employee_list_view" id="employee_list_view" style="width: 250px;" onclick="add_emp_list()"></select>
                        </td>
                    </tr> 
                    <tr style="display: none;"><td><span id="employee_ids"></span><span id="confirmedemp"></span></td></tr>
                </table>
            </div>
        </div>
		</div>
	<?php
		}
	?>
       
			
		<br>
			<div class="header_text">
				
						<h4 class="panel-title">
							Bonus & Increment History
						</h4>
			</div>

		<div id="simul_his">
		 <div class="tabs" style="margin-top:-3px; padding:0px 0px 50px 0px">
			
			   <div class="tab tab1">
				   <input type="radio" id="tab-1" name="tab-group-1" checked>
				
				   <label for="tab-1" onclick="change(0)">Increment</label>
				   
				   </div>
				<div class="tab tab2" >
				   <input type="radio" id="tab-2" name="tab-group-1">
				   <label for="tab-2" id="tab2" onclick="change(1)">Bonus</label>
				   
				  
				 </div> 
				 <!--<div class="tab tab3" >
				   <input type="radio" id="tab-3" name="tab-group-1">
				   <label for="tab-3" id="tab3" onclick="change(2)">Claims</label>
				   
				  
				   </div> 
				   <div class="tab tab4" >
				   <input type="radio" id="tab-4" name="tab-group-1">
				   <label for="tab-4" id="tab4" onclick="change(3)">Deduction</label>
				   
				  
				   </div> -->
				  
			   </div>
			    <hr>
      
            <div class="tablediv" style="width: 100%;">
			<!--<table id="tbl" class="bordercollapse" style="width: 100%;">
				  <tr>
                        <td> View Simulation By Type :
                        
                            <select id="selecttype" style="width: 250px;" onchange="select(this.value)">
                                <option value="p">Increment</option>   
                                <option value="m">Bonus</option>
                               
                            </select>
                        </td>
                    </tr>
					</table>-->
                <div style="float: right; margin-bottom: 4px;">
				<?php 
				 if(!isset($_GET['bonus'])){
					if($igen_a_hr == "a_hr_edit"){
				?>
				<input type="button" id="button1" value="Delete" class="button" onclick="cleartext1('del')" style="width: 70px;" />				
				
				<?php 
					}
					}else if(isset($_GET['bonus'])){
					if($igen_a_hr == "a_hr_edit"){
				?>
						<input type="button" id="button1" value="Delete" class="button" onclick="cleartext2('del')" style="width: 70px;" />				
				
				<?php 
					}
					}
				if($row_10['employer_id']==$user_id && !isset($_GET['bonus'])){
				
				?>
				<input type="button" id="button2" value="Approve" class="button" onclick="cleartext1('appro')" style="width: 70px;" />
				
				<?php 
				
				}else if($row_10['employer_id']==$user_id && isset($_GET['bonus'])){
				
				?>
				<input type="button" id="button2" value="Approve" class="button" onclick="cleartext2('appro')" style="width: 70px;" />
				
				<?php 
				
				}
				?>
				</div>
                <div>
				<?php 
				 if(!isset($_GET['bonus'])){
				?>
				 <table  id="incrementTable" class="TFtable dataTable bordercollapse" style="width: 100%;">
                       <thead>
						   <tr>
							  <th style="width: 10px;">ID</th>
								<th style="width: 300px;">Employee</th>
								<th style="width: 180px;">Department</th>
								<th style="width: 100px;">Increment Amount</th>
								<th style="width: 100px;">Before(RM)</th>
								<th style="width: 100px;">After (RM)</th>
								<th style="width: 100px;">Difference (RM)</th>
								 <th style="width: 100px;">Increment Date</th>
								  <th style="width: 150px;">Status</th>
								<th style="width: 50px;">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$count=1;
						$sym="Month";
							$sql3 = 'SELECT * from simulation_inrement WHERE status IN("Pending", "Approved", "active")';
                           $query2 = mysql_query($sql3);
                              while ($row = mysql_fetch_array($query2)) {
							  $dep_name=$row['dep_name'];
							  $emp_name=$row['emp_name'];
							  $increment_by_amount=$row['increment_by_amount']; 
							  $increment_by_prece=$row['increment_by_precentage'];
							  if($increment_by_amount!="0"){
							  $increment_by=$increment_by_amount;
							  }else if($increment_by_prece!="0"){
							  $increment_by=$increment_by_prece."%";
							  }
							  $Before_Increment=$row['Before_Increment'];
							  $after_increment=$row['after_increment'];
							   $difference=$row['difference'];
							  $empid=$row['emp_id'];
							  $id=$row['id'];
							  
						   echo '<tr >
								<td style="width: 10px;">' . $count . '</td>
								<td style="width: 300px;"><input type="hidden" id="empid" value=' . $empid . ' />' . $emp_name . '</td>
								<td style="width: 180px;">' . $dep_name . '</td>
								<td style="width: 100px;"><span name="stotal">' . $increment_by. '</span></td>  			
								<td style="width: 100px;"><span name="atotal">' . number_format($Before_Increment, 2) . '</span></td>
								<td style="width: 100px;">' . number_format($after_increment, 2) . '</td>
								<td style="width: 100px;">' . number_format($difference, 2) . '</td>
								<td style="width: 100px;">' .$row['incre_date'] . '</td>
								<td style="width: 100px;">' . $row['status'] . '</td>';
								
								if($row['status']=="Pending"){
									echo'
									<td ><input type="checkbox" value="'.$id.'"  style="width: 70px;" /></td>';
								}else{
									echo'<td > - </td>';
								}
									
								echo'</tr>';
			$count++;
				}		  
							 ?>
					</tbody>
					</table>
			  <?php 
				 }else{
				?>
                  	
				   <table  id="incrementTable"  class=" TFtable dataTablebordercollapse" style="width: 100%;">
                     
						
						<thead>
							<tr>
								<th style="width:10px;">ID</th>
								<th style="width: 300px;">Employee</th>
								<th style="width: 180px;">Department</th>
								<th style="width: 100px;">Basic Salry (RM)</th>
								<th style="width: 50px;">Bonus Rate</th>
								<th style="width: 100px;">Bonus Amount (RM)</th>
								<th style="width: 100px;">Status</th>
								<th style="width: 100px;">Action</th>
							   
							</tr> 
						</thead>
						<tbody>
						<?php
						$count=1;
						$sym="Month";
							$sql3 = 'SELECT * from simulation ';
                           $query2 = mysql_query($sql3);
                              while ($row = mysql_fetch_array($query2)) {
							  $dep_name=$row['dep_name'];
							  $emp_name=$row['emp_name'];
							  $get_basic=$row['salary'];
							  $in_by=$row['bonus'];
							  $total=$row['total_bonus'];
							   $increment=$row['increment'];
							  $empid=$row['emp_id'];
							  $id=$row['id'];
							  $sym="RM";
							   echo '<tr>
								<td style="width: 10px;">' . $count . '</td>
								<td style="width: 300px;"><input type="hidden" id="empid" value=' . $empid . ' />' . $emp_name . '</td>
								<td style="width: 180px;">' . $dep_name . '</td>
								<td style="width: 100px;">' . number_format($get_basic, 2) . '</td>
								<td style="width: 50px;"><span name="stotal">' . $in_by . '</span></td>  
								<td style="width: 100px;"><span name="atotal">' . number_format($total, 2) . '</span></td>
								<td style="width: 100px;"><span name="atotal">' .$row['bonus_status']. '</span></td>';
								if($row['bonus_status']=="Pending"){
									echo'<td class="alignrighttable"><input type="checkbox" value="'.$id.'"  style="width: 70px;" /></td>';
								}else{
									echo'<td class="alignrighttable">-</td>';
								}	
								echo'</tr>';
							$count++;
				}	
         		
							 ?>
					</tbody>
                   </table>
			  <?php
				 }
			  ?>
                    <table id="tb2" class="bordercollapse" style="width: 100%;">
					
					</table>
              
                    <table class="bordercollapse" style="width: 100%; font-weight: bold;">
                        <tr class="tabletr2" id="totalintr" style="display: none;">
                            <td style="width: 180px;">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="width: 130px;">&nbsp;</td>
                            <td style="width: 220px;"><span id="stotal">0</span></td>
                            <td style="width: 220px;"><span id="atotal">0</span></td>
                            <td style="width: 150px;"><span id="dtotal">0</span></td>
                        </tr>
                        <tr class="tabletr" id="totalbonustr" style="display: none;">
                            <td style="width: 180px;">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="width: 180px;">&nbsp;</td>
                            <td style="width: 220px;"><span id="stotal1">&nbsp;</span></td>
                            <td style="width: 220px;"><span id="atotal1">&nbsp;</span></td>
                            <td style="width: 150px; display: none;"><span id="dtotal1">&nbsp;</span></td>
                        </tr>
                    </table>
               	
                </div>
            </div>
	 </div>
    <div id="popup" ></div>
</div>
</div>
</div>

<span style="display: none;" id="selecttypespan"></span>
<span style="display: none;" id="selectintypespan"></span>
<span id="branchSpan" style="display: none;"><?php echo $igen_branchlist; ?></span>

<script type="text/javascript">
$(document).ready(function() {
   oTable = $('#incrementTable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    });

    
    function showBranch(company_id){
        var branch = $("#branchSpan").html();
        $.ajax({
            type:"POST",
            url:"?widget=showbranch_form",
            data:{
                company_id:company_id,
                branch:branch
            },
            success:function(data){
                $("#dropBranch").empty().append(data);
                $("#selectdep").empty().append("<option value=''>--Please Select--</option>");
                $("#employee_list_view").val("");
                $("#employee_ids").html("");
            }
        });
    } 
    
    function showDep(branch_id){
        $.ajax({
            type:"POST",
            url:"?widget=showdept_sim",
            data:{
                branch_id:branch_id
            },
            success:function(data){
                $("#selectdep").empty().append(data);
                $("#employee_list_view").val("");
                $("#employee_ids").html("");
				$("#b_id").val(branch_id);
			$("select#selectdep").after('<input type="button" value=" + " onclick="addrow(this)" name="addr" />');
            }
        });
    }
	function addrow(obj){ 
	var b_id=$("#b_id").val();
	 $.ajax({
                type:'POST',
                url:"?widget=showdept_sim",
                data:{
				branch_id:b_id
                    
                },
                success:function(data){
				
			 $(obj).parent().parent().after("<tr  name='leave_row'><td></td><td><select class='input_text' name='selectdep' id='nm' class='selectdep' style='width: 250px;'>"+data+"</select><input type='button'  id='add' value=' + ' onclick='addrow(this)' name='addr' />&nbsp;<input type='button'  id='rem' value=' x ' onclick='removerow(this)' /></td></tr>");
        $(obj).hide();
                    
                } 

            });
       
    } 
	function removerow(obj){
        $(obj).parent().parent().prev().find("[name=addr]").show(); 
        $(obj).parent().parent().remove();
    }

    
    function selectdep(){ 
        $("#employee_list_view").empty(); 
    }
     function select(intype){
	 var status = intype;
	 if(status=="m"){ 
	 $(".tableth").show();
	 $(".tabletr").show();
	  $("#calintr1").hide();
	  $(".tabletr1").hide();
	  $("#button1").hide();
	  $("#button2").hide();
	 }else{
	  $(".tableth").hide();
	 $(".tabletr").hide();
	  $("#calintr1").show();
	  $(".tabletr1").show();
	 }
	
	}
    function add_emp_list(){
        $("#employee_list_view").val(""); 
        $("#employee_ids").html("");
        var confirmedemp = $("#confirmedemp").html();
        var department = $("#selectdep").val();
		$("#tbl").children().find("[name=leave_row]").each(function(i,dom){
             
            y1=$(dom).find("[name=selectdep]").val();
            department+="," + y1
        });
        var branch = $("#dropBranch").val();
        if(department != ""){
            if(department == "0"){
                department = "ALL";
            }
            var url= "?widget=simulation_popup&d="+department+"&b="+branch+"&c="+confirmedemp;
            window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
        }
    }
    
    function selecttype(type){
        if(type == ""){
            $("#selecttypetr").hide();
            $("#in_by").val("");
            $("#selecttypespan").html("");
        }else if(type == "m"){
            $("#selecttypetr").show();
            $("#selecttypetd").html("Bonus Rate");
            $("#selecttypespan").html("m");
            $("#in_by").val("");
            $("#selectintype").val("");
            $("#selectintypetr").hide();
            $("#selectintypespan").html("");
        }else if(type == "p"){
            $("#selectintypetr").show();
            $("#selecttypetr").hide();
            $("#selecttypetd").html("Increment (%)");
            $("#selecttypespan").html("p");
            $("#in_by").val("");
        }else if(type == "s"){
            $("#selecttypetr").show();
            $("#selecttypetd").html("Amount");
            $("#in_by").val("");
        }
    }
    
    function selectintype(intype){
        if(intype == ""){
            $("#selecttypetr").hide();
            $("#in_by").val("");
            $("#selectintypespan").html("");
        }else if(intype == "ia"){
            $("#selecttypetr").show();
            $("#selecttypetd").html("Increment Amount (RM)");
            $("#selectintypespan").html("ia");
        }else if(intype == "ip"){
            $("#selecttypetr").show();
            $("#selecttypetd").html("Increment Amount (%)ssss");
			$("#in_by").attr("placeholder", "E.g. 5,10,20...");
            $("#selectintypespan").html("ip");
        }
    }
    
    function clearfield(){
        window.location='?loc=simulation';
    }
    
    function search(){
        var confirmedemp = $("#confirmedemp").html();        
        var dep_id = $("#selectdep").val();
        if(dep_id == ""){
            alert("Please Select Department");
            $("#selectdep").focus();
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=simulation_popup",
                data:{
                    dep_id:dep_id,
                    confirmedemp:confirmedemp
                },
                success:function(data){
                    //alert(data)
                    if(data != false){
                        $('#popup').append(data);
                    }
                    else{
                        alert('Error While Proccessing');
                    }
                }
            });
        }
    }
    
    /*Unused function to append other employee to calculation*/
    function cal_total(){ 
        var dep_id = $("#selectdep").val();
        var exp_emp_id = "";
        $("[id=empid]").each(function()
        {
            exp_emp_id += jQuery(this).val()+",";
        });
        var new_all_id = exp_emp_id.substring(0, exp_emp_id.length-1);
        
        $.ajax({
            type:'POST',
            url:"?widget=append_others_emp",
            data:{
                new_all_id:new_all_id,
                dep_id:dep_id
            },
            success:function(data){
                if(data != false){
                    $('#tb2').append(data);
                    $('#divappend').fadeIn();
                    $('#cal_total').hide();
                    total();
                }else{
                    alert('Error While Proccessing');
                }
            }
        });
    }
    
    function cal(){ 
        var all_id = "";
        var dep_id =$("#selectdep").val();
        var confirmedemp = "";
        var selecttype = $("#selecttypespan").html();
        var selectintype = $("#selectintypespan").html();
        
        $("#employee_list_view option").each(function()
        {
            all_id += jQuery(this).val()+",";
        });
		
		$("#tbl").children().find("[name=leave_row]").each(function(i,dom){
             
            y1=$(dom).find("[name=selectdep]").val();
            dep_id+="," + y1
        });
		
		
        var in_type = $("#selecttype").val();
        var in_by = $("#in_by").val();
        var new_all_id = all_id.substring(0, all_id.length-1);
        
        confirmedemp = $("#confirmedemp").html() + $("#employee_ids").html() + ",";
                                
        var error2 = [];
        var error3 = [];
        
        if(dep_id == ''){
            error3.push("Department");
        }
        if(new_all_id == ''){
            error3.push("Employee");
        }
        if(in_type == ''){
            error3.push("Increment Type");
        }
        if(in_by == ''){
            error3.push("Increment Amount");
        }else{
            if(in_by.match(/^\d+$/) || in_by.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Increment Amount");
            }
        }
        
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data2 = "";
        var data3 = "";

        if(error2.length > 0){
            data2 = "Please Check :\n"+error_data2+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
                
        if(error2.length > 0 || error3.length > 0){
            alert(data2 + data3);
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=dep_sim",
                data:{
                    dep_id:dep_id,
                    new_all_id:new_all_id,
                    in_type:in_type,
                    in_by:in_by,
                    selectintype:selectintype
                },
                success:function(data){

                    if(data != false){
					
                        $('#dropCompany').attr("disabled",true);
                        $('#dropBranch').attr("disabled",true);
                        $('#selectdep').attr("disabled",true);
						$(".input_text").attr("disabled",true); 
						$("#add").attr("disabled",true);
						$("#rem").attr("disabled",true);
                        $('#employee_list_view').html("");
                        $('#in_by').val("");
                       
                        $('#confirmedemp').html(confirmedemp);
                        $("#selecttype").attr("disabled", true);
                        if(selecttype == "p" || selecttype == "a"){
                            $("#calintr").show();
                            $("#totalintr").show();
                        }else if(selecttype == "m"){
                            
                            $("#cal_total").hide();
                        }
                        total();
						   window.location='?loc=simulation';
                    }else{
                        alert('Error While Proccessing'); 
                    }
                }
            });
        }
    }
	function cleartext1(id){
	
	var sList = "";
	var x = confirm("Are you sure you want perform this action ?");
	$('input[type=checkbox]:checked').each(function () {

		sList += $(this).val() + "," ;
		
		
	});

	if(sList==""){
		alert("tick the check box");
	}else{

	  if (x){
			$.ajax({
					type:'POST',
					url:"?widget=delete_simulation",
					data:{
					   sList:sList,
					   id:id
					},
					success:function(data){
						 alert(data);
						  window.location='?loc=simulation'; 
					}
				});
			}
		}
    }
	function cleartext2(status){
		var sList="";
		$('input[type=checkbox]:checked').each(function () {
				sList += $(this).val() + "," ;
			});

			if(sList==""){
				alert("Please tick the check box");
			}else{
			var x = confirm("Are you sure you want perform this action?");
			  if (x){
					$.ajax({
						type:'POST',
						url:"?widget=delete_simulation1",
						data:{
						   
						   status:status,
						   id:sList,
						   action:"bonus"
						},
						success:function(data){
							  window.location='?loc=simulation';
						}
					});
				}
					
			}
    }
    function total(){
        var at=0;
        var st=0;
        var dt=0;
        
        var at1=0;
        var st1=0;
        var dt1=0;
        //num = +num.replace(/[^\d\.-]/g,'');
        $("[name=atotal]").each(function(i,dom){
            at+=parseFloat($(dom).html().replace(/[^\d\.-]/g,''));
        })
        $("#atotal").html(at.toFixed(2));
        
        $("[name=stotal]").each(function(i,dom){
            st+=parseFloat($(dom).html().replace(/[^\d\.-]/g,''));
        })
        $("#stotal").html(st.toFixed(2));
        
        $("[name=dtotal]").each(function(i,dom){
            dt+=parseFloat($(dom).html().replace(/[^\d\.-]/g,''));
        })
        $("#dtotal").html(dt.toFixed(2));
        
        
        $("[name=atotal1]").each(function(i,dom){
            at+=parseFloat($(dom).html().replace(/[^\d\.-]/g,''));
        })
        $("#atotal1").html(at.toFixed(2));
        
        $("[name=stotal1]").each(function(i,dom){
            st+=parseFloat($(dom).html().replace(/[^\d\.-]/g,''));
        })
        $("#stotal1").html();
        
        $("[name=dtotal1]").each(function(i,dom){
            dt+=parseFloat($(dom).html().replace(/[^\d\.-]/g,''));
        })
        $("#dtotal1").html();
    }
	
	function change(id){
		if(id==1){  
			window.open('?loc=simulation&bonus=bon', '_parent')
		 }else{
			window.open('?loc=simulation', '_parent')
		 }
	}
</script>
<style>
    .tabs {
      position: relative;   
    
      clear: both;
      margin: 0px 0;
	  font-size: 14px;
 
    }
    .tab {
      float: left;
    }
    .tab label {
	 
		padding: 10px;
		margin-left: -1px;
		position: relative;
		left: 1px;
		padding: 10px 30px;
		background-color: #2b2a2a;
		width: 89px;
		color: #fff;
		font-size: 13px;
		cursor: pointer;
    }
    .tab [type=radio] {
      display: none;   
    }
    .content {
      position: absolute;
      top: 28px;
      left: 0;
      background: #000;
      right: 0;
      bottom: 0;
      padding: 20px;
      border: 1px solid #ccc; 
    }
	
	<?php  
	if(isset($_GET['bonus'])){
	
	
	?>
		[type=radio]:checked ~ label {
		  z-index: 2;
		}
		
		#tab2{
			background: #155983;
			color: #fff;
			z-index: 2;
			font-weight: bold;
		}
	
	
	<?php
	}else if(isset($_GET['cl'])){
	
	
	?>
		[type=radio]:checked ~ label {
		  z-index: 2;
		}
		
		#tab3{
			background: #155983;
			color: #fff;
			z-index: 2;
			font-weight: bold;
		}
	
	
	<?php
	}else if(isset($_GET['dva'])){
	
	
	?>
		[type=radio]:checked ~ label {
		  z-index: 2;
		}
		
		#tab4{
			background: #155983;
			color: #fff;
			z-index: 2;
			font-weight: bold;
		}
	
	
	<?php
	}else{
	?>
		[type=radio]:checked ~ label {
			background: #155983;
			color: #fff;
			z-index: 2;
			font-weight: bold;
		}
		
	<?php
	}
	?>
	   
		.alignrighttable {
			text-align: center !important;
		}
		#simul_his {
			margin-top: 20px;
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