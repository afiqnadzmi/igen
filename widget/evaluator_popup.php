<?php
/* Copyright (c) 2012 Voxz Software Solution Sdn. Bhd.

  This Software Application is the copyrighted work of Voxz Software Solution or its suppliers.
  Voxz Software Solution grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of Voxz Software Solution Sdn. Bhd. */
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
   <!-- <input type="button"  class="button" value="Select All" onclick="select_all()" style="width: 100px;"/>
    <input type="button" class="button" value="Deselect All" onclick="deselect_all()" style="width: 100px;"/> -->
    <input type="button" class="button" value="Done" onclick="done()" style="width: 100px;"/>
</div>
<div class="tablecolor" style="width: 95%;">
    <table id="tab1" class="TFtable">
        <thead><tr >
            <th style="width:50px">ID</th>
            <th>Employee Name</th>
            <th style="width: 70px;">Select</th>
        </tr></thead>
        <?php
        $confirmed = explode(",", $_GET['c']);
        $confirmedemp = "";
		$dep_id=$_GET['d'];
        for ($i = 0; $i <= count($confirmed); $i++) {
            if ($confirmed[$i] != "") {
                $data = " AND id <> " . $confirmed[$i];
                $confirmedemp = $confirmedemp . $data;
            }
        }
		

        $sql = "select * from employee";
        if ($_GET['d'] != "") {
            if ($_GET['d'] == "ALL") {
                $sql .=" where emp_status = 'Active' AND branch_id = " . $_GET['b'] . $confirmedemp;
            } else {
                $sql .=" where emp_status = 'Active' AND dep_id in($dep_id)".$confirmedemp;
            }
        }

        if ($_GET['list'] != "")
            $idss = explode(",", $_GET['list']);

        $result = mysql_query($sql);
        $i = 1;
        while ($rs = mysql_fetch_array($result)) {
            foreach ($idss as $id) {
                if ($id == $rs['id'])
                    $checked = "checked";
            }
            print "<tr class='tabletr'><td>EMP" . str_pad($rs['id'],6, "0", STR_PAD_LEFT). "</td><td>" . $rs['full_name'] . "</td><td><input type='radio' name='" . $rs['full_name'] . "'class='check' value='" . $rs['id'] . "' $checked></td>";
            $checked = "";
        }
        ?>
    </table>
</div>



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
        $("input:radio:checked").each(function(i,dom){
            ids[i] = $(dom).val();
            names[i] = '<option>' + $(dom).attr("name") + '</option>';
        });
        var newStr = ids.toString();
       
        $.ajax({
            type:'POST',
            url:"?widget=append_emp",
            data:{
                newStr:newStr
            },
            success:function(data){
			
                if(data != false){
                  //  $("#employee_ids", opener.window.document).html(newStr);
                    $("#evaluator_list_view").empty().append(data);
					
                 
					$("select#evaluator_list_view").data("selectBox-selectBoxIt").refresh();
                }else{
                    alert('Error While Proccessing');
                }
            }
        });
    }
</script>
 
			
            <style type="text/css" title="currentStyle">
                /*    @import "plugins/datatable/css/demo_page.css";*/
                @import "plugins/datatable/css/demo_table_jui.css";
                @import "plugins/datatable/css/themes/smoothness/jquery-ui-1.8.4.custom.css";
            </style>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {

        oTable = $('#tab1').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    });
	

</script>