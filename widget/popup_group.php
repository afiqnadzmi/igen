<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<style type="text/css">
    /* popup_box DIV-Styles*/
    #popup_box1 { 
        position:fixed;  
        _position:absolute; /* hack for internet explorer 6 */  
        height:500px;  
        width:600px;  
        background:#FFFFFF;  
        left: 300px;
        top: 100px;
        z-index:100;  /*Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */	
        /* additional features, can be omitted */
        border:10px solid #C4C4C7;	
        padding:15px;  
        font-size:15px;  
        -moz-box-shadow: 0 0 5px #EAEAEB;
        -webkit-box-shadow: 0 0 5px #EAEAEB;
        box-shadow: 0 0 5px #EAEAEB;
        overflow: auto;

    }

    #container {

        /*        width:100%;
                height:100%;*/
    }

    a{  
        cursor: pointer;  
        text-decoration:none;  
    } 

    /* This is for the positioning of the Close Link */
    #popupBoxClose1 {
        /*        font-size:20px;  
                line-height:15px;  
                right:5px;  
                top:5px;  
                position:absolute;  
                color:#6fa5e2;  
                font-weight:500;  */
        right:5px;  
        top:5px;  
        position:absolute;  
    }
    .rounded_corners {
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -khtml-border-radius: 5px;
        border-radius: 5px;
    }

    .button {
        height: 30px;
        width:60px;
        -moz-border-radius: 7px;
        border-radius: 7px;
        padding:3px 2px;
        background:#006699;
        color: white;
        cursor: pointer;

    }

    .button:hover {
        height: 30px;
        width:60px;
        -moz-border-radius: 7px;
        border-radius: 7px;
        padding:3px 2px;
        background:#0099CC;
        color: white;
        cursor: pointer; 

    }
</style>

<?php
$group_id = $_POST['group_id'];
$dep_id = $_POST['dep_id'];
$emp_id = $_POST['emp_id'];
?>

<div id="popup_box1" class="rounded_corners">	
    <div style="padding-bottom: 20px;">
        <span>Select Employee:</span>
        <input id="popupBoxClose1" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: dimgrey;" type="button" value="X" onclick="unloadPopupBox()" />
    </div>
    <div style="border: 1px solid black;">
        <table style="border-collapse: collapse;width: 100%; font-size: 13px;">
            <tr class="tableth">
                <th>Name</th>
                <th>Position</th>
                <th>Action</th>
            </tr>
            <?php
            $sql3 = 'SELECT * , emp.id as empid
                        FROM employee as emp
                        left join position as emp_pos
                        on emp.position_id = emp_pos.id
                        where emp.dep_id = ' . $dep_id . ' ORDER BY position_name;';
            $sql_result3 = mysql_query($sql3);
            while ($newArray3 = mysql_fetch_array($sql_result3)) {
                echo "<tr class='tabletr'>";
                echo "<td>" . $newArray3['full_name'] . "</td><td>" . $newArray3['position_name'] . "</td><td>";
                echo "<a style='font-size: 10pt;color:blue;' onclick='e_select(\"" . $newArray3['empid'] . "\",\"" . $newArray3['full_name'] . "\")'>Select</a></td></tr>";
            }
            ?>
        </table>
    </div>
    <br/>
</div>
<script type="text/javascript">
        
    $(document).ready(function() {
            
        loadPopupBox(); 

    });

    function loadPopupBox() {	// To Load the Popupbox
        $("#container").css({ // this is just for style
            "opacity": "0.3"  
        }); 		
    }
		
        
    function unloadPopupBox() {	// TO Unload the Popupbox
        $("#container").css({ // this is just for style		
            "opacity": "1"  
        }); 
        $('#popup_box1').remove();
    }	
        
    function e_select(id,full_name){
          
        document.getElementById("e_head_name").value=full_name;
        document.getElementById("e_head_id").value=id;
        unloadPopupBox();
     
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