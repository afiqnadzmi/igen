<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tableplugin').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
</script>
<style>

.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

</style>
<?php

if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1") {
    $is_admin = "1";
} else {
    $is_admin = "0";
}

if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
    $sqlAdd = ' AND request_date BETWEEN "' . $_GET["from"] . '" AND "' . $_GET["to"] . '"';
} else {
    $sqlAdd = ' AND DATE_SUB(CURDATE(),INTERVAL 60 DAY) <= request_date';
}
if($_GET['emp']!="" && $igen_a_hr == "a_hr_edit"){
	$sql = "SELECT * FROM employee_overtime WHERE emp_id=" .$_GET['emp']. $sqlAdd . " ORDER BY request_date DESC, id";
}else{
	$sql = "SELECT * FROM employee_overtime WHERE emp_id=" . $_COOKIE['igen_user_id'] . $sqlAdd . " ORDER BY request_date DESC, id";
}
$rs = mysql_query($sql);
$i = 1;
?>

<div class="main_div">
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Employee Overtime </a>
					</h4>
				</div>
		</div>
	</div>
	<div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">  
			<br>
			<div class="modal"></div>
			<div class="header_text" >Overtime Application</div>

			<div class="main_content">
				<div id="container" class="tablediv">
					<table>
						<tr>
							<td colspan="2">
								<input type="button" class="button" value="Apply" onclick="save()" style="width: 70px;" />
								<input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
								<span id="is_admin" style="display: none;"><?php echo $is_admin; ?></span>
							</td>
						</tr>
						<?php 
							if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1") { 
								if (isset($_GET["emp"]) == true && $_GET["emp"] != "" && $igen_a_hr == "a_hr_edit" ) {
									$emp_id = $_GET["emp"];
									$queryEmp = mysql_query('SELECT full_name, company_id, branch_id, dep_id FROM employee WHERE id=' . $emp_id);
									$rowEmp = mysql_fetch_array($queryEmp);
								}	
						?>
							<tr>
								<td>Company<span class="red"> *</span></td>
								<td>
									<select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)">
										<option value="">--Please Select--</option>
										<?php
										$queryCompany = mysql_query('SELECT * FROM company ORDER BY code'); 
										while ($rowCompany = mysql_fetch_array($queryCompany)) {
											if (isset($_GET["emp"]) == true && $_GET["emp"] != "" && $igen_a_hr == "a_hr_edit" ) {
												if ($rowEmp["company_id"] == $rowCompany["id"]) {
													echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
												} else {
													echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
													
												}
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
								<td>Branch<span class="red"> *</span></td>
								<td>
									<select id="dropBranch" style="width: 250px;" onchange="showDep(this.value)">
										<option value="">--Please Select--</option>
										<?php
										if (isset($_GET["emp"]) == true && $_GET["emp"] != "") {
											$queryBranch = mysql_query('SELECT * FROM branch WHERE company_id="' . $rowEmp["company_id"] . '" ORDER BY branch_code');
										} else {
											$queryCompany = mysql_query('SELECT * FROM company WHERE is_default=1 LIMIT 1');
											$rowCompany = mysql_fetch_array($queryCompany);
											$queryBranch = mysql_query('SELECT * FROM branch WHERE company_id="' . $rowCompany["id"] . '" ORDER BY branch_code');
										}
										while ($rowBranch = mysql_fetch_array($queryBranch)) {
											if ($rowEmp["branch_id"] == $rowBranch['id']) {
												echo '<option value="' . $rowBranch["id"] . '" selected="true">' . $rowBranch["branch_code"] . '</option>';
											} else {
												echo '<option value="' . $rowBranch["id"] . '">' . $rowBranch["branch_code"] . '</option>';
											}
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Department<span class="red"> *</span></td>
								<td>
									<select id="department" style="width: 250px;" onchange="add_emp_list()">
										<option value="">--Please Select--</option>
										<?php
										if (isset($_GET["emp"]) == true && $_GET["emp"] != "" && $igen_a_hr == "a_hr_edit") {
											$queryDep = mysql_query('SELECT * FROM department WHERE branch_id="' . $rowEmp["branch_id"] . '" ORDER BY dep_name');
										}
										while ($rowDep = mysql_fetch_array($queryDep)) {
											if ($rowEmp["dep_id"] == $rowDep["id"]) {
												echo '<option value="' . $rowDep["id"] . '" selected="true">' . $rowDep["dep_name"] . '</option>';
											} else {
												echo '<option value="' . $rowDep["id"] . '">' . $rowDep["dep_name"] . '</option>';
											}
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Employee<span class="red"> *</span></td>
								<td>
									<input type="hidden" id="employee_id" value="<?php echo $emp_id; ?>" name="employee" />
									<input type="text" id="employee_name" style="width: 250px;" onclick="add_emp_list()" value="<?php echo $rowEmp["full_name"]; ?>" />
								</td>
							</tr>
							<tr><td colspan="5" style="border-bottom: 1px solid gray;">&nbsp;</td></tr>
							<tr><td colspan="5" style="padding-bottom: 5px;"></td></tr>
						<?php } ?>
						<tr>
							<td style="width: 200px;">Overtime Date<span class="red"> *</span></td>
							<td><input type="text" class="input_text" id="ot_date" name="date" style="width:250px"/></td>
							<td style="width: 200px;"></td>
							<td style="width: 200px;"></td>
							<input type="hidden" id="employee_id1" value="<?php echo $_COOKIE['igen_user_id']; ?>" />
						</tr>  
						<tr>
							<td>Start Time</td>
							<td>
								<select id="from_time1">
									<?php
									for ($i = 0; $i <= 23; $i++) {
										$start1 = str_pad($i, 2, '0', STR_PAD_LEFT);
										echo '<option value="' . $start1 . '">' . $start1 . '</option>';
									}
									?>
								</select>:<select id="from_time2">
									<?php
									for ($i = 0; $i <= 59; $i++) {
										$start2 = str_pad($i, 2, '0', STR_PAD_LEFT);
										echo '<option value="' . $start2 . '">' . $start2 . '</option>';
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>End Time</td>
							<td>
								<select id="to_time1">
									<?php
									for ($i = 0; $i <= 23; $i++) {
										$end1 = str_pad($i, 2, '0', STR_PAD_LEFT);
										echo '<option value="' . $end1 . '">' . $end1 . '</option>';
									}
									?>
								</select>:<select id="to_time2">
									<?php
									for ($i = 0; $i <= 59; $i++) {
										$end2 = str_pad($i, 2, '0', STR_PAD_LEFT);
										echo '<option value="' . $end2 . '">' . $end2 . '</option>';
									}
									?>
								</select>
							</td>
						</tr>
					</table>
				</div>
				</div> 

			<br><br>	
			<?php if (isset($_COOKIE["igen_user_id"]) == true || $igen_userpermission == "1") {
			
			?>
			
				<div class="header_text">
					<span>Overtime History</span>
					<span style="float: right; font-size: 13px; font-weight: normal; margin-top: -5px;">
						<?php
						if (isset($_GET["from"]) == true) {
							$from = $_GET["from"];
						} else {
							$from = '';
						}
						if (isset($_GET["to"]) == true) {
							$to = $_GET["to"];
						} else {
							$to = '';
						}
						?>
						<table>
							<tr>
								<td>Date Range&nbsp;<input type="text" id="fromdate" style="width: 90px;" value="<?php echo $from; ?>" />&nbsp;-&nbsp;<input type="text" id="todate" style="width: 90px;" value="<?php echo $to; ?>" /></td>
							</tr>
						</table>
					</span>
				</div>
				<div class="main_content">
					<div class="plugindiv">
					  <div id="edu" style="margin-bottom:3%">
						<table id="tableplugin" class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
							<thead>
								<tr class="pluginth">
									<th style="width: 30px;">No.</th>
									<th style="width: 100px;">Overtime Date</th>
									<th style="width: 100px;">Start Time</th>
									<th style="width: 100px;">End Time</th>
									<th style="width: 50px;">Total Minutes</th>
									<th style="width: 100px;">Apply Date</th>
									<th class="aligncentertable" style="width: 100px;">Status</th>
									<th class="aligncentertable" style="width: 100px;">Action</th>
								</tr>
							</thead>
							<?php
							$num = 0;
							while ($newArray = mysql_fetch_array($rs)) {
								$num = $num + 1;
								$from = $newArray['from_time'];
								$to = $newArray['to_time'];
								$id = $newArray['id'];

								$array_from = explode(":", $from);
								$array_to = explode(":", $to);
								if ($array_from[0] > 12) {

									$from_h1 = $array_from[0] - 12;
									$from_h = "" . $from_h1 . "";
									$f_time = "PM";
								} else {

									if ($array_from[0] >= 10) {
										$from_h = substr($array_from[0], 0);
									} else {
										$from_h = substr($array_from[0], 1);
									}
									$f_time = "AM";
								}

								if ($array_to[0] > 12) {

									$to_h1 = $array_to[0] - 12;
									$to_h = "" . $to_h1 . "";
									$t_time = "PM";
								} else {

									if ($array_to[0] >= 10) {
										$to_h = substr($array_to[0], 0);
									} else {
										$to_h = substr($array_to[0], 1);
									}
									$t_time = "AM";
								}

								$from_time = $from_h . ":" . $array_from[1] . " " . "$f_time";
								$to_time = $to_h . ":" . $array_to[1] . " " . "$t_time";
								$ot_status=$newArray['ot_status'];
								
								if($ot_status=="Approved_lv1" || $ot_status=="Approved_lv2" || $ot_status=="Approved_lv3"){
									$ot_status = $newArray['status2'];
								}
								echo '<tr class="plugintr">
								  <td>' . $num . '</td>
								  <td>' . date('d-m-Y', strtotime($newArray['ot_date'])) . '</td>
								  <td>' . $from_time . '</td>
								  <td>' . $to_time . '</td>
								  <td>' . $newArray['total_minutes'] . '</td>
								  <td>' . date('d-m-Y', strtotime($newArray['request_date'])) . '</td>
								  <td class="aligncentertable">' . $ot_status . '</td>';

								if ($ot_status == "Pending") {
									echo '<td class="aligncentertable"><a title="Cancel" href="javascript:void()" onclick="deleteid(' . $id . ')"><i class="far fa-window-close" style="color:#000;"></i></a></td> ';
								} else {
									echo "<td class='aligncentertable'>-</td> ";
								}
							}
							?>
						</table></div>
				
			<?php
				
			} else { ?>
				<br/><br/>
				<div class="header_text">
					<span>Employee Overtime History</span>
					<span style="float: right; font-size: 13px; font-weight: normal;">
						<?php
						if (isset($_GET["from"]) == true) {
							$from = $_GET["from"];
						} else {
							$from = '';
						}
						if (isset($_GET["to"]) == true) {
							$to = $_GET["to"]; 
						} else {
							$to = '';
						}
						?>
						<table>
							<tr>
								<td>Date Range&nbsp;<input type="text" id="fromdate" style="width: 90px;" value="<?php echo $from; ?>" />&nbsp;-&nbsp;<input type="text" id="todate" style="width: 90px;" value="<?php echo $to; ?>" /></td>
							</tr>
						</table>
					</span>
				</div>
				<div class="main_content">
					<div class="plugindiv">
						<table id="tableplugin" style="border-collapse: collapse;width: 100%; font-size: 13px;">
							<thead>
								<tr class="pluginth">
									<th style="width: 30px;">No.</th>
									<th>Overtime Date</th>
									<th style="width: 150px;">Start Time</th>
									<th style="width: 150px;">End Time</th>
									<th style="width: 150px;">Total Minutes</th>
									<th style="width: 120px;">Apply Date</th>
									<th class="aligncentertable" style="width: 150px;">Status</th>
									<th class="aligncentertable" style="width: 100px;">Action</th>
								</tr>
							</thead>
							<?php
							$num = 0;
							while ($newArray = mysql_fetch_array($rs)) {
								$num = $num + 1;
								$from = $newArray['from_time'];
								$to = $newArray['to_time'];
								$id = $newArray['id'];

								$array_from = explode(":", $from);
								$array_to = explode(":", $to);
								if ($array_from[0] > 12) {

									$from_h1 = $array_from[0] - 12;
									$from_h = "" . $from_h1 . "";
									$f_time = "PM";
								} else {

									if ($array_from[0] >= 10) {
										$from_h = substr($array_from[0], 0);
									} else {
										$from_h = substr($array_from[0], 1);
									}
									$f_time = "AM";
								}

								if ($array_to[0] > 12) {

									$to_h1 = $array_to[0] - 12;
									$to_h = "" . $to_h1 . "";
									$t_time = "PM";
								} else {

									if ($array_to[0] >= 10) {
										$to_h = substr($array_to[0], 0);
									} else {
										$to_h = substr($array_to[0], 1);
									}
									$t_time = "AM";
								}

								$from_time = $from_h . ":" . $array_from[1] . " " . "$f_time";
								$to_time = $to_h . ":" . $array_to[1] . " " . "$t_time";
								$ot_status=$newArray['ot_status'];
								if($ot_status=="Approved_lv1" || $ot_status=="Approved_lv2" || $ot_status=="Approved_lv3"){
									$ot_status = $row['status2'];
								}
								echo '<tr class="plugintr">
								  <td>' . $num . '</td>
								  <td>' . date('d-m-Y', strtotime($newArray['ot_date'])) . '</td>
								  <td>' . $from_time . '</td>
								  <td>' . $to_time . '</td>
								  <td>' . $newArray['total_minutes'] . '</td>
								  <td>' . date('d-m-Y', strtotime($newArray['request_date'])) . '</td>
								  <td class="aligncentertable">' . $ot_status . '</td>';

								if ($ot_status == "Pending") {
									echo '<td class="aligncentertable"><a title="Cancel" href="javascript:void()" onclick="deleteid(' . $id . ')"><i class="far fa-window-close" style="color:#000;"></i></a></td> ';
								} else {
									echo "<td class='aligncentertable'>-</td> ";
								}
							}
							?>
						</table>
					</div>
				</div>
		</div>
	</div>
	
    <?php } ?>
</div>
</div>
	</div>

<script type="text/javascript">
          
    $("#fromdate, #todate").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function (){
            var from = $("#fromdate").val();
            var to = $("#todate").val();
            if(from != "" && to != ""){
                if(from > to){
                    window.location = '?eloc=emp_ot_app&from='+to+'&to='+from;
                }else{
                    window.location = '?eloc=emp_ot_app&from='+from+'&to='+to;
                }
            }
        },
		onClose: function( selectedDate ) {
    $( "#todate" ).datepicker( "option", "minDate", selectedDate );
	}
    });
    
    function showBranch(company_id){
        var branch = "";
        $.ajax({
            type:"POST",
            url:"?widget=showbranch_form",
            data:{
                company_id:company_id,
                branch:branch
            },
            success:function(data){
                $("#dropBranch").empty().append(data);
                $("#department").empty().append("<option value=''>--Please Select--</option>");
                $("#employee_id").val();
                $("#employee_name").val("");
            }
        });
    }
    
    function showDep(branch_id){
        $.ajax({
            type:"POST",
            url:"?widget=showdept_form",
            data:{
                branch_id:branch_id
            },
            success:function(data){
                $("#department").empty().append(data);
                $("#employee_id").val();
                $("#employee_name").val("");
            }
        });
    }

    function add_emp_list(){
        var department = $("#department").val();
        var branch = $("#dropBranch").val();
        var url= "?widget=search_emp_e_app&d="+department+"&b="+branch+"&t=ot";
        window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
    }
    
    function clearNew(){
        window.location='?eloc=emp_ot_app';
    }
    $(function(){
    
        var picker={dateFormat:"dd-mm-yy"};
        $("#ot_date").datepicker(picker);  
  
    });
    
    function save(){ 
        var from_time1=$("#from_time1").val();
        var to_time1=$("#to_time1").val();
        var from_time2=$("#from_time2").val();
        var to_time2=$("#to_time2").val();
        var date=$("#ot_date").val();
        
        var is_admin = $('#is_admin').html();
        var emp_id = $('#employee_id').val();
		var emp_id1 = $('#employee_id1').val();
       
        var error1 = [];
        var error3 = [];
        
        if(is_admin == "1"){
            if(emp_id == "" || emp_id == " "){
                error3.push("Employee");
            }
        }else{
            emp_id = emp_id1;
        }
        if(date == "" || date == " "){
            error1.push("Overtime Date");
        }
        if(from_time1 == "00" && from_time2 == "00"){
            error1.push("From Time")
        }
        if(to_time1 == "00" && to_time2 == "00"){
            error1.push("To Time")
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
		
            $.ajax({
                type:"POST",
                url:"?widget=checkempot",
                data:{
                    from_time1:from_time1,
                    to_time1:to_time1,
                    from_time2:from_time2,
                    to_time2:to_time2,
                    date:date,
                    emp_id:emp_id
                },
                success:function(data){
                    if(data == "true"){
					 $(".modal").show();
                        $.ajax({
                            type:"POST",
                            url:"?ewidget=empotapp",
                            data:{
                                from_time1:from_time1,
                                to_time1:to_time1,
                                from_time2:from_time2,
                                to_time2:to_time2,
                                date:date,
                                emp_id:emp_id
                            },
                            success:function(data){
							
                                if(data == true){
                                    alert("Overtime Applied");
                                    window.location = '?eloc=emp_ot_app';
                                }else{
                                    alert("Error While Proccessing");
                                }
                            }
                        }) 
                    }else if(data == "applied"){
                        alert("Overtime Application Failed\nError: Double Overtime Submission");
                    }else if(data == "from_time"){
				
                        alert("Overtime Application Failed\nError: Invalid Overtime (From Time)");
                    }else if(data == "to_time"){
                        alert("Overtime Application Failed\nError: Invalid Overtime (To Time)");
                    }else if(data == "no_att"){
                        alert("Overtime Application Failed\nError: No Attendance");
                    }
                }
            }) 
        }
    }
       
    function checkh(){
        if($("#from_time1").val() <= 12 ){
        
        }else{
            alert("Numeric only");
            $("#from_time1").val("");
        }
        if($("#to_time1").val() <= 12){
        
        }else{
            alert("Please key in an integer from (1-12)");
            $("#to_time1").val("");
        }
    }

    function checkm(){
        if($("#from_time2").val() <= 60){
        
        }else{
            alert("Please key in an integer from (1-60)");
            $("#from_time2").val("");
        }
        if($("#to_time2").val() <= 60){
        
        }else{
            alert("Please key in an integer from (1-60)");
            $("#to_time2").val("");
        }
    }
    
    function deleteid(id){
   
        var result = confirm("Are you sure you want to cancel this overtime application?");
        if(result == true){
            $.ajax({
                type:'POST',
                url:'?ewidget=deleteotapp',
                data:{
                    id:id
                },
                success:function(data){
                    if(data==true){
                        alert("Overtime Application Cancelled");
                        window.location='?eloc=emp_ot_app';
                    }else{
                        alert('Error While Processing');
                    }
                }
            })
        }
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