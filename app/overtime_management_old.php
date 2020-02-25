<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
  //ok
  
?>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tablecolor').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
</script>


<div class="main_div">
    <div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">OverTime Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <?php if ($igen_a_m == "a_m_edit") { ?>
        <div class="header_text">
            <span>OverTime Maintenance</span>
        </div>
        <div class="main_content"> 
            <div class="tablediv">
                <?php
                $sql2 = 'SELECT *, ot.id as otid FROM overtime ot inner join employee e on ot.emp_id= e.id WHERE ot.id = ' . $_GET['overtime_id'] . '';
                $rs2 = mysql_query($sql2);
                while ($row2 = mysql_fetch_array($rs2)) {
                    $overtime_name = $row2['overtime_name'];
                    $week_end_rate = $row2['week_end_rate'];
                    $holiday_rate = $row2['holiday_rate'];
                    $normal_rate = $row2['normal_rate'];
					$full_name=$row2['full_name'];
					$resting_day=$row2['resting_day'];
                    $overtime_id = $row2['otid'];
                }
				
                if (isset($_GET['overtime_id']) == true) {
                    ?>  
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Save" onclick="editovertime(<?php echo $overtime_id ?>)" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                        </tr> 
                        <tr>
                            <td style="width:200px;">Employee</td>
                            <td><input type="text" value="<?php echo $full_name ?>" readonly class="input_text"  name="overtime_name" id="overtime_name" style="width: 250px"/></td>
                        </tr>
						<tr>
							<td >Resting Day</td>
							<td>
								<select id="restDate" style="width: 250px;"  name='rest'>
									<option value="">--Please Select--</option>
									<option value="1" <?php if($resting_day==1){ echo "selected"; } ?>>Monday</option>
									<option value="2" <?php if($resting_day==2){ echo "selected"; } ?>>Tuesday</option>
									<option value="3" <?php if($resting_day==3){ echo "selected"; } ?>>Wednesday</option>
									<option value="4" <?php if($resting_day==4){ echo "selected"; } ?>>Thuesday</option>
									<option value="5" <?php if($resting_day==5){ echo "selected"; } ?>>Friday</option>
									<option value="6" <?php if($resting_day==6){ echo "selected"; } ?>>Saturday</option>
									<option value="7" <?php if($resting_day==7){ echo "selected"; } ?>>Sunday</option>
								</select>
							</td>
						</tr>
                        <tr>
                            <td >Resting Day Rate</td>
                            <td ><input type="text" value="<?php echo $week_end_rate ?>" class="input_text" id="week_end_rate" name="week_end_rate"  value="" style="width: 250px"/></td>
                        </tr>

                        <tr>
                            <td >Holiday Rate</td>
                            <td ><input type="text" class="input_text" id="holiday_rate" name="holiday_rate" value="<?php echo $holiday_rate ?>" style="width: 250px"/></td>
                        </tr>

                        <tr>
                            <td >Normal Rate</td>
                            <td ><input type="text" class="input_text" id="normal_rate" name="normal_rate" value="<?php echo $normal_rate ?>" style="width: 250px"/></td>
                        </tr>  
						
                    </table>
                <?php } else if(isset($_GET['eid']) && $_GET['eid']!=""){
					
					?>
					<div class="table">
						<div style="border: 1px solid black;padding-bottom: 10px;background-color: beige;">
							<table id="tbl" class="bold bordercollapse" style="width: 100%;">
								<tr class="tableth">
									<th style="width: 100px;">Employee</th>
									<th style="width: 180px;">Holiday Rate</th>
									<th style="width: 100px;">Normal Rate</th>
									<th style="width: 100px;">Resting Day</th>
									<th style="width: 100px;">Reesting Day Rate</th>
									<th style="width: 20px;">Cub</th>
									<th></th>
								</tr>
								<?php
				
								$dep_id=$_GET['eid'];
								if($dep_id!="ALL"){
									$sql = "select * from employee  where emp_status = 'Active' AND dep_id in($dep_id) AND branch_id = " . $_GET['b'];
								 }else{
									 $sql = "select * from employee  where emp_status = 'Active' AND branch_id = " . $_GET['b'];
								 }
									$result = mysql_query($sql);
								 ?>
								  <tr>
									<td colspan="2">
										<input type="button" class="button add-checkAll" value="Add" onclick="addovertime()" style="width: 70px;" />
										
									</td>
									</tr> 
									<tr>
									<td colspan="2">
										<input type="checkbox" class="all-employee add-checkAll" value="all"/> &nbsp; All
										
									</td>
									</tr> 
										<tr class="tabletr individual" name='leave_row'  style="background-color: beige; color: black;">
											<td>
												<select id="employee" style="width:250px;"  name='tid' onchange="emplyee()">
													<option value="">--Please Select--</option>
													<?php
													while ($rs = mysql_fetch_array($result)) {							
														echo '<option value="' . $rs['id'] . '">' .$rs['full_name']. '</option>';
													}
													?>
												</select>
											</td>
											<td>
												<input name='fy' id="holiday_rate" type='text' value="" />
											</td>
											<td>
											   <input name='ty' id="normal_id" type='text' value="" />
											</td>
											<td>
												<select id="restDate" style="width: auto"  name='rest'>
													<option value="">--Please Select--</option>
													<option value="1">Monday</option>
													<option value="2">Tuesday</option>
													<option value="3">Wednesday</option>
													<option value="4">Thuesday</option>
													<option value="5">Friday</option>
													<option value="6">Saturday</option>
													<option value="7">Sunday</option>
												</select>
											</td>
											<td>
											   <input name='cn' id="restDay_rate" type='text' value="" />
											</td>
											<td>
												<select id="cub" style="width: auto"  name='cub'>
													<option value="">--Please Select--</option>
													<option value="Y">Yes</option>
												</select>
											</td>
											<td>
												<input type="hidden" id="departments" value="<?php echo $_GET['eid'] ?>">
												<input type="hidden" id="branches" value="<?php echo $_GET['b'] ?>">
												<input type="button" value=" + " onclick="addemployee(this)" name="addr" /><?php
												
												if ($temp_name == $rs['full_name']) {
													?>
													<input type='button' value=' x ' onclick='removerow(this)' />
													<?php
												}
												?>
											</td>
											
										</tr> 
										<!-- All employee -->
										<tr class="tabletr all_emp"  style="background-color: beige; color: black; display:none">
											<td>
												<select id="employee" style="width: 250px;"  name='tid' onchange="emplyee()">
													<option value="All">All Employee</option>
												</select>
											</td>
											<td>
												<input name='fy' id="holiday_rate1" type='text' value="" />
											</td>
											<td>
											   <input name='ty' id="normal_id1" type='text' value="" />
											</td>
											<td>
												<select id="restDate1" style="width: auto"  name='rest'>
													<option value="">--Please Select--</option>
													<option value="1">Monday</option>
													<option value="2">Tuesday</option>
													<option value="3">Wednesday</option>
													<option value="4">Thuesday</option>
													<option value="5">Friday</option>
													<option value="6">Saturday</option>
													<option value="7">Sunday</option>
												</select>
											</td>
											<td>
											   <input name='cn' id="restDay_rate1" type='text' value="" />
											</td>
											<td>
												<select id="cub" style="width: auto"  name='cub'>
													<option value="">--Please Select--</option>
													<option value="Y">Yes</option>
												</select>
											</td>
								
											<td>
												<input type="hidden" id="departments" value="<?php echo $_GET['eid'] ?>">
												<input type="hidden" id="branches" value="<?php echo $_GET['b'] ?>">
						
											</td>
											
										</tr>
							</table>
						</div>
					</div>
					<?php
					
				}else { ?>
                    <table>
					    <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Add" onclick="process_overTime()" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
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
                    
                        
                    </table>
                <?php } ?>
            </div>
        </div>
        <br/><br/>
        <?php
    } elseif ($igen_a_m == "a_m_view") {
        $sql2 = 'SELECT * FROM overtime WHERE id = ' . $_GET['view_id'];
        $rs2 = mysql_query($sql2);
        $row2 = mysql_fetch_array($rs2);
        $overtime_name = $row2['overtime_name'];
        $week_end_rate = $row2['week_end_rate'];
        $holiday_rate = $row2['holiday_rate'];
        $normal_rate = $row2['normal_rate'];
        $overtime_id = $row2['id'];
        ?>
        <div class="header_text">
            <span>Overtime Maintenance</span>
        </div>
        <div class="main_content"> 
            <div class="tablediv">
                <table>
                    <tr>
                        <td style="width:200px;">Overtime Name</td>
                        <td><input type="text" value="<?php echo $overtime_name ?>" style="width: 250px" readonly="readonly"/></td>
                    </tr>

                    <tr>
                        <td >Resting Day Rate</td>
                        <td ><input type="text" value="<?php echo $week_end_rate ?>" readonly="readonly" style="width: 250px"/></td>
                    </tr>

                    <tr>
                        <td >Holiday Rate</td>
                        <td ><input type="text" value="<?php echo $holiday_rate ?>" style="width: 250px" readonly="readonly"/></td>
                    </tr>

                    <tr>
                        <td >Normal Rate</td>
                        <td ><input type="text" value="<?php echo $normal_rate ?>" style="width: 250px" readonly="readonly"/></td>
                    </tr>   
                </table>
            </div>
        </div>
        <br/><br/>
    <?php } ?>
    <div class="header_text">
        <span>OverTime List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th>Employee</th>
                        <th class="aligncentertable" style="width:150px">Resting Day rate</th>
                        <th class="aligncentertable" style="width:150px">Holiday rate</th>
                        <th class="aligncentertable" style="width:150px">Normal rate</th>
                        <th class="aligncentertable" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = 'SELECT *, ot.id as otid FROM overtime ot inner join employee e on ot.emp_id= e.id';
                $rs = mysql_query($sql);

                while ($row = mysql_fetch_array($rs)) {
                    $i = $i + 1;
                    $full_name = $row['full_name'];
                    $week_end_rate = $row['week_end_rate'];
                    $holiday_rate = $row['holiday_rate'];
                    $normal_rate = $row['normal_rate'];
                    $overtime_id = $row['otid'];

                    echo'<tr class="plugintr">
                        <td>' . $i . '</td>
                        <td style="width:250px">' . $full_name . '</td>
                        <td class="aligncentertable">' . $week_end_rate . '</td>
                        <td class="aligncentertable">' . $holiday_rate . '</td>
                        <td class="aligncentertable">' . $normal_rate . '</td>';
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a href="?loc=overtime_management&overtime_id=' . $overtime_id . '">Edit</a>&nbsp;|&nbsp;<a href="javascript:void()" onclick="deleteovertime(' . $overtime_id . ')">Delete</a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td class="aligncentertable"><a href="?loc=overtime_management&view_id=' . $overtime_id . '">View</a></td>';
                    }
                    echo '</tr>';
                }
                ?>  
            </table>
        </div>
    </div>
