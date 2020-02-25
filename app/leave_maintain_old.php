<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

$eid = isset($_GET["eid"]) ? $_GET["eid"] : "";
if ($eid != "") {
    $style = "block";
    $sql = "SELECT * FROM group_for_leave where id='" . $eid . "' limit 1";
    $rs = mysql_query($sql);
    $row = mysql_fetch_array($rs);
} else {
    $style = "none";
}
?>
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
        <br/>
        <div class="header_text">
            <span>Simulation</span>
        </div>
	<?php 
		if ($eid == "") {
	?>
        <div class="main_content">
            <div class="tablediv">
                <table id="tbl"> 
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
                        <td>
						<?php
							/*if(isset($_GET['eid'])){
									 $dep_id=$_GET['eid'];
							?>
						
							<?php
									
									$sql = 'SELECT id, dep_name FROM department WHERE id in('.$dep_id.') AND is_active=1';
									$query = mysql_query($sql);
									while ($row = mysql_fetch_array($query)) {
									  echo'<select class="input_text" name="selectdep" id="selectdep" style="width: 250px;" onchange="selectdep()">';
										     echo '<option value="' . $row["id"] . '" selected>' . $row["dep_name"] . '</option>';
										echo' </select><br>';
									}
								
								 }else{*/
								?>
							<select class="input_text" name="selectdep" id="selectdep" style="width: 250px;" onchange="selectdep()">
                                <option value="">--Please Select--</option>
                            </select>							
							<input type="hidden" id="b_id" value="">
                        </td>
                    </tr>
                     <tr>
                        <td colspan="3">
                            <input class="button" type="button" value="Add" onclick="add_emp_list()" style="width: 70px;"/>
                            <input class="button" type="button" value="Clear" onclick="clearfield()" style="width: 70px;"/>
                        </td>
                    </tr>
             
                </table>
            </div>
        </div>
	<?php 
	 }else{
	?>
     <div class="main_content" id="updatetable" style="display: <?php echo $style ?>;">
            <div class="tablediv">
                <div style="padding-top: 10px;padding-bottom: 5px;">
                    <?php if ($eid != "") { ?>
                        <input type="button" class="button" value="Save" onclick="updategroup(<?php echo $eid ?>)" style="width: 70px;"/>
						<input type='button' class="button" value='back' onclick='clearNew()' style="width: 70px;" />
                    <?php } else { ?>
                        <input type='button' class="button" value='Add' onclick='savegroup()' style="width: 70px;" />
                    <?php } ?>
                </div>
                <div class="table">
                    <div style="border: 1px solid black;padding-bottom: 10px;background-color: beige;">
                        <table id="tbl" class="bold bordercollapse" style="width: 100%;">
                            <tr class="tableth">
                                <th style="width: 200px;">Employee</th>
                                <th style="width: 180px;">Allowance</th>
                                <th style="width: 180px;">Allowance Amount</th>
                                <th style="width: 180px;">Tanech</th>
                                <th></th>
                            </tr>
                            <?php
							    //Get all the allowance
								$sql_allowance = "select * from allowance";
								$result_allowance = mysql_query($sql_allowance);
								//Select all the employee based on department and branch
								$confirmed = explode(",", $_GET['c']);
								$confirmedemp = "";
								$dep_id=$_GET['eid'];
								for ($i = 0; $i <= count($confirmed); $i++) {
									if ($confirmed[$i] != "") {
										$data = " AND id <> " . $confirmed[$i];
										$confirmedemp = $confirmedemp . $data;
									}
								}
		
								$sql = "select * from employee  where emp_status = 'Active' AND dep_id in($dep_id) AND branch_id = " . $_GET['b'];
								$result = mysql_query($sql);
								/*
																$sql=" where emp_status = 'Active' AND dep_id in($dep_id)".$confirmedemp;
								if ($_GET['eid'] != "") {
									if ($_GET['eid'] == "ALL") {
										$sql .=" where emp_status = 'Active' AND branch_id = " . $_GET['b'] . $confirmedemp;
									} else {
										$sql .=" where emp_status = 'Active' AND dep_id in($dep_id)".$confirmedemp;
									}
								}

								if ($_GET['list'] != "")
									$idss = explode(",", $_GET['list']);

								$result = mysql_query($sql);
								$i = 1;
								
							/*$sql2 = "SELECT * FROM group_for_leave where id='" . $eid . "'";
                                $sql_result2 = mysql_query($sql2);
                                $newArray = mysql_fetch_array($sql_result2);

                                $sql1 = "SELECT * FROM leave_group l join leave_type lt
                                        on l.leave_type_id=lt.id 
					where group_for_leave_id='" . $eid . "'
                                        ORDER BY lt.type_name, l.from_year";
                                $sql_result1 = mysql_query($sql1);

                                $temp_name = "";
                                while ($newArray1 = mysql_fetch_array($sql_result1)) {*/
                                    ?>
                                    <tr class="tabletr" name='leave_row' style="background-color: beige; color: black;">
                                        <td>
											<select id="employee" style="width: 250px;">
												<option value="">--Please Select--</option>
												<?php
												while ($rs = mysql_fetch_array($result)) {
													/*foreach ($idss as $id) {
														if ($id == $rs['id'])
															$checked = "checked";
													}
													print "<tr class='tabletr'><td>EMP" . str_pad($rs['id'],6, "0", STR_PAD_LEFT). "</td><td>" . $rs['full_name'] . "</td><td><input type='checkbox' name='" . $rs['full_name'] . "'class='check' value='" . $rs['id'] . "' $checked></td>";
													$checked = "";*/
								
													echo '<option value="' . $rs['id'] . '">' .$rs['full_name']. '</option>';
												}
												?>
											</select>
											<input name='tid' value='<?php //echo $newArray1["id"]; ?>' type='hidden' />
                                        </td>
                                        <td>
										  <select id="allowance" style="width: 250px;"  onchange="allowance(this.value)">
												<option value="">--Please Select--</option>
												<?php
												while ($rs_allowance = mysql_fetch_array($result_allowance)) {
													/*foreach ($idss as $id) {
														if ($id == $rs['id'])
															$checked = "checked";
													}
													print "<tr class='tabletr'><td>EMP" . str_pad($rs['id'],6, "0", STR_PAD_LEFT). "</td><td>" . $rs['full_name'] . "</td><td><input type='checkbox' name='" . $rs['full_name'] . "'class='check' value='" . $rs['id'] . "' $checked></td>";
													$checked = "";*/
								
													echo '<option value="' . $rs_allowance['id'] . '">' .$rs_allowance['allowance_name']. '</option>';
												}
												?>
											</select>
                                           
                                        </td>
                                        <td>
                                           <input name='ty' id="allowance_id" type='text' value="" readonly//>
                                        </td>
                                        <td>
                                            <input name='days' type='text' value="<?php //echo $newArray1["days"]; ?>" />
                                        </td>
                                        <td>
										    <input type="hidden" id="departments" value="<?php echo $_GET['eid'] ?>">
											<input type="hidden" id="branches" value="<?php echo $_GET['b'] ?>">
                                            <input type="button" value=" + " onclick="addemployee(this,<?php echo $_GET['eid']; ?>)" name="addr" /><?php
									        
									if ($temp_name == $rs['full_name']) {
                                                ?>
                                                <input type='button' value=' x ' onclick='removerow(this)' />
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    
                        </table>
                    </div>
                </div>
            </div>
        </div>
	<?php
      }
     ?>
     </div>
	</div>  
<script type="text/javascript">
    function view(id){
        window.location="?loc=leave_maintain&eid=" + id;
    }

    function addemployee(obj,id){
		var department=$("#departments").val();
		var branches=$("#branches").val();   
		$.ajax({
                dataType:'json',
                url:"?widget=showemployee_sim",
				//dataType: 'json',
               data:{
					departments:department,
					branches:branches
				},
                success:function(data){
					//var allowance=allowance("All");
					$(obj).parent().parent().after("<tr class='tabletr' name='leave_row'><td><select id='employee' style='width: 250px;'>"+data.data1+"</select></td><td><select id='allowance' style='width: 250px;'>"+data.data2+"</select></td><td><input name='ty' type='text' value='' /></td><td><input name='days' type='text' value='' /></td><td><input type='button' value=' + ' onclick='addemployee(this,"+id+")' name='addr' /><input type='button' value=' x ' onclick='removerow(this)' /></td></tr>");
					//$(obj).parent().parent().after("<tr class='tabletr' name='leave_row'><td><select id='employee' style='width: 250px;'>"+data+"</select></td><td><input name='fy' type='text' value=''/></td><td><input name='ty' type='text' value='' /></td><td><input name='days' type='text' value='' /></td><td><input type='button' value=' + ' onclick='addemployee(this,"+id+")' name='addr' /><input type='button' value=' x ' onclick='removerow(this)' /></td></tr>");
					$(obj).hide();
                    
                } 

            });
    }

    function removerow(obj){
        $(obj).parent().parent().prev().find("[name=addr]").show();
        $(obj).parent().parent().remove();
    }
    function clearNew(){
        window.location='?loc=leave_maintain';
    }
    function addnewbox(){
        $('#addnewbox').toggle('slow');
    }
    function add_leave(){
        var error1 = [];
        var error3 = [];
        
        var grp_name = $("#group_name").val();
        if(grp_name == "" || grp_name == " "){
            error1.push("Leave Group Name");
        }
        var l=$("#selected_leave_list").val();
        if(l!=null){
        }else{
            error3.push("Leave Type");
        }
        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data1 = "";
        var data3 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
                
        if(error1.length > 0 || error3.length > 0){
            alert(data1 + data3);
        }else{
            $("#tbl").empty().append("<tr class='tableth'><th style='width: 200px;'>Leave Type</th><th style='width: 180px;'>From Year</th><th style='width: 180px;'>To Year</th><th style='width: 180px;'>Days of Leave</th><th></th></tr>");
            $("#selected_leave_list option").each(function(){
                $("#tbl").append("<tr name='leave_row' style='background-color: beige; color: black;'><td style='padding-left: 10px;'>"+$(this).text()+"<input name='tid' value='"+$(this).val()+"' type='hidden' /></td><td style='padding-left: 10px;'><input name='fy' type='text' /></td><td style='padding-left: 10px;'><input name='ty' type='text' /></td><td style='padding-left: 10px;'><input name='days' type='text' /></td><td style='padding-left: 10px;'><input type='button' value=' + ' onclick='addrow(this,"+$(this).val()+")' name='addr' /></td></tr>");
            });
            $('#updatetable').fadeIn();//.toggle('slow');
        }
    }
    
    function updategroup(gid){
        var id='', y1='', y2='', y3='',str='';
        var gn=$("#group_name").val();
        $("#tbl").children().find("[name=leave_row]").each(function(i,dom){
            id=$(dom).find("[name=tid]").val(); 
            y1=$(dom).find("[name=fy]").val();
            y2=$(dom).find("[name=ty]").val();
            y3=$(dom).find("[name=days]").val();
            str+=id+','+y1+','+y2+','+y3+';';
        });
        $.ajax({
            type:"POST",
            url:"?widget=update_group",
            data:{
                gn:gn,
                str:str,
                gid:gid
            },
            success:function(data){
                if(data == true){
                    alert("Leave Group Updated");
                    window.location = '?loc=leave_maintain';
                }else{
                    alert("Error While Processing");
                }
            }
        })
    }
    function addtogroup(){
        var leave_id = $("#leaveIDSpan").html();
        if(leave_id == ""){
            $("#leave_list option:selected").each(function(i,dom){
                $("#selected_leave_list").append(dom);
            }); 
        }else{
            $("#leave_list option:selected").each(function(i,dom){
                $("#selected_leave_list").append(dom);
            }); 
            
            var selectedOptions = $.map($('#selected_leave_list option'),
            function(e) { return $(e).val(); } );
            var list = selectedOptions.join(',');

            $.ajax({
                type:"POST",
                url:"?widget=getLeaveGroupType",
                data:{
                    leave_id:leave_id,
                    list:list
                },
                success:function(data){
                    $("#tbl").empty().append("<tr class='tableth'><th style='width: 200px;'>Leave Type</th><th style='width: 180px;'>From Year</th><th style='width: 180px;'>To Year</th><th style='width: 180px;'>Days of Leave</th><th></th></tr>");
                    $("#tbl").append(data);
                    $('#updatetable').fadeIn();//.toggle('slow');
                }
            })
        }
    }
    function removefromgroup(){
        var leave_id = $("#leaveIDSpan").html();
        if(leave_id == ""){
            $("#selected_leave_list option:selected").each(function(i,dom){
                $("#leave_list").append(dom);
            }); 
        }else{
            $("#selected_leave_list option:selected").each(function(i,dom){
                $("#leave_list").append(dom);
            }); 
            
            var selectedOptions = $.map($('#selected_leave_list option'),
            function(e) { return $(e).val(); } );
            var list = selectedOptions.join(',');

            $.ajax({
                type:"POST",
                url:"?widget=getLeaveGroupType",
                data:{
                    leave_id:leave_id,
                    list:list
                },
                success:function(data){
                    $("#tbl").empty().append("<tr class='tableth'><th style='width: 200px;'>Leave Type</th><th style='width: 180px;'>From Year</th><th style='width: 180px;'>To Year</th><th style='width: 180px;'>Days of Leave</th><th></th></tr>");
                    $("#tbl").append(data);
                    $('#updatetable').fadeIn();//.toggle('slow');
                }
            })
        }
    }
    
    function savegroup(){
        var id='', y1='', y2='', y3='',str='';
        var gn=$("#group_name").val();
        $("#tbl").children().find("[name=leave_row]").each(function(i,dom){
            id=$(dom).find("[name=tid]").val(); 
            y1=$(dom).find("[name=fy]").val();
            y2=$(dom).find("[name=ty]").val();
            y3=$(dom).find("[name=days]").val();
            str+=id+','+y1+','+y2+','+y3+';';
        });
        $.ajax({
            type:"POST",
            url:"?widget=save_group",
            data:{
                gn:gn,
                str:str
            },
            success:function(data){
                if(data == true){
                    alert("Leave Group Added");
                    window.location = '?loc=leave_maintain';
                }else{
                    alert("Error While Processing");
                }
            }
        })
    }
    function delete_group(id){
        var r=confirm("Are you sure you want to delete this record?");
        if(r){
            $.ajax({
                type:"POST",
                url:"?widget=del_leavegroup",
                data:{
                    id:id
                },
                success:function(data){
                    if(data == true){
                        alert("Leave Group Deleted");
                        window.location='?loc=leave_maintain';
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
        }
    }
    function edit(id){
        window.location="?loc=leave_maintain&eid="+id;
    }
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
			window.location="?loc=leave_maintain&eid="+department+"&b="+branch+"&c="+confirmedemp;;
        }
    }
 function allowance(id){ 
	 $.ajax({
                type:'POST',
                url:"?widget=allowance_ammount",
                data:{
				id:id
                    
                },
                success:function(data){
                      $("#allowance_id").val(data);
                } 

            });
       
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