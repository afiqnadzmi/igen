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
        height:400px;  
        width:600px;  
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

    #container {

        width:100%;
        height:100%;
    }

    a{  
        cursor: pointer;  
        text-decoration:none;  
    } 

    /* This is for the positioning of the Close Link */
    #popupBoxClose1 {
        /*        font-size:20px;  
                line-height:15px;  */
        right:5px;  
        top:5px;  
        position:absolute;  
        /*        color:#6fa5e2;  */
        /*        font-weight:500;  */
    }
    .rounded_corners {
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -khtml-border-radius: 5px;
        border-radius: 5px;
    }

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
</style>

<?php

$checkid = $_POST['replaceStr'];

/* Check user_permission_view if restricted access permission */
if (isset($_COOKIE["igen_user_id"]) == true) {
    $queryView = mysql_query('SELECT upv.branch_id FROM user_permission AS up
                    INNER JOIN employee AS e ON e.level_id = up.id
                    JOIN user_permission_view AS upv ON upv.user_permission_id = up.id
                    WHERE e.id=' . $_COOKIE['igen_user_id']);
    $rowView = mysql_fetch_array($queryView);
    $igen_branchlist = $rowView["branch_id"];
    if ($igen_branchlist != "") {
        $sqlAdd = ' AND dep.branch_id IN (' . $igen_branchlist . ')';
    }
}

?>

<div id="popup_box1" class="rounded_corners">	
    <div>
        <table style="padding-bottom: 5px;">
            <tr>
                <td><input type="checkbox" id="temp_transfer" onclick="temp_transfer()" /></td>
                <td id="temp_span" style="padding-left: 5px;">Temporary Transfer</td>
            </tr>
        </table>
        <div id="duration" style="display: none; padding-bottom: 10px;">
            <span>From <input type="text" style="width: 150px;" id="fromdate" /> To <input type="text" style="width: 150px;" id="todate" /></span>
        </div>
    </div>
    <div style="padding-bottom: 10px;">
        <span>Employee transfer to :
            <select name="selectdep" id="testing" style="padding-left: 2px; width: 200px;">
                <option value="">--Please Select--</option>

                <?php
				
			
                if ($_POST["branch"] == "0") {
                    $query = "SELECT grp.id, dep.dep_name, grp.group_name
                    FROM department as dep
                    inner join emp_group as grp
                    on dep.id = grp.dep_id
                    JOIN branch AS b
                    ON b.id = dep.branch_id
                    WHERE dep.is_active = 1 " . $sqlAdd . "
                    ORDER BY dep.dep_name, grp.group_name";
                } else {
				if(!empty($_POST["dep_id"])){
                    $query = "SELECT grp.id, dep.dep_name, grp.group_name
                    FROM department as dep
                    inner join emp_group as grp
                    on dep.id = grp.dep_id
                    JOIN branch AS b
                    ON b.id = dep.branch_id
                    WHERE dep.is_active = 1 " . $sqlAdd . "
                    AND dep.id NOT IN (". $_POST["dep_id"].") AND dep.branch_id=" . $_POST["branch"] . "
                    ORDER BY dep.dep_name, grp.group_name";
				}else{
					$query = "SELECT grp.id, dep.dep_name, grp.group_name
                    FROM department as dep
                    inner join emp_group as grp
                    on dep.id = grp.dep_id
                    JOIN branch AS b
                    ON b.id = dep.branch_id
                    WHERE dep.is_active = 1 " . $sqlAdd . "
                    AND dep.branch_id=" . $_POST["branch"] . "
                    ORDER BY dep.dep_name, grp.group_name";
				}
                }
                $rs = mysql_query($query);
                $num = mysql_num_rows($rs);
				
                if ($num > 0) {
                    echo '<optgroup label="--Active Department--">';
                    while ($rows = mysql_fetch_array($rs)) {
                        echo '<option style="padding-left: 5px;" value="' . $rows['id'] . '">' . $rows['dep_name'] . '  (' . $rows['group_name'] . ')</option>';
                    }
                    echo '</optgroup>';
                }

                $query1 = "SELECT grp.id, dep.dep_name, grp.group_name
                    FROM department as dep
                    inner join emp_group as grp
                    on dep.id = grp.dep_id
                    JOIN branch AS b
                    ON b.id = dep.branch_id
                    WHERE dep.is_active = 0 " . $sqlAdd . "
                    AND dep.branch_id=" . $_POST["branch"] . "
                    ORDER BY dep.dep_name, grp.group_name";
                $rs1 = mysql_query($query1);
                $num1 = mysql_num_rows($rs1);
                if ($num1 > 0) {
                    echo '<optgroup label="--Inactive Department--">';
                    while ($rows1 = mysql_fetch_array($rs1)) {
                        echo '<option style="padding-left: 5px;" value="' . $rows1['id'] . '">' . $rows1['dep_name'] . ' ' . $rows1['group_name'] . '</option>';
                    }
                    echo '</optgroup>';
                }
                ?>
            </select>
            <input class="button" type="button" value="Confirm" onclick="confirmbutton(<?php echo "'$checkid'" ?>)" style="width: 90px;"/>
        </span>
        <input id="popupBoxClose1" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: dimgrey;" type="button" value="X" onclick="unloadPopupBox()" />
    </div>
    <div style="border: 1px solid black;">
        <table style="border-collapse: collapse;width: 100%; font-size: 13px;">
            <tr class="tableth">
                <th style='text-align: left; padding-left: 10px;'>Name</th>
                <th style='text-align: left; padding-left: 10px;'>Group</th>
                <th style='text-align: left; padding-left: 10px;'>Department</th>
            </tr>
            <?php
            $sql = 'SELECT *
                FROM employee as emp
                inner join emp_group as grp
                on emp.group_id = grp.id
                join department as dep
                on dep.id = grp.dep_id
                where emp.id in(' . $checkid . ')';
            $sql_result = mysql_query($sql);
            while ($newArray = mysql_fetch_array($sql_result)) {

                echo "
                <tr class='tabletr'>
                <td style='text-align: left; padding-left: 10px;'>" . $newArray['full_name'] . "</td>
                <td style='text-align: left; padding-left: 10px;'>" . $newArray['dep_name'] . " </td> 
                <td style='text-align: left; padding-left: 10px;'>" . $newArray['group_name'] . " </td> 
                </tr>   
                 ";
            }
            ?>
        </table>
    </div>
    <br/>
</div>
<script type="text/javascript">
        
    $(function() {
        $("#fromdate").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });

    $(function() {
        $("#todate").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
    });
    
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
        //        $('#popup_box1').css({"display":"none"});
        $("#popup_box1").remove();
    }	
        
    function temp_transfer(){
        var temp_show = $('#temp_transfer').is(':checked');
        if(temp_show == false){
            $("#duration").hide();
            $("#temp_span").empty();
            $("#temp_span").append("Temporary Transfer");
        }else{
            $("#duration").show();
            $("#temp_span").empty();
            $("#temp_span").append("<b>Temporary Transfer</b>");
        }    
    }
        
    function confirmbutton(myid)
    {  
	  var dep=$("#dep").val()
        var combo1 = $('#testing').val();//groud_id
        var emptranid = myid;//employee id 
        var fromdate = $("#fromdate").val();
        var todate = $("#todate").val();
        var temp_show;
        if($('#temp_transfer').is(':checked') == false){
            temp_show = "N"
        }else{
            temp_show = "Y";
        }

        if(emptranid == "" || emptranid == " "){
            alert("Please Select Employee");
        }else{
            if(temp_show == "Y" && (fromdate == "" || todate == "")){
                alert("Pick Duration");
            }else{
                var result = confirm("Are you sure you want to transfer this employee(s)?");
                if(result == true){
				$(".modal").show();
                    $.ajax({
                        type:'POST',
                        url:'?widget=updateemployee',
                        data:{
                            combo1:combo1,
                            emptranid:emptranid,
                            fromdate:fromdate,
                            todate:todate,
							dep:dep,
                            temp_show:temp_show
                        },
                        success:function(data){
						
                            if(data == true){
                                alert("Employee Transfered");
                                window.location='?loc=emp_transfer';
                            }else{
                                alert("Error While Processing");
                            }  
                        }
                    })   
                }
            }
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