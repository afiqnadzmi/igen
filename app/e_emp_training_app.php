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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Employee Training</a>
					</h4>
				</div>
		</div>
	</div>
<div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
<div class="modal"></div>


    <?php
  
        if (isset($_GET["emp"]) == true && $_GET["emp"] != "" && $igen_a_hr == "a_hr_edit") {
            $queryEmp = mysql_query('SELECT full_name, company_id, branch_id, dep_id FROM employee WHERE id=' . $_GET["emp"]);
            $rowEmp = mysql_fetch_array($queryEmp);
            $emp_id = $_GET["emp"];
        } else {
        $emp_id = $_COOKIE['igen_user_id'];
    }
    $sql2 = 'SELECT * FROM employee WHERE id = "' . $emp_id . '" ';
    $rs2 = mysql_query($sql2);
    $row2 = mysql_fetch_array($rs2);
    $pos_id = $row2['position_id'];
 
	
    /*
    if (isset($_GET["from"]) == true && isset($_GET["to"]) == true) {
        $sqlAdd = ' AND from_date BETWEEN "' . $_GET["from"] . '" AND "' . $_GET["to"] . '"';
    } else {
        $sqlAdd = ' AND DATE_SUB(CURDATE(),INTERVAL 60 DAY) <= from_date';
    }
	*/
  
    $sql = 'SELECT * FROM training WHERE pos_id="'.$pos_id.'"  OR pos_id LIKE"%'.$pos_id.',%" ORDER BY from_date DESC';
    $rs = mysql_query($sql);

    ?>
    <div class="header_text">
        <span>Training Application</span>            
        <?php if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1") {
			
            
        } else {  ?>
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
        <?php } ?>
    </div>
    <!--<div class="main_content">
        <div id="container" class="tablediv">
            <span id="is_admin" style="display: none;"><?php echo $is_admin; ?></span>
            <table> 
                <?php if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1") { ?>
                    <tr>
                        <td style="width: 200px;">Company<span class="red"> *</span></td>
                        <td>
                            <select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)">
                                <option value="">--Please Select--</option>
                                <?php
                                $queryCompany = mysql_query('SELECT * FROM company ORDER BY code');
                                while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                    if (isset($_GET["emp"]) == true && $_GET["emp"] != "") {
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
                                if (isset($_GET["emp"]) == true && $_GET["emp"] != "") {
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
                            <input type="hidden" id="employee_id" value="<?php echo $emp_id; ?>" />
                            <input type="text" id="employee_name" style="width: 250px;" onclick="add_emp_list()" value="<?php echo $rowEmp["full_name"]; ?>" />
                        </td>
                    </tr>
					 
                <?php } ?>
            </table>
        </div>
    </div>-->
    <div class="main_content">
        <div class="plugindiv">
            <table id="tableplugin" class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
                <thead>
                    <tr class="pluginth">
                        <th style="width:10px">No.</th>
                        <th style="width:200px">Training Name</th>
                        <th style="width:100px">Start Date</th>
                        <th style="width:100px">End Date</th>
                        <th style="width:200px">Venue</th>
						<th style="width:200px">Description</th>
                        <th style="width:100px">Apply Date</th>
                        <th class="aligncentertable" style="width:100px;">Status</th>
                        <th class="aligncentertable" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <?php
                $i = 1;
                while ($row = mysql_fetch_array($rs)) {
						
                    $training_id = $row['id'];
                    $training_name = $row['training_name'];
                    $position = $row['position'];
                    $from_date = $row['from_date'];
                    $to_date = $row['to_date'];
                    $start_time = $row['start_time'];
                    $venue = substr($row['venue'], 0, 25) . '...';
                    $train_desc = $row['train_desc'];
                    $request_date = $row['request_date'];
					$desc=$row['train_desc'];

                   // $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $training_id . ')" onMouseout="emp_app_hide()"';

                    $sql3 = 'SELECT id, request_status,status2, request_date FROM employee_training WHERE training_id = ' . $training_id . ' AND employee_id = ' . $emp_id;
                    $query3 = mysql_query($sql3);
                    $row3 = mysql_fetch_array($query3);
                    $num_rows3 = mysql_num_rows($query3);

                    $emptrain_id = $row3["id"];
                    $request_status = $row3["request_status"];
                    $request_date = date('d-m-Y', strtotime($row3["request_date"]));
                    if($request_status=="Approved_lv1" || $request_status=="Approved_lv2" || $request_status=="Approved_lv3"){
							$request_status = $row3['status2'];
					 }
                    if ($num_rows3 == 0) {
                        $request_status = "-";  
                        $request_date = "-";
                    }

                    echo '<tr class="plugintr">';
                    echo '<td>' . $i . '</td>
                      <td ' . $mouseover . '>' . $training_name . '</td>
                      <td ' . $mouseover . '>' . date('d-m-Y', strtotime($from_date)) . '</td>
                      <td ' . $mouseover . '>' . date('d-m-Y', strtotime($to_date)) . '</td>
                      <td>' . $venue . '</td>
					  <td>' . $desc. '</td>
                      <td>' . $request_date . '</td>
                      <td class="aligncentertable">' . $request_status . '</td>';

                    if ($num_rows3 == 0) {
                        echo '<td class="aligncentertable"><a href="javascript:void()" onclick="applytrain(' . $training_id . ')">Apply</a></td>';
                    } else {
                        if ($request_status == "Pending") {
                            echo '<td class="aligncentertable"><a title="Cancel" href="javascript:void()" onclick="deleteid(' . $emptrain_id . ')"><i class="far fa-window-close" style="color:#000;"></i></a></td>';
                        } else {
                            echo '<td class="aligncentertable">-</td>';
                        }
                    }

                    echo '</tr>';

                    $i++;
                }
                ?>
            </table>
        </div>
    </div> 
    <!--<div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Training Name, From Date & End Date</span> to see more details *</div> -->
</div></p></div></div>
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
                    window.location = '?eloc=emp_training_app&from='+to+'&to='+from;
                }else{
                    window.location = '?eloc=emp_training_app&from='+from+'&to='+to;
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
        var url= "?widget=search_emp_e_app&d="+department+"&b="+branch+"&t=training";
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
                action:"training"
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
    
    function applytrain(id){
        var is_admin = $('#is_admin').html();
        var emp_id = $('#employee_id').val();
        
        if(is_admin == "0"){
            emp_id = "0";
        }
        var result = confirm("Are you sure you want to apply for this training(s)?");
        if(result){
             $(".modal").show();        
            $.ajax({
                type:'POST',
                url:"?ewidget=emptrainingapp",
                data:{
                    id:id,
                    emp_id:emp_id
                },
                success:function(data){
                    if(data==true){
                        alert("E-Training Applied");
                        window.location='?eloc=emp_training_app';
                    }else{
                        alert("Error While Processing");
                    }            
                }
            });
        }
    }
    
    function deleteid(emptid){

        var result = confirm("Are you sure you want to cancel this training application?");
        if(result == true){
            $.ajax({
                type:'POST',
                url:'?ewidget=deleteemptraining',
                data:{
                    emptid:emptid
                },
                success:function(data){
                    if(data==true){
                        alert("E-Training Application Cancelled");
                        window.location='?eloc=emp_training_app';
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
