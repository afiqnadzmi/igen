<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<div class="pluginDiv" style="padding-bottom: 5px;">
    <div id="loanDiv" style="width:97%;border:solid;border-color:lightgrey;padding: 8px 10px 10px 10px;">
        <?php if ($igen_a_hr == "a_hr_edit") { ?>
            <div style="padding-bottom: 5px;display: none;"><input class="button" type="button" value="Add" onclick="addclaim()"/></div>
            <table border="0" style="padding-bottom: 5px; border-spacing: 5px;display: none;">
                <tr>
                    <td style="width: 120px;">Claim Title</td>
                    <td><input type="text" id="claim_title" style="padding:3px;width:213px;border:1px solid gray;" /></td>
                    <td style="padding-left: 100px; width: 150px;">Amount (RM)</td>
                    <td><input type="text" id="claim_amount" style="padding:3px;width:213px;border:1px solid gray;" /></td>
                </tr>
                <tr>
                    <td>Claim Number</td>
                    <td><input type="text" id="claim_number" style="padding:3px;width:213px;border:1px solid gray;" /></td>
                    <td style="padding-left: 100px;">Remark</td>
                    <td rowspan="2"><textarea type="text" id="claim_remark" style="padding:3px;width:213px;height:50px;border:1px solid gray;"></textarea></td>
                </tr>
                <tr>
                    <td>Claim Date</td>
                    <td><input type="text" id="claim_date" style="padding:3px;width:213px;border:1px solid gray;" /></td>
                </tr>
                <tr align="left">
                    <td colspan="4" align="left">
                        <div id="errorAdd"></div>
                    </td>
                </tr>
            </table>  
        <?php } ?>
        <div id="changeDiv2">
            <table id="tableClaim12" class="TFtable"  style="width:100%;">
                <thead>
                     <tr class="pluginth">
                        <th class="aligncentertable" style="width:40px"></th>
                        <th>Employee</th>
                        <th style="width:180px">Leave Type</th>
                        <th style="width:150px">From (Date)</th>
                        <th style="width:150px">To (Date)</th>
                        <th style="width:110px">No. of Days</th>
                        <th style="width:120px">Apply Date</th>
						<th style="width:120px">view</th>
                        <th style="width:100px" class='aligncentertable'>Status</th>  
                    </tr>
                </thead>
                <?php
				if(isset($_GET['viewId']) == true){
					$employee_id=$_GET['viewId'];
				}else{
					$employee_id=0;
				}
                $sql = "SELECT *, e.id AS emp_id, l.id AS lid, l.depid
                                FROM employee_leave AS l
                                INNER JOIN employee AS e
                                ON e.id = l.emp_id
                                INNER JOIN leave_type AS t
                                ON l.leave_type_id = t.id
                                WHERE l.emp_id='".$_GET['viewId']."' AND DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= l.leave_date";
                    $rs = mysql_query($sql);
				
					
                    while ($row = mysql_fetch_array($rs)) {
                        $Profile_pic = $row['image_src'];
                        $full_name = $row['full_name'];
                        $type_name = $row['type_name'];
                        $from_date = $row['from_date'];
                        $to_date = $row['to_date'];
                        $num_days = $row['num_days'];
                        $reason = $row['reason'];
                        $status = $row['request_status'];
                        $id = $row['lid'];
                        $emp_id = $row['emp_id'];
						$img_path =$row['img_path'];
                        $leave_type_id = $row["leave_type_id"];
                        $insert_date = $row['leave_date'];
                       
                        //$mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $emp_id . ')" onMouseout="emp_app_hide()"';
                         $f_date =1;
						 $t_date=2;
                        echo'<tr class="plugintr">
                            <td class="aligncentertable cursor_pointer" onMouseover="emp_app(' . $emp_id . ')" onMouseout="emp_app_hide()"><img style="width:40px; height:40px" src="' . $Profile_pic . '"/></td>
                            <td><span class="bold">EMP' . str_pad($emp_id, 6, "0", STR_PAD_LEFT) . '</span><br/>' . $full_name . '</td> 
                            <td>' . $type_name . '</td>
                            <td>' . $from_date . '</td>
                            <td>' . $to_date . '</td>
                            <td>' . $num_days . '</td>
                            <td>' . $insert_date . '</td>';
						
					 if($img_path!=null){
					echo '<td class="aligncentertable"><a href="uploads/leave/' .$img_path. '" target="_blank">View</a></td>';
					}else{
					echo '<td class="aligncentertable">-</td>';
					}
                   
                       
                            if ($status != 'Approved') {
                                echo '<td class="aligncentertable">' . $status . '</td>';
                            } else {
                                echo '<td class="aligncentertable" id="updateStatus1' . $id . '">';
								?>
                                <select name='dropDownLoan' id='drop<?php echo $id ; ?>' onchange='saveValue_admin(<?php echo $id ?>, <?php echo $emp_id ?>, "<?php echo $from_date ?>", "<?php echo $to_date ?>")' style='width: 100px;'>
                               <?php
							   echo '
								     <option value="">Select</option>
                                    <option value="Rejected">Reject</option>';
                                echo '</select>';
                                echo '</td>';
                            }
                        
                        echo '</tr>';
                    }
					?>
            </table>
        </div>
    </div>
   <!-- <div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Claim Title & Claim Number</span> to see more details *</div> -->
