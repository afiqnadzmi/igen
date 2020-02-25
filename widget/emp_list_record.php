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

      //$status="active"
        $sql = "select * from employee";
      
      //  $sql .=$status;

       

        $result = mysql_query($sql);
        $i = 1;
        while ($rs = mysql_fetch_array($result)) {
           
            print "<tr class='tabletr'><td>EMP" . str_pad($rs['id'],6, "0", STR_PAD_LEFT) . "</td><td>" . $rs['full_name'] . "</td><td><input type='radio' alt='" . $rs['full_name'] . "'  name='radio' class='check' value='" . $rs['id'] . "' $checked></td>";
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
	$(".radio").click(function() {
	
    if ($(this).is(":checked")) {
        var group = "input:checkbox[name='" + $(this).attr("name") + "']";
        $(group).prop("checked", false);
        $(this).prop("checked", true);
    } else {
        $(this).prop("checked", false);
    }
});
    function done(){
        var ids = new Array();
        var names = new Array();
        $("input:radio:checked'").each(function(i,dom){
            ids[i] = $(dom).val();
            names[i] = $(dom).attr("alt");
        });
        var newStr = ids.toString();
		var newname = names.toString();
       if(newStr!=null && newStr!==null){
	   window.open('?loc=incident_record&emp_id='+newStr+'&n='+newname, '_parent')
	   
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