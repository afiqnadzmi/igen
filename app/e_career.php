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

<div class="main_div">
    <br/>
    <div class="header_text">
        <span>E-Career</span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <?php
            if ($igen_a_ea == "a_ea_edit") {
                if (isset($_GET['id']) == true) {
                    $sql_result = mysql_query("SELECT ec.*, b.company_id, b.id AS branch_id FROM employee_career AS ec 
                                               INNER JOIN department AS d ON d.id = ec.department
                                               JOIN branch AS b ON b.id = d.branch_id
                                               WHERE ec.id = " . $_GET['id']);
                    $newArray1 = mysql_fetch_array($sql_result);
                    ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Save" onclick="savecareer(<?php echo $_GET['id']; ?>)" id="addbut" style="width: 70px;" /><input type="hidden" value="" id="career_id"/>
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                        </tr>  
                        <tr>
                            <td style="vertical-align: top; width: 200px;">Position Available</td>
                            <td style="vertical-align: top;">
                                <select class="input_text" name="selectpos" id="selectpos" style="width: 250px">
                                    <option  value="0">--Please Select--</option>
                                    <?php
                                    $query = "SELECT * FROM position ORDER BY position_name";
                                    $rs = mysql_query($query);
                                    while ($rows = mysql_fetch_array($rs)) {
                                        $position_name = $rows['position_name'];
                                        $pos_id = $rows['id'];
                                        if ($pos_id == $newArray1["position_available"]) {
                                            echo '<option selected="true" value="' . $pos_id . '">' . $position_name . '</option>';
                                        } else {
                                            echo '<option value="' . $pos_id . '">' . $position_name . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Company<span class="red"> *</span></td>
                            <td>
                                <select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)">
                                    <option value="">--Please Select--</option>
                                    <?php
                                    if ($igen_companylist != "") {
                                        $sqlCompany = 'SELECT * FROM company WHERE id IN (' . $igen_companylist . ') ORDER BY code';
                                    } else {
                                        $sqlCompany = 'SELECT * FROM company ORDER BY code';
                                    }
                                    $queryCompany = mysql_query($sqlCompany);
                                    while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                        if ($newArray1["company_id"] == $rowCompany["id"]) {
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
                            <td>Branch<span class="red"> *</span></td>
                            <td>
                                <select id="dropBranch" style="width: 250px;" onchange="showDep(this.value)">
                                    <option value="">--Please Select--</option>
                                    <?php
                                    if ($igen_branchlist != "") {
                                        $sqlBranch = 'SELECT * FROM branch WHERE id IN (' . $igen_branchlist . ') AND company_id=' . $newArray1["company_id"] . ' ORDER BY branch_code';
                                    } else {
                                        $sqlBranch = 'SELECT * FROM branch WHERE company_id = ' . $newArray1["company_id"] . ' ORDER BY branch_code';
                                    }
                                    $queryBranch = mysql_query($sqlBranch);
                                    while ($rowBranch = mysql_fetch_array($queryBranch)) {
                                        if ($newArray1["branch_id"] == $rowBranch["id"]) {
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
                            <td style="vertical-align: top;">Department</td>
                            <td style="vertical-align: top;">
                                <select class="input_text" name="selectdep" id="selectdep" style="width: 250px">
                                    <option  value="0">--Please Select--</option>
                                    <?php
                                    if ($igen_branchlist != "") {
                                        $sqlDep = 'SELECT d.* FROM department AS d
                                                       INNER JOIN branch AS b ON b.id = d.branch_id
                                                       WHERE d.branch_id IN (' . $igen_branchlist . ') AND b.company_id=' . $newArray1["company_id"] . ' ORDER BY d.dep_name';
                                    } else {
                                        $sqlDep = 'SELECT d.* FROM department AS d
                                                       INNER JOIN branch AS b ON b.id = d.branch_id
                                                       WHERE d.branch_id = ' . $newArray1["branch_id"] . ' AND b.company_id=' . $newArray1["company_id"] . ' ORDER BY d.dep_name';
                                    }
                                    $rs2 = mysql_query($sqlDep);
                                    while ($rows2 = mysql_fetch_array($rs2)) {
                                        $dep_name = $rows2['dep_name'];
                                        $dep_id = $rows2['id'];
                                        if ($dep_id == $newArray1["department"]) {
                                            echo '<option selected="true" value="' . $dep_id . '">' . $dep_name . '</option>';
                                        } else {
                                            echo '<option value="' . $dep_id . '">' . $dep_name . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px">Salary (RM)</td>
                            <td><input type="text" class="input_text" id="salary" name="salary" value="<?php echo $newArray1["salary"] ?>" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Requirement</td>
                            <td><TEXTAREA id="requirement" class="input_textarea" NAME="requirement" style="width: 250px; height: 100px;"><?php echo $newArray1["requirement"] ?></TEXTAREA></td>
                            <td style="padding-left: 50px; vertical-align: top; width: 200px;">Expectation</td>
                            <td><TEXTAREA id="expectation" class="input_textarea" NAME="expectation" style="width: 250px; height: 100px;"><?php echo $newArray1["expectation"] ?></TEXTAREA></td>
                        </tr>
                    </table>
                <?php } else { ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Add" onclick="addcareer()" id="addbut" style="width: 70px;" /><input type="hidden" value="" id="career_id"/>
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                        </tr>  
                        <tr>
                            <td style="vertical-align: top; width: 200px;">Position Available</td>
                            <td style="vertical-align: top;">
                                <select class="input_text" name="selectpos" id="selectpos" style="width: 250px">
                                    <option value="0">--Please Select--</option>
                                    <?php
                                    $query = "SELECT * FROM position ORDER BY position_name";
                                    $rs = mysql_query($query);
                                    while ($rows = mysql_fetch_array($rs)) {
                                        $position_name = $rows['position_name'];
                                        $pos_id = $rows['id'];

                                        echo '<option value="' . $pos_id . '">' . $position_name . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Company<span class="red"> *</span></td>
                            <td>
                                <select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)">
                                    <option value="">--Please Select--</option>
                                    <?php
                                    if ($igen_companylist != "") {
                                        $sqlCompany = 'SELECT * FROM company WHERE id IN (' . $igen_companylist . ') ORDER BY code';
                                    } else {
                                        $sqlCompany = 'SELECT * FROM company ORDER BY code';
                                    }
                                    $queryCompany = mysql_query($sqlCompany);
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
                            <td>Branch<span class="red"> *</span></td>
                            <td>
                                <select id="dropBranch" style="width: 250px;" onchange="showDep(this.value)">
                                    <option value="">--Please Select--</option>
                                    <?php
                                    if ($igen_companylist == "") {
                                        $queryCompany = mysql_query('SELECT * FROM company WHERE is_default=1 LIMIT 1');
                                        $rowCompany = mysql_fetch_array($queryCompany);
                                        $queryBranch = mysql_query('SELECT * FROM branch WHERE company_id="' . $rowCompany["id"] . '" ORDER BY branch_code');
                                        while ($rowBranch = mysql_fetch_array($queryBranch)) {
                                            echo '<option value="' . $rowBranch["id"] . '">' . $rowBranch["branch_code"] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Department</td>
                            <td style="vertical-align: top;">
                                <select class="input_text" name="selectdep" id="selectdep" style="width: 250px">
                                    <option  value="0">--Please Select--</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px">Salary (RM)</td>
                            <td><input type="text" class="input_text" id="salary" name="salary" value="" style="width: 250px"/></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Requirement</td>
                            <td><TEXTAREA id="requirement" class="input_textarea" NAME="requirement" style="width: 250px; height: 100px;"></TEXTAREA></td>
                            <td style="padding-left: 50px; vertical-align: top; width: 200px;">Expectation</td>
                            <td><TEXTAREA id="expectation" class="input_textarea" NAME="expectation" style="width: 250px; height: 100px;"></TEXTAREA></td>
                        </tr>
                    </table>
                    <?php
                }
            } elseif ($igen_a_ea == "a_ea_view") {
                $sql_result = mysql_query("SELECT ec.*, b.company_id, b.id AS branch_id FROM employee_career AS ec 
                                               INNER JOIN department AS d ON d.id = ec.department
                                               JOIN branch AS b ON b.id = d.branch_id
                                               WHERE ec.id = " . $_GET['view_id']);
                $newArray1 = mysql_fetch_array($sql_result);
                ?>
                <table>
                    <tr>
                        <td style="vertical-align: top; width: 200px;">Position Available</td>
                        <td style="vertical-align: top;">
                            <select class="input_text" name="selectpos" id="selectpos" style="width: 250px" disabled="disabled">
                                <option  value="0">--Please Select--</option>
                                <?php
                                $query = "SELECT * FROM position ORDER BY position_name";
                                $rs = mysql_query($query);
                                while ($rows = mysql_fetch_array($rs)) {
                                    $position_name = $rows['position_name'];
                                    $pos_id = $rows['id'];
                                    if ($pos_id == $newArray1["position_available"]) {
                                        echo '<option selected="true" value="' . $pos_id . '">' . $position_name . '</option>';
                                    } else {
                                        echo '<option value="' . $pos_id . '">' . $position_name . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Company<span class="red"> *</span></td>
                        <td>
                            <select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)" disabled="disabled">
                                <option value="">--Please Select--</option>
                                <?php
                                if ($igen_companylist != "") {
                                    $sqlCompany = 'SELECT * FROM company WHERE id IN (' . $igen_companylist . ') ORDER BY code';
                                } else {
                                    $sqlCompany = 'SELECT * FROM company ORDER BY code';
                                }
                                $queryCompany = mysql_query($sqlCompany);
                                while ($rowCompany = mysql_fetch_array($queryCompany)) {
                                    if ($newArray1["company_id"] == $rowCompany["id"]) {
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
                        <td>Branch<span class="red"> *</span></td>
                        <td>
                            <select id="dropBranch" style="width: 250px;" onchange="showDep(this.value)" disabled="disabled">
                                <option value="">--Please Select--</option>
                                <?php
                                if ($igen_branchlist != "") {
                                    $sqlBranch = 'SELECT * FROM branch WHERE id IN (' . $igen_branchlist . ') AND company_id=' . $newArray1["company_id"] . ' ORDER BY branch_code';
                                } else {
                                    $sqlBranch = 'SELECT * FROM branch WHERE company_id = ' . $newArray1["company_id"] . ' ORDER BY branch_code';
                                }
                                $queryBranch = mysql_query($sqlBranch);
                                while ($rowBranch = mysql_fetch_array($queryBranch)) {
                                    if ($newArray1["branch_id"] == $rowBranch["id"]) {
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
                        <td style="vertical-align: top;">Department</td>
                        <td style="vertical-align: top;">
                            <select class="input_text" name="selectdep" id="selectdep" style="width: 250px" disabled="disabled">
                                <option  value="0">--Please Select--</option>
                                <?php
                                if ($igen_branchlist != "") {
                                    $sqlDep = 'SELECT d.* FROM department AS d
                                                       INNER JOIN branch AS b ON b.id = d.branch_id
                                                       WHERE d.branch_id IN (' . $igen_branchlist . ') AND b.company_id=' . $newArray1["company_id"] . ' ORDER BY d.dep_name';
                                } else {
                                    $sqlDep = 'SELECT d.* FROM department AS d
                                                       INNER JOIN branch AS b ON b.id = d.branch_id
                                                       WHERE d.branch_id = ' . $newArray1["branch_id"] . ' AND b.company_id=' . $newArray1["company_id"] . ' ORDER BY d.dep_name';
                                }
                                $rs2 = mysql_query($sqlDep);
                                while ($rows2 = mysql_fetch_array($rs2)) {
                                    $dep_name = $rows2['dep_name'];
                                    $dep_id = $rows2['id'];
                                    if ($dep_id == $newArray1["department"]) {
                                        echo '<option selected="true" value="' . $dep_id . '">' . $dep_name . '</option>';
                                    } else {
                                        echo '<option value="' . $dep_id . '">' . $dep_name . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px">Salary (RM)</td>
                        <td><input type="text" class="input_text" id="salary" name="salary" value="<?php echo $newArray1["salary"] ?>" style="width: 250px" disabled="disabled"/></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Requirement</td>
                        <td><TEXTAREA id="requirement" class="input_textarea" NAME="requirement" style="width: 250px; height: 100px;" readonly="readonly"><?php echo $newArray1["requirement"] ?></TEXTAREA></td>
                        <td style="padding-left: 50px; vertical-align: top; width: 200px;">Expectation</td>
                        <td><TEXTAREA id="expectation" class="input_textarea" NAME="expectation" style="width: 250px; height: 100px;" readonly="readonly"><?php echo $newArray1["expectation"] ?></TEXTAREA></td>
                    </tr>
                </table>
                <?php
            }
            ?>
        </div>
    </div>
    <br/><br/>
    <div class="header_text">
        <span>E-Career List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor">
                <thead>
                    <tr class="pluginth">
                        <th style="width:200px">Position Available</th>
                        <th style="width:150px">Company</th>
                        <th style="width:150px">Branch</th>
                        <th style="width:200px">Department</th>
                        <th class="alignrighttable" style="width:150px">Salary (RM)</th>    
                        <th class="aligncentertable" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql3 = 'SELECT * FROM employee_career';
                $rs3 = mysql_query($sql3);


                while ($row3 = mysql_fetch_array($rs3)) {
                    $position_available = $row3['position_available'];
                    $department = $row3['department'];
                    $requirement = $row3['requirement'];
                    $expectation = $row3['expectation'];
                    $salary = $row3['salary'];
                    $career_id = $row3['id'];

                    $sql4 = 'SELECT position_name FROM position WHERE id = ' . $position_available;
                    $query4 = mysql_query($sql4);
                    $row4 = mysql_fetch_array($query4);

                    $sql5 = 'SELECT d.dep_name, b.branch_code, c.code FROM department AS d
                             INNER JOIN branch AS b ON b.id = d.branch_id
                             JOIN company AS c ON c.id = b.company_id
                             WHERE d.id = ' . $department;
                    $query5 = mysql_query($sql5);
                    $row5 = mysql_fetch_array($query5);

                    echo'<tr class="plugintr">        
                    <td>' . $row4["position_name"] . '</td>
                    <td>' . $row5["code"] . '</td>
                    <td>' . $row5["branch_code"] . '</td>
                    <td>' . $row5["dep_name"] . '</td>
                    <td class="alignrighttable">' . number_format($salary, 2, '.', '') . '</td>';
                    if ($igen_a_ea == "a_ea_edit") {
                        echo '<td class="aligncentertable"><a href="?loc=e_career&id=' . $career_id . '">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void()" onclick="deletecareer(' . $career_id . ')">Delete</a></td>';
                    } elseif ($igen_a_ea == "a_ea_view") {
                        echo '<td class="aligncentertable"><a href="?loc=e_career&view_id=' . $career_id . '">View</a></td>';
                    }
                    echo '</tr>';
                }
                ?>  
            </table>
        </div>
    </div>
</div>
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
            }
        });
    }
    
    function showDep(branch_id){
        $.ajax({
            type:"POST",
            url:"?widget=showdept",
            data:{
                branch_id:branch_id
            },
            success:function(data){
                $("#selectdep").empty().append(data);
            }
        });
    }

    function edit(career_id){
        $.ajax({
            type:'POST',
            url:"?widget=edit_e_career",
            data:{
                career_id:career_id
            },
            success:function(data){
                var data2 = data.split(",");
                var id = data2[0];
                var position_available = data2[1];
                var department = data2[2];
                var requirement = data2[3];
                var expectation = data2[4];
                var salary = data2[5];
                $('#addbut').val("Update");
                $('#career_id').val(id);
                $('#selectpos').val(position_available);
                $('#selectdep').val(department);
                $('#requirement').val(requirement);
                $('#expectation').val(expectation);
                $('#salary').val(salary);
            }

        });
    }
    
    
    function addcareer(){
    
        var position_available = $('#selectpos').val();
        var department = $('#selectdep').val();
        var requirement = $('#requirement').val();
        var expectation = $('#expectation').val();
        var salary = $('#salary').val();

        var error1 = [];
        var error2 = [];
        var error3 = [];

        if(position_available == 0){
            error3.push("Position Available");
        }
        if(salary == '' || salary == ' '){
            error1.push("Salary Amount");
        }else{
            if(salary.match(/^\d+$/) || salary.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Salary Amount");
            }
        }
        if(department == 0){
            error3.push("Department");
        }
        if(requirement == '' || requirement == ' '){
            error1.push("Requirement");
        }
        if(expectation == '' || expectation == ' '){
            error1.push("Expectation");
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
            $.ajax({
                type:'POST',
                url:"?widget=addcareer",
                data:{
                    position_available:position_available,
                    department:department,
                    requirement:requirement,
                    expectation:expectation,
                    salary:salary
                },
                success:function(data){
                    if(data == true){
                        alert("Career Added");
                        window.location='?loc=e_career';
                    }else{
                        alert("Error While Processing");
                    }
                }

            });
        }
    }
    
    function savecareer(id){
        var selectpos = $('#selectpos').val();
        var selectdep = $('#selectdep').val();
        var requirement = $('#requirement').val();
        var expectation = $('#expectation').val();
        var salary = $('#salary').val();
        var error1 = [];
        var error2 = [];
        var error3 = [];

        if(selectpos == 0){
            error3.push("Position Available");
        }
        if(salary == '' || salary == ' '){
            error1.push("Salary Amount");
        }else{
            if(salary.match(/^\d+$/) || salary.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Salary Amount");
            }
        }
        if(selectdep == 0){
            error3.push("Department");
        }
        if(requirement == '' || requirement == ' '){
            error1.push("Requirement");
        }
        if(expectation == '' || expectation == ' '){
            error1.push("Expectation");
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
            $.ajax({
                type:'POST',
                url:"?widget=update_e_career",
                data:{
                    id:id,
                    selectpos:selectpos,
                    selectdep:selectdep,
                    requirement:requirement,
                    expectation:expectation,
                    salary:salary
                },
                success:function(data){
                    if(data == true){
                        alert("Career Updated");
                        window.location='?loc=e_career';
                    }else{
                        alert("Error While Processing");
                    }
                }
            });
        }
    }
    
    function deletecareer(career_id){

        var result = confirm("Are you sure you want to delete this record?");
        if(result == true){
            $.ajax({
                type:'POST',
                url:'?widget=deletecareer',
                data:{
                    career_id:career_id
                },

                success:function(data){
                    if(data==true){
                        alert('Career Deleted');
                        window.location='?loc=e_career';
                    }else{
                        alert('Error While Processing');
                    }
                }
            })
        }
    }
    
    function clearNew(){
        window.location='?loc=e_career';
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