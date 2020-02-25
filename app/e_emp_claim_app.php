<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php


if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1") {
  
    $is_admin = "1";
    $upload_id = $_COOKIE['igen_id'];
} else {
    $is_admin = "0";
    $upload_id = $_COOKIE['igen_user_id'];
}
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
.main_div.claim {
    margin-left: -11px;
    border: none !important;
}
</style>
<div class="main_div">
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Employee Claim</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">        
			<br>
			<div class="modal"><!-- Place at bottom of page --></div>
			<div class="header_text">
				<span>Claim Application</span>
			</div>
			<div class="main_content">
				<div id="container" class="tablediv">
					<table>
						<tr>
							<td colspan="2">
								<input type="button" class="button" value="Apply" onclick="applyclaim()" style="width: 70px;" />
								<input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
								<span id="is_admin" style="display: none;"><?php echo $is_admin; ?></span>
							</td>
						</tr>
						<?php if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1") {
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
							<tr id="tr_department">
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
							<tr><td colspan="4" style="border-bottom: 1px solid gray;">&nbsp;</td></tr>
							<tr><td colspan="4" style="padding-bottom: 5px;"></td></tr>
						<?php } ?>
						<tr>
							<?php
							 //Get all the allowance
								$sql_claim = "select * from claim_payroll";
								$result_claim = mysql_query($sql_claim);
						    ?>
							<td style="width: 200px;">Claim Type<span class="red"> *</span></td>
							<td style=" padding-right: 50px;">
							<select  class="input_text"s name="claim_title" id="claim_title" style="width: 250px;">
							<option  value=""> Please select claim type</option>
							<?php
								while ($rs_claim = mysql_fetch_array($result_claim)) {						
									echo '<option value="' . $rs_claim['id'] . '">' .$rs_claim['claim_name']. '</option>';
								}
							?>
							</select>
							</td>
							<td rowspan="4" style="width: 200px; vertical-align: top;"><span class="red"> *</span>Remark</td>
							<td rowspan="4" style="vertical-align: top;"><TEXTAREA id="claim_remark" NAME="claim_remark" style="width: 250px; height: 100px;"></TEXTAREA></td>
						</tr>
                         <tr id="clinic_name" style="display:none">
							<td>Clinic Name<span class="red"> *</span></td></td>
							<td><input type="text" class="input_text" id="clinic" name="clinic" style="width: 250px" /></td>
						</tr>
						<tr>
							<td>Receipt Number<span class="red"> *</span></td></td>
							<td><input type="text" class="input_text" id="claim_number" name="claim_number" style="width: 250px" /></td>
						</tr>

						<tr>
							<td>Claim Date<span class="red"> *</span></td>
							<td><input type="text"  class="input_text" id="claim_date" style="width: 250px" /></td>
						</tr>

						<tr>
							<td>Amount (RM)<span class="red"> *</span></td>
							<td><input type="text" class="input_text" id="claim_amount" name="claim_amount" style="width: 250px"/></td>
						</tr>
						<tr>
							<td style="vertical-align: top;">Attachment</td> 
							 <td id="dropFileForm">
								 <input type="file" name="files[]" id="fileInput" multiple onchange="addFiles(event)">

								  <label for="fileInput" id="fileLabel" ondragover="overrideDefault(event);fileHover();" ondragenter="overrideDefault(event);fileHover();" ondragleave="overrideDefault(event);fileHoverEnd();" ondrop="overrideDefault(event);fileHoverEnd();
										addFiles(event);">
									<img src="images/download.png"><br>
									 
									<span id="fileLabelText">
									<input type="text" id="uploaded_img" style="width:250px;" value="Choose a file or drag it here" readonly />
									</span>
									<br>
									<span id="uploadStatus"></span>
								  </label>
								<!--<input id="file_upload" name="file_upload" type="file" multiple="true" style="width:100%" />-->


						   </td>
						</tr> 
					</table>
				</div>
			</div>
			</br></br>
			<?php if (isset($_COOKIE["igen_user_id"]) == true || $igen_userpermission == "1") {
			?>
			
			 <div class="header_text">
					<span>Claim History</span>
					<span style="float: right; font-size: 12px; margin-top:-6px; font-weight: normal;">
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
								<td >Date Range&nbsp;<input type="text" id="fromdate" style="width: 90px;" value="<?php echo $from; ?>" />&nbsp;-&nbsp;<input type="text" id="todate" style="width: 90px;" value="<?php echo $to; ?>" /></td>
							</tr>
						</table>
					</span>
				</div>
				<div class="main_content">
					<div class="plugindiv">
					<div style="margin-bottom:3%">
						<table id="tableplugin" class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
							<thead>
								<tr class="pluginth">
									<th style="width: 30px;">No.</th>
									<th>Claim Type</th>
									<th>Clinic Name</th>
									<th style="width: 150px;">Receipt Number</th>
									<th style="width: 120px;">Claim Date</th>
									<th class="alignrighttable" style="width: 120px;">Amount (RM)</th>
									<th style="width: 120px;">Apply Date</th>
									<th style="width: 120px;">Attachment</th>
									<th class="aligncentertable" style="width: 120px;">Status</th>
									<th class="aligncentertable" style="width: 100px;">Action</th>
								</tr>
							</thead>
							<?php
							if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
								$sqlAdd = ' AND insert_date BETWEEN "' . $_GET["from"] . '" AND "' . $_GET["to"] . '"';
							} else {
								$sqlAdd = ' AND DATE_SUB(CURDATE(),INTERVAL 60 DAY) <= insert_date';
							}
							if($_GET['emp']!="" && $igen_a_hr == "a_hr_edit"){
								$sql = 'SELECT * FROM employee_claim WHERE emp_id = "' .$_GET['emp']. '"' . $sqlAdd . ' ORDER BY insert_date DESC';
							}else{
								$sql = 'SELECT * FROM employee_claim WHERE created_by="' . $_COOKIE["igen_user_id"] . '" AND emp_id = "' . $_COOKIE["igen_user_id"] . '"' . $sqlAdd . ' ORDER BY insert_date DESC';
							}
							$rs = mysql_query($sql);

							while ($row = mysql_fetch_array($rs)) {
								$i = $i + 1;
								$claim_item_title = $row['claim_item_title'];
								$claim_no = $row['claim_no'];
								$insert_date = $row['insert_date'];
								$claim_date = $row['claim_date'];
								$amount = $row['amount'];
								$remark = $row['remark'];
								$claim_status = $row['claim_status'];
								$img_path =$row['img_path'];
								$claimid = $row['id'];
								$clinic = $row['clinic'];
								if($claim_status=="Approved_lv1" || $claim_status=="Approved_lv2" || $claim_status=="Approved_lv3"){
									$claim_status = $row['status2'];
								}
								$mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $claimid . ')" onMouseout="emp_app_hide()"';

								echo '<tr class="plugintr">';
								echo'<td>' . $i . '</td>
						<td ' . $mouseover . '>' . $claim_item_title . '</td>
						<td ' . $mouseover . '>' . $clinic. '</td>
						<td ' . $mouseover . '>' . $claim_no . '</td>
						<td>' . date("d-m-Y", strtotime($claim_date )). '</td>
						<td class="alignrighttable">' . number_format($amount, 2, '.', '') . '</td>
						<td>' . date('d-m-Y', strtotime($insert_date)) . '</td>';
						if($img_path!=null){
							echo '<td class="aligncentertable"><a title="View" href="uploads/claim/' .$img_path. '" target="_blank"><i class="fas fa-download" style="color:#000;"></i></a></td>';
							}else{
							echo '<td class="aligncentertable"></td>';
							}
						
						echo '<td class="aligncentertable">' . $claim_status . '</td> ';

								if ($claim_status == "Pending") {
									echo '<td class="aligncentertable"><a title="Cancel" href="javascript:void()" onclick="deleteid(' . $claimid . ')"><i class="far fa-window-close" style="color:#000;"></i></a></td> ';
								} else {
									echo ' <td class="aligncentertable">-</td> ';
								}
								echo '</tr>';
							} 
							?>  
							
						</table>
						</div>
					</div>
				</div>
				<div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Claim Title & Claim Number</span> to see more details *</div>
	
      <?php  
    } else { ?>
					<div class="header_text">
						<span>Employee Claim History</span>
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
							<table id="tableplugin" style="border-collapse: collapse;width: 100%; font-size: 13px;" class="TFtable">
								<thead>
									<tr class="pluginth">
										<th style="width: 30px;">No.</th>
										<th>Claim Type</th>
										<th>Clinic Name</th>
										<th style="width: 150px;">Receipt Number</th>
										<th style="width: 120px;">Claim Date</th>
										<th class="alignrighttable" style="width: 120px;">Amount (RM)</th>
										<th style="width: 120px;">Apply Date</th>
									
										<th class="aligncentertable" style="width: 120px;">Status</th>
										<th class="aligncentertable" style="width: 100px;">Action</th>
									</tr>
								</thead>
								<?php
								if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
									$sqlAdd = ' AND insert_date BETWEEN "' . $_GET["from"] . '" AND "' . $_GET["to"] . '"';
								} else {
									$sqlAdd = ' AND DATE_SUB(CURDATE(),INTERVAL 60 DAY) <= insert_date';
								}
								$sql = 'SELECT * FROM employee_claim WHERE emp_id = "' . $_COOKIE['igen_user_id'] . '"' . $sqlAdd . ' ORDER BY insert_date DESC';
								$rs = mysql_query($sql);

								while ($row = mysql_fetch_array($rs)) {
									$i = $i + 1;
									$claim_item_title = $row['claim_item_title'];
									$claim_no = $row['claim_no'];
									$insert_date = $row['insert_date'];
									$claim_date = $row['claim_date'];
									$amount = $row['amount'];
									$remark = $row['remark'];
									$claim_status = $row['claim_status'];
									$claimid = $row['id'];
									$clinic = $row['clinic'];
									if($claim_status=="Approved_lv1" || $claim_status=="Approved_lv2" || $claim_status=="Approved_lv3"){
										$claim_status = $row['status2'];
									}

									$mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $claimid . ')" onMouseout="emp_app_hide()"';

									echo '<tr class="plugintr">';
									echo'<td>' . $i . '</td>
							<td ' . $mouseover . '>' . $claim_item_title . '</td>
							<td ' . $mouseover . '>' . $clinic. '</td>
							<td ' . $mouseover . '>' . $claim_no . '</td>
							<td>' . $claim_date . '</td>
							<td class="alignrighttable">' . number_format($amount, 2, '.', '') . '</td>
							<td>' . date('Y-m-d', strtotime($insert_date)) . '</td>
							<td class="aligncentertable">' . $claim_status . '</td> ';

									if ($claim_status == "Pending") {
										echo '<td class="aligncentertable"><a href="javascript:void()" onclick="deleteid(' . $claimid . ')">Revoke</a></td> ';
									} else {
										echo ' <td class="aligncentertable">-</td> ';
									}
									echo '</tr>';
								}
								?>  
							</table>
						</div>
					</div>
					<div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Claim Title & Claim Number</span> to see more details *</div>

    <?php } ?>

