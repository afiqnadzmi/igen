<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<style>
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

<span id="companyID" style="display: none;"><?php echo $_GET["c"]; ?></span>
<div style="padding: 10px;">
    <table>
        <tr>
            <td style="width: 100px;">Search</td>
            <td><input type="text" id="search_emp" name="search_emp" style="width: 150px;" />&nbsp;&nbsp;<a onclick="search_emp()">Search</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="clear_emp()">Clear</a></td>
        </tr>
    </table>
</div>
<div style="border: 1px solid black;">
    <table id="emp_table" style="width: 100%; border-collapse: collapse;">
        <?php
        echo '<tr class="tableth">
                  <th style="width: 30px;">No.</th>
                  <th style="width: 100px;">Employee Code</th>
                  <th>Name</th>
                  <th style="width: 150px;">Position</th>
                  <th style="width: 60px;">Action</th>
                  </tr>';
        if (isset($_GET["emp_name"]) == true) {
            $sql = 'SELECT e.id, e.full_name, p.position_name, e.salary, e.address FROM employee AS e INNER JOIN position AS p ON p.id = e.position_id WHERE e.full_name LIKE "%' . $_GET["emp_name"] . '%" AND e.company_id=' . $_GET["c"];
        } else {
            $sql = 'SELECT e.id, e.full_name, p.position_name, e.salary, e.address FROM employee AS e INNER JOIN position AS p ON p.id = e.position_id WHERE e.company_id=' . $_GET["c"];
        }
        $query = mysql_query($sql);
        while ($row = mysql_fetch_array($query)) {
            $i = $i + 1;
            echo '<tr class="tabletr">
                      <td>' . $i . '</td>
                      <td>EMP' . str_pad($row["id"], 6, "0", STR_PAD_LEFT) . '</td>
                      <td>' . $row["full_name"] . '</td>
                      <td>' . $row["position_name"] . '</td>';
            ?>
            <td><a onclick="select_emp('<?php echo $_GET["id"]; ?>','<?php echo $row["full_name"]; ?>', '<?php echo $row["position_name"] ?>', '<?php echo $row["salary"]; ?>', '<?php echo $row["address"] ?>', '<?php echo $_GET["type"]; ?>')">Select</a></td>
            <?php
            echo '</tr>';
        }
        ?>
    </table>
</div>
<script type="text/javascript" src="js/jquery-1.4.4.js"></script>
<script type="text/javascript">
    function search_emp(){
        var name = $("#search_emp").val();
        var company = $("#companyID").html();
        window.location = '?widget=letter_popup_list&c='+company+'&emp_name='+name;
    }
    function clear_emp(){
        var company = $("#companyID").html();
        window.location = '?widget=letter_popup_list&c='+company;
    }
    function select_emp(id, emp_name, position, salary, address, type){
        if(type == "p"){
            opener.document.getElementById("byname").value= emp_name;
            opener.document.getElementById("byposition").value= position;
        }else if(type == "e"){
            if(id==1){
                opener.document.getElementById("name").value= emp_name;
            }else if(id == 2){
                opener.document.getElementById("name").value= emp_name;
                opener.document.getElementById("position").value= position;
                opener.document.getElementById("salary").value= salary;
                opener.document.getElementById("address").value= address;
            }else if(id == 3){
                opener.document.getElementById("name").value= emp_name;
                opener.document.getElementById("salary").value= salary;
                opener.document.getElementById("address").value= address;
            }else if(id == 4){
                opener.document.getElementById("name").value= emp_name;
                opener.document.getElementById("salary").value= salary;
                opener.document.getElementById("address").value= address;
            }else if(id == 5){
                opener.document.getElementById("name").value= emp_name;
                opener.document.getElementById("address").value= address;
            }else if(id == 6){
                opener.document.getElementById("name").value= emp_name;
                opener.document.getElementById("address").value= address;
            }
        }
        window.close();
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