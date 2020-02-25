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
        background-image: url('css/theme_c/BG_Button.png');
        background-repeat: repeat-x;

    }

    .button:hover {
        height: 30px;
        width:70px;
        -moz-border-radius: 7px;
        border-radius: 7px;
        padding:3px 2px;
        background:#0099CC;
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

<div class="tablecolor" style="width: 95%;">
    <table>
        <tr class="tableth">
            <th style="width:50px">ID</th>
            <th>Employee Name</th>
            <th style="width: 110px;">Company</th>
            <th style="width: 110px;">Branch</th>
            <th style="width: 110px;">Department</th>
            <th style="width: 110px;">Group</th>
        </tr>
        <?php
        $emp_id = $_GET["emp"];
        $sqlGetEmp = 'SELECT e.id, e.full_name, c.name, b.branch_code, d.dep_name, g.group_name
                      FROM employee AS e
                      INNER JOIN company AS c
                      ON e.company_id = c.id
                      JOIN branch AS b
                      ON e.branch_id = b.id
                      JOIN department AS d
                      ON e.dep_id = d.id
                      JOIN emp_group AS g
                      ON e.group_id = g.id
                      WHERE e.id IN (' . $emp_id . ')';
        $queryGetEmp = mysql_query($sqlGetEmp);
        $i = 1;
        while ($rowGetEmp = mysql_fetch_array($queryGetEmp)) {
            echo '<tr class="tabletr">
                  <td>' . $rowGetEmp["id"] . '</td>
                  <td>' . $rowGetEmp["full_name"] . '</td>
                  <td>' . $rowGetEmp["name"] . '</td>
                  <td>' . $rowGetEmp["branch_code"] . '</td>
                  <td>' . $rowGetEmp["dep_name"] . '</td>
                  <td>' . $rowGetEmp["group_name"] . '</td>
                  </tr>';
            $i = $i + 1;
        }
        ?>
    </table>
</div>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>