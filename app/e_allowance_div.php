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
        display:none; /* Hide the DIV */
        position:fixed;  
        _position:absolute; /* hack for internet explorer 6 */  
        /*        width:600px;  */
        background:#FFFFFF;  
        left: 300px;
        top: 150px;
        z-index:1; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */
        margin-left: 15px;  	
        /* additional features, can be omitted */
        border:2px solid #ff0000;  	
        padding:15px;  
        font-size:15px;

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
    <div id="tableLeave" style="width:97%;border:solid;border-color:lightgrey;padding: 8px 10px 10px 10px;">
        <table id="eallowancetable" class="TFtable" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr class='pluginth'>
                    <th style="width: 30px;">No.</th>
                    <th style="width: 200px;">Allowance Type</th>
                    <th style="width: 200px; padding-right: 10px;">Amount (RM)</th>
                </tr>
            </thead>
            <?php
            $i = 0;
            $sql = "SELECT a.allowance_name, a.allowance_amount FROM employee_allowance AS ea
                    INNER JOIN allowance AS a
                    ON a.id = ea.allowance_id
                    WHERE ea.emp_id =" . $getID;
            $sql_result = mysql_query($sql);
            while ($newArray = mysql_fetch_array($sql_result)) {
                $i = $i + 1;
                echo"<tr class='plugintr'>
                        <td>" . $i . "</td>
                        <td>" . $newArray['allowance_name'] . "</td>
                        <td style='padding-right: 10px;'>" . number_format($newArray['allowance_amount'], 2, '.', '') . "</td>
                        </tr>";
            }
            echo'</table>';
            ?>
            </tr>
        </table>                   
    </div>
</div>
<!--pop up box START-->
<div id="popup_box1" style="min-height:100px;border:5px solid #EAEAEB;padding:5px">	
    <span>Select Allowance Type :</span>
    <a id="popupBoxClose1">Close</a>	
    <table cellpadding="0" cellspacing="0" style="margin-left: 10px;width:500px;">
        <tr>
            <td>
                <table border="0" style="border-collapse: collapse;"><tr>
                        <?php
                        $sql = "SELECT * FROM allowance;";
                        $sql_result = mysql_query($sql);
                        $i = 1;
                        while ($newArray = mysql_fetch_array($sql_result)) {
                            $sql_result1 = mysql_query("SELECT * FROM employee_allowance WHERE emp_id ='" . $_GET['viewId'] . "' and allowance_id='" . $newArray["id"] . "';");
                            if ($newArray1 = mysql_fetch_array($sql_result1)) {
                                echo"<td width='100px;'><input type='checkbox' name= 'selection' value='" . $newArray['id'] . "' checked>" . $newArray['allowance_name'] . "</option></td></tr><tr>";
                            } else {
                                echo"<td width='100px;'><input type='checkbox' name= 'selection' value='" . $newArray['id'] . "'>" . $newArray['allowance_name'] . "</option></td></tr><tr>";
                            }
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>
                            <a href="javascript:select()">Finish Select</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript">
    function select(){
		var emp=<?php print $employee_id; ?>;
        var selected = $("input[name=selection]:checked").map(function(){ return this.value; }).get().join(",");
        $.ajax({
            type:"POST",
            url:"?widget=dep_div_add",
            data:{
                selected:selected,
                id:emp
            },
            success:function(data){
                if(data != false){
                    $("#contain1").empty().append(data);
                }else{
                    alert("Error while proccess!");
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
		
    };
    
       
    
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