</div>
<div class="popup"></div>

<style type="text/css">
    .popup{
        position: absolute; 
        float: left; 
        display: none; 
        width: 350px; 
        border: 1px solid mistyrose;
        background-color: mistyrose;
        padding: 15px 20px 10px 20px;
        -moz-box-shadow: 0 0 5px #mistyrose;
        -webkit-box-shadow: 0 0 5px #mistyrose;
        box-shadow: 0 0 5px #mistyrose;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -khtml-border-radius: 5px;
        border-radius: 5px;
    }
</style>
<script type="text/javascript">
    function emp_app_claim(id){ 
        var doc = $(document).height(); 
        var popup = parseInt($(".pluginDiv").height())+parseInt($(".pluginDiv").position().top+parseInt($(".popup").height()));
        var difference = doc-popup;
        var total;
        
        if(difference >= 0){
            total = 0;
        }else{
            total = difference;
        }
        
        $.ajax({
            type:'POST',
            url:'?widget=emp_app_info',
            data:{
                id:id,
                action:"admin_claim"
            },
            success:function(data){ 
                $(".popup").html(data);
            }  
        });   
        $(document).mousemove(function(e){
            $('.popup').show();
            $('.popup').css({
                left:  e.pageX + 20,
                top:   e.pageY + total
            });
        });
    }
    
    function emp_app_claim_hide(){
        $(document).mousemove(function(){
            $('.popup').hide();
        });
    }
</script>

<script language="javascript" type="text/javascript">
    $(function() {
        var pickerOpts = { dateFormat:"yy-mm-dd" };
        $("#claim_date").datepicker(pickerOpts);
    });
                            
    function addclaim(){
        var claim_title=$('#claim_title').val();
        var claim_number=$('#claim_number').val();
        var claim_date=$('#claim_date').val();
        var claim_amount=$('#claim_amount').val();
        var claim_remark=$('#claim_remark').val();
        var emp=<?php print $employee_id; ?>;
        var error1 = [];
        var error2 = [];
        
        if(claim_title=='' || claim_title==' '){
            error1.push("Claim Title");
        }
        if(claim_number=='' || claim_number==' '){
            error1.push("Claim Number");
        }
        if(claim_date=='' || claim_date==' '){
            error1.push("Date");
        }
        if(claim_amount == '' || claim_amount == ' '){
            error1.push("Amount");
        }else{
            if(claim_amount.match(/^\d+$/) || claim_amount.match(/^[0-9]*\.[0-9]*$/)){
            }else{
                error2.push("Amount");
            }   
        }
        
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var error_data2 = '';
        for(var i=0; i< error2.length; i++){
            error_data2 = error_data2 + error2[i] + "; "
        }
                
        var data1 = "";
        var data2 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
        if(error2.length > 0){
            data2 = "Please Double Check :\n"+error_data2;
        }
                
        if(error1.length > 0 || error2.length > 0){
            alert(data1 + data2);
        }else{
            $.ajax({ 
                type:'POST',
                url:'?widget=add_claim',
                data:{
                    claim_title:claim_title,
                    claim_number:claim_number,
                    claim_date:claim_date,
                    claim_amount:claim_amount,
                    claim_remark:claim_remark,
                    id:emp
                },
                success:function(data){
                    if(data!=false){
                        alert("Claim Added");
                        $('#changeDiv2').empty().append(data);
                        
                        $('#claim_title').val("");
                        $('#claim_number').val("");
                        $('#claim_date').val("");
                        $('#claim_amount').val("");
                        $('#claim_remark').val("");
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
        }
    }
    function delclaim(id){
		var emp=<?php print $employee_id; ?>;
        var result = confirm('Are you sure you want to delete this record?');
        if(result){
            $.ajax({
                type:'POST',
                url:'?widget=del_claim',
                data:{
                    id:id,
                    empid:emp
                },
                success:function(data){
                    if(data!=false){
                        alert("Claim Deleted");
                        $('#changeDiv2').empty().append(data);
                    }else{
                        alert("Error While Processing");
                    }
                }
            })
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