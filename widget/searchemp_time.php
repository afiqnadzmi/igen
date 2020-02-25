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
    .cursor_pointer{
        cursor: pointer;
    }
</style>
<div style="padding: 10px;">
    <table>
        <tr>
            <td style="width: 100px;">Search</td>
            <td><input type="text" id="search_emp" style="width: 150px;" />&nbsp;&nbsp;<a class="cursor_pointer" onclick="search_emp()">Search</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="cursor_pointer" onclick="clear_emp()">Clear</a></td>
        </tr>
    </table>
</div>
<div class="tablecolor" style="width: 700px;">
    <table>
        <tr class="tableth">
            <th style="width:50px">ID</th>
            <th>Employee Name</th>
            <th style="width:200px">Department</th>
            <th style="width:150px">Group</th>
            <th style="width: 70px;">Action</th>
        </tr>

        <?php
        if (isset($_GET["emp_name"]) == true) {
            $sql = "SELECT * , emp.id as empid
                    FROM employee as emp
                    inner join emp_group as grp
                    on emp.group_id = grp.id
                    join department as dep
                    on dep.id = grp.dep_id
                    WHERE emp.full_name LIKE '%" . $_GET["emp_name"] . "%' AND emp.emp_status = 'Active'";
        } else {
            $sql = "SELECT * , emp.id as empid
                    FROM employee as emp
                    inner join emp_group as grp
                    on emp.group_id = grp.id
                    join department as dep
                    on dep.id = grp.dep_id
                    WHERE emp.emp_status = 'Active'";
        }

        $rs = mysql_query($sql);
        $num_rows = mysql_num_rows($rs);

        if ($rs && $num_rows > 0) {
            while ($row = mysql_fetch_array($rs)) {
                $fullname = $row['full_name'];
                $empid = $row['empid'];
                $dep_name = $row['dep_name'];
                $group_name = $row['group_name'];

                echo '<tr class="tabletr">
                        <td>' . $empid . '</td>
                        <td>' . $fullname . '</td>
                        <td>' . $dep_name . '</td>
                        <td>' . $group_name . '</td>';
                ?>
                <td><a class="cursor_pointer" onclick="select_emp(<?php echo $empid; ?>, '<?php echo $fullname; ?>')">Select</a></td>
                <?php
                echo '<tr>';
            }
            ?>
        </table>
    </div>    
    <?php
} else {
    echo '<tr class="tabletr"><td colspan="4">-- No Record --</td><tr>';
}
?>
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script language="javascript" type="text/javascript">
    $("#search_emp").keypress(function(event) {
        if ( event.which == 13 ) {
            search_emp();
        }
    });
    
    function search_emp(){
        var name = $("#search_emp").val();
        window.location = '?widget=searchemp_time&emp_name='+name;
    }
    function clear_emp(){
        window.location = '?widget=searchemp_time';
    }
    function select_emp(empid, empname){
        opener.document.getElementById("name").value= empname;
        opener.document.getElementById("id").value= empid;
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