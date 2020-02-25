<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$emp_id = isset($_GET["emp_id"]) ? $_GET["emp_id"] : "";
if (isset($_GET["emp_id"]) == true && isset($_GET["selection"]) == false) {
    $f_name = emp_name($_GET["emp_id"]);
    $query_getEmp = mysql_query('SELECT company_id, branch_id, dep_id, emp_status FROM employee WHERE id=' . $_GET["emp_id"]);
    $row_getEmp = mysql_fetch_array($query_getEmp);
    $emp_company = $row_getEmp["company_id"];
    $emp_branch = $row_getEmp["branch_id"];
    $emp_dep = $row_getEmp["dep_id"];
    $emp_status = $row_getEmp["emp_status"];
} elseif (isset($_GET["selection"]) == true && $_GET["selection"] == "all") {
    if ($_GET["dep"] == "0") {
        $querySelectionEmp = mysql_query('SELECT id FROM employee WHERE branch_id = ' . $_GET["branch"]);
    } else {
        $querySelectionEmp = mysql_query('SELECT id FROM employee WHERE dep_id = ' . $_GET["dep"]);
    }
    while ($rowSelectionEmp = mysql_fetch_array($querySelectionEmp)) {
        $selectionEmp = $selectionEmp . $rowSelectionEmp["id"] . ',';
    }
    $selectionEmp = substr($selectionEmp, 0, -1);
    $getSelectionEmp = explode(",", $selectionEmp);
    $countSelectionEmp = count($getSelectionEmp);
}

$queryCheck = mysql_query("select id, is_close from payroll_finalised where finalise_month='" . $_GET["mon"] . "' and finalise_year='" . $_GET["year"] . "' limit 1");
$rowCheck = mysql_fetch_array($queryCheck);
$numCheck = mysql_num_rows($queryCheck);
if ($numCheck > 0) {
    $payroll_id = $rowCheck["id"];
    $payroll_close = $rowCheck["is_close"];
} else {
    $payroll_id = '0';
    $payroll_close = '0';
}
if (isset($_GET["selection"]) == true && $_GET["selection"] == "all") {
    if ($numCheck > 0) {
        if (isset($_GET["emp_id"]) == true) {
            $queryCheckReport = mysql_query('SELECT id FROM payroll_report WHERE payroll_finalised_id=' . $payroll_id . ' AND emp_id = ' . $_GET["emp_id"]);
        } else {
            $queryCheckReport = mysql_query('SELECT id FROM payroll_report WHERE payroll_finalised_id=' . $payroll_id . ' AND emp_id IN (' . $selectionEmp . ')');
        }
        $numCheck1 = mysql_num_rows($queryCheckReport);
    }
} elseif (isset($_GET["emp_id"]) == true) {
    if ($numCheck > 0) {
        $queryCheckReport = mysql_query('SELECT id FROM payroll_report WHERE payroll_finalised_id=' . $payroll_id . ' AND emp_id = ' . $_GET["emp_id"]);
        $numCheck1 = mysql_num_rows($queryCheckReport);
    }
}
if (isset($_GET["selection"]) == true && $_GET["selection"] == "all") {
    $table_show = 'none';
    $selection1_show = 'selected="selected"';
    $selection2_show = '';
} else {
    $table_show = 'block';
    $selection1_show = '';
    $selection2_show = 'selected="selected"';
}

