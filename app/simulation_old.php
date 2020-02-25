<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<div class="main_div">
    <div id="con">
        <br/>
        <div class="header_text">
            <span>Simulation</span>
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
        <div id="divappend" class="main_content">
            <div class="tablediv" style="width: 97%;">
                <div style="padding-bottom: 5px; padding-top: 10px;"></div>
                <div style="border: 1px solid black;">
                    <table id="tbl" class="bordercollapse" style="width: 100%;">
                       <!-- <tr class="tableth" id="calintr" style="display: none;">
                            <th style="width: 180px;">Department</th>
                            <th>Name</th>
                            <th style="width: 130px;">Increment By</th>
                            <th style="width: 220px;">Before Increment Total (RM)</th>
                            <th style="width: 220px;">After Increment Total (RM)</th>
                            <th style="width: 150px;">Difference (RM)</th>
                        </tr> -->

                        <tr class="tableth" id="calbonustr">
						    <th style="width: 180px;">ID</th>
                            <th style="width: 180px;">Department</th>
                            <th>Name</th>
                            <th style="width: 180px;">Basic Salary (RM)</th>
                            <th style="width: 220px;">Bonus</th>
							<th style="width: 220px;">Increment</th>
                            <th style="width: 220px;">Total Bonus (RM)</th>
							<th style="width: 100px;">Action</th>
                           
                        </tr> 
						<?php
						$count=1;
						$sym="Month";
							$sql3 = 'SELECT * from simulation WHERE status="active"';
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
							  
							   echo '<tr class="tabletr">
			<td style="width: 180px;">' . $count . '</td>
            <td style="width: 180px;">' . $dep_name . '</td>
            <td><input type="hidden" id="empid" value=' . $empid . ' />' . $emp_name . '</td>
            <td style="width: 180px;">' . number_format($get_basic, 2, ".", "") . '</td>
            <td style="width: 220px;"><span name="stotal">' . $in_by . ' (' . $sym . ')' . '</span></td>  
            <td style="width: 220px;"><span name="stotal">' . $increment . ' (' . $sym . ')' . '</span></td>				
            <td style="width: 220px;"><span name="atotal">' . number_format($total, 2, ".", "") . '</span></td>
			<td class="alignrighttable"><input type="button" value="Delete" class="button" onclick="cleartext1('.$id.')" style="width: 70px;" /></td>
                
            </tr>';
			$count++;
				}		  
							 ?>
                    </table>
                    <table id="tb2" class="bordercollapse" style="width: 100%;">
					
					</table>
                    <hr/>
                    <table class="bordercollapse" style="width: 100%; font-weight: bold;">
                        <tr class="tabletr" id="totalintr" style="display: none;">
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
                    <hr/>
                </div>
            </div>
        </div>
    </div> 
    <div id="popup" ></div>
</div>

<span style="display: none;" id="selecttypespan"></span>
<span style="display: none;" id="selectintypespan"></span>
<span id="branchSpan" style="display: none;"><?php echo $igen_branchlist; ?></span>

<script type="text/javascript">
    
    
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
            $("#selecttypetd").html("Bonus (Months)");
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
            $("#selecttypetd").html("Increment Amount (%)");
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
        $.ajax({
                type:'POST',
                url:"?widget=delete_simulation",
                data:{
                   id:id
                },
                success:function(data){
				     alert(data);
					  window.location='?loc=simulation';
                }
            });
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
</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>