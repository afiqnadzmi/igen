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
        oTable = $('#tablecolor').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
</script>
<style type="text/css">
    /* popup_box DIV-Styles*/
    #popup_box { 
        display:none; /* Hide the DIV */
        position:fixed;  
        _position:absolute; /* hack for internet explorer 6 */  
        height:500px;  
        width:600px;  
        background:#FFFFFF;  
        left: 300px;
        top: 100px;
        z-index:100; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */	
        /* additional features, can be omitted */
        border:10px solid #C4C4C7;  	
        font-size:15px;  
        -moz-box-shadow: 0 0 5px #EAEAEB;
        -webkit-box-shadow: 0 0 5px #EAEAEB;
        box-shadow: 0 0 5px #EAEAEB;
        overflow: auto;
    }
    #e_popup_box { 
        display:none; /* Hide the DIV */
        position:fixed;  
        _position:absolute; /* hack for internet explorer 6 */  
        height:500px;  
        width:600px;  
        background:#FFFFFF;  
        left: 300px;
        top: 170px;
        z-index:100; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */	
        /* additional features, can be omitted */
        border:10px solid #C4C4C7;  	
        font-size:15px;  
        -moz-box-shadow: 0 0 5px #EAEAEB;
        -webkit-box-shadow: 0 0 5px #EAEAEB;
        box-shadow: 0 0 5px #EAEAEB;
        overflow: auto;

    }

    #container {

        width:100%;
        height:100%;
    }

    a{  
        cursor: pointer;  
        text-decoration:none;  
    } 

    /* This is for the positioning of the Close Link */
    #popupBoxClose {
        /*        font-size:20px;  
                line-height:15px;  
                right:5px;  
                top:5px;  
                position:absolute;  
                color:#6fa5e2;  
                font-weight:500;  	*/
        position: relative;
        top: -10px;
    }

    #e_popupBoxClose {
        /*        font-size:20px;  
                line-height:15px;  
                right:5px;  
                top:5px;  
                position:absolute;  
                color:#6fa5e2;  
                font-weight:500;  */
        position: relative;
        top: -10px;	
    }
</style>
<!--<script src="http://jqueryjs.googlecode.com/files/jquery-1.2.6.min.js" type="text/javascript"></script>-->

<script type="text/javascript">
    
    function searchHead_func(){
	

        
        // When site loaded, load the Popupbox First
        loadPopupBox();
	
        $('#popupBoxClose').click( function() {			
            unloadPopupBox();
        });
		
		

        
		
        function loadPopupBox() {	// To Load the Popupbox
            $('#popup_box').fadeIn("slow");
            $("#container").css({ // this is just for style
                "opacity": "0.6"
            });
        }
        /**********************************************************/
		
    };
    
    function e_searchHead_func(){
	

        
        // When site loaded, load the Popupbox First
        e_loadPopupBox();
	
        $('#e_popupBoxClose').click( function() {			
            e_unloadPopupBox();
        });
		
		

        
		
        function e_loadPopupBox() {	// To Load the Popupbox
            $('#e_popup_box').fadeIn("slow");
            $("#container").css({ // this is just for style
                "opacity": "0.6"
            });
        }
        /**********************************************************/
		
    };
    
       
    
    function unloadPopupBox() {	// TO Unload the Popupbox
        $('#popup_box').fadeOut("slow");
        $("#container").css({ // this is just for style		
            "opacity": "1"  
        }); 
    }	
        
    function e_unloadPopupBox() {	// TO Unload the Popupbox
        $('#e_popup_box').fadeOut("slow");
        $("#container").css({ // this is just for style		
            "opacity": "1"  
        }); 
    }	
   
</script>

