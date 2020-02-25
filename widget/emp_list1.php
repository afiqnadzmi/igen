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

<div style="padding: 15px 0px 5px 15px;">
    <input type="button"  class="button" value="Select All" onclick="select_all()" style="width: 100px;"/>
    <input type="button" class="button" value="Deselect All" onclick="deselect_all()" style="width: 100px;"/>
    <input type="button" class="button" value="Done" onclick="done()" style="width: 100px;"/>
</div>
<div class="tablecolor" style="width: 95%;">
    <table>
        <tr class="tableth">
            <th style="width:50px">ID</th>
            <th>Employee Name</th>
            <th style="width: 70px;">Select</th>
        </tr>
        <?php
        if (isset($_GET["s"]) == true && $_GET["s"] != "") {
            $status =  $_GET["s"];
        } else {
            $status = '';
        }

        $sql = "SELECT e.full_name,  e.id as eid, e.level_id, u.a_ea, u.id as uid FROM  employee e, user_permission u WHERE u.a_ps='a_ps_show' AND e.level_id=u.id AND emp_status='".$status."'";
      
     

        if ($_GET['list'] != "")
            $idss = explode(",", $_GET['list']);

        $result = mysql_query($sql);
        $i = 1;
        while ($rs = mysql_fetch_array($result)) {
            foreach ($idss as $id) {
                if ($id == $rs['id'])
                    $checked = "checked";
            }
            print "<tr class='tabletr'><td>EMP" . str_pad($rs['eid'],6, "0", STR_PAD_LEFT) . "</td><td>" . $rs['full_name'] . "</td><td><input type='checkbox' name='" . $rs['full_name'] . "'class='check' value='" . $rs['eid'] . "' $checked></td>";
            $checked = "";
        }
        ?>
    </table>
</div>

<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>

<script type="text/javascript">
    function select_all(){
        $("input").attr("checked",true);
    }
    function deselect_all(){
        $("input").attr("checked",false);
    }
    function done(){
        var ids = new Array();
        var names = new Array();
        $("input:checkbox:checked'").each(function(i,dom){
            ids[i] = $(dom).val();
            names[i] = '<option>' + $(dom).attr("name") + '</option>';
        });
        var newStr = ids.toString();
        if(newStr == ""){
            window.close();
        }
		else{
            $.ajax({
                type:'POST',
                url:"?widget=append_emp",
                data:{
                    newStr:newStr
                },
                success:function(data){
                    if(data != false){
                        $("#employee_ids", opener.window.document).html(newStr);
                        $("#employee_list_view", opener.window.document).empty().append(data);
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