</div>
</div>
</div>
<div id="popup"></div>

<style type="text/css">
    #popup{
        position: absolute; 
        float: left; 
        display: none; 
        width: 350px; 
        border: 1px solid mistyrose;
        background-color: mistyrose;
        padding: 15px 20px 10px 20px;
        -moz-box-shadow: 0 0 5px #mistyrose;
        -webkit-box-shadow: 0 0 5px #mistyrose;
        box-shadow: 0 0 5px #mistyrose;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -khtml-border-radius: 5px;
        border-radius: 5px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
		$("#claim_title").change(function(){
			if($(this).val()==7){
				$("#clinic_name").show();
			}else{
				$("#clinic_name").hide();
			}
		});
	})
    $("#fromdate, #todate").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function (){
            var from = $("#fromdate").val();
            var to = $("#todate").val();
            
            if(from != "" && to != ""){
                if(from > to){
                    window.location = '?eloc=emp_claim_app&from='+to+'&to='+from;
                }else{
                    window.location = '?eloc=emp_claim_app&from='+from+'&to='+to;
                }
            }
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
        var url= "?widget=search_emp_e_app&d="+department+"&b="+branch+"&t=claim";
        window.open(url,'mywindow','location=1, status=1, scrollbars=1, width=750, height=700');
    }
    
    function emp_app(id){ 
        var doc = $(document).height(); 
        var popup = parseInt($(".plugindiv").height())+parseInt($(".plugindiv").position().top+parseInt($("#popup").height()));
        var difference = doc-popup;
        var total;
        
        if(difference >= 0){
            total = 0;
        }else{
            total = difference;
        }
        
        $.ajax({
            type:'POST',
            url:'?widget=emp_app_info',
            data:{
                id:id,
                action:"claim"
            },
            success:function(data){ 
                $("#popup").html(data);
            }  
        });   
        $(document).mousemove(function(e){
            $('#popup').show();
            $('#popup').css({
                left: e.pageX + 20,
                top: e.pageY + total
            });
        });
    }

    function emp_app_hide(){
        $(document).mousemove(function(){
            $('#popup').hide();
        });
    }
	
 //$("#claim_date").click(function(){
 //alert("hi")
 /*
var d = new Date();

var month = d.getMonth()+1;
var day = d.getDate();
 
var year=d.getFullYear();


var days = Math.round(((new Date(year, month))-(new Date(year, month-1)))/86400000);

var min= (days - day + 1) ;
*/
var d = new Date(); 
var c =new Date(); 
d.setMonth(d.getMonth() - 2);


  $("#claim_date").datepicker({
        dateFormat: 'dd-mm-yy',
        changeMonth: true,
        changeYear: true,
		  maxDate:c,
		  minDate:d, // 0 days offset = today
        
		numberOfMonths: 1,
        
      //  minDate: "dateToday",
		// minDate: min,
		// inline: false,
            
       
    });
                    
                
         //   });
   
	

    function clearNew(){
        window.location='?eloc=emp_claim_app';
    }

    function applyclaim(){
	
        var claim_title =$('#claim_title').val();//claim Id
		var claim_text =$('#claim_title option:selected').text(); // Claim Text
        var claim_number = $('#claim_number').val();
        var claim_date = $('#claim_date').val();
        var claim_amount = $('#claim_amount').val();
        var claim_remark = $('#claim_remark').val();
        var uploaded_img = $('#uploaded_img').val();
		var clinic = $("#clinic").val();
        var is_admin = $('#is_admin').html();
        var emp_id = $('#employee_id').val();
		var files = $('#fileInput')[0].files[0];
        var formData = new FormData();
	    formData.append("claim_number",claim_number);
		 formData.append("fileInput",files);
		formData.append("claim_date",claim_date);
		formData.append("claim_amount",claim_amount);
		formData.append("claim_remark",claim_remark);
		formData.append("claim_title",claim_title);
		formData.append("claim_title",claim_title);
		formData.append("claim_text",claim_text);
		formData.append("emp_id",emp_id);
		formData.append("clinic",clinic);
		var ext_arr = ['png','jpg','gif','pdf','PNG','JPG','GIV','PDF'];
		var ext =$('#uploaded_img').val().replace(/^.*\./, '');
		if(jQuery.inArray(ext, ext_arr)==-1 && uploaded_img!=""){
			alert("Please upload image or pdf file only");
			exit;
		}
        var error1 = [];
        var error2 = [];
        var error3 = [];
        if(is_admin == "1"){
            if(emp_id == "" || emp_id == " "){
                error3.push("Employee");
            }
        }else{
            emp_id = "0";
        }
        if(claim_title == "" || claim_title == " "){
            error1.push("Claim Title");
        }
		if(clinic == "" || clinic == " "){
			if(claim_title==7){
				error1.push("Clinic Name");
			}
        }
        if(claim_date == "" || claim_date == " "){
            error1.push("Claim Date");
        }
        if(claim_amount == "" || claim_amount == " "){
            error1.push("Claim Amount");
        }else{
            if(claim_amount.match(/^\d+$/) || claim_amount.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Claim Amount");
            }
        }
        var error_data1 = '';
        for(var i=0;
        i< error1.length;
        i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0;
        i< error2.length;
        i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
        var error_data3 = '';
        for(var i=0;
        i< error3.length;
        i++){
            error_data3 = error_data3 + error3[i] + "; "
        }

        var data1 = "";
        var data2 = "";
        var data3 = "";
        var data4 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Check :\n"+error_data2+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3+"\n\n";
        }

        if(error1.length > 0 || error2.length > 0 || error3.length > 0){
            alert(data1 + data2 + data3 + data4);
        }else{
		 $(".modal").show();
            $.ajax({
                type:'POST',
                url:"?ewidget=empclaimapp",
                data:{
                    claim_title:claim_title,
                    claim_number:claim_number,
                    claim_date:claim_date,
                    claim_amount:claim_amount,
                    claim_remark:claim_remark,
                    uploaded_img:uploaded_img,
					claim_text:claim_text,
					clinic:clinic,
                    emp_id:emp_id
                },
				data: formData,
				processData: false,
				contentType: false,
                success:function(data){
                    if(data==true){
                        alert("E-Claim Applied");
                        window.location='?eloc=emp_claim_app';
                    }else{
                        alert("Error While Processing");
                    }
                }
            });
        }
    }

    function deleteid(claimid){

        var result = confirm("Are you sure you want to cancel this claim application?");
        if(result == true){
            $.ajax({
                type:'POST',
                url:'?ewidget=deleteclaimapp',
                data:{
                    claimid:claimid
                },
                success:function(data){
                    if(data==true){
                        alert("E-Claim Application Cancelled");
                        window.location='?eloc=emp_claim_app';
                    }else{
                        alert('Error While Processing');
                    }
                }
            })
        }
    }

