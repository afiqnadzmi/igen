<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
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
<div class="main_div" style="width:100%">
<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Employee Holiday Replacement</a>
					</h4>
				</div>
		</div>
</div>
<div id="collapseone" class="panel-collapse collapse in" >
<div class="panel-body">    
<div class="modal"></div

    <br/>
    <div class="header_text">
        <span>Holiday Replacement Application </span>
    </div>
    <div class="main_content">
        <div id="container" class="tablediv">
            <table>
                <tr>
                    <td colspan="2">
                        <input class="button" type="button" value="Apply" onclick="applyreplace()" style="width: 70px;" />
                        <input class="button" type="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
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
                    <td style="width: 200px;">Public Holiday (Date)<span class="red"> *</span></td>
                    <td>
                        <select class="input_text" name="selectdate" id="selectdate" style="width: 250px;">
                            <option value="">--Please Select--</option>
                            <?php
                            $query = "SELECT * FROM public_holiday ORDER BY occasion_name";
                            $rs = mysql_query($query);
                            while ($rows = mysql_fetch_array($rs)) {
                                $occasion_name = $rows['occasion_name'];
                                $from_date = $rows['from_date'];
								$c_year=date("Y");
								 $year=date("Y", strtotime($from_date));
                                $pubhli_id = $rows['id'];
								//$c_year="2014";
                                if($year==$c_year){
                                echo '<option  value="' . $pubhli_id . '">' . $occasion_name . '( ' . $from_date. ')</option>';
								}
                            }
                            ?>
                        </select>
                    </td>

                    <td style="padding-left: 20px; padding-right: 20px;">To</td>

                    <td style="width: 200px;">Replacement Holiday (Date)<span class="red"> *</span></td>
                    <td><input type="text" class="input_text" id="replacement"  name="replacement" value="" style="width: 250px"/></td>
                </tr>  
            </table>
        </div>
    </div>
    <?php if (isset($_COOKIE["igen_user_id"]) == true || $igen_userpermission == "1") {
        
    ?>
        <br/><br/>
        <div class="header_text">
            <span>Holiday Replacement History</span>
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
                <table style="float: right; font-size: 13px; font-weight: normal; position:relative; top:-4px">
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
                            <th style="width:30px">No.</th>
                            <th style="width: 100px;">Replacement Date</th>
                            <th style="width:250px">Public Holiday</th>
                            <th style="width:100px">Apply Date</th>
                            <th class="aligncentertable" style="width:100px">Status</th>
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
						$sql = 'SELECT * , rep.id AS repid
						FROM public_holiday as pub_holi
						inner join holiday_replacement as rep
						on pub_holi.id = rep.pub_holiday_id
						WHERE emp_id = "' .$_GET['emp']. '"' . $sqlAdd . ' ORDER BY insert_date DESC';
					}else{
						$sql = 'SELECT * , rep.id AS repid
						FROM public_holiday as pub_holi
						inner join holiday_replacement as rep
						on pub_holi.id = rep.pub_holiday_id
						WHERE emp_id = "' . $_COOKIE['igen_user_id'] . '"' . $sqlAdd . ' ORDER BY insert_date DESC';
					}
                    $rs = mysql_query($sql);

                    while ($row = mysql_fetch_array($rs)) {
                        $i = $i + 1;
                        $replace_date = $row['replace_date'];
                        $occasion_name = $row['occasion_name'];
                        $from_date = $row['from_date'];
                        $insert_date = $row['insert_date'];
                        $replacement_status = $row['replacement_status'];
                        $repid = $row['repid'];
						if($replacement_status=="Approved_lv1" || $replacement_status=="Approved_lv2" || $replacement_status=="Approved_lv3"){
								$replacement_status = $row['status2'];
							}
                        echo '<tr class="plugintr">
                    <td>' . $i . '</td>
                    <td>' . date("d-m-Y", strtotime($replace_date)) . '</td>
                    <td>' . $occasion_name . '</td>
                    <td>' . date("d-m-Y", strtotime($insert_date)) . '</td>
                    <td class="aligncentertable">' . $replacement_status . '</td>  ';

                        if ($replacement_status == "Pending") {
                            echo '<td class="aligncentertable"><a title="Cancel" href="javascript:void()" onclick="deleteid(' . $repid . ')"><i class="far fa-window-close" style="color:#000;"></i></a></td> ';
                        } else {
                            echo '<td class="aligncentertable">-</td> ';
                        }
                        echo '         
                        </tr>
                        ';
                    }
                    ?>  
                </table>
            </div>
        </div>
    <?php } ?>
</div></div></div></div>

<script type="text/javascript">
      $(".datepicker").datepicker();
    $("#fromdate, #todate").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function (){
            var from = $("#fromdate").val();
            var to = $("#todate").val();
            if(from != "" && to != ""){
                if(from > to){
                    window.location = '?eloc=holiday_replacement&from='+to+'&to='+from;
                }else{
                    window.location = '?eloc=holiday_replacement&from='+from+'&to='+to;
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
        var url= "?widget=search_emp_e_app&d="+department+"&b="+branch+"&t=hr";
        window.open(url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
    }
    
    function clearNew(){
        window.location='?eloc=holiday_replacement';
    }
  
        $("#replacement").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
   
    
    function applyreplace(){
        var replacement = $('#replacement').val();
        var selectdate = $('#selectdate').val();
       
        var is_admin = $('#is_admin').html();
        var emp_id = $('#employee_id').val();
        
        var error1 = [];
        var error2 = [];
        
        if(is_admin == "1"){
            if(emp_id == "" || emp_id == " "){
                error2.push("Employee");
            }
        }else{
            emp_id = "0";
        }
        if(selectdate == "" || selectdate == " "){
            error2.push("Public Holiday (Date)");
        }
        if(replacement == "" || replacement == " "){
            error1.push("Replacement Holiday (Date)");
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
            data2 = "Please Select :\n"+error_data2;
        }
                
        if(error1.length > 0 || error2.length > 0){
            alert(data1+data2);
        }else{ 
         	 $(".modal").show();		
            $.ajax({
                type:'POST',
                url:"?ewidget=holidayreplacement",
                data:{
                    selectdate:selectdate,
                    replacement:replacement,
                    emp_id:emp_id
                },
                success:function(data){
                    if(data==true){
                        alert("Holiday Replacement Applied");
                        window.location='?eloc=holiday_replacement';
                    }else{
                        alert("Error While Processing");
                    }
                }
            });    
        }
    }
    
    function deleteid(repid){

        var result = confirm("Are you sure you want to cancel this holiday replacement application?");
       
        if(result == true){
            $.ajax({
                type:'POST',
                url:'?ewidget=deleteholidayreplace',
                data:{
                    repid:repid
                },

                success:function(data){
                    if(data==true){
                        alert("Holiday Replacement Application Cancelled");
                        window.location='?eloc=holiday_replacement';
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