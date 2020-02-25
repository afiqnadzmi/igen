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
        
        <div id="changeDiv2">
		
           <table id="table_plugin" class="TFtable" style="border-collapse: collapse;width: 100%; font-size: 13px;">
                <thead>
                    <tr class="pluginth">
                        <th style="width:10px">No.</th>
                        <th style="width:200px">Training Name</th>
                        <th style="width:100px">Start Date</th>
                        <th style="width:100px">End Date</th>
                        <th style="width:200px">Venue</th>
						<th style="width:200px">Description</th>
                        <th style="width:100px">Apply Date</th>
                        <th class="aligncentertable" style="width:100px;">Status</th>
                        <th class="aligncentertable" style="width: 100px;">Action</th>
                    </tr>
                </thead>
                <?php
				if(isset($_GET['viewId']) == true){
					$employee_id=$_GET['viewId'];
				}else{
					$employee_id=0;
				}
				 $sql2 = 'SELECT * FROM employee WHERE id = "' . $getID . '" ';
					$rs2 = mysql_query($sql2);
					$row2 = mysql_fetch_array($rs2);
					$pos_id = $row2['position_id'];
				$sql = 'SELECT * FROM training WHERE  emp_id LIKE"%'.$getID.'"';
                $rs = mysql_query($sql);
                $i = 1;
                while ($row = mysql_fetch_array($rs)) {
                    $training_id = $row['id'];
                    $training_name = $row['training_name'];
                    $position = $row['position'];
                    $from_date = $row['from_date'];
                    $to_date = $row['to_date'];
                    $start_time = $row['start_time'];
                    $venue = substr($row['venue'], 0, 25) . '...';
                    $train_desc = $row['train_desc'];
                    $request_date = $row['request_date'];
					$desc=$row['train_desc'];

                   // $mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $training_id . ')" onMouseout="emp_app_hide()"';

                    $sql3 = 'SELECT * FROM employee_training WHERE training_id = ' . $training_id . ' AND request_status="Approved" AND employee_id = ' . $emp_id;
                    $query3 = mysql_query($sql3);
                    $row3 = mysql_fetch_array($query3);
                    $num_rows3 = mysql_num_rows($query3);

                    $emptrain_id = $row3["id"];
                    $request_status = $row3["request_status"];
                    $request_date = date('d-m-Y', strtotime($row3["request_date"]));

                    if ($num_rows3 != 0) {
                      
                    

                    echo '<tr class="plugintr">';
                    echo '<td>' . $i . '</td>
                      <td ' . $mouseover . '>' . $training_name . '</td>
                      <td ' . $mouseover . '>' . date('d-m-Y', strtotime($from_date)) . '</td>
                      <td ' . $mouseover . '>' . date('d-m-Y', strtotime($to_date)) . '</td>
                      <td>' . $venue . '</td>
					  <td>' . $desc. '</td>
                      <td>' . $request_date . '</td>
                      <td class="aligncentertable">' . $request_status . '</td>';

                    if ($num_rows3 == 0) {
                        echo '<td class="aligncentertable"><a href="javascript:void()" onclick="applytrain(' . $training_id . ')">Apply</a></td>';
                    } else {
                        if ($request_status == "Pending") {
                            echo '<td class="aligncentertable"><a href="javascript:void()" onclick="deleteid(' . $emptrain_id . ')">Revoke</a></td>';
                        } else {
                            echo '<td class="aligncentertable">-</td>';
                        }
                    }

                    echo '</tr>';

                    $i++;
					
					}
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
		 oTable = $('#table_plugin').dataTable({
            "bJQueryUI": true,                 
            "sPaginationType": "full_numbers"
        });
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
        var result = confirm('Are you sure you want to delete this record?');
		var emp=<?php print $employee_id; ?>;
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