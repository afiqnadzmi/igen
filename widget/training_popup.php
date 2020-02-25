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


    

    table#tab
    {
        /*    background-color:#F8F8F8;*/
        color: #000;
        padding: 5px 0 5px 10px;
        text-align: left;
    }
    
</style>

<div style="padding: 5px 0px 5px 5px;">
    <input type="button"  id="editBut" value="Select All" onclick="select_all()" style="width: 100px;margin-left:10px"/>
    <input type="button" id="editBut" value="Deselect All" onclick="deselect_all()" style="width: 100px; margin-left:10px"/>
    <input type="button" id="editBut" value="Done" onclick="done()" style="width: 100px; margin-left:10px"/>
	<input id="popupBoxClose" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: dimgrey;margin-bottom: 3px; margin-top: -8px;" type="button" value="X" onclick="closePopoup()">
	
</div>

<span style="padding:10px">Searh by Employee Name: <input type="text" style="margin-left:50px" id="search" placeholder="Search By Employee Name"></input></span>
<div  style="width: 95%; padding:10px">
    <table id="tab" class="TFtable" border="1px solid">
        <thead><tr style="background:#000; color:#fff">
            <th style="width:100px">ID</th>
            <th style="width:100px">Employee Name</th>
            <th style="width: 70px;">Select</th>
        </tr></thead>
		
		
        <?php
		
        $confirmed = explode(",", $_GET['c']);
        $confirmedemp = "";
		$position=$_POST['str'];
        for ($i = 0; $i <= count($confirmed); $i++) {
            if ($confirmed[$i] != "") {
                $data = " AND id <> " . $confirmed[$i];
                $confirmedemp = $confirmedemp . $data;
            }
        }
		

        $sql = "select * from employee where position_id in($position) and emp_status = 'Active'";
        
        if ($_GET['list'] != "")
            $idss = explode(",", $_GET['list']);

        $result = mysql_query($sql);
        $i = 1;
        while ($rs = mysql_fetch_array($result)) {
            foreach ($idss as $id) {
                if ($id == $rs['id'])
                    $checked = "checked";
            }
           echo "<tr class='tabletr'><td>EMP" . str_pad($rs['id'],6, "0", STR_PAD_LEFT). "</td><td>" . $rs['full_name'] . "</td><td><input type='checkbox' name='" . $rs['full_name'] . "'class='check' value='" . $rs['id'] . "' $checked></td>";
            $checked = "";
        }
    echo'   
    </table>
</div>';
 ?>
 
 <?php


?>
     <script type="text/javascript" charset="utf-8" src="plugins/datatable/js/jquery.dataTables.js"></script> 
            <script type="text/javascript" charset="utf-8" src="plugins/datatable/js/FixedColumns.js"></script>
			
            <style type="text/css" title="currentStyle">
                /*    @import "plugins/datatable/css/demo_page.css";*/
                @import "plugins/datatable/css/demo_table_jui.css";
                @import "plugins/datatable/css/themes/smoothness/jquery-ui-1.8.4.custom.css";
            </style>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
       /*
        oTable = $('#tab').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		*/
    });
	
	function dep(){
	
	
	}
	
	$("#search").on("keyup", function() {
    var value = $(this).val().toUpperCase();
    
    $("#tab tr").each(function(index) {
        if (index !== 0) {

            $row = $(this);

            var id = $row.find("td:nth-child(2)").text();

            if (id.indexOf(value) !== 0) {
                $row.hide();
            }
            else {
                $row.show();
            }
        }
    });
});
</script>
