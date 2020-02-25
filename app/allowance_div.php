<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<style type="text/css">
    #popup_box1 { 
        display: none;
        position:fixed;  
        _position:absolute; /* hack for internet explorer 6 */  
        height:300px;  
        width:500px;  
        background:#FFFFFF;  
        left: 300px;
        top: 150px;
        z-index:100; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */
        margin-left: 15px;  	
        /* additional features, can be omitted */
        /*        border:2px solid #ff0000;  */
        border:10px solid #C4C4C7;
        padding:15px;  
        font-size:15px;  
        -moz-box-shadow: 0 0 5px #EAEAEB;
        -webkit-box-shadow: 0 0 5px #EAEAEB;
        box-shadow: 0 0 5px #EAEAEB;
        overflow: auto;

    }

    #container1 {

        /*        width:100%;
                height:100%;*/
    }

    a{  
        cursor: pointer;  
        text-decoration:none;  
    } 

    /* This is for the positioning of the Close Link */
    #popupBoxClose1 { 
        line-height:15px;  
        right:5px;  
        top:5px;  
        position:absolute;  
        color:#6fa5e2;  
        font-weight:500;  	
    }
</style>

<div style="padding-bottom: 5px;">
    <div style="width:97%;border:solid;border-color:lightgrey;padding: 8px 10px 10px 10px;">
        <div id="contain1" style="padding-bottom: 5px;">
            <?php if ($igen_a_hr == "a_hr_edit") { ?>
                <div style="padding-bottom: 5px;"><input class="button" type="button" value="Add" onclick="addAllowance()"/></div>
            <?php } ?>
            <table id="tableAllowance" class="TFtable" border="0" style="width:100%; border-collapse: collapse;">
                <thead>
                    <tr class="pluginth">
                        <th style="width:10%;">No.</th>
                        <th style="width:50%;">Allowance Type</th>
                        <th style="width:40%;">Amount (RM)</th>
                    </tr>
                </thead>
                <?php
                $num = 0;
                $sql = "SELECT a.allowance_name, a.allowance_amount FROM employee_allowance AS ea
                        INNER JOIN allowance AS a
                        ON a.id = ea.allowance_id
                        WHERE ea.emp_id =" . $_GET['viewId'];
                $sql_result = mysql_query($sql);
                while ($newArray = mysql_fetch_array($sql_result)) {
                    $num = $num + 1;
                    echo"<tr class='plugintr'>
                            <td style= 'width:10%;'>" . $num . "</td>
                            <td style= 'width:50%;'>" . $newArray['allowance_name'] . "</td>
                            <td style= 'width:40%;'>" . number_format($newArray['allowance_amount'], 2, '.', '') . "</td>
                            </tr>";
                }
                echo'</table>';
                ?>
            </table>
        </div>
    </div>
</div>

<!--pop up box START-->
<div id="popup_box1">	
    <div style="padding-bottom: 5px; padding-left: 10px;">
        <input class='button' type='button' value='Confirm' onclick='select_pro()' id='buttonPro' style='width:90px' />
    </div>
    <input id="popupBoxClose1" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: dimgrey;" type="button" value="X" />
    <table cellpadding="0" cellspacing="0" style="margin-left: 10px;width:97%;">
        <tr class="tableth">
            <th style='text-align: center; width: 100px;'>Select</th>
            <th>Allowance Type</th>
			 <th>Amount</th>
        </tr>
        <tr class="tabletr">
            <?php
            $sql = "SELECT * FROM allowance where allowance_type=1;";
            $sql_result = mysql_query($sql);
            $i = 1;
            while ($newArray = mysql_fetch_array($sql_result)) {
                $sql_result1 = mysql_query("SELECT * FROM employee_allowance WHERE emp_id ='" . $_GET['viewId'] . "' and allowance_id='" . $newArray["id"] . "';");
                if ($newArray1 = mysql_fetch_array($sql_result1)) {
                    echo"<td style='text-align: center;'><input type='checkbox' name= 'selection' value='" . $newArray['id'] . "' checked></option></td><td>" . $newArray['allowance_name'] . "</td><td>" . $newArray['allowance_amount'] . "</td></tr><tr class='tabletr'>";
                } else {
                    echo"<td style='text-align: center;'><input type='checkbox' name= 'selection' value='" . $newArray['id'] . "'></option></td><td>" . $newArray['allowance_name'] . "</td><td>" . $newArray['allowance_amount'] . "</td></tr><tr class='tabletr'>";
                }
            }
            ?>
        </tr>
    </table>
    <br/>
</div>

<script type="text/javascript">

    function select_pro(){
        var selected = $("input[name=selection]:checked").map(function(){ return this.value; }).get().join(",");
        $.ajax({
            type:"POST",
            url:"?widget=dep_div_add",
            data:{
                selected:selected,
                id:<?php echo $_GET['viewId']; ?>
            },
            success:function(data){
                if(data != false){
                    alert("Allowance Edited");
                    $("#contain1").empty().append(data);
                }else{
                    alert("Error While Proccessing");
                }
            }
        })
        unloadPopupBox1();
     
    }

    function addAllowance(){
        // When site loaded, load the Popupbox First
        loadPopupBox1();
	
        $('#popupBoxClose1').click( function() {			
            unloadPopupBox1();
        });
		
		

        
		
        function loadPopupBox1() {	// To Load the Popupbox
            $('#popup_box1').fadeIn("slow");
            $("#container1").css({ // this is just for style
                "opacity": "0.3"  
            }); 		
        }
        /**********************************************************/
		
    }
    
       
    
    function unloadPopupBox1() {	// TO Unload the Popupbox
        $('#popup_box1').fadeOut("slow");
        $("#container1").css({ // this is just for style		
            "opacity": "1"  
        }); 
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