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

<div id="container" class="main_div">
    <br/>
    <div class="header_text">
        <span>Group Maintenance</span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <?php if ($igen_a_m == "a_m_edit") { ?>
                <?php
                if (isset($_GET['gid']) == true) {
                    $sql_result2 = mysql_query("SELECT b.company_id, d.branch_id, eg.* FROM emp_group AS eg
                                                INNER JOIN department AS d ON d.id=eg.dep_id
                                                JOIN branch AS b ON b.id=d.branch_id
                                                WHERE eg.id=" . $_GET['gid']);
                    while ($newArray2 = mysql_fetch_array($sql_result2)) {
                        ?>
                        <table>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="button" value="Save" onclick="e_save_func(<?php echo $_GET['gid'] ?>)" style="width: 70px;"/>
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
                                            if (isset($_GET["gid"]) == true && $newArray2["company_id"] == $rowCompany["id"]) {
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
                                    <select id="branchSelect" style="width: 250px;" onchange="showDep(this.value)">
                                        <option value="0">--Please Select--</option>
                                        <?php
                                        $queryBranch = mysql_query('SELECT * FROM branch ORDER BY branch_code');
                                        while ($rowBranch = mysql_fetch_array($queryBranch)) {
                                            if (isset($_GET["gid"]) == true && $newArray2["branch_id"] == $rowBranch["id"]) {
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
                                <td>Department</td>
                                <td>
                                    <select id="e_dept" class="input_text" style="width: 250px;">
                                        <?php
                                        $sql = "SELECT d.id,d.dep_name,b.branch_code FROM department d inner join branch b on d.branch_id=b.id WHERE d.is_active=1 AND d.branch_id = " . $newArray2["branch_id"] . " ORDER BY b.branch_code, d.dep_name";
                                        $sql_result = mysql_query($sql);
                                        echo "<option value=''>--Please Select--</option>";
                                        while ($newArray = mysql_fetch_array($sql_result)) {
                                            if ($newArray2['dep_id'] == $newArray['id']) {
                                                echo"<option value='" . $newArray['id'] . "' selected='selected'>" . $newArray['dep_name'] . "</option>";
                                            } else {
                                                echo"<option value='" . $newArray['id'] . "'>" . $newArray['dep_name'] . "</option>";
                                            }
                                        }
                                        $query_checkdep = mysql_query('SELECT d.id, d.dep_name, d.is_active, b.branch_code FROM department AS d INNER JOIN branch AS b ON d.branch_id = b.id WHERE d.id =' . $newArray2['dep_id']);
                                        $row_checkdep = mysql_fetch_array($query_checkdep);
                                        if ($row_checkdep["is_active"] == "0") {
                                            echo '<optgroup label="--Inactive Department--">
                                                  <option value="' . $row_checkdep["id"] . '" selected="true">' . $row_checkdep["dep_name"] . '</option>
                                                  </optgroup>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:200px;">Group Name</td>
                                <td><input type="text" class="input_text" id="e_group_name" value="<?php echo $newArray2['group_name'] ?>" style="width: 250px;"/></td>
                            </tr>
                            <tr>
                                <td>Group Status</td>
                                <td>
                                    <select id="groupstatus" style="width: 250px;">
                                        <option value="">--Please Select--</option>
                                        <?php
                                        $sql2 = "SELECT is_active FROM emp_group WHERE id = " . $_GET['gid'] . ";";
                                        $sql_result2 = mysql_query($sql2);
                                        $newArray2 = mysql_fetch_array($sql_result2);
                                        if ($newArray2["is_active"] == "1") {
                                            $active_sel = 'selected="true"';
                                            $inactive_sel = '';
                                        } elseif ($newArray2["is_active"] == "0") {
                                            $active_sel = '';
                                            $inactive_sel = 'selected="true"';
                                        }
                                        ?>
                                        <option value="1" <?php echo $active_sel; ?>>Active</option>
                                        <option value="0" <?php echo $inactive_sel; ?>>Inactive</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Employee In-Charge</td>
                                <?php
                                $sql1 = "SELECT * FROM employee where id = " . $_GET['empid'] . ";";
                                $sql_result1 = mysql_query($sql1);
                                $newArray1 = mysql_fetch_array($sql_result1);
                                ?>
                                <td><input type="text" class="input_text" readonly id="e_head_name" value="<?php echo $newArray1['full_name'] ?>" style="width: 250px;"/>
                                    <input type="hidden" style="padding-top:10px;" id="e_head_id" value="<?php echo $_GET['empid'] ?>"/></td>
                                <td style="padding-left:10px;"><a class="cursor_pointer" onclick="popup_func(<?php echo $_GET['gid'] ?>,<?php echo $_GET['did'] ?>)" style="color:blue;padding-top:10px;">Search</a></td>
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
                                <select id="branchSelect" style="width: 250px;" onchange="showDep(this.value)">
                                    <option value="0">--Please Select--</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Department</td>
                            <td>
                                <select id="dept" class="input_text" style="width: 250px;">
                                    <option value="">--Please Select--</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:200px;">Group Name</td>
                            <td><input type="text" class="input_text" id="group_name" style="width: 250px;"/></td>
                        </tr>
                        <tr>
                            <td>Group Status</td>
                            <td>
                                <select id="groupstatus" style="width: 250px;">
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
                $sql_result2 = mysql_query("SELECT b.company_id, d.branch_id, eg.* FROM emp_group AS eg
                                            INNER JOIN department AS d ON d.id=eg.dep_id
                                            JOIN branch AS b ON b.id=d.branch_id
                                            WHERE eg.id=" . $_GET['view_id']);
                $newArray2 = mysql_fetch_array($sql_result2);
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
                                    if (isset($_GET["view_id"]) == true && $newArray2["company_id"] == $rowCompany["id"]) {
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
                                    if (isset($_GET["view_id"]) == true && $newArray2["branch_id"] == $row["id"]) {
                                        echo '<option value="' . $row["id"] . '" selected="true">' . $row["branch_code"] . '</option>';
                                    } else {
                                        echo '<option value="' . $row["id"] . '">' . $row["branch_code"] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Department</td>
                        <td><select id="e_dept" class="input_text" style="width: 250px;" disabled="disabled">
                                <?php
                                $sql = "SELECT d.id,dep_name,branch_code FROM department d left join branch b on d.branch_id=b.id;";
                                $sql_result = mysql_query($sql);
                                echo "<option value=''>--Please Select--</option>";
                                while ($newArray = mysql_fetch_array($sql_result)) {
                                    if ($newArray2['dep_id'] == $newArray['id']) {
                                        echo"<option value='" . $newArray['id'] . "' selected='selected'>" . $newArray['dep_name'] . "</option>";
                                    } else {
                                        echo"<option value='" . $newArray['id'] . "'>" . $newArray['dep_name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:200px;">Group Name</td>
                        <td><input type="text" class="input_text" id="e_group_name" value="<?php echo $newArray2['group_name'] ?>" style="width: 250px;" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td>Group Status</td>
                        <td>
                            <select id="groupstatus" style="width: 250px;" disabled="disabled">
                                <option value="">--Please Select--</option>
                                <?php
                                $sql2 = "SELECT is_active FROM emp_group WHERE id = " . $_GET['view_id'] . ";";
                                $sql_result2 = mysql_query($sql2);
                                $newArray2 = mysql_fetch_array($sql_result2);
                                if ($newArray2["is_active"] == "1") {
                                    $active_sel = 'selected="true"';
                                    $inactive_sel = '';
                                } elseif ($newArray2["is_active"] == "0") {
                                    $active_sel = '';
                                    $inactive_sel = 'selected="true"';
                                }
                                ?>
                                <option value="1" <?php echo $active_sel; ?>>Active</option>
                                <option value="0" <?php echo $inactive_sel; ?>>Inactive</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Employee In-Charge</td>
                        <?php
                        $sql1 = "SELECT * FROM employee where id = " . $_GET['empid'] . ";";
                        $sql_result1 = mysql_query($sql1);
                        $newArray1 = mysql_fetch_array($sql_result1);
                        ?>
                        <td><input type="text" class="input_text" readonly id="e_head_name" value="<?php echo $newArray1['full_name'] ?>" style="width: 250px;"/>
                            <input type="hidden" style="padding-top:10px;" id="e_head_id" value="<?php echo $_GET['empid'] ?>"/></td>
                        <td style="padding-left:10px;"><a class="cursor_pointer" onclick="popup_func(<?php echo $_GET['gid'] ?>,<?php echo $_GET['did'] ?>)" style="color:blue;padding-top:10px;">Search</a></td>
                    </tr>
                </table>
            <?php } ?>
        </div>
    </div>
    <br/><br/>
    <div class="header_text">
        <span>Group List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th>Group Name</th>
                        <th style="width: 150px;">Branch</th>
                        <th style="width: 200px;">Department</th>
                        <th style="width: 150px;">Employee In-Charge</th>
                        <th class='aligncentertable' style="width: 100px;">Head Count</th>
                        <th class='aligncentertable' style="width: 100px;">Status</th>
                        <th class='aligncentertable' style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT *, g.id AS gid, g.num_availability AS gnum, g.dep_id AS gdepid, e.id AS empid,branch_code, g.is_active
                FROM emp_group AS g
                LEFT JOIN employee AS e
                ON g.incharge_emp_id = e.id
                JOIN department AS d
                ON g.dep_id = d.id
				left join branch b on d.branch_id=b.id;
				;";
                $sql_result = mysql_query($sql);

                while ($newArray = mysql_fetch_array($sql_result)) {
                    $sql1 = 'SELECT id FROM employee WHERE group_id = ' . $newArray['gid'] . ' ';
                    $query1 = mysql_query($sql1);
                    $head_count = mysql_num_rows($query1);
                    $i = $i + 1;
                    if ($newArray["is_active"] == "1") {
                        $status = "Active";
                    } elseif ($newArray["is_active"] == "0") {
                        $status = "Inactive";
                    }

                    echo"<tr class='plugintr'>
                    <td>" . $i . "</td>
                    <td>" . $newArray['group_name'] . "</td>
                    <td>" . $newArray['branch_code'] . "</td>
					<td>" . $newArray['dep_name'] . "</td>
                    <td>" . $newArray['full_name'] . "</td>
                    <td class='aligncentertable'>" . $head_count . "</td>
                    <td class='aligncentertable'>" . $status . "</td>";
                    if ($igen_a_m == "a_m_edit") {
                        echo "<td class='aligncentertable'>
                    <a style='font-size: 10pt;color:blue;' href='?loc=group&gid=" . $newArray['gid'] . "&did=" . $newArray['gdepid'] . "&empid=" . $newArray['empid'] . "'>Edit</a>
                    </td>";
                    } elseif ($igen_a_m == "a_m_view") {
                        echo "<td class='aligncentertable'>
                    <a style='font-size: 10pt;color:blue;' href='?loc=group&view_id=" . $newArray['gid'] . "&did=" . $newArray['gdepid'] . "&empid=" . $newArray['empid'] . "'>View</a>
                    </td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
        </div> 
    </div>
</div>
<div id="c"></div>


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
                $("#e_dept").empty().append('<option value="">--Please Select--</option>');
                $("#dept").empty().append('<option value="">--Please Select--</option>');
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
                $("#e_dept").empty().append(data);
                $("#dept").empty().append(data);
            }
        });
    }

    function view(id){
        window.location="?loc=group&view_id=" + id;
    }
    function popup_func(gid,did,empid)
    {
        $.ajax({
            type:'POST',
            url:"?widget=popup_group",
            data:{
                group_id : gid,
                dep_id : did,
                emp_id : empid
            },
            success:function(msg){
                $("#c").append(msg);
            }
        });
    }
    
    function clearNew(){
        window.location="?loc=group";
    }

    function del(id, head_count){
        
        var result = confirm("Are you sure you want to delete this record?");
        if(result == true){
            if(head_count <= 0){
                var id = id;
                $.ajax({
                    type:"POST",
                    url:"?widget=del_group",
                    data:{
                        id:id
                    },
                    success:function(data){
                        if(data == true){
                            alert("Group Deleted");
                            window.location = "?loc=group";
                        }else{
                            alert("Error While Proccessing");
                        }
                    }
                })
            }else{
                alert("Group Can't be Deleted");
            }
        }
    }


    function e_save_func(id){

        var group_name = $('#e_group_name').val();
        var dept = $('#e_dept').val();
        var company = $('#dropCompany').val();
        var branch = $('#branchSelect').val();
        var e_head_id = $('#e_head_id').val();
        var groupstatus = $('#groupstatus').val();
        
        var error1 = [];
        var error3 = [];
        
        if(group_name == "" || group_name == " "){
            error1.push("Group Name");
        }
        if(company == ""){
            error3.push("Company");
        }
        if(branch == "" || branch == "0"){
            error3.push("Branch");
        }
        if(dept == "" || dept == "0"){
            error3.push("Department");
        }
        if(groupstatus == ""){
            error3.push("Group Status");
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
                url:"?widget=editgroup",
                data:{
                    group_name:group_name,
                    dept:dept,
                    emp:e_head_id,
                    quota:0,
                    id:id,
                    groupstatus:groupstatus
                },
                success:function(data){
                    if(data == true){
                        alert("Group Updated");
                        window.location = "?loc=group";
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
    }
    
    function save_func(){
        var group_name = $('#group_name').val()
        var company = $('#dropCompany').val();
        var dept = $('#dept').val();
        var groupstatus = $('#groupstatus').val();
        var branch = $('#branchSelect').val();
        
        var error1 = [];
        var error3 = [];
        
        if(group_name == "" || group_name == " "){
            error1.push("Group Name");
        }
        if(company == ""){
            error3.push("Company");
        }
        if(branch == "" || branch == "0"){
            error3.push("Branch");
        }
        if(dept == "" || dept == "0"){
            error3.push("Department");
        }
        if(groupstatus == ""){
            error3.push("Group Status");
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
                url:"?widget=groupadd",
                data:{
                    group_name:group_name,
                    dept:dept,
                    emp:"",
                    quota:0,
                    groupstatus:groupstatus
                },
                success:function(data){
                    if(data == true){
                        alert("Group Added");
                        window.location = '?loc=group';
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