if (isset($_GET["print"]) == true && $_GET["print"] == "true") {
    $view_display = "display: none;";
    if (isset($_GET["selection"]) == true && $_GET["selection"] == "all") {
        if ($payroll_close == "0") {
            if ($numCheck > "0") {
                if ($numCheck1 == "0") {
                    $print_display = "display: none";
                    $show_display = "display: none";
                } else {
                    $print_display = "display: block";
                    $show_display = "display: none";
                }
                if ($numCheck1 != $countSelectionEmp) {
                    if (isset($_GET["emp_id"]) == true && $_GET["emp_id"] != "") {
                        if ($numCheck1 == "0") {
                            $confirmDis = "display: block";
                        } else {
                            $confirmDis = "display: none";
                        }
                    } else {
                        $confirmDis = "display: block";
                    }
                } else {
                    $confirmDis = "display: none";
                }
            } else {
                $print_display = "display: none";
                $show_display = "display: none";
                $confirmDis = "display: block";
            }
        } else {
            $print_display = "display: block";
            $show_display = "display: none";
            $confirmDis = "display: none";
        }
    } elseif (isset($_GET["selection"]) == false && isset($_GET["emp_id"]) == true) {
        if ($emp_status == "Active") {
            if ($payroll_close == "0") {
                if ($numCheck > "0") {
                    if ($numCheck1 == "0") {
                        $print_display = "display: none";
                        $show_display = "display: none";
                        $confirmDis = "display: block";
                    } else {
                        $print_display = "display: block";
                        $show_display = "display: none";
                        $confirmDis = "display: none";
                    }
                } else {
                    $print_display = "display: none";
                    $show_display = "display: none";
                    $confirmDis = "display: block";
                }
            } else {
                $print_display = "display: block";
                $show_display = "display: none";
                $confirmDis = "display: none";
            }
        } else {
            $print_display = "display: none";
            $show_display = "display: none";
            $confirmDis = "display: none";
        }
    }
} elseif (isset($_GET["print"]) == false && isset($_GET["show"]) == false) {
    $print_display = "display: none";
    $show_display = "display: none";
    $confirmDis = "display: none";
    $view_display = "display: none";
} elseif (isset($_GET["show"]) == true && $_GET["show"] == "true") {
    $confirmDis = "display: none";
    $print_display = "display: none";
    if ($payroll_close == "0") {
        if ($numCheck > "0") {
            if ($numCheck1 == "0") {
                $show_display = "display: block";
                $view_display = "display: none";
            } else {
                if (isset($_GET["selection"]) == true && $_GET["selection"] == "all") {
                    if ($countSelectionEmp != $numCheck1) {
                        $show_display = "display: block";
                        $view_display = "display: none";
                    } else {
                        $show_display = "display: none";
                        $view_display = "display: block";
                    }
                } elseif (isset($_GET["selection"]) == false && isset($_GET["emp_id"]) == true) {
                    $show_display = "display: none";
                    $view_display = "display: block";
                }
            }
        } else {
            $show_display = "display: block";
            $view_display = "display: none";
        }
    } else {
        $show_display = "display: none";
        $view_display = "display: block";
    }
} else {
    $print_display = "display: none";
    $show_display = "display: block";
    $confirmDis = "display: none";
    $view_display = "display: none";
}
?>
<span id="empStatusSpan" style="display: none;"><?php echo $emp_status; ?></span>
<table>
    <tr>
        <td>
            <input type="button" value="Clear" class="button" onclick="clearNew()" style="width: 75px;"/>
        </td>
        <td id="showresult" style="<?php echo $show_display; ?>">
            <input style="width: 75px;" type="button" class="button" value="Process" onclick="showresult()" />
        </td>
        <td id="viewresult" style="<?php echo $view_display; ?>">
            <input style="width: 110px;" type="button" class="button" value="Payroll Viewer" onclick="showresult()" />
        </td>
        <td id="confirmBtn" style="<?php echo $confirmDis; ?>">
            <input type="button" value="Confirm" class="button" onclick="confirmPayroll()" style="width: 75px;"/>
        </td>
        <td>
            <?php
            echo '<input id="printpay" style="width: 75px; ' . $print_display . '" type="button" value="Preview" class="button" ';
            if (isset($_GET["selection"]) == true && $_GET["selection"] == "all") {
                echo 'onclick="printpayall(' . $_GET["mon"] . ',' . $_GET["year"] . ',' . $_GET["branch"] . ',' . $_GET["dep"] . ')"';
            } elseif (isset($_GET["selection"]) == false) {
                echo 'onclick="printpay(' . $month . ',' . $year . ',' . $emp_id . ')"';
            }
            echo '/>';
            ?>
        </td>
    </tr>
