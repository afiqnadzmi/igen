<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn.
  Bhd. */
  
  if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1") {
  
    $is_admin = "1";
    $upload_id = $_COOKIE['igen_id']; 
} else {
    $is_admin = "0";
    $upload_id = $_COOKIE['igen_user_id'];
}
?>
<script type="text/javascript" charset="utf-8">
    $(function() {
        oTable = $('#tableplugin').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
</script>
<?php
if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1") {
    $is_admin = "1";
} else {
    $is_admin = "0";
}
?>
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
<div class="main_div">
    <div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Employee Loan</a>
					</h4>
				</div>
		</div>
	</div>
	<div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">  
			<br>
			<div class="modal"></div>
			<div class="header_text">
			
				<span>Loan Application</span>
			</div>
			<div class="main_content">
				<div id="container" class="tablediv">
					<table>
						<tr>
							<td colspan="2">
								<input type="button" class="button" value="Apply" onclick="applyloan()" style="width: 70px;" />
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
							<td style="width: 200px;">Loan Type <span class="red"> *</span></td>
							<td style=" padding-right: 50px;">
							
							<select id="type" style="width: 250px;">
							<option value=""> Please Select Loan type </option> 
						<?php
							$sql = "SELECT * FROM loan_management";
							$sql_result = mysql_query($sql);

							while ($newArray = mysql_fetch_array($sql_result)) {
								echo'<option value="'.$newArray ['name'].'">'.$newArray ['name'].'</option>';
							}
						?>
						</select>
							</td>
							<td rowspan="4" style="width: 200px; vertical-align: top;">Reason for Loan<span class="red"> *</span></td>
							<td rowspan="4"><TEXTAREA id="reason" NAME="reason" style="width: 250px; height: 100px;"></TEXTAREA></td>
						</tr>

						<tr>
							<td>Loan Amount (RM)<span class="red"> *</span></td>
							<td><input type="text" class="input_text" id="amount" name="amount" style="width: 250px" onchange="cal()"/></td>
						</tr>

						<tr>
							<td>Installment (Month)<span class="red"> *</span></td>
							<td><input type="text"  class="input_text" id="repay" style="width: 250px" onchange="cal()"/></td>
						</tr>

						<tr>
							<td>Installment/Month (RM)</td>
							<td><input type="text" class="input_text" id="installment" name="installment" readonly style="width: 250px"/></td>
						</tr> 
						<tr>
							<td>Guarantor<span class="red"> *</span></td>
							<td><input type="text"  class="input_text" id="guarantor" style="width: 250px" /></td>
						</tr>
						 <!-- <tr>
							<td style="vertical-align: top;">Attachment</td>
							<td>
								<input id="file_upload" name="file_upload" type="file" multiple="true" style="width:100px" />
								<input type="text" id="uploaded_img" style="width:250px; display: none;" readonly />
							</td>
						</tr> -->
					</table>
				</div>
			</div>
	       </br></br></br>
			<?php if (($_COOKIE["igen_user_id"])== true || $igen_userpermission == "1") {
			?>
			 
				<div class="header_text">
					<span>Loan History</span>
					<span style="float: right; font-size: 13px; font-weight: normal; position:relative; top:-4px">
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
					
						<table id="tableplugin" class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
							<thead>
								<tr class="pluginth">
									<th style="width: 30px;">No.</th>
									<th style="width:100px">Loan Type</th>
									<th class="alignrighttable" style="width:100px">Loan Amount (RM)</th>
									<th class="aligncentertable" style="width:100px">Installment (Month)</th>
									<th style="width:150px">Guarantor</th>
									<th style="width: 100px;">Apply Date</th>
									<!-- <th style="width: 50px;">Attachment</th> -->
									<th class="aligncentertable" style="width:100px">Status</th>
									<th class="aligncentertable" style="width: 100px;">Action</th>
								</tr>
							</thead>
							<?php
							if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
								$sqlAdd = " AND loan_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
							} else {
								$sqlAdd = " AND DATE_SUB(CURDATE(),INTERVAL 60 DAY) <= loan_date";
							}
							if($_GET['emp']!="" && $igen_a_hr == "a_hr_edit"){
								$sql = 'SELECT * FROM employee_loan WHERE emp_id = "' .$_GET['emp']. '"' . $sqlAdd . ' ORDER BY loan_date DESC';
							}else{
								$sql = 'SELECT * FROM employee_loan WHERE emp_id = "' . $_COOKIE['igen_user_id'] . '"' . $sqlAdd . ' ORDER BY loan_date DESC';
							}
							$rs = mysql_query($sql);

							while ($row = mysql_fetch_array($rs)) {
								$i = $i + 1;
								$type_of_loan = $row['type_of_loan'];
								$loan_amount = $row['loan_amount'];
								$installment = $row['installment'];
								$rep_month = $row['rep_month'];
								$reason_for_loan = $row['reason_for_loan'];
								$loan_status = $row['loan_status']; 
								$loan_date = $row['loan_date'];
								$img_path =$row['img_path'];
								$loanid = $row['id'];
								$guarantor = $row['guarantor'];
								if($loan_status=="Approved_lv1" || $loan_status=="Approved_lv2" || $loan_status=="Approved_lv3"){
									$loan_status = $row['status2'];
								}
								$mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $loanid . ')" onMouseout="emp_app_hide()"';

								echo '<tr class="plugintr">';
								echo'<td>' . $i . '</td>
							<td ' . $mouseover . '>' . $type_of_loan . '</td>
							<td class="alignrighttable cursor_pointer" onMouseover="emp_app(' . $loanid . ')" onMouseout="emp_app_hide()">' . number_format($loan_amount, 2, '.', '') . '</td>
							<td class="aligncentertable">' . $rep_month . '</td>
							<td>' . $guarantor . '</td>
							<td>' . date('d-m-Y', strtotime($loan_date)) . '</td>';
							if($img_path!=null){
							//echo '<td class="aligncentertable"><a title="View" href="uploads/loan/' .$img_path. '" target="_blank"><i class="fas fa-download" style="color:#000;"></i></a></td>';
							}else{
							//echo '<td class="aligncentertable">-</td>';
							}
							echo '<td class="aligncentertable">' . $loan_status . '</td>';

								if ($loan_status == "Pending") {
									echo '<td class="aligncentertable"><a title="Cancel" href="javascript:void()" onclick="deleteid(' . $loanid . ')"><i class="far fa-window-close" style="color:#000;"></i></a></td> ';
								} else {
									echo '<td class="aligncentertable">-</td> ';
								}
								echo '</tr>';
							}
							?>  
						</table>
						
					</div>
				</div>
				<div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Loan Type & Loan Amount</span> to see more details *</div>
		   
	
	 <?php   
    } else { ?>
			<div class="header_text">
				<span>Loan History</span>
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
								<th>Loan Type</th>
								<th class="alignrighttable" style="width:150px">Loan Amount (RM)</th>
								<th class="aligncentertable" style="width:150px">Installment (Month)</th>
								<th style="width:150px">Guarantor</th>
								<th style="width: 120px;">Apply Date</th>
								 <!--<th style="width: 120px;">Attachment</th>-->
								<th class="aligncentertable" style="width:150px">Status</th>
								<th class="aligncentertable" style="width: 100px;">Action</th>
							</tr>
						</thead>
						
							
						<?php
						if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
							$sqlAdd = " AND loan_date BETWEEN '" . $_GET["from"] . "' AND '" . $_GET["to"] . "'";
						} else {
							$sqlAdd = " AND DATE_SUB(CURDATE(),INTERVAL 60 DAY) <= loan_date";
						}
						$sql = 'SELECT * FROM employee_loan WHERE emp_id = "' . $_COOKIE['igen_user_id'] . '"' . $sqlAdd . ' ORDER BY loan_date DESC';
						$rs = mysql_query($sql);

						while ($row = mysql_fetch_array($rs)) {
							$i = $i + 1;
							$type_of_loan = $row['type_of_loan'];
							$loan_amount = $row['loan_amount'];
							$installment = $row['installment'];
							$rep_month = $row['rep_month'];
							$reason_for_loan = $row['reason_for_loan'];
							$loan_status = $row['loan_status'];
							$loan_date = $row['loan_date'];
							$img_path =$row['img_path'];
							$loanid = $row['id'];
							$guarantor = $row['guarantor'];

							$mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $loanid . ')" onMouseout="emp_app_hide()"';

							echo '<tr class="plugintr">';
							echo'<td>' . $i . '</td>
						<td ' . $mouseover . '>' . $type_of_loan . '</td>
						<td class="alignrighttable cursor_pointer" onMouseover="emp_app(' . $loanid . ')" onMouseout="emp_app_hide()">' . number_format($loan_amount, 2, '.', '') . '</td>
						<td class="aligncentertable">' . $rep_month . '</td>
						<td>' . $guarantor . '</td>
						<td>' . $loan_date . '</td>';
						if($img_path!=null){
						//echo '<td class="aligncentertable"><a title="View" href="uploads/loan/' .$img_path. '" target="_blank"><i class="fas fa-download" style="color:#000;"></i></a></td>';
						}else{
						//echo '<td class="aligncentertable"></td>';
						}
						echo '<td class="aligncentertable">' . $loan_status . '</td>';

							if ($loan_status == "Pending") {
								echo '<td class="aligncentertable"><a title="Cancel" href="javascript:void()" onclick="deleteid(' . $loanid . ')"><i class="far fa-window-close" style="color:#000;"></i></a></td> ';
							} else {
								echo '<td class="aligncentertable">-</td> ';
							}
							echo '</tr>';
						}
						?>  
						
					</table>
				</div>
			</div>
			<div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Loan Type & Loan Amount</span> to see more details *</div>
			
		</div>
	</div>
	<?php } ?>
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
    
    $("#fromdate, #todate").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function (){
            var from = $("#fromdate").val();
            var to = $("#todate").val();
            if(from != "" && to != ""){
                if(from > to){
                    window.location = '?eloc=emp_loan_app&from='+to+'&to='+from;
                }else{
                    window.location = '?eloc=emp_loan_app&from='+from+'&to='+to;
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
        var url= "?widget=search_emp_e_app&d="+department+"&b="+branch+"&t=loan";
        window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
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
                action:"loan"
            },
            success:function(data){ 
                $("#popup").html(data);
            }  
        });   
        $(document).mousemove(function(e){
            $('#popup').show();
            $('#popup').css({
                left:  e.pageX + 20,
                top:   e.pageY + total
            });
        });
    }
    
    function emp_app_hide(){
        $(document).mousemove(function(){
            $('#popup').hide();
        });
    }
    
    function clearNew(){
        window.location='?eloc=emp_loan_app';
    }
    function cal(){
        var loan_amount = $('#amount').val();
        var repay = $('#repay').val();
        var total = 0;
        
        var month = repay;
        total = loan_amount / month;
        var dec2_total = 0;
        dec2_total = total.toFixed(2);
        if (dec2_total != 'Infinity')
        {
            $('#installment').val(dec2_total);
        }
        else
        {
            $('#installment').val(0);
        }
    }
    
    function applyloan(){
	
        var type_of_loan = $('#type').val();
        var reason_for_loan = $('#reason').val();
        var loan_amount = $('#amount').val();
        var installment = $('#installment').val();
        var repay = $('#repay').val();
        var repay_month = repay;
        var uploaded_img = $('#uploaded_img').val();
        var is_admin = $('#is_admin').html();
        var emp_id = $('#employee_id').val();
		var guarantor = $("#guarantor").val();
		
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
        if(type_of_loan == "" || type_of_loan == " "){
            error1.push("Loan Type");
        }
        if(loan_amount == "" || loan_amount == " "){
            error1.push("Loan Amount");
        }else{
            if(loan_amount.match(/^\d+$/) || loan_amount.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Loan Amount");
            }
        }
        if(repay == "" || repay == ""){
            error1.push("Installment (Month)")
        }else{
            if(repay.match(/^\d+$/)){   
            }else{
                error2.push("Installment (Month)");
            }
        }
        if(reason_for_loan == "" || reason_for_loan == " "){
            error1.push("Reason for Loan");
        }
		if(guarantor == "" || guarantor == " "){
            error1.push("Guarantor");
        }
        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
        var error_data3 = '';
        for(var i=0; i< error3.length; i++){
            error_data3 = error_data3 + error3[i] + "; "
        }
                
        var data1 = "";
        var data2 = "";
        var data3 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Check :\n"+error_data2+"\n\n";
        }
        if(error3.length > 0){
            data3 = "Please Select :\n"+error_data3;
        }
                
        if(error1.length > 0 || error2.length > 0 || error3.length > 0){
            alert(data1 + data2 + data3);
        }else{
		
		 $(".modal").show();
            $.ajax({
                type:'POST',
                url:"?ewidget=emploanapp",
                data:{
                    type_of_loan:type_of_loan,
                    reason_for_loan:reason_for_loan,
                    loan_amount:loan_amount,
                    installment:installment,
                    repay_month:repay_month,
					uploaded_img:uploaded_img,
					guarantor:guarantor,
                    emp_id:emp_id
                },
                success:function(data){
                   if(data==true){
                        alert("E-Loan Applied");
                        window.location='?eloc=emp_loan_app';
                    }else{
                        alert("Error While Processing");
                    }
                }

            });
        }
    }
    
    function deleteid(loanid){

        var result = confirm("Are you sure you want to cancel this loan application?");
        if(result == true){
            $.ajax({
                type:'POST',
                url:'?ewidget=deleteloanapp',
                data:{
                    loanid:loanid
                },
                success:function(data){
                    if(data==true){
                        alert("E-Loan Application Cancelled");
                        window.location='?eloc=emp_loan_app';
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