</script>    
<script>
	function editProfile(){
		var id =$("#em_id").val();
		//window.location='?eloc=emp_view_profile&id='+id;
    }
		
	var dropFileForm = document.getElementById("dropFileForm");
	//var #uploaded_img = document.getElementById("uploaded_img");
	var uploadStatus = document.getElementById("uploadStatus");
	var fileInput = document.getElementById("fileInput");
	var droppedFiles;

	function overrideDefault(event) {
	  event.preventDefault();
	  event.stopPropagation();
	}

	function fileHover() {
	  dropFileForm.classList.add("fileHover");
	  
	}

	function fileHoverEnd() {
	  dropFileForm.classList.remove("fileHover");
	}

	function addFiles(event) {
	  droppedFiles = event.target.files || event.dataTransfer.files;
	  //$("input[type='file']").prop("files", e.originalEvent.dataTransfer.files);
	  showFiles(droppedFiles);
	}

	function showFiles(files) {
		$("input[type='file']").prop("files", files);
	  if (files.length > 1) {
		 $("#uploaded_img").val(files.length + " files selected");
		//fileLabelText.innerText = files.length + " files selected";
	  } else {
		 $("#uploaded_img").val(files[0].name);
		//fileLabelText.innerText = files[0].name;
	  }
	}

	function changeStatus(text) {
	  uploadStatus.innerText = text;
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