</table>
<table>
    <tr>
        <td style="width: 150px;">Choose One</td>
        <td>
            <select id="selection" onchange="displaytable(this.value)" style="width: 250px;">
                <option value="1" <?php echo $selection2_show; ?>>Single Employee</option>
                <option value="2" <?php echo $selection1_show; ?>>All Employee(s)</option>
            </select> 
        </td> 
    </tr>
    <tr>
        <td>Company</td>
        <td>
            <select id="dropCompany" style="width: 250px;" onchange="showBranch(this.value)">
                <?php
                echo '<option value="">--Please Select--</option>';
                if ($igen_companylist != "") {
                    $queryCompany = mysql_query('SELECT * FROM company WHERE id IN (' . $igen_companylist . ') ORDER BY code');
                    while ($rowCompany = mysql_fetch_array($queryCompany)) {
                        if (isset($_GET["emp_id"]) == true && isset($_GET["selection"]) == false) {
                            if ($emp_company == $rowCompany["id"]) {
                                echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                            } else {
                                echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                            }
                        } elseif (isset($_GET["selection"]) == true && $_GET["selection"] == "all") {
                            if ($_GET["company"] == $rowCompany["id"]) {
                                echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                            } else {
                                echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                            }
                        } else {
                            echo '<option value="' . $rowCompany["id"] . '">' . $rowCompany["code"] . '</option>';
                        }
                    }
                } else {
                    $queryCompany = mysql_query('SELECT * FROM company ORDER BY code');
                    while ($rowCompany = mysql_fetch_array($queryCompany)) {
                        if ($rowCompany["is_default"] == "1") {
                            echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                        } elseif ($emp_company == $rowCompany["id"]) {
                            echo '<option value="' . $rowCompany["id"] . '" selected="true">' . $rowCompany["code"] . '</option>';
                        } elseif (isset($_GET["company"]) == true && $_GET["company"] == $rowCompany["id"]) {
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
        <td>Branch</td>
        <td>
            <select id="dropBranch" style="width: 250px;" onchange="showDep(this.value)">
                <option value="">--Please Select--</option>
                <?php
                if ($igen_companylist != "") {
                    if (isset($_GET["emp_id"]) == true && isset($_GET["selection"]) == false) {
                        $sqlBranch = 'SELECT * FROM branch WHERE id IN (' . $igen_branchlist . ') AND company_id = ' . $emp_company . ' ORDER BY branch_code';
                    } elseif (isset($_GET["selection"]) == true && $_GET["selection"] == "all") {
                        $sqlBranch = 'SELECT * FROM branch WHERE id IN (' . $igen_branchlist . ') AND company_id = ' . $_GET["company"] . ' ORDER BY branch_code';
                    }
                    $queryBranch = mysql_query($sqlBranch);
                    while ($rowBranch = mysql_fetch_array($queryBranch)) {
                        if (isset($_GET["emp_id"]) == true && isset($_GET["selection"]) == false) {
                            if ($emp_branch == $rowBranch["id"]) {
                                echo '<option value="' . $rowBranch["id"] . '" selected="true">' . $rowBranch["branch_code"] . '</option>';
                            } else {
                                echo '<option value="' . $rowBranch["id"] . '">' . $emp_branch . $rowBranch["id"] . $rowBranch["branch_code"] . '</option>';
                            }
                        } elseif (isset($_GET["selection"]) == true && $_GET["selection"] == "all") {
                            if ($_GET["branch"] == $rowBranch["id"]) {
                                echo '<option value="' . $rowBranch["id"] . '" selected="true">' . $rowBranch["branch_code"] . '</option>';
                            } else {
                                echo '<option value="' . $rowBranch["id"] . '">' . $rowBranch["branch_code"] . '</option>';
                            }
                        }
                    }
                } else {
                    if (isset($_GET["emp_id"]) == true && isset($_GET["selection"]) == false) {
                        $sqlBranch = 'SELECT * FROM branch WHERE company_id = ' . $emp_company . ' ORDER BY branch_code';
                    } elseif (isset($_GET["selection"]) == true && $_GET["selection"] == "all") {
                        $sqlBranch = 'SELECT * FROM branch WHERE company_id = ' . $_GET["company"] . ' ORDER BY branch_code';
                    } else {
                        $sqlBranch = 'SELECT b.* FROM branch AS b 
                                      INNER JOIN company AS c ON c.id = b.company_id 
                                      WHERE c.is_default =1 ORDER BY b.branch_code';
                    }
                    $queryBranch = mysql_query($sqlBranch);
                    while ($rowBranch = mysql_fetch_array($queryBranch)) {
                        if (isset($_GET["emp_id"]) == true && isset($_GET["selection"]) == false) {
                            if ($emp_branch == $rowBranch["id"]) {
                                echo '<option value="' . $rowBranch["id"] . '" selected="true">' . $rowBranch["branch_code"] . '</option>';
                            } else {
                                echo '<option value="' . $rowBranch["id"] . '">' . $rowBranch["branch_code"] . '</option>';
                            }
                        } elseif (isset($_GET["selection"]) == true && $_GET["selection"] == "all") {
                            if ($_GET["branch"] == $rowBranch["id"]) {
                                echo '<option value="' . $rowBranch["id"] . '" selected="true">' . $rowBranch["branch_code"] . '</option>';
                            } else {
                                echo '<option value="' . $rowBranch["id"] . '">' . $rowBranch["branch_code"] . '</option>';
                            }
                        } else {
                            echo '<option value="' . $rowBranch["id"] . '">' . $rowBranch["branch_code"] . '</option>';
                        }
                    }
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td style="width: 150px;">Department</td>
        <td>
            <select class="input_text" name="selectdep" id="selectdep" style="width: 250px;" onchange="changeDep(this.value)">
                <option value="" selected="true">--Please Select--</option>
                <?php
                if ($igen_companylist != "") {
                    if (isset($_GET["emp_id"]) == true && isset($_GET["selection"]) == false) {
                        $sqlDep = 'SELECT d.* FROM department AS d INNER JOIN branch AS b ON b.id = d.branch_id
                                   WHERE d.branch_id IN (' . $igen_branchlist . ') 
                                   AND b.company_id = ' . $emp_company . ' AND d.is_active=1 ORDER BY d.dep_name';
                    } elseif (isset($_GET["selection"]) == true && $_GET["selection"] == "all") {
                        $sqlDep = 'SELECT d.* FROM department AS d INNER JOIN branch AS b ON b.id = d.branch_id
                                   WHERE d.branch_id IN (' . $igen_branchlist . ') 
                                   AND b.company_id = ' . $_GET["company"] . ' AND d.is_active=1 ORDER BY d.dep_name';
                    }
                } else {
                    if (isset($_GET["emp_id"]) == true && isset($_GET["selection"]) == false) {
                        $sqlDep = 'SELECT d.* FROM department AS d INNER JOIN branch AS b ON b.id = d.branch_id
                                   WHERE b.company_id = ' . $emp_company . ' AND d.branch_id = ' . $emp_branch . ' AND d.is_active=1 ORDER BY d.dep_name';
                    } elseif (isset($_GET["selection"]) == true && $_GET["selection"] == "all") {
                        $sqlDep = 'SELECT d.* FROM department AS d INNER JOIN branch AS b ON b.id = d.branch_id
                                   WHERE b.company_id = ' . $_GET["company"] . ' AND d.branch_id = ' . $_GET["branch"] . ' AND d.is_active=1 ORDER BY d.dep_name';
                    }
                }
                if ($_GET["dep"] == "0") {
                    echo '<option value="0" selected="selected">All Departments</option>';
                } else {
                    echo '<option value="0">All Departments</option>';
                }
                $queryDep = mysql_query($sqlDep);
                while ($rowDep = mysql_fetch_array($queryDep)) {
                    if (isset($_GET["emp_id"]) == true && isset($_GET["selection"]) == false) {
                        if ($emp_dep == $rowDep["id"]) {
                            echo '<option value="' . $rowDep["id"] . '" selected="true">' . $rowDep["dep_name"] . '</option>';
                        } else {
                            echo '<option value="' . $rowDep["id"] . '">' . $rowDep["dep_name"] . '</option>';
                        }
                    } elseif (isset($_GET["selection"]) == true && $_GET["selection"] == "all") {
                        if ($_GET["dep"] == $rowDep["id"]) {
                            echo '<option value="' . $rowDep["id"] . '" selected="true">' . $rowDep["dep_name"] . '</option>';
                        } else {
                            echo '<option value="' . $rowDep["id"] . '">' . $rowDep["dep_name"] . '</option>';
                        }
                    } else {
                        echo '<option value="' . $rowDep["id"] . '">' . $rowDep["dep_name"] . '</option>';
                    }
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td style="width: 150px;">Employee Status</td>
        <td>
            <?php
            if (isset($_GET["status"]) == true) {
                if ($_GET["status"] == "Active") {
                    $empStatusAct = 'selected="selected"';
                } elseif ($_GET["status"] == "Inactive") {
                    $empStatusIn = 'selected="selected"';
                }
            } else {
                $empStatusAct = 'selected="selected"';
                $empStatusIn = '';
            }
            ?>
            <select id="emp_status" style="width: 250px;" onchange="empStatus()">
                <option value="">--Please Select--</option>
                <option value="Active" <?php echo $empStatusAct; ?>>Active</option>
                <option value="Inactive" <?php echo $empStatusIn; ?>>Inactive</option>
            </select> 
        </td>
    </tr>
</table>
<table id="table1" style="display: <?php echo $table_show; ?>">
    <tr>
        <td style="width: 150px;">Employee</td>
        <td><input type="text" id="emp_name" value="<?php echo $f_name ?>" style="width: 245px;" readonly="readonly"/></td>
        <td>&nbsp;<a class="cursor_pointer blue" onclick="search_emp()">Search</a></td>
    </tr>
</table>
<table>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td colspan="2">Month&nbsp;&nbsp;
            <?php
            if (isset($_GET["emp_id"]) == true) {
                $emp = 1;
            } else {
                $emp = 0;
            }
            ?>
            <select id="ddlmon" style="width: 60px;" onchange="changemonth(<?php echo $emp; ?>)">
                <?php
                for ($i = 1; $i < 13; $i++) {
                    if (isset($_GET["mon"]) == true) {
                        if ($_GET["mon"] == $i) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                    } else {
                        $m = date('n');
                        if ($m == $i) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                    }
                    ?>
                    <option <?php echo $selected ?> value="<?php echo $i ?>"><?php echo date('M', mktime(0, 0, 0, $i, 1, date("Y"))) ?></option>
                <?php } ?>
            </select>&nbsp;&nbsp;
            Year&nbsp;&nbsp;
            <select style="width: 80px;" id="ddlyear" onchange="changemonth(<?php echo $emp; ?>)">
                <?php
                for ($i = date("Y"); $i >= date("Y") - 5; $i--) {
                    if ($_GET["year"] == $i) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    ?>
                    <option <?php echo $selected ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
</table>   

<span id="selectionSpan" style="display: none;"><?php echo $_GET["selection"]; ?></span>
<span id="empidSpan" style="display: none;"><?php echo $_GET["emp_id"]; ?></span>
<span id="payrollIDSpan" style="display: none;"><?php echo $payroll_id; ?></span>
<span id="branchSpan" style="display: none;"><?php echo $igen_branchlist; ?></span>

<script language="javascript" type="text/javascript">
    
    function confirmPayroll(){
        var selection = $("#selectionSpan").html();
        var month = $("#ddlmon").val();
        var year = $("#ddlyear").val();
        var status = $("#emp_status").val();
        var url = '';
        
        if(selection == "all"){
            var company = $("#dropCompany").val();
            var branch = $("#dropBranch").val();
            var dep = $("#selectdep").val();
            url = '&status='+status+'&mon='+month+'&year='+year+'&c='+company+'&b='+branch+'&d='+dep;
            window.open('?widget=confirm_emplist'+url,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');  
        }else if(selection == ""){
            var newStr = $("#empidSpan").html();
            var payroll_id = $("#payrollIDSpan").html();
            var result = confirm('Are you sure you want to confirm this payroll?');
            if(result){
                $.ajax({
                    type:'POST',
                    url:"?widget=confirm_payroll",
                    data:{
                        newStr:newStr,
                        payroll_id:payroll_id,
                        action:"single",
                        month:month,
                        year:year
                    },
                    success:function(data){
                        if(data == true){
                            alert("Employee's Payroll Confirmed");
                            window.location.reload();
                        }else{
                            alert('Error While Proccessing');
                        }
                    }
                });
            }
        }
    }
    
    function empStatus(){
        var selection = $("#selection").val();
        var company = $("#dropCompany").val();
        var branch = $("#dropBranch").val();
        var dept = $("#selectdep").val();
        var status=$('#emp_status').val();
        var month=$('#ddlmon').val();
        var year=$('#ddlyear').val();
        if(selection == "2"){
            if(dept != ""){
                window.location = '?loc=payroll&show=true&selection=all&status='+status+'&company='+company+'&branch='+branch+'&dep='+dept+'&mon='+month+'&year='+year;
            }
        }
    }
    
    function changemonth(emp){
        var selection = $("#selection").val();
        var company = $("#dropCompany").val();
        var branch = $("#dropBranch").val();
        var dept = $("#selectdep").val();
        var empID = $("#empidSpan").html();
        var status=$('#emp_status').val();
        var month=$('#ddlmon').val();
        var year=$('#ddlyear').val();
        if(selection == "1"){
            if(empID != ""){
                window.location = '?loc=payroll&show=true&emp_id='+empID+'&mon='+month+'&year='+year;
            }
        }else if(selection == "2"){
            if(dept != ""){
                window.location = '?loc=payroll&show=true&selection=all&status='+status+'&company='+company+'&branch='+branch+'&dep='+dept+'&mon='+month+'&year='+year;
            }
        }
        
        //        if(emp_status == "Active"){
        //            if(emp == "1" && company != "" && branch != "" && dept != ""){
        //                $('#printpay').css({"display": "none"});
        //                $('#showresult').css({"display": "block"});
        //                $('#confirmBtn').css({"display": "none"});
        //            }else if(emp == "0" && company != "" && branch != "" && dept != ""){
        //                $('#printpay').css({"display": "none"});
        //                $('#showresult').css({"display": "block"});
        //                $('#confirmBtn').css({"display": "none"});
        //            }
        //        }else{
        //            $('#printpay').css({"display": "none"});
        //            $('#showresult').css({"display": "block"});
        //            $('#confirmBtn').css({"display": "none"});
        //        }
    }
    function clearNew(){
        window.location='?loc=payroll';
    }
    function search_emp(){
        var dep_id=$('#selectdep').val();
        var branch_id=$('#dropBranch').val();
        var status=$('#emp_status').val();
        var month=$('#ddlmon').val();
        var year=$('#ddlyear').val();
        if(dep_id!='' && branch_id != ''){
            if(dep_id=='0'){
                window.open('?widget=search_emp&branch_id='+branch_id+'&status='+status+'&mon='+month+'&year='+year,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
            }else{
                window.open('?widget=search_emp&dep_id='+dep_id+'&status='+status+'&mon='+month+'&year='+year,'mywindow','location=1,status=1,scrollbars=1,width=750,height=700');
            }
        }else{
            alert('Please Select Branch & Department');
        }
    }
    function showBranch(company_id){
        var branch = $("#branchSpan").html();
        $.ajax({
            type:"POST",
            url:"?widget=showcompany",
            data:{
                company_id : company_id,
                branch:branch
            },
            success:function(data){
                $("#dropBranch").empty().append(data);
                $("[name=selectdep]").empty().append("<option value='' >--Please Select--</option>");
                $('#printpay').css({"display": "none"});
                $('#confirmBtn').css({"display": "none"});
                $('#showresult').css({"display": "none"});
                $("#emp_name").val("");
            }
        });
    }
    function showDep(branch_id){
        $.ajax({
            type:"POST",
            url:"?widget=showdept_payroll",
            data:{
                branch_id : branch_id
            },
            success:function(data){
                $("#selectdep").empty().append(data);
                $('#printpay').css({"display": "none"});
                $('#confirmBtn').css({"display": "none"});
                $('#showresult').css({"display": "none"});
                $("#emp_name").val("");
            }
        });
    }
    function changeDep(id){
        $("#emp_name").val("");
        var emp_name = $("#emp_name").val();
        var selection = $("#selection").val();
        $('#printpay').css({"display": "none"});
        $('#confirmBtn').css({"display": "none"});
        if(selection == "1"){
            if(id == "" || emp_name == ""){
                $('#showresult').css({"display": "none"});
            }else{
                $('#showresult').css({"display": "block"});
            }
        }else if(selection == "2"){
            var company = $("#dropCompany").val();
            var branch = $("#dropBranch").val();
            var dept = $("#selectdep").val();
            var status=$('#emp_status').val();
            var month=$('#ddlmon').val();
            var year=$('#ddlyear').val();
            if(dept != ""){
                window.location = '?loc=payroll&show=true&selection=all&status='+status+'&company='+company+'&branch='+branch+'&dep='+dept+'&mon='+month+'&year='+year;
            }else{
                $("#showAllEmpTable").empty();
            }
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