<div class="main_div">
  	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Department Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="header_text">
        <span>Department Maintenance</span>
    </div>
    <div class="main_content">
        <div id="container" class="tablediv">
            <?php if ($igen_a_m == "a_m_edit") { ?>
                <?php
                if (isset($_GET['did']) == true) {
                    $sql_result1 = mysql_query("SELECT d.is_active, c.id AS company, d.branch_id, d.dep_name, d.dep_description, d.head_emp_id, e.full_name
                                                FROM department AS d
                                                LEFT JOIN employee AS e
                                                ON d.head_emp_id = e.id
                                                JOIN branch AS b
                                                ON b.id=d.branch_id
                                                JOIN company AS c
                                                ON c.id=b.company_id
                                                WHERE d.id=" . $_GET['did'] . ";");
                    while ($newArray1 = mysql_fetch_array($sql_result1)) {
                        ?>
                        <table>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="button" value="Save" onclick="e_save_func(<?php echo $_GET['did'] ?>)" style="width: 70px;"/>
                                    <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Company</td>
                                <td>
                                    <select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)">
                                        <option value="">--Please Select--</option>
                                        <?php
                                        $queryCompany = mysql_query('SELECT * FROM company ORDER BY code');
                                        while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                            if (isset($_GET["did"]) == true && $newArray1["company"] == $rowCompany["id"]) {
                                                echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                            } else {
                                                echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:200px;">Branch</td>
                                <td>
                                    <select id="branchSelect" style="width: 250px;">
                                        <option value="0">--Please Select--</option>
                                        <?php
                                        if (isset($_GET["did"]) == true) {
                                            $sql = 'SELECT id, branch_code FROM branch WHERE company_id=' . $newArray1["company"] . ' ORDER BY branch_code';
                                        } else {
                                            $sql = 'SELECT id, branch_code FROM branch ORDER BY branch_code';
                                        }
                                        $query = mysql_query($sql);
                                        while ($row = mysql_fetch_array($query)) {
                                            if ($newArray1["branch_id"] == $row["id"]) {
                                                echo '<option value="' . $row["id"] . '" selected="selected">' . $row["branch_code"] . '</option>';
                                            } else {
                                                echo '<option value="' . $row["id"] . '">' . $row["branch_code"] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:200px;">Department Name</td>
                                <td><input type="text" class="input_text" id="e_department_name" value="<?php echo $newArray1['dep_name'] ?>" style="width: 250px;"/></td>
                            </tr>
                            <tr>
                                <td style="width:200px; vertical-align: top;">Department Description</td>
                                <td>
                                    <textarea id="e_department_description" style="width: 250px; height: 100px;"><?php echo $newArray1['dep_description'] ?></textarea>
                                </td>
                            </tr>
                            <tr style="display: none;">
                                <td style="width:200px;">Department Quota</td>
                                <td><input type="text" class="input_text" id="e_department_quota" value="0" style="width: 250px;"/></td>
                            </tr>
                            <tr>
                                <td style="width:200px;">Department Head Employee</td>
                                <td><input type="text" class="input_text" readonly id="e_head_name" value="<?php echo $newArray1['full_name'] ?>" style="width: 250px;"/>
                                    <input type="hidden" style="padding-top:10px;" id="e_head_id" value="<?php echo $newArray1['head_emp_id'] ?>"/></td>
                                <td style="padding-left:10px;"><a onclick="e_searchHead_func()" style="color:blue;padding-top:10px;">Search</a></td>
                            </tr>
                            <tr>
                                <td>Department Status</td>
                                <td>
                                    <?php
                                    if ($newArray1["is_active"] == "1") {
                                        $status_active = 'selected="true"';
                                    } elseif ($newArray1["is_active"] == "0") {
                                        $status_inactive = 'selected="true"';
                                    } else {
                                        $default = 'selected="true"';
                                    }
                                    ?>
                                    <select id="dep_status" style="width: 250px;">
                                        <option value="" <?php echo $default; ?>>--Please Select--</option>
                                        <option value="1" <?php echo $status_active; ?>>Active</option>
                                        <option value="0" <?php echo $status_inactive; ?>>Inactive</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    <?php }
                } else { ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Add" onclick="save_func()" style="width: 70px;"/>
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Company</td>
                            <td>
                                <select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)">
                                    <option value="">--Please Select--</option>
                                    <?php
                                    $queryCompany = mysql_query('SELECT * FROM company ORDER BY code');
                                    while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                        if (isset($_GET["did"]) == true && $newArray1["company"] == $rowCompany["id"]) {
                                            echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                        } else {
                                            echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:200px;">Branch</td>
                            <td>
                                <select id="branchSelect" style="width: 250px;">
                                    <option value="0">--Please Select--</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:200px;">Department Name</td>
                            <td><input type="text" class="input_text" id="department_name" style="width: 250px;"/></td>
                        </tr>
                        <tr>
                            <td style="width:200px; vertical-align: top;">Department Description</td>
                            <td><textarea id="department_description" style="width: 250px; height: 100px;"></textarea></td>
                        </tr>
                        <tr style="display: none;">
                            <td style="width:200px;">Department Quota</td>
                            <td><input type="text" class="input_text" id="department_quota" style="width: 250px;"/></td>
                        </tr>
                        <tr style="display: none;">
                            <td style="width:200px;">Department Head Employee</td>
                            <td><input type="text" class="input_text" readonly id="head_name" style="width: 250px;"/>
                                <input type="hidden" style="padding-top:10px;" id="head_id" value=""/></td>
                            <td style="padding-left:10px;"><a onclick="searchHead_func()" style="color:blue;padding-top:10px;">Search</a></td>
                        </tr>
                        <tr>
                            <td>Department Status</td>
                            <td>
                                <select id="dep_status" style="width: 250px;">
                                    <option value="">--Please Select--</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                <?php } ?>
                <?php
            } elseif ($igen_a_m == "a_m_view") {
                $sql_result1 = mysql_query("SELECT d.is_active, c.id AS company, d.branch_id, d.dep_name, d.dep_description, d.head_emp_id, e.full_name
                                            FROM department AS d
                                            LEFT JOIN employee AS e
                                            ON d.head_emp_id = e.id
                                            JOIN branch AS b
                                            ON b.id=d.branch_id
                                            JOIN company AS c
                                            ON c.id=b.company_id
                                            WHERE d.id=" . $_GET['view_id'] . ";");
                $newArray1 = mysql_fetch_array($sql_result1);
                ?>
                <table>
                    <tr>
                        <td>Company</td>
                        <td>
                            <select id="dropCompany" style="width: 250px;" disabled="disabled">
                                <option value="">--Please Select--</option>
                                <?php
                                $queryCompany = mysql_query('SELECT * FROM company ORDER BY code');
                                while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                    if (isset($_GET["view_id"]) == true && $newArray1["company"] == $rowCompany["id"]) {
                                        echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                                    } else {
                                        echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Branch</td>
                        <td>
                            <select id="branchSelect" style="width: 250px;" disabled="disabled">
                                <option value="0">--Please Select--</option>
                                <?php
                                $sql = 'SELECT id, branch_code FROM branch';
                                $query = mysql_query($sql);
                                while ($row = mysql_fetch_array($query)) {
                                    if ($newArray1["branch_id"] == $row["id"]) {
                                        echo '<option value="' . $row["id"] . '" selected="selected">' . $row["branch_code"] . '</option>';
                                    } else {
                                        echo '<option value="' . $row["id"] . '">' . $row["branch_code"] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Department Name</td>
                        <td><input type="text" class="input_text" id="e_department_name" value="<?php echo $newArray1['dep_name'] ?>" style="width: 250px;" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td style="width:200px; vertical-align: top;">Department Description</td>
                        <td>
                            <textarea id="e_department_description" style="width: 250px; height: 100px;" readonly="readonly"><?php echo $newArray1['dep_description'] ?></textarea>
                        </td>
                    </tr>
                    <tr style="display: none;">
                        <td style="width:200px;">Department Quota</td>
                        <td><input type="text" class="input_text" id="e_department_quota" value="0" style="width: 250px;" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Department Head Employee</td>
                        <td><input type="text" class="input_text" readonly id="e_head_name" value="<?php echo $newArray1['full_name'] ?>" style="width: 250px;"/>
                            <input type="hidden" style="padding-top:10px;" id="e_head_id" value="<?php echo $newArray1['head_emp_id'] ?>"/></td>
                    </tr>
                    <tr>
                        <td>Department Status</td>
                        <td>
                            <?php
                            if ($newArray1["is_active"] == "1") {
                                $status_active = 'selected="true"';
                            } elseif ($newArray1["is_active"] == "0") {
                                $status_active = 'selected="true"';
                            } else {
                                $default = 'selected="true"';
                            }
                            ?>
                            <select id="dep_status" style="width: 250px;" disabled="disabled">
                                <option value="" selected="true">--Please Select--</option>
                                <option value="1" <?php echo $status_active; ?>>Active</option>
                                <option value="0" <?php echo $status_inactive; ?>>Inactive</option>
                            </select>
                        </td>
                    </tr>
                </table>
            <?php } ?>
        </div>
    </div>
    <br/><br/>
    <div class="header_text">
        <span>Department List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th style="width: 150px;">Branch Code</th>
                        <th>Department Name</th>
                        <th style="width: 250px;">Head Employee</th>
                        <th style="width: 100px;" class='aligncentertable'>Head Count</th>
                        <th style="width: 100px;" class='aligncentertable'>Status</th>
                        <th style="width: 100px;" class='aligncentertable'>Action</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT d.is_active, b.branch_code, d.dep_name, d.dep_description, e.full_name, d.num_availability, d.dep_quota, d.id AS did
                FROM department AS d
                LEFT JOIN employee AS e
                ON e.id = d.head_emp_id
                JOIN branch AS b
                ON b.id = d.branch_id";
                $sql_result = mysql_query($sql);
                while ($newArray = mysql_fetch_array($sql_result)) {
                    $sql1 = 'SELECT id FROM employee WHERE dep_id = ' . $newArray['did'];
                    $query1 = mysql_query($sql1);
                    $head_count = mysql_num_rows($query1);
                    $i = $i + 1;
                    if ($newArray["is_active"] == 1) {
                        $status = 'Active';
                    } elseif ($newArray["is_active"] == 0) {
                        $status = 'Inactive';
                    }
                    echo"<tr class='plugintr'>
                    <td>" . $i . "</td>
                    <td>" . $newArray['branch_code'] . "</td>
                    <td>" . $newArray['dep_name'] . "</td>
                    <td>" . $newArray['full_name'] . "</td>
                    <td class='aligncentertable'>" . $head_count . "</td>
                    <td class='aligncentertable'>" . $status . "</td>";
                    if ($igen_a_m == "a_m_edit") {
                        echo "<td class='aligncentertable'>
                    <a title='Edit' style='font-size: 10pt;color:blue;' onclick='edit(" . $newArray['did'] . ")'><i class='far fa-edit' style='color:#000;'></i></a>
                    </td>";
                    } elseif ($igen_a_m == "a_m_view") {
                        echo "<td class='aligncentertable'>
                    <a title='View' style='font-size: 10pt;color:blue;' onclick='view(" . $newArray['did'] . ")'><i class='far fa-eye' aria-hidden='true'></i></a>
                    </td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <div id="popup_box" style="z-index:1000;opacity:1;">
        <div style="padding: 20px 15px;">
            <div style="padding-bottom: 5px; padding-left: 5px;">
                <span>Select Employee:</span>
                <input id="popupBoxClose" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: dimgrey;" type="button" value="X" />
            </div>
            <table border="1" class="bordercollapse margincenter" style="width:98%;">
                <tr class="tableth">
                    <th>Name</th>
                    <th style="text-align: center; width: 100px; padding-right: 10px;">Action</th>
                </tr>
                <?php
                $sql = 'SELECT id,full_name FROM employee where position_id = 1 and dep_id = ' . $_GET[did] . ' ;';
                echo $sql;
                $sql_result = mysql_query($sql);
                while ($newArray = mysql_fetch_array($sql_result)) {
                    echo "<tr class='tabletr'>";
                    echo "<td>" . $newArray['full_name'] . "</td>";
                    echo "<td style='text-align: center;'>";
                    echo "<a style='font-size: 10pt;color:blue; padding-right: 10px;' onclick='select(\"" . $newArray['id'] . "\",\"" . $newArray['full_name'] . "\")'>Select</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <script type="text/javascript">
                function select(id,full_name){
                      
                    document.getElementById("head_name").value=full_name;
                    document.getElementById("head_id").value=id;
                    unloadPopupBox();
                 
                }
            </script>
        </div>
    </div>

    <div id="e_popup_box" style="z-index:1000;opacity:1;">	
        <div style="padding: 20px 15px;">
            <div style="padding-bottom: 5px; padding-left: 5px;">
                <span>Select Department Head :</span>
                <input id="e_popupBoxClose" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: dimgrey;" type="button" value="X" />	
            </div>
            <table border="1" class="bordercollapse margincenter" style="width:98%;">
                <tr class="tableth">
                    <th style='text-align: center;'>Name</th>
                    <th style='text-align: center;'>Position</th>
                    <th style='text-align: center;'>Action</th>
                </tr>
                <?php
                $sql2 = 'SELECT * , emp.id as empid
                        FROM employee as emp
                        inner join `position` as emp_pos
                        on emp.position_id = emp_pos.id
                        where emp.dep_id =  ' . $_GET[did] . ' ;';
                $sql_result2 = mysql_query($sql2);
                while ($newArray2 = mysql_fetch_array($sql_result2)) {
                    echo "<tr class='tabletr'>";
                    echo "<td style='text-align: center;'>" . $newArray2['full_name'] . "</td><td style='text-align: center;'>" . $newArray2['position_name'] . "</td><td style='text-align: center;'>";
                    echo "<a style='font-size: 10pt;color:blue;' onclick='e_select(\"" . $newArray2['empid'] . "\",\"" . $newArray2['full_name'] . "\")'>Select</a></td></tr>";
                }
                ?>
            </table>
            <script type="text/javascript">
                function e_select(id,full_name){
          
                    document.getElementById("e_head_name").value=full_name;
                    document.getElementById("e_head_id").value=id;
                    e_unloadPopupBox();
     
                }
            </script>
        </div>
    </div>
</p></div></div></div>
</div>

<script type="text/javascript">
    
    function showBranch(company_id){
        $.ajax({
            type:"POST",
            url:"?widget=showcompany",
            data:{
                company_id:company_id
            },
            success:function(data){
                $("#branchSelect").empty().append(data);
            }
        });
    }
    
    
    function view(id){
        window.location="?loc=department&view_id=" + id;
    }
    function clearNew(){
        window.location="?loc=department";
    }
    function edit(id){
    
        window.location = "?loc=department&did=" + id;
    }

    function search(){
        $('#search_box').toggle('slow');
    }

    function search_func(){
        var name = document.getElementById("search_name").value;
        window.location="?loc=department&name=" + name;
    }

    function save_func(){
        var dep_name = document.getElementById('department_name').value;
        var dep_description = document.getElementById('department_description').value;
        var dep_quota = document.getElementById('department_quota').value;
        var head_id = document.getElementById('head_id').value;
        var branch_id = $("#branchSelect").val();
        var dep_status = $("#dep_status").val();
        
        var error1 = [];
        var error3 = [];
        
        if(branch_id == "0"){
            error3.push("Branch");
        }
        if(dep_status == ""){
            error3.push("Department Status");
        }
        if(dep_name == '' || dep_name == ' '){
            error1.push("Department Name");
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
                url:"?widget=departmentadd",
                data:{
                    dep_name:dep_name,
                    dep_description:dep_description,
                    dep_quota:0,
                    head_id:head_id,
                    branch_id:branch_id,
                    dep_status:dep_status
                },
                success:function(data){
                    if(data == true){
                        alert("Department Added");
                        window.location='?loc=department';
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
    }
    
    function del(id, head_count){
        var result = confirm('Are you sure you want to delete this record?');
        if(result){
            if(head_count <= 0){
                var id = id;
                $.ajax({
                    type:"POST",
                    url:"?widget=deleteDepartment",
                    data:{
                        id:id
                    },
                    success:function(data){
                        if(data == true){
                            alert("Department Deleted");
                            window.location='?loc=department';
                        }else{
                            alert("Error While Proccessing");
                        }
                    }
                })
            }else{
                alert("Department Can't be Deleted");
            }
        }
    }
    
    function e_save_func(id){
        var dep_name = document.getElementById('e_department_name').value;
        var dep_description = document.getElementById('e_department_description').value;
        var dep_quota = document.getElementById('e_department_quota').value;
        var head_id = document.getElementById('e_head_id').value;
        var branch_id = $("#branchSelect").val();
        var dep_status = $("#dep_status").val();
        
        var error1 = [];
        var error3 = [];
        
        if(branch_id == "0"){
            error3.push("Branch");
        }
        if(dep_status == ""){
            error3.push("Department Status");
        }
        if(dep_name == '' || dep_name == ' '){
            error1.push("Department Name");
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
                url:"?widget=editDepartment",
                data:{
                    dep_name:dep_name,
                    dep_description:dep_description,
                    dep_quota:0,
                    head_id:head_id,
                    id:id,
                    branch_id:branch_id,
                    dep_status:dep_status
                },
                success:function(data){
                    if(data == true){
                        alert("Department Updated");
                        window.location='?loc=department';
                    }else{
                        alert("Error While Proccessing");
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