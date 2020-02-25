<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<style>
    .button {
        height: 30px;
        width:70px;
        -moz-border-radius: 7px;
        border-radius: 7px;
        padding:2px 2px;
        color: white;
        cursor: pointer;
        position: relative;
        top: -6px;
        background-color: blue;
        background-image: url('css/theme_c/BG_Button.png');
        background-repeat: repeat-x;

    }

    .button:hover {
        height: 30px;
        width:70px;
        -moz-border-radius: 7px;
        border-radius: 7px;
        padding:3px 2px;
        background-color:#0099CC;
        color: white;
        cursor: pointer; 

    }
    .tablecolor{
        margin-left: auto;
        margin-right: auto;
        border: 1px solid black;
        background-color: beige;
        width: 98%;
    }


    .tablecolor table{
        border-collapse: collapse;
        width: 100%;
    }

    .tableth th
    {
        /*    background-color:#F8F8F8;*/
        background-color: darkblue;
        color: white;
        padding: 5px 0 5px 10px;
        text-align: left;
    }
    .tablerow
    {
        background-color: #EBF6FC;
    }
    .tabletr
    {
        /*    background-color:#F8F8F8;*/
        background-color: beige;
        color: black;
    }
    .tabletr td{
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 10px;
    }
    a{
        text-decoration: none;
        color:blue; 
    }
    a:hover{
        cursor: pointer;
        text-decoration: underline;
    }
</style>

<?php
$branch = $_GET["b"];
$dep = $_GET["d"];
$month = $_GET["mon"];
$year = $_GET["year"];
$queryCheck = mysql_query("select id from payroll_finalised where finalise_month='" . $month . "' and finalise_year='" . $year . "' limit 1");
$numCheck = mysql_num_rows($queryCheck);
$rowCheck = mysql_fetch_array($queryCheck);
if ($numCheck > 0) {
    $payroll_id = $rowCheck["id"];
    $queryCheckReport = mysql_query('SELECT emp_id FROM payroll_report WHERE payroll_finalised_id=' . $payroll_id);
    $num = mysql_num_rows($queryCheckReport);
    while ($rowCheckReport = mysql_fetch_array($queryCheckReport)) {
        $emp_id = $emp_id . 'e.id<>' . $rowCheckReport["emp_id"] . ' AND ';
    }
} else {
    $payroll_id = '0';
}
$emp_id = substr($emp_id, 0, -5);
if ($emp_id != "") {
    $sqlAdd = ' AND ' . $emp_id;
}


?>

<div style="padding: 15px 0px 5px 15px;">
    <input type="button" class="button" value="Select All" onclick="select_all()" style="width: 100px;"/>
    <input type="button" class="button" value="Deselect All" onclick="deselect_all()" style="width: 100px;"/>
    <input type="button" class="button" value="Confirm" onclick="confirm_payroll(<?php echo $payroll_id; ?>)" style="width: 100px;" />
</div>
<div class="tablecolor" style="width: 95%;">
    <table>
        <tr class="tableth">
            <th style="width:50px">ID</th>
            <th>Employee Name</th>
            <th style="width: 70px;">Select</th>
        </tr>
        <?php
        $sql = 'SELECT e.* FROM employee AS e INNER JOIN department AS d ON d.id = e.dep_id';

        if ($dep == "0") {
            $sql .= ' WHERE e.branch_id = ' . $branch;
        } else {
            $sql .= ' WHERE e.dep_id = ' . $dep;
        }

        if (isset($_GET["status"]) == true && $_GET["status"] != "") {
            $status = ' AND e.emp_status = "' . $_GET["status"] . '"';
        } else {
            $status = '';
        }
        $sql .=$status;
        $sql .= ' AND d.is_active = 1' . $sqlAdd;

        $result = mysql_query($sql);
        $i = 1;
        while ($rs = mysql_fetch_array($result)) {
            foreach ($idss as $id) {
                if ($id == $rs['id'])
                    $checked = "checked";
            }
            print "<tr class='tabletr'><td>" . $rs['id'] . "</td><td>" . $rs['full_name'] . "</td><td><input type='checkbox' name='" . $rs['full_name'] . "'class='check' value='" . $rs['id'] . "' $checked></td>";
            $checked = "";
        }
        ?>
    </table>
</div>
<span id="month" style="display: none;"><?php echo $month; ?></span>
<span id="year" style="display: none;"><?php echo $year; ?></span>
<span id="dep" style="display: none;"><?php echo $dep; ?></span>

<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript">
    function select_all(){
        $("input").attr("checked",true);
    }
    function deselect_all(){
        $("input").attr("checked",false);
    }
    function confirm_payroll(payroll_id){
        var month = $("#month").html();
        var year = $("#year").html();
		var department = $("#dep").html();
		var branch ="<?php echo $_GET["b"];  ?>";
        var result = confirm('Are you sure you want to confirm these payroll(s)?');
        
        if(result){
            var ids = new Array();
        
            $("input:checked").each(function(i,dom){
                ids[i] = $(dom).val();
            });
            var newStr = ids.toString();
        
            $.ajax({
                type:'POST',
                url:"?widget=confirm_payroll",
                data:{
                    newStr:newStr,
                    payroll_id:payroll_id,
                    action:"all",
                    month:month,
                    year:year,
					dep:department,
					branch:branch,
                },
                success:function(data){
				
                    if(data == true){
                        alert("Employee's Payroll Confirmed");
                        opener.location.reload();
                        window.close();
                    }else{
                        alert('Error While Proccessing');
                    }
                }
            });
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