</p></div></div></div>

<script type="text/javascript">
    function view(id){
        window.location="?loc=overtime_management&view_id=" + id;
    }
    function clearNew(){
        window.location='?loc=overtime_management';
    }
    function addovertime(){
		var department="";
		var branches = "";
		
		
		var employee_id = "";
        var restday_rate = "";
        var holiday_rate = "";
        var normal_rate = "";
		var resting_day = "";
		var cub ="";
		var str = "";
		if($(".all-employee").is(":checked")){
			department=$("#departments").val();
		    branches=$("#branches").val();
			employee_id="All"; 
            holiday_rate=$("#holiday_rate1").val();
            normal_rate=$("#normal_id1").val(); 
			resting_day=$("#restDate1").val(); 
			restday_rate=$("#restDay_rate1").val(); 			
			str+=employee_id + ',' + holiday_rate + ',' + normal_rate + ',' + resting_day + ',' + restday_rate + ";";
		}else{
			$("#tbl").children().find("[name=leave_row]").each(function(i,dom){
				employee_id=$(dom).find("[name=tid]").val(); 
				holiday_rate=$(dom).find("[name=fy]").val();
				normal_rate=$(dom).find("[name=ty]").val(); 
				resting_day=$(dom).find("[name=rest]").val(); 
				restday_rate=$(dom).find("[name=cn]").val();
                cub=$(dom).find("[name=cub]").val();				
				str+=employee_id + ',' + holiday_rate + ',' + normal_rate + ',' + resting_day + ',' + restday_rate + ',' + cub + ";";
				if(str==""){
					exit();
				}
			});
		}
	     str=str.slice(0, -1);
      if(employee_id=="" || holiday_rate=="" || normal_rate=="" || resting_day=="" || restday_rate=="" || str==""){
            alert("Please keyin all the fields");
			exit();
        }
		
		if(!$.isNumeric(holiday_rate) || !$.isNumeric(normal_rate) || !$.isNumeric(restday_rate)){
			alert("All Rates have to be numeric");
			exit();
		}
        $.ajax({
                type:'POST',
                url:"?widget=addovertime",
                data:{
                    str:str,
					department:department,
					branches:branches
                },
                success:function(data){
                    if(data == true){
                        alert("Overtime Added");
                        window.location='?loc=overtime_management';
                    }else{
                        alert("Error While Processing");
                    }
                }

            });
        
    }
    
    function deleteovertime(overtimeid){

        var result = confirm("Are you sure you want to delete this record?");
        if(result == true){
            $.ajax({
                type:'POST',
                url:'?widget=deleteovertime',
                data:{
                    overtimeid:overtimeid
                },

                success:function(data){
                    if(data==true){
                        alert('Overtime Deleted');
                        window.location='?loc=overtime_management';
                    }else{
                        alert('Error While Processing');
                    }
                }
            })
        }
    }
    
    function editovertime(overtimeid)
    {
		
        var restDay = $('#restDate').val();
        var week_end_rate = $('#week_end_rate').val();
        var holiday_rate = $('#holiday_rate').val();
        var normal_rate = $('#normal_rate').val();
        var overtime_id = overtimeid;
  
        var error1 = [];
        var error2 = [];
        
        if(restDate == '' || restDate == ' '){
            error1.push("Resting Day");
        }
        if(week_end_rate == '' || week_end_rate == ' '){
            error1.push("Resting Day Rate");
        }else{
            if(week_end_rate.match(/^\d+$/) || week_end_rate.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Resting Day Rate");
            }   
        }
        if(holiday_rate == '' || holiday_rate == ' '){
            error1.push("Holiday Rate");
        }else{
            if(holiday_rate.match(/^\d+$/) || holiday_rate.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Holiday Rate");
            }   
        }
        if(normal_rate == '' || normal_rate == ' '){
            error1.push("Normal Rate");
        }else{
            if(normal_rate.match(/^\d+$/) || normal_rate.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Normal Rate");
            }   
        }
     
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
                
        var data1 = "";
        var data2 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Check :\n"+error_data2+"\n\n";
        }
                
        if(error1.length > 0 || error2.length > 0){
            alert(data1 + data2);
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=editovertime",
                data:{
                   overtime_name:restDay,
                    week_end_rate:week_end_rate,
                    holiday_rate:holiday_rate,
                    normal_rate:normal_rate,
                    overtime_id:overtime_id
                },
                success:function(data){

                    if(data==true){
						
                        alert("Overtime Updated");
                        window.location='?loc=overtime_management';
                    }else{
                        alert("Error While Processing");
                    }
                }
            });
        }
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
            url:"?widget=showdept_payroll",
            data:{
                branch_id:branch_id
            },
            success:function(data){
				$select=
                $("#selectdep").empty().append(data);
                $("#employee_list_view").val("");
                $("#employee_ids").html("");
				$("#b_id").val(branch_id);
			//$("select#selectdep").after('<input type="button" value=" + " onclick="addrow(this)" name="addr" />');
            }
        });
    }
	
	function process_overTime(){
        var department = $("#selectdep").val();
        var branch = $("#dropBranch").val();
        if(department != ""){
            if(department == "0"){
                department = "ALL";
            }
			window.location="?loc=overtime_management&eid="+department+"&b="+branch;
        }
    }
	
	function addemployee(obj){
		var department=$("#departments").val();
		var branches=$("#branches").val(); 
		$.ajax({
                dataType:'json',
                url:"?widget=showemployee_sim",
				//dataType: 'json',
               data:{
					departments:department,
					branches:branches,
					action:"ot"
				},
                success:function(data){
					//var allowance=allowance("All");
					$(obj).parent().parent().after("<tr class='tabletr individual' name='leave_row'><td><select id='employee'  style='width: 250px;' name='tid'>"+data.data1+"</select></td><td><input name='fy' id='restDay_rate' type='text' value='' autocomplete='off'></td><td><input name='ty' id='normal_rate' type='text' value='' autocomplete='off'></td><td><select id='restDate' style='width:auto' name='rest'><option value=''>--Please Select--</option><option value='1'>Monday</option><option value='2'>Tuesday</option><option value='3'>Wednesday</option><option value='4'>Thuesday</option><option value='5'>Friday</option><option value='6'>Saturday</option><option value='7'>Sunday</option></select></td><td> <input name='cn' id='restDay_rate' type='text' value='' autocomplete='off'></td><td><select id='cub' style='width: auto'  name='cub'><option value=''>--Please Select--</option><option value='Y'>Yes</option></select></td><td><input type='button' value=' + ' onclick='addemployee(this)' name='addr' /><input type='button' value=' x ' onclick='removerow(this)' /></td></tr>");
					$(obj).hide(); 
                } 

            });	
	}
	function removerow(obj){
        $(obj).parent().parent().prev().find("[name=addr]").show(); 
        $(obj).parent().parent().remove();
    }
   $(document).ready(function(){
	   $(".all-employee").click(function(){
		   if($(this).is(":checked")){
			    $("tr.tabletr.all_emp").show();
				$("tr.tabletr.individual").hide();
		   }else{
			   $("tr.tabletr.all_emp").hide();
				$("tr.tabletr.individual").show();
		   }
		   
	   })
	   	  //individualall_emp
	   
   })

  
</script>
<style>
.add-checkAll,input.all-employee.add-checkAll{
    margin-left: 10px;
}
table#tbl input[type=text] {
    width: 